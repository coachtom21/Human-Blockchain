<?php
/**
 * Template Name: Festival Organizers (Meet the Organizers)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Meet the Organizers | <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
  <meta name="description" content="Meet the Organizers: a simple gateway page with brief summaries and clear CTAs linking out to Indivisible, No Kings, American Kitefliers Association, and Pocketbook Change." />

  <style>
    :root{
      --bg: #0b1220;
      --panel: rgba(255,255,255,0.06);
      --panel2: rgba(255,255,255,0.08);
      --text: rgba(255,255,255,0.92);
      --muted: rgba(255,255,255,0.72);
      --faint: rgba(255,255,255,0.55);
      --line: rgba(255,255,255,0.14);
      --shadow: 0 18px 60px rgba(0,0,0,0.45);
      --radius: 18px;

      --accent: #7dd3fc;     /* sky */
      --accent2: #a7f3d0;    /* mint */
      --accent3: #fca5a5;    /* soft red */
      --accent4: #fcd34d;    /* kite gold */
      --link: #93c5fd;
      --focus: 0 0 0 3px rgba(125,211,252,0.35);
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
      color: var(--text);
      background:
        radial-gradient(900px 600px at 15% 10%, rgba(125,211,252,0.20), transparent 60%),
        radial-gradient(800px 520px at 80% 30%, rgba(167,243,208,0.14), transparent 60%),
        radial-gradient(1000px 700px at 40% 85%, rgba(252,211,77,0.10), transparent 60%),
        linear-gradient(180deg, #060a12 0%, #0b1220 55%, #070a10 100%);
      line-height:1.5;
    }

    a{color:var(--link); text-decoration:none}
    a:hover{text-decoration:underline}
    .wrap{max-width:1100px; margin:0 auto; padding:28px 18px 64px}

    .topbar{
      display:flex; align-items:center; justify-content:space-between;
      gap:14px; margin-bottom:22px;
    }
    .brand{display:flex; align-items:center; gap:12px; text-decoration:none; color: var(--text)}
    .brand:hover{color: var(--text)}
    .mark{
      width:40px; height:40px; border-radius:12px;
      background:
        radial-gradient(12px 12px at 30% 30%, rgba(255,255,255,0.30), transparent 60%),
        linear-gradient(135deg, rgba(125,211,252,0.9), rgba(167,243,208,0.65));
      box-shadow: 0 10px 22px rgba(0,0,0,0.35);
      border:1px solid rgba(255,255,255,0.18);
    }
    .brand h1{
      font-size:14px; margin:0; letter-spacing:0.12em; text-transform:uppercase;
      color: rgba(255,255,255,0.80);
    }
    .brand small{
      display:block; margin-top:2px; font-size:12px; color:var(--faint);
      letter-spacing:0.02em; text-transform:none;
    }

    .nav{display:flex; gap:10px; flex-wrap:wrap; justify-content:flex-end}
    .nav a{
      font-size:13px; padding:8px 10px; border-radius:999px;
      background: rgba(255,255,255,0.06);
      border:1px solid rgba(255,255,255,0.10);
    }
    .nav a:focus{outline:none; box-shadow:var(--focus)}

    .hero{
      border:1px solid rgba(255,255,255,0.14);
      background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04));
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .hero-inner{padding:24px 20px 10px}

    .kicker{
      display:inline-flex; align-items:center; gap:10px;
      padding:7px 10px;
      border-radius:999px;
      background: rgba(125,211,252,0.12);
      border:1px solid rgba(125,211,252,0.22);
      color: rgba(255,255,255,0.84);
      font-size:13px;
      width: fit-content;
    }
    .kdot{
      width:8px; height:8px; border-radius:99px;
      background: var(--accent4);
      box-shadow: 0 0 0 4px rgba(252,211,77,0.14);
    }
    h2{
      margin:14px 0 10px;
      font-size: clamp(24px, 3vw, 38px);
      line-height:1.12;
      letter-spacing:-0.02em;
    }
    .lede{
      margin:0 0 14px;
      color: var(--muted);
      font-size: 16px;
      max-width: 75ch;
    }

    .gate{
      margin-top:14px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(0,0,0,0.22);
      border-radius: 18px;
      padding: 14px;
      display:flex; align-items:flex-start; justify-content:space-between; gap:12px;
      flex-wrap:wrap;
    }
    .gate strong{color: rgba(255,255,255,0.92)}
    .gate p{margin:4px 0 0; color: var(--muted); font-size:14px; max-width: 78ch}
    .btnrow{display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-left:auto}
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:11px 14px;
      border-radius: 12px;
      border:1px solid rgba(255,255,255,0.16);
      background: rgba(255,255,255,0.06);
      color: var(--text);
      font-size:14px;
      cursor:pointer;
      user-select:none;
      transition: transform .06s ease, background .2s ease, border-color .2s ease;
      text-decoration:none;
      white-space:nowrap;
    }
    .btn:hover{background: rgba(255,255,255,0.10)}
    .btn:active{transform: translateY(1px)}
    .btn:focus{outline:none; box-shadow: var(--focus)}
    .btn-primary{
      background: linear-gradient(135deg, rgba(125,211,252,0.92), rgba(167,243,208,0.78));
      border-color: rgba(255,255,255,0.22);
      color:#03101b;
      font-weight: 800;
    }
    .btn-primary:hover{
      background: linear-gradient(135deg, rgba(125,211,252,0.98), rgba(167,243,208,0.86));
    }

    .grid{
      margin-top: 16px;
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:14px;
      padding: 0 20px 20px;
    }
    @media (max-width: 900px){
      .grid{grid-template-columns: 1fr}
    }
    .card{
      border-radius: 18px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(255,255,255,0.06);
      box-shadow: 0 16px 40px rgba(0,0,0,0.30);
      padding: 16px 16px 14px;
      display:flex;
      flex-direction:column;
      gap:10px;
      min-height: 180px;
    }
    .card h3{margin:0; font-size:16px; letter-spacing:-0.01em}
    .card p{margin:0; color:var(--muted); font-size:14px}
    .strengths{
      margin:0;
      padding-left: 18px;
      color: var(--muted);
      font-size: 14px;
    }
    .strengths li{margin:8px 0}

    .card .ctas{
      margin-top:auto;
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      align-items:center;
    }
    .pill{
      font-size:12px;
      padding:6px 10px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(0,0,0,0.18);
      color: rgba(255,255,255,0.78);
    }

    .divider{
      height:1px;
      background: rgba(255,255,255,0.12);
      margin: 10px 0 0;
    }

    .footer{
      margin-top: 18px;
      padding: 14px 20px 18px;
      border-top: 1px solid rgba(255,255,255,0.14);
      color: var(--faint);
      font-size: 12px;
      display:flex; flex-wrap:wrap; gap:10px; justify-content:space-between;
    }

    /* Modal confirm gate */
    .modal-backdrop{
      position:fixed; inset:0;
      background: rgba(0,0,0,0.62);
      display:none;
      align-items:center;
      justify-content:center;
      padding: 18px;
      z-index: 9999;
    }
    .modal{
      width:min(760px, 100%);
      border-radius: 18px;
      border:1px solid rgba(255,255,255,0.14);
      background: linear-gradient(180deg, rgba(255,255,255,0.10), rgba(255,255,255,0.06));
      box-shadow: 0 22px 70px rgba(0,0,0,0.55);
      overflow:hidden;
    }
    .modal-header{
      padding: 14px 16px;
      display:flex; align-items:center; justify-content:space-between; gap:12px;
      border-bottom: 1px solid rgba(255,255,255,0.14);
      background: rgba(0,0,0,0.22);
    }
    .modal-header h3{
      margin:0;
      font-size:14px;
      letter-spacing:0.08em;
      text-transform:uppercase;
      color: rgba(255,255,255,0.80)
    }
    .xbtn{
      border:1px solid rgba(255,255,255,0.16);
      background: rgba(255,255,255,0.06);
      color: var(--text);
      border-radius: 12px;
      padding: 9px 10px;
      cursor:pointer;
    }
    .xbtn:focus{outline:none; box-shadow: var(--focus)}
    .modal-body{padding: 16px}
    .modal-body p{margin:0 0 12px; color: var(--muted); font-size:14px}
    .modal-actions{
      padding: 14px 16px;
      border-top: 1px solid rgba(255,255,255,0.14);
      display:flex; gap:10px; justify-content:flex-end; flex-wrap:wrap;
      background: rgba(0,0,0,0.18);
    }
    .checkbox{
      display:flex; gap:10px; align-items:flex-start;
      padding: 12px;
      border-radius: 14px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(0,0,0,0.22);
    }
    .checkbox input{margin-top:3px}
    .fineprint{
      margin-top: 10px;
      font-size: 12px;
      color: var(--faint);
      border-top: 1px dashed rgba(255,255,255,0.16);
      padding-top: 10px;
    }
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>

