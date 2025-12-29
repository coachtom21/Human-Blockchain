# QRtiger v-Card Validation Explained

## Overview

The **QRtiger v-Card Validation** is **Step 2** of the device activation flow. It serves as a **validator credential** that:
- Validates device identity
- Enables ledger access (unvalidated devices cannot write ledger events)
- Minimizes PII (only hash and minimal metadata stored)
- Acts as a required credential for participation

---

## Why v-Card Validation?

According to the project requirements:

> **QRtiger v-card is mandatory for participation**
> - Acts as a validator credential for:
>   - Device registration
>   - Discord Gracebook role assignment
>   - PoD eligibility
> - Store hash + minimal metadata only (PII minimization)
> - **Unvalidated devices cannot write ledger events**

This means:
- ✅ **Validated devices** → Can participate in Proof of Delivery, earn XP, write to ledger
- ❌ **Unvalidated devices** → Blocked from PoD actions and ledger writes

---

## How It Works

### **Step-by-Step Flow**

```
1. User completes Step 1 (Device Activation)
   ↓
2. Redirected to /activate-device-step-2?device_id=X
   ↓
3. User enters/scans QRtiger v-card hash
   ↓
4. Frontend sends POST to /wp-json/hb/v1/vcard/validate
   ↓
5. Backend validates via QRtiger API (or placeholder)
   ↓
6. v-Card stored in database (hash only, no PII)
   ↓
7. Device status updated: vcard_status = 'validated'
   ↓
8. Redirect to Step 3 (Discord Connection)
```

---

## Technical Implementation

### **1. Frontend (template-activate-device-step-2.php)**

**What the user sees:**
- Input field for v-card hash (or QR scanner)
- "Validate v-Card" button
- Loading spinner during validation
- Success/error messages

**What happens:**
```javascript
// User submits v-card hash
POST /wp-json/hb/v1/vcard/validate
{
  "device_id": 1,
  "vcard_hash": "abc123xyz..."
}

// On success → Redirect to Step 3
// On error → Show error message
```

---

### **2. REST API Endpoint**

**Endpoint:** `POST /wp-json/hb/v1/vcard/validate`

**Parameters:**
- `device_id` (required, integer) - Device ID from Step 1
- `vcard_hash` (required, string) - QRtiger v-card hash
- `vcard_data` (optional, string) - Full v-card data (if available)

**Response (Success):**
```json
{
  "vcard_id": 1,
  "status": "validated"
}
```

**Response (Error):**
```json
{
  "code": "validation_failed",
  "message": "v-Card validation failed"
}
```

---

### **3. Backend Service (QRtiger_Service)**

**Location:** `includes/class-qrtiger-service.php`

**Key Methods:**

#### **`validate_vcard($vcard_hash, $vcard_data)`**
- Validates v-card via QRtiger API
- Currently uses **placeholder validation** (accepts any hash)
- When API key is configured, calls actual QRtiger API
- Returns validation result with hash and metadata

#### **`store_vcard($device_id, $validation_result)`**
- Stores v-card in `wp_hb_qrtiger_vcards` table
- Updates device's `vcard_status` field
- Handles duplicate v-cards (updates existing record)
- **PII Minimization:** Only stores hash, no personal data

#### **`update_device_vcard_status($device_id, $status)`**
- Updates device record: `vcard_status = 'validated'`
- This status is checked before allowing ledger writes

---

### **4. Database Schema**

**Table:** `wp_hb_qrtiger_vcards`

```sql
CREATE TABLE wp_hb_qrtiger_vcards (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  device_id BIGINT(20) UNSIGNED NOT NULL,
  vcard_hash VARCHAR(255) NOT NULL,        -- Hash only, no PII
  status ENUM('pending', 'validating', 'validated', 'rejected'),
  qrtiger_reference VARCHAR(255),          -- QRtiger API reference
  metadata TEXT,                           -- Minimal metadata (JSON)
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  validated_at TIMESTAMP NULL,
  PRIMARY KEY (id),
  UNIQUE KEY vcard_hash (vcard_hash),     -- One hash per v-card
  KEY idx_device (device_id)
);
```

**Device Table Update:**
```sql
-- Device table has vcard_status field
vcard_status ENUM('pending', 'validated', 'rejected') DEFAULT 'pending'
```

---

## Status Flow

```
pending → validating → validated ✅
                      ↓
                   rejected ❌
```

**Status Meanings:**
- `pending` - v-Card not yet validated (default)
- `validating` - Currently being validated (if async)
- `validated` - ✅ Successfully validated, device can access ledger
- `rejected` - ❌ Validation failed, device cannot access ledger

---

## PII Minimization

**What is stored:**
- ✅ `vcard_hash` - Cryptographic hash (not reversible)
- ✅ `qrtiger_reference` - API reference ID
- ✅ `metadata` - Minimal validation metadata (timestamp, method)
- ✅ `status` - Validation status

