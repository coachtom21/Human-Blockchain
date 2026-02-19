<?php
/**
 * Template Name: Activate Device - Complete
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Registration Complete | HumanBlockchain.info</title>
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
      padding:28px; box-shadow:var(--shadow2); max-width:600px; margin:0 auto; text-align:center;
    }
    h1{font-size:32px; margin:0 0 12px; letter-spacing:-.6px}
    .lead{color:var(--muted); font-size:16px; margin:0 0 24px; line-height:1.6}
    .btn{display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:12px 20px; border-radius:14px; border:none;
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      color:#071024; font-weight:700; font-size:15px; cursor:pointer;
      width:100%; margin-top:16px; transition: filter .08s ease; text-decoration:none;
    }
    .btn:hover{filter:brightness(1.05)}
    .btn.secondary{background: rgba(232,238,252,.06); color:var(--text); border:1px solid var(--line)}
    .btn.secondary:hover{background: rgba(232,238,252,.10)}
    .success-icon{font-size:64px; margin:20px 0}
    .error{color:#fb7185; font-size:14px; margin-top:8px; display:none}
    .error.show{display:block}
    .loading{display:none; text-align:center; margin:20px 0}
    .loading.show{display:block}
    .spinner{border:3px solid rgba(232,238,252,.1); border-top-color:var(--accent);
      border-radius:50%; width:32px; height:32px; animation:spin .8s linear infinite;
      margin:0 auto 12px;
    }
    @keyframes spin{to{transform:rotate(360deg)}}
    .footer-note{margin-top:20px; font-size:12px; color:var(--muted); text-align:center}
    .button-group{display:flex; gap:12px; margin-top:20px}
    .button-group .btn{flex:1}
  </style>
  <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
</head>
<body>
  <div class="wrap">
    <div class="card">
      <div class="success-icon">✅</div>
      <h1>You're Live</h1>
      <p class="lead">
        This device is now enabled for Proof of Delivery.
        You can start scanning vouchers and participating in the HumanBlockchain.
      </p>

      <div class="error" id="errorMessage"></div>
      
      <div class="loading" id="loadingIndicator">
        <div class="spinner"></div>
        <div>Completing registration...</div>
      </div>

      <div id="successContent" style="display:none">
        <div class="button-group">
          <a href="/pod" class="btn">Return to Delivery</a>
          <a href="/my-device" class="btn secondary">View My Device</a>
        </div>
      </div>

      <p class="footer-note">
        Any redemption is handled by the Voluntary Fulfillment Network.
      </p>
    </div>
  </div>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const deviceId = urlParams.get('device_id');

    if (!deviceId) {
      window.location.href = '/activate-device';
    }

    const errorMsg = document.getElementById('errorMessage');
    const loading = document.getElementById('loadingIndicator');
    const successContent = document.getElementById('successContent');

    // Complete registration on page load
    window.addEventListener('load', async function() {
      try {
        const response = await fetch(`/wp-json/hb/v1/device/${deviceId}/complete`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
        });

        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Failed to complete registration');
        }

        loading.classList.remove('show');
        successContent.style.display = 'block';

      } catch (error) {
        errorMsg.textContent = error.message;
        errorMsg.classList.add('show');
        loading.classList.remove('show');
      }
    });
  </script>
</body>
</html>

