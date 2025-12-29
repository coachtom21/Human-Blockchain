<?php
/**
 * Template Name: Serendipity Protocol
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Serendipity Protocol • Human Blockchain</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="The 10-year reset event where XP is extinguished, fiat enters the treasury momentarily, and every member becomes a free agent for the next Human Blockchain cycle.">
<style>
  :root {
    --bg: #050816;
    --bg-alt: #0b1020;
    --bg-soft: #090d1a;
    --accent: #ffb347;
    --accent-soft: rgba(255,179,71,0.12);
    --accent-2: #44ffd2;
    --accent-3: #7b61ff;
    --text-main: #f5f5f7;
    --text-muted: #a0a3b1;
    --border-subtle: #23263a;
    --radius-lg: 18px;
    --radius-xl: 26px;
    --radius-pill: 999px;
    --shadow-soft: 0 22px 45px rgba(0,0,0,0.55);
    --gradient-hero: linear-gradient(135deg, #ffb347 0%, #ff4b81 30%, #7b61ff 65%, #44ffd2 100%);
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

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
    max-width: 1080px;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
  }

  .logo-lockup {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .logo-mark {
    width: 40px;
    height: 40px;
    border-radius: 16px;
    background: conic-gradient(from 190deg, #ffb347, #ff4b81, #7b61ff, #44ffd2, #ffb347);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 11px;
    font-weight: 700;
    color: #050816;
    box-shadow: var(--shadow-soft);
  }

  .logo-title {
    font-size: 15px;
    font-weight: 650;
    text-transform: uppercase;
    letter-spacing: 0.14em;
  }

  .btn-back {
    border-radius: var(--radius-pill);
    border: 1px solid var(--border-subtle);
    padding: 8px 16px;
    font-size: 12px;
    color: var(--text-main);
    background: rgba(9,13,26,0.9);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .btn-back span.icon {
    font-size: 14px;
  }

  .btn-back:hover {
    border-color: var(--accent-2);
    color: var(--accent-2);
  }

  .section {
    border-radius: var(--radius-xl);
    padding: 22px 20px 24px;
    margin-bottom: 32px;
    background: var(--bg-alt);
    border: 1px solid rgba(255,255,255,0.04);
    box-shadow: var(--shadow-soft);
  }

  .section-kicker {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.18em;
    color: var(--accent-2);
    margin-bottom: 8px;
  }

  .section-title {
    font-size: 24px;
    margin-bottom: 14px;
    background-image: var(--gradient-hero);
    -webkit-background-clip: text;
    color: transparent;
  }

  .section-body {
    font-size: 14px;
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 14px;
  }

  .highlight {
    color: var(--accent);
    font-weight: 600;
  }

  .timeline {
    border-radius: var(--radius-lg);
    padding: 14px 16px;
    background: rgba(9,13,26,0.9);
    border: 1px dashed rgba(123, 97, 255, 0.7);
    margin-bottom: 16px;
  }

  .timeline-row {
    display: grid;
    grid-template-columns: 1.1fr 3fr;
    gap: 10px;
    padding: 6px 0;
  }

  .timeline-label {
    text-transform: uppercase;
    letter-spacing: 0.14em;
    color: var(--accent-3);
    font-size: 11px;
  }

  .timeline-value {
    font-size: 13px;
    color: var(--text-main);
  }

  .cta-banner {
    border-radius: var(--radius-xl);
    padding: 18px 16px;
    background: linear-gradient(120deg, rgba(255,179,71,0.12), rgba(123,97,255,0.18));
    border: 1px solid rgba(255,179,71,0.45);
    display: flex;
    flex-direction: column;
    gap: 10px;
    font-size: 13px;
    color: var(--text-main);
    margin-bottom: 22px;
  }

  .cta-banner strong {
    color: var(--accent);
  }

  footer {
    font-size: 11px;
    color: var(--text-muted);
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
  }

  footer a {
    color: var(--accent-2);
    text-decoration: none;
    border-bottom: 1px dotted rgba(68,255,210,0.6);
  }

  footer a:hover {
    border-bottom-style: solid;
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
    body {
      padding: 24px 12px 48px;
    }
    .page {
      max-width: 100%;
    }
  }

  @media (max-width: 900px) {
    body {
      padding: 20px 10px 40px;
    }
    header {
      flex-direction: column;
      align-items: flex-start;
      gap: 12px;
    }
    .logo-mark {
      width: 36px;
      height: 36px;
      font-size: 10px;
    }
    .logo-title {
      font-size: 14px;
    }
    .btn-back {
      width: 100%;
      justify-content: center;
    }
    .section {
      padding: 18px 16px 20px;
    }
    .section-title {
      font-size: 20px;
    }
    .section-body {
      font-size: 13px;
    }
    .timeline {
      padding: 12px 14px;
    }
    .timeline-row {
      flex-direction: column;
      gap: 8px;
    }
    .timeline-label {
      font-size: 11px;
    }
    .timeline-value {
      font-size: 12px;
    }
    .cta-banner {
      padding: 16px 14px;
      font-size: 13px;
    }
  }

  @media (max-width: 768px) {
    body {
      padding: 16px 8px 32px;
    }
    .logo-mark {
      width: 32px;
      height: 32px;
      font-size: 9px;
    }
    .logo-title {
      font-size: 13px;
    }
    .section {
      padding: 16px 14px 18px;
      border-radius: 20px;
    }
    .section-kicker {
      font-size: 11px;
    }
    .section-title {
      font-size: 18px;
      margin-bottom: 12px;
    }
    .section-body {
      font-size: 12px;
    }
    .timeline {
      padding: 10px 12px;
    }
    .timeline-label {
      font-size: 10px;
    }
    .timeline-value {
      font-size: 11px;
    }
    .cta-banner {
      padding: 14px 12px;
      font-size: 12px;
    }
    footer {
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
      font-size: 11px;
    }
  }

  @media (max-width: 600px) {
    body {
      padding: 12px 6px 24px;
    }
    .section {
      padding: 14px 12px 16px;
      border-radius: 18px;
    }
    .section-title {
      font-size: 16px;
    }
    .section-body {
      font-size: 11px;
    }
    .timeline {
      padding: 10px 10px;
    }
    .cta-banner {
      padding: 12px 10px;
      font-size: 11px;
    }
  }

  @media (max-width: 480px) {
    body {
      padding: 10px 5px 20px;
    }
    .logo-mark {
      width: 28px;
      height: 28px;
      font-size: 8px;
    }
    .logo-title {
      font-size: 12px;
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
    .section {
      padding: 12px 10px 14px;
    }
    .section-title {
      font-size: 14px;
    }
  }

  @media (hover: none) and (pointer: coarse) {
    .btn-back {
      min-height: 44px;
      min-width: 44px;
    }
  }
</style>
</head>

<body>
<div class="page">

<header>
  <div class="logo-lockup">
    <div class="logo-mark">XP</div>
    <div class="logo-title">Serendipity Protocol</div>
  </div>

  <a href="nil" class="btn-back">
    <span class="icon">←</span> Back to NIL Free Agency
  </a>
</header>

<!-- INTRO -->
<section class="section">
  <div class="section-kicker">Once-per-decade reset</div>
  <h1 class="section-title">The Serendipity Protocol</h1>
  <p class="section-body">
    The Serendipity Protocol is the <span class="highlight">10-year human reset event</span> where the entire YAM JAM economy
    closes one ledger and begins a new one. All XP is sealed and extinguished. All seller POC MSBs settle their fiat
    obligations. And for one moment — and only one — <span class="highlight">fiat enters the treasury</span> before the next
    cycle begins.
  </p>
</section>

<!-- HOW IT WORKS TIMELINE -->
<section class="section">
  <div class="section-kicker">The Three Moments</div>
  <h2 class="section-title">The Serendipity Timeline</h2>

  <div class="timeline">
    <div class="timeline-row">
      <div class="timeline-label">Now → 2030</div>
      <div class="timeline-value">
        XP accrues from every PoD scan, membership, referral, and buyer-directed YAM JAM action.
        The treasury holds <strong>zero fiat</strong>. All obligations are seller-fronted.
      </div>
    </div>

    <div class="timeline-row">
      <div class="timeline-label">May 16, 2030</div>
      <div class="timeline-value">
        The Protocol activates. <strong>All XP is sealed and extinguished.</strong> Seller POC MSBs settle every dollar of
        outstanding obligations, and <strong>all fiat enters the treasury for one night only.</strong> The ledger closes.
      </div>
    </div>

    <div class="timeline-row">
      <div class="timeline-label">May 17, 2030</div>
      <div class="timeline-value">
        XP resets to zero. Treasury redistributes 99% via the Peace Pentagon formula and locks 1% into the Legacy Fund.
        The <strong>NIL Free Agency Marketplace opens</strong> and every member becomes a free agent with their decade-long XP record book.
      </div>
    </div>
  </div>
</section>

<!-- WHY IT MATTERS -->
<section class="section">
  <div class="section-kicker">Why It Matters</div>
  <h2 class="section-title">The Human Blockchain Needs a Human Reset</h2>
  <p class="section-body">
    XP is not money; it is <span class="highlight">proof of participation</span>. A decade of your actions, your trading, your
    buyer-directed impact, your deliveries, your commitments, and your peacekeeping deeds — recorded in sextillionth-of-a-penny
    precision. The Serendipity Protocol ensures no member can hoard power or accumulate permanent advantage. Every 10 years,
    the system refreshes, the ledger closes, and every human begins again at <strong>absolute zero</strong>.
  </p>
</section>

<!-- CTA -->
<div class="cta-banner">
  <strong>Serendipity changes everything.</strong><br>
  It transforms your XP into your NIL passport and resets the world economy around voters and consumers — every decade.
  <br><br>
  Prepare yourself. Earn XP now. Your next free agency begins May 17, 2030.
</div>

<footer>
  <div>© HumanBlockchain.info • YAM JAM • Member Capitalism Reset Cycle</div>
  <div>
    <a href="nil-free-agency.html">NIL Free Agency</a> •
    <a href="#">Peace Pentagon</a> •
    <a href="#">BIS 2.0 Charter</a>
  </div>
</footer>

</div>
</body>
</html>



