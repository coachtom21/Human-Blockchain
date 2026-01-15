# HumanBlockchain Portal - Development Task Checklist
## For Codepixelzmedia Development Team

**Project:** HumanBlockchain WordPress Plugin  
**Start Date:** TBD  
**Target Completion:** TBD

---

## ✅ Phase 1: Foundation (Week 1-2)

### Setup & Database
- [ ] Create plugin directory structure `/wp-content/plugins/hbc-portal/`
- [ ] Create main plugin file `hbc-portal.php` with activation hooks
- [ ] Create all required class files in `includes/` directory
- [ ] Create database migration script
- [ ] Create `hbc_devices` table
- [ ] Create `hbc_members` table
- [ ] Create `hbc_referrals` table
- [ ] Create `hbc_xp_ledger` table
- [ ] Create `hbc_vouchers` table
- [ ] Test plugin activation/deactivation
- [ ] Verify all tables created correctly
- [ ] Test database indexes

**Estimated Time:** 16-20 hours

---

## ✅ Phase 2: Device Registration (Week 2-3)

### Device Identity System
- [ ] Implement UUIDv4 generation
- [ ] Create device hash algorithm (SHA256)
- [ ] Implement localStorage + cookie storage (JavaScript)
- [ ] Create `HBC_Device_Service` class
- [ ] Implement device registration endpoint `/wp-json/hbc/v1/device/register`
- [ ] Test device ID persistence
- [ ] Test device hash consistency
- [ ] Verify no hardware IDs collected

### Geo-Location System
- [ ] Implement browser Geolocation API request
- [ ] Create consent dialog
- [ ] Implement location rounding (3-4 decimal places)
- [ ] Store server timestamp
- [ ] Store consent flag
- [ ] Test location capture
- [ ] Test consent flow

### Serendipity Protocol
- [ ] Create `HBC_Serendipity_Service` class
- [ ] Implement Buyer POC assignment (local)
- [ ] Implement Seller POC assignment (global)
- [ ] Implement Peace Pentagon branch assignment
- [ ] Enforce POC limits (30 buyers, 5 sellers)
- [ ] Test POC assignments
- [ ] Test POC limit enforcement

**Estimated Time:** 24-30 hours

---

## ✅ Phase 3: Discord Integration (Week 3-4)

### OAuth2 Implementation
- [ ] Create `HBC_Discord_Service` class
- [ ] Implement Discord OAuth2 URL generation
- [ ] Create OAuth callback handler
- [ ] Implement token exchange
- [ ] Store Discord user ID and username
- [ ] Verify guild membership
- [ ] Test OAuth flow end-to-end

### Bot Role Assignment
- [ ] Set up Discord bot (separate task)
- [ ] Create webhook endpoint `/wp-json/hbc/v1/discord/role-confirm`
- [ ] Implement HMAC signature verification
- [ ] Update member status on role confirmation
- [ ] Store role confirmation timestamp
- [ ] Test webhook receives correctly
- [ ] Test status updates

**Estimated Time:** 20-24 hours

---

## ✅ Phase 4: Complimentary 10-Pack System (Week 4-5)

### Pack Issuance
- [ ] Create `HBC_Voucher_Service` class
- [ ] Implement one-pack-per-device check
- [ ] Create pack type selection (sticker/hang_tag)
- [ ] Generate 10 unique voucher IDs (UUIDv4)
- [ ] Generate QR codes for each voucher
- [ ] Insert vouchers into database
- [ ] Update device record with pack flags
- [ ] Create ledger entry (amount = 0, no XP)
- [ ] Test pack issuance
- [ ] Test duplicate prevention

### Voucher Lifecycle
- [ ] Implement status: Issued → Unused → Attached → Validated → Closed
- [ ] Create seller scan endpoint (Scan 1)
- [ ] Create buyer scan endpoint (Scan 2)
- [ ] Implement XP minting on validation only
- [ ] Link voucher to XP ledger entry
- [ ] Test status transitions
- [ ] Test 2-scan requirement

### Fulfillment
- [ ] Create PDF generation for digital packs
- [ ] Implement QR code rendering in PDF
- [ ] Create download endpoint
- [ ] (Optional) Implement physical shipping tracking
- [ ] Test PDF generation
- [ ] Test QR code scannability

