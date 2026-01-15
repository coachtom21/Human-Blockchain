# HumanBlockchain System Flow
## Complete User Journey - Client Overview

**Date:** January 2025  
**Purpose:** Visual overview of the complete system flow from order to delivery confirmation

---

## 🎯 System Overview

The HumanBlockchain system enables a **2-scan Proof of Delivery** process where:
- **Sellers** deliver products and initiate delivery records
- **Buyers** confirm receipt and complete the delivery
- **XP (loyalty points)** are recorded when both scans complete
- **No money flows through the system** - VFN handles money separately

---

## 📦 Phase 1: Product Order (WooCommerce - MEGAvoter Site)

### Step 1: Customer Places Order
```
Customer visits MEGAvoter site
    ↓
Browses products (Hang Tags or Stickers)
    ↓
Places preorder/backorder for 10-Pack
    ↓
Order created in WooCommerce
```

**What Happens:**
- Order stored in WooCommerce
- Order synced to VFN backorder pool
- System prepares for fulfillment

---

## 🚚 Phase 2: Admin Assignment & Seller Claim

### Step 2: Admin Assigns Order to Seller
```
Admin logs into dashboard (humanblockchain.info)
    ↓
Views "Available Backorders" (from WooCommerce)
    ↓
Selects order #12345
    ↓
Clicks "Assign to Seller"
    ↓
Selects seller from list (MEGAvoter/Patron members only)
    ↓
Clicks "Send Claim Request"
    ↓
System sends notification to seller
    ↓
Order status: "Pending Claim" (waiting for seller)
```

**What Happens:**
- Order synced from WooCommerce via REST API
- Admin assigns order to specific seller
- Only MEGAvoter/Patron members can be assigned (seller restriction)
- Notification sent to seller

### Step 3: Seller Accepts Claim Request
```
Seller receives notification:
    - Email: "You have a new delivery request"
    - Dashboard: "My Claim Requests"
    ↓
Seller logs in → Views "My Claim Requests"
    ↓
Sees Order #12345 assigned by admin
    ↓
Clicks "Accept Claim" or "Reject Claim"
    ↓
If ACCEPT:
    → Order status: "Claimed"
    → Linked to seller_device_id
    → 7-day deadline starts
    → Seller can now deliver
    ↓
If REJECT:
    → Order status: "Rejected"
    → Admin notified
    → Admin can reassign to different seller
```

**What Happens:**
- Seller accepts/rejects claim request
- If accepted: Order linked to seller, 7-day deadline starts
- If rejected: Admin can reassign to another seller

### Step 4: Seller Prepares Delivery
```
Seller accepts claim request
    ↓
Prints product with universal QR code
    ↓
Attaches QR code label to product
    ↓
Product ready for delivery
```

**Physical Label Design:**
```
┌─────────────────────────┐
│   [Universal QR Code]   │
│   (Same for ALL orders) │
│   URL: humanblockchain. │
│        info/?proof_type=│
│        scan             │
│                         │
│   Order #: 12345        │
│   Voucher: 3 of 10      │
│   Type: Hang Tag        │
└─────────────────────────┘
```

**Important:**
- **QR Code contains ONLY:** `humanblockchain.info/?proof_type=scan`
- **NO order ID, voucher number, or type in QR code**
- Order number, voucher number, and type are **printed as text** on the label (for reference only)
- **System auto-detects order from database** (no manual entry needed)

**What Happens:**
- Universal QR code printed (identical for all products)
- QR code redirects to scan page with `proof_type=scan` parameter
- System verifies proof_type parameter
- System queries database to find assigned orders for seller/buyer
- Order number and voucher number printed as text on label (reference only)
- Product ready for delivery

---

## 📱 Phase 3: Seller Scan (Scan 1 - Delivery Initiation)

### Step 5: Seller Scans QR Code
```
Seller delivers product to buyer
    ↓
Seller scans universal QR code
    ↓
QR contains: humanblockchain.info/?proof_type=scan
    ↓
Redirects to scan page
```

