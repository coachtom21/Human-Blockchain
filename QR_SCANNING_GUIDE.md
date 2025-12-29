# How to Scan QRtiger v-Card QR Code

## Overview

The v-card validation page now includes **QR code scanning functionality** that automatically extracts the hash from QRtiger v-card QR codes.

---

## How It Works

### **Two Methods Available:**

1. **📷 Camera Scanner** (Recommended)
   - Click "Open Camera Scanner"
   - Point camera at QRtiger v-card QR code
   - Automatically extracts hash and validates

2. **✍️ Manual Entry**
   - Enter v-card hash directly in the text field
   - Click "Validate v-Card"

---

## QR Code Scanning Process

### **Step 1: Scan QR Code**
When you scan a QRtiger v-card QR code, it typically contains one of:

1. **Direct vCard Data** (BEGIN:VCARD...END:VCARD format)
   ```
   BEGIN:VCARD
   VERSION:3.0
   FN:John Doe
   EMAIL:john@example.com
   ...
   END:VCARD
   ```

2. **URL to vCard File**
   ```
   https://qrtiger.com/vcard/abc123xyz
   ```

3. **Already a Hash** (64-character SHA-256 hash)
   ```
   a1b2c3d4e5f6...
   ```

### **Step 2: Extract Hash**

The system automatically:

1. **If URL:** Fetches the vCard file from the URL
2. **If vCard Data:** Uses the vCard content directly
3. **If Hash:** Uses it directly
4. **Generate Hash:** Creates SHA-256 hash of the vCard content

### **Step 3: Validate**

The extracted hash is sent to the backend for validation via QRtiger API.

---

## Technical Details

### **Hash Generation**

The system uses **SHA-256** to generate a unique hash from vCard data:

```javascript
// Normalize vCard data
const normalized = vcardData.trim().replace(/\r\n/g, '\n');

// Generate SHA-256 hash
const hash = await crypto.subtle.digest('SHA-256', data);
```

**Why SHA-256?**
- ✅ Cryptographically secure
- ✅ Produces consistent 64-character hash
- ✅ Cannot be reversed (one-way function)
- ✅ PII minimization (hash doesn't reveal personal data)

### **QR Scanner Library**

Uses **html5-qrcode** library:
- ✅ Works on mobile and desktop
- ✅ Uses device camera
- ✅ Real-time scanning
- ✅ No external dependencies (CDN)

---

## User Experience Flow

```
1. User clicks "📷 Open Camera Scanner"
   ↓
2. Browser requests camera permission
   ↓
3. Camera view opens
   ↓
4. User points camera at QR code
   ↓
5. QR code detected automatically
   ↓
6. System extracts vCard data/hash
   ↓
7. Hash generated (if needed)
   ↓
8. Hash filled in input field
   ↓
9. Validation request sent automatically
   ↓
10. Success → Redirect to Step 3
```

---

## Browser Compatibility

### **Camera Access:**
- ✅ **Chrome/Edge** (Desktop & Mobile) - Full support
- ✅ **Firefox** (Desktop & Mobile) - Full support
- ✅ **Safari** (iOS/macOS) - Full support
- ⚠️ **Older browsers** - May require manual entry

### **HTTPS Requirement:**
- Camera access requires **HTTPS** (or localhost)
- Production sites must use SSL certificate

---

## Troubleshooting

### **"Failed to start camera"**
**Causes:**
- No camera permission granted
- Camera already in use by another app
- Browser doesn't support camera API

**Solutions:**
1. Grant camera permission in browser settings
2. Close other apps using camera
3. Use manual entry instead

### **"Failed to process QR code"**
**Causes:**
- QR code is not a valid vCard
- URL in QR code is inaccessible
- Network error fetching vCard

**Solutions:**
1. Verify QR code is from QRtiger
2. Check internet connection
3. Try manual entry with hash

### **"Failed to fetch vCard from URL"**
**Causes:**
- URL is broken or expired
- CORS restrictions
- Network timeout

**Solutions:**
1. Verify QR code is still valid
2. Try scanning again
3. Contact QRtiger support if URL persists

---

## Manual Entry Alternative

If scanning doesn't work, users can:

1. **Get Hash from QRtiger Dashboard:**
   - Log into QRtiger account
   - View v-card details
   - Copy the hash/identifier

2. **Extract Hash from QR Code:**
   - Use any QR scanner app
   - Copy the content
   - If it's a URL, visit it and download vCard
   - Generate hash manually (or use online SHA-256 tool)

3. **Enter Hash Manually:**
   - Paste hash into text field
   - Click "Validate v-Card"

---

## Security Considerations

### **What Gets Stored:**
- ✅ **Hash only** (SHA-256)
- ✅ **No personal information**
- ✅ **No vCard content**

### **What Doesn't Get Stored:**
- ❌ Full vCard data
- ❌ Name, email, phone
- ❌ Any PII (Personally Identifiable Information)

### **Privacy:**
- Camera access is temporary (only during scanning)
- No video/photo is stored
- Hash cannot be reversed to reveal identity

---

## Testing

### **Test QR Code Scanning:**

1. **Get a Test QRtiger v-Card:**
   - Create one at https://qrtiger.com
   - Or use a test QR code

2. **Test Flow:**
   ```
   1. Go to /activate-device-step-2?device_id=1
   2. Click "Open Camera Scanner"
   3. Grant camera permission
   4. Point camera at QR code
   5. Wait for auto-detection
   6. Verify hash appears in input field
   7. Verify validation succeeds
   ```

### **Test Manual Entry:**

1. Use a known hash (e.g., test hash from database)
2. Enter directly in text field
3. Click "Validate v-Card"
4. Verify validation succeeds

---

## Code Reference

### **Key Functions:**

- `startScanner()` - Initializes QR scanner
- `stopScanner()` - Stops scanner and cleans up
- `extractVCardHash(qrResult)` - Extracts hash from QR code data
- `generateVCardHash(vcardData)` - Generates SHA-256 hash
- `validateVCard(hash)` - Sends validation request

### **Files:**
- **Frontend:** `template-activate-device-step-2.php`
- **Library:** html5-qrcode (CDN)

---

## Summary

**QR Scanning Features:**
- ✅ Real-time camera scanning
- ✅ Automatic hash extraction
- ✅ Supports URL and direct vCard data
- ✅ SHA-256 hash generation
- ✅ Mobile-friendly
- ✅ Fallback to manual entry

**User Benefits:**
- 🚀 Faster than manual entry
- 📱 Works on mobile devices
- 🔒 Secure (hash only, no PII)
- ✨ Automatic validation

---

## Next Steps

After successful v-card validation:
1. ✅ Device `vcard_status` = `'validated'`
2. ✅ Redirect to Step 3 (Discord Connection)
3. ✅ Device can proceed with registration

