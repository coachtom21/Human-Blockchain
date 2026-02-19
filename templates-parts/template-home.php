<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>HumanBlockchain.info | Serendipity + YAM-is-ON Proof of Delivery</title>
  <meta name="description" content="Device-driven 2-scan Proof of Delivery. Serendipity forms Buyer POCs locally by geo-location + timestamp and Seller POCs out-of-state or global. XP in scientific notation. New World Penny recognition. VFN handles redemption." />

  <style>
    /* =========================================================
    HumanBlockchain.info — Modern CSS (inline, ready to paste)
    ========================================================= */
    :root{
      --bg: #0b1220;
      --bg2:#070d18;
      --panel: rgba(18,31,61,.70);
      --line: rgba(232,238,252,.12);
      --text: #e8eefc;
      --muted: #b8c3e6;

      --accent: #7dd3fc;
      --accent2:#a78bfa;
      --good: #86efac;
      --warn: #fbbf24;

      --radius: 18px;
      --shadow: 0 18px 48px rgba(0,0,0,.35);
      --shadow2: 0 8px 18px rgba(0,0,0,.22);
      --maxw: 1100px;

      --font: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Apple Color Emoji", "Segoe UI Emoji";
      --mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:var(--font); color:var(--text); line-height:1.45;
      background:
        radial-gradient(1100px 600px at 15% 0%, rgba(167,139,250,.18), transparent 55%),
        radial-gradient(900px 500px at 85% 20%, rgba(125,211,252,.16), transparent 55%),
        radial-gradient(700px 420px at 50% 90%, rgba(134,239,172,.10), transparent 60%),
        linear-gradient(180deg, var(--bg), var(--bg2));
    }
    a{color:inherit;text-decoration:none}
    code{font-family:var(--mono); background: rgba(232,238,252,.06); border:1px solid var(--line);
      padding:2px 6px; border-radius:10px; font-size:.95em}
    .wrap{max-width:var(--maxw); margin:0 auto; padding:0 18px}
    .grid{display:grid; gap:16px}
    .two{display:grid; grid-template-columns:1fr 1fr; gap:16px}
    .three{display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px}
    @media (max-width:900px){ .two,.three{grid-template-columns:1fr} }
    .small{font-size:12px; color:var(--muted)}
    .lead{color:var(--muted); font-size:16px; margin:0 0 18px}
    h1{font-size:42px; line-height:1.05; margin:10px 0 10px; letter-spacing:-.6px}
    h2{font-size:28px; margin:0 0 10px; letter-spacing:-.3px}
    h3{font-size:18px; margin:0 0 8px}
    @media (max-width:520px){ h1{font-size:34px} h2{font-size:24px} }

    .card{
      background:var(--panel); border:1px solid var(--line); border-radius:var(--radius);
      padding:18px; box-shadow:var(--shadow2);
    }
    .section{padding:26px 0}
    .hero{padding:44px 0 18px}
    .hero .grid{grid-template-columns:1.25fr .75fr; align-items:stretch}
    @media (max-width:900px){ .hero .grid{grid-template-columns:1fr} }

    /* Topbar / Nav */
    .topbar{
      position:sticky; top:0; z-index:50;
      background:rgba(11,18,32,.78);
      backdrop-filter: blur(10px);
      border-bottom:1px solid var(--line);
      width:100%;
    }
    .topbar .wrap{
      max-width:none;
      width:100%;
      padding-left:24px;
      padding-right:24px;
    }
    .nav{
      display:flex; align-items:center; justify-content:space-between;
      gap:12px; padding:14px 0;
      flex-wrap:wrap;
    }
    .brand{display:flex; align-items:center; gap:10px; min-width:220px}
    .logo{
      width:28px; height:28px; border-radius:10px;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      box-shadow: 0 10px 20px rgba(0,0,0,.25);
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
    .brand b{letter-spacing:.3px}
    .brand .small.tagline{white-space:normal; line-height:1.35; max-width:280px}
    .menu{display:flex; align-items:center; gap:6px; flex-wrap:wrap; justify-content:center; flex:1 1 auto; min-width:0}
    .menu a{
      font-size:14px; color:var(--muted);
      padding:8px 10px; border-radius:12px;
      border:1px solid transparent;
    }
    .menu a:hover{background: rgba(232,238,252,.06); color:var(--text); border-color: rgba(232,238,252,.10)}
    .cta{display:flex; align-items:center; gap:10px; flex-wrap:wrap; flex-shrink:0}

    /* Buttons */
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:10px 14px; border-radius:14px; border:1px solid var(--line);
      background: rgba(232,238,252,.06); color:var(--text);
      font-weight:800; font-size:14px;
      box-shadow: 0 10px 18px rgba(0,0,0,.18);
      transition: transform .08s ease, filter .08s ease, background .12s ease, border-color .12s ease;
    }
    .btn:hover{background: rgba(232,238,252,.10); transform: translateY(-1px)}
    .btn:active{transform: translateY(0px); filter: brightness(.98)}
    .btn.primary{
      border-color:transparent;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      color:#071024;
    }
    .btn.primary:hover{filter:brightness(1.05)}
    .btn.ghost{background: transparent; border-color: rgba(232,238,252,.18)}
    .btn.small{padding:8px 12px; border-radius:12px; font-size:13px}

    /* Pills / tags */
    .pill, .tag{
      display:inline-flex; align-items:center; gap:8px;
      border-radius:999px; padding:6px 10px;
      font-size:13px; color:var(--muted);
      background: rgba(232,238,252,.08); border:1px solid var(--line);
    }
    .tag{font-size:12px}
    .badge{
      display:inline-flex; align-items:center; gap:8px;
      padding:6px 10px; border-radius:999px;
      background: rgba(125,211,252,.10);
      border:1px solid rgba(125,211,252,.25);
      color: var(--text);
      font-size: 12px;
      font-weight: 800;
    }

    /* KPI blocks */
    .kpi{display:flex; gap:10px; flex-wrap:wrap; margin-top:12px}
    .kpi .mini{
      flex:1; min-width:180px;
      background: rgba(232,238,252,.05); border:1px solid var(--line);
      border-radius:16px; padding:12px;
    }
    .mini b{display:block; font-size:14px; margin-bottom:4px}
    .mini span{color:var(--muted); font-size:13px}

    /* Lists */
    .list{display:grid; gap:10px; margin-top:10px}
    .item{
      display:flex; gap:10px; align-items:flex-start;
      padding:12px; border-radius:16px;
      background: rgba(232,238,252,.05);
      border:1px solid rgba(232,238,252,.10);
    }
    .dot{
      width:10px; height:10px; border-radius:999px;
      margin-top:6px; background:var(--accent);
      box-shadow: 0 0 0 4px rgba(125,211,252,.10);
    }
    .dot.good{background:var(--good); box-shadow: 0 0 0 4px rgba(134,239,172,.10)}
    .dot.warn{background:var(--warn); box-shadow: 0 0 0 4px rgba(251,191,36,.12)}

    /* FAQ accordions */
    details{
      border-radius:16px; background: rgba(232,238,252,.05);
      border:1px solid rgba(232,238,252,.12);
      padding:12px; overflow:hidden;
    }
    details + details{margin-top:10px}
    details[open]{background: rgba(232,238,252,.06)}
    details summary{
      cursor:pointer; list-style:none; font-weight:900;
      display:flex; align-items:center; justify-content:space-between; gap:12px;
    }
    details summary::-webkit-details-marker{display:none}
    details summary::after{
      content:"+";
      font-weight:900; color:var(--muted);
      width:26px; height:26px;
      display:inline-flex; align-items:center; justify-content:center;
      border-radius:10px; border:1px solid rgba(232,238,252,.12);
      background: rgba(232,238,252,.04);
    }
    details[open] summary::after{content:"–"}
    details p{margin:10px 0 0; color:var(--muted)}

    /* Footer */
    .footer{
      padding:26px 0 36px;
      border-top:1px solid var(--line);
      color:var(--muted); font-size:13px;
    }
    .footer .cols{display:grid; grid-template-columns:1fr 1fr; gap:16px}
    @media (max-width:900px){ .footer .cols{grid-template-columns:1fr} }

    /* Mobile menu - Sidebar */
    .hamburger{display:none}
    @media (min-width: 901px){
      .hamburger{display:none !important}
    }
    .hamburger label{
      display:inline-flex; align-items:center; justify-content:center;
      width:44px; height:44px; border-radius:14px;
      border:1px solid rgba(232,238,252,.16);
      background: rgba(232,238,252,.06);
      cursor:pointer;
      transition: background .12s ease;
    }
    .hamburger label:hover{background: rgba(232,238,252,.10)}
    .hamburger svg{width:22px;height:22px}
    #navtoggle{display:none}
    
    /* Sidebar overlay - mobile/tablet only; hidden on desktop */
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
    @media (min-width: 901px){
      .sidebar-overlay{
        display: none !important;
        pointer-events: none;
      }
    }
    .sidebar-overlay.active{
      display: block;
      opacity: 1;
    }
    @media (min-width: 901px){
      .sidebar-overlay.active{
        display: none !important;
      }
    }
    
    /* Sidebar menu - mobile/tablet only; hidden on desktop */
    .sidebar-menu{
      position: fixed;
      top: 0;
      right: -100%;
      width: 320px;
      max-width: 85vw;
      height: 100vh;
      background: rgba(11,18,32,.95);
      backdrop-filter: blur(20px);
      border-left: 1px solid rgba(232,238,252,.12);
      z-index: 9999;
      overflow-y: auto;
      transition: right 0.3s ease;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    @media (min-width: 901px){
      .sidebar-menu{
        display: none !important;
        right: -100% !important;
        pointer-events: none;
      }
    }
    .sidebar-menu.active{
      right: 0;
    }
    @media (min-width: 901px){
      .sidebar-menu.active{
        display: none !important;
      }
    }
    
    /* Prevent body scroll when sidebar is open */
    body.sidebar-open{
      overflow: hidden;
    }
    
    /* Sidebar header */
    .sidebar-header{
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(232,238,252,.12);
    }
    
    .sidebar-close{
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 12px;
      border: 1px solid rgba(232,238,252,.16);
      background: rgba(232,238,252,.06);
      cursor: pointer;
      color: var(--text);
      transition: background .12s ease;
    }
    
    .sidebar-close:hover{
      background: rgba(232,238,252,.10);
    }
    
    .sidebar-close svg{
      width: 20px;
      height: 20px;
    }
    
    /* Sidebar menu links */
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
      transition: all .12s ease;
    }
    
    .sidebar-menu-links a:hover{
      background: rgba(232,238,252,.06);
      color: var(--text);
      border-color: rgba(232,238,252,.10);
    }
    
    /* Sidebar device status section */
    .sidebar-device-section{
      padding: 16px;
      border-radius: 16px;
      background: rgba(232,238,252,.05);
      border: 1px solid rgba(232,238,252,.12);
    }
    
    .sidebar-device-section h3{
      font-size: 14px;
      font-weight: 800;
      margin: 0 0 12px 0;
      color: var(--text);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    /* Device status in sidebar */
    .sidebar-device-section .device-status{
      margin-bottom: 0;
      display: none;
    }
    
    .sidebar-device-section .device-status.active{
      display: flex;
    }
    
    .sidebar-device-section #activate-device-sidebar{
      display: block;
    }
    
    .sidebar-device-section .device-status.active ~ #activate-device-sidebar{
      display: none !important;
    }
    
    /* Sidebar buttons */
    .sidebar-buttons{
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: auto;
      padding-top: 20px;
      border-top: 1px solid rgba(232,238,252,.12);
    }
    
    .sidebar-buttons .btn{
      width: 100%;
      justify-content: center;
    }
    
    /* Mobile responsive */
    @media (max-width:900px){
      .menu{display:none}
      .cta .device-activate-wrapper{display:none}
      .cta .btn.ghost{display:none}
      .hamburger{display:block}
      .brand .small.tagline{display:none}
      .brand b{font-size: 16px}
    }
    @media (max-width:600px){
      .brand .small{display:none}
    }
    
    /* Old menu drawer - hide it */
    .menu-drawer{
      display: none !important;
    }

    /* ============ DEVICE STATUS DISPLAY ============ */
    .device-status{
      display:none;
      padding:12px 16px;
      border-radius:14px;
      background:rgba(134,239,172,.1);
      border:1px solid rgba(134,239,172,.3);
      align-items:center;
      gap:12px;
    }
    .device-status.active{
      display:flex;
    }
    .status-dot{
      width:10px;
      height:10px;
      border-radius:50%;
      background:#86efac;
      box-shadow:0 0 0 3px rgba(134,239,172,.2);
      animation:pulse 2s infinite;
      flex-shrink:0;
    }
    @keyframes pulse{
      0%,100%{opacity:1}
      50%{opacity:.7}
    }
    .status-text{
      flex:1;
      font-size:14px;
    }
    .status-text strong{
      display:block;
      color:var(--text);
      margin-bottom:2px;
    }
    .status-text small{
      display:block;
      color:var(--muted);
      font-size:12px;
    }
    .device-activate-wrapper{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
    }

    /* ============ ENTRY MODAL OVERLAY ============ */
    .entry-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
      backdrop-filter: blur(8px);
      display: grid;
      place-items: center;
      z-index: 10000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
      padding: 18px;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
    }
    
    /* Lock body scroll when modal is active */
    body:has(.entry-overlay.active),
    body:has(.pod-gate-overlay.active) {
      overflow: hidden;
      position: fixed;
      width: 100%;
    }

    .entry-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .entry-overlay .overlay {
      width: min(720px, 100%);
      max-width: 100%;
      max-height: calc(100vh - 36px);
      background: rgba(11,18,32,.35);
      border: 1px solid rgba(232,238,252,.10);
      border-radius: calc(var(--radius) + 6px);
      padding: 10px;
      box-shadow: var(--shadow);
      backdrop-filter: blur(10px);
      transform: scale(0.95);
      transition: transform 0.3s ease;
      margin: auto;
      display: flex;
      flex-direction: column;
    }

    .entry-overlay.active .overlay {
      transform: scale(1);
    }

    .entry-overlay .modal {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      padding: 20px;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      max-height: 100%;
      display: flex;
      flex-direction: column;
    }

    .entry-overlay .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 10px;
    }

    .entry-overlay .logo {
      width: 40px;
      height: 40px;
      border-radius: 14px;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      box-shadow: 0 12px 24px rgba(0,0,0,.28);
      flex: 0 0 auto;
    }

    .entry-overlay .brand b {
      letter-spacing: .3px;
    }

    .entry-overlay .brand .sub {
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px;
    }

    .entry-overlay h1 {
      font-size: 26px;
      line-height: 1.15;
      margin: 8px 0 8px;
      letter-spacing: -.3px;
    }

    .entry-overlay p {
      margin: 0 0 12px;
      color: var(--muted);
      line-height: 1.45;
    }

    .entry-overlay .pillrow {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin: 10px 0 14px;
    }

    .entry-overlay .pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(232,238,252,.08);
      border: 1px solid rgba(232,238,252,.12);
      font-size: 12px;
      color: var(--muted);
    }

    .entry-overlay .dot {
      width: 9px;
      height: 9px;
      border-radius: 999px;
      background: var(--accent);
      box-shadow: 0 0 0 4px rgba(125,211,252,.10);
    }

    .entry-overlay .dot.good {
      background: var(--good);
      box-shadow: 0 0 0 4px rgba(134,239,172,.10);
    }

    .entry-overlay .dot.warn {
      background: var(--warn);
      box-shadow: 0 0 0 4px rgba(251,191,36,.12);
    }

    .entry-overlay .cta {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 12px;
    }

    .entry-overlay .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px 14px;
      border-radius: 14px;
      border: 1px solid rgba(232,238,252,.16);
      background: rgba(232,238,252,.06);
      color: var(--text);
      font-weight: 900;
      cursor: pointer;
      text-decoration: none;
      transition: transform .08s ease, background .12s ease, filter .08s ease;
    }

    .entry-overlay .btn:hover {
      background: rgba(232,238,252,.10);
      transform: translateY(-1px);
    }

    .entry-overlay .btn:active {
      transform: translateY(0px);
      filter: brightness(.98);
    }

    .entry-overlay .btn.primary {
      border-color: transparent;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      color: #071024;
    }

    .entry-overlay .btn.primary:hover {
      filter: brightness(1.05);
    }

    .entry-overlay .btn.ghost {
      background: transparent;
    }

    .entry-overlay .divider {
      height: 1px;
      background: rgba(232,238,252,.12);
      margin: 14px 0;
    }

    .entry-overlay .top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 10px;
      flex-wrap: wrap;
    }
    .entry-overlay .q {
      margin-top: 14px;
      padding: 14px;
      border-radius: 16px;
      border: 1px solid var(--line);
      background: rgba(0,0,0,.18);
    }
    .entry-overlay .q h2 { margin: 0 0 6px; font-size: 14px; }
    .entry-overlay .q p { margin: 0; color: var(--muted); font-size: 13px; line-height: 1.45; }
    .entry-overlay .pillRow {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 10px;
    }
    .entry-overlay .pillRow .pill {
      border: 1px solid var(--line);
      border-radius: 999px;
      padding: 8px 12px;
      background: rgba(255,255,255,.04);
      cursor: pointer;
      font-weight: 800;
      font-size: 13px;
      appearance: none;
    }
    .entry-overlay .pillRow .pill[aria-pressed="true"] {
      outline: 2px solid rgba(125,211,252,.55);
    }
    .entry-overlay .fine {
      margin-top: 12px;
      color: var(--muted);
      font-size: 12px;
      line-height: 1.5;
    }
    .entry-overlay .note {
      font-size: 12px;
      color: var(--muted);
      line-height: 1.5;
      margin: 8px 0 0;
    }

    .entry-overlay .list {
      display: grid;
      gap: 10px;
      margin-top: 12px;
    }

    .entry-overlay .item {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      padding: 12px;
      border-radius: 16px;
      background: rgba(232,238,252,.05);
      border: 1px solid rgba(232,238,252,.10);
    }

    .entry-overlay .item b {
      color: var(--text);
      font-size: 13px;
    }

    .entry-overlay .item span {
      display: block;
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px;
    }

    .entry-overlay .legal {
      margin-top: 12px;
      font-size: 12px;
      color: var(--muted);
    }

    @media (max-width: 768px) {
      .entry-overlay {
        padding: 0;
        align-items: stretch;
        padding-top: 0;
        padding-bottom: 0;
        display: flex;
        flex-direction: column;
      }
      .entry-overlay .overlay {
        max-height: 100vh;
        width: 100%;
        padding: 0;
        border-radius: 0;
        margin: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 0;
      }
      .entry-overlay .modal {
        padding: 20px 16px;
        max-height: 100vh;
        border-radius: 0;
        overflow-y: auto;
        flex: 1;
        min-height: 0;
        -webkit-overflow-scrolling: touch;
      }
      .entry-overlay h1 {
        font-size: 22px;
        margin: 4px 0 8px;
      }
      .entry-overlay .brand {
        margin-bottom: 8px;
      }
      .entry-overlay .logo {
        width: 36px;
        height: 36px;
      }
      .entry-overlay .brand b {
        font-size: 16px;
      }
      .entry-overlay .brand .sub {
        font-size: 11px;
      }
      .entry-overlay p {
        font-size: 14px;
        line-height: 1.5;
      }
      .entry-overlay .btn {
        width: 100%;
        min-height: 48px;
        font-size: 15px;
        padding: 12px 16px;
      }
      .entry-overlay .cta {
        margin-top: 16px;
        flex-direction: column;
        gap: 10px;
      }
      .entry-overlay .legal {
        margin-top: 16px;
        font-size: 11px;
        line-height: 1.5;
      }
      .entry-overlay .list {
        gap: 8px;
        margin-top: 10px;
      }
      .entry-overlay .item {
        padding: 10px;
      }
      .entry-overlay .item b {
        font-size: 12px;
      }
      .entry-overlay .item span {
        font-size: 11px;
      }
      .entry-overlay .pillrow {
        gap: 6px;
        margin: 8px 0 12px;
      }
      .entry-overlay .pill {
        font-size: 11px;
        padding: 5px 8px;
      }
    }
    
    @media (max-width: 480px) {
      .entry-overlay .modal {
        padding: 16px 12px;
      }
      .entry-overlay h1 {
        font-size: 20px;
      }
      .entry-overlay .logo {
        width: 32px;
        height: 32px;
      }
      .entry-overlay .brand b {
        font-size: 15px;
      }
      .entry-overlay .btn {
        min-height: 44px;
        font-size: 14px;
      }
    }

    /* ============ POD GATE MODAL ============ */
    .pod-gate-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
      backdrop-filter: blur(8px);
      display: none;
      grid;
      place-items: center;
      z-index: 10000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      padding: 18px;
    }

    .pod-gate-overlay.active {
      display: grid;
      opacity: 1;
      visibility: visible;
    }

    .pod-gate-modal {
      width: min(880px, 92%);
      max-width: 100%;
      max-height: calc(100vh - 36px);
      background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.06));
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: var(--radius);
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
      padding: 28px;
      transform: scale(0.95);
      transition: transform 0.3s ease;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      margin: auto;
    }

    .pod-gate-overlay.active .pod-gate-modal {
      transform: scale(1);
    }

    .pod-gate-grid {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 24px;
    }

    @media (max-width: 820px) {
      .pod-gate-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .pod-gate-overlay {
        padding: 0;
        align-items: stretch;
        padding-top: 0;
        padding-bottom: 0;
        display: flex;
        flex-direction: column;
      }
      .pod-gate-modal {
        max-height: 100vh;
        width: 100%;
        padding: 24px 20px;
        border-radius: 0;
        margin: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 0;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
      }
      .pod-gate-grid {
        flex: 1;
        min-height: 0;
        display: flex;
        flex-direction: column;
      }
      .pod-gate-modal h2 {
        font-size: 22px;
        margin-bottom: 12px;
      }
      .pod-gate-sub {
        font-size: 14px;
        line-height: 1.6;
        margin-top: 8px;
      }
      .choice-btn {
        min-width: 100%;
        min-height: 48px;
        padding: 14px 16px;
        font-size: 15px;
      }
      .btn-row {
        flex-direction: column;
        gap: 10px;
        margin-top: 16px;
      }
      .statement-box {
        margin-top: 16px;
        padding: 16px;
      }
      .statement-box p {
        font-size: 13px;
        line-height: 1.6;
      }
      .modal-footer {
        margin-top: 16px;
        font-size: 11px;
        flex-direction: column;
        gap: 8px;
        text-align: center;
      }
      .pod-gate-grid {
        gap: 20px;
      }
    }

    @media (max-width: 480px) {
      .pod-gate-modal {
        padding: 20px 16px;
      }
      .pod-gate-modal h2 {
        font-size: 20px;
      }
      .choice-btn {
        min-height: 44px;
        font-size: 14px;
        padding: 12px 14px;
      }
      .statement-box {
        padding: 12px;
      }
      .statement-box p {
        font-size: 12px;
      }
    }

    .pod-gate-modal h2 {
      margin: 0;
      font-size: 26px;
      color: var(--text);
    }

    .pod-gate-sub {
      margin-top: 10px;
      color: var(--muted);
      line-height: 1.6;
    }

    .btn-row {
      margin-top: 18px;
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .choice-btn {
      flex: 1;
      min-width: 200px;
      padding: 14px;
      border-radius: 14px;
      border: 1px solid rgba(255, 255, 255, 0.14);
      background: rgba(255, 255, 255, 0.12);
      color: var(--text);
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .choice-btn:hover {
      background: rgba(255, 255, 255, 0.18);
      border-color: var(--accent);
      transform: translateY(-1px);
    }

    .statement-box {
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: 16px;
      padding: 18px;
      background: linear-gradient(180deg, rgba(255, 255, 255, 0.12), rgba(0, 0, 0, 0.15));
    }

    /* ============ OTP POPUP ROLE SELECTION - With visible radio buttons ============ */
    .hb-role-selection {
      text-align: left;
    }

    .hb-role-option {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 16px 20px;
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.14);
      background: rgba(255, 255, 255, 0.08);
      color: var(--text);
      font-weight: 500;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .hb-role-option:hover {
      background: rgba(255, 255, 255, 0.12);
      border-color: rgba(255, 255, 255, 0.18);
      transform: translateY(-1px);
    }

    .hb-role-option input[type="radio"] {
      width: 22px;
      height: 22px;
      margin: 0;
      cursor: pointer;
      accent-color: var(--accent);
      flex-shrink: 0;
      -webkit-appearance: none;
      appearance: none;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      background: transparent;
      position: relative;
    }

    .hb-role-option input[type="radio"]:checked {
      border-color: var(--accent);
      background: var(--accent);
    }

    .hb-role-option input[type="radio"]:checked::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: rgba(7, 16, 36, 0.9);
    }

    .hb-role-option span {
      font-size: 16px;
      color: var(--text);
      font-weight: 500;
      flex: 1;
    }

    .hb-role-option:has(input[type="radio"]:checked) {
      background: rgba(125,211,252,.12);
      border-color: rgba(125,211,252,.3);
    }

    .hb-role-option:has(input[type="radio"]:checked) span {
      font-weight: 600;
      color: var(--accent);
    }

    .statement-box strong {
      color: var(--text);
    }

    .statement-box p {
      margin: 0;
      font-size: 13px;
      line-height: 1.7;
      color: var(--muted);
    }

    .modal-footer {
      margin-top: 18px;
      font-size: 12px;
      color: var(--muted);
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    /* POC Join Guild Modal (YAM) */
    :root{
      --yam-bg:#0b0f14;
      --yam-card:#0f1621;
      --yam-ink:#eaf1ff;
      --yam-muted:#b7c3d9;
      --yam-line:rgba(255,255,255,.12);
      --yam-shadow: 0 16px 40px rgba(0,0,0,.45);
      --yam-radius:18px;
      --yam-good:#7CFFB2;
      --yam-link:#a7c7ff;
      --yam-warn:#FFD37C;
      --yam-mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      --yam-sans: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
    }
    .yam-btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      padding:12px 14px;
      border-radius:14px;
      border:1px solid var(--yam-line);
      background:rgba(255,255,255,.05);
      color:var(--yam-ink);
      font-weight:800;
      letter-spacing:.01em;
      cursor:pointer;
      box-shadow: 0 10px 26px rgba(0,0,0,.25);
    }
    .yam-btn:hover{background:rgba(255,255,255,.08)}
    .yam-btn.primary{
      background:linear-gradient(90deg, rgba(124,255,178,.22), rgba(167,199,255,.22));
      border-color: rgba(167,199,255,.25);
    }
    .yam-modal{
      position:fixed;
      inset:0;
      display:none;
      padding:18px;
      background:rgba(0,0,0,.60);
      backdrop-filter: blur(6px);
      z-index:9999;
      overflow-y:auto;
      overflow-x:hidden;
      -webkit-overflow-scrolling:touch;
    }
    .yam-modal[aria-hidden="false"]{display:block;}
    .yam-modal[aria-hidden="false"]{
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:flex-start;
      padding-top:24px;
      padding-bottom:24px;
    }
    body:has(.yam-modal[aria-hidden="false"]){overflow:hidden;}
    .yam-dialog{
      width:min(980px, 100%);
      border-radius:22px;
      background:rgba(15,22,33,.92);
      border:1px solid var(--yam-line);
      box-shadow:var(--yam-shadow);
      overflow:visible;
      margin:auto;
      flex-shrink:0;
    }
    .yam-dialogHeader{
      padding:18px 18px 14px;
      border-bottom:1px solid var(--yam-line);
      background:linear-gradient(to bottom, rgba(255,255,255,.04), transparent);
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
      gap:14px;
    }
    .yam-titleBlock{min-width:0}
    .yam-kicker{
      display:flex;
      align-items:center;
      gap:10px;
      color:var(--yam-muted);
      font-size:13px;
      letter-spacing:.08em;
      text-transform:uppercase;
    }
    .yam-dot{
      width:10px; height:10px; border-radius:999px;
      background:linear-gradient(90deg, var(--yam-good), var(--yam-link));
      box-shadow:0 0 0 4px rgba(124,255,178,.10);
    }
    .yam-dialogHeader h3{
      margin:10px 0 6px;
      font-size:22px;
      letter-spacing:-.01em;
      color:var(--yam-ink);
    }
    .yam-sub{
      margin:0;
      color:var(--yam-muted);
      font-size:14px;
      max-width:80ch;
    }
    .yam-close{
      flex:0 0 auto;
      border:1px solid var(--yam-line);
      background:rgba(255,255,255,.04);
      color:var(--yam-ink);
      width:42px; height:42px;
      border-radius:14px;
      cursor:pointer;
      font-weight:900;
    }
    .yam-close:hover{background:rgba(255,255,255,.07)}
    .yam-body{
      padding:16px 18px 18px;
      display:grid;
      grid-template-columns: 1.1fr .9fr;
      gap:16px;
    }
    @media (max-width: 900px){
      .yam-body{grid-template-columns:1fr}
    }
    .yam-card{
      border:1px solid var(--yam-line);
      border-radius:18px;
      padding:14px;
      background:rgba(255,255,255,.03);
    }
    .yam-alert{
      border-left:4px solid rgba(255,211,124,.55);
      background:rgba(255,211,124,.06);
      border-radius:16px;
      padding:12px 12px 12px 14px;
    }
    .yam-alert strong{color:var(--yam-warn)}
    .yam-metaRow{
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      margin-top:10px;
    }
    .yam-pill{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding:8px 10px;
      border-radius:999px;
      border:1px solid var(--yam-line);
      color:var(--yam-muted);
      background:rgba(0,0,0,.18);
      font-size:12.5px;
      white-space:nowrap;
    }
    .yam-pill b{color:var(--yam-ink)}
    .yam-form{
      display:grid;
      gap:12px;
      margin-top:12px;
    }
    .yam-row{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:12px;
    }
    @media (max-width: 700px){
      .yam-row{grid-template-columns:1fr}
    }
    .yam-field label{
      display:block;
      font-size:12px;
      letter-spacing:.06em;
      text-transform:uppercase;
      color:var(--yam-muted);
      margin:0 0 6px;
    }
    .yam-field input,
    .yam-field select,
    .yam-field textarea{
      width:100%;
      padding:11px 12px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(0,0,0,.25);
      color:var(--yam-ink);
      outline:none;
    }
    .yam-field textarea{min-height:90px; resize:vertical}
    .yam-field input::placeholder,
    .yam-field textarea::placeholder{color:rgba(183,195,217,.65)}
    .yam-help{
      margin:6px 0 0;
      color:var(--yam-muted);
      font-size:12.5px;
    }
    .yam-meter{
      display:grid;
      gap:10px;
      margin-top:12px;
    }
    .yam-meterTop{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:10px;
      color:var(--yam-muted);
      font-size:13px;
    }
    .yam-bar{
      height:12px;
      border-radius:999px;
      border:1px solid var(--yam-line);
      background:rgba(0,0,0,.22);
      overflow:hidden;
    }
    .yam-bar > span{
      display:block;
      height:100%;
      width:0%;
      background:linear-gradient(90deg, rgba(255,211,124,.28), rgba(124,255,178,.28), rgba(167,199,255,.28));
    }
    .yam-mono{
      font-family:var(--yam-mono);
      font-size:12.5px;
      color:rgba(234,241,255,.88);
    }
    .yam-actions{
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      justify-content:flex-end;
      padding:14px 18px;
      border-top:1px solid var(--yam-line);
      background:rgba(0,0,0,.18);
    }
    .yam-note{
      flex:1 1 240px;
      color:var(--yam-muted);
      font-size:12.5px;
      align-self:center;
      min-width:200px;
    }
    .ctaRow{display:flex;gap:10px;flex-wrap:wrap;margin-top:14px}
    .home-register-modal{position:fixed;inset:0;background:rgba(0,0,0,.68);display:none;align-items:center;justify-content:center;padding:18px;z-index:10001}
    .home-register-modal.show{display:flex}
    .home-register-modal .modal-inner{max-width:820px;width:100%;border-radius:18px;border:1px solid var(--line);background:#0c121b;padding:18px}
    .home-register-modal .modalTop{display:flex;align-items:flex-start;gap:10px;margin-bottom:10px}
    .home-register-modal .modalTop h3{margin:0;font-size:18px}
    .home-register-modal .modalTop .x{margin-left:auto}
    .home-register-modal .row{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    @media (max-width:760px){.home-register-modal .row{grid-template-columns:1fr}}
    .home-register-modal label{display:block;font-size:12px;color:var(--muted);margin:10px 0 6px}
    .home-register-modal input,.home-register-modal select{width:100%;padding:11px 12px;border-radius:12px;border:1px solid var(--line);background:rgba(255,255,255,.04);color:var(--text);outline:none}
    .home-register-modal .check{display:flex;gap:10px;align-items:flex-start;margin-top:10px}
    .home-register-modal .check input{width:auto;margin-top:2px}
    .home-register-modal .actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:12px}
    .home-register-modal .hidden{display:none !important}
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>

<body>
  <!-- ================= ENTRY MODAL (Enter Website protocol) ================= -->
  <div class="entry-overlay" id="enterOverlay" role="dialog" aria-modal="true" aria-labelledby="enterTitle">
    <div class="overlay">
      <div class="modal">
        <div class="top">
          <div class="brand">
            <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
            <div>
              <h1 id="enterTitle"><?php echo esc_html( get_bloginfo( 'name' ) ); ?> • Enter Website</h1>
              <div class="sub">Two quick prompts. Then you choose the path.</div>
            </div>
          </div>
          <div class="cta" style="margin-top:0">
            <button type="button" class="btn" id="entryHomeBtn">Home</button>
            <a class="btn" href="<?php echo esc_url( home_url( '/faq' ) ); ?>">What is this?</a>
          </div>
        </div>

        <div class="q" id="q1">
          <h2>Prompt 1 — Is this Proof of Delivery?</h2>
          <p>Choose <strong>Yes</strong> only if you're confirming a delivery event (voucher attached / proof recorded).</p>
          <div class="pillRow">
            <button type="button" class="pill" id="podYes" aria-pressed="false">Yes</button>
            <button type="button" class="pill" id="podNo" aria-pressed="false">No</button>
          </div>
        </div>

        <div class="q" id="q2">
          <h2>Prompt 2 — Is this the Final Destination?</h2>
          <p>Choose <strong>Yes</strong> only if the package arrived at its intended final destination.</p>
          <div class="pillRow">
            <button type="button" class="pill" id="fdYes" aria-pressed="false">Yes</button>
            <button type="button" class="pill" id="fdNo" aria-pressed="false">No</button>
          </div>
        </div>

        <div class="divider" role="separator"></div>

        <div class="cta">
          <button type="button" class="btn primary" id="enterWebsite">Enter Website</button>
          <a class="btn" href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>" id="entryHowBtn">How it works</a>
        </div>

        <p class="fine">
          Your responses are recorded for reputation outcomes ("Kalshi Mirror" style metrics) at individual / group / guild levels.
          Demo storage key: <code>hb_last_scan</code>.
        </p>

        <p class="note">
          If <strong>Proof of Delivery = Yes</strong>, you'll be routed to the <strong>WooCommerce Backorder routine</strong>.
          If <strong>No</strong>, you'll be routed into the onboarding funnel (device registration → membership → Discord).
        </p>
      </div>
    </div>
  </div>

  <!-- ================= POD GATE MODAL ================= -->
  <div class="pod-gate-overlay" id="podOverlay">
    <div class="pod-gate-modal" id="podGate">
      <div class="pod-gate-grid">
        <div>
          <h2>Is This Proof of Delivery?</h2>
          <p class="pod-gate-sub">
            Select <strong>Yes</strong> only if you are validating a delivery event
            using a 2-scan Proof-of-Delivery process.
          </p>
          <div class="btn-row">
            <button class="choice-btn" id="podGateYes">
              YES — Proof of Delivery
            </button>
            <button class="choice-btn" id="podGateNo">
              NO — Continue to Website
            </button>
          </div>
        </div>
        <aside class="statement-box">
          <p>
            <strong>
              "Small Street Applied–Atlanta is a Wyoming DAO and Limited Cooperative Association
            </strong>
            that embodies the functional spirit of an FRB Section 25A coordination role by operating a
            <strong>non-custodial, proof-based clearing-visibility and reporting system</strong>
            for independent participants."
          </p>
        </aside>
      </div>
      <div class="modal-footer">
        <span>HumanBlockchain.info</span>
        <span>Proof before payment • Visibility without custody</span>
      </div>
    </div>
  </div>

  <!-- TOP NAV -->
  <header class="topbar">
    <div class="wrap">
      <nav class="nav" aria-label="Primary">
        <a class="brand" href="/">
          <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
          <div>
            <b><?php echo esc_html( get_bloginfo( 'name' ) ); ?></b><br>
            <span class="small tagline">Device-driven trust • 2-scan Proof of Delivery • XP accounting</span>
          </div>
        </a>

        <!-- Desktop menu -->
        <div class="menu" aria-label="Menu">
          <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>">Membership</a>
          <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">How it works</a>
          <a href="#faq">FAQs</a>
          <a href="#organizers">Organizers</a>
          <a href="<?php echo esc_url( home_url( '/detente-2030' ) ); ?>">Detente 2030</a>
          <a href="<?php echo esc_url( home_url( '/proof-of-delivery' ) ); ?>">Proof of Delivery</a>
          <a href="<?php echo esc_url( home_url( '/poc-guilds' ) ); ?>">POC Guilds</a>
        </div>

        <!-- Right side actions + mobile toggle -->
        <div class="cta">
          <button class="btn primary" type="button" id="openRegisterModal">Register Device</button>
          <button class="btn primary open-join-poc-trigger" id="openJoinPOC" type="button">Start POC</button>
          <div class="device-activate-wrapper">
            <!-- Active Status Display (hidden by default) -->
            <div class="device-status" id="device-status-nav">
              <span class="status-dot"></span>
              <div class="status-text">
                <strong>Device Active</strong>
                <small id="device-status-nav-message">Ready to use</small>
              </div>
            </div>
            <!-- Activate Button (shown by default) -->
            <a class="btn primary" href="/activate-device" id="activate-device-nav">Activate Device</a>
          </div>
          <a class="btn ghost" href="/pod-mode">PoD Mode</a>

          <div class="hamburger">
            <input id="navtoggle" type="checkbox" />
            <label for="navtoggle" aria-label="Open menu">
              <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </label>
          </div>
        </div>
      </nav>
    </div>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>
    
    <!-- Sidebar Menu -->
    <div class="sidebar-menu" aria-label="Mobile Sidebar Menu">
      <div class="sidebar-header">
        <h2 style="margin:0; font-size:18px; font-weight:800;">Menu</h2>
        <label for="navtoggle" class="sidebar-close" aria-label="Close menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </label>
      </div>
      
      <!-- Navigation Links -->
      <div class="sidebar-menu-links">
        <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>">Membership</a>
        <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">How it works</a>
        <a href="#faq">FAQs</a>
        <a href="#organizers">Organizers</a>
        <a href="<?php echo esc_url( home_url( '/detente-2030' ) ); ?>">Detente 2030</a>
        <a href="<?php echo esc_url( home_url( '/proof-of-delivery' ) ); ?>">Proof of Delivery</a>
        <a href="<?php echo esc_url( home_url( '/poc-guilds' ) ); ?>">POC Guilds</a>
      </div>
      
      <!-- Device Status Section -->
      <div class="sidebar-device-section">
        <h3>Device Status</h3>
        <!-- Active Status Display -->
        <div class="device-status" id="device-status-sidebar">
          <span class="status-dot"></span>
          <div class="status-text">
            <strong>Device Active</strong>
            <small id="device-status-sidebar-message">Ready to use</small>
          </div>
        </div>
        <!-- Activate Button -->
        <a class="btn primary" href="/activate-device" id="activate-device-sidebar" style="margin-top:12px; width:100%; justify-content:center;">Activate Device</a>
      </div>
      
      <!-- Action Buttons -->
      <div class="sidebar-buttons">
        <button type="button" class="btn primary" id="openRegisterModalSidebar" style="width:100%; justify-content:center;">Register Device</button>
        <button type="button" class="btn primary open-join-poc-trigger" style="width:100%; justify-content:center;">Start POC</button>
        <a class="btn ghost" href="/pod-mode">PoD Mode</a>
      </div>
    </div>
  </header>

  <!-- Join POC Guild Modal -->
  <div class="yam-modal" id="joinPOCModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="joinPOCTitle">
    <div class="yam-dialog">
      <div class="yam-dialogHeader">
        <div class="yam-titleBlock">
          <div class="yam-kicker"><span class="yam-dot"></span> YAM'er Portal • Accrued Demand</div>
          <h3 id="joinPOCTitle">Join a POC Guild (5 sellers / 25 buyers)</h3>
          <p class="yam-sub">
            This pop-up records your <b>accrued demand</b> to join a community Guild. That demand is a Kalshi Mirror reputation signal:
            it proves who is ready to participate <i>before</i> assignments are finalized.
          </p>
        </div>
        <button class="yam-close" type="button" data-close-modal aria-label="Close">✕</button>
      </div>

      <div class="yam-body">
        <div class="yam-card">
          <div class="yam-alert">
            <strong>Status check:</strong> You do not currently have an active POC assignment.<br/>
            Submit this demand record to enter the serendipity assignment queue.
          </div>

          <form class="yam-form" id="joinPOCForm" action="#" method="post">
            <input type="hidden" name="member_id" value="" />
            <input type="hidden" name="device_id" value="" />
            <input type="hidden" name="current_poc_status" value="NO_ACTIVE_POC" />

            <div class="yam-row">
              <div class="yam-field">
                <label for="rolePref">Role preference</label>
                <select id="rolePref" name="role_preference" required>
                  <option value="" selected disabled>Select…</option>
                  <option value="YAMER_BUYER">YAM'er (Buyer)</option>
                  <option value="SELLER_ELIGIBLE">Seller-Eligible (I can sponsor + deliver)</option>
                  <option value="EITHER_SERENDIPITY">Either (serendipity assigns)</option>
                </select>
                <p class="yam-help">Serendipity can assign you to a buyer POC and/or place you in the seller queue, based on capacity.</p>
              </div>
              <div class="yam-field">
                <label for="assignmentMode">Assignment mode</label>
                <select id="assignmentMode" name="assignment_mode" required>
                  <option value="" selected disabled>Select…</option>
                  <option value="SERENDIPITY_DEFAULT">Serendipity (default)</option>
                  <option value="INVITE_CODE">I have an invite code</option>
                  <option value="ORG_SPONSORED_EVENT">I joined at an event</option>
                </select>
                <p class="yam-help">Invite code and event mode help your Guild form faster while still respecting assignments.</p>
              </div>
            </div>

            <div class="yam-row">
              <div class="yam-field">
                <label for="pledgeIntent">Pledge intent</label>
                <select id="pledgeIntent" name="pledge_intent" required>
                  <option value="" selected disabled>Select…</option>
                  <option value="READY_30">I'm ready to pledge $30 at the next kite festival</option>
                  <option value="READY_NOW">I'm ready now (next available event)</option>
                  <option value="OBSERVE_FIRST">I will observe first, then pledge</option>
                </select>
                <p class="yam-help">This is a participation signal—"leave your wallet at home" still applies.</p>
              </div>
              <div class="yam-field">
                <label for="eventWindow">Preferred event window</label>
                <select id="eventWindow" name="preferred_event_window" required>
                  <option value="" selected disabled>Select…</option>
                  <option value="NEXT_30_DAYS">Next 30 days</option>
                  <option value="NEXT_60_DAYS">Next 60 days</option>
                  <option value="NEXT_90_DAYS">Next 90 days</option>
                  <option value="ANYTIME">Anytime (first available)</option>
                </select>
                <p class="yam-help">Used to measure demand and schedule Guild formation.</p>
              </div>
            </div>

            <div class="yam-row">
              <div class="yam-field">
                <label for="region">Region (city/state)</label>
                <input id="region" name="region" type="text" placeholder="e.g., Atlanta, GA" required />
                <p class="yam-help">Helps group nearby participation opportunities without exposing your exact location.</p>
              </div>
              <div class="yam-field">
                <label for="contact">Contact (email or SMS)</label>
                <input id="contact" name="contact" type="text" placeholder="you@email.com or (555) 555-5555" required />
                <p class="yam-help">Only used for Guild assignment notifications and event reminders.</p>
              </div>
            </div>

            <div class="yam-field">
              <label for="notes">Notes (optional)</label>
              <textarea id="notes" name="notes" placeholder="Anything that helps place you faster: invite code, organizer name, event name, etc."></textarea>
              <p class="yam-help">If you selected "Invite code," place it here (or your portal can show an invite field conditionally).</p>
            </div>

            <div class="yam-row">
              <div class="yam-field">
                <label for="consent1"><span class="yam-mono">Kalshi Mirror consent</span></label>
                <select id="consent1" name="kalshi_mirror_consent" required>
                  <option value="" selected disabled>Select…</option>
                  <option value="YES">Yes — record my demand as reputation</option>
                  <option value="NO">No — do not record demand</option>
                </select>
                <p class="yam-help">Selecting "Yes" creates a demand signal for community formation metrics.</p>
              </div>
              <div class="yam-field">
                <label for="consent2"><span class="yam-mono">Serendipity assignment acknowledgement</span></label>
                <select id="consent2" name="serendipity_ack" required>
                  <option value="" selected disabled>Select…</option>
                  <option value="YES">Yes — I accept serendipity placement</option>
                  <option value="NO">No — I do not accept placement</option>
                </select>
                <p class="yam-help">If "No," you can still browse events but won't enter the assignment queue.</p>
              </div>
            </div>
          </form>
        </div>

        <div class="yam-card">
          <h4 style="margin:0 0 8px; font-size:16px; letter-spacing:-.01em;">Accrued Demand (Mirror Signal)</h4>
          <p class="yam-sub" style="max-width:none">
            As you fill the form, this preview shows the demand signal your Guild will publish:
            a simple, auditable count of who's ready to participate.
          </p>

          <div class="yam-meter" aria-live="polite">
            <div class="yam-meterTop">
              <span>Demand strength</span>
              <span class="yam-mono" id="demandScore">0 / 100</span>
            </div>
            <div class="yam-bar" aria-label="Demand strength bar">
              <span id="demandBar"></span>
            </div>
            <div class="yam-metaRow">
              <div class="yam-pill"><b>Status:</b> NO_ACTIVE_POC</div>
              <div class="yam-pill"><b>Signal:</b> Accrued Demand</div>
              <div class="yam-pill"><b>Queue:</b> Serendipity</div>
            </div>
          </div>

          <div class="divider" style="margin:16px 0"></div>

          <div class="yam-card" style="padding:12px; background:rgba(0,0,0,.22)">
            <div class="yam-mono" style="margin-bottom:8px; opacity:.9">Mirror event payload (preview)</div>
            <div class="ledger" style="margin:0">
<pre id="mirrorPreview">{
  "event_type": "POC_ACCRUED_DEMAND",
  "member_status": "NO_ACTIVE_POC",
  "role_preference": null,
  "assignment_mode": null,
  "pledge_intent": null,
  "preferred_event_window": null,
  "region": null,
  "consents": {
    "kalshi_mirror": null,
    "serendipity_ack": null
  }
}</pre>
            </div>
            <p class="note" style="margin-top:10px">
              Your backend can post this to the GitHub append-only ledger as a monthly aggregate or as hashed, privacy-preserving events.
            </p>
          </div>

          <div class="divider" style="margin:16px 0"></div>

          <div class="yam-alert">
            <strong>Reminder:</strong> This is not a cash register. It's a trust register.<br/>
            Demand today → Guild formation tomorrow → monthly receipts/obligations/extinguishments posted.
          </div>
        </div>
      </div>

      <div class="yam-actions">
        <div class="yam-note">
          Submitting creates a demand record for Kalshi Mirror reputation and serendipity queueing.
        </div>
        <button class="yam-btn" type="button" data-close-modal>Cancel</button>
        <button class="yam-btn primary" type="submit" form="joinPOCForm" id="submitJoinPOC">
          Submit Demand Signal
        </button>
      </div>
    </div>
  </div>

  <!-- Device Registration Modal -->
  <div class="home-register-modal" id="registerModalBg" role="dialog" aria-modal="true" aria-label="Device Registration">
    <div class="modal-inner">
      <div class="modalTop">
        <div>
          <h3 id="register">Register your device (Proof-first onboarding)</h3>
          <div class="small">Buyers: no QRtiger v-card required. Sellers: QRtiger v-card required.</div>
        </div>
        <button class="btn x" type="button" id="closeRegisterModal">Close</button>
      </div>
      <div class="row">
        <div>
          <label for="regFullName">Name (or handle)</label>
          <input id="regFullName" placeholder="Your name / handle" autocomplete="name" />
        </div>
        <div>
          <label for="regEmail">Email</label>
          <input id="regEmail" type="email" placeholder="you@email.com" autocomplete="email" />
        </div>
      </div>
      <div class="row">
        <div>
          <label for="regPhone">Mobile (SMS)</label>
          <input id="regPhone" placeholder="+1 (___) ___-____" autocomplete="tel" />
        </div>
        <div>
          <label for="regMsb">MSB credentials (choose one)</label>
          <select id="regMsb">
            <option value="PayPal">PayPal</option>
            <option value="Venmo">Venmo</option>
            <option value="ApplePay">Apple Pay</option>
            <option value="GooglePay">Google Pay</option>
            <option value="AliPay">AliPay</option>
            <option value="FonePay">FonePay</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div>
          <label for="regRole">I am registering as…</label>
          <select id="regRole">
            <option value="Buyer">Buyer (YAM'er)</option>
            <option value="Seller">Seller / Sponsor (MEGAvoter)</option>
          </select>
        </div>
        <div id="regSellerTypeWrap" class="hidden">
          <label for="regSellerType">Seller type</label>
          <select id="regSellerType">
            <option value="IndividualSponsored">Individual-sponsored</option>
            <option value="GroupSponsored">Group-sponsored</option>
          </select>
        </div>
      </div>
      <div id="regVcardWrap" class="hidden">
        <label for="regQrVcard">QRtiger v-card link (required for Sellers)</label>
        <input id="regQrVcard" placeholder="https://qrtiger.com/..." />
      </div>
      <div class="check">
        <input id="regConsent" type="checkbox" />
        <label for="regConsent" class="small">I consent to device-driven proof logging (timestamp + location if enabled) and understand XP is a non-cash accounting unit.</label>
      </div>
      <div class="check">
        <input id="regDiscord" type="checkbox" />
        <label for="regDiscord" class="small">I will accept the Discord Gracebook invite to activate my status (Pending → Active).</label>
      </div>
      <div class="actions">
        <button class="btn primary" type="button" id="submitDeviceBtn">Confirm Registration</button>
        <a class="btn" href="<?php echo esc_url( home_url( '/membership' ) ); ?>">Go to Membership</a>
      </div>
      <p class="small" id="regStatus" style="margin-top:10px;"></p>
      <div style="height:1px;background:var(--line);margin:12px 0"></div>
      <p class="small">Output created: Member ID, Device ID (hash), Serendipity Peace Pentagon role assignment, Buyer/Seller POC assignment status (Pending/Active).</p>
      <p class="small">Referral XP opportunities are shown after activation. NWP issuance is available only through Seller POCs.</p>
    </div>
  </div>

  <main>
    <section class="hero">
      <div class="wrap">
        <div class="grid" style="grid-template-columns:1.2fr .8fr;margin-top:0">
          <div class="card">
            <div class="kicker">
              <span class="pill">Leave wallet at home</span>
              <span class="pill">Presence becomes proof</span>
              <span class="pill">8–12 week maturity window</span>
            </div>
            <h1>Show how money should work—by showing up.</h1>
            <p class="lead">
              This is a pledge-based economy where <strong>presence becomes proof</strong>.
              Register your device, choose Buyer or Seller, accept your Discord Gracebook invite, and let Serendipity assign
              your Peace Pentagon role and your buyer/seller POC community.
            </p>
            <div class="ctaRow">
              <button class="btn primary" type="button" id="openRegisterModalHero">Start: Register your device</button>
              <a class="btn" href="<?php echo esc_url( home_url( '/membership' ) ); ?>">Choose membership level</a>
              <a class="btn" href="#how">How it works</a>
              <a class="btn" href="#faq">FAQs</a>
            </div>
            <p class="note" style="margin-top:12px">
              <span class="warn">XP disclaimer:</span>
              XP is a <strong>non-cash, non-transferable accounting unit</strong> used to measure verified participation events
              (device + timestamp + location + prompt outcomes). XP is <strong>not money</strong> and has <strong>no guaranteed redemption value</strong>
              prior to scheduled governance milestones.
            </p>
            <p class="note">
              Monthly statements are posted to an append-only ledger.
              Annual reconciliation aligns receipts, obligations, and extinguishment rules.
            </p>
          </div>
          <div class="card">
            <div class="badge"><span class="good">Buyer</span> • No QRtiger v-card required</div>
            <div style="height:1px;background:var(--line);margin:12px 0"></div>
            <div class="mini">
              <h3>Buyer (YAM'er path)</h3>
              <p>Device registration + MSB credentials (PayPal, Venmo, Apple Pay, Google Pay) + Discord Gracebook acceptance. A verified $30 pledge can trigger the <strong>$5 XP reward</strong>.</p>
            </div>
            <div style="height:10px"></div>
            <div class="badge"><span class="good">Seller</span> • QRtiger v-card required</div>
            <div style="height:1px;background:var(--line);margin:12px 0"></div>
            <div class="mini">
              <h3>Seller / Sponsor (MEGAvoter path)</h3>
              <p>Everything a buyer has, plus a <strong>QRtiger v-card</strong>. Seller can be individual-sponsored or group-sponsored. <strong>NWP issuing is strictly a feature of the Seller POC.</strong></p>
            </div>
            <p class="note">If five sellers can't gather and sing a song for peace, how will any plan work? This movement scales when even a small fraction shows up.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="how">
      <div class="wrap">
        <div class="card">
          <h2>How it works</h2>
          <div class="grid">
            <div class="mini">
              <h3>1) Register device</h3>
              <p>Link a phone to MSB credentials and consent to proof logging. Discord Gracebook acceptance activates the ledger identity.</p>
            </div>
            <div class="mini">
              <h3>2) Choose Buyer or Seller</h3>
              <p>Buyers do not need a QRtiger v-card. Sellers do. Serendipity assigns Peace Pentagon role + POC membership (Pending → Active).</p>
            </div>
            <div class="mini">
              <h3>3) Proof prompts</h3>
              <p>"Is this Proof of Delivery?" and "Final Destination?" outcomes are recorded for reputation metrics (individual / POC / guild).</p>
            </div>
            <div class="mini">
              <h3>4) Maturity + statements</h3>
              <p>XP matures 8–12 weeks after confirmed delivery. Monthly statements post to an append-only ledger; annual reconciliation follows.</p>
            </div>
          </div>
          <p class="note">PoD uses vouchers / delivery credentials attached to packages (never "stamp" language). Settlement is governed and reported outside the event moment.</p>
        </div>
      </div>
    </section>

    <section class="section" id="organizers">
      <div class="wrap">
        <div class="card">
          <h2>Grassroots organizers</h2>
          <p class="lead" style="margin:0">
            Organizers can qualify for <strong>MEGA Grants (up to 70%)</strong> when reliability is proven through Kalshi Mirror reputation scores
            (delivery performance, participation recovery, verified event outcomes).
          </p>
          <div class="ctaRow">
            <a class="btn" href="<?php echo esc_url( home_url( '/organizers' ) ); ?>">Organizer streamline</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/detente-2030' ) ); ?>">Detente 2030 build-out</a>
          </div>
          <p class="note">Kite festivals and quiet gatherings beat outrage marches. No slogans needed. Proof requires presence.</p>
        </div>
      </div>
    </section>

    <section class="section" id="faq">
      <div class="wrap">
        <div class="card">
          <h2>FAQs</h2>
          <div class="grid">
            <div class="mini">
              <h3>Do buyers need a QRtiger v-card?</h3>
              <p>No. Buyers need device registration + MSB credentials + Discord acceptance. Sellers must have a QRtiger v-card.</p>
            </div>
            <div class="mini">
              <h3>What makes someone "Active"?</h3>
              <p>After device registration, accepting the Discord Gracebook invite moves status from Pending to Active (plus any verification rules your governance applies).</p>
            </div>
            <div class="mini">
              <h3>Who issues NWP?</h3>
              <p>Only Seller POCs issue NWP. Buyer-only accounts earn XP recognition but don't issue NWP unless they activate as a seller.</p>
            </div>
            <div class="mini">
              <h3>Is XP money?</h3>
              <p>No. XP is an accounting unit for verified participation events. It's not cash, not transferable, and not guaranteed redeemable before scheduled milestones.</p>
            </div>
          </div>
          <p class="note">Want the simplest start? Register your device, choose Buyer, accept Discord, then explore referrals and "How it works."</p>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="wrap">
      <div style="display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap" class="small">
        <div>© <span id="y"></span> <?php echo esc_html( get_bloginfo( 'name' ) ); ?> • YAM = You And Me • Proof of Delivery vouchers • Append-only ledger posting</div>
        <div>
          <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>">Membership</a> •
          <a href="#register" id="footerRegisterLink">Register</a> •
          <a href="<?php echo esc_url( home_url( '/pod-mode' ) ); ?>">Scan Router</a>
        </div>
      </div>
    </div>

    <?php
    // Get current user info for JavaScript
    $current_user = wp_get_current_user();
    $user_data = array(
      'userId' => $current_user->ID,
      'userName' => $current_user->display_name,
      'userEmail' => $current_user->user_email,
      'loggedIn' => is_user_logged_in()
    );
    ?>
    <script>
      // Pass WordPress user data to JavaScript
      var hbcUserData = <?php echo json_encode($user_data); ?>;
      
      document.getElementById('y').textContent = new Date().getFullYear();

      // ---------- Register Device Modal ----------
      function openRegisterModal() {
        const el = document.getElementById('registerModalBg');
        if (el) { el.classList.add('show'); document.body.style.overflow = 'hidden'; }
        if (typeof toggleSidebar === 'function') toggleSidebar(false);
      }
      function closeRegisterModal() {
        const el = document.getElementById('registerModalBg');
        if (el) { el.classList.remove('show'); document.body.style.overflow = ''; }
      }
      function toggleRegisterSellerFields() {
        const role = document.getElementById('regRole') && document.getElementById('regRole').value;
        const v = document.getElementById('regVcardWrap');
        const t = document.getElementById('regSellerTypeWrap');
        if (role === 'Seller') {
          if (v) v.classList.remove('hidden');
          if (t) t.classList.remove('hidden');
        } else {
          if (v) v.classList.add('hidden');
          if (t) t.classList.add('hidden');
        }
      }
      function submitDeviceRegistration() {
        const role = document.getElementById('regRole').value;
        const name = (document.getElementById('regFullName') && document.getElementById('regFullName').value.trim()) || '';
        const email = (document.getElementById('regEmail') && document.getElementById('regEmail').value.trim()) || '';
        const phone = (document.getElementById('regPhone') && document.getElementById('regPhone').value.trim()) || '';
        const msb = document.getElementById('regMsb').value;
        const consent = document.getElementById('regConsent').checked;
        const discord = document.getElementById('regDiscord').checked;
        const vcard = (document.getElementById('regQrVcard') && document.getElementById('regQrVcard').value.trim()) || '';
        if (!name || !email || !phone) { alert('Please enter name, email, and mobile.'); return; }
        if (!consent) { alert('Please accept the consent checkbox.'); return; }
        if (!discord) { alert('Discord Gracebook acceptance is required to activate.'); return; }
        if (role === 'Seller' && !vcard) { alert('Sellers must provide a QRtiger v-card link.'); return; }
        var randId = function(prefix) { return prefix + '_' + Math.random().toString(16).slice(2) + '_' + Date.now().toString(16); };
        var branches = ['Planning','Budget','Media','Distribution','Membership'];
        var assignSerendipity = function() { return branches[Math.floor(Math.random() * branches.length)]; };
        var payload = {
          member_id: randId('m'),
          device_id: randId('d'),
          role: role,
          seller_type: role === 'Seller' ? document.getElementById('regSellerType').value : null,
          qrtiger_vcard: role === 'Seller' ? vcard : null,
          name: name,
          email: email,
          phone: phone,
          msb: msb,
          peace_pentagon_role: assignSerendipity(),
          buyer_poc_status: 'Pending',
          seller_poc_status: role === 'Seller' ? 'Pending' : null,
          created_at: new Date().toISOString()
        };
        try { localStorage.setItem('hb_registration', JSON.stringify(payload)); } catch (e) {}
        var statusEl = document.getElementById('regStatus');
        if (statusEl) statusEl.textContent = 'Saved (demo). Next: complete Membership choice and accept your Discord invite to move Pending → Active.';
      }
      (function() {
        var r = document.getElementById('regRole');
        if (r) r.addEventListener('change', toggleRegisterSellerFields);
        toggleRegisterSellerFields();
        ['openRegisterModal','openRegisterModalHero','openRegisterModalSidebar'].forEach(function(id) {
          var btn = document.getElementById(id);
          if (btn) btn.addEventListener('click', function(e) { e.preventDefault(); openRegisterModal(); });
        });
        var closeBtn = document.getElementById('closeRegisterModal');
        if (closeBtn) closeBtn.addEventListener('click', closeRegisterModal);
        var footerLink = document.getElementById('footerRegisterLink');
        if (footerLink) footerLink.addEventListener('click', function(e) { e.preventDefault(); openRegisterModal(); });
        var submitBtn = document.getElementById('submitDeviceBtn');
        if (submitBtn) submitBtn.addEventListener('click', submitDeviceRegistration);
        var modalBg = document.getElementById('registerModalBg');
        if (modalBg) modalBg.addEventListener('click', function(e) { if (e.target === modalBg) closeRegisterModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && modalBg && modalBg.classList.contains('show')) closeRegisterModal(); });
      })();

      // Entry Modal (Enter Website protocol) - Show on page load
      const enterOverlay = document.getElementById("enterOverlay");
      const podOverlay = document.getElementById("podOverlay");
      const enterWebsiteBtn = document.getElementById("enterWebsite");
      const podGateYes = document.getElementById("podGateYes");
      const podGateNo = document.getElementById("podGateNo");

      var scanState = { pod: null, final: null };
      var WOO_BACKORDER_URL = "<?php echo esc_url( home_url( '/backorder' ) ); ?>";
      var HOME_REGISTER = "<?php echo esc_url( home_url( '/' ) ); ?>#register";

      function setPressed(idYes, idNo, yesPressed) {
        var y = document.getElementById(idYes), n = document.getElementById(idNo);
        if (y) y.setAttribute("aria-pressed", yesPressed ? "true" : "false");
        if (n) n.setAttribute("aria-pressed", yesPressed ? "false" : "true");
      }
      function setAnswer(which, val) {
        scanState[which] = val;
        if (which === "pod") setPressed("podYes", "podNo", val === "YES");
        if (which === "final") setPressed("fdYes", "fdNo", val === "YES");
      }
      function persistScan() {
        var payload = {
          ts: new Date().toISOString(),
          pod: scanState.pod,
          final: scanState.final,
          geo: "client_geo_if_enabled",
          device: "device_hash_if_registered"
        };
        try { localStorage.setItem("hb_last_scan", JSON.stringify(payload)); } catch (e) {}
        console.log("Saved hb_last_scan:", payload);
      }
      function enterWebsiteFromOverlay() {
        if (!scanState.pod || !scanState.final) {
          alert("Please answer both prompts (PoD + Final Destination).");
          return;
        }
        persistScan();
        if (scanState.pod === "YES") {
          window.location.href = WOO_BACKORDER_URL;
        } else {
          enterOverlay.classList.remove("active");
          document.body.style.overflow = "";
          if (typeof openRegisterModal === "function") openRegisterModal();
          else window.location.href = HOME_REGISTER;
        }
      }

      // Show entry modal on page load
      window.addEventListener("load", function() {
        enterOverlay.classList.add("active");
        document.body.style.overflow = "hidden";
      });

      if (enterWebsiteBtn) enterWebsiteBtn.addEventListener("click", function(e) { e.preventDefault(); enterWebsiteFromOverlay(); });
      var entryHomeBtn = document.getElementById("entryHomeBtn");
      if (entryHomeBtn) entryHomeBtn.addEventListener("click", function() { enterOverlay.classList.remove("active"); document.body.style.overflow = ""; });

      var podYes = document.getElementById("podYes"), podNo = document.getElementById("podNo");
      var fdYes = document.getElementById("fdYes"), fdNo = document.getElementById("fdNo");
      if (podYes) podYes.addEventListener("click", function() { setAnswer("pod", "YES"); });
      if (podNo) podNo.addEventListener("click", function() { setAnswer("pod", "NO"); });
      if (fdYes) fdYes.addEventListener("click", function() { setAnswer("final", "YES"); });
      if (fdNo) fdNo.addEventListener("click", function() { setAnswer("final", "NO"); });

      // POD Gate (legacy / alternate flow) - Yes button (opens OTP verification popup - role selection)
      if (podGateYes) podGateYes.addEventListener("click", function() {
        podOverlay.classList.remove("active");
        document.body.style.overflow = "";
        // Open OTP verification popup at role selection step (Step 3)
        setTimeout(() => {
          // Function to show role selection popup
          function showRolePopup() {
            const otpPopup = document.getElementById('hb-otp-popup');
            
            if (!otpPopup) {
              console.error('OTP Popup element not found in DOM. Checking if it exists...');
              // Wait a bit and try again (in case DOM not fully loaded)
              setTimeout(() => {
                const retryPopup = document.getElementById('hb-otp-popup');
                if (retryPopup) {
                  showRolePopup();
                } else {
                  console.error('OTP Popup still not found after retry');
                }
              }, 100);
              return;
            }
            
            console.log('OTP Popup element found, showing role selection...');
            
            // Hide all steps first
            const allSteps = otpPopup.querySelectorAll('.hb-popup-step');
            console.log('Found', allSteps.length, 'popup steps');
            allSteps.forEach(step => {
              step.style.display = 'none';
            });
            
            // Show role selection step (Step 3)
            const roleStep = document.getElementById('hb-step-3');
            if (roleStep) {
              roleStep.style.display = 'block';
              console.log('Role selection step shown');
            } else {
              console.error('Role selection step (hb-step-3) not found');
            }
            
            // Show the popup - set all necessary styles explicitly
            otpPopup.style.cssText = `
              position: fixed !important;
              top: 0 !important;
              left: 0 !important;
              width: 100% !important;
              height: 100% !important;
              background-color: rgba(0, 0, 0, 0.7) !important;
              z-index: 99999 !important;
              display: flex !important;
              visibility: visible !important;
              opacity: 1 !important;
              align-items: center !important;
              justify-content: center !important;
            `;
            
            // Also ensure the popup container is visible
            const popupContainer = otpPopup.querySelector('.hb-popup-container');
            if (popupContainer) {
              popupContainer.style.display = 'block';
              popupContainer.style.visibility = 'visible';
              popupContainer.style.opacity = '1';
            }
            
            document.body.style.overflow = "hidden";
            
            // Verify it's visible
            const computedStyle = window.getComputedStyle(otpPopup);
            console.log('OTP Popup styles:', {
              display: computedStyle.display,
              visibility: computedStyle.visibility,
              opacity: computedStyle.opacity,
              zIndex: computedStyle.zIndex,
              position: computedStyle.position,
              width: computedStyle.width,
              height: computedStyle.height
            });
            
            // Check if popup is actually in viewport
            const rect = otpPopup.getBoundingClientRect();
            console.log('OTP Popup position:', {
              top: rect.top,
              left: rect.left,
              width: rect.width,
              height: rect.height,
              visible: rect.width > 0 && rect.height > 0
            });
            
            console.log('OTP Popup displayed at role selection step');
          }
          
          // Try to show immediately
          showRolePopup();
          
          // Also try with jQuery if available (as backup)
          if (typeof jQuery !== 'undefined') {
            jQuery(document).ready(function($) {
              const $popup = $('#hb-otp-popup');
              if ($popup.length && $popup.css('display') === 'none') {
                $('.hb-popup-step').hide();
                $('#hb-step-3').show();
                $popup.css({
                  'display': 'flex',
                  'visibility': 'visible',
                  'opacity': '1'
                });
                document.body.style.overflow = "hidden";
                console.log('OTP Popup shown via jQuery fallback');
              }
            });
          }
        }, 300);
      });

      // POD Gate - No button (close and continue)
      podGateNo.addEventListener("click", () => {
        podOverlay.classList.remove("active");
        document.body.style.overflow = "";
        if (window.location.hash === "#openJoinPOC") {
          setTimeout(() => {
            const pocBtn = document.getElementById("openJoinPOC");
            if (pocBtn) pocBtn.click();
          }, 200);
        }
      });

      // ============ DEVICE STATUS CHECK ============
      /**
       * Generate UUIDv4
       */
      function generateUUIDv4() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
          var r = Math.random() * 16 | 0;
          var v = c == 'x' ? r : (r & 0x3 | 0x8);
          return v.toString(16);
        });
      }

      /**
       * Get or create device ID from localStorage
       */
      function getOrCreateDeviceId() {
        let device_id = localStorage.getItem('hbc_device_id');
        if (!device_id) {
          device_id = generateUUIDv4();
          localStorage.setItem('hbc_device_id', device_id);
        }
        return device_id;
      }

      /**
       * Create device fingerprint
       */
      function createDeviceFingerprint() {
        let fingerprint = {
          screen: {
            width: screen.width || null,
            height: screen.height || null,
            colorDepth: screen.colorDepth || null
          },
          window: {
            devicePixelRatio: window.devicePixelRatio || null
          },
          navigator: {
            platform: navigator.platform || null,
            language: navigator.language || null,
            hardwareConcurrency: navigator.hardwareConcurrency || null,
            maxTouchPoints: navigator.maxTouchPoints || null
          },
          timezone: {
            timezone: Intl.DateTimeFormat ? Intl.DateTimeFormat().resolvedOptions().timeZone : null
          }
        };
        return fingerprint;
      }

      /**
       * Create device hash from fingerprint
       */
      function createDeviceHash(fingerprint) {
        let hashData = {
          screen: fingerprint.screen.width + 'x' + fingerprint.screen.height + 'x' + fingerprint.screen.colorDepth,
          timezone: fingerprint.timezone.timezone,
          language: fingerprint.navigator.language,
          hardware: fingerprint.navigator.hardwareConcurrency,
          touch: fingerprint.navigator.maxTouchPoints,
          platform: fingerprint.navigator.platform,
          pixelRatio: fingerprint.window.devicePixelRatio
        };
        let hashString = JSON.stringify(hashData);
        let hash = 0;
        for (let i = 0; i < hashString.length; i++) {
          let char = hashString.charCodeAt(i);
          hash = ((hash << 5) - hash) + char;
          hash = hash & hash;
        }
        return Math.abs(hash).toString(16);
      }

      /**
       * Get user account info
       */
      function getUserAccountInfo() {
        let userInfo = {
          loggedIn: false,
          userId: null,
          userName: null,
          userEmail: null
        };
        if (typeof hbcUserData !== 'undefined') {
          userInfo.loggedIn = true;
          userInfo.userId = hbcUserData.userId || null;
          userInfo.userName = hbcUserData.userName || null;
          userInfo.userEmail = hbcUserData.userEmail || null;
        }
        return userInfo;
      }

      /**
       * Show active status for all buttons
       */
      function showActiveStatus(status, deviceData) {
        const statusIds = ['nav', 'sidebar', 'hero', 'pod', 'faq'];
        const buttonIds = ['activate-device-nav', 'activate-device-sidebar', 'activate-device-hero', 'activate-device-pod', 'activate-device-faq'];
        
        let message = 'Your device is registered and ready to use';
        if (status === 'validated') {
          message = 'Your device is fully validated and ready for all features';
        } else if (status === 'activating') {
          message = 'Your device is activated and ready to use';
        }

        statusIds.forEach((id, index) => {
          const statusDiv = document.getElementById(`device-status-${id}`);
          const statusMessage = document.getElementById(`device-status-${id}-message`);
          const button = document.getElementById(buttonIds[index]);
          
          if (statusDiv && button) {
            statusDiv.classList.add('active');
            button.style.display = 'none';
            if (statusMessage) {
              statusMessage.textContent = message;
            }
          }
        });
      }

      /**
       * Show activate buttons
       */
      function showActivateButtons() {
        const statusIds = ['nav', 'sidebar', 'hero', 'pod', 'faq'];
        const buttonIds = ['activate-device-nav', 'activate-device-sidebar', 'activate-device-hero', 'activate-device-pod', 'activate-device-faq'];
        
        statusIds.forEach((id, index) => {
          const statusDiv = document.getElementById(`device-status-${id}`);
          const button = document.getElementById(buttonIds[index]);
          
          if (statusDiv && button) {
            statusDiv.classList.remove('active');
            button.style.display = '';
          }
        });
      }

      /**
       * Check if device is active
       */
      async function checkDeviceActive() {
        let device_id = localStorage.getItem('hbc_device_id');
        
        if (!device_id) {
          showActivateButtons();
          return false;
        }
        
        let fingerprint = createDeviceFingerprint();
        let device_hash = createDeviceHash(fingerprint);
        let userInfo = getUserAccountInfo();
        
        if (!device_id || !device_hash) {
          showActivateButtons();
          return false;
        }
        
        try {
          const response = await fetch('/wp-json/hb/v1/device/check-active', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              device_id: device_id,
              device_hash: device_hash,
              wp_user_id: userInfo.loggedIn ? userInfo.userId : null
            })
          });
          
          const data = await response.json();
          
          if (data.active) {
            showActiveStatus(data.status, data.device);
            return true;
          } else {
            showActivateButtons();
            return false;
          }
        } catch (error) {
          console.error('Error checking device status:', error);
          showActivateButtons();
          return false;
        }
      }

      // Sidebar toggle functionality
      function toggleSidebar(open) {
        const overlay = document.querySelector('.sidebar-overlay');
        const sidebar = document.querySelector('.sidebar-menu');
        const navToggle = document.getElementById('navtoggle');
        
        if (overlay && sidebar && navToggle) {
          if (open) {
            overlay.classList.add('active');
            sidebar.classList.add('active');
            document.body.classList.add('sidebar-open');
            navToggle.checked = true;
          } else {
            overlay.classList.remove('active');
            sidebar.classList.remove('active');
            document.body.classList.remove('sidebar-open');
            navToggle.checked = false;
          }
        }
      }
      
      // Check device status when page loads
      document.addEventListener('DOMContentLoaded', function() {
        checkDeviceActive();
        
        const navToggle = document.getElementById('navtoggle');
        const overlay = document.querySelector('.sidebar-overlay');
        const sidebar = document.querySelector('.sidebar-menu');
        
        // Toggle sidebar when checkbox changes
        if (navToggle) {
          navToggle.addEventListener('change', function() {
            toggleSidebar(this.checked);
          });
        }
        
        // Close sidebar when clicking overlay
        if (overlay) {
          overlay.addEventListener('click', function() {
            toggleSidebar(false);
          });
        }
        
        // Close sidebar when clicking a menu link
        const sidebarLinks = document.querySelectorAll('.sidebar-menu-links a');
        sidebarLinks.forEach(link => {
          link.addEventListener('click', function() {
            toggleSidebar(false);
          });
        });
        
        // Close sidebar when clicking PoD Mode button
        const podModeBtn = document.querySelector('.sidebar-buttons .btn');
        if (podModeBtn) {
          podModeBtn.addEventListener('click', function() {
            toggleSidebar(false);
          });
        }
        
        // Close sidebar when clicking activate device button
        const activateBtn = document.getElementById('activate-device-sidebar');
        if (activateBtn) {
          activateBtn.addEventListener('click', function() {
            toggleSidebar(false);
          });
        }
        
        // Close sidebar when resizing to desktop (sidebar is mobile/tablet only)
        window.addEventListener('resize', function() {
          if (window.innerWidth >= 901) {
            toggleSidebar(false);
          }
        });
      });

      // ============ JOIN POC MODAL ============
      (function(){
        const modal = document.getElementById('joinPOCModal');
        if (!modal) return;
        const closeEls = modal.querySelectorAll('[data-close-modal]');
        const form = document.getElementById('joinPOCForm');
        const demandScoreEl = document.getElementById('demandScore');
        const demandBar = document.getElementById('demandBar');
        const mirrorPreview = document.getElementById('mirrorPreview');

        let lastFocus = null;

        function openModal(){
          lastFocus = document.activeElement;
          modal.setAttribute('aria-hidden','false');
          const first = modal.querySelector('select, input, textarea, button');
          if(first) first.focus();
          document.addEventListener('keydown', onPOCKeydown);
        }

        function closeModal(){
          modal.setAttribute('aria-hidden','true');
          document.removeEventListener('keydown', onPOCKeydown);
          if(lastFocus) lastFocus.focus();
        }

        function onPOCKeydown(e){
          if(e.key === 'Escape') closeModal();
        }

        document.querySelectorAll('.open-join-poc-trigger').forEach(function(btn){ btn.addEventListener('click', openModal); });
        closeEls.forEach(el => el.addEventListener('click', closeModal));

        modal.addEventListener('click', (e)=>{
          if(e.target === modal) closeModal();
        });

        function computeScore(data){
          let score = 0;
          if(data.role_preference) score += 20;
          if(data.assignment_mode) score += 15;
          if(data.pledge_intent) score += 20;
          if(data.preferred_event_window) score += 10;
          if(data.region) score += 10;
          if(data.contact) score += 10;
          if(data.kalshi_mirror_consent === 'YES') score += 10;
          if(data.serendipity_ack === 'YES') score += 5;
          if(data.kalshi_mirror_consent === 'NO') score = Math.min(score, 40);
          if(data.serendipity_ack === 'NO') score = Math.min(score, 55);
          return Math.max(0, Math.min(100, score));
        }

        function readForm(){
          if(!form) return {};
          const fd = new FormData(form);
          return Object.fromEntries(fd.entries());
        }

        function updatePreview(){
          if(!demandScoreEl || !demandBar || !mirrorPreview || !form) return;
          const data = readForm();
          const score = computeScore(data);
          demandScoreEl.textContent = score + ' / 100';
          demandBar.style.width = score + '%';
          const payload = {
            event_type: "POC_ACCRUED_DEMAND",
            member_status: "NO_ACTIVE_POC",
            role_preference: data.role_preference || null,
            assignment_mode: data.assignment_mode || null,
            pledge_intent: data.pledge_intent || null,
            preferred_event_window: data.preferred_event_window || null,
            region: data.region || null,
            consents: {
              kalshi_mirror: data.kalshi_mirror_consent || null,
              serendipity_ack: data.serendipity_ack || null
            }
          };
          mirrorPreview.textContent = JSON.stringify(payload, null, 2);
        }

        if(form){
          form.addEventListener('input', updatePreview);
          form.addEventListener('change', updatePreview);
          form.addEventListener('submit', (e)=>{
            e.preventDefault();
            const data = readForm();
            const score = computeScore(data);
            if(data.serendipity_ack !== 'YES'){
              alert("To enter the POC assignment queue, please acknowledge serendipity placement (set to YES).");
              return;
            }
            if(data.kalshi_mirror_consent !== 'YES'){
              if(!confirm("You selected NO for Kalshi Mirror demand recording. Submit anyway (no demand signal will be recorded)?")) return;
            }
            console.log("Submit Demand Signal", { ...data, demand_score: score });
            alert("Demand signal submitted. You are now in the serendipity assignment queue (pending capacity).");
            closeModal();
            form.reset();
            updatePreview();
          });
        }
        updatePreview();
      })();
    </script>
  </footer>
  
  <?php
  // Include OTP Verification Popup directly in this template
  $popup_file = get_stylesheet_directory() . '/templates-parts/popup-otp-verification.php';
  if ( file_exists( $popup_file ) ) {
    include $popup_file;
  }
  ?>
</body>
</html>
