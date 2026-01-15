RECOMMENDED SYSTEM FLOW - BEST PRACTICE
HumanBlockchain.info - Complete System Documentation

---

Document Information:
- Date: January 2025
- Version: 2.0
- Status: Complete Recommended System Flow
- Purpose: Comprehensive documentation of system flow, membership, referrals, and resource allocation

---

TABLE OF CONTENTS

1. Core Principle
2. Phase 1: Initial Setup
3. Phase 2: User Account
4. Phase 3: Order Fulfillment
5. Phase 4: Seller Scan
6. Phase 5: Buyer Scan
7. Phase 6: Membership System
8. Phase 7: Referral System
9. Database Structure
10. Key Rules
11. 10 Postmaster Generals Framework
12. Complete Flow Diagrams
13. Summary

---

CORE PRINCIPLE

Device = Identity, User Account = Tracking & XP

Fundamental Concept:
- Device represents the physical device (phone, laptop, tablet)
- User Account represents the person (for XP, orders, tracking)
- Device can work without user account (anonymous)
- User account enhances device capabilities (XP, orders, history)

Key Relationships:
- One device = One identity (even if multiple users use it)
- One user account = Can link to one device (primary device)
- Device activation = Can be anonymous (no login required)
- User registration = Separate from device (WordPress account)

---

PHASE 1: INITIAL SETUP

Timing: Optional - Can happen anytime  
Purpose: Register device and optionally link to user account

---

Option A: Device Activation First (Recommended for Quick Start)

```
User visits humanblockchain.info
    ↓
Clicks "Activate Device" button
    ↓
Device Activation Page (/activate-device)
    ↓
User clicks "Activate This Device"
    ↓
System collects:
    ✓ Device ID (UUIDv4)
    ✓ Device Hash (fingerprint)
    ✓ Device Fingerprint Data
    ✓ Geolocation (if permission granted)
    ↓
Device stored in database:
    - device_id: "abc123..."
    - device_hash: "xyz789..."
    - wp_user_id: NULL (anonymous)
    - status: "activating"
    ↓
Device is ACTIVE (but not linked to user)
    ↓
User can browse site, but cannot:
    - Scan QR codes (needs login)
    - Earn XP (needs login)
    - Access orders (needs login)
```

Benefits:
- Quick start (no login barrier)
- Device ready when user wants to scan
- Can link to account later

---

Option B: User Registration First (Alternative)

```
User visits humanblockchain.info
    ↓
Clicks "Register" or "Sign Up"
    ↓
User Registration:
    - Email address
    - Password
    - Name (optional)
    ↓
Account created in WordPress
    ↓
User is logged in
    ↓
Then activates device (device linked immediately)
```

Benefits:
- Device linked to account immediately
- Full access from start
- ❌ Higher barrier (requires registration)

---

PHASE 2: USER ACCOUNT

Timing: Required when accessing features  
Purpose: Link device to user identity for tracking and XP

---

When User Account is Required

1. To Scan QR Codes (Proof of Delivery)
2. To Earn XP Points
3. To Access Orders (claim, fulfill)
4. To View Dashboard (XP history, orders)
5. To Participate in 2-Scan PoD

User Registration/Login Flow:

```
User needs to scan QR code OR access features
    ↓
System checks: Is user logged in?
    ↓
If NOT logged in:
    → Show login/register modal or page
    → User can:
        Option 1: Login (if has account)
            - Email + Password
            - Login successful
        Option 2: Register (if new user)
            - Email + Password
            - Name (optional)
            - Account created
            - Auto-logged in
    ↓
After login:
    → Link device to user account
    → Update wp_user_id in device record
    → Continue to requested action
```

---

PHASE 3: ORDER FULFILLMENT

Integration: WooCommerce  
Purpose: Customer orders products, admin assigns to sellers

---

Step 1: Customer Places Order

```
Customer visits MEGAvoter site (WooCommerce)
    ↓
Browses products (Hang Tags or Stickers - 10-pack)
    ↓
Places preorder/backorder
    ↓
Order created in WooCommerce
    ↓
Order synced to VFN backorder pool via REST API
    ↓
Order status: "eligible" (waiting for admin assignment)
```

---

Step 2: Admin Assignment

```
Admin logs into WordPress Admin
    ↓
Views "Available Backorders" dashboard
    ↓
Selects order #12345
    ↓
Clicks "Assign to Seller"
    ↓
Selects seller from list:
    - Only MEGAvoter/Patron can be sellers
    - YAM'ers can be sellers (with pending Seller POC)
    ↓
Clicks "Send Claim Request"
    ↓
System sends notification to seller
    ↓
Order status: "pending_claim" (waiting for seller)
```

---

Step 3: Seller Accepts Claim

