<?php
/*
Template Name: New World Penny
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>New World Penny • Ledger-Issued Recognition (No Fiat) | HumanBlockchain.info</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="The seller never pays fiat. New World Pennies are issued as cooperative ledger recognition units for validated geo-location delivery touchpoints." />
  <style>
    :root{
      --bg:#050816;
      --bg-alt:#0b1020;
      --card:#0e1530;
      --text:#f5f5f7;
      --muted:#a0a3b1;
      --border:#23263a;
      --accent:#ffb347;
      --accent2:#44ffd2;
      --danger:#ff4b81;
      --shadow:0 22px 45px rgba(0,0,0,.45);
      --radius:18px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
      color:var(--text);
      background:
        radial-gradient(1100px 700px at 15% 10%, rgba(255,179,71,.14), transparent 60%),
        radial-gradient(900px 650px at 85% 15%, rgba(68,255,210,.12), transparent 55%),
        linear-gradient(180deg, var(--bg), var(--bg-alt));
      line-height:1.55;
    }
    .wrap{max-width:1020px;margin:0 auto;padding:28px 18px 56px}
    .topbar{
      display:flex;align-items:center;justify-content:space-between;gap:14px;
      margin-bottom:18px;padding:10px 12px;border:1px solid var(--border);
      border-radius:14px;background:rgba(14,21,48,.55);backdrop-filter: blur(10px);
    }
    .brand{display:flex;align-items:center;gap:10px;font-weight:950;letter-spacing:.2px}
    .dot{
      width:10px;height:10px;border-radius:999px;background:var(--accent);
      box-shadow:0 0 0 6px rgba(255,179,71,.14);
    }
    .nav{display:flex;flex-wrap:wrap;gap:8px;justify-content:flex-end}
    .nav a{
      text-decoration:none;padding:8px 10px;border:1px solid var(--border);
      border-radius:12px;color:var(--muted);font-weight:750;font-size:13px;
      background:rgba(5,8,22,.25);
    }
    .nav a:hover{color:var(--text);border-color:rgba(255,179,71,.35)}
    .hero{
      border:1px solid var(--border);
      border-radius:var(--radius);
      background: linear-gradient(180deg, rgba(14,21,48,.85), rgba(11,16,32,.75));
      box-shadow:var(--shadow);
      padding:22px 18px;
    }
    .badge{
      display:inline-flex;align-items:center;gap:10px;
      padding:8px 12px;border-radius:999px;
      border:1px solid rgba(255,179,71,.35);
      background:rgba(255,179,71,.10);
      font-weight:950;font-size:13px;
    }
    h1{margin:14px 0 10px;font-size:34px;line-height:1.15}
    .lead{color:var(--muted);max-width:920px;margin:0 0 12px}
    .statement{
      margin-top:12px;
      border:1px solid rgba(68,255,210,.30);
      background:rgba(68,255,210,.10);
      border-radius:16px;
      padding:14px 14px;
    }
    .pill{
      display:inline-flex;
      padding:4px 10px;border-radius:999px;font-size:12px;
      border:1px solid rgba(68,255,210,.35);
      color:var(--accent2);
      background:rgba(68,255,210,.08);
      font-weight:950;
      margin-bottom:8px;
    }
    .statement p{
      margin:0;
      font-size:17px;
      font-weight:950;
      letter-spacing:.1px;
    }
    .grid{
      display:grid;grid-template-columns:1.1fr .9fr;gap:14px;margin-top:16px
    }
    @media (max-width:900px){.grid{grid-template-columns:1fr} h1{font-size:28px}}
    .card{
      border:1px solid var(--border);
      border-radius:var(--radius);
      background:rgba(14,21,48,.55);
      box-shadow:0 14px 28px rgba(0,0,0,.35);
      padding:14px 14px;
    }
    .card h2{margin:0 0 10px;font-size:18px}
    .card p{margin:0 0 10px;color:var(--muted)}
    ul{margin:8px 0 0 18px;color:var(--muted)}
    li{margin:6px 0}
    .steps{
      display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:10px
    }
    @media (max-width:720px){.steps{grid-template-columns:1fr}}
    .step{
      border:1px solid rgba(255,179,71,.24);
      background:rgba(255,179,71,.07);
      border-radius:16px;
      padding:12px 12px;
    }
    .step .k{
      display:flex;align-items:center;gap:8px;
      font-weight:950;margin:0 0 6px;font-size:14px;
    }
    .step .k span{
      width:26px;height:26px;border-radius:10px;
      display:inline-flex;align-items:center;justify-content:center;
      background:rgba(255,179,71,.14);
      border:1px solid rgba(255,179,71,.32);
    }
    .callout{
      margin-top:10px;
      border:1px solid rgba(255,75,129,.30);
      background:rgba(255,75,129,.08);
      border-radius:16px;
      padding:12px 12px;
      color:var(--muted);
    }
    .callout b{color:#ffd6e2}
    .math{
      margin-top:12px;
      border:1px solid rgba(68,255,210,.28);
      background:rgba(68,255,210,.08);
      border-radius:16px;
      padding:12px 12px;
      color:var(--muted);
    }
    .chip{
      display:inline-flex;align-items:center;gap:8px;
      padding:8px 10px;border-radius:14px;
      border:1px solid var(--border);
      background:rgba(5,8,22,.25);
      color:var(--text);
      font-weight:950;
      margin:6px 6px 0 0;
    }
    .chip small{color:var(--muted);font-weight:850}
    .cta{
      display:flex;flex-wrap:wrap;gap:10px;margin-top:12px
    }
    .btn{
      text-decoration:none;
      display:inline-flex;align-items:center;justify-content:center;
      padding:11px 14px;border-radius:14px;
      font-weight:950;font-size:14px;letter-spacing:.2px;
      border:1px solid rgba(255,179,71,.35);
      background:rgba(255,179,71,.14);
      color:var(--text);
    }
    .btn.secondary{
      border-color:rgba(68,255,210,.32);
      background:rgba(68,255,210,.10);
    }
    .btn.ghost{
      border-color:var(--border);
      background:rgba(5,8,22,.25);
      color:var(--muted);
    }
    .fineprint{
      margin-top:14px;padding-top:12px;border-top:1px solid var(--border);
      color:var(--muted);font-size:13px;
    }
    code{
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      font-size: 12px;padding: 2px 6px;border-radius: 10px;border: 1px solid var(--border);
      background: rgba(5,8,22,.35);color: var(--text);
    }
  </style>
</head>

<body>
  <div class="wrap">

    <div class="topbar">
      <div class="brand">
        <span class="dot"></span>
        <div>Human Blockchain <span style="color:var(--muted);font-weight:950;">• New World Penny</span></div>
      </div>
      <div class="nav">
        <a href="/proof-of-delivery">Proof of Delivery</a>
        <a href="/xp-peg">XP Peg</a>
        <a href="/faqs">FAQs</a>
        <a href="/join">Join</a>
      </div>
    </div>

    <section class="hero">
      <span class="badge">🪙 Ledger-Issued Recognition (No Fiat)</span>
      <h1>Seller never pays — the ledger records recognition.</h1>
      <p class="lead">
        The New World Penny is not money, not a fee, and not a payment. It is a <b>cooperative ledger recognition unit</b>
        used to measure and honor human service along a delivery route.
      </p>

      <div class="statement">
        <div class="pill">Non-Negotiable</div>
        <p>
          The <b>seller never pays fiat</b>. For ledger accounting only, the seller <b>issues</b> one New World Penny
          for each <b>validated geo-location delivery touch</b>. If <b>30 members</b> touch the delivery in route to the buyer,
          the seller issues <b>30 New World Pennies</b> — purely as cooperative ledger recognition.
        </p>
      </div>

      <div class="cta">
        <a class="btn" href="/proof-of-delivery">Learn 2-scan Proof of Delivery</a>
        <a class="btn secondary" href="/xp-peg">XP as a measuring stick</a>
        <a class="btn ghost" href="/faqs">FAQ: Trade credit vs money</a>
      </div>

      <div class="fineprint">
        Recognition is recorded with geo-location, device ID, timestamp, and transaction ID tied to a voucher or hang tag.
        No fiat settlement is required for issuing New World Pennies.
      </div>
    </section>

    <div class="grid">
      <section class="card">
        <h2>How it works (recognition-only)</h2>
        <p>
          A delivery can pass through many hands. Every time a member physically advances the delivery and completes a verified
          geo-location scan, the ledger records that service and the seller issues a penny as acknowledgment.
        </p>

        <div class="steps">
          <div class="step">
            <div class="k"><span>1</span> Touchpoint scan</div>
            <ul>
              <li>Member scans the voucher/hang tag at a real handoff point.</li>
              <li>System captures geo-location + device ID + timestamp.</li>
              <li>Touchpoint is attached to the transaction ID.</li>
            </ul>
          </div>

          <div class="step">
            <div class="k"><span>2</span> Validation</div>
            <ul>
              <li>Duplicate or conflicting scans are rejected.</li>
              <li>Only validated touches count toward penny issuance.</li>
              <li>Each validated touch = 1 penny.</li>
            </ul>
          </div>

          <div class="step">
            <div class="k"><span>3</span> Buyer closes the route</div>
            <ul>
              <li>Final buyer scan confirms delivery completion.</li>
              <li>Route history becomes locked and auditable.</li>
              <li>Recognition totals become final.</li>
            </ul>
          </div>

          <div class="step">
            <div class="k"><span>4</span> Seller issues pennies (ledger)</div>
            <ul>
              <li>Seller issues one penny per validated touchpoint.</li>
              <li>No fiat changes hands; this is recognition accounting.</li>
              <li>Pennies become collectable service receipts.</li>
            </ul>
          </div>
        </div>

        <div class="math">
          <div><b style="color:var(--text);">Formula</b></div>
          <div style="margin-top:6px;">
            <span class="chip">Pennies issued <small>= # validated route touches</small></span>
            <span class="chip">Example <small>30 touches = 30 pennies</small></span>
          </div>
        </div>

        <div class="callout">
          <b>Human value made visible:</b> A New World Penny is a public “thank you” that scales — a record that someone showed up,
          moved the delivery forward, and proved it.
        </div>
      </section>

      <aside class="card">
        <h2>What this prevents</h2>
        <ul>
          <li>Confusing recognition with money or wages</li>
          <li>Hidden fees for delivery participants</li>
          <li>Speculation on “penny value”</li>
          <li>Inflated claims without proof</li>
        </ul>

        <div class="callout">
          <b>Plain meaning:</b> If you touched the delivery and proved it with a geo-scan, you earn a penny — recorded on the ledger.
          No fiat required.
        </div>

        <div class="fineprint">
          Suggested page slug: <code>/new-world-penny-ledger-issued</code><br/>
          Menu label: <code>New World Penny (No Fiat)</code>
        </div>
      </aside>
    </div>

    <div class="fineprint" style="margin-top:18px;">
      © HumanBlockchain.info • Small Street Applied • Atlanta • Ledger-only service recognition • Detente 2030 pledge community
    </div>

  </div>
</body>
</html>

