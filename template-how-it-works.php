<?php
/**
 * 
 * Template Name: How it Works
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>How It Works • Human Blockchain • United Citizens</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="How the Human Blockchain works: YAM-is-On vouchers, 2-scan Proof-of-Delivery, XP, YAM JAM, New World Pennies, Peace Pentagon, and the 5 / 4 / 1 allocation with $0.50 to the seller." />
  <style>
    :root {
      --bg: #050816;
      --bg-alt: #0b1020;
      --accent: #ffb347;
      --accent-soft: rgba(255, 179, 71, 0.1);
      --accent-2: #44ffd2;
      --text-main: #f5f5f7;
      --text-muted: #a0a3b1;
      --border-subtle: #23263a;
      --danger: #ff4b81;
      --shadow-soft: 0 22px 45px rgba(0, 0, 0, 0.55);
      --radius-xl: 18px;
      --font-sans: system-ui, -apple-system, BlinkMacSystemFont, "SF Pro Text", "Inter", sans-serif;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--font-sans);
      background: radial-gradient(circle at top, #161b37 0, #050816 55%, #02030a 100%);
      color: var(--text-main);
      min-height: 100vh;
      line-height: 1.6;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .page {
      max-width: 1120px;
      margin: 0 auto;
      padding: 1.5rem 1.25rem 4rem;
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      padding: 0.75rem 0 1.4rem;
      position: sticky;
      top: 0;
      z-index: 10;
      backdrop-filter: blur(16px);
      background: linear-gradient(to bottom, rgba(5, 8, 22, 0.96), rgba(5, 8, 22, 0.7), transparent);
    }

    .logo-block {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .logo-icon {
      width: 36px;
      height: 36px;
      border-radius: 999px;
      border: 1px solid var(--border-subtle);
      background: radial-gradient(circle at 30% 0%, var(--accent) 0, #140b30 45%, #050816 100%);
      box-shadow: 0 0 18px rgba(255, 179, 71, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .logo-text {
      display: flex;
      flex-direction: column;
      gap: 0.1rem;
    }

    .logo-title {
      font-size: 0.95rem;
      font-weight: 600;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .logo-sub {
      font-size: 0.78rem;
      color: var(--text-muted);
    }

    .header-right {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      align-items: flex-end;
    }

    .breadcrumb {
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    .breadcrumb a {
      color: var(--accent-2);
    }

    .back-link {
      font-size: 0.78rem;
      color: var(--accent-2);
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      cursor: pointer;
    }

    .back-link span {
      font-size: 0.9rem;
    }

    main {
      margin-top: 0.5rem;
    }

    /* HERO */
    .hero {
      border-radius: 24px;
      background: radial-gradient(circle at top, rgba(255, 179, 71, 0.16), rgba(7, 10, 32, 0.97));
      border: 1px solid rgba(255, 255, 255, 0.06);
      box-shadow: var(--shadow-soft);
      padding: 1.8rem 1.6rem 1.5rem;
      margin-bottom: 2.5rem;
    }

    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.2rem 0.65rem;
      border-radius: 999px;
      border: 1px solid rgba(68, 255, 210, 0.4);
      background: rgba(15, 24, 54, 0.9);
      font-size: 0.75rem;
      color: var(--accent-2);
      text-transform: uppercase;
      letter-spacing: 0.16em;
      margin-bottom: 0.75rem;
    }

    .hero-heading {
      font-size: clamp(1.9rem, 3.2vw, 2.4rem);
      font-weight: 700;
      letter-spacing: 0.02em;
      margin-bottom: 0.45rem;
    }

    .hero-highlight {
      background: linear-gradient(120deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero-subtitle {
      font-size: 0.95rem;
      color: var(--text-muted);
      max-width: 44rem;
    }

    .hero-subtitle strong {
      color: var(--text-main);
    }

    .hero-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 0.6rem;
      margin-top: 1rem;
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    .hero-chip {
      padding: 0.22rem 0.7rem;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(4, 7, 24, 0.95);
    }

    .hero-chip span {
      color: var(--accent-2);
      font-weight: 500;
    }

    /* Sections */
    section {
      margin-bottom: 2.6rem;
    }

    .section-label {
      font-size: 0.76rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
      margin-bottom: 0.4rem;
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.3rem;
    }

    .section-subtitle {
      font-size: 0.9rem;
      color: var(--text-muted);
      max-width: 42rem;
      margin-bottom: 0.8rem;
    }

    /* Grid + cards */
    .grid-2 {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 1.1rem;
    }

    .card {
      border-radius: var(--radius-xl);
      background: rgba(5, 9, 30, 0.98);
      border: 1px solid rgba(42, 53, 110, 0.85);
      padding: 0.9rem 1rem 0.9rem;
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.75);
      font-size: 0.9rem;
      color: var(--text-muted);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0.4rem;
      gap: 0.75rem;
    }

    .card-title {
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text-main);
    }

    .pill {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
    }

    .step-number {
      width: 24px;
      height: 24px;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.18);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      color: var(--accent-2);
    }

    ul {
      margin-top: 0.35rem;
      padding-left: 1.1rem;
      font-size: 0.88rem;
    }

    li {
      margin-bottom: 0.25rem;
    }

    .inline-highlight {
      color: var(--accent);
      font-weight: 500;
    }

    /* Timeline / flow */
    .flow {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1rem;
    }

    .flow-step {
      border-radius: var(--radius-xl);
      background: rgba(9, 13, 39, 0.95);
      border: 1px solid rgba(64, 78, 142, 0.9);
      padding: 0.9rem 0.9rem 0.85rem;
      position: relative;
      font-size: 0.87rem;
      color: var(--text-muted);
    }

    .flow-step h3 {
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.25rem;
    }

    .flow-tag {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
      margin-bottom: 0.1rem;
    }

    .flow-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      padding: 0.15rem 0.55rem;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 0.72rem;
      margin-top: 0.35rem;
    }

    /* Allocation breakdown */
    .alloc-grid {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 1.1rem;
    }

    .alloc-diagram {
      border-radius: var(--radius-xl);
      background: radial-gradient(circle at top left, rgba(255, 179, 71, 0.18), rgba(5, 8, 28, 0.96));
      border: 1px solid rgba(255, 255, 255, 0.12);
      padding: 1rem 1rem 0.9rem;
      font-size: 0.9rem;
      color: var(--text-muted);
    }

    .alloc-diagram h3 {
      font-size: 0.98rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.35rem;
    }

    .alloc-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.4rem 0;
      border-bottom: 1px dashed rgba(255, 255, 255, 0.08);
      font-size: 0.88rem;
    }

    .alloc-row:last-child {
      border-bottom: none;
    }

    .alloc-label {
      display: flex;
      flex-direction: column;
      gap: 0.1rem;
    }

    .alloc-label span:first-child {
      font-weight: 500;
      color: var(--text-main);
    }

    .alloc-note {
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    .alloc-value {
      text-align: right;
      font-size: 0.86rem;
    }

    .tag-soft {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      padding: 0.12rem 0.5rem;
      border-radius: 999px;
      background: rgba(4, 7, 24, 0.96);
      border: 1px solid rgba(255, 255, 255, 0.08);
      font-size: 0.72rem;
      margin-top: 0.2rem;
    }

    .callout {
      margin-top: 0.75rem;
      padding: 0.6rem 0.8rem;
      border-radius: 12px;
      background: rgba(9, 13, 39, 0.9);
      border: 1px dashed rgba(255, 255, 255, 0.1);
      font-size: 0.85rem;
      color: var(--text-muted);
    }

    .callout strong {
      color: var(--accent-2);
    }

    .cta-row {
      margin-top: 1.1rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.65rem;
    }

    .btn-ghost {
      padding: 0.6rem 1.1rem;
      border-radius: 999px;
      border: 1px solid var(--border-subtle);
      background: rgba(5, 8, 22, 0.6);
      color: var(--text-muted);
      font-size: 0.84rem;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      cursor: pointer;
      transition: border-color 0.15s ease, background 0.15s ease, color 0.15s ease;
    }

    .btn-ghost:hover {
      border-color: rgba(255, 179, 71, 0.4);
      color: var(--text-main);
      background: rgba(15, 21, 52, 0.9);
    }

    footer {
      margin-top: 2.4rem;
      padding-top: 1.2rem;
      border-top: 1px solid rgba(29, 35, 72, 0.85);
      font-size: 0.78rem;
      color: var(--text-muted);
      display: flex;
      justify-content: space-between;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    footer a {
      color: var(--accent-2);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .page {
        padding: 1.25rem 1rem 3rem;
      }
    }

    @media (max-width: 960px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }
      .header-right {
        width: 100%;
        align-items: flex-start;
      }
      .flow {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.5rem;
      }
      .alloc-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.25rem;
      }
      .grid-2 {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.5rem;
      }
      .hero-heading {
        font-size: clamp(1.8rem, 5vw, 2.4rem);
      }
      .hero-subtitle {
        font-size: 0.92rem;
      }
    }

    @media (max-width: 768px) {
      .page {
        padding: 1rem 0.9rem 2.5rem;
      }
      .logo-icon {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
      }
      .logo-title {
        font-size: 0.88rem;
      }
      .logo-sub {
        font-size: 0.72rem;
      }
      .breadcrumb {
        font-size: 0.7rem;
      }
      .back-link {
        font-size: 0.72rem;
      }
      .hero {
        padding: 1.5rem 1.1rem;
      }
      .hero-heading {
        font-size: clamp(1.6rem, 6vw, 2.2rem);
        line-height: 1.3;
      }
      .hero-subtitle {
        font-size: 0.88rem;
        line-height: 1.6;
      }
      .hero-meta {
        flex-direction: column;
        gap: 0.5rem;
      }
      .hero-chip {
        font-size: 0.78rem;
        padding: 0.4rem 0.7rem;
      }
      .section-title {
        font-size: 1.2rem;
      }
      .section-subtitle {
        font-size: 0.9rem;
      }
      .card {
        padding: 1rem 0.9rem;
      }
    }

    @media (max-width: 600px) {
      .page {
        padding: 0.9rem 0.75rem 2rem;
      }
      header {
        padding: 0.65rem 0 1rem;
      }
      .logo-icon {
        width: 30px;
        height: 30px;
        font-size: 0.75rem;
      }
      .logo-title {
        font-size: 0.82rem;
      }
      .logo-sub {
        font-size: 0.68rem;
      }
      .hero {
        padding: 1.25rem 1rem;
        border-radius: 20px;
      }
      .hero-heading {
        font-size: clamp(1.4rem, 7vw, 2rem);
        line-height: 1.25;
      }
      .hero-subtitle {
        font-size: 0.85rem;
      }
      .hero-chip {
        font-size: 0.72rem;
        padding: 0.35rem 0.65rem;
      }
      .section-label {
        font-size: 0.72rem;
      }
      .section-title {
        font-size: 1.1rem;
      }
      .section-subtitle {
        font-size: 0.88rem;
      }
      .card {
        padding: 0.95rem 0.85rem;
        border-radius: 16px;
      }
      .card-title {
        font-size: 0.95rem;
      }
      .pill {
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
      }
      ul, ol {
        font-size: 0.85rem;
        padding-left: 1rem;
      }
      footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
      }
    }

    @media (max-width: 480px) {
      .page {
        padding: 0.75rem 0.6rem 1.75rem;
      }
      .hero {
        padding: 1.1rem 0.9rem;
      }
      .hero-heading {
        font-size: clamp(1.3rem, 8vw, 1.8rem);
      }
      .section-title {
        font-size: 1rem;
      }
      .card {
        padding: 0.9rem 0.8rem;
      }
    }

    @media (max-width: 360px) {
      .page {
        padding: 0.65rem 0.5rem 1.5rem;
      }
      .logo-icon {
        width: 28px;
        height: 28px;
        font-size: 0.7rem;
      }
      .hero-heading {
        font-size: clamp(1.2rem, 9vw, 1.6rem);
      }
    }

    @media (hover: none) and (pointer: coarse) {
      .back-link,
      .btn {
        min-height: 44px;
        min-width: 44px;
      }
    }
  </style>
