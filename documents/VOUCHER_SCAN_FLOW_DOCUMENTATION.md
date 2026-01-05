# Voucher/Hang-Tag Scan Experience Flow
## Complete System Flow Documentation

---

## 📋 Overview

This document details the complete user journey from scanning a YAM-is-ON voucher/hang-tag QR code through device activation, delivery confirmation, and XP ledger entry. The flow is designed for mobile-first, 5-second comprehension, with clear boundaries between ledger (non-custodial) and VFN (custodial).

---

## 🎯 System Architecture Principles

### **Non-Negotiable Truths:**
- **d-DAO General Ledger** = non-custodial (verification + XP accounting only)
- **VFN** = sole custodial network for fiat/MSB activities
- **XP** = loyalty accounting only (not money, not transferable, not redeemable on demand)
- **No money flows** through the ledger layer
- **2-scan requirement**: STXID minted at Scan 1, XP only after Scan 2

---

## 📱 Complete User Flow

### **Screen 0: Scan Landing (Implicit Entry Point)**

**URL Pattern:** `/pod?voucher_id=XXXX`

**What Happens:**
- User scans QR code on voucher/hang-tag
- QR code resolves to: `/pod?voucher_id=XXXX`
- System extracts `voucher_id` from URL parameter

**UI Elements:**
- **Header (small):** "YAM-is-ON Delivery"
- **Sub-header:** "You're scanning a delivery credential."

**Backend Process:**
1. Validate `voucher_id` exists in database
2. Check voucher status (active, expired, used)
3. Load voucher metadata (seller, product, timestamp)
4. Redirect to Screen 1 (Gate 1)

**Database Query:**
```sql
SELECT * FROM wp_hb_vouchers 
WHERE voucher_id = ? AND status = 'active'
```

---

### **Screen 1: Gate 1 (Intent Filter)**

**Purpose:** Filter out casual browsers from actual delivery confirmations

**UI Elements:**
- **Question:** "Is this Proof of Delivery?"
- **Subtext:** "Choose YES only if you are confirming a real delivery or handoff."
- **Buttons:**
  - `YES — Confirm Delivery`
  - `NO — Just Looking`
- **Footer (small, muted):** "No money. No obligation. Just truth."

**User Actions:**
- **YES** → Proceed to Screen 2 (Gate 2)
- **NO** → Redirect to home page (`/`) - **NO ledger event**

**Backend Process (YES):**
1. Store intent: `intent = 'proof_of_delivery'`
2. Store voucher_id in session
3. Redirect to Screen 2

**Backend Process (NO):**
1. Clear session data
2. Redirect to home page
3. **No database writes**
4. **No ledger events**

**Code Logic:**
```php
if ($user_choice === 'YES') {
    $_SESSION['pod_intent'] = true;
    $_SESSION['voucher_id'] = $voucher_id;
    redirect('/pod/gate-2');
} else {
    clear_session();
    redirect('/');
}
```

---

### **Screen 2: Gate 2 (Location Classification)**

**Purpose:** Classify whether this is final destination or in-transit handoff

**UI Elements:**
- **Question:** "Is this the final destination?"
- **Subtext:** "Choose what best describes this moment."
- **Buttons:**
  - `YES — Delivered to recipient`
  - `NO — In route / handoff`
- **Helper text (small):** "Every confirmed step matters."

**User Actions:**
- **YES** → Final destination → Proceed to Screen 3
- **NO** → In-transit handoff → Proceed to Screen 3 (different flow)

**Backend Process:**
1. Store location classification: `location_type = 'final' | 'handoff'`
2. Check device registration status
3. Redirect to Screen 3

**Database Action:**
```sql
UPDATE wp_hb_pod_sessions SET
  location_type = ?,
  updated_at = NOW()
WHERE session_id = ?
```

**Code Logic:**
```php
$location_type = ($user_choice === 'YES') ? 'final' : 'handoff';
$_SESSION['location_type'] = $location_type;
redirect('/pod/device-status');
```

---

### **Screen 3: Device Status (Conditional Branch)**

**Purpose:** Check if device is registered; branch accordingly

#### **Branch A: Device Already Registered**

**UI Elements:**
- **Message:** "Delivery recorded."
- **Toast/Confirmation:** "1 New World Penny earned"
- **Footer (small):** "Thank you for moving value forward."

**Backend Process:**
1. Retrieve device from fingerprint
2. Check device status: `validated` and `active`
3. Check if this is Scan 1 or Scan 2:
   - **Scan 1 (Seller):** Mint STXID, create PoD record
   - **Scan 2 (Buyer):** Complete PoD, create XP ledger entries
4. Display success message
5. Redirect to completion screen

