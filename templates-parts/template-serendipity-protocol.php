<?php

/**
 * Template Name: Serendipity Protocol
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Serendipity Protocol | HumanBlockchain.info</title>
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
width:34px;height:34px;border-radius:12px;
background:
radial-gradient(circle at 30% 30%, rgba(52,211,153,.9), transparent 60%),
radial-gradient(circle at 70% 70%, rgba(120,160,255,.9), transparent 60%),
rgba(255,255,255,.06);
border:1px solid var(--line);
flex:0 0 auto;
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
grid-template-columns: 1.1fr .9fr;
gap:18px;
margin-top:16px;
align-items:start;
}
@media(max-width:900px){
.grid{grid-template-columns:1fr}
}
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
.timeline{
margin-top:12px;
display:grid;
gap:10px;
}
.event{
display:flex;
gap:12px;
align-items:flex-start;
padding:12px;
border-radius:16px;
border:1px solid rgba(255,255,255,.14);
background: rgba(255,255,255,.04);
}
.stamp{
width:28px;height:28px;border-radius:50%;
display:flex;align-items:center;justify-content:center;
background: var(--accent);
color:#062015;
font-weight:950;
flex:0 0 auto;
}
.callout{
margin-top:14px;
padding:14px;
border-radius:16px;
border:1px solid rgba(255,255,255,.14);
background: rgba(255,255,255,.04);
}
.callout b{display:block;margin-bottom:6px}
.cta{
display:grid;
gap:12px;
align-content:start;
}
.btn{
appearance:none;
border:none;
border-radius: var(--btnRadius);
padding:14px 16px;
font-weight:900;
cursor:pointer;
display:flex;
justify-content:space-between;
align-items:center;
gap:12px;
border:1px solid transparent;
text-decoration:none;
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
.btn small{
display:block;
font-size:12px;
font-weight:800;
opacity:.8;
}
.arrow{font-weight:900}
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
"Liberation
}
</style>
</head>
<body>
<header class="nav">
<div class="nav-inner">
<a class="brand" href="home">
<div class="logo"></div>
<div>
<h1>HumanBlockchain.info</h1>
<small>Serendipity Protocol</small>
</div>
</a>
<nav class="nav-links">
<a href="how-it-works">How It Works</a>
<a href="dao">Join the DAO</a>
<a href="pod-mode">PoD Mode</a>
<a href="faq">FAQs</a>
</nav>
</div>
</header>
<main class="wrap">
<section class="card">
<div class="card-inner">
<div class="badge"><span class="dot"></span> Randomized assignment • Geo-time
grouping • Human-first coordination</div>
<h2>Read the Serendipity Protocol</h2>
<p class="muted">
The Serendipity Protocol is the moment your device becomes part of a living network.
When you register, the system uses <b>timestamp + location</b> to place you into
community coordination
structures—without requiring personal identity or social media profiles.
</p>
<div class="grid">
<!-- Left column -->
<div>
<div class="panel">
<h3>What Serendipity means here</h3>
<ul>
<li>People register independently—yet the system forms groups automatically</li>
<li>Local proximity creates local community grouping</li>
<li>Near-simultaneous registrations create “moment-based” alignment</li>
<li>Your device becomes a neutral input into the coordination algorithm</li>
</ul>
</div>
<div class="panel" style="margin-top:12px;">
<h3>The core rule</h3>
<p class="muted" style="margin:0;">
The only input that matters at the moment of onboarding is the device confirmation
context:
<code>geo
<code>device
id
_
_
hash</code> + <code>timestamp</code> +
_
region</code>
.
Everything else is optional and minimized.
</p>
</div>
inputs.
<div class="callout">
<b>Why this is powerful</b>
Serendipity removes the “gatekeeper problem.
”
Instead of influencers or institutions deciding who belongs, the protocol lets
real people join at real moments—and lets the network self-organize from verified
</div>
<div class="panel" style="margin-top:12px;">
<h3>Example: how groups can form</h3>
<div class="timeline">
<div class="event">
<div class="stamp">1</div>
<div>
<b>Registration cluster forms</b>
<p class="muted" style="margin:6px 0 0;">
Devices register within a time window (ex: 10–30 minutes).
</p>
</div>
</div>
<div class="event">
<div class="stamp">2</div>
<div>
<b>Local buyer grouping</b>
<p class="muted" style="margin:6px 0 0;">
Local region determines local community grouping for consumer participation.
</p>
</div>
</div>
<div class="event">
<div class="stamp">3</div>
<div>
<b>Out-of-region pairing</b>
<p class="muted" style="margin:6px 0 0;">
A portion of assignments intentionally connect you with people outside your region
to promote cross-community trust.
</p>
</div>
</div>
governance.
<div class="event">
<div class="stamp">4</div>
<div>
<b>Participation begins</b>
<p class="muted" style="margin:6px 0 0;">
You can now take part in PoD confirmations, loyalty participation, and DAO
</p>
</div>
</div>
</div>
</div>
</div>
<!-- Right column -->
<aside class="cta">
<div class="panel">
<h3>What Serendipity does NOT do</h3>
<ul>
<li>Does not require your name to join</li>
<li>Does not depend on followers or social ranking</li>
<li>Does not sell personal identity information</li>
<li>Does not turn onboarding into a popularity contest</li>
</ul>
</div>
<a class="btn btnPrimary" href="activate-device.html">
<div>
Activate Your Device
<small>Trigger Serendipity onboarding</small>
</div>
<div class="arrow">→</div>
</a>
<a class="btn btnGhost" href="join-the-dao.html">
<div>
Join the DAO
<small>Participation becomes influence</small>
</div>
<div class="arrow">→</div>
</a>
<a class="btn btnGhost" href="pod-mode.html">
<div>
Go to PoD Mode
<small>Begin verified participation</small>
</div>
<div class="arrow">→</div>
</a>
<div class="fineprint">
<b>Protocol note:</b> The Serendipity Protocol is designed to be a fair starting point.
It groups participants using minimal data (geo-time context) so the network can form
naturally.
Any future roles, rewards, or governance weight should be tied to verified activity—not
identity.
</div>
</aside>
</div>
</div>
</section>
</main>
</body>