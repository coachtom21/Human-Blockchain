<?php
/**
 * Template Name: Kite Festival
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kite Festival for Peace — God Wink Invitation | <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
  <style>
    :root{
      --bg:#0b1020;
      --panel:#111a33;
      --panel2:#0f1730;
      --text:#eaf0ff;
      --muted:rgba(234,240,255,.78);
      --muted2:rgba(234,240,255,.62);
      --line:rgba(234,240,255,.12);
      --accent:#7cf0ff;
      --accent2:#c7ff7c;
      --warn:#ffd37c;
      --shadow: 0 14px 45px rgba(0,0,0,.35);
      --radius:18px;
      --max:1100px;
      --font: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family:var(--font);
      color:var(--text);
      background:
        radial-gradient(1200px 600px at 20% 0%, rgba(124,240,255,.14), transparent 55%),
        radial-gradient(900px 520px at 85% 10%, rgba(199,255,124,.11), transparent 55%),
        radial-gradient(900px 650px at 50% 100%, rgba(255,211,124,.09), transparent 60%),
        linear-gradient(180deg, #070a14 0%, var(--bg) 55%, #070a14 100%);
      min-height:100vh;
    }
    a{color:inherit}
    .wrap{max-width:var(--max); margin:0 auto; padding:24px}
    header{
      display:flex; align-items:center; justify-content:space-between;
      gap:16px; padding:10px 0 18px;
      flex-wrap:wrap;
    }
    .brand{
      display:flex; align-items:center; gap:12px; text-decoration:none; color:var(--text);
    }
    .brand:hover{color:var(--text)}
    .mark{
      width:44px; height:44px; border-radius:14px;
      background:linear-gradient(135deg, rgba(124,240,255,.95), rgba(199,255,124,.85));
      box-shadow: var(--shadow);
      display:grid; place-items:center;
      color:#091026; font-weight:800;
    }
    .brand .title{font-weight:800; letter-spacing:.2px}
    .brand .sub{font-size:.9rem; color:var(--muted2); margin-top:2px}
    .top-actions{display:flex; gap:10px; flex-wrap:wrap; justify-content:flex-end}
    .btn{
      border:1px solid var(--line);
      background:rgba(255,255,255,.03);
      color:var(--text);
      padding:10px 14px;
      border-radius:14px;
      cursor:pointer;
      text-decoration:none;
      display:inline-flex; align-items:center; gap:10px;
      transition:transform .08s ease, border-color .15s ease, background .15s ease;
      user-select:none;
    }
    .btn:hover{transform:translateY(-1px); border-color:rgba(124,240,255,.35); background:rgba(124,240,255,.06)}
    .btn.primary{
      background:linear-gradient(135deg, rgba(124,240,255,.22), rgba(199,255,124,.14));
      border-color:rgba(124,240,255,.40);
    }
    .hero{
      border:1px solid var(--line);
      background:linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.02));
      border-radius:var(--radius);
      padding:26px;
      box-shadow: var(--shadow);
      overflow:hidden;
      position:relative;
    }
    .hero:before{
      content:"";
      position:absolute; inset:-1px;
      background:
        radial-gradient(800px 240px at 10% 0%, rgba(124,240,255,.16), transparent 60%),
        radial-gradient(600px 240px at 85% 0%, rgba(199,255,124,.13), transparent 60%);
      pointer-events:none;
      opacity:.9;
    }
    .hero > *{position:relative}
    .kicker{
      display:inline-flex; align-items:center; gap:10px;
      padding:8px 12px;
      border-radius:999px;
      background:rgba(124,240,255,.08);
      border:1px solid rgba(124,240,255,.22);
      color:var(--muted);
      font-size:.95rem;
      width:fit-content;
    }
    h1{margin:14px 0 8px; font-size:2.1rem; line-height:1.15}
    .lede{color:var(--muted); font-size:1.05rem; line-height:1.6; max-width:78ch}
    .grid{
      display:grid;
      grid-template-columns: 1.15fr .85fr;
      gap:18px;
      margin-top:18px;
    }
    @media (max-width: 920px){ .grid{grid-template-columns:1fr} }
    .card{
      border:1px solid var(--line);
      background:rgba(17,26,51,.55);
      border-radius:var(--radius);
      padding:18px;
    }
    .card h2{margin:0 0 8px; font-size:1.15rem}
    .card p{margin:0; color:var(--muted); line-height:1.65}
    .bullets{margin:10px 0 0; padding-left:18px; color:var(--muted)}
    .bullets li{margin:8px 0}
    .callout{
      margin-top:16px;
      border:1px solid rgba(255,211,124,.22);
      background:linear-gradient(180deg, rgba(255,211,124,.10), rgba(255,211,124,.04));
      border-radius:var(--radius);
      padding:16px;
    }
    .callout strong{color:#fff}
    .callout .note{color:var(--muted); line-height:1.6; margin-top:6px}
    .media{
      margin-top:18px;
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:18px;
    }
    @media (max-width: 920px){ .media{grid-template-columns:1fr} }
    .media .panel{
      border:1px solid var(--line);
      background:rgba(15,23,48,.7);
      border-radius:var(--radius);
      padding:16px;
      box-shadow: var(--shadow);
    }
    .panel h3{margin:0 0 10px; font-size:1.05rem}
    .panel .hint{margin:0 0 12px; color:var(--muted2); font-size:.95rem; line-height:1.5}
    audio, video{
      width:100%;
      border-radius:14px;
      outline:none;
      background:#0a0f1f;
      border:1px solid rgba(234,240,255,.10);
    }
    .section{
      margin-top:18px;
      border:1px solid var(--line);
      background:rgba(255,255,255,.03);
      border-radius:var(--radius);
      padding:18px;
    }
    .section h2{margin:0 0 10px}
    .pillrow{display:flex; gap:10px; flex-wrap:wrap; margin-top:10px}
    .pill{
      border:1px solid rgba(234,240,255,.12);
      background:rgba(255,255,255,.03);
      border-radius:999px;
      padding:8px 12px;
      color:var(--muted);
      font-weight:700;
      letter-spacing:.2px;
    }
    .divider{height:1px; background:var(--line); margin:16px 0}
    footer{
      margin:22px 0 8px;
      color:var(--muted2);
      font-size:.92rem;
      display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap;
    }
    .small{font-size:.92rem; color:var(--muted2); line-height:1.55}
    .anchor{scroll-margin-top:18px}
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>
<body>

<div class="wrap">
  <!-- Top Bar -->
  <header>
    <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <div class="mark" aria-hidden="true">&#129665;</div>
      <div>
        <div class="title">Kite Festival for Peace</div>
        <div class="sub">God Wink Invitation • "Let truth keep score."</div>
      </div>
    </a>
    <div class="top-actions">
      <a class="btn" href="#media">Podcast + Video</a>
      <a class="btn primary" href="#invitation">Read the Invitation</a>
    </div>
  </header>

  <!-- Hero -->
  <main class="hero">
    <div class="kicker">&#10024; God Wink Invitation • A game of presence, not outrage</div>
    <h1>Peace demonstration becomes a kite festival.</h1>
    <p class="lede">
      This is a deliberate shift away from high-conflict protest marches into a joyful, non-violent
      "game of presence." Kites rise where anger once stood. Children fly kites where tension once lived.
      The point isn't slogans—it's behavior, trust, and showing up.
    </p>
    <div class="grid">
      <section class="card">
        <h2>What changes (and why it matters)</h2>
        <p>
          The festival replaces tension with play, and replaces transaction with presence.
          Organizers are no longer here to extract donations. Citizens are asked to leave their wallet at home.
        </p>
        <ul class="bullets">
          <li><strong>Replacing tension with play:</strong> calm, unifying atmosphere.</li>
          <li><strong>Non-transactional space:</strong> no money changing hands—leadership that can't be bought.</li>
          <li><strong>Behavior over slogans:</strong> practice FAITH in your relationships, not speeches.</li>
          <li><strong>Rebuilding trust:</strong> honor human value patiently—don't exploit it in the moment.</li>
        </ul>
      </section>
      <aside class="card">
        <h2>The directive</h2>
        <p>
          Bring your family. Fly a kite for peace. Let truth keep score.
        </p>
        <div class="callout">
          <strong>Leave your wallet at home.</strong>
          <div class="note">
            This gathering is not a fundraiser. It's a demonstration that community presence is real,
            measurable, and powerful—without financial extraction or political outrage.
          </div>
        </div>
        <div class="divider"></div>
        <p class="small">
          The long-term aim is a steady "3%" core of consistent participants—people who show up calmly,
          year after year, and rebuild civic power through trust.
        </p>
      </aside>
    </div>

    <!-- Media Panels -->
    <section id="media" class="media anchor" aria-label="Podcast and Video">
      <div class="panel">
        <h3>Toppling Dictators With Nylon And String</h3>
        <p class="hint">
          Listen to the podcast on kite festivals for peace.
        </p>
        <audio controls preload="metadata">
          <source src="https://humanblockchain.info/wp-content/uploads/2026/02/Toppling_Dictators_With_Nylon_And_String.mp3" type="audio/mpeg" />
          Your browser does not support the audio element.
        </audio>
      </div>
      <div class="panel">
        <h3>The God Wink Proposal</h3>
        <p class="hint">
          Watch the God Wink proposal video.
        </p>
        <video controls preload="metadata">
          <source src="https://humanblockchain.info/wp-content/uploads/2026/02/The_God_Wink_Proposal.mp4" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      </div>
    </section>

    <!-- Invitation Content -->
    <section id="invitation" class="section anchor" aria-label="God Wink Invitation text">
      <h2>God Wink Invitation</h2>
      <p class="lede" style="margin-top:0">
        The God Wink proposal uses peaceful kite festivals to replace traditional, high-conflict protest marches.
        It aligns with grassroots values—non-violent community presence, not financial extraction, not political outrage.
      </p>
      <div class="divider"></div>
      <h3 style="margin:0 0 8px; font-size:1.05rem;">Peace demonstration becomes a kite festival</h3>
      <p class="small" style="margin:0 0 10px;">
        This transformation is a deliberate shift into a "game of presence":
      </p>
      <ul class="bullets">
        <li><strong>Replacing Tension with Play:</strong> children fly kites where tension once lived; kites rise where anger once stood.</li>
        <li><strong>A Non-Transactional Space:</strong> organizers are no longer to extract donations; citizens leave wallets at home; leadership can't be bought.</li>
        <li><strong>Behavior Over Slogans:</strong> practice FAITH in relationships instead of speeches or slogans.</li>
        <li><strong>Rebuilding Trust:</strong> honor human value patiently rather than exploiting it in the moment.</li>
      </ul>
      <div class="divider"></div>
      <h3 style="margin:0 0 8px; font-size:1.05rem;">FAITH behavior (what we practice here)</h3>
      <div class="pillrow" aria-label="FAITH behaviors">
        <span class="pill">Fair</span>
        <span class="pill">Accepting</span>
        <span class="pill">Insightful</span>
        <span class="pill">Transparent</span>
        <span class="pill">Humble</span>
      </div>
      <div class="callout" style="margin-top:16px;">
        <strong>Bring your family. Fly a kite for peace. Let truth keep score.</strong>
        <div class="note">
          The goal is long-term engagement—a calm, consistent core of participants who show up with presence, accountability, and trust.
        </div>
      </div>
    </section>

    <footer>
      <div>&#129665; Kite Festival for Peace • God Wink Invitation</div>
      <div class="small"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></div>
    </footer>
  </main>
</div>
</body>
</html>
