HTML PoD Mode
Generate html/css content page for PoD Mode for humanblockchain.info
<!DOCTYPE html>
<html lang=
<head>
"en">
<meta charset=
"UTF-8" />
<meta name=
"viewport" content=
"width=device-width, initial-scale=1"
/>
<title>PoD Mode | HumanBlockchain.info</title>
<style>
:root{
--bg:#0b1020;
--card:#101a34;
--text:#eef2ff;
--muted:#b8c1e3;
--line:rgba(255,255,255,.14);
--shadow:0 18px 50px rgba(0,0,0,.55);
--radius:18px;
--btnRadius:14px;
--focus:0 0 0 3px rgba(120,160,255,.35);
}
*{box-sizing:border-box}
body{
margin:0;
min-height:100vh;
font-family: system-ui,
-apple-system,Segoe
UI,Roboto,Helvetica,Arial;
background:
radial-gradient(1000px 650px at 20% 10%,
rgba(120,160,255,.18), transparent 60%),
radial-gradient(900px 650px at 80% 85%, rgba(52,211,153,.12),
transparent 65%),
var(--bg);
color:var(--text);
}
/* Top nav (simple, drop-in) */
.nav{
position:sticky;
top:0;
z-index:10;
backdrop-filter: blur(10px);
background: rgba(11,16,32,.68);
border-bottom:1px solid var(--line);
}
.nav-inner{
max-width:1100px;
margin:0 auto;
padding:14px 18px;
display:flex;
align-items:center;
justify-content:space-between;
gap:14px;
}
.brand{
display:flex;
gap:10px;
align-items:center;
min-width:0;
text-decoration:none;
color:var(--text);
}
.logo{
width:34px;height:34px;border-radius:12px;
background:
radial-gradient(circle at 30% 30%, rgba(52,211,153,.9),
transparent 60%),
radial-gradient(circle at 70% 70%, rgba(120,160,255,.9),
transparent 60%),
rgba(255,255,255,.06);
border:1px solid var(--line);
flex:0 0 auto;
}
.brand h1{
margin:0;
font-size:14px;
letter-spacing:.4px;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}
.brand small{
display:block;
font-size:12px;
color:var(--muted);
margin-top:2px;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}
.nav-links{
display:flex;
gap:10px;
flex-wrap:wrap;
justify-content:flex-end;
}
.nav-links a{
text-decoration:none;
color:var(--muted);
font-weight:700;
font-size:12px;
padding:10px 12px;
border-radius: 999px;
border:1px solid rgba(255,255,255,.10);
background: rgba(255,255,255,.04);
}
.nav-links a:hover{ filter:brightness(1.08); }
.nav-links a:focus{ outline:none; box-shadow: var(--focus); }
/* Layout */
.wrap{
max-width:1100px;
margin:0 auto;
padding:26px 18px 60px;
}
.hero{
display:grid;
grid-template-columns: 1.2fr .8fr;
gap:18px;
align-items:stretch;
}
@media(max-width: 900px){
.hero{ grid-template-columns:1fr; }
}
.card{
border:1px solid var(--line);
background: rgba(255,255,255,.05);
border-radius: var(--radius);
box-shadow: var(--shadow);
overflow:hidden;
}
.card-inner{ padding:20px; }
.badge{
display:inline-flex;
align-items:center;
gap:8px;
padding:8px 12px;
border-radius:999px;
border:1px solid rgba(255,255,255,.14);
background: rgba(0,0,0,.18);
color:var(--muted);
font-size:12px;
letter-spacing:.2px;
}
.badge .dot{
width:8px;height:8px;border-radius:50%;
background:#34d399;
box-shadow:0 0 0 3px rgba(52,211,153,.18);
}
h2{
margin:12px 0 10px;
font-size:30px;
letter-spacing:.2px;
line-height:1.15;
}
p{ margin:10px 0; }
.muted{ color:var(--muted); }
.grid{
margin-top:14px;
display:grid;
grid-template-columns:1fr 1fr;
gap:12px;
}
@media(max-width: 700px){
.grid{ grid-template-columns:1fr; }
}
.panel{
border:1px solid rgba(255,255,255,.14);
background: rgba(0,0,0,.18);
border-radius: 16px;
padding:14px;
}
.panel h3{
margin:0 0 8px;
color:var(--muted);
font-size:13px;
letter-spacing:.35px;
text-transform:uppercase;
}
ul{ margin:0; padding-left:18px; }
li{ margin:7px 0; }
/* Right rail card (PoD controls) */
.mode{
rgba(255,255,255,.03));
}
background: linear-gradient(180deg, rgba(52,211,153,.10),
.mode h3{
margin:0 0 8px;
font-size:14px;
letter-spacing:.35px;
text-transform:uppercase;
color:var(--muted);
}
.mode .status{
margin-top:8px;
padding:12px;
border-radius: 16px;
border:1px solid rgba(255,255,255,.14);
background: rgba(0,0,0,.18);
}
.statusRow{
display:flex;
justify-content:space-between;
gap:10px;
align-items:center;
flex-wrap:wrap;
}
.pill{
display:inline-flex;
align-items:center;
gap:8px;
padding:8px 10px;
border-radius:999px;
border:1px solid rgba(255,255,255,.14);
background: rgba(255,255,255,.04);
color:var(--muted);
font-weight:800;
font-size:12px;
}
.pill strong{ color:var(--text); }
.pill .miniDot{
width:8px;height:8px;border-radius:50%;
background: rgba(255,255,255,.35);
}
.pill.on .miniDot{
background:#34d399;
box-shadow:0 0 0 3px rgba(52,211,153,.18);
}
.btnRow{
margin-top:12px;
display:grid;
gap:10px;
}
.btn{
appearance:none;
border:none;
border-radius: var(--btnRadius);
padding:12px 14px;
font-weight:900;
cursor:pointer;
text-align:left;
display:flex;
justify-content:space-between;
align-items:center;
gap:12px;
border:1px solid transparent;
transition: transform .06s ease, filter .12s ease;
}
.btn:active{ transform: translateY(1px); }
.btn:focus{ outline:none; box-shadow: var(--focus); }
.btnPrimary{
background: linear-gradient(180deg,#34d399,#10b981);
color:#052015;
border-color: rgba(52,211,153,.35);
}
.btnGhost{
background: rgba(255,255,255,.06);
color: var(--text);
border-color: rgba(255,255,255,.14);
}
.btn small{
display:block;
font-weight:800;
color: rgba(0,0,0,.55);
}
.btnGhost small{ color: rgba(255,255,255,.70); }
.arrow{ font-weight:900; }
.fineprint{
margin-top:12px;
padding-top:12px;
border-top:1px solid rgba(255,255,255,.14);
font-size:12px;
color:var(--muted);
line-height:1.5;
}
/* Sections */
.section{
margin-top:18px;
}
.section .card{ margin-top:12px; }
.kpi{
display:grid;
grid-template-columns: repeat(3, 1fr);
gap:12px;
margin-top:12px;
}
@media(max-width: 850px){
.kpi{ grid-template-columns: 1fr; }
}
.kpi .panel{
padding:14px;
}
.kpi .big{
font-size:22px;
font-weight:950;
letter-spacing:.2px;
margin:0 0 4px;
}
.kpi .label{
margin:0;
color:var(--muted);
font-size:12px;
font-weight:800;
letter-spacing:.3px;
text-transform:uppercase;
}
.callout{
margin-top:12px;
padding:14px;
border-radius: 16px;
border:1px solid rgba(255,255,255,.14);
background: rgba(255,255,255,.04);
}
.callout b{ display:block; margin-bottom:6px; }
code{
font-family: ui-monospace, SFMono-Regular, Menlo, Monaco,
Consolas,
"Liberation Mono"
"Courier New"
,
, monospace;
font-size:12px;
color: rgba(234,240,255,.92);
background: rgba(0,0,0,.22);
padding:2px 6px;
border-radius:8px;
border:1px solid rgba(255,255,255,.10);
white-space:nowrap;
}
</style>
</head>
<body>
<!-- Simple header -->
<header class=
"nav">
<div class=
"nav-inner">
<a class=
"brand" href=
"index.html">
<div class=
"logo" aria-hidden=
"true"></div>
<div>
</div>
<h1>HumanBlockchain.info</h1>
<small>PoD Mode • Device-driven verification</small>
</a>
<nav class=
<a href=
<a href=
<a href=
<a href=
"nav-links" aria-label=
"Primary">
"how-it-works.html">How It Works</a>
"proof-of-delivery.html">Proof of Delivery</a>
"register-device.html">Register Device</a>
"faq.html">FAQs</a>
</nav>
</div>
</header>
<main class=
"wrap">
<!-- HERO -->
<div class=
"hero">
<!-- Left: explanation -->
<section class=
"card">
<div class=
"card-inner">
<div class=
"badge"><span class=
active verification for real-world delivery</div>
"dot"></span> PoD Mode is
<h2>PoD Mode</h2>
<p class=
"muted">
PoD Mode is a focused experience for completing
<b>device-driven, 2-scan Proof of Delivery</b> events.
It’s designed for real-world handoffs—packages, services,
in-person deliveries—where trust is created
by <b>two independent confirmations</b>.
</p>
<div class=
"grid">
<div class=
"panel">
<h3>2-scan sequence</h3>
<ul>
dispatch / service start</li>
delivery / completion</li>
verification</li>
</ul>
</div>
<li><b>Scan 1 (Initiate)</b>: provider confirms
<li><b>Scan 2 (Confirm)</b>: receiver confirms
<li>Both scans record <b>timestamp + location</b> for
<div class=
"panel">
<h3>What PoD Mode does</h3>
<ul>
<li>Reduces “he said / she said” disputes</li>
<li>Creates a clean, auditable confirmation
record</li>
<li>Supports loyalty points + participation credits
(site policy)</li>
</ul>
</div>
</div>
<div class=
"callout">
<b>Important</b>
PoD Mode is about <b>verification</b>. It does not process
payments, store funds, or function as a bank.
It records confirmation signals so merchants and
communities can measure human value fairly.
</div>
</div>
</section>
<!-- Right: mode controls / CTAs -->
<aside class=
"card mode">
<div class=
"card-inner">
<h3>PoD Mode Controls</h3>
<p class=
"muted" style=
"margin-top:6px;">
Use these actions to begin, complete, or review a Proof of
Delivery event.
</p>
aria-hidden=
aria-hidden=
aria-hidden=
<div class=
"status">
<div class=
"statusRow">
<div class=
"pill on"><span class=
"miniDot"
"true"></span><strong>PoD Mode</strong> ON</div>
<div class=
"pill"><span class=
"miniDot"
"true"></span><strong>2-Scan</strong> Required</div>
<div class=
"pill"><span class=
"miniDot"
"true"></span><strong>Device</strong> Verified</div>
</div>
</div>
onclick=
<div class=
"btnRow">
<button class=
"btn btnPrimary" type=
"window.location.href=
'pod-start.html'">
Start Scan 1 (Initiate)
<span class=
"arrow">→</span>
</button>
"button"
onclick=
<button class=
"btn btnGhost" type=
"window.location.href=
'pod-confirm.html'">
Complete Scan 2 (Confirm)
<span class=
"arrow">→</span>
</button>
"button"
onclick=
<button class=
"window.location.href=
View PoD History
<span class=
</button>
"btn btnGhost" type=
'pod-history.html'">
"button"
"arrow">→</span>
onclick=
<button class=
"btn btnGhost" type=
"window.location.href=
'help.html#pod'">
PoD Help & Troubleshooting
<span class=
"arrow">→</span>
</button>
</div>
"button"
<div class=
"fineprint">
<b>Data minimization:</b> PoD Mode focuses on device
verification signals (timestamp + location + scan state).
Avoid entering sensitive personal data. Your merchant or
community policies determine any loyalty points
or participation credits associated with verified events.
</div>
</div>
</aside>
</div>
<!-- KPI / Quick reference -->
<section class=
"section">
<div class=
"card">
<div class=
"card-inner">
<div class=
"badge"><span class=
Reference</div>
"dot"></span> Quick
<div class=
"kpi">
<div class=
"panel">
<p class=
"big">Scan 1</p>
<p class=
"label">Initiate / Dispatch / Start</p>
<p class=
"muted" style=
"margin:8px 0 0;">
Creates a pending PoD record and locks the event to a
device context.
</p>
</div>
<div class=
<p class=
<p class=
<p class=
verification outcome.
</p>
</div>
"panel">
"big">Scan 2</p>
"label">Confirm / Receive / Complete</p>
"muted" style=
"margin:8px 0 0;">
Completes the PoD record and finalizes the
<div class=
"panel">
<p class=
"big">Result</p>
<p class=
"label">Verified participation</p>
<p class=
"muted" style=
"margin:8px 0 0;">
A verifiable confirmation record usable for loyalty
points and dispute clarity.
</p>
</div>
</div>
<div class=
"callout" style=
"margin-top:14px;">
<b>Implementation note (for devs)</b>
Typical PoD Mode record fields: <code>event_id</code>,
<code>scan1_device_id</code>, <code>scan1_time</code>,
<code>scan1_geo</code>, <code>scan2_device_id</code>,
<code>scan2_time</code>, <code>scan2_geo</code>,
<code>status</code> (pending/verified/failed), and a
merchant-defined <code>points_policy_id</code>.
</div>
</div>
</div>
</section>
</main>
</body>
</html>
generate content for Start Scan 1 (Initiate) → Complete Scan 2 (Confirm) → View PoD
History → PoD Help & Troubleshooting → links
Below are four clean, copy-paste–ready HTML/CSS content pages for the PoD Mode links
on humanblockchain.info.
They share a consistent visual system and plain-language framing aligned with your
device-driven, loyalty-safe model.
You can deploy them as:
pod-start.html
●
●
pod-confirm.html
●
pod-history.html
●
pod-help.html
1⃣ Start Scan 1 (Initiate)
File: pod-start.html
<!DOCTYPE html>
<html lang=
"en">
<head>
<meta charset=
"UTF-8">
<meta name=
"viewport" content=
"width=device-width, initial-scale=1">
<title>Start Scan 1 | PoD Mode</title>
<link rel=
"stylesheet" href=
"pod-shared.css">
</head>
<body>
<main class=
"wrap">
<h1>Start Scan 1 (Initiate)</h1>
<p class=
"lead">
Scan 1 begins a Proof of Delivery event.
It confirms that a product, service, or handoff has been
initiated.
</p>
<section class=
"panel">
<h2>When to use Scan 1</h2>
<ul>
</ul>
</section>
<li>A package is shipped or handed off</li>
<li>A service begins (on-site, in-person, or remote)</li>
<li>A digital or physical delivery process starts</li>
<section class=
"panel">
<h2>What Scan 1 records</h2>
<ul>
<li>Device ID (hashed)</li>
<li>Timestamp</li>
<li>Approximate location</li>
<li>Event status: <strong>Pending</strong></li>
</ul>
</section>
<section class=
"callout">
<strong>Important:</strong>
Scan 1 does not complete delivery.
No loyalty points or participation credit are finalized until Scan
2 occurs.
</section>
<a class=
"btn primary" href=
Proceed to Scan 2 →
</a>
</main>
"pod-confirm.html">
</body>
</html>
2⃣ Complete Scan 2 (Confirm)
File: pod-confirm.html
<!DOCTYPE html>
<html lang=
"en">
<head>
<meta charset=
"UTF-8">
<meta name=
"viewport" content=
"width=device-width, initial-scale=1">
<title>Complete Scan 2 | PoD Mode</title>
<link rel=
"stylesheet" href=
"pod-shared.css">
</head>
<body>
<main class=
"wrap">
<h1>Complete Scan 2 (Confirm)</h1>
<p class=
"lead">
Scan 2 confirms that delivery or service completion has occurred.
This final step verifies the Proof of Delivery event.
</p>
<section class=
"panel">
<h2>Who performs Scan 2</h2>
<ul>
<li>The recipient of a product</li>
<li>The customer receiving a service</li>
<li>An authorized receiving party</li>
</ul>
</section>
<section class=
"panel">
<h2>What Scan 2 does</h2>
<ul>
</ul>
</section>
<li>Links to an existing Scan 1 event</li>
<li>Records device, time, and location</li>
<li>Marks the event as <strong>Verified</strong></li>
<section class=
"callout">
<strong>Result:</strong>
Once Scan 2 is complete, the Proof of Delivery record becomes
immutable
and eligible for loyalty points or participation recognition (per
policy).
</section>
<a class=
"btn ghost" href=
View PoD History →
"pod-history.html">
</a>
</main>
</body>
</html>
3⃣ View PoD History
File: pod-history.html
<!DOCTYPE html>
<html lang=
"en">
<head>
<meta charset=
"UTF-8">
<meta name=
"viewport" content=
"width=device-width, initial-scale=1">
<title>PoD History | HumanBlockchain</title>
<link rel=
"stylesheet" href=
"pod-shared.css">
</head>
<body>
<main class=
"wrap">
<h1>Proof of Delivery History</h1>
<p class=
"lead">
PoD History shows your verified delivery records created through
device-driven 2-scan confirmation.
</p>
<section class=
"panel">
<h2>What you can see</h2>
<ul>
<li>Initiated events (Scan 1 only)</li>
<li>Verified events (Scan 1 + Scan 2)</li>
<li>Timestamps and confirmation status</li>
</ul>
</section>
<section class=
"panel">
<h2>Status meanings</h2>
<ul>
</ul>
</section>
<li><strong>Pending</strong> — awaiting Scan 2</li>
<li><strong>Verified</strong> — delivery confirmed</li>
<li><strong>Expired</strong> — confirmation window elapsed</li>
<section class=
"callout">
<strong>Note:</strong>
PoD records are append-only. They cannot be edited or deleted once
verified.
</section>
<a class=
Need help? →
</a>
</main>
"btn ghost" href=
"pod-help.html">
</body>
</html>
4⃣ PoD Help & Troubleshooting
File: pod-help.html
<!DOCTYPE html>
<html lang=
"en">
<head>
<meta charset=
"UTF-8">
<meta name=
"viewport" content=
"width=device-width, initial-scale=1">
<title>PoD Help | HumanBlockchain</title>
<link rel=
"stylesheet" href=
"pod-shared.css">
</head>
<body>
<main class=
"wrap">
<h1>PoD Help & Troubleshooting</h1>
<p class=
"lead">
Most Proof of Delivery issues can be resolved by understanding
how device-driven confirmation works.
</p>
<section class=
"panel">
<h2>Common issues</h2>
<ul>
<li>Scan 2 not completed</li>
<li>Different device used unintentionally</li>
<li>Location permissions disabled</li>
<li>Confirmation window expired</li>
</ul>
</section>
<section class=
"panel">
<h2>Best practices</h2>
<ul>
</ul>
</section>
<li>Use the same device you registered</li>
<li>Enable location access during scans</li>
<li>Complete Scan 2 promptly</li>
<li>Confirm success message before leaving</li>
<section class=
"callout">
<strong>Reminder:</strong>
HumanBlockchain does not adjudicate payments or disputes.
PoD records provide neutral confirmation signals for merchants and
communities.
</section>
<a class=
</a>
</main>
"btn ghost" href=
Start a new PoD event →
"pod-start.html">
</body>
</html>