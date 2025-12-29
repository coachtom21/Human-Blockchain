<?php
/**
 * Discord Integration Service
 * 
 * Handles Discord OAuth and role assignment
 * 
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Discord_Service {
	
	/**
	 * Discord OAuth endpoints
	 */
	private static $oauth_authorize = 'https://discord.com/api/oauth2/authorize';
	private static $oauth_token = 'https://discord.com/api/oauth2/token';
	private static $api_base = 'https://discord.com/api/v10';
	
	/**
	 * Get Discord OAuth credentials
	 */
	private static function get_credentials() {
		return array(
			'client_id' => get_option( 'hb_discord_client_id', '' ),
			'client_secret' => get_option( 'hb_discord_client_secret', '' ),
			'redirect_uri' => get_option( 'hb_discord_redirect_uri', home_url( '/discord-callback' ) ),
			'guild_id' => get_option( 'hb_discord_guild_id', '' ),
		);
	}
	
	/**
	 * Get Discord OAuth authorization URL
	 * 
	 * @param int $device_id Device ID
	 * @return string|WP_Error Authorization URL or error
	 */
	public static function get_authorization_url( $device_id ) {
		$credentials = self::get_credentials();
		
		if ( empty( $credentials['client_id'] ) ) {
			return new WP_Error( 'no_client_id', 'Discord client ID not configured' );
		}
		
		$state = wp_create_nonce( 'discord_oauth_' . $device_id );
		set_transient( 'discord_oauth_state_' . $device_id, $state, 600 ); // 10 minutes
		
		// Store device_id in state for callback
		$state_with_device = $state . '_' . $device_id;
		
		$params = array(
			'client_id' => $credentials['client_id'],
			'redirect_uri' => $credentials['redirect_uri'] . '?device_id=' . $device_id,
			'response_type' => 'code',
			'scope' => 'identify guilds.join',
			'state' => $state_with_device,
		);
		
		return self::$oauth_authorize . '?' . http_build_query( $params );
	}
	
	/**
	 * Exchange authorization code for access token
	 * 
	 * @param string $code Authorization code
	 * @param string $state State parameter
	 * @return array|WP_Error Token data
	 */
	public static function exchange_code_for_token( $code, $state ) {
		$credentials = self::get_credentials();
		
		$response = wp_remote_post( self::$oauth_token, array(
			'headers' => array(
				'Content-Type' => 'application/x-www-form-urlencoded',
			),
			'body' => array(
				'client_id' => $credentials['client_id'],
				'client_secret' => $credentials['client_secret'],
				'grant_type' => 'authorization_code',
				'code' => $code,
				'redirect_uri' => $credentials['redirect_uri'],
			),
			'timeout' => 30,
		) );
		
		if ( is_wp_error( $response ) ) {
			return $response;
		}
		
		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );
		
		if ( ! $data || isset( $data['error'] ) ) {
			return new WP_Error( 'token_error', $data['error_description'] ?? 'Failed to get token' );
		}
		
		return $data;
	}
	
	/**
	 * Get Discord user info
	 * 
	 * @param string $access_token Access token
	 * @return array|WP_Error User data
	 */
	public static function get_user_info( $access_token ) {
		$response = wp_remote_get( self::$api_base . '/users/@me', array(
			'headers' => array(
				'Authorization' => 'Bearer ' . $access_token,
			),
			'timeout' => 30,
		) );
		
		if ( is_wp_error( $response ) ) {
			return $response;
		}
		
		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );
		
		if ( ! $data || isset( $data['error'] ) ) {
			return new WP_Error( 'user_error', 'Failed to get user info' );
		}
		
		return $data;
	}
	
	/**
	 * Store Discord connection
	 * 
	 * @param int   $device_id Device ID
	 * @param array $user_info Discord user info
	 * @param string $access_token Access token (will be hashed)
	 * @return array|WP_Error Stored connection data
	 */
	public static function store_connection( $device_id, $user_info, $access_token ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_discord_mappings';
		
		// Hash access token (don't store plain)
		$token_hash = hash( 'sha256', $access_token );
		
		// Check if connection already exists
		$existing = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$table_name} WHERE device_id = %d OR discord_user_id = %s",
				$device_id,
				$user_info['id']
			),
			ARRAY_A
		);
		
		if ( $existing ) {
			// Update existing
			$wpdb->update(
				$table_name,
				array(
					'device_id' => $device_id,
					'discord_username' => $user_info['username'] ?? '',
					'access_token_hash' => $token_hash,
					'connected_at' => current_time( 'mysql' ),
				),
				array( 'id' => $existing['id'] ),
				array( '%d', '%s', '%s', '%s' ),
				array( '%d' )
			);
			
			return array(
				'connection_id' => $existing['id'],
				'discord_user_id' => $user_info['id'],
			);
		}
		
		// Insert new connection
		$result = $wpdb->insert(
			$table_name,
			array(
				'device_id' => $device_id,
				'discord_user_id' => $user_info['id'],
				'discord_username' => $user_info['username'] ?? '',
				'access_token_hash' => $token_hash,
				'connected_at' => current_time( 'mysql' ),
			),
			array( '%d', '%s', '%s', '%s', '%s' )
		);
		
		if ( $result === false ) {
			return new WP_Error( 'db_error', 'Failed to store Discord connection', array( 'error' => $wpdb->last_error ) );
		}
		
		$connection_id = $wpdb->insert_id;
		
		// Assign Discord role based on device status
		self::assign_discord_role( $device_id, $user_info['id'] );
		
		return array(
			'connection_id' => $connection_id,
			'discord_user_id' => $user_info['id'],
		);
	}
	
	/**
	 * Assign Discord role to user
	 * 
	 * @param int    $device_id Device ID
	 * @param string $discord_user_id Discord user ID
	 * @return bool|WP_Error Success or error
	 */
	public static function assign_discord_role( $device_id, $discord_user_id ) {
		$credentials = self::get_credentials();
		
		if ( empty( $credentials['guild_id'] ) || empty( $credentials['client_id'] ) ) {
			// Log but don't fail
			error_log( 'Discord role assignment skipped: credentials not configured' );
			return true;
		}
		
		// Get device info to determine role
		global $wpdb;
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT status, membership_tier, vcard_status FROM {$wpdb->prefix}hb_devices WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		if ( ! $device ) {
			return new WP_Error( 'device_not_found', 'Device not found' );
		}
		
		// Determine role name based on device status and tier
		$role_name = 'YAM\'er'; // Default
		
		if ( $device['membership_tier'] === 'megavoter' ) {
			$role_name = 'MEGAvoter';
		} elseif ( $device['membership_tier'] === 'patron' ) {
			$role_name = 'Patron';
		}
		
		// TODO: Implement actual Discord API call to assign role
		// This requires bot token and guild member add endpoint
		// For now, just log the role assignment
		
		error_log( sprintf(
			'Discord role assignment: User %s should get role %s (Device ID: %d)',
			$discord_user_id,
			$role_name,
			$device_id
		) );
		
		// Store role in database
		$wpdb->update(
			$wpdb->prefix . 'hb_discord_mappings',
			array( 'role' => $role_name ),
			array( 'discord_user_id' => $discord_user_id ),
			array( '%s' ),
			array( '%s' )
		);
		
		return true;
	}
	
	/**
	 * Get Discord connection by device ID
	 * 
	 * @param int $device_id Device ID
	 * @return array|false Connection data or false
	 */
	public static function get_connection_by_device( $device_id ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_discord_mappings';
		
		$connection = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM {$table_name} WHERE device_id = %d", $device_id ),
			ARRAY_A
		);
		
		return $connection ? $connection : false;
	}
}

