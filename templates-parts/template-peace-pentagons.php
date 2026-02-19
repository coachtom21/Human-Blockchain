<?php 
/**
 * 
 * Template Name: Peace Pentagons
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Peace Pentagon • Five Branches of the Human Blockchain</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="The Peace Pentagon is the five-branch governance map for the United Citizens movement. Each $10 YAM JAM allocates $4 to these branches, funding planning, budget, media, distribution, and membership work." />
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
      width: 28px;
      height: 28px;
      border-radius: 999px;
      border: 1px solid var(--border-subtle);
      background: radial-gradient(circle at 30% 0%, var(--accent) 0, #140b30 45%, #050816 100%);
      box-shadow: 0 0 18px rgba(255, 179, 71, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.65rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      overflow: hidden;
    }
    
    .logo-icon img {
      height: 100%;
      object-fit: contain;
      border-radius: 999px;
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

    .pentagon-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1rem;
    }

    .branch-card {
      border-radius: var(--radius-xl);
      background: rgba(5, 9, 32, 0.98);
      border: 1px solid rgba(42, 53, 110, 0.9);
      padding: 0.9rem 0.95rem 0.8rem;
      font-size: 0.86rem;
      color: var(--text-muted);
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.75);
    }

    .branch-name {
      font-size: 0.96rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.15rem;
    }

    .branch-tag {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.16em;
      color: var(--accent-2);
      margin-bottom: 0.35rem;
    }

    ul {
      margin-top: 0.3rem;
      padding-left: 1.1rem;
      font-size: 0.86rem;
    }

    li {
      margin-bottom: 0.22rem;
    }

    .inline-highlight {
      color: var(--accent);
      font-weight: 500;
    }

    .diagram {
      border-radius: var(--radius-xl);
      background: radial-gradient(circle at top left, rgba(255, 179, 71, 0.18), rgba(5, 8, 28, 0.96));
      border: 1px solid rgba(255, 255, 255, 0.12);
      padding: 1rem 1rem 0.9rem;
      font-size: 0.88rem;
      color: var(--text-muted);
      margin-bottom: 1rem;
    }

    .diagram h3 {
      font-size: 0.98rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.35rem;
    }

    .diagram-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.3rem 0;
      border-bottom: 1px dashed rgba(255, 255, 255, 0.08);
    }

    .diagram-row:last-child {
      border-bottom: none;
    }

    .diagram-label {
      display: flex;
      flex-direction: column;
      gap: 0.06rem;
    }

    .diagram-label span:first-child {
      font-weight: 500;
      color: var(--text-main);
    }

    .diagram-note {
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    .diagram-val {
      font-size: 0.86rem;
      text-align: right;
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

    .grid-2 {
      display: grid;
      grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
      gap: 1.1rem;
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

    @media (max-width: 960px) {
      .pentagon-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.25rem;
      }
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
      .pentagon-card {
        padding: 1rem 0.9rem;
      }
      .pentagon-title {
        font-size: 0.95rem;
      }
    }

    @media (max-width: 720px) {
      .pentagon-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 1rem;
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
      .pentagon-card {
        padding: 0.95rem 0.85rem;
        border-radius: 16px;
      }
      .pentagon-title {
        font-size: 0.9rem;
      }
      .pentagon-desc {
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
      .pentagon-card {
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
      .pentagon-card {
        min-height: 44px;
      }
    }
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>
<body>
  <div class="page">
    <header>
      <div class="logo-block">
        <?php 
        $logo = hb_get_site_logo( 'medium', array( 'class' => 'logo-icon' ) );
        // If logo is image, use it; otherwise use fallback "HB" text
        if ( strpos( $logo, '<img' ) === false ) {
            echo '<div class="logo-icon">HB</div>';
        } else {
            echo $logo;
        }
        ?>
        <div class="logo-text">
          <div class="logo-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></div>
          <div class="logo-sub">Your Voice. Your Choice. Your Treasury.</div>
        </div>
      </div>
      <div class="header-right">
        <div class="breadcrumb">
          <a href="home">Home</a> · <span>Peace Pentagon</span>
        </div>
        <a href="home" class="back-link">
          <span>⟵</span> Back to HumanBlockchain.info
        </a>
      </div>
    </header>

    <main>
      <!-- HERO -->
      <section class="hero">
        <div class="hero-tag">Five-branch map</div>
        <h1 class="hero-heading">
          The <span class="hero-highlight">Peace Pentagon</span> is how the $4 social fund learns to move.
        </h1>
        <p class="hero-subtitle">
          Every confirmed 2-scan Proof-of-Delivery mints a <strong>$10 YAM JAM trade credit</strong>
          (210,000 YAM at 21,000:1). That $10 is always split:
          <strong>$5 to the buyer</strong>, <strong>$4 to the Peace Pentagon social impact fund</strong>,
          and <strong>$1 to patronage</strong> with <strong>$0.50 guaranteed to the seller</strong>.  
          The Peace Pentagon is where the <strong>$4 social slice</strong> gets its marching orders.
        </p>
        <div class="hero-meta">
          <div class="hero-chip"><span>Social Fund</span>: $4 per YAM JAM = 84,000 YAM</div>
          <div class="hero-chip"><span>Branches</span>: Planning · Budget · Media · Distribution · Membership</div>
          <div class="hero-chip"><span>Era</span>: Built for the 21,000:1 peg to May 17, 2030</div>
        </div>
      </section>

      <!-- SECTION: DIAGRAM -->
      <section>
        <div class="section-label">Flow</div>
        <div class="section-title">How $10 moves through YAM JAM + Peace Pentagon</div>
        <p class="section-subtitle">
          Before we zoom into each branch, here’s the whole 5 / 4 / 1 pattern at a glance.
        </p>

        <div class="diagram">
          <h3>Every confirmed YAM JAM ($10 = 210,000 YAM) becomes:</h3>

          <div class="diagram-row">
            <div class="diagram-label">
              <span>$5 — Buyer rebate</span>
              <span class="diagram-note">Rewarding the voter/consumer who confirmed 2-scan PoD.</span>
            </div>
            <div class="diagram-val">
              <div>105,000 YAM</div>
              <div class="diagram-note">50% of YAM JAM</div>
            </div>
          </div>

          <div class="diagram-row">
            <div class="diagram-label">
              <span>$4 — Peace Pentagon social fund</span>
              <span class="diagram-note">
                Fuel for Planning, Budget, Media, Distribution, Membership work.
              </span>
            </div>
            <div class="diagram-val">
              <div>84,000 YAM</div>
              <div class="diagram-note">40% of YAM JAM</div>
            </div>
          </div>

          <div class="diagram-row">
            <div class="diagram-label">
              <span>$1 — Patronage</span>
              <span class="diagram-note">
                Linked to seller performance and POC-level cooperative rewards.
              </span>
            </div>
            <div class="diagram-val">
              <div>21,000 YAM</div>
              <div class="diagram-note">10% of YAM JAM</div>
            </div>
          </div>
        </div>

        <p class="section-subtitle">
          The Peace Pentagon never touches the whole $10. It only ever coordinates the **$4 social fund** — and does so
          in public, via XP, YAM, and New World Penny accounting.
        </p>
      </section>

      <!-- SECTION: BRANCH CARDS -->
      <section>
        <div class="section-label">Branches</div>
        <div class="section-title">Five roles, one peace economy</div>
        <p class="section-subtitle">
          When you register and accept your first YAM-is-On assignment, you are placed into **one** of these branches.
          That becomes your “home base” for how you help direct the $4 slice.
        </p>

        <div class="pentagon-grid">
          <div class="branch-card">
            <div class="branch-tag">Branch 1</div>
            <div class="branch-name">Planning</div>
            <p>
              Planning connects the dots between **where people are** and **where YAM-is-On tags need to go**.
            </p>
            <ul>
              <li>Designs new <strong>POCs</strong> and pilot regions.</li>
              <li>Identifies artisans, sellers, and last-mile partners to onboard.</li>
              <li>Uses $4 social fund data to map under-served routes and regions.</li>
            </ul>
            <p style="margin-top:0.25rem;">
              If you’re in Planning, every YAM JAM you help route makes the Peace Pentagon more **intelligent over time**.
            </p>
          </div>

          <div class="branch-card">
            <div class="branch-tag">Branch 2</div>
            <div class="branch-name">Budget</div>
            <p>
              Budget is the **nerve center** for numbers and solvency at the 21,000:1 peg.
            </p>
            <ul>
              <li>Tracks how the $4 social fund is split across projects and regions.</li>
              <li>Monitors XP, YAM, and New World Penny reserves for each branch.</li>
              <li>Verifies that the 5 / 4 / 1 pattern is honored before fiat is moved.</li>
            </ul>
            <p style="margin-top:0.25rem;">
              If you’re in Budget, you make sure United Citizens never loses the plot of **where every $10 YAM JAM goes**.
            </p>
          </div>

          <div class="branch-card">
            <div class="branch-tag">Branch 3</div>
            <div class="branch-name">Media</div>
            <p>
              Media tells the story of **real humans** behind the ledger.
            </p>
            <ul>
              <li>Turns dry numbers into narrative: who got the $5, $4, $1, and why.</li>
              <li>Highlights top-performing POCs, sellers, and routes as heroes — not just ratings.</li>
              <li>Explains YAM JAM, XP, and the 5 / 4 / 1 split to new audiences.</li>
            </ul>
            <p style="margin-top:0.25rem;">
              If you’re in Media, your job is to make the Human Blockchain **feel human**.
            </p>
          </div>

          <div class="branch-card">
            <div class="branch-tag">Branch 4</div>
            <div class="branch-name">Distribution</div>
            <p>
              Distribution is where the **rubber meets the road** — literally.
            </p>
            <ul>
              <li>Supports local hubs, drivers, and last-mile partners.</li>
              <li>Ensures YAM-is-On measuring sticks are available where people actually ship.</li>
              <li>Uses the $4 social fund to improve routes, safety, and logistics access.</li>
            </ul>
            <p style="margin-top:0.25rem;">
              If you’re in Distribution, your superpower is turning the $4 slice into **better real-world movement**.
            </p>
          </div>

          <div class="branch-card">
            <div class="branch-tag">Branch 5</div>
            <div class="branch-name">Membership</div>
            <p>
              Membership makes sure the Peace Pentagon is **people-first**, not metric-first.
            </p>
            <ul>
              <li>Onboards new members into Buyer POCs and Seller POCs.</li>
              <li>Helps resolve disputes and edge cases around PoD and reward flows.</li>
              <li>Coordinates education around XP, YAM, and the 8–12 week maturity window.</li>
            </ul>
            <p style="margin-top:0.25rem;">
              If you’re in Membership, you keep the movement grounded in **Fair, Accepting, Insightful, Transparent, Humble** behavior.
            </p>
          </div>
        </div>
      </section>

      <!-- SECTION: CONNECTION TO POC & SELLER $0.50 -->
      <section>
        <div class="section-label">Synergy</div>
        <div class="section-title">How Peace Pentagon, POCs, and $0.50 seller rewards interlock</div>
        <p class="section-subtitle">
          The Peace Pentagon doesn’t stand alone. It works in sync with <strong>Patron Organizing Communities (POCs)</strong> and the
          **$0.50 per delivery** that always reaches the seller.
        </p>

        <div class="grid-2">
          <div class="diagram">
            <h3>One delivery, three dimensions</h3>
            <div class="diagram-row">
              <div class="diagram-label">
                <span>Buyer</span>
                <span class="diagram-note">“Is this PoD?” + “Final Destination?”</span>
              </div>
              <div class="diagram-val">
                <div>$5 rebate</div>
                <div class="diagram-note">105,000 YAM</div>
              </div>
            </div>
            <div class="diagram-row">
              <div class="diagram-label">
                <span>Peace Pentagon</span>
                <span class="diagram-note">Planning · Budget · Media · Distribution · Membership</span>
              </div>
              <div class="diagram-val">
                <div>$4 fund</div>
                <div class="diagram-note">84,000 YAM</div>
              </div>
            </div>
            <div class="diagram-row">
              <div class="diagram-label">
                <span>POCs & Seller</span>
                <span class="diagram-note">Seller POC + group patronage pools</span>
              </div>
              <div class="diagram-val">
                <div>$1 patronage</div>
                <div class="diagram-note">$0.50 to seller, $0.50 to group</div>
              </div>
            </div>
          </div>

          <div class="callout">
            <strong>Read this slowly:</strong>  
            Every time a YAM-is-On measuring stick completes a 2-scan PoD:
            <ul style="margin-top:0.35rem;">
              <li>The <strong>buyer</strong> gets a $5 share of the future.</li>
              <li>The <strong>Peace Pentagon</strong> gets $4 to grow the movement’s capacity.</li>
              <li>The <strong>seller</strong> gets $0.50 — every single time — plus shared patronage benefits via their POC.</li>
            </ul>
            In that pattern, the Peace Pentagon is never an overhead cost. It’s the **coordination layer** that makes sure $4
            doesn’t vanish into a black box but lands in visible, accountable work.
          </div>
        </div>

        <div class="cta-row">
          <button class="btn-ghost" onclick="window.location.href='united-citizens.html';">
            Return to the United Citizens story ⟶
          </button>
          <button class="btn-ghost" onclick="window.location.href='how-it-works.html';">
            See the full YAM JAM flow ⟶
          </button>
          <button class="btn-ghost" onclick="window.location.href='faq.html';">
            Read the FAQ ⟶
          </button>
        </div>
      </section>
    </main>

    <footer>
      <div>© <span id="year"></span> HumanBlockchain.info · Peace Pentagon</div>
      <div><a href="#top">Back to top</a></div>
    </footer>
  </div>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>