```
Seller receives notification:
    - Email: "You have a new delivery request"
    - Dashboard: "My Claim Requests"
    ↓
Seller logs in (if not already)
    ↓
Views "My Claim Requests"
    ↓
Sees Order #12345 assigned by admin
    ↓
Clicks "Accept Claim" or "Reject Claim"
    ↓
If ACCEPT:
    → Order status: "claimed"
    → Linked to seller_device_id
    → 7-day deadline starts
    → Seller can now deliver
    ↓
If REJECT:
    → Order status: "rejected"
    → Admin notified
    → Admin can reassign to different seller
```

---

Step 4: Seller Prepares Delivery

```
Seller accepts claim request
    ↓
Prints product with universal QR code label
    ↓
Physical Label Design:
    ┌─────────────────────────┐
    │   [Universal QR Code]   │
    │   URL: humanblockchain. │
    │        info/?proof_type=│
    │        scan             │
    │                         │
    │   Order #: 12345        │
    │   Voucher: 3 of 10      │
    │   Type: Hang Tag        │
    └─────────────────────────┘
    ↓
QR Code contains ONLY: humanblockchain.info/?proof_type=scan
Order info printed as TEXT (for reference)
    ↓
Product ready for delivery
```

---

PHASE 4: SELLER SCAN (Scan 1)

Type: Delivery Initiation  
Purpose: Seller scans QR code to initiate delivery and earn $10.30 XP

---

Step 5: Seller Scans QR Code

```
Seller delivers product to buyer
    ↓
Seller scans universal QR code on label
    ↓
QR redirects to: humanblockchain.info/?proof_type=scan
    ↓
System detects: proof_type=scan parameter
```

---

Step 6: Proof of Delivery Popup

```
Popup: "Is this proof of delivery?"
    ↓
[YES] → Continue
[NO] → Exit (no record created)
```

---

Step 7: Role Selection

```
Popup: "What is your role?"
    ↓
○ I am the Seller (delivering this product) ← Select this
○ I am the Buyer (receiving this product)
    ↓
[Continue]
```

---

Step 8: Login Check (REQUIRED)

```
System checks: Is user logged in?
    ↓
If NOT logged in:
    → Show login/register modal
    → User enters:
        - Email address
        - Password
        OR
        - Click "Register" (if new user)
            - Email + Password + Name
            - Account created
    ↓
After login:
    → System links device to user account
    → Update wp_user_id in device record
    → Continue to device check
    ↓
If logged in:
    → Continue to device check
```

---

Step 9: Device Activation Check

```
System checks: Is device registered?
    ↓
If device NOT registered:
    → Quick device activation
    → Collect device fingerprint
    → Generate device_id (UUIDv4)
    → Store device in database
    → Link to logged-in user (wp_user_id)
    → Continue to order lookup
    ↓
If device registered:
    → Continue to order lookup
```

---

Step 10: Automatic Order Detection

```
System queries database:
    - Get seller's device_id (from logged-in user)
    - Check wp_vfn_backorder_pool table
    - Find orders where:
        assigned_to_seller_id = seller_device_id
        pool_status = 'claimed'
        initiation_deadline > NOW()
    ↓
If only ONE active claimed order:
    → Auto-select that order
    → Continue to processing
    ↓
If MULTIPLE active claimed orders:
    → Show list: "Which order are you scanning?"
    → [Order #12345] [Order #12346] [Order #12347]
    → User selects order
    ↓
If NO claimed orders:
    → Error: "No assigned orders found. Contact admin."
```

---

Step 11: Confirm Destination

```
Popup: "Is this the final destination?"
    ↓
[YES] → Final delivery (goes directly to buyer)
[NO] → In-transit handoff (intermediate delivery person)
    ↓
[Continue]
```

---

Step 12: Process Seller Scan

```
After destination confirmed:
    ↓
System records seller scan:
    ✓ Creates Seller Transaction ID (STXID)
    ✓ Records seller device_id
    ✓ Records timestamp
    ✓ Records destination type (final/intermediate)
    ✓ Updates order status: "initiated"
    ✓ Updates voucher status: "seller_scanned"
    ↓
System issues New World Penny (NWP):
    ✓ NWP issued to seller
    ✓ NWP recorded in ledger
    ✓ NWP type: "handoff" or "final_delivery"
    ↓
System creates XP entry:
    ✓ Seller receives $10.30 pledged
    ✓ Stored as XP conversion (pending)
    ✓ Status: "Pending" (waiting for buyer scan)
    ✓ Note: YAM'ers, MEGAvoters, and Patrons can all be sellers
    ✓ YAM'ers can pledge $10.30 (same as other tiers)
    ↓
Message: "Delivery initiated. New World Penny issued. $10.30 XP recorded (pending buyer confirmation)."
```

---

PHASE 5: BUYER SCAN (Scan 2)

Type: Delivery Confirmation  
Purpose: Buyer scans QR code to confirm delivery and earn $5 XP

---

