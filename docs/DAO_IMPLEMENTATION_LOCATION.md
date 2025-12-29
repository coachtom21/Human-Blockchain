# Where to Place DAO System & Participation Ban Protocol

## Recommended Approach: Custom WordPress Plugin

For a system this complex, **create a custom plugin** rather than putting it in the theme. This keeps the functionality independent and makes it easier to maintain, update, and potentially reuse.

### Directory Structure

```
wp-content/plugins/small-street-dao/
├── small-street-dao.php          # Main plugin file
├── includes/
│   ├── class-dao-database.php    # Database schema & setup
│   ├── class-dao-member.php      # Member registration & management
│   ├── class-dao-poc.php         # POC assignment engine
│   ├── class-dao-pod.php         # Proof of Delivery system
│   ├── class-dao-xp-ledger.php   # XP ledger service
│   ├── class-dao-referral.php    # Referral system
│   ├── class-dao-reconciliation.php  # Monthly reconciliation
│   ├── class-dao-moderation.php  # Participation Ban Protocol ⭐
│   └── class-dao-constants.php   # XP constants & config
├── api/
│   ├── class-dao-rest-api.php    # REST API endpoints
│   └── endpoints/
│       ├── class-endpoint-members.php
│       ├── class-endpoint-pods.php
│       ├── class-endpoint-xp.php
│       └── class-endpoint-moderation.php  # Ban endpoints ⭐
├── admin/
│   ├── class-dao-admin.php       # Admin dashboard
│   └── views/
│       ├── member-management.php
│       └── moderation-panel.php  # Ban interface ⭐
├── database/
│   └── schema.sql                # Database schema
└── uninstall.php                 # Cleanup on uninstall
```

---

## Alternative: Theme-Based Approach

If you prefer to keep it in the theme (not recommended for production), use this structure:

```
wp-content/themes/hello-theme-child-master/
├── functions.php                  # Load DAO system
├── includes/
│   ├── dao/
│   │   ├── class-dao-database.php
│   │   ├── class-dao-member.php
│   │   ├── class-dao-poc.php
│   │   ├── class-dao-pod.php
│   │   ├── class-dao-xp-ledger.php
│   │   ├── class-dao-referral.php
│   │   ├── class-dao-reconciliation.php
│   │   ├── class-dao-moderation.php  # Participation Ban Protocol ⭐
│   │   └── class-dao-constants.php
│   └── api/
│       └── class-dao-rest-api.php
└── admin/
    └── dao-moderation.php        # Admin moderation panel
```

---

## Specific File Locations

### 1. Participation Ban Protocol ⭐

**Location:** `wp-content/plugins/small-street-dao/includes/class-dao-moderation.php`

This file should contain:
- `DAO_Moderation` class
- `ban_member_from_xp()` method
- `extinguish_member_xp()` method
- `remove_from_pocs()` method
- `block_pod_participation()` method
- `get_banned_members()` method
- `unban_member()` method (if needed)

**Admin Interface:** `wp-content/plugins/small-street-dao/admin/views/moderation-panel.php`

**API Endpoint:** `wp-content/plugins/small-street-dao/api/endpoints/class-endpoint-moderation.php`

---

### 2. Main DAO System

**Core Files:**
- **Database Setup:** `includes/class-dao-database.php`
- **Member System:** `includes/class-dao-member.php`
- **POC Engine:** `includes/class-dao-poc.php`
- **PoD System:** `includes/class-dao-pod.php`
- **XP Ledger:** `includes/class-dao-xp-ledger.php`
- **Referral System:** `includes/class-dao-referral.php`
- **Reconciliation:** `includes/class-dao-reconciliation.php`

**Main Plugin File:** `small-street-dao.php` (registers everything)

---

## Implementation Steps

### Step 1: Create Plugin Directory

```bash
mkdir -p wp-content/plugins/small-street-dao/{includes,api/endpoints,admin/views,database}
```

### Step 2: Create Main Plugin File

**File:** `wp-content/plugins/small-street-dao/small-street-dao.php`

