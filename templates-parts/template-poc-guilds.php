<?php
/**
 * Template Name: POC Guilds
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Guilds (POC) • <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
  <style>
    :root{
      --bg:#0b0f14;
      --card:#0f1621;
      --ink:#eaf1ff;
      --muted:#b7c3d9;
      --line:rgba(255,255,255,.10);
      --good:#7CFFB2;
      --warn:#FFD37C;
      --link:#a7c7ff;
      --shadow: 0 10px 30px rgba(0,0,0,.35);
      --radius:18px;
      --max: 1080px;
      --mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      --sans: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family:var(--sans);
      background:
        radial-gradient(1200px 600px at 20% -10%, rgba(167,199,255,.12), transparent 60%),
        radial-gradient(900px 500px at 90% 0%, rgba(124,255,178,.10), transparent 55%),
        radial-gradient(1000px 700px at 50% 120%, rgba(255,211,124,.10), transparent 55%),
        var(--bg);
      color:var(--ink);
      line-height:1.5;
    }
    a{color:var(--link); text-decoration:none}
    a:hover{text-decoration:underline}

    /* Site nav */
    .site-nav{
      position:sticky;
      top:0;
      z-index:50;
      padding:14px 18px;
      border-bottom:1px solid var(--line);
      background:rgba(11,15,20,.85);
      backdrop-filter:blur(10px);
    }
    .nav-inner{
      max-width:var(--max);
      margin:0 auto;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:14px;
      flex-wrap:wrap;
    }
    .brand{
      display:flex;
      align-items:center;
      gap:10px;
      color:var(--ink);
      text-decoration:none;
      font-weight:800;
    }
    .brand:hover{color:var(--ink); text-decoration:none}
    .logo{
      width:28px;
      height:28px;
      border-radius:10px;
      background:linear-gradient(135deg, rgba(124,255,178,.9), rgba(167,199,255,.9));
      box-shadow:0 8px 20px rgba(0,0,0,.25);
      flex-shrink:0;
      display:flex;
      align-items:center;
      justify-content:center;
      overflow:hidden;
    }
    .logo img{height:100%; object-fit:contain; border-radius:10px}
    .nav-links{display:flex; align-items:center; gap:8px; flex-wrap:wrap}
    .nav-links a{
      color:var(--muted);
      font-size:13px;
      font-weight:700;
      padding:8px 12px;
      border-radius:12px;
      border:1px solid transparent;
      transition:background .12s ease, color .12s ease;
    }
    .nav-links a:hover{background:rgba(255,255,255,.06); color:var(--ink)}
    .nav-links a.current{color:var(--good); border-color:rgba(124,255,178,.25)}
    .hamburger{display:none}
    .hamburger label{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:44px;
      height:44px;
      border-radius:12px;
      border:1px solid var(--line);
      background:rgba(255,255,255,.05);
      cursor:pointer;
      color:var(--ink);
    }
    .hamburger label:hover{background:rgba(255,255,255,.08)}
    .hamburger svg{width:22px; height:22px}
    #navtoggle{display:none}
    .sidebar-overlay{
      display:none;
      position:fixed;
      inset:0;
      background:rgba(0,0,0,.5);
      backdrop-filter:blur(4px);
      z-index:9998;
      opacity:0;
      transition:opacity .3s ease;
      cursor:pointer;
    }
    .sidebar-overlay.active{display:block; opacity:1}
    .sidebar-menu{
      position:fixed;
      top:0;
      right:-100%;
      width:320px;
      max-width:85vw;
      height:100vh;
      background:rgba(15,22,33,.95);
      border-left:1px solid var(--line);
      z-index:9999;
      overflow-y:auto;
      transition:right .3s ease;
      padding:20px;
      display:flex;
      flex-direction:column;
      gap:20px;
    }
    .sidebar-menu.active{right:0}
    .sidebar-header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding-bottom:16px;
      border-bottom:1px solid var(--line);
    }
    .sidebar-header h2{margin:0; font-size:18px; font-weight:800; color:var(--ink)}
    .sidebar-close{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:40px;
      height:40px;
      border-radius:12px;
      border:1px solid var(--line);
      background:rgba(255,255,255,.05);
      cursor:pointer;
      color:var(--ink);
    }
    .sidebar-close:hover{background:rgba(255,255,255,.08)}
    .sidebar-menu-links{display:flex; flex-direction:column; gap:8px}
    .sidebar-menu-links a{
      display:block;
      padding:14px 16px;
      border-radius:14px;
      color:var(--muted);
      border:1px solid transparent;
      font-size:15px;
      transition:all .12s ease;
    }
    .sidebar-menu-links a:hover{background:rgba(255,255,255,.06); color:var(--ink)}
    @media (max-width:900px){
      .nav-links{display:none}
      .hamburger{display:block}
    }
    body.sidebar-open{overflow:hidden}

    header.page-header{
      padding:56px 18px 22px;
      border-bottom:1px solid var(--line);
      background:linear-gradient(to bottom, rgba(255,255,255,.03), transparent);
    }
    .wrap{max-width:var(--max); margin:0 auto}
    .kicker{
      display:inline-flex;
      align-items:center;
      gap:10px;
      color:var(--muted);
      font-size:14px;
      letter-spacing:.08em;
      text-transform:uppercase;
    }
    .dot{
      width:10px; height:10px; border-radius:999px;
      background:linear-gradient(90deg, var(--good), var(--link));
      box-shadow:0 0 0 4px rgba(124,255,178,.10);
    }
    h1{
      margin:14px 0 10px;
      font-size:clamp(30px, 4vw, 46px);
      line-height:1.12;
      letter-spacing:-.02em;
    }
    .subhead{
      color:var(--muted);
      font-size:clamp(16px, 2.0vw, 18px);
      max-width:78ch;
    }
    .heroGrid{
      margin-top:24px;
      display:grid;
      grid-template-columns: 1.35fr .65fr;
      gap:16px;
    }
    @media (max-width: 900px){
      .heroGrid{grid-template-columns: 1fr}
    }
    .card{
      background:rgba(15,22,33,.82);
      border:1px solid var(--line);
      border-radius:var(--radius);
      padding:18px;
      box-shadow:var(--shadow);
      backdrop-filter: blur(8px);
    }
    .callout{
      border-left:4px solid rgba(124,255,178,.55);
      padding:14px 14px 14px 14px;
      background:rgba(124,255,178,.06);
      border-radius:14px;
    }
    .callout strong{color:var(--good)}
    .pillRow{display:flex; flex-wrap:wrap; gap:10px; margin-top:14px}
    .pill{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding:8px 10px;
      border-radius:999px;
      border:1px solid var(--line);
      color:var(--muted);
      background:rgba(255,255,255,.03);
      font-size:13px;
      white-space:nowrap;
    }
    .pill b{color:var(--ink); font-weight:700}
    .mono{
      font-family:var(--mono);
      font-size:12.5px;
      color:rgba(234,241,255,.92);
    }
    main{padding:26px 18px 64px}
    h2{
      margin:26px 0 10px;
      font-size:22px;
      letter-spacing:-.01em;
    }
    p{margin:10px 0; color:rgba(234,241,255,.92)}
    .muted{color:var(--muted)}
    .grid{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:16px;
      margin-top:14px;
    }
    @media (max-width: 900px){
      .grid{grid-template-columns:1fr}
    }
    .list{
      margin:12px 0 0;
      padding:0;
      list-style:none;
      display:grid;
      gap:10px;
    }
    .li{
      display:flex;
      gap:10px;
      padding:12px;
      border:1px solid var(--line);
      border-radius:14px;
      background:rgba(255,255,255,.03);
    }
    .badge{
      flex:0 0 auto;
      width:28px;
      height:28px;
      border-radius:10px;
      display:grid;
      place-items:center;
      border:1px solid var(--line);
      background:rgba(255,255,255,.04);
      color:var(--ink);
      font-weight:800;
      font-size:13px;
    }
    .li strong{display:block}
    .li span{display:block; color:var(--muted); font-size:14px; margin-top:2px}
    .steps{
      counter-reset: step;
      display:grid;
      gap:10px;
      margin-top:12px;
      padding:0;
      list-style:none;
    }
    .step{
      counter-increment: step;
      position:relative;
      padding:14px 14px 14px 52px;
      border:1px solid var(--line);
      border-radius:14px;
      background:rgba(255,255,255,.03);
    }
    .step::before{
      content: counter(step);
      position:absolute;
      left:14px; top:14px;
      width:28px; height:28px;
      border-radius:10px;
      display:grid;
      place-items:center;
      font-weight:900;
      background:rgba(167,199,255,.10);
      border:1px solid rgba(167,199,255,.25);
      color:var(--ink);
    }
    .step strong{display:block}
    .step span{display:block; color:var(--muted); font-size:14px; margin-top:2px}
    .divider{
      margin:22px 0;
      height:1px;
      background:linear-gradient(90deg, transparent, var(--line), transparent);
    }
    .ledger{
      padding:14px;
      border:1px solid rgba(255,255,255,.12);
      border-radius:14px;
      background:rgba(0,0,0,.30);
      overflow:auto;
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.02);
    }
    pre{
      margin:0;
      font-family:var(--mono);
      font-size:12.5px;
      color:rgba(234,241,255,.90);
      line-height:1.5;
      white-space:pre;
    }
    .ctaRow{
      display:flex;
      flex-wrap:wrap;
      gap:12px;
      margin-top:16px;
      align-items:center;
    }
    .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      padding:11px 14px;
      border-radius:14px;
      border:1px solid var(--line);
      background:rgba(255,255,255,.05);
      color:var(--ink);
      font-weight:800;
      letter-spacing:.01em;
      box-shadow:var(--shadow);
      cursor:pointer;
      text-decoration:none;
    }
    .btn:hover{background:rgba(255,255,255,.08); text-decoration:none; color:var(--ink)}
    .btn.primary{
      background:linear-gradient(90deg, rgba(124,255,178,.22), rgba(167,199,255,.22));
      border-color: rgba(167,199,255,.25);
    }
    .note{
      font-size:13px;
      color:var(--muted);
    }
    footer{
      padding:26px 18px;
      border-top:1px solid var(--line);
      color:var(--muted);
      font-size:13px;
    }
  </style>
