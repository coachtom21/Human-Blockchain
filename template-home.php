<!-- 
Template Name: Home Template -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Human Blockchain • Your Voice. Your Choice. Your Treasury.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Human Blockchain is a referral membership gateway that sponsors the United Citizens clearinghouse — a Visa/Mastercard alternative powered by 2-scan Proof-of-Delivery and cooperative patronage." />
  <style>
    :root {
      --bg: #050816;
      --bg-alt: #0b1020;
      --accent: #ffb347;
      --accent-soft: rgba(255, 179, 71, 0.08);
      --accent-2: #44ffd2;
      --text-main: #f5f5f7;
      --text-muted: #a0a3b1;
      --border-subtle: #23263a;
      --danger: #ff4b81;
      --shadow-soft: 0 22px 45px rgba(0, 0, 0, 0.6);
      --radius-xl: 26px;
      --radius-lg: 18px;
      --radius-pill: 999px;
      --max-width: 1120px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "SF Pro Text",
        "Segoe UI", sans-serif;
      background: radial-gradient(circle at top, #111827 0, #050816 50%);
      color: var(--text-main);
      -webkit-font-smoothing: antialiased;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    img {
      max-width: 100%;
      display: block;
    }

    .page {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .shell {
      width: 100%;
      max-width: var(--max-width);
      margin: 0 auto;
      padding: 1.5rem 1.25rem 4rem;
    }

    /* Header */

    .site-header {
      position: sticky;
      top: 0;
      z-index: 20;
      backdrop-filter: blur(16px);
      background: linear-gradient(
        to bottom,
        rgba(5, 8, 22, 0.95),
        rgba(5, 8, 22, 0.85),
        transparent
      );
      border-bottom: 1px solid rgba(35, 38, 58, 0.8);
    }

    .site-header-inner {
      max-width: var(--max-width);
      margin: 0 auto;
      padding: 0.75rem 1.25rem 0.9rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 0.65rem;
    }

    .brand-mark {
      width: 32px;
      height: 32px;
      border-radius: 12px;
      background: radial-gradient(circle at 30% 0, #ffffff, #ffb347 30%, #7c2cff);
      box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.12),
        0 14px 35px rgba(0, 0, 0, 0.65);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      font-weight: 700;
      color: #050816;
    }

    .brand-text {
      display: flex;
      flex-direction: column;
      gap: 0.06rem;
    }

    .brand-name {
      font-size: 0.98rem;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      font-weight: 650;
    }

    .brand-tagline {
      font-size: 0.72rem;
      color: var(--text-muted);
    }

    .nav {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      font-size: 0.82rem;
      color: var(--text-muted);
    }

    .nav a {
      position: relative;
      padding-bottom: 0.1rem;
    }

    .nav a::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 0;
      height: 1px;
      background: linear-gradient(90deg, var(--accent), var(--accent-2));
      transition: width 0.2s ease;
    }

    .nav a:hover::after {
      width: 100%;
    }

    .nav-cta {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.38rem 0.9rem;
      border-radius: var(--radius-pill);
      border: 1px solid rgba(255, 179, 71, 0.5);
      background: radial-gradient(
          circle at top left,
          rgba(255, 179, 71, 0.09),
          transparent 50%
        ),
        rgba(5, 8, 22, 0.8);
      color: var(--accent);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
      font-size: 0.8rem;
      font-weight: 600;
      white-space: nowrap;
    }

    .nav-cta span.icon {
      font-size: 0.95rem;
    }

    @media (max-width: 768px) {
      .site-header-inner {
        flex-wrap: wrap;
        justify-content: center;
      }
      .nav {
        display: none;
      }
    }

    /* Hero */

    .hero {
      padding-top: 2.75rem;
      display: grid;
      grid-template-columns: minmax(0, 1.4fr) minmax(0, 1.2fr);
      gap: 2.5rem;
      align-items: center;
    }

    .hero-left {
      display: flex;
      flex-direction: column;
      gap: 1.75rem;
    }

    .hero-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.28rem 0.7rem;
      border-radius: var(--radius-pill);
      border: 1px solid rgba(68, 255, 210, 0.45);
      background: radial-gradient(
          circle at top left,
          rgba(68, 255, 210, 0.12),
          transparent 60%
        ),
        rgba(11, 16, 32, 0.95);
      color: var(--accent-2);
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      max-width: max-content;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
    }

    .hero-pill-dot {
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: radial-gradient(circle at 30% 0, #ffffff, #44ffd2);
      box-shadow: 0 0 0 4px rgba(68, 255, 210, 0.18);
    }

    .hero-title {
      font-size: clamp(2.1rem, 3.1vw + 1.4rem, 3.2rem);
      line-height: 1.07;
      letter-spacing: 0.01em;
    }

    .hero-title span.highlight {
      background: linear-gradient(120deg, #ffb347, #ff4b81, #44ffd2);
      -webkit-background-clip: text;
      color: transparent;
    }

    .hero-subtitle {
      font-size: 0.98rem;
      line-height: 1.7;
      color: var(--text-muted);
      max-width: 34rem;
    }

    .hero-subtitle b {
      color: var(--accent);
      font-weight: 600;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 0.9rem;
    }

    .btn {
      border-radius: var(--radius-pill);
      padding: 0.75rem 1.35rem;
      font-size: 0.9rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      cursor: pointer;
      border: none;
      outline: none;
      text-decoration: none;
      transition: transform 0.12s ease, box-shadow 0.12s ease,
        background 0.12s ease, border-color 0.12s ease;
      white-space: nowrap;
    }

    .btn-primary {
      background: radial-gradient(
          circle at top left,
          rgba(255, 255, 255, 0.18),
          transparent 55%
        ),
        linear-gradient(120deg, #ffb347, #ff4b81);
      color: #050816;
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.8);
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 22px 50px rgba(0, 0, 0, 0.9);
    }

    .btn-ghost {
      background: rgba(11, 16, 32, 0.85);
      color: var(--text-main);
      border: 1px solid rgba(255, 255, 255, 0.12);
    }

    .btn-ghost:hover {
      background: rgba(15, 23, 42, 0.95);
    }

    .btn .icon {
      font-size: 1rem;
    }

    .hero-meta {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 0.9rem;
      margin-top: 0.25rem;
      max-width: 32rem;
    }

    .meta-card {
      border-radius: 16px;
      padding: 0.85rem 0.9rem;
      background: radial-gradient(
          circle at top left,
          rgba(255, 179, 71, 0.16),
          transparent 55%
        ),
        rgba(11, 16, 32, 0.85);
      border: 1px solid rgba(35, 38, 58, 0.85);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
    }

    .meta-card:nth-child(2) {
      background: radial-gradient(
          circle at top right,
          rgba(68, 255, 210, 0.12),
          transparent 55%
        ),
        rgba(11, 16, 32, 0.85);
    }

    .meta-card:nth-child(3) {
      background: radial-gradient(
          circle at top,
          rgba(255, 75, 129, 0.14),
          transparent 60%
        ),
        rgba(11, 16, 32, 0.85);
    }

    .meta-label {
      font-size: 0.68rem;
      text-transform: uppercase;
      letter-spacing: 0.09em;
      color: var(--text-muted);
      margin-bottom: 0.25rem;
    }

    .meta-value {
      font-size: 0.9rem;
      font-weight: 600;
    }

    .meta-note {
      font-size: 0.7rem;
      margin-top: 0.15rem;
      color: var(--text-muted);
    }

    /* Hero right */

    .hero-right {
      display: flex;
      justify-content: center;
    }

    .hero-panel {
      width: 100%;
      max-width: 420px;
      border-radius: var(--radius-xl);
      border: 1px solid rgba(68, 255, 210, 0.5);
      background: radial-gradient(
          circle at top left,
          rgba(68, 255, 210, 0.12),
          transparent 55%
        ),
        radial-gradient(
          circle at bottom right,
          rgba(255, 75, 129, 0.22),
          transparent 45%
        ),
        rgba(5, 8, 22, 0.96);
      padding: 1.2rem 1.1rem 1.25rem;
      box-shadow: var(--shadow-soft);
      position: relative;
      overflow: hidden;
    }

    .hero-panel-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 0.75rem;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      border-radius: var(--radius-pill);
      border: 1px solid rgba(255, 255, 255, 0.22);
      padding: 0.25rem 0.6rem;
      font-size: 0.7rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      background: rgba(5, 8, 22, 0.8);
    }

    .badge-dot {
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: radial-gradient(circle at 30% 0, #ffffff, #ffb347);
    }

    .panel-title {
      font-size: 0.9rem;
      font-weight: 600;
    }

    .panel-subtitle {
      font-size: 0.74rem;
      color: var(--text-muted);
    }

    .panel-grid {
      margin-top: 0.8rem;
      display: grid;
      grid-template-columns: 1.1fr 1.1fr;
      gap: 0.7rem;
    }

    .panel-card {
      border-radius: 16px;
      padding: 0.7rem 0.75rem;
      background: rgba(11, 16, 32, 0.93);
      border: 1px solid rgba(35, 38, 58, 0.9);
    }

    .panel-label {
      font-size: 0.68rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.09em;
      margin-bottom: 0.35rem;
    }

    .panel-value {
      font-size: 0.9rem;
      font-weight: 600;
      margin-bottom: 0.2rem;
    }

    .panel-chip-row {
      display: flex;
      flex-wrap: wrap;
      gap: 0.25rem;
    }

    .chip {
      font-size: 0.68rem;
      padding: 0.18rem 0.5rem;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.16);
      background: rgba(15, 23, 42, 0.95);
      color: var(--text-muted);
    }

    .chip.highlight {
      border-color: rgba(255, 179, 71, 0.85);
      color: var(--accent);
      background: rgba(15, 23, 42, 0.98);
    }

    .xp-line {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      gap: 0.75rem;
      margin-top: 0.4rem;
    }

    .xp-line .label {
      font-size: 0.72rem;
      color: var(--text-muted);
    }

    .xp-line .value {
      font-size: 0.76rem;
      font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo,
        Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      color: var(--accent-2);
    }

    .xp-line .value span.dim {
      color: rgba(160, 163, 177, 0.8);
    }

    .panel-footer {
      margin-top: 0.85rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 0.75rem;
      font-size: 0.72rem;
      color: var(--text-muted);
    }

    .panel-footer strong {
      color: var(--accent);
      font-weight: 600;
    }

    .panel-footer a {
      font-size: 0.72rem;
      color: var(--accent-2);
      text-decoration: underline;
      text-decoration-style: dotted;
      text-underline-offset: 0.14rem;
    }

    /* Sections */

    .section {
      margin-top: 3.25rem;
    }

    .section-header {
      display: flex;
      flex-direction: column;
      gap: 0.3rem;
      margin-bottom: 1.4rem;
    }

    .section-kicker {
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
    }

    .section-title {
      font-size: 1.25rem;
      letter-spacing: 0.02em;
    }

    .section-description {
      font-size: 0.92rem;
      color: var(--text-muted);
      max-width: 40rem;
    }

    .section-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1.3rem;
    }

    .card {
      border-radius: var(--radius-lg);
      border: 1px solid var(--border-subtle);
      background: radial-gradient(
          circle at top left,
          rgba(255, 179, 71, 0.07),
          transparent 55%
        ),
        var(--bg-alt);
      padding: 1rem 1.05rem 1.1rem;
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.7);
    }

    .card h3 {
      font-size: 0.98rem;
      margin-bottom: 0.45rem;
    }

    .card p {
      font-size: 0.86rem;
      color: var(--text-muted);
      line-height: 1.6;
    }

    .card-tag {
      font-size: 0.68rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--text-muted);
      margin-bottom: 0.45rem;
    }

    .card-highlight {
      border-color: rgba(68, 255, 210, 0.8);
      background: radial-gradient(
          circle at top right,
          rgba(68, 255, 210, 0.16),
          transparent 55%
        ),
        var(--bg-alt);
    }

    .card-list {
      list-style: none;
      margin-top: 0.55rem;
      display: flex;
      flex-direction: column;
      gap: 0.3rem;
      font-size: 0.84rem;
      color: var(--text-muted);
    }

    .card-list li::before {
      content: "• ";
      color: var(--accent);
    }

    /* How it works */

    .steps {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1.3rem;
    }

    .step-number {
      width: 26px;
      height: 26px;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.18);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
      margin-bottom: 0.5rem;
      background: radial-gradient(
          circle at top left,
          rgba(255, 179, 71, 0.45),
          transparent 60%
        ),
        rgba(5, 8, 22, 0.9);
    }

    .step-title {
      font-size: 0.95rem;
      margin-bottom: 0.3rem;
    }

    .step-text {
      font-size: 0.86rem;
      color: var(--text-muted);
      line-height: 1.6;
    }

    /* Referral strip */

    .referral-strip {
      margin-top: 3.25rem;
      border-radius: var(--radius-xl);
      border: 1px solid rgba(68, 255, 210, 0.65);
      padding: 1.1rem 1.1rem 1.15rem;
      background: radial-gradient(
          circle at top left,
          rgba(68, 255, 210, 0.2),
          transparent 60%
        ),
        radial-gradient(
          circle at bottom right,
          rgba(255, 179, 71, 0.22),
          transparent 55%
        ),
        #050816;
      display: flex;
      flex-direction: column;
      gap: 0.65rem;
      box-shadow: var(--shadow-soft);
    }

    .referral-strip-main {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 0.75rem;
      justify-content: space-between;
    }

    .referral-text {
      font-size: 0.94rem;
    }

    .referral-text span {
      background: linear-gradient(120deg, #ffb347, #ff4b81, #44ffd2);
      -webkit-background-clip: text;
      color: transparent;
      font-weight: 600;
    }

    .referral-note {
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    /* FAQ */

    .faq-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 1.1rem;
    }

    .faq-item {
      border-radius: 18px;
      border: 1px solid var(--border-subtle);
      padding: 0.8rem 0.9rem 0.9rem;
      background: rgba(11, 16, 32, 0.9);
    }

    .faq-q {
      font-size: 0.9rem;
      margin-bottom: 0.25rem;
    }

    .faq-a {
      font-size: 0.84rem;
      color: var(--text-muted);
      line-height: 1.6;
    }

    /* Footer */

    .site-footer {
      border-top: 1px solid rgba(35, 38, 58, 0.9);
      margin-top: 3.5rem;
      padding-top: 1.7rem;
      font-size: 0.78rem;
      color: var(--text-muted);
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 0.75rem;
      justify-content: space-between;
    }

    .footer-links {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .footer-links a {
      text-decoration: underline;
      text-decoration-style: dotted;
      text-underline-offset: 0.15rem;
    }

    @media (max-width: 960px) {
      .hero {
        grid-template-columns: minmax(0, 1fr);
      }

      .hero-right {
        order: -1;
      }

      .hero {
        gap: 2.2rem;
      }

      .section-grid,
      .steps,
      .faq-grid {
        grid-template-columns: minmax(0, 1fr);
      }

      .hero-meta {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 640px) {
      .shell {
        padding-inline: 1rem;
      }

      .hero {
        padding-top: 2rem;
      }

      .hero-meta {
        grid-template-columns: minmax(0, 1fr);
      }

      .referral-strip {
        padding: 0.95rem;
      }
    }
  </style>
</head>
<body>
  <div class="page">
    <!-- Header -->
    <header class="site-header">
      <div class="site-header-inner">
        <a href="#top" class="brand">
          <div class="brand-mark">HB</div>
          <div class="brand-text">
            <div class="brand-name">Human Blockchain</div>
            <div class="brand-tagline">
              Your Voice. Your Choice. Your Treasury.
            </div>
          </div>
        </a>
        <nav class="nav">
          <a href="#cookie-jar">Cookie Jar Economy</a>
          <a href="#human-blockchain">2-Scan PoD</a>
          <a href="#yam-jam">YAM JAM</a>
          <a href="#small-street">Small Street Applied</a>
          <a href="#faq">FAQ</a>
          <a href="#join" class="nav-cta">
            <span class="icon">✨</span>
            Join the Referral Network
          </a>
        </nav>
      </div>
    </header>

    <!-- Main -->
    <main id="top">
      <div class="shell">
        <!-- Hero -->
        <section class="hero" aria-labelledby="hero-title">
          <div class="hero-left">
            <div class="hero-pill">
              <span class="hero-pill-dot"></span>
              AI Mastered by Human Intelligence (HI)
            </div>
            <h1 class="hero-title" id="hero-title">
              A <span class="highlight">Human Blockchain</span> for the
              Cookie&nbsp;Jar Economy.
            </h1>
            <p class="hero-subtitle">
              In the Cookie Jar Economy, <b>speculation is a dirty word</b>.
              We seek certainty — verified by a <b>2-scan Proof-of-Delivery</b>
              between <b>You And Me</b>. Every confirmed delivery mints
              <b>XP (Experience Points)</b>, becomes <b>YAM JAM</b> rewards, and
              flows into a New World Penny marketplace on
              <b>Small Street Applied</b>.
            </p>

            <div class="hero-actions" id="join">
              <a href="#referral" class="btn btn-primary">
                <span class="icon">🚀</span>
                Enter HumanBlockchain.info Portal
              </a>
              <a href="#how-it-works" class="btn btn-ghost">
                <span class="icon">📋</span>
                See How the 2-Scan Works
              </a>
            </div>

            <div class="hero-meta" aria-label="Key system highlights">
              <div class="meta-card">
                <div class="meta-label">Currency</div>
                <div class="meta-value">YAM • 21,000 : 1 USD</div>
                <div class="meta-note">
                  Just Alternative Money — You And Me in every exchange.
                </div>
              </div>
              <div class="meta-card">
                <div class="meta-label">XP Ledger</div>
                <div class="meta-value">Sextillionths of a Penny</div>
                <div class="meta-note">
                  Scientific-notation XP, whole-penny redemption only.
                </div>
              </div>
              <div class="meta-card">
                <div class="meta-label">Clearinghouse</div>
                <div class="meta-value">United Citizens</div>
                <div class="meta-note">
                  A Visa/Mastercard alternative for Your Voice, Your Choice,
                  Your Treasury.
                </div>
              </div>
            </div>
          </div>

          <div class="hero-right" aria-hidden="false">
            <aside class="hero-panel">
              <div class="hero-panel-header">
                <div>
                  <div class="panel-title">2-Scan Proof of Delivery</div>
                  <div class="panel-subtitle">
                    One delivery. Two scans. A Human Blockchain event.
                  </div>
                </div>
                <div class="badge">
                  <span class="badge-dot"></span>
                  LIVE XP MINT
                </div>
              </div>

              <div class="panel-grid">
                <div class="panel-card">
                  <div class="panel-label">Scan #1 • Seller</div>
                  <div class="panel-value">You ship. You pledge.</div>
                  <div class="panel-chip-row">
                    <span class="chip highlight">3% Seller</span>
                    <span class="chip">10% Personal</span>
                  </div>
                  <div class="xp-line">
                    <span class="label">Trade credit</span>
                    <span class="value">
                      $10.30 → <span class="dim">XP ledger mint</span>
                    </span>
                  </div>
                </div>

                <div class="panel-card">
                  <div class="panel-label">Scan #2 • Buyer</div>
                  <div class="panel-value">You receive. You confirm.</div>
                  <div class="panel-chip-row">
                    <span class="chip highlight">7% Buyer</span>
                    <span class="chip">Social impact fund</span>
                  </div>
                  <div class="xp-line">
                    <span class="label">XP format</span>
                    <span class="value">
                      1.000 × 10<span class="dim">²³</span>
                      <span class="dim">XP</span>
                    </span>
                  </div>
                </div>
              </div>

              <div class="xp-line" style="margin-top: 0.75rem;">
                <span class="label">Expression</span>
                <span class="value">Human value, not LAUGH money</span>
              </div>

              <div class="panel-footer">
                <span>
                  <strong>2-scan</strong> closes the door on speculation and
                  opens a ledger of trust.
                </span>
                <a href="#small-street">View Small Street Applied →</a>
              </div>
            </aside>
          </div>
        </section>

        <!-- Cookie Jar Economy -->
        <section
          class="section"
          id="cookie-jar"
          aria-labelledby="cookie-jar-title"
        >
          <div class="section-header">
            <div class="section-kicker">Cookie Jar Economy</div>
            <h2 class="section-title" id="cookie-jar-title">
              Where speculation is a dirty word — and certainty is wealth.
            </h2>
            <p class="section-description">
              Instead of chasing charts and whales, the Cookie Jar Economy
              rewards <b>human action</b>. Every confirmed delivery mints XP,
              every XP is tied to a <b>New World Penny</b>, and every penny is
              accountable to the community treasury.
            </p>
          </div>

          <div class="section-grid">
            <article class="card card-highlight">
              <div class="card-tag">01 • No Speculation</div>
              <h3>Value from deliveries, not volatility.</h3>
              <p>
                No leverage. No betting. No “number go up.” Value appears only
                when goods or services are actually delivered between You And
                Me. Each 2-scan Proof-of-Delivery event mints XP into the
                shared ledger.
              </p>
              <ul class="card-list">
                <li>XP is earned only through action.</li>
                <li>Every event is time-stamped and geo-verified.</li>
                <li>Every penny is accounted for in Member Treasury.</li>
              </ul>
            </article>

            <article class="card">
              <div class="card-tag">02 • XP Ledger</div>
              <h3>Experience Points in scientific notation.</h3>
              <p>
                XP is measured in sextillionths of a penny — displayed in
                scientific notation for integer-safe accounting. “Dust” under
                one penny stays as XP until it grows into whole-penny value.
              </p>
              <ul class="card-list">
                <li>Dust XP stays in a no-spend ledger.</li>
                <li>Whole pennies accrue before redemption.</li>
                <li>Community can see residual XP for everyone.</li>
              </ul>
            </article>

            <article class="card">
              <div class="card-tag">03 • Member Treasury</div>
              <h3>Your Voice. Your Choice. Your Treasury.</h3>
              <p>
                United Citizens operates as a cooperative clearinghouse — a
                Visa/Mastercard alternative where patronage flow is governed by
                members, not banks or whales.
              </p>
              <ul class="card-list">
                <li>10% patronage on confirmed trade value.</li>
                <li>Redemption cycles anchored to calendar dates.</li>
                <li>XP → YAM → fiat/crypto under cooperative rules.</li>
              </ul>
            </article>
          </div>
        </section>

        <!-- Human Blockchain / 2-Scan -->
        <section
          class="section"
          id="human-blockchain"
          aria-labelledby="human-blockchain-title"
        >
          <div class="section-header">
            <div class="section-kicker">Human Blockchain</div>
            <h2 class="section-title" id="human-blockchain-title">
              2-scan Proof-of-Delivery between You And Me.
            </h2>
            <p class="section-description">
              A true “block” in the Human Blockchain is not mined by machines;
              it’s earned when two humans agree: “Delivery happened.” The
              seller scans first. The buyer confirms. Together, they mint a
              trust event into the ledger.
            </p>
          </div>

          <div class="steps" id="how-it-works">
            <article class="card">
              <div class="step-number">1</div>
              <h3 class="step-title">Scan #1 — Seller</h3>
              <p class="step-text">
                The seller places a YAM-is-On voucher or hang tag on the
                delivery and scans it before shipment. This marks the pledge:
                <b>$10.30 in trade credit</b> is now in motion — not yet money,
                but a <b>promise to pay</b> backed by community rules.
              </p>
            </article>

            <article class="card">
              <div class="step-number">2</div>
              <h3 class="step-title">Scan #2 — Buyer</h3>
              <p class="step-text">
                Upon receiving the delivery, the buyer scans the same voucher.
                This confirms the event in time and space (timestamp + geo
                location). Only then does the XP ledger mint the full
                experience credit.
              </p>
            </article>

            <article class="card">
              <div class="step-number">3</div>
              <h3 class="step-title">Ledger Event — XP Mint</h3>
              <p class="step-text">
                The Member Treasury records:
                <b>7% buyer rebate</b>, <b>3% seller patronage</b> (or 10%
                personal), and a New World Penny of XP split in sextillionths.
                Nothing is speculative. Everything is traceable. Every step is
                governed by FAITH values — Fair, Accepting, Insightful,
                Transparent, Humble.
              </p>
            </article>
          </div>
        </section>

        <!-- YAM JAM -->
        <section class="section" id="yam-jam" aria-labelledby="yam-jam-title">
          <div class="section-header">
            <div class="section-kicker">YAM JAM</div>
            <h2 class="section-title" id="yam-jam-title">
              Just Alternative Money in action-based rewards.
            </h2>
            <p class="section-description">
              YAM means “You And Me.” YAM JAM is what happens when XP from
              confirmed deliveries flows into <b>leaderboards, rewards, and
              community treasuries</b>. Instead of hoarding, YAM JAM celebrates
              participation.
            </p>
          </div>

          <div class="section-grid">
            <article class="card card-highlight">
              <div class="card-tag">Action → XP</div>
              <h3>Every scan is a story of value.</h3>
              <p>
                Each hang-tag scan represents a human story: a craftsman, a
                merchant, a neighbor, a social impact project. YAM JAM turns
                those stories into XP and showcases them on public leaderboards.
              </p>
              <ul class="card-list">
                <li>Top contributors rise through participation.</li>
                <li>No pay-to-win — only deliver-to-win.</li>
                <li>XP is a record of what you’ve done, not what you own.</li>
              </ul>
            </article>

            <article class="card">
              <div class="card-tag">21,000 : 1</div>
              <h3>Fixed YAM peg to USD.</h3>
              <p>
                YAM is pegged at <b>21,000 YAM per 1 USD</b> in a 2:6:8 decimal
                correlation model (USD:YAM:BTC). This anchors YAM JAM to an
                easy-to-understand micro-unit environment while keeping XP in a
                no-spend ledger until maturity.
              </p>
              <ul class="card-list">
                <li>Clear conversion path: XP → YAM → fiat/crypto.</li>
                <li>90% XP reserves, 10% fiat/crypto exposure.</li>
                <li>Whole-penny logic for redemption events.</li>
              </ul>
            </article>

            <article class="card">
              <div class="card-tag">Leaderboards</div>
              <h3>Human value, visible to everyone.</h3>
              <p>
                YAM JAM leaderboards invite members to measure success not by
                balance sheets but by contributions — how many deliveries you’ve
                confirmed, how many people you’ve helped onboard, how much
                social impact you’ve funded.
              </p>
              <ul class="card-list">
                <li>XP ranks craftspeople, sellers, and patrons.</li>
                <li>Referral XP for building the human blockchain.</li>
                <li>LAUGH Money events celebrate top contributors.</li>
              </ul>
            </article>
          </div>
        </section>

        <!-- Small Street Applied -->
        <section
          class="section"
          id="small-street"
          aria-labelledby="small-street-title"
        >
          <div class="section-header">
            <div class="section-kicker">Small Street Applied</div>
            <h2 class="section-title" id="small-street-title">
              The New World Penny marketplace for demand and pledges.
            </h2>
            <p class="section-description">
              SmallStreet.app is where the theory becomes practice. It’s the
              marketplace where <b>demand and pledges take centerstage</b>,
              tracking every 2-scan delivery as XP in a <b>human-first wallet</b>
              connected to the HumanBlockchain.info referral network.
            </p>
          </div>

          <div class="section-grid">
            <article class="card card-highlight">
              <div class="card-tag">Marketplace</div>
              <h3>Every home, a Small Street.</h3>
              <p>
                Every household becomes a micro-marketplace, turning unwanted
                items and new creations into trade-credit deliveries. Each item
                that moves with a YAM-is-On voucher adds another story to the
                human ledger.
              </p>
              <ul class="card-list">
                <li>Estate items, crafts, services, and more.</li>
                <li>Proof-of-Delivery vouchers on every shipment.</li>
                <li>XP wallet for every buyer and seller.</li>
              </ul>
            </article>

            <article class="card">
              <div class="card-tag">Wallet</div>
              <h3>XP-first, money-later wallet design.</h3>
              <p>
                Small Street stores XP, not just balances. Until August 31
                reconciliation dates, funds don’t move — only XP does. This
                keeps regulators at bay while the community builds a deep ledger
                of trust and delivery history.
              </p>
              <ul class="card-list">
                <li>2-scan events mint XP in real time.</li>
                <li>8–12 week XP maturity window.</li>
                <li>Redemption only after XP becomes whole-penny value.</li>
              </ul>
            </article>

            <article class="card">
              <div class="card-tag">Portal Links</div>
              <h3>Linked to HumanBlockchain.info gateway.</h3>
              <p>
                Small Street Applied connects directly into the
                HumanBlockchain.info portal and referral network, ensuring every
                new buyer, seller, or patron is anchored to the same Member
                Treasury rules and FAITH-based operating system.
              </p>
              <ul class="card-list">
                <li>Onboarding via QRtiger v-card &amp; Discord.</li>
                <li>Referral tracking for YAM’er, MEGAvoter, Patron levels.</li>
                <li>Unified XP + YAM JAM identity across the ecosystem.</li>
              </ul>
            </article>
          </div>
        </section>

        <!-- Referral / Portal Strip -->
        <section class="referral-strip" id="referral">
          <div class="referral-strip-main">
            <div class="referral-text">
              Join the
              <span>HumanBlockchain.info referral network</span> and help build
              the United Citizens clearinghouse — a Visa/Mastercard alternative
              guided by 2-scan Proof-of-Delivery and cooperative patronage.
            </div>
            <div>
              <a href="#join" class="btn btn-primary">
                <span class="icon">🔗</span>
                Get Your Referral Link
              </a>
            </div>
          </div>
          <div class="referral-note">
            Start by accepting a Discord Gracebook invite, linking your QRtiger
            v-card and payment rail (Venmo/PayPal/FonePay), then choosing your
            role: YAM’er (free), MEGAvoter ($12/year), or Patron. Every
            confirmed delivery you touch becomes part of the Human Blockchain.
          </div>
        </section>

        <!-- FAQ -->
        <section class="section" id="faq" aria-labelledby="faq-title">
          <div class="section-header">
            <div class="section-kicker">FAQ</div>
            <h2 class="section-title" id="faq-title">
              Quick answers about the Human Blockchain.
            </h2>
          </div>

          <div class="faq-grid">
            <article class="faq-item">
              <h3 class="faq-q">Is this a cryptocurrency or a token sale?</h3>
              <p class="faq-a">
                No. The Cookie Jar Economy is a <b>promise-to-pay</b> system
                anchored in XP and YAM JAM. XP is minted only when a 2-scan
                Proof-of-Delivery event is confirmed. YAM is a community
                currency pegged at 21,000:1 USD and governed through cooperative
                patronage — not speculative trading.
              </p>
            </article>

            <article class="faq-item">
              <h3 class="faq-q">
                What makes this a “Human Blockchain” instead of a traditional
                blockchain?
              </h3>
              <p class="faq-a">
                A “block” here is a <b>human trust event</b>: You And Me
                confirming a delivery together. Technology (QR codes, GPS,
                timestamps, ledgers) simply supports what humans decide. AI is
                <b>mastered by Human Intelligence (HI)</b>, not the other way
                around.
              </p>
            </article>

            <article class="faq-item">
              <h3 class="faq-q">
                How does HumanBlockchain.info relate to SmallStreet.app?
              </h3>
              <p class="faq-a">
                HumanBlockchain.info is the <b>gateway and referral hub</b>,
                organizing members, roles, and patronage rules. SmallStreet.app
                is the <b>marketplace and wallet layer</b>, where 2-scan
                deliveries are tracked as XP and YAM JAM rewards.
              </p>
            </article>

            <article class="faq-item">
              <h3 class="faq-q">Who controls the Member Treasury?</h3>
              <p class="faq-a">
                The Member Treasury is stewarded by <b>United Citizens</b>
                through cooperative frameworks, with XP and YAM flows designed
                around <b>FAITH values</b>: Fair, Accepting, Insightful,
                Transparent, Humble. Over time, this structure evolves toward
                more on-chain cooperative and DAO-style governance.
              </p>
            </article>
          </div>
        </section>

        <!-- Footer -->
        <footer class="site-footer">
          <div>
            © <span id="year"></span> HumanBlockchain.info • A United Citizens /
            Small Street Applied experiment in the Cookie Jar Economy.
          </div>
          <div class="footer-links">
            <a href="#cookie-jar">Cookie Jar Overview</a>
            <a href="#human-blockchain">2-Scan PoD</a>
            <a href="#yam-jam">YAM JAM</a>
            <a href="#small-street">Small Street Applied</a>
          </div>
        </footer>
      </div>
    </main>
  </div>

  <script>
    // Set current year in footer
    document.getElementById("year").textContent =
      new Date().getFullYear().toString();
  </script>
</body>
</html>