```php
<?php
/**
 * Plugin Name: Small Street Applied DAO
 * Plugin URI: https://smallstreet.applied
 * Description: Non-custodial trade-credit clearinghouse with XP ledger and 2-scan PoD system
 * Version: 1.0.0
 * Author: Small Street Applied
 * License: GPL v2 or later
 * Text Domain: small-street-dao
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'SS_DAO_VERSION', '1.0.0' );
define( 'SS_DAO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SS_DAO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load core classes
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-constants.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-database.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-member.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-poc.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-pod.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-xp-ledger.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-referral.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-reconciliation.php';
require_once SS_DAO_PLUGIN_DIR . 'includes/class-dao-moderation.php'; // ⭐ Ban Protocol

// Load API
require_once SS_DAO_PLUGIN_DIR . 'api/class-dao-rest-api.php';

// Load Admin (if in admin)
if ( is_admin() ) {
    require_once SS_DAO_PLUGIN_DIR . 'admin/class-dao-admin.php';
}

// Activation hook - create database tables
register_activation_hook( __FILE__, array( 'DAO_Database', 'create_tables' ) );

// Deactivation hook
register_deactivation_hook( __FILE__, array( 'DAO_Database', 'deactivate' ) );
```

### Step 3: Create Participation Ban Protocol Class

**File:** `wp-content/plugins/small-street-dao/includes/class-dao-moderation.php`