Step 13: Buyer Receives Product

```
Buyer receives product with QR code label
    ↓
Buyer scans same universal QR code
    ↓
QR redirects to: humanblockchain.info/?proof_type=scan
    ↓
System detects: proof_type=scan parameter
```

---

Step 14-16: Same Popups as Seller

```
Step 14: "Is this proof of delivery?" → [YES]
Step 15: Role selection → Select "I am the Buyer"
Step 16: Login check → Login if needed
Step 17: Device activation check → Activate if needed
```

---

Step 18: Automatic Order Detection (Buyer)

```
System queries database:
    - Get buyer's device_id (from logged-in user)
    - Check wp_vfn_backorder_pool table
    - Find orders with:
        seller_scanned status (waiting for buyer)
        Sort by latest first
    ↓
If only ONE order waiting for buyer scan:
    → Auto-select that order
    → Continue to seller scan verification
    ↓
If MULTIPLE orders waiting:
    → Show list: "Which order are you scanning?"
    → [Order #12345] [Order #12346]
    → User selects order
    ↓
If NO orders found:
    → Error: "No pending deliveries found."
```

---

Step 19: Verify Seller Scan

```
After order selected:
    ↓
System checks database for seller scan:
    - Query wp_vfn_vouchers table
    - Check: order_id = selected order
    - Verify: status = 'seller_scanned'
    - Verify: seller_txn_id exists
    - Verify: seller_scan_at timestamp exists
    ↓
If seller scan data found and matched:
    → Continue to confirm delivery
    ↓
If seller scan NOT found:
    → Error: "Seller hasn't scanned yet. Please wait for seller to initiate delivery."
    → Exit
```

---

Step 20: Confirm Destination (Buyer)

```
Popup: "Is this the final destination?"
    ↓
[YES] → Final delivery (end customer receives)
[NO] → In-transit handoff (intermediate delivery person)
    ↓
[Continue]
```

---

Step 21: Process Buyer Scan & Complete Transaction

```
After destination confirmed:
    ↓
System records buyer scan:
    ✓ Records buyer device_id
    ✓ Records buyer scan timestamp
    ✓ Records destination type (final/intermediate)
    ✓ Updates voucher status: "completed"
    ✓ Updates order status: "fulfilled"
    ↓
System issues New World Penny (NWP):
    ✓ NWP issued to buyer
    ✓ NWP recorded in ledger
    ✓ NWP type: "handoff" or "final_delivery"
    ↓
System creates XP entries:
    ✓ Buyer receives $5 pledged
    ✓ Stored as XP conversion
    ✓ Status: "Pending" (matures 8-12 weeks)
    ✓ Note: YAM'ers can receive 10-pack vouchers/hang tags and earn $5 XP
    ↓
System releases seller XP:
    ✓ Seller's $10.30 XP status: "Confirmed"
    ✓ Both XP entries now active
    ✓ YAM'ers can pledge $10.30 (as sellers) and earn full amount
    ↓
System allocates resources:
    ✓ $4 → Peace Pentagon branch resource
       • Goes to buyer's Peace Pentagon branch
       • YAM'ers receive $4 in their branch resource (managed by MEGAvoters or 10 PMG)
       • Managed by qualified MEGAvoters or 10 Postmaster Generals (PMG)
    ✓ $1 Patronage breakdown:
      • $0.50 → Credited to YAM'er seller (if seller is YAM'er)
      • $0.40 → Group bonus → Treasury
      • $0.10 → Treasury allocation → Treasury
      • If buyer is YAM'er: $0.50 credited to YAM'er, $0.40 + $0.10 → Treasury
    ↓
Message: "Delivery confirmed! New World Penny issued. $5 XP recorded."
```

Important Notes:
- YAM'ers can receive 10-pack vouchers/hang tags and participate as buyers
- YAM'ers can pledge $10.30 (as sellers) and earn the full amount
- YAM'ers earn $4 in their Peace Pentagon branch resource (managed by MEGAvoters or 10 PMG)
- YAM'ers earn $0.50 patronage (if they are the seller)
- Resource management: $4 branch resources are managed by qualified MEGAvoters or 10 Postmaster Generals (2 from each branch)

---

Complete Flow Diagrams

Purpose: Visual representation of complete system flow

---

Main System Flow

```
┌─────────────────────────────────────────────────────────┐
│         PHASE 1: SETUP (Optional - Anytime)             │
│  Option A: Activate Device (Anonymous)                  │
│  Option B: Register Account → Activate Device           │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 2: ORDER (WooCommerce)                    │
│  Customer → WooCommerce → REST API → Backorder Pool    │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 3: ADMIN ASSIGNMENT                       │
│  Admin → Assign Order → Seller Accepts → Claimed       │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 4: SELLER SCAN (Scan 1)                   │
│  Scan QR → "Proof?" → Role → LOGIN → Device Check →    │
│  Order Lookup → "Final?" → Process → NWP → $10.30 XP   │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 5: BUYER SCAN (Scan 2)                    │
│  Scan QR → "Proof?" → Role → LOGIN → Device Check →    │
│  Order Lookup → Verify Seller → "Final?" → Process →   │
│  NWP → $5 XP → Seller XP Confirmed → Resource Alloc.   │
└─────────────────────────────────────────────────────────┘
```

