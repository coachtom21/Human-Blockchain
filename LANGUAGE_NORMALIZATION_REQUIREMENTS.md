# Site-Wide Language Normalization Requirements

## 📋 Overview

The client has provided **canonical language blocks** and **find/replace rules** that must be applied across **ALL pages** of the HumanBlockchain.info site to ensure consistent, legally compliant messaging.

---

## 🎯 Key Corrections (Single Source of Truth)

1. **d-DAO General Ledger** = **non-custodial** (does not hold, move, or settle money)
2. **VFN** = **sole custodial network** for fiat/MSB (NOT non-custodial)
3. **XP/New World Penny** = **loyalty accounting only** (NOT money, NOT credits, NOT wallet balance)
4. **10-pack** = **credential kit**; NOT "free"; **pledge-gated** ($10.30 with $0.30 PoD service COGS)
5. **$0.30** = **PoD service COGS** (cost reimbursement); **never enters XP**
6. **STXID** = minted at **Scan 1**; **XP only after Scan 2**

---

## 📝 Canonical Language Blocks

### **A. Custody + Money Flow (Canonical)**

```html
<div class="callout warn">
  <b>Custody clarification</b>
  The <b>d-DAO General Ledger is non-custodial</b> and does not hold, move, or settle money.
  The <b>Voluntary Fulfillment Network (VFN)</b> is the <b>sole custodial network</b> for any fiat, MSB,
  or seller-funded activities. The ledger records <b>verification + XP accounting only</b>.
</div>
```

### **B. XP / New World Penny (Canonical)**

```html
<div class="callout">
  <b>Loyalty points = XP (New World Penny)</b>
  XP is a memo-ledger unit used for loyalty accounting of verified human value.
  XP is <b>not money</b>, <b>not a wallet balance</b>, <b>not transferable</b>, and <b>not redeemable on demand</b>.
  XP entries are created only after verification and may mature after an 8–12 week policy window.
</div>
```

### **C. 10-Pack Eligibility (Canonical)**

```html
<div class="callout">
  <b>10-pack credential kit (pledge-gated)</b>
  A 10-pack (stickers or hang tags) is a <b>credential kit</b>, not merchandise.
  Do not label it "free." Eligibility requires a seller pledge of <b>$10.30</b>,
  with <b>$0.30</b> allocated to PoD service <b>COGS</b> (outside XP).
</div>
```

### **D. 2-Scan + STXID Rule (Canonical)**

```html
<div class="callout">
  <b>2-scan verification rule</b>
  <b>STXID</b> (Seller Transaction ID) is minted only at <b>Scan 1 (Initiate)</b>.
  No XP ledger entries are created until <b>Scan 2 (Confirm)</b> is accepted.
</div>
```

---

## 🔄 Find/Replace Rules (Exact Sweep List)

### **A. Custody Sentence Normalization**

**FIND (common old lines):**
- `The VFN remains non-custodial and does not touch money`
- `VFN is non-custodial and does not touch money`
- `Platform never touches money`
- `VFN does not hold or move money`

**REPLACE with (single canonical sentence):**
```
The d-DAO General Ledger is non-custodial and does not hold, move, or settle money. The Voluntary Fulfillment Network (VFN) is the sole custodial network for any fiat, MSB, or seller-funded activities.
```

### **B. "Free 10-pack" Normalization**

**FIND:**
- `free 10-pack`
- `Get your free 10-pack`
- `free voucher kit`
- `giveaway 10-pack`

**REPLACE with:**
- `eligible 10-pack (seller pledge required)`
- OR for headlines: `10-pack credential kit (pledge-gated)`

### **C. XP as Money/Credits Normalization**

**FIND:**
- `XP credits`
- `XP is redeemable`
- `XP balance`
- `wallet balance`
- `store credit`

**REPLACE with:**
- `XP loyalty accounting`
- `XP memo-ledger unit`

### **D. $0.30 "Fee" Normalization**

**FIND:**
- `$0.30 fee`
- `platform fee`
- `PoD fee`

**REPLACE with:**
- `$0.30 PoD service COGS (cost reimbursement)`

---

## 🎨 Approved "One-Line" UI Copy

### **Buttons/Tooltips:**

