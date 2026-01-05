<?php
/**
 * Template Name: United Citizens
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>United Citizens • Movement, Not Entity</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="United Citizens is a movement, not a corporation — a spirit of voters and consumers who use YAM-is-On measuring sticks, 2-scan Proof-of-Delivery, and YAM JAM 5/4/1 allocations to control what counts as wealth." />
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

    .hero {
      border-radius: 24px;
      background: radial-gradient(circle at top, rgba(255, 179, 71, 0.18), rgba(7, 10, 32, 0.97));
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: var(--shadow-soft);
      padding: 1.8rem 1.6rem 1.5rem;
      margin-bottom: 2.4rem;
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
      margin-bottom: 0.4rem;
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

    section {
      margin-bottom: 2.4rem;
    }

    .section-label {
      font-size: 0.76rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
      margin-bottom: 0.35rem;
    }

    .section-title {
      font-size: 1.22rem;
      font-weight: 600;
      margin-bottom: 0.3rem;
    }

    .section-subtitle {
      font-size: 0.9rem;
      color: var(--text-muted);
      max-width: 42rem;
      margin-bottom: 0.7rem;
    }

    .grid-2 {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 1.1rem;
    }

    .card {
      border-radius: var(--radius-xl);
      background: rgba(5, 9, 32, 0.98);
      border: 1px solid rgba(42, 53, 110, 0.9);
      padding: 0.9rem 1rem 0.8rem;
      font-size: 0.88rem;
      color: var(--text-muted);
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.75);
    }

    .card-title {
      font-size: 0.96rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.35rem;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      padding: 0.14rem 0.5rem;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 0.7rem;
      margin-bottom: 0.35rem;
      color: var(--accent-2);
      text-transform: uppercase;
      letter-spacing: 0.16em;
    }

    ul {
      margin-top: 0.35rem;
      padding-left: 1.1rem;
      font-size: 0.86rem;
    }

    li {
      margin-bottom: 0.25rem;
    }

    .inline-highlight {
      color: var(--accent);
      font-weight: 500;
    }

    .quote-block {
      margin-top: 0.7rem;
      padding: 0.55rem 0.7rem;
      border-left: 3px solid rgba(255, 179, 71, 0.7);
      background: rgba(5, 8, 24, 0.95);
      border-radius: 0 12px 12px 0;
      font-size: 0.9rem;
      color: var(--text-muted);
    }

    .quote-block strong {
      color: var(--accent);
    }

    .callout {
      margin-top: 0.9rem;
      padding: 0.7rem 0.9rem;
      border-radius: 12px;
      background: rgba(9, 13, 39, 0.9);
      border: 1px dashed rgba(255, 255, 255, 0.12);
      font-size: 0.85rem;
      color: var(--text-muted);
    }

    .callout strong {
      color: var(--accent-2);
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

    @media (max-width: 900px) {
      .grid-2 {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.5rem;
      }
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }
      .header-right {
        align-items: flex-start;
        width: 100%;
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
      .card {
        padding: 0.95rem 0.85rem;
        border-radius: 16px;
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
          <a href="home">Home</a> · <span>United Citizens</span>
        </div>
        <a href="home" class="back-link">
          <span>⟵</span> Back to HumanBlockchain.info
        </a>
      </div>
    </header>

    <main>
      <!-- HERO -->
      <section class="hero">
        <div class="hero-tag">Movement, not entity</div>
        <h1 class="hero-heading">
          United Citizens is a <span class="hero-highlight">spirit</span> of voters and consumers taking back wealth.
        </h1>
        <p class="hero-subtitle">
          United Citizens is not a corporation, PAC, or political party. It’s a **shared attitude**:
          if a delivery doesn’t carry a <strong>YAM-is-On measuring stick</strong> and complete a
          <strong>2-scan Proof-of-Delivery</strong>, then it doesn’t count as wealth in our economy — no matter what
          a balance sheet says.  
          When it does, we mint a <strong>$10 YAM JAM trade credit</strong>, split as
          <strong>$5 buyer / $4 Peace Pentagon / $1 patronage</strong> with <strong>$0.50 to the seller</strong>.
        </p>
        <div class="hero-meta">
          <div class="hero-chip"><span>Core Peg</span>: 21,000 YAM = 1 USD (build to May 17, 2030)</div>
          <div class="hero-chip"><span>Unit</span>: 1 YAM JAM = $10 = 210,000 YAM</div>
          <div class="hero-chip"><span>Ethos</span>: You And Me, Just Alternative Money</div>
        </div>
      </section>

      <!-- SECTION 1: WHAT UNITED CITIZENS IS / IS NOT -->
      <section>
        <div class="section-label">Definition</div>
        <div class="section-title">What United Citizens is — and what it isn’t</div>
        <p class="section-subtitle">
          Think of United Citizens as **Wi-Fi for civic power**. It’s everywhere humans scan YAM-is-On tags and confirm
          deliveries into the Human Blockchain.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="badge">What it is</div>
            <div class="card-title">A movement of spenders, not spectators</div>
            <p>
              United Citizens is:
            </p>
            <ul>
              <li><strong>A culture</strong> where buyers and sellers insist on YAM-is-On measuring sticks.</li>
              <li><strong>A practice</strong> of 2-scan PoD — two humans confirming each delivery.</li>
              <li><strong>A metric</strong> where each PoD mints a $10 YAM JAM split 5 / 4 / 1 with $0.50 to the seller.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              If you scan, confirm, and care where the $10 goes, you’re already acting as United Citizens.
            </p>
          </div>

          <div class="card">
            <div class="badge">What it isn’t</div>
            <div class="card-title">Not a corporate or political entity</div>
            <p>
              United Citizens is **not**:
            </p>
            <ul>
              <li>Not a centralized company with shareholders.</li>
              <li>Not a traditional political party or SuperPAC.</li>
              <li>Not a “token project” chasing speculation.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              It lives **inside your choices** and **inside the ledger** — not in a legal boilerplate. The legal entities
              (MSBs, cooperatives, vendors) exist to **serve the movement**, not define it.
            </p>
          </div>
        </div>

        <div class="quote-block">
          <strong>Mantra:</strong> “We are voters and consumers. We decide what counts as wealth.”
        </div>
      </section>

      <!-- SECTION 2: HOW UNITED CITIZENS USES YAM JAM -->
      <section>
        <div class="section-label">Mechanism</div>
        <div class="section-title">How YAM JAM turns scans into influence</div>
        <p class="section-subtitle">
          United Citizens doesn’t ask for permission from banks or platforms. It just **redefines the scoreboard**.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="badge">YAM-is-On</div>
            <div class="card-title">Measuring sticks of trust</div>
            <p>
              Every YAM-is-On tag declares:
            </p>
            <ul>
              <li>“This delivery is part of the United Citizens economy.”</li>
              <li>“We want <strong>YAM JAM</strong>, not just tracking numbers.”</li>
              <li>“We accept only **You And Me, Just Alternative Money** as the first measurement.”</li>
            </ul>
            <p style="margin-top:0.35rem;">
              Until the tag is scanned by both seller and buyer, the movement treats that shipment as **unverified**.
            </p>
          </div>

          <div class="card">
            <div class="badge">YAM JAM 5 / 4 / 1</div>
            <div class="card-title">Where the $10 actually goes</div>
            <p>
              For each confirmed 2-scan PoD:
            </p>
            <ul>
              <li><strong>$5</strong> — buyer rebate (voter/consumer reward).</li>
              <li><strong>$4</strong> — Peace Pentagon social impact fund (5 branches).</li>
              <li><strong>$1</strong> — patronage to POCs and seller performance.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              From that $1 patronage, <strong>$0.50</strong> goes directly to the <strong>seller</strong>  
              for this delivery. The remaining $0.50 supports POC and treasury-level cooperative rewards.
            </p>
          </div>
        </div>

        <div class="callout">
          <strong>Key idea:</strong> United Citizens is the agreement that **every $10 YAM JAM must be auditable** —  
          $5 back to the buyer, $4 into Peace Pentagon work, $1 into patronage with $0.50 guaranteed to the seller.
        </div>
      </section>

      <!-- SECTION 3: GLOBAL GRID (POCs, PEACE PENTAGON, ROLES) -->
      <section>
        <div class="section-label">Global grid</div>
        <div class="section-title">From one scan to a global network</div>
        <p class="section-subtitle">
          Every registration and first scan is treated as a **moment of serendipity**. That moment locks in your place in a
          global lattice of POCs and Peace Pentagon branches.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="badge">POC Grids</div>
            <div class="card-title">30-person pods for local power</div>
            <p>
              When you step into United Citizens:
            </p>
            <ul>
              <li>You are mapped into a <strong>Buyer POC</strong> (30-person pod, often local).</li>
              <li>If you choose to sell or coach, you join a <strong>Seller POC</strong> (global cell of artisans/makers).</li>
              <li>Each 2-scan PoD in your POC feeds XP, YAM, and New World Pennies back into that pod.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              So that $10 YAM JAM is never abstract — it is always tied to **real people in a specific pod**.
            </p>
          </div>

          <div class="card">
            <div class="badge">Peace Pentagon</div>
            <div class="card-title">$4 social fund across five branches</div>
            <p>
              The <strong>$4 social impact fund</strong> from each YAM JAM is routed across:
            </p>
            <ul>
              <li><strong>Planning</strong> — designing new POCs & pilots.</li>
              <li><strong>Budget</strong> — managing reserves & solvency at the peg.</li>
              <li><strong>Media</strong> — amplifying United Citizens stories.</li>
              <li><strong>Distribution</strong> — supporting routes, hubs, drivers.</li>
              <li><strong>Membership</strong> — onboarding, support, dispute resolution.</li>
            </ul>
            <p style="margin-top:0.35rem;">
              Your first assignment locks you into one of these branches — that becomes your **home circle** in the movement.
            </p>
          </div>
        </div>
      </section>

      <!-- SECTION 4: HOW YOU PARTICIPATE -->
      <section>
        <div class="section-label">Participation</div>
        <div class="section-title">How Millennials & Gen Z step in</div>
        <p class="section-subtitle">
          No permission slips, no forms to mail. Just **choices + devices + tags**.
        </p>

        <div class="grid-2">
          <div class="card">
            <div class="badge">As a buyer</div>
            <div class="card-title">You’re already feeding the system</div>
            <ul>
              <li>Look for <strong>YAM-is-On</strong> tags when you buy or receive anything.</li>
              <li>When you scan, answer:
                <br />• “Is this Proof of Delivery?”  
                • “Is this the Final Destination?”</li>
              <li>Every “Yes / Yes” mints a YAM JAM and routes <strong>$5</strong> back to you (via XP → YAM → redemption).</li>
              <li>Your scan also sends <strong>$4</strong> into Peace Pentagon work and **$0.50** into the seller’s patronage line.</li>
            </ul>
          </div>

          <div class="card">
            <div class="badge">As a seller / last-mile human</div>
            <div class="card-title">You’re not invisible anymore</div>
            <ul>
              <li>Attach YAM-is-On measuring sticks to what you deliver.</li>
              <li>Scan when it leaves you; coach the final receiver to complete the second scan.</li>
              <li>For every confirmed PoD, you:
                <ul style="margin-top:0.25rem;">
                  <li>Help mint a $10 YAM JAM at 21,000:1.</li>
                  <li>Trigger the 5 / 4 / 1 split across buyer, Peace Pentagon, and patronage.</li>
                  <li>Receive <strong>$0.50</strong> directly from the patronage slice.</li>
                </ul>
              </li>
              <li>Over time, your reputation is measured in **confirmed YAM JAMs**, not just stars in an app.</li>
            </ul>
          </div>
        </div>

        <div class="callout">
          <strong>Bottom line:</strong> United Citizens is the invisible layer that appears **the instant you scan a YAM-is-On tag** and
          agree that a delivery is real. From that moment, every $10 YAM JAM is **your vote** for how the world’s wealth should be counted.
        </div>

        <div class="cta-row">
          <button class="btn-ghost" onclick="window.location.href='how-it-works.html';">
            See the full mechanics (How It Works) ⟶
          </button>
          <button class="btn-ghost" onclick="window.location.href='peace-pentagon.html';">
            Explore the Peace Pentagon branches ⟶
          </button>
          <button class="btn-ghost" onclick="window.location.href='faq.html';">
            Read the FAQ ⟶
          </button>
        </div>
      </section>
    </main>

    <footer>
      <div>© <span id="year"></span> HumanBlockchain.info · United Citizens Movement</div>
      <div><a href="#top">Back to top</a></div>
    </footer>
  </div>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>