---

Key Decisions

Purpose: Important design decisions and their rationale

---

1. Device Activation
- Can be anonymous (no login required)
- Can be linked later (when user logs in)
- One device = one identity (even if multiple users use it)

2. User Account
- Required for scanning (Proof of Delivery)
- Required for XP tracking
- Required for order access
- Optional for device activation

3. Login Timing
- Before scanning (required)
- During device activation (optional, but recommended)
- Can link device later (if activated anonymously)

4. Device Linking
- Automatic when user logs in (if device not linked)
- Updates wp_user_id in device record
- One device can be linked to one user (primary user)

---

User Journey Options

Purpose: Different paths users can take through the system

---

Journey A: Quick Start (Recommended)
```
1. Activate Device (anonymous) → 30 seconds
2. Browse site, learn about system
3. When ready to scan → Login/Register
4. Device automatically linked to account
5. Start scanning and earning XP
```

Journey B: Full Registration First
```
1. Register Account → 2 minutes
2. Activate Device (linked immediately)
3. Full access from start
4. Can scan immediately
```

Journey C: Scan First
```
1. Scan QR code
2. System asks: "Login required"
3. User logs in/registers
4. Device activated automatically
5. Continue with scan
```

---

Recommended Implementation

Purpose: Implementation priorities and status

---

Priority 1: Device Activation (Current - Working)
- Works without login
- Stores device data
- Can link to user if logged in

Priority 2: Login/Register System
- ⚠️ Need to implement:
  - Login modal/page
  - Registration form
  - Device linking after login
  - Session management

Priority 3: Scan Flow
- ⚠️ Need to implement:
  - QR code detection (?proof_type=scan)
  - Proof popup
  - Role selection
  - Login check
  - Device check
  - Order lookup
  - Scan processing

---

Summary

Purpose: Quick reference summary of key points

---

Best Practice Flow:
1. Device Activation = Quick, anonymous, optional
2. User Account = Required for scanning, XP, orders
3. Login = Required before scanning, optional for device activation
4. Device Linking = Automatic when user logs in

Key Principle:
- Low barrier to entry (device activation is easy)
- Login only when needed (for scanning/XP)
- Automatic linking (device connects to account seamlessly)

---

PHASE 6: MEMBERSHIP SYSTEM

Timing: After device registration  
Purpose: Select membership tier for POC assignment and resource allocation

---

Overview

Three Membership Tiers (All FREE):

| Tier | Cost | Description | Can Be Seller? | Seller POC | Resource Allocation Rights | Referral XP |
|------|------|-------------|----------------|------------|---------------------------|-------------|
| YAM'er | Free | "Participate in Proof of Delivery" | Yes | Pending | ❌ No | 1 XP |
| MEGAvoter | Free | "Guide social impact decisions" | Yes | Active | Yes (after 5-seller karaoke) | 5 XP |
| Patron | Free | "Support and scale the network" | Yes | Active | Yes (after 5-seller karaoke) | 25 XP |

Important Notes:
- All memberships are FREE - No payment required
- "Annual" and "Monthly" are commitment labels, NOT payment terms
- Membership affects:
  - POC (Point of Contact) assignment
  - Seller eligibility
  - Referral XP amounts
  - Discord role assignment

---

Step 1: User Registers Device

```
User visits humanblockchain.info
    ↓
Starts device registration
    ↓
Device ID created
    ↓
Geo-location captured
    ↓
Device stored in database
```

---

Step 2: User Connects Discord (Optional)

```
User clicks "Connect Discord"
    ↓
OAuth2 flow completes
    ↓
Discord user ID stored
    ↓
Discord roles assigned (based on membership tier)
```

---

Step 3: Membership Selection Screen

```
Screen: "Choose your participation level"
    ↓
Options displayed:
    ○ YAM'er — Free
      "Participate in Proof of Delivery."
    
    ○ MEGAvoter — Annual
      "Guide social impact decisions."
    
    ○ Patron — Monthly
      "Support and scale the network."
    ↓
User selects membership tier
    ↓
[Continue] button clicked
```

UI Elements:
- Heading: "Choose your participation level"
- Subtext: "You can change this later."
- Three membership options with descriptions
- Footer: "Referral recognition is issued annually in XP on September 1."

---

Step 4: System Stores Membership

