<?php
/**
 * Database Migration: Add Hybrid Method Columns to wp_hb_devices
 * 
 * Adds device_id (UUIDv4), device_hash, wp_user_id, device_name, last_seen_at columns
 * Migrates existing device_fingerprint data to device_hash
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
 * Add hybrid method columns to devices table
 */
function hb_add_hybrid_method_columns() {
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'hb_devices';
	
	// Check if table exists
	$table_exists = $wpdb->get_var( $wpdb->prepare( 
		"SHOW TABLES LIKE %s", 
		$table_name 
	) );
	
	if ( ! $table_exists ) {
		return new WP_Error( 'table_not_found', 'Table ' . $table_name . ' does not exist. Run migration 001 first.' );
	}
	
	// Get existing columns
	$columns_result = $wpdb->get_results( "DESCRIBE {$table_name}", ARRAY_A );
	$columns = array();
	foreach ( $columns_result as $col ) {
		$columns[] = $col['Field'];
	}
	
	$alter_queries = array();
	
	// Add device_id (UUIDv4) column if it doesn't exist
	if ( ! in_array( 'device_id', $columns ) ) {
		$alter_queries[] = "ADD COLUMN device_id VARCHAR(36) NULL AFTER id";
	}
	
	// Add device_hash column if it doesn't exist
	if ( ! in_array( 'device_hash', $columns ) ) {
		// Determine position based on what exists
		$after_col = in_array( 'device_id', $columns ) ? 'device_id' : 'id';
		$alter_queries[] = "ADD COLUMN device_hash VARCHAR(64) NULL AFTER {$after_col}";
	}
	
	// Add wp_user_id column if it doesn't exist
	if ( ! in_array( 'wp_user_id', $columns ) ) {
		$after_col = in_array( 'device_hash', $columns ) ? 'device_hash' : ( in_array( 'device_id', $columns ) ? 'device_id' : 'id' );
		$alter_queries[] = "ADD COLUMN wp_user_id BIGINT(20) UNSIGNED NULL AFTER {$after_col}";
	}
	
	// Add device_name column if it doesn't exist
	if ( ! in_array( 'device_name', $columns ) ) {
		$after_col = in_array( 'wp_user_id', $columns ) ? 'wp_user_id' : ( in_array( 'device_hash', $columns ) ? 'device_hash' : 'id' );
		$alter_queries[] = "ADD COLUMN device_name VARCHAR(255) NULL AFTER {$after_col}";
	}
	
	// Add last_seen_at column if it doesn't exist
	if ( ! in_array( 'last_seen_at', $columns ) ) {
		$after_col = in_array( 'activated_at', $columns ) ? 'activated_at' : 'created_at';
		$alter_queries[] = "ADD COLUMN last_seen_at TIMESTAMP NULL AFTER {$after_col}";
	}
	
	// Execute ALTER TABLE if there are columns to add
	if ( ! empty( $alter_queries ) ) {
		$sql = "ALTER TABLE {$table_name} " . implode( ', ', $alter_queries );
		$result = $wpdb->query( $sql );
		
		if ( $result === false ) {
			return new WP_Error( 'alter_failed', 'Failed to add columns: ' . $wpdb->last_error );
		}
	}
	
	// Refresh columns list after adding new columns
	$columns_result = $wpdb->get_results( "DESCRIBE {$table_name}", ARRAY_A );
	$columns = array();
	foreach ( $columns_result as $col ) {
		$columns[] = $col['Field'];
	}
	
	// Add indexes
	$indexes = $wpdb->get_results( "SHOW INDEXES FROM {$table_name}" );
	$index_names = array();
	foreach ( $indexes as $index ) {
		$index_names[] = $index->Key_name;
	}
	
	// Add unique index on device_id if column exists and index doesn't
	if ( in_array( 'device_id', $columns ) ) {
		if ( ! in_array( 'device_id', $index_names ) ) {
			$wpdb->query( "ALTER TABLE {$table_name} ADD UNIQUE KEY device_id (device_id)" );
		}
	}
	
	// Add index on device_hash if column exists and index doesn't
	if ( in_array( 'device_hash', $columns ) ) {
		if ( ! in_array( 'idx_device_hash', $index_names ) ) {
			$wpdb->query( "ALTER TABLE {$table_name} ADD KEY idx_device_hash (device_hash)" );
		}
	}
	
	// Add index on wp_user_id if column exists and index doesn't
	if ( in_array( 'wp_user_id', $columns ) ) {
		if ( ! in_array( 'idx_wp_user', $index_names ) ) {
			$wpdb->query( "ALTER TABLE {$table_name} ADD KEY idx_wp_user (wp_user_id)" );
		}
	}
	
	// Migrate existing data
	// Check which columns exist before querying
	$select_fields = array( 'id' );
	if ( in_array( 'device_fingerprint', $columns ) ) {
		$select_fields[] = 'device_fingerprint';
	}
	if ( in_array( 'device_id', $columns ) ) {
		$select_fields[] = 'device_id';
	}
	if ( in_array( 'device_hash', $columns ) ) {
		$select_fields[] = 'device_hash';
	}
	if ( in_array( 'activated_at', $columns ) ) {
		$select_fields[] = 'activated_at';
	}
	if ( in_array( 'last_seen_at', $columns ) ) {
		$select_fields[] = 'last_seen_at';
	}
	
	$where_conditions = array();
	if ( in_array( 'device_id', $columns ) ) {
		$where_conditions[] = "device_id IS NULL";
	}
	if ( in_array( 'device_hash', $columns ) ) {
		$where_conditions[] = "device_hash IS NULL";
	}
	
	$where_clause = ! empty( $where_conditions ) ? 'WHERE ' . implode( ' OR ', $where_conditions ) : '';
	
	$devices = $wpdb->get_results( 
		"SELECT " . implode( ', ', $select_fields ) . " FROM {$table_name} {$where_clause}", 
		ARRAY_A 
	);
	
	foreach ( $devices as $device ) {
		$update_data = array();
		$update_format = array();
		
		// Generate device_id if missing
		if ( in_array( 'device_id', $columns ) && empty( $device['device_id'] ) ) {
			$update_data['device_id'] = hb_generate_uuidv4();
			$update_format[] = '%s';
		}
		
		// Migrate device_fingerprint to device_hash if device_hash is empty
		if ( in_array( 'device_hash', $columns ) && in_array( 'device_fingerprint', $columns ) ) {
			if ( ! empty( $device['device_fingerprint'] ) && empty( $device['device_hash'] ) ) {
				$update_data['device_hash'] = $device['device_fingerprint'];
				$update_format[] = '%s';
			}
		}
		
		// Set last_seen_at to activated_at if available
		if ( in_array( 'last_seen_at', $columns ) ) {
			if ( empty( $device['last_seen_at'] ) ) {
				if ( ! empty( $device['activated_at'] ) ) {
					$update_data['last_seen_at'] = $device['activated_at'];
				} else {
					$update_data['last_seen_at'] = current_time( 'mysql' );
				}
				$update_format[] = '%s';
			}
		}
		
		if ( ! empty( $update_data ) ) {
			$wpdb->update(
				$table_name,
				$update_data,
				array( 'id' => $device['id'] ),
				$update_format,
				array( '%d' )
			);
		}
	}
	
	// Update migration version
	update_option( 'hb_db_version', '1.1.0' );
	
	return true;
}

