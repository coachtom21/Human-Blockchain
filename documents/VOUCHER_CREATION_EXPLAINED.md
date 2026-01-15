# Voucher Creation System - Complete Explanation
## How Vouchers Are Created (No WooCommerce)

---

## 🎯 Key Point: Vouchers Are NOT WooCommerce Products

**Important:** The client's requirements do **NOT** mention WooCommerce products. Vouchers are:
- ✅ **Complimentary** (free, not sold)
- ✅ **Generated programmatically** (created by code, not products)
- ✅ **Stored in custom database table** (`hbc_vouchers`)
- ❌ **NOT WooCommerce products**
- ❌ **NOT for sale**
- ❌ **NOT in shopping cart**

---

## 📦 How Vouchers Are Created

### Step 1: Trigger (When Vouchers Are Created)

Vouchers are created automatically when:
1. Device registration is completed
2. Discord connection is confirmed (or marked "pending Discord")

**One-time only:** Each device gets exactly one 10-pack, ever.

---

### Step 2: User Chooses Pack Type

Before creating vouchers, user selects:
- **Sticker vouchers** (for packages, envelopes, labels)
- **Hang tags** (for physical goods, events, services)

This choice is stored: `pack_type = 'sticker'` or `'hang_tag'`

---

### Step 3: System Generates 10 Vouchers

**Process (in PHP):**

```php
// class-voucher-service.php
class HBC_Voucher_Service {
    
    public function issue_complimentary_pack($device_id, $pack_type) {
        // 1. Check if already issued (prevent duplicates)
        $device = HBC_Device_Service::get($device_id);
        if ($device->complimentary_pack_issued) {
            return new WP_Error('already_issued', 'Pack already issued');
        }
        
        // 2. Generate 10 unique vouchers
        $vouchers = [];
        for ($i = 0; $i < 10; $i++) {
            // Generate unique voucher ID (UUIDv4)
            $voucher_id = wp_generate_uuid4();
            
            // Generate QR code data
            $qr_code = $this->generate_qr_code($voucher_id);
            
            // Create voucher record
            $vouchers[] = [
                'voucher_id' => $voucher_id,        // Unique ID
                'device_id' => $device_id,          // Who owns it
                'pack_type' => $pack_type,          // sticker or hang_tag
                'pack_source' => 'complimentary',    // Free, not purchased
                'status' => 'issued',                // Initial status
                'qr_code' => $qr_code               // QR code data
            ];
        }
        
        // 3. Insert all 10 vouchers into database
        foreach ($vouchers as $v) {
            $this->create_voucher($v);
        }
        
        // 4. Update device record
        $device->update([
            'complimentary_pack_issued' => true,
            'pack_type' => $pack_type,
            'pack_issued_at' => current_time('mysql')
        ]);
        
        // 5. Write ledger entry (NO XP - amount = 0)
        HBC_XP_Ledger_Service::create_entry([
            'entry_type' => 'complimentary_pack_issued',
            'actor_type' => 'device',
            'actor_id' => $device_id,
            'amount' => 0,  // No XP for issuance
            'metadata' => [
                'pack_type' => $pack_type,
                'quantity' => 10,
                'reference' => 'onboarding'
            ]
        ]);
        
        return $vouchers;
    }
    
    // Generate QR code for voucher
    private function generate_qr_code($voucher_id) {
        // QR code contains URL to scan voucher
        $scan_url = home_url('/pod?voucher_id=' . $voucher_id);
        
        // Use QR code library to generate
        // Example: phpqrcode library
        // Returns: QR code image data or URL
        return $scan_url; // Or encoded QR image data
    }
}
```

---

## 🔢 What Each Voucher Contains

### Voucher Data Structure:

```php
Each Voucher:
├── voucher_id (UUIDv4) - Unique identifier
├── device_id - Links to device that owns it
├── pack_type - 'sticker' or 'hang_tag'
├── pack_source - 'complimentary' (always free)
├── status - 'issued', 'unused', 'attached', 'validated', 'closed'
├── qr_code - QR code data/URL
├── seller_scan_at - When seller scanned (Scan 1)
├── buyer_scan_at - When buyer scanned (Scan 2)
├── xp_entry_id - Links to XP ledger when validated
├── created_at - When voucher was created
└── validated_at - When both scans completed
```