```
Backend Process:
    ↓
1. Store membership selection in database
   UPDATE devices SET
     membership_tier = 'yamer' | 'megavoter' | 'patron',
     membership_selected_at = NOW()
   WHERE id = device_id
    ↓
2. Trigger POC Assignment (Serendipity Protocol)
   - Assign Buyer POC (local)
   - Assign Seller POC (if MEGAvoter/Patron)
   - Assign Peace Pentagon Branch
```

---

Step 5: POC Assignment (Automatic)

#### A) Buyer POC Assignment (Everyone Gets This)

```
System Process:
    ↓
1. Use device's geo-location
2. Find or create Buyer POC in same region
3. Max 30 members per Buyer POC
4. Assign based on timestamp
5. If POC is full, create new POC
    ↓
Result: Device assigned to local Buyer POC
```

Database:
```sql
INSERT INTO poc_memberships (
    device_id,
    poc_id,
    poc_type,  -- 'buyer'
    assigned_at
) VALUES (?, ?, 'buyer', NOW())
```

#### B) Seller POC Assignment (All Members)

```
System Process:
    ↓
1. Check membership tier
   - If YAM'er → Assign "pending" Seller POC (can send/receive packages)
   - If MEGAvoter/Patron → Assign active Seller POC
    ↓
2. Find or create Seller POC (out-of-state/global)
3. Max 5 sellers per Seller POC
4. Assign slot index (0-4) based on registration timestamp
5. Assign away from device's locality
    ↓
Result: Device assigned to global Seller POC (pending or active)
```

Database:
```sql
-- For all members (YAM'er gets "pending" status)
INSERT INTO poc_memberships (
    device_id,
    poc_id,
    poc_type,  -- 'seller'
    slot_index,  -- 0-4
    status,  -- 'pending' for YAM'er, 'active' for MEGAvoter/Patron
    assigned_at
) VALUES (?, ?, 'seller', ?, ?, NOW())
```

#### C) Peace Pentagon Branch Assignment (Everyone)

```
System Process:
    ↓
1. Use time-based serendipity (CRC32 hash)
2. Hash: device_id + registration_timestamp
3. Assign to one of 5 branches:
   - Planning
   - Budget
   - Media
   - Distribution
   - Membership
    ↓
Result: Device assigned to Peace Pentagon Branch
```

---

Step 6: Registration Complete

```
Membership stored
    ↓
POCs assigned
    ↓
Discord roles updated
    ↓
User can now:
    Scan vouchers (as buyer)
    Claim orders (if MEGAvoter/Patron - as seller)
    Receive referral XP (if referred)
```

---

PHASE 7: REFERRAL SYSTEM

Timing: Optional - Can happen anytime  
Purpose: Reward members who invite others to join the network

---

How Referrals Work

Purpose: Reward members who invite others to join the network

Key Points:
- Referrer (inviter) gets XP when someone they invited registers
- XP amount depends on referrer's membership tier
- XP has maturity window (8-12 weeks)
- Annual close rule applies (August 31)

Referral XP Amounts

| Referrer's Tier | XP Amount | USD Equivalent |
|-----------------|-----------|----------------|
| YAM'er | 1 XP | $0.000048 |
| MEGAvoter | 5 XP | $0.000238 |
| Patron | 25 XP | $0.001190 |

Note: XP = 21,000 per $1 USD

---

Step 1: Referrer Shares Link

```
Referrer (existing member) shares referral link
    ↓
Link format: humanblockchain.info/register?ref=REFERRER_ID
    ↓
New user clicks link
```

Referral Link Structure:
- Contains referrer's device_id or user_id
- Stored in URL parameter: `?ref=12345`
- System tracks who referred whom

---

Step 2: New User Registers

```
New user visits referral link
    ↓
Starts device registration
    ↓
System detects referral parameter
    ↓
Stores referrer information
```

Backend Process:
```php
// Extract referrer ID from URL
$referrer_id = $_GET['ref'];

// Store referral relationship
create_referral($referrer_id, $new_device_id);
```

---

Step 3: New User Completes Registration

```
New user completes:
    ✓ Device registration
    ✓ Discord connection (optional)
    ✓ Membership selection
    ↓
Registration complete
```

---

Step 4: System Creates Referral Record

```
Backend Process:
    ↓
1. Get referrer's membership tier
2. Calculate XP amount based on tier:
   - YAM'er → 1 XP
   - MEGAvoter → 5 XP
   - Patron → 25 XP
    ↓
3. Calculate maturity date (8-12 weeks random)
   $weeks = rand(8, 12);
   $maturity_date = date('Y-m-d', strtotime("+$weeks weeks"));
    ↓
4. Create referral record
   INSERT INTO hbc_referrals (
       referrer_wp_user_id,
       referred_device_id,
       xp_amount,
       maturity_date,
       status,
       created_at
   ) VALUES (?, ?, ?, ?, 'pending_maturity', NOW())
    ↓
5. Create XP ledger entry (pending)
   INSERT INTO hbc_xp_ledger (
       entry_type = 'referral_award',
       actor_id = referrer_id,
       amount = xp_amount,
       status = 'pending',
       maturity_date = maturity_date
   )
```

