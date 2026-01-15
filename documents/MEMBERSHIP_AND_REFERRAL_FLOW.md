# Membership & Referral Flow
## Complete System Guide

**Date:** January 2025  
**Purpose:** Clear explanation of membership tiers and referral system

---

## 📋 Table of Contents

1. [Membership System](#membership-system)
2. [Membership Flow](#membership-flow)
3. [Referral System](#referral-system)
4. [Referral Flow](#referral-flow)
5. [Database Structure](#database-structure)
6. [Key Rules](#key-rules)

---

## 🎯 Membership System

### Three Membership Tiers

| Tier | Cost | Description | Can Be Seller? | Seller POC | Resource Allocation Rights | Referral XP |
|------|------|-------------|----------------|------------|---------------------------|-------------|
| **YAM'er** | Free | "Participate in Proof of Delivery" | ✅ Yes | Pending | ❌ No | 1 XP |
| **MEGAvoter** | Free | "Guide social impact decisions" | ✅ Yes | Active | ✅ Yes (after 5-seller karaoke) | 5 XP |
| **Patron** | Free | "Support and scale the network" | ✅ Yes | Active | ✅ Yes (after 5-seller karaoke) | 25 XP |

### Important Notes

- **All memberships are FREE** - No payment required
- **"Annual" and "Monthly"** are commitment labels, NOT payment terms
- **Membership affects:**
  - POC (Point of Contact) assignment
  - Seller eligibility
  - Referral XP amounts
  - Discord role assignment

---

## 🔄 Membership Flow

### Step 1: User Registers Device

```
User visits humanblockchain.info
    ↓
Starts device registration
    ↓
Device ID created
    ↓
Geo-location captured
```

### Step 2: User Connects Discord

```
User clicks "Connect Discord"
    ↓
OAuth2 flow completes
    ↓
Discord user ID stored
    ↓
Discord roles assigned
```

### Step 3: Membership Selection Screen

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

**UI Elements:**
- Heading: "Choose your participation level"
- Subtext: "You can change this later."
- Three membership options with descriptions
- Footer: "Referral recognition is issued annually in XP on September 1."

### Step 4: System Stores Membership

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

### Step 5: POC Assignment (Automatic)

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

**Database:**
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

**Database:**
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

### Step 6: Registration Complete

```
Membership stored
    ↓
POCs assigned
    ↓
Discord roles updated
    ↓
User can now:
    ✅ Scan vouchers (as buyer)
    ✅ Claim orders (if MEGAvoter/Patron - as seller)
    ✅ Receive referral XP (if referred)
```

---

## 🎁 Referral System

### How Referrals Work

**Purpose:** Reward members who invite others to join the network

**Key Points:**
- Referrer (inviter) gets XP when someone they invited registers
- XP amount depends on referrer's membership tier
- XP has maturity window (8-12 weeks)
- Annual close rule applies (August 31)

### Referral XP Amounts

| Referrer's Tier | XP Amount | USD Equivalent |
|-----------------|-----------|----------------|
| YAM'er | 1 XP | $0.000048 |
| MEGAvoter | 5 XP | $0.000238 |
| Patron | 25 XP | $0.001190 |

**Note:** XP = 21,000 per $1 USD

---

## 🔄 Referral Flow

### Step 1: Referrer Shares Link

```
Referrer (existing member) shares referral link
    ↓
Link format: humanblockchain.info/register?ref=REFERRER_ID
    ↓
New user clicks link
```

**Referral Link Structure:**
- Contains referrer's device_id or user_id
- Stored in URL parameter: `?ref=12345`
- System tracks who referred whom

### Step 2: New User Registers

```
New user visits referral link
    ↓
Starts device registration
    ↓
System detects referral parameter
    ↓
Stores referrer information
```

**Backend Process:**
```php
// Extract referrer ID from URL
$referrer_id = $_GET['ref'];

// Store referral relationship
create_referral($referrer_id, $new_device_id);
```

### Step 3: New User Completes Registration

```
New user completes:
    ✓ Device registration
    ✓ Discord connection
    ✓ Membership selection
    ↓
Registration complete
```

### Step 4: System Creates Referral Record

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

### Step 5: Referral Status Flow

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

### Step 6: Maturity Check (Daily Cron)

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

### Step 7: Annual Close (August 31)

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

## 🗄️ Database Structure

### Membership Storage

**Table: `wp_hb_devices`**
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

### POC Assignments

**Table: `wp_hb_poc_memberships`**
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

### Referral Storage

**Table: `wp_hb_referrals`**
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

### XP Ledger (Referral Entries)

**Table: `wp_hb_xp_ledger`**
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

## 📊 Complete Flow Diagrams

### Membership Flow

```
User Registration
    ↓
Device Registration
    ↓
Discord Connection
    ↓
Membership Selection
    ├─ YAM'er → Buyer POC only
    ├─ MEGAvoter → Buyer POC + Seller POC
    └─ Patron → Buyer POC + Seller POC
    ↓
POC Assignment (Automatic)
    ├─ Buyer POC (Local)
    ├─ Seller POC (Global, if MEGAvoter/Patron)
    └─ Peace Pentagon Branch
    ↓
Registration Complete
```

### Referral Flow

```
Referrer Shares Link
    ↓
New User Clicks Link
    ↓
New User Registers
    ↓
System Creates Referral Record
    ├─ Get referrer's tier
    ├─ Calculate XP (1/5/25)
    ├─ Set maturity date (8-12 weeks)
    └─ Create XP ledger entry (pending)
    ↓
Daily Maturity Check
    ├─ Check if maturity_date reached
    └─ Update status to 'matured'
    ↓
Annual Close (Aug 31)
    ├─ Waive maturity for completed actions
    └─ Issue referral recognition (Sep 1)
    ↓
Referrer Receives XP
```

---

## 🚨 Key Rules

### Membership Rules

1. **All memberships are FREE**
   - No payment required
   - No subscription management
   - "Annual" and "Monthly" are labels only

2. **Membership Selection**
   - Selected during device registration
   - Can be changed later (if allowed)
   - Stored in database permanently

3. **Seller Eligibility**
   - **YAM'ers can be sellers** (with "pending" Seller POC assignment)
   - **MEGAvoter/Patron can be sellers** (with active Seller POC)
   - **YAM'ers can send and receive packages** (full participation)
   - **YAM'ers cannot allocate resources** (no voice on $4 social impact or treasury reserves)
   - **MEGAvoters earn resource allocation rights** (by posting 5-seller karaoke)

4. **POC Assignment**
   - Buyer POC: Everyone gets (local)
   - Seller POC: Everyone gets (global)
     - YAM'er: "pending" status (can send/receive packages)
     - MEGAvoter/Patron: "active" status
   - Assignment is automatic (Serendipity Protocol)

### Referral Rules

1. **Referrer Must Be Registered**
   - Referrer must have completed device registration
   - Referrer must have selected membership tier
   - Referrer must be active member

2. **XP Amount Based on Referrer's Tier**
   - YAM'er: 1 XP per referral
   - MEGAvoter: 5 XP per referral
   - Patron: 25 XP per referral

3. **Maturity Window**
   - XP matures after 8-12 weeks (randomized)
   - Status: `pending_maturity` → `matured`
   - Daily cron job checks maturity dates

4. **Annual Close Rule**
   - August 31: Annual close date
   - Waives maturity for completed actions
   - September 1: Referral recognition issued

5. **Referral Tracking**
   - One referral per new user
   - Referral links to referrer's user_id or device_id
   - Referral can be voided if member leaves

---

## 💡 Important Points

### Membership Benefits Summary

| Benefit | YAM'er | MEGAvoter | Patron |
|---------|--------|-----------|--------|
| Can be Buyer | ✅ Yes | ✅ Yes | ✅ Yes |
| Can be Seller | ✅ Yes (pending POC) | ✅ Yes (active POC) | ✅ Yes (active POC) |
| Can Send/Receive Packages | ✅ Yes | ✅ Yes | ✅ Yes |
| Buyer POC | ✅ Yes | ✅ Yes | ✅ Yes |
| Seller POC | ✅ Yes (pending) | ✅ Yes (active) | ✅ Yes (active) |
| Resource Allocation Rights | ❌ No | ✅ Yes (after 5-seller karaoke) | ✅ Yes (after 5-seller karaoke) |
| Referral XP | 1 XP | 5 XP | 25 XP |
| Discord Roles | ✅ Yes | ✅ Yes | ✅ Yes |
| Peace Pentagon Branch | ✅ Yes | ✅ Yes | ✅ Yes |

### Referral XP Timeline

```
Day 0: New user registers
    ↓
Referral record created
XP entry created (status: pending)
    ↓
Week 8-12: Maturity date reached
    ↓
Daily cron updates status to 'matured'
    ↓
Referrer can use matured XP
    ↓
August 31: Annual close
    ↓
September 1: Referral recognition issued
```

---

## 📋 Summary

### Membership System
- **Three tiers:** YAM'er (Free), MEGAvoter (Annual), Patron (Monthly)
- **All free:** No payment required
- **Selection:** During device registration
- **Effects:** POC assignment, seller eligibility, referral XP amounts, resource allocation rights

### Key Updates
- **YAM'ers can be sellers** (with "pending" Seller POC assignment)
- **YAM'ers can send and receive packages** (full participation)
- **YAM'ers cannot allocate resources** (no voice on $4 social impact or treasury reserves)
- **MEGAvoters earn resource allocation rights** (by posting 5-seller karaoke)
- **10 Postmaster Generals (PMG)** - 2 from each branch, annual XP leaders, manage resources

### Referral System
- **Purpose:** Reward members who invite others
- **XP amounts:** 1/5/25 based on referrer's tier
- **Maturity:** 8-12 weeks before XP is available
- **Annual close:** August 31 waives maturity, September 1 issues recognition

### Key Database Tables
- `wp_hb_devices` - Stores membership tier
- `wp_hb_poc_memberships` - Stores POC assignments
- `wp_hb_referrals` - Stores referral relationships
- `wp_hb_xp_ledger` - Stores XP entries (including referrals)

---

---

## 🏆 10 Postmaster Generals (PMG) Framework

### Overview
The 10 Postmaster Generals are annual XP leaders who manage Peace Pentagon branch resources alongside qualified MEGAvoters.

### Structure
- **10 PMG total:** 2 from each Peace Pentagon branch
- **5 Branches:** Planning, Budget, Media, Distribution, Membership
- **Selection:** Annual XP leaders from each branch (top 2 performers)
- **Term:** Annual (selected based on XP accumulation)

### Role & Authority
- **Resource Management:** Manage $4 social impact funds for their branch
- **Allocation Rights:** Can allocate resources alongside qualified MEGAvoters
- **Recognition:** Top performers in XP accumulation annually
- **Governance:** Part of the framework for resource allocation decisions

### Database Structure
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

### Selection Process
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

**Last Updated:** January 2025  
**Status:** Complete Reference Guide (Updated with YAM'er Seller Capabilities & PMG Framework)