**Database Actions:**
```sql
-- For Scan 1 (Seller)
INSERT INTO wp_hb_pod_records (
  voucher_id, device_id, seller_txn_id, scan_type, 
  location_type, status, created_at
) VALUES (?, ?, ?, 'seller', ?, 'initiated', NOW());

-- For Scan 2 (Buyer)
UPDATE wp_hb_pod_records SET
  buyer_device_id = ?,
  buyer_scan_at = NOW(),
  status = 'completed'
WHERE seller_txn_id = ?;

-- Create XP ledger entries
INSERT INTO wp_hb_xp_ledger (
  seller_txn_id, xp_type, amount, status, created_at
) VALUES 
  (?, 'rebate', 5, 'pending', NOW()),
  (?, 'emergency', 4, 'pending', NOW()),
  (?, 'patronage', 1, 'pending', NOW());
```

#### **Branch B: Device Not Registered**

**UI Elements:**
- **Message:** "To record this delivery, activate this device."
- **Subtext:** "Your phone becomes your delivery identity. No account. No wallet."
- **Button:** "Activate This Device"
- **Footer (small):** "Takes about 30 seconds."

**Backend Process:**
1. Generate device fingerprint
2. Check if fingerprint exists → if yes, redirect to device status
3. If new, redirect to Screen 4 (Device Activation)

**Code Logic:**
```php
$device_fingerprint = generate_device_fingerprint();
$device = get_device_by_fingerprint($device_fingerprint);

if ($device && $device['status'] === 'validated') {
    // Device exists and is validated
    redirect('/pod/record-delivery');
} else {
    // New device or not validated
    $_SESSION['device_fingerprint'] = $device_fingerprint;
    redirect('/activate-device');
}
```

---

### **Screen 4: Device Activation (One-Time)**

**Purpose:** Register device for first-time users

**UI Elements:**
- **Heading:** "Activate this device"
- **Description:** "This device will be used to confirm delivery events you participate in."
- **Checkbox (required):** ☑ "I understand one device equals one human voice."
- **Button:** "Confirm & Continue"
- **Footer (small):** "Location and time are used only to confirm delivery."

**User Actions:**
1. User reads information
2. User checks required checkbox
3. User clicks "Confirm & Continue"

**Backend Process:**
1. Validate checkbox is checked
2. Capture geolocation (with user permission)
3. Generate device fingerprint
4. Store device registration
5. Update device status: `pending` → `activating`
6. Store location data (latitude, longitude, city, state, country)
7. Redirect to Screen 5 (Discord Connection)

**Database Actions:**
```sql
INSERT INTO wp_hb_devices (
  device_fingerprint, status, activated_at,
  location_lat, location_lng, location_city, 
  location_state, location_country, activation_ip,
  created_at
) VALUES (?, 'activating', NOW(), ?, ?, ?, ?, ?, ?, NOW());
```

**API Endpoint:**
```
POST /wp-json/hb/v1/device/register
POST /wp-json/hb/v1/device/activate
```

**Code Logic:**
```php
if (!isset($_POST['device_agreement'])) {
    return error('Checkbox must be checked');
}

$device_data = [
    'device_fingerprint' => generate_device_fingerprint(),
    'latitude' => $_POST['latitude'],
    'longitude' => $_POST['longitude'],
    'city' => $_POST['city'],
    'state' => $_POST['state'],
    'country' => $_POST['country'],
];

$device = register_device($device_data);
activate_device($device['id'], $device_data);

redirect('/activate-device-step-2?device_id=' . $device['id']);
```

---

### **Screen 5: Discord Connection (Gracebook)**

**Purpose:** Connect device to Discord for role assignment and community coordination

**UI Elements:**
- **Heading:** "Connect to the Gracebook"
- **Description:** "This is where delivery confirmations, roles, and community coordination happen."
- **Button:** "Accept Discord Invite"
- **Helper text (small):** "Required to complete Proof of Delivery."

**User Actions:**
1. User clicks "Accept Discord Invite"
2. Redirected to Discord OAuth
3. User authorizes connection
4. Redirected back to callback URL

**Backend Process:**
1. Generate Discord OAuth URL
2. Store OAuth state in session
3. Redirect to Discord authorization
4. On callback:
   - Validate OAuth state
   - Exchange code for access token
   - Retrieve Discord user info
   - Assign Discord role based on device status
   - Store Discord mapping
   - Update device: `discord_connected = true`
   - Redirect to Screen 6

**Database Actions:**
```sql
INSERT INTO wp_hb_discord_mappings (
  device_id, discord_user_id, discord_username,
  discord_role, connected_at
) VALUES (?, ?, ?, ?, NOW());

UPDATE wp_hb_devices SET
  discord_connected = true,
  updated_at = NOW()
WHERE id = ?;
```

**API Endpoints:**
```
GET /wp-json/hb/v1/discord/auth-url?device_id=X
GET /wp-json/hb/v1/discord/callback?code=XXX&state=YYY
```