---

Step 5: Referral Status Flow

```
1. pending_maturity
   (Created, waiting for maturity date)
        ↓
2. matured
   (Maturity date reached, XP available)
        ↓
3. void
   (Cancelled if referrer/referred leaves)
```

---

Step 6: Maturity Check (Daily Cron)

```
System runs daily:
    ↓
1. Check all referrals with status = 'pending_maturity'
2. Compare maturity_date with current date
3. If maturity_date <= today:
   → Update status to 'matured'
   → Update XP ledger entry status to 'matured'
    ↓
4. Referrer can now use matured XP
```

---

Step 7: Annual Close (August 31)

```
Special Rule: Annual Close
    ↓
On August 31 each year:
    ↓
1. System waives maturity for completed actions
2. Creates adjustment ledger entries
3. Processes pending referrals
    ↓
On September 1:
    ↓
Referral recognition issued in XP
```

---

Database Structure

Purpose: Technical reference for database tables and relationships

---

Membership Storage

Table: `wp_hb_devices`
```sql
CREATE TABLE wp_hb_devices (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    device_id VARCHAR(36) UNIQUE NOT NULL,
    membership_tier ENUM('yamer', 'megavoter', 'patron') DEFAULT 'yamer',
    membership_selected_at DATETIME NULL,
    buyer_poc_id INT NULL,
    seller_poc_id INT NULL,
    peace_pentagon_branch ENUM('planning', 'budget', 'media', 'distribution', 'membership') NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_membership_tier (membership_tier),
    INDEX idx_buyer_poc (buyer_poc_id),
    INDEX idx_seller_poc (seller_poc_id)
);
```

POC Assignments

Table: `wp_hb_poc_memberships`
```sql
CREATE TABLE wp_hb_poc_memberships (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    device_id BIGINT NOT NULL,
    poc_id INT NOT NULL,
    poc_type ENUM('buyer', 'seller') NOT NULL,
    slot_index INT NULL,  -- 0-4 for seller POCs
    assigned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_device (device_id),
    INDEX idx_poc (poc_id),
    INDEX idx_type (poc_type)
);
```

Referral Storage

Table: `wp_hb_referrals`
```sql
CREATE TABLE wp_hb_referrals (
    referral_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    referrer_wp_user_id BIGINT UNSIGNED NOT NULL,
    referrer_device_id VARCHAR(36) NULL,
    referred_device_id VARCHAR(36) NOT NULL,
    referred_wp_user_id BIGINT UNSIGNED NULL,
    xp_amount INT NOT NULL,  -- 1, 5, or 25
    maturity_date DATE NOT NULL,  -- 8-12 weeks from creation
    status ENUM('pending_action', 'pending_maturity', 'matured', 'void') DEFAULT 'pending_maturity',
    created_at DATETIME NOT NULL,
    matured_at DATETIME NULL,
    INDEX idx_referrer (referrer_wp_user_id),
    INDEX idx_referred_device (referred_device_id),
    INDEX idx_maturity_date (maturity_date),
    INDEX idx_status (status)
);
```

XP Ledger (Referral Entries)

Table: `wp_hb_xp_ledger`
```sql
CREATE TABLE wp_hb_xp_ledger (
    entry_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    entry_type ENUM(
        'device_register',
        'referral_award',  -- Referral XP
        'role_assigned',
        'complimentary_pack_issued',
        'voucher_used',
        'maturity_unlock',
        'annual_close_adjustment',
        'action_completed'
    ) NOT NULL,
    actor_type ENUM('device', 'wp_user', 'system') NOT NULL,
    actor_id VARCHAR(36) NOT NULL,
    amount INT NOT NULL,  -- XP units
    reference_id VARCHAR(36) NULL,  -- Links to referral_id
    metadata JSON NULL,
    status ENUM('pending', 'matured') DEFAULT 'pending',
    maturity_date DATE NULL,
    created_at DATETIME NOT NULL,
    immutable_hash VARCHAR(64) NOT NULL,
    previous_hash VARCHAR(64) NULL,
    INDEX idx_actor (actor_type, actor_id),
    INDEX idx_entry_type (entry_type),
    INDEX idx_reference (reference_id),
    INDEX idx_status (status)
);
```

---

Key Rules

Purpose: Important rules and constraints for system operation

---

Membership Rules

1. All memberships are FREE
   - No payment required
   - No subscription management
   - "Annual" and "Monthly" are labels only

2. Membership Selection
   - Selected during device registration
   - Can be changed later (if allowed)
   - Stored in database permanently

