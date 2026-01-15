<?php
/**
 * Device Registration Service
 * 
 * Handles device fingerprinting, registration, and validation
 * 
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Device_Registration_Service {
	
	/**
	 * Generate device fingerprint from device characteristics
	 * 
	 * @param array $device_data Device characteristics
	 * @return string Device fingerprint hash
	 */
	public static function generate_device_fingerprint( $device_data ) {
		$fingerprint_string = '';
		
		// Collect device characteristics
		$fingerprint_string .= isset( $device_data['user_agent'] ) ? $device_data['user_agent'] : '';
		$fingerprint_string .= isset( $device_data['screen_resolution'] ) ? $device_data['screen_resolution'] : '';
		$fingerprint_string .= isset( $device_data['timezone'] ) ? $device_data['timezone'] : '';
		$fingerprint_string .= isset( $device_data['language'] ) ? $device_data['language'] : '';
		$fingerprint_string .= isset( $device_data['platform'] ) ? $device_data['platform'] : '';
		
		// Create hash
		return hash( 'sha256', $fingerprint_string );
	}
	
	/**
	 * Check if device already exists
	 * 
	 * @param string $device_fingerprint Device fingerprint
	 * @return array|false Device data or false if not found
	 */
	public static function get_device_by_fingerprint( $device_fingerprint ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_devices';
		
		$device = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$table_name} WHERE device_fingerprint = %s",
				$device_fingerprint
			),
			ARRAY_A
		);
		
		return $device ? $device : false;
	}
	
	/**
	 * Register new device
	 * 
	 * @param array $device_data Device registration data
	 * @return array|WP_Error Device ID and data, or error
	 */
	public static function register_device( $device_data ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_devices';
		
		// Generate fingerprint if not provided
		if ( empty( $device_data['device_fingerprint'] ) ) {
			$device_data['device_fingerprint'] = self::generate_device_fingerprint( $device_data );
		}
		
		// Check if device already exists
		$existing = self::get_device_by_fingerprint( $device_data['device_fingerprint'] );
		if ( $existing ) {
			return new WP_Error(
				'device_exists',
				'Device already registered',
				array( 'device_id' => $existing['id'], 'status' => $existing['status'] )
			);
		}
		
		// Prepare data
		$insert_data = array(
			'device_fingerprint' => $device_data['device_fingerprint'],
			'status'             => 'pending',
			'user_agent'         => isset( $device_data['user_agent'] ) ? $device_data['user_agent'] : '',
			'screen_resolution'  => isset( $device_data['screen_resolution'] ) ? $device_data['screen_resolution'] : '',
			'timezone'           => isset( $device_data['timezone'] ) ? $device_data['timezone'] : '',
			'language'           => isset( $device_data['language'] ) ? $device_data['language'] : '',
			'created_at'         => current_time( 'mysql' ),
		);
		
		// Insert device
		$result = $wpdb->insert( $table_name, $insert_data );
		
		if ( $result === false ) {
			return new WP_Error(
				'db_error',
				'Failed to register device',
				array( 'error' => $wpdb->last_error )
			);
		}
		
		$device_id = $wpdb->insert_id;
		
		return array(
			'device_id'          => $device_id,
			'device_fingerprint' => $device_data['device_fingerprint'],
			'status'             => 'pending',
		);
	}
	
	/**
	 * Activate device (Step 3)
	 * 
	 * @param int   $device_id Device ID
	 * @param array $activation_data Activation data (location, etc.)
	 * @return array|WP_Error Success or error
	 */
	public static function activate_device( $device_id, $activation_data ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_devices';
		
		// Verify device exists
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM {$table_name} WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		if ( ! $device ) {
			return new WP_Error( 'device_not_found', 'Device not found' );
		}
		
		// Update device with activation data
		// Use direct SQL to handle NULL values properly
		$set_parts = array();
		$set_values = array();
		
		$set_parts[] = "status = %s";
		$set_values[] = 'activating';
		
		$set_parts[] = "activated_at = %s";
		$set_values[] = current_time( 'mysql' );
		
		$set_parts[] = "activation_ip = %s";
		$set_values[] = self::get_client_ip();
		
		// Handle location data - only include if provided
		if ( isset( $activation_data['latitude'] ) && $activation_data['latitude'] !== null && $activation_data['latitude'] !== '' ) {
			$set_parts[] = "location_lat = %f";
			$set_values[] = floatval( $activation_data['latitude'] );
		}
		
		if ( isset( $activation_data['longitude'] ) && $activation_data['longitude'] !== null && $activation_data['longitude'] !== '' ) {
			$set_parts[] = "location_lng = %f";
			$set_values[] = floatval( $activation_data['longitude'] );
		}
		
		if ( isset( $activation_data['city'] ) && ! empty( $activation_data['city'] ) ) {
			$set_parts[] = "location_city = %s";
			$set_values[] = sanitize_text_field( $activation_data['city'] );
		}
		
		if ( isset( $activation_data['state'] ) && ! empty( $activation_data['state'] ) ) {
			$set_parts[] = "location_state = %s";
			$set_values[] = sanitize_text_field( $activation_data['state'] );
		}
		
		if ( isset( $activation_data['country'] ) && ! empty( $activation_data['country'] ) ) {
			$set_parts[] = "location_country = %s";
			$set_values[] = sanitize_text_field( $activation_data['country'] );
		}
		
		$set_values[] = $device_id;
		
		$sql = "UPDATE {$table_name} SET " . implode( ', ', $set_parts ) . " WHERE id = %d";
		$result = $wpdb->query( $wpdb->prepare( $sql, $set_values ) );
		
		if ( $result === false ) {
			return new WP_Error( 'db_error', 'Failed to activate device', array( 'error' => $wpdb->last_error ) );
		}
		
		return array(
			'success' => true,
			'device_id' => $device_id,
			'status' => 'activating',
		);
	}
	
	/**
	 * Validate device (final step after all validations pass)
	 * 
	 * @param int $device_id Device ID
	 * @return array|WP_Error Success or error
	 */
	public static function validate_device( $device_id ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_devices';
		
		$result = $wpdb->update(
			$table_name,
			array(
				'status'       => 'validated',
				'validated_at' => current_time( 'mysql' ),
			),
			array( 'id' => $device_id ),
			array( '%s', '%s' ),
			array( '%d' )
		);
		
		if ( $result === false ) {
			return new WP_Error( 'db_error', 'Failed to validate device', array( 'error' => $wpdb->last_error ) );
		}
		
		return array(
			'success' => true,
			'device_id' => $device_id,
			'status' => 'validated',
		);
	}
	
	/**
	 * Get client IP address
	 * 
	 * @return string IP address
	 */
	private static function get_client_ip() {
		$ip_keys = array(
			'HTTP_CF_CONNECTING_IP', // Cloudflare
			'HTTP_X_REAL_IP',
			'HTTP_X_FORWARDED_FOR',
			'REMOTE_ADDR',
		);
		
		foreach ( $ip_keys as $key ) {
			if ( ! empty( $_SERVER[ $key ] ) ) {
				$ip = sanitize_text_field( $_SERVER[ $key ] );
				// Handle comma-separated IPs (X-Forwarded-For)
				if ( strpos( $ip, ',' ) !== false ) {
					$ip = trim( explode( ',', $ip )[0] );
				}
				return $ip;
			}
		}
		
		return '0.0.0.0';
	}
	
	/**
	 * Check if device can participate in PoD
	 * 
	 * @param int $device_id Device ID
	 * @return bool|WP_Error True if can participate, error otherwise
	 */
	public static function can_participate_in_pod( $device_id ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_devices';
		
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT status, vcard_status FROM {$table_name} WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		if ( ! $device ) {
			return new WP_Error( 'device_not_found', 'Device not found' );
		}
		
		if ( $device['status'] !== 'validated' ) {
			return new WP_Error( 'device_not_validated', 'Device is not validated' );
		}
		
		if ( $device['vcard_status'] !== 'validated' ) {
			return new WP_Error( 'vcard_not_validated', 'QRtiger v-card is not validated' );
		}
		
		return true;
	}
	
	/**
	 * Check if device is active (hybrid method)
	 * Checks by device_id (UUIDv4) or device_hash
	 * 
	 * @param string $device_id Device ID (UUIDv4)
	 * @param string $device_hash Device hash (fingerprint)
	 * @param int|null $wp_user_id WordPress user ID (optional)
	 * @return array|false Device data if active, false if not found
	 */
	public static function check_device_active( $device_id, $device_hash = null, $wp_user_id = null ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_devices';
		
		// First, check if table has device_id column (UUIDv4)
		// If not, we'll need to add it via migration
		$columns = $wpdb->get_col( "DESCRIBE {$table_name}" );
		$has_device_id_col = in_array( 'device_id', $columns );
		$has_device_hash_col = in_array( 'device_hash', $columns );
		$has_wp_user_id_col = in_array( 'wp_user_id', $columns );
		
		// Build query based on available columns
		$where = array();
		$where_values = array();
		
		if ( $has_device_id_col && $device_id ) {
			$where[] = "device_id = %s";
			$where_values[] = $device_id;
		}
		
		if ( $has_device_hash_col && $device_hash ) {
			$where[] = "device_hash = %s";
			$where_values[] = $device_hash;
		}
		
		if ( $has_wp_user_id_col && $wp_user_id ) {
			$where[] = "wp_user_id = %d";
			$where_values[] = $wp_user_id;
		}
		
		// If no columns match, fall back to device_fingerprint
		if ( empty( $where ) && $device_hash ) {
			$where[] = "device_fingerprint = %s";
			$where_values[] = $device_hash;
		}
		
		if ( empty( $where ) ) {
			return false;
		}
		
		$sql = "SELECT * FROM {$table_name} WHERE " . implode( ' OR ', $where );
		$device = $wpdb->get_row(
			$wpdb->prepare( $sql, $where_values ),
			ARRAY_A
		);
		
		if ( ! $device ) {
			return false;
		}
		
		// Check if device is active (activating or validated)
		$active_statuses = array( 'activating', 'validated' );
		if ( in_array( $device['status'], $active_statuses ) ) {
			return $device;
		}
		
		return false;
	}
	
	/**
	 * Register device with hybrid method (UUIDv4 + device_hash + wp_user_id)
	 * 
	 * @param array $device_data Device registration data
	 * @return array|WP_Error Device data or error
	 */
	public static function register_device_hybrid( $device_data ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_devices';
		
		// Check if device already exists
		$existing = self::check_device_active(
			$device_data['device_id'] ?? null,
			$device_data['device_hash'] ?? null,
			$device_data['wp_user_id'] ?? null
		);
		
		if ( $existing ) {
			// Update last_seen_at if column exists
			$columns = $wpdb->get_col( "DESCRIBE {$table_name}" );
			if ( in_array( 'last_seen_at', $columns ) ) {
				$wpdb->update(
					$table_name,
					array( 'last_seen_at' => current_time( 'mysql' ) ),
					array( 'id' => $existing['id'] ),
					array( '%s' ),
					array( '%d' )
				);
			}
			
			return array(
				'device_id' => $device_data['device_id'] ?? $existing['device_id'] ?? null,
				'device_hash' => $device_data['device_hash'] ?? $existing['device_hash'] ?? null,
				'status' => $existing['status'],
				'existing' => true,
				'db_id' => $existing['id']
			);
		}
		
		// Prepare insert data
		$insert_data = array(
			'status' => 'activating', // Set to activating when device is registered
			'created_at' => current_time( 'mysql' ),
			'activated_at' => current_time( 'mysql' ),
		);
		
		// Add device_id (UUIDv4) if column exists
		$columns = $wpdb->get_col( "DESCRIBE {$table_name}" );
		if ( in_array( 'device_id', $columns ) && isset( $device_data['device_id'] ) ) {
			$insert_data['device_id'] = sanitize_text_field( $device_data['device_id'] );
		}
		
		// Add device_hash if column exists
		if ( in_array( 'device_hash', $columns ) && isset( $device_data['device_hash'] ) ) {
			$insert_data['device_hash'] = sanitize_text_field( $device_data['device_hash'] );
		} elseif ( isset( $device_data['device_hash'] ) ) {
			// Fall back to device_fingerprint if device_hash column doesn't exist
			$insert_data['device_fingerprint'] = sanitize_text_field( $device_data['device_hash'] );
		}
		
		// Add wp_user_id if column exists
		if ( in_array( 'wp_user_id', $columns ) && isset( $device_data['wp_user_id'] ) ) {
			$insert_data['wp_user_id'] = intval( $device_data['wp_user_id'] );
		}
		
		// Add device_name if column exists
		if ( in_array( 'device_name', $columns ) && isset( $device_data['device_name'] ) ) {
			$insert_data['device_name'] = sanitize_text_field( $device_data['device_name'] );
		}
		
		// Add fingerprint data
		if ( isset( $device_data['fingerprint'] ) ) {
			$fp = $device_data['fingerprint'];
			
			if ( isset( $fp['navigator']['userAgent'] ) ) {
				$insert_data['user_agent'] = sanitize_text_field( $fp['navigator']['userAgent'] );
			}
			
			if ( isset( $fp['screen']['width'] ) && isset( $fp['screen']['height'] ) ) {
				$insert_data['screen_resolution'] = $fp['screen']['width'] . 'x' . $fp['screen']['height'];
			}
			
			if ( isset( $fp['timezone']['timezone'] ) ) {
				$insert_data['timezone'] = sanitize_text_field( $fp['timezone']['timezone'] );
			}
			
			if ( isset( $fp['navigator']['language'] ) ) {
				$insert_data['language'] = sanitize_text_field( $fp['navigator']['language'] );
			}
		}
		
		// Add geolocation if available
		if ( isset( $device_data['geolocation'] ) && $device_data['geolocation']['available'] ) {
			$geo = $device_data['geolocation'];
			$insert_data['location_lat'] = floatval( $geo['latitude'] );
			$insert_data['location_lng'] = floatval( $geo['longitude'] );
		}
		
		// Add IP address
		$insert_data['activation_ip'] = self::get_client_ip();
		
		// Insert device
		$result = $wpdb->insert( $table_name, $insert_data );
		
		if ( $result === false ) {
			return new WP_Error(
				'db_error',
				'Failed to register device',
				array( 'error' => $wpdb->last_error )
			);
		}
		
		$db_id = $wpdb->insert_id;
		
		return array(
			'device_id' => $device_data['device_id'] ?? null,
			'device_hash' => $device_data['device_hash'] ?? null,
			'status' => 'activating',
			'existing' => false,
			'db_id' => $db_id
		);
	}
}