---

## 📱 QR Code Generation

### What's in the QR Code?

**Option 1: URL (Recommended)**
```
https://humanblockchain.info/pod?voucher_id=abc123-def456-ghi789
```

**Option 2: Just Voucher ID**
```
abc123-def456-ghi789
```
(Then system constructs URL on scan)

### How QR Code is Generated:

**PHP Library Options:**
1. **phpqrcode** (Recommended)
   ```php
   require_once 'phpqrcode/qrlib.php';
   QRcode::png($data, $filename, QR_ECLEVEL_L, 10, 2);
   ```

2. **Endroid QR Code**
   ```php
   use Endroid\QrCode\QrCode;
   $qrCode = new QrCode($data);
   ```

3. **Simple QR Code API**
   ```php
   $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($data);
   ```

**Recommendation:** Use `phpqrcode` library - it's free, works offline, and reliable.

---

## 📄 PDF Generation (Digital Fulfillment)

### How PDF is Created:

```php
public function generate_pack_pdf($device_id) {
    // Get all vouchers for this device
    $vouchers = $this->get_vouchers_by_device($device_id, 'issued');
    
    // Use PDF library (TCPDF, FPDF, or DomPDF)
    $pdf = new TCPDF();
    $pdf->AddPage();
    
    // Layout: 2 vouchers per row, 5 rows = 10 vouchers
    $x = 10;
    $y = 10;
    $width = 90;
    $height = 90;
    
    foreach ($vouchers as $index => $voucher) {
        // Add QR code image
        $qr_image = $this->generate_qr_image($voucher->qr_code);
        $pdf->Image($qr_image, $x, $y, $width, $height);
        
        // Add voucher ID text
        $pdf->SetXY($x, $y + $height);
        $pdf->SetFontSize(8);
        $pdf->Cell($width, 5, substr($voucher->voucher_id, 0, 8) . '...', 0, 1);
        
        // Position next voucher
        if (($index + 1) % 2 == 0) {
            $x = 10;
            $y += $height + 20;
        } else {
            $x += $width + 10;
        }
    }
    
    // Return PDF file
    return $pdf->Output('voucher-pack.pdf', 'D'); // 'D' = download
}
```

**PDF Library Options:**
1. **TCPDF** (Recommended) - Full featured, good QR support
2. **FPDF** - Lightweight, simple
3. **DomPDF** - HTML to PDF conversion

---

## 🗄️ Database Storage

### Table: `hbc_vouchers`

```sql
CREATE TABLE hbc_vouchers (
    voucher_id VARCHAR(36) PRIMARY KEY,  -- UUIDv4
    device_id VARCHAR(36) NOT NULL,      -- Owner
    pack_type ENUM('sticker', 'hang_tag') NOT NULL,
    pack_source ENUM('complimentary', 'purchased') DEFAULT 'complimentary',
    status ENUM('issued', 'unused', 'attached', 'validated', 'closed') DEFAULT 'issued',
    qr_code VARCHAR(255) NOT NULL,       -- QR code data/URL
    seller_scan_at DATETIME NULL,       -- Scan 1 timestamp
    buyer_scan_at DATETIME NULL,        -- Scan 2 timestamp
    xp_entry_id BIGINT UNSIGNED NULL,   -- Links to XP ledger
    created_at DATETIME NOT NULL,
    validated_at DATETIME NULL,
    INDEX idx_device (device_id),
    INDEX idx_status (status),
    INDEX idx_qr_code (qr_code)
);
```

**Important:** Vouchers are stored in custom table, NOT as WordPress posts or WooCommerce products.

---

## 🔄 Voucher Lifecycle

### Status Flow:

```
1. issued (complimentary)
   ↓
2. unused (ready to use)
   ↓
3. attached (seller scan - Scan 1)
   ↓
4. validated (buyer scan - Scan 2) ← XP MINTED HERE
   ↓
5. closed (ledger finalized)
```

**XP is ONLY created at step 4 (validated), not before.**

---

