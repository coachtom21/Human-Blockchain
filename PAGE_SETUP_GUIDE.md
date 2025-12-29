# WordPress Pages Setup Guide
## Create Pages for Device Registration Flow

---

## 📄 PAGES TO CREATE

You need to create **5 WordPress pages** and assign the corresponding templates to them.

---

## 🚀 STEP-BY-STEP INSTRUCTIONS

### **Page 1: Activate Device**

1. Go to **WordPress Admin** → **Pages** → **Add New**
2. **Title**: `Activate Device`
3. **Permalink/Slug**: `activate-device` (should auto-generate)
4. **Page Attributes** → **Template**: Select **"Activate Device"**
5. Click **Publish**

**URL**: `http://yoursite.com/activate-device`

---

### **Page 2: Activate Device Step 2 (v-Card Validation)**

1. Go to **WordPress Admin** → **Pages** → **Add New**
2. **Title**: `Validate v-Card` (or any title you prefer)
3. **Permalink/Slug**: `activate-device-step-2` (important - must match this exactly)
4. **Page Attributes** → **Template**: Select **"Activate Device - Step 2 (v-Card Validation)"**
5. Click **Publish**

**URL**: `http://yoursite.com/activate-device-step-2`

---

### **Page 3: Activate Device Step 3 (Discord Connection)**

1. Go to **WordPress Admin** → **Pages** → **Add New**
2. **Title**: `Connect Discord` (or any title you prefer)
3. **Permalink/Slug**: `activate-device-step-3` (important - must match this exactly)
4. **Page Attributes** → **Template**: Select **"Activate Device - Step 3 (Discord Connection)"**
5. Click **Publish**

**URL**: `http://yoursite.com/activate-device-step-3`

---

### **Page 4: Activate Device Step 4 (Membership Selection)**

1. Go to **WordPress Admin** → **Pages** → **Add New**
2. **Title**: `Choose Membership` (or any title you prefer)
3. **Permalink/Slug**: `activate-device-step-4` (important - must match this exactly)
4. **Page Attributes** → **Template**: Select **"Activate Device - Step 4 (Membership Selection)"**
5. Click **Publish**

**URL**: `http://yoursite.com/activate-device-step-4`

---

### **Page 5: Activate Device Complete**

1. Go to **WordPress Admin** → **Pages** → **Add New**
2. **Title**: `Registration Complete` (or any title you prefer)
3. **Permalink/Slug**: `activate-device-complete` (important - must match this exactly)
4. **Page Attributes** → **Template**: Select **"Activate Device - Complete"**
5. Click **Publish**

**URL**: `http://yoursite.com/activate-device-complete`

---

## ✅ QUICK CHECKLIST

- [ ] Page 1: `/activate-device` → Template: "Activate Device"
- [ ] Page 2: `/activate-device-step-2` → Template: "Activate Device - Step 2 (v-Card Validation)"
- [ ] Page 3: `/activate-device-step-3` → Template: "Activate Device - Step 3 (Discord Connection)"
- [ ] Page 4: `/activate-device-step-4` → Template: "Activate Device - Step 4 (Membership Selection)"
- [ ] Page 5: `/activate-device-complete` → Template: "Activate Device - Complete"

---

## 🔍 HOW TO VERIFY TEMPLATES ARE AVAILABLE

If you don't see the templates in the dropdown:

1. **Check file names** - Templates must be named exactly:
   - `template-activate-device.php`
   - `template-activate-device-step-2.php`
   - `template-activate-device-step-3.php`
   - `template-activate-device-step-4.php`
   - `template-activate-device-complete.php`

2. **Check template header** - Each file must have:
   ```php
   <?php
   /**
    * Template Name: Activate Device
    */
   ?>
   ```

3. **Clear cache** - If using caching plugins, clear cache

4. **Refresh** - Refresh the page editor after creating template files

---

## 🎯 IMPORTANT NOTES

### **Slug Requirements**
The page **slugs** must match exactly:
- `activate-device`
- `activate-device-step-2`
- `activate-device-step-3`
- `activate-device-step-4`
- `activate-device-complete`

These are hardcoded in the JavaScript redirects. If you change them, update the JavaScript in the template files.

### **Template Assignment**
- You **must** assign the template in **Page Attributes**
- The page content doesn't matter (templates override it)
- You can leave the page content empty

### **Testing**
After creating pages:
1. Visit `/activate-device`
2. Complete the form
3. Should redirect to `/activate-device-step-2`
4. Continue through all steps

---

## 🐛 TROUBLESHOOTING

### **Issue: Template not showing in dropdown**
**Solution**: 
- Verify file exists in theme directory
- Check file has `Template Name:` comment
- Try refreshing the page editor
- Check file permissions

### **Issue: Page shows 404**
**Solution**:
- Check permalink settings: Settings → Permalinks
- Click "Save Changes" to flush rewrite rules
- Verify page is published (not draft)

### **Issue: Wrong template loads**
**Solution**:
- Verify template is selected in Page Attributes
- Clear WordPress cache
- Check for conflicting plugins

---

## 📝 ALTERNATIVE: Quick Page Creation Script

If you want to create pages programmatically, add this to `functions.php` temporarily:

```php
function hb_create_registration_pages() {
    $pages = array(
        array(
            'title' => 'Activate Device',
            'slug' => 'activate-device',
            'template' => 'template-activate-device.php',
        ),
        array(
            'title' => 'Validate v-Card',
            'slug' => 'activate-device-step-2',
            'template' => 'template-activate-device-step-2.php',
        ),
        array(
            'title' => 'Connect Discord',
            'slug' => 'activate-device-step-3',
            'template' => 'template-activate-device-step-3.php',
        ),
        array(
            'title' => 'Choose Membership',
            'slug' => 'activate-device-step-4',
            'template' => 'template-activate-device-step-4.php',
        ),
        array(
            'title' => 'Registration Complete',
            'slug' => 'activate-device-complete',
            'template' => 'template-activate-device-complete.php',
        ),
    );
    
    foreach ( $pages as $page_data ) {
        $page = get_page_by_path( $page_data['slug'] );
        
        if ( ! $page ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $page_data['title'],
                'post_name'    => $page_data['slug'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ) );
            
            if ( $page_id ) {
                update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
            }
        }
    }
}

// Run once (remove after use)
// add_action('init', 'hb_create_registration_pages');
```

**To use**: Uncomment the last line, visit your site once, then comment it back out.

---

## ✅ VERIFICATION

After creating all pages, test the flow:

1. Visit: `/activate-device` ✅
2. Fill form → Should redirect to `/activate-device-step-2` ✅
3. Validate v-card → Should redirect to `/activate-device-step-3` ✅
4. Connect Discord → Should redirect to `/activate-device-step-4` ✅
5. Select membership → Should redirect to `/activate-device-complete` ✅

---

**All pages must be created for the registration flow to work!**

