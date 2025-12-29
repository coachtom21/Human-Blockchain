# Testing & Verification Manual
## HumanBlockchain.info Device Registration System

---

## 📋 PRE-TESTING CHECKLIST

Before testing, ensure:
- [ ] WordPress is installed and running
- [ ] Theme is activated (hello-theme-child-master)
- [ ] You have admin access to WordPress
- [ ] Database is accessible
- [ ] PHP version 7.4+ (recommended 8.0+)

---

## 🔧 STEP 1: RUN DATABASE MIGRATION

### Method A: Automatic (Recommended)
1. Go to WordPress Admin → Appearance → Themes
2. Switch to a different theme (temporarily)
3. Switch back to "Hello Elementor Child" theme
4. Migration runs automatically on theme activation

### Method B: Manual via URL
1. Log in as WordPress admin
2. Visit: `http://yoursite.com/wp-admin/?hb_run_migration=1`
3. You should see "Migration completed!" message

### Method C: Via WordPress Admin (Custom Page)
1. Create a temporary admin page or use a plugin
2. Call the function directly:
   ```php
   require_once get_stylesheet_directory() . '/database/migrations/001_create_device_tables.php';
   hb_create_device_tables();
   ```

### Verify Migration Success

**Option 1: Check via phpMyAdmin / Database Tool**
```sql
SHOW TABLES LIKE 'wp_hb_%';
```

You should see:
- `wp_hb_devices`
- `wp_hb_qrtiger_vcards`
- `wp_hb_discord_mappings`
- `wp_hb_poc_memberships`
- `wp_hb_buyer_pocs`
- `wp_hb_seller_pocs`

**Option 2: Check via WordPress**
```php
// Add this to functions.php temporarily or run in WP-CLI
$version = get_option( 'hb_db_version' );
echo $version; // Should output: 1.0.0
```

**Option 3: Check Table Structure**
```sql
DESCRIBE wp_hb_devices;
```

Should show columns: id, device_fingerprint, status, user_agent, etc.

---

## 🌐 STEP 2: CREATE WORDPRESS PAGES

Create these pages in WordPress Admin → Pages → Add New:

### Page 1: Activate Device
- **Title**: "Activate Device"
- **Slug**: `activate-device`
- **Template**: Select "Activate Device" from template dropdown
- **Publish**

### Page 2: Activate Device Step 2
- **Title**: "Validate v-Card"
- **Slug**: `activate-device-step-2`
- **Template**: Select "Activate Device - Step 2 (v-Card Validation)"
- **Publish**

### Page 3: Activate Device Step 3
- **Title**: "Connect Discord"
- **Slug**: `activate-device-step-3`
- **Template**: Select "Activate Device - Step 3 (Discord Connection)"
- **Publish**

### Page 4: Activate Device Step 4
- **Title**: "Choose Membership"
- **Slug**: `activate-device-step-4`
- **Template**: Select "Activate Device - Step 4 (Membership Selection)"
- **Publish**

### Page 5: Activate Device Complete
- **Title**: "Registration Complete"
- **Slug**: `activate-device-complete`
- **Template**: Select "Activate Device - Complete"
- **Publish**

**Note**: If templates don't appear in dropdown, ensure files have `Template Name:` comment at the top.

---

## 🧪 STEP 3: TEST API ENDPOINTS

### Test 1: Device Registration

**Using cURL:**
```bash
curl -X POST http://yoursite.com/wp-json/hb/v1/device/register \
  -H "Content-Type: application/json" \
  -d '{
    "user_agent": "Mozilla/5.0 (Test Browser)",
    "screen_resolution": "1920x1080",
    "timezone": "America/New_York",
    "language": "en-US",
    "platform": "Linux"
  }'
```

**Expected Response:**
```json
{
  "device_id": 1,
  "device_fingerprint": "abc123...",
  "status": "pending"
}
```