```php
<?php
/**
 * DAO Moderation & Participation Ban Protocol
 * 
 * Handles member bans, XP extinguishing, and IP protection
 * through social enforcement rather than legal action.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class DAO_Moderation {
    
    /**
     * Ban member from XP participation
     * 
     * This is the core IP protection mechanism:
     * - Extinguishes all existing XP
     * - Prevents future XP accrual
     * - Removes from POC participation
     * - Blocks PoD events
     * - Removes from referral trees
     * 
     * @param int $member_id Member ID to ban
     * @param string $reason Reason for ban (optional)
     * @return bool|WP_Error Success or error
     */
    public static function ban_member_from_xp( $member_id, $reason = '' ) {
        global $wpdb;
        
        $wpdb->query( 'START TRANSACTION' );
        
        try {
            // 1. Extinguish all existing XP
            self::extinguish_member_xp( $member_id, 'ban', $reason );
            
            // 2. Update member status
            $wpdb->update(
                $wpdb->prefix . 'ss_dao_members',
                array( 
                    'xp_banned' => 1,
                    'banned_at' => current_time( 'mysql' ),
                    'ban_reason' => $reason
                ),
                array( 'id' => $member_id ),
                array( '%d', '%s', '%s' ),
                array( '%d' )
            );
            
            // 3. Remove from POCs
            self::remove_from_pocs( $member_id );
            
            // 4. Block future PoD participation
            self::block_pod_participation( $member_id );
            
            // 5. Remove from referral trees
            self::remove_from_referral_trees( $member_id );
            
            $wpdb->query( 'COMMIT' );
            
            // Log the ban action
            do_action( 'ss_dao_member_banned', $member_id, $reason );
            
            return true;
            
        } catch ( Exception $e ) {
            $wpdb->query( 'ROLLBACK' );
            return new WP_Error( 'ban_failed', $e->getMessage() );
        }
    }
    
    /**
     * Extinguish all XP for a member
     */
    private static function extinguish_member_xp( $member_id, $type = 'ban', $note = '' ) {
        global $wpdb;
        
        // Get all active XP (create entries that haven't been extinguished)
        $xp_entries = $wpdb->get_results( $wpdb->prepare( "
            SELECT id, xp_amount 
            FROM {$wpdb->prefix}ss_dao_xp_ledger_entries
            WHERE member_id = %d 
            AND type = 'create'
            AND id NOT IN (
                SELECT DISTINCT pod_id 
                FROM {$wpdb->prefix}ss_dao_xp_ledger_entries 
                WHERE type = 'extinguish' 
                AND member_id = %d
            )
        ", $member_id, $member_id ) );
        
        foreach ( $xp_entries as $entry ) {
            // Create extinguish entry
            $wpdb->insert(
                $wpdb->prefix . 'ss_dao_xp_ledger_entries',
                array(
                    'member_id' => $member_id,
                    'type' => 'extinguish',
                    'category' => 'other',
                    'xp_amount' => $entry->xp_amount,
                    'note' => sprintf( 'XP extinguished due to %s: %s', $type, $note ),
                    'created_at' => current_time( 'mysql' )
                ),
                array( '%d', '%s', '%s', '%d', '%s', '%s' )
            );
        }
    }
    
    /**
     * Remove member from all POCs
     */
    private static function remove_from_pocs( $member_id ) {
        global $wpdb;
        
        $wpdb->delete(
            $wpdb->prefix . 'ss_dao_poc_members',
            array( 'member_id' => $member_id ),
            array( '%d' )
        );
        
        // Clear POC references in members table
        $wpdb->update(
            $wpdb->prefix . 'ss_dao_members',
            array( 
                'buyer_poc_id' => null,
                'seller_poc_id' => null
            ),
            array( 'id' => $member_id ),
            array( '%d', '%d' ),
            array( '%d' )
        );
    }
    
    /**
     * Block member from PoD participation
     */
    private static function block_pod_participation( $member_id ) {
        global $wpdb;
        
        // Cancel any pending PoDs
        $wpdb->update(
            $wpdb->prefix . 'ss_dao_pods',
            array( 'status' => 'cancelled' ),
            array( 
                'buyer_id' => $member_id,
                'status' => array( 'initiated', 'buyer_scanned' )
            ),
            array( '%s' ),
            array( '%d', '%s' )
        );
        
        $wpdb->update(
            $wpdb->prefix . 'ss_dao_pods',
            array( 'status' => 'cancelled' ),
            array( 
                'seller_id' => $member_id,
                'status' => array( 'initiated', 'buyer_scanned' )
            ),
            array( '%s' ),
            array( '%d', '%s' )
        );
    }
    
    /**
     * Remove member from referral trees
     */
    private static function remove_from_referral_trees( $member_id ) {
        global $wpdb;
        
        // Remove as referrer
        $wpdb->delete(
            $wpdb->prefix . 'ss_dao_referral_links',
            array( 'referrer_member_id' => $member_id ),
            array( '%d' )
        );
        
        // Remove as referred (optional - you may want to keep history)
        // $wpdb->delete(
        //     $wpdb->prefix . 'ss_dao_referral_links',
        //     array( 'referred_member_id' => $member_id ),
        //     array( '%d' )
        // );
    }
    
    /**
     * Get list of banned members
     */
    public static function get_banned_members() {
        global $wpdb;
        
        return $wpdb->get_results( "
            SELECT id, email, discord_id, banned_at, ban_reason
            FROM {$wpdb->prefix}ss_dao_members
            WHERE xp_banned = 1
            ORDER BY banned_at DESC
        " );
    }
    
    /**
     * Check if member is banned
     */
    public static function is_member_banned( $member_id ) {
        global $wpdb;
        
        $banned = $wpdb->get_var( $wpdb->prepare( "
            SELECT xp_banned 
            FROM {$wpdb->prefix}ss_dao_members
            WHERE id = %d
        ", $member_id ) );
        
        return (bool) $banned;
    }
    
    /**
     * Unban member (restore XP participation)
     * Note: This does NOT restore extinguished XP
     */
    public static function unban_member( $member_id ) {
        global $wpdb;
        
        $result = $wpdb->update(
            $wpdb->prefix . 'ss_dao_members',
            array( 
                'xp_banned' => 0,
                'banned_at' => null,
                'ban_reason' => null
            ),
            array( 'id' => $member_id ),
            array( '%d', '%s', '%s' ),
            array( '%d' )
        );
        
        if ( $result !== false ) {
            do_action( 'ss_dao_member_unbanned', $member_id );
            return true;
        }
        
        return false;
    }
}
```

