<?php
/**
 * QRtiger v-Card Validation Service
 * 
 * Handles QRtiger v-card validation and storage
 * 
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class QRtiger_Service {
	
	/**
	 * QRtiger API endpoint (placeholder - update with actual API)
	 */
	private static $api_endpoint = 'https://api.qrtiger.com/v1/validate'; // Placeholder
	
	/**
	 * API key (store in wp_options)
	 */
	private static function get_api_key() {
		return get_option( 'hb_qrtiger_api_key', '' );
	}
	
	/**
	 * Validate v-card via QRtiger API
	 * 
	 * @param string $vcard_hash v-card hash
	 * @param string $vcard_data Optional v-card data
	 * @return array|WP_Error Validation result
	 */
	public static function validate_vcard( $vcard_hash, $vcard_data = '' ) {
		$api_key = self::get_api_key();
		
		if ( empty( $api_key ) ) {
			// For now, accept any hash (placeholder until API key is configured)
			return array(
				'valid' => true,
				'vcard_hash' => $vcard_hash,
				'reference' => 'placeholder_' . time(),
				'metadata' => array(
					'validated_at' => current_time( 'mysql' ),
					'method' => 'placeholder',
				),
			);
		}
		
		// TODO: Implement actual QRtiger API call
		// For now, return placeholder validation
		
		$response = wp_remote_post( self::$api_endpoint, array(
			'headers' => array(
				'Authorization' => 'Bearer ' . $api_key,
				'Content-Type' => 'application/json',
			),
			'body' => json_encode( array(
				'vcard_hash' => $vcard_hash,
				'vcard_data' => $vcard_data,
			) ),
			'timeout' => 30,
		) );
		
		if ( is_wp_error( $response ) ) {
			return $response;
		}
		
		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );
		
		if ( ! $data || ! isset( $data['valid'] ) ) {
			return new WP_Error( 'invalid_response', 'Invalid API response' );
		}
		
		return $data;
	}
	
	/**
	 * Store v-card validation
	 * 
	 * @param int   $device_id Device ID
	 * @param array $validation_result Validation result from API
	 * @return array|WP_Error Stored v-card data
	 */
	public static function store_vcard( $device_id, $validation_result ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_qrtiger_vcards';
		
		// Check if v-card already exists
		$existing = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$table_name} WHERE device_id = %d AND vcard_hash = %s",
				$device_id,
				$validation_result['vcard_hash']
			),
			ARRAY_A
		);
		
		if ( $existing ) {
			// Update existing record
			$update_data = array(
				'status' => $validation_result['valid'] ? 'validated' : 'rejected',
				'qrtiger_reference' => isset( $validation_result['reference'] ) ? $validation_result['reference'] : '',
				'metadata' => json_encode( isset( $validation_result['metadata'] ) ? $validation_result['metadata'] : array() ),
				'validated_at' => current_time( 'mysql' ),
			);
			
			$wpdb->update(
				$table_name,
				$update_data,
				array( 'id' => $existing['id'] ),
				array( '%s', '%s', '%s', '%s' ),
				array( '%d' )
			);
			
			// Update device vcard_status
			self::update_device_vcard_status( $device_id, $update_data['status'] );
			
			return array(
				'vcard_id' => $existing['id'],
				'status' => $update_data['status'],
			);
		}
		
		// Insert new v-card
		$insert_data = array(
			'device_id' => $device_id,
			'vcard_hash' => $validation_result['vcard_hash'],
			'status' => $validation_result['valid'] ? 'validated' : 'rejected',
			'qrtiger_reference' => isset( $validation_result['reference'] ) ? $validation_result['reference'] : '',
			'metadata' => json_encode( isset( $validation_result['metadata'] ) ? $validation_result['metadata'] : array() ),
			'created_at' => current_time( 'mysql' ),
			'validated_at' => current_time( 'mysql' ),
		);
		
		$result = $wpdb->insert( $table_name, $insert_data, array( '%d', '%s', '%s', '%s', '%s', '%s', '%s' ) );
		
		if ( $result === false ) {
			return new WP_Error( 'db_error', 'Failed to store v-card', array( 'error' => $wpdb->last_error ) );
		}
		
		$vcard_id = $wpdb->insert_id;
		
		// Update device vcard_status
		self::update_device_vcard_status( $device_id, $insert_data['status'] );
		
		return array(
			'vcard_id' => $vcard_id,
			'status' => $insert_data['status'],
		);
	}
	
	/**
	 * Update device vcard_status
	 * 
	 * @param int    $device_id Device ID
	 * @param string $status Status (validated, rejected, pending)
	 */
	private static function update_device_vcard_status( $device_id, $status ) {
		global $wpdb;
		
		$wpdb->update(
			$wpdb->prefix . 'hb_devices',
			array( 'vcard_status' => $status ),
			array( 'id' => $device_id ),
			array( '%s' ),
			array( '%d' )
		);
	}
	
	/**
	 * Get v-card by device ID
	 * 
	 * @param int $device_id Device ID
	 * @return array|false v-card data or false
	 */
	public static function get_vcard_by_device( $device_id ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'hb_qrtiger_vcards';
		
		$vcard = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM {$table_name} WHERE device_id = %d ORDER BY created_at DESC LIMIT 1", $device_id ),
			ARRAY_A
		);
		
		return $vcard ? $vcard : false;
	}
}

