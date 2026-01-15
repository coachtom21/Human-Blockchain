<?php
/**
 * Database Migration: Verify Indexes and Migrate Existing Data
 * 
 * Verifies indexes exist and migrates existing device_fingerprint to device_hash
 * Also generates UUIDv4 for devices missing device_id
 * 
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generate UUIDv4
 */
function hb_generate_uuidv4() {
	return sprintf(
		'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000, // Version 4
		mt_rand( 0, 0x3fff ) | 0x8000, // Variant bits
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	);
}

/**
 * Verify indexes and migrate existing data
 */
function hb_verify_and_migrate_data() {
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'hb_devices';
	
	// Check if table exists
	$table_exists = $wpdb->get_var( $wpdb->prepare( 
		"SHOW TABLES LIKE %s", 
		$table_name 
	) );
	
	if ( ! $table_exists ) {
		return new WP_Error( 'table_not_found', 'Table ' . $table_name . ' does not exist.' );
	}
	
	$results = array(
		'indexes_added' => 0,
		'devices_updated' => 0,
		'errors' => array()
	);
	
	// Get existing indexes
	$indexes = $wpdb->get_results( "SHOW INDEXES FROM {$table_name}" );
	$index_names = array();
	foreach ( $indexes as $index ) {
		$index_names[] = $index->Key_name;
	}
	
	// Add unique index on device_id if it doesn't exist
	if ( ! in_array( 'device_id', $index_names ) ) {
		$result = $wpdb->query( "ALTER TABLE {$table_name} ADD UNIQUE KEY device_id (device_id)" );
		if ( $result !== false ) {
			$results['indexes_added']++;
		} else {
			$results['errors'][] = 'Failed to add device_id index: ' . $wpdb->last_error;
		}
	}
	
	// Add index on device_hash if it doesn't exist
	if ( ! in_array( 'idx_device_hash', $index_names ) ) {
		$result = $wpdb->query( "ALTER TABLE {$table_name} ADD KEY idx_device_hash (device_hash)" );
		if ( $result !== false ) {
			$results['indexes_added']++;
		} else {
			$results['errors'][] = 'Failed to add device_hash index: ' . $wpdb->last_error;
		}
	}
	
	// Add index on wp_user_id if it doesn't exist
	if ( ! in_array( 'idx_wp_user', $index_names ) ) {
		$result = $wpdb->query( "ALTER TABLE {$table_name} ADD KEY idx_wp_user (wp_user_id)" );
		if ( $result !== false ) {
			$results['indexes_added']++;
		} else {
			$results['errors'][] = 'Failed to add wp_user_id index: ' . $wpdb->last_error;
		}
	}
	
	// Migrate existing data
	// Get devices that need migration
	$devices = $wpdb->get_results( 
		"SELECT id, device_fingerprint, device_id, device_hash, activated_at, last_seen_at 
		 FROM {$table_name} 
		 WHERE device_id IS NULL 
		 OR (device_hash IS NULL AND device_fingerprint IS NOT NULL)
		 OR (last_seen_at IS NULL AND activated_at IS NOT NULL)", 
		ARRAY_A 
	);
	
	foreach ( $devices as $device ) {
		$update_data = array();
		$update_format = array();
		
		// Generate device_id if missing
		if ( empty( $device['device_id'] ) ) {
			$update_data['device_id'] = hb_generate_uuidv4();
			$update_format[] = '%s';
		}
		
		// Migrate device_fingerprint to device_hash if device_hash is empty
		if ( ! empty( $device['device_fingerprint'] ) && empty( $device['device_hash'] ) ) {
			$update_data['device_hash'] = $device['device_fingerprint'];
			$update_format[] = '%s';
		}
		
		// Set last_seen_at to activated_at if available
		if ( empty( $device['last_seen_at'] ) && ! empty( $device['activated_at'] ) ) {
			$update_data['last_seen_at'] = $device['activated_at'];
			$update_format[] = '%s';
		} elseif ( empty( $device['last_seen_at'] ) ) {
			$update_data['last_seen_at'] = current_time( 'mysql' );
			$update_format[] = '%s';
		}
		
		if ( ! empty( $update_data ) ) {
			$result = $wpdb->update(
				$table_name,
				$update_data,
				array( 'id' => $device['id'] ),
				$update_format,
				array( '%d' )
			);
			
			if ( $result !== false ) {
				$results['devices_updated']++;
			} else {
				$results['errors'][] = 'Failed to update device ID ' . $device['id'] . ': ' . $wpdb->last_error;
			}
		}
	}
	
	return $results;
}

// Run migration manually (if called directly via URL)
if ( isset( $_GET['hb_run_migration_003'] ) && current_user_can( 'manage_options' ) ) {
	// Set proper headers
	header( 'Content-Type: text/html; charset=utf-8' );
	
	$result = hb_verify_and_migrate_data();
	
	if ( is_wp_error( $result ) ) {
		echo '<!DOCTYPE html><html><head><title>Migration 003 - Failed</title></head><body>';
		echo '<h1>Migration 003 Failed</h1>';
		echo '<p style="color: red;">Error: ' . esc_html( $result->get_error_message() ) . '</p>';
		echo '</body></html>';
	} else {
		echo '<!DOCTYPE html><html><head><title>Migration 003 - Success</title></head><body>';
		echo '<h1>Migration 003 Completed!</h1>';
		echo '<ul>';
		echo '<li>✓ Indexes added: ' . $result['indexes_added'] . '</li>';
		echo '<li>✓ Devices updated: ' . $result['devices_updated'] . '</li>';
		if ( ! empty( $result['errors'] ) ) {
			echo '<li style="color: orange;">⚠ Errors: ' . count( $result['errors'] ) . '</li>';
			echo '<pre>' . print_r( $result['errors'], true ) . '</pre>';
		}
		echo '</ul>';
		echo '<p><a href="' . esc_url( admin_url() ) . '">Go to WordPress Admin</a></p>';
		echo '</body></html>';
	}
	exit;
}