### Step 4: Create REST API Endpoint for Banning

**File:** `wp-content/plugins/small-street-dao/api/endpoints/class-endpoint-moderation.php`

```php
<?php
/**
 * REST API Endpoint for Moderation & Banning
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class DAO_Endpoint_Moderation {
    
    public static function register_routes() {
        register_rest_route( 'ss-dao/v1', '/moderation/ban', array(
            'methods' => 'POST',
            'callback' => array( __CLASS__, 'ban_member' ),
            'permission_callback' => array( __CLASS__, 'check_admin_permission' ),
            'args' => array(
                'member_id' => array(
                    'required' => true,
                    'type' => 'integer',
                    'validate_callback' => function( $param ) {
                        return is_numeric( $param );
                    }
                ),
                'reason' => array(
                    'required' => false,
                    'type' => 'string',
                ),
            ),
        ) );
        
        register_rest_route( 'ss-dao/v1', '/moderation/banned', array(
            'methods' => 'GET',
            'callback' => array( __CLASS__, 'get_banned_members' ),
            'permission_callback' => array( __CLASS__, 'check_admin_permission' ),
        ) );
        
        register_rest_route( 'ss-dao/v1', '/moderation/unban', array(
            'methods' => 'POST',
            'callback' => array( __CLASS__, 'unban_member' ),
            'permission_callback' => array( __CLASS__, 'check_admin_permission' ),
            'args' => array(
                'member_id' => array(
                    'required' => true,
                    'type' => 'integer',
                ),
            ),
        ) );
    }
    
    public static function check_admin_permission() {
        return current_user_can( 'manage_options' );
    }
    
    public static function ban_member( WP_REST_Request $request ) {
        $member_id = $request->get_param( 'member_id' );
        $reason = $request->get_param( 'reason' ) ?: 'Administrative action';
        
        $result = DAO_Moderation::ban_member_from_xp( $member_id, $reason );
        
        if ( is_wp_error( $result ) ) {
            return new WP_Error( 'ban_failed', $result->get_error_message(), array( 'status' => 500 ) );
        }
        
        return new WP_REST_Response( array(
            'success' => true,
            'message' => 'Member banned from XP participation',
            'member_id' => $member_id
        ), 200 );
    }
    
    public static function get_banned_members( WP_REST_Request $request ) {
        $banned = DAO_Moderation::get_banned_members();
        return new WP_REST_Response( $banned, 200 );
    }
    
    public static function unban_member( WP_REST_Request $request ) {
        $member_id = $request->get_param( 'member_id' );
        
        $result = DAO_Moderation::unban_member( $member_id );
        
        if ( ! $result ) {
            return new WP_Error( 'unban_failed', 'Failed to unban member', array( 'status' => 500 ) );
        }
        
        return new WP_REST_Response( array(
            'success' => true,
            'message' => 'Member unbanned',
            'member_id' => $member_id
        ), 200 );
    }
}
```

---

## Database Schema Addition

Add to your `members` table:

```sql
ALTER TABLE wp_ss_dao_members
ADD COLUMN xp_banned TINYINT(1) DEFAULT 0,
ADD COLUMN banned_at DATETIME NULL,
ADD COLUMN ban_reason VARCHAR(255) NULL;
```

---

## Summary

**DAO System Location:**
- ✅ **Recommended:** `wp-content/plugins/small-street-dao/`
- ⚠️ **Alternative:** `wp-content/themes/hello-theme-child-master/includes/dao/`

**Participation Ban Protocol Location:**
- ✅ **Class:** `wp-content/plugins/small-street-dao/includes/class-dao-moderation.php`
- ✅ **API:** `wp-content/plugins/small-street-dao/api/endpoints/class-endpoint-moderation.php`
- ✅ **Admin UI:** `wp-content/plugins/small-street-dao/admin/views/moderation-panel.php`

**Next Steps:**
1. Create the plugin directory structure
2. Create the main plugin file
3. Implement the moderation class
4. Add REST API endpoints
5. Create admin interface
6. Test ban functionality