**Code Logic:**
```php
// Generate auth URL
$auth_url = Discord_Service::get_authorization_url($device_id);
redirect($auth_url);

// On callback
$discord_user = Discord_Service::handle_callback($code, $state);
Discord_Service::assign_role($discord_user['id'], $device_id);
redirect('/activate-device-step-4?device_id=' . $device_id);
```

---

### **Screen 6: Membership Selection**

**Purpose:** Select participation tier (affects POC assignment and XP allocation)

**UI Elements:**
- **Heading:** "Choose your participation level"
- **Subtext:** "You can change this later."
- **Options:**
  - **YAM'er — Free** - "Participate in Proof of Delivery."
  - **MEGAvoter — Annual** - "Guide social impact decisions."
  - **Patron — Monthly** - "Support and scale the network."
- **Button:** "Continue"
- **Footer (small):** "Referral recognition is issued annually in XP on September 1."

**User Actions:**
1. User selects membership tier
2. User clicks "Continue"

**Backend Process:**
1. Store membership selection
2. Update device: `membership_tier = 'yamer' | 'megavoter' | 'patron'`
3. Trigger Serendipity POC assignment:
   - Assign Buyer POC (local, based on geo-location)
   - Assign Seller POC (out-of-state/global, based on timestamp)
4. Redirect to Screen 7

**Database Actions:**
```sql
UPDATE wp_hb_devices SET
  membership_tier = ?,
  updated_at = NOW()
WHERE id = ?;

-- Serendipity POC Assignment
INSERT INTO wp_hb_poc_buyer_pocs (device_id, poc_id, assigned_at)
VALUES (?, ?, NOW());

INSERT INTO wp_hb_poc_seller_pocs (device_id, poc_id, assigned_at)
VALUES (?, ?, NOW());
```

**API Endpoint:**
```
POST /wp-json/hb/v1/device/{id}/membership
```

**Code Logic:**
```php
$membership_tier = $_POST['membership_tier'];
update_device_membership($device_id, $membership_tier);

// Serendipity assignment
$buyer_poc = Serendipity_Service::assign_buyer_poc($device_id);
$seller_poc = Serendipity_Service::assign_seller_poc($device_id);

redirect('/activate-device-complete?device_id=' . $device_id);
```

---

### **Screen 7: Completion**

**Purpose:** Confirm device is live and ready for PoD

**UI Elements:**
- **Message:** "You're live"
- **Subtext:** "This device is now enabled for Proof of Delivery."
- **Buttons:**
  - "Return to Delivery"
  - "View My Device"
- **Footer (small):** "Any redemption is handled by the Voluntary Fulfillment Network."

**User Actions:**
1. User clicks "Return to Delivery" → Returns to Screen 3 (Device Status) to complete PoD
2. User clicks "View My Device" → Redirects to `/my-device`

**Backend Process:**
1. Update device status: `activating` → `validated`
2. Mark device as ready for PoD
3. Complete registration flow
4. If coming from voucher scan, return to PoD flow

**Database Actions:**
```sql
UPDATE wp_hb_devices SET
  status = 'validated',
  registration_completed_at = NOW(),
  updated_at = NOW()
WHERE id = ?;
```

**API Endpoint:**
```
POST /wp-json/hb/v1/device/{id}/complete
```

**Code Logic:**
```php
complete_device_registration($device_id);

if (isset($_SESSION['voucher_id'])) {
    // Return to PoD flow
    redirect('/pod/device-status?voucher_id=' . $_SESSION['voucher_id']);
} else {
    redirect('/my-device');
}
```

---

## 🔄 Complete Flow Diagram

```
QR Code Scan
    ↓
Screen 0: Scan Landing (/pod?voucher_id=XXXX)
    ↓
Screen 1: Gate 1 (Intent Filter)
    ├─ YES → Screen 2
    └─ NO → Home Page (no ledger event)
    ↓
Screen 2: Gate 2 (Location Classification)
    ├─ YES (Final) → Screen 3
    └─ NO (Handoff) → Screen 3
    ↓
Screen 3: Device Status Check
    ├─ Device Registered → Record Delivery → XP Ledger Entry
    └─ Device Not Registered → Screen 4
        ↓
    Screen 4: Device Activation
        ↓
    Screen 5: Discord Connection
        ↓
    Screen 6: Membership Selection
        ↓
    Screen 7: Completion → Return to Screen 3
        ↓
    Record Delivery → XP Ledger Entry
```

---

## 🗄️ Database Schema (Key Tables)

### **wp_hb_devices**
- Device registration and status
- Geo-location data
- Membership tier
- Discord connection status

### **wp_hb_pod_records**
- 2-scan Proof of Delivery records
- Seller Transaction ID (STXID)
- Scan 1 (seller) and Scan 2 (buyer) timestamps
- Location classification