</head>
<body>
  <div class="page">
    <header>
      <div class="logo-block">
        <div class="logo-icon">HB</div>
        <div class="logo-text">
          <div class="logo-title">Human Blockchain</div>
          <div class="logo-sub">Your Voice. Your Choice. Your Treasury.</div>
        </div>
      </div>
      <div class="header-right">
        <div class="breadcrumb">
          <a href="home">Home</a> · <span>How It Works</span>
        </div>
        <a href="home" class="back-link">
          <span>⟵</span> Back to HumanBlockchain.info
        </a>
      </div>
    </header>

    <main>
      <!-- HERO -->
      <section class="hero">
        <div class="hero-tag">How it works</div>
        <h1 class="hero-heading">
          From <span class="hero-highlight">2-scan Proof-of-Delivery</span> to <span class="hero-highlight">YAM JAM</span>.
        </h1>
        <p class="hero-subtitle">
          Every time a <strong>real human delivery</strong> is confirmed with a YAM-is-On measuring stick, the Human Blockchain
          mints a <strong>$10 YAM JAM trade credit</strong> — defined as <strong>210,000 YAM</strong> at a fixed peg of
          <strong>21,000 YAM = 1 USD</strong> for this build phase leading to the <strong>May 17, 2030 Genesis Block</strong>.  
          That $10 splits as <strong>$5 buyer rebate</strong>, <strong>$4 Peace Pentagon social impact fund</strong>,
          and <strong>$1 patronage</strong>, with <strong>$0.50 from that patronage going directly to the seller</strong> on every confirmed delivery.
        </p>
        <div class="hero-meta">
          <div class="hero-chip"><span>Core Unit</span>: $10 YAM JAM = 210,000 YAM</div>
          <div class="hero-chip"><span>Allocation</span>: $5 / $4 / $1 (with $0.50 to seller)</div>
          <div class="hero-chip"><span>Era</span>: Build to May 17, 2030 Genesis Block</div>
        </div>
      </section>

      <!-- SECTION 1: THE MEASURING STICK -->
      <section id="measuring-stick">
        <div class="section-label">Step 1</div>
        <div class="section-title">Tag it: the YAM-is-On measuring stick</div>
        <p class="section-subtitle">
          Nothing counts until it’s tagged. The YAM-is-On voucher or hang tag is the **measuring stick** of wealth in this system.
          No tag, no scan, no YAM JAM.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="card-header">
              <div class="card-title">What is a YAM-is-On tag?</div>
              <div class="pill">Measuring stick</div>
            </div>
            <p>
              A <strong>YAM-is-On voucher or hang tag</strong> is a physical or digital credential placed on any item or service
              that will be delivered. Each tag has a unique code linked to:
            </p>
            <ul>
              <li>The <strong>seller</strong> (who is promising delivery).</li>
              <li>The <strong>buyer</strong> (who will receive and confirm it).</li>
              <li>A <strong>POC</strong> (Patron Organizing Community) and Peace Pentagon branch.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              If it doesn’t carry a YAM-is-On measuring stick, the Human Blockchain treats it as invisible:
              <span class="inline-highlight">no tag, no wealth.</span>
            </p>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">Why is the tag so important?</div>
              <div class="pill">Human blockchain</div>
            </div>
            <p>
              Because the tag is what turns a normal shipment into a <strong>2-scan Proof-of-Delivery (PoD)</strong> event.
              It signals to the network:
            </p>
            <ul>
              <li>“This delivery is about <strong>trust</strong>, not just tracking.”</li>
              <li>“Two humans will confirm this, not just a warehouse system.”</li>
              <li>“When it lands, it mints a <strong>$10 YAM JAM</strong> in XP and YAM.”</li>
            </ul>
            <p style="margin-top:0.35rem;">
              The tag is the moment where <strong>voters and consumers</strong> claim the delivery as part of their
              own economy — not just corporate logistics.
            </p>
          </div>
        </div>
      </section>

      <!-- SECTION 2: 2-SCAN PROOF OF DELIVERY -->
      <section id="two-scan">
        <div class="section-label">Step 2</div>
        <div class="section-title">Scan it twice: 2-scan Proof-of-Delivery</div>
        <p class="section-subtitle">
          Two humans, two scans, one shared truth. That’s the heartbeat of the Human Blockchain.
        </p>

        <div class="flow">
          <div class="flow-step">
            <div class="flow-tag">Scan #1</div>
            <h3>Seller launches the promise</h3>
            <p>
              The <strong>seller</strong> scans the YAM-is-On tag when the item leaves their hands.  
              The system captures:
            </p>
            <ul>
              <li>Seller ID + device ID.</li>
              <li>Time, date, and location.</li>
              <li>Related <strong>Seller POC</strong> and Peace Pentagon branch.</li>
            </ul>
            <div class="flow-chip">
              <span>⏱</span> This is where the 8–12 week maturity window starts ticking.
            </div>
          </div>

          <div class="flow-step">
            <div class="flow-tag">Scan #2</div>
            <h3>Buyer confirms delivery</h3>
            <p>
              When the package lands, the <strong>buyer</strong> (or final human receiver) scans the same tag and is asked:
            </p>
            <ul>
              <li><strong>“Is this Proof of Delivery?”</strong> (Y/N)</li>
              <li>If yes: <strong>“Is this the Final Destination?”</strong> (Y/N)</li>
            </ul>
            <p>
              Answering “Yes / Yes” locks in the PoD and final route.
            </p>
            <div class="flow-chip">
              <span>✔</span> HI over AI: two humans agree, then the ledger moves.
            </div>
          </div>

          <div class="flow-step">
            <div class="flow-tag">Result</div>
            <h3>YAM JAM is minted</h3>
            <p>
              A fully confirmed 2-scan PoD mints a single <strong>$10 YAM JAM trade credit</strong>:
            </p>
            <ul>
              <li>Valued as <strong>210,000 YAM</strong> at <strong>21,000 YAM = 1 USD</strong>.</li>
              <li>Recorded first as <strong>XP</strong> (sextillionth-of-a-penny units).</li>
              <li>Attached to specific buyer, seller, and POC records.</li>
            </ul>
            <div class="flow-chip">
              <span>💠</span> One delivery = one YAM JAM = one new link in the Human Blockchain.
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 3: ALLOCATION 5 / 4 / 1 -->
      <section id="allocation">
        <div class="section-label">Step 3</div>
        <div class="section-title">$10 YAM JAM split: $5 / $4 / $1 (with $0.50 to seller)</div>
        <p class="section-subtitle">
          Once a YAM JAM exists, it follows a transparent pattern. This is how wealth flows from each confirmed delivery.
        </p>

        <div class="alloc-grid">
          <div class="alloc-diagram">
            <h3>One YAM JAM, three destinations</h3>
            <p>
              Every confirmed 2-scan PoD mints a <strong>$10 YAM JAM trade credit</strong>, defined as
              <strong>210,000 YAM</strong> at the pegged rate of <strong>21,000 YAM = 1 USD</strong>
              (for the build to the May 17, 2030 Genesis Block).
            </p>

            <div class="alloc-row" style="margin-top:0.4rem;">
              <div class="alloc-label">
                <span>$5 — Buyer rebate</span>
                <span class="alloc-note">
                  Goes to the buyer/voter/consumer who confirmed delivery.
                </span>
              </div>
              <div class="alloc-value">
                <div>105,000 YAM</div>
                <div class="alloc-note">50% of YAM JAM</div>
              </div>
            </div>

            <div class="alloc-row">
              <div class="alloc-label">
                <span>$4 — Peace Pentagon social impact</span>
                <span class="alloc-note">
                  Fuels Planning, Budget, Media, Distribution, Membership work.
                </span>
              </div>
              <div class="alloc-value">
                <div>84,000 YAM</div>
                <div class="alloc-note">40% of YAM JAM</div>
              </div>
            </div>

            <div class="alloc-row">
              <div class="alloc-label">
                <span>$1 — Patronage</span>
                <span class="alloc-note">
                  Linked to Seller POC performance and cooperative rewards.
                </span>
              </div>
              <div class="alloc-value">
                <div>21,000 YAM</div>
                <div class="alloc-note">10% of YAM JAM</div>
              </div>
            </div>

            <p style="margin-top:0.55rem;">
              That $1 patronage slice then splits further:
            </p>
            <ul style="margin-top:0.3rem;">
              <li><strong>$0.50</strong> — directly to the <strong>seller</strong> for this confirmed delivery.</li>
              <li><strong>$0.50</strong> — into group bonuses, treasury, and long-term cooperative pools (e.g. POC rotations, platform reserves, legacy funds).</li>
            </ul>

            <div class="tag-soft">
              <span>🧾</span> Every YAM JAM is an auditable 5 / 4 / 1 event with $0.50 guaranteed to the seller.
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">Why this split matters</div>
              <div class="pill">Incentive design</div>
            </div>
            <p>
              The 5 / 4 / 1 pattern exists so **everyone who makes the delivery real gets paid**:
            </p>
            <ul>
              <li><strong>$5</strong> keeps the buyer engaged — they’re not just a customer, they’re a <strong>voter in the economy</strong>.</li>
              <li><strong>$4</strong> builds the <strong>Peace Pentagon</strong> — funding local and global work that keeps the system fair and resilient.</li>
              <li><strong>$1</strong> rewards productive POCs and sellers — with <strong>$0.50** guaranteed per confirmed delivery to the seller</strong>.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              High level: <strong>the buyer gets thanked, the seller gets paid, the movement gets stronger</strong> — on every YAM-is-On tag that completes the 2-scan journey.
            </p>
          </div>
        </div>

        <div class="callout">
          <strong>TL;DR:</strong> One tag. Two scans. $10 YAM JAM = 210,000 YAM.  
          Always split as <strong>$5 buyer rebate + $4 Peace Pentagon fund + $1 patronage</strong>, with
          <strong>$0.50 of that patronage going straight to the seller</strong> on every confirmed delivery.
        </div>
      </section>

      <!-- SECTION 4: XP & MATURITY -->
      <section id="xp-maturity">
        <div class="section-label">Step 4</div>
        <div class="section-title">XP & 8–12 week maturity: value before money</div>
        <p class="section-subtitle">
          The Human Blockchain values **promises kept over trades cleared**. That’s why YAM JAM lives as XP first.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="card-header">
              <div class="card-title">What is XP?</div>
              <div class="pill">Sextillionth-of-a-penny</div>
            </div>
            <p>
              <strong>XP</strong> is a <em>sextillionth-of-a-penny</em> unit of value — ultra-tiny, but incredibly precise.
              When a YAM JAM is minted:
            </p>
            <ul>
              <li>The $10 credit (210,000 YAM) is recorded as XP across buyer, seller, and POC accounts.</li>
              <li>Every fraction of the 5 / 4 / 1 split exists as <strong>XP dust</strong> until maturity.</li>
              <li>This XP is visible, trackable, and cannot be faked without breaking the 2-scan record.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              XP is how the Human Blockchain says:  
              <span class="inline-highlight">“We see every promise kept — down to a sextillionth of a penny.”</span>
            </p>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">Why 8–12 week maturity?</div>
              <div class="pill">Real-world time</div>
            </div>
            <p>
              The <strong>8–12 week maturity window</strong> exists so value can settle at a **human pace**, not a high-frequency trading pace:
            </p>
            <ul>
              <li>Returns, disputes, and adjustments can be handled without chaos.</li>
              <li>POCs and Peace Pentagon branches can verify performance.</li>
              <li>The XP record has time to stabilize before fiat moves.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              After this window, XP consolidates into <strong>New World Pennies and YAM balances</strong> that can be
              redeemed via the peg through a Money Service Business (MSB).
            </p>
          </div>
        </div>
      </section>

      <!-- SECTION 5: RAILS & MSB -->
      <section id="rails">
        <div class="section-label">Step 5</div>
        <div class="section-title">Settlement: Visa/Mastercard rails + MSB, not speculation</div>
        <p class="section-subtitle">
          The Human Blockchain doesn’t fight the existing rails — it **reorders the logic** so humans lead and money follows.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Where do Visa/Mastercard rails fit in?</div>
              <div class="pill">Existing plumbing</div>
            </div>
            <p>
              The system is designed so that all <strong>XP and YAM settlement happens first</strong>. Only after:
            </p>
            <ul>
              <li>The 2-scan PoD is confirmed.</li>
              <li>The $10 YAM JAM is minted and split 5 / 4 / 1.</li>
              <li>XP matures into New World Pennies and YAM balances.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              …do **Visa/Mastercard rails** and banking infrastructure move fiat to mirror:
              <strong>$5 buyer / $4 social impact / $1 patronage with $0.50 to seller</strong>.
            </p>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">What does the MSB actually do?</div>
              <div class="pill">Money service business</div>
            </div>
            <p>
              A licensed <strong>Money Service Business (MSB)</strong> is the bridge between:
            </p>
            <ul>
              <li>The <strong>Human Blockchain ledger</strong> (XP, YAM, New World Pennies).</li>
              <li>The <strong>legacy financial system</strong> (fiat rails, banks, reporting obligations).</li>
            </ul>
            <p style="margin-top:0.35rem;">
              The MSB:
            </p>
            <ul>
              <li>Honors the peg: <strong>21,000 YAM = 1 USD</strong> for this build era.</li>
              <li>Honors the allocation: <strong>$5 / $4 / $1</strong> with **$0.50 to the seller**.</li>
              <li>Handles compliance so the movement can focus on <strong>human value</strong>, not paperwork.</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- SECTION 6: QUICK START -->
      <section id="quick-start">
        <div class="section-label">Step 6</div>
        <div class="section-title">Quick start: how you plug in</div>
        <p class="section-subtitle">
          You don’t need to be a dev, a banker, or a politician. You just need a device and a tag.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="card-header">
              <div class="card-title">As a buyer / voter / consumer</div>
              <div class="pill">You And Me</div>
            </div>
            <ul>
              <li>Look for <strong>YAM-is-On vouchers or hang tags</strong> on things you buy or receive.</li>
              <li>When prompted, scan the tag and answer:
                <br />• “<strong>Is this Proof of Delivery?</strong>”  
                • “<strong>Is this the Final Destination?</strong>”</li>
              <li>Every “Yes / Yes” you tap mints a <strong>$10 YAM JAM</strong> and sends <strong>$5 back to you</strong> (via XP → YAM → redemption).</li>
              <li>You instantly become part of a <strong>Buyer POC</strong> and a Peace Pentagon branch.</li>
            </ul>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">As a seller / maker / last-mile human</div>
              <div class="pill">Just Alternative Money</div>
            </div>
            <ul>
              <li>Attach a <strong>YAM-is-On measuring stick</strong> to every delivery you’re responsible for.</li>
              <li>Scan when it leaves you. Encourage the final receiver to complete the 2-scan PoD.</li>
              <li>For every confirmed delivery, you:
                <ul style="margin-top:0.25rem;">
                  <li>Help mint a $10 YAM JAM.</li>
                  <li>Trigger the 5 / 4 / 1 allocation flow.</li>
                  <li>Receive <strong>$0.50 in patronage</strong> (210,000 YAM × 10% × 50%).</li>
                </ul>
              </li>
              <li>Over time, your POC and Peace Pentagon branch see your performance in XP and YAM, not just ratings and stars.</li>
            </ul>
          </div>
        </div>

        <div class="callout">
          <strong>Bottom line:</strong>  
          A YAM-is-On measuring stick + two human scans = one $10 YAM JAM = 210,000 YAM split as
          <strong>$5 buyer rebate</strong> + <strong>$4 Peace Pentagon social impact fund</strong> +
          <strong>$1 patronage</strong> with <strong>$0.50 guaranteed to the seller</strong>.  
          That’s You And Me, Just Alternative Money — <strong>YAM JAM</strong> — on the road to the
          <strong>May 17, 2030 Genesis Block</strong>.
        </div>

        <div class="cta-row">
          <button class="btn-ghost" onclick="window.location.href='faq.html';">
            Read the FAQ ⟶
          </button>
          <button class="btn-ghost" onclick="window.location.href='united-citizens.html';">
            Learn about United Citizens ⟶
          </button>
          <button class="btn-ghost" onclick="window.location.href='peace-pentagon.html';">
            Explore the Peace Pentagon ⟶
          </button>
        </div>
      </section>
    </main>

    <footer>
      <div>© <span id="year"></span> HumanBlockchain.info · How It Works</div>
      <div><a href="#top">Back to top</a></div>
    </footer>
  </div>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>