</head>

<body>
  <!-- Site nav -->
  <nav class="site-nav" aria-label="Primary">
    <div class="nav-inner">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
        <span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
      </a>

      <div class="nav-links">
        <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">How It Works</a>
        <a href="<?php echo esc_url( home_url( '/proof-of-delivery' ) ); ?>">Proof of Delivery</a>
        <a href="<?php echo esc_url( home_url( '/serendipity-protocol' ) ); ?>">Serendipity Protocol</a>
        <a href="<?php echo esc_url( home_url( '/new-world-penny' ) ); ?>">New World Penny</a>
        <a href="<?php echo esc_url( home_url( '/dao' ) ); ?>">Join the DAO</a>
        <a href="<?php echo esc_url( home_url( '/poc-guilds' ) ); ?>" class="current">POC Guilds</a>
        <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">FAQs</a>
      </div>

      <div class="hamburger">
        <input id="navtoggle" type="checkbox" class="hamburger-toggle" />
        <label for="navtoggle" aria-label="Open menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M4 7h16M4 12h16M4 17h16"/>
          </svg>
        </label>
      </div>
    </div>
  </nav>

  <div class="sidebar-overlay" id="sidebar-overlay"></div>
  <div class="sidebar-menu" id="sidebar-menu" aria-label="Mobile menu">
    <div class="sidebar-header">
      <h2>Menu</h2>
      <label for="navtoggle" class="sidebar-close" aria-label="Close menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </label>
    </div>
    <div class="sidebar-menu-links">
      <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">How It Works</a>
      <a href="<?php echo esc_url( home_url( '/proof-of-delivery' ) ); ?>">Proof of Delivery</a>
      <a href="<?php echo esc_url( home_url( '/serendipity-protocol' ) ); ?>">Serendipity Protocol</a>
      <a href="<?php echo esc_url( home_url( '/new-world-penny' ) ); ?>">New World Penny</a>
      <a href="<?php echo esc_url( home_url( '/dao' ) ); ?>">Join the DAO</a>
      <a href="<?php echo esc_url( home_url( '/poc-guilds' ) ); ?>">POC Guilds</a>
      <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">FAQs</a>
    </div>
  </div>

  <script>
  (function(){
    var t = document.getElementById('navtoggle');
    var o = document.getElementById('sidebar-overlay');
    var s = document.getElementById('sidebar-menu');
    function open(v){ o.classList.toggle('active', v); s.classList.toggle('active', v); document.body.classList.toggle('sidebar-open', v); t.checked = v; }
    if(t) t.addEventListener('change', function(){ open(this.checked); });
    if(o) o.addEventListener('click', function(){ open(false); });
    var links = s ? s.querySelectorAll('.sidebar-menu-links a') : [];
    for(var i=0;i<links.length;i++) links[i].addEventListener('click', function(){ open(false); });
  })();
  </script>

  <header class="page-header">
    <div class="wrap">
      <div class="kicker"><span class="dot"></span> Human Blockchain • POC Guilds</div>
      <h1>Guilds are Patron Organizing Communities built inside an LCA framework.</h1>
      <p class="subhead">
        A Guild is where trust becomes visible: receipts, obligations, and extinguishments are posted monthly under MSB-style reporting discipline,
        while the economic outcome is treated as <b>patronage dividends</b>—not "mystery money."
      </p>

      <div class="heroGrid">
        <div class="card callout">
          <p style="margin:0">
            <strong>Leave your wallet at home</strong> at every kite festival.<br/>
            Your smartphone is the proof-of-presence tool. You pledge <b>$30</b>, then you take to the sky—participation first, accounting second, redemption later.
          </p>
          <div class="pillRow">
            <div class="pill"><b>LCA</b> Limited Cooperative Association</div>
            <div class="pill"><b>POC</b> 5 sellers + 25 buyers</div>
            <div class="pill"><b>Dividend</b> patronage accounting</div>
            <div class="pill"><b>MSB</b> monthly statement cadence</div>
            <div class="pill"><b>Ledger</b> append-only GitHub trust</div>
          </div>
        </div>

        <div class="card">
          <h2 style="margin-top:0">What "Guild" means</h2>
          <p class="muted" style="margin-bottom:12px">
            A Guild is a community finance container that can be audited by ordinary people.
          </p>
          <ul class="list">
            <li class="li">
              <div class="badge">1</div>
              <div>
                <strong>Governed like a cooperative</strong>
                <span>Income is categorized and reported as patronage dividends where applicable.</span>
              </div>
            </li>
            <li class="li">
              <div class="badge">2</div>
              <div>
                <strong>Accounted like a merchant</strong>
                <span>Merchant income is tracked as merchant income—cleanly separated from patronage.</span>
              </div>
            </li>
            <li class="li">
              <div class="badge">3</div>
              <div>
                <strong>Includes referral compensation</strong>
                <span>Non-employee referral bonuses are tracked as non-employee income.</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="wrap">

      <h2>Why Guilds exist: Trust you can verify</h2>
      <p>
        Guilds are designed for a sandbox playground—open to anyone willing to show up, participate, and let the record speak for itself.
        The "Small Street Applied – Atlanta" GitHub repo is the public presentation layer of that record: an append-only trail of
        <b>receipts</b>, <b>obligations</b>, and <b>extinguishments</b> posted on a monthly cadence.
      </p>

      <div class="grid">
        <div class="card">
          <h2 style="margin-top:0">Three income lanes (kept separate)</h2>
          <ul class="list">
            <li class="li">
              <div class="badge">A</div>
              <div>
                <strong>Patronage dividends (Guild/LCA lane)</strong>
                <span>Guild outcomes distributed based on participation rules—recorded as patronage dividends.</span>
              </div>
            </li>
            <li class="li">
              <div class="badge">B</div>
              <div>
                <strong>Merchant income (commerce lane)</strong>
                <span>Product/service merchant receipts are accounted for as merchant income.</span>
              </div>
            </li>
            <li class="li">
              <div class="badge">C</div>
              <div>
                <strong>Referral bonuses (non-employee lane)</strong>
                <span>Referral compensation is tracked as non-employee income (separate from patronage).</span>
              </div>
            </li>
          </ul>
          <div class="divider"></div>
          <p class="note">
            The point is simple: <b>no mixing buckets</b>. When categories are clean, trust becomes easier—for members, auditors, and regulators.
          </p>
        </div>

        <div class="card">
          <h2 style="margin-top:0">Monthly MSB-style statement posting</h2>
          <p class="muted">
            Each Guild posts a monthly statement that mirrors money-services discipline, even when the "game" is simply presence + proof + community accounting.
          </p>
          <ol class="steps">
            <li class="step">
              <strong>Receipts posted</strong>
              <span>What was pledged/earned/recorded during the month (by category).</span>
            </li>
            <li class="step">
              <strong>Obligations posted</strong>
              <span>What the Guild owes (patronage distributions, operational obligations, etc.).</span>
            </li>
            <li class="step">
              <strong>Extinguishments posted</strong>
              <span>What obligations were closed out (extinguished) according to the algorithm and rules.</span>
            </li>
          </ol>
          <div class="ctaRow">
            <a class="btn primary" href="#" aria-label="Open Ledger (placeholder)">Open the Guild Ledger</a>
            <a class="btn" href="#" aria-label="How the Algorithm Works (placeholder)">How the Algorithm Works</a>
          </div>
          <p class="note">Links above are placeholders—wire them to your Small Street Applied – Atlanta repo pages.</p>
        </div>
      </div>

      <h2>How a kite festival becomes a Guild trust event</h2>
      <p>
        Kite festivals are where the concept stays human: no slogans, no outrage, no wallets—just presence, participation, and a smartphone-based pledge.
        A Guild makes that participation legible by converting it into clean monthly reporting.
      </p>

      <div class="grid">
        <div class="card">
          <h2 style="margin-top:0">Festival flow (wallet stays home)</h2>
          <ol class="steps">
            <li class="step">
              <strong>Show up with your smartphone</strong>
              <span>Your device is your proof-of-presence anchor—simple, personal, and hard to fake at scale.</span>
            </li>
            <li class="step">
              <strong>Pledge $30</strong>
              <span>Your pledge is the commitment signal that the Guild can account for and report.</span>
            </li>
            <li class="step">
              <strong>Take to the sky</strong>
              <span>Participation is the product. The Guild records outcomes and posts them monthly.</span>
            </li>
            <li class="step">
              <strong>Monthly posting builds Trust</strong>
              <span>Receipts, obligations, extinguishments—published to the append-only record.</span>
            </li>
          </ol>
        </div>

        <div class="card">
          <h2 style="margin-top:0">What gets posted (example format)</h2>
          <p class="muted">
            Below is a human-readable example (not financial advice—just the structure of what a Guild publishes for verification).
          </p>
          <div class="ledger" role="region" aria-label="Ledger Example">
            <pre>
