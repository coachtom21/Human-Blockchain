<?php
/*
Template: PoD Mode
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PoD Mode | HumanBlockchain.info</title>

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
      --danger:#fb7185;
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

    /* Mode tiles */
    .tiles{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:12px;
      margin-top:12px;
    }
    @media(max-width:760px){ .tiles{grid-template-columns:1fr} }
    .tile{
      border-radius:16px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.04);
      padding:14px;
      display:flex;
      flex-direction:column;
      gap:10px;
      min-height:140px;
    }
    .tile b{font-size:16px}
    .tile .mini{font-size:13px;color:var(--muted);line-height:1.45}
    .tile a{
      margin-top:auto;
      text-decoration:none;
      font-weight:950;
      display:flex;justify-content:space-between;align-items:center;
      padding:12px 12px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      color: var(--text);
    }
    .tile a.primary{
      background: linear-gradient(180deg,#34d399,#10b981);
      color:#052015;
      border-color: rgba(52,211,153,.35);
    }

    /* Steps */
    .steps{display:grid;gap:12px;margin-top:10px}
    .step{
      display:flex; gap:12px; align-items:flex-start;
      padding:12px;
      border-radius:16px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.04);
    }
    .num{
      width:30px;height:30px;border-radius:50%;
      display:flex;align-items:center;justify-content:center;
      background:var(--accent);color:#062015;
      font-weight:950;font-size:14px;
      flex:0 0 auto;
      margin-top:2px;
    }
    .tag{
      display:inline-flex;align-items:center;gap:8px;
      padding:6px 10px;border-radius:999px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      color: var(--muted);
      font-weight:900;
      font-size:12px;
      margin-top:8px;
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
    .callout.danger{
      border-color: rgba(251,113,133,.35);
      background: rgba(251,113,133,.08);
    }
    .warnDot{
      display:inline-block;
      width:10px;height:10px;border-radius:50%;
      background: var(--warn);
      box-shadow:0 0 0 3px rgba(251,191,36,.16);
      margin-right:10px;
      vertical-align:middle;
    }

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
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>

<body>
  <header class="nav">
    <div class="nav-inner">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
        <div>
          <h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
          <small>Proof of Delivery Mode</small>
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

        <div class="badge"><span class="dot" aria-hidden="true"></span> PoD Mode • scan • answer • confirm</div>

        <h2>PoD Mode</h2>
        <p class="muted">
          PoD Mode is the simple “delivery confirmation” screen.
          If you can scan a code and answer a question, you can do Proof of Delivery.
        </p>

        <div class="grid">
          <!-- LEFT -->
          <div>
            <div class="panel">
              <h3>Choose what you want to do</h3>

              <div class="tiles">
                <div class="tile">
                  <b>Start Scan 1 (Seller Initiates)</b>
                  <div class="mini">
                    Seller selects “Seller,” pledges <b>$10.30</b>, and creates the Transaction ID.
                    This begins the delivery record.
                  </div>
                  <a class="primary" href="scan-1">
                    Start Scan 1 <span>→</span>
                  </a>
                </div>

                <div class="tile">
                  <b>Complete Scan 2 (Buyer Confirms)</b>
                  <div class="mini">
                    Buyer validates the Transaction ID and accepts receipt.
                    This completes the delivery confirmation.
                  </div>
                  <a href="scan-2">
                    Complete Scan 2 <span>→</span>
                  </a>
                </div>

                <div class="tile">
                  <b>View PoD History</b>
                  <div class="mini">
                    See your recent confirmations, handoffs, and completed deliveries.
                    (For your device only.)
                  </div>
                  <a href="pod-history">
                    View History <span>→</span>
                  </a>
                </div>

                <div class="tile">
                  <b>PoD Help & Troubleshooting</b>
                  <div class="mini">
                    Fix common scan issues: wrong code, weak signal, camera trouble, or role confusion.
                  </div>
                  <a href="pod-help">
                    Get Help <span>→</span>
                  </a>
                </div>
              </div>
            </div>

            <div class="panel">
              <h3>What you will be asked</h3>
              <div class="steps">
                <div class="step">
                  <div class="num">1</div>
                  <div>
                    <b>“Is this Proof of Delivery?”</b>
                    <div class="muted">If yes, the scan is recorded with time and location.</div>
                    <div class="tag">Simple: Yes / No</div>
                  </div>
                </div>

                <div class="step">
                  <div class="num">2</div>
                  <div>
                    <b>“Is this the final destination?”</b>
                    <div class="muted">
                      Handoffs answer <b>No</b>. Only the true final stop answers <b>Yes</b>.
                      Every “No” and the single “Yes” earns <b>1 New World Penny (NWP)</b> issued by the seller.
                    </div>
                    <div class="tag">Handoff = No • Final stop = Yes</div>
                  </div>
                </div>

                <div class="step">
                  <div class="num">3</div>
                  <div>
                    <b>Buyer accepts receipt</b>
                    <div class="muted">
                      After the final destination is confirmed, the buyer selects the Buyer role and accepts receipt.
                      This assigns the <b>$5 buyer rebate in XP</b>.
                    </div>
                    <div class="tag">$5 XP buyer rebate</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="callout">
              <b>New World Penny (NWP) for every helper</b>
              Every handoff that answers <b>No</b> and the single final destination <b>Yes</b> earns <b>1 NWP</b>.
              The seller issues one NWP per helper to the Human Blockchain for delivery work.
              <br><br>
              <b>Example:</b> If 30 people helped move the package, the seller issues <b>30 NWP</b>.
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Plain-language custody clarification</b>
              The <b>d-DAO General Ledger is non-custodial</b>—it does not hold or move money.
              The <b>Voluntary Fulfillment Network (VFN)</b> is the <b>sole custodial network</b> for any fiat or MSB activity.
              <span class="muted">PoD Mode records verification and loyalty accounting only.</span>
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Cookie Jar Economy launch</b>
              The seller pledge of <b>$10.30</b> supports the Cookie Jar Economy scheduled for
              <b>May 17, 2030</b>.
              <span class="muted">Note: $0.30 is allocated to PoD service cost of goods sold (COGS).</span>
            </div>

            <div class="callout danger">
              <b>Safety note</b>
              Never scan while driving. Pull over or stop first. If you are unsure, use Help & Troubleshooting.
            </div>
          </div>

          <!-- RIGHT -->
          <aside class="cta">
            <a class="btn btnPrimary" href="pod-mode-live">
              <div>
                Enter PoD Mode Now
                <span class="sub">Open camera • scan a code</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="register-device">
              <div>
                Register This Device
                <span class="sub">Required before earning credit</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="scan-1">
              <div>
                Start Scan 1 (Seller)
                <span class="sub">Pledge $10.30 • create Transaction ID</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="scan-2">
              <div>
                Complete Scan 2 (Buyer)
                <span class="sub">Validate Transaction ID • accept receipt</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="pod-help">
              <div>
                PoD Help & Troubleshooting
                <span class="sub">Fix scan problems fast</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <div class="fineprint">
              <b>Tip:</b> If you’re handing off a package, you’ll usually answer:
              <b>“Yes, this is Proof of Delivery”</b> and <b>“No, this is not the final destination.”</b>
            </div>
          </aside>
        </div>

      </div>
    </section>
  </main>
</body>
</html>


