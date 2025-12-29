<?php
/**
 * Template Name: Activate Device
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Activate Device | HumanBlockchain.info</title>
  <meta name="description" content="Activate your device to participate in the HumanBlockchain 2-scan Proof of Delivery system." />

  <style>
    :root{
      --bg: #0b1220;
      --bg2:#070d18;
      --panel: rgba(18,31,61,.70);
      --line: rgba(232,238,252,.12);
      --text: #e8eefc;
      --muted: #b8c3e6;
      --accent: #7dd3fc;
      --accent2:#a78bfa;
      --good: #86efac;
      --warn: #fbbf24;
      --radius: 18px;
      --shadow2: 0 8px 18px rgba(0,0,0,.22);
      --maxw: 1100px;
      --font: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Apple Color Emoji", "Segoe UI Emoji";
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:var(--font); color:var(--text); line-height:1.45;
      background:
        radial-gradient(1100px 600px at 15% 0%, rgba(167,139,250,.18), transparent 55%),
        radial-gradient(900px 500px at 85% 20%, rgba(125,211,252,.16), transparent 55%),
        radial-gradient(700px 420px at 50% 90%, rgba(134,239,172,.10), transparent 60%),
        linear-gradient(180deg, var(--bg), var(--bg2));
    }
    a{color:inherit;text-decoration:none}
    .wrap{max-width:var(--maxw); margin:0 auto; padding:24px 18px}
    .card{
      background:var(--panel); border:1px solid var(--line); border-radius:var(--radius);
      padding:28px; box-shadow:var(--shadow2); max-width:600px; margin:0 auto;
    }
    h1{font-size:32px; margin:0 0 12px; letter-spacing:-.6px}
    .lead{color:var(--muted); font-size:16px; margin:0 0 24px; line-height:1.6}
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:12px 20px; border-radius:14px; border:1px solid var(--line);
      background: linear-gradient(135deg, rgba(125,211,252,.95), rgba(167,139,250,.95));
      color:#071024; font-weight:700; font-size:15px;
      cursor:pointer; transition: transform .08s ease, filter .08s ease;
      width:100%; margin-top:16px;
    }
    .btn:hover{filter:brightness(1.05); transform: translateY(-1px)}
    .btn:disabled{opacity:.5; cursor:not-allowed}
    .checkbox-wrapper{
      display:flex; gap:12px; align-items:flex-start; margin:20px 0;
      padding:16px; background: rgba(232,238,252,.05); border-radius:12px;
    }
    .checkbox-wrapper input[type="checkbox"]{
      width:20px; height:20px; margin-top:2px; cursor:pointer;
    }
    .checkbox-wrapper label{
      flex:1; cursor:pointer; font-size:14px; line-height:1.5;
    }
    .error{color:#fb7185; font-size:14px; margin-top:8px; display:none}
    .error.show{display:block}
    .success{color:var(--good); font-size:14px; margin-top:8px; display:none}
    .success.show{display:block}
    .loading{display:none; text-align:center; margin:20px 0}
    .loading.show{display:block}
    .spinner{
      border:3px solid rgba(232,238,252,.1);
      border-top-color:var(--accent);
      border-radius:50%; width:32px; height:32px;
      animation:spin .8s linear infinite; margin:0 auto 12px;
    }
    @keyframes spin{to{transform:rotate(360deg)}}
    .footer-note{
      margin-top:20px; font-size:12px; color:var(--muted); text-align:center;
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div class="card">
      <h1>Activate This Device</h1>
      <p class="lead">
        This device will be used to confirm delivery events you participate in.
        Your phone becomes your delivery identity.
      </p>

      <form id="deviceActivationForm">
        <div class="checkbox-wrapper">
          <input type="checkbox" id="oneDeviceCheckbox" required>
          <label for="oneDeviceCheckbox">
            I understand <strong>one device equals one human voice</strong>.
          </label>
        </div>

        <div class="error" id="errorMessage"></div>
        <div class="success" id="successMessage"></div>
        
        <div class="loading" id="loadingIndicator">
          <div class="spinner"></div>
          <div>Activating device...</div>
        </div>

        <button type="submit" class="btn" id="activateBtn" disabled>
          Confirm & Continue
        </button>
      </form>

      <p class="footer-note">
        Location and time are used only to confirm delivery.
      </p>
    </div>
  </div>

  <script>
    const form = document.getElementById('deviceActivationForm');
    const checkbox = document.getElementById('oneDeviceCheckbox');
    const activateBtn = document.getElementById('activateBtn');
    const errorMsg = document.getElementById('errorMessage');
    const successMsg = document.getElementById('successMessage');
    const loading = document.getElementById('loadingIndicator');

    // Enable button when checkbox is checked
    checkbox.addEventListener('change', function() {
      activateBtn.disabled = !this.checked;
    });

    // Collect device fingerprint
    function getDeviceFingerprint() {
      const data = {
        user_agent: navigator.userAgent,
        screen_resolution: `${screen.width}x${screen.height}`,
        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        language: navigator.language,
        platform: navigator.platform,
      };
      return data;
    }

    // Get geolocation
    function getLocation() {
      return new Promise((resolve, reject) => {
        if (!navigator.geolocation) {
          resolve(null);
          return;
        }
        navigator.geolocation.getCurrentPosition(
          (position) => {
            resolve({
              latitude: position.coords.latitude,
              longitude: position.coords.longitude,
            });
          },
          (error) => {
            console.warn('Geolocation error:', error);
            resolve(null);
          }
        );
      });
    }

    // Register device
    async function registerDevice() {
      const deviceData = getDeviceFingerprint();
      
      try {
        const response = await fetch('/wp-json/hb/v1/device/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(deviceData),
        });

        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Registration failed');
        }

        // Handle existing device
        if (result.existing) {
          // Check device status
          if (result.status === 'validated') {
            // Device already fully registered, redirect to device dashboard
            window.location.href = '/my-device?device_id=' + result.device_id;
            return null; // Stop execution
          }
          // Device exists but not validated, continue with activation
          return result;
        }

        return result;
      } catch (error) {
        throw new Error('Failed to register device: ' + error.message);
      }
    }

    // Activate device
    async function activateDevice(deviceId, location) {
      const activationData = {
        device_id: deviceId,
      };
      
      // Only include location if available
      if (location && location.latitude !== null && location.latitude !== undefined) {
        activationData.latitude = location.latitude;
      }
      if (location && location.longitude !== null && location.longitude !== undefined) {
        activationData.longitude = location.longitude;
      }

      try {
        const response = await fetch('/wp-json/hb/v1/device/activate', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(activationData),
        });

        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Activation failed');
        }

        return result;
      } catch (error) {
        throw new Error('Failed to activate device: ' + error.message);
      }
    }

    // Handle form submission
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      // Hide previous messages
      errorMsg.classList.remove('show');
      successMsg.classList.remove('show');
      loading.classList.add('show');
      activateBtn.disabled = true;

      try {
        // Step 1: Register device
        const registration = await registerDevice();
        
        // If registerDevice returned null, it means redirect happened
        if (!registration) {
          return;
        }
        
        // Handle existing device
        if (registration.existing) {
          const deviceId = registration.device_id;
          const status = registration.status;
          
          if (status === 'validated') {
            // Device already fully registered, redirect to device dashboard
            window.location.href = '/my-device?device_id=' + deviceId;
            return;
          }
          
          // Device exists but not fully activated, continue with activation
          const location = await getLocation();
          const activation = await activateDevice(deviceId, location);
          
          successMsg.textContent = 'Device activated successfully! Redirecting...';
          successMsg.classList.add('show');
          loading.classList.remove('show');
          
          setTimeout(() => {
            window.location.href = '/activate-device-step-2?device_id=' + deviceId;
          }, 1500);
          return;
        }

        const deviceId = registration.device_id;

        // Step 2: Get location and activate
        const location = await getLocation();
        const activation = await activateDevice(deviceId, location);

        // Success
        successMsg.textContent = 'Device activated successfully! Redirecting to next step...';
        successMsg.classList.add('show');
        loading.classList.remove('show');

        // Redirect to next step (v-card validation)
        setTimeout(() => {
          window.location.href = '/activate-device-step-2?device_id=' + deviceId;
        }, 1500);

      } catch (error) {
        errorMsg.textContent = error.message;
        errorMsg.classList.add('show');
        loading.classList.remove('show');
        activateBtn.disabled = false;
      }
    });
  </script>
</body>
</html>

