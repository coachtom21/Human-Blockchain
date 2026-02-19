<?php
/**
 * Template: Proof of Delivery
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>I Have Proof of Delivery | HumanBlockchain.info</title>
  <meta name="description" content="Confirm a delivery using the 2-scan Proof of Delivery protocol. Receiver acceptance (Scan #2) finalizes the ledger entry as XP." />
  <style>
    :root{
      --bg:#0b1020;
      --panel: rgba(255,255,255,.06);
      --text: rgba(255,255,255,.92);
      --muted: rgba(255,255,255,.72);
      --line: rgba(255,255,255,.14);
      --accent:#7dd3fc;
      --accent2:#a78bfa;
      --good:#34d399;
      --warn:#fbbf24;
      --danger:#fb7185;
      --shadow: 0 20px 60px rgba(0,0,0,.45);
      --radius: 18px;
      --radius2: 26px;
      --max: 1120px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
      color:var(--text);
      background:
        radial-gradient(1200px 700px at 10% 10%, rgba(125,211,252,.18), transparent 55%),
        radial-gradient(900px 600px at 92% 18%, rgba(167,139,250,.18), transparent 55%),
        radial-gradient(900px 700px at 40% 105%, rgba(52,211,153,.14), transparent 60%),
        linear-gradient(180deg, #070a14 0%, #0b1020 55%, #070a14 100%);
      overflow-x:hidden;
    }
    a{color:inherit; text-decoration:none}
    .wrap{max-width:var(--max); margin:0 auto; padding:24px}

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
    .brand{display:flex; gap:10px; align-items:center;
      text-decoration:none; color:var(--text);
      min-width:260px;
    }
    .logo{
      width:28px; height:28px; border-radius:10px;
      background: conic-gradient(from 210deg, var(--accent), var(--accent2), var(--good), var(--accent));
      box-shadow: 0 10px 30px rgba(0,0,0,.35);
      border:1px solid rgba(255,255,255,.18);
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
    .nav-links a:hover{
      background: rgba(255,255,255,.08);
      border-color: rgba(255,255,255,.22);
    }

    /* Cards / type */
    .card{
      border:1px solid var(--line);
      border-radius: var(--radius2);
      background: linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.04));
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .card-inner{padding:22px}
    .badge{
      display:inline-flex; align-items:center; gap:8px;
      font-size:12px;
      padding:8px 10px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.18);
      background: rgba(255,255,255,.05);
      color: rgba(255,255,255,.85);
    }
    .dot{width:9px; height:9px; border-radius:50%; background: var(--accent)}
    .title{
      margin:14px 0 8px;
      font-size:38px;
      line-height:1.08;
      letter-spacing:-0.02em;
    }
    .lead{
      margin:0;
      color: var(--muted);
      font-size:16px;
      line-height:1.6;
      max-width: 84ch;
    }
    .kicker{
      font-size:12px;
      letter-spacing:.14em;
      text-transform:uppercase;
      color: rgba(255,255,255,.72);
      margin:0 0 10px;
    }
    .h2{margin:0 0 10px; font-size:22px; letter-spacing:-0.01em}
    .small{font-size:13px; color:var(--muted); line-height:1.65}

    /* Layout */
    .hero{padding:34px 0 10px}
    .hero-grid{
      display:grid;
      grid-template-columns: 1.2fr .8fr;
      gap:18px;
      align-items:stretch;
    }
    @media (max-width: 940px){
      .hero-grid{grid-template-columns:1fr}
      .brand{min-width:auto}
    }

    /* Buttons */
    .cta{display:flex; gap:10px; flex-wrap:wrap; margin-top:14px}
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:8px;
      padding:12px 14px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.18);
      background: rgba(255,255,255,.06);
      color: rgba(255,255,255,.9);
      font-size:13px;
      cursor:pointer;
      transition: transform .12s ease, background .12s ease, border-color .12s ease;
      user-select:none;
      white-space:nowrap;
    }
    .btn:hover{transform: translateY(-1px); background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.25)}
    .btn.primary{
      border-color: rgba(125,211,252,.38);
      background: linear-gradient(180deg, rgba(125,211,252,.22), rgba(125,211,252,.10));
    }
    .btn.good{
      border-color: rgba(52,211,153,.35);
      background: linear-gradient(180deg, rgba(52,211,153,.20), rgba(52,211,153,.08));
    }
    .btn.warn{
      border-color: rgba(251,191,36,.40);
      background: linear-gradient(180deg, rgba(251,191,36,.22), rgba(251,191,36,.10));
    }
    .btn.danger{
      border-color: rgba(251,113,133,.40);
      background: linear-gradient(180deg, rgba(251,113,133,.20), rgba(251,113,133,.08));
    }

    /* Mini blocks */
    .mini{
      border:1px solid var(--line);
      border-radius: var(--radius);
      background: rgba(255,255,255,.04);
      padding:16px;
      margin-top:12px;
    }
    .mini h3{
      margin:0 0 6px;
      font-size:13px;
      letter-spacing:.06em;
      text-transform:uppercase;
      color: rgba(255,255,255,.86);
      display:flex; align-items:center; gap:8px;
    }
    .chip{display:inline-block; width:9px; height:9px; border-radius:50%; background: var(--good)}
    .mini p{margin:0; color:var(--muted); font-size:13px; line-height:1.6}

    /* Steps */
    .steps{display:grid; gap:12px; margin-top:14px}
    .step{
      border:1px solid var(--line);
      border-radius: 18px;
      background: rgba(255,255,255,.04);
      padding:14px;
      display:flex; gap:12px; align-items:flex-start;
    }
    .num{
      width:34px; height:34px;
      border-radius:14px;
      display:grid; place-items:center;
      border:1px solid rgba(255,255,255,.18);
      background: rgba(255,255,255,.06);
      font-weight:800;
      color: rgba(255,255,255,.9);
      flex:0 0 auto;
      margin-top:1px;
    }
    .step b{display:block; margin:0 0 3px; font-size:14px}
    .step span{display:block; color:var(--muted); font-size:13px; line-height:1.55}

    /* Form */
    .form{
      margin-top:14px;
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:12px;
    }
    @media (max-width: 720px){ .form{grid-template-columns:1fr} }

    label{
      display:block;
      font-size:12px;
      letter-spacing:.08em;
      text-transform:uppercase;
      color: rgba(255,255,255,.75);
      margin:0 0 8px;
    }
    .field{
      border:1px solid rgba(255,255,255,.16);
      border-radius: 16px;
      background: rgba(255,255,255,.04);
      padding:12px 12px;
    }
    input, select, textarea{
      width:100%;
      border:0;
      outline:0;
      background: transparent;
      color: rgba(255,255,255,.92);
      font-size:14px;
      font-family: inherit;
    }
    textarea{min-height:92px; resize:vertical}
    .hint{
      margin-top:8px;
      color: rgba(255,255,255,.62);
      font-size:12px;
      line-height:1.5;
    }
    .rowspan{grid-column:1 / -1}

    .checks{
      display:grid;
      gap:10px;
      margin-top:10px;
      padding:14px;
      border-radius: 16px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.03);
    }
    .check{display:flex; gap:10px; align-items:flex-start; font-size:13px; line-height:1.5; color: rgba(255,255,255,.82)}
    .check input{width:auto; margin-top:2px}

    .note{
      margin-top:12px;
      border-left:3px solid rgba(52,211,153,.55);
      padding:14px 14px 14px 16px;
      border-radius: 14px;
      background: rgba(52,211,153,.08);
      color: rgba(255,255,255,.86);
      font-size:13px;
      line-height:1.6;
    }
    .warn{
      margin-top:12px;
      border-left:3px solid rgba(251,191,36,.55);
      padding:14px 14px 14px 16px;
      border-radius: 14px;
      background: rgba(251,191,36,.08);
      color: rgba(255,255,255,.86);
      font-size:13px;
      line-height:1.6;
    }

    .foot{
      margin:18px 0 34px;
      padding:16px;
      border:1px solid var(--line);
      border-radius: var(--radius);
      background: rgba(255,255,255,.03);
      color: var(--muted);
      font-size:12px;
      line-height:1.65;
    }

    .toast{
      position:fixed; left:50%; bottom:18px; transform:translateX(-50%);
      background: rgba(0,0,0,.65);
      border:1px solid rgba(255,255,255,.16);
      color: rgba(255,255,255,.92);
      padding:10px 12px;
      border-radius: 999px;
      font-size:12px;
      backdrop-filter: blur(10px);
      display:none;
      z-index:60;
    }

    /* Payload preview */
    code{
      display:block;
      margin-top:10px;
      padding:12px;
      border-radius: 14px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.25);
      color: rgba(255,255,255,.90);
      font-size:12px;
      line-height:1.55;
      overflow:auto;
      white-space:pre-wrap;
      word-break:break-word;
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
          <small>I Have Proof of Delivery</small>
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

  <main class="wrap" role="main">
    <section class="hero">
      <div class="hero-grid">
        <!-- Left -->
        <div class="card">
          <div class="card-inner">
            <span class="badge"><span class="dot" aria-hidden="true"></span> 2-Scan Protocol • Receiver Confirms • XP Posts</span>
            <h2 class="title">I Have Proof of Delivery</h2>
            <p class="lead">
              If you received a package or completed a delivery, this is where truth gets recorded.
              <strong>Scan #2 (receiver acceptance)</strong> finalizes the event in the ledger as XP.
            </p>

            <div class="steps" aria-label="How to confirm a delivery">
              <div class="step">
                <div class="num" aria-hidden="true">1</div>
                <div>
                  <b>Enter the delivery credential</b>
                  <span>Type or paste the voucher / delivery credential ID from the package or label.</span>
                </div>
              </div>
              <div class="step">
                <div class="num" aria-hidden="true">2</div>
                <div>
                  <b>Confirm final destination</b>
                  <span>Was this the last stop? If yes, settlement can be finalized and recognition can be issued.</span>
                </div>
              </div>
              <div class="step">
                <div class="num" aria-hidden="true">3</div>
                <div>
                  <b>Receiver accepts (Scan #2)</b>
                  <span>This is the anti-fraud moment. No acceptance = no finalized entry.</span>
                </div>
              </div>
            </div>

            <div class="note" role="note">
              <strong>Recognition:</strong> When a delivery is confirmed at the final destination, the system can mint a
              <strong>New World Penny</strong> service award to the final delivery person (and optionally record in-route “handoff” touches).
            </div>

            <div class="cta">
              <button class="btn primary" type="button" onclick="scrollToForm()">Confirm Now</button>
              <a class="btn good" href="new-world-penny">What is the New World Penny?</a>
              <a class="btn" href="faq">FAQ</a>
            </div>
          </div>
        </div>

        <!-- Right -->
        <aside class="card" aria-label="Rules and reminders">
          <div class="card-inner">
            <p class="kicker">Rules & reminders</p>
            <h3 class="h2">Keep it simple. Keep it true.</h3>

            <div class="mini">
              <h3><span class="chip" style="background:var(--good)"></span> Receiver has authority</h3>
              <p>Only the receiver can finalize acceptance. This stops phantom deliveries.</p>
            </div>

            <div class="mini">
              <h3><span class="chip" style="background:var(--warn)"></span> Vouchers are not postage</h3>
              <p>Never call them “stamps.” Use voucher / delivery credential terms only.</p>
            </div>

            <div class="mini">
              <h3><span class="chip" style="background:var(--accent)"></span> XP is cooperative accounting</h3>
              <p>XP records participation. This portal is non-custodial and does not hold your money.</p>
            </div>

            <div class="warn" role="note">
              <strong>Tip:</strong> If you are not registered yet, register your device first so your scan can be trusted and credited.
              <div class="cta" style="margin-top:10px;">
                <a class="btn warn" href="register-device">Register Device</a>
                <a class="btn" href="join">Join the DAO</a>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </section>

    <!-- Confirmation form -->
    <section class="card" id="podForm" aria-label="Proof of Delivery confirmation">
      <div class="card-inner">
        <p class="kicker">Scan #2 • Acceptance</p>
        <h3 class="h2">Confirm delivery (receiver acceptance)</h3>
        <p class="small">
          This is the receiver’s confirmation page. Wire it to your backend endpoint to post the finalized ledger entry.
          In production, the system should validate: registered device witness, voucher ID, expected receiver, timestamp,
          and (optional) location if enabled by policy.
        </p>

        <!-- Integration: set action="/api/pod/accept" method="POST" -->
        <form class="form" action="#" method="post" onsubmit="return handleSubmit(event)">
          <div class="field">
            <label for="voucherId">Voucher / delivery credential ID</label>
            <input id="voucherId" name="voucherId" type="text" placeholder="e.g., YAM-POD-000123" required />
            <div class="hint">Use the ID printed on the delivery credential attached to the package.</div>
          </div>

          <div class="field">
            <label for="receiverId">Receiver (you)</label>
            <input id="receiverId" name="receiverId" type="text" placeholder="Member ID / name" required />
            <div class="hint">The receiver is the final authority on acceptance.</div>
          </div>

          <div class="field">
            <label for="finalDest">Is this the final destination?</label>
            <select id="finalDest" name="finalDest" required>
              <option value="" disabled selected>Select…</option>
              <option value="yes">Yes — final destination</option>
              <option value="no">No — this was a handoff</option>
            </select>
            <div class="hint">Final destination enables settlement + service recognition rules.</div>
          </div>

          <div class="field">
            <label for="condition">Condition on arrival</label>
            <select id="condition" name="condition" required>
              <option value="" disabled selected>Select…</option>
              <option value="good">Good / acceptable</option>
              <option value="partial">Partial / needs follow-up</option>
              <option value="damaged">Damaged / dispute likely</option>
            </select>
            <div class="hint">This helps route disputes without breaking the ledger’s truth.</div>
          </div>

          <div class="field">
            <label for="deliveryPerson">Final delivery person (if known)</label>
            <input id="deliveryPerson" name="deliveryPerson" type="text" placeholder="Delivery person ID / name" />
            <div class="hint">Used to mint a New World Penny service award when final destination is confirmed.</div>
          </div>

          <div class="field">
            <label for="hands">How many hands touched this delivery?</label>
            <select id="hands" name="hands" required>
              <option value="" disabled selected>Select…</option>
              <option value="1">1 (final delivery only)</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="30">30</option>
            </select>
            <div class="hint">Optional: record in-route handoffs for transparency and recognition policy.</div>
          </div>

          <div class="field">
            <label for="location">Delivery location (optional)</label>
            <input id="location" name="location" type="text" placeholder="City, State / GPS (if enabled)" />
            <div class="hint">Optional. Only include if you opted in to location during scans.</div>
          </div>

          <div class="field">
            <label for="branch">Your Peace Pentagon branch</label>
            <select id="branch" name="branch" required>
              <option value="" disabled selected>Select…</option>
              <option value="planning">Planning</option>
              <option value="budget">Budget</option>
              <option value="media">Media</option>
              <option value="distribution">Distribution</option>
              <option value="membership">Membership</option>
            </select>
            <div class="hint">Branch is part of your membership role assignments.</div>
          </div>

          <div class="field rowspan">
            <label for="notes">Visible acceptance note (optional)</label>
            <textarea id="notes" name="notes" placeholder="A short, factual acceptance note..."></textarea>
            <div class="hint">Keep it factual and respectful. This can be visible as part of the recognition culture.</div>
          </div>

          <div class="rowspan checks" aria-label="Acceptance confirmations">
            <div class="check">
              <input id="agree1" name="agree1" type="checkbox" required />
              <label for="agree1" style="margin:0; text-transform:none; letter-spacing:normal; font-size:13px; color:rgba(255,255,255,.82);">
                I confirm the delivery credential ID matches what is on the package.
              </label>
            </div>
            <div class="check">
              <input id="agree2" name="agree2" type="checkbox" required />
              <label for="agree2" style="margin:0; text-transform:none; letter-spacing:normal; font-size:13px; color:rgba(255,255,255,.82);">
                I understand Scan #2 is the receiver’s acceptance and finalizes the ledger entry as XP.
              </label>
            </div>
            <div class="check">
              <input id="agree3" name="agree3" type="checkbox" required />
              <label for="agree3" style="margin:0; text-transform:none; letter-spacing:normal; font-size:13px; color:rgba(255,255,255,.82);">
                I understand XP is cooperative accounting (not money) and this portal is non-custodial.
              </label>
            </div>
          </div>

          <div class="rowspan cta">
            <button class="btn primary" type="submit">Accept Delivery (Demo)</button>
            <button class="btn" type="button" onclick="buildPreview()">Preview Ledger Entry</button>
            <a class="btn good" href="new-world-penny">New World Penny</a>
            <a class="btn warn" href="faq">FAQ</a>
          </div>
        </form>

        <div class="mini" style="margin-top:16px;">
          <h3><span class="chip" style="background:var(--accent2)"></span> Ledger preview (demo)</h3>
          <p class="small">This shows what a clean, append-only “acceptance event” could look like before it is posted.</p>
          <code id="preview">
{
  "type": "POD_ACCEPTANCE",
  "voucher_id": "YAM-POD-000123",
  "receiver": "Receiver ID",
  "final_destination": true,
  "condition": "good",
  "hands_touched": 1,
  "branch": "distribution",
  "timestamp": "auto",
  "location": "optional",
  "recognition": {
    "new_world_penny": true,
    "awarded_to": "Final Delivery Person"
  }
}
          </code>
        </div>

        <div class="foot">
          <strong>Measurement note:</strong> XP may be expressed using the reference convention
          <strong>21,000 YAM = $1 USD</strong> for reporting. This is a measurement yardstick for cooperative accounting,
          not a custodial promise or immediate redemption guarantee.
        </div>
      </div>
    </section>
  </main>

  <div class="toast" id="toast" role="status" aria-live="polite">Saved (demo).</div>

  <script>
    function scrollToForm(){
      document.getElementById('podForm').scrollIntoView({behavior:'smooth', block:'start'});
    }

    function buildPreview(){
      const voucherId = document.getElementById('voucherId').value || "YAM-POD-000123";
      const receiverId = document.getElementById('receiverId').value || "Receiver ID";
      const finalDest = document.getElementById('finalDest').value === "yes";
      const condition = document.getElementById('condition').value || "good";
      const deliveryPerson = document.getElementById('deliveryPerson').value || "Final Delivery Person";
      const hands = Number(document.getElementById('hands').value || 1);
      const branch = document.getElementById('branch').value || "distribution";
      const location = document.getElementById('location').value || "optional";

      const payload = {
        type: "POD_ACCEPTANCE",
        voucher_id: voucherId,
        receiver: receiverId,
        final_destination: finalDest,
        condition: condition,
        hands_touched: hands,
        branch: branch,
        timestamp: "auto",
        location: location,
        recognition: {
          new_world_penny: finalDest,
          awarded_to: finalDest ? deliveryPerson : null
        }
      };

      document.getElementById('preview').innerText = JSON.stringify(payload, null, 2);
      showToast("Preview updated.");
    }

    // Demo submit
    function handleSubmit(e){
      e.preventDefault();
      buildPreview();
      const finalDest = document.getElementById('finalDest').value === "yes";
      showToast(finalDest ? "Accepted (demo). Final destination confirmed." : "Recorded (demo). Handoff noted.");
      return false;
    }

    function showToast(msg){
      const el = document.getElementById('toast');
      el.textContent = msg || "Done.";
      el.style.display = 'block';
      clearTimeout(window.__toastTimer);
      window.__toastTimer = setTimeout(()=>{ el.style.display='none'; }, 2200);
    }
  </script>
</body>
</html>

