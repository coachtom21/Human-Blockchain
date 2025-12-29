# Device Registration Flow
## HumanBlockchain.info - Complete User Journey

---

## 📱 OVERVIEW

Device registration is the foundation of the HumanBlockchain system. Each device represents "one human voice" and enables participation in the 2-scan Proof-of-Delivery (PoD) system.

---

## 🔄 COMPLETE REGISTRATION FLOW

### **Entry Point: User Arrives at Site**

```
User visits humanblockchain.info
    ↓
Entry Modal appears (popup)
    ↓
User clicks "Enter Website"
    ↓
POD Gate Modal appears
    ↓
User clicks "NO — Continue to Website"
    ↓
User lands on home page (Serendipity content)
```

---

## 🚀 DEVICE REGISTRATION FLOW (Primary Path)

### **Step 1: User Initiates Registration**

**Trigger:** User clicks "Activate Device" button (from home page or scan flow)

**Screen:** Device Activation Landing
- URL: `/activate-device`
- Content: Introduction to device activation
- CTA: "Start Activation" button

---

### **Step 2: Device Fingerprinting**

**Backend Process:**
1. **Generate Device Fingerprint**
   - Collect device characteristics:
     - User Agent
     - Screen resolution
     - Timezone
     - Language
     - Browser plugins (if available)
     - Canvas fingerprint (optional)
   - Create unique hash: `device_fingerprint = hash(device_characteristics)`
   - Check if device already exists in database

2. **Check Existing Registration**
   - Query `devices` table by `device_fingerprint`
   - If found:
     - Check status (validated, suspended, etc.)
     - Redirect to device dashboard if active
     - Show reactivation screen if suspended
   - If not found:
     - Proceed to Step 3

**Database Action:**
```sql
INSERT INTO devices (
  device_fingerprint,
  status,              -- 'pending'
  created_at,
  user_agent,
  screen_resolution,
  timezone,
  language
) VALUES (...)
```

---

### **Step 3: Device Activation Screen**

**Screen 4 from Scan Flow (if coming from PoD)**
**OR**
**Standalone Activation Page (if from "Activate Device" button)**

**UI Elements:**
- Heading: "Activate this device"
- Description: "This device will be used to confirm delivery events you participate in."
- **Required Checkbox:** ☑ "I understand one device equals one human voice."
- Button: "Confirm & Continue"
- Footer: "Location and time are used only to confirm delivery."

**User Actions:**
1. User reads information
2. User checks required checkbox
3. User clicks "Confirm & Continue"

**Backend Process:**
1. Validate checkbox is checked
2. Capture geolocation (with user permission)
3. Store activation timestamp
4. Update device status: `pending` → `activating`
5. Store location data (latitude, longitude, city, state, country)

**Database Action:**
```sql
UPDATE devices SET
  status = 'activating',
  activated_at = NOW(),
  location_lat = ?,
  location_lng = ?,
  location_city = ?,
  location_state = ?,
  location_country = ?,
  activation_ip = ?
WHERE device_fingerprint = ?
```

---

### **Step 4: QRtiger v-Card Validation**

**Screen:** v-Card Validation Request

**UI Elements:**
- Heading: "Validate Your Identity"
- Description: "QRtiger v-card is required for participation. This validates your device and enables ledger access."
- Input: QR code scanner or manual entry
- Button: "Scan v-Card" or "Enter v-Card Hash"
- Helper text: "Only hash and minimal metadata are stored (PII minimization)."

**User Actions:**
1. User scans QRtiger v-card QR code
   - OR manually enters v-card identifier
2. System validates v-card via QRtiger API
3. System extracts hash and minimal metadata

**Backend Process:**
1. **QRtiger API Integration**
   - Call QRtiger API to validate v-card
   - Extract v-card hash
   - Extract minimal metadata (no PII)
   - Store validation result

