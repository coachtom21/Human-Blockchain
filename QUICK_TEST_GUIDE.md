# Quick Test Guide
## 5-Minute Verification Checklist

---

## ⚡ FASTEST WAY TO VERIFY IMPLEMENTATION

### 1. Check Database Tables (1 minute)

**Via phpMyAdmin or Database Tool:**
```sql
SHOW TABLES LIKE 'wp_hb_%';
```

**Expected**: 6 tables
- wp_hb_devices
- wp_hb_qrtiger_vcards
- wp_hb_discord_mappings
- wp_hb_poc_memberships
- wp_hb_buyer_pocs
- wp_hb_seller_pocs

**If tables don't exist:**
```bash
# Visit as admin:
http://yoursite.com/wp-admin/?hb_run_migration=1
```

---

### 2. Test API Endpoint (1 minute)

**Open Browser Console (F12) and run:**
```javascript
fetch('/wp-json/hb/v1/device/register', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({
    user_agent: navigator.userAgent,
    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
  })
})
.then(r => r.json())
.then(data => {
  console.log('✅ API Works!', data);
  if(data.device_id) {
    console.log('Device ID:', data.device_id);
  }
})
.catch(err => console.error('❌ API Error:', err));
```

**Expected**: Should return `{device_id: 1, device_fingerprint: "...", status: "pending"}`

---

### 3. Check Frontend Page (1 minute)

**Visit**: `http://yoursite.com/activate-device`

**What to Check:**
- ✅ Page loads (not 404)
- ✅ Form appears
- ✅ Checkbox is visible
- ✅ "Confirm & Continue" button exists

**If page doesn't exist:**
1. Go to WordPress Admin → Pages → Add New
2. Title: "Activate Device"
3. Template: Select "Activate Device"
4. Publish
5. Visit the page URL

---

### 4. Test Complete Flow (2 minutes)

1. **Visit** `/activate-device`
2. **Check** the checkbox
3. **Click** "Confirm & Continue"
4. **Check** if redirects to Step 2
5. **Enter** test v-card hash: `test123`
6. **Click** "Validate v-Card"
7. **Check** if redirects to Step 3

**If any step fails:**
- Check browser console (F12) for errors
- Check network tab for API errors
- Check WordPress debug log

---

## 🔍 VERIFY DATABASE RECORD

**After testing, check database:**
```sql
SELECT id, device_fingerprint, status, membership_tier, peace_pentagon_branch 
FROM wp_hb_devices 
ORDER BY id DESC 
LIMIT 1;
```

**Expected**: Should see a record with:
- `status` = 'activating' or 'validated'
- `device_fingerprint` = hash string
- Other fields populated

---

## ✅ SUCCESS INDICATORS

**Everything is working if:**
- ✅ 6 database tables exist
- ✅ API endpoint returns device_id
- ✅ Frontend page loads
- ✅ Form submission works
- ✅ Database record is created
- ✅ No JavaScript errors in console
- ✅ No PHP errors in logs

---

## 🐛 COMMON ISSUES & FIXES

### Issue: "Tables don't exist"
**Fix**: Run migration manually
```php
// Add to functions.php temporarily, then visit site
require_once get_stylesheet_directory() . '/database/migrations/001_create_device_tables.php';
hb_create_device_tables();
```

### Issue: "API returns 404"
**Fix**: Check if REST API is enabled
- Visit: `http://yoursite.com/wp-json/`
- Should show JSON response
- If not, check permalink settings

### Issue: "Page shows 404"
**Fix**: Create page in WordPress admin
- Pages → Add New
- Assign template
- Publish

### Issue: "JavaScript errors"
**Fix**: Check browser console
- Look for missing files
- Check API endpoint URLs
- Verify jQuery is loaded (if needed)

---

## 📋 MINIMUM VIABLE TEST

**If you only have 2 minutes:**

1. **Check tables exist**: `SHOW TABLES LIKE 'wp_hb_%';` → Should see 6 tables
2. **Test API**: Visit `http://yoursite.com/wp-json/hb/v1/device/register` → Should see JSON (may need POST)
3. **Check page**: Visit `/activate-device` → Should load (create page if needed)

**If all 3 work → Implementation is successful!**

---

## 🎯 WHAT TO TEST NEXT

Once basic functionality works:
1. Test complete registration flow
2. Test error handling
3. Test with different devices
4. Test POC assignment
5. Test Discord integration (if configured)

---

**Quick Test Time**: ~5 minutes
**Full Test Time**: ~30 minutes

