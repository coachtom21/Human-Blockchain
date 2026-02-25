<?php
/**
 * Template Name: Festival Organizers (Teach Our Children)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Teach This to Our Children | <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
  <meta name="description" content="Teach this to our children: joy first, purpose first, presence first. A pledge-based economy that measures human value by participation." />

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
    .brand{
      display:flex; align-items:center; gap:12px;
      text-decoration:none; color: var(--text);
    }
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
    .nav{
      display:flex; gap:10px; flex-wrap:wrap; justify-content:flex-end;
    }
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
    .hero-inner{
      padding:26px 20px 22px;
      display:grid;
      grid-template-columns: 1.3fr 0.7fr;
      gap:18px;
    }
    @media (max-width: 860px){
      .hero-inner{grid-template-columns: 1fr}
    }
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
    .hero h2{
      margin:14px 0 10px;
      font-size: clamp(26px, 3.2vw, 40px);
      line-height:1.12;
      letter-spacing:-0.02em;
    }
    .hero p{
      margin:0 0 14px;
      color: var(--muted);
      font-size: 16px;
      max-width: 68ch;
    }
    .cta-row{
      display:flex; flex-wrap:wrap; gap:10px; align-items:center;
      margin-top: 14px;
    }
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
    }
    .btn:hover{background: rgba(255,255,255,0.10)}
    .btn:active{transform: translateY(1px)}
    .btn:focus{outline:none; box-shadow: var(--focus)}
    .btn-primary{
      background: linear-gradient(135deg, rgba(125,211,252,0.9), rgba(167,243,208,0.72));
      border-color: rgba(255,255,255,0.22);
      color:#03101b;
      font-weight: 700;
    }
    .btn-primary:hover{
      background: linear-gradient(135deg, rgba(125,211,252,0.95), rgba(167,243,208,0.80));
    }
    .btn-icon{
      width:18px; height:18px; display:inline-block;
    }

    .sidecard{
      border-left: 1px solid rgba(255,255,255,0.14);
      padding-left: 18px;
    }
    @media (max-width: 860px){
      .sidecard{border-left:none; padding-left:0; border-top:1px solid rgba(255,255,255,0.14); padding-top:16px}
    }
    .quote{
      margin:0;
      padding:16px 16px;
      border-radius: 16px;
      background: rgba(0,0,0,0.22);
      border:1px solid rgba(255,255,255,0.14);
    }
    .quote p{margin:0; color: rgba(255,255,255,0.86); font-size:15px}
    .quote footer{margin-top:10px; color: var(--faint); font-size:13px}
    .micro{
      margin-top:14px;
      padding:12px 14px;
      border-radius: 16px;
      border:1px solid rgba(255,255,255,0.12);
      background: rgba(255,255,255,0.05);
      color: var(--muted);
      font-size:13px;
    }
    .micro strong{color: rgba(255,255,255,0.88)}
    .section{
      margin-top: 18px;
      padding: 20px;
    }
    .grid{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:14px;
    }
    @media (max-width: 860px){
      .grid{grid-template-columns: 1fr}
    }
    .card{
      border-radius: 18px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(255,255,255,0.06);
      box-shadow: 0 16px 40px rgba(0,0,0,0.30);
      padding: 16px 16px 14px;
    }
    .card h3{
      margin:0 0 8px;
      font-size:16px;
      letter-spacing:-0.01em;
    }
    .card p{margin:0 0 10px; color:var(--muted); font-size:14px}
    .bullets{
      margin:10px 0 0;
      padding: 0 0 0 18px;
      color: var(--muted);
      font-size:14px;
    }
    .bullets li{margin:8px 0}
    .pillrow{display:flex; flex-wrap:wrap; gap:8px; margin-top:10px}
    .pill{
      font-size:12px;
      padding:6px 10px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(0,0,0,0.18);
      color: rgba(255,255,255,0.78);
    }

    .banner{
      margin-top: 16px;
      border-radius: 18px;
      border:1px solid rgba(255,255,255,0.14);
      background:
        radial-gradient(1000px 220px at 10% 20%, rgba(252,211,77,0.12), transparent 55%),
        radial-gradient(900px 240px at 80% 40%, rgba(125,211,252,0.12), transparent 55%),
        rgba(255,255,255,0.05);
      padding: 16px;
      box-shadow: 0 16px 44px rgba(0,0,0,0.30);
    }
    .banner h3{margin:0 0 6px}
    .banner p{margin:0; color:var(--muted); font-size:14px}

    .video-grid{
      margin-top: 14px;
      display:grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap:14px;
    }
    @media (max-width: 860px){
      .video-grid{grid-template-columns: 1fr}
    }
    .player{
      border-radius: 18px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(0,0,0,0.30);
      min-height: 260px;
      display:flex;
      align-items:center;
      justify-content:center;
      position:relative;
    }
    .player .placeholder{
      text-align:center;
      padding: 26px 18px;
      max-width: 56ch;
    }
    .player .placeholder strong{color: rgba(255,255,255,0.92)}
    .thumbs{
      border-radius: 18px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(255,255,255,0.06);
      padding: 14px;
    }
    .thumbs h4{margin:0 0 10px; font-size:14px; color: rgba(255,255,255,0.86)}
    .thumbgrid{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:10px;
    }
    .thumb{
      border-radius: 14px;
      border:1px solid rgba(255,255,255,0.12);
      background: rgba(0,0,0,0.22);
      padding: 10px;
      min-height: 78px;
      display:flex;
      flex-direction:column;
      justify-content:space-between;
    }
    .thumb span{font-size:12px; color: rgba(255,255,255,0.78)}
    .thumb small{font-size:11px; color: var(--faint)}
    .thumb:hover{border-color: rgba(255,255,255,0.20); background: rgba(0,0,0,0.28)}
    .thumb:focus{outline:none; box-shadow: var(--focus)}

    .nft{
      margin-top: 14px;
      border-radius: 18px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(255,255,255,0.06);
      padding: 14px;
    }
    .nft h4{margin:0 0 10px; font-size:14px; color: rgba(255,255,255,0.86)}
    .nftgrid{
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap:10px;
    }
    @media (max-width: 860px){
      .nftgrid{grid-template-columns: 1fr}
    }
    .nftitem{
      border-radius: 16px;
      border:1px solid rgba(255,255,255,0.12);
      background: rgba(0,0,0,0.20);
      padding: 12px;
    }
    .nftitem strong{display:block; margin-bottom:6px; font-size:13px}
    .nftitem p{margin:0; color: var(--muted); font-size:12px}
    .footer{
      margin-top: 26px;
      padding-top: 16px;
      border-top: 1px solid rgba(255,255,255,0.14);
      color: var(--faint);
      font-size: 12px;
      display:flex; flex-wrap:wrap; gap:10px; justify-content:space-between;
    }

    /* Modal */
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
      width:min(720px, 100%);
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
    .modal-header h3{margin:0; font-size:14px; letter-spacing:0.08em; text-transform:uppercase; color: rgba(255,255,255,0.80)}
    .modal-body{padding: 16px}
    .modal-body p{margin:0 0 12px; color: var(--muted); font-size:14px}
    .modal-actions{
      padding: 14px 16px;
      border-top: 1px solid rgba(255,255,255,0.14);
      display:flex; gap:10px; justify-content:flex-end; flex-wrap:wrap;
      background: rgba(0,0,0,0.18);
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
    .formgrid{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:10px;
      margin-top: 12px;
    }
    @media (max-width: 720px){
      .formgrid{grid-template-columns: 1fr}
    }
    label{display:block; font-size:12px; color: rgba(255,255,255,0.78); margin: 0 0 6px}
    input, select, textarea{
      width:100%;
      padding: 11px 12px;
      border-radius: 12px;
      border:1px solid rgba(255,255,255,0.14);
      background: rgba(0,0,0,0.28);
      color: var(--text);
      font-size: 14px;
    }
    textarea{min-height: 90px; resize: vertical}
    input:focus, select:focus, textarea:focus{outline:none; box-shadow: var(--focus)}
    .fineprint{
      margin-top: 10px;
      font-size: 12px;
      color: var(--faint);
      border-top: 1px dashed rgba(255,255,255,0.16);
      padding-top: 10px;
    }
    .math{
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      font-size: 12px;
      color: rgba(255,255,255,0.80);
      background: rgba(0,0,0,0.25);
      border:1px solid rgba(255,255,255,0.12);
      padding: 10px 12px;
      border-radius: 14px;
      overflow:auto;
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
          <small>Teach This to Our Children</small>
        </div>
      </a>

      <nav class="nav" aria-label="Primary">
        <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">What Is This?</a>
        <a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">How This Works</a>
        <a href="<?php echo esc_url( home_url( '/kite-festival' ) ); ?>">Kite Festival</a>
        <a href="<?php echo esc_url( home_url( '/poc-guilds' ) ); ?>">Guilds</a>
      </nav>
    </div>

    <header class="hero" role="banner">
      <div class="hero-inner">
        <div>
          <div class="kicker"><span class="kdot" aria-hidden="true"></span> A lesson worth passing down</div>

          <h2>Teach this to our children: <br/>Joy comes first.</h2>

          <p>
            It can feel like an insult to offer money for something you'd do for free—because the joy is the point.
            This is the lesson we should pass down: <strong>purpose first, presence first, contribution first.</strong>
            Money can be a tool later. But it must never be the condition.
          </p>

          <div class="cta-row">
            <button class="btn btn-primary" id="openPledge">
              <span class="btn-icon" aria-hidden="true">🪁</span> Make a Pledge of Presence
            </button>
            <a class="btn" href="#the-lesson">
              <span class="btn-icon" aria-hidden="true">📌</span> Read the Lesson
            </a>
            <a class="btn" href="#video">
              <span class="btn-icon" aria-hidden="true">🎥</span> Watch / Listen
            </a>
          </div>
        </div>

        <aside class="sidecard" aria-label="Coach Tom note">
          <blockquote class="quote">
            <p>
              "When we teach kids to chase meaning before money, we teach them how to build trust.
              And when trust grows, the whole system needs less force."
            </p>
            <footer>— Coach Tom, Legacy to Live By</footer>
          </blockquote>

          <div class="micro">
            <strong>Human value</strong> is not a paycheck.
            It's a record of participation—proof that you showed up, helped someone, and made the world better by being present.
          </div>
        </aside>
      </div>

      <div class="section" id="the-lesson">
        <div class="grid">
          <div class="card">
            <h3>1) The lesson in one sentence</h3>
            <p>
              Teach children to ask <strong>"Where am I needed?"</strong> before they ask <strong>"What do I get?"</strong>
            </p>
            <ul class="bullets">
              <li>Joy is the signal that you're aligned with purpose.</li>
              <li>Purpose is the engine that creates trust.</li>
              <li>Trust is the foundation that makes everything work.</li>
            </ul>
            <div class="pillrow">
              <span class="pill">Joy → Purpose</span>
              <span class="pill">Purpose → Trust</span>
              <span class="pill">Trust → Freedom</span>
            </div>
          </div>

          <div class="card">
            <h3>2) The world reverses the order</h3>
            <p>
              The danger is when we teach kids the opposite:
              <strong>money first</strong>, then joy (maybe), then meaning (if you have time).
            </p>
            <ul class="bullets">
              <li>When joy disappears, people stop showing up.</li>
              <li>When people stop showing up, trust breaks.</li>
              <li>When trust breaks, systems require enforcement.</li>
              <li>When enforcement grows, freedom shrinks.</li>
            </ul>
            <div class="pillrow">
              <span class="pill">Money-first drains joy</span>
              <span class="pill">Trust breaks</span>
              <span class="pill">Force replaces faith</span>
            </div>
          </div>

          <div class="card">
            <h3>3) Presence is the original economy</h3>
            <p>
              Before contracts and currency, humans built life through participation.
              That's what we're restoring—measuring value by presence and contribution.
            </p>
            <ul class="bullets">
              <li>A child helps because they belong.</li>
              <li>A neighbor shows up because it matters.</li>
              <li>A community grows because people participate.</li>
            </ul>
            <div class="pillrow">
              <span class="pill">Belonging</span>
              <span class="pill">Participation</span>
              <span class="pill">Legacy</span>
            </div>
          </div>

          <div class="card">
            <h3>4) How Human Blockchain makes it measurable</h3>
            <p>
              We don't measure your worth. We measure your <strong>participation</strong>—a simple, device-driven record of
              presence that proves you showed up.
            </p>
            <div class="math" aria-label="XP math">
