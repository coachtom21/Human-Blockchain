<?php
/**
 * Template Name: YAM JAM Rewards
 *
 * YAM JAM (You And Me, Just Alternative Money) — rewards economics page.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="yamjam-page" tabindex="-1">
  <style>
    .yamjam-page{
      --yamjam-bg:#07111f;
      --yamjam-bg2:#0b1730;
      --yamjam-panel:#0f1d39;
      --yamjam-panel2:#13264a;
      --yamjam-text:#eef4ff;
      --yamjam-muted:#a8b8d8;
      --yamjam-line:rgba(255,255,255,.10);
      --yamjam-line2:rgba(105,167,255,.22);
      --yamjam-blue:#69a7ff;
      --yamjam-cyan:#67e8f9;
      --yamjam-green:#3ddc97;
      --yamjam-gold:#f7c65f;
      --yamjam-purple:#9b7bff;
      --yamjam-red:#ff7f7f;
      --yamjam-shadow:0 20px 48px rgba(0,0,0,.34);
      --yamjam-radius:22px;
      --yamjam-max:1180px;
    }

    html{scroll-behavior:smooth}

    .yamjam-page *{box-sizing:border-box}

    .yamjam-page{
      margin:0;
      font-family:Arial, Helvetica, sans-serif;
      color:var(--yamjam-text);
      line-height:1.6;
      background:
        radial-gradient(circle at top left, rgba(105,167,255,.12), transparent 28%),
        radial-gradient(circle at top right, rgba(61,220,151,.08), transparent 24%),
        linear-gradient(180deg, var(--yamjam-bg) 0%, var(--yamjam-bg2) 100%);
    }

    .yamjam-page a{text-decoration:none;color:inherit}

    .yamjam-wrap{width:min(var(--yamjam-max), calc(100% - 32px)); margin:0 auto}

    .yamjam-header{
      position:sticky;
      top:0;
      z-index:20;
      backdrop-filter:blur(10px);
      background:rgba(7,17,31,.82);
      border-bottom:1px solid var(--yamjam-line);
    }

    .yamjam-header-row{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:20px;
      padding:14px 0;
    }

    .yamjam-brand{
      font-weight:800;
      letter-spacing:.03em;
      color:#fff;
    }
    .yamjam-brand span{color:var(--yamjam-cyan)}

    .yamjam-links{
      display:flex;
      gap:18px;
      flex-wrap:wrap;
      color:var(--yamjam-muted);
      font-size:.95rem;
    }

    .yamjam-links a:hover{color:#fff}

    .yamjam-hero{
      padding:78px 0 34px;
    }

    .yamjam-hero-grid{
      display:grid;
      grid-template-columns:1.15fr .85fr;
      gap:24px;
      align-items:center;
    }

    .yamjam-eyebrow{
      display:inline-block;
      padding:8px 14px;
      border-radius:999px;
      background:rgba(105,167,255,.10);
      border:1px solid var(--yamjam-line2);
      color:var(--yamjam-blue);
      font-size:.82rem;
      font-weight:700;
      text-transform:uppercase;
      letter-spacing:.06em;
      margin-bottom:18px;
    }

    .yamjam-page h1{
      margin:0 0 16px;
      font-size:clamp(2.2rem,4.7vw,4.2rem);
      line-height:1.03;
      letter-spacing:-.04em;
      color:var(--yamjam-text);
    }

    .yamjam-hero p{
      margin:0 0 14px;
      color:var(--yamjam-muted);
      font-size:1.04rem;
      max-width:760px;
    }

    .yamjam-glass{
      background:linear-gradient(180deg, rgba(16,29,57,.94), rgba(10,20,40,.92));
      border:1px solid var(--yamjam-line);
      border-radius:28px;
      box-shadow:var(--yamjam-shadow);
      padding:24px;
    }

    .yamjam-stack{
      display:grid;
      gap:11px;
      margin-top:14px;
    }

    .yamjam-row{
      display:flex;
      justify-content:space-between;
      gap:14px;
      padding:12px 14px;
      border-radius:15px;
      background:rgba(255,255,255,.03);
      border:1px solid rgba(255,255,255,.06);
      color:var(--yamjam-muted);
    }

    .yamjam-row strong{color:#fff}

    .yamjam-section{padding:28px 0 56px}

    .yamjam-section-title{
      text-align:center;
      margin-bottom:24px;
    }

    .yamjam-section-title h2{
      margin:0 0 10px;
      font-size:clamp(1.7rem,3vw,2.7rem);
      letter-spacing:-.03em;
      color:var(--yamjam-text);
    }

    .yamjam-section-title p{
      margin:0 auto;
      max-width:880px;
      color:var(--yamjam-muted);
    }

    .yamjam-band{
      padding:30px;
      border-radius:28px;
      background:
        radial-gradient(circle at right top, rgba(103,232,249,.10), transparent 24%),
        linear-gradient(180deg, #0f1f3d 0%, #0a1630 100%);
      border:1px solid var(--yamjam-line2);
      box-shadow:var(--yamjam-shadow);
    }

    .yamjam-band h2{
      margin:0 0 10px;
      font-size:1.9rem;
      color:var(--yamjam-text);
    }

    .yamjam-band p{
      margin:0 0 20px;
      color:var(--yamjam-muted);
    }

    .yamjam-formula-grid{
      display:grid;
      grid-template-columns:repeat(5,1fr);
      gap:14px;
    }

    .yamjam-formula-box{
      background:rgba(255,255,255,.04);
      border:1px solid rgba(255,255,255,.08);
      border-radius:18px;
      padding:18px 14px;
      text-align:center;
    }

    .yamjam-formula-box .yamjam-num{
      font-size:1.4rem;
      font-weight:800;
      color:#fff;
      margin-bottom:6px;
    }

    .yamjam-formula-box .yamjam-lab{
      font-size:.9rem;
      color:var(--yamjam-muted);
    }

    .yamjam-grid-3{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:22px;
    }

    .yamjam-grid-2{
      display:grid;
      grid-template-columns:repeat(2,1fr);
      gap:22px;
    }

    .yamjam-card{
      background:linear-gradient(180deg, rgba(19,38,74,.92), rgba(11,23,48,.94));
      border:1px solid var(--yamjam-line);
      border-radius:var(--yamjam-radius);
      box-shadow:var(--yamjam-shadow);
      padding:24px;
      height:100%;
    }

    .yamjam-tag{
      display:inline-block;
      padding:7px 12px;
      border-radius:999px;
      font-size:.8rem;
      font-weight:700;
      margin-bottom:14px;
      border:1px solid transparent;
    }

    .yamjam-tag--blue{background:rgba(105,167,255,.12);color:var(--yamjam-blue);border-color:rgba(105,167,255,.22)}
    .yamjam-tag--green{background:rgba(61,220,151,.10);color:var(--yamjam-green);border-color:rgba(61,220,151,.22)}
    .yamjam-tag--gold{background:rgba(247,198,95,.10);color:var(--yamjam-gold);border-color:rgba(247,198,95,.22)}
    .yamjam-tag--purple{background:rgba(155,123,255,.11);color:var(--yamjam-purple);border-color:rgba(155,123,255,.22)}
    .yamjam-tag--red{background:rgba(255,127,127,.11);color:var(--yamjam-red);border-color:rgba(255,127,127,.22)}

    .yamjam-card h3{
      margin:0 0 10px;
      font-size:1.2rem;
      color:var(--yamjam-text);
    }

    .yamjam-card p{
      margin:0 0 14px;
      color:var(--yamjam-muted);
    }

    .yamjam-page ul.yamjam-clean{
      margin:0;
      padding-left:18px;
      color:var(--yamjam-muted);
    }

    .yamjam-page ul.yamjam-clean li{margin-bottom:9px}

    .yamjam-timeline{
      display:grid;
      grid-template-columns:repeat(4,1fr);
      gap:16px;
      margin-top:22px;
    }

    .yamjam-step{
      border:1px solid rgba(255,255,255,.08);
      background:rgba(255,255,255,.03);
      border-radius:18px;
      padding:18px;
    }

    .yamjam-step .yamjam-step-num{
      width:34px;
      height:34px;
      border-radius:50%;
      display:grid;
      place-items:center;
      background:rgba(105,167,255,.16);
      color:#fff;
      font-weight:800;
      margin-bottom:12px;
    }

    .yamjam-step h4{
      margin:0 0 8px;
      font-size:1rem;
      color:var(--yamjam-text);
    }

    .yamjam-step p{
      margin:0;
      font-size:.95rem;
      color:var(--yamjam-muted);
    }

    .yamjam-mini-stats{
      display:grid;
      grid-template-columns:repeat(4,1fr);
      gap:16px;
      margin-top:24px;
    }

    .yamjam-mini{
      background:linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.025));
      border:1px solid var(--yamjam-line);
      border-radius:18px;
      padding:18px;
      text-align:center;
    }

    .yamjam-mini .yamjam-big{
      font-size:1.65rem;
      font-weight:800;
      color:#fff;
      margin-bottom:6px;
    }

    .yamjam-mini .yamjam-txt{
      font-size:.93rem;
      color:var(--yamjam-muted);
    }

    .yamjam-footer-cta{
      padding:6px 0 82px;
    }

    .yamjam-cta-box{
      border-radius:28px;
      padding:34px;
      background:
        radial-gradient(circle at top left, rgba(105,167,255,.14), transparent 28%),
        linear-gradient(135deg, #12254a 0%, #0c1730 100%);
      border:1px solid rgba(105,167,255,.24);
      box-shadow:var(--yamjam-shadow);
    }

    .yamjam-cta-box h2{
      margin:0 0 10px;
      font-size:2rem;
      color:var(--yamjam-text);
    }

    .yamjam-cta-box p{
      margin:0;
      color:var(--yamjam-muted);
      max-width:980px;
    }

    @media (max-width:1020px){
      .yamjam-hero-grid,
      .yamjam-grid-3,
      .yamjam-grid-2,
      .yamjam-formula-grid,
      .yamjam-timeline,
      .yamjam-mini-stats{
        grid-template-columns:1fr;
      }
      .yamjam-header-row{
        flex-direction:column;
        align-items:flex-start;
      }
    }
  </style>

  <header class="yamjam-header">
    <div class="yamjam-wrap yamjam-header-row">
      <div class="yamjam-brand">Human<span>Blockchain</span>.info</div>
      <nav class="yamjam-links" aria-label="<?php esc_attr_e( 'YAM JAM page sections', 'hello-elementor-child' ); ?>">
        <a href="#rewards"><?php esc_html_e( 'Rewards', 'hello-elementor-child' ); ?></a>
        <a href="#treasury"><?php esc_html_e( 'Treasury', 'hello-elementor-child' ); ?></a>
        <a href="#mirror"><?php esc_html_e( 'Mirror', 'hello-elementor-child' ); ?></a>
        <a href="#genesis"><?php esc_html_e( 'Genesis', 'hello-elementor-child' ); ?></a>
        <a href="#bis20"><?php esc_html_e( 'BIS 2.0', 'hello-elementor-child' ); ?></a>
      </nav>
    </div>
  </header>

  <section class="yamjam-hero">
    <div class="yamjam-wrap yamjam-hero-grid">
      <div>
        <span class="yamjam-eyebrow"><?php esc_html_e( 'YAM JAM Rewards Page', 'hello-elementor-child' ); ?></span>
        <h1><?php esc_html_e( 'Pledge Value Today.', 'hello-elementor-child' ); ?><br><?php esc_html_e( 'Reputation After Maturity.', 'hello-elementor-child' ); ?><br><?php esc_html_e( 'Carry Forward Into BIS 2.0.', 'hello-elementor-child' ); ?></h1>
        <p>
          <?php esc_html_e( 'The YAM-is-On hang tag or sticker QR code creates a $30 buyer pledge, recognized by the ledger as $30 trade value. No cash is involved. Each confirmed delivery allocates $10 Cost of Goods Sold (COGS), $10.30 community value, and $9.70 seller margin, which carries NWP issue, accrual, and extinguishment responsibility.', 'hello-elementor-child' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'Community value includes a $5 buyer rebate, $4 social impact allocation, $1 patronage dividend, and $0.30 PoD service cost. Every 10-pack hang tag or sticker giveaway highlights $103 community value.', 'hello-elementor-child' ); ?>
        </p>
      </div>

      <aside class="yamjam-glass">
        <h3 style="margin:0 0 12px;"><?php esc_html_e( '$30 Trade Value Snapshot', 'hello-elementor-child' ); ?></h3>
        <div class="yamjam-stack">
          <div class="yamjam-row"><span><?php esc_html_e( 'Buyer Pledge Trade Value', 'hello-elementor-child' ); ?></span><strong>$30.00</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( 'Cost of Goods Sold (COGS)', 'hello-elementor-child' ); ?></span><strong>$10.00</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( 'Community Value', 'hello-elementor-child' ); ?></span><strong>$10.30</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( 'Seller Margin', 'hello-elementor-child' ); ?></span><strong>$9.70</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( 'Buyer Rebate', 'hello-elementor-child' ); ?></span><strong>$5.00</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( 'Social Impact', 'hello-elementor-child' ); ?></span><strong>$4.00</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( 'Patronage Dividend', 'hello-elementor-child' ); ?></span><strong>$1.00</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( 'PoD Service Cost', 'hello-elementor-child' ); ?></span><strong>$0.30</strong></div>
          <div class="yamjam-row"><span><?php esc_html_e( '10-Pack Community Value', 'hello-elementor-child' ); ?></span><strong>$103.00</strong></div>
        </div>
      </aside>
    </div>
  </section>

  <section class="yamjam-section">
    <div class="yamjam-wrap">
      <div class="yamjam-band">
        <h2><?php esc_html_e( 'Core Allocation Formula', 'hello-elementor-child' ); ?></h2>
        <p>
          <?php esc_html_e( 'One YAM-is-On scan creates one structured pledge event, one reputation opportunity, one treasury residual, and one future carry-forward record.', 'hello-elementor-child' ); ?>
        </p>
        <div class="yamjam-formula-grid">
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$30</div>
            <div class="yamjam-lab"><?php esc_html_e( 'Trade Value', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$10</div>
            <div class="yamjam-lab"><?php esc_html_e( 'Cost of Goods Sold', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$10.30</div>
            <div class="yamjam-lab"><?php esc_html_e( 'Community Value', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$9.70</div>
            <div class="yamjam-lab"><?php esc_html_e( 'Seller Margin', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$103</div>
            <div class="yamjam-lab"><?php esc_html_e( '10-Pack Highlight', 'hello-elementor-child' ); ?></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="rewards" class="yamjam-section">
    <div class="yamjam-wrap">
      <div class="yamjam-section-title">
        <h2><?php esc_html_e( 'Three Member Revenue Streams', 'hello-elementor-child' ); ?></h2>
        <p>
          <?php esc_html_e( 'Rewards are built from pledge activation, NWP issuance, and annual residual referral bonuses.', 'hello-elementor-child' ); ?>
        </p>
      </div>

      <div class="yamjam-grid-3">
        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--blue"><?php esc_html_e( 'Revenue Stream 1', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'YAM-is-On Pledge Activation', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( 'The first stream begins with the $30 buyer pledge and ledger trade value event.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( '$10 Cost of Goods Sold (COGS)', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$10.30 community value', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$9.70 seller margin', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$5 buyer rebate', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$4 social impact', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$1 patronage dividend', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$0.30 PoD service cost', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>

        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--green"><?php esc_html_e( 'Revenue Stream 2', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'NWP Issuance', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( 'The second stream is NWP issuance, accrual, and extinguishment, funded from seller margin and tied to reputation.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( 'Extends value beyond the original pledge event', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Builds track record through measurable participation', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Strengthens carry-forward value after validation', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>

        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--gold"><?php esc_html_e( 'Revenue Stream 3', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'Annual Referral Bonuses', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php
			printf(
				/* translators: %s: date (September 1) */
				esc_html__( 'Residual bonuses are delivered each year on %s for active memberships.', 'hello-elementor-child' ),
				'<strong>' . esc_html__( 'September 1', 'hello-elementor-child' ) . '</strong>'
			);
			?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( '$1 YAM’er', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$5 MEGAvoter', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '$25 Patron', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Annual residual member incentive', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section id="treasury" class="yamjam-section">
    <div class="yamjam-wrap">
      <div class="yamjam-section-title">
        <h2><?php esc_html_e( 'Member Treasury / Append-Only Ledger Residual', 'hello-elementor-child' ); ?></h2>
        <p>
          <?php esc_html_e( 'Every confirmed delivery generates a $0.40 residual captured by the Member Treasury / append-only ledger.', 'hello-elementor-child' ); ?>
        </p>
      </div>

      <div class="yamjam-band">
        <p>
          <?php esc_html_e( 'This $0.40 ledger residual is made of $0.30 PoD trade value plus $0.10 treasury reserve generated from the $1 patronage dividend after allocating $0.50 individual seller value and $0.40 POC group bonus pool value.', 'hello-elementor-child' ); ?>
        </p>

        <div class="yamjam-formula-grid">
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$0.30</div>
            <div class="yamjam-lab"><?php esc_html_e( 'PoD Trade Value', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$0.10</div>
            <div class="yamjam-lab"><?php esc_html_e( 'Treasury Reserve', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$0.50</div>
            <div class="yamjam-lab"><?php esc_html_e( 'Individual Seller', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$0.40</div>
            <div class="yamjam-lab"><?php esc_html_e( 'POC Group Bonus Pool', 'hello-elementor-child' ); ?></div>
          </div>
          <div class="yamjam-formula-box">
            <div class="yamjam-num">$0.40</div>
            <div class="yamjam-lab"><?php esc_html_e( 'Ledger Residual', 'hello-elementor-child' ); ?></div>
          </div>
        </div>
      </div>

      <div class="yamjam-grid-2" style="margin-top:22px;">
        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--red"><?php esc_html_e( 'Residual Reserve', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'Core YAM JAM Ledger Resource', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( 'The Member Treasury or append-only ledger accrues this residual from every confirmed delivery as the core reserve resource of the system.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( 'Tracks delivery-linked residual value', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Builds treasury strength through repetition', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Supports long-term one-vote, one-share member distribution', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>

        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--purple"><?php esc_html_e( 'Patron Member Basis', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'September 1, 2030 Allocation Logic', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( '99% of the core YAM JAM ledger residual reserve is allocated on September 1, 2030 on a one-vote, one-share basis for Patron members pledging the $30 monthly subscription.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( 'Patron-focused treasury distribution', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'One-vote, one-share logic', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( '1% legacy seed reserved for the next 10-year iteration', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section id="mirror" class="yamjam-section">
    <div class="yamjam-wrap">
      <div class="yamjam-band">
        <h2><?php esc_html_e( 'Kalshi Mirror “Did This Happen?” Protocol', 'hello-elementor-child' ); ?></h2>
        <p>
          <?php esc_html_e( 'Reputation is earned only after an 8–12 week maturity period. The record is then tested by a binary mirror question: Did this happen? When mirrored true, the event becomes validated reputation, creating assurance and supporting access to the 70% LTV MEGAgrants program.', 'hello-elementor-child' ); ?>
        </p>

        <div class="yamjam-timeline">
          <div class="yamjam-step">
            <div class="yamjam-step-num">1</div>
            <h4><?php esc_html_e( 'Pledge Recorded', 'hello-elementor-child' ); ?></h4>
            <p><?php esc_html_e( '$30 trade value and PoD-linked event enter the ledger.', 'hello-elementor-child' ); ?></p>
          </div>
          <div class="yamjam-step">
            <div class="yamjam-step-num">2</div>
            <h4><?php esc_html_e( 'Maturity Window', 'hello-elementor-child' ); ?></h4>
            <p><?php esc_html_e( 'Record waits 8–12 weeks before reputation is finalized.', 'hello-elementor-child' ); ?></p>
          </div>
          <div class="yamjam-step">
            <div class="yamjam-step-num">3</div>
            <h4><?php esc_html_e( 'Mirror Check', 'hello-elementor-child' ); ?></h4>
            <p><?php esc_html_e( 'The system asks: Did this happen?', 'hello-elementor-child' ); ?></p>
          </div>
          <div class="yamjam-step">
            <div class="yamjam-step-num">4</div>
            <h4><?php esc_html_e( 'Assurance Built', 'hello-elementor-child' ); ?></h4>
            <p><?php esc_html_e( 'Validated outcomes build reputation and future access.', 'hello-elementor-child' ); ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="genesis" class="yamjam-section">
    <div class="yamjam-wrap">
      <div class="yamjam-section-title">
        <h2><?php esc_html_e( 'Genesis Block and Treasury Distribution', 'hello-elementor-child' ); ?></h2>
        <p>
          <?php esc_html_e( 'The 2030 cycle establishes the first 10-year renewable currency and carries value forward into the next decade.', 'hello-elementor-child' ); ?>
        </p>
      </div>

      <div class="yamjam-grid-2">
        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--purple"><?php esc_html_e( 'May 17, 2030', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'Genesis Block', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( 'May 17, 2030 is the genesis block for a 10-year renewable currency, backed by fiat and crypto deposits received on May 16, 2030.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( 'Deposits received May 16, 2030 form the initial backing base', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Genesis launches the first renewable currency cycle', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'YAM JAM activity from May 17 through Dec. 31, 2030 accrues as carry-forward value', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>

        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--gold"><?php esc_html_e( 'September 1, 2030', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( '99% Allocation / 1% Legacy Seed', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( 'On September 1, 2030, the treasury distributes 99% of assets and confirms 1% as the legacy seed for the next 10-year iteration.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( 'Reported on 1099-PATR', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Reported on 1099-K', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Reported on 1099-NEC', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Creates the seed base for renewal', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section id="bis20" class="yamjam-section">
    <div class="yamjam-wrap">
      <div class="yamjam-section-title">
        <h2><?php esc_html_e( '2031–2040 BIS 2.0 Carry Forward', 'hello-elementor-child' ); ?></h2>
        <p>
          <?php esc_html_e( 'All YAM JAM activities from May 17 through December 31, 2030 accrue as carry-forward values into the 2031–2040 BIS 2.0 cycle, where BIS means Bounty for Inspirational Services.', 'hello-elementor-child' ); ?>
        </p>
      </div>

      <div class="yamjam-grid-2">
        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--blue"><?php esc_html_e( 'Carry Forward Logic', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'Value Does Not Stop at 2030', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( 'Validated 2030 activity becomes the opening carry-forward layer for the next decade of operations.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( 'May 17–Dec. 31, 2030 activity accrues forward', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Reputation, pledge history, and member values continue', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Creates continuity instead of restart', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>

        <article class="yamjam-card">
          <span class="yamjam-tag yamjam-tag--green"><?php esc_html_e( 'BIS 2.0', 'hello-elementor-child' ); ?></span>
          <h3><?php esc_html_e( 'Bounty for Inspirational Services', 'hello-elementor-child' ); ?></h3>
          <p>
            <?php esc_html_e( 'The 2031–2040 BIS 2.0 period operates as the next reinvoicing era, using carry-forward values and legacy seed values from 2030 as the foundation for ongoing operations.', 'hello-elementor-child' ); ?>
          </p>
          <ul class="yamjam-clean">
            <li><?php esc_html_e( '10-year follow-on cycle', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Reinvoicing operations continue from proven history', 'hello-elementor-child' ); ?></li>
            <li><?php esc_html_e( 'Legacy seed and carry-forward values support renewal', 'hello-elementor-child' ); ?></li>
          </ul>
        </article>
      </div>

      <div class="yamjam-mini-stats">
        <div class="yamjam-mini">
          <div class="yamjam-big">$0.40</div>
          <div class="yamjam-txt"><?php esc_html_e( 'Per Delivery Ledger Residual', 'hello-elementor-child' ); ?></div>
        </div>
        <div class="yamjam-mini">
          <div class="yamjam-big">8–12</div>
          <div class="yamjam-txt"><?php esc_html_e( 'Week Reputation Maturity', 'hello-elementor-child' ); ?></div>
        </div>
        <div class="yamjam-mini">
          <div class="yamjam-big">99 / 1</div>
          <div class="yamjam-txt"><?php esc_html_e( 'Allocation / Legacy Seed', 'hello-elementor-child' ); ?></div>
        </div>
        <div class="yamjam-mini">
          <div class="yamjam-big">2031–2040</div>
          <div class="yamjam-txt"><?php esc_html_e( 'BIS 2.0 Reinvoicing Era', 'hello-elementor-child' ); ?></div>
        </div>
      </div>
    </div>
  </section>

  <section class="yamjam-footer-cta">
    <div class="yamjam-wrap">
      <div class="yamjam-cta-box">
        <h2><?php esc_html_e( 'Human Blockchain Summary', 'hello-elementor-child' ); ?></h2>
        <p>
          <?php esc_html_e( 'YAM JAM begins with a $30 pledge event, including $10 Cost of Goods Sold (COGS), $10.30 community value, and $9.70 seller margin. Every confirmed delivery also creates a $0.40 Member Treasury / append-only ledger residual made of $0.30 PoD trade value plus $0.10 treasury reserve after the $1 patronage dividend allocates $0.50 individual seller value and $0.40 POC group bonus pool value. Reputation matures through the Kalshi Mirror “did this happen” protocol after 8–12 weeks and supports 70% LTV MEGAgrants access. May 17, 2030 launches the genesis block of a 10-year renewable currency backed by fiat and crypto deposits received May 16, 2030. On September 1, 2030, 99% of the core YAM JAM ledger residual reserve is allocated on a one-vote, one-share basis for Patron members pledging the $30 monthly subscription, while 1% is confirmed as the legacy seed for the next 10-year iteration. All activity from May 17 through December 31, 2030 carries forward into the 2031–2040 BIS 2.0 Bounty for Inspirational Services reinvoicing cycle.', 'hello-elementor-child' ); ?>
        </p>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
