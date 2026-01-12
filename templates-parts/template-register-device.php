<?php
/**
 * Template: Register Device
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register This Device | HumanBlockchain.info</title>

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
    }
    .brand{
      display:flex; gap:10px; align-items:center;
      text-decoration:none; color:var(--text);
      min-width:0;
    }
    .logo{
      width:34px;height:34px;border-radius:12px;
      background:
        radial-gradient(circle at 30% 30%, rgba(52,211,153,.9), transparent 60%),
        radial-gradient(circle at 70% 70%, rgba(120,160,255,.9), transparent 60%),
        rgba(255,255,255,.06);
      border:1px solid var(--line);
      flex:0 0 auto;
    }
    .brand h1{margin:0;font-size:14px;letter-spacing:.4px}
    .brand small{display:block;font-size:12px;color:var(--muted)}

    .nav-links{display:flex;gap:10px;flex-wrap:wrap}
    .nav-links a{
      text-decoration:none;
      color:var(--muted);
      font-weight:800;
      font-size:12px;
      padding:10px 12px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.04);
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
      grid-template-columns: 1.05fr .95fr;
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
    ul{margin:0;padding-left:18px}
    li{margin:9px 0;font-size:16px;line-height:1.6}

    .steps{
      display:grid;
      gap:12px;
      margin-top:6px;
    }
    .step{
      display:flex;
      gap:12px;
      align-items:flex-start;
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

    /* CTA buttons */
    .cta{display:grid;gap:12px;align-content:start}
    .btn{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
      text-decoration:none;
      border-radius: var(--btnRadius);
      padding:16px 16px;
      font-weight:950;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.06);
      color: var(--text);
      cursor:pointer;
      font-size:16px;
    }
    .btnPrimary{
      background: linear-gradient(180deg,#34d399,#10b981);
      color:#052015;
      border-color: rgba(52,211,153,.35);
    }
    .btn .sub{
      display:block;
      font-size:13px;
      font-weight:800;
      opacity:.86;
      margin-top:4px;
      color: rgba(255,255,255,.86);
    }
    .btnPrimary .sub{color:#062015;opacity:.8}
    .arrow{font-weight:950}

    .fineprint{
      margin-top:14px;
      padding-top:12px;
      border-top:1px solid rgba(255,255,255,.14);
      font-size:13px;
      color:var(--muted);
      line-height:1.6;
    }
    .pillRow{
      display:flex;gap:8px;flex-wrap:wrap;margin-top:10px
    }
    .pill{
      display:inline-flex;align-items:center;gap:8px;
      padding:8px 10px;border-radius:999px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      color:var(--muted);
      font-weight:900;
      font-size:12px;
    }
    .pill .miniDot{
      width:8px;height:8px;border-radius:50%;
      background:rgba(255,255,255,.35);
    }
    .pill.good .miniDot{
      background:var(--accent);
      box-shadow:0 0 0 3px rgba(52,211,153,.18);
    }
  </style>
</head>

<body>
  <header class="nav">
    <div class="nav-inner">
      <a class="brand" href="home">
        <div class="logo" aria-hidden="true"></div>
        <div>
          <h1>HumanBlockchain.info</h1>
          <small>Register This Device</small>
        </div>
      </a>

      <nav class="nav-links" aria-label="Primary">
        <a href="how-it-works">How It Works</a>
        <a href="pod-mode">PoD Mode</a>
        <a href="loyalty-xp">Loyalty Points</a>
        <a href="faq">FAQs</a>
      </nav>
    </div>
  </header>

  <main class="wrap">
    <section class="card">
      <div class="card-inner">
        <div class="badge"><span class="dot" aria-hidden="true"></span> Simple • Safe • Loyalty accounting</div>

        <h2>Register This Device</h2>
        <p class="muted">
          This is the simple “check-in” step that lets your phone participate.
          Once registered, your device can help confirm deliveries and earn loyalty credit
          called <b>XP</b> and <b>New World Penny (NWP)</b>.
        </p>

        <div class="grid">
          <!-- LEFT: Plain-language explanation -->
          <div>
            <div class="panel">
              <h3>Two Scans: Start + Confirm</h3>
              <div class="steps">
                <div class="step">
                  <div class="num">1</div>
                  <div>
                    <b>Seller starts the delivery</b>
                    <div class="muted">
                      The seller begins by selecting “Seller,” pledging <b>$10.30</b>,
                      and creating a <b>Transaction ID</b>.
                      This sets the roles for the delivery.
                    </div>
                  </div>
                </div>

                <div class="step">
                  <div class="num">2</div>
                  <div>
                    <b>Buyer confirms receipt</b>
                    <div class="muted">
                      The buyer validates the same Transaction ID and accepts the delivery.
                      Acceptance is recorded with a timestamp and location.
                    </div>
                  </div>
                </div>
              </div>

              <div class="pillRow">
                <div class="pill good"><span class="miniDot"></span>Easy: scan + answer</div>
                <div class="pill"><span class="miniDot"></span>Recorded: time + location</div>
                <div class="pill"><span class="miniDot"></span>Loyalty accounting</div>
              </div>
            </div>

            <div class="panel">
              <h3>The key question everyone answers</h3>
              <p>
                During delivery, the system asks:
                <b>“Is this the final destination?”</b>
              </p>

              <div class="steps">
                <div class="step">
                  <div class="num">NO</div>
                  <div>
                    <b>Every handoff answers “No”</b>
                    <div class="muted">
                      Each time a package is handed from one person to another along the route,
                      the helper answers <b>No</b> to “final destination.”
                      That “No” confirms: <b>“I helped move this delivery forward.”</b>
                    </div>
                  </div>
                </div>

                <div class="step">
                  <div class="num">YES</div>
                  <div>
                    <b>Only the last stop answers “Yes”</b>
                    <div class="muted">
                      The delivery person at the true final destination answers <b>Yes</b>.
                      That “Yes” confirms: <b>“This delivery arrived where it was meant to arrive.”</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="callout">
              <b>New World Penny (NWP) for every helper</b>
              Every “<b>No</b>” handoff and the single “<b>Yes</b>” final destination response
              earns <b>one New World Penny (NWP)</b> as loyalty recognition.
              The NWP is <b>issued by the seller</b> to the Human Blockchain for delivery work.
              <br><br>
              <b>Example:</b> If <b>30</b> individuals helped the package reach the buyer, the seller issues
              <b>30 NWP</b>.
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Buyer’s $5 rebate in XP</b>
              After the final destination is confirmed, the buyer selects the <b>Buyer</b> role and accepts receipt.
              That buyer acceptance assigns a <b>$5 buyer rebate in XP</b> (loyalty accounting).
              <br><br>
              <span class="muted">
                NWP recognizes delivery helpers (every “No” plus the single “Yes”).
                The $5 XP rebate recognizes the buyer for completing the final acceptance.
              </span>
            </div>

            <div class="callout">
              <b>Cookie Jar Economy (launching May 17, 2030)</b>
              The seller pledge of <b>$10.30</b> supports the Cookie Jar Economy—a long-term community pool
              designed to reward verified cooperation over time.
              The system is scheduled to activate on <b>May 17, 2030</b>.
              <br><br>
              <span class="muted">
                Note: <b>$0.30</b> is allocated to Proof of Delivery service cost of goods sold (COGS).
              </span>
            </div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Custody clarification (simple)</b>
              The <b>d-DAO General Ledger is non-custodial</b> — it does not hold or move money.
              The <b>Voluntary Fulfillment Network (VFN)</b> is the <b>sole custodial network</b> for any fiat or MSB activity.
              <span class="muted">The ledger records verification and loyalty accounting only.</span>
            </div>
          </div>

          <!-- RIGHT: CTAs -->
          <aside class="cta">
            <a class="btn btnPrimary" href="device-register">
              <div>
                Register My Device
                <span class="sub">Quick check-in • start participating</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="pod-mode">
              <div>
                Enter PoD Mode
                <span class="sub">Start Scan 1 • Confirm delivery</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="loyalty-xp">
              <div>
                Understand Loyalty Points
                <span class="sub">XP + New World Penny explained</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="ten-pack-request">
              <div>
                Request 10-Pack (If Eligible)
                <span class="sub">Credential kit • pledge-gated</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <div class="fineprint">
              <b>Privacy note:</b> Registration is designed to use minimal information.
              The goal is simple: confirm real participation without turning your life into a profile.
            </div>
          </aside>
        </div>
      </div>
    </section>
  </main>
</body>
</html>


