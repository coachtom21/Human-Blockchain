<?php
/**
 * Template Name: Membership
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Membership • <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
  <style>
    :root{
      --bg:#0b0f14; --card:#101824; --ink:#e9eef6; --muted:#b7c4d6;
      --line:rgba(255,255,255,.10);
      --a:#7dd3fc; --b:#a78bfa; --ok:#86efac; --warn:#fde68a; --btn:#1f2a3a;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial;background:var(--bg);color:var(--ink)}
    a{color:var(--a);text-decoration:none}
    a:hover{text-decoration:underline}
    .wrap{max-width:1120px;margin:0 auto;padding:24px}
    header{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:16px;flex-wrap:wrap}
    .title{font-weight:900;font-size:16px}
    .sub{color:var(--muted);font-size:12px;line-height:1.4}
    .btn{
      border:1px solid var(--line);background:var(--btn);color:var(--ink);
      padding:10px 12px;border-radius:12px;cursor:pointer;font-weight:800;
      font-size:14px;display:inline-flex;align-items:center;justify-content:center;
      text-decoration:none;
    }
    .btn:hover{filter:brightness(1.1)}
    .btn.primary{background:linear-gradient(135deg, rgba(125,211,252,.25), rgba(167,139,250,.20))}
    .card{border:1px solid var(--line);border-radius:18px;padding:16px;background:rgba(255,255,255,.04);box-shadow:0 18px 45px rgba(0,0,0,.25)}
    .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
    @media (max-width:980px){.grid{grid-template-columns:1fr}}
    .price{display:inline-block;margin:6px 0 10px;padding:4px 10px;border-radius:999px;border:1px solid var(--line);color:var(--muted);font-size:12px}
    ul{margin:0;padding-left:18px;color:var(--muted);line-height:1.55}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px}
    @media (max-width:980px){.row{grid-template-columns:1fr}}
    .mini{padding:14px;border-radius:16px;border:1px solid var(--line);background:rgba(0,0,0,.18)}
    .mini h3{margin:0 0 6px;font-size:14px}
    .mini p{margin:0;color:var(--muted);font-size:13px;line-height:1.45}
    .foot{margin-top:14px;color:var(--muted);font-size:12px;line-height:1.55}
    .warn{color:var(--warn);font-weight:900}
    .badge{display:inline-flex;gap:8px;align-items:center;border:1px solid var(--line);border-radius:999px;padding:6px 10px;background:rgba(255,255,255,.03);color:var(--muted);font-size:12px}
    .ok{color:var(--ok);font-weight:900}
    label{display:block;font-size:12px;color:var(--muted);margin:10px 0 6px}
    select{width:100%;padding:11px 12px;border-radius:12px;border:1px solid var(--line);background:rgba(0,0,0,.20);color:var(--ink)}
    .actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:10px}
    .divider{height:1px;background:var(--line);margin:12px 0}
    code{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace}
    @media (max-width:520px){.wrap{padding:14px}.title{font-size:14px}.actions .btn,.cta .btn{width:100%;justify-content:center}}
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>
<body>
  <div class="wrap">
    <header>
      <div>
        <div class="title">Membership Choice (Buyer vs Seller)</div>
        <div class="sub">
          Buyers do <strong>not</strong> need a QRtiger v-card. Sellers do. Discord Gracebook acceptance is required for both.
          Serendipity assigns Peace Pentagon role + POC membership (Pending → Active).
        </div>
      </div>
      <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">← Home</a>
        <a class="btn" href="<?php echo esc_url( home_url( '/pod-mode' ) ); ?>">Scan Router</a>
        <button class="btn primary" type="button" id="confirmChoiceBtn">Confirm Choice</button>
      </div>
    </header>

    <div class="card">
      <div class="badge"><span class="ok">Step</span> 1) Register device → 2) Choose level → 3) Accept Discord invite → 4) Activate POCs</div>
      <div class="divider"></div>

      <div class="row">
        <div class="mini">
          <h3>Buyer: $5 XP reward logic</h3>
          <p>
            Buyers register device + MSB credentials. When a $30 pledge is verified as true, the buyer becomes eligible for the <strong>$5 XP reward</strong>.
          </p>
        </div>
        <div class="mini">
          <h3>Seller: NWP issuing + PoD capability</h3>
          <p>
            Sellers must have a QRtiger v-card and join a Seller POC. <strong>NWP issuing is strictly a feature of the Seller POC.</strong>
          </p>
        </div>
      </div>

      <div class="divider"></div>

      <div class="grid">
        <div class="card" style="box-shadow:none">
          <h2 style="margin:0 0 6px">Buyer (YAM'er)</h2>
          <div class="price">Free • Buyer-first path</div>
          <ul>
            <li>Requires device registration + MSB credentials</li>
            <li>Discord Gracebook acceptance required</li>
            <li>$30 pledge verified as true → eligible for $5 XP reward</li>
            <li>Assigned Peace Pentagon role + Buyer POC (Pending → Active)</li>
          </ul>
        </div>

        <div class="card" style="box-shadow:none">
          <h2 style="margin:0 0 6px">Seller / Sponsor (MEGAvoter)</h2>
          <div class="price">$12 annual pledge • Seller path</div>
          <ul>
            <li>Requires QRtiger v-card</li>
            <li>Individual-sponsored or group-sponsored</li>
            <li>Discord Gracebook acceptance required</li>
            <li>Assigned Peace Pentagon role + Seller POC (Pending → Active)</li>
            <li>Can issue NWP through Seller POC</li>
          </ul>
        </div>

        <div class="card" style="box-shadow:none">
          <h2 style="margin:0 0 6px">Patron / Stakeholder</h2>
          <div class="price">Honor / leaderboard award</div>
          <ul>
            <li>Recognition for reliability and participation</li>
            <li>Supports Detente 2030 build-out</li>
            <li>May unlock deeper organizer responsibilities</li>
          </ul>
        </div>
      </div>

      <div class="divider"></div>

      <label for="pick">Select your membership level</label>
      <select id="pick">
        <option value="Buyer">Buyer (YAM'er)</option>
        <option value="Seller">Seller / Sponsor (MEGAvoter)</option>
        <option value="Patron">Patron / Stakeholder (award)</option>
      </select>

      <div class="actions">
        <button class="btn primary" type="button" id="saveMembershipBtn">Save membership choice</button>
        <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>#register">Register device</a>
        <a class="btn" href="<?php echo esc_url( home_url( '/organizers' ) ); ?>">Organizer streamline</a>
      </div>

      <p class="foot">
        Referral XP opportunities (annual, for active members): <strong>$1</strong> YAM'er, <strong>$5</strong> MEGAvoter, <strong>$25</strong> Patron recognition.
        Bonuses post when referred members remain <strong>Active</strong>.
      </p>

      <p class="foot">
        <span class="warn">XP disclaimer:</span> XP is a non-cash, non-transferable accounting unit for verified participation events.
        XP is not money and has no guaranteed redemption value prior to governance milestones.
      </p>

      <p class="foot">
        Organizer note: <strong>MEGA Grants (up to 70%)</strong> may be available based on Kalshi Mirror reputation outcomes
        (delivery performance, utilization, recovery).
      </p>

      <p class="foot">
        Demo storage key: <code>hb_membership</code>.
      </p>
    </div>
  </div>

  <script>
    function confirmChoice(){
      var pick = document.getElementById('pick');
      var choice = pick ? pick.value : 'Buyer';
      var payload = { choice: choice, saved_at: new Date().toISOString() };
      try { localStorage.setItem('hb_membership', JSON.stringify(payload)); } catch (e) {}
      console.log('Saved hb_membership:', payload);
      alert('Saved (demo). Next: accept Discord Gracebook invite to activate Pending → Active.');
    }
    (function(){
      var btn = document.getElementById('confirmChoiceBtn');
      if (btn) btn.addEventListener('click', confirmChoice);
      var saveBtn = document.getElementById('saveMembershipBtn');
      if (saveBtn) saveBtn.addEventListener('click', confirmChoice);
    })();
  </script>
</body>
</html>
