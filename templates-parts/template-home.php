<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>HumanBlockchain.info | Serendipity + YAM-is-ON Proof of Delivery</title>
  <meta name="description" content="Device-driven 2-scan Proof of Delivery. Serendipity forms Buyer POCs locally by geo-location + timestamp and Seller POCs out-of-state or global. XP in scientific notation. New World Penny recognition. VFN handles redemption." />

  <style>
    /* =========================================================
    HumanBlockchain.info — Modern CSS (inline, ready to paste)
    ========================================================= */
    :root{
      --bg: #0b1220;
      --bg2:#070d18;
      --panel: rgba(18,31,61,.70);
      --line: rgba(232,238,252,.12);
      --text: #e8eefc;
      --muted: #b8c3e6;

      --accent: #7dd3fc;
      --accent2:#a78bfa;
      --good: #86efac;
      --warn: #fbbf24;

      --radius: 18px;
      --shadow: 0 18px 48px rgba(0,0,0,.35);
      --shadow2: 0 8px 18px rgba(0,0,0,.22);
      --maxw: 1100px;

      --font: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Apple Color Emoji", "Segoe UI Emoji";
      --mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:var(--font); color:var(--text); line-height:1.45;
      background:
        radial-gradient(1100px 600px at 15% 0%, rgba(167,139,250,.18), transparent 55%),
        radial-gradient(900px 500px at 85% 20%, rgba(125,211,252,.16), transparent 55%),
        radial-gradient(700px 420px at 50% 90%, rgba(134,239,172,.10), transparent 60%),
        linear-gradient(180deg, var(--bg), var(--bg2));
    }
    a{color:inherit;text-decoration:none}
    code{font-family:var(--mono); background: rgba(232,238,252,.06); border:1px solid var(--line);
      padding:2px 6px; border-radius:10px; font-size:.95em}
    .wrap{max-width:var(--maxw); margin:0 auto; padding:0 18px}
    .grid{display:grid; gap:16px}
    .two{display:grid; grid-template-columns:1fr 1fr; gap:16px}
    .three{display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px}
    @media (max-width:900px){ .two,.three{grid-template-columns:1fr} }
    .small{font-size:12px; color:var(--muted)}
    .lead{color:var(--muted); font-size:16px; margin:0 0 18px}
    h1{font-size:42px; line-height:1.05; margin:10px 0 10px; letter-spacing:-.6px}
    h2{font-size:28px; margin:0 0 10px; letter-spacing:-.3px}
    h3{font-size:18px; margin:0 0 8px}
    @media (max-width:520px){ h1{font-size:34px} h2{font-size:24px} }

    .card{
      background:var(--panel); border:1px solid var(--line); border-radius:var(--radius);
      padding:18px; box-shadow:var(--shadow2);
    }
    .section{padding:26px 0}
    .hero{padding:44px 0 18px}
    .hero .grid{grid-template-columns:1.25fr .75fr; align-items:stretch}
    @media (max-width:900px){ .hero .grid{grid-template-columns:1fr} }

    /* Topbar / Nav */
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
    .brand{display:flex; align-items:center; gap:10px; min-width:220px}
    .logo{
      width:36px; height:36px; border-radius:12px;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      box-shadow: 0 10px 20px rgba(0,0,0,.25);
    }
    .brand b{letter-spacing:.3px}
    .menu{display:flex; align-items:center; gap:6px; flex-wrap:wrap; justify-content:center}
    .menu a{
      font-size:14px; color:var(--muted);
      padding:8px 10px; border-radius:12px;
      border:1px solid transparent;
    }
    .menu a:hover{background: rgba(232,238,252,.06); color:var(--text); border-color: rgba(232,238,252,.10)}
    .cta{display:flex; align-items:center; gap:10px; flex-wrap:wrap}

    /* Buttons */
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:10px 14px; border-radius:14px; border:1px solid var(--line);
      background: rgba(232,238,252,.06); color:var(--text);
      font-weight:800; font-size:14px;
      box-shadow: 0 10px 18px rgba(0,0,0,.18);
      transition: transform .08s ease, filter .08s ease, background .12s ease, border-color .12s ease;
    }
    .btn:hover{background: rgba(232,238,252,.10); transform: translateY(-1px)}
    .btn:active{transform: translateY(0px); filter: brightness(.98)}
    .btn.primary{
      border-color:transparent;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      color:#071024;
    }
    .btn.primary:hover{filter:brightness(1.05)}
    .btn.ghost{background: transparent; border-color: rgba(232,238,252,.18)}
    .btn.small{padding:8px 12px; border-radius:12px; font-size:13px}

    /* Pills / tags */
    .pill, .tag{
      display:inline-flex; align-items:center; gap:8px;
      border-radius:999px; padding:6px 10px;
      font-size:13px; color:var(--muted);
      background: rgba(232,238,252,.08); border:1px solid var(--line);
    }
    .tag{font-size:12px}
    .badge{
      display:inline-flex; align-items:center; gap:8px;
      padding:6px 10px; border-radius:999px;
      background: rgba(125,211,252,.10);
      border:1px solid rgba(125,211,252,.25);
      color: var(--text);
      font-size: 12px;
      font-weight: 800;
    }

    /* KPI blocks */
    .kpi{display:flex; gap:10px; flex-wrap:wrap; margin-top:12px}
    .kpi .mini{
      flex:1; min-width:180px;
      background: rgba(232,238,252,.05); border:1px solid var(--line);
      border-radius:16px; padding:12px;
    }
    .mini b{display:block; font-size:14px; margin-bottom:4px}
    .mini span{color:var(--muted); font-size:13px}

    /* Lists */
    .list{display:grid; gap:10px; margin-top:10px}
    .item{
      display:flex; gap:10px; align-items:flex-start;
      padding:12px; border-radius:16px;
      background: rgba(232,238,252,.05);
      border:1px solid rgba(232,238,252,.10);
    }
    .dot{
      width:10px; height:10px; border-radius:999px;
      margin-top:6px; background:var(--accent);
      box-shadow: 0 0 0 4px rgba(125,211,252,.10);
    }
    .dot.good{background:var(--good); box-shadow: 0 0 0 4px rgba(134,239,172,.10)}
    .dot.warn{background:var(--warn); box-shadow: 0 0 0 4px rgba(251,191,36,.12)}

    /* FAQ accordions */
    details{
      border-radius:16px; background: rgba(232,238,252,.05);
      border:1px solid rgba(232,238,252,.12);
      padding:12px; overflow:hidden;
    }
    details + details{margin-top:10px}
    details[open]{background: rgba(232,238,252,.06)}
    details summary{
      cursor:pointer; list-style:none; font-weight:900;
      display:flex; align-items:center; justify-content:space-between; gap:12px;
    }
    details summary::-webkit-details-marker{display:none}
    details summary::after{
      content:"+";
      font-weight:900; color:var(--muted);
      width:26px; height:26px;
      display:inline-flex; align-items:center; justify-content:center;
      border-radius:10px; border:1px solid rgba(232,238,252,.12);
      background: rgba(232,238,252,.04);
    }
    details[open] summary::after{content:"–"}
    details p{margin:10px 0 0; color:var(--muted)}

    /* Footer */
    .footer{
      padding:26px 0 36px;
      border-top:1px solid var(--line);
      color:var(--muted); font-size:13px;
    }
    .footer .cols{display:grid; grid-template-columns:1fr 1fr; gap:16px}
    @media (max-width:900px){ .footer .cols{grid-template-columns:1fr} }

    /* Mobile menu (no JS) */
    .hamburger{display:none}
    .hamburger label{
      display:inline-flex; align-items:center; justify-content:center;
      width:44px; height:44px; border-radius:14px;
      border:1px solid rgba(232,238,252,.16);
      background: rgba(232,238,252,.06);
      cursor:pointer;
    }
    .hamburger label:hover{background: rgba(232,238,252,.10)}
    .hamburger svg{width:22px;height:22px}
    #navtoggle{display:none}
    @media (max-width:900px){
      .menu{display:none}
      .hamburger{display:block}
      #navtoggle:checked ~ .menu-drawer{display:block}
    }
    .menu-drawer{
      display:none;
      padding:10px 0 14px;
      border-top:1px solid rgba(232,238,252,.10);
      margin-top:10px;
    }
    .menu-drawer a{
      display:block;
      padding:10px 12px;
      border-radius:14px;
      color:var(--muted);
      border:1px solid transparent;
    }
    .menu-drawer a:hover{
      background: rgba(232,238,252,.06);
      color: var(--text);
      border-color: rgba(232,238,252,.10);
    }

    /* ============ ENTRY MODAL OVERLAY ============ */
    .entry-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
      backdrop-filter: blur(8px);
      display: grid;
      place-items: center;
      z-index: 10000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
      padding: 18px;
    }

    .entry-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .entry-overlay .overlay {
      width: min(720px, 100%);
      background: rgba(11,18,32,.35);
      border: 1px solid rgba(232,238,252,.10);
      border-radius: calc(var(--radius) + 6px);
      padding: 10px;
      box-shadow: var(--shadow);
      backdrop-filter: blur(10px);
      transform: scale(0.95);
      transition: transform 0.3s ease;
    }

    .entry-overlay.active .overlay {
      transform: scale(1);
    }

    .entry-overlay .modal {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      padding: 20px;
    }

    .entry-overlay .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 10px;
    }

    .entry-overlay .logo {
      width: 40px;
      height: 40px;
      border-radius: 14px;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      box-shadow: 0 12px 24px rgba(0,0,0,.28);
      flex: 0 0 auto;
    }

    .entry-overlay .brand b {
      letter-spacing: .3px;
    }

    .entry-overlay .brand .sub {
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px;
    }

    .entry-overlay h1 {
      font-size: 26px;
      line-height: 1.15;
      margin: 8px 0 8px;
      letter-spacing: -.3px;
    }

    .entry-overlay p {
      margin: 0 0 12px;
      color: var(--muted);
      line-height: 1.45;
    }

    .entry-overlay .pillrow {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin: 10px 0 14px;
    }

    .entry-overlay .pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(232,238,252,.08);
      border: 1px solid rgba(232,238,252,.12);
      font-size: 12px;
      color: var(--muted);
    }

    .entry-overlay .dot {
      width: 9px;
      height: 9px;
      border-radius: 999px;
      background: var(--accent);
      box-shadow: 0 0 0 4px rgba(125,211,252,.10);
    }

    .entry-overlay .dot.good {
      background: var(--good);
      box-shadow: 0 0 0 4px rgba(134,239,172,.10);
    }

    .entry-overlay .dot.warn {
      background: var(--warn);
      box-shadow: 0 0 0 4px rgba(251,191,36,.12);
    }

    .entry-overlay .cta {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 12px;
    }

    .entry-overlay .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px 14px;
      border-radius: 14px;
      border: 1px solid rgba(232,238,252,.16);
      background: rgba(232,238,252,.06);
      color: var(--text);
      font-weight: 900;
      cursor: pointer;
      text-decoration: none;
      transition: transform .08s ease, background .12s ease, filter .08s ease;
    }

    .entry-overlay .btn:hover {
      background: rgba(232,238,252,.10);
      transform: translateY(-1px);
    }

    .entry-overlay .btn:active {
      transform: translateY(0px);
      filter: brightness(.98);
    }

    .entry-overlay .btn.primary {
      border-color: transparent;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      color: #071024;
    }

    .entry-overlay .btn.primary:hover {
      filter: brightness(1.05);
    }

    .entry-overlay .btn.ghost {
      background: transparent;
    }

    .entry-overlay .divider {
      height: 1px;
      background: rgba(232,238,252,.12);
      margin: 14px 0;
    }

    .entry-overlay .list {
      display: grid;
      gap: 10px;
      margin-top: 12px;
    }

    .entry-overlay .item {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      padding: 12px;
      border-radius: 16px;
      background: rgba(232,238,252,.05);
      border: 1px solid rgba(232,238,252,.10);
    }

    .entry-overlay .item b {
      color: var(--text);
      font-size: 13px;
    }

    .entry-overlay .item span {
      display: block;
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px;
    }

    .entry-overlay .legal {
      margin-top: 12px;
      font-size: 12px;
      color: var(--muted);
    }

    @media (max-width: 520px) {
      .entry-overlay .modal {
        padding: 16px;
      }
      .entry-overlay h1 {
        font-size: 22px;
      }
      .entry-overlay .btn {
        width: 100%;
      }
    }

    /* ============ POD GATE MODAL ============ */
    .pod-gate-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
      backdrop-filter: blur(8px);
      display: none;
      grid;
      place-items: center;
      z-index: 10000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .pod-gate-overlay.active {
      display: grid;
      opacity: 1;
      visibility: visible;
    }

    .pod-gate-modal {
      width: min(880px, 92%);
      background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.06));
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: var(--radius);
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
      padding: 28px;
      transform: scale(0.95);
      transition: transform 0.3s ease;
    }

    .pod-gate-overlay.active .pod-gate-modal {
      transform: scale(1);
    }

    .pod-gate-grid {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 24px;
    }

    @media (max-width: 820px) {
      .pod-gate-grid {
        grid-template-columns: 1fr;
      }
    }

    .pod-gate-modal h2 {
      margin: 0;
      font-size: 26px;
      color: var(--text);
    }

    .pod-gate-sub {
      margin-top: 10px;
      color: var(--muted);
      line-height: 1.6;
    }

    .btn-row {
      margin-top: 18px;
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .choice-btn {
      flex: 1;
      min-width: 200px;
      padding: 14px;
      border-radius: 14px;
      border: 1px solid rgba(255, 255, 255, 0.14);
      background: rgba(255, 255, 255, 0.12);
      color: var(--text);
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .choice-btn:hover {
      background: rgba(255, 255, 255, 0.18);
      border-color: var(--accent);
      transform: translateY(-1px);
    }

    .statement-box {
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: 16px;
      padding: 18px;
      background: linear-gradient(180deg, rgba(255, 255, 255, 0.12), rgba(0, 0, 0, 0.15));
    }

    .statement-box strong {
      color: var(--text);
    }

    .statement-box p {
      margin: 0;
      font-size: 13px;
      line-height: 1.7;
      color: var(--muted);
    }

    .modal-footer {
      margin-top: 18px;
      font-size: 12px;
      color: var(--muted);
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 0.5rem;
    }
  </style>
</head>

<body>
  <!-- ================= ENTRY MODAL ================= -->
  <div class="entry-overlay" id="enterOverlay" role="dialog" aria-modal="true" aria-labelledby="title">
    <div class="overlay">
      <div class="modal">
        <div class="brand">
          <span class="logo" aria-hidden="true"></span>
          <div>
            <b>HumanBlockchain.info</b>
            <div class="sub">YAM-is-ON • Proof of Delivery • Serendipity POCs</div>
          </div>
        </div>

        <h1 id="title">Enter the Human Blockchain</h1>
        <p>
          This site records <b>verified human delivery steps</b> using a YAM-is-ON voucher (sticker) or hang tag.
          Serendipity forms Buyer POCs locally (geo-location) and Seller POCs out-of-state or global (timestamp priority).
        </p>

        <div class="pillrow" aria-label="Key concepts">
          <span class="pill"><span class="dot good"></span> Proof-first</span>
          <span class="pill"><span class="dot"></span> Serendipity POCs</span>
          <span class="pill"><span class="dot warn"></span> XP is not money</span>
        </div>

        <div class="list" aria-label="What you will see next">
          <div class="item">
            <span class="dot good" style="margin-top:6px"></span>
            <div>
              <b>Prompt 1:</b> "Is this Proof of Delivery?"
              <span>YES enters PoD Mode. NO continues into the website.</span>
            </div>
          </div>

          <div class="item">
            <span class="dot" style="margin-top:6px"></span>
            <div>
              <b>Prompt 2 (if YES):</b> "Is this the final destination?"
              <span>YES = delivered to recipient. NO = in-route / handoff.</span>
            </div>
          </div>

          <div class="item">
            <span class="dot warn" style="margin-top:6px"></span>
            <div>
              <b>XP display:</b> scientific notation
              <span>Example: <code>1.0 × 10⁻¹⁸ XP</code> — measurement of action, not money.</span>
            </div>
          </div>
        </div>

        <div class="divider" role="separator"></div>

        <div class="cta" aria-label="Enter options">
          <a class="btn primary" href="https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof" target="_blank" rel="noopener noreferrer" id="enterPodMode">Enter PoD Mode</a>
          <a class="btn" href="#" id="enterWebsite">Enter Website</a>
          <a class="btn ghost" href="/faq">Read FAQs</a>
        </div>

        <p class="legal">
          Disclosure: HumanBlockchain.info provides proof-based ledger visibility and reporting. It does not custody money.
          Any fiat or crypto redemption—if offered—occurs only through the Voluntary Fulfillment Network (VFN) outside this ledger.
        </p>
      </div>
    </div>
  </div>

  <!-- ================= POD GATE MODAL ================= -->
  <div class="pod-gate-overlay" id="podOverlay">
    <div class="pod-gate-modal" id="podGate">
      <div class="pod-gate-grid">
        <div>
          <h2>Is This Proof of Delivery?</h2>
          <p class="pod-gate-sub">
            Select <strong>Yes</strong> only if you are validating a delivery event
            using a 2-scan Proof-of-Delivery process.
          </p>
          <div class="btn-row">
            <button class="choice-btn" id="podGateYes">
              YES — Proof of Delivery
            </button>
            <button class="choice-btn" id="podGateNo">
              NO — Continue to Website
            </button>
          </div>
        </div>
        <aside class="statement-box">
          <p>
            <strong>
              "Small Street Applied–Atlanta is a Wyoming DAO and Limited Cooperative Association
            </strong>
            that embodies the functional spirit of an FRB Section 25A coordination role by operating a
            <strong>non-custodial, proof-based clearing-visibility and reporting system</strong>
            for independent participants."
          </p>
        </aside>
      </div>
      <div class="modal-footer">
        <span>HumanBlockchain.info</span>
        <span>Proof before payment • Visibility without custody</span>
      </div>
    </div>
  </div>

  <!-- TOP NAV -->
  <header class="topbar">
    <div class="wrap">
      <nav class="nav" aria-label="Primary">
        <a class="brand" href="/">
          <span class="logo" aria-hidden="true"></span>
          <div>
            <b>HumanBlockchain.info</b><br>
            <span class="small">YAM-is-ON • Proof of Delivery + Serendipity POCs</span>
          </div>
        </a>

        <!-- Desktop menu -->
        <div class="menu" aria-label="Menu">
          <a href="/how-it-works">How It Works</a>
          <a href="/proof-of-delivery">Proof of Delivery</a>
          <a href="/serendipity-protocol">Serendipity Protocol</a>
          <a href="/new-world-penny">New World Penny</a>
          <a href="/dao">Join the DAO</a>
          <a href="/faq">FAQs</a>
        </div>

        <!-- Right side actions + mobile toggle -->
        <div class="cta">
          <a class="btn primary" href="/activate-device">Activate Device</a>
          <a class="btn ghost" href="https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof" target="_blank" rel="noopener noreferrer">PoD Mode</a>

          <div class="hamburger">
            <input id="navtoggle" type="checkbox" />
            <label for="navtoggle" aria-label="Open menu">
              <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </label>
          </div>
        </div>
      </nav>

      <!-- Mobile drawer -->
      <div class="menu-drawer" aria-label="Mobile Menu">
        <a href="/how-it-works">How It Works</a>
        <a href="/proof-of-delivery">Proof of Delivery</a>
        <a href="/serendipity-protocol">Serendipity Protocol</a>
        <a href="/new-world-penny">New World Penny</a>
        <a href="/dao">Join the DAO</a>
        <a href="/faq">FAQs</a>
      </div>
    </div>
  </header>

  <main>
    <!-- HERO -->
    <section class="hero">
      <div class="wrap">
        <div class="pill">
          Serendipity creates POCs from the newest device registrations using geo-location + timestamp
        </div>

        <div class="grid" style="margin-top:14px">
          <!-- Left hero -->
          <div class="card">
            <span class="badge">SERENDIPITY IS THE ONBOARDING MOMENT</span>
            <h1>Your device registers — and the network forms around you.</h1>
            <p class="lead">
              When you activate a device, the system uses <b>geo-location</b> and <b>timestamp</b> to create the next available
              Patron Organizing Communities (POCs). <b>Buyer POCs are local</b>. <b>Seller POCs are out-of-state or global</b>.
              You don't "join a team" — you are <i>placed</i> into a living ledger on purpose.
            </p>

            <div class="kpi">
              <div class="mini">
                <b>Buyer POC = Local</b>
                <span>Built from recent device registrations near you</span>
              </div>
              <div class="mini">
                <b>Seller POC = Out-of-state / Global</b>
                <span>Matched away from your locality to encourage détente</span>
              </div>
              <div class="mini">
                <b>XP is measurement</b>
                <span>Shown as <code>1.0 × 10⁻¹⁸ XP</code> (not money)</span>
              </div>
            </div>

            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:16px">
              <a class="btn primary" href="/activate-device">Activate This Device</a>
              <a class="btn" href="/dao">Join the DAO</a>
              <a class="btn ghost" href="/serendipity-protocol">Read Serendipity Protocol</a>
            </div>

            <p class="small" style="margin-top:12px">
              Device activation triggers role assignments and POC placement. Proof of Delivery remains 2-scan:
              seller initiates, buyer acceptance completes settlement. The d-DAO General Ledger is non-custodial and does not hold, move, or settle money. The Voluntary Fulfillment Network (VFN) is the sole custodial network for any fiat, MSB, or seller-funded activities.
            </p>
          </div>

          <!-- Right hero -->
          <div class="card">
            <h3>Serendipity in 60 seconds</h3>
            <div class="list">
              <div class="item">
                <span class="dot good"></span>
                <div>
                  <b>Step 1:</b> Activate your device<br>
                  <span class="small">Your phone becomes your delivery identity.</span>
                </div>
              </div>

              <div class="item">
                <span class="dot"></span>
                <div>
                  <b>Step 2:</b> Local Buyer POC is assigned<br>
                  <span class="small">Based on geo-location + most recent registrations nearby.</span>
                </div>
              </div>

              <div class="item">
                <span class="dot"></span>
                <div>
                  <b>Step 3:</b> Seller POC is assigned out-of-state / global<br>
                  <span class="small">Designed to connect people across regions and countries.</span>
                </div>
              </div>

              <div class="item">
                <span class="dot good"></span>
                <div>
                  <b>Step 4:</b> Proof of Delivery becomes real<br>
                  <span class="small">Scan voucher/hang tag → confirm final destination → earn XP recognition.</span>
                </div>
              </div>
            </div>

            <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
              <span class="tag">Geo + timestamp form groups</span>
              <span class="tag">Buyer local • Seller global</span>
              <span class="tag">Append-only ledger</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SERENDIPITY PROTOCOL (overview) -->
    <section class="section" id="serendipity">
      <div class="wrap">
        <h2>Serendipity Protocol</h2>
        <p class="lead">
          Serendipity is the moment the ledger becomes social. The newest device activations create the next available POCs.
          This keeps onboarding fair, prevents gatekeeping, and scales globally.
        </p>

        <div class="three">
          <div class="card">
            <h3>Buyer POC (Local)</h3>
            <div class="list">
              <div class="item"><span class="dot good"></span>
                <div><b>Rule:</b> Assigned from your local registration area.</div>
              </div>
              <div class="item"><span class="dot"></span>
                <div><b>Why:</b> Local coordination for buyer confirmations and community trust.</div>
              </div>
            </div>
          </div>

          <div class="card">
            <h3>Seller POC (Out-of-state / Global)</h3>
            <div class="list">
              <div class="item"><span class="dot good"></span>
                <div><b>Rule:</b> Assigned away from your locality.</div>
              </div>
              <div class="item"><span class="dot"></span>
                <div><b>Why:</b> Cross-region cooperation and "détente by design."</div>
              </div>
            </div>
          </div>

          <div class="card">
            <h3>Timestamp Priority</h3>
            <div class="list">
              <div class="item"><span class="dot good"></span>
                <div><b>Rule:</b> Newest registrations fill the next open POC seats.</div>
              </div>
              <div class="item"><span class="dot"></span>
                <div><b>Why:</b> No waiting lists controlled by humans. The clock is impartial.</div>
              </div>
            </div>
          </div>
        </div>

        <div class="card" style="margin-top:16px">
          <h3>POC placement happens once — then delivery begins</h3>
          <p class="lead" style="margin:0">
            After placement, Proof of Delivery runs on the voucher/hang tag ID. Seller initiates. Optional handoff scans record custody movement.
            Buyer acceptance completes settlement. Recognition is recorded as XP in scientific notation, e.g. <code>1.0 × 10⁻¹⁸ XP</code>.
          </p>

          <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
            <a class="btn primary" href="/activate-device">Activate Device</a>
            <a class="btn" href="https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof" target="_blank" rel="noopener noreferrer">I Have Proof of Delivery</a>
            <a class="btn ghost" href="/proof-of-delivery">Proof of Delivery details</a>
          </div>
        </div>
      </div>
    </section>

    <!-- NEW WORLD PENNY -->
    <section class="section" id="nwp">
      <div class="wrap">
        <h2>New World Penny</h2>
        <p class="lead">
          The New World Penny is recognition for verified delivery steps. XP is a memo-ledger unit used for loyalty accounting of verified human value. XP is <b>not money</b>, <b>not a wallet balance</b>, <b>not transferable</b>, and <b>not redeemable on demand</b>. XP entries are created only after verification and may mature after an 8–12 week policy window. The Voluntary Fulfillment Network (VFN) is the sole custodial network for any fiat, MSB, or seller-funded activities.
        </p>

        <div class="two">
          <div class="card">
            <h3>Ledger display</h3>
            <div class="list">
              <div class="item">
                <span class="dot good"></span>
                <div>
                  <b>Example:</b> 1 New World Penny = <code>1.0 × 10⁻¹⁸ XP</code><br>
                  <span class="small">Scientific notation signals measurement, not currency.</span>
                </div>
              </div>
              <div class="item">
                <span class="dot"></span>
                <div><b>Precision:</b><br><span class="small">XP is recorded at sextillionth-of-a-penny resolution with a 21,000-to-1 USD calibration scale.</span></div>
              </div>
            </div>
            <div style="margin-top:14px">
              <a class="btn" href="/new-world-penny">New World Penny details</a>
            </div>
          </div>

          <div class="card">
            <h3>Referral recognition (issued Sep 1)</h3>
            <p class="small" style="margin-top:0">
              Issued once per year in XP on <b>September 1st</b>. (No money custody. No conversion inside the ledger.)
            </p>
            <div class="list">
              <div class="item"><span class="dot"></span>
                <div><b>Tier 1:</b> <code>1.0 × 10⁻¹⁸ XP</code></div>
              </div>
              <div class="item"><span class="dot"></span>
                <div><b>Tier 5:</b> <code>5.0 × 10⁻¹⁸ XP</code></div>
              </div>
              <div class="item"><span class="dot"></span>
                <div><b>Tier 25:</b> <code>2.5 × 10⁻¹⁷ XP</code></div>
              </div>
            </div>
            <div style="margin-top:14px">
              <a class="btn" href="/faq#referrals">Read referral rules</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQs -->
    <section class="section" id="faqs">
      <div class="wrap">
        <h2>FAQs</h2>
        <p class="lead">Fast answers. Clear boundaries. Proof-first design.</p>

        <div class="grid">
          <details open>
            <summary>What is Serendipity?</summary>
            <p>
              Serendipity is the protocol that creates POCs from the newest device registrations. Geo-location assigns a local Buyer POC.
              Timestamp priority fills the next open seats. A separate Seller POC is assigned out-of-state or global to connect people across regions.
            </p>
          </details>

          <details>
            <summary>Why is Buyer POC local and Seller POC global?</summary>
            <p>
              Local Buyer POCs improve coordination for acceptance scans and community trust. Global Seller POCs are assigned out-of-state or across countries
              to encourage cooperation and détente by design.
            </p>
          </details>

          <details>
            <summary>Is XP money?</summary>
            <p>
              No. XP is a memo-ledger unit used for loyalty accounting of verified human value. XP is <b>not money</b>, <b>not a wallet balance</b>, <b>not transferable</b>, and <b>not redeemable on demand</b>. XP entries are created only after verification and may mature after an 8–12 week policy window. The d-DAO General Ledger is non-custodial and does not hold, move, or settle money. The Voluntary Fulfillment Network (VFN) is the sole custodial network for any fiat, MSB, or seller-funded activities.
            </p>
          </details>

          <details id="referrals">
            <summary>When is referral recognition issued?</summary>
            <p>
              Referral recognition is issued in XP on September 1st each year. Tiers are displayed in scientific notation:
              <br><br>
              <b>Tier 1:</b> <code>1.0 × 10⁻¹⁸ XP</code><br>
              <b>Tier 5:</b> <code>5.0 × 10⁻¹⁸ XP</code><br>
              <b>Tier 25:</b> <code>2.5 × 10⁻¹⁷ XP</code>
            </p>
          </details>

          <details>
            <summary>Where does redemption happen?</summary>
            <p>
              The d-DAO General Ledger is non-custodial and does not hold, move, or settle money. The Voluntary Fulfillment Network (VFN) is the sole custodial network for any fiat, MSB, or seller-funded activities. HumanBlockchain.info records proof, accounting, and reporting only.
            </p>
          </details>
        </div>

        <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
          <a class="btn primary" href="/activate-device">Activate Device</a>
          <a class="btn" href="/dao">Join the DAO</a>
          <a class="btn ghost" href="/serendipity-protocol">Serendipity Protocol</a>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="wrap">
      <div class="cols">
        <div>
          <b>HumanBlockchain.info</b><br>
          <span class="small">Serendipity POCs • Proof of Delivery • XP measurement</span>
          <div style="margin-top:10px;display:flex;gap:10px;flex-wrap:wrap">
            <a class="btn small" href="/my-device">My Device</a>
            <a class="btn small" href="https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof" target="_blank" rel="noopener noreferrer">PoD Mode</a>
          </div>
        </div>

        <div>
          <b>System boundaries:</b>
          <p class="small" style="margin-top:8px">
            The <b>d-DAO General Ledger is non-custodial</b> (verification + XP accounting only).
            The <b>Voluntary Fulfillment Network (VFN)</b> is the <b>sole custodial network</b> for fiat/MSB activities.
            XP is loyalty accounting only—no wallets, balances, escrow, or payment APIs in the ledger layer.
          </p>
          <p class="small">
            Referral recognition is issued in XP on September 1st each year.
          </p>
        </div>
      </div>

      <div style="margin-top:16px" class="small">
        © <span id="y"></span> HumanBlockchain.info • YAM-is-ON Delivery Credential
      </div>
    </div>

    <script>
      document.getElementById('y').textContent = new Date().getFullYear();

      // Entry Modal - Show on page load
      const enterOverlay = document.getElementById("enterOverlay");
      const podOverlay = document.getElementById("podOverlay");
      const enterWebsiteBtn = document.getElementById("enterWebsite");
      const enterPodModeBtn = document.getElementById("enterPodMode");
      const podGateYes = document.getElementById("podGateYes");
      const podGateNo = document.getElementById("podGateNo");

      // Show entry modal on page load
      window.addEventListener("load", () => {
        enterOverlay.classList.add("active");
        document.body.style.overflow = "hidden";
      });

      // Enter Website button - show POD gate
      enterWebsiteBtn.addEventListener("click", (e) => {
        e.preventDefault();
        enterOverlay.classList.remove("active");
        setTimeout(() => {
          podOverlay.classList.add("active");
        }, 300);
      });

      // Enter PoD Mode button - close entry modal and open SmallStreet app in new tab
      enterPodModeBtn.addEventListener("click", (e) => {
        e.preventDefault();
        enterOverlay.classList.remove("active");
        document.body.style.overflow = "";
        // Open SmallStreet app PoD mode in new tab
        window.open("https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof", "_blank", "noopener,noreferrer");
      });

      // POD Gate - Yes button (opens existing PoD modal)
      podGateYes.addEventListener("click", () => {
        podOverlay.classList.remove("active");
        document.body.style.overflow = "";
        // Open the existing PoD modal after overlay closes
        setTimeout(() => {
          window.open("https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof","_blank");
        }, 300);
      });

      // POD Gate - No button (close and continue)
      podGateNo.addEventListener("click", () => {
        podOverlay.classList.remove("active");
        document.body.style.overflow = "";
      });
    </script>
  </footer>
</body>
</html>
