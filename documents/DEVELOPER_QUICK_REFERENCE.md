# Developer Quick Reference Guide
## HumanBlockchain Portal - Key Concepts & Rules

---

## 🚨 Critical Rules (Never Break These)

### 1. XP is NOT Money
- **Always** display XP as measurement units
- **Never** use $ signs or currency symbols
- **Never** call it "payment" or "reward"
- Example: "1 XP" not "$1 XP"

### 2. Append-Only Ledger
- **Never** update existing ledger entries
- **Always** create new entries for changes
- **Always** maintain hash chain
- **Never** delete entries

### 3. One Complimentary Pack Per Device
- **Ever.** Not per user, not per year. **Per device.**
- Check `complimentary_pack_issued` flag before issuing
- **Never** issue second pack to same device

### 4. Privacy-First
- **Never** store raw IP addresses
- **Never** store raw user agents
- **Always** hash sensitive data before storage
- **Never** collect hardware IDs

### 5. Trust Moves First
- Value delivery happens before ledger recording
- 2-scan process required for XP
- Seller scan (pledge) → Buyer scan (confirm) → XP minted

---

## 📊 Database Tables Quick Reference

### `hbc_devices`
- `device_id` (UUID) - Primary key
- `device_hash` - SHA256 hash for fraud detection
- `complimentary_pack_issued` - Boolean flag
- `pack_type` - 'sticker' or 'hang_tag'

### `hbc_members`
- `discord_user_id` - Links to Discord
- `membership_level` - 'yamer', 'megavoter', 'patron'
- `status` - 'pending_discord', 'pending_action', 'pending_maturity', 'active', 'suspended', 'revoked'
- `buyer_poc_id`, `seller_poc_id` - POC assignments

### `hbc_referrals`
- `xp_amount` - 1, 5, or 25
- `maturity_date` - 8-12 weeks from creation
- `status` - 'pending_action', 'pending_maturity', 'matured', 'void'

### `hbc_xp_ledger`
- `entry_type` - See entry types below
- `amount` - XP units (can be 0)
- `immutable_hash` - Hash chain link
- `previous_hash` - Previous entry hash

### `hbc_vouchers`
- `status` - 'issued', 'unused', 'attached', 'validated', 'closed'
- `pack_source` - 'complimentary' or 'purchased'
- XP only minted when status = 'validated'

---

## 🔄 Entry Types Reference

| Entry Type | When Created | XP Amount |
|------------|--------------|-----------|
| `device_register` | Device registration | 0 (or configurable) |
| `complimentary_pack_issued` | Pack issued | 0 (never XP) |
| `referral_award` | Referral created | 1, 5, or 25 (pending) |
| `voucher_used` | Buyer validates delivery | 1+ (based on value) |
| `maturity_unlock` | Referral matures | 1, 5, or 25 |
| `annual_close_adjustment` | Aug 31 close | 1, 5, or 25 |
| `role_assigned` | Discord roles assigned | 0 (or configurable) |
| `action_completed` | MEGAvoter/Patron action | Configurable |

---

## 🎯 Status Lifecycles

### Member Status Flow
```
pending_discord → pending_action → pending_maturity → active
                                    ↓
                                 suspended/revoked
```

### Referral Status Flow
```
pending_action → pending_maturity → matured
                      ↓
                    void (if revoked)
```

### Voucher Status Flow
```
issued → unused → attached → validated → closed
```

**XP is ONLY minted at 'validated' stage**

---

## 🔐 Security Checklist

### API Endpoints
- [ ] Nonce check for logged-in users
- [ ] HMAC signature for Discord webhooks
- [ ] Rate limiting per IP
- [ ] Rate limiting per device_hash

### Data Storage
- [ ] IP addresses hashed (SHA256)
- [ ] User agents hashed (SHA256)
- [ ] Bot tokens encrypted
- [ ] Geolocation consent logged

### Validation
- [ ] Input sanitization
- [ ] Output escaping
- [ ] SQL prepared statements
- [ ] XSS prevention

---

## 📝 UI Language Guidelines

