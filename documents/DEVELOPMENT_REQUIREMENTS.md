# HumanBlockchain.info Development Requirements
## Complete Implementation Guide for Codepixelzmedia

**Version:** 1.0  
**Date:** January 2025  
**Project:** HumanBlockchain Portal - WordPress Plugin Development

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Core Philosophy](#core-philosophy)
3. [Milestone 1: Plugin Foundation & Database](#milestone-1-plugin-foundation--database)
4. [Milestone 2: Device Registration System](#milestone-2-device-registration-system)
5. [Milestone 3: Discord Integration](#milestone-3-discord-integration)
6. [Milestone 4: Complimentary 10-Pack System](#milestone-4-complimentary-10-pack-system)
7. [Milestone 5: XP Ledger & Maturity System](#milestone-5-xp-ledger--maturity-system)
8. [Milestone 6: Referral System](#milestone-6-referral-system)
9. [Milestone 7: Admin Panel](#milestone-7-admin-panel)
10. [Milestone 8: Frontend UI & Shortcodes](#milestone-8-frontend-ui--shortcodes)
11. [Security & Compliance](#security--compliance)
12. [Testing & Acceptance Criteria](#testing--acceptance-criteria)

---

## Project Overview

### What We're Building

A WordPress plugin that powers humanblockchain.info, enabling:
- **Device Registration**: Privacy-first device identity with geo-location
- **Discord Integration**: OAuth2 login + bot role assignment
- **XP Ledger**: Append-only ledger for tracking human value
- **Referral System**: Sponsor tracking with maturity windows
- **Complimentary 10-Pack**: Starter vouchers/hang tags for onboarding
- **Pledge-Based Economy UI**: Human-centered interface

### Core Principles

1. **XP is NOT money** - It's a measurement of human value
2. **Append-only ledger** - Immutable audit trail
3. **Privacy-first** - No sensitive data collection
4. **Trust-first** - Value moves before money
5. **One complimentary pack per device** - Ever

---

## Core Philosophy

### The Pledge-Based Economy (Personified)

**The Economy Has Three Faces:**

1. **The Pledger** (Seller/Provider)
   - "I deliver value."

2. **The Confirmer** (Buyer/Receiver)
   - "I confirm truth."

3. **The Ledger** (The System/DAO)
   - "I remember trust forever."

**Key Message:**
> "A pledge-based economy is the economy with a face. Instead of money moving first, human value moves first. A person pledges delivery, another confirms it, and the ledger records trust—not speculation."

**UI Language Requirements:**
- Use warm, human wording
- Show "three living roles" on screen
- Make ledger entries read like statements, not transactions
- Example: "A pledge was made." not "Transaction completed."

---

## Milestone 1: Plugin Foundation & Database

### Task 1.1: Create Plugin Structure

**Location:** `/wp-content/plugins/hbc-portal/`

**Required Files:**
```
hbc-portal/
├── hbc-portal.php (main plugin file)
├── includes/
│   ├── class-device-service.php
│   ├── class-discord-service.php
│   ├── class-xp-ledger-service.php
│   ├── class-referral-service.php
│   ├── class-voucher-service.php
│   └── class-serendipity-service.php
├── templates/
│   ├── shortcode-enter.php
│   ├── shortcode-register.php
│   ├── shortcode-discord-connect.php
│   ├── shortcode-dashboard.php
│   └── shortcode-faq.php
├── assets/
│   ├── css/
│   │   └── hbc-portal.css
│   └── js/
│       ├── hbc-registration.js
│       └── hbc-dashboard.js
└── admin/
    ├── class-admin-pages.php
    └── views/
        ├── devices-list.php
        ├── members-list.php
        ├── referrals-list.php
        └── xp-ledger-viewer.php
```

**Acceptance Criteria:**
- [ ] Plugin activates without errors
- [ ] All class files load correctly
- [ ] Admin menu appears in WordPress dashboard

---

### Task 1.2: Database Schema

**Custom Tables Required:**

#### Table: `hbc_devices`
```sql
CREATE TABLE hbc_devices (
    device_id VARCHAR(36) PRIMARY KEY, -- UUIDv4
    device_hash VARCHAR(64) NOT NULL, -- SHA256 hash
    wp_user_id BIGINT UNSIGNED NULL, -- Links to WP user if logged in
    created_at DATETIME NOT NULL,
    last_seen_at DATETIME NOT NULL,
    geo_lat DECIMAL(8,4) NULL, -- 3-4 decimal places
    geo_lng DECIMAL(9,4) NULL,
    geo_consent BOOLEAN DEFAULT FALSE,
    ip_hash VARCHAR(64) NULL, -- Hashed IP
    user_agent_hash VARCHAR(64) NULL, -- Hashed UA
    complimentary_pack_issued BOOLEAN DEFAULT FALSE,
    pack_type ENUM('sticker', 'hang_tag') NULL,
    pack_issued_at DATETIME NULL,
    INDEX idx_device_hash (device_hash),
    INDEX idx_wp_user (wp_user_id),
    INDEX idx_created (created_at)
);
```

#### Table: `hbc_members`
```sql
CREATE TABLE hbc_members (
    member_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    wp_user_id BIGINT UNSIGNED NULL,
    device_id VARCHAR(36) NOT NULL,
    discord_user_id VARCHAR(20) NULL,
    discord_username VARCHAR(100) NULL,
    membership_level ENUM('yamer', 'megavoter', 'patron') DEFAULT 'yamer',
    status ENUM('pending_discord', 'pending_action', 'pending_maturity', 'active', 'suspended', 'revoked') DEFAULT 'pending_discord',
    buyer_poc_id INT NULL,
    seller_poc_id INT NULL,
    peace_pentagon_branch ENUM('planning', 'budget', 'media', 'distribution', 'membership') NULL,
    discord_connected_at DATETIME NULL,
    role_confirmed_at DATETIME NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    INDEX idx_wp_user (wp_user_id),
    INDEX idx_device (device_id),
    INDEX idx_discord (discord_user_id),
    INDEX idx_status (status)
);
```

#### Table: `hbc_referrals`
```sql
CREATE TABLE hbc_referrals (
    referral_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    referrer_wp_user_id BIGINT UNSIGNED NOT NULL,
    referrer_device_id VARCHAR(36) NULL,
    referred_device_id VARCHAR(36) NOT NULL,
    referred_wp_user_id BIGINT UNSIGNED NULL,
    xp_amount INT NOT NULL, -- 1, 5, or 25
    maturity_date DATE NOT NULL, -- 8-12 weeks from creation
    status ENUM('pending_action', 'pending_maturity', 'matured', 'void') DEFAULT 'pending_maturity',
    created_at DATETIME NOT NULL,
    matured_at DATETIME NULL,
    INDEX idx_referrer (referrer_wp_user_id),
    INDEX idx_referred_device (referred_device_id),
    INDEX idx_maturity_date (maturity_date),
    INDEX idx_status (status)
);
```

#### Table: `hbc_xp_ledger` (Append-Only)
```sql
CREATE TABLE hbc_xp_ledger (
    entry_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    entry_type ENUM(
        'device_register',
        'referral_award',
        'role_assigned',
        'complimentary_pack_issued',
        'voucher_used',
        'maturity_unlock',
        'annual_close_adjustment',
        'action_completed'
    ) NOT NULL,
    actor_type ENUM('device', 'wp_user', 'system') NOT NULL,
    actor_id VARCHAR(36) NOT NULL, -- device_id or wp_user_id
    amount INT NOT NULL, -- XP units (can be 0 for non-XP entries)
    reference_id VARCHAR(36) NULL, -- Links to referral_id, voucher_id, etc.
    metadata JSON NULL, -- Flexible data storage
    created_at DATETIME NOT NULL,
    immutable_hash VARCHAR(64) NOT NULL, -- Hash of entry + previous hash
    previous_hash VARCHAR(64) NULL, -- Links to previous entry
    INDEX idx_actor (actor_type, actor_id),
    INDEX idx_entry_type (entry_type),
    INDEX idx_created (created_at),
    INDEX idx_hash (immutable_hash)
);
```

#### Table: `hbc_vouchers`
```sql
CREATE TABLE hbc_vouchers (
    voucher_id VARCHAR(36) PRIMARY KEY, -- UUIDv4
    device_id VARCHAR(36) NOT NULL,
    pack_type ENUM('sticker', 'hang_tag') NOT NULL,
    pack_source ENUM('complimentary', 'purchased') DEFAULT 'complimentary',
    status ENUM('issued', 'unused', 'attached', 'validated', 'closed') DEFAULT 'issued',
    qr_code VARCHAR(255) NOT NULL, -- QR code data
    seller_scan_at DATETIME NULL,
    buyer_scan_at DATETIME NULL,
    xp_entry_id BIGINT UNSIGNED NULL, -- Links to XP ledger when validated
    created_at DATETIME NOT NULL,
    validated_at DATETIME NULL,
    INDEX idx_device (device_id),
    INDEX idx_status (status),
    INDEX idx_qr_code (qr_code)
);
```

**Acceptance Criteria:**
- [ ] All tables created on plugin activation
- [ ] Indexes properly set
- [ ] Foreign key constraints (if applicable)
- [ ] Migration script handles updates

---

## Milestone 2: Device Registration System

### Task 2.1: Privacy-First Device Identity

**Requirements:**
- Generate `device_id` as UUIDv4
- Store in browser localStorage + secure cookie
- Create `device_hash` = SHA256(device_id + user_agent + timezone + screen_width + screen_height)
- **DO NOT** collect hardware IDs (Apple blocks, privacy risk)

**Implementation:**
```php
// class-device-service.php
class HBC_Device_Service {
    public function generate_device_id() {
        return wp_generate_uuid4();
    }
    
    public function create_device_hash($device_id, $user_agent, $timezone, $screen_w, $screen_h) {
        $data = $device_id . $user_agent . $timezone . $screen_w . $screen_h;
        return hash('sha256', $data);
    }
    
    public function register_device($device_id, $device_hash, $geo_data, $ip, $user_agent) {
        // Store hashed IP and UA
        $ip_hash = hash('sha256', $ip);
        $ua_hash = hash('sha256', $user_agent);
        
        // Insert into hbc_devices
        // Return device record
    }
}
```

**JavaScript (hbc-registration.js):**
```javascript
// Generate or retrieve device ID
function getOrCreateDeviceId() {
    let deviceId = localStorage.getItem('hbc_device_id');
    if (!deviceId) {
        deviceId = generateUUID();
        localStorage.setItem('hbc_device_id', deviceId);
        // Also set secure cookie
        setSecureCookie('hbc_device_id', deviceId, 365);
    }
    return deviceId;
}

// Collect device fingerprint
function collectDeviceFingerprint() {
    return {
        device_id: getOrCreateDeviceId(),
        user_agent: navigator.userAgent,
        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        screen_width: screen.width,
        screen_height: screen.height
    };
}
```

**Acceptance Criteria:**
- [ ] Device ID persists across sessions
- [ ] Device hash is consistent for same device
- [ ] No hardware IDs collected
- [ ] IP and UA are hashed before storage

---

### Task 2.2: Geo-Location Capture

**Requirements:**
- Use browser Geolocation API (permission-based)
- Store coarse location (3-4 decimal places)
- Always store server timestamp (authoritative)
- Require explicit consent

**Implementation:**
```javascript
// Request geolocation with consent
function requestGeolocation() {
    return new Promise((resolve, reject) => {
        if (!navigator.geolocation) {
            reject(new Error('Geolocation not supported'));
            return;
        }
        
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const geo = {
                    lat: parseFloat(position.coords.latitude.toFixed(4)),
                    lng: parseFloat(position.coords.longitude.toFixed(4)),
                    consent: true,
                    timestamp: new Date().toISOString()
                };
                resolve(geo);
            },
            (error) => {
                reject(error);
            },
            {
                enableHighAccuracy: false, // Coarse is fine
                timeout: 10000,
                maximumAge: 60000
            }
        );
    });
}
```

**Acceptance Criteria:**
- [ ] User consent dialog appears
- [ ] Location rounded to 3-4 decimal places
- [ ] Server timestamp stored
- [ ] Consent flag recorded

---

### Task 2.3: Serendipity Protocol Assignment

**Requirements:**
- Assign Buyer POC based on local geo grid + timestamp
- Assign Seller POC based on global bucket (different state/country)
- Service function: `assign_poc(device_id, lat, lng, timestamp)`

**Implementation:**
```php
// class-serendipity-service.php
class HBC_Serendipity_Service {
    public function assign_poc($device_id, $lat, $lng, $timestamp) {
        // Buyer POC: Local assignment
        $buyer_poc = $this->find_or_create_buyer_poc($lat, $lng, $timestamp);
        
        // Seller POC: Global assignment (away from locality)
        $seller_poc = $this->find_or_create_seller_poc($lat, $lng, $timestamp);
        
        // Peace Pentagon Branch: Time-based serendipity
        $branch = $this->assign_peace_pentagon_branch($device_id, $timestamp);
        
        return [
            'buyer_poc_id' => $buyer_poc,
            'seller_poc_id' => $seller_poc,
            'peace_pentagon_branch' => $branch
        ];
    }
    
    private function find_or_create_buyer_poc($lat, $lng, $timestamp) {
        // Find local POC within ~50km radius
        // Max 30 members per Buyer POC
        // If full, create new POC
    }
    
    private function find_or_create_seller_poc($lat, $lng, $timestamp) {
        // Find global POC away from device location
        // Max 5 sellers per Seller POC
        // Assign based on timestamp bucket
    }
}
```

**Acceptance Criteria:**
- [ ] Buyer POC assigned locally
- [ ] Seller POC assigned globally
- [ ] Peace Pentagon branch assigned
- [ ] POC limits enforced (30 buyers, 5 sellers)

---

## Milestone 3: Discord Integration

### Task 3.1: Discord OAuth2 Login

**Requirements:**
- Implement "Connect Discord" button
- Capture: `discord_user_id`, `username`, `guild membership`
- Store connection timestamp

**Implementation:**
```php
// class-discord-service.php
class HBC_Discord_Service {
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $guild_id;
    
    public function get_oauth_url($state) {
        $params = [
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code',
            'scope' => 'identify guilds',
            'state' => $state
        ];
        return 'https://discord.com/api/oauth2/authorize?' . http_build_query($params);
    }
    
    public function exchange_code_for_token($code) {
        // Exchange authorization code for access token
        // Return user info
    }
    
    public function verify_guild_membership($discord_user_id) {
        // Check if user is in the guild
        // Return true/false
    }
}
```

**Acceptance Criteria:**
- [ ] OAuth flow completes successfully
- [ ] Discord user ID stored
- [ ] Guild membership verified
- [ ] Connection timestamp recorded

---

### Task 3.2: Discord Bot Role Assignment

**Requirements:**
- Bot confirms user is in server
- Assigns roles: Peace Pentagon branch, Buyer POC, Seller POC, membership level
- Webhook endpoint: `/wp-json/hbc/v1/discord/role-confirm`

**Implementation:**
```php
// REST API endpoint
add_action('rest_api_init', function() {
    register_rest_route('hbc/v1', '/discord/role-confirm', [
        'methods' => 'POST',
        'callback' => 'hbc_discord_role_confirm',
        'permission_callback' => 'hbc_verify_discord_webhook'
    ]);
});

function hbc_discord_role_confirm($request) {
    $data = $request->get_json_params();
    
    // Verify HMAC signature
    if (!verify_discord_webhook_signature($request)) {
        return new WP_Error('unauthorized', 'Invalid signature', ['status' => 401]);
    }
    
    $discord_user_id = $data['user_id'];
    $roles = $data['roles']; // Array of role IDs assigned
    
    // Update member record
    $member = HBC_Member_Service::get_by_discord_id($discord_user_id);
    if ($member) {
        $member->update([
            'role_confirmed_at' => current_time('mysql'),
            'status' => 'active' // Or 'pending_action' if action required
        ]);
    }
    
    return new WP_REST_Response(['success' => true], 200);
}
```

**Acceptance Criteria:**
- [ ] Bot assigns roles correctly
- [ ] Webhook receives confirmation
- [ ] Member status updated
- [ ] HMAC signature verified

---

## Milestone 4: Complimentary 10-Pack System

### Task 4.1: Pack Issuance Logic

**Requirements:**
- Issue once per device, ever
- Trigger: Device registration + Discord connection confirmed
- User chooses: Sticker vouchers OR Hang tags
- Record in ledger (no XP minted)

**Implementation:**
```php
// class-voucher-service.php
class HBC_Voucher_Service {
    public function issue_complimentary_pack($device_id, $pack_type) {
        // Check if already issued
        $device = HBC_Device_Service::get($device_id);
        if ($device->complimentary_pack_issued) {
            return new WP_Error('already_issued', 'Pack already issued');
        }
        
        // Generate 10 unique vouchers
        $vouchers = [];
        for ($i = 0; $i < 10; $i++) {
            $voucher_id = wp_generate_uuid4();
            $qr_code = $this->generate_qr_code($voucher_id);
            
            $vouchers[] = [
                'voucher_id' => $voucher_id,
                'device_id' => $device_id,
                'pack_type' => $pack_type,
                'pack_source' => 'complimentary',
                'status' => 'issued',
                'qr_code' => $qr_code
            ];
        }
        
        // Insert vouchers
        foreach ($vouchers as $v) {
            $this->create_voucher($v);
        }
        
        // Update device record
        $device->update([
            'complimentary_pack_issued' => true,
            'pack_type' => $pack_type,
            'pack_issued_at' => current_time('mysql')
        ]);
        
        // Write ledger entry (NO XP)
        HBC_XP_Ledger_Service::create_entry([
            'entry_type' => 'complimentary_pack_issued',
            'actor_type' => 'device',
            'actor_id' => $device_id,
            'amount' => 0, // No XP
            'metadata' => [
                'pack_type' => $pack_type,
                'quantity' => 10,
                'reference' => 'onboarding'
            ]
        ]);
        
        return $vouchers;
    }
}
```

**Acceptance Criteria:**
- [ ] One pack per device enforced
- [ ] 10 unique vouchers generated
- [ ] QR codes created
- [ ] Ledger entry written (amount = 0)
- [ ] Device flag updated

---

### Task 4.2: Voucher Status Lifecycle

**Requirements:**
- Track: Issued → Unused → Attached → Validated → Closed
- XP only created at Validated stage
- 2-scan process required

**Implementation:**
```php
// Seller scan (Scan 1)
public function attach_voucher_to_delivery($voucher_id, $device_id) {
    $voucher = $this->get_voucher($voucher_id);
    
    if ($voucher->status !== 'issued' && $voucher->status !== 'unused') {
        return new WP_Error('invalid_status', 'Voucher not available');
    }
    
    $voucher->update([
        'status' => 'attached',
        'seller_scan_at' => current_time('mysql')
    ]);
    
    return $voucher;
}

// Buyer scan (Scan 2) - XP minted here
public function validate_delivery($voucher_id, $buyer_device_id) {
    $voucher = $this->get_voucher($voucher_id);
    
    if ($voucher->status !== 'attached') {
        return new WP_Error('invalid_status', 'Voucher not attached');
    }
    
    // Update voucher
    $voucher->update([
        'status' => 'validated',
        'buyer_scan_at' => current_time('mysql'),
        'validated_at' => current_time('mysql')
    ]);
    
    // Mint XP (this is where XP is created)
    $xp_entry = HBC_XP_Ledger_Service::create_entry([
        'entry_type' => 'voucher_used',
        'actor_type' => 'device',
        'actor_id' => $voucher->device_id, // Seller gets XP
        'amount' => 1, // Or calculate based on delivery value
        'reference_id' => $voucher_id,
        'metadata' => [
            'buyer_device_id' => $buyer_device_id,
            'pack_type' => $voucher->pack_type
        ]
    ]);
    
    $voucher->update(['xp_entry_id' => $xp_entry->entry_id]);
    
    // Close voucher
    $voucher->update(['status' => 'closed']);
    
    return $xp_entry;
}
```

**Acceptance Criteria:**
- [ ] Status transitions enforced
- [ ] XP only minted on validation
- [ ] Both scans required
- [ ] Ledger entry links to voucher

---

### Task 4.3: Fulfillment Options

**Requirements:**
- Option A: Digital-first (PDF download)
- Option B: Physical mail (tracking)
- Separate from XP logic

**Implementation:**
```php
// Digital fulfillment
public function generate_pack_pdf($device_id) {
    $vouchers = $this->get_vouchers_by_device($device_id, 'issued');
    
    // Generate PDF with QR codes
    // Return download link
}

// Physical fulfillment (optional)
public function mark_pack_shipped($device_id, $tracking_number) {
    $device = HBC_Device_Service::get($device_id);
    $device->update([
        'fulfillment_status' => 'shipped',
        'tracking_number' => $tracking_number,
        'shipped_at' => current_time('mysql')
    ]);
}
```

**Acceptance Criteria:**
- [ ] PDF generation works
- [ ] QR codes scannable
- [ ] Physical tracking optional
- [ ] Fulfillment separate from XP

---

## Milestone 5: XP Ledger & Maturity System

### Task 5.1: Append-Only Ledger

**Requirements:**
- Every XP event writes one immutable row
- Hash chain: `immutable_hash = SHA256(entry_data + previous_hash)`
- No updates to amounts
- Only new entries + status changes

**Implementation:**
```php
// class-xp-ledger-service.php
class HBC_XP_Ledger_Service {
    public function create_entry($data) {
        global $wpdb;
        
        // Get previous hash
        $previous_entry = $wpdb->get_row(
            "SELECT immutable_hash FROM {$wpdb->prefix}hbc_xp_ledger ORDER BY entry_id DESC LIMIT 1"
        );
        $previous_hash = $previous_entry ? $previous_entry->immutable_hash : '';
        
        // Build entry data
        $entry_data = [
            'entry_type' => $data['entry_type'],
            'actor_type' => $data['actor_type'],
            'actor_id' => $data['actor_id'],
            'amount' => $data['amount'],
            'reference_id' => $data['reference_id'] ?? null,
            'metadata' => json_encode($data['metadata'] ?? []),
            'created_at' => current_time('mysql')
        ];
        
        // Create immutable hash
        $hash_input = json_encode($entry_data) . $previous_hash;
        $immutable_hash = hash('sha256', $hash_input);
        
        // Insert entry
        $wpdb->insert(
            $wpdb->prefix . 'hbc_xp_ledger',
            array_merge($entry_data, [
                'immutable_hash' => $immutable_hash,
                'previous_hash' => $previous_hash
            ])
        );
        
        return $wpdb->get_row("SELECT * FROM {$wpdb->prefix}hbc_xp_ledger WHERE entry_id = " . $wpdb->insert_id);
    }
}
```

**Acceptance Criteria:**
- [ ] Hash chain maintained
- [ ] No updates to existing entries
- [ ] Previous hash links correctly
- [ ] Immutability verified

---

### Task 5.2: Maturity Scheduler

**Requirements:**
- Daily cron job
- Find referrals where `maturity_date <= now` and `status = pending_maturity`
- Mark as matured
- Create ledger entry

**Implementation:**
```php
// WP-Cron hook
add_action('hbc_daily_maturity_check', 'hbc_process_maturity');

function hbc_process_maturity() {
    global $wpdb;
    
    $today = current_time('Y-m-d');
    
    // Find matured referrals
    $referrals = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}hbc_referrals 
         WHERE maturity_date <= %s 
         AND status = 'pending_maturity'",
        $today
    ));
    
    foreach ($referrals as $referral) {
        // Update referral status
        $wpdb->update(
            $wpdb->prefix . 'hbc_referrals',
            [
                'status' => 'matured',
                'matured_at' => current_time('mysql')
            ],
            ['referral_id' => $referral->referral_id]
        );
        
        // Create ledger entry
        HBC_XP_Ledger_Service::create_entry([
            'entry_type' => 'maturity_unlock',
            'actor_type' => 'wp_user',
            'actor_id' => $referral->referrer_wp_user_id,
            'amount' => $referral->xp_amount,
            'reference_id' => $referral->referral_id,
            'metadata' => [
                'referred_device_id' => $referral->referred_device_id
            ]
        ]);
    }
}

// Schedule daily
if (!wp_next_scheduled('hbc_daily_maturity_check')) {
    wp_schedule_event(time(), 'daily', 'hbc_daily_maturity_check');
}
```

**Acceptance Criteria:**
- [ ] Cron runs daily
- [ ] Matured referrals updated
- [ ] Ledger entries created
- [ ] No duplicates processed

---

### Task 5.3: Annual Close (Aug 31)

**Requirements:**
- Special job on August 31
- Waive maturity for completed actions
- Write ledger entry

**Implementation:**
```php
add_action('hbc_annual_close', 'hbc_process_annual_close');

function hbc_process_annual_close() {
    global $wpdb;
    
    // Find pending maturity referrals with completed actions
    $referrals = $wpdb->get_results(
        "SELECT r.* FROM {$wpdb->prefix}hbc_referrals r
         INNER JOIN {$wpdb->prefix}hbc_members m ON r.referred_device_id = m.device_id
         WHERE r.status = 'pending_maturity'
         AND m.status = 'active'"
    );
    
    foreach ($referrals as $referral) {
        // Waive maturity
        $wpdb->update(
            $wpdb->prefix . 'hbc_referrals',
            [
                'status' => 'matured',
                'matured_at' => current_time('mysql')
            ],
            ['referral_id' => $referral->referral_id]
        );
        
        // Create ledger entry
        HBC_XP_Ledger_Service::create_entry([
            'entry_type' => 'annual_close_adjustment',
            'actor_type' => 'system',
            'actor_id' => 'annual_close',
            'amount' => $referral->xp_amount,
            'reference_id' => $referral->referral_id,
            'metadata' => [
                'reason' => 'annual_close_waiver',
                'referred_device_id' => $referral->referred_device_id
            ]
        ]);
    }
}

// Schedule for Aug 31
function hbc_schedule_annual_close() {
    $year = date('Y');
    $aug_31 = strtotime("$year-08-31 23:59:59");
    
    if ($aug_31 > time()) {
        wp_schedule_single_event($aug_31, 'hbc_annual_close');
    }
}
```

**Acceptance Criteria:**
- [ ] Runs on Aug 31
- [ ] Waives maturity correctly
- [ ] Ledger entries created
- [ ] Only for completed actions

---

## Milestone 6: Referral System

### Task 6.1: Referral Tracking

**Requirements:**
- Capture referrer on device registration
- Store referral link/code
- Calculate XP amount (1/5/25 based on tier)
- Set maturity date (8-12 weeks)

**Implementation:**
```php
// class-referral-service.php
class HBC_Referral_Service {
    public function create_referral($referrer_user_id, $referred_device_id, $tier = 'yamer') {
        $xp_amounts = [
            'yamer' => 1,
            'megavoter' => 5,
            'patron' => 25
        ];
        
        $xp_amount = $xp_amounts[$tier] ?? 1;
        
        // Calculate maturity date (8-12 weeks)
        $weeks = rand(8, 12);
        $maturity_date = date('Y-m-d', strtotime("+$weeks weeks"));
        
        // Create referral
        global $wpdb;
        $wpdb->insert(
            $wpdb->prefix . 'hbc_referrals',
            [
                'referrer_wp_user_id' => $referrer_user_id,
                'referred_device_id' => $referred_device_id,
                'xp_amount' => $xp_amount,
                'maturity_date' => $maturity_date,
                'status' => 'pending_maturity',
                'created_at' => current_time('mysql')
            ]
        );
        
        // Create ledger entry (pending)
        HBC_XP_Ledger_Service::create_entry([
            'entry_type' => 'referral_award',
            'actor_type' => 'wp_user',
            'actor_id' => $referrer_user_id,
            'amount' => $xp_amount,
            'reference_id' => $wpdb->insert_id,
            'metadata' => [
                'status' => 'pending_maturity',
                'maturity_date' => $maturity_date,
                'referred_device_id' => $referred_device_id
            ]
        ]);
        
        return $wpdb->insert_id;
    }
}
```

**Acceptance Criteria:**
- [ ] Referral created on registration
- [ ] XP amount calculated correctly
- [ ] Maturity date set (8-12 weeks)
- [ ] Ledger entry written

---

## Milestone 7: Admin Panel

### Task 7.1: Admin Pages

**Required Pages:**

1. **Devices List**
   - Show all devices
   - Fraud signals (duplicate hashes, impossible geo jumps)
   - Filter by status, date range
   - Export CSV

2. **Members List**
   - Discord status
   - Role confirmation timestamps
   - Membership level
   - POC assignments
   - Export for GitHub access

3. **Referrals List**
   - Maturity queue
   - Status filter
   - XP amounts
   - Maturity dates

4. **XP Ledger Viewer**
   - Filter by user/device
   - Entry type filter
   - Date range
   - Hash chain verification

5. **Settings Page**
   - Discord Guild ID
   - Bot token (encrypted)
   - Referral XP amounts (1/5/25)
   - Maturity window (8-12 weeks)
   - Annual close date

**Acceptance Criteria:**
- [ ] All pages accessible
- [ ] Data displays correctly
- [ ] Filters work
- [ ] Exports functional
- [ ] Settings save securely

---

## Milestone 8: Frontend UI & Shortcodes

### Task 8.1: Shortcodes

**Required Shortcodes:**

1. `[hbc_enter]` - Enter Website / PoD gateway
2. `[hbc_register_device]` - Registration wizard
3. `[hbc_discord_connect]` - Connect Discord
4. `[hbc_dashboard]` - User dashboard
5. `[hbc_faq]` - FAQ content

**Implementation:**
```php
// Register shortcodes
add_shortcode('hbc_enter', 'hbc_shortcode_enter');
add_shortcode('hbc_register_device', 'hbc_shortcode_register');
add_shortcode('hbc_discord_connect', 'hbc_shortcode_discord');
add_shortcode('hbc_dashboard', 'hbc_shortcode_dashboard');
add_shortcode('hbc_faq', 'hbc_shortcode_faq');

function hbc_shortcode_enter($atts) {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/shortcode-enter.php';
    return ob_get_clean();
}
```

**UI Language Requirements:**
- Warm, human wording
- Show "three living roles" (Pledger, Confirmer, Ledger)
- Ledger entries as statements, not transactions
- Example: "A pledge was made." not "Transaction completed."

**Acceptance Criteria:**
- [ ] All shortcodes render
- [ ] Forms functional
- [ ] Human-centered language
- [ ] Responsive design

---

## Security & Compliance

### Requirements

1. **API Endpoints**
   - Nonce checks for logged-in actions
   - HMAC signature for Discord webhooks
   - Rate limiting per IP/device_hash

2. **Data Storage**
   - Hash sensitive data (IP, UA)
   - Encrypt bot tokens
   - Log geolocation consent

3. **Abuse Prevention**
   - One pack per device
   - Flag multiple devices from same person
   - Manual review capability

**Acceptance Criteria:**
- [ ] All endpoints secured
- [ ] Sensitive data hashed
- [ ] Rate limiting active
- [ ] Abuse prevention working

---

## Testing & Acceptance Criteria

### Test Scenarios

1. **Device Registration**
   - [ ] New device creates record
   - [ ] Geo-location captured
   - [ ] POC assigned
   - [ ] Complimentary pack issued

2. **Discord Integration**
   - [ ] OAuth flow works
   - [ ] Roles assigned
   - [ ] Status updated

3. **XP Ledger**
   - [ ] Entries immutable
   - [ ] Hash chain maintained
   - [ ] Maturity processes correctly

4. **Referral System**
   - [ ] Referrals tracked
   - [ ] Maturity dates set
   - [ ] XP awarded on maturity

5. **Admin Panel**
   - [ ] All pages load
   - [ ] Data displays correctly
   - [ ] Exports work

---

## Required Disclaimers

### Complimentary Voucher Notice

> "This 10-pack of vouchers or hang tags is provided solely to demonstrate and enable participation in the Proof-of-Delivery system. Vouchers do not represent money, credit, or a promise of payment. XP is recorded only when a voucher is later used and validated by both parties."

### Dashboard Tooltip

> "This is onboarding infrastructure, not a reward or payment."

---

## Development Priority

**Phase 1 (Critical):**
1. Plugin foundation
2. Database schema
3. Device registration
4. Basic XP ledger

**Phase 2 (Essential):**
5. Discord integration
6. Complimentary pack system
7. Referral system

**Phase 3 (Important):**
8. Maturity scheduler
9. Admin panel
10. Frontend shortcodes

**Phase 4 (Enhancement):**
11. Annual close
12. GitHub access flags
13. Advanced fraud detection

---

## Notes for Developers

- **XP is NOT money** - Always display as measurement units
- **Append-only** - Never update ledger entries, only create new ones
- **Privacy-first** - Hash all sensitive data
- **One pack per device** - Enforce strictly
- **Human language** - Use warm, personified wording in UI

---

**End of Requirements Document**