### Step 6: Proof of Delivery Popup (First)
```
Popup: "Is this proof of delivery?"
    ↓
[YES] → Continue
[NO] → Exit (no record created)
```

### Step 7: Role Selection Popup
```
Popup: "What is your role?"
    ↓
○ I am the Seller (delivering this product) ← Select this
○ I am the Buyer (receiving this product)
    ↓
[Continue]
```

### Step 8: Login Status Check
```
System checks: Is user logged in?
    ↓
If NOT logged in:
    → Login page (Email + Password)
    → After login, continue
    ↓
If logged in:
    → Continue to device check
```

### Step 9: Device Activation (If Needed)
```
System checks: Is device registered?
    ↓
If device NOT registered:
    → Device activation flow
    → Register device
    → Return to scan flow
    ↓
If device registered:
    → Continue to database lookup
```

### Step 10: Check Database for Claimed Orders
```
System queries database:
    - Get seller's device_id (from logged-in user)
    - Check wp_vfn_backorder_pool table
    - Find orders where: assigned_to_seller_id = seller_device_id
    - Filter: pool_status = 'claimed' AND initiation_deadline > NOW()
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

### Step 11: Confirm Destination (Required)
```
Popup: "Is this the final destination?"
    ↓
[YES] → Final delivery (goes directly to buyer)
[NO] → In-transit handoff (intermediate delivery person)
    ↓
[Continue]
```

### Step 12: Process Seller Scan & Issue NWP
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
    ✓ NWP issued to seller (recognizes delivery person)
    ✓ NWP recorded in ledger
    ✓ NWP type: "handoff" (if NO) or "final_delivery" (if YES)
    ↓
System creates XP entry:
    ✓ Seller receives $10.30 pledged
    ✓ Stored as XP conversion (pending)
    ✓ Status: "Pending" (waiting for buyer scan)
    ↓
Message: "Delivery initiated. New World Penny issued. $10.30 XP recorded (pending buyer confirmation)."
```

**What Happens:**
- ✅ STXID created (unique transaction ID)
- ✅ Seller scan recorded
- ✅ **New World Penny (NWP) issued** (recognizes delivery person)
- ✅ Voucher status: "Seller Scanned"
- ✅ Seller receives $10.30 pledged → Stored as XP conversion (pending)
- ⏳ Waiting for buyer scan to confirm

---

## 📦 Phase 4: Buyer Receives Product

### Step 13: Buyer Receives Delivery
```
Buyer receives product with QR code label
    ↓
Buyer scans same universal QR code
    ↓
QR contains: humanblockchain.info/?proof_type=scan
    ↓
Redirects to scan page
```

### Step 14: Proof of Delivery Popup (First)
```
Popup: "Is this proof of delivery?"
    ↓
[YES] → Continue
[NO] → Exit (no record created)
```

### Step 15: Role Selection Popup
```
Popup: "What is your role?"
    ↓
○ I am the Seller (delivering this product)
○ I am the Buyer (receiving this product) ← Select this
    ↓
[Continue]
```

### Step 16: Login Status Check
```
System checks: Is user logged in?
    ↓
If NOT logged in:
    → Login page (Email + Password)
    → After login, continue
    ↓
If logged in:
    → Continue to device check
```

### Step 17: Device Activation (If Needed)
```
System checks: Is device registered?
    ↓
If device NOT registered:
    → Device activation flow
    → Register device
    → Return to scan flow
    ↓
If device registered:
    → Continue to database lookup
```

### Step 18: Check Database for Existing Orders
```
System queries database:
    - Get buyer's device_id (from logged-in user)
    - Check wp_vfn_backorder_pool table
    - Find orders with seller_scanned status (waiting for buyer)
    - Sort by latest first
    ↓
If only ONE order waiting for buyer scan:
    → Auto-select that order
    → Continue to seller scan verification
    ↓
If MULTIPLE orders waiting for buyer scan:
    → Show list: "Which order are you scanning?" (Latest first)
    → [Order #12345] [Order #12346] [Order #12347]
    → User selects order
    ↓
If NO orders found:
    → Error: "No pending deliveries found."
```

