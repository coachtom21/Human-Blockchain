<?php
/*
Template Name: New World Penny
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Loyalty Points (XP / New World Penny) | HumanBlockchain.info</title>
<style>
:root{
--bg:#0b1020;
--text:#eef2ff;
--muted:#b8c1e3;
--line:rgba(255,255,255,.14);
--shadow:0 18px 50px rgba(0,0,0,.55);
--radius:18px;
--btnRadius:14px;
--focus:0 0 0 3px rgba(120,160,255,.35);
--accent:#34d399;
}
*{box-sizing:border-box}
body{
margin:0;
min-height:100vh;
font-family: system-ui,
-apple-system,Segoe UI,Roboto,Helvetica,Arial;
background:
radial-gradient(1000px 650px at 20% 10%, rgba(120,160,255,.18), transparent 60%),
radial-gradient(900px 650px at 80% 85%, rgba(52,211,153,.12), transparent 65%),
var(--bg);
color:var(--text);
}
/* Header */
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
justify-content:space-between;
align-items:center;
gap:14px;
}
.brand{
display:flex;gap:10px;align-items:center;
text-decoration:none;color:var(--text);
min-width:0;
}
.logo{
width:28px;height:28px;border-radius:10px;
background:
radial-gradient(circle at 30% 30%, rgba(52,211,153,.9), transparent 60%),
radial-gradient(circle at 70% 70%, rgba(120,160,255,.9), transparent 60%),
rgba(255,255,255,.06);
border:1px solid var(--line);
flex:0 0 auto;
display: flex;
align-items: center;
justify-content: center;
overflow: hidden;
}
.logo img{
height: 100%;
object-fit: contain;
border-radius: 10px;
}
.brand h1{margin:0;font-size:14px;letter-spacing:.4px}
.brand small{display:block;font-size:12px;color:var(--muted)}
.nav-links{display:flex;gap:10px;flex-wrap:wrap}
.nav-links a{
text-decoration:none;
color:var(--muted);
font-weight:800;
font-size:12px;
padding:10px 12px;
border-radius:999px;
border:1px solid rgba(255,255,255,.10);
background: rgba(255,255,255,.04);
}
/* Layout */
.wrap{
max-width:1100px;
margin:0 auto;
padding:26px 18px 60px;
}
.card{
border:1px solid var(--line);
background: rgba(255,255,255,.05);
border-radius: var(--radius);
box-shadow: var(--shadow);
overflow:hidden;
}
.card-inner{padding:22px}
.badge{
display:inline-flex;align-items:center;gap:8px;
padding:8px 12px;
border-radius:999px;
border:1px solid rgba(255,255,255,.14);
background: rgba(0,0,0,.18);
color:var(--muted);
font-size:12px;
}
.badge .dot{
width:8px;height:8px;border-radius:50%;
background:var(--accent);
box-shadow:0 0 0 3px rgba(52,211,153,.18);
}
h2{
margin:12px 0 10px;
font-size:32px;
line-height:1.15;
letter-spacing:.2px;
}
p{margin:10px 0}
.muted{color:var(--muted)}
.grid{
display:grid;
grid-template-columns: 1.05fr .95fr;
gap:18px;
margin-top:16px;
align-items:start;
}
@media(max-width:900px){ .grid{grid-template-columns:1fr} }
.panel{
border:1px solid rgba(255,255,255,.14);
background: rgba(0,0,0,.18);
border-radius:16px;
padding:14px;
}
.panel h3{
margin:0 0 8px;
color:var(--muted);
font-size:13px;
letter-spacing:.35px;
text-transform:uppercase;
}
ul{margin:0;padding-left:18px}
li{margin:7px 0}
.callout{
margin-top:14px;
padding:14px;
border-radius:16px;
border:1px solid rgba(255,255,255,.14);
background: rgba(255,255,255,.04);
}
.callout b{display:block;margin-bottom:6px}
.chips{
display:flex;
gap:10px;
flex-wrap:wrap;
margin-top:10px;
}
.chip{
display:inline-flex;
align-items:center;
gap:8px;
padding:10px 12px;
border-radius:999px;
border:1px solid rgba(255,255,255,.14);
background: rgba(255,255,255,.04);
color:var(--muted);
font-weight:900;
font-size:12px;
}
.chip .miniDot{
width:8px;height:8px;border-radius:50%;
background:rgba(255,255,255,.35);
}
.chip.good .miniDot{
background:var(--accent);
box-shadow:0 0 0 3px rgba(52,211,153,.18);
}
.cta{display:grid;gap:12px;align-content:start}
.btn{
display:flex;
justify-content:space-between;
align-items:center;
gap:12px;
text-decoration:none;
border-radius: var(--btnRadius);
padding:14px 16px;
font-weight:950;
border:1px solid transparent;
cursor:pointer;
}
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
.btn .sub{
display:block;
font-size:12px;
font-weight:800;
opacity:.8;
margin-top:2px;
}
.arrow{font-weight:950}
.fineprint{
margin-top:14px;
padding-top:12px;
border-top:1px solid rgba(255,255,255,.14);
font-size:12px;
color:var(--muted);
line-height:1.5;
}
code{
font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas,
Mono"
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
<header class="nav">
<div class="nav-inner">
<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo' ) ); ?>
<div>
<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
<small>Loyalty Points = XP / New World Penny</small>
</div>
</a>
<nav class="nav-links" aria-label="Primary">
<a href="how-it-works">How It Works</a>
<a href="register-device">Register Device</a>
<a href="pod-mode">PoD Mode</a>
<a href="loyalty-xp">Loyalty Points</a>
</nav>
</div>
</header>
<main class="wrap">
<section class="card">
<div class="card-inner">
<div class="badge"><span class="dot"></span> Loyalty points are measured as verified
human value</div>
<h2>Loyalty Points = XP (New World Penny)</h2>
<p class="muted">
HumanBlockchain loyalty points are not “discount points” or “store credit.
”
They are a measure of <b>verified human participation</b>
.
We call this measure <b>XP</b> — also known as a <b>New World Penny</b>
.
</p>
<div class="grid">
<!-- Left: definitions -->
<div>
<div class="panel">
<h3>Two names, one idea</h3>
<ul>
<li><b>XP</b> = Experience Points (a unit of verified participation)</li>
<li><b>New World Penny</b> = the cultural name for the same unit</li>
<li>Both represent a <b>measurement</b>
, not a currency</li>
</ul>
<div class="chips">
<div class="chip good"><span class="miniDot"></span>Verified participation</div>
<div class="chip"><span class="miniDot"></span>Not money</div>
<div class="chip"><span class="miniDot"></span>Not stored value</div>
</div>
</div>
<div class="panel" style="margin-top:12px;">
<h3>How points are earned</h3>
<ul>
<li>By completing a verified action (often via 2-scan Proof of Delivery)</li>
<li>By showing up and being confirmed in a merchant/community workflow</li>
<li>By completing steps that are measurable, audit-friendly, and real</li>
</ul>
<p class="muted" style="margin:10px 0 0;">
Think of XP as “the receipt of human involvement.
”
</p>
</div>
<div class="callout">
<b>Plain-language meaning</b>
A New World Penny is a “thank you” that can be counted.
It makes human effort visible—so loyalty is based on what actually happened,
not what someone claims happened.
</div>
<div class="panel" style="margin-top:12px;">
<h3>What XP is NOT</h3>
<ul>
<li>Not a bank account</li>
<li>Not a prepaid balance</li>
<li>Not a gift card</li>
<li>Not a promise of redemption</li>
</ul>
<p class="muted" style="margin:10px 0 0;">
XP exists to measure value created by people, not to replace payments.
</p>
</div>
</div>
<!-- Right: mechanics + CTAs -->
<aside class="cta">
<div class="panel">
<h3>How XP stays honest</h3>
<ul>
<li>XP is issued only when the action is <b>verified</b></li>
<li>Verification uses <b>device + time + location</b> context</li>
<li>2-scan PoD reduces false claims</li>
<li>Records are append-only (audit-friendly)</li>
</ul>
</div>
<div class="panel">
<h3>Simple example</h3>
<p class="muted" style="margin:0;">
A delivery is initiated (Scan 1) and confirmed (Scan 2).
The merchant policy then issues:
</p>
<ul style="margin-top:10px;">
<li><b>+1 XP</b> to the confirmed delivery agent</li>
<li><b>+1 XP</b> to the receiving participant (optional)</li>
<li><b>+XP</b> bonuses based on merchant rules</li>
</ul>
<p class="muted" style="margin:10px 0 0;">
The point is not “how much money.
” The point is “what was verified.
”
</p>
</div>
<a class="btn btnPrimary" href="pod-mode">
<div>
Enter PoD Mode
<span class="sub">Verify actions that earn XP</span>
</div>
<div class="arrow">→</div>
</a>
<a class="btn btnGhost" href="activate-device">
<div>
Activate Your Device
<span class="sub">Enable verified participation</span>
</div>
<div class="arrow">→</div>
</a>
<div class="fineprint">
<b>Compliance note:</b> XP / New World Penny is a participation measure used for
loyalty and recognition.
It does not represent stored value or a monetary balance. Any benefits tied to XP
(discounts, perks,
recognition tiers) are defined by merchant/community policy and may vary by program.
Verification uses minimal data and may include timestamp and approximate location.
</div>
</aside>
</div>
<div class="callout" style="margin-top:16px;">
<b>Developer-facing summary (optional)</b>
XP is a ledger-friendly unit that can be stored as <code>xp_
units</code> linked to a
verified event:
<code>event
id</code>
<code>device
id
,
hash</code>
,
_
_
_
<code>timestamp</code>
,
<code>geo
_
region</code>
,
<code>policy_
id</code>
.
Display names can vary: “XP”
,
“New World Penny”
, or “Loyalty Points.
”
</div>
</div>
</section>
</main>
</body>
</html>
