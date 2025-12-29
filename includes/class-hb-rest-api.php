<?php
/**
 * HumanBlockchain REST API
 * 
 * Registers all REST API endpoints for device registration and PoD
 * 
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class HB_REST_API {
	
	/**
	 * Register REST API routes
	 */
	public static function register_routes() {
		$namespace = 'hb/v1';
		
		// Device Registration Endpoints
		register_rest_route( $namespace, '/device/register', array(
			'methods'             => 'POST',
			'callback'            => array( __CLASS__, 'register_device' ),
			'permission_callback' => '__return_true', // Public endpoint
			'args'                => array(
				'user_agent'        => array( 'required' => false, 'type' => 'string' ),
				'screen_resolution'  => array( 'required' => false, 'type' => 'string' ),
				'timezone'           => array( 'required' => false, 'type' => 'string' ),
				'language'           => array( 'required' => false, 'type' => 'string' ),
				'platform'           => array( 'required' => false, 'type' => 'string' ),
			),
		) );
		
		register_rest_route( $namespace, '/device/activate', array(
			'methods'             => 'POST',
			'callback'            => array( __CLASS__, 'activate_device' ),
			'permission_callback' => '__return_true',
			'args'                => array(
				'device_id'  => array( 'required' => true, 'type' => 'integer' ),
				'latitude'   => array( 'required' => false, 'type' => 'number', 'validate_callback' => function( $param ) {
					return $param === null || is_numeric( $param );
				} ),
				'longitude'  => array( 'required' => false, 'type' => 'number', 'validate_callback' => function( $param ) {
					return $param === null || is_numeric( $param );
				} ),
				'city'       => array( 'required' => false, 'type' => 'string' ),
				'state'      => array( 'required' => false, 'type' => 'string' ),
				'country'    => array( 'required' => false, 'type' => 'string' ),
			),
		) );
		
		register_rest_route( $namespace, '/device/(?P<id>\d+)', array(
			'methods'             => 'GET',
			'callback'            => array( __CLASS__, 'get_device' ),
			'permission_callback' => '__return_true',
		) );
		
		register_rest_route( $namespace, '/device/check', array(
			'methods'             => 'POST',
			'callback'            => array( __CLASS__, 'check_device' ),
			'permission_callback' => '__return_true',
			'args'                => array(
				'device_fingerprint' => array( 'required' => true, 'type' => 'string' ),
			),
		) );
		
		// QRtiger v-Card Validation Endpoints
		register_rest_route( $namespace, '/vcard/validate', array(
			'methods'             => 'POST',
			'callback'            => array( __CLASS__, 'validate_vcard' ),
			'permission_callback' => '__return_true',
			'args'                => array(
				'device_id'  => array( 'required' => true, 'type' => 'integer' ),
				'vcard_hash' => array( 'required' => true, 'type' => 'string' ),
				'vcard_data' => array( 'required' => false, 'type' => 'string' ),
			),
		) );
		
		// Discord endpoints
		register_rest_route( $namespace, '/discord/auth-url', array(
			'methods'             => 'GET',
			'callback'            => array( __CLASS__, 'get_discord_auth_url' ),
			'permission_callback' => '__return_true',
			'args'                => array(
				'device_id' => array( 'required' => true, 'type' => 'integer' ),
			),
		) );
		
		register_rest_route( $namespace, '/discord/callback', array(
			'methods'             => 'GET',
			'callback'            => array( __CLASS__, 'discord_callback' ),
			'permission_callback' => '__return_true',
		) );
		
		// Membership selection
		register_rest_route( $namespace, '/device/(?P<id>\d+)/membership', array(
			'methods'             => 'POST',
			'callback'            => array( __CLASS__, 'set_membership' ),
			'permission_callback' => '__return_true',
			'args'                => array(
				'tier' => array( 'required' => true, 'type' => 'string', 'enum' => array( 'yamer', 'megavoter', 'patron' ) ),
			),
		) );
		
		// Complete registration
		register_rest_route( $namespace, '/device/(?P<id>\d+)/complete', array(
			'methods'             => 'POST',
			'callback'            => array( __CLASS__, 'complete_registration' ),
			'permission_callback' => '__return_true',
		) );
	}
	
	/**
	 * Register device endpoint
	 */
	public static function register_device( WP_REST_Request $request ) {
		$device_data = array(
			'user_agent'       => $request->get_param( 'user_agent' ) ?: ( isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '' ),
			'screen_resolution' => $request->get_param( 'screen_resolution' ) ?: '',
			'timezone'         => $request->get_param( 'timezone' ) ?: '',
			'language'         => $request->get_param( 'language' ) ?: '',
			'platform'         => $request->get_param( 'platform' ) ?: '',
		);
		
		$result = Device_Registration_Service::register_device( $device_data );
		
		if ( is_wp_error( $result ) ) {
			// If device already exists, return existing device info instead of error
			if ( $result->get_error_code() === 'device_exists' ) {
				$existing_data = $result->get_error_data();
				$device_id = isset( $existing_data['device_id'] ) ? $existing_data['device_id'] : null;
				$status = isset( $existing_data['status'] ) ? $existing_data['status'] : 'unknown';
				
				// Get full device info
				global $wpdb;
				$device = $wpdb->get_row(
					$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}hb_devices WHERE id = %d", $device_id ),
					ARRAY_A
				);
				
				if ( $device ) {
					return new WP_REST_Response( array(
						'device_id' => $device['id'],
						'device_fingerprint' => $device['device_fingerprint'],
						'status' => $device['status'],
						'existing' => true, // Flag to indicate existing device
					), 200 );
				}
			}
			
			return new WP_Error(
				$result->get_error_code(),
				$result->get_error_message(),
				array( 'status' => 400 )
			);
		}
		
		return new WP_REST_Response( $result, 200 );
	}
	
	/**
	 * Activate device endpoint
	 */
	public static function activate_device( WP_REST_Request $request ) {
		$device_id = intval( $request->get_param( 'device_id' ) );
		
		// Get parameters, allowing null values for optional fields
		$latitude = $request->get_param( 'latitude' );
		$longitude = $request->get_param( 'longitude' );
		
		$activation_data = array(
			'latitude'  => ( $latitude !== null && $latitude !== '' ) ? floatval( $latitude ) : null,
			'longitude' => ( $longitude !== null && $longitude !== '' ) ? floatval( $longitude ) : null,
			'city'      => $request->get_param( 'city' ) ?: '',
			'state'     => $request->get_param( 'state' ) ?: '',
			'country'   => $request->get_param( 'country' ) ?: '',
		);
		
		$result = Device_Registration_Service::activate_device( $device_id, $activation_data );
		
		if ( is_wp_error( $result ) ) {
			return new WP_Error(
				$result->get_error_code(),
				$result->get_error_message(),
				array( 'status' => 400 )
			);
		}
		
		return new WP_REST_Response( $result, 200 );
	}
	
	/**
	 * Get device endpoint
	 */
	public static function get_device( WP_REST_Request $request ) {
		$device_id = intval( $request->get_param( 'id' ) );
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'hb_devices';
		
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM {$table_name} WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		if ( ! $device ) {
			return new WP_Error( 'device_not_found', 'Device not found', array( 'status' => 404 ) );
		}
		
		// Remove sensitive data
		unset( $device['activation_ip'] );
		
		return new WP_REST_Response( $device, 200 );
	}
	
	/**
	 * Check device endpoint
	 */
	public static function check_device( WP_REST_Request $request ) {
		$device_fingerprint = sanitize_text_field( $request->get_param( 'device_fingerprint' ) );
		
		$device = Device_Registration_Service::get_device_by_fingerprint( $device_fingerprint );
		
		if ( ! $device ) {
			return new WP_REST_Response( array( 'exists' => false ), 200 );
		}
		
		// Remove sensitive data
		unset( $device['activation_ip'] );
		
		return new WP_REST_Response( array(
			'exists' => true,
			'device' => $device,
		), 200 );
	}
	
	/**
	 * Validate v-card endpoint
	 */
	public static function validate_vcard( WP_REST_Request $request ) {
		$device_id = intval( $request->get_param( 'device_id' ) );
		$vcard_hash = sanitize_text_field( $request->get_param( 'vcard_hash' ) );
		$vcard_data = $request->get_param( 'vcard_data' );
		
		// Validate via QRtiger API
		$validation_result = QRtiger_Service::validate_vcard( $vcard_hash, $vcard_data );
		
		if ( is_wp_error( $validation_result ) ) {
			return new WP_Error(
				$validation_result->get_error_code(),
				$validation_result->get_error_message(),
				array( 'status' => 400 )
			);
		}
		
		// Store v-card
		$stored = QRtiger_Service::store_vcard( $device_id, $validation_result );
		
		if ( is_wp_error( $stored ) ) {
			return new WP_Error(
				$stored->get_error_code(),
				$stored->get_error_message(),
				array( 'status' => 500 )
			);
		}
		
		return new WP_REST_Response( $stored, 200 );
	}
	
	/**
	 * Get Discord authorization URL
	 */
	public static function get_discord_auth_url( WP_REST_Request $request ) {
		$device_id = intval( $request->get_param( 'device_id' ) );
		
		$url = Discord_Service::get_authorization_url( $device_id );
		
		if ( is_wp_error( $url ) ) {
			return new WP_Error(
				$url->get_error_code(),
				$url->get_error_message(),
				array( 'status' => 400 )
			);
		}
		
		return new WP_REST_Response( array( 'auth_url' => $url ), 200 );
	}
	
	/**
	 * Discord OAuth callback
	 */
	public static function discord_callback( WP_REST_Request $request ) {
		$code = $request->get_param( 'code' );
		$state = $request->get_param( 'state' );
		
		// Extract device_id from state if needed, or get from request
		$device_id = intval( $request->get_param( 'device_id' ) );
		
		// If device_id not in request, try to extract from state
		if ( ! $device_id && $state ) {
			// State format: nonce_device_id (from get_authorization_url)
			// We'll need to store device_id in state differently
			// For now, require device_id in request
		}
		
		if ( empty( $code ) || empty( $state ) ) {
			return new WP_Error( 'missing_params', 'Missing required parameters', array( 'status' => 400 ) );
		}
		
		// Find device_id from state (we stored it in transient)
		// Try to find device_id by checking all recent state transients
		// For now, require device_id in URL
		if ( ! $device_id ) {
			return new WP_Error( 'missing_device_id', 'Device ID required', array( 'status' => 400 ) );
		}
		
		// Verify state
		$stored_state = get_transient( 'discord_oauth_state_' . $device_id );
		if ( $stored_state !== $state ) {
			return new WP_Error( 'invalid_state', 'Invalid state parameter', array( 'status' => 400 ) );
		}
		
		// Exchange code for token
		$token_data = Discord_Service::exchange_code_for_token( $code, $state );
		
		if ( is_wp_error( $token_data ) ) {
			return new WP_Error(
				$token_data->get_error_code(),
				$token_data->get_error_message(),
				array( 'status' => 400 )
			);
		}
		
		// Get user info
		$user_info = Discord_Service::get_user_info( $token_data['access_token'] );
		
		if ( is_wp_error( $user_info ) ) {
			return new WP_Error(
				$user_info->get_error_code(),
				$user_info->get_error_message(),
				array( 'status' => 400 )
			);
		}
		
		// Store connection
		$connection = Discord_Service::store_connection( $device_id, $user_info, $token_data['access_token'] );
		
		if ( is_wp_error( $connection ) ) {
			return new WP_Error(
				$connection->get_error_code(),
				$connection->get_error_message(),
				array( 'status' => 500 )
			);
		}
		
		// Delete state transient
		delete_transient( 'discord_oauth_state_' . $device_id );
		
		return new WP_REST_Response( $connection, 200 );
	}
	
	/**
	 * Set membership tier
	 */
	public static function set_membership( WP_REST_Request $request ) {
		$device_id = intval( $request->get_param( 'id' ) );
		$tier = sanitize_text_field( $request->get_param( 'tier' ) );
		
		if ( ! in_array( $tier, array( 'yamer', 'megavoter', 'patron' ) ) ) {
			return new WP_Error( 'invalid_tier', 'Invalid membership tier', array( 'status' => 400 ) );
		}
		
		global $wpdb;
		$result = $wpdb->update(
			$wpdb->prefix . 'hb_devices',
			array( 'membership_tier' => $tier ),
			array( 'id' => $device_id ),
			array( '%s' ),
			array( '%d' )
		);
		
		if ( $result === false ) {
			return new WP_Error( 'db_error', 'Failed to update membership', array( 'status' => 500 ) );
		}
		
		// Trigger POC assignment if location is available
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT location_country, location_state FROM {$wpdb->prefix}hb_devices WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		if ( $device && $device['location_country'] ) {
			$location = array(
				'country' => $device['location_country'],
				'state' => $device['location_state'],
			);
			
			Serendipity_Service::assign_all_pocs( $device_id, $location );
		}
		
		return new WP_REST_Response( array( 'success' => true, 'tier' => $tier ), 200 );
	}
	
	/**
	 * Complete registration
	 */
	public static function complete_registration( WP_REST_Request $request ) {
		$device_id = intval( $request->get_param( 'id' ) );
		
		// Validate device has all required data
		global $wpdb;
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}hb_devices WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		if ( ! $device ) {
			return new WP_Error( 'device_not_found', 'Device not found', array( 'status' => 404 ) );
		}
		
		// Check if v-card is validated
		if ( $device['vcard_status'] !== 'validated' ) {
			return new WP_Error( 'vcard_not_validated', 'QRtiger v-card must be validated first', array( 'status' => 400 ) );
		}
		
		// Check if Discord is connected
		$discord = Discord_Service::get_connection_by_device( $device_id );
		if ( ! $discord ) {
			return new WP_Error( 'discord_not_connected', 'Discord must be connected first', array( 'status' => 400 ) );
		}
		
		// Check if membership is selected
		if ( empty( $device['membership_tier'] ) ) {
			return new WP_Error( 'membership_not_selected', 'Membership tier must be selected first', array( 'status' => 400 ) );
		}
		
		// Finalize device validation
		$result = Device_Registration_Service::validate_device( $device_id );
		
		if ( is_wp_error( $result ) ) {
			return new WP_Error(
				$result->get_error_code(),
				$result->get_error_message(),
				array( 'status' => 500 )
			);
		}
		
		// Assign POCs if not already assigned
		if ( $device['location_country'] ) {
			$location = array(
				'country' => $device['location_country'],
				'state' => $device['location_state'],
			);
			Serendipity_Service::assign_all_pocs( $device_id, $location );
		}
		
		return new WP_REST_Response( array(
			'success' => true,
			'device_id' => $device_id,
			'status' => 'validated',
		), 200 );
	}
}