XP (Presence Unit) = a sextillionth-of-a-penny measure
1 NWP (1 penny) = 4.76190476 × 10^18 XP
1 USD (100 pennies) = 4.76190476 × 10^20 XP

YAM redemption peg (extinguishment):
21,000 YAM = 1 USD

Principle:
Pledge first → Proof second → Settlement last
            </div>
            <div class="pillrow">
              <span class="pill">Device = personal proof</span>
              <span class="pill">QR = universal entry</span>
              <span class="pill">Ledger = transparency</span>
            </div>
          </div>
        </div>

        <div class="banner" id="video">
          <h3>Watch / Listen (placeholders)</h3>
          <p>
            This page is designed to host a primary video + a podcast embed, plus a thumbnail gallery to guide families,
            guilds, and organizers into the "joy-first" pledge economy.
          </p>

          <div class="video-grid">
            <div class="player" role="group" aria-label="Primary video player placeholder">
              <div class="placeholder">
                <strong>Primary Video Placeholder</strong><br/>
                Drop in your YouTube/Vimeo embed here (or self-hosted player).
                <div style="margin-top:12px; color: rgba(255,255,255,0.70); font-size:13px;">
                  Suggested title: "Teach This to Our Children — Joy First, Purpose First"
                </div>
              </div>
            </div>

            <div class="thumbs" aria-label="Video thumbnail gallery">
              <h4>Video Thumbnail Gallery</h4>
              <div class="thumbgrid">
                <button class="thumb" type="button">
                  <span>Joy before money</span>
                  <small>2:15</small>
                </button>
                <button class="thumb" type="button">
                  <span>Why trust matters</span>
                  <small>3:40</small>
                </button>
                <button class="thumb" type="button">
                  <span>Kite festival = presence</span>
                  <small>4:05</small>
                </button>
                <button class="thumb" type="button">
                  <span>Pledge → Proof → Settlement</span>
                  <small>3:10</small>
                </button>
              </div>

              <div style="margin-top:12px" class="player" aria-label="Podcast player placeholder">
                <div class="placeholder">
                  <strong>Podcast Placeholder</strong><br/>
                  Drop in Spotify/Apple/Anchor embed here.
                </div>
              </div>
            </div>
          </div>

          <div class="nft" aria-label="NFT shopping gallery placeholder">
            <h4>NFT / Pledge Shopping Gallery (placeholders)</h4>
            <div class="nftgrid">
              <div class="nftitem">
                <strong>YAM Welcome Package</strong>
                <p>Framed art, NFT delivery, or both — pledge-based.</p>
              </div>
              <div class="nftitem">
                <strong>Founders Constitution</strong>
                <p>3-page framed edition + NFT delivery option.</p>
              </div>
              <div class="nftitem">
                <strong>MEGAvoter Kit</strong>
                <p>Hat + t-shirt pledge kit (optional gallery tile).</p>
              </div>
            </div>
          </div>
        </div>

        <div class="banner" style="margin-top:14px">
          <h3>Teach it by doing it</h3>
          <p>
            Want a child to understand? Don't lecture—invite them into a game of presence.
            Fly a kite. Help someone. Show up once a year. Log participation with a simple scan.
            That's how trust becomes real.
          </p>
        </div>

        <div class="footer">
          <div>
            © <span id="year"></span> <?php echo esc_html( get_bloginfo( 'name' ) ); ?> • "Legacy to Live By" • Coach Tom
          </div>
          <div>
            <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy</a> • <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms</a> • <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a>
          </div>
        </div>
      </div>
    </header>
  </div>

  <!-- Modal: Pledge of Presence -->
  <div class="modal-backdrop" id="modalBackdrop" aria-hidden="true">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div class="modal-header">
        <h3 id="modalTitle">Pledge of Presence</h3>
        <button class="xbtn" id="closeModal" aria-label="Close">✕</button>
      </div>

      <div class="modal-body">
        <p>
          This is not a checkout. This is a <strong>commitment</strong>—a promise to teach children that joy, purpose,
          and participation come first.
        </p>

        <div class="formgrid">
          <div>
            <label for="name">Name (or family name)</label>
            <input id="name" type="text" placeholder="e.g., The Johnson Family" />
          </div>
          <div>
            <label for="city">City / Region</label>
            <input id="city" type="text" placeholder="e.g., Atlanta, GA" />
          </div>
          <div>
            <label for="role">I'm showing up as…</label>
            <select id="role">
              <option value="family">Family / Parent</option>
              <option value="mentor">Mentor / Coach</option>
              <option value="teacher">Teacher / School</option>
              <option value="organizer">Organizer / Guild Lead</option>
              <option value="curious">Curious Observer</option>
            </select>
          </div>
          <div>
            <label for="event">Next place I'll show up</label>
            <input id="event" type="text" placeholder="e.g., Kite Festival / Community Day" />
          </div>
        </div>

        <div style="margin-top:10px">
          <label for="promise">My promise (one sentence)</label>
          <textarea id="promise" placeholder="Example: I will teach my kids that helping others and showing up matters more than money."></textarea>
        </div>

        <div class="fineprint">
          <strong>Note:</strong> In the Human Blockchain framework, pledges are the starting point.
          Proof-of-delivery and settlement happen later through the standard 2-scan routine.
          This page is the cultural foundation: teach the lesson first.
        </div>
      </div>

      <div class="modal-actions">
        <button class="btn" id="cancelBtn">Cancel</button>
        <button class="btn btn-primary" id="submitBtn">Submit Pledge</button>
      </div>
    </div>
  </div>

  <script>
    // Tiny helpers (no dependencies)
    const $ = (id) => document.getElementById(id);

    const modalBackdrop = $("modalBackdrop");
    const openPledge = $("openPledge");
    const closeModal = $("closeModal");
    const cancelBtn = $("cancelBtn");
    const submitBtn = $("submitBtn");

    function openModal(){
      modalBackdrop.style.display = "flex";
      modalBackdrop.setAttribute("aria-hidden","false");
      setTimeout(() => $("name").focus(), 50);
    }
    function hideModal(){
      modalBackdrop.style.display = "none";
      modalBackdrop.setAttribute("aria-hidden","true");
      openPledge.focus();
    }

    openPledge.addEventListener("click", openModal);
    closeModal.addEventListener("click", hideModal);
    cancelBtn.addEventListener("click", hideModal);

    modalBackdrop.addEventListener("click", (e) => {
      if(e.target === modalBackdrop) hideModal();
    });

    document.addEventListener("keydown", (e) => {
      if(e.key === "Escape" && modalBackdrop.style.display === "flex") hideModal();
    });

    submitBtn.addEventListener("click", () => {
      const payload = {
        name: $("name").value.trim(),
        city: $("city").value.trim(),
        role: $("role").value,
        event: $("event").value.trim(),
        promise: $("promise").value.trim(),
        submitted_at: new Date().toISOString()
      };

      // Replace this with your real endpoint (WordPress REST, PHP handler, etc.)
      // Example:
      // fetch("/api/pledge", { method:"POST", headers:{ "Content-Type":"application/json" }, body: JSON.stringify(payload) })
      //   .then(r => r.json()).then(() => { ... });

      console.log("Pledge submitted:", payload);
      alert("Pledge received. Thank you for teaching the joy-first lesson.");
      hideModal();

      // Optional: clear fields
      ["name","city","event","promise"].forEach(id => $(id).value = "");
      $("role").value = "family";
    });

    // Footer year
    $("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
