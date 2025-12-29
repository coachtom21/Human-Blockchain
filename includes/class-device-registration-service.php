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
}