2. **Database Storage**
```sql
INSERT INTO qrtiger_vcards (
  device_id,
  vcard_hash,          -- Hash only, no PII
  status,              -- 'pending'
  qrtiger_reference,
  metadata,             -- Minimal, non-PII data
  created_at
) VALUES (...)
```

3. **Validation Workflow**
   - Status: `pending` → `validating` → `validated` or `rejected`
   - If validated: Update device status
   - If rejected: Show error, allow retry

**Database Update:**
```sql
UPDATE qrtiger_vcards SET
  status = 'validated',
  validated_at = NOW()
WHERE device_id = ? AND vcard_hash = ?

UPDATE devices SET
  vcard_status = 'validated'
WHERE id = ?
```

---

### **Step 5: Discord Connection (Gracebook)**

**Screen 5 from Scan Flow**

**UI Elements:**
- Heading: "Connect to the Gracebook"
- Description: "This is where delivery confirmations, roles, and community coordination happen."
- Button: "Accept Discord Invite"
- Helper text: "Required to complete Proof of Delivery."

**User Actions:**
1. User clicks "Accept Discord Invite"
2. OAuth flow redirects to Discord
3. User authorizes application
4. Discord redirects back with authorization code

**Backend Process:**
1. **Discord OAuth Flow**
   - Redirect to Discord OAuth URL
   - User authorizes on Discord
   - Discord redirects back with `code`
   - Exchange `code` for access token
   - Fetch Discord user info (user ID, username)

2. **Store Discord Mapping**
```sql
INSERT INTO discord_mappings (
  device_id,
  discord_user_id,
  discord_username,
  connected_at,
  access_token_hash  -- Store hashed, not plain
) VALUES (...)
```

3. **Failure Handling**
   - If Discord API fails: Log error, queue for retry
   - Don't block registration, but mark as "discord_pending"
   - Allow user to retry later

---

### **Step 6: Membership Selection**

**Screen 6 from Scan Flow**

**UI Elements:**
- Heading: "Choose your participation level"
- Subtext: "You can change this later."
- Options:
  - **YAM'er** — Free
    - Description: "Participate in Proof of Delivery."
  - **MEGAvoter** — Annual
    - Description: "Guide social impact decisions."
  - **Patron** — Monthly
    - Description: "Support and scale the network."
- Button: "Continue"
- Footer: "Referral recognition is issued annually in XP on September 1."

**User Actions:**
1. User selects membership tier
2. User clicks "Continue"

**Backend Process:**
1. Store membership selection
```sql
UPDATE devices SET
  membership_tier = ?,  -- 'yamer', 'megavoter', 'patron'
  membership_selected_at = NOW()
WHERE id = ?
```

2. Trigger POC Assignment (Serendipity Protocol)
   - See Step 7

---

### **Step 7: Serendipity POC Assignment**

**Backend Process (Automatic):**

1. **Buyer POC Assignment (Local)**
   - Use device's geolocation (from Step 3)
   - Find or create Buyer POC in same region
   - Max 30 members per Buyer POC
   - Assign based on timestamp (newest registrations fill next open seats)
   - If POC is full, create new POC

```sql
-- Find or create Buyer POC
SELECT id FROM buyer_pocs 
WHERE region = ? AND member_count < 30
ORDER BY created_at DESC
LIMIT 1

-- If not found, create new
INSERT INTO buyer_pocs (region, created_at) VALUES (?, NOW())

-- Assign device to Buyer POC
INSERT INTO poc_memberships (
  device_id,
  poc_id,
  poc_type,  -- 'buyer'
  assigned_at
) VALUES (?, ?, 'buyer', NOW())
```

2. **Seller POC Assignment (Out-of-state/Global)**
   - Assign away from device's locality
   - Find or create Seller POC (global, branch-based)
   - Max 5 sellers per Seller POC
   - Assign slot index (0-4) based on registration timestamp
   - Only for MEGAvoter and Patron tiers

