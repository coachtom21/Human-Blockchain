<?php

/**
 * Template Name: FAQ
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FAQs | HumanBlockchain.info</title>

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
      --danger:#fb7185;
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
    }
    .brand{
      display:flex; gap:10px; align-items:center;
      text-decoration:none; color:var(--text);
      min-width:260px;
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
    .callout.danger{
      border-color: rgba(251,113,133,.35);
      background: rgba(251,113,133,.08);
    }
    .warnDot{
      display:inline-block;
      width:10px;height:10px;border-radius:50%;
      background: var(--warn);
      box-shadow:0 0 0 3px rgba(251,191,36,.16);
      margin-right:10px;
      vertical-align:middle;
    }

    /* Allocation chips */
    .alloc{
      margin-top:10px;
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:10px;
    }
    @media(max-width:720px){ .alloc{grid-template-columns:1fr} }
    .chip{
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      border-radius:16px;
      padding:12px;
    }
    .chip .top{
      display:flex;justify-content:space-between;align-items:baseline;gap:12px;
      font-weight:950;
    }
    .chip .amt{
      font-size:18px;
    }
    .chip .desc{
      margin-top:6px;
      color:var(--muted);
      font-size:13px;
      line-height:1.5;
    }
    .suballoc{
      margin-top:10px;
      padding-top:10px;
      border-top:1px solid rgba(255,255,255,.12);
      display:grid;
      gap:8px;
      color:var(--muted);
      font-size:13px;
      line-height:1.5;
    }
    .row{
      display:flex;justify-content:space-between;gap:12px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.03);
      padding:10px 12px;
      border-radius:14px;
      color: rgba(238,242,255,.92);
    }
    .row span{color:var(--muted)}
    .row b{color:var(--text)}

    /* FAQ accordion (native) */
    details{
      border:1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.04);
      border-radius:16px;
      padding:12px 14px;
      margin:10px 0;
    }
    summary{
      cursor:pointer;
      font-weight:950;
      font-size:16px;
      list-style:none;
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:10px;
    }
    summary::-webkit-details-marker{display:none}
    summary .chev{
      width:28px;height:28px;border-radius:10px;
      display:flex;align-items:center;justify-content:center;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.18);
      color: var(--muted);
      flex:0 0 auto;
      font-weight:950;
    }
    details[open] summary .chev{transform: rotate(90deg)}
    .answer{
      margin-top:10px;
      color: rgba(238,242,255,.92);
      font-size:15px;
      line-height:1.65;
    }
    .answer .muted{color:var(--muted)}
    .answer ul{margin:10px 0 0;padding-left:18px}
    .answer li{margin:8px 0}

    /* Right rail */
    .cta{display:grid;gap:12px;align-content:start}
    .btn{
      display:flex;justify-content:space-between;align-items:center;gap:12px;
      text-decoration:none;border-radius: 14px;
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
  </style>
</head>

<body>
  <header class="nav">
    <div class="nav-inner">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
        <div>
          <h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
          <small>Frequently Asked Questions</small>
        </div>
      </a>

      <nav class="nav-links" aria-label="Primary">
        <a href="how-it-works">How It Works</a>
        <a href="register-device">Register Device</a>
        <a href="pod-mode">PoD Mode</a>
        <a href="loyalty-xp">Loyalty Points</a>
      </nav>
    </div>
  </header>

  <main class="wrap">
    <section class="card">
      <div class="card-inner">

        <div class="badge"><span class="dot" aria-hidden="true"></span> One universal QR • VFN monthly reconciliation • patronage split clarified</div>

        <h2>FAQs</h2>
        <p class="muted">
          Plain-language answers for everyday people. If you still have a question,
          the fastest help is in PoD Help or in Discord after you accept your invite.
        </p>

        <div class="grid">
          <!-- LEFT -->
          <div>

            <div class="callout warn">
              <span class="warnDot" aria-hidden="true"></span><b>Seller pledge allocation (simple)</b>
              When the seller initiates Scan 1 and pledges <b>$10.30</b>, it is allocated as:
              <div class="alloc" aria-label="Pledge allocation">
                <div class="chip">
                  <div class="top"><span>$5</span><span class="amt">Buyer Rebate</span></div>
                  <div class="desc">Recorded in XP when the buyer confirms receipt (Scan 2).</div>
                </div>

                <div class="chip">
                  <div class="top"><span>$4</span><span class="amt">Social Impact Resource</span></div>
                  <div class="desc">A community resource allocation (recorded as XP accounting).</div>
                </div>

                <div class="chip">
                  <div class="top"><span>$1</span><span class="amt">Patronage (split)</span></div>
                  <div class="desc">
                    Patronage is recorded in XP and split into three parts:
                    <div class="suballoc" aria-label="Patronage split">
                      <div class="row"><b>$0.50</b><span>Individual seller pledge return</span></div>
                      <div class="row"><b>$0.40</b><span>Rotating 5-seller group bonus pool</span></div>
                      <div class="row"><b>$0.10</b><span>Treasury reserve</span></div>
                    </div>
                  </div>
                </div>

                <div class="chip">
                  <div class="top"><span>$0.30</span><span class="amt">PoD Service COGS</span></div>
                  <div class="desc">Cost of goods sold for Proof of Delivery service (recorded as part of reconciliation).</div>
                </div>
              </div>
              <p class="muted" style="margin:10px 0 0">
                This page explains the allocation model and the accounting record. It is not a bank screen.
              </p>
            </div>

            <div class="panel">
              <h3>Most common questions</h3>

              <details open>
                <summary>
                  Is there really only one QR code for everyone?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  Yes. There is <b>one universal QR code</b> used to start the process.
                  Everyone scans the <b>same QR</b> to begin Proof of Delivery.
                  <ul>
                    <li>The universal QR opens PoD Mode and starts the “two-scan” flow.</li>
                    <li>Your role (seller, helper, buyer) is selected inside the flow—<b>not</b> by a different QR.</li>
                    <li>This keeps PoD simple: <b>one code, one process, clear choices</b>.</li>
                  </ul>
                </div>
              </details>

              <details>
                <summary>
                  What is the Voluntary Fulfillment Network (VFN)?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  The <b>Voluntary Fulfillment Network (VFN)</b> is the real-world network of <b>buyers and sellers</b>
                  delivering goods and services using the <b>same two-scan method</b> as an accounting record.
                  <ul>
                    <li><b>Sellers</b> initiate delivery records and pledge the $10.30.</li>
                    <li><b>Buyers</b> complete the record by confirming receipt.</li>
                    <li>Both roles are part of “fulfillment” because both complete a required step of the verified delivery record.</li>
                  </ul>
                </div>
              </details>

              <details>
                <summary>
                  Who does monthly reconciliation and what does that mean?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  The <b>VFN</b> is responsible for <b>monthly reconciliation</b> to the <b>append-only general ledger</b>.
                  In plain language:
                  <ul>
                    <li>All verified PoD records are gathered for the month.</li>
                    <li>Receipts (what was confirmed) and obligations (what was pledged) are summarized.</li>
                    <li>The summary is written to the ledger in a way that cannot be quietly edited later.</li>
                  </ul>
                  <span class="muted">Append-only means: records can be added, but not changed after the fact.</span>
                </div>
              </details>

              <details>
                <summary>
                  Is this money? Can I cash out XP or New World Pennies?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  No. <b>XP</b> and <b>New World Penny (NWP)</b> are <b>loyalty accounting</b>—a record that you helped.
                  They are used for <b>general ledger purposes only</b>.
                  <div class="callout warn" style="margin-top:12px">
                    <span class="warnDot" aria-hidden="true"></span><b>YAM JAM clarification</b>
                    YAM JAM means <b>You And Me, Just Alternative Money</b>.
                    Here, “alternative money” means an <b>alternative measuring stick</b> for human value—not cash.
                  </div>
                </div>
              </details>

              <details>
                <summary>
                  What is Proof of Delivery (PoD) in plain language?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  Proof of Delivery is two scans that confirm a real delivery happened:
                  <ul>
                    <li><b>Scan 1 (Seller):</b> Seller starts the delivery, pledges <b>$10.30</b>, and creates the <b>Transaction ID</b>.</li>
                    <li><b>Scan 2 (Buyer):</b> Buyer validates the Transaction ID and accepts receipt.</li>
                  </ul>
                  Both scans are recorded with time and location to prevent confusion.
                </div>
              </details>

              <details>
                <summary>
                  How does the $1 patronage work (and why split it)?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  Patronage is recorded in XP accounting and split to support both individuals and group fairness:
                  <ul>
                    <li><b>$0.50</b> goes to the <b>individual seller</b> as a pledge return.</li>
                    <li><b>$0.40</b> goes into a <b>rotating 5-seller group bonus pool</b> (so each seller gets a turn).</li>
                    <li><b>$0.10</b> remains as a <b>treasury reserve</b> for stability and reconciliation.</li>
                  </ul>
                </div>
              </details>

              <details>
                <summary>
                  Why does it ask “Is this the final destination?”
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  Because deliveries often include handoffs. The system needs to know:
                  <ul>
                    <li><b>No</b> = this is a handoff along the route (not the final stop)</li>
                    <li><b>Yes</b> = this is the true final stop</li>
                  </ul>
                  <b>Every “No” handoff and the single “Yes” final destination response earns 1 NWP</b>,
                  issued by the seller to recognize delivery helpers.
                </div>
              </details>

              <details>
                <summary>
                  What is the 21,000 to 1 USD peg and “sextillionth of a penny”?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  It’s a bookkeeping ruler—nothing more.
                  <ul>
                    <li>The ledger uses <b>21,000 units</b> as a familiar reference for <b>$1</b> in reporting.</li>
                    <li>It measures tiny amounts down to a <b>sextillionth of a penny</b> so credit can be shared fairly.</li>
                  </ul>
                  Used for <b>general ledger purposes only</b>.
                </div>
              </details>

              <details>
                <summary>
                  Do I have to join Discord? Why?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  Yes—Discord acceptance is part of participation because it is our community room.
                  It’s where you get help, updates, and community assignments.
                </div>
              </details>

              <details>
                <summary>
                  Is it safe to scan while delivering?
                  <span class="chev">›</span>
                </summary>
                <div class="answer">
                  Safety first:
                  <ul>
                    <li>Never scan while driving.</li>
                    <li>Stop, park, and scan safely.</li>
                  </ul>
                </div>
              </details>
            </div>

            <div class="callout danger">
              <b>Reminder</b>
              If you are unsure which role to choose, pause and use PoD Help or ask in Discord.
            </div>
          </div>

          <!-- RIGHT -->
          <aside class="cta">
            <a class="btn btnPrimary" href="register-device">
              <div>
                Register This Device
                <span class="sub">Start here</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="pod-mode">
              <div>
                Enter PoD Mode
                <span class="sub">Universal QR starts here</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <a class="btn" href="pod-help">
              <div>
                PoD Help & Troubleshooting
                <span class="sub">Fix common issues</span>
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

            <a class="btn" href="how-it-works">
              <div>
                How It Works
                <span class="sub">Simple overview</span>
              </div>
              <div class="arrow">→</div>
            </a>

            <div class="fineprint">
              <b>Plain-language summary:</b><br />
              One universal QR starts the process. VFN is the buyer/seller fulfillment network using the 2-scan method.
              Seller pledge allocation includes: $5 buyer rebate, $4 social impact resource, and $1 patronage split as
              $0.50 individual seller return, $0.40 rotating 5-seller group bonus pool, and $0.10 treasury reserve
              (plus $0.30 PoD service COGS).
            </div>
          </aside>
        </div>

      </div>
    </section>
  </main>
</body>
</html>


