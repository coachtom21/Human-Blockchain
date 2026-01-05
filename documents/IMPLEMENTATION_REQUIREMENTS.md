# Implementation Requirements for Small Street Applied DAO

Based on the documentation files in this directory, here's a comprehensive list of what needs to be implemented:

## 1. Database Schema (MySQL/MariaDB)

### Core Tables Required:

#### 1.1 Members & Identity
- **`members`** table
  - Core identity fields (discord_id, email, phone, country, region, city, lat/lng)
  - Registration timestamp (for serendipity logic)
  - Device fingerprint
  - Branch assignment (planning, budget, media, distribution, membership)
  - Role (yammer, megvoter, patron)
  - Buyer POC ID and Seller POC ID references

#### 1.2 POC (Proof of Cooperation) System
- **`pocs`** table
  - Type (buyer/seller)
  - Branch assignment
  - Region key (e.g., "US-GA-ATL" or "GLOBAL-MEDIA-GENERAL")
  - Max members (30 for buyer POCs, 5 for seller POCs)

- **`poc_members`** table
  - Links members to POCs
  - Role in POC (buyer/seller/coach)
  - Slot index (0-4 for seller POCs)

- **`buyer_assignments`** table
  - Links buyers to sellers (25-buyer network per seller)
  - Tracks seller POC assignments

#### 1.3 Proof of Delivery (PoD) System
- **`pods`** table
  - Buyer and seller IDs
  - Transaction UID (from QR/scan system)
  - Amount USD (default $10.30)
  - Status (initiated, buyer_scanned, completed, reconciled)
  - Rebate status (pending, fulfilled, not_applicable)
  - Timestamps (created, completed, reconciled)

- **`delivery_heroes`** table (mentioned in PHP doc)
  - XP awarded
  - New world pennies
  - Seller POC endorsement ID
  - Transaction ID
  - Device ID
  - Geo coordinates (lat/lng)
  - Timestamp

#### 1.4 MSB Settlements (Money Service Business)
- **`msb_settlements`** table
  - Links to PoD
  - Seller ID
  - MSB reference (Venmo/FonePay transaction ID)
  - Amount USD (e.g., $5 buyer rebate)
  - Status (pending, confirmed, failed)
  - Confirmation timestamp

#### 1.5 XP Ledger System
- **`xp_ledger_entries`** table
  - Links to PoD (optional)
  - Member ID
  - Type (create/extinguish)
  - Category (rebate, social_impact, patronage, referral, other)
  - XP amount (integer, 21,000 per $1 USD)
  - Note field
  - Created timestamp

#### 1.6 Referral System
- **`referral_links`** table
  - Referred member ID
  - Referrer member ID
  - Tier (yam, megavoter, patron)
  - Created timestamp

- **`referral_settlements`** table
  - Links to PoD (optional)
  - Referrer member ID
  - Seller ID
  - Tier (yam, megavoter, patron)
  - Amount USD ($1, $5, or $25)
  - MSB reference
  - Status (pending, confirmed, failed)
  - Confirmation timestamp

#### 1.7 Reconciliation System
- **`reconciliation_runs`** table
  - Year and month
  - Status (started, completed, failed)
  - Start and completion timestamps
  - Error message field

---

## 2. PHP Backend Implementation

### 2.1 Core Constants
```php
const XP_PER_USD = 21000;

const REBATE_USD = 5.00;
const SOCIAL_USD = 4.00;
const PATRONAGE_USD = 1.00;

const REBATE_XP = 105000;      // 5 * 21000
const SOCIAL_XP = 84000;       // 4 * 21000
const PATRONAGE_XP = 21000;    // 1 * 21000

// Referral tiers
const REFERRAL_LEVEL1_USD = 1.00;   // YAM'er: 21,000 XP
const REFERRAL_LEVEL2_USD = 5.00;   // MEGAvoter: 105,000 XP
const REFERRAL_LEVEL3_USD = 25.00;  // Patron: 525,000 XP
```

### 2.2 Member Registration & Assignment Engine
- **`registerMember()`** function
  - Creates new member record
  - Assigns branch using time-based serendipity (CRC32 hash)
  - Assigns buyer POC (local 30-member pod)
  - Assigns seller POC if role is megvoter/patron (global 5-seller circle)
  - Uses registration timestamp for deterministic assignments

- **`assignBranch()`** function
  - Time-based serendipity logic
  - Uses member ID + registration timestamp
  - Returns one of 5 Peace Pentagon branches

