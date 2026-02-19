<?php
/**
 * 
 * Template Name: How it Works
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>How It Works | HumanBlockchain.info</title>

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
      --soft: rgba(255,255,255,.06);
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
      position: relative;
    }
    .brand{
      display:flex; gap:10px; align-items:center;
      text-decoration:none; color:var(--text);
      min-width:260px;
      flex-shrink: 0;
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
    .panel h4{
      margin:12px 0 8px;
      color:rgba(255,255,255,.92);
      font-size:16px;
      letter-spacing:.1px;
    }
    ul{margin:0;padding-left:18px}
    li{margin:9px 0;font-size:16px;line-height:1.6}

    .steps{display:grid;gap:12px;margin-top:6px}
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

    /* Right rail CTAs */
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

    /* Simple “cards” */
    .miniCards{
      display:grid;gap:10px;margin-top:10px;
    }
    .mini{
      padding:14px;border-radius:16px;border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.16);
    }
    .mini b{display:block;margin-bottom:6px}
  </style>
</head>

<body>
  <header class="nav">
    <div class="nav-inner">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
        <div>
          <h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
          <small>How It Works</small>
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
        <div class="badge"><span class="dot" aria-hidden="true"></span> Scan • Confirm • Earn loyalty credit • Build community</div>

        <h2>How It Works</h2>
        <p class="muted">
          HumanBlockchain is a simple way to confirm deliveries, recognize helpers, and track loyalty credit.
          You don’t need to understand technology. If you can scan a code and answer a question, you can use it.
        </p>

        <div class="grid">

          <!-- LEFT CONTENT -->
          <div>
            <div class="panel">
              <h3>Step-by-step (the short version)</h3>
              <div class="steps">
                <div class="step">
                  <div class="num">1</div>
                  <div>
                    <b>Register your device</b>
                    <div class="muted">Your phone becomes your “membership card.”</div>
                  </div>
                </div>
                <div class="step">
                  <div class="num">2</div>
                  <div>
                    <b>Accept the Discord invite</b>
                    <div class="muted">Discord is our community room for help, updates, and group proof.</div>
                  </div>
                </div>
                <div class="step">
                  <div class="num">3</div>
                  <div>
                    <b>Use 2-scan Proof of Delivery</b>
                    <div class="muted">Seller starts it. Buyer confirms it. Helpers are recognized.</div>
                  </div>
                </div>
                <div class="step">
                  <div class="num">4</div>
                  <div>
                    <b>Earn loyalty credit</b>
                    <div class="muted">New World Penny (NWP) for helpers + $5 buyer rebate in XP.</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="panel">
              <h3>Discord acceptance (why it matters)</h3>
              <p>
                Discord is where the community stays connected. When you accept the invite, you can:
              </p>
              <ul>
                <li>Get help from real people (and see updates)</li>
                <li>View your referral status and community messages</li>
                <li>Participate in group activities that unlock membership status (when required)</li>
              </ul>

              <div class="callout">
                <b>Simple rule</b>
                Device registration is your “check-in.” Discord acceptance is your “welcome handshake.”
                Both are required to fully participate.
              </div>
            </div>

            <div class="panel">
              <h3>Serendipity role assignment</h3>
              <p>
                When you register, the system assigns you to community roles automatically.
                This is called <b>Serendipity</b>—it keeps things fair and prevents favoritism.
              </p>

              <div class="miniCards">
                <div class="mini">
                  <b>You are assigned two groups</b>
                  One as a <b>buyer group</b> and one as a <b>seller group</b>.
                  <span class="muted">This helps build local trust and wider connection.</span>
                </div>
                <div class="mini">
                  <b>Assignments are based on timing and location</b>
                  People registering around the same time are grouped together.
                  <span class="muted">You don’t have to “pick a team.”</span>
                </div>
                <div class="mini">
                  <b>You can still participate immediately</b>
                  Your assignment simply organizes the community and helps routing decisions later.
                </div>
              </div>
            </div>

            <div class="panel">
              <h3>Referral bonus (simple and fair)</h3>
              <p>
                If someone invited you, they may earn a referral bonus after you complete the basic steps.
                Referral bonuses are recorded as loyalty accounting (XP), not money.
              </p>

              <ul>
                <li><b>Inviter must be registered</b> before inviting others</li>
                <li>You can register <b>with a sponsor</b> or <b>by yourself</b></li>
                <li>Referral bonuses follow an <b>8–12 week maturity window</b> before any outside settlement is considered</li>
              </ul>

              <div class="callout warn">
                <span class="warnDot" aria-hidden="true"></span><b>Important</b>
                This site tracks <b>verification and loyalty accounting</b>.
                Any fiat or MSB activity (if used) happens in the <b>Voluntary Fulfillment Network (VFN)</b> or seller systems,
                not inside the ledger.
              </div>
            </div>

            <div class="panel">
              <h3>Proof of Delivery (the key question)</h3>
              <p>
                Along a delivery route, everyone may be asked:
                <b>“Is this the final destination?”</b>
              </p>
              <ul>
                <li><b>Handoffs answer “No”</b> → each helper is recognized with <b>1 NWP</b> issued by the seller</li>
                <li><b>The final stop answers “Yes”</b> → the delivery arrival is confirmed</li>
                <li><b>Buyer acceptance</b> assigns the <b>$5 buyer rebate in XP</b></li>
              </ul>
              <div class="callout">
                <b>Example</b>
                If 30 people helped move a package along, the seller issues <b>30 New World Pennies</b>—one per helper.
              </div>
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Cookie Jar Economy launch</b>
              The seller pledge of <b>$10.30</b> supports the Cookie Jar Economy, scheduled to launch on
              <b>May 17, 2030</b>. Until then, pledges and confirmations are recorded to build long-term trust.
            </div>
          </div>

          <!-- RIGHT RAIL CTAs -->
          <aside class="cta">
            <a class="btn btnPrimary" href="device-register">
              <div>
                Register My Device
                <span class="sub">Start here • simple check-in</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="discord-invite">
              <div>
                Accept Discord Invite
                <span class="sub">Join the community room</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="pod-mode">
              <div>
                Enter PoD Mode
                <span class="sub">Scan 1 / Scan 2</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="loyalty-xp">
              <div>
                Loyalty Points (XP & NWP)
                <span class="sub">What you earn and why</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="faq">
              <div>
                FAQs & Rules
                <span class="sub">Clear answers, no jargon</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <div class="fineprint">
              <b>Plain-language promise:</b><br />
              If you can scan and answer yes/no, you can use this system.
              The goal is simple: verify real deliveries and reward helpful people.
            </div>
          </aside>

        </div>
      </div>
    </section>
  </main>
</body>
</html>


