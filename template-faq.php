<?php
/**
 * 
 * Template Name: FAQ
 */
?>
FAQ’s HTML/CSS
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>FAQ • Human Blockchain • United Citizens</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Frequently asked questions about the Human Blockchain, United Citizens movement, YAM-is-On vouchers, 2-scan Proof-of-Delivery, XP, YAM JAM, New World Pennies, and the Peace Pentagon." />
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
      font-size: clamp(1.9rem, 3.2vw, 2.3rem);
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

    /* Sections & FAQ cards */
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
      margin-bottom: 0.6rem;
    }

    .faq-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 1.1rem;
    }

    .faq-card {
      border-radius: var(--radius-xl);
      background: rgba(5, 9, 30, 0.98);
      border: 1px solid rgba(42, 53, 110, 0.85);
      padding: 0.9rem 0.95rem 0.85rem;
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.75);
      font-size: 0.9rem;
      color: var(--text-muted);
    }

    .faq-q {
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.3rem;
    }

    .faq-a {
      font-size: 0.88rem;
    }

    .faq-a strong {
      color: var(--accent);
    }

    .faq-tag {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
      margin-bottom: 0.2rem;
    }

    .inline-highlight {
      color: var(--accent);
      font-weight: 500;
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

    .tldr-list {
      margin-top: 0.6rem;
      padding-left: 1.1rem;
      font-size: 0.9rem;
      color: var(--text-muted);
    }

    .tldr-list li {
      margin-bottom: 0.25rem;
    }

    .cta-row {
      margin-top: 1rem;
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

    @media (max-width: 880px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }
      .header-right {
        align-items: flex-start;
        width: 100%;
      }
      .faq-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.25rem;
      }
      .hero-heading {
        font-size: clamp(1.8rem, 5vw, 2.4rem);
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
      }
      .faq-item {
        padding: 1rem 0.9rem;
      }
      .faq-question {
        font-size: 0.95rem;
      }
      .faq-answer {
        font-size: 0.88rem;
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
      .faq-item {
        padding: 0.95rem 0.85rem;
        border-radius: 16px;
      }
      .faq-question {
        font-size: 0.9rem;
      }
      .faq-answer {
        font-size: 0.85rem;
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
      .faq-item {
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
      .faq-item {
        min-height: 44px;
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
          <a href="home">Home</a> · <span>FAQ</span>
        </div>
        <a href="home" class="back-link">
          <span>⟵</span> Back to HumanBlockchain.info
        </a>
      </div>
    </header>

    <main>
      <!-- HERO -->
      <section class="hero">
        <div class="hero-tag">FAQ</div>
        <h1 class="hero-heading">
          Questions about the <span class="hero-highlight">Human Blockchain</span> & <span class="hero-highlight">United Citizens</span>.
        </h1>
        <p class="hero-subtitle">
          This FAQ is written for <strong>voters, consumers, artisans, drivers, and devs</strong> who want to understand
          how <strong>YAM-is-On vouchers</strong>, <strong>2-scan Proof-of-Delivery</strong>, <strong>XP, YAM JAM & New World Pennies</strong>,
          and the <strong>Peace Pentagon</strong> fit together.  
          For this first build phase leading to the <strong>May 17, 2030 Genesis Block</strong>, the community
          currency <strong>YAM</strong> is pegged at <strong>21,000 YAM = 1 USD</strong>, so every YAM JAM trade credit has a clear,
          stable redemptive value and a transparent <strong>$5 / $4 / $1</strong> allocation.
        </p>
        <div class="hero-meta">
          <div class="hero-chip"><span>Audience</span>: Millennials, Gen Z, & curious humans</div>
          <div class="hero-chip"><span>Theme</span>: Voter & consumer-controlled economy</div>
          <div class="hero-chip"><span>Peg</span>: 21,000 YAM = 1 USD (to May 17, 2030 Genesis Block)</div>
        </div>
      </section>

      <!-- GENERAL -->
      <section id="general">
        <div class="section-label">Section 1</div>
        <div class="section-title">General questions</div>
        <p class="section-subtitle">
          Start here if you’re trying to understand what HumanBlockchain.info and United Citizens are at a high level.
        </p>
        <div class="faq-grid">
          <div class="faq-card">
            <div class="faq-tag">General</div>
            <div class="faq-q">What is the Human Blockchain?</div>
            <div class="faq-a">
              The <strong>Human Blockchain</strong> is a shared ledger of <em>verified human actions</em>, not just
              financial transactions. Every time a real person scans a YAM-is-On tag and confirms a delivery,
              that moment becomes a permanent link in a chain of <strong>trust</strong>, measured first in XP and then,
              after maturity, in <strong>YAM and New World Pennies</strong> at a pegged redemption value.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">General</div>
            <div class="faq-q">What is the United Citizens movement?</div>
            <div class="faq-a">
              <strong>United Citizens</strong> is a <em>movement, not a corporation</em>. It’s the spirit of
              voters and consumers who say: <strong>“We decide what counts as wealth.”</strong>  
              The tools (YAM-is-On, PoD, XP, YAM, Peace Pentagon) exist to serve that spirit — not to control it.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">General</div>
            <div class="faq-q">Is this a cryptocurrency or a political party?</div>
            <div class="faq-a">
              No. The Human Blockchain is a <strong>measurement and settlement system</strong> that can connect
              to fiat and crypto, but it is not defined by speculation. United Citizens is a <strong>movement</strong>,
              not a political party or PAC. You participate by how you spend, scan, and support deliveries.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">General</div>
            <div class="faq-q">Why is this focused on voters and consumers?</div>
            <div class="faq-a">
              Because <strong>you already feed the entire economy</strong>.  
              Every click, cart, and delivery is powered by your choices.  
              The Human Blockchain simply gives you a way to say:
              <strong>“If we don’t confirm it, it’s not wealth.”</strong>
            </div>
          </div>
        </div>
      </section>

      <!-- YAM-IS-ON & 2-SCAN POD & YAM JAM -->
      <section id="yam-pod">
        <div class="section-label">Section 2</div>
        <div class="section-title">YAM-is-On, YAM JAM & 2-scan Proof-of-Delivery</div>
        <p class="section-subtitle">
          These questions explain why the <strong>YAM-is-On voucher / hang tag</strong> is the “measuring stick” of this new economy,
          how YAM JAM is valued, and how the <strong>$10 trade credit</strong> splits into <strong>$5 / $4 / $1</strong>.
        </p>
        <div class="faq-grid">
          <div class="faq-card">
            <div class="faq-tag">YAM-is-On</div>
            <div class="faq-q">What is a YAM-is-On voucher or hang tag?</div>
            <div class="faq-a">
              A <strong>YAM-is-On voucher or hang tag</strong> is a physical or digital tag placed on an item or service
              that will be delivered. It carries a unique code that lets the system ask two questions:
              <strong>“Is this Proof of Delivery?”</strong> and <strong>“Is this the Final Destination?”</strong>  
              If there’s no tag, the Human Blockchain treats that delivery as invisible — <em>no tag, no scan, no wealth</em>.
              It is literally the <strong>measuring stick</strong> for YAM JAM and New World Penny accumulation.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">PoD</div>
            <div class="faq-q">What is 2-scan Proof-of-Delivery (PoD)?</div>
            <div class="faq-a">
              <strong>2-scan PoD</strong> means:
              <br /><br />
              <strong>Scan #1 – Seller:</strong> the seller scans the YAM-is-On tag when the item leaves their hands.<br />
              <strong>Scan #2 – Buyer:</strong> the final human receiver scans the same tag and confirms delivery.  
              <br /><br />
              When both scans are complete, the system mints a <strong>$10 YAM JAM trade credit</strong> as XP.  
              For this build phase up to the <strong>May 17, 2030 Genesis Block</strong>, that $10 YAM JAM is defined as
              <strong>210,000 YAM</strong> at the fixed peg of <strong>21,000 YAM = 1 USD</strong>.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">Allocation</div>
            <div class="faq-q">How is each $10 YAM JAM trade credit allocated?</div>
            <div class="faq-a">
              Every confirmed 2-scan delivery generates a single <strong>$10 YAM JAM trade credit</strong>  
              (210,000 YAM at the 21,000:1 peg). That $10 is allocated as:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li><strong>$5</strong> — direct <strong>buyer rebate</strong> (rewarding the voter/consumer who confirmed delivery).</li>
                <li><strong>$4</strong> — <strong>Peace Pentagon social impact fund</strong>, fueling Planning, Budget, Media, Distribution, and Membership work.</li>
                <li><strong>$1</strong> — <strong>patronage</strong> linked to the POC network and seller performance.</li>
              </ul>
              From that $1 patronage:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li><strong>$0.50</strong> goes directly to the <strong>seller</strong> who completed the delivery.</li>
                <li>The remaining <strong>$0.50</strong> can be shared across group bonuses, treasury, and long-term cooperative rewards.</li>
              </ul>
              So every YAM JAM not only thanks the buyer, it also <strong>pays the seller</strong> and powers the wider peace economy.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">YAM JAM</div>
            <div class="faq-q">What exactly is YAM JAM?</div>
            <div class="faq-a">
              <strong>YAM JAM</strong> stands for <strong>You And Me, Just Alternative Money</strong>.  
              Practically, it means: every completed 2-scan Proof-of-Delivery mints a
              <strong>$10 trade credit</strong> in XP and YAM, allocated as:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li><strong>$5 buyer rebate</strong> — rewarding the human who scanned “Yes, this arrived.”</li>
                <li><strong>$4 social impact fund</strong> — routed through the Peace Pentagon branches.</li>
                <li><strong>$1 patronage</strong> — with <strong>$0.50</strong> going straight to the seller for every confirmed delivery.</li>
              </ul>
              It’s how the system says:  
              <strong>“Two humans kept a promise. That’s worth $10 in a 5 / 4 / 1 pattern — and the seller always gets paid.”</strong>
            </div>
          </div>
        </div>
      </section>

      <!-- XP, YAM PEG & NEW WORLD PENNY -->
      <section id="xp-nwp">
        <div class="section-label">Section 3</div>
        <div class="section-title">XP, YAM peg, and New World Pennies</div>
        <p class="section-subtitle">
          These questions cover the “micro” side of the system: how value is recorded as <strong>XP</strong>, how the
          <strong>YAM</strong> peg works, and how it crystallizes as <strong>New World Pennies</strong> during the build to the
          <strong>May 17, 2030 Genesis Block</strong>.
        </p>
        <div class="faq-grid">
          <div class="faq-card">
            <div class="faq-tag">XP</div>
            <div class="faq-q">What is XP in this system?</div>
            <div class="faq-a">
              <strong>XP</strong> is a memo-ledger unit used for loyalty accounting of verified human value. XP is <b>not money</b>, <b>not a wallet balance</b>, <b>not transferable</b>, and <b>not redeemable on demand</b>. XP entries are created only after verification and may mature after an 8–12 week policy window. XP is recorded at sextillionth-of-a-penny precision and displayed in scientific notation to make it unmistakably different from money.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">YAM Peg</div>
            <div class="faq-q">What is YAM, and how is it pegged?</div>
            <div class="faq-a">
              <strong>YAM</strong> is the community currency that powers YAM JAM:
              <strong>You And Me, Just Alternative Money</strong>.  
              For this initial build window up to the <strong>May 17, 2030 Genesis Block</strong>:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>The peg is fixed at <strong>21,000 YAM = 1 USD</strong>.</li>
                <li>A $10 YAM JAM trade credit is therefore <strong>210,000 YAM</strong>.</li>
                <li>The peg defines the <strong>redemptive value</strong> when YAM is converted into fiat or other assets through the treasury and MSB.</li>
              </ul>
              That fixed peg plus the <strong>5 / 4 / 1</strong> split makes every delivery <strong>auditable and predictable</strong>.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">Maturity</div>
            <div class="faq-q">What is the 8–12 week maturity window?</div>
            <div class="faq-a">
              When a $10 YAM JAM trade credit (210,000 YAM) is minted, it starts as XP and then goes through an
              <strong>8–12 week maturity period</strong>. During this time:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>The value is visible as XP loyalty accounting entries, not as instant cash.</li>
                <li>The focus stays on <strong>promise-keeping</strong> and delivery, not speculation.</li>
                <li>Once matured, XP consolidates into <strong>New World Pennies</strong> that may be redeemed through the Voluntary Fulfillment Network (VFN) using the 21,000:1 peg and 5 / 4 / 1 split.</li>
              </ul>
              This keeps the system aligned with <strong>real-world delivery cycles</strong>, not high-speed trading.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">New World Penny</div>
            <div class="faq-q">What is a New World Penny?</div>
            <div class="faq-a">
              A <strong>New World Penny</strong> is the base human unit of wealth in this system.  
              It is formed when enough XP — sextillionth-of-a-penny dust — accumulates through
              2-scan Proof-of-Delivery events and is counted via YAM at the pegged rate.  
              New World Pennies:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>Represent <strong>verified deliveries</strong>, not speculative bets.</li>
                <li>Can be redeemed through fiat rails via a Money Service Business (MSB).</li>
                <li>Are calculated against YAM at <strong>21,000 YAM per 1 USD</strong> with each $10 YAM JAM following the <strong>$5 buyer / $4 social / $1 patronage</strong> pattern.</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <!-- UNITED CITIZENS, PEACE PENTAGON, POCs -->
      <section id="movement-structure">
        <div class="section-label">Section 4</div>
        <div class="section-title">Movement, Peace Pentagon, and POCs</div>
        <p class="section-subtitle">
          These questions explain the “social map” behind the tech: the movement, the five-branch Peace Pentagon,
          and your place in the network — including how the <strong>$4 social impact fund</strong> flows.
        </p>
        <div class="faq-grid">
          <div class="faq-card">
            <div class="faq-tag">Movement</div>
            <div class="faq-q">Is United Citizens an organization I can join?</div>
            <div class="faq-a">
              You don’t join it like a club with dues and a membership card.  
              You become part of <strong>United Citizens</strong> when you:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>Scan a YAM-is-On tag as buyer, seller, or courier.</li>
                <li>Confirm deliveries into the Human Blockchain.</li>
                <li>Behave like the economy belongs to <strong>us</strong>, not just to whales and platforms.</li>
              </ul>
              That’s why we say: it’s a <strong>spirit, not a person</strong>.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">Peace Pentagon</div>
            <div class="faq-q">What is the Peace Pentagon, and how does it use the $4 social impact fund?</div>
            <div class="faq-a">
              The <strong>Peace Pentagon</strong> is a five-branch map of how the movement organizes itself:
              <strong>Planning, Budget, Media, Distribution, Membership</strong>.  
              Every member is placed into one of these branches at registration. The
              <strong>$4 social impact fund</strong> from each YAM JAM is allocated across these five branches to:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>Plan and coordinate new POCs and pilots (Planning).</li>
                <li>Track numbers and keep cooperative accounting honest (Budget).</li>
                <li>Tell the story and amplify real human value (Media).</li>
                <li>Support routes, last-mile logistics, and IRL infrastructure (Distribution).</li>
                <li>Onboard and support new members globally (Membership).</li>
              </ul>
              So the $4 is not a black box — it’s the fuel for organized peace work.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">POC</div>
            <div class="faq-q">What is a Patron Organizing Community (POC)?</div>
            <div class="faq-a">
              A <strong>POC</strong> is a 30-person pod in the network: typically <strong>5 sellers/coaches</strong> and
              <strong>25 buyers</strong>. Each member has:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>A <strong>Buyer POC</strong> (their local pod as a shopper).</li>
                <li>A <strong>Seller POC</strong> (their global cell as a creator/coach).</li>
              </ul>
              Every 2-scan delivery inside these POCs feeds XP, YAM, and New World Pennies into both local and global branches — and
              the <strong>$1 patronage</strong> slice rewards the seller and the wider POC they’re part of.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">Roles</div>
            <div class="faq-q">How are roles and branches assigned to me?</div>
            <div class="faq-a">
              At registration, your <strong>time and place</strong> of entry are treated as a moment of serendipity.
              An assignment engine:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>Places you into one Peace Pentagon branch.</li>
                <li>Connects you to a local Buyer POC.</li>
                <li>Links you to a global Seller POC (often with artisans and sellers in other countries).</li>
              </ul>
              This keeps the grid balanced and global by design, while ensuring the <strong>$4 social impact fund</strong>
              reaches real people doing real work.
            </div>
          </div>
        </div>
      </section>

      <!-- RAILS, MSB, SAFETY -->
      <section id="rails-msb">
        <div class="section-label">Section 5</div>
        <div class="section-title">Rails, MSB, peg & safety</div>
        <p class="section-subtitle">
          These questions address how the system touches existing payment rails, why it doesn’t try to replace them,
          and how the YAM peg & 5 / 4 / 1 split interact with fiat settlement.
        </p>
        <div class="faq-grid">
          <div class="faq-card">
            <div class="faq-tag">Rails</div>
            <div class="faq-q">Does this replace Visa or Mastercard?</div>
            <div class="faq-a">
              No. The system uses <strong>existing rails</strong> wherever it makes sense.  
              The key difference is the <strong>order of operations</strong>:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>First, humans confirm value through 2-scan PoD.</li>
                <li>Then, XP, YAM, and New World Pennies keep score (with YAM pegged at 21,000:1 and a 5 / 4 / 1 split per YAM JAM).</li>
                <li>Only at the end do Visa/Mastercard rails and an MSB handle fiat settlement that mirrors that split.</li>
              </ul>
              The rails become <strong>plumbing</strong>, not power.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">MSB</div>
            <div class="faq-q">What is the role of an MSB (Money Service Business)?</div>
            <div class="faq-a">
              A licensed <strong>MSB</strong> is used to:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>Convert matured New World Pennies and YAM balances into fiat or crypto.</li>
                <li>Handle compliance, reporting, and regulatory requirements.</li>
                <li>Keep the Human Blockchain’s settlement layer linked to the real financial system at the pegged rate of 21,000 YAM per USD and the 5 / 4 / 1 allocation.</li>
              </ul>
              The MSB doesn’t control what counts as value — it just helps translate that value into existing currencies when needed.
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">Trust</div>
            <div class="faq-q">How does this prevent fraud or fake deliveries?</div>
            <div class="faq-a">
              The system makes fraud harder by requiring:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>A real <strong>YAM-is-On measuring stick</strong> on the package.</li>
                <li>Two distinct scans — seller and final receiver — each anchored to <strong>device, time, and location</strong>.</li>
                <li>POC and Peace Pentagon links that make patterns of abuse easier to see.</li>
              </ul>
              Perfect security doesn’t exist, but <strong>device + context + human scan</strong> is a big step beyond “just trust the tracking number.”
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">Control</div>
            <div class="faq-q">Who ultimately controls this system?</div>
            <div class="faq-a">
              The design goal is <strong>HI over AI</strong> — Human Intelligence over algorithms.  
              That means:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>Voters and consumers decide what gets scanned and confirmed.</li>
                <li>POCs and Peace Pentagon branches decide how the <strong>$4 social fund</strong> and <strong>$1 patronage</strong> flow.</li>
                <li>YAM, XP, New World Pennies, rails, and MSBs are tools — not masters.</li>
              </ul>
              Control is distributed across millions of small actions, not concentrated in one company.
            </div>
          </div>
        </div>
      </section>

      <!-- QUICK START -->
      <section id="quick-start">
        <div class="section-label">Section 6</div>
        <div class="section-title">Quick start for Millennials & Gen Z</div>
        <p class="section-subtitle">
          If you just want to know “what do I actually do?”, this is the micro-guide.
        </p>
        <div class="faq-grid">
          <div class="faq-card">
            <div class="faq-tag">Action</div>
            <div class="faq-q">What’s the simplest way to participate?</div>
            <div class="faq-a">
              <ol style="padding-left:1.1rem; margin-top:0.2rem;">
                <li>Get a <strong>YAM-is-On voucher or hang tag</strong> on something you buy or sell.</li>
                <li>Scan it when prompted and answer:
                  <br />• “Is this Proof of Delivery?”<br />• “Is this the Final Destination?”</li>
                <li>Watch your XP and YAM begin to accumulate — that’s your <strong>YAM JAM</strong> trail.</li>
                <li>Learn which <strong>Peace Pentagon branch</strong> you’re in and how your POC works.</li>
              </ol>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-tag">Mindset</div>
            <div class="faq-q">What mindset should I bring into this?</div>
            <div class="faq-a">
              Think of this as:
              <ul style="margin-top:0.35rem; padding-left:1rem;">
                <li>A way to turn ordinary spending into <strong>human-level influence</strong>.</li>
                <li>A chance to reward <strong>makers, last-mile humans, and your future self</strong> directly.</li>
                <li>A long game — XP, YAM, and New World Pennies track <strong>years of proof</strong>, not just days of hype.</li>
              </ul>
              If that resonates, you’re already aligned with the <strong>United Citizens</strong> spirit.
            </div>
          </div>
        </div>

        <div class="callout">
          <strong>TL;DR:</strong> Stick a YAM-is-On measuring stick on real-world value.  
          Scan it twice. Let XP and YAM settle before money moves.  
          For this build phase, every confirmed YAM JAM is <strong>$10 = 210,000 YAM</strong>, split as
          <strong>$5 buyer rebate</strong> + <strong>$4 Peace Pentagon social impact fund</strong> + <strong>$1 patronage</strong>, with
          <strong>$0.50 of that patronage going straight to the seller</strong>.  
          That’s You And Me, Just Alternative Money — <strong>YAM JAM</strong>.
        </div>

        <div class="cta-row">
          <button class="btn-ghost" onclick="window.location.href='how-it-works.html';">
            Dive deeper: How it works ⟶
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
      <div style="max-width:1120px; margin:0 auto; padding:1.5rem 1.25rem; border-top:1px solid var(--border-subtle);">
        <div style="margin-bottom:1rem;">
          <b>System boundaries:</b>
          <p style="margin-top:0.5rem; font-size:0.85rem; color:var(--text-muted); line-height:1.6;">
            The <b>d-DAO General Ledger is non-custodial</b> (verification + XP accounting only).
            The <b>Voluntary Fulfillment Network (VFN)</b> is the <b>sole custodial network</b> for fiat/MSB activities.
            XP is loyalty accounting only—no wallets, balances, escrow, or payment APIs in the ledger layer.
          </p>
        </div>
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; font-size:0.85rem; color:var(--text-muted);">
          <div>© <span id="year"></span> HumanBlockchain.info · FAQ</div>
          <div><a href="#top">Back to top</a></div>
        </div>
      </div>
    </footer>
  </div>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>