**Using Browser Console (JavaScript):**
```javascript
fetch('/wp-json/hb/v1/device/register', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    user_agent: navigator.userAgent,
    screen_resolution: screen.width + 'x' + screen.height,
    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
    language: navigator.language,
  })
})
.then(r => r.json())
.then(console.log);
```

### Test 2: Check Device

**Using cURL:**
```bash
curl http://yoursite.com/wp-json/hb/v1/device/1
```

**Expected Response:**
```json
{
  "id": "1",
  "device_fingerprint": "abc123...",
  "status": "pending",
  "created_at": "2024-01-01 12:00:00",
  ...
}
```

### Test 3: Activate Device

**Using cURL:**
```bash
curl -X POST http://yoursite.com/wp-json/hb/v1/device/activate \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": 1,
    "latitude": 40.7128,
    "longitude": -74.0060,
    "city": "New York",
    "state": "NY",
    "country": "US"
  }'
```

**Expected Response:**
```json
{
  "success": true,
  "device_id": 1,
  "status": "activating"
}
```

### Test 4: Validate v-Card

**Using cURL:**
```bash
curl -X POST http://yoursite.com/wp-json/hb/v1/vcard/validate \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": 1,
    "vcard_hash": "test_vcard_hash_12345"
  }'
```

**Expected Response:**
```json
{
  "vcard_id": 1,
  "status": "validated"
}
```

### Test 5: Set Membership

**Using cURL:**
```bash
curl -X POST http://yoursite.com/wp-json/hb/v1/device/1/membership \
  -H "Content-Type: application/json" \
  -d '{
    "tier": "yamer"
  }'
```

**Expected Response:**
```json
{
  "success": true,
  "tier": "yamer"
}
```

### Test 6: Complete Registration

**Using cURL:**
```bash
curl -X POST http://yoursite.com/wp-json/hb/v1/device/1/complete \
  -H "Content-Type: application/json"
```

**Expected Response:**
```json
{
  "success": true,
  "device_id": 1,
  "status": "validated"
}
```

---

## 🖥️ STEP 4: TEST FRONTEND FLOW

### Test Complete Registration Flow

1. **Visit**: `http://yoursite.com/activate-device`

2. **Step 1 - Device Activation**:
   - Page should load with activation form
   - Check the "I understand one device equals one human voice" checkbox
   - Click "Confirm & Continue"
   - Should redirect to Step 2

3. **Step 2 - v-Card Validation**:
   - Enter a test v-card hash (e.g., `test_vcard_123`)
   - Click "Validate v-Card"
   - Should show success and redirect to Step 3

4. **Step 3 - Discord Connection**:
   - Click "Accept Discord Invite"
   - **Note**: If Discord not configured, you'll see an error
   - For testing without Discord, you can skip this step by manually updating database