3. Seller Eligibility
   - YAM'ers can be sellers (with "pending" Seller POC assignment)
   - MEGAvoter/Patron can be sellers (with active Seller POC)
   - YAM'ers can send and receive packages (full participation)
   - YAM'ers can pledge $10.30 (as sellers) and earn the full amount
   - YAM'ers can receive 10-pack vouchers/hang tags (as buyers)
   - YAM'ers earn $4 in their Peace Pentagon branch resource (managed by MEGAvoters or 10 PMG)
   - YAM'ers earn $0.50 patronage (if they are the seller)
   - YAM'ers cannot allocate resources (no voice on $4 social impact or treasury reserves allocation decisions)
   - MEGAvoters earn resource allocation rights (by posting 5-seller karaoke)
   - 10 Postmaster Generals (PMG) manage resources (2 from each branch, annual XP leaders)

4. POC Assignment
   - Buyer POC: Everyone gets (local)
   - Seller POC: Everyone gets (global)
     - YAM'er: "pending" status (can send/receive packages)
     - MEGAvoter/Patron: "active" status
   - Assignment is automatic (Serendipity Protocol)

Referral Rules

1. Referrer Must Be Registered
   - Referrer must have completed device registration
   - Referrer must have selected membership tier
   - Referrer must be active member

2. XP Amount Based on Referrer's Tier
   - YAM'er: 1 XP per referral
   - MEGAvoter: 5 XP per referral
   - Patron: 25 XP per referral

3. Maturity Window
   - XP matures after 8-12 weeks (randomized)
   - Status: `pending_maturity` → `matured`
   - Daily cron job checks maturity dates

4. Annual Close Rule
   - August 31: Annual close date
   - Waives maturity for completed actions
   - September 1: Referral recognition issued

5. Referral Tracking
   - One referral per new user
   - Referral links to referrer's user_id or device_id
   - Referral can be voided if member leaves

---

Membership Benefits Summary

Quick Reference: Compare benefits across all membership tiers

---

| Benefit | YAM'er | MEGAvoter | Patron |
|---------|--------|-----------|--------|
| Can be Buyer | Yes | Yes | Yes |
| Can Receive 10-Pack Vouchers/Hang Tags | Yes | Yes | Yes |
| Can be Seller | Yes (pending POC) | Yes (active POC) | Yes (active POC) |
| Can Pledge $10.30 (as Seller) | Yes | Yes | Yes |
| Can Earn $5 XP (as Buyer) | Yes | Yes | Yes |
| Can Send/Receive Packages | Yes | Yes | Yes |
| Buyer POC | Yes | Yes | Yes |
| Seller POC | Yes (pending) | Yes (active) | Yes (active) |
| Earn $4 Branch Resource (as Buyer) | Yes (managed by MEGAvoters/PMG) | Yes (can manage) | Yes (can manage) |
| Earn $0.50 Patronage (as Seller) | Yes | Yes | Yes |
| Resource Allocation Rights | ❌ No (cannot allocate, but receive $4) | Yes (after 5-seller karaoke) | Yes (after 5-seller karaoke) |
| Referral XP | 1 XP | 5 XP | 25 XP |
| Discord Roles | Yes | Yes | Yes |
| Peace Pentagon Branch | Yes | Yes | Yes |

---

10 Postmaster Generals (PMG) Framework

Purpose: Annual XP leaders who manage Peace Pentagon branch resources

---

Overview
The 10 Postmaster Generals are annual XP leaders who manage Peace Pentagon branch resources alongside qualified MEGAvoters. They are an integral part of the resource allocation framework.

Structure
- 10 PMG total: 2 from each Peace Pentagon branch
- 5 Branches: Planning, Budget, Media, Distribution, Membership
- Selection: Annual XP leaders from each branch (top 2 performers)
- Term: Annual (selected based on XP accumulation)

Role & Authority
- Resource Management: Manage $4 social impact funds for their branch
- Allocation Rights: Can allocate resources alongside qualified MEGAvoters
- Recognition: Top performers in XP accumulation annually
- Governance: Part of the framework for resource allocation decisions
- YAM'er Resources: Manage $4 branch resources that YAM'ers earn (alongside MEGAvoters)

Key Responsibilities
- Manage $4 Branch Resources: When YAM'ers, MEGAvoters, or Patrons receive $4 in their Peace Pentagon branch resource (from buyer scans), PMG and qualified MEGAvoters manage these funds
- Allocation Decisions: Make decisions about how branch resources are allocated for social impact
- Annual Selection: Selected at end of year based on XP accumulation within each branch

YAM'er Resource Allocation Details

When YAM'er is the Buyer:
```
YAM'er receives 10-pack vouchers/hang tags
    ↓
YAM'er scans QR code (as buyer)
    ↓
System allocates resources:
    ✓ $4 → YAM'er's Peace Pentagon branch resource
       • Managed by MEGAvoters or 10 PMG
       • YAM'er receives the $4 in their branch
       • YAM'er cannot allocate (no voice in allocation decisions)
    ✓ $1 Patronage breakdown:
      • $0.50 → Credited to YAM'er (if YAM'er is the seller)
      • $0.40 → Group bonus → Treasury
      • $0.10 → Treasury allocation → Treasury
```

