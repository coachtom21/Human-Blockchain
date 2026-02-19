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
  <title>How This Works • Algorithm • Proof of Delivery (PoD) | <?php echo esc_attr( get_bloginfo( 'name' ) ); ?></title>

  <style>
    :root{
      --bg:#0b0f14;
      --card:#101824;
      --text:#e9eef6;
      --ink:#e9eef6;
      --muted:#b7c4d6;
      --line:rgba(255,255,255,.10);
      --shadow:0 18px 45px rgba(0,0,0,.35);
      --radius:18px;
      --btnRadius:12px;
      --accent:#34d399;
      --a:#7dd3fc;
      --b:#a78bfa;
      --ok:#86efac;
      --warn:#fde68a;
      --btn:#1f2a3a;
      --danger:#fb7185;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      min-height:100vh;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
      background:
        radial-gradient(1200px 600px at 20% 10%, rgba(125,211,252,.12), transparent 60%),
        radial-gradient(900px 500px at 80% 30%, rgba(167,139,250,.10), transparent 55%),
        var(--bg);
      color:var(--ink);
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
    a{color:var(--a);text-decoration:none}
    a:hover{text-decoration:underline}
    .hiw-wrap{max-width:1120px;margin:0 auto;padding:24px}
    .hiw-header{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:16px;flex-wrap:wrap}
    .hiw-brand{display:flex;align-items:center;gap:12px}
    .hiw-mark{width:44px;height:44px;border-radius:14px;background:linear-gradient(135deg,rgba(125,211,252,.35),rgba(167,139,250,.35));border:1px solid var(--line);box-shadow:0 12px 30px rgba(0,0,0,.35);flex-shrink:0;display:flex;align-items:center;justify-content:center;overflow:hidden}
    .hiw-mark img{height:100%;object-fit:contain;border-radius:14px}
    .hiw-brand h1{font-size:16px;margin:0}
    .hiw-brand .sub{margin:2px 0 0;color:var(--muted);font-size:12px;line-height:1.4}
    .hiw-nav{display:flex;gap:10px;flex-wrap:wrap}
    .hiw-btn{appearance:none;border:1px solid var(--line);background:var(--btn);color:var(--ink);padding:10px 12px;border-radius:12px;cursor:pointer;font-weight:800;font-size:13px;text-decoration:none;display:inline-block}
    .hiw-btn:hover{filter:brightness(1.1)}
    .hiw-btn.primary{background:linear-gradient(135deg,rgba(125,211,252,.25),rgba(167,139,250,.20))}
    .hero{display:grid;grid-template-columns:1.15fr .85fr;gap:14px;align-items:stretch}
    @media (max-width:980px){.hero{grid-template-columns:1fr}}
    .hiw-card{background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.02));border:1px solid var(--line);border-radius:18px;padding:18px;box-shadow:0 18px 45px rgba(0,0,0,.35)}
    .hiw-card h2{margin:8px 0 8px;font-size:30px;line-height:1.08}
    .lead{color:var(--muted);font-size:15px;line-height:1.6;margin:0}
    .kicker{display:flex;gap:8px;flex-wrap:wrap;align-items:center;color:var(--muted);font-size:12px}
    .pill{border:1px solid var(--line);border-radius:999px;padding:4px 10px;background:rgba(0,0,0,.25)}
    .hiw-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:14px}
    @media (max-width:980px){.hiw-grid{grid-template-columns:1fr}}
    .math{border:1px solid var(--line);background:rgba(255,255,255,.03);border-radius:16px;padding:14px;margin-top:12px}
    .math .row2{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    @media (max-width:980px){.math .row2{grid-template-columns:1fr}}
    .eq{padding:10px 12px;border-radius:14px;border:1px solid var(--line);background:rgba(0,0,0,.18);color:var(--muted);font-size:13px;line-height:1.5}
    .eq strong{color:var(--ink)}
    .calc{margin-top:12px;display:grid;grid-template-columns:1fr 1fr;gap:12px}
    @media (max-width:980px){.calc{grid-template-columns:1fr}}
    .calc label{display:block;font-size:12px;color:var(--muted);margin:10px 0 6px}
    .calc input{width:100%;padding:11px 12px;border-radius:12px;border:1px solid var(--line);background:rgba(0,0,0,.20);color:var(--ink);outline:none}
    .out{padding:12px;border-radius:16px;border:1px solid var(--line);background:rgba(0,0,0,.18);color:var(--muted);font-size:13px;line-height:1.55}
    .out .big{font-size:15px;color:var(--ink);font-weight:900}
    .scanBox{border:1px solid var(--line);background:rgba(0,0,0,.18);border-radius:16px;padding:14px}
    .scanRow{display:flex;gap:10px;flex-wrap:wrap;margin-top:10px}
    .tag{display:inline-flex;gap:8px;align-items:center;border:1px solid var(--line);border-radius:999px;padding:6px 10px;background:rgba(255,255,255,.03);color:var(--muted);font-size:12px}
    .hiw-footer{margin-top:18px;color:var(--muted);font-size:12px;display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap}
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

  <div class="hiw-wrap">
    <header class="hiw-header">
      <div class="hiw-brand">
        <div class="hiw-mark" aria-hidden="true"><?php echo hb_get_site_logo( 'medium', array( 'aria-hidden' => 'true' ) ); ?></div>
        <div>
          <h1>How This Works • <span class="ok">Algorithm</span> • Proof of Delivery (PoD)</h1>
          <div class="sub">A device-driven Wyoming DAO/LCA: Proof of Presence → Kalshi Mirror outcomes → XP accounting → extinguishment at 21,000 YAM : 1 USD.</div>
        </div>
      </div>
      <div class="hiw-nav">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hiw-btn">Back to PoD Prompts</a>
        <a href="<?php echo esc_url( home_url( '/dao' ) ); ?>" class="hiw-btn">Membership</a>
        <a href="<?php echo esc_url( home_url( '/activate-device' ) ); ?>" class="hiw-btn primary">Register Device</a>
      </div>
    </header>

    <section class="hero">
      <div class="hiw-card">
        <div class="kicker">
          <span class="pill">Leave wallet at home</span>
          <span class="pill">Presence becomes proof</span>
          <span class="pill">Scientific notation ledger</span>
        </div>
        <h2>What the PoD prompts are doing</h2>
        <p class="lead">The universal QR asks two questions: <strong>"Is this Proof of Delivery?"</strong> and <strong>"Is this the Final Destination?"</strong>. Those answers become a measurable proof signal — not money — recorded with device, timestamp, and (if enabled) geo-location. That proof signal feeds the <strong>Kalshi Mirror</strong> reputation model for individuals, POCs, and guilds.</p>
        <div class="hiw-grid">
          <div class="mini">
            <h3>Prompt 1 — Proof of Delivery?</h3>
            <p><span class="ok">PoD = Yes</span> means you are confirming a delivery event (voucher / delivery credential attached). The routine routes you into the <strong>WooCommerce Backorder</strong> path. <span class="ok">PoD = No</span> routes you into onboarding (register → membership → Discord).</p>
          </div>
          <div class="mini">
            <h3>Prompt 2 — Final Destination?</h3>
            <p>Final Destination is a reliability marker. It is always recorded for Kalshi Mirror performance outcomes, but it should never block entry into the website.</p>
          </div>
          <div class="mini">
            <h3>Buyer vs Seller rule</h3>
            <p>Buyers: device + MSB credentials + Discord acceptance. <strong>No QRtiger v-card required.</strong> Sellers: everything buyers have plus a <strong>QRtiger v-card required</strong>. Sellers can be individual- or group-sponsored.</p>
          </div>
          <div class="mini">
            <h3>NWP issuing rule</h3>
            <p><strong>NWP issuing is strictly a feature of the Seller POC.</strong> Buyer-only accounts earn XP recognition but do not issue NWP unless they activate as sellers and join a Seller POC.</p>
          </div>
        </div>
        <div class="math">
          <div class="kicker"><span class="pill">Algorithm constants</span><span class="pill">Published extinguishment</span><span class="pill">21,000 YAM : 1 USD</span></div>
          <div class="row2" style="margin-top:10px">
            <div class="eq"><strong>1 NWP (1 cent)</strong> = <strong>4.76190476 × 10¹⁸ XP</strong><br/><span class="note" style="margin-top:6px;display:block">This is the published XP extinguishment required to close one penny of obligation.</span></div>
            <div class="eq"><strong>1 USD (100 cents)</strong> = <strong>4.76190476 × 10²⁰ XP</strong><br/><span class="note" style="margin-top:6px;display:block">Derived as 100 × the NWP rate.</span></div>
          </div>
          <div class="row2" style="margin-top:10px">
            <div class="eq"><strong>1 USD</strong> = <strong>21,000 YAM</strong><br/><span class="note" style="margin-top:6px;display:block">Redemption peg used for extinguishment mapping.</span></div>
            <div class="eq"><strong>1 YAM</strong> = <strong>2.267573695 × 10¹⁶ XP</strong><br/><span class="note" style="margin-top:6px;display:block">Derived: (4.76190476 × 10²⁰ XP per USD) ÷ 21,000.</span></div>
          </div>
          <div class="divider"></div>
          <div class="eq"><strong>Extinguishment (burn) formulas</strong><br/><span class="note" style="margin-top:6px;display:block">YAM = XP ÷ (2.267573695 × 10¹⁶)<br/>USD = YAM ÷ 21,000  (equivalently: USD = XP ÷ (4.76190476 × 10²⁰)</span></div>
        </div>
        <p class="note">Why a sextillionth-of-a-penny scale can "measure everything": it is small enough to record nearly any participation event without rounding away meaning, and large enough in aggregate to support an auditable redemption mapping at the published peg. XP is not money — it is the measurement rail that makes social and financial outcomes behave consistently.</p>
      </div>
      <div class="hiw-card">
        <h3 style="margin:0 0 10px;font-size:16px">Your last scan (integration)</h3>
        <div class="scanBox">
          <div class="tag">PoD: <strong id="podVal">—</strong></div>
          <div class="tag">Final Destination: <strong id="finalVal">—</strong></div>
          <div class="tag">Routed: <strong id="routeVal">—</strong></div>
          <div class="tag">Timestamp: <strong id="tsVal">—</strong></div>
          <div class="scanRow">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hiw-btn primary">Answer prompts again</a>
            <a href="<?php echo esc_url( home_url( '/backorder' ) ); ?>" class="hiw-btn" id="btn-backorder">Woo Backorder</a>
            <a href="<?php echo esc_url( home_url( '/activate-device' ) ); ?>" class="hiw-btn">Register device</a>
          </div>
          <p class="note" style="margin-top:10px">Demo reads <code>localStorage</code> key <code>hb_last_scan</code>. Server should log to an append-only ledger table.</p>
        </div>
        <div class="divider"></div>
        <h3 style="margin:0 0 10px;font-size:16px">XP ↔ YAM ↔ USD calculator</h3>
        <p class="note" style="margin:0 0 10px">This is the "human value math engine." It shows the redemption correlation at the published extinguishment rate.</p>
        <div class="calc">
          <div>
            <label for="xpIn">Enter XP units</label>
            <input id="xpIn" inputmode="decimal" placeholder="e.g. 2.38095238e21" />
            <div class="note">Tip: you can paste scientific notation like <code>1.428571428e22</code>.</div>
          </div>
          <div class="out" id="xpOut"><div class="big">—</div><div>YAM: —</div><div>USD: —</div></div>
          <div>
            <label for="usdIn">Enter USD value</label>
            <input id="usdIn" inputmode="decimal" placeholder="e.g. 30" />
            <div class="note">USD → XP uses: <code>1 USD = 4.76190476 × 10²⁰ XP</code>.</div>
          </div>
          <div class="out" id="usdOut"><div class="big">—</div><div>XP: —</div><div>YAM: —</div></div>
        </div>
        <div class="divider"></div>
        <h3 style="margin:0 0 10px;font-size:16px">Participation → redemption correlation</h3>
        <p class="note" style="margin:0">Participation is captured as proof (device + time + geo + prompt outcomes). Kalshi Mirror scoring converts proof into reputation. Reputation can qualify organizer communities for MEGA Grants (up to 70%) and unlock higher pledge throughput. XP records the accounting of those outcomes, and redemption/extinguishment burns XP at the published peg.</p>
        <div class="divider"></div>
        <h3 style="margin:0 0 10px;font-size:16px">XP disclaimer (must-read)</h3>
        <p class="note" style="margin:0"><span class="warn">XP is non-cash and non-transferable.</span> XP is an accounting unit for verified participation events. XP is <strong>not money</strong> and has <strong>no guaranteed redemption value</strong> prior to scheduled governance milestones. Delivery-related XP may require an <strong>8–12 week maturity window</strong> after confirmed delivery, with monthly statement posting to an append-only ledger and annual reconciliation.</p>
      </div>
    </section>

    <section class="hiw-card" style="margin-top:14px">
      <h3 style="margin:0 0 8px">The end-to-end algorithm (plain English)</h3>
      <div class="hiw-grid">
        <div class="mini"><h3>1) Scan & answer</h3><p>PoD and Final Destination are recorded with device/time/geo for proof of presence.</p></div>
        <div class="mini"><h3>2) Route</h3><p>PoD=Yes routes to Woo Backorder. PoD=No routes to onboarding.</p></div>
        <div class="mini"><h3>3) Register device</h3><p>MSB credentials + consent + Discord invite acceptance requirement.</p></div>
        <div class="mini"><h3>4) Serendipity assignment</h3><p>Peace Pentagon branch + Buyer/Seller POCs assigned (Pending → Active).</p></div>
        <div class="mini"><h3>5) Kalshi Mirror outcomes</h3><p>Proof signals become reliability scores for individuals, POCs, and guilds.</p></div>
        <div class="mini"><h3>6) XP accounting & extinguishment</h3><p>XP records participation value; redemption burns XP at 21,000 YAM : 1 USD using scientific notation constants.</p></div>
      </div>
      <div class="divider"></div>
      <div class="scanRow">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hiw-btn primary">Return to PoD prompts</a>
        <a href="<?php echo esc_url( home_url( '/dao' ) ); ?>" class="hiw-btn">Membership choices</a>
        <a href="<?php echo esc_url( home_url( '/activate-device' ) ); ?>" class="hiw-btn">Register device</a>
      </div>
    </section>

    <footer class="hiw-footer">
      <div>© <?php echo esc_html( get_bloginfo( 'name' ) ); ?> • How This Works • Algorithm • XP accounting • Kalshi Mirror proof of presence</div>
      <div><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> • <a href="<?php echo esc_url( home_url( '/' ) ); ?>">PoD Router</a> • <a href="<?php echo esc_url( home_url( '/dao' ) ); ?>">Membership</a></div>
    </footer>
  </div>

  <script>
  (function(){
    var XP_PER_CENT = 4.76190476e18, XP_PER_USD = 4.76190476e20, YAM_PER_USD = 21000, XP_PER_YAM = XP_PER_USD / YAM_PER_USD;
    function safeText(id, txt){ var el = document.getElementById(id); if(el) el.textContent = (txt === null || txt === undefined || txt === "") ? "—" : String(txt); }
    function inferRoute(pod){ return pod === "YES" ? "WOO_BACKORDER" : (pod === "NO" ? "WEBSITE" : "—"); }
    function loadLastScan(){
      try{
        var raw = localStorage.getItem("hb_last_scan");
        if(!raw) return;
        var s = JSON.parse(raw);
        safeText("podVal", s.pod || "—");
        safeText("finalVal", s.final || "—");
        safeText("routeVal", inferRoute(s.pod));
        safeText("tsVal", s.ts || "—");
      }catch(e){ console.warn("Could not parse hb_last_scan", e); }
    }
    function fmtSci(n){
      if(!isFinite(n)) return "—";
      var abs = Math.abs(n);
      if(abs === 0) return "0";
      if(abs >= 1e6 || abs < 1e-3) return n.toExponential(8);
      return n.toLocaleString(undefined, {maximumFractionDigits: 8});
    }
    function parseNum(val){ var x = Number(String(val).trim()); return isFinite(x) ? x : NaN; }
    function recalcFromXP(){
      var xp = parseNum(document.getElementById("xpIn").value), out = document.getElementById("xpOut");
      if(!out) return;
      if(!isFinite(xp)){ out.innerHTML = "<div class=\"big\">—</div><div>YAM: —</div><div>USD: —</div>"; return; }
      var yam = xp / XP_PER_YAM, usd = yam / YAM_PER_USD;
      out.innerHTML = "<div class=\"big\">From XP</div><div>YAM: <strong>"+fmtSci(yam)+"</strong></div><div>USD: <strong>"+fmtSci(usd)+"</strong></div><div class=\"note\" style=\"margin-top:8px\">Burn rule: XP extinguished at <code>1 USD = 4.76190476×10²⁰ XP</code> and <code>1 USD = 21,000 YAM</code>.</div>";
    }
    function recalcFromUSD(){
      var usd = parseNum(document.getElementById("usdIn").value), out = document.getElementById("usdOut");
      if(!out) return;
      if(!isFinite(usd)){ out.innerHTML = "<div class=\"big\">—</div><div>XP: —</div><div>YAM: —</div>"; return; }
      var xp = usd * XP_PER_USD, yam = usd * YAM_PER_USD;
      out.innerHTML = "<div class=\"big\">From USD</div><div>XP: <strong>"+fmtSci(xp)+"</strong></div><div>YAM: <strong>"+fmtSci(yam)+"</strong></div><div class=\"note\" style=\"margin-top:8px\">Example: $30 → "+fmtSci(30 * XP_PER_USD)+" XP and "+fmtSci(30 * YAM_PER_USD)+" YAM.</div>";
    }
    loadLastScan();
    var xpIn = document.getElementById("xpIn"), usdIn = document.getElementById("usdIn");
    if(xpIn){ xpIn.value = (30 * XP_PER_USD).toExponential(8); xpIn.addEventListener("input", recalcFromXP); recalcFromXP(); }
    if(usdIn){ usdIn.value = "5"; usdIn.addEventListener("input", recalcFromUSD); recalcFromUSD(); }
  })();
  </script>
</body>
</html>