## 📋 Complete Creation Flow

### User Journey:

1. **User registers device**
   - Device ID created
   - Geo-location captured
   - POC assigned

2. **User connects Discord**
   - OAuth flow
   - Roles assigned
   - Status: Active

3. **System triggers pack issuance**
   - Checks: `complimentary_pack_issued = false`
   - User selects: Sticker or Hang Tag
   - System generates 10 vouchers
   - Each gets unique ID + QR code
   - All stored in database

4. **User downloads PDF**
   - System generates PDF with 10 QR codes
   - User downloads and prints
   - Or views on mobile

5. **User uses vouchers**
   - Attaches to deliveries
   - Seller scans (Scan 1)
   - Buyer scans (Scan 2)
   - XP minted on validation

---

## 🚫 What Vouchers Are NOT

### ❌ NOT WooCommerce Products
- No product pages
- No shopping cart
- No checkout process
- No payment processing
- No inventory management

### ❌ NOT For Sale
- Complimentary only
- No price
- No purchase option
- One per device, ever

### ❌ NOT Physical Products Initially
- Digital-first (PDF download)
- User prints themselves
- Physical fulfillment optional later

---

## ✅ What Vouchers ARE

### ✅ Complimentary Starter Kit
- Free onboarding tool
- Enables participation
- No cash value
- Not a reward

### ✅ Digital Tokens
- Unique IDs in database
- QR codes for scanning
- Trackable status
- Linked to device

### ✅ Proof-of-Delivery Enablers
- Used in 2-scan process
- Seller scan (pledge)
- Buyer scan (confirm)
- XP minted on validation

---

## 🛠️ Implementation Requirements

### Required Libraries:

1. **QR Code Generation**
   - Library: `phpqrcode` or similar
   - Function: Generate QR code image from voucher ID
   - Format: PNG or SVG

2. **PDF Generation**
   - Library: `TCPDF` or `FPDF`
   - Function: Create PDF with 10 QR codes
   - Layout: Printable format

### Required Functions:

```php
// Generate voucher ID
function generate_voucher_id() {
    return wp_generate_uuid4();
}

// Generate QR code
function generate_qr_code($voucher_id) {
    $url = home_url('/pod?voucher_id=' . $voucher_id);
    // Use QR library to create image
    return $qr_image_data;
}

// Create voucher in database
function create_voucher($voucher_data) {
    global $wpdb;
    $wpdb->insert($wpdb->prefix . 'hbc_vouchers', $voucher_data);
}

// Generate PDF pack
function generate_pack_pdf($device_id) {
    // Get vouchers
    // Create PDF
    // Add QR codes
    // Return PDF file
}
```

---

## 📊 Summary

### Voucher Creation Process:

1. **Trigger:** Device registration + Discord connection
2. **User Choice:** Sticker or Hang Tag
3. **System Generates:** 10 unique vouchers (UUID + QR code)
4. **Storage:** Custom database table (`hbc_vouchers`)
5. **Fulfillment:** PDF download (digital-first)
6. **Usage:** 2-scan process (seller + buyer)
7. **XP:** Minted only on validation (Scan 2)

### Key Points:

- ✅ **Programmatic creation** (code generates vouchers)
- ✅ **Custom database table** (not WooCommerce)
- ✅ **Complimentary** (free, not sold)
- ✅ **One pack per device** (ever)
- ✅ **Digital-first** (PDF download)
- ❌ **NOT WooCommerce products**
- ❌ **NOT for sale**
- ❌ **NOT physical products** (initially)

---

## ❓ Common Questions

### Q: Can vouchers be purchased?
**A:** No, they're complimentary only. One free pack per device.

### Q: Can we use WooCommerce for this?
**A:** No, vouchers are not products. They're generated programmatically and stored in custom table.

### Q: How do users get physical vouchers?
**A:** They download PDF and print themselves. Physical mail fulfillment is optional later.

### Q: Can vouchers be transferred?
**A:** No, vouchers are linked to device. Cannot be transferred or sold.

### Q: What if user wants more vouchers?
**A:** They would need to register another device (subject to abuse prevention rules).

---

**Last Updated:** January 2025