<body>
  <div class="wrap">
    <div class="topbar">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'mark', 'aria-hidden' => 'true' ) ); ?>
        <div>
          <h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
          <small>Meet the Organizers (Entry Gate)</small>
        </div>
      </a>

      <nav class="nav" aria-label="Primary">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <a href="<?php echo esc_url( home_url( '/kite-festival' ) ); ?>">Kite Festival</a>
        <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">How This Works</a>
        <a href="<?php echo esc_url( home_url( '/poc-guilds' ) ); ?>">Guilds</a>
      </nav>
    </div>

    <main class="hero" role="main">
      <div class="hero-inner">
        <div class="kicker"><span class="kdot" aria-hidden="true"></span> Affirmative response gateway</div>

        <h2>Meet the Organizers</h2>

        <p class="lede">
          You said <strong>YES</strong> to the "Meet the Organizers" prompt. This page is a simple gate for entry:
          a brief summary of each organizer's strengths, followed by a clear call-to-action that redirects you to their websites.
          <br /><br />
          This isn't about slogans. It's about <strong>presence</strong>, <strong>community</strong>, and <strong>pocketbook change</strong>—
          built through peaceful gatherings like kite festivals.
        </p>

        <section class="gate" aria-label="Entry gate actions">
          <div>
            <strong>One click to proceed:</strong>
            <p>
              Open the organizer gateway and choose where to engage first. Each CTA launches in a new tab so you can return here.
            </p>
          </div>
          <div class="btnrow">
            <button class="btn btn-primary" id="openGate">Open Organizer Gateway</button>
            <a class="btn" href="#organizers">View Summaries</a>
          </div>
        </section>
      </div>

      <div class="grid" id="organizers" aria-label="Organizer summaries">
        <!-- Indivisible -->
        <article class="card">
          <div>
            <h3>Indivisible</h3>
            <p>
              A nationwide civic network known for practical organizing toolkits and local group coordination—
              built for consistent participation, not one-time outrage.
            </p>
            <ul class="strengths">
              <li>Proven local group formation and shared playbooks</li>
              <li>Volunteer activation with repeatable community routines</li>
              <li>Long-horizon civic pressure that translates into results</li>
            </ul>
          </div>
          <div class="divider"></div>
          <div class="ctas">
            <span class="pill">Organize locally</span>
            <a class="btn" href="https://indivisible.org" target="_blank" rel="noopener noreferrer" data-org="Indivisible">
              Visit Indivisible →
            </a>
          </div>
        </article>

        <!-- No Kings -->
        <article class="card">
          <div>
            <h3>No Kings</h3>
            <p>
              A civic framing that rejects dominance politics and supports democratic norms through participation and accountability—
              coalition-friendly by design.
            </p>
            <ul class="strengths">
              <li>Clear anti-authoritarian message that's easy to share</li>
              <li>Coalition-friendly: supports broad participation</li>
              <li>Focuses on norms, legitimacy, and civic trust</li>
            </ul>
          </div>
          <div class="divider"></div>
          <div class="ctas">
            <span class="pill">Coalition energy</span>
            <a class="btn" href="https://nokings.org" target="_blank" rel="noopener noreferrer" data-org="NoKings">
              Visit No Kings →
            </a>
          </div>
        </article>

        <!-- AKA -->
        <article class="card">
          <div>
            <h3>American Kitefliers Association (AKA)</h3>
            <p>
              The kite community is a natural "peace demonstration" platform: family-friendly, visual, joyful,
              and built around skill, weather, and shared presence.
            </p>
            <ul class="strengths">
              <li>Established clubs, festivals, safety practices, and tradition</li>
              <li>Turns gathering into play—without slogans</li>
              <li>Perfect for annual "proof of presence" rituals</li>
            </ul>
          </div>
          <div class="divider"></div>
          <div class="ctas">
            <span class="pill">Festivals & clubs</span>
            <a class="btn" href="https://www.aka.kite.org" target="_blank" rel="noopener noreferrer" data-org="AKA">
              Visit AKA →
            </a>
          </div>
        </article>

        <!-- Pocketbook Change -->
        <article class="card">
          <div>
            <h3>Pocketbook Change</h3>
            <p>
              Economic engagement as civic power: shifting attention and spending behavior to create measurable outcomes—
              translating values into repeatable actions people can do every week.
            </p>
            <ul class="strengths">
              <li>Turns civic intent into consistent consumer choices</li>
              <li>Measurable behavior that can be repeated at scale</li>
              <li>Pairs naturally with "presence" and community rituals</li>
            </ul>
          </div>
          <div class="divider"></div>
          <div class="ctas">
            <span class="pill">Pocketbook power</span>
            <a class="btn" href="https://pocketbookchange.org" target="_blank" rel="noopener noreferrer" data-org="PocketbookChange">
              Visit Pocketbook Change →
            </a>
          </div>
        </article>
      </div>

      <div class="footer">
        <div>
          © <span id="year"></span> <?php echo esc_html( get_bloginfo( 'name' ) ); ?> • Meet the Organizers Gate
        </div>
        <div>
          <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy</a> • <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms</a> • <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a>
        </div>
      </div>
    </main>
  </div>

  <!-- Modal Gate -->
  <div class="modal-backdrop" id="modalBackdrop" aria-hidden="true">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div class="modal-header">
        <h3 id="modalTitle">Organizer Gateway</h3>
        <button class="xbtn" id="closeModal" aria-label="Close">✕</button>
      </div>

      <div class="modal-body">
        <p>
          Choose an organizer to visit. Each link opens in a new tab. When you return, you can continue your Human Blockchain journey.
        </p>

        <div class="checkbox">
          <input id="affirm" type="checkbox" />
          <label for="affirm" style="margin:0">
            I'm here to build <strong>presence</strong> and <strong>community power</strong>—not to chase outrage.
            I understand this page is a gateway and these are external websites.
          </label>
        </div>

        <div class="fineprint">
          Tip: In your implementation, you can record "affirmative entry" locally (or via WordPress/PHP) before redirecting.
          This is a consent-style gate, not a paywall.
        </div>
      </div>

      <div class="modal-actions">
        <button class="btn" id="cancelBtn">Cancel</button>

        <a class="btn" id="goIndivisible" href="https://indivisible.org" target="_blank" rel="noopener noreferrer">Go to Indivisible →</a>
        <a class="btn" id="goNoKings" href="https://nokings.org" target="_blank" rel="noopener noreferrer">Go to No Kings →</a>
        <a class="btn" id="goAKA" href="https://www.aka.kite.org" target="_blank" rel="noopener noreferrer">Go to AKA →</a>
        <a class="btn btn-primary" id="goPocketbook" href="https://pocketbookchange.org" target="_blank" rel="noopener noreferrer">Go to Pocketbook Change →</a>
      </div>
    </div>
  </div>

  <script>
    const $ = (id) => document.getElementById(id);

    const modalBackdrop = $("modalBackdrop");
    const openGate = $("openGate");
    const closeModal = $("closeModal");
    const cancelBtn = $("cancelBtn");
    const affirm = $("affirm");

    const gateLinks = ["goIndivisible","goNoKings","goAKA","goPocketbook"].map($);

    function openModal(){
      modalBackdrop.style.display = "flex";
      modalBackdrop.setAttribute("aria-hidden","false");
      affirm.checked = false;
      setGateState(false);
      setTimeout(() => affirm.focus(), 40);
    }

    function hideModal(){
      modalBackdrop.style.display = "none";
      modalBackdrop.setAttribute("aria-hidden","true");
      openGate.focus();
    }

    function setGateState(enabled){
      gateLinks.forEach(a => {
        a.style.pointerEvents = enabled ? "auto" : "none";
        a.style.opacity = enabled ? "1" : "0.45";
        a.setAttribute("aria-disabled", enabled ? "false" : "true");
      });
    }

    openGate.addEventListener("click", openModal);
    closeModal.addEventListener("click", hideModal);
    cancelBtn.addEventListener("click", hideModal);

    modalBackdrop.addEventListener("click", (e) => {
      if(e.target === modalBackdrop) hideModal();
    });

    document.addEventListener("keydown", (e) => {
      if(e.key === "Escape" && modalBackdrop.style.display === "flex") hideModal();
    });

    affirm.addEventListener("change", () => setGateState(affirm.checked));

    // Optional: capture CTA clicks for analytics / WordPress endpoint later
    document.querySelectorAll("a[data-org]").forEach(a => {
      a.addEventListener("click", () => {
        console.log("Organizer CTA clicked:", a.getAttribute("data-org"), new Date().toISOString());
      });
    });

    $("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
