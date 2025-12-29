<?php
/**
 * Serendipity POC Assignment Service
 * 
 * Handles automatic POC assignment based on geo-location and timestamp
 * 
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Serendipity_Service {
	
	/**
	 * Assign Buyer POC (local, geo-based)
	 * 
	 * @param int   $device_id Device ID
	 * @param array $location Location data
	 * @return array|WP_Error POC assignment data
	 */
	public static function assign_buyer_poc( $device_id, $location ) {
		global $wpdb;
		
		$poc_table = $wpdb->prefix . 'hb_buyer_pocs';
		$membership_table = $wpdb->prefix . 'hb_poc_memberships';
		
		// Determine region from location
		$region = self::get_region_from_location( $location );
		
		// Find or create Buyer POC with available space (max 30 members)
		$poc = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT p.*, COUNT(m.id) as member_count 
				FROM {$poc_table} p
				LEFT JOIN {$membership_table} m ON m.poc_id = p.id AND m.poc_type = 'buyer'
				WHERE p.region = %s
				GROUP BY p.id
				HAVING member_count < 30
				ORDER BY p.created_at DESC
				LIMIT 1",
				$region
			),
			ARRAY_A
		);
		
		if ( ! $poc ) {
			// Create new Buyer POC
			$result = $wpdb->insert(
				$poc_table,
				array(
					'region' => $region,
					'created_at' => current_time( 'mysql' ),
				),
				array( '%s', '%s' )
			);
			
			if ( $result === false ) {
				return new WP_Error( 'db_error', 'Failed to create Buyer POC', array( 'error' => $wpdb->last_error ) );
			}
			
			$poc_id = $wpdb->insert_id;
		} else {
			$poc_id = $poc['id'];
		}
		
		// Assign device to Buyer POC
		$result = $wpdb->insert(
			$membership_table,
			array(
				'device_id' => $device_id,
				'poc_id' => $poc_id,
				'poc_type' => 'buyer',
				'assigned_at' => current_time( 'mysql' ),
			),
			array( '%d', '%d', '%s', '%s' )
		);
		
		if ( $result === false ) {
			return new WP_Error( 'db_error', 'Failed to assign Buyer POC', array( 'error' => $wpdb->last_error ) );
		}
		
		return array(
			'poc_id' => $poc_id,
			'poc_type' => 'buyer',
			'region' => $region,
		);
	}
	
	/**
	 * Assign Seller POC (out-of-state/global)
	 * 
	 * @param int   $device_id Device ID
	 * @param array $location Location data
	 * @param string $branch Peace Pentagon branch
	 * @return array|WP_Error POC assignment data
	 */
	public static function assign_seller_poc( $device_id, $location, $branch ) {
		global $wpdb;
		
		$poc_table = $wpdb->prefix . 'hb_seller_pocs';
		$membership_table = $wpdb->prefix . 'hb_poc_memberships';
		
		$region = self::get_region_from_location( $location );
		
		// Find Seller POC that is NOT in the same region (out-of-state/global)
		// Max 5 sellers per Seller POC
		$poc = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT p.*, COUNT(m.id) as member_count 
				FROM {$poc_table} p
				LEFT JOIN {$membership_table} m ON m.poc_id = p.id AND m.poc_type = 'seller'
				WHERE p.region != %s AND p.branch = %s
				GROUP BY p.id
				HAVING member_count < 5
				ORDER BY p.created_at DESC
				LIMIT 1",
				$region,
				$branch
			),
			ARRAY_A
		);
		
		if ( ! $poc ) {
			// Create new Seller POC
			$result = $wpdb->insert(
				$poc_table,
				array(
					'region' => 'global',
					'branch' => $branch,
					'created_at' => current_time( 'mysql' ),
				),
				array( '%s', '%s', '%s' )
			);
			
			if ( $result === false ) {
				return new WP_Error( 'db_error', 'Failed to create Seller POC', array( 'error' => $wpdb->last_error ) );
			}
			
			$poc_id = $wpdb->insert_id;
			$slot_index = 0;
		} else {
			$poc_id = $poc['id'];
			// Get next available slot index (0-4)
			$slot_index = intval( $poc['member_count'] );
		}
		
		// Assign device to Seller POC
		$result = $wpdb->insert(
			$membership_table,
			array(
				'device_id' => $device_id,
				'poc_id' => $poc_id,
				'poc_type' => 'seller',
				'slot_index' => $slot_index,
				'assigned_at' => current_time( 'mysql' ),
			),
			array( '%d', '%d', '%s', '%d', '%s' )
		);
		
		if ( $result === false ) {
			return new WP_Error( 'db_error', 'Failed to assign Seller POC', array( 'error' => $wpdb->last_error ) );
		}
		
		return array(
			'poc_id' => $poc_id,
			'poc_type' => 'seller',
			'slot_index' => $slot_index,
			'branch' => $branch,
		);
	}
	
	/**
	 * Assign Peace Pentagon branch (time-based serendipity)
	 * 
	 * @param int $device_id Device ID
	 * @return string Branch name
	 */
	public static function assign_peace_pentagon_branch( $device_id ) {
		global $wpdb;
		
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT id, created_at FROM {$wpdb->prefix}hb_devices WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		if ( ! $device ) {
			return 'planning'; // Default
		}
		
		// Use CRC32 hash of device_id + timestamp for deterministic assignment
		$hash_input = $device['id'] . $device['created_at'];
		$hash = crc32( $hash_input );
		
		// Map hash to one of 5 branches
		$branches = array( 'planning', 'budget', 'media', 'distribution', 'membership' );
		$branch_index = abs( $hash ) % 5;
		$branch = $branches[ $branch_index ];
		
		// Update device
		$wpdb->update(
			$wpdb->prefix . 'hb_devices',
			array( 'peace_pentagon_branch' => $branch ),
			array( 'id' => $device_id ),
			array( '%s' ),
			array( '%d' )
		);
		
		return $branch;
	}
	
	/**
	 * Get region from location data
	 * 
	 * @param array $location Location data
	 * @return string Region identifier
	 */
	private static function get_region_from_location( $location ) {
		// Use country + state as region identifier
		$country = isset( $location['country'] ) ? $location['country'] : 'unknown';
		$state = isset( $location['state'] ) ? $location['state'] : 'unknown';
		
		return strtolower( $country . '_' . $state );
	}
	
	/**
	 * Complete POC assignment for device
	 * 
	 * @param int   $device_id Device ID
	 * @param array $location Location data
	 * @return array|WP_Error Assignment results
	 */
	public static function assign_all_pocs( $device_id, $location ) {
		// Assign Peace Pentagon branch first
		$branch = self::assign_peace_pentagon_branch( $device_id );
		
		// Assign Buyer POC (local)
		$buyer_poc = self::assign_buyer_poc( $device_id, $location );
		if ( is_wp_error( $buyer_poc ) ) {
			return $buyer_poc;
		}
		
		// Assign Seller POC (out-of-state/global) - only for MEGAvoter and Patron
		global $wpdb;
		$device = $wpdb->get_row(
			$wpdb->prepare( "SELECT membership_tier FROM {$wpdb->prefix}hb_devices WHERE id = %d", $device_id ),
			ARRAY_A
		);
		
		$seller_poc = null;
		if ( $device && in_array( $device['membership_tier'], array( 'megavoter', 'patron' ) ) ) {
			$seller_poc = self::assign_seller_poc( $device_id, $location, $branch );
			if ( is_wp_error( $seller_poc ) ) {
				// Log but don't fail
				error_log( 'Seller POC assignment failed: ' . $seller_poc->get_error_message() );
			}
		}
		
		return array(
			'branch' => $branch,
			'buyer_poc' => $buyer_poc,
			'seller_poc' => $seller_poc,
		);
	}
}

