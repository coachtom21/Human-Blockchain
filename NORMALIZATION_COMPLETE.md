# Language Normalization - Implementation Summary

## ✅ Completed Changes

### **1. template-home.php** ✅
- ✅ Updated footer with standard "System boundaries" text
- ✅ Fixed custody language (d-DAO non-custodial, VFN custodial)
- ✅ Updated XP language to "loyalty accounting" (not money/credits)
- ✅ Updated New World Penny section with canonical XP language
- ✅ Updated FAQ section with corrected custody language

### **2. template-dao.php** ✅
- ✅ Fixed "XP credits" → "XP loyalty accounting entries"

### **3. template-faq.php** ✅
- ✅ Updated XP definition to canonical language
- ✅ Fixed maturity window language
- ✅ Added standard footer with "System boundaries" text

---

## 🔄 Remaining Files to Update

Based on the audit, these files still need normalization:

1. **template-how-it-works.php** - Check for XP/money language
2. **template-new-world-penny.php** - Verify XP language
3. **template-nil.php** - Check for XP/money language
4. **template-serendipity-protocol.php** - Verify custody language
5. **template-united-citizens.php** - Check for XP/money language
6. **template-peace-pentagons.php** - Verify all language
7. **template-xp-praticipation-ban-protocol.php** - Check XP language

---

## 📋 Standard Footer (To Add to All Pages)

```html
<footer class="fineprint">
  <b>System boundaries:</b>
  The <b>d-DAO General Ledger is non-custodial</b> (verification + XP accounting only).
  The <b>Voluntary Fulfillment Network (VFN)</b> is the <b>sole custodial network</b> for fiat/MSB activities.
  XP is loyalty accounting only—no wallets, balances, escrow, or payment APIs in the ledger layer.
</footer>
```

---

## 🎯 Key Language Corrections Applied

### **Custody Language:**
- ✅ d-DAO General Ledger = **non-custodial** (does not hold, move, or settle money)
- ✅ VFN = **sole custodial network** for fiat/MSB (NOT non-custodial)

### **XP Language:**
- ✅ XP = **loyalty accounting** (not money, not credits, not wallet balance)
- ✅ XP is **not transferable**, **not redeemable on demand**
- ✅ XP entries mature after 8–12 week policy window

### **10-Pack Language:**
- ⚠️ Need to check for "free 10-pack" references
- ⚠️ Should be "10-pack credential kit (pledge-gated)" or "eligible 10-pack (seller pledge required)"

### **$0.30 Language:**
- ⚠️ Need to check for "$0.30 fee" references
- ⚠️ Should be "$0.30 PoD service COGS (cost reimbursement)"

---

## 📝 Next Steps

1. Continue updating remaining template files
2. Add canonical language blocks where appropriate
3. Verify all pages meet normalization checklist
4. Test all pages for consistency

---

## ✅ Normalization Checklist Status

- ✅ Uses d-DAO ledger non-custodial wording
- ✅ States VFN is sole custodial for fiat/MSB
- ⚠️ Never says "free 10-pack" (need to verify all pages)
- ✅ Defines XP/New World Penny as loyalty accounting only
- ⚠️ States STXID minted at Scan 1 and no XP without Scan 2 (need to verify)
- ⚠️ Calls $0.30 "PoD service COGS / reimbursement" (need to verify)

---

## 📄 Files Updated So Far

1. ✅ `template-home.php` - Complete
2. ✅ `template-dao.php` - XP language fixed
3. ✅ `template-faq.php` - XP language and footer updated

---

## 🔍 Search Patterns Used

- `XP.*money|XP.*credit|XP.*balance|XP.*wallet|XP.*redeem`
- `free 10-pack|free voucher|giveaway 10-pack`
- `VFN.*non-custodial|Platform never touches money`
- `\.30 fee|platform fee|PoD fee`

---

**Last Updated:** [Current Date]
**Status:** In Progress (3/17 template files completed)

