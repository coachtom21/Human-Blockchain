# Client Clarification Questions
## Questions to Confirm Before Development

---

## 🔴 Critical Questions (Must Answer)

### 1. Buyer Registration Requirement
**Question:** When a buyer/receiver scans a voucher to confirm delivery, do they need to be registered in the system?

**Options:**
- **A)** Buyer MUST be registered (prompt registration if not)
- **B)** Buyer can scan as guest (no registration required)
- **C)** Buyer can scan without registration, but registration is optional

**Why Important:** Affects the 2-scan flow, security, and audit trail.

**Our Recommendation:** Option A (buyer must register) for complete tracking.

---

### 2. Voucher Reusability
**Question:** Can a single voucher be used multiple times, or is it one-time only?

**Options:**
- **A)** One-time use only (after validation, voucher is "closed" and cannot be reused)
- **B)** Can be reused multiple times (same voucher for multiple deliveries)

**Why Important:** Affects voucher lifecycle and XP minting logic.

**Our Recommendation:** Option A (one-time use) based on documentation showing status "closed" after validation.

---

### 3. Buyer Gets Voucher Pack
**Question:** If a buyer registers to confirm a delivery, do they automatically get their own 10-pack of vouchers?

**Options:**
- **A)** Yes, every registered user gets 10-pack (one-time, ever)
- **B)** No, only initial registrations get vouchers (not buyers who register to confirm)
- **C)** Buyers get vouchers but different quantity/type

**Why Important:** Affects voucher issuance logic and user expectations.

**Our Recommendation:** Option A (every registered user gets 10-pack) - registration = voucher pack.

---

## 🟡 Important Questions (Should Answer)

### 4. Admin Manual Voucher Creation
**Question:** Should admins be able to manually create/issue voucher packs?

**Options:**
- **A)** Yes, admins can manually issue packs (for support cases, testing, etc.)
- **B)** No, only automatic system creation (no manual override)

**Why Important:** Support and edge case handling.

**Our Recommendation:** Option A (admin can manually issue) for support flexibility.

---

### 5. Voucher Transfer/Sharing
**Question:** Can users share/transfer their vouchers with others?

**Options:**
- **A)** No, vouchers are non-transferable (linked to device, cannot be given away)
- **B)** Yes, users can transfer vouchers to other devices/users
- **C)** Partial - vouchers can be "assigned" to deliveries but stay linked to original owner

**Why Important:** Affects voucher ownership and tracking.

**Our Recommendation:** Option A (non-transferable) based on documentation.

---

### 6. Multiple Packs Per User
**Question:** Can a user get more than one 10-pack?

**Options:**
- **A)** No, strictly one pack per device (ever)
- **B)** Yes, users can request additional packs (admin approval)
- **C)** Yes, users can purchase additional packs

**Why Important:** Affects voucher issuance rules and abuse prevention.

**Our Recommendation:** Option A (one pack per device, ever) as per documentation.

---

### 7. Voucher Expiration
**Question:** Do vouchers expire or have a validity period?

**Options:**
- **A)** No expiration (vouchers valid forever until used)
- **B)** Yes, vouchers expire after X months/years
- **C)** Yes, vouchers expire if not used within X time

**Why Important:** Affects voucher status management and database queries.

**Our Recommendation:** Option A (no expiration) unless client specifies otherwise.

---

## 🟢 Nice-to-Know Questions (Optional)

### 8. Physical Fulfillment Priority
**Question:** Should we implement physical mail fulfillment from the start, or digital-only initially?

**Options:**
- **A)** Digital-only (PDF download) for MVP, physical later
- **B)** Both digital and physical from start
- **C)** Physical only (no digital)

**Why Important:** Affects development timeline and complexity.

**Our Recommendation:** Option A (digital-first) for faster launch.

---

### 9. QR Code Content
**Question:** What should the QR code contain/encode?

