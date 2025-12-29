<?php
/**
 * Database Migration: Create Device Registration Tables
 * 
 * Run this migration to create the necessary tables for device registration
 * 
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create device registration tables
 */
function hb_create_device_tables() {
	global $wpdb;
	
	$charset_collate = $wpdb->get_charset_collate();
	
	// Devices table
	$devices_table = $wpdb->prefix . 'hb_devices';
	$devices_sql = "CREATE TABLE IF NOT EXISTS {$devices_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		device_fingerprint VARCHAR(255) NOT NULL,
		status ENUM('pending', 'activating', 'validated', 'suspended', 'rejected') DEFAULT 'pending',
		user_agent TEXT,
		screen_resolution VARCHAR(50),
		timezone VARCHAR(50),
		language VARCHAR(10),
		location_lat DECIMAL(10, 8),
		location_lng DECIMAL(11, 8),
		location_city VARCHAR(100),
		location_state VARCHAR(100),
		location_country VARCHAR(100),
		activation_ip VARCHAR(45),
		membership_tier ENUM('yamer', 'megavoter', 'patron'),
		peace_pentagon_branch ENUM('planning', 'budget', 'media', 'distribution', 'membership'),
		vcard_status ENUM('pending', 'validated', 'rejected') DEFAULT 'pending',
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		activated_at TIMESTAMP NULL,
		validated_at TIMESTAMP NULL,
		PRIMARY KEY (id),
		UNIQUE KEY device_fingerprint (device_fingerprint),
		KEY idx_status (status),
		KEY idx_location (location_country, location_state),
		KEY idx_vcard_status (vcard_status)
	) {$charset_collate};";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
	// Create devices table first (no foreign keys)
	dbDelta( $devices_sql );
	
	// QRtiger v-cards table
	$vcards_table = $wpdb->prefix . 'hb_qrtiger_vcards';
	$vcards_sql = "CREATE TABLE IF NOT EXISTS {$vcards_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		device_id BIGINT(20) UNSIGNED NOT NULL,
		vcard_hash VARCHAR(255) NOT NULL,
		status ENUM('pending', 'validating', 'validated', 'rejected') DEFAULT 'pending',
		qrtiger_reference VARCHAR(255),
		metadata TEXT,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		validated_at TIMESTAMP NULL,
		PRIMARY KEY (id),
		UNIQUE KEY vcard_hash (vcard_hash),
		KEY idx_device (device_id),
		KEY idx_status (status),
		KEY idx_device_fk (device_id)
	) {$charset_collate};";
	
	// Discord mappings table
	$discord_table = $wpdb->prefix . 'hb_discord_mappings';
	$discord_sql = "CREATE TABLE IF NOT EXISTS {$discord_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		device_id BIGINT(20) UNSIGNED NOT NULL,
		discord_user_id VARCHAR(255) NOT NULL,
		discord_username VARCHAR(255),
		role VARCHAR(100),
		connected_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		access_token_hash VARCHAR(255),
		PRIMARY KEY (id),
		UNIQUE KEY discord_user_id (discord_user_id),
		KEY idx_device (device_id),
		KEY idx_device_fk (device_id)
	) {$charset_collate};";
	
	// POC memberships table
	$poc_table = $wpdb->prefix . 'hb_poc_memberships';
	$poc_sql = "CREATE TABLE IF NOT EXISTS {$poc_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		device_id BIGINT(20) UNSIGNED NOT NULL,
		poc_id BIGINT(20) UNSIGNED NOT NULL,
		poc_type ENUM('buyer', 'seller') NOT NULL,
		slot_index TINYINT UNSIGNED,
		assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY idx_device (device_id),
		KEY idx_poc (poc_id, poc_type),
		KEY idx_device_fk (device_id)
	) {$charset_collate};";
	
	// Buyer POCs table
	$buyer_pocs_table = $wpdb->prefix . 'hb_buyer_pocs';
	$buyer_pocs_sql = "CREATE TABLE IF NOT EXISTS {$buyer_pocs_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		region VARCHAR(100) NOT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY idx_region (region)
	) {$charset_collate};";
	
	// Seller POCs table
	$seller_pocs_table = $wpdb->prefix . 'hb_seller_pocs';
	$seller_pocs_sql = "CREATE TABLE IF NOT EXISTS {$seller_pocs_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		region VARCHAR(100) NOT NULL,
		branch ENUM('planning', 'budget', 'media', 'distribution', 'membership') NOT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY idx_region (region),
		KEY idx_branch (branch)
	) {$charset_collate};";
	
	// Create tables with foreign key references (using indexes instead of FK constraints for compatibility)
	dbDelta( $vcards_sql );
	dbDelta( $discord_sql );
	dbDelta( $poc_sql );
	dbDelta( $buyer_pocs_sql );
	dbDelta( $seller_pocs_sql );
	
	// Store migration version
	update_option( 'hb_db_version', '1.0.0' );
	
	return true;
}

// Run migration on activation (if called directly)
if ( isset( $_GET['hb_run_migration'] ) && current_user_can( 'manage_options' ) ) {
	hb_create_device_tables();
	echo 'Migration completed!';
	exit;
}