5. **Step 4 - Membership Selection**:
   - Select a membership tier (YAM'er, MEGAvoter, or Patron)
   - Click "Continue"
   - Should redirect to completion page

6. **Step 5 - Completion**:
   - Should show "You're Live" message
   - Registration completes automatically
   - Buttons appear: "Return to Delivery" and "View My Device"

---

## 🔍 STEP 5: VERIFY DATABASE RECORDS

### Check Device Record

**Via phpMyAdmin or Database Tool:**
```sql
SELECT * FROM wp_hb_devices ORDER BY id DESC LIMIT 1;
```

**What to Check:**
- ✅ `device_fingerprint` is populated (SHA-256 hash)
- ✅ `status` is `validated` (after completion)
- ✅ `location_lat` and `location_lng` are populated
- ✅ `membership_tier` is set (yamer, megavoter, or patron)
- ✅ `peace_pentagon_branch` is assigned
- ✅ `vcard_status` is `validated`
- ✅ `activated_at` and `validated_at` timestamps are set

### Check v-Card Record

```sql
SELECT * FROM wp_hb_qrtiger_vcards WHERE device_id = 1;
```

**What to Check:**
- ✅ `vcard_hash` is stored
- ✅ `status` is `validated`
- ✅ `device_id` matches device

### Check Discord Connection

```sql
SELECT * FROM wp_hb_discord_mappings WHERE device_id = 1;
```

**What to Check:**
- ✅ `discord_user_id` is populated
- ✅ `device_id` matches
- ✅ `connected_at` timestamp is set

### Check POC Assignments

```sql
SELECT * FROM wp_hb_poc_memberships WHERE device_id = 1;
```

**What to Check:**
- ✅ At least one Buyer POC assignment exists
- ✅ If MEGAvoter/Patron, Seller POC assignment exists
- ✅ `poc_type` is 'buyer' or 'seller'
- ✅ `assigned_at` timestamp is set

---

## 🐛 TROUBLESHOOTING

### Issue: Tables Not Created

**Symptoms**: API returns database errors

**Solution**:
1. Check if migration ran: `SELECT * FROM wp_options WHERE option_name = 'hb_db_version';`
2. If not, manually run migration:
   ```php
   require_once get_stylesheet_directory() . '/database/migrations/001_create_device_tables.php';
   hb_create_device_tables();
   ```
3. Check WordPress error logs: `wp-content/debug.log`

### Issue: API Endpoints Return 404

**Symptoms**: `GET /wp-json/hb/v1/device/register` returns 404

**Solution**:
1. Check if REST API is enabled: Visit `http://yoursite.com/wp-json/`
2. Check if routes are registered:
   ```php
   // Add to functions.php temporarily
   add_action('rest_api_init', function() {
       error_log('REST API init - checking routes');
       $routes = rest_get_server()->get_routes();
       error_log(print_r(array_keys($routes), true));
   });
   ```
3. Verify `functions.php` is loading service classes
4. Check for PHP errors in error logs

### Issue: Device Registration Fails

**Symptoms**: API returns error on device registration

**Solution**:
1. Check database connection
2. Verify table exists: `SHOW TABLES LIKE 'wp_hb_devices';`
3. Check for duplicate fingerprint:
   ```sql
   SELECT * FROM wp_hb_devices WHERE device_fingerprint = 'your_hash';
   ```
4. Check WordPress debug log for errors

### Issue: Frontend Pages Don't Load

**Symptoms**: Pages show 404 or blank

**Solution**:
1. Verify pages are created in WordPress admin
2. Check page slugs match template expectations
3. Verify template files exist in theme directory
4. Check template name in file matches WordPress template selection
5. Clear WordPress cache if using caching plugin

### Issue: Discord OAuth Not Working

**Symptoms**: Discord button doesn't redirect or callback fails

**Solution**:
1. Check Discord credentials are set:
   ```php
   get_option('hb_discord_client_id');
   get_option('hb_discord_client_secret');
   get_option('hb_discord_redirect_uri');
   ```
2. Verify redirect URI matches Discord app settings
3. Check redirect URI includes `device_id` parameter
4. Test OAuth URL generation:
   ```php
   $url = Discord_Service::get_authorization_url(1);
   var_dump($url);
   ```

### Issue: POC Assignment Not Working

**Symptoms**: Device registered but no POC assignments

**Solution**:
1. Check if location data exists:
   ```sql
   SELECT location_country, location_state FROM wp_hb_devices WHERE id = 1;
   ```
2. Manually trigger POC assignment:
   ```php
   $location = array('country' => 'US', 'state' => 'NY');
   Serendipity_Service::assign_all_pocs(1, $location);
   ```
3. Check POC tables exist:
   ```sql
   SHOW TABLES LIKE 'wp_hb_buyer_pocs';
   SHOW TABLES LIKE 'wp_hb_seller_pocs';
   ```

---

## ✅ VERIFICATION CHECKLIST

### Database Verification
- [ ] All 6 tables exist
- [ ] Tables have correct structure
- [ ] Indexes are created
- [ ] Migration version stored in wp_options

### API Verification
- [ ] All endpoints return 200 (not 404)
- [ ] Device registration creates record
- [ ] Device activation updates record
- [ ] v-card validation stores hash
- [ ] Membership selection updates tier
- [ ] Completion validates device

### Frontend Verification
- [ ] All 5 pages load correctly
- [ ] Forms submit without errors
- [ ] Redirects work between steps
- [ ] Error messages display properly
- [ ] Success messages display properly
- [ ] Loading indicators work

### Flow Verification
- [ ] Complete registration flow works end-to-end
- [ ] Device status progresses: pending → activating → validated
- [ ] v-card status: pending → validated
- [ ] POC assignments created
- [ ] Peace Pentagon branch assigned

---

## 📊 TESTING SCENARIOS

### Scenario 1: New User Registration
1. Visit `/activate-device`
2. Complete all 5 steps
3. Verify device is `validated` in database
4. Verify POC assignments exist
5. Verify Discord connection exists (if configured)

### Scenario 2: Existing Device Check
1. Register device (get device_id)
2. Visit `/activate-device` again
3. Should detect existing device
4. Should redirect to device dashboard or show existing status

### Scenario 3: Partial Registration
1. Complete Step 1 (activation)
2. Stop at Step 2
3. Check database: device should be `activating`
4. Resume registration later
5. Should continue from where left off

### Scenario 4: Error Handling
1. Try to activate without checkbox → Should show error
2. Try invalid v-card → Should show error
3. Try to complete without v-card → Should show error
4. Try to complete without Discord → Should show error

---

## 🔐 SECURITY CHECKS

### Verify Security
- [ ] API endpoints don't expose sensitive data
- [ ] Device fingerprints are hashed (not plain)
- [ ] Access tokens are hashed (not plain)
- [ ] SQL injection protection (prepared statements)
- [ ] Input validation on all endpoints
- [ ] CSRF protection (if needed)

### Check Data Privacy
- [ ] v-card hash only (no PII)
- [ ] Location data is optional
- [ ] No personal information stored
- [ ] Discord user ID only (not username stored permanently)

---

## 📝 TESTING LOG TEMPLATE

Use this template to track your testing:

```
Date: ___________
Tester: ___________

Database Migration:
[ ] Tables created
[ ] Migration version: ___________

API Testing:
[ ] Device registration: PASS / FAIL
[ ] Device activation: PASS / FAIL
[ ] v-card validation: PASS / FAIL
[ ] Membership selection: PASS / FAIL
[ ] Registration completion: PASS / FAIL

Frontend Testing:
[ ] Step 1 loads: PASS / FAIL
[ ] Step 2 loads: PASS / FAIL
[ ] Step 3 loads: PASS / FAIL
[ ] Step 4 loads: PASS / FAIL
[ ] Step 5 loads: PASS / FAIL

End-to-End Flow:
[ ] Complete registration: PASS / FAIL
[ ] Database records created: PASS / FAIL
[ ] POC assignments: PASS / FAIL

Issues Found:
1. ___________
2. ___________

Notes:
___________
```

---

## 🚀 QUICK START TESTING

**Fastest way to test everything:**

1. **Run Migration**: Visit `?hb_run_migration=1` (as admin)
2. **Create Pages**: Create 5 pages with templates
3. **Test API**: Use browser console or Postman
4. **Test Frontend**: Visit `/activate-device` and complete flow
5. **Verify Database**: Check records in database

**Expected Time**: 15-30 minutes for full test

---

## 📞 SUPPORT

If you encounter issues:
1. Check WordPress debug log: `wp-content/debug.log`
2. Check browser console for JavaScript errors
3. Check network tab for API errors
4. Verify all files are in correct locations
5. Check file permissions (should be readable)

---

**Last Updated**: Implementation Complete
**Status**: Ready for Testing