- **`assignBuyerPoc()`** function
  - Finds or creates buyer POC in same region
  - Max 30 members per buyer POC
  - Returns POC ID

- **`assignSellerPoc()`** function
  - Finds or creates seller POC (global, branch-based)
  - Max 5 sellers per seller POC
  - Assigns slot index (0-4) based on registration time
  - Returns POC ID and slot index

- **`assignBuyerToSeller()`** function
  - Links buyer to seller (25-buyer network)
  - Prefers local sellers, falls back to global
  - Enforces 25-buyer limit per seller

### 2.3 Proof of Delivery (PoD) System
- **PoD Creation** endpoint
  - Creates new PoD record with transaction UID
  - Initial status: 'initiated'
  - Tracks buyer and seller

- **2-Scan PoD Logic**
  - First scan: buyer scans QR code → status: 'buyer_scanned'
  - Second scan: seller confirms → status: 'completed'
  - Each scan validates transaction UID

- **PoD Completion Handler**
  - Validates both scans completed
  - Triggers XP ledger entries (create entries for social impact and patronage)
  - Sets rebate status to 'pending'

### 2.4 MSB Settlement Tracking
- **MSB Settlement Logging**
  - Seller logs $5 buyer rebate payment via Venmo/FonePay/etc.
  - Records MSB transaction reference
  - Status: 'pending' until confirmed
  - Links to PoD

- **MSB Settlement Confirmation**
  - Updates status to 'confirmed'
  - Sets confirmed_at timestamp
  - Used in monthly reconciliation

### 2.5 XP Ledger Service
- **XP Entry Creation**
  - Creates XP ledger entries (type: 'create')
  - Categories: rebate, social_impact, patronage, referral, other
  - Calculates XP from USD using 21,000 XP per $1

- **XP Entry Extinguishing**
  - Creates XP ledger entries (type: 'extinguish')
  - Used when rebates are fulfilled
  - Used in referral settlements (create + extinguish pattern)

- **XP Display/Query Functions**
  - Read-only member XP wallet view
  - Shows XP by category
  - Shows notional USD equivalent (informational only)
  - **NO transfer, redemption, or trading functions**

### 2.6 Referral System
- **Referral Link Creation**
  - Records who referred whom
  - Tracks referral tier
  - Prevents duplicate referrals

- **Referral Settlement Logging**
  - Seller logs referral bonus payment via MSB
  - Records MSB transaction reference
  - Links to PoD (if applicable)
  - Tracks tier and amount

- **Referral XP Accounting**
  - Creates XP entry (type: 'create') for referrer
  - Creates XP entry (type: 'extinguish') immediately after
  - Represents obligation recognized and fulfilled

### 2.7 Monthly Reconciliation Engine
- **`runMonthlyReconciliation()`** function
  - Processes all completed PoDs for given month
  - Processes all confirmed referral settlements for month
  - Creates reconciliation run record
  - Runs in database transaction

- **`reconcilePod()`** function
  - Checks for confirmed $5 rebate in msb_settlements
  - If confirmed: sets rebate_status = 'fulfilled', extinguishes rebate XP
  - Always: creates XP for social impact and patronage
  - Marks PoD as 'reconciled'

- **`reconcileReferralSettlement()`** function
  - Maps tier to XP constant
  - Creates XP entry (create) for referrer
  - Creates XP entry (extinguish) for same amount
  - Marks settlement as reconciled

### 2.8 Member Moderation & IP Protection
- **XP Participation Ban**
  - Ability to ban member from earning XP
  - Extinguishes all existing XP for banned member
  - Prevents future XP accrual
  - Removes from POC participation
  - Blocks from PoD events
  - Removes from referral trees

- **Member Status Management**
  - Active/Inactive/Banned status
  - Integration with Discord membership
  - Enforces cooperative integrity

---

## 3. API Endpoints Required

### 3.1 Member Management
- `POST /api/register_member` - Register new member with full assignment
- `GET /api/member/{id}` - Get member details
- `GET /api/member/{id}/xp_wallet` - Get read-only XP wallet view
- `POST /api/member/{id}/ban` - Ban member from XP participation

### 3.2 PoD System
- `POST /api/pod/create` - Create new PoD event
- `POST /api/pod/{id}/scan` - Record scan (buyer or seller)
- `GET /api/pod/{id}` - Get PoD status
- `GET /api/pod/list` - List PoDs (with filters)

