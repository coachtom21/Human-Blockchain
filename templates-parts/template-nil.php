<?php

/**
 * Template Name: NIL
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NIL Free Agency • Powered by XP & the Human Blockchain</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Every 10 years, your XP record book becomes your NIL free agency passport. Join the Human Blockchain and prepare for the May 17, 2030 Genesis Block.">
  <style>
    :root {
      --bg: #050816;
      --bg-alt: #0b1020;
      --bg-soft: #090d1a;
      --accent: #ffb347;
      --accent-soft: rgba(255, 179, 71, 0.12);
      --accent-2: #44ffd2;
      --accent-3: #7b61ff;
      --text-main: #f5f5f7;
      --text-muted: #a0a3b1;
      --border-subtle: #23263a;
      --danger: #ff4b81;
      --shadow-soft: 0 22px 45px rgba(0, 0, 0, 0.55);
      --radius-lg: 18px;
      --radius-xl: 26px;
      --radius-pill: 999px;
      --max-width: 1080px;
      --gradient-hero: linear-gradient(135deg, #ffb347 0%, #ff4b81 30%, #7b61ff 65%, #44ffd2 100%);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "SF Pro Text", sans-serif;
      background: radial-gradient(circle at top, #171b35 0, #050816 55%);
      color: var(--text-main);
      min-height: 100vh;
      padding: 32px 16px 64px;
      display: flex;
      justify-content: center;
    }

    .page {
      width: 100%;
      max-width: var(--max-width);
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
      gap: 16px;
    }

    .logo-lockup {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo-mark {
      width: 28px;
      height: 28px;
      border-radius: 10px;
      background: conic-gradient(from 190deg, #ffb347, #ff4b81, #7b61ff, #44ffd2, #ffb347);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.35), var(--shadow-soft);
      position: relative;
      overflow: hidden;
    }

    .logo-mark::after {
      content: "XP";
      font-size: 9px;
      font-weight: 700;
      letter-spacing: 0.09em;
      color: #050816;
    }
    
    .logo-mark img {
      height: 100%;
      object-fit: contain;
      border-radius: 10px;
      position: absolute;
      z-index: 1;
    }
    
    .logo-mark:has(img)::after {
      display: none;
    }

    .logo-text-block {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .logo-title {
      font-size: 15px;
      font-weight: 650;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--text-main);
    }

    .logo-sub {
      font-size: 12px;
      color: var(--text-muted);
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .pill-tag {
      border-radius: var(--radius-pill);
      border: 1px solid rgba(68, 255, 210, 0.4);
      padding: 6px 14px;
      font-size: 11px;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--accent-2);
      background: rgba(9, 13, 26, 0.9);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .pill-dot {
      width: 6px;
      height: 6px;
      border-radius: 999px;
      background: var(--accent-2);
      box-shadow: 0 0 10px rgba(68, 255, 210, 0.8);
    }

    .btn-outline {
      border-radius: var(--radius-pill);
      border: 1px solid var(--border-subtle);
      padding: 8px 16px;
      font-size: 12px;
      color: var(--text-main);
      background: rgba(9, 13, 26, 0.9);
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-outline span.icon {
      font-size: 14px;
    }

    .btn-outline:hover {
      border-color: var(--accent-2);
      color: var(--accent-2);
    }

    main {
      display: grid;
      grid-template-columns: minmax(0, 3fr) minmax(0, 2.3fr);
      gap: 26px;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      body {
        padding: 24px 12px 48px;
      }
      .page {
        max-width: 100%;
      }
      main {
        gap: 20px;
      }
    }

    @media (max-width: 900px) {
      main {
        grid-template-columns: minmax(0, 1fr);
        gap: 20px;
      }
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
      body {
        padding: 20px 10px 40px;
      }
      .logo-mark {
        width: 36px;
        height: 36px;
      }
      .logo-title {
        font-size: 14px;
      }
      .logo-sub {
        font-size: 11px;
      }
      .nav-actions {
        width: 100%;
        flex-direction: column;
        align-items: flex-start;
      }
      .hero-card {
        padding: 20px 18px 18px;
      }
      .hero-title {
        font-size: clamp(1.8rem, 5vw, 2.4rem);
      }
      .section-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 12px;
      }
    }

    .hero-card {
      border-radius: var(--radius-xl);
      padding: 24px 22px 22px;
      background:
        radial-gradient(circle at top, rgba(123, 97, 255, 0.25), transparent 55%),
        radial-gradient(circle at 80% 130%, rgba(68, 255, 210, 0.25), transparent 55%),
        var(--bg-soft);
      border: 1px solid rgba(255, 255, 255, 0.04);
      box-shadow: var(--shadow-soft);
      position: relative;
      overflow: hidden;
    }

    .hero-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 12px;
      border-radius: var(--radius-pill);
      background: rgba(5, 8, 22, 0.85);
      border: 1px solid rgba(255, 179, 71, 0.5);
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.16em;
      color: var(--accent);
      margin-bottom: 18px;
    }

    .hero-pill-label {
      padding: 2px 8px;
      border-radius: 999px;
      background: rgba(255, 179, 71, 0.24);
      color: #050816;
      font-weight: 700;
      font-size: 10px;
    }

    .hero-title {
      font-size: clamp(26px, 4vw, 34px);
      line-height: 1.1;
      margin-bottom: 10px;
    }

    .hero-title span.highlight {
      background-image: var(--gradient-hero);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero-subtitle {
      font-size: 14px;
      color: var(--text-muted);
      max-width: 520px;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .hero-subtitle strong {
      color: var(--accent-2);
      font-weight: 600;
    }

    .hero-cta-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 18px;
    }

    .btn-primary {
      border-radius: var(--radius-pill);
      padding: 10px 18px;
      border: 0;
      background: var(--gradient-hero);
      color: #050816;
      font-weight: 650;
      font-size: 13px;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.6);
    }

    .btn-primary span.icon {
      font-size: 15px;
    }

    .btn-secondary {
      border-radius: var(--radius-pill);
      border: 1px solid rgba(123, 97, 255, 0.6);
      padding: 9px 16px;
      background: rgba(9, 13, 26, 0.9);
      color: var(--accent-3);
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    .hero-meta {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 12px;
      font-size: 12px;
      color: var(--text-muted);
      margin-bottom: 6px;
    }

    .hero-meta strong {
      color: var(--accent-2);
      font-weight: 600;
    }

    .hero-meta-badge {
      padding: 4px 10px;
      border-radius: var(--radius-pill);
      background: rgba(11, 16, 32, 0.96);
      border: 1px solid rgba(68, 255, 210, 0.35);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: var(--accent-2);
    }

    .hero-meta-badge span.dot {
      width: 6px;
      height: 6px;
      border-radius: 999px;
      background: var(--accent-2);
    }

    .hero-footnote {
      font-size: 11px;
      color: var(--text-muted);
      opacity: 0.85;
    }

    .hero-footnote span {
      color: var(--accent);
      font-weight: 500;
    }

    .xp-panel {
      border-radius: var(--radius-xl);
      padding: 18px 16px 20px;
      background: radial-gradient(circle at top, rgba(68, 255, 210, 0.22), transparent 60%), var(--bg-alt);
      border: 1px solid rgba(255, 255, 255, 0.04);
      box-shadow: var(--shadow-soft);
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .xp-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 10px;
    }

    .xp-title {
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.16em;
      color: var(--text-muted);
    }

    .xp-badge {
      border-radius: var(--radius-pill);
      padding: 5px 10px;
      background: rgba(5, 8, 22, 0.9);
      border: 1px solid rgba(255, 179, 71, 0.6);
      font-size: 11px;
      color: var(--accent);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .xp-badge span.pip {
      width: 6px;
      height: 6px;
      border-radius: 999px;
      background: var(--accent);
    }

    .xp-metric-card {
      border-radius: var(--radius-lg);
      padding: 12px 12px 13px;
      background: rgba(5, 8, 22, 0.9);
      border: 1px solid rgba(35, 38, 58, 0.85);
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      font-size: 12px;
    }

    @media (max-width: 768px) {
      body {
        padding: 16px 8px 32px;
      }
      .logo-mark {
        width: 32px;
        height: 32px;
      }
      .logo-title {
        font-size: 13px;
      }
      .logo-sub {
        font-size: 10px;
      }
      .hero-card {
        padding: 18px 16px 16px;
        border-radius: 20px;
      }
      .hero-title {
        font-size: clamp(1.6rem, 6vw, 2.2rem);
        line-height: 1.2;
      }
      .hero-sub {
        font-size: 12px;
      }
      .pill-tag {
        font-size: 10px;
        padding: 5px 12px;
      }
      .btn-outline {
        font-size: 11px;
        padding: 7px 14px;
      }
      .section-title {
        font-size: 18px;
      }
      .section-body {
        font-size: 12px;
      }
      .xp-metric-card {
        padding: 12px 10px;
      }
      .info-card {
        padding: 10px 10px 12px;
      }
    }

    @media (max-width: 600px) {
      body {
        padding: 12px 6px 24px;
      }
      .logo-mark {
        width: 30px;
        height: 30px;
      }
      .logo-title {
        font-size: 12px;
      }
      .hero-card {
        padding: 16px 14px 14px;
        border-radius: 18px;
      }
      .hero-title {
        font-size: clamp(1.4rem, 7vw, 2rem);
        line-height: 1.15;
      }
      .hero-sub {
        font-size: 11px;
      }
      .xp-metric-card {
        grid-template-columns: 1fr;
        padding: 10px 8px;
      }
      .xp-metric-label {
        font-size: 10px;
      }
      .xp-metric-value {
        font-size: 12px;
      }
      .section-title {
        font-size: 16px;
      }
      .section-body {
        font-size: 11px;
      }
      .info-card {
        padding: 10px 8px 10px;
      }
      .info-heading {
        font-size: 13px;
      }
      .cta-banner {
        flex-direction: column;
        align-items: flex-start;
        padding: 12px 10px;
        font-size: 11px;
      }
      footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        font-size: 10px;
      }
    }

    .xp-metric {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .xp-metric-label {
      font-size: 11px;
      color: var(--text-muted);
    }

    .xp-metric-value {
      font-size: 13px;
      font-weight: 600;
      color: var(--accent-2);
    }

    .xp-metric-hint {
      font-size: 11px;
      color: var(--text-muted);
    }

    .xp-record-note {
      font-size: 12px;
      color: var(--text-muted);
      line-height: 1.6;
    }

    .xp-record-note strong {
      color: var(--accent-2);
      font-weight: 600;
    }

    .xp-timeline {
      border-radius: var(--radius-lg);
      padding: 10px 12px;
      background: rgba(5, 8, 22, 0.9);
      border: 1px dashed rgba(123, 97, 255, 0.7);
      font-size: 11px;
      color: var(--text-muted);
      display: grid;
      gap: 6px;
    }

    .xp-timeline-row {
      display: grid;
      grid-template-columns: 1.3fr 3fr;
      gap: 8px;
    }

    .xp-timeline-label {
      text-transform: uppercase;
      letter-spacing: 0.16em;
      font-size: 10px;
      color: var(--accent-3);
    }

    .xp-timeline-value strong {
      color: var(--accent);
    }

    section.section {
      margin-top: 28px;
      border-radius: var(--radius-xl);
      padding: 20px 18px 18px;
      background: rgba(5, 8, 22, 0.94);
      border: 1px solid rgba(255, 255, 255, 0.05);
      box-shadow: var(--shadow-soft);
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      gap: 12px;
      margin-bottom: 12px;
    }

    .section-title {
      font-size: 16px;
      font-weight: 600;
    }

    .section-kicker {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
    }

    .section-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
      font-size: 13px;
    }


    .info-card {
      border-radius: var(--radius-lg);
      padding: 12px 12px 14px;
      background: rgba(9, 13, 26, 0.95);
      border: 1px solid rgba(35, 38, 58, 0.9);
    }

    .info-label {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.16em;
      color: var(--text-muted);
      margin-bottom: 4px;
    }

    .info-heading {
      font-size: 14px;
      margin-bottom: 6px;
      color: var(--accent-2);
      font-weight: 600;
    }

    .info-body {
      font-size: 12px;
      line-height: 1.6;
      color: var(--text-muted);
    }

    .info-body strong {
      color: var(--accent);
      font-weight: 600;
    }

    .cta-banner {
      margin-top: 18px;
      border-radius: var(--radius-lg);
      padding: 14px 12px;
      background: linear-gradient(120deg, rgba(255, 179, 71, 0.08), rgba(123, 97, 255, 0.16));
      border: 1px solid rgba(255, 179, 71, 0.45);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      font-size: 12px;
      color: var(--text-main);
    }

    @media (max-width: 480px) {
      body {
        padding: 10px 5px 20px;
      }
      .logo-mark {
        width: 28px;
        height: 28px;
      }
      .hero-title {
        font-size: clamp(1.3rem, 8vw, 1.8rem);
      }
      .section-title {
        font-size: 15px;
      }
      .section-body {
        font-size: 10px;
      }
    }

    @media (max-width: 360px) {
      body {
        padding: 8px 4px 16px;
      }
      .hero-card {
        padding: 14px 12px 12px;
      }
      .hero-title {
        font-size: clamp(1.2rem, 9vw, 1.6rem);
      }
    }

    @media (hover: none) and (pointer: coarse) {
      .btn-outline,
      .pill-tag {
        min-height: 44px;
        min-width: 44px;
      }
    }

    .cta-banner strong {
      color: var(--accent);
    }

    .cta-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    footer {
      margin-top: 30px;
      font-size: 11px;
      color: var(--text-muted);
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 8px;
    }

    footer a {
      color: var(--accent-2);
      text-decoration: none;
      border-bottom: 1px dotted rgba(68, 255, 210, 0.6);
    }

    footer a:hover {
      border-bottom-style: solid;
    }
  </style>
</head>
<body>
  <div class="page">
    <header>
      <div class="logo-lockup">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo-mark' ) ); ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text-block">
          <div class="logo-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></div>
          <div class="logo-sub">NIL Free Agency • Powered by XP &amp; YAM JAM</div>
  </a>
      </div>
      <div class="nav-actions">
        <div class="pill-tag">
          <span class="pill-dot"></span>
          <span>Next Reset: May 17, 2030</span>
        </div>
        <a class="btn-outline" href="serendipity-protocol">
          <span class="icon">📜</span>
          Read Serendipity Protocol
</a>
      </div>
    </header>

    <main>
      <!-- HERO -->
      <section class="hero-card">
        <div class="hero-pill">
          <span class="hero-pill-label">NIL • XP • FREE AGENCY</span>
          Every 10 years, the slate is wiped clean
        </div>
        <h1 class="hero-title">
          Your <span class="highlight">Name, Image &amp; Likeness</span><br>
          becomes a <span class="highlight">10-Year Free Agency</span> event.
        </h1>
        <p class="hero-subtitle">
          In the YAM JAM economy, your value isn’t fake followers or ad clicks. It’s
          <strong>XP — experience points</strong> recorded on the Human Blockchain. Every decade,
          your XP record book becomes your <strong>NIL passport</strong> and you enter a global
          free agency marketplace as a completely human, completely verified asset.
        </p>
        <div class="hero-cta-row">
          <button class="btn-primary">
            <span class="icon">🚀</span>
            Join NIL Watchlist
          </button>
          <button class="btn-secondary">
            <span class="icon">🔗</span>
            Connect QRtiger + Venmo
          </button>
        </div>
        <div class="hero-meta">
          <div class="hero-meta-badge">
            <span class="dot"></span>
            <span>Genesis Block Detente • May 17, 2030</span>
          </div>
          <div>XP accrues daily — <strong>your NIL resets every 10 years.</strong></div>
        </div>
        <div class="hero-footnote">
          All XP extinguishes on <span>May 16, 2030</span>. Your record book is sealed. Free agency opens.
        </div>
      </section>

      <!-- XP PANEL / RECORD BOOK PREVIEW -->
      <aside class="xp-panel">
        <div class="xp-header">
          <div class="xp-title">Your XP Record Book</div>
          <div class="xp-badge">
            <span class="pip"></span>
            NIL Free Agent in &lt; 5 years
          </div>
        </div>
        <div class="xp-metric-card">
          <div class="xp-metric">
            <div class="xp-metric-label">XP Accrued This Cycle</div>
            <div class="xp-metric-value">3.42 × 10²³ XP</div>
            <div class="xp-metric-hint">Sextillionth-of-a-penny units • No speculation, just receipts.</div>
          </div>
          <div class="xp-metric">
            <div class="xp-metric-label">NIL Readiness Score</div>
            <div class="xp-metric-value">Tier II • Emerging Free Agent</div>
            <div class="xp-metric-hint">Built from PoD scans, referrals, pledges, and Peace Pentagon activity.</div>
          </div>
        </div>
        <p class="xp-record-note">
          Every delivery you confirm, every 10-pack you pledge, every LAUGH event you host —
          it all lands here as <strong>XP</strong>. At the decade’s end, this record becomes your
          <strong>NIL marketplace profile</strong> for sponsors, DAOs, and communities.
        </p>
        <div class="xp-timeline">
          <div class="xp-timeline-row">
            <div class="xp-timeline-label">Now</div>
            <div class="xp-timeline-value">Earn XP through YAM-is-On vouchers, 2-scan Proof-of-Delivery, and buyer-directed impact.</div>
          </div>
          <div class="xp-timeline-row">
            <div class="xp-timeline-label">May 16, 2030</div>
            <div class="xp-timeline-value"><strong>Serendipity Protocol:</strong> All XP is sealed, fiat enters treasury, the decade closes.</div>
          </div>
          <div class="xp-timeline-row">
            <div class="xp-timeline-label">May 17, 2030</div>
            <div class="xp-timeline-value"><strong>NIL Free Agency opens:</strong> Your XP record book becomes your human NIL contract.</div>
          </div>
        </div>
      </aside>
    </main>

    <!-- HOW IT WORKS -->
    <section class="section" id="how-it-works">
      <div class="section-header">
        <div>
          <div class="section-kicker">How NIL Free Agency Works</div>
          <h2 class="section-title">Every action is logged. Every decade resets. You stay in control.</h2>
        </div>
      </div>
      <div class="section-grid">
        <div class="info-card">
          <div class="info-label">Step 1</div>
          <div class="info-heading">Live your decade in XP</div>
          <div class="info-body">
            Connect your <strong>QRtiger v-card</strong>, Venmo/FonePay, and Gracebook identity. Every 2-scan Proof-of-Delivery, every referral, and every
            $10.30 YAM-is-On trade credit writes XP into your record book — <strong>not as money, but as proof of participation</strong>.
          </div>
        </div>
        <div class="info-card">
          <div class="info-label">Step 2</div>
          <div class="info-heading">Serendipity closes the book</div>
          <div class="info-body">
            On <strong>May 16, 2030</strong>, the Serendipity Protocol triggers: all fiat obligations are settled by seller POCs, all XP is extinguished,
            and your 10-year XP record is sealed forever as a <strong>human blockchain artifact</strong>.
          </div>
        </div>
        <div class="info-card">
          <div class="info-label">Step 3</div>
          <div class="info-heading">Enter NIL free agency</div>
          <div class="info-body">
            On <strong>May 17, 2030</strong>, your XP record becomes your <strong>NIL profile</strong>. You choose how to license your
            name, image, likeness, and decade of receipts — to DAOs, sponsors, Peace Pentagon projects, or to no one at all. <strong>You are the free agent.</strong>
          </div>
        </div>
      </div>

      <div class="cta-banner">
        <div>
          <strong>This isn’t fantasy points.</strong> It’s a decade of verifiable human value.
          When Serendipity hits, your XP becomes your NIL passport — and everyone starts the next cycle at zero.
        </div>
        <div class="cta-actions">
          <button class="btn-primary">
            <span class="icon">🧬</span>
            Start Earning XP
          </button>
          <button class="btn-secondary">
            <span class="icon">🕊️</span>
            Learn About Detente 2030
          </button>
        </div>
      </div>
    </section>

    <!-- WHY IT MATTERS -->
    <section class="section" id="why-it-matters">
      <div class="section-header">
        <div>
          <div class="section-kicker">Why This Matters</div>
          <h2 class="section-title">From celebrity NIL to citizen NIL — powered by Member Capitalism.</h2>
        </div>
      </div>
      <div class="section-grid">
        <div class="info-card">
          <div class="info-label">Everyone has NIL</div>
          <div class="info-heading">Not just athletes &amp; influencers</div>
          <div class="info-body">
            In the old world, NIL belonged to the few. In the Human Blockchain, <strong>every voter and consumer</strong> carries NIL value
            measured in XP. Your spending, your deliveries, your pledges — this is your highlight reel.
          </div>
        </div>
        <div class="info-card">
          <div class="info-label">No hoarding, no whales</div>
          <div class="info-heading">10-year reset, zero permanent kings</div>
          <div class="info-body">
            Because XP is extinguished every decade, there are <strong>no permanent dynasties</strong>. You can’t hoard power; you can only
            earn trust. Each cycle, every member gets a fresh start to prove who they are through action.
          </div>
        </div>
        <div class="info-card">
          <div class="info-label">AI mastered by HI</div>
          <div class="info-heading">Proof of person, not just proof of work</div>
          <div class="info-body">
            AI can fake content, but it can’t fake a decade of device-confirmed, cryptographically anchored PoD events. XP becomes
            your <strong>HI signature</strong> — Human Intelligence over AI — and your NIL becomes an asset that no bot can counterfeit.
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <div>© HumanBlockchain.info • YAM JAM • NIL Free Agency Marketplace</div>
      <div>
        <a href="#">View Technical Whitepaper</a> •
        <a href="#">Join Gracebook</a> •
        <a href="#">LegacyToLiveBy.org</a>
      </div>
    </footer>
  </div>
</body>
</html>