**Options:**
- **A)** Full URL: `https://humanblockchain.info/pod?voucher_id=XXXX`
- **B)** Just voucher ID: `XXXX` (system constructs URL)
- **C)** Encrypted data with voucher ID + metadata

**Why Important:** Affects QR code generation and scanning logic.

**Our Recommendation:** Option A (full URL) for easier scanning.

---

### 10. Voucher Design Customization
**Question:** Can users customize voucher design/layout, or is it standardized?

**Options:**
- **A)** Standardized design (all vouchers look the same)
- **B)** Users can choose from templates
- **C)** Fully customizable by users

**Why Important:** Affects PDF generation complexity.

**Our Recommendation:** Option A (standardized) for MVP simplicity.

---

### 11. Voucher Status After Validation
**Question:** After both scans complete (validated), can the voucher be viewed/historical data accessed?

**Options:**
- **A)** Yes, validated vouchers remain visible in user dashboard (historical record)
- **B)** No, validated vouchers are hidden/archived
- **C)** Only admins can see validated vouchers

**Why Important:** Affects dashboard design and user experience.

**Our Recommendation:** Option A (visible in history) for transparency.

---

### 12. Multiple Devices Per User
**Question:** If a user registers multiple devices, does each device get its own 10-pack?

**Options:**
- **A)** Yes, each device gets its own pack (one pack per device)
- **B)** No, one pack per user (shared across devices)
- **C)** First device gets pack, additional devices flagged for review

**Why Important:** Affects voucher issuance logic and abuse prevention.

**Our Recommendation:** Option A (one pack per device) but with fraud detection for same person.

---

### 13. Voucher Scanning Interface
**Question:** Where/how do users scan vouchers?

**Options:**
- **A)** Dedicated scanning page (`/pod` or `/scan`)
- **B)** Mobile app
- **C)** Camera scanner on any page
- **D)** Manual entry of voucher ID

**Why Important:** Affects frontend development and user flow.

**Our Recommendation:** Option A (dedicated scanning page) with camera support.

---

### 14. XP Amount Per Voucher Validation
**Question:** How much XP is minted when a voucher is validated (both scans complete)?

**Options:**
- **A)** Fixed amount (e.g., 1 XP per validated voucher)
- **B)** Variable based on delivery value/type
- **C)** Based on user's membership tier
- **D)** Configurable by admin

**Why Important:** Affects XP ledger and reward system.

**Our Recommendation:** Need client input - not clearly specified in docs.

---

### 15. Voucher Pack Type Change
**Question:** If user already got sticker pack, can they later get hang tag pack (or vice versa)?

**Options:**
- **A)** No, pack type is locked at first issuance
- **B)** Yes, users can request different type (admin approval)
- **C)** Users can get both types (separate packs)

**Why Important:** Affects voucher issuance logic.

**Our Recommendation:** Option A (locked at first choice) - one pack per device.

---

## 📋 Summary of Critical Questions

**Must Answer Before Development:**
1. ✅ Buyer registration requirement (must register or can scan as guest?)
2. ✅ Voucher reusability (one-time or reusable?)
3. ✅ Buyer gets voucher pack (yes or no when registering to confirm?)

**Should Answer:**
4. Admin manual creation capability
5. Voucher transferability
6. Multiple packs per user
7. Voucher expiration

**Nice to Know:**
8. Physical fulfillment priority
9. QR code content format
10. Voucher design customization
11. Validated voucher visibility
12. Multiple devices handling
13. Scanning interface location
14. XP amount per validation
15. Pack type changeability

---

## 🎯 Recommended Priority

**Answer these 3 first:**
1. Buyer registration requirement
2. Voucher reusability  
3. Buyer gets voucher pack

**Then answer these 4:**
4. Admin manual creation
5. Voucher transferability
6. Multiple packs per user
7. Voucher expiration

**Rest can be answered during development or Phase 2.**

---

**Last Updated:** January 2025