**Estimated Time:** 28-32 hours

---

## ✅ Phase 5: XP Ledger System (Week 5-6)

### Append-Only Ledger
- [ ] Create `HBC_XP_Ledger_Service` class
- [ ] Implement hash chain algorithm
- [ ] Create entry creation method
- [ ] Implement previous hash linking
- [ ] Test immutability (no updates)
- [ ] Test hash chain integrity
- [ ] Create ledger verification function

### Entry Types
- [ ] Implement `device_register` entry
- [ ] Implement `referral_award` entry
- [ ] Implement `complimentary_pack_issued` entry
- [ ] Implement `voucher_used` entry
- [ ] Implement `maturity_unlock` entry
- [ ] Implement `annual_close_adjustment` entry
- [ ] Test all entry types

**Estimated Time:** 16-20 hours

---

## ✅ Phase 6: Maturity System (Week 6-7)

### Daily Maturity Check
- [ ] Create WP-Cron hook `hbc_daily_maturity_check`
- [ ] Implement maturity date query
- [ ] Update referral status to 'matured'
- [ ] Create maturity unlock ledger entry
- [ ] Test cron execution
- [ ] Test maturity processing
- [ ] Test no duplicates

### Annual Close
- [ ] Create annual close hook `hbc_annual_close`
- [ ] Implement Aug 31 scheduling
- [ ] Find referrals with completed actions
- [ ] Waive maturity for active members
- [ ] Create annual close ledger entries
- [ ] Test scheduling
- [ ] Test waiver logic

**Estimated Time:** 12-16 hours

---

## ✅ Phase 7: Referral System (Week 7)

### Referral Tracking
- [ ] Create `HBC_Referral_Service` class
- [ ] Implement referral creation on device registration
- [ ] Calculate XP amounts (1/5/25 based on tier)
- [ ] Set maturity date (8-12 weeks random)
- [ ] Create pending referral ledger entry
- [ ] Test referral creation
- [ ] Test XP amount calculation
- [ ] Test maturity date calculation

**Estimated Time:** 12-16 hours

---

## ✅ Phase 8: Admin Panel (Week 8-9)

### Devices List Page
- [ ] Create admin page `hbc-devices`
- [ ] Display device list with pagination
- [ ] Implement fraud signal detection
- [ ] Add filters (status, date range)
- [ ] Add CSV export
- [ ] Test display
- [ ] Test filters
- [ ] Test export

### Members List Page
- [ ] Create admin page `hbc-members`
- [ ] Display member list
- [ ] Show Discord status
- [ ] Show role confirmation timestamps
- [ ] Show POC assignments
- [ ] Add export for GitHub access
- [ ] Test display
- [ ] Test export

### Referrals List Page
- [ ] Create admin page `hbc-referrals`
- [ ] Display referral list
- [ ] Show maturity queue
- [ ] Add status filter
- [ ] Show XP amounts and dates
- [ ] Test display
- [ ] Test filters

### XP Ledger Viewer
- [ ] Create admin page `hbc-ledger`
- [ ] Display ledger entries
- [ ] Add user/device filter
- [ ] Add entry type filter
- [ ] Add date range filter
- [ ] Implement hash chain verification
- [ ] Test display
- [ ] Test filters
- [ ] Test verification

### Settings Page
- [ ] Create admin page `hbc-settings`
- [ ] Add Discord Guild ID field
- [ ] Add Bot token field (encrypted)
- [ ] Add referral XP amounts (1/5/25)
- [ ] Add maturity window (8-12 weeks)
- [ ] Add annual close date
- [ ] Implement settings save
- [ ] Test settings persistence
- [ ] Test encryption

**Estimated Time:** 32-40 hours

---

## ✅ Phase 9: Frontend Shortcodes (Week 9-10)

### Shortcode: [hbc_enter]
- [ ] Create template file
- [ ] Implement "Enter Website" / "PoD Gateway" UI
- [ ] Add JavaScript for modal
- [ ] Test rendering
- [ ] Test functionality

### Shortcode: [hbc_register_device]
- [ ] Create template file
- [ ] Implement registration wizard
- [ ] Add geo-location request
- [ ] Add device fingerprint collection
- [ ] Add form submission
- [ ] Test registration flow
- [ ] Test error handling