### ✅ DO Use
- "A pledge was made"
- "Trust recorded"
- "Value acknowledged"
- "A delivery was confirmed"
- "A New World Penny was minted"
- "Become visible to the ledger"
- "Here's your starter kit"

### ❌ DON'T Use
- "Transaction completed"
- "Payment received"
- "Reward issued"
- "Money transferred"
- "Balance updated"

### Three Living Roles
Always show on relevant screens:
1. **The Pledger** (Seller/Provider) - "I deliver value"
2. **The Confirmer** (Buyer/Receiver) - "I confirm truth"
3. **The Ledger** (The System) - "I remember trust forever"

---

## 🔢 XP Amounts Reference

| Tier | Referral XP | Description |
|------|------------|-------------|
| YAM'er | 1 | Free tier |
| MEGAvoter | 5 | Annual supporter |
| Patron | 25 | Monthly stakeholder |

**Maturity Window:** 8-12 weeks (randomized)

---

## 📅 Important Dates

- **August 31:** Annual close date
  - Waives maturity for completed actions
  - Creates adjustment ledger entries

- **September 1:** Referral recognition issued (if applicable)

---

## 🛠️ Common Functions

### Generate Device Hash
```php
$hash = hash('sha256', $device_id . $user_agent . $timezone . $screen_w . $screen_h);
```

### Create Ledger Entry
```php
HBC_XP_Ledger_Service::create_entry([
    'entry_type' => 'voucher_used',
    'actor_type' => 'device',
    'actor_id' => $device_id,
    'amount' => 1,
    'reference_id' => $voucher_id,
    'metadata' => ['buyer_device_id' => $buyer_id]
]);
```

### Check Pack Issued
```php
$device = HBC_Device_Service::get($device_id);
if ($device->complimentary_pack_issued) {
    // Already issued, reject
}
```

### Calculate Maturity Date
```php
$weeks = rand(8, 12);
$maturity_date = date('Y-m-d', strtotime("+$weeks weeks"));
```

---

## 🚦 POC Assignment Rules

### Buyer POC
- **Location:** Local (within ~50km)
- **Max Size:** 30 members
- **Assignment:** Geo + timestamp bucket

### Seller POC
- **Location:** Global (away from device location)
- **Max Size:** 5 sellers
- **Assignment:** Global bucket + timestamp

### Peace Pentagon Branch
- **Options:** planning, budget, media, distribution, membership
- **Assignment:** Time-based serendipity (CRC32 hash)

---

## 📦 Complimentary Pack Rules

### Issuance
- **Trigger:** Device registration + Discord connection
- **Quantity:** 10 vouchers/hang tags
- **Choice:** User selects sticker OR hang_tag
- **One-time:** Ever. Per device.

### Fulfillment
- **Digital:** PDF download with QR codes
- **Physical:** Optional, separate tracking

### XP
- **Issuance:** NO XP (amount = 0)
- **Usage:** XP minted only when voucher validated (2-scan)

---

## 🔗 API Endpoints

### Device Registration
```
POST /wp-json/hbc/v1/device/register
Body: { device_id, device_hash, geo_lat, geo_lng, consent }
```

### Discord Webhook
```
POST /wp-json/hbc/v1/discord/role-confirm
Headers: X-Discord-Signature (HMAC)
Body: { user_id, roles[] }
```

### Voucher Scan (Seller)
```
POST /wp-json/hbc/v1/voucher/attach
Body: { voucher_id, device_id }
```

### Voucher Scan (Buyer)
```
POST /wp-json/hbc/v1/voucher/validate
Body: { voucher_id, device_id }
```

---

## ⚠️ Common Pitfalls

1. **Don't mint XP on pack issuance** - Only on voucher validation
2. **Don't update ledger entries** - Always create new ones
3. **Don't store raw IP/UA** - Always hash first
4. **Don't allow second pack** - Check flag first
5. **Don't use money language** - Use value/measurement language
6. **Don't skip 2-scan process** - Both scans required for XP
7. **Don't forget hash chain** - Every entry needs previous hash

---

## 📚 Related Documents

- `DEVELOPMENT_REQUIREMENTS.md` - Full requirements
- `TASK_CHECKLIST.md` - Development tasks
- This document - Quick reference

---

**Last Updated:** January 2025