### **wp_hb_xp_ledger**
- XP entries (rebate, emergency, patronage)
- Status (pending, matured)
- Maturity window (8-12 weeks)

### **wp_hb_vouchers**
- Voucher/hang-tag records
- Status (active, expired, used)
- Associated seller and product

### **wp_hb_poc_buyer_pocs**
- Buyer POC assignments (local)
- Based on geo-location

### **wp_hb_poc_seller_pocs**
- Seller POC assignments (out-of-state/global)
- Based on timestamp priority

---

## 🔐 Security & Validation Rules

### **Device Registration:**
- One device = one human voice (enforced by fingerprint)
- Device fingerprint is immutable
- Cannot register same device twice

### **2-Scan PoD:**
- **STXID minted at Scan 1** (seller scan)
- **No XP ledger entries until Scan 2** (buyer scan)
- Both scans must be from different devices
- Voucher can only be used once

### **XP Ledger:**
- Append-only (no edits, no deletions)
- Entries mature after 8-12 weeks
- XP is loyalty accounting only (not money)

### **VFN Separation:**
- No payment APIs in ledger layer
- No balances or wallets
- No transfer logic
- All fiat/crypto redemption handled by VFN

---

## 📊 XP Ledger Entry Rules

### **When XP Entries Are Created:**
- **Only after Scan 2 (Buyer Confirmation)**
- **Never at Scan 1 (Seller Initiation)**

### **XP Allocation (per $10 YAM JAM):**
- **$5** → Buyer Rebate XP (`xp_type = 'rebate'`)
- **$4** → Emergency Resource XP (`xp_type = 'emergency'`)
- **$1** → Patronage XP (`xp_type = 'patronage'`)

### **XP Maturity:**
- Status: `pending` → `matured` (after 8-12 weeks)
- XP entries are visible but not redeemable until matured
- Redemption handled by VFN (outside ledger)

---

## 🎯 Key Decision Points

### **1. Intent Filter (Screen 1)**
- **YES** → Continue to PoD flow
- **NO** → Exit (no ledger event)

### **2. Location Classification (Screen 2)**
- **YES (Final)** → Complete delivery
- **NO (Handoff)** → Record intermediate step

### **3. Device Status (Screen 3)**
- **Registered** → Record delivery immediately
- **Not Registered** → Device activation flow

---

## 🔄 Return to PoD Flow

After device activation completes (Screen 7), if user came from voucher scan:

1. Return to Screen 3 (Device Status)
2. Device is now registered → Record delivery
3. Complete 2-scan PoD process
4. Create XP ledger entries

**Code Logic:**
```php
// Store voucher context during activation
$_SESSION['voucher_id'] = $voucher_id;
$_SESSION['return_to_pod'] = true;

// After activation complete
if (isset($_SESSION['return_to_pod'])) {
    redirect('/pod/device-status?voucher_id=' . $_SESSION['voucher_id']);
}
```

---

## 📱 Mobile-First Design Principles

### **5-Second Comprehension:**
- Clear, single-purpose screens
- Minimal text, maximum clarity
- Large touch targets
- Immediate feedback

### **No Money Language:**
- Never says "sign up"
- Never mentions money at decision points
- Frames truth-telling as the action
- Keeps redemption clearly out of band (VFN)

### **Error Handling:**
- One-line fallback: "This delivery can't be recorded right now. You can still learn how the system works."
- Graceful degradation
- Clear error messages

---

## 🚀 Implementation Checklist

### **Frontend:**
- [ ] Screen 0: Scan Landing page
- [ ] Screen 1: Gate 1 (Intent Filter)
- [ ] Screen 2: Gate 2 (Location Classification)
- [ ] Screen 3: Device Status (conditional)
- [ ] Screen 4: Device Activation
- [ ] Screen 5: Discord Connection
- [ ] Screen 6: Membership Selection
- [ ] Screen 7: Completion

### **Backend:**
- [ ] Voucher validation endpoint
- [ ] Device registration endpoints
- [ ] PoD record creation
- [ ] 2-scan validation logic
- [ ] XP ledger entry creation
- [ ] Serendipity POC assignment
- [ ] Discord OAuth integration

### **Database:**
- [ ] Voucher table
- [ ] PoD records table
- [ ] XP ledger table
- [ ] Device registration table
- [ ] POC assignment tables

---

## 📝 Notes

- **STXID** (Seller Transaction ID) is minted only at Scan 1
- **XP entries** are created only after Scan 2
- **No money flows** through the ledger
- **VFN handles** all fiat/crypto redemption
- **XP is loyalty accounting** only (not money, not transferable)

---

**Last Updated:** [Current Date]
**Version:** 1.0
**Status:** Ready for Implementation