**What is NOT stored:**
- ❌ Full name
- ❌ Email address
- ❌ Phone number
- ❌ Physical address
- ❌ Any other personal information

**Why this matters:**
- Privacy-first design
- GDPR/privacy compliance
- Reduces data breach risk
- Hash cannot be reversed to reveal identity

---

## Integration with Other Systems

### **1. Device Registration**
- Device must have `vcard_status = 'validated'` to proceed to Step 3
- Checked in `Device_Registration_Service::complete_registration()`

### **2. Discord Role Assignment**
- v-Card validation status may influence Discord role assignment
- Validated devices get appropriate roles in Gracebook

### **3. Proof of Delivery (PoD)**
- **Unvalidated devices are blocked from PoD actions**
- Checked before allowing PoD confirmations
- Prevents unvalidated users from writing to ledger

### **4. Ledger Access**
- `vcard_status = 'validated'` is required for ledger writes
- Enforced in `Device_Registration_Service` and PoD services

---

## Current Implementation Status

### ✅ **Implemented:**
- Frontend validation page (`template-activate-device-step-2.php`)
- REST API endpoint (`/vcard/validate`)
- Database schema (`wp_hb_qrtiger_vcards` table)
- Service class (`QRtiger_Service`)
- Status management (pending → validated)
- PII minimization (hash-only storage)
- Device status updates

### ⚠️ **Placeholder (Ready for API):**
- QRtiger API integration currently uses placeholder
- Accepts any hash for testing
- When API key is added, will call actual QRtiger API

**To enable real QRtiger API:**
1. Get QRtiger API key
2. Add to WordPress options: `update_option('hb_qrtiger_api_key', 'your-key');`
3. Update API endpoint in `class-qrtiger-service.php` if needed

---

## Testing

### **Manual Test:**
1. Go to `/activate-device`
2. Complete Step 1 (device registration)
3. You'll be redirected to `/activate-device-step-2?device_id=X`
4. Enter any test hash (e.g., `test_vcard_123`)
5. Click "Validate v-Card"
6. Should see success message and redirect to Step 3

### **API Test:**
```bash
curl -X POST http://yoursite.com/wp-json/hb/v1/vcard/validate \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": 1,
    "vcard_hash": "test_vcard_hash_12345"
  }'
```

### **Database Check:**
```sql
-- Check v-card record
SELECT * FROM wp_hb_qrtiger_vcards WHERE device_id = 1;

-- Check device status
SELECT id, status, vcard_status FROM wp_hb_devices WHERE id = 1;
```

**Expected Results:**
- ✅ v-Card record created in `wp_hb_qrtiger_vcards`
- ✅ Device `vcard_status` = `'validated'`
- ✅ Can proceed to Step 3 (Discord connection)

---

## Security Considerations

1. **Hash Validation:**
   - v-Card hash is sanitized before storage
   - Unique constraint prevents duplicate hashes
   - Hash cannot be reversed to reveal identity

2. **Status Enforcement:**
   - Backend checks `vcard_status` before allowing ledger writes
   - Frontend cannot bypass validation requirement

3. **API Security:**
   - REST API endpoint is public (for device activation)
   - Validation happens server-side
   - No sensitive data exposed in responses

---

## Error Handling

**Common Errors:**

1. **"Please enter v-card hash"**
   - User didn't enter hash
   - Frontend validation error

2. **"v-Card validation failed"**
   - QRtiger API rejected the hash
   - Invalid hash format
   - API connection error

3. **"v-Card validation is pending"**
   - Validation is in progress (if async)
   - User should wait and try again

4. **"QRtiger v-card must be validated first"**
   - User trying to skip Step 2
   - Device `vcard_status` is not `'validated'`

---

## Next Steps After Validation

Once v-card is validated:
1. ✅ Device `vcard_status` = `'validated'`
2. ✅ User redirected to Step 3 (Discord Connection)
3. ✅ Device can now proceed to membership selection
4. ✅ Device will be able to participate in PoD after full registration

---

## Summary

**QRtiger v-Card Validation is:**
- ✅ A required validator credential
- ✅ Step 2 of device activation
- ✅ PII-minimized (hash only)
- ✅ Gatekeeper for ledger access
- ✅ Integrated with Discord roles
- ✅ Enforced in PoD workflow

**Key Takeaway:**
> **Unvalidated devices cannot write ledger events.** This is a constitutional requirement to ensure only validated participants can contribute to the append-only ledger.

---

## Files Reference

- **Frontend:** `template-activate-device-step-2.php`
- **Backend Service:** `includes/class-qrtiger-service.php`
- **REST API:** `includes/class-hb-rest-api.php` (line 240-270)
- **Database:** `database/migrations/001_create_device_tables.php` (line 56-72)
- **Testing:** `TESTING_MANUAL.md` (section "Test 4: Validate v-Card")