### 3.3 MSB Settlements
- `POST /api/msb_settlement/create` - Log MSB settlement
- `POST /api/msb_settlement/{id}/confirm` - Confirm MSB settlement
- `GET /api/msb_settlement/list` - List settlements

### 3.4 Referral System
- `POST /api/referral/create` - Create referral link
- `POST /api/referral_settlement/create` - Log referral payment
- `GET /api/referral/{member_id}` - Get referral tree

### 3.5 Reconciliation
- `POST /api/reconciliation/run` - Trigger monthly reconciliation
- `GET /api/reconciliation/runs` - List reconciliation runs
- `GET /api/reconciliation/{id}` - Get reconciliation details

### 3.6 POC Management
- `GET /api/poc/{id}` - Get POC details
- `GET /api/poc/{id}/members` - List POC members
- `GET /api/member/{id}/assignments` - Get member's POC assignments

---

## 4. Compliance & Safety Requirements

### 4.1 Non-Negotiable Constraints
- ✅ **XP is NEVER transferable** between members
- ✅ **XP is NEVER redeemable** from the DAO
- ✅ **DAO NEVER handles fiat custody**
- ✅ **XP is strictly accounting/logging** only
- ✅ **No market-making behaviors** (no order books, exchanges, liquidity pools)

### 4.2 Regulatory Safety
- No money transmission
- No custody of fiat
- No tradable token
- No market-making behavior
- No currency-like function
- All fiat flows through MSB platforms (Venmo, PayPal, FonePay, etc.)

### 4.3 XP Characteristics
- Non-monetary
- Non-transferable
- Non-redeemable
- Non-tradable
- Extinguishable on schedule (monthly/annual/10-year cycles)
- Accounting peg: 21,000 XP per $1 USD (not a price, not exchangeable)

---

## 5. Frontend/UI Requirements

### 5.1 Member Dashboard
- Member profile view
- XP wallet display (read-only)
- PoD history
- Referral tree visualization
- POC assignments display

### 5.2 PoD Interface
- QR code scanner for buyers
- QR code scanner for sellers
- PoD status tracking
- Transaction history

### 5.3 Admin/Moderation Panel
- Member management
- XP ban functionality
- Reconciliation trigger
- Settlement confirmation interface
- POC management

### 5.4 Discord Integration
- Member verification via Discord ID
- Private channel membership gating
- IP protection through Discord privacy

---

## 6. Additional Features Mentioned

### 6.1 Delivery Heroes System
- Track delivery heroes with XP awards
- New world pennies tracking
- Seller POC endorsements
- Geo-location tracking

### 6.2 Serendipity Protocol
- Time-based assignment logic
- Deterministic but pseudo-random assignments
- "Moment of serendipity" presentation in Discord

### 6.3 Peace Pentagon Integration
- Five branches: planning, budget, media, distribution, membership
- Branch-based seller POC organization
- Branch assignment on registration

---

## 7. Implementation Priority

### Phase 1: Core Infrastructure
1. Database schema creation
2. Member registration system
3. POC assignment engine
4. Basic PoD creation

### Phase 2: XP & Settlement
1. XP ledger system
2. MSB settlement tracking
3. Referral system
4. XP wallet display

### Phase 3: Reconciliation
1. Monthly reconciliation engine
2. Reconciliation run tracking
3. Reporting and audit trails

### Phase 4: Moderation & Safety
1. Member ban functionality
2. XP extinguishing on ban
3. Admin moderation panel

### Phase 5: Integration & Polish
1. Discord integration
2. Frontend UI/UX
3. API documentation
4. Testing and validation

---

## 8. Technical Notes

- Use **PHP with PDO** for database access
- Use **strict typing** (`declare(strict_types=1);`)
- Use **prepared statements** for all queries
- Implement **service classes** (ReconciliationService, XpLedgerService, etc.)
- Add **inline comments** reinforcing compliance constraints
- Use **database transactions** for critical operations
- Implement **error handling** and logging

---

## 9. Documentation Needed

- API documentation
- Database schema documentation
- XP accounting rules documentation
- Compliance guidelines
- Member onboarding guide
- Admin operations manual

---

**Note**: This is a comprehensive system for a Wyoming DAO LLC + Limited Cooperative Association. All implementations must strictly adhere to the compliance constraints to avoid money transmission, custody, or token-like behaviors.