When YAM'er is the Seller:
```
YAM'er pledges $10.30 (as seller)
    ↓
YAM'er scans QR code (as seller)
    ↓
System creates XP entry:
    ✓ YAM'er receives $10.30 pledged
    ✓ Stored as XP conversion (pending buyer confirmation)
    ↓
When buyer scans:
    ✓ YAM'er's $10.30 XP status: "Confirmed"
    ✓ YAM'er earns $0.50 patronage (from $1 patronage breakdown)
```

Key Points:
- YAM'ers can receive $4 in their Peace Pentagon branch resource (as buyers)
- YAM'ers cannot allocate the $4 (no voice in allocation decisions)
- YAM'ers can earn $0.50 patronage (if they are the seller)
- 10 PMG and qualified MEGAvoters manage the $4 branch resources

Database Structure
```sql
CREATE TABLE wp_hb_postmaster_generals (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    device_id VARCHAR(36) NOT NULL,
    peace_pentagon_branch ENUM('planning', 'budget', 'media', 'distribution', 'membership') NOT NULL,
    year INT NOT NULL,
    total_xp INT NOT NULL,
    rank_in_branch INT NOT NULL,  -- 1 or 2 (top 2)
    selected_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_branch_year (peace_pentagon_branch, year),
    INDEX idx_device (device_id)
);
```

Selection Process
```
Annual Selection (End of Year):
    ↓
1. Calculate XP totals for all members by branch
2. Rank members within each branch
3. Select top 2 from each branch (5 branches × 2 = 10)
4. Assign PMG status for next year
5. Update database with PMG assignments
    ↓
Result: 10 Postmaster Generals selected
```

---

Updated Complete Flow Diagram (Including Membership & Referral)

```
┌─────────────────────────────────────────────────────────┐
│         PHASE 1: SETUP (Optional - Anytime)             │
│  Option A: Activate Device (Anonymous)                  │
│  Option B: Register Account → Activate Device           │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 2: USER ACCOUNT (When Needed)              │
│  Login/Register → Link Device to Account                │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 6: MEMBERSHIP SELECTION                   │
│  Choose Tier → POC Assignment → Discord Roles           │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 7: REFERRAL SYSTEM (Optional)             │
│  Share Link → New User Registers → XP Awarded          │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 3: ORDER (WooCommerce)                    │
│  Customer → WooCommerce → REST API → Backorder Pool    │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 4: ADMIN ASSIGNMENT                       │
│  Admin → Assign Order → Seller Accepts → Claimed       │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 5: SELLER SCAN (Scan 1)                   │
│  Scan QR → "Proof?" → Role → LOGIN → Device Check →    │
│  Order Lookup → "Final?" → Process → NWP → $10.30 XP   │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│         PHASE 6: BUYER SCAN (Scan 2)                    │
│  Scan QR → "Proof?" → Role → LOGIN → Device Check →    │
│  Order Lookup → Verify Seller → "Final?" → Process →   │
│  NWP → $5 XP → Seller XP Confirmed → Resource Alloc.    │
└─────────────────────────────────────────────────────────┘
```

---

Complete Summary

Purpose: Comprehensive summary of all system components

---

Device Activation
- Quick, anonymous, optional
- Can be linked to user account later
- One device = one identity

User Account
- Required for scanning, XP, orders
- Login required before scanning
- Device links automatically when user logs in

Membership System
- Three tiers: YAM'er (Free), MEGAvoter (Annual), Patron (Monthly)
- All free: No payment required
- Selection: During device registration
- Effects: POC assignment, seller eligibility, referral XP amounts, resource allocation rights

Referral System
- Purpose: Reward members who invite others
- XP amounts: 1/5/25 based on referrer's tier
- Maturity: 8-12 weeks before XP is available
- Annual close: August 31 waives maturity, September 1 issues recognition

Key Database Tables
- `wp_hb_devices` - Stores device info and membership tier
- `wp_hb_poc_memberships` - Stores POC assignments
- `wp_hb_referrals` - Stores referral relationships
- `wp_hb_xp_ledger` - Stores XP entries (including referrals)
- `wp_hb_postmaster_generals` - Stores PMG assignments

---

---

DOCUMENT FOOTER

Last Updated: January 2025
Version: 2.0
Status: Complete Recommended System Flow (Including Membership & Referral)
Maintained By: HumanBlockchain Development Team

---

*This document serves as the complete reference guide for the HumanBlockchain.info system flow, including device activation, user accounts, order fulfillment, membership tiers, referral system, and resource allocation.*