```sql
-- Find or create Seller POC (out-of-state/global)
SELECT id FROM seller_pocs 
WHERE region != ? AND member_count < 5
ORDER BY created_at DESC
LIMIT 1

-- Assign device to Seller POC
INSERT INTO poc_memberships (
  device_id,
  poc_id,
  poc_type,  -- 'seller'
  slot_index,  -- 0-4
  assigned_at
) VALUES (?, ?, 'seller', ?, NOW())
```

3. **Peace Pentagon Branch Assignment**
   - Use time-based serendipity (CRC32 hash of device_id + timestamp)
   - Assign to one of 5 branches:
     - Planning
     - Budget
     - Media
     - Distribution
     - Membership

```sql
UPDATE devices SET
  peace_pentagon_branch = ?  -- Calculated from hash
WHERE id = ?
```

4. **Discord Role Assignment**
   - Based on device validation status
   - Based on v-card validation status
   - Based on membership tier
   - Call Discord API to assign role

```sql
-- Discord role assignment (via API)
POST /discord/api/guilds/{guild_id}/members/{user_id}/roles
```

---

### **Step 8: Registration Completion**

**Screen 7 from Scan Flow**

**UI Elements:**
- Heading: "You're live"
- Message: "This device is now enabled for Proof of Delivery."
- Buttons:
  - "Return to Delivery" (if came from PoD flow)
  - "View My Device"
- Footer: "Any redemption is handled by the Voluntary Fulfillment Network."

**Backend Process:**
1. Update device status to `validated`
```sql
UPDATE devices SET
  status = 'validated',
  validated_at = NOW()
WHERE id = ?
```

2. Create welcome XP entry (optional, for onboarding)
```sql
INSERT INTO xp_ledger_entries (
  device_id,
  type,           -- 'create'
  category,       -- 'other'
  xp_amount,      -- 0 or small welcome amount
  note,           -- 'Device activation welcome'
  created_at
) VALUES (?, 'create', 'other', 0, 'Device activation', NOW())
```

---

## 🔄 ALTERNATIVE FLOWS

### **Flow A: Registration from PoD Scan**

```
User scans QR code → /pod?voucher_id=XXXX
    ↓
Screen 0: Scan Landing
    ↓
Screen 1: Gate 1 (Intent Filter)
    - User clicks "YES — Confirm Delivery"
    ↓
Screen 2: Gate 2 (Location Classification)
    - User selects "YES — Delivered to recipient"
    ↓
Screen 3: Device Status Check
    - System checks if device is registered
    - If NOT registered → Screen 4 (Device Activation)
    - If registered → Show "Delivery recorded" message
```

### **Flow B: Direct Device Activation**

```
User clicks "Activate Device" from home page
    ↓
Device Activation Landing Page
    ↓
Step 2: Device Fingerprinting
    ↓
Step 3: Device Activation Screen
    ↓
Step 4: QRtiger v-Card Validation
    ↓
Step 5: Discord Connection
    ↓
Step 6: Membership Selection
    ↓
Step 7: Serendipity POC Assignment
    ↓
Step 8: Registration Completion
```

---

## 🗄️ DATABASE SCHEMA

### **devices Table**
```sql
CREATE TABLE devices (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  device_fingerprint VARCHAR(255) UNIQUE NOT NULL,
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
  INDEX idx_fingerprint (device_fingerprint),
  INDEX idx_status (status),
  INDEX idx_location (location_country, location_state)
);
```

### **qrtiger_vcards Table**
```sql
CREATE TABLE qrtiger_vcards (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  device_id BIGINT NOT NULL,
  vcard_hash VARCHAR(255) UNIQUE NOT NULL,
  status ENUM('pending', 'validating', 'validated', 'rejected') DEFAULT 'pending',
  qrtiger_reference VARCHAR(255),
  metadata JSON,  -- Minimal, non-PII data
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  validated_at TIMESTAMP NULL,
  FOREIGN KEY (device_id) REFERENCES devices(id),
  INDEX idx_device (device_id),
  INDEX idx_hash (vcard_hash),
  INDEX idx_status (status)
);
```