### Step 19: Verify Seller Scan in Database
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

### Step 20: Confirm Destination (Required)
```
Popup: "Is this the final destination?"
    ↓
[YES] → Final delivery (end customer receives)
[NO] → In-transit handoff (intermediate delivery person)
    ↓
[Continue]
```

### Step 21: Process Buyer Scan, Issue NWP & Create XP
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
    ✓ NWP issued to buyer (recognizes delivery person)
    ✓ NWP recorded in ledger
    ✓ NWP type: "handoff" (if NO) or "final_delivery" (if YES)
    ↓
System creates XP entries:
    ✓ Buyer receives $5 pledged
    ✓ Stored as XP conversion
    ✓ Status: "Pending" (matures 8-12 weeks)
    ↓
System releases seller XP:
    ✓ Seller's $10.30 XP status: "Confirmed"
    ✓ Both XP entries now active
    ↓
System allocates resources (if seller is YAM'er):
    ✓ $4 → Peace Pentagon branch resource (managed by MEGAvoters/10 PMG)
    ✓ $1 Patronage breakdown:
      • $0.50 → Credited to YAM'er seller
      • $0.40 → Group bonus → Treasury
      • $0.10 → Treasury allocation → Treasury
    ↓
Message: "Delivery confirmed! New World Penny issued. $5 XP recorded."
```

**What Happens:**
- ✅ Buyer scan recorded
- ✅ **New World Penny (NWP) issued** (recognizes delivery person)
- ✅ Voucher status: "Completed"
- ✅ Buyer receives $5 pledged → Stored as XP conversion
- ✅ Seller's $10.30 XP confirmed (released from pending)
- ✅ **Resource allocation** (if YAM'er seller: $4 to branch, $1 patronage split)
- ✅ XP status: "Pending" (matures in 8-12 weeks)
- ✅ Transaction complete

**System Validation:**
- ✅ Checks: Has seller scanned this voucher?
- ✅ Checks: Is this the correct voucher number?
- ✅ Checks: Different device from seller?
- ✅ If seller hasn't scanned → Error: "Seller hasn't initiated delivery yet"

---

## 🔄 Complete Flow Diagram

```
┌─────────────────────────────────────────────────────────┐
│                    PHASE 1: ORDER                       │
│  Customer → WooCommerce → REST API → Backorder Pool   │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│              PHASE 2: ADMIN ASSIGNMENT                 │
│  Admin Dashboard → Assign Order → Send Claim Request   │
│  → Seller Accepts → Order Claimed (7-day deadline)     │
│  → Seller Prints QR → Attaches to Product              │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│              PHASE 3: SELLER SCAN (Scan 1)             │
│  Scan QR → "Proof?" → Select "Seller" → Login →       │
│  Device Check → Database Lookup → Select Order →       │
│  "Final Destination?" → Process → NWP Issued →        │
│  $10.30 XP (pending) → Status: "Initiated"            │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│              PHASE 4: BUYER RECEIVES                    │
│  Buyer Gets Product → Scans QR → "Proof?" →            │
│  Select "Buyer" → Login → Device Check →               │
│  Database Lookup → Select Order → Verify Seller Scan →│
│  "Final Destination?" → Process → NWP Issued →        │
│  $5 XP → Seller XP Confirmed → Resource Allocation →  │
│  "Completed"                                            │
└─────────────────────────────────────────────────────────┘
```

---

## 📊 Key System Features

### ✅ Admin Assignment System
- **Admin controls** who gets which orders
- Admin assigns orders to sellers (MEGAvoter/Patron only)
- Seller accepts/rejects claim request
- Better quality control and tracking

### ✅ Seller Restrictions
- **YAM'ers can be sellers** (with "pending" Seller POC assignment)
- **MEGAvoter/Patron** can be sellers (active Seller POC)
- **YAM'ers can send and receive packages** (full participation)
- **YAM'ers cannot allocate resources** (no voice on $4 social impact or treasury reserves)
- **MEGAvoters earn resource allocation rights** (by posting 5-seller karaoke)
- **Anyone can be buyer** (all members get Buyer POC)
- Same person can be seller in one transaction, buyer in another

### ✅ Universal QR Code
- **One QR code format** for all products (same URL)
- **QR Code URL:** `humanblockchain.info/?proof_type=scan`
- **NO data in QR code** (no order ID, voucher number, or type)
- Order number, voucher number, and type **printed as text** on label (reference only)
- Can be printed in bulk (identical QR for all products)
- **System auto-detects order from database** (no manual entry)
- System verifies `proof_type=scan` parameter
- Database lookup matches seller/buyer to assigned orders

### ✅ Order-Based Tracking
- Each 10-pack order = 10 vouchers
- Vouchers tracked by: Order Number + Voucher Number (1-10)
- Each voucher can be scanned independently
- Data stored in humanblockchain.info database

### ✅ Login & Device Activation
- **Email + Password login** required
- Device activation after login (if not registered)
- Device ID stored with each scan
- Enables XP tracking and order association

### ✅ Automatic Order Detection
- **Seller:** System queries database for assigned orders
  - Checks `wp_vfn_backorder_pool` table
  - Finds orders where `assigned_to_seller_id` = seller's device_id
  - Auto-selects if only one, shows list if multiple
- **Buyer:** System queries database for buyer's orders
  - Checks `wp_vfn_backorder_pool` table
  - Finds orders with `seller_scanned` status (waiting for buyer)
  - Auto-selects if only one, shows list if multiple
- **No manual entry required** - all from database
- Reduces errors and improves UX

### ✅ Role Selection
- User selects: "Seller" or "Buyer"
- System validates based on voucher status
- Prevents fraud (seller ≠ buyer, different devices)

### ✅ 2-Scan Process
- **Scan 1 (Seller):** Initiates delivery, creates STXID
- **Scan 2 (Buyer):** Confirms receipt, creates XP
- Both scans required for XP
- Different devices required (seller ≠ buyer)

### ✅ XP System
- **Seller:** Receives $10.30 pledged → Stored as XP conversion (pending buyer scan)
- **Buyer:** Receives $5 pledged → Stored as XP conversion (after confirming delivery)
- **Seller XP:** Confirmed/released when buyer scans
- **Both XP:** Status "Pending" (matures 8-12 weeks)
- XP is conversion of pledged amounts, not separate entries

### ✅ New World Penny (NWP) System
- **NWP issued with every handoff** (intermediate delivery person)
- **NWP issued with every final delivery** (end customer)
- **Purpose:** Recognize delivery people who make trade possible
- **NWP enables daily XP accumulation** for those involved in delivery
- **NWP recorded in ledger** for transparency

### ✅ Resource Allocation System
- **$4 Social Impact:** Goes to Peace Pentagon branch resource
  - Managed by MEGAvoters (who qualify by posting 5-seller karaoke)
  - Or managed by 10 Postmaster Generals (2 from each branch)
- **$1 Patronage Breakdown:**
  - $0.50 → Credited to YAM'er seller (if applicable)
  - $0.40 → Group bonus → Treasury
  - $0.10 → Treasury allocation → Treasury
- **YAM'ers cannot decide resource allocation** (no voice on spending)
- **MEGAvoters have resource allocation rights** (earned through karaoke qualification)

### ✅ 10 Postmaster Generals (PMG) Framework
- **10 PMG total:** 2 from each Peace Pentagon branch (5 branches × 2 = 10)
- **Selection:** Annual XP leaders from each branch
- **Role:** Manage Peace Pentagon branch resources ($4 social impact)
- **Authority:** Can allocate resources alongside qualified MEGAvoters
- **Recognition:** Top performers in XP accumulation annually

### ✅ MEGAvoter Qualification System
- **Resource Allocation Rights:** Earned by posting 5-seller karaoke
- **Qualification Process:** MEGAvoter must complete 5 seller transactions (karaoke)
- **After Qualification:** MEGAvoter can manage $4 social impact funds
- **Works with PMG:** Qualified MEGAvoters and 10 PMG manage resources together

---

## 🎯 Status Flow

### Backorder Pool Status:
```
1. Eligible
   (Order synced, waiting for admin assignment)
        ↓
2. Pending Claim
   (Admin assigned, waiting for seller to accept)
        ↓
3. Claimed
   (Seller accepted, 7-day deadline active)
        ↓
4. Initiated
   (Seller scanned, waiting for buyer)
        ↓
5. Fulfilled
   (Buyer scanned, XP created)
```

### Voucher Status:
```
1. Active
   (Order placed, not scanned yet)
        ↓
2. Seller Scanned
   (Seller initiated, waiting for buyer)
        ↓
3. Completed
   (Both scans done, XP created)
```

### Transaction Status:
```
1. Initiated
   (STXID created, seller scanned)
        ↓
2. Fulfilled
   (Buyer scanned, XP created)
```

---

## 💡 Important Points

### ✅ What Works:
- Admin assignment system (quality control)
- Seller restrictions (MEGAvoter/Patron only)
- Universal QR code (contains only redirect URL, no data)
- Order-based tracking (Order # + Voucher #)
- Login with email/password
- Device activation after login
- Smart order selection (auto-detect for sellers)
- Role selection (clear user intent)
- 2-scan validation (seller + buyer)
- XP only after buyer confirms

### ✅ Data Storage:
- All data stored in humanblockchain.info database
- WooCommerce orders synced via REST API
- Order and voucher tracking in custom tables

### ✅ User Experience:
- **Sellers:** System auto-detects claimed orders from database
- **Buyers:** System auto-detects pending orders from database
- **Both:** Login required, device activation if needed
- **No manual entry:** All order info retrieved from database

---

## 📋 Summary

**Complete Journey:**
1. Customer orders 10-pack on WooCommerce (MEGAvoter site)
2. Order synced to humanblockchain.info via REST API
3. Admin assigns order to seller (YAM'er/MEGAvoter/Patron can be sellers)
4. Seller accepts claim request
5. Seller prints universal QR labels and delivers
6. Seller scans QR → "Proof?" → Select "Seller" → Login → Device activation → Database lookup → Select order → "Is this final destination?" → Process → **NWP issued** → $10.30 XP (pending)
7. Buyer receives and scans same QR → "Proof?" → Select "Buyer" → Login → Device activation → Database lookup → Select order → Verify seller scan → "Is this final destination?" → Process → **NWP issued** → $5 XP → Seller XP confirmed → Resource allocation ($4 to branch, $1 patronage split)
8. XP recorded when both scans complete
9. **NWP recognizes delivery people** at every handoff and final delivery

**Key Requirements:**
- Admin assignment system (admin controls who gets orders)
- Seller restrictions (YAM'er/MEGAvoter/Patron can be sellers)
- YAM'ers have "pending" Seller POC (can send/receive packages)
- Universal QR code (contains only: `humanblockchain.info/?proof_type=scan`)
- System verifies `proof_type=scan` parameter
- Automatic order detection from database (no manual entry)
- Order number + Voucher number tracking
- Login with email/password
- Device activation after login
- Role selection (Seller/Buyer)
- "Is this final destination?" question (required for both scans)
- New World Penny (NWP) issued with every handoff and final delivery
- 2-scan validation (different devices)
- XP only after buyer scan
- Resource allocation ($4 to branch, $1 patronage split)
- MEGAvoter qualification (5-seller karaoke for resource allocation rights)
- 10 Postmaster Generals framework (2 from each branch, annual XP leaders)
- All data stored in humanblockchain.info

---

**Last Updated:** January 2025  
**Status:** Updated with NWP System, YAM'er Seller Capabilities, Resource Allocation, and PMG Framework  
**Version:** 3.0