**Replace "free 10-pack" phrasing with:**
- Button: `Request 10-Pack (Pledge Required)`
- Subtitle: `Credential kit after seller pledge ($10.30)`

**Replace "platform doesn't touch money / VFN non-custodial" with:**
- Tooltip: `Ledger is non-custodial; VFN is custodial for fiat/MSB`

**Replace "XP points = money/credits" with:**
- Tooltip: `XP is loyalty accounting only (not money)`

---

## 📄 Page Footer Standard (Put on Every Page)

```html
<footer class="fineprint">
  <b>System boundaries:</b>
  The <b>d-DAO General Ledger is non-custodial</b> (verification + XP accounting only).
  The <b>Voluntary Fulfillment Network (VFN)</b> is the <b>sole custodial network</b> for fiat/MSB activities.
  XP is loyalty accounting only—no wallets, balances, escrow, or payment APIs in the ledger layer.
</footer>
```

---

## ✅ Normalization Checklist (Acceptance Criteria)

A page is "normalized" only if **ALL** are true:

- ✅ Uses d-DAO ledger non-custodial wording
- ✅ States VFN is sole custodial for fiat/MSB
- ✅ Never says "free 10-pack"
- ✅ Defines XP/New World Penny as loyalty accounting only
- ✅ States STXID minted at Scan 1 and no XP without Scan 2
- ✅ Calls $0.30 "PoD service COGS / reimbursement" and says never in XP

---

## 📂 Files That Need Updates

Based on the codebase search, these files likely need normalization:

1. **template-home.php** - Main home page
2. **template-how-it-works.php** - How it works page
3. **template-faq.php** - FAQ page
4. **template-new-world-penny.php** - New World Penny page
5. **template-nil.php** - NIL page
6. **template-united-citizens.php** - United Citizens page
7. **template-serendipity-protocol.php** - Serendipity Protocol page
8. **template-peace-pentagons.php** - Peace Pentagons page
9. **Any other template files** that mention:
   - XP as money/credits
   - Free 10-pack
   - VFN as non-custodial
   - $0.30 as a fee

---

## 🚀 Implementation Plan

### **Step 1: Audit All Pages**
- Search for all instances of incorrect language
- Create a list of files that need updates

### **Step 2: Apply Find/Replace Rules**
- Use the exact find/replace rules provided
- Update all instances across all files

### **Step 3: Add Canonical Language Blocks**
- Add appropriate callout blocks to relevant pages
- Ensure consistency across all pages

### **Step 4: Add Standard Footer**
- Add the standard footer to every page
- Ensure it's consistent

### **Step 5: Verify Checklist**
- Go through each page and verify all checklist items
- Ensure no page says "free 10-pack"
- Ensure XP is always described as loyalty accounting only
- Ensure VFN is described as custodial (not non-custodial)

---

## ⚠️ Critical Corrections

### **Most Important Changes:**

1. **VFN is CUSTODIAL** (not non-custodial)
   - OLD: "VFN is non-custodial"
   - NEW: "VFN is the sole custodial network for fiat/MSB"

2. **d-DAO Ledger is NON-CUSTODIAL**
   - OLD: (confused with VFN)
   - NEW: "d-DAO General Ledger is non-custodial and does not hold, move, or settle money"

3. **XP is NOT Money**
   - OLD: "XP credits", "XP balance", "wallet balance"
   - NEW: "XP loyalty accounting", "XP memo-ledger unit"

4. **10-Pack is NOT Free**
   - OLD: "free 10-pack", "giveaway 10-pack"
   - NEW: "10-pack credential kit (pledge-gated)", "eligible 10-pack (seller pledge required)"

5. **$0.30 is COGS, Not Fee**
   - OLD: "$0.30 fee", "platform fee"
   - NEW: "$0.30 PoD service COGS (cost reimbursement)"

---

## 📝 Notes

- These changes are **legally critical** for compliance
- Language must be **exact** as provided
- All pages must be consistent
- Footer must be on every page
- No exceptions to the canonical language

---

## 🔍 Next Steps

1. **Review this document** with the client
2. **Get approval** on implementation approach
3. **Implement changes** across all template files
4. **Verify** using the normalization checklist
5. **Test** all pages for consistency

