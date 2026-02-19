<?php
/**
 * Template Name: Serendipity
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Serendipity • Human Blockchain • Your Voice. Your Choice. Your Treasury.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Serendipity is the moment you and another free agent decide to act. Human Blockchain turns that shared thought into a 2-scan proof-of-delivery economy.">
  <style>
    :root {
      --bg: #050816;
      --bg-alt: #0b1020;
      --accent: #ffb347;
      --accent-soft: rgba(255,179,71,0.1);
      --accent-2: #44ffd2;
      --text-main: #f5f5f7;
      --text-muted: #a0a3b1;
      --border-subtle: #23263a;
      --danger: #ff4b81;
      --shadow-soft: 0 22px 45px rgba(0,0,0,0.65);
      --radius-lg: 18px;
      --radius-pill: 999px;
      --gap-lg: 2.25rem;
      --gap-md: 1.4rem;
      --gap-sm: 0.9rem;
      --font-main: system-ui, -apple-system, BlinkMacSystemFont, "SF Pro Text",
        "Inter", "Segoe UI", sans-serif;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--font-main);
      background: radial-gradient(circle at top, #151b3a 0, #050816 45%, #01020a 100%);
      color: var(--text-main);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      padding: 1.5rem;
    }

    .shell {
      max-width: 1120px;
      width: 100%;
      background: linear-gradient(135deg, rgba(255,255,255,0.02), rgba(255,255,255,0.0));
      border-radius: 26px;
      border: 1px solid rgba(255,255,255,0.04);
      box-shadow: var(--shadow-soft);
      padding: 1.75rem 1.75rem 2.25rem;
      position: relative;
      overflow: hidden;
    }

    .shell::before {
      content: "";
      position: absolute;
      inset: -30%;
      opacity: 0.22;
      background:
        radial-gradient(circle at 0% 0%, rgba(68,255,210,0.14), transparent 60%),
        radial-gradient(circle at 100% 20%, rgba(255,179,71,0.14), transparent 55%),
        radial-gradient(circle at 50% 120%, rgba(125,92,255,0.18), transparent 60%);
      pointer-events: none;
      z-index: -1;
    }

    /* Top nav + badge bar */
    .top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: var(--gap-lg);
      gap: var(--gap-md);
      flex-wrap: wrap;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 0.8rem;
    }

    .brand-mark {
      width: 36px;
      height: 36px;
      border-radius: 14px;
      border: 1px solid rgba(255,255,255,0.12);
      background:
        radial-gradient(circle at 20% 0%, rgba(68,255,210,0.5), transparent 60%),
        radial-gradient(circle at 80% 100%, rgba(255,179,71,0.8), transparent 60%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      font-weight: 700;
      color: #050816;
      box-shadow: 0 10px 30px rgba(0,0,0,0.55);
    }

    .brand-text-main {
      font-size: 1.1rem;
      font-weight: 600;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .brand-text-sub {
      font-size: 0.78rem;
      color: var(--text-muted);
    }

    .top {
      position: relative;
    }
    .nav-links {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
    }

    .nav-chip {
      padding: 0.4rem 0.85rem;
      border-radius: 999px;
      border: 1px solid rgba(255,255,255,0.06);
      font-size: 0.8rem;
      color: var(--text-muted);
      background: rgba(0,0,0,0.25);
      backdrop-filter: blur(12px);
      cursor: pointer;
      text-decoration: none;
      transition: all 0.18s ease;
    }
    
    /* Hamburger Menu */
    .hamburger-menu {
      display: none;
    }
    .hamburger-toggle {
      display: none;
    }
    .hamburger-btn {
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
    .hamburger-btn:hover {
      background: rgba(255,255,255,.10);
    }
    .hamburger-btn svg {
      width: 22px;
      height: 22px;
      stroke: currentColor;
    }
    
    /* Sidebar Overlay */
    .sidebar-overlay {
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
    
    .sidebar-overlay.active {
      display: block;
      opacity: 1;
    }
    
    /* Sidebar Menu */
    .sidebar-menu {
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
    
    .sidebar-menu.active {
      right: 0;
    }
    
    /* Sidebar Header */
    .sidebar-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(255,255,255,.12);
    }
    
    .sidebar-header h2 {
      margin: 0;
      font-size: 18px;
      font-weight: 800;
      color: var(--text-main);
    }
    
    .sidebar-close {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.16);
      background: rgba(255,255,255,.06);
      cursor: pointer;
      color: var(--text-main);
      transition: background .12s ease;
    }
    
    .sidebar-close:hover {
      background: rgba(255,255,255,.10);
    }
    
    .sidebar-close svg {
      width: 20px;
      height: 20px;
    }
    
    /* Sidebar Menu Links */
    .sidebar-menu-links {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    .sidebar-menu-links a {
      display: block;
      padding: 14px 16px;
      border-radius: 14px;
      color: var(--text-muted);
      border: 1px solid transparent;
      font-size: 15px;
      text-decoration: none;
      transition: all .12s ease;
    }
    
    .sidebar-menu-links a:hover {
      background: rgba(255,255,255,.06);
      color: var(--text-main);
      border-color: rgba(255,255,255,.10);
    }
    
    /* Mobile Responsive */
    @media (max-width: 900px) {
      .nav-links {
        display: none;
      }
      .hamburger-menu {
        display: block;
      }
      .brand {
        flex: 1;
        min-width: 0;
      }
      .brand-text-sub {
        display: none;
      }
      .brand-text-main {
        font-size: 16px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    }
    
    /* Prevent body scroll when sidebar is open */
    body.sidebar-open {
      overflow: hidden;
      position: fixed;
      width: 100%;
    }

    .nav-chip.highlight {
      border-color: rgba(255,179,71,0.7);
      color: var(--accent);
      background: rgba(255,179,71,0.06);
    }

    .nav-chip:hover {
      border-color: rgba(255,255,255,0.18);
      color: var(--text-main);
      transform: translateY(-1px);
    }

    /* Layout */
    .grid {
      display: grid;
      grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
      gap: var(--gap-lg);
      align-items: stretch;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      body {
        padding: 1.25rem;
      }
      .shell {
        padding: 1.5rem 1.4rem 2rem;
      }
    }

    @media (max-width: 860px) {
      .grid {
        grid-template-columns: minmax(0, 1fr);
        gap: var(--gap-md);
      }
      body {
        padding: 1rem;
      }
      .shell {
        padding: 1.4rem 1.25rem 1.75rem;
      }
      .hero-title {
        font-size: clamp(1.8rem, 5vw, 2.4rem);
      }
      .hero-sub {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 768px) {
      body {
        padding: 0.9rem;
      }
      .shell {
        padding: 1.25rem 1.1rem 1.5rem;
        border-radius: 20px;
      }
      .top {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }
      .brand-mark {
        width: 32px;
        height: 32px;
        font-size: 0.7rem;
      }
      .brand-text {
        font-size: 0.85rem;
      }
      .hero-title {
        font-size: clamp(1.6rem, 6vw, 2.2rem);
        line-height: 1.2;
      }
      .hero-sub {
        font-size: 0.88rem;
      }
      .tagline-pill {
        font-size: 0.72rem;
        padding: 0.28rem 0.8rem;
      }
      .btn {
        font-size: 0.85rem;
        padding: 0.7rem 1.2rem;
      }
      .cta-row {
        flex-direction: column;
        width: 100%;
      }
      .btn {
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 640px) {
      body {
        padding: 0.75rem;
      }
      .shell {
        padding: 1.1rem 1rem 1.4rem;
        border-radius: 18px;
      }
      .top {
        margin-bottom: var(--gap-md);
      }
      .hero-title {
        font-size: clamp(1.4rem, 7vw, 2rem);
        line-height: 1.15;
      }
      .hero-sub {
        font-size: 0.85rem;
      }
      .tagline-pill {
        font-size: 0.68rem;
        padding: 0.25rem 0.7rem;
      }
      .btn {
        font-size: 0.82rem;
        padding: 0.65rem 1.1rem;
      }
      .section-label {
        font-size: 0.72rem;
      }
      .section-title {
        font-size: 1.1rem;
      }
      .section-body {
        font-size: 0.88rem;
      }
    }

    /* Left column: Hero */
    .hero {
      display: flex;
      flex-direction: column;
      gap: var(--gap-md);
    }

    .tagline-pill {
      align-self: flex-start;
      padding: 0.32rem 0.9rem;
      border-radius: var(--radius-pill);
      border: 1px solid rgba(68,255,210,0.65);
      background: radial-gradient(circle at 10% 0%, rgba(68,255,210,0.25), transparent 60%);
      font-size: 0.76rem;
      text-transform: uppercase;
      letter-spacing: 0.14em;
      color: var(--accent-2);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .tagline-dot {
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: var(--accent-2);
      box-shadow: 0 0 16px rgba(68,255,210,0.85);
    }

    .hero-title {
      font-size: clamp(2.1rem, 3vw, 2.6rem);
      line-height: 1.08;
      letter-spacing: 0.02em;
    }

    .hero-title span.highlight {
      background-image: linear-gradient(120deg, #ffb347, #ff4b81, #ffb347);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      text-shadow: 0 0 26px rgba(0,0,0,0.7);
    }

    .hero-sub {
      font-size: 0.96rem;
      color: var(--text-muted);
      line-height: 1.6;
    }

    .hero-sub strong {
      color: var(--accent-2);
      font-weight: 500;
    }

    .hero-quote {
      margin-top: 0.4rem;
      font-size: 0.88rem;
      color: var(--text-muted);
      border-left: 2px solid rgba(255,255,255,0.12);
      padding-left: 0.75rem;
      font-style: italic;
    }

    .cta-row {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      margin-top: 0.5rem;
    }

    .btn {
      border-radius: var(--radius-pill);
      padding: 0.75rem 1.4rem;
      font-size: 0.9rem;
      border: 1px solid transparent;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.45rem;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .btn-primary {
      background: linear-gradient(135deg, #ffb347, #ff4b81);
      border-color: rgba(255,255,255,0.2);
      color: #050816;
      font-weight: 600;
      box-shadow: 0 14px 35px rgba(0,0,0,0.8);
    }

    .btn-primary:hover {
      transform: translateY(-1px) scale(1.01);
      box-shadow: 0 18px 42px rgba(0,0,0,0.9);
    }

    .btn-ghost {
      border-color: rgba(255,255,255,0.16);
      background: rgba(4,7,22,0.9);
      color: var(--text-main);
    }

    .btn-ghost:hover {
      border-color: rgba(255,255,255,0.35);
      background: rgba(7,12,32,0.95);
      transform: translateY(-1px);
    }

    .btn-subtext {
      font-size: 0.77rem;
      color: var(--text-muted);
      margin-top: 0.4rem;
    }

    /* Steps */
    .steps {
      margin-top: 0.9rem;
      display: grid;
      gap: 0.65rem;
    }

    .step {
      display: flex;
      gap: 0.7rem;
      align-items: flex-start;
    }

    .step-number {
      width: 26px;
      height: 26px;
      border-radius: 999px;
      border: 1px solid rgba(255,255,255,0.3);
      font-size: 0.78rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at 30% 0%, rgba(68,255,210,0.3), transparent 65%);
      color: var(--text-main);
      flex-shrink: 0;
    }

    .step-body {
      font-size: 0.86rem;
      color: var(--text-muted);
      line-height: 1.5;
    }

    .step-body strong {
      color: var(--accent);
      font-weight: 500;
    }

    /* Right column: Serendipity radar */
    .panel {
      background: radial-gradient(circle at 0 0, rgba(68,255,210,0.18), transparent 55%),
                  radial-gradient(circle at 100% 100%, rgba(255,179,71,0.16), transparent 60%),
                  rgba(3,6,22,0.96);
      border-radius: 22px;
      border: 1px solid rgba(255,255,255,0.06);
      padding: 1.3rem 1.2rem 1.35rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      position: relative;
      overflow: hidden;
    }

    .panel-heading {
      font-size: 0.92rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.85rem;
    }

    .pill-live {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      border-radius: var(--radius-pill);
      padding: 0.2rem 0.7rem;
      font-size: 0.74rem;
      background: rgba(4,7,22,0.8);
      border: 1px solid rgba(255,255,255,0.15);
      color: var(--accent-2);
    }

    .dot-pulse {
      position: relative;
      width: 8px;
      height: 8px;
      border-radius: 999px;
      background: var(--accent-2);
      box-shadow: 0 0 12px rgba(68,255,210,0.9);
    }

    .dot-pulse::before {
      content: "";
      position: absolute;
      inset: -4px;
      border-radius: 999px;
      border: 1px solid rgba(68,255,210,0.55);
      opacity: 0.9;
      animation: ping 1.6s infinite ease-out;
    }

    @keyframes ping {
      0% {
        transform: scale(0.6);
        opacity: 0.9;
      }
      80% {
        transform: scale(1.25);
        opacity: 0;
      }
      100% {
        transform: scale(1.4);
        opacity: 0;
      }
    }

    .panel-sub {
      font-size: 0.86rem;
      color: var(--text-muted);
      line-height: 1.6;
    }

    .serendipity-bubble {
      margin-top: 0.3rem;
      border-radius: 16px;
      padding: 0.85rem 0.9rem;
      background: rgba(5,11,32,0.9);
      border: 1px dashed rgba(255,255,255,0.15);
      font-size: 0.84rem;
      color: var(--text-main);
    }

    .serendipity-bubble span {
      color: var(--accent);
      font-weight: 500;
    }

    .presence-grid {
      margin-top: 0.5rem;
      display: grid;
      gap: 0.6rem;
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    @media (max-width: 540px) {
      body {
        padding: 0.65rem;
      }
      .shell {
        padding: 1rem 0.9rem 1.3rem;
      }
      .hero-title {
        font-size: clamp(1.3rem, 8vw, 1.8rem);
      }
      .presence-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 0.5rem;
      }
      .presence-card {
        padding: 0.65rem 0.75rem;
        font-size: 0.75rem;
      }
      .presence-label {
        font-size: 0.65rem;
      }
      .presence-pill {
        font-size: 0.65rem;
        padding: 0.15rem 0.55rem;
      }
    }

    @media (max-width: 360px) {
      body {
        padding: 0.5rem;
      }
      .shell {
        padding: 0.95rem 0.85rem 1.2rem;
      }
      .brand-mark {
        width: 28px;
        height: 28px;
        font-size: 0.65rem;
      }
      .hero-title {
        font-size: clamp(1.2rem, 9vw, 1.6rem);
      }
    }

    @media (hover: none) and (pointer: coarse) {
      .btn,
      .badge {
        min-height: 44px;
        min-width: 44px;
      }
    }

    .presence-card {
      border-radius: 14px;
      padding: 0.7rem 0.8rem;
      background: rgba(4,7,22,0.9);
      border: 1px solid rgba(255,255,255,0.08);
      display: flex;
      flex-direction: column;
      gap: 0.1rem;
      font-size: 0.8rem;
    }

    .presence-label {
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.12em;
      font-size: 0.7rem;
    }

    .presence-value {
      font-weight: 500;
    }

    .presence-pill {
      margin-top: 0.2rem;
      align-self: flex-start;
      padding: 0.18rem 0.6rem;
      border-radius: var(--radius-pill);
      background: rgba(255,179,71,0.12);
      color: var(--accent);
      font-size: 0.7rem;
    }

    .divider {
      height: 1px;
      background: linear-gradient(90deg,
        transparent,
        rgba(255,255,255,0.16),
        transparent);
      margin: 0.4rem 0 0.5rem;
    }

    .micro-copy {
      font-size: 0.72rem;
      color: var(--text-muted);
      line-height: 1.5;
    }

    .micro-copy strong {
      color: var(--accent-2);
      font-weight: 500;
    }

    .micro-links {
      margin-top: 0.35rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.55rem;
    }

    .micro-chip {
      font-size: 0.72rem;
      border-radius: var(--radius-pill);
      padding: 0.18rem 0.7rem;
      border: 1px solid rgba(255,255,255,0.14);
      color: var(--text-muted);
      text-decoration: none;
      background: rgba(3,7,24,0.9);
      transition: all 0.15s ease;
      cursor: pointer;
    }

    .micro-chip:hover {
      border-color: rgba(255,255,255,0.3);
      color: var(--text-main);
    }

    .badge-strip {
      margin-top: 1.1rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.4rem;
      font-size: 0.7rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.14em;
    }

    .badge {
      padding: 0.2rem 0.55rem;
      border-radius: var(--radius-pill);
      border: 1px solid rgba(255,255,255,0.16);
      background: rgba(4,7,20,0.9);
    }

    .badge.accent {
      border-color: rgba(255,179,71,0.65);
      color: var(--accent);
      background: rgba(255,179,71,0.06);
    }

  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>
<body>
  <div class="shell">
    <!-- top brand + menu -->
    <header class="top">
      <div class="brand">
        <div class="brand-mark">HB</div>
        <div>
          <div class="brand-text-main">Human Blockchain</div>
          <div class="brand-text-sub">Your Voice. Your Choice. Your Treasury.</div>
        </div>
      </div>
      <nav class="nav-links">
        <a class="nav-chip" href="/">Overview</a>
        <a class="nav-chip" href="/how-it-works">How It Works</a>
        <a class="nav-chip" href="/peace-pentagon">Peace Pentagon</a>
        <a class="nav-chip" href="/faq">FAQ</a>
        <a class="nav-chip highlight" href="#">Serendipity</a>
      </nav>
      
      <div class="hamburger-menu">
        <input type="checkbox" id="hamburger-toggle-<?php echo get_the_ID(); ?>" class="hamburger-toggle" />
        <label for="hamburger-toggle-<?php echo get_the_ID(); ?>" class="hamburger-btn" aria-label="Open menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M4 7h16M4 12h16M4 17h16"/>
          </svg>
        </label>
      </div>
    </header>
    
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
        <a href="/">Overview</a>
        <a href="/how-it-works">How It Works</a>
        <a href="/peace-pentagon">Peace Pentagon</a>
        <a href="/faq">FAQ</a>
        <a href="#" class="highlight">Serendipity</a>
      </div>
    </div>
    
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

    <main class="grid">
      <!-- Left: hero + steps -->
      <section class="hero">
        <div class="tagline-pill">
          <span class="tagline-dot"></span>
          Serendipity Window Open
        </div>

        <h1 class="hero-title">
          Act on the thought that <span class="highlight">won&rsquo;t leave you alone.</span>
        </h1>

        <p class="hero-sub">
          Somewhere else on Earth, <strong>right now</strong>, another voter and consumer
          is thinking the exact same thing you are:
          <br><br>
          <em>&ldquo;What if we put <strong>You And Me</strong> on top of the economy?&rdquo;</em>
        </p>

        <p class="hero-quote">
          Serendipity is when two free agents share the same courage at the same moment — 
          and decide to move.
        </p>

        <div class="cta-row">
          <a href="#join" class="btn btn-primary">
            I&rsquo;m Ready &mdash; Count Me In
          </a>
          <a href="#scan" class="btn btn-ghost">
            I’ve Scanned a YAM-is-On Voucher
          </a>
        </div>
        <div class="btn-subtext">
          No speculation. No pressure. Just a 2-scan proof-of-delivery economy
          where AI is mastered by Human Intelligence (HI).
        </div>

        <div class="steps" id="join">
          <div class="step">
            <div class="step-number">1</div>
            <div class="step-body">
              <strong>Accept the invitation.</strong> Join the Gracebook Discord and
              claim your <strong>QRtiger v-card ID</strong> as your Human Blockchain handle.
            </div>
          </div>
          <div class="step">
            <div class="step-number">2</div>
            <div class="step-body">
              <strong>Choose your lane.</strong> Register as a
              <strong>YAM&rsquo;er</strong> (shopper), <strong>MEGAvoter</strong> (organizer),
              or <strong>Patron</strong> (stakeholder) and connect your Venmo/FonePay MSB rails.
            </div>
          </div>
          <div class="step" id="scan">
            <div class="step-number">3</div>
            <div class="step-body">
              <strong>Scan to settle.</strong> When you see a <strong>YAM-is-On</strong>
              voucher or hang tag, complete the 2-scan proof of delivery. That single scan
              mints a <strong>$10.30 trade credit</strong> in XP at
              <strong>21,000 YAM per 1 USD</strong>.
            </div>
          </div>
          <div class="step">
            <div class="step-number">4</div>
            <div class="step-body">
              <strong>Feed the Peace Pentagon.</strong> Every confirmed delivery allocates
              <strong>$5 buyer rebate</strong>, <strong>$4 social impact</strong>, and
              <strong>$1 patronage</strong> into a Member Capitalism ledger —
              ready for the next Genesis Block.
            </div>
          </div>
        </div>
      </section>

      <!-- Right: serendipity radar / presence -->
      <aside class="panel" aria-label="Serendipity presence panel">
        <div class="panel-heading">
          <span>Who else is thinking this right now?</span>
          <span class="pill-live">
            <span class="dot-pulse"></span>
            Serendipity Scan
          </span>
        </div>

        <p class="panel-sub">
          You&rsquo;re not the only one wondering if voters and consumers can run
          their own Visa/Mastercard alternative. This panel is reserved for the
          <strong>live presence widget</strong> that tracks who else has opened
          the Serendipity page in this same window of time.
        </p>

        <div class="serendipity-bubble">
          <span>Because someone else, at this exact moment, is thinking the same thing.</span>
          <br>
          The Human Blockchain simply asks: <em>will you find each other in time?</em>
        </div>

        <div class="presence-grid">
          <div class="presence-card">
            <div class="presence-label">Free Agents Watching</div>
            <div class="presence-value" data-serendipity-count>##</div>
            <div class="presence-pill">Connect them here</div>
          </div>
          <div class="presence-card">
            <div class="presence-label">Last Genesis Block</div>
            <div class="presence-value">May 17, 2030</div>
            <div class="presence-pill">10-year reset cycle</div>
          </div>
        </div>

        <div class="divider"></div>

        <div class="micro-copy">
          Every 10 years, a <strong>Genesis Block</strong> dissolves all buyer and seller
          POC roles and resets the <strong>Peace Pentagon branches</strong>.
          No one is locked in. No one is left out.
          <br><br>
          Serendipity is your chance to step into the next cycle as a
          <strong>free agent NIL</strong> — with proof-of-delivery
          as your only credential.
        </div>

        <div class="micro-links">
          <a class="micro-chip" href="https://discord.gg/" target="_blank" rel="noreferrer">
            Join Gracebook Discord
          </a>
          <a class="micro-chip" href="how-it-works.html">
            Read the 2-Scan Protocol
          </a>
          <a class="micro-chip" href="peace-pentagon.html">
            Explore Peace Pentagon Roles
          </a>
        </div>

        <div class="badge-strip">
          <span class="badge accent">AI Mastered by HI</span>
          <span class="badge">You And Me Economy</span>
          <span class="badge">YAM-is-On Vouchers</span>
        </div>
      </aside>
    </main>
  </div>
</body>
</html>
