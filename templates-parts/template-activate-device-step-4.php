<?php
/**
 * Template Name: Activate Device - Step 4 (Membership Selection)
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Choose Membership | HumanBlockchain.info</title>
  <style>
    :root{
      --bg: #0b1220; --bg2:#070d18; --panel: rgba(18,31,61,.70);
      --line: rgba(232,238,252,.12); --text: #e8eefc; --muted: #b8c3e6;
      --accent: #7dd3fc; --good: #86efac; --radius: 18px;
      --shadow2: 0 8px 18px rgba(0,0,0,.22); --maxw: 1100px;
      --font: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
    }
    *{box-sizing:border-box} html,body{height:100%; margin:0}
    body{font-family:var(--font); color:var(--text); line-height:1.45;
      background: radial-gradient(1100px 600px at 15% 0%, rgba(167,139,250,.18), transparent 55%),
        radial-gradient(900px 500px at 85% 20%, rgba(125,211,252,.16), transparent 55%),
        linear-gradient(180deg, var(--bg), var(--bg2));
    }
    .wrap{max-width:var(--maxw); margin:0 auto; padding:24px 18px}
    .card{background:var(--panel); border:1px solid var(--line); border-radius:var(--radius);
      padding:28px; box-shadow:var(--shadow2); max-width:600px; margin:0 auto;
    }
    h1{font-size:32px; margin:0 0 12px; letter-spacing:-.6px}
    .lead{color:var(--muted); font-size:16px; margin:0 0 24px; line-height:1.6}
    .btn{display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:12px 20px; border-radius:14px; border:none;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      color:#071024; font-weight:700; font-size:15px; cursor:pointer;
      width:100%; margin-top:16px; transition: filter .08s ease;
    }
    .btn:hover{filter:brightness(1.05)}
    .btn:disabled{opacity:.5; cursor:not-allowed}
    .membership-options{display:grid; gap:12px; margin:20px 0}
    .option{background: rgba(232,238,252,.05); border:2px solid var(--line);
      border-radius:12px; padding:16px; cursor:pointer; transition: all .15s ease;
    }
    .option:hover{border-color:var(--accent); background: rgba(232,238,252,.08)}
    .option.selected{border-color:var(--accent); background: rgba(125,211,252,.10)}
    .option h3{margin:0 0 8px; font-size:18px}
    .option p{margin:0; color:var(--muted); font-size:14px}
    .error{color:#fb7185; font-size:14px; margin-top:8px; display:none}
    .error.show{display:block}
    .success{color:var(--good); font-size:14px; margin-top:8px; display:none}
    .success.show{display:block}
    .loading{display:none; text-align:center; margin:20px 0}
    .loading.show{display:block}
    .spinner{border:3px solid rgba(232,238,252,.1); border-top-color:var(--accent);
      border-radius:50%; width:32px; height:32px; animation:spin .8s linear infinite;
      margin:0 auto 12px;
    }
    @keyframes spin{to{transform:rotate(360deg)}}
    .footer-note{margin-top:20px; font-size:12px; color:var(--muted); text-align:center}
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h1>Choose Your Participation Level</h1>
      <p class="lead">You can change this later.</p>

      <div class="membership-options" id="membershipOptions">
        <div class="option" data-tier="yamer">
          <h3>YAM'er — Free</h3>
          <p>Participate in Proof of Delivery.</p>
        </div>
        <div class="option" data-tier="megavoter">
          <h3>MEGAvoter — Annual</h3>
          <p>Guide social impact decisions.</p>
        </div>
        <div class="option" data-tier="patron">
          <h3>Patron — Monthly</h3>
          <p>Support and scale the network.</p>
        </div>
      </div>

      <div class="error" id="errorMessage"></div>
      <div class="success" id="successMessage"></div>
      
      <div class="loading" id="loadingIndicator">
        <div class="spinner"></div>
        <div>Saving membership selection...</div>
      </div>

      <button class="btn" id="continueBtn" disabled>
        Continue
      </button>

      <p class="footer-note">
        Referral recognition is issued annually in XP on September 1.
      </p>
    </div>
  </div>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const deviceId = urlParams.get('device_id');

    if (!deviceId) {
      window.location.href = '/activate-device';
    }

    let selectedTier = null;
    const options = document.querySelectorAll('.option');
    const continueBtn = document.getElementById('continueBtn');
    const errorMsg = document.getElementById('errorMessage');
    const successMsg = document.getElementById('successMessage');
    const loading = document.getElementById('loadingIndicator');

    options.forEach(option => {
      option.addEventListener('click', function() {
        options.forEach(o => o.classList.remove('selected'));
        this.classList.add('selected');
        selectedTier = this.dataset.tier;
        continueBtn.disabled = false;
      });
    });

    continueBtn.addEventListener('click', async function() {
      if (!selectedTier) return;

      errorMsg.classList.remove('show');
      successMsg.classList.remove('show');
      loading.classList.add('show');
      continueBtn.disabled = true;

      try {
        const response = await fetch(`/wp-json/hb/v1/device/${deviceId}/membership`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ tier: selectedTier }),
        });

        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Failed to save membership');
        }

        successMsg.textContent = 'Membership selected! Redirecting...';
        successMsg.classList.add('show');
        loading.classList.remove('show');

        setTimeout(() => {
          window.location.href = '/activate-device-complete?device_id=' + deviceId;
        }, 1500);

      } catch (error) {
        errorMsg.textContent = error.message;
        errorMsg.classList.add('show');
        loading.classList.remove('show');
        continueBtn.disabled = false;
      }
    });
  </script>
</body>
</html>

