<?php
/**
 * Template Name: Activate Device - Step 3 (Discord Connection)
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Connect Discord | HumanBlockchain.info</title>
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
      width:100%; margin-top:16px; transition: filter .08s ease; text-decoration:none;
    }
    .btn:hover{filter:brightness(1.05)}
    .btn:disabled{opacity:.5; cursor:not-allowed}
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
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h1>Connect to the Gracebook</h1>
      <p class="lead">
        This is where delivery confirmations, roles, and community coordination happen.
        Required to complete Proof of Delivery.
      </p>

      <div class="error" id="errorMessage"></div>
      <div class="success" id="successMessage"></div>
      
      <div class="loading" id="loadingIndicator">
        <div class="spinner"></div>
        <div>Getting Discord authorization...</div>
      </div>

      <a href="#" class="btn" id="discordBtn">
        Accept Discord Invite
      </a>

      <p class="footer-note">
        You'll be redirected to Discord to authorize the connection.
      </p>
    </div>
  </div>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const deviceId = urlParams.get('device_id');
    const code = urlParams.get('code');
    const state = urlParams.get('state');

    if (!deviceId) {
      window.location.href = '/activate-device';
    }

    const errorMsg = document.getElementById('errorMessage');
    const successMsg = document.getElementById('successMessage');
    const loading = document.getElementById('loadingIndicator');
    const discordBtn = document.getElementById('discordBtn');

    // Handle Discord callback
    if (code && state) {
      handleDiscordCallback();
    } else {
      // Get Discord auth URL
      getDiscordAuthUrl();
    }

    async function getDiscordAuthUrl() {
      try {
        const response = await fetch(`/wp-json/hb/v1/discord/auth-url?device_id=${deviceId}`);
        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Failed to get Discord URL');
        }

        discordBtn.href = result.auth_url;
        loading.classList.remove('show');

      } catch (error) {
        errorMsg.textContent = error.message;
        errorMsg.classList.add('show');
        loading.classList.remove('show');
      }
    }

    async function handleDiscordCallback() {
      loading.classList.add('show');

      try {
        const response = await fetch(`/wp-json/hb/v1/discord/callback?code=${code}&state=${state}&device_id=${deviceId}`);
        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Discord connection failed');
        }

        successMsg.textContent = 'Discord connected successfully! Redirecting...';
        successMsg.classList.add('show');
        loading.classList.remove('show');

        setTimeout(() => {
          window.location.href = '/activate-device-step-4?device_id=' + deviceId;
        }, 1500);

      } catch (error) {
        errorMsg.textContent = error.message;
        errorMsg.classList.add('show');
        loading.classList.remove('show');
      }
    }
  </script>
</body>
</html>

