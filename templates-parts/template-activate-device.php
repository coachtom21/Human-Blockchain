<?php

/**
 * Template Name: Activate Device
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Activate Device | HumanBlockchain.info</title>
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
display:flex;
gap:10px;
align-items:center;
text-decoration:none;
color:var(--text);
}
.logo{
width:34px;height:34px;border-radius:12px;
background:
radial-gradient(circle at 30% 30%, rgba(52,211,153,.9), transparent 60%),
radial-gradient(circle at 70% 70%, rgba(120,160,255,.9), transparent 60%),
rgba(255,255,255,.06);
border:1px solid var(--line);
}
.brand h1{margin:0;font-size:14px;letter-spacing:.4px}
.brand small{display:block;font-size:12px;color:var(--muted)}
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
}
.card-inner{padding:20px}
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
}
.badge .dot{
width:8px;height:8px;border-radius:50%;
background:#34d399;
box-shadow:0 0 0 3px rgba(52,211,153,.18);
}
h2{
margin:12px 0 10px;
font-size:30px;
line-height:1.15;
letter-spacing:.2px;
}
p{margin:10px 0}
.muted{color:var(--muted)}
.grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:14px;
margin-top:14px;
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
font-size:13px;
letter-spacing:.35px;
text-transform:uppercase;
color:var(--muted);
}
ul{margin:0;padding-left:18px}
li{margin:7px 0}
/* Activation steps */
.steps{
margin-top:16px;
display:grid;
gap:12px;
}
.step{
display:flex;
gap:12px;
align-items:flex-start;
}
.stepNum{
width:28px;height:28px;border-radius:50%;
display:flex;align-items:center;justify-content:center;
background:#34d399;color:#062015;
font-weight:900;font-size:14px;
flex:0 0 auto;
}
/* CTA */
.cta{
margin-top:18px;
display:grid;
gap:12px;
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
border:1px solid transparent;
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
<a class="brand" href="index.html">
<div class="logo"></div>
<div>
<h1>HumanBlockchain.info</h1>
<small>Activate Device</small>
</div>
</a>
</div>
</header>
<main class="wrap">
<section class="card">
<div class="card-inner">
<div class="badge">
<span class="dot"></span>
Device activation enables loyalty & Proof of Delivery
</div>
<h2>Activate Your Device</h2>
<p class="muted">
Activating your device allows you to participate in
<strong>device-driven verification</strong> for loyalty points and Proof of Delivery
events.
</p>
Each device represents a single human participant.
<div class="grid">
<div class="panel">
<h3>Why activate?</h3>
<ul>
<li>Confirm deliveries using your own device</li>
<li>Participate in loyalty and recognition programs</li>
<li>Reduce disputes through verified confirmation</li>
<li>Maintain privacy with minimal data collection</li>
</ul>
</div>
<div class="panel">
<h3>What activation does</h3>
<ul>
<li>Creates a unique, hashed device identifier</li>
<li>Links scans to timestamp and location</li>
<li>Prevents duplicate or automated activity</li>
<li>Enables 2-scan Proof of Delivery</li>
</ul>
</div>
</div>
<div class="steps">
<div class="step">
<div class="stepNum">1</div>
<div>
<strong>Open this page on the device you will use</strong>
<p class="muted">Activation applies only to the current device.</p>
</div>
</div>
<div class="step">
<div class="stepNum">2</div>
<div>
<strong>Allow required permissions</strong>
<p class="muted">Location and camera access are used only during scans.</p>
</div>
</div>
<div class="step">
<div class="stepNum">3</div>
<div>
<strong>Confirm activation</strong>
<p class="muted">Your device becomes eligible for PoD and loyalty
participation.</p>
</div>
</div>
</div>
<div class="cta">
<button class="btn btnPrimary" onclick="activateDevice()">
Activate This Device
<span class="arrow">→</span>
</button>
<button class="btn btnGhost" onclick="window.location.href='pod-mode.html'">
Go to PoD Mode
<span class="arrow">→</span>
</button>
</div>
<div class="fineprint">
<strong>Privacy note:</strong> HumanBlockchain does not store personal identity.
Device activation uses hashed identifiers and is limited to verification purposes
only.
Loyalty points and participation credits are governed by merchant or community
policy.
</div>
</div>
</section>
</main>
<script>
function activateDevice(){
alert("Device activation placeholder.\n\nThis is where you would:\n• generate a hashed
device ID\n• request permissions\n• store activation locally or via API");
}
</script>
</body>
</html>