### Shortcode: [hbc_discord_connect]
- [ ] Create template file
- [ ] Implement Discord OAuth button
- [ ] Add connection status display
- [ ] Test OAuth flow
- [ ] Test status updates

### Shortcode: [hbc_dashboard]
- [ ] Create template file
- [ ] Display XP balance
- [ ] Show voucher status
- [ ] Show referral status
- [ ] Show maturity countdown
- [ ] Add human-centered language
- [ ] Test display
- [ ] Test calculations

### Shortcode: [hbc_faq]
- [ ] Create template file
- [ ] Display FAQ content
- [ ] Add accordion functionality
- [ ] Test rendering

**Estimated Time:** 24-30 hours

---

## ✅ Phase 10: Security & Compliance (Week 10)

### API Security
- [ ] Implement nonce checks for all endpoints
- [ ] Add HMAC signature verification for Discord webhooks
- [ ] Implement rate limiting per IP
- [ ] Implement rate limiting per device_hash
- [ ] Test nonce validation
- [ ] Test HMAC verification
- [ ] Test rate limiting

### Data Protection
- [ ] Hash all IP addresses before storage
- [ ] Hash all user agents before storage
- [ ] Encrypt Discord bot token
- [ ] Log geolocation consent
- [ ] Test hashing
- [ ] Test encryption
- [ ] Test consent logging

### Abuse Prevention
- [ ] Enforce one pack per device
- [ ] Flag multiple devices from same person
- [ ] Create manual review interface
- [ ] Add revoke capability for vouchers
- [ ] Test enforcement
- [ ] Test flagging
- [ ] Test revocation

**Estimated Time:** 16-20 hours

---

## ✅ Phase 11: Testing & QA (Week 11)

### Unit Testing
- [ ] Test device registration
- [ ] Test Discord OAuth
- [ ] Test pack issuance
- [ ] Test voucher lifecycle
- [ ] Test XP ledger
- [ ] Test maturity system
- [ ] Test referral system

### Integration Testing
- [ ] Test full registration flow
- [ ] Test Discord connection flow
- [ ] Test pack issuance flow
- [ ] Test voucher validation flow
- [ ] Test referral flow
- [ ] Test maturity processing

### User Acceptance Testing
- [ ] Test as new user
- [ ] Test as referrer
- [ ] Test as admin
- [ ] Test on mobile devices
- [ ] Test on different browsers
- [ ] Test error scenarios

**Estimated Time:** 20-24 hours

---

## ✅ Phase 12: Documentation & Handoff (Week 12)

### Documentation
- [ ] Write plugin installation guide
- [ ] Write configuration guide
- [ ] Write user manual
- [ ] Write admin manual
- [ ] Document API endpoints
- [ ] Document database schema
- [ ] Create troubleshooting guide

### Code Documentation
- [ ] Add PHPDoc comments to all classes
- [ ] Add inline comments for complex logic
- [ ] Document all functions
- [ ] Create code style guide

### Handoff
- [ ] Prepare deployment package
- [ ] Create deployment checklist
- [ ] Schedule handoff meeting
- [ ] Provide access credentials
- [ ] Transfer documentation

**Estimated Time:** 16-20 hours

---

## Total Estimated Time

**Minimum:** 236 hours (~6 weeks @ 40 hrs/week)  
**Maximum:** 302 hours (~7.5 weeks @ 40 hrs/week)

---

## Critical Path Items

These must be completed in order:

1. ✅ Plugin foundation & database
2. ✅ Device registration
3. ✅ Discord integration
4. ✅ Complimentary pack system
5. ✅ XP ledger
6. ✅ Admin panel
7. ✅ Frontend shortcodes

---

## Dependencies

- **Discord Bot Setup** (external) - Required for Phase 3
- **QR Code Library** - Required for Phase 4
- **PDF Generation Library** - Required for Phase 4
- **WordPress REST API** - Required for all phases

---

## Notes

- All XP amounts are integers (not money)
- Ledger is append-only (never update)
- One complimentary pack per device (ever)
- Privacy-first: hash all sensitive data
- Human-centered language in UI

---

**Last Updated:** January 2025
