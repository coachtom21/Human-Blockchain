<?php

/**
 * Template Name: Serendipity Protocol
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Serendipity Protocol | HumanBlockchain.info</title>

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
    p{margin:10px 0;font-size:16px;line-height:1.65}
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

    /* Steps */
    .steps{
      display:grid;
      gap:10px;
      margin-top:10px;
    }
    .step{
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.04);
      border-radius:16px;
      padding:14px;
    }
    .stepTop{
      display:flex;align-items:center;justify-content:space-between;gap:12px;
      margin-bottom:8px;
    }
    .num{
      width:32px;height:32px;border-radius:12px;
      display:flex;align-items:center;justify-content:center;
      background: rgba(52,211,153,.12);
      border:1px solid rgba(52,211,153,.28);
      color: var(--text);
      font-weight:950;
    }
    .stepTitle{
      font-weight:950;
      font-size:16px;
      letter-spacing:.15px;
      flex:1;
    }
    .pill{
      padding:7px 10px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      color: var(--muted);
      font-size:12px;
      font-weight:850;
      white-space:nowrap;
    }
    ul{margin:8px 0 0;padding-left:18px}
    li{margin:8px 0;line-height:1.6}

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
  </style>
</head>

<body>
  <header class="nav">
    <div class="nav-inner">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
        <div>
          <h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
          <small>Serendipity Protocol</small>
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

        <div class="badge"><span class="dot" aria-hidden="true"></span> Location + timestamp • local buyers • global sellers • marketplace of ideas</div>

        <h2>Serendipity Protocol</h2>
        <p class="muted">
          Serendipity is the moment your device joins the network.
          Your <b>location</b> and <b>timestamp</b> help organize the community in a fair way—without forms,
          without gatekeepers, and without needing to “know the right people.”
        </p>

        <div class="grid">
          <!-- LEFT -->
          <div>
            <div class="panel">
              <h3>What this protocol does (plain language)</h3>
              <ul>
                <li>Creates a <b>local Buyer circle</b> (people near you)</li>
                <li>Creates a <b>global Seller circle</b> (people beyond your local area)</li>
                <li>Builds a YAM JAM <b>marketplace of ideas</b> where participation is verified by the 2-scan method</li>
              </ul>

              <div class="callout warn">
                <span class="warnDot" aria-hidden="true"></span><b>YAM JAM reminder</b>
                YAM JAM means <b>You And Me, Just Alternative Money</b>.
                Here, “alternative money” means an <b>alternative measuring stick</b> for human value—not cash.
              </div>
            </div>

            <div class="panel">
              <h3>How Serendipity works (step-by-step)</h3>
              <div class="steps">
                <div class="step">
                  <div class="stepTop">
                    <div class="num">1</div>
                    <div class="stepTitle">Register your device</div>
                    <div class="pill">Location + timestamp</div>
                  </div>
                  <div class="muted">
                    Your device creates a “moment in time” record. That moment is used to organize fair groups.
                  </div>
                </div>

                <div class="step">
                  <div class="stepTop">
                    <div class="num">2</div>
                    <div class="stepTitle">Local buyers form naturally</div>
                    <div class="pill">Near you</div>
                  </div>
                  <div class="muted">
                    Devices registering in the same area create a local neighborhood buyer circle—
                    a marketplace of practical needs and everyday coordination.
                  </div>
                </div>

                <div class="step">
                  <div class="stepTop">
                    <div class="num">3</div>
                    <div class="stepTitle">Global sellers connect beyond borders</div>
                    <div class="pill">Beyond your area</div>
                  </div>
                  <div class="muted">
                    Sellers are organized to be broader than your local circle. The goal is to
                    build bridging relationships—out of state, and eventually worldwide.
                  </div>
                </div>

                <div class="step">
                  <div class="stepTop">
                    <div class="num">4</div>
                    <div class="stepTitle">Ideas become visible through verified action</div>
                    <div class="pill">2-scan proof</div>
                  </div>
                  <div class="muted">
                    The marketplace of ideas isn’t just talk—people show up, deliver, and confirm using the two-scan method.
                    Verified actions become loyalty accounting entries (XP / New World Penny).
                  </div>
                </div>
              </div>
            </div>

            <div class="panel">
              <h3>What gets organized by location and timestamp?</h3>
              <div class="tableWrap">
                <table aria-label="Serendipity organization table">
                  <thead>
                    <tr>
                      <th>Signal</th>
                      <th>What it helps create</th>
                      <th>Why it matters</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>Location</b></td>
                      <td>Local buyer circle</td>
                      <td>Builds trust and practical collaboration close to home</td>
                    </tr>
                    <tr>
                      <td><b>Timestamp</b></td>
                      <td>Fair ordering & grouping</td>
                      <td>Prevents “insiders” from controlling who gets placed where</td>
                    </tr>
                    <tr>
                      <td><b>Combined</b></td>
                      <td>Local buyers + global sellers</td>
                      <td>Creates a balanced network: local stability + global ideas</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="callout">
              <b>Why we call it a “marketplace of ideas”</b>
              Because the network rewards <b>proof</b>, not hype. People propose ideas, then demonstrate them by
              doing real deliveries, real handoffs, and real confirmations using the universal QR and the two-scan method.
              <span class="muted">Ideas become more valuable when they are carried by action.</span>
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>How VFN fits in</b>
              The Voluntary Fulfillment Network (VFN) is the network of buyers and sellers using 2-scan accounting.
              VFN performs monthly reconciliation to an <b>append-only general ledger</b> for receipts and obligations.
            </div>
          </div>

          <!-- RIGHT -->
          <aside class="cta">
            <a class="btn btnPrimary" href="register-device">
              <div>
                Register This Device
                <span class="sub">Create your serendipity moment</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="pod-mode">
              <div>
                Enter PoD Mode
                <span class="sub">Use the universal QR</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="how-it-works">
              <div>
                Read How It Works
                <span class="sub">Simple overview</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="faq">
              <div>
                FAQs
                <span class="sub">Quick answers</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <div class="fineprint">
              <b>Plain-language summary:</b><br />
              Serendipity uses device registration location and timestamp to form local buyers and global sellers,
              so your YAM JAM marketplace grows by verified action—not paperwork.
            </div>
          </aside>
        </div>

      </div>
    </section>
  </main>
</body>
</html>