### **discord_mappings Table**
```sql
CREATE TABLE discord_mappings (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  device_id BIGINT NOT NULL,
  discord_user_id VARCHAR(255) UNIQUE NOT NULL,
  discord_username VARCHAR(255),
  role VARCHAR(100),
  connected_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  access_token_hash VARCHAR(255),  -- Hashed, not plain
  FOREIGN KEY (device_id) REFERENCES devices(id),
  INDEX idx_device (device_id),
  INDEX idx_discord_user (discord_user_id)
);
```

### **poc_memberships Table**
```sql
CREATE TABLE poc_memberships (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  device_id BIGINT NOT NULL,
  poc_id BIGINT NOT NULL,
  poc_type ENUM('buyer', 'seller') NOT NULL,
  slot_index TINYINT,  -- 0-4 for seller POCs
  assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (device_id) REFERENCES devices(id),
  INDEX idx_device (device_id),
  INDEX idx_poc (poc_id, poc_type)
);
```

---

## 🔐 VALIDATION RULES

### **Device Validation Requirements**
1. ✅ Device fingerprint must be unique
2. ✅ Activation checkbox must be checked
3. ✅ Geolocation must be captured (with permission)
4. ✅ QRtiger v-card must be validated
5. ✅ Discord connection must be established (or queued)
6. ✅ Membership tier must be selected

### **Gate Checks (Before PoD Actions)**
- Device status must be `validated`
- v-card status must be `validated`
- Device must not be `suspended` or `rejected`

---

## ⚠️ ERROR HANDLING

### **Common Scenarios**

1. **Device Already Registered**
   - Check device fingerprint
   - If found and validated → Redirect to device dashboard
   - If found and suspended → Show suspension message
   - If found and pending → Continue activation

2. **QRtiger v-Card Validation Fails**
   - Show error message
   - Allow retry
   - Store rejection reason
   - Don't block registration, but mark as `vcard_pending`

3. **Discord API Failure**
   - Log error
   - Queue for retry
   - Mark as `discord_pending`
   - Allow user to complete registration
   - Show "Connect Discord later" option

4. **Geolocation Denied**
   - Use IP-based location (less accurate)
   - Show warning message
   - Allow manual location entry (optional)

5. **POC Assignment Failure**
   - Retry assignment
   - Create new POC if needed
   - Log error for admin review

---

## 📊 STATUS FLOW DIAGRAM

```
[pending]
    ↓
[activating] ← User confirms activation
    ↓
[vcard_validating] ← QRtiger validation in progress
    ↓
[discord_connecting] ← Discord OAuth in progress
    ↓
[validated] ← All checks passed
    ↓
[suspended] ← Admin action (can be reactivated)
[rejected] ← Permanent rejection
```

---

## 🎯 SUCCESS CRITERIA

Registration is considered **complete** when:
1. ✅ Device record created with unique fingerprint
2. ✅ Device status = `validated`
3. ✅ QRtiger v-card validated
4. ✅ Discord connected (or queued)
5. ✅ Membership tier selected
6. ✅ Buyer POC assigned
7. ✅ Seller POC assigned (if MEGAvoter/Patron)
8. ✅ Peace Pentagon branch assigned
9. ✅ Discord role assigned

---

## 🔄 POST-REGISTRATION

After successful registration:
- Device can participate in PoD scans
- Device can earn XP
- Device can view NIL performance records
- Device can participate in referral system
- Device appears in POC member lists
- Device receives Discord role-based access

---

## 📝 NOTES

- **One Device = One Human Voice**: This is a core principle. Each device represents one participant.
- **PII Minimization**: Only v-card hash and minimal metadata are stored. No personal information.
- **Non-Custodial**: The system does not custody money. All fiat/crypto redemption handled by VFN.
- **Immutability**: Once validated, device records cannot be edited (only new entries for corrections).
- **Serendipity**: POC assignment is automatic based on geo-location and timestamp (no human gatekeeping).

