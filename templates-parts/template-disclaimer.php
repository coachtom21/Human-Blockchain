<?php
/**
 * Template Name: Disclaimer
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Disclaimer &amp; Non-Custodial Notice | <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
  <style>
    :root{
      --bg:#0b0f1a;
      --card:#111a2e;
      --text:#e9eefc;
      --muted:#b7c3e6;
      --line:rgba(233,238,252,.16);
      --accent:#7aa2ff;
      --warn:#ffd166;
      --ok:#7dffb2;
      --shadow: 0 20px 60px rgba(0,0,0,.45);
      --radius:18px;
      --max: 980px;
      font-synthesis-weight: none;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background:
        radial-gradient(900px 600px at 18% 12%, rgba(122,162,255,.18), transparent 55%),
        radial-gradient(900px 600px at 88% 30%, rgba(125,255,178,.10), transparent 50%),
        radial-gradient(900px 700px at 50% 88%, rgba(255,209,102,.10), transparent 55%),
        var(--bg);
      color:var(--text);
      font: 16px/1.55 system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
    }
    a{color:var(--accent); text-decoration:none}
    a:hover{text-decoration:underline}
    header{
      padding: 42px 20px 18px;
      max-width: var(--max);
      margin: 0 auto;
    }
    .brand{
      display:flex;
      gap:12px;
      align-items:center;
      flex-wrap:wrap;
    }
    .logo{
      width:40px;height:40px;border-radius:12px;
      background: linear-gradient(135deg, rgba(122,162,255,.9), rgba(125,255,178,.75));
      box-shadow: 0 10px 30px rgba(122,162,255,.22);
      position:relative;
      display:flex;
      align-items:center;
      justify-content:center;
      overflow:hidden;
    }
    .logo img{height:100%;object-fit:contain;border-radius:12px}
    h1{
      font-size: clamp(26px, 3.2vw, 40px);
      line-height:1.15;
      margin: 8px 0 6px;
      letter-spacing:-.02em;
    }
    .subtitle{
      color:var(--muted);
      max-width: 75ch;
      margin: 0;
    }
    main{
      max-width: var(--max);
      margin: 0 auto;
      padding: 0 20px 56px;
    }
    .card{
      background: linear-gradient(180deg, rgba(17,26,46,.92), rgba(17,26,46,.70));
      border: 1px solid rgba(233,238,252,.14);
      border-radius: var(--radius);
      padding: 22px;
      box-shadow: var(--shadow);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      overflow:hidden;
    }
    .card + .card{margin-top:16px}
    .pillrow{
      display:flex; flex-wrap:wrap; gap:10px;
      margin: 14px 0 0;
    }
    .pill{
      border:1px solid rgba(233,238,252,.18);
      background: rgba(233,238,252,.06);
      color: var(--muted);
      padding: 8px 10px;
      border-radius: 999px;
      font-size: 13px;
      letter-spacing:.01em;
    }
    .pill strong{color:var(--text); font-weight:650}
    .grid{
      display:grid;
      grid-template-columns: 1fr;
      gap:16px;
      margin-top: 16px;
    }
    @media (min-width: 880px){
      .grid{grid-template-columns: 1fr 1fr}
    }
    h2{
      margin: 0 0 8px;
      font-size: 18px;
      letter-spacing:-.01em;
    }
    p{margin: 0 0 12px}
    ul{
      margin: 0;
      padding-left: 18px;
      color: var(--muted);
    }
    li{margin: 8px 0}
    .callout{
      border:1px solid rgba(255,209,102,.32);
      background: rgba(255,209,102,.08);
      padding: 14px 14px;
      border-radius: 14px;
      color: var(--text);
    }
    .callout b{color: var(--warn)}
    .ok{
      border:1px solid rgba(125,255,178,.25);
      background: rgba(125,255,178,.07);
      border-radius: 14px;
      padding: 14px;
    }
    .ok b{color: var(--ok)}
    .hr{
      height:1px;
      background: var(--line);
      margin: 16px 0;
    }
    footer{
      max-width: var(--max);
      margin: 0 auto;
      padding: 18px 20px 40px;
      color: var(--muted);
      font-size: 13px;
    }
    code{
      background: rgba(233,238,252,.06);
      border: 1px solid rgba(233,238,252,.14);
      border-radius: 10px;
      padding: 2px 6px;
      color: var(--text);
      white-space: nowrap;
    }
    .meta{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
      margin-top: 10px;
      color: var(--muted);
      font-size: 13px;
    }
    .dot{opacity:.6}
    .note{
      border:1px solid rgba(122,162,255,.22);
      background: rgba(122,162,255,.08);
      border-radius: 14px;
      padding: 14px;
      color: var(--muted);
    }
    .note b{color:var(--text)}
    /* Top navigation */
    .disclaimer-nav{
      position:sticky;
      top:0;
      z-index:50;
      background: rgba(11,15,26,.9);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-bottom: 1px solid var(--line);
    }
    .disclaimer-nav .nav-inner{
      max-width: var(--max);
      margin: 0 auto;
      padding: 14px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
      flex-wrap: wrap;
    }
    .disclaimer-nav .brand{
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: var(--text);
    }
    .disclaimer-nav .brand:hover{color: var(--text); text-decoration: none}
    .disclaimer-nav .logo{
      width: 32px;
      height: 32px;
      flex-shrink: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border-radius: 10px;
      background: linear-gradient(135deg, rgba(122,162,255,.9), rgba(125,255,178,.75));
    }
    .disclaimer-nav .logo img{ height: 100%; object-fit: contain; border-radius: 10px; }
    .disclaimer-nav .brand-name{
      font-weight: 800;
      font-size: 15px;
      letter-spacing: .02em;
    }
    .disclaimer-nav .nav-links{
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .disclaimer-nav .nav-links a{
      color: var(--muted);
      font-size: 13px;
      font-weight: 600;
      padding: 8px 12px;
      border-radius: 10px;
      border: 1px solid transparent;
      transition: background .15s ease, color .15s ease;
    }
    .disclaimer-nav .nav-links a:hover{
      background: rgba(233,238,252,.06);
      color: var(--text);
    }
    .disclaimer-nav .nav-links a.current{
      color: var(--accent);
      border-color: rgba(122,162,255,.25);
    }
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>
<body>
  <nav class="disclaimer-nav" aria-label="Main navigation">
    <div class="nav-inner">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="logo">
          <?php echo function_exists( 'hb_get_site_logo' ) ? hb_get_site_logo( 'medium', array( 'class' => 'logo-img' ) ) : ''; ?>
        </span>
        <span class="brand-name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
      </a>
      <div class="nav-links">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>">Membership</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#how">How it works</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#faq">FAQs</a>
        <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">How It Works</a>
        <a href="<?php echo esc_url( home_url( '/proof-of-delivery' ) ); ?>">Proof of Delivery</a>
        <a href="<?php echo esc_url( home_url( '/poc-guilds' ) ); ?>">POC Guilds</a>
        <a href="<?php echo esc_url( home_url( '/disclaimer' ) ); ?>" class="current">Disclaimer</a>
      </div>
    </div>
  </nav>
  <header>
    <div class="brand">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-hidden="true">
        <?php echo function_exists( 'hb_get_site_logo' ) ? hb_get_site_logo( 'medium', array( 'class' => 'logo-img' ) ) : ''; ?>
      </a>
      <div>
        <div style="color:var(--muted); font-size:13px; letter-spacing:.08em; text-transform:uppercase;">
          <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
        </div>
        <h1>Disclaimer &amp; Non-Custodial Notice</h1>
        <p class="subtitle">
          This page explains what <?php echo esc_html( get_bloginfo( 'name' ) ); ?> is (and is not), what may be recorded when you scan,
          and how XP / YAM / "New World Penny" references should be interpreted as cooperative measurement conventions.
        </p>
        <div class="meta">
          <span>Version: <code>v1.1</code></span><span class="dot">•</span>
          <span>Last updated: <code>December 14, 2025</code></span>
        </div>
      </div>
    </div>

    <div class="pillrow" aria-label="Key notices">
      <div class="pill"><strong>Non-custodial</strong> recordkeeping only</div>
      <div class="pill"><strong>Not</strong> a bank / escrow / wallet</div>
      <div class="pill"><strong>Not</strong> a money transmitter</div>
      <div class="pill"><strong>No</strong> guarantee of redemption</div>
      <div class="pill"><strong>Unit-of-account</strong> conventions only</div>
    </div>
  </header>

  <main>
    <section class="card">
      <div class="callout">
        <b>Plain-English Summary:</b>
        <?php echo esc_html( get_bloginfo( 'name' ) ); ?> is a public-facing registry for <b>proof-based attestations</b>.
        It records that a delivery or service was acknowledged by a scanning device, producing a neutral, append-only record.
        It does <b>not</b> hold money, move money, promise money, or guarantee outcomes.
      </div>

      <div class="hr"></div>

      <div class="grid">
        <div class="ok">
          <h2>What this site does</h2>
          <ul>
            <li>Provides a scan flow to confirm a delivery or service event as an <b>attestation</b>.</li>
            <li>Captures basic event metadata (for example: timestamp, page path, and a session/device identifier).</li>
            <li>May record optional context if you provide it (for example: role selection, referral attribution, or note fields).</li>
            <li>Supports cooperative ledger accounting references (for example: "XP", "YAM", or "New World Penny") as <b>non-monetary</b> measurement markers.</li>
          </ul>
        </div>

        <div class="callout">
          <h2>What this site does NOT do</h2>
          <ul>
            <li>Does not custody fiat or crypto.</li>
            <li>Does not process card, ACH, Venmo, PayPal, or other payments.</li>
            <li>Does not act as a bank, broker, escrow, wallet provider, or exchange.</li>
            <li>Does not guarantee that any participant will pay, reimburse, redeem, or convert anything.</li>
            <li>Does not provide legal, tax, or financial advice.</li>
          </ul>
        </div>
      </div>
    </section>

    <section class="card">
      <h2>YAM Peg &amp; New World Penny Measurement Convention</h2>
      <p class="subtitle">
        The following statements describe <b>measurement conventions</b> used for cooperative accounting and visibility.
        They are not an offer, not a promise of redemption, and not a representation that any conversion will occur via this website.
      </p>

      <div class="hr"></div>

      <div class="note">
        <p style="margin:0 0 10px;">
          <b>Reference peg (unit-of-account):</b> For ledger math only, the system may reference
          <code>21,000 YAM = $1.00 USD</code> as a <b>pricing ruler</b> to keep entries comparable across time.
        </p>
        <p style="margin:0;">
          <b>Granularity (micro-unit):</b> A "New World Penny" may be used as a symbolic micro-reward marker expressed at
          <code>sextillionth-of-a-penny</code> style granularity for recordkeeping precision and leaderboard accounting.
        </p>
      </div>

      <div class="hr"></div>

      <ul>
        <li><b>Non-monetary:</b> YAM, XP, and "New World Penny" references on this site are cooperative measurement markers, not currency held here.</li>
        <li><b>No stored value:</b> This site does not maintain a custodial balance, deposit account, or stored-value wallet for you.</li>
        <li><b>No guarantee:</b> Any mention of a peg does not guarantee redeemability, conversion, or price stability through this website.</li>
      </ul>
    </section>

    <section class="card">
      <h2>Non-Custodial &amp; No Money Transmission</h2>
      <p style="color:var(--muted)">
        <?php echo esc_html( get_bloginfo( 'name' ) ); ?> is designed for <b>proof-based visibility and reporting</b>. Any reference to "XP", "trade credit",
        "pledge", "YAM", or "New World Penny" is informational and represents cooperative recordkeeping—not a stored-value account.
      </p>
      <ul>
        <li><b>No custody:</b> We do not hold member funds or balances on this site.</li>
        <li><b>No settlement:</b> This site does not execute transfers, redemptions, or disbursements.</li>
        <li><b>No guarantee:</b> Any off-site settlement (if any) is between participants and their chosen service providers.</li>
      </ul>
    </section>

    <section class="card">
      <h2>Proof Events &amp; Accuracy</h2>
      <p style="color:var(--muted)">
        A scan creates an attestation that a device reported an event. It does not prove identity, intent, ownership, or satisfaction.
      </p>
      <ul>
        <li><b>Attestation only:</b> A scan indicates "this device reported this event at this time."</li>
        <li><b>Human error happens:</b> Incorrect scans, wrong selections, and mistaken confirmations can occur.</li>
        <li><b>Append-only record:</b> Corrections may be logged as follow-up entries; prior entries may remain visible for auditability.</li>
      </ul>
    </section>

    <section class="card">
      <h2>Privacy, Device Data, and Location</h2>
      <p style="color:var(--muted)">
        We aim to collect only what is necessary for proof-based recordkeeping. Depending on your browser settings and choices,
        the site may record technical data.
      </p>
      <ul>
        <li><b>Device/session identifiers:</b> We may store a pseudonymous identifier to prevent duplicate or abusive submissions.</li>
        <li><b>IP and user-agent:</b> Standard web server logs may include IP address and browser/device details.</li>
        <li><b>Location:</b> If location is requested, it is optional and may be denied by you. If you allow it, coarse or precise location may be recorded.</li>
        <li><b>Third-party services:</b> If analytics or security services are used, they may place cookies or process logs per their policies.</li>
      </ul>
      <div class="hr"></div>
      <p class="subtitle">
        Publish a separate <b>Privacy Notice</b> describing exact fields captured, retention windows, and removal requests where feasible.
      </p>
    </section>

    <section class="card">
      <h2>Tax / Reporting Notice</h2>
      <p style="color:var(--muted)">
        Any reference to tax forms or reporting (for example, independent contractor referral reporting) is informational only.
        Participants are responsible for their own tax compliance and recordkeeping.
      </p>
      <ul>
        <li>Nothing on this site should be interpreted as tax advice.</li>
        <li>Consult a qualified tax professional for guidance.</li>
      </ul>
    </section>

    <section class="card">
      <h2>Eligibility, Risk, and No Warranty</h2>
      <ul>
        <li><b>Use at your own risk:</b> You are responsible for the choices you make when scanning and confirming.</li>
        <li><b>No warranty:</b> The site is provided "as is" without warranties of any kind.</li>
        <li><b>Limitation of liability:</b> To the maximum extent permitted by law, we are not liable for indirect or consequential damages arising from use of the site.</li>
        <li><b>Third-party links:</b> If this site links to outside services, those services have their own terms and privacy policies.</li>
      </ul>
    </section>

    <section class="card">
      <h2>Contact</h2>
      <p style="color:var(--muted)">
        Questions about this disclaimer or proof-based reporting visibility:
      </p>
      <ul>
        <li>Email: <a href="mailto:coachtom@legacytoliveby.org">coachtom@legacytoliveby.org</a></li>
      </ul>
      <div class="hr"></div>
      <p class="subtitle">
        If you publish a full Terms page, link it here and in the site footer.
      </p>
    </section>
  </main>

  <footer>
    <div>
      © <span id="y"></span> <?php echo esc_html( get_bloginfo( 'name' ) ); ?> — Proof-based visibility and cooperative recordkeeping.
      This page is a general notice and does not create a fiduciary relationship, agency relationship, or contractual guarantee.
    </div>
  </footer>

  <script>
    document.getElementById("y").textContent = new Date().getFullYear();
  </script>
</body>
</html>
