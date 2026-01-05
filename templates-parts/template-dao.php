<?php

/*
 * Template Name: DAO
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Join the DAO | HumanBlockchain.info</title>
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
.nav-links{
display:flex;gap:10px;flex-wrap:wrap;
}
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
.steps{
display:grid;
gap:12px;
margin-top:12px;
}
.step{
display:flex;
gap:12px;
align-items:flex-start;
}
.num{
width:28px;height:28px;border-radius:50%;
display:flex;align-items:center;justify-content:center;
background:var(--accent);color:#062015;
font-weight:950;font-size:14px;
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
</style>
</head>
<body>
<header class="nav">
<div class="nav-inner">
<a class="brand" href="home">
<div class="logo"></div>
<div>
<h1>HumanBlockchain.info</h1>
<small>Join the DAO</small>
</div>
</a>
<nav class="nav-links">
<a href="how-it-works">How It Works</a>
<a href="proof-of-delivery">Proof of Delivery</a>
<a href="activate-device">Activate Device</a>
<a href="faq">FAQs</a>
</nav>
</div>
</header>
<main class="wrap">
<section class="card">
<div class="card-inner">
<div class="badge"><span class="dot"></span> Decentralized • Device-driven •
Human-first</div>
<h2>Join the DAO</h2>
<p class="muted">
Joining the DAO means participating in a <b>human-governed, device-driven
network</b>
where verification replaces trust assumptions and people—not platforms—form the
ledger.
</p>
<div class="grid">
<!-- Left -->
<div>
<div class="panel">
<h3>What the DAO is</h3>
<ul>
<li>A decentralized participation network</li>
<li>Governed by verified human activity</li>
<li>Coordinated through device confirmation</li>
<li>Designed for transparency and fairness</li>
</ul>
</div>
<div class="panel" style="margin-top:12px;">
<h3>What joining means</h3>
<ul>
<li>Your device becomes a single voting & participation node</li>
<li>You can take part in Proof of Delivery events</li>
<li>Your confirmed actions can influence DAO outcomes</li>
<li>No tokens required to begin participation</li>
</ul>
</div>
<div class="callout">
<b>Important distinction</b>
This DAO is not about speculation or financial custody.
It is a coordination layer where <b>verified human actions</b>
become the basis for trust, recognition, and governance.
</div>
</div>
<!-- Right -->
<aside class="cta">
<div class="panel">
<h3>How to join</h3>
<div class="steps">
<div class="step">
<div class="num">1</div>
<div>
<b>Activate a device</b>
<p class="muted" style="margin:6px 0 0;">
Your device represents you—no usernames required.
</p>
</div>
</div>
<div class="step">
<div class="num">2</div>
<div>
<b>Participate</b>
<p class="muted" style="margin:6px 0 0;">
Complete confirmations, scans, and verified actions.
</p>
</div>
</div>
<div class="step">
<div class="num">3</div>
<div>
<b>Earn influence</b>
<p class="muted" style="margin:6px 0 0;">
Influence grows from verified participation, not capital.
</p>
</div>
</div>
</div>
</div>
<a class="btn btnPrimary" href="activate-device.html">
<div>
Activate Your Device
<small>Join the DAO</small>
</div>
<div class="arrow">→</div>
</a>
<a class="btn btnGhost" href="pod-mode.html">
<div>
Go to PoD Mode
<small>Start participating</small>
</div>
<div class="arrow">→</div>
</a>
<div class="fineprint">
<b>Governance note:</b>
DAO participation is based on device-verified actions.
No financial stake is required to join. Governance rules,
voting thresholds, and recognition models are published
openly and evolve through verified participation.
</div>
</aside>
</div>
</div>
</section>
</main>
</body>
</html>


