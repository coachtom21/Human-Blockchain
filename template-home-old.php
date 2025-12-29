<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Human Blockchain • United Citizens • Your Voice. Your Choice. Your Treasury.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Human Blockchain is the referral gateway for the United Citizens movement — a voter and consumer controlled clearinghouse that uses 2-scan Proof-of-Delivery on top of Visa/Mastercard rails." />
  <style>
    :root {
      --bg: #050816;
      --bg-alt: #0b1020;
      --accent: #ffb347;
      --accent-soft: rgba(255, 179, 71, 0.1);
      --accent-2: #44ffd2;
      --text-main: #f5f5f7;
      --text-muted: #a0a3b1;
      --border-subtle: #23263a;
      --danger: #ff4b81;
      --radius-xl: 18px;
      --shadow-soft: 0 22px 45px rgba(0, 0, 0, 0.55);
      --font-sans: system-ui, -apple-system, BlinkMacSystemFont, "SF Pro Text", "Inter", sans-serif;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--font-sans);
      background: radial-gradient(circle at top, #161b37 0, #050816 55%, #02030a 100%);
      color: var(--text-main);
      min-height: 100vh;
      line-height: 1.6;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    img {
      max-width: 100%;
      display: block;
    }

    /* Layout */
    .page {
      max-width: 1180px;
      margin: 0 auto;
      padding: 1.5rem 1.25rem 4rem;
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      padding: 0.75rem 1rem 1.5rem;
      position: sticky;
      top: 0;
      z-index: 20;
      backdrop-filter: blur(16px);
      background: linear-gradient(to bottom, rgba(5, 8, 22, 0.96), rgba(5, 8, 22, 0.7), transparent);
    }

    .logo-block {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .logo-icon {
      width: 40px;
      height: 40px;
      border-radius: 999px;
      border: 1px solid var(--border-subtle);
      background: radial-gradient(circle at 30% 0%, var(--accent) 0, #140b30 45%, #050816 100%);
      box-shadow: 0 0 20px rgba(255, 179, 71, 0.35);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .logo-text {
      display: flex;
      flex-direction: column;
      gap: 0.1rem;
    }

    .logo-title {
      font-size: 0.95rem;
      font-weight: 600;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .logo-sub {
      font-size: 0.78rem;
      color: var(--text-muted);
    }

    nav {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      font-size: 0.9rem;
    }

    .nav-link {
      position: relative;
      padding-bottom: 0.2rem;
      cursor: pointer;
      color: var(--text-muted);
    }

    .nav-link:hover {
      color: var(--text-main);
    }

    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, var(--accent), var(--accent-2));
      transition: width 0.2s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .nav-cta {
      padding: 0.45rem 0.9rem;
      border-radius: 999px;
      border: 1px solid rgba(255, 179, 71, 0.7);
      background: radial-gradient(circle at top left, var(--accent-soft), rgba(4, 7, 23, 0.9));
      font-size: 0.85rem;
      font-weight: 500;
      color: var(--accent);
      display: flex;
      align-items: center;
      gap: 0.35rem;
      cursor: pointer;
      box-shadow: 0 0 0 rgba(255, 179, 71, 0.25);
      transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
    }

    .nav-cta:hover {
      transform: translateY(-1px);
      box-shadow: 0 10px 18px rgba(0, 0, 0, 0.5);
      background: radial-gradient(circle at top left, rgba(255, 179, 71, 0.18), rgba(4, 7, 23, 0.96));
    }

    /* Hamburger Menu */
    .hamburger {
      display: none;
      flex-direction: column;
      justify-content: space-around;
      width: 28px;
      height: 28px;
      background: transparent;
      border: none;
      cursor: pointer;
      padding: 0;
      z-index: 25;
      position: relative;
    }

    .hamburger span {
      width: 100%;
      height: 2px;
      background: var(--text-main);
      border-radius: 2px;
      transition: all 0.3s ease;
      transform-origin: center;
    }

    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translate(6px, 6px);
    }

    .hamburger.active span:nth-child(2) {
      opacity: 0;
      transform: translateX(-10px);
    }

    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translate(6px, -6px);
    }

    /* Close button inside menu */
    .menu-close {
      display: none;
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      width: 32px;
      height: 32px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      cursor: pointer;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      color: var(--text-main);
      z-index: 101;
      transition: all 0.2s ease;
    }

    .menu-close:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: var(--accent);
      color: var(--accent);
    }

    .menu-close::before {
      content: "×";
      font-size: 1.5rem;
      line-height: 1;
    }

    .menu-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(2, 4, 12, 0.85);
      z-index: 99;
      backdrop-filter: blur(4px);
    }

    .menu-overlay.active {
      display: block;
    }

    /* Hero */
    .hero {
      display: grid;
      grid-template-columns: minmax(0, 2.1fr) minmax(0, 1.6fr);
      gap: 2.5rem;
      margin-top: 1.5rem;
      align-items: center;
    }

    .hero-heading {
      font-size: clamp(2.1rem, 4vw, 2.7rem);
      font-weight: 700;
      letter-spacing: 0.02em;
    }

    .hero-highlight {
      background: linear-gradient(120deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.25rem 0.7rem;
      border-radius: 999px;
      background: rgba(16, 24, 64, 0.8);
      border: 1px solid rgba(68, 255, 210, 0.25);
      font-size: 0.78rem;
      color: var(--accent-2);
      margin-bottom: 0.75rem;
    }

    .hero-tag span.label {
      padding: 0.08rem 0.5rem;
      border-radius: 999px;
      background: rgba(68, 255, 210, 0.12);
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.09em;
    }

    .hero-body {
      margin-top: 0.9rem;
      font-size: 0.98rem;
      color: var(--text-muted);
      max-width: 32rem;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      margin-top: 1.5rem;
      align-items: center;
    }

    .btn-primary {
      border: none;
      outline: none;
      cursor: pointer;
      padding: 0.7rem 1.25rem;
      border-radius: 999px;
      background: linear-gradient(135deg, var(--accent), #ff7f50);
      color: #1a1020;
      font-size: 0.9rem;
      font-weight: 600;
      box-shadow: var(--shadow-soft);
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      transition: transform 0.1s ease, box-shadow 0.15s ease;
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 28px 48px rgba(0, 0, 0, 0.7);
    }

    .btn-ghost {
      padding: 0.65rem 1.1rem;
      border-radius: 999px;
      border: 1px solid var(--border-subtle);
      background: rgba(5, 8, 22, 0.6);
      color: var(--text-muted);
      font-size: 0.85rem;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      cursor: pointer;
      transition: border-color 0.15s ease, background 0.15s ease, color 0.15s ease;
    }

    .btn-ghost:hover {
      border-color: rgba(255, 179, 71, 0.4);
      color: var(--text-main);
      background: rgba(15, 21, 52, 0.9);
    }

    .hero-footnote {
      margin-top: 1rem;
      font-size: 0.78rem;
      color: var(--text-muted);
    }

    .hero-footnote span {
      color: var(--accent-2);
      font-weight: 500;
    }

    /* Hero card - Scan Visualization */
    .hero-card {
      border-radius: 24px;
      background: radial-gradient(circle at top, rgba(255, 179, 71, 0.09) 0, rgba(8, 12, 35, 0.97) 45%, #040516 100%);
      border: 1px solid rgba(255, 255, 255, 0.04);
      box-shadow: var(--shadow-soft);
      padding: 1.5rem 1.4rem;
      position: relative;
      overflow: hidden;
    }

    .hero-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 0 0, rgba(68, 255, 210, 0.08), transparent 55%);
      pointer-events: none;
    }

    .hero-card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.1rem;
    }

    .hero-card-title {
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.16em;
      color: var(--text-muted);
    }

    .badge-live {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      padding: 0.15rem 0.6rem;
      border-radius: 999px;
      background: rgba(18, 189, 131, 0.14);
      color: var(--accent-2);
      font-size: 0.78rem;
    }

    .badge-dot {
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: var(--accent-2);
      box-shadow: 0 0 12px rgba(68, 255, 210, 0.8);
    }

    .scan-flow {
      display: grid;
      grid-template-columns: 1.1fr 1.1fr;
      gap: 1.4rem;
      font-size: 0.78rem;
    }

    .scan-box {
      border-radius: var(--radius-xl);
      padding: 0.9rem 0.8rem;
      background: rgba(4, 8, 28, 0.95);
      border: 1px solid rgba(76, 84, 134, 0.7);
      position: relative;
      overflow: hidden;
    }

    .scan-box h4 {
      font-size: 0.82rem;
      margin-bottom: 0.35rem;
    }

    .scan-meta {
      font-size: 0.72rem;
      color: var(--text-muted);
      margin-bottom: 0.4rem;
    }

    .scan-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      padding: 0.2rem 0.55rem;
      border-radius: 999px;
      background: rgba(68, 255, 210, 0.12);
      color: var(--accent-2);
      font-size: 0.72rem;
      margin-top: 0.35rem;
    }

    .scan-pill.secondary {
      background: rgba(255, 179, 71, 0.15);
      color: var(--accent);
    }

    .scan-connector {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 2.5rem;
      height: 1px;
      background: linear-gradient(90deg, rgba(255, 179, 71, 0.3), rgba(68, 255, 210, 0.7));
      transform: translate(-50%, -50%) rotate(-12deg);
      opacity: 0.9;
    }

    .xp-bar {
      margin-top: 1rem;
      font-size: 0.72rem;
      color: var(--text-muted);
    }

    .xp-bar-track {
      margin-top: 0.25rem;
      width: 100%;
      height: 5px;
      border-radius: 999px;
      background: rgba(31, 41, 88, 0.9);
      overflow: hidden;
    }

    .xp-bar-fill {
      width: 26%;
      height: 100%;
      border-radius: 999px;
      background: linear-gradient(90deg, var(--accent-2), var(--accent));
      box-shadow: 0 0 12px rgba(68, 255, 210, 0.5);
    }

    .hero-card-foot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1rem;
      font-size: 0.78rem;
      color: var(--text-muted);
    }

    .hero-card-foot span.strong {
      color: var(--accent);
      font-weight: 500;
    }

    /* Sections */
    section {
      margin-top: 3.2rem;
    }

    .section-label {
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
      color: var(--accent-2);
      margin-bottom: 0.4rem;
    }

    .section-title {
      font-size: 1.35rem;
      font-weight: 600;
      margin-bottom: 0.55rem;
    }

    .section-body {
      font-size: 0.95rem;
      color: var(--text-muted);
      max-width: 42rem;
    }

    .grid-two {
      display: grid;
      grid-template-columns: minmax(0, 1.2fr) minmax(0, 1.5fr);
      gap: 2.5rem;
      align-items: flex-start;
    }

    .card {
      border-radius: var(--radius-xl);
      background: rgba(5, 9, 30, 0.98);
      border: 1px solid rgba(42, 53, 110, 0.85);
      padding: 1.2rem 1.1rem;
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.75);
    }

    .card-header {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.5rem;
    }

    .card-tag {
      font-size: 0.78rem;
      color: var(--accent-2);
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .chip-row {
      display: flex;
      flex-wrap: wrap;
      gap: 0.4rem;
      margin-top: 0.9rem;
    }

    .chip {
      font-size: 0.75rem;
      padding: 0.25rem 0.55rem;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      background: rgba(5, 10, 33, 0.98);
      color: var(--text-muted);
    }

    .list {
      margin-top: 0.4rem;
      padding-left: 1.1rem;
      font-size: 0.9rem;
      color: var(--text-muted);
    }

    .list li {
      margin-bottom: 0.25rem;
    }

    .inline-highlight {
      color: var(--accent);
      font-weight: 500;
    }

    /* PoD Modal */
    .modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(2, 4, 12, 0.85);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 50;
    }

    .modal {
      width: 100%;
      max-width: 420px;
      border-radius: 20px;
      background: radial-gradient(circle at top, rgba(255, 179, 71, 0.16), #040616 45%, #040414 100%);
      border: 1px solid rgba(255, 255, 255, 0.06);
      padding: 1.4rem 1.3rem 1.05rem;
      box-shadow: 0 26px 60px rgba(0, 0, 0, 0.85);
      position: relative;
    }

    .modal-heading {
      font-size: 1.05rem;
      font-weight: 600;
      margin-bottom: 0.4rem;
    }

    .modal-sub {
      font-size: 0.86rem;
      color: var(--text-muted);
      margin-bottom: 0.9rem;
    }

    .modal-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 0.5rem;
      margin-top: 0.7rem;
    }

    .btn-small {
      font-size: 0.8rem;
      padding: 0.45rem 0.9rem;
      border-radius: 999px;
      cursor: pointer;
      border: 1px solid var(--border-subtle);
      background: rgba(3, 6, 20, 0.9);
      color: var(--text-muted);
      transition: 0.15s ease;
    }

    .btn-small:hover {
      border-color: rgba(255, 179, 71, 0.5);
      color: var(--text-main);
      background: rgba(12, 17, 47, 0.96);
    }

    .btn-small.primary {
      border-color: rgba(255, 179, 71, 0.8);
      background: linear-gradient(135deg, var(--accent), #ff7f50);
      color: #1a1020;
      font-weight: 600;
    }

    .modal-footer-note {
      margin-top: 0.65rem;
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    .modal-footer-note span {
      color: var(--accent-2);
    }

    .modal-close {
      position: absolute;
      top: 0.75rem;
      right: 0.9rem;
      font-size: 1rem;
      color: var(--text-muted);
      cursor: pointer;
    }

    .modal-step-label {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.14em;
      color: var(--accent-2);
      margin-bottom: 0.35rem;
    }

    .modal-destination-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      font-size: 0.78rem;
      padding: 0.2rem 0.5rem;
      border-radius: 999px;
      border: 1px dashed rgba(255, 255, 255, 0.12);
      color: var(--text-muted);
      margin-bottom: 0.5rem;
    }

    .modal-result {
      margin-top: 0.4rem;
      font-size: 0.86rem;
      color: var(--accent-2);
      display: none;
    }

    .modal-result strong {
      color: var(--accent);
    }

    /* Loader */
    .modal-loader {
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      padding: 2rem 1rem;
      margin-top: 0.4rem;
    }

    .modal-loader.active {
      display: flex;
    }

    .loader {
      width: 40px;
      aspect-ratio: 1;
      display: flex;
    }

    .loader:before,
    .loader:after {
      content: "";
      flex: 1;
      background: var(--accent);
      animation: l21 2s infinite;
      border-radius: 100px 0 0 100px;
      transform-origin: top right;
      transform: translateY(calc(var(--s,1)*0%)) rotate(0);
    }

    .loader:after {
      transform-origin: bottom left;
      border-radius: 0 100px 100px 0;
      --s:-1;
    }

    @keyframes l21 {
      33%  {transform: translate(0,calc(var(--s,1)*50%)) rotate(0)}
      66%  {transform: translate(0,calc(var(--s,1)*50%)) rotate(-90deg)}
      90%,
      100% {transform: translate(calc(var(--s,1)*-100%),calc(var(--s,1)*50%))  rotate(-90deg)}
    }

    .loader-text {
      font-size: 0.85rem;
      color: var(--text-muted);
      text-align: center;
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
    }

    .entry-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .entry-modal {
      width: min(880px, 92%);
      background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.06));
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: var(--radius-xl);
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
      padding: 28px;
      transform: scale(0.95);
      transition: transform 0.3s ease;
    }

    .entry-overlay.active .entry-modal {
      transform: scale(1);
    }

    .entry-modal h1 {
      margin: 0 0 12px;
      font-size: 28px;
      letter-spacing: -0.02em;
      color: var(--text-main);
    }

    .entry-modal p {
      color: var(--text-muted);
      line-height: 1.6;
      max-width: 60ch;
      margin: 0;
    }

    .enter-btn {
      margin-top: 22px;
      padding: 14px 22px;
      font-size: 15px;
      font-weight: 700;
      border-radius: 14px;
      border: 1px solid rgba(255, 255, 255, 0.14);
      background: rgba(255, 255, 255, 0.14);
      color: var(--text-main);
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .enter-btn:hover {
      background: rgba(255, 255, 255, 0.20);
      border-color: var(--accent);
      transform: translateY(-1px);
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
    }

    .pod-gate-overlay.active {
      display: grid;
      opacity: 1;
      visibility: visible;
    }

    .pod-gate-modal {
      width: min(880px, 92%);
      background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.06));
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: var(--radius-xl);
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
      padding: 28px;
      transform: scale(0.95);
      transition: transform 0.3s ease;
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

    .pod-gate-modal h2 {
      margin: 0;
      font-size: 26px;
      color: var(--text-main);
    }

    .pod-gate-sub {
      margin-top: 10px;
      color: var(--text-muted);
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
      color: var(--text-main);
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

    .statement-box strong {
      color: var(--text-main);
    }

    .statement-box p {
      margin: 0;
      font-size: 13px;
      line-height: 1.7;
      color: var(--text-muted);
    }

    .modal-footer {
      margin-top: 18px;
      font-size: 12px;
      color: var(--text-muted);
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    /* Footer */
    footer {
      margin-top: 3rem;
      padding-top: 1.5rem;
      border-top: 1px solid rgba(29, 35, 72, 0.85);
      font-size: 0.78rem;
      color: var(--text-muted);
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      justify-content: space-between;
      align-items: center;
    }

    footer a {
      color: var(--accent-2);
      font-size: 0.78rem;
    }

    /* Responsive Design */
    /* Large Tablets and Small Desktops */
    @media (max-width: 1024px) {
      .page {
        padding: 1.25rem 1rem 3rem;
      }
      .hero {
        gap: 2rem;
      }
      .grid-two {
        gap: 2rem;
      }
    }

    /* Tablets */
    @media (max-width: 900px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        padding-inline: 0;
        gap: 1rem;
      }
      nav {
        flex-wrap: wrap;
        padding-left: 0;
        gap: 0.9rem;
        font-size: 0.85rem;
      }
      .nav-link {
        padding: 0.3rem 0;
      }
      .nav-cta {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
      }
      .hero {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.5rem;
      }
      .hero-heading {
        font-size: clamp(1.8rem, 5vw, 2.4rem);
      }
      .hero-body {
        font-size: 0.92rem;
      }
      .section {
        margin-top: 2.5rem;
      }
      .grid-two {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.5rem;
      }
      .scan-flow {
        grid-template-columns: 1fr;
        gap: 1rem;
      }
      .scan-connector {
        display: none;
      }
      .modal {
        max-width: 90%;
        margin: 1rem;
      }
    }

    /* Small Tablets and Large Phones */
    @media (max-width: 768px) {
      .page {
        padding: 1rem 0.9rem 2.5rem;
      }
      .logo-icon {
        width: 36px;
        height: 36px;
        font-size: 0.8rem;
      }
      .logo-title {
        font-size: 0.88rem;
      }
      .logo-sub {
        font-size: 0.72rem;
      }
      .hamburger {
        display: flex;
      }
      nav {
        position: fixed;
        top: 0;
        right: -100%;
        width: 280px;
        height: 100vh;
        background: linear-gradient(135deg, rgba(5, 8, 22, 0.98), rgba(11, 16, 32, 0.98));
        backdrop-filter: blur(20px);
        flex-direction: column;
        align-items: flex-start;
        padding: 5rem 1.5rem 2rem;
        gap: 1.5rem;
        font-size: 0.9rem;
        box-shadow: -4px 0 20px rgba(0, 0, 0, 0.5);
        transition: right 0.3s ease;
        z-index: 100;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
      }
      nav.active {
        right: 0;
      }
      nav.active .menu-close {
        display: flex;
      }
      .nav-link {
        width: 100%;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      }
      .nav-link::after {
        display: none;
      }
      .nav-cta {
        margin-top: 0.5rem;
        width: 100%;
        justify-content: center;
        padding: 0.7rem 1rem;
      }
      .hero {
        margin-top: 1rem;
      }
      .hero-heading {
        font-size: clamp(1.6rem, 6vw, 2.2rem);
        line-height: 1.3;
      }
      .hero-body {
        font-size: 0.9rem;
        margin-top: 0.75rem;
      }
      .hero-actions {
        margin-top: 1.25rem;
        gap: 0.65rem;
      }
      .btn-primary,
      .btn-ghost {
        font-size: 0.85rem;
        padding: 0.65rem 1.1rem;
      }
      .hero-card {
        padding: 1.25rem 1.1rem;
        margin-top: 1rem;
      }
      .section-title {
        font-size: 1.2rem;
      }
      .section-body {
        font-size: 0.9rem;
      }
      .card {
        padding: 1rem 0.9rem;
      }
      footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
      }
    }

    /* Mobile Phones */
    @media (max-width: 640px) {
      .page {
        padding: 0.9rem 0.75rem 2rem;
      }
      header {
        padding: 0.65rem 0 1rem;
      }
      .logo-block {
        gap: 0.6rem;
      }
      .logo-icon {
        width: 32px;
        height: 32px;
        font-size: 0.75rem;
      }
      .logo-title {
        font-size: 0.82rem;
      }
      .logo-sub {
        font-size: 0.68rem;
      }
      nav {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        gap: 0.5rem;
        font-size: 0.8rem;
      }
      .nav-link {
        padding: 0.4rem 0;
        width: 100%;
      }
      .nav-cta {
        width: 100%;
        padding: 0.5rem 0.9rem;
        font-size: 0.78rem;
        margin-top: 0.25rem;
      }
      .hero {
        margin-top: 0.75rem;
      }
      .hero-heading {
        font-size: clamp(1.4rem, 7vw, 2rem);
        line-height: 1.25;
      }
      .hero-tag {
        font-size: 0.72rem;
        padding: 0.2rem 0.6rem;
        margin-bottom: 0.6rem;
      }
      .hero-body {
        font-size: 0.88rem;
        margin-top: 0.65rem;
      }
      .hero-actions {
        flex-direction: column;
        width: 100%;
        margin-top: 1rem;
        gap: 0.6rem;
      }
      .btn-primary,
      .btn-ghost {
        width: 100%;
        justify-content: center;
        font-size: 0.82rem;
        padding: 0.7rem 1rem;
      }
      .hero-footnote {
        font-size: 0.72rem;
        margin-top: 0.75rem;
      }
      .hero-card {
        margin-top: 0.75rem;
        padding: 1.1rem 0.95rem;
        border-radius: 18px;
      }
      .hero-card-title {
        font-size: 0.78rem;
      }
      .scan-flow {
        gap: 0.85rem;
        font-size: 0.72rem;
      }
      .scan-box {
        padding: 0.8rem 0.7rem;
      }
      .scan-box h4 {
        font-size: 0.78rem;
      }
      .scan-meta {
        font-size: 0.68rem;
      }
      .scan-pill {
        font-size: 0.68rem;
        padding: 0.18rem 0.5rem;
      }
      .xp-bar {
        font-size: 0.68rem;
      }
      .hero-card-foot {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.4rem;
        font-size: 0.72rem;
        margin-top: 0.85rem;
      }
      .grid-two {
        grid-template-columns: minmax(0, 1fr);
        gap: 1.25rem;
      }
      .section {
        margin-top: 2rem;
      }
      .section-label {
        font-size: 0.72rem;
      }
      .section-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
      }
      .section-body {
        font-size: 0.88rem;
      }
      .card {
        padding: 0.95rem 0.85rem;
        border-radius: 16px;
      }
      .card-tag {
        font-size: 0.72rem;
      }
      .list {
        font-size: 0.85rem;
        padding-left: 1rem;
      }
      .chip {
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
      }
      .modal {
        max-width: 95%;
        padding: 1.2rem 1rem 0.95rem;
        border-radius: 16px;
      }
      .modal-heading {
        font-size: 0.98rem;
      }
      .modal-sub {
        font-size: 0.8rem;
      }
      .modal-buttons {
        flex-direction: column;
        gap: 0.4rem;
      }
      .btn-small {
        width: 100%;
        justify-content: center;
        font-size: 0.78rem;
        padding: 0.5rem 0.85rem;
      }
      footer {
        font-size: 0.72rem;
        padding-top: 1.25rem;
        margin-top: 2.5rem;
      }
    }

    /* Small Mobile Phones */
    @media (max-width: 480px) {
      .page {
        padding: 0.75rem 0.6rem 1.75rem;
      }
      .hero-heading {
        font-size: clamp(1.3rem, 8vw, 1.8rem);
      }
      .hero-body {
        font-size: 0.85rem;
      }
      .hero-card {
        padding: 1rem 0.85rem;
      }
      .section-title {
        font-size: 1rem;
      }
      .section-body {
        font-size: 0.85rem;
      }
      .modal {
        padding: 1rem 0.9rem 0.85rem;
      }
      .modal-heading {
        font-size: 0.95rem;
      }
      .modal-sub {
        font-size: 0.78rem;
      }
    }

    /* Extra Small Phones */
    @media (max-width: 360px) {
      .page {
        padding: 0.65rem 0.5rem 1.5rem;
      }
      .logo-icon {
        width: 28px;
        height: 28px;
        font-size: 0.7rem;
      }
      .logo-title {
        font-size: 0.75rem;
      }
      .logo-sub {
        font-size: 0.65rem;
      }
      nav {
        font-size: 0.75rem;
      }
      .hero-heading {
        font-size: clamp(1.2rem, 9vw, 1.6rem);
      }
      .btn-primary,
      .btn-ghost {
        font-size: 0.78rem;
        padding: 0.65rem 0.9rem;
      }
    }

    /* Touch-friendly adjustments */
    @media (hover: none) and (pointer: coarse) {
      .nav-link,
      .btn-primary,
      .btn-ghost,
      .btn-small,
      .nav-cta {
        min-height: 44px;
        min-width: 44px;
      }
      .modal-close {
        min-width: 44px;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    }

    /* Landscape orientation adjustments */
    @media (max-width: 900px) and (orientation: landscape) {
      .page {
        padding: 0.75rem 1rem 2rem;
      }
      header {
        padding: 0.5rem 0 0.75rem;
      }
      .hero {
        margin-top: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- ================= ENTRY MODAL ================= -->
  <div class="entry-overlay" id="enterOverlay">
    <div class="entry-modal" id="enterModal">
      <h1>Welcome to HumanBlockchain.info</h1>
      <p>
        This site operates a <strong>non-custodial, proof-based clearing-visibility system</strong>.
        Entering confirms your intent to interact within an independent, device-verified, ledger environment.
      </p>
      <button class="enter-btn" id="enterSite">
        Enter Website
      </button>
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

  <div class="page">
    <!-- HEADER -->
    <header>
      <div class="logo-block">
        <div class="logo-icon">
          HB
        </div>
        <div class="logo-text">
          <div class="logo-title">Human Blockchain</div>
          <div class="logo-sub">Your Voice. Your Choice. Your Treasury.</div>
        </div>
      </div>
      <button class="hamburger" id="hamburger-menu" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="menu-overlay" id="menu-overlay"></div>
      <nav id="main-nav">
        <button class="menu-close" id="menu-close-btn" aria-label="Close menu"></button>
        <a href="#about" class="nav-link">About</a>
        <a href="how-it-works" class="nav-link">How It Works</a>
        <a href="united-citizens" class="nav-link">United Citizens</a>
        <a href="peace-pentagon" class="nav-link">Peace Pentagon</a>
        <a href="serendipity" class="nav-link">Serendipity</a>
        <a href="nil" class="nav-link">NIL</a>
        <a href="faq" class="nav-link">FAQ</a>
        <button class="nav-cta" id="nav-pod-btn">
          Scan Proof-of-Delivery
          <span>›</span>
        </button>
      </nav>
    </header>

    <!-- HERO -->
    <main>
      <section class="hero" id="top">
        <div>
          <div class="hero-tag">
            <span class="label">Welcome</span>
            <span>to the United Citizens movement</span>
          </div>
          <h1 class="hero-heading">
            A <span class="hero-highlight">voter & consumer-controlled</span> alternative to Visa & Mastercard.
          </h1>
          <p class="hero-body">
            <strong>HumanBlockchain.info</strong> is the referral gateway for
            <span class="inline-highlight">United Citizens</span> — a movement that uses
            <strong>YAM-is-On vouchers and hang tags</strong> as measuring sticks of real-world value.
            Two scans of a tag prove delivery, mint XP, and grow the <strong>New World Penny</strong> economy,
            while banks simply settle the fiat in the background.
          </p>
          <div class="hero-actions">
            <button class="btn-primary" id="hero-pod-btn">
              Start Proof-of-Delivery
              <span>⟶</span>
            </button>
            <button class="btn-ghost" onclick="document.getElementById('united-citizens').scrollIntoView({behavior:'smooth'})">
              Learn about United Citizens
            </button>
          </div>
          <div class="hero-footnote">
            Every scan = <span>You And Me, Just Alternative Money (YAM JAM)</span> —
            not speculation, not surveillance capitalism.
          </div>
        </div>

        <!-- Hero Scan Visualization -->
        <div class="hero-card" aria-label="2-scan Proof-of-Delivery visualization">
          <div class="hero-card-header">
            <div class="hero-card-title">2-Scan Proof-of-Delivery</div>
            <div class="badge-live">
              <span class="badge-dot"></span>
              Human blockchain: LIVE
            </div>
          </div>
          <div class="scan-flow">
            <div class="scan-box">
              <h4>Scan #1 – Seller</h4>
              <div class="scan-meta">
                YAM-is-On voucher is attached.<br />
                Seller starts the promise-to-deliver.
              </div>
              <div class="scan-pill secondary">
                📦 “Leaving my hands”
              </div>
              <div class="scan-pill">
                XP seed created (sextillionth of a penny)
              </div>
            </div>
            <div class="scan-box">
              <h4>Scan #2 – Buyer</h4>
              <div class="scan-meta">
                Buyer confirms final delivery.<br />
                Last-mile driver is recognized.
              </div>
              <div class="scan-pill secondary">
                ✅ “Yes, I received this”
              </div>
              <div class="scan-pill">
                YAM JAM $10 trade credit minted
              </div>
            </div>
          </div>
          <div class="scan-connector"></div>
          <div class="xp-bar">
            XP maturity • 8–12 weeks → New World Pennies → fiat settlement on Visa/Mastercard rails through a licensed MSB.
            <div class="xp-bar-track">
              <div class="xp-bar-fill"></div>
            </div>
          </div>
          <div class="hero-card-foot">
            <div>
              <span class="strong">No tag, no scan, no wealth.</span><br />
              The voucher or hang tag is the measuring stick of this economy.
            </div>
            <div>
              Last-mile heroes: <span class="strong">seen and rewarded</span> 🚚
            </div>
          </div>
        </div>
      </section>

      <!-- ABOUT -->
      <section id="about">
        <div class="section-label">About</div>
        <div class="section-title">What is the Human Blockchain?</div>
        <p class="section-body">
          The <strong>Human Blockchain</strong> is not a data center or a mining farm.
          It is a living network of people who scan a YAM-is-On measuring stick
          at the moment value changes hands. Each 2-scan Proof-of-Delivery mints
          a $10 <strong>YAM JAM</strong> trade credit — measured first in XP
          (sextillionths of a penny), then maturing into <strong>New World Pennies</strong>.
          Visa and Mastercard rails are still used for final fiat settlement, but
          the <em>power to create value</em> is owned by voters and consumers, not by the rails.
        </p>
      </section>

      <!-- HOW IT WORKS -->
      <section id="how-it-works">
        <div class="grid-two">
          <div>
            <div class="section-label">How it works</div>
            <div class="section-title">The measuring stick: YAM-is-On.</div>
            <p class="section-body">
              Every delivery that belongs to the United Citizens economy carries
              a <strong>YAM-is-On voucher or hang tag</strong>. That tag is the
              measuring stick. If there is no tag, the system cannot measure the
              delivery — and no new wealth exists inside the Human Blockchain.
            </p>
            <ul class="list">
              <li><span class="inline-highlight">Scan #1 – Seller</span>: The seller scans the tag when the item leaves their hands.</li>
              <li><span class="inline-highlight">Scan #2 – Buyer</span>: The buyer scans the same tag to confirm delivery.</li>
              <li>Both scans are anchored to device ID, time, and place, forming a tamper-resistant human receipt.</li>
              <li>The last-mile driver is recognized as the person who completed the promise-to-deliver.</li>
            </ul>
            <div class="chip-row">
              <div class="chip">2-scan Proof-of-Delivery</div>
              <div class="chip">XP → New World Penny</div>
              <div class="chip">You & Me, Just Alternative Money</div>
              <div class="chip">Last-mile recognition</div>
            </div>
          </div>
          <div>
            <div class="card">
              <div class="card-header">
                <span class="card-tag">Flow: from scan to settlement</span>
              </div>
              <ol class="list">
                <li><strong>Scan the measuring stick.</strong> Seller and buyer both scan the YAM-is-On tag.</li>
                <li><strong>XP is issued.</strong> A $10 trade credit is minted as XP — a sextillionth-of-a-penny valuation.</li>
                <li><strong>Maturity window.</strong> Over 8–12 weeks, XP matures into New World Pennies on a shared ledger.</li>
                <li><strong>Fiat conversion.</strong> When needed, value flows through Visa/Mastercard rails and a licensed MSB — not to create wealth, but to settle it.</li>
                <li><strong>Treasure the human role.</strong> Drivers, couriers, artisans, buyers, and sellers are all visible nodes in the Human Blockchain.</li>
              </ol>
              <p class="section-body" style="margin-top:0.6rem;font-size:0.86rem;">
                The chain that matters is not the code — it’s the <strong>people</strong>
                whose device-verified actions make the economy real.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- UNITED CITIZENS -->
      <section id="united-citizens">
        <div class="section-label">United Citizens</div>
        <div class="section-title">A movement, not a card.</div>
        <p class="section-body">
          <strong>United Citizens</strong> is a global movement of Millennials,
          Gen Z, and allies who believe that
          <span class="inline-highlight">the economy should answer to voters and consumers</span>,
          not just to markets and algorithms. When you scan a YAM-is-On tag, you’re not just tracking a package —
          you are casting an economic vote:
        </p>
        <ul class="list">
          <li><strong>I want my spending recorded as human value, not a data point for speculation.</strong></li>
          <li><strong>I want last-mile workers and creators to be recognized in the rewards.</strong></li>
          <li><strong>I want a transparent path from delivery to impact.</strong></li>
        </ul>
        <p class="section-body" style="margin-top:0.6rem;">
          HumanBlockchain.info is the doorway: from here, you can join
          the United Citizens community, connect to your local and global POCs,
          and step into a You & Me economic grid where every delivery mints peace.
        </p>
        <div class="hero-actions" style="margin-top:1.4rem;">
          <button class="btn-primary" onclick="window.open('https://discord.com/invite/g5jreAPbra','_blank')">
            Join the United Citizens Discord
          </button>
          <button class="btn-ghost" onclick="window.open('https://www.smallstreet.app/shop', '_blank')">
            Browse YAM-is-On tags & merch
          </button>
        </div>
      </section>

      <!-- PEACE PENTAGON -->
      <section id="peace-pentagon">
        <div class="grid-two">
          <div>
            <div class="section-label">Peace Pentagon</div>
            <div class="section-title">Every member is placed with purpose.</div>
            <p class="section-body">
              When you register, your time and place of entry become your
              <strong>moment of serendipity</strong>. The system places you into the
              <strong>Peace Pentagon</strong> — one of five branches — and assigns you to
              <strong>local Buyer POCs</strong> and <strong>global Seller POCs</strong>.
            </p>
            <ul class="list">
              <li><strong>Planning</strong> – long-range design & logistics.</li>
              <li><strong>Budget</strong> – XP flows, pennies, and treasury visibility.</li>
              <li><strong>Media</strong> – telling the story of United Citizens.</li>
              <li><strong>Distribution</strong> – coordinating last-mile value.</li>
              <li><strong>Membership</strong> – welcoming the next wave of voters & consumers.</li>
            </ul>
          </div>
          <div>
            <div class="card">
              <div class="card-header">
                <span class="card-tag">You inside the grid</span>
              </div>
              <p class="section-body" style="font-size:0.9rem;">
                Each registered member receives:
              </p>
              <ul class="list">
                <li>A <strong>Peace Pentagon branch</strong> based on your registration moment.</li>
                <li>A <strong>local Buyer POC</strong> — a 30-person pod where your spending and confirmations grow shared rewards.</li>
                <li>A <strong>global Seller POC</strong> — a 5-seller cell connected to artisans, craftsmen, and creators worldwide.</li>
              </ul>
              <p class="section-body" style="margin-top:0.6rem;font-size:0.88rem;">
                Each seller can grow a <strong>25-buyer network</strong> with YAM-is-On referrals. Every 2-scan
                confirmation inside that network becomes proof that the Human Blockchain is alive and moving wealth
                toward people and peace.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- FAQ -->
      <section id="faq">
        <div class="section-label">FAQ</div>
        <div class="section-title">Quick answers for curious humans.</div>
        <div class="grid-two" style="margin-top:1.2rem;">
          <div class="card">
            <div class="card-header">
              <span class="card-tag">Why the 2-scan rule?</span>
            </div>
            <p class="section-body" style="font-size:0.9rem;">
              Because we only count wealth when real people are involved at both ends of the exchange.
              One scan proves intention. Two scans prove completion. Without both, no XP is minted,
              no New World Penny forms, and no wealth is recognized inside the Human Blockchain.
            </p>
          </div>
          <div class="card">
            <div class="card-header">
              <span class="card-tag">Is this a replacement for banks?</span>
            </div>
            <p class="section-body" style="font-size:0.9rem;">
              No. Banks, Visa, and Mastercard still handle the fiat rails.
              United Citizens simply insists that <strong>human-verified delivery</strong>
              — not speculation — is the source of true value. XP and New World Pennies
              keep track of that value before any conversion happens.
            </p>
          </div>
        </div>
      </section>
    </main>

    <!-- FOOTER -->
    <footer>
      <div>© <span id="year"></span> HumanBlockchain.info · United Citizens</div>
      <div>
        <a href="#top">Back to top</a>
      </div>
    </footer>
  </div>

  <!-- PoD MODAL -->
  <div class="modal-backdrop" id="pod-modal-backdrop" aria-hidden="true">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="pod-modal-title">
      <div class="modal-close" id="pod-modal-close">×</div>
      <div class="modal-step-label">Step 1</div>
      <div class="modal-heading" id="pod-modal-title">Is this Proof of Delivery?</div>
      <p class="modal-sub" id="pod-modal-text">
        You are holding or scanning a YAM-is-On voucher or hang tag.<br />
        Confirming Proof-of-Delivery tells the Human Blockchain that a real human actually received this item.
      </p>
      <div class="modal-buttons" id="pod-step-1">
        <button class="btn-small" id="pod-no-btn">No, I’m just exploring</button>
        <button class="btn-small primary" id="pod-yes-btn">Yes, this is Proof of Delivery</button>
      </div>

      <!-- Step 2 (hidden initially) -->
      <div id="pod-step-2" style="display:none;">
        <div class="modal-step-label">Step 2</div>
        <div class="modal-heading">Is this the final destination?</div>
        <div class="modal-destination-tag">
          📦 This question ensures the right person is credited with final delivery.
        </div>
        <p class="modal-sub">
          If this item will be handed off again (for example, to someone you are delivering it to),
          select “No”. The final receiver will complete the 2-scan Proof-of-Delivery.
        </p>
        <div class="modal-buttons">
          <button class="btn-small" id="pod-final-no-btn">No, passing it along</button>
          <button class="btn-small primary" id="pod-final-yes-btn">Yes, I am the final receiver</button>
        </div>
      </div>

      <!-- Result -->
      <div class="modal-result" id="pod-result"></div>
      
      <!-- Loader -->
      <div class="modal-loader" id="modal-loader">
        <div class="loader"></div>
        <div class="loader-text">Redirecting...</div>
      </div>
      
      <div class="modal-footer-note">
        <span>No tag, no scan, no wealth.</span> The measuring stick of this economy is the YAM-is-On voucher or hang tag.
      </div>
    </div>
  </div>

  <script>
    // footer year
    document.getElementById("year").textContent = new Date().getFullYear();

    // Entry Modal - Show on page load
    const enterOverlay = document.getElementById("enterOverlay");
    const podOverlay = document.getElementById("podOverlay");
    const enterSiteBtn = document.getElementById("enterSite");
    const podGateYes = document.getElementById("podGateYes");
    const podGateNo = document.getElementById("podGateNo");

    // Show entry modal on page load
    window.addEventListener("load", () => {
      enterOverlay.classList.add("active");
      document.body.style.overflow = "hidden";
    });

    // Enter Website button - show POD gate
    enterSiteBtn.addEventListener("click", () => {
      enterOverlay.classList.remove("active");
      setTimeout(() => {
        podOverlay.classList.add("active");
      }, 300);
    });

    // POD Gate - Yes button (opens existing PoD modal)
    podGateYes.addEventListener("click", () => {
      podOverlay.classList.remove("active");
      document.body.style.overflow = "";
      // Open the existing PoD modal after overlay closes
      setTimeout(() => {
        window.open("https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof","_blank");
      //   const modalBackdrop = document.getElementById("pod-modal-backdrop");
      //   if (modalBackdrop) {
      //     modalBackdrop.style.display = "flex";
      //     const podStep1 = document.getElementById("pod-step-1");
      //     const podStep2 = document.getElementById("pod-step-2");
      //     const podResult = document.getElementById("pod-result");
      //     const podText = document.getElementById("pod-modal-text");
      //     if (podStep1) podStep1.style.display = "flex";
      //     if (podStep2) podStep2.style.display = "none";
      //     if (podResult) podResult.style.display = "none";
      //     if (podResult) podResult.textContent = "";
      //     if (podText) {
      //       podText.textContent = "You are holding or scanning a YAM-is-On voucher or hang tag.\nConfirming Proof-of-Delivery tells the Human Blockchain that a real human actually received this item.";
      //     }
      //   }
      }, 300);
    });

    // POD Gate - No button (close and continue)
    podGateNo.addEventListener("click", () => {
      podOverlay.classList.remove("active");
      document.body.style.overflow = "";
    });

    // Hamburger Menu Toggle
    const hamburger = document.getElementById("hamburger-menu");
    const nav = document.getElementById("main-nav");
    const overlay = document.getElementById("menu-overlay");
    const menuClose = document.getElementById("menu-close-btn");

    function toggleMenu() {
      hamburger.classList.toggle("active");
      nav.classList.toggle("active");
      overlay.classList.toggle("active");
      document.body.style.overflow = nav.classList.contains("active") ? "hidden" : "";
    }

    function closeMenu() {
      hamburger.classList.remove("active");
      nav.classList.remove("active");
      overlay.classList.remove("active");
      document.body.style.overflow = "";
    }

    if (hamburger && nav && overlay) {
      hamburger.addEventListener("click", toggleMenu);
      overlay.addEventListener("click", closeMenu);
      
      if (menuClose) {
        menuClose.addEventListener("click", closeMenu);
      }

      // Close menu when clicking nav links
      const navLinks = nav.querySelectorAll(".nav-link");
      navLinks.forEach(link => {
        link.addEventListener("click", () => {
          if (window.innerWidth <= 768) {
            closeMenu();
          }
        });
      });

      // Close menu when clicking CTA button
      const navCta = document.getElementById("nav-pod-btn");
      if (navCta) {
        navCta.addEventListener("click", () => {
          if (window.innerWidth <= 768) {
            closeMenu();
          }
        });
      }
    }

    const modalBackdrop = document.getElementById("pod-modal-backdrop");
    const modalClose = document.getElementById("pod-modal-close");
    const btnHeroPod = document.getElementById("hero-pod-btn");
    const btnNavPod = document.getElementById("nav-pod-btn");
    const podStep1 = document.getElementById("pod-step-1");
    const podStep2 = document.getElementById("pod-step-2");
    const podResult = document.getElementById("pod-result");
    const podText = document.getElementById("pod-modal-text");

    function openPodModal() {
      modalBackdrop.style.display = "flex";
      podStep1.style.display = "flex";
      podStep2.style.display = "none";
      podResult.style.display = "none";
      podResult.textContent = "";
      modalLoader.classList.remove("active");
      podText.textContent =
        "You are holding or scanning a YAM-is-On voucher or hang tag.\nConfirming Proof-of-Delivery tells the Human Blockchain that a real human actually received this item.";
    }

    function closePodModal() {
      modalBackdrop.style.display = "none";
    }

    btnHeroPod.addEventListener("click", openPodModal);
    btnNavPod.addEventListener("click", openPodModal);
    modalClose.addEventListener("click", closePodModal);
    modalBackdrop.addEventListener("click", (e) => {
      if (e.target === modalBackdrop) closePodModal();
    });

    // Loader element
    const modalLoader = document.getElementById("modal-loader");

    // Step 1 buttons
    document.getElementById("pod-no-btn").addEventListener("click", () => {
      // Exploring: send to Discord/Gracebook
      podStep1.style.display = "none";
      podStep2.style.display = "none";
      podResult.style.display = "block";
      podResult.innerHTML =
        "You'll be redirected to <strong>United Citizens Gracebook (Discord)</strong> for onboarding.<br /><br />" +
        "This is where you learn how Proof-of-Delivery, XP, and the New World Penny economy work.";
      
      // Show loader
      modalLoader.classList.add("active");
      
      // Redirect after delay
      setTimeout(() => {
        window.open("https://discord.com/invite/g5jreAPbra","_blank");
        // Hide loader after redirect
        setTimeout(() => {
          modalLoader.classList.remove("active");
        }, 500);
      }, 1800);
    });

    document.getElementById("pod-yes-btn").addEventListener("click", () => {
      // Move to step 2
      podStep1.style.display = "none";
      podStep2.style.display = "block";
    });

    // Step 2 buttons
    document.getElementById("pod-final-no-btn").addEventListener("click", () => {
      podStep2.style.display = "none";
      podResult.style.display = "block";
      podResult.innerHTML =
        "Understood. The Human Blockchain has recorded a <strong>handoff</strong> — " +
        "the final receiver will complete the 2-scan Proof-of-Delivery.<br /><br />" +
        "You'll now be guided to <strong>United Citizens Gracebook (Discord)</strong> " +
        "to log this handoff and continue the chain.";
      
      // Show loader
      modalLoader.classList.add("active");
      
      // Redirect after delay
      setTimeout(() => {
        window.open("https://discord.com/invite/g5jreAPbra", "_blank");
        // Hide loader after redirect
        setTimeout(() => {
          modalLoader.classList.remove("active");
        }, 500);
      }, 2100);
    });

    document.getElementById("pod-final-yes-btn").addEventListener("click", () => {
      podStep2.style.display = "none";
      podResult.style.display = "block";
      podResult.innerHTML =
        "✅ <strong>2-scan Proof-of-Delivery complete.</strong><br />" +
        "XP has been minted toward a $10 YAM JAM trade credit. " +
        "This will mature into New World Pennies before any fiat moves on Visa/Mastercard rails via a licensed MSB.<br /><br />" +
        "You'll now be redirected to <strong>WooCommerce</strong> to finalize settlement and view your rewards.";
      
      // Show loader
      modalLoader.classList.add("active");
      
      // Redirect after delay
      setTimeout(() => {
        window.open("https://www.smallstreet.app/?utm_source=humanblockchain.info&scan_type=proof","_blank");
        // Hide loader after redirect
        setTimeout(() => {
          modalLoader.classList.remove("active");
        }, 500);
      }, 2200);
    });
  </script>
</body>
</html>


