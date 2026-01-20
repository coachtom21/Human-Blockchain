<?php
/**
 * Template: Loyalty XP
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Loyalty Points (XP, NWP & YAM JAM) | HumanBlockchain.info</title>

  <style>
    :root{
      --bg:#0b1020;
      --text:#eef2ff;
      --muted:#b8c1e3;
      --line:rgba(255,255,255,.14);
      --shadow:0 18px 50px rgba(0,0,0,.55);
      --radius:18px;
      --btnRadius:14px;
      --accent:#34d399;
      --warn:#fbbf24;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      min-height:100vh;
      font-family: system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;
      background:
        radial-gradient(1000px 650px at 20% 10%, rgba(120,160,255,.18), transparent 60%),
        radial-gradient(900px 650px at 80% 85%, rgba(52,211,153,.12), transparent 65%),
        var(--bg);
      color:var(--text);
    }

    /* Header */
    .nav{
      position:sticky; top:0; z-index:10;
      backdrop-filter: blur(10px);
      background: rgba(11,16,32,.68);
      border-bottom:1px solid var(--line);
    }
    .nav-inner{
      max-width:1100px;
      margin:0 auto;
      padding:14px 18px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:14px;
      flex-wrap:wrap;
    }
    .brand{
      display:flex; gap:10px; align-items:center;
      text-decoration:none; color:var(--text);
      min-width:260px;
    }
    .logo{
      width:28px;height:28px;border-radius:10px;
      background:
        radial-gradient(circle at 30% 30%, rgba(52,211,153,.9), transparent 60%),
        radial-gradient(circle at 70% 70%, rgba(120,160,255,.9), transparent 60%),
        rgba(255,255,255,.06);
      border:1px solid var(--line);
      flex:0 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .logo img{
      height: 100%;
      object-fit: contain;
      border-radius: 10px;
    }
    .brand h1{margin:0;font-size:14px;letter-spacing:.4px}
    .brand small{display:block;font-size:12px;color:var(--muted)}
    .nav-inner{
      position: relative;
    }
    .nav-links{display:flex;gap:10px;flex-wrap:wrap}
    .nav-links a{
      text-decoration:none;
      color:var(--muted);
      font-weight:850;
      font-size:12px;
      padding:10px 12px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.04);
      transition: all .12s ease;
    }
    .nav-links a:hover{
      background: rgba(255,255,255,.08);
      color: var(--text);
    }
    
    /* Hamburger Menu */
    .hamburger-menu{
      display: none;
    }
    .hamburger-toggle{
      display: none;
    }
    .hamburger-btn{
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.16);
      background: rgba(255,255,255,.06);
      cursor: pointer;
      transition: background .12s ease;
      flex-shrink: 0;
    }
    .hamburger-btn:hover{
      background: rgba(255,255,255,.10);
    }
    .hamburger-btn svg{
      width: 22px;
      height: 22px;
      stroke: currentColor;
    }
    
    /* Sidebar Overlay */
    .sidebar-overlay{
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      z-index: 9998;
      opacity: 0;
      transition: opacity 0.3s ease;
      cursor: pointer;
    }
    
    .sidebar-overlay.active{
      display: block;
      opacity: 1;
    }
    
    /* Sidebar Menu */
    .sidebar-menu{
      position: fixed;
      top: 0;
      right: -100%;
      width: 320px;
      max-width: 85vw;
      height: 100vh;
      background: rgba(11,18,32,.95);
      backdrop-filter: blur(20px);
      border-left: 1px solid rgba(255,255,255,.12);
      z-index: 9999;
      overflow-y: auto;
      transition: right 0.3s ease;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      -webkit-overflow-scrolling: touch;
    }
    
    .sidebar-menu.active{
      right: 0;
    }
    
    /* Sidebar Header */
    .sidebar-header{
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(255,255,255,.12);
    }
    
    .sidebar-header h2{
      margin: 0;
      font-size: 18px;
      font-weight: 800;
      color: var(--text);
    }
    
    .sidebar-close{
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.16);
      background: rgba(255,255,255,.06);
      cursor: pointer;
      color: var(--text);
      transition: background .12s ease;
    }
    
    .sidebar-close:hover{
      background: rgba(255,255,255,.10);
    }
    
    .sidebar-close svg{
      width: 20px;
      height: 20px;
    }
    
    /* Sidebar Menu Links */
    .sidebar-menu-links{
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    .sidebar-menu-links a{
      display: block;
      padding: 14px 16px;
      border-radius: 14px;
      color: var(--muted);
      border: 1px solid transparent;
      font-size: 15px;
      text-decoration: none;
      transition: all .12s ease;
    }
    
    .sidebar-menu-links a:hover{
      background: rgba(255,255,255,.06);
      color: var(--text);
      border-color: rgba(255,255,255,.10);
    }
    
    /* Mobile Responsive */
    @media (max-width: 900px){
      .nav-links{
        display: none;
      }
      .hamburger-menu{
        display: block;
      }
      .brand{
        min-width: auto;
        flex: 1;
        min-width: 0;
      }
      .brand small{
        display: none;
      }
      .brand h1{
        font-size: 16px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    }
    
    /* Prevent body scroll when sidebar is open */
    body.sidebar-open{
      overflow: hidden;
      position: fixed;
      width: 100%;
    }

    /* Layout */
    .wrap{max-width:1100px;margin:0 auto;padding:26px 18px 60px;}
    .card{
      border:1px solid var(--line);
      background: rgba(255,255,255,.05);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .card-inner{padding:22px}

    .badge{
      display:inline-flex;align-items:center;gap:8px;
      padding:8px 12px;border-radius:999px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      color:var(--muted);
      font-size:12px;
      letter-spacing:.2px;
    }
    .badge .dot{
      width:8px;height:8px;border-radius:50%;
      background:var(--accent);
      box-shadow:0 0 0 3px rgba(52,211,153,.18);
    }

    h2{margin:12px 0 10px;font-size:34px;line-height:1.15;letter-spacing:.2px}
    p{margin:10px 0;font-size:16px;line-height:1.6}
    .muted{color:var(--muted)}

    .grid{
      display:grid;
      grid-template-columns: 1.08fr .92fr;
      gap:18px;
      margin-top:16px;
      align-items:start;
    }
    @media(max-width:900px){ .grid{grid-template-columns:1fr} }

    .panel{
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      border-radius:16px;
      padding:16px;
      margin-bottom:12px;
    }
    .panel h3{
      margin:0 0 10px;
      color:var(--text);
      font-size:19px;
      letter-spacing:.15px;
    }

    .bigStat{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:12px;
      margin-top:10px;
    }
    @media(max-width:700px){ .bigStat{grid-template-columns:1fr} }
    .stat{
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.04);
      border-radius:16px;
      padding:14px;
    }
    .stat .label{
      color:var(--muted);
      text-transform:uppercase;
      letter-spacing:.35px;
      font-size:12px;
      font-weight:900;
    }
    .stat .value{
      margin-top:8px;
      font-size:28px;
      font-weight:950;
      letter-spacing:.2px;
    }
    .stat .note{
      margin-top:8px;
      color:var(--muted);
      font-size:13px;
      line-height:1.5;
    }

    ul{margin:0;padding-left:18px}
    li{margin:9px 0;font-size:16px;line-height:1.6}

    .callout{
      margin-top:12px;
      padding:16px;
      border-radius:16px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.04);
      font-size:16px;
      line-height:1.6;
    }
    .callout b{display:block;margin-bottom:8px;font-size:17px}
    .callout.warn{
      border-color: rgba(251,191,36,.35);
      background: rgba(251,191,36,.06);
    }
    .warnDot{
      display:inline-block;
      width:10px;height:10px;border-radius:50%;
      background: var(--warn);
      box-shadow:0 0 0 3px rgba(251,191,36,.16);
      margin-right:10px;
      vertical-align:middle;
    }

    /* Table */
    .tableWrap{
      margin-top:12px;
      overflow:auto;
      border-radius:16px;
      border:1px solid rgba(255,255,255,.14);
    }
    table{
      width:100%;
      border-collapse:collapse;
      min-width:760px;
      background: rgba(0,0,0,.12);
    }
    th, td{
      padding:12px 12px;
      border-bottom:1px solid rgba(255,255,255,.10);
      vertical-align:top;
      text-align:left;
      font-size:13px;
    }
    th{
      color:var(--muted);
      font-size:12px;
      letter-spacing:.35px;
      text-transform:uppercase;
      background: rgba(255,255,255,.04);
    }
    tr:last-child td{border-bottom:none}

    /* Right rail */
    .cta{display:grid;gap:12px;align-content:start}
    .btn{
      display:flex;justify-content:space-between;align-items:center;gap:12px;
      text-decoration:none;border-radius: var(--btnRadius);
      padding:16px 16px;font-weight:950;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.06);
      color: var(--text);
      cursor:pointer;font-size:16px;
    }
    .btnPrimary{
      background: linear-gradient(180deg,#34d399,#10b981);
      color:#052015;border-color: rgba(52,211,153,.35);
    }
    .btn .sub{
      display:block;font-size:13px;font-weight:800;opacity:.86;margin-top:4px;
      color: rgba(255,255,255,.86);
    }
    .btnPrimary .sub{color:#062015;opacity:.8}
    .arrow{font-weight:950}

    .fineprint{
      margin-top:14px;padding-top:12px;border-top:1px solid rgba(255,255,255,.14);
      font-size:13px;color:var(--muted);line-height:1.6;
    }

    code{
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono","Courier New", monospace;
      font-size:12px;
      color: rgba(234,240,255,.92);
      background: rgba(0,0,0,.22);
      padding:2px 6px;
      border-radius:8px;
      border:1px solid rgba(255,255,255,.10);
      white-space:nowrap;
    }
  </style>
</head>

<body>
  <header class="nav">
    <div class="nav-inner">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
        <div>
          <h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
          <small>Loyalty Points (XP & NWP)</small>
        </div>
      </a>

      <nav class="nav-links" aria-label="Primary">
        <a href="/how-it-works">How It Works</a>
        <a href="/register-device">Register Device</a>
        <a href="/pod-mode">PoD Mode</a>
        <a href="/loyalty-xp">Loyalty Points</a>
      </nav>
      
      <div class="hamburger-menu">
        <input type="checkbox" id="hamburger-toggle-<?php echo get_the_ID(); ?>" class="hamburger-toggle" />
        <label for="hamburger-toggle-<?php echo get_the_ID(); ?>" class="hamburger-btn" aria-label="Open menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M4 7h16M4 12h16M4 17h16"/>
          </svg>
        </label>
      </div>
    </div>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebar-overlay-<?php echo get_the_ID(); ?>"></div>
    
    <!-- Sidebar Menu -->
    <div class="sidebar-menu" id="sidebar-menu-<?php echo get_the_ID(); ?>" aria-label="Mobile Sidebar Menu">
      <div class="sidebar-header">
        <h2>Menu</h2>
        <label for="hamburger-toggle-<?php echo get_the_ID(); ?>" class="sidebar-close" aria-label="Close menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </label>
      </div>
      
      <!-- Navigation Links -->
      <div class="sidebar-menu-links">
        <a href="/how-it-works">How It Works</a>
        <a href="/register-device">Register Device</a>
        <a href="/pod-mode">PoD Mode</a>
        <a href="/loyalty-xp">Loyalty Points</a>
      </div>
    </div>
  </header>
  
  <script>
    (function() {
      const toggleId = 'hamburger-toggle-<?php echo get_the_ID(); ?>';
      const toggle = document.getElementById(toggleId);
      const overlay = document.getElementById('sidebar-overlay-<?php echo get_the_ID(); ?>');
      const sidebar = document.getElementById('sidebar-menu-<?php echo get_the_ID(); ?>');
      
      function toggleSidebar(open) {
        if (overlay && sidebar && toggle) {
          if (open) {
            overlay.classList.add('active');
            sidebar.classList.add('active');
            document.body.classList.add('sidebar-open');
            toggle.checked = true;
          } else {
            overlay.classList.remove('active');
            sidebar.classList.remove('active');
            document.body.classList.remove('sidebar-open');
            toggle.checked = false;
          }
        }
      }
      
      if (toggle) {
        toggle.addEventListener('change', function() {
          toggleSidebar(this.checked);
        });
      }
      
      if (overlay) {
        overlay.addEventListener('click', function() {
          toggleSidebar(false);
        });
      }
      
      const sidebarLinks = sidebar ? sidebar.querySelectorAll('.sidebar-menu-links a') : [];
      sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
          toggleSidebar(false);
        });
      });
    })();
  </script>

  <main class="wrap">
    <section class="card">
      <div class="card-inner">

        <div class="badge"><span class="dot" aria-hidden="true"></span> YAM JAM • XP & NWP • accounting only • not money</div>

        <h2>Loyalty Points (XP & New World Penny)</h2>
        <p class="muted">
          In our community we call this <b>YAM JAM</b> —
          <b>You And Me, Just Alternative Money</b>.
          That phrase sounds like money, but here’s the truth:
          <b>it is not money</b>. It’s a simple way to <b>measure and record</b> real help using loyalty accounting.
        </p>

        <div class="grid">
          <!-- LEFT -->
          <div>
            <div class="panel">
              <h3>What YAM JAM means (in plain language)</h3>
              <ul>
                <li><b>You And Me</b> = real people helping each other</li>
                <li><b>Just</b> = fair, simple, and easy to understand</li>
                <li><b>Alternative Money</b> = a <b>measuring stick</b> for human value, not cash</li>
              </ul>

              <div class="callout warn">
                <span class="warnDot" aria-hidden="true"></span><b>Important</b>
                “Alternative money” here means <b>alternative measuring</b>.
                It does <b>not</b> mean a bank account, a wallet, or something you spend like dollars.
              </div>
            </div>

            <div class="panel">
              <h3>The simplest way to understand the points</h3>
              <ul>
                <li><b>XP</b> = loyalty accounting points for verified participation</li>
                <li><b>New World Penny (NWP)</b> = one “thank you” point for each delivery helper</li>
                <li>Points are recorded in a <b>general ledger</b> for tracking only</li>
                <li>Points are <b>not money</b> and do not work like a bank balance</li>
              </ul>

              <div class="bigStat">
                <div class="stat">
                  <div class="label">Peg used for accounting</div>
                  <div class="value">21,000 : 1</div>
                  <div class="note">
                    For ledger math only: <b>21,000 units</b> are treated as the bookkeeping equivalent of <b>$1</b>.
                    This is not an exchange feature—just a consistent measuring stick.
                  </div>
                </div>

                <div class="stat">
                  <div class="label">Smallest accounting unit</div>
                  <div class="value">1 / 10²¹</div>
                  <div class="note">
                    The ledger can record value down to a <b>sextillionth of a penny</b>
                    (a 1 with 21 zeros).
                    This lets many helpers receive credit without rounding away their effort.
                  </div>
                </div>
              </div>
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Why use the 21,000-to-1 peg?</b>
              People understand dollars. The ledger uses the <b>21,000-to-1</b> peg as a familiar reference so reports
              can be read easily. It remains <b>general ledger accounting only</b>.
            </div>

            <div class="panel">
              <h3>Examples (simple and practical)</h3>
              <div class="tableWrap">
                <table aria-label="Examples table">
                  <thead>
                    <tr>
                      <th>Situation</th>
                      <th>What is recorded</th>
                      <th>Why it matters</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>Buyer confirms a delivery</b></td>
                      <td>$5 buyer rebate in <b>XP</b> (loyalty accounting)</td>
                      <td>Rewards the buyer for completing the final acceptance</td>
                    </tr>
                    <tr>
                      <td><b>30 people help move a package</b></td>
                      <td><b>30 NWP</b> (one per helper) issued by seller</td>
                      <td>Recognizes every helper fairly</td>
                    </tr>
                    <tr>
                      <td><b>Many small acts over time</b></td>
                      <td>Ledger totals in tiny units (down to sextillionths)</td>
                      <td>Keeps long-term accounting accurate and fair</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="callout">
              <b>Where money is handled (simple)</b>
              The <b>d-DAO General Ledger</b> is non-custodial and does not hold or move money.
              The <b>Voluntary Fulfillment Network (VFN)</b> is the sole custodial network for any fiat or MSB activity.
              <span class="muted">This page explains loyalty accounting records only.</span>
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Cookie Jar Economy launch</b>
              Seller pledges (like <b>$10.30</b>) support the Cookie Jar Economy scheduled for <b>May 17, 2030</b>.
              Until then, the ledger focuses on <b>verified records</b> and <b>loyalty accounting</b>.
            </div>
          </div>

          <!-- RIGHT -->
          <aside class="cta">
            <a class="btn btnPrimary" href="register-device">
              <div>
                Register This Device
                <span class="sub">Start earning loyalty credit</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="pod-mode">
              <div>
                Enter PoD Mode
                <span class="sub">Scan • confirm • record</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="how-it-works">
              <div>
                Read “How It Works”
                <span class="sub">Simple overview</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="faq">
              <div>
                FAQs & Rules
                <span class="sub">Clear answers</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <div class="fineprint">
              <b>Plain-language summary:</b><br />
              YAM JAM is “You And Me, Just Alternative Money”—meaning an alternative way to <b>measure</b> human value,
              not a way to spend money. The 21,000-to-1 peg and sextillionth units are used for ledger math only.
            </div>
          </aside>
        </div>

      </div>
    </section>
  </main>
</body>
</html>