// Run migration manually (if called directly via URL)
if ( isset( $_GET['hb_run_migration_002'] ) && current_user_can( 'manage_options' ) ) {
	// Set proper headers
	header( 'Content-Type: text/html; charset=utf-8' );
	
	$result = hb_add_hybrid_method_columns();
	
	if ( is_wp_error( $result ) ) {
		echo '<!DOCTYPE html><html><head><title>Migration 002 - Failed</title></head><body>';
		echo '<h1>Migration 002 Failed</h1>';
		echo '<p style="color: red;">Error: ' . esc_html( $result->get_error_message() ) . '</p>';
		echo '<p>Error Code: ' . esc_html( $result->get_error_code() ) . '</p>';
		if ( $result->get_error_data() ) {
			echo '<pre>' . print_r( $result->get_error_data(), true ) . '</pre>';
		}
		echo '</body></html>';
	} else {
		echo '<!DOCTYPE html><html><head><title>Migration 002 - Success</title></head><body>';
		echo '<h1>Migration 002 Completed Successfully!</h1>';
		echo '<ul>';
		echo '<li>✓ Added columns: device_id, device_hash, wp_user_id, device_name, last_seen_at</li>';
		echo '<li>✓ Migrated existing device_fingerprint data to device_hash</li>';
		echo '<li>✓ Generated UUIDv4 for existing devices</li>';
		echo '<li>✓ Added indexes for better performance</li>';
		echo '</ul>';
		echo '<p><strong>Database version updated to: 1.1.0</strong></p>';
		echo '<p><a href="' . esc_url( admin_url() ) . '">Go to WordPress Admin</a></p>';
		echo '</body></html>';
	}
	exit;
}
