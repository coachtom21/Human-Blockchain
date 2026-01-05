<?php

/**
 * Template Name: FAQ
 */
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>FAQs | HumanBlockchain.info</title>
<meta name="description" content="HumanBlockchain.info FAQs: Serendipity POCs, Proof of
Delivery, XP scientific notation, New World Penny recognition, and VFN redemption boundary.
"
/>
<style>
:root{
--bg:#0b1220; --bg2:#070d18;
--panel: rgba(18,31,61,.70);
--line: rgba(232,238,252,.12);
--text:#e8eefc; --muted:#b8c3e6;
--accent:#7dd3fc; --accent2:#a78bfa;
--good:#86efac; --warn:#fbbf24;
--radius:18px; --shadow: 0 10px 22px rgba(0,0,0,.22);
--maxw: 980px;
--font: ui-sans-serif, system-ui,
-apple-system, Segoe UI, Roboto, Arial,
"Apple Color
Emoji"
,
"Segoe UI Emoji";
--mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas,
"Liberation
Mono"
"Courier New"
,
, monospace;
}
*{box-sizing:border-box}
body{
margin:0;
font-family:var(--font);
color:var(--text);
background:
radial-gradient(1100px 650px at 18% 0%, rgba(167,139,250,.20), transparent 55%),
radial-gradient(1000px 520px at 86% 25%, rgba(125,211,252,.18), transparent 55%),
radial-gradient(700px 420px at 50% 92%, rgba(134,239,172,.10), transparent 60%),
linear-gradient(180deg, var(--bg), var(--bg2));
line-height:1.45;
}
a{color:inherit;text-decoration:none}
.wrap{max-width:var(--maxw); margin:0 auto; padding:0 18px}
.topbar{
position:sticky; top:0; z-index:50;
background:rgba(11,18,32,.78);
backdrop-filter: blur(10px);
border-bottom:1px solid var(--line);
}
.nav{
display:flex; align-items:center; justify-content:space-between;
gap:12px; padding:14px 0;
}
.brand{display:flex;align-items:center;gap:10px}
.logo{
width:36px;height:36px;border-radius:12px;
background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
box-shadow: 0 12px 24px rgba(0,0,0,.25);
}
.brand b{letter-spacing:.3px}
.small{font-size:12px;color:var(--muted)}
.btn{
display:inline-flex;align-items:center;justify-content:center;gap:10px;
padding:10px 14px;border-radius:14px;
border:1px solid rgba(232,238,252,.16);
background: rgba(232,238,252,.06);
color:var(--text);
font-weight:900;font-size:14px;
box-shadow: var(--shadow);
transition: transform .08s ease, background .12s ease, filter .08s ease;
}
.btn:hover{background: rgba(232,238,252,.10); transform: translateY(-1px)}
.btn:active{transform: translateY(0px); filter: brightness(.98)}
.btn.primary{
border-color:transparent;
background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
color:#071024;
}
.btn.ghost{background: transparent}
h1{font-size:34px; letter-spacing:-
.4px; margin:0 0 6px}
p{margin:0 0 12px; color:var(--muted)}
.lead{font-size:16px}
.card{
background:var(--panel);
border:1px solid var(--line);
border-radius:var(--radius);
padding:18px;
box-shadow: var(--shadow);
}
.section{padding:26px 0}
.grid{display:grid; gap:12px}
details{
border-radius:16px;
background: rgba(232,238,252,.05);
border:1px solid rgba(232,238,252,.12);
padding:12px;
overflow:hidden;
}
details[open]{background: rgba(232,238,252,.06)}
details + details{margin-top:10px}
details summary{
cursor:pointer;
list-style:none;
font-weight:900;
display:flex;
align-items:center;
justify-content:space-between;
gap:12px;
}
details summary::-webkit-details-marker{display:none}
details summary::after{
content:"+";
font-weight:900;
color:var(--muted);
width:26px;height:26px;
display:inline-flex;align-items:center;justify-content:center;
border-radius:10px;
border:1px solid rgba(232,238,252,.12);
background: rgba(232,238,252,.04);
flex:0 0 auto;
}
details[open] summary::after{content:"
–
"}
details p{margin:10px 0 0; color:var(--muted)}
code{
font-family:var(--mono);
background: rgba(232,238,252,.06);
border: 1px solid rgba(232,238,252,.14);
padding:2px 6px;
border-radius:10px;
font-size:.95em;
color:var(--text);
}
.pill{
.pillrow{display:flex;gap:8px;flex-wrap:wrap;margin:10px 0 6px}
display:inline-flex;align-items:center;gap:8px;
padding:6px 10px;border-radius:999px;
background: rgba(232,238,252,.08);
border:1px solid rgba(232,238,252,.12);
font-size:12px;color:var(--muted);
}
.dot{width:9px;height:9px;border-radius:999px;background:var(--accent);box-shadow:0 0 0
4px rgba(125,211,252,.10)}
.dot.good{background:var(--good);box-shadow:0 0 0 4px rgba(134,239,172,.10)}
.dot.warn{background:var(--warn);box-shadow:0 0 0 4px rgba(251,191,36,.12)}
.toc{
display:flex; gap:10px; flex-wrap:wrap; margin-top:12px;
}
.toc a{
display:inline-flex;align-items:center;
padding:8px 10px;
border-radius:999px;
border:1px solid rgba(232,238,252,.14);
background: rgba(232,238,252,.06);
color:var(--muted);
font-size:13px;
}
.footer{
padding:26px 0 36px;
border-top:1px solid var(--line);
color:var(--muted);
font-size:13px;
.toc a:hover{background: rgba(232,238,252,.10); color:var(--text)}
}
@media (max-width:520px){
h1{font-size:28px}
.btn{width:100%}
}
</style>
</head>
<body>
<header class="topbar">
<div class="wrap">
<nav class="nav">
<a class="brand" href="/home">
<span class="logo" aria-hidden="true"></span>
<div>
<b>HumanBlockchain.info</b><br>
<span class="small">FAQs • Proof of Delivery • Serendipity POCs</span>
</div>
</a>
<div style="display:flex;gap:10px;flex-wrap:wrap">
<a class="btn ghost" href="/home">Back to Home</a>
<a class="btn primary" href="https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof" target="_blank" rel="noopener noreferrer">PoD Mode</a>
</div>
</nav>
</div>
</header>
<main class="section">
<div class="wrap">
<div class="card">
<h1>Frequently Asked Questions</h1>
<p class="lead">
Simple answers first. Clear boundaries. Proof-first design.
</p>
<div class="pillrow">
<span class="pill"><span class="dot good"></span> Serendipity POCs</span>
<span class="pill"><span class="dot"></span> 2-Scan Proof of Delivery</span>
<span class="pill"><span class="dot.warn"></span> XP is not money</span>
</div>
<div class="toc" aria-label="FAQ jump links">
<a href="#serendipity">Serendipity</a>
<a href="#poc">POCs</a>
<a href="#pod">Proof of Delivery</a>
<a href="#xp">XP + New World Penny</a>
<a href="#referrals">Referrals</a>
<a href="#vfn">VFN / Redemption</a>
</div>
<div style="height:1px;background:rgba(232,238,252,.12);margin:14px 0"></div>
<div class="grid">
<details open id="serendipity">
<summary>What is Serendipity?</summary>
<p>
Serendipity is the onboarding protocol that creates Patron Organizing Communities
(POCs) from the newest device registrations.
It uses <b>geo-location</b> and <b>timestamp</b> so the network forms
fairly—without gatekeepers.
</p>
</details>
<details id="poc">
<summary>How are Buyer POCs and Seller POCs assigned?</summary>
<p>
<b>Buyer POCs are local</b>—assigned from registrations near your location.
<b>Seller POCs are out-of-state or global</b>—assigned away
from your locality to encourage cross-region cooperation and détente by design.
</p>
</details>
<details id="pod">
<summary>What is 2-Scan Proof of Delivery?</summary>
<p>
Proof of Delivery is anchored to a YAM-is-ON voucher (sticker) or hang tag ID. The
<b>seller initiates</b> (first scan).
Optional handoff scans can record custody movement. The <b>buyer acceptance</b>
(second scan) completes settlement.
</p>
</details>
<details>
<p>
destination?” YES/NO.
</p>
</details>
<summary>What do I see right after I scan a voucher or hang tag?</summary>
You’ll see: (1) “Is this Proof of Delivery?” YES/NO. If YES, (2) “Is this the final
YES records a delivered step. NO records an in-route / handoff step.
<details id="xp">
<summary>Is XP money?</summary>
<p>
No. XP is a <b>measurement of verified human action</b>
, displayed in scientific
notation so it can’t be confused with money.
Example: <code>1.0 × 10⁻¹⁸ XP</code>
. XP is recorded at sextillionth-of-a-penny
precision using a 21,000-to-1 USD reference scale
for calibration only (no conversion inside the ledger).
</p>
</details>
<details>
<p>
<summary>What is the New World Penny?</summary>
The New World Penny is the public name for XP-based recognition. It represents
verified action on the ledger and is displayed as
scientific notation XP (measurement), not dollars or cents.
</p>
</details>
<details id="referrals">
<summary>How do referrals work?</summary>
<p>
Referrals are linked through Discord invites. Referral recognition is issued once per
year on <b>September 1st</b> in XP measurement units.
Tiers are displayed in scientific notation:
<br><br>
<b>Tier 1:</b> <code>1.0 × 10⁻¹⁸ XP</code><br>
<b>Tier 5:</b> <code>5.0 × 10⁻¹⁸ XP</code><br>
<b>Tier 25:</b> <code>2.5 × 10⁻¹⁷ XP</code>
</p>
</details>
<details id="vfn">
<summary>Where does redemption happen?</summary>
<p>
Any fiat or crypto redemption—if offered—happens only through the <b>Voluntary
Fulfillment Network (VFN)</b> outside the d-DAO ledger.
HumanBlockchain.info records proof, accounting, and reporting only. No money
custody occurs here.
</p>
</details>
<details>
<summary>Why separate the ledger from redemption?</summary>
<p>
Separation prevents confusion and reduces fraud. The ledger records truth (proof +
accountability). VFN handles any optional redemption
under its own rules and compliance boundaries.
</p>
</details>
</div>
<div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
<a class="btn primary" href="https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof" target="_blank" rel="noopener noreferrer">Enter PoD Mode</a>
<a class="btn" href="/home">Enter Website</a>
<a class="btn ghost" href="/new-world-penny">New World Penny</a>
</div>
<p class="small" style="margin-top:12px">
Disclosure: HumanBlockchain.info provides proof-based ledger visibility and reporting. It
does not custody money.
XP is a cooperative measurement unit displayed in scientific notation.
Any fiat/crypto redemption occurs only through the Voluntary Fulfillment Network (VFN)
outside this ledger.
</p>
</div>
</div>
</main>
<footer class="footer">
<div class="wrap">
© <span id="y"></span> HumanBlockchain.info • YAM-is-ON Delivery Credential
</div>
<script>
document.getElementById('y').textContent = new Date().getFullYear();
</script>
</footer>
</body>
</html>