GUILD MONTHLY STATEMENT (Example)
Period: YYYY-MM (local time)
Entity: POC Guild (LCA-aligned)
Posting: Append-only (Small Street Applied – Atlanta)

1) RECEIPTS
- Patronage receipts (eligible for dividends): $______
- Merchant income receipts:                 $______
- Referral bonuses (non-employee):          $______

2) OBLIGATIONS
- Patronage dividend obligation:            $______
- Operations / fulfillment obligation:      $______
- Other disclosed obligations:              $______

3) EXTINGUISHMENTS
- Obligations extinguished this period:     $______
- Method: published Guild algorithm + rules
- References: txn ids / event ids / proofs  (links)
            </pre>
          </div>
          <p class="note">
            The algorithm is the promise. The monthly posting is the proof. Trust becomes a habit.
          </p>
        </div>
      </div>

      <div class="card" style="margin-top:16px">
        <h2 style="margin-top:0">Guild promise</h2>
        <p>
          A Guild does not ask people to "trust the vibe." It asks them to trust a process:
          <b>play in the sandbox</b>, <b>pledge with your phone</b>, then verify the monthly record.
        </p>
        <p class="muted">
          If your community can gather to fly kites—peacefully, playfully, and consistently—then the Guild can do what money systems rarely do:
          show its work in public.
        </p>
        <div class="ctaRow">
          <a class="btn primary" href="<?php echo esc_url( home_url( '/' ) ); ?>#openJoinPOC" aria-label="Join a Guild">Join a Guild</a>
          <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>#openJoinPOC" aria-label="Start a POC">Start a POC (5 sellers + 25 buyers)</a>
          <a class="btn" href="<?php echo esc_url( home_url( '/faq' ) ); ?>" aria-label="Read Reporting Rules">Read Reporting Rules</a>
        </div>
        <p class="note">
          "Join a Guild" and "Start a POC" open the demand-signal modal on the home page. Replace "Open the Guild Ledger" / "How the Algorithm Works" with your repo URLs when ready.
        </p>
      </div>

    </div>
  </main>

  <footer>
    <div class="wrap">
      <div class="mono">Small Street Applied – Atlanta • Guilds (POC) • LCA Framework • Monthly Receipts / Obligations / Extinguishments</div>
      <div style="margin-top:8px">
        This page is part of a public sandbox: participation first, transparent accounting second, and long-term trust always.
      </div>
      <div style="margin-top:8px" class="mono">© <?php echo date( 'Y' ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></div>
    </div>
  </footer>
</body>
</html>
