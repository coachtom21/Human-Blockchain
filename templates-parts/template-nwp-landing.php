<?php
/**
 * Template Name: NWP Landing
 */
$hb_nwp_activating_video_url = apply_filters(
	'hb_nwp_activating_video_url',
	'https://humanblockchain.info/wp-content/uploads/2026/04/One-Sky-One-World-%E2%86%92-Detente-2030-2026-04-241.mp4'
);
$hb_nwp_gratitude_audio_url = apply_filters(
	'hb_nwp_gratitude_audio_url',
	'https://humanblockchain.info/wp-content/uploads/2026/04/Turning_human_gratitude_into_economic_value.mp4'
);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NWP Processing Center | humanblockchain.info</title>
  <style>
    :root {
      --bg: #08111f;
      --panel: #0f1b2d;
      --panel-2: #13233b;
      --text: #eef4ff;
      --muted: #b6c4dc;
      --accent: #f5b942;
      --accent-2: #64d2ff;
      --green: #51d38a;
      --border: rgba(255,255,255,0.12);
      --shadow: 0 20px 60px rgba(0,0,0,0.35);
      --radius: 24px;
      --max: 1180px;
    }

    * { box-sizing: border-box; }
    html {
      scroll-behavior: smooth;
      overflow-x: hidden; /* older engines */
      overflow-x: clip; /* keeps X overflow contained without breaking position: sticky on the nav */
    }
    body.nwp-landing {
      margin: 0;
      overflow-x: hidden;
      overflow-x: clip;
      -webkit-text-size-adjust: 100%;
      text-size-adjust: 100%;
      padding-left: max(0px, env(safe-area-inset-left, 0px));
      padding-right: max(0px, env(safe-area-inset-right, 0px));
    }
    body {
      margin: 0;
      font-family: Inter, Arial, Helvetica, sans-serif;
      background:
        radial-gradient(circle at top right, rgba(100,210,255,0.14), transparent 28%),
        radial-gradient(circle at top left, rgba(245,185,66,0.12), transparent 22%),
        linear-gradient(180deg, #07101c 0%, #0b1627 100%);
      color: var(--text);
      line-height: 1.55;
    }

    a { color: inherit; text-decoration: none; }
    img { max-width: 100%; display: block; }

    .container {
      width: min(var(--max), calc(100% - 32px));
      margin: 0 auto;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 14px 20px;
      border-radius: 999px;
      font-weight: 700;
      border: 1px solid transparent;
      transition: 0.25s ease;
      cursor: pointer;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--accent), #ffd16c);
      color: #08111f;
      box-shadow: 0 18px 40px rgba(245,185,66,0.28);
    }

    .btn-primary:hover { transform: translateY(-1px); }

    .btn-secondary {
      background: rgba(255,255,255,0.04);
      border-color: var(--border);
      color: var(--text);
    }

    .btn-secondary:hover {
      background: rgba(255,255,255,0.08);
      transform: translateY(-1px);
    }

    .hero {
      padding: 84px 0 56px;
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.15fr 0.85fr;
      gap: 32px;
      align-items: center;
    }

    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(100,210,255,0.10);
      border: 1px solid rgba(100,210,255,0.18);
      color: #d8f6ff;
      font-size: 0.9rem;
      margin-bottom: 18px;
    }

    h1, h2, h3 { line-height: 1.1; margin: 0 0 16px; color: #fff; }
    h1 {
      font-size: 4.6rem;
      font-weight: 600;
      letter-spacing: -0.04em;
      max-width: 13ch;
    }

    .hero p {
      color: var(--muted);
      font-size: 1.1rem;
      max-width: 60ch;
      margin: 0 0 24px;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 24px;
    }

    .hero-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .hero-meta span {
      padding: 10px 14px;
      border-radius: 999px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
    }

    .hero-card {
      background: linear-gradient(180deg, rgba(19,35,59,0.95), rgba(11,22,39,0.95));
      border: 1px solid var(--border);
      border-radius: 28px;
      padding: 26px;
      box-shadow: var(--shadow);
      position: relative;
      overflow: hidden;
    }

    .hero-card::after {
      content: "";
      position: absolute;
      inset: auto -20% -30% auto;
      width: 240px;
      height: 240px;
      background: radial-gradient(circle, rgba(245,185,66,0.25), transparent 65%);
      pointer-events: none;
    }

    .hero-card--video {
      padding: 0;
      display: flex;
      flex-direction: column;
    }

    .hero-card--video::after {
      z-index: 0;
    }

    .hero-video-chrome {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 18px 12px;
      background: linear-gradient(180deg, #132542, #0d1728);
      border-bottom: 1px solid rgba(255,255,255,0.08);
      color: #dbe7fb;
      font-size: 0.88rem;
    }

    .hero-card--video .nwp-media-video-wrap {
      position: relative;
      z-index: 1;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: none;
      margin: 0 0 16px;
    }

    .hero-card-body {
      position: relative;
      z-index: 1;
      padding: 20px 22px 22px;
    }

    .hero-card-title {
      font-size: 1.7rem;
      font-weight: 600;
      margin: 0 0 10px;
      color: #fff;
      line-height: 1.2;
    }

    .hero-card-lead {
      margin: 0 0 18px;
      color: var(--muted);
      font-size: 1rem;
      line-height: 1.5;
    }

    .hero-card-audio {
      display: flex;
      flex-direction: column;
      align-items: stretch;
      text-align: left;
      padding: 16px 18px;
      margin: 0 0 20px;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(100, 210, 255, 0.22);
      border-radius: 16px;
    }

    .hero-card-audio .nwp-media-kind {
      margin-bottom: 4px;
    }

    .nwp-audio-title {
      margin: 0 0 12px;
      font-size: 0.92rem;
      color: var(--muted);
      line-height: 1.4;
    }

    .nwp-gratitude-audio {
      display: block;
      width: 100%;
      min-height: 44px;
    }

    .hero-card-cta {
      position: relative;
      z-index: 1;
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      padding: 0;
      margin-top: 4px;
    }

    .phone {
      border-radius: 28px;
      padding: 18px;
      border: 1px solid rgba(255,255,255,0.14);
      background: linear-gradient(180deg, #0c1627, #101c30);
    }

    .phone-screen {
      border-radius: 22px;
      padding: 20px;
      background: linear-gradient(180deg, #132542, #0d1728);
      border: 1px solid rgba(255,255,255,0.08);
    }

    .phone-top {
      display: flex;
      justify-content: space-between;
      color: #dbe7fb;
      font-size: 0.88rem;
      margin-bottom: 18px;
    }

    .scan-badge {
      display: inline-block;
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(81,211,138,0.14);
      border: 1px solid rgba(81,211,138,0.3);
      color: #bdf3d2;
      font-size: 0.84rem;
      font-weight: 700;
      margin-bottom: 14px;
    }

    .formula-card, .card, .step, .tier, .cta-panel {
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
    }

    .section {
      padding: 40px 0;
    }

    .section-head {
      max-width: 760px;
      margin-bottom: 24px;
    }

    .section-head p {
      color: var(--muted);
      margin: 0;
    }

    .formula-grid,
    .cards,
    .steps,
    .tier-grid,
    .cta-grid,
    .feature-grid {
      display: grid;
      gap: 20px;
    }

    .formula-grid,
    .cards,
    .tier-grid,
    .feature-grid {
      grid-template-columns: repeat(3, 1fr);
    }

    .steps {
      grid-template-columns: repeat(4, 1fr);
    }

    .card, .formula-card, .step, .tier {
      padding: 24px;
    }

    .card h3, .formula-card h3, .step h3, .tier h3 {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .card p, .formula-card p, .step p, .tier p {
      margin: 0;
      color: var(--muted);
    }

    .kicker {
      display: inline-block;
      font-size: 0.78rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.09em;
      color: var(--accent-2);
      margin-bottom: 10px;
    }

    .big-number {
      font-size: 2.2rem;
      font-weight: 900;
      letter-spacing: -0.04em;
      margin: 8px 0 10px;
      color: #fff;
    }

    .step-number {
      width: 42px;
      height: 42px;
      display: grid;
      place-items: center;
      border-radius: 14px;
      background: rgba(245,185,66,0.14);
      color: var(--accent);
      font-weight: 900;
      margin-bottom: 14px;
    }

    .feature-grid .card {
      min-height: 100%;
    }

    .nwp-media-video-wrap {
      width: 100%;
      border-radius: var(--radius);
      overflow: hidden;
      background: #050a12;
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
    }

    .nwp-media-video {
      display: block;
      width: 100%;
      height: auto;
      vertical-align: middle;
    }

    .nwp-media-kind {
      display: block;
      font-size: 0.72rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--accent-2);
      margin-bottom: 10px;
    }

    .nwp-media-hint {
      margin: 0;
      font-size: 0.9rem;
      color: var(--muted);
    }

    .tier ul {
      margin: 14px 0 0;
      padding-left: 18px;
      color: var(--muted);
    }

    .tier li + li { margin-top: 8px; }

    .tier-highlight {
      border-color: rgba(245,185,66,0.35);
      background: linear-gradient(180deg, rgba(245,185,66,0.10), rgba(255,255,255,0.04));
    }

    .cta-panel {
      padding: 30px;
      background: linear-gradient(135deg, rgba(100,210,255,0.08), rgba(245,185,66,0.10));
    }

    .cta-grid {
      grid-template-columns: 1.2fr 0.8fr;
      align-items: center;
    }

    .cta-panel p {
      color: var(--muted);
      margin: 0 0 20px;
      max-width: 58ch;
    }

    .mini-list {
      display: grid;
      gap: 12px;
    }

    .mini-item {
      padding: 14px 16px;
      border-radius: 18px;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.10);
      color: var(--muted);
    }

    footer {
      padding: 34px 0 60px;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .footer-box {
      display: flex;
      justify-content: space-between;
      gap: 18px;
      flex-wrap: wrap;
      padding-top: 24px;
      border-top: 1px solid rgba(255,255,255,0.10);
    }

    @media (max-width: 1024px) {
      .hero-grid,
      .formula-grid,
      .cards,
      .steps,
      .tier-grid,
      .feature-grid,
      .cta-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 900px) {
      .hero-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 720px) {
      .hero {
        padding: 48px 0 40px;
      }
      .hero-grid,
      .formula-grid,
      .cards,
      .steps,
      .tier-grid,
      .feature-grid,
      .cta-grid {
        grid-template-columns: 1fr;
      }
      h1 { max-width: none; }
      .footer-box {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    @media (max-width: 480px) {
      .container {
        width: min(var(--max), calc(100% - 24px));
      }
      .eyebrow {
        font-size: 0.8rem;
        padding: 6px 12px;
        line-height: 1.35;
      }
      .hero p {
        font-size: 1rem;
      }
      .hero-actions {
        flex-direction: column;
        align-items: stretch;
      }
      .hero-actions .btn {
        width: 100%;
        max-width: 100%;
        min-height: 48px;
      }
      .hero-meta {
        flex-direction: column;
        align-items: stretch;
      }
      .hero-meta span {
        text-align: center;
      }
    }

    .yamjam-tutorial {
      padding: 90px 20px;
      background: linear-gradient(180deg, #08111f 0%, #0f1f38 100%);
      color: #eef4ff;
      scroll-margin-top: 88px;
    }

    .yamjam-container {
      width: min(1180px, 100%);
      margin: 0 auto;
    }

    .yamjam-header {
      max-width: 820px;
      margin-bottom: 40px;
    }

    .yamjam-kicker,
    .yamjam-mini-kicker {
      display: inline-block;
      padding: 8px 14px;
      border-radius: 999px;
      font-size: 0.8rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .yamjam-kicker {
      margin-bottom: 12px;
      background: rgba(100, 210, 255, 0.12);
      border: 1px solid rgba(100, 210, 255, 0.2);
      color: #d9f7ff;
    }

    .yamjam-mini-kicker {
      margin-bottom: 10px;
      background: rgba(245, 185, 66, 0.12);
      border: 1px solid rgba(245, 185, 66, 0.22);
      color: #ffe39f;
    }

    .yamjam-header h2 {
      font-size: clamp(2.2rem, 4vw, 3.4rem);
      margin: 0 0 14px;
      line-height: 1.1;
    }

    .yamjam-header p {
      color: #b8c6dc;
      line-height: 1.7;
      margin: 0;
    }

    .yamjam-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 22px;
      margin-bottom: 30px;
    }

    .yamjam-card {
      padding: 26px;
      border-radius: 24px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .yamjam-card-highlight {
      border-color: rgba(100, 210, 255, 0.3);
    }

    .yamjam-card h3 {
      margin: 0 0 10px;
      font-size: 1.25rem;
      line-height: 1.2;
    }

    .yamjam-card p {
      margin: 0;
      color: #b8c6dc;
      line-height: 1.65;
    }

    .yamjam-number {
      width: 44px;
      height: 44px;
      display: grid;
      place-items: center;
      border-radius: 14px;
      background: rgba(245, 185, 66, 0.15);
      margin-bottom: 12px;
      font-weight: 900;
    }

    .yamjam-flow,
    .yamjam-nwp,
    .yamjam-summary {
      display: grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap: 24px;
      margin-bottom: 30px;
      padding: 28px;
      border-radius: 26px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
      align-items: start;
    }

    .yamjam-flow-left h3,
    .yamjam-nwp-copy h3,
    .yamjam-summary-copy h3 {
      margin: 0 0 10px;
      font-size: clamp(1.35rem, 2.5vw, 1.9rem);
      line-height: 1.2;
    }

    .yamjam-flow-left p,
    .yamjam-nwp-copy p,
    .yamjam-summary-copy p {
      margin: 0 0 12px;
      color: #b8c6dc;
      line-height: 1.7;
    }

    .yamjam-nwp-copy p:last-of-type {
      margin-bottom: 0;
    }

    .yamjam-nwp-copy ul {
      margin: 12px 0 0;
      padding-left: 1.2em;
      color: #b8c6dc;
      line-height: 1.65;
    }

    .yamjam-step,
    .yamjam-point,
    .yamjam-summary-item {
      padding: 14px 16px;
      border-radius: 18px;
      background: rgba(255, 255, 255, 0.05);
      margin-bottom: 10px;
    }

    .yamjam-step:last-child,
    .yamjam-point:last-child {
      margin-bottom: 0;
    }

    .yamjam-step strong,
    .yamjam-point strong,
    .yamjam-summary-item strong {
      display: block;
      margin-bottom: 4px;
      color: #fff;
    }

    .yamjam-step span,
    .yamjam-point span,
    .yamjam-summary-item span {
      color: #b8c6dc;
      font-size: 0.95rem;
    }

    .yamjam-step-highlight,
    .yamjam-summary-item-highlight {
      border: 1px solid rgba(245, 185, 66, 0.3);
    }

    .yamjam-summary-box {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    @media (max-width: 980px) {
      .yamjam-grid,
      .yamjam-flow,
      .yamjam-nwp,
      .yamjam-summary {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 640px) {
      .yamjam-tutorial {
        padding: 64px 16px;
      }
    }

    .seller-types {
      padding: 88px 20px;
      background:
        radial-gradient(circle at top right, rgba(245, 185, 66, 0.08), transparent 24%),
        radial-gradient(circle at bottom left, rgba(100, 210, 255, 0.08), transparent 26%),
        linear-gradient(180deg, #091321 0%, #0f1d34 100%);
      color: #eef4ff;
      scroll-margin-top: 88px;
    }

    .seller-container {
      width: min(1200px, 100%);
      margin: 0 auto;
    }

    .seller-header {
      max-width: 830px;
      margin-bottom: 42px;
    }

    .seller-kicker {
      display: inline-block;
      margin-bottom: 12px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(245, 185, 66, 0.12);
      border: 1px solid rgba(245, 185, 66, 0.24);
      color: #ffe39f;
      font-size: 0.8rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .seller-header h2 {
      margin: 0 0 14px;
      font-size: clamp(2.1rem, 4vw, 3.35rem);
      line-height: 1.08;
      letter-spacing: -0.035em;
    }

    .seller-header p {
      margin: 0;
      color: #b9c8df;
      font-size: 1.06rem;
      line-height: 1.75;
    }

    .seller-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-bottom: 28px;
    }

    .seller-card {
      display: flex;
      flex-direction: column;
      min-height: 100%;
      padding: 30px;
      border-radius: 28px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(255, 255, 255, 0.04);
      box-shadow: 0 20px 44px rgba(0, 0, 0, 0.22);
      transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .seller-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 26px 52px rgba(0, 0, 0, 0.28);
    }

    .seller-card-personal {
      background: linear-gradient(
        180deg,
        rgba(245, 185, 66, 0.13),
        rgba(255, 255, 255, 0.04)
      );
      border-color: rgba(245, 185, 66, 0.34);
    }

    .seller-card-poc {
      background: linear-gradient(
        180deg,
        rgba(81, 211, 138, 0.1),
        rgba(255, 255, 255, 0.04)
      );
      border-color: rgba(81, 211, 138, 0.26);
    }

    .seller-card-guild {
      background: linear-gradient(
        180deg,
        rgba(100, 210, 255, 0.1),
        rgba(255, 255, 255, 0.04)
      );
      border-color: rgba(100, 210, 255, 0.26);
    }

    .seller-badge {
      display: inline-block;
      align-self: flex-start;
      margin-bottom: 14px;
      padding: 8px 12px;
      border-radius: 999px;
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      border: 1px solid transparent;
    }

    .seller-badge-personal {
      background: rgba(245, 185, 66, 0.12);
      border-color: rgba(245, 185, 66, 0.25);
      color: #ffe19a;
    }

    .seller-badge-poc {
      background: rgba(81, 211, 138, 0.12);
      border-color: rgba(81, 211, 138, 0.24);
      color: #c9f7db;
    }

    .seller-badge-guild {
      background: rgba(100, 210, 255, 0.12);
      border-color: rgba(100, 210, 255, 0.22);
      color: #d9f7ff;
    }

    .seller-card h3 {
      margin: 0 0 12px;
      font-size: 1.42rem;
      line-height: 1.2;
    }

    .seller-lead {
      margin: 0 0 18px;
      color: #c0cde2;
      font-size: 1rem;
      line-height: 1.72;
    }

    .seller-message-box {
      margin-bottom: 18px;
      padding: 18px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .seller-message-label {
      display: inline-block;
      margin-bottom: 8px;
      color: #ffffff;
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .seller-message-box p {
      margin: 0;
      color: #b9c8df;
      line-height: 1.7;
    }

    .seller-list {
      margin: 0;
      padding-left: 18px;
      color: #d7e3f4;
      line-height: 1.7;
      flex-grow: 1;
    }

    .seller-list li + li {
      margin-top: 8px;
    }

    .seller-footer {
      margin-top: 24px;
      padding-top: 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .seller-footer span {
      display: block;
      margin-bottom: 6px;
      color: #8ea3c2;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .seller-footer strong {
      color: #ffffff;
      font-size: 0.97rem;
      line-height: 1.5;
    }

    .seller-summary-band {
      display: grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap: 24px;
      align-items: center;
      padding: 30px;
      border-radius: 28px;
      background: linear-gradient(
        135deg,
        rgba(245, 185, 66, 0.1),
        rgba(100, 210, 255, 0.08)
      );
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.2);
    }

    .seller-summary-kicker {
      display: inline-block;
      margin-bottom: 10px;
      color: #ffe39f;
      font-size: 0.8rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .seller-summary-intro h3 {
      margin: 0 0 12px;
      font-size: clamp(1.55rem, 3vw, 2.3rem);
      line-height: 1.15;
    }

    .seller-summary-intro p {
      margin: 0;
      color: #bccade;
      line-height: 1.75;
    }

    .seller-summary-stack {
      display: grid;
      gap: 14px;
    }

    .seller-summary-item {
      padding: 16px 18px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .seller-summary-item strong {
      display: block;
      margin-bottom: 6px;
      color: #ffffff;
      font-size: 1rem;
    }

    .seller-summary-item span {
      color: #b9c8df;
      font-size: 0.95rem;
    }

    .seller-summary-item-highlight {
      border-color: rgba(245, 185, 66, 0.32);
      background: rgba(245, 185, 66, 0.12);
    }

    @media (max-width: 1024px) {
      .seller-grid,
      .seller-summary-band {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 640px) {
      .seller-types {
        padding: 68px 16px;
      }

      .seller-card,
      .seller-summary-band {
        padding: 24px;
      }
    }

    .trade-value {
      padding: 80px 20px;
      background: linear-gradient(180deg, #091321 0%, #10203a 100%);
      color: #eef4ff;
      scroll-margin-top: 88px;
    }

    .trade-container {
      width: min(1180px, 100%);
      margin: 0 auto;
    }

    .trade-header {
      max-width: 780px;
      margin-bottom: 40px;
    }

    .trade-kicker {
      display: inline-block;
      margin-bottom: 12px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(81, 211, 138, 0.12);
      border: 1px solid rgba(81, 211, 138, 0.22);
      color: #cbf6dc;
      font-size: 0.8rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .trade-header h2 {
      margin: 0 0 14px;
      font-size: clamp(2rem, 4vw, 3.2rem);
      line-height: 1.1;
      letter-spacing: -0.03em;
    }

    .trade-header p {
      margin: 0;
      color: #b8c6dc;
      font-size: 1.05rem;
      line-height: 1.7;
    }

    .trade-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 22px;
      margin-bottom: 28px;
    }

    .trade-card {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 26px;
      padding: 28px;
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
      transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .trade-card:hover {
      transform: translateY(-4px);
      border-color: rgba(100, 210, 255, 0.32);
    }

    .trade-card-primary {
      background: linear-gradient(
        180deg,
        rgba(100, 210, 255, 0.1),
        rgba(255, 255, 255, 0.04)
      );
      border-color: rgba(100, 210, 255, 0.28);
    }

    .trade-label {
      display: inline-block;
      margin-bottom: 14px;
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(245, 185, 66, 0.12);
      border: 1px solid rgba(245, 185, 66, 0.22);
      color: #ffe19a;
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .trade-card h3 {
      margin: 0 0 12px;
      font-size: 1.35rem;
      line-height: 1.2;
    }

    .trade-card p {
      margin: 0 0 18px;
      color: #b8c6dc;
      line-height: 1.7;
      font-size: 1rem;
    }

    .trade-tag-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .trade-tag {
      display: inline-flex;
      align-items: center;
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #d9e6f8;
      font-size: 0.88rem;
      font-weight: 600;
    }

    .trade-band {
      display: grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap: 22px;
      align-items: stretch;
      background: linear-gradient(
        135deg,
        rgba(245, 185, 66, 0.1),
        rgba(100, 210, 255, 0.08)
      );
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 28px;
      padding: 30px;
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.2);
    }

    .trade-mini-kicker {
      display: inline-block;
      margin-bottom: 10px;
      color: #ffe19a;
      font-size: 0.82rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .trade-band-left h3 {
      margin: 0 0 12px;
      font-size: clamp(1.5rem, 3vw, 2.2rem);
      line-height: 1.15;
    }

    .trade-band-left p {
      margin: 0;
      color: #b8c6dc;
      line-height: 1.7;
    }

    .trade-band-right {
      display: grid;
      gap: 14px;
    }

    .trade-metric {
      padding: 16px 18px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .trade-metric strong {
      display: block;
      margin-bottom: 6px;
      color: #ffffff;
      font-size: 1rem;
    }

    .trade-metric span {
      color: #b8c6dc;
      font-size: 0.95rem;
    }

    @media (max-width: 980px) {
      .trade-grid,
      .trade-band {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 640px) {
      .trade-value {
        padding: 64px 16px;
      }

      .trade-card,
      .trade-band {
        padding: 24px;
      }
    }

    .processing-flow {
      padding: 88px 20px;
      background:
        radial-gradient(circle at top left, rgba(100, 210, 255, 0.08), transparent 24%),
        radial-gradient(circle at bottom right, rgba(245, 185, 66, 0.08), transparent 24%),
        linear-gradient(180deg, #08111f 0%, #10203a 100%);
      color: #eef4ff;
      scroll-margin-top: 88px;
    }

    .flow-container {
      width: min(1200px, 100%);
      margin: 0 auto;
    }

    .flow-header {
      max-width: 820px;
      margin-bottom: 44px;
    }

    .flow-kicker {
      display: inline-block;
      margin-bottom: 12px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(100, 210, 255, 0.12);
      border: 1px solid rgba(100, 210, 255, 0.22);
      color: #d8f7ff;
      font-size: 0.8rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .flow-header h2 {
      margin: 0 0 14px;
      font-size: clamp(2.1rem, 4vw, 3.4rem);
      line-height: 1.08;
      letter-spacing: -0.035em;
    }

    .flow-header p {
      margin: 0;
      color: #b9c8df;
      font-size: 1.05rem;
      line-height: 1.75;
    }

    .flow-timeline {
      position: relative;
      display: grid;
      gap: 24px;
      margin-bottom: 30px;
    }

    .flow-line {
      position: absolute;
      left: 28px;
      top: 0;
      bottom: 0;
      width: 3px;
      border-radius: 999px;
      background: linear-gradient(
        180deg,
        rgba(100, 210, 255, 0.3),
        rgba(245, 185, 66, 0.3)
      );
    }

    .flow-step {
      position: relative;
      display: grid;
      grid-template-columns: 72px 1fr;
      gap: 18px;
      align-items: start;
    }

    .flow-icon {
      position: relative;
      z-index: 2;
      width: 56px;
      height: 56px;
      display: grid;
      place-items: center;
      border-radius: 18px;
      background: linear-gradient(135deg, #f5b942, #ffd673);
      color: #08111f;
      font-weight: 900;
      font-size: 1.1rem;
      box-shadow: 0 16px 30px rgba(245, 185, 66, 0.25);
    }

    .flow-card {
      padding: 26px 28px;
      border-radius: 26px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
      transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .flow-card:hover {
      transform: translateY(-4px);
      border-color: rgba(100, 210, 255, 0.3);
    }

    .flow-label {
      display: inline-block;
      margin-bottom: 10px;
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(245, 185, 66, 0.12);
      border: 1px solid rgba(245, 185, 66, 0.2);
      color: #ffe19a;
      font-size: 0.76rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .flow-card h3 {
      margin: 0 0 10px;
      font-size: 1.35rem;
      line-height: 1.2;
    }

    .flow-card p {
      margin: 0 0 16px;
      color: #b9c8df;
      line-height: 1.7;
      font-size: 1rem;
    }

    .flow-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .flow-tags span {
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #dce8f8;
      font-size: 0.88rem;
      font-weight: 600;
    }

    .flow-summary {
      display: grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap: 24px;
      align-items: center;
      padding: 30px;
      border-radius: 28px;
      background: linear-gradient(
        135deg,
        rgba(100, 210, 255, 0.08),
        rgba(245, 185, 66, 0.1)
      );
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.2);
    }

    .flow-summary-kicker {
      display: inline-block;
      margin-bottom: 10px;
      color: #d8f7ff;
      font-size: 0.8rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .flow-summary-left h3 {
      margin: 0 0 12px;
      font-size: clamp(1.5rem, 3vw, 2.25rem);
      line-height: 1.15;
    }

    .flow-summary-left p {
      margin: 0;
      color: #bccade;
      line-height: 1.75;
    }

    .flow-summary-right {
      display: grid;
      gap: 14px;
    }

    .flow-mini-card {
      padding: 16px 18px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .flow-mini-card strong {
      display: block;
      margin-bottom: 6px;
      color: #ffffff;
      font-size: 1rem;
    }

    .flow-mini-card span {
      color: #b9c8df;
      font-size: 0.94rem;
    }

    .flow-mini-card-highlight {
      border-color: rgba(245, 185, 66, 0.32);
      background: rgba(245, 185, 66, 0.12);
    }

    @media (max-width: 980px) {
      .flow-summary {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 720px) {
      .processing-flow {
        padding: 68px 16px;
      }

      .flow-step {
        grid-template-columns: 1fr;
        gap: 12px;
      }

      .flow-line {
        display: none;
      }

      .flow-card,
      .flow-summary {
        padding: 24px;
      }
    }

    .why-register {
      padding: 88px 20px;
      background:
        radial-gradient(circle at top right, rgba(100, 210, 255, 0.08), transparent 24%),
        radial-gradient(circle at bottom left, rgba(245, 185, 66, 0.08), transparent 24%),
        linear-gradient(180deg, #091321 0%, #10203a 100%);
      color: #eef4ff;
      scroll-margin-top: 88px;
    }

    .why-register-container {
      width: min(1200px, 100%);
      margin: 0 auto;
    }

    .why-register-header {
      max-width: 860px;
      margin-bottom: 42px;
    }

    .why-register-kicker,
    .why-register-mini-kicker {
      display: inline-block;
      padding: 8px 14px;
      border-radius: 999px;
      font-size: 0.8rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .why-register-kicker {
      margin-bottom: 12px;
      background: rgba(100, 210, 255, 0.12);
      border: 1px solid rgba(100, 210, 255, 0.22);
      color: #d9f7ff;
    }

    .why-register-mini-kicker {
      margin-bottom: 10px;
      background: rgba(245, 185, 66, 0.12);
      border: 1px solid rgba(245, 185, 66, 0.24);
      color: #ffe39f;
    }

    .why-register-header h2 {
      margin: 0 0 14px;
      font-size: clamp(2.15rem, 4vw, 3.5rem);
      line-height: 1.08;
      letter-spacing: -0.035em;
    }

    .why-register-header p {
      margin: 0;
      color: #b9c8df;
      font-size: 1.06rem;
      line-height: 1.78;
    }

    .why-register-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-bottom: 30px;
    }

    .why-register-card {
      padding: 28px;
      border-radius: 28px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 20px 44px rgba(0, 0, 0, 0.22);
      transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .why-register-card:hover {
      transform: translateY(-4px);
      border-color: rgba(100, 210, 255, 0.3);
    }

    .why-register-card-highlight {
      background: linear-gradient(
        180deg,
        rgba(245, 185, 66, 0.12),
        rgba(255, 255, 255, 0.04)
      );
      border-color: rgba(245, 185, 66, 0.3);
    }

    .why-register-icon {
      width: 52px;
      height: 52px;
      display: grid;
      place-items: center;
      margin-bottom: 16px;
      border-radius: 16px;
      background: linear-gradient(135deg, #f5b942, #ffd673);
      color: #08111f;
      font-weight: 900;
      font-size: 1.05rem;
      box-shadow: 0 16px 30px rgba(245, 185, 66, 0.24);
    }

    .why-register-card h3 {
      margin: 0 0 12px;
      font-size: 1.35rem;
      line-height: 1.2;
    }

    .why-register-card p {
      margin: 0;
      color: #bccade;
      line-height: 1.72;
    }

    .why-register-band {
      display: grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap: 24px;
      align-items: center;
      padding: 30px;
      border-radius: 28px;
      background: linear-gradient(
        135deg,
        rgba(100, 210, 255, 0.08),
        rgba(245, 185, 66, 0.1)
      );
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.2);
      margin-bottom: 30px;
    }

    .why-register-band-copy h3 {
      margin: 0 0 12px;
      font-size: clamp(1.5rem, 3vw, 2.3rem);
      line-height: 1.15;
    }

    .why-register-band-copy p {
      margin: 0;
      color: #bccade;
      line-height: 1.75;
    }

    .why-register-band-points {
      display: grid;
      gap: 14px;
    }

    .why-register-point {
      padding: 16px 18px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .why-register-point strong {
      display: block;
      margin-bottom: 6px;
      color: #ffffff;
      font-size: 1rem;
    }

    .why-register-point span {
      color: #b9c8df;
      font-size: 0.95rem;
    }

    .why-register-point-highlight {
      border-color: rgba(245, 185, 66, 0.32);
      background: rgba(245, 185, 66, 0.12);
    }

    .why-register-steps {
      margin-bottom: 30px;
    }

    .why-register-steps-header {
      max-width: 700px;
      margin-bottom: 22px;
    }

    .why-register-steps-header h3 {
      margin: 0;
      font-size: clamp(1.45rem, 2.8vw, 2.2rem);
      line-height: 1.15;
    }

    .why-register-step-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .why-register-step {
      padding: 24px;
      border-radius: 24px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.18);
    }

    .why-register-step-number {
      width: 44px;
      height: 44px;
      display: grid;
      place-items: center;
      margin-bottom: 14px;
      border-radius: 14px;
      background: rgba(100, 210, 255, 0.14);
      color: #d9f7ff;
      font-weight: 900;
    }

    .why-register-step h4 {
      margin: 0 0 10px;
      font-size: 1.1rem;
      line-height: 1.25;
    }

    .why-register-step p {
      margin: 0;
      color: #bccade;
      line-height: 1.68;
      font-size: 0.97rem;
    }

    .why-register-cta {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 24px;
      align-items: center;
      padding: 30px;
      border-radius: 28px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
    }

    .why-register-cta-copy h3 {
      margin: 0 0 12px;
      font-size: clamp(1.45rem, 3vw, 2.2rem);
      line-height: 1.15;
    }

    .why-register-cta-copy p {
      margin: 0;
      color: #bccade;
      line-height: 1.75;
    }

    .why-register-cta-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      justify-content: flex-start;
    }

    .why-register-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 20px;
      border-radius: 999px;
      font-weight: 800;
      text-decoration: none;
      transition: 0.25s ease;
      border: 1px solid transparent;
    }

    .why-register-btn-primary {
      background: linear-gradient(135deg, #f5b942, #ffd673);
      color: #08111f;
      box-shadow: 0 16px 30px rgba(245, 185, 66, 0.24);
    }

    .why-register-btn-primary:hover {
      transform: translateY(-2px);
    }

    .why-register-btn-secondary {
      background: rgba(255, 255, 255, 0.05);
      color: #eef4ff;
      border-color: rgba(255, 255, 255, 0.12);
    }

    .why-register-btn-secondary:hover {
      background: rgba(255, 255, 255, 0.08);
      transform: translateY(-2px);
    }

    #register-vcard {
      scroll-margin-top: 88px;
      height: 0;
      margin: 0;
      padding: 0;
      overflow: hidden;
      pointer-events: none;
    }

    @media (max-width: 1024px) {
      .why-register-grid,
      .why-register-band,
      .why-register-step-grid,
      .why-register-cta {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 640px) {
      .why-register {
        padding: 68px 16px;
      }

      .why-register-card,
      .why-register-band,
      .why-register-step,
      .why-register-cta {
        padding: 24px;
      }
    }

    @media (max-width: 640px) {
      .yamjam-tutorial,
      .trade-value,
      .processing-flow,
      .seller-types,
      .why-register {
        scroll-margin-top: 72px;
      }
      #register-vcard {
        scroll-margin-top: 72px;
      }
      #join {
        scroll-margin-top: 72px;
      }
    }

    @media (max-width: 480px) {
      .why-register-cta-actions {
        flex-direction: column;
        align-items: stretch;
      }
      .why-register-btn {
        width: 100%;
        min-height: 48px;
        justify-content: center;
      }
    }
  </style>
  <?php wp_head(); ?>
  <style id="nwp-landing-headings">
    /* After wp_head: theme/Elementor rules load earlier and were washing out titles */
    body.nwp-landing h1 {
      font-size: 4.6rem !important;
      font-weight: 600 !important;
    }
    @media (max-width: 1200px) {
      body.nwp-landing h1 {
        font-size: clamp(2.5rem, 5.5vw, 4.6rem) !important;
      }
    }
    @media (max-width: 640px) {
      body.nwp-landing h1 {
        font-size: clamp(1.7rem, 6.2vw, 2.35rem) !important;
        line-height: 1.12 !important;
      }
    }
    body.nwp-landing h1,
    body.nwp-landing h2,
    body.nwp-landing h3,
    body.nwp-landing h4 {
      color: #ffffff !important;
    }
    /* cpm-humanblockchain “activate” modals: white card — h2 was invisible (white on white) */
    body.nwp-landing .cpm-nwp-modal--activate .cpm-nwp-activate-title,
    body.nwp-landing .cpm-nwp-modal--activate h2.cpm-nwp-activate-title {
      color: #111111 !important;
    }
    body.nwp-landing .cpm-nwp-modal--activate .cpm-nwp-verify-subtitle {
      color: #6b7280 !important;
    }
    body.nwp-landing .big-number {
      color: #ffffff !important;
    }
    body.nwp-landing .nwp-site-header .nav-links,
    body.nwp-landing .nwp-site-header .nav-links a {
      color: #ffffff !important;
    }
    body.nwp-landing .nwp-site-header .nav-links a:hover {
      color: #64d2ff !important;
    }
    body.nwp-landing .nwp-site-header .brand-site-title {
      color: #ffffff !important;
    }
    /* cpm-hb: membership “branches” — load after theme + wp_head() so the three cards stay a grid */
    #cpm-hb-membership-modal .cpm-hb-membership-grid {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }
    @media (max-width: 1100px) {
      #cpm-hb-membership-modal .cpm-hb-membership-grid {
        grid-template-columns: 1fr !important;
      }
    }
  </style>
</head>
<body <?php body_class( 'nwp-landing' ); ?>>
  <?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

  <header class="hero">
    <div class="container hero-grid">
      <div>
        <div class="eyebrow">NWP turns your smartphone into a member-owned processing center</div>
        <h1>Process YAM JAM trade value like a Visa or Mastercard rail.</h1>
        <p>
          The New World Penny processing layer allows an <strong>individual</strong>, a <strong>Patron Organizing Community</strong>, or a <strong>guild</strong> to establish seller trade value through a smartphone, a QRtiger v-card, proof of delivery, and time-based maturity. Every verified encounter becomes part of a human blockchain built on real people, real time, and real place.
        </p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="#join">Join Gracebook</a>
          <a class="btn btn-secondary" href="#processing-flow">See the Processing Flow</a>
        </div>
        <div class="hero-meta">
          <span>Register your QRtiger v-card</span>
          <span>Face-to-face validation first</span>
          <span>Proof of delivery + maturity</span>
        </div>
      </div>

      <div class="hero-card hero-card--video">
        <div class="hero-video-chrome">
          <span>humanblockchain.info</span>
          <span>Live Processing</span>
        </div>
        <div class="hero-card-body">
          <div class="scan-badge"><?php echo esc_html__( 'First NWP Scan Detected', 'hello-elementor-child' ); ?></div>
          <h3 class="hero-card-title"><?php echo esc_html__( 'Activate Device', 'hello-elementor-child' ); ?></h3>
          <p class="hero-card-lead">
            <?php echo esc_html__( 'Accept your first NWP, register your device, join Gracebook, and unlock your QRtiger v-card gateway.', 'hello-elementor-child' ); ?>
          </p>

          <div class="nwp-media-video-wrap">
            <video
              class="nwp-media-video"
              controls
              playsinline
              preload="metadata"
              title="<?php echo esc_attr__( 'Activating Your NWP Processing Center', 'hello-elementor-child' ); ?>"
            >
              <source src="<?php echo esc_url( $hb_nwp_activating_video_url ); ?>" type="video/mp4" />
              <p class="nwp-media-hint" style="padding: 1rem;"><?php echo esc_html__( 'Your browser does not support embedded video.', 'hello-elementor-child' ); ?></p>
            </video>
          </div>

          <div class="hero-card-audio" aria-label="<?php echo esc_attr__( 'Gratitude audio', 'hello-elementor-child' ); ?>">
            <span class="nwp-media-kind"><?php echo esc_html__( 'Audio', 'hello-elementor-child' ); ?></span>
            <p class="nwp-audio-title"><?php echo esc_html__( 'Turning human gratitude into economic value', 'hello-elementor-child' ); ?></p>
            <audio
              class="nwp-gratitude-audio"
              controls
              playsinline
              preload="metadata"
              title="<?php echo esc_attr__( 'Turning human gratitude into economic value', 'hello-elementor-child' ); ?>"
            >
              <source src="<?php echo esc_url( $hb_nwp_gratitude_audio_url ); ?>" type="audio/mp4" />
            </audio>
          </div>

          <div class="mini-list">
            <div class="mini-item">
              <strong><?php echo esc_html__( 'Seller type:', 'hello-elementor-child' ); ?></strong>
              <?php echo esc_html__( 'Individual / POC / Guild', 'hello-elementor-child' ); ?>
            </div>
            <div class="mini-item">
              <strong><?php echo esc_html__( 'Validation:', 'hello-elementor-child' ); ?></strong>
              <?php echo esc_html__( 'Time + Geo + Proof of Delivery', 'hello-elementor-child' ); ?>
            </div>
            <div class="mini-item">
              <strong><?php echo esc_html__( 'Maturity:', 'hello-elementor-child' ); ?></strong>
              <?php echo esc_html__( 'Trade value becomes eligible after maturity rules are satisfied', 'hello-elementor-child' ); ?>
            </div>
          </div>

          <div class="hero-card-cta">
            <a class="btn btn-primary" href="#join"><?php echo esc_html__( 'Register v-card', 'hello-elementor-child' ); ?></a>
            <a class="btn btn-secondary" href="#seller-types"><?php echo esc_html__( 'Seller Paths', 'hello-elementor-child' ); ?></a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="trade-value" id="trade-value">
    <div class="trade-container">
      <div class="trade-header">
        <span class="trade-kicker">Trade Value</span>
        <h2>How NWP processing establishes YAM JAM trade value</h2>
        <p>
          NWP is the first processing event that turns a smartphone into a
          member-owned value gateway. When a seller transaction is backed by
          <strong>proof of delivery</strong> and allowed <strong>time for maturity</strong>,
          the event becomes eligible to carry YAM JAM trade value through the
          human blockchain.
        </p>
      </div>

      <div class="trade-grid">
        <article class="trade-card trade-card-primary">
          <div class="trade-label">Activation Layer</div>
          <h3>1. First NWP scan</h3>
          <p>
            The first scan creates a seller-side activation moment. A smartphone,
            a member relationship, a timestamp, and geo-location come together to
            begin the processing trail.
          </p>
          <div class="trade-tag-row">
            <span class="trade-tag">Device to device</span>
            <span class="trade-tag">Face to face</span>
            <span class="trade-tag">Timestamped</span>
          </div>
        </article>

        <article class="trade-card">
          <div class="trade-label">Verification Layer</div>
          <h3>2. Proof of delivery</h3>
          <p>
            Trade value gains weight when delivery is confirmed in the real world.
            This endorsement shows that value was actually moved, received, or
            fulfilled rather than merely promised.
          </p>
          <div class="trade-tag-row">
            <span class="trade-tag">Verified event</span>
            <span class="trade-tag">Seller endorsed</span>
          </div>
        </article>

        <article class="trade-card">
          <div class="trade-label">Maturity Layer</div>
          <h3>3. Time for maturity</h3>
          <p>
            The trade event is not treated as instantly settled. It matures over
            time, which gives the record accountability, patience, and economic
            structure before YAM JAM value is processed.
          </p>
          <div class="trade-tag-row">
            <span class="trade-tag">Time-based</span>
            <span class="trade-tag">Accountable value</span>
          </div>
        </article>
      </div>

      <div class="trade-band">
        <div class="trade-band-left">
          <span class="trade-mini-kicker">Simple Formula</span>
          <h3>NWP Scan + Proof of Delivery + Maturity = Trade Value</h3>
          <p>
            This is how a phone begins functioning like a community-owned payment
            rail. Instead of relying only on centralized card rails, the member
            processes value through verified participation.
          </p>
        </div>
        <div class="trade-band-right">
          <div class="trade-metric">
            <strong>Seller Types</strong>
            <span>Individual · POC · Guild</span>
          </div>
          <div class="trade-metric">
            <strong>Validation</strong>
            <span>Time · Geo · Delivery</span>
          </div>
          <div class="trade-metric">
            <strong>Purpose</strong>
            <span>YAM JAM processing</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yamjam-tutorial" id="how-it-works">
    <div class="yamjam-container">

      <div class="yamjam-header">
        <span class="yamjam-kicker">How Money Works (Tutorial)</span>
        <h2>Separate money from trade value — and everything becomes clear</h2>
        <p>
          Most people think money and value are the same thing. They are not.
          <strong>YAM JAM — You And Me, Just Alternative Money</strong> is a simple
          game that uses your smartphone to show how <strong>community value is built
          first</strong>, and money comes later.
        </p>
      </div>

      <div class="yamjam-grid">
        <article class="yamjam-card">
          <div class="yamjam-number">1</div>
          <h3>Trade value happens first</h3>
          <p>
            When people exchange goods, services, time, or presence, value is created.
            This happens whether or not money moves. Trade value is real-world activity.
          </p>
        </article>

        <article class="yamjam-card">
          <div class="yamjam-number">2</div>
          <h3>Money is just a settlement layer</h3>
          <p>
            Fiat and crypto are tools used later to settle value. They do not create
            the value itself. They only measure and transfer it after the fact.
          </p>
        </article>

        <article class="yamjam-card yamjam-card-highlight">
          <div class="yamjam-number">3</div>
          <h3>YAM JAM tracks value without moving money</h3>
          <p>
            The YAM JAM game separates these two layers. Your smartphone records
            participation and trade activity without requiring fiat or crypto to move.
          </p>
        </article>
      </div>

      <div class="yamjam-flow">
        <div class="yamjam-flow-left">
          <span class="yamjam-mini-kicker">The Game Mechanic</span>
          <h3>Smartphone + NWP + Time = Community Value</h3>
          <p>
            Instead of paying instantly, YAM JAM uses a futures-style model.
            Trade value is recorded today and becomes economically meaningful
            after an <strong>8–12 week maturity period</strong>.
          </p>
        </div>

        <div class="yamjam-flow-right">
          <div class="yamjam-step">
            <strong>Step 1</strong>
            <span>Scan NWP (New World Penny)</span>
          </div>
          <div class="yamjam-step">
            <strong>Step 2</strong>
            <span>Record participation (proof of delivery)</span>
          </div>
          <div class="yamjam-step">
            <strong>Step 3</strong>
            <span>Hold as future value (8–12 weeks)</span>
          </div>
          <div class="yamjam-step yamjam-step-highlight">
            <strong>Step 4</strong>
            <span>Becomes usable trade value</span>
          </div>
        </div>
      </div>

      <div class="yamjam-nwp">
        <div class="yamjam-nwp-copy">
          <span class="yamjam-mini-kicker">Human Value Layer</span>
          <h3>NWP is privately issued gratitude + validation</h3>
          <p>
            A <strong>New World Penny (NWP)</strong> is not money. It is a signal.
            It says: <strong>“this happened”</strong> and <strong>“this mattered.”</strong>
          </p>
          <p>
            When issued, it performs two roles:
          </p>
          <ul>
            <li><strong>Gratitude:</strong> human acknowledgment of value</li>
            <li><strong>Validation:</strong> proof that a real exchange occurred</li>
          </ul>
        </div>

        <div class="yamjam-nwp-points">
          <div class="yamjam-point">
            <strong>Individual NWP</strong>
            <span>“You mean something to me” — highest value</span>
          </div>
          <div class="yamjam-point">
            <strong>POC NWP</strong>
            <span>5-seller group benefits from participation</span>
          </div>
          <div class="yamjam-point">
            <strong>Guild NWP</strong>
            <span>Default community-wide thanks</span>
          </div>
        </div>
      </div>

      <div class="yamjam-summary">
        <div class="yamjam-summary-copy">
          <span class="yamjam-mini-kicker">What You Learn</span>
          <h3>This is a futures-based model of how economies really work</h3>
          <p>
            In traditional finance, futures trading allows value today to settle later.
            YAM JAM applies the same principle to human activity:
          </p>
          <p>
            <strong>Participation today becomes collateral for value tomorrow.</strong>
          </p>
        </div>

        <div class="yamjam-summary-box">
          <div class="yamjam-summary-item">
            <strong>No fiat required</strong>
            <span>Value tracked without cash movement</span>
          </div>
          <div class="yamjam-summary-item">
            <strong>No crypto required</strong>
            <span>Device-driven validation instead</span>
          </div>
          <div class="yamjam-summary-item yamjam-summary-item-highlight">
            <strong>Human-first economics</strong>
            <span>Participation becomes measurable value</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="processing-flow" id="processing-flow">
    <div class="flow-container">
      <div class="flow-header">
        <span class="flow-kicker">See the Processing Flow</span>
        <h2>How a smartphone becomes an NWP processing center</h2>
        <p>
          The processing flow begins with a face-to-face NWP encounter and moves
          through registration, seller identity, proof of delivery, and time for
          maturity. This is how a member-owned smartphone starts functioning like a
          Visa or Mastercard-style community processing rail for YAM JAM trade value.
        </p>
      </div>

      <div class="flow-timeline">
        <div class="flow-line"></div>

        <article class="flow-step">
          <div class="flow-icon">1</div>
          <div class="flow-card">
            <span class="flow-label">Activation</span>
            <h3>Accept your first NWP face to face</h3>
            <p>
              A member, POC seller, or guild representative introduces you to the
              network through a real-world encounter. The first NWP scan begins the
              device-to-device activation process.
            </p>
            <div class="flow-tags">
              <span>Real person</span>
              <span>Real place</span>
              <span>Real time</span>
            </div>
          </div>
        </article>

        <article class="flow-step">
          <div class="flow-icon">2</div>
          <div class="flow-card">
            <span class="flow-label">Registration</span>
            <h3>Register your smartphone and identity</h3>
            <p>
              Your phone becomes part of the human blockchain through device
              registration, timestamp validation, geo-location, and referral linkage.
            </p>
            <div class="flow-tags">
              <span>Device linked</span>
              <span>Geo validated</span>
              <span>Timestamped</span>
            </div>
          </div>
        </article>

        <article class="flow-step">
          <div class="flow-icon">3</div>
          <div class="flow-card">
            <span class="flow-label">Gateway</span>
            <h3>Connect your QRtiger v-card</h3>
            <p>
              Your QRtiger v-card becomes your portable seller gateway in digital or
              printed form, allowing your phone to act as your visible processing identity.
            </p>
            <div class="flow-tags">
              <span>Digital</span>
              <span>Printed</span>
              <span>Seller identity</span>
            </div>
          </div>
        </article>

        <article class="flow-step">
          <div class="flow-icon">4</div>
          <div class="flow-card">
            <span class="flow-label">Endorsement</span>
            <h3>Confirm proof of delivery</h3>
            <p>
              Proof of delivery shows that value actually moved in the real world.
              This endorsement gives the transaction credibility beyond simple intent.
            </p>
            <div class="flow-tags">
              <span>Verified movement</span>
              <span>Seller endorsed</span>
              <span>Human blockchain record</span>
            </div>
          </div>
        </article>

        <article class="flow-step">
          <div class="flow-icon">5</div>
          <div class="flow-card">
            <span class="flow-label">Maturity</span>
            <h3>Allow time for maturity</h3>
            <p>
              The trade record matures over time before becoming eligible for YAM JAM
              processing. Time gives the transaction accountability and economic discipline.
            </p>
            <div class="flow-tags">
              <span>Patience</span>
              <span>Accountability</span>
              <span>Eligible value</span>
            </div>
          </div>
        </article>

        <article class="flow-step">
          <div class="flow-icon">6</div>
          <div class="flow-card">
            <span class="flow-label">Processing</span>
            <h3>Process trade value like a community payment rail</h3>
            <p>
              Once validated and matured, your smartphone can serve as a member-owned
              processing center for individual, POC, or guild seller activity inside
              the YAM JAM system.
            </p>
            <div class="flow-tags">
              <span>Individual</span>
              <span>POC</span>
              <span>Guild</span>
            </div>
          </div>
        </article>
      </div>

      <div class="flow-summary">
        <div class="flow-summary-left">
          <span class="flow-summary-kicker">Simple View</span>
          <h3>NWP Scan → Registration → Delivery Proof → Maturity → Trade Value</h3>
          <p>
            The smartphone becomes more than a communication device. It becomes a
            trusted instrument for onboarding, validation, and community commerce.
          </p>
        </div>

        <div class="flow-summary-right">
          <div class="flow-mini-card">
            <strong>Join Gracebook</strong>
            <span>Enter the member network</span>
          </div>
          <div class="flow-mini-card">
            <strong>Register QRtiger v-card</strong>
            <span>Activate your seller gateway</span>
          </div>
          <div class="flow-mini-card flow-mini-card-highlight">
            <strong>Build trade value</strong>
            <span>Process YAM JAM through maturity</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="seller-types" id="seller-types">
    <div class="seller-container">
      <div class="seller-header">
        <span class="seller-kicker">Seller Types</span>
        <h2>Three seller paths. Three meanings of thanks. One human blockchain.</h2>
        <p>
          NWP processing is not only about seller identity. It also communicates
          the <strong>meaning of appreciation</strong>. A guild-issued NWP reflects
          community thanks at the default level. A Patron Organizing Community
          reflects the benefit of coordinated 5-seller participation. The
          <strong>highest human value remains personal</strong>: when an individual
          issues an NWP directly, the message is simple —
          <strong>“you mean something to me.”</strong>
        </p>
      </div>

      <div class="seller-grid">
        <article class="seller-card seller-card-personal">
          <div class="seller-badge seller-badge-personal">Highest Human Value</div>
          <h3>Individual Seller</h3>
          <p class="seller-lead">
            An individually issued NWP is the most personal form of recognition.
            It says, directly and clearly, <strong>“you mean something to me.”</strong>
            This is not generic gratitude. It is a human-to-human acknowledgment.
          </p>

          <div class="seller-message-box">
            <span class="seller-message-label">Meaning</span>
            <p>
              Personal issuance turns a penny into a human treasure. Over time,
              collected individual pennies become a record of meaningful encounters,
              kindness, and remembered value.
            </p>
          </div>

          <ul class="seller-list">
            <li>Most personal seller endorsement</li>
            <li>Direct device-to-device appreciation</li>
            <li>Strongest emotional and relational value</li>
            <li>Individual pennies become human treasures</li>
          </ul>

          <div class="seller-footer">
            <span>Use case</span>
            <strong>direct relationships, personal recognition, cherished encounters</strong>
          </div>
        </article>

        <article class="seller-card seller-card-poc">
          <div class="seller-badge seller-badge-poc">5-Seller Benefit Layer</div>
          <h3>Patron Organizing Community</h3>
          <p class="seller-lead">
            A Patron Organizing Community is a <strong>group of 5 sellers</strong>
            working together. A POC-issued NWP means your participation benefits
            the group and helps strengthen the shared value created by the seller circle.
          </p>

          <div class="seller-message-box">
            <span class="seller-message-label">Meaning</span>
            <p>
              This form of issuance says that your involvement matters to a local
              team. Your presence supports a coordinated structure where five sellers
              benefit from participation and shared activity.
            </p>
          </div>

          <ul class="seller-list">
            <li>Built around a 5-seller organizing structure</li>
            <li>Your participation benefits the group</li>
            <li>Community recognition with local social meaning</li>
            <li>Ideal for organized grassroots activity</li>
          </ul>

          <div class="seller-footer">
            <span>Use case</span>
            <strong>local group coordination, shared rewards, organized participation</strong>
          </div>
        </article>

        <article class="seller-card seller-card-guild">
          <div class="seller-badge seller-badge-guild">Default Community Thanks</div>
          <h3>Guild Seller</h3>
          <p class="seller-lead">
            A guild-issued NWP represents <strong>community thanks in its default form</strong>.
            It is broad, inclusive appreciation from the wider network rather than a deeply
            personal one-to-one expression.
          </p>

          <div class="seller-message-box">
            <span class="seller-message-label">Meaning</span>
            <p>
              Guild issuance says: the community sees you, values your presence,
              and thanks you as part of the larger whole. It is the standard layer
              of appreciation that helps scale the network.
            </p>
          </div>

          <ul class="seller-list">
            <li>Default issuance for wider community appreciation</li>
            <li>Broadest recognition across the network</li>
            <li>Scales gratitude beyond one person or one local group</li>
            <li>Best for campaigns, teams, and shared identity</li>
          </ul>

          <div class="seller-footer">
            <span>Use case</span>
            <strong>network-wide thanks, guild identity, broad participation</strong>
          </div>
        </article>
      </div>

      <div class="seller-summary-band">
        <div class="seller-summary-intro">
          <span class="seller-summary-kicker">Value Hierarchy</span>
          <h3>Guild thanks is default. POC thanks is group benefit. Personal thanks is highest.</h3>
          <p>
            The NWP seller path teaches members that not all gratitude carries the
            same meaning. Guild-issued NWP expresses community-wide thanks. POC-issued
            NWP reflects benefit flowing through a 5-seller structure. Individual
            issuance remains the rarest and most treasured form because it says,
            plainly, <strong>you matter to me personally</strong>.
          </p>
        </div>

        <div class="seller-summary-stack">
          <div class="seller-summary-item">
            <strong>Guild</strong>
            <span>Default community thanks</span>
          </div>
          <div class="seller-summary-item">
            <strong>POC</strong>
            <span>5-seller group benefit</span>
          </div>
          <div class="seller-summary-item seller-summary-item-highlight">
            <strong>Individual</strong>
            <span>Highest-value personal meaning</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="why-it-matters">
    <div class="container">
      <div class="section-head">
        <div class="kicker">Why It Matters</div>
        <h2>A smartphone processing center instead of a card terminal</h2>
        <p>
          This model teaches members to see their phones as instruments of verification, onboarding, and community commerce. Rather than relying only on distant financial institutions, members learn how to process trade value through visible, ethical, and time-stamped participation.
        </p>
      </div>

      <div class="feature-grid">
        <div class="card">
          <h3>Visa/Mastercard-like logic</h3>
          <p>Your phone acts like a payment endpoint, except the processing basis is proof of participation, delivery confirmation, and maturity rather than only card authorization.</p>
        </div>
        <div class="card">
          <h3>Human blockchain ethos</h3>
          <p>Every first activation starts with face-to-face accountability. Even digital credentials remain grounded in time, place, and validated member identity.</p>
        </div>
        <div class="card">
          <h3>QRtiger identity rail</h3>
          <p>Your QRtiger v-card serves as the portable seller gateway for digital or printed credential use across NWP and future YAM JAM flows.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="why-register" id="why-register">
    <div class="why-register-container">
      <div class="why-register-header">
        <span class="why-register-kicker">Why Register?</span>
        <h2>Your phone is not becoming a machine. It is becoming a tool that proves your participation mattered.</h2>
        <p>
          Most people hesitate when asked to register a v-card, download Discord,
          or “become a processing device.” That hesitation is normal. YAM JAM —
          <strong>You And Me, Just Alternative Money</strong> — is a proof of concept
          designed to show something simple: your presence, your delivery, and your
          participation have value.
        </p>
      </div>

      <div class="why-register-grid">
        <article class="why-register-card why-register-card-highlight">
          <div class="why-register-icon">1</div>
          <h3>Claim your place in the network</h3>
          <p>
            Registration is not about surrendering control. It is about claiming a
            visible place in a people-powered value network where your activity can
            be recognized and remembered.
          </p>
        </article>

        <article class="why-register-card">
          <div class="why-register-icon">2</div>
          <h3>Create your personal QR gateway</h3>
          <p>
            Your QRtiger v-card is your identity gateway. It allows others to
            recognize you, thank you, and connect future NWP and YAM JAM activity
            to your real participation.
          </p>
        </article>

        <article class="why-register-card">
          <div class="why-register-icon">3</div>
          <h3>Join Gracebook, not “just another app”</h3>
          <p>
            Discord becomes Gracebook in this proof of concept: a gathering place
            where participation is seen, relationships are formed, and the community
            around your activity becomes visible.
          </p>
        </article>
      </div>

      <div class="why-register-band">
        <div class="why-register-band-copy">
          <span class="why-register-mini-kicker">What This Really Means</span>
          <h3>Most systems track spending. YAM JAM tracks participation.</h3>
          <p>
            Your smartphone already connects you to money, messages, and markets.
            YAM JAM adds one more possibility: it helps your phone record that you
            showed up, helped, delivered, received, supported, or mattered in a real
            human encounter.
          </p>
        </div>

        <div class="why-register-band-points">
          <div class="why-register-point">
            <strong>QRtiger v-card</strong>
            <span>Claim your personal identity gateway</span>
          </div>
          <div class="why-register-point">
            <strong>Gracebook</strong>
            <span>Join the community where participation lives</span>
          </div>
          <div class="why-register-point why-register-point-highlight">
            <strong>YAM JAM</strong>
            <span>Use your phone to prove human value</span>
          </div>
        </div>
      </div>

      <div class="why-register-steps">
        <div class="why-register-steps-header">
          <span class="why-register-mini-kicker">Simple Onboarding</span>
          <h3>Start small. One scan at a time.</h3>
        </div>

        <div class="why-register-step-grid">
          <article class="why-register-step">
            <div class="why-register-step-number">1</div>
            <h4>Accept your first NWP</h4>
            <p>
              Start with one face-to-face encounter. No heavy commitment up front.
            </p>
          </article>

          <article class="why-register-step">
            <div class="why-register-step-number">2</div>
            <h4>See why it matters</h4>
            <p>
              Understand that the message behind the scan is simple: your participation has value.
            </p>
          </article>

          <article class="why-register-step">
            <div class="why-register-step-number">3</div>
            <h4>Register your QR gateway</h4>
            <p>
              Create your QRtiger v-card so your identity can travel with you.
            </p>
          </article>

          <article class="why-register-step">
            <div class="why-register-step-number">4</div>
            <h4>Join Gracebook</h4>
            <p>
              Connect to the member network where your activity can grow into something bigger.
            </p>
          </article>
        </div>
      </div>

      <div class="why-register-cta">
        <div class="why-register-cta-copy">
          <span class="why-register-mini-kicker">The Real Promise</span>
          <h3>We are not asking you to become technology.</h3>
          <p>
            We are asking you to use technology to show that your human value can
            be seen, shared, and appreciated.
          </p>
        </div>

        <div class="why-register-cta-actions">
          <a href="#join" class="why-register-btn why-register-btn-primary">Join Gracebook</a>
          <a href="#register-vcard" class="why-register-btn why-register-btn-secondary">Register QRtiger v-card</a>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="join">
    <div class="container">
      <div id="register-vcard" aria-hidden="true"></div>
      <div class="cta-panel">
        <div class="cta-grid">
          <div>
            <div class="kicker">Join the Network</div>
            <h2>Join Gracebook. Register your QRtiger v-card. Activate your processing role.</h2>
            <p>
              Start with your first NWP encounter. Join the Gracebook community, connect your QRtiger v-card, and prepare your smartphone to serve as a trusted processing center for YAM JAM trade value. Whether you serve as an individual seller, a Patron Organizing Community member, or part of a guild, your device becomes part of a shared economic rail endorsed by proof of delivery and time for maturity.
            </p>
            <div class="hero-actions">
              <a class="btn btn-primary" href="#join">Join Gracebook Now</a>
              <a class="btn btn-secondary" href="#register-vcard">Register QRtiger v-card</a>
            </div>
          </div>
          <div class="mini-list">
            <div class="mini-item"><strong>1.</strong> Accept your first NWP face to face</div>
            <div class="mini-item"><strong>2.</strong> Register your device and seller identity</div>
            <div class="mini-item"><strong>3.</strong> Link your QRtiger v-card gateway</div>
            <div class="mini-item"><strong>4.</strong> Build matured, proof-of-delivery-backed trade value</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container footer-box">
      <div>
        <strong>humanblockchain.info</strong><br />
        NWP Processing Center for YAM JAM trade value
      </div>
      <div>
        Built around device registration, QRtiger v-card identity, proof of delivery, and time-based maturity.
      </div>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
