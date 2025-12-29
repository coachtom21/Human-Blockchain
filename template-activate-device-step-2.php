<?php
/**
 * Template Name: Activate Device - Step 2 (v-Card Validation)
 */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Validate v-Card | HumanBlockchain.info</title>
  <!-- QR Scanner Library -->
  <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
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
    input[type="text"]{width:100%; padding:12px; border-radius:12px; border:1px solid var(--line);
      background: rgba(232,238,252,.05); color:var(--text); font-size:15px; margin:12px 0;
    }
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
    .qr-scanner{width:100%; max-width:400px; margin:20px auto; padding:20px;
      background: rgba(232,238,252,.05); border-radius:12px; text-align:center;
    }
    .scanner-container{display:none; margin:20px 0}
    .scanner-container.active{display:block}
    #qr-reader{width:100%; max-width:300px; margin:0 auto; border-radius:12px; overflow:hidden}
    .scanner-controls{display:flex; gap:10px; margin-top:12px; justify-content:center}
    .btn-secondary{background: rgba(232,238,252,.08); border:1px solid var(--line); color:var(--text)}
    .btn-secondary:hover{background: rgba(232,238,252,.12)}
    .toggle-scanner{font-size:14px; padding:8px 16px; border-radius:10px}
    .divider{text-align:center; margin:20px 0; color:var(--muted); font-size:13px; position:relative}
    .divider::before,.divider::after{content:''; position:absolute; top:50%; width:40%; height:1px; background:var(--line)}
    .divider::before{left:0}
    .divider::after{right:0}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h1>Validate Your Identity</h1>
      <p class="lead">
        QRtiger v-card is required for participation. This validates your device and enables ledger access.
        Only hash and minimal metadata are stored (PII minimization).
      </p>

      <form id="vcardForm">
        <!-- QR Scanner Section -->
        <div class="qr-scanner">
          <p style="margin:0 0 12px; font-size:14px">Scan QRtiger v-card QR code</p>
          <button type="button" class="btn btn-secondary toggle-scanner" id="toggleScanner">
            📷 Open Camera Scanner
          </button>
          
          <div class="scanner-container" id="scannerContainer">
            <div id="qr-reader"></div>
            <div class="scanner-controls">
              <button type="button" class="btn btn-secondary" id="stopScanner">Stop Scanner</button>
            </div>
          </div>
        </div>

        <div class="divider">OR</div>

        <!-- Manual Entry Section -->
        <div>
          <label for="vcardHash" style="display:block; margin-bottom:8px; font-size:14px; color:var(--muted)">
            Enter v-card hash manually
          </label>
          <input type="text" id="vcardHash" placeholder="Paste v-card hash here" required>
        </div>

        <div class="error" id="errorMessage"></div>
        <div class="success" id="successMessage"></div>
        
        <div class="loading" id="loadingIndicator">
          <div class="spinner"></div>
          <div>Validating v-card...</div>
        </div>

        <button type="submit" class="btn" id="validateBtn">
          Validate v-Card
        </button>
      </form>

      <p class="footer-note">
        Your v-card hash is stored securely. No personal information is retained.
      </p>
    </div>
  </div>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const deviceId = urlParams.get('device_id');

    if (!deviceId) {
      window.location.href = '/activate-device';
    }

    const form = document.getElementById('vcardForm');
    const errorMsg = document.getElementById('errorMessage');
    const successMsg = document.getElementById('successMessage');
    const loading = document.getElementById('loadingIndicator');
    const scannerContainer = document.getElementById('scannerContainer');
    const toggleScannerBtn = document.getElementById('toggleScanner');
    const stopScannerBtn = document.getElementById('stopScanner');
    const vcardHashInput = document.getElementById('vcardHash');
    
    let html5QrCode = null;
    let isScanning = false;

    /**
     * Generate SHA-256 hash from vCard data
     */
    async function generateVCardHash(vcardData) {
      // Normalize vCard data (remove whitespace, normalize line endings)
      const normalized = vcardData.trim().replace(/\r\n/g, '\n').replace(/\r/g, '\n');
      
      // Convert to ArrayBuffer
      const encoder = new TextEncoder();
      const data = encoder.encode(normalized);
      
      // Generate SHA-256 hash
      const hashBuffer = await crypto.subtle.digest('SHA-256', data);
      const hashArray = Array.from(new Uint8Array(hashBuffer));
      const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
      
      return hashHex;
    }

    /**
     * Extract vCard data from QR code result
     * QRtiger v-cards can contain:
     * 1. Direct vCard data (BEGIN:VCARD...END:VCARD)
     * 2. URL to vCard file
     */
    async function extractVCardHash(qrResult) {
      try {
        // Check if it's a URL
        if (qrResult.startsWith('http://') || qrResult.startsWith('https://')) {
          // Fetch vCard from URL
          const response = await fetch(qrResult);
          if (!response.ok) {
            throw new Error('Failed to fetch vCard from URL');
          }
          const vcardData = await response.text();
          return await generateVCardHash(vcardData);
        }
        
        // Check if it's direct vCard data
        if (qrResult.includes('BEGIN:VCARD') && qrResult.includes('END:VCARD')) {
          return await generateVCardHash(qrResult);
        }
        
        // If it's already a hash (alphanumeric, 64 chars for SHA-256)
        if (/^[a-f0-9]{64}$/i.test(qrResult.trim())) {
          return qrResult.trim();
        }
        
        // Otherwise, treat the entire result as vCard data and hash it
        return await generateVCardHash(qrResult);
      } catch (error) {
        console.error('Error extracting vCard hash:', error);
        throw new Error('Failed to process vCard data: ' + error.message);
      }
    }

    /**
     * Start QR Scanner
     */
    async function startScanner() {
      if (isScanning) return;
      
      try {
        html5QrCode = new Html5Qrcode("qr-reader");
        
        await html5QrCode.start(
          { facingMode: "environment" }, // Use back camera on mobile
          {
            fps: 10,
            qrbox: { width: 250, height: 250 },
            aspectRatio: 1.0
          },
          async (decodedText, decodedResult) => {
            // Successfully scanned
            stopScanner();
            
            try {
              // Show loading
              loading.classList.add('show');
              errorMsg.classList.remove('show');
              
              // Extract hash from scanned data
              const hash = await extractVCardHash(decodedText);
              
              // Fill input with hash
              vcardHashInput.value = hash;
              
              // Auto-submit form
              loading.classList.remove('show');
              successMsg.textContent = 'QR code scanned! Validating...';
              successMsg.classList.add('show');
              
              // Submit validation
              await validateVCard(hash);
            } catch (error) {
              loading.classList.remove('show');
              errorMsg.textContent = error.message || 'Failed to process QR code';
              errorMsg.classList.add('show');
            }
          },
          (errorMessage) => {
            // Ignore scanning errors (they're frequent during scanning)
          }
        );
        
        isScanning = true;
        scannerContainer.classList.add('active');
        toggleScannerBtn.textContent = '📷 Scanner Active';
        toggleScannerBtn.disabled = true;
      } catch (error) {
        errorMsg.textContent = 'Failed to start camera: ' + error.message;
        errorMsg.classList.add('show');
        console.error('Scanner error:', error);
      }
    }

    /**
     * Stop QR Scanner
     */
    async function stopScanner() {
      if (!isScanning || !html5QrCode) return;
      
      try {
        await html5QrCode.stop();
        html5QrCode.clear();
        html5QrCode = null;
        isScanning = false;
        scannerContainer.classList.remove('active');
        toggleScannerBtn.textContent = '📷 Open Camera Scanner';
        toggleScannerBtn.disabled = false;
      } catch (error) {
        console.error('Error stopping scanner:', error);
      }
    }

    /**
     * Validate vCard
     */
    async function validateVCard(vcardHash) {
      errorMsg.classList.remove('show');
      successMsg.classList.remove('show');
      loading.classList.add('show');

      if (!vcardHash) {
        errorMsg.textContent = 'Please enter v-card hash';
        errorMsg.classList.add('show');
        loading.classList.remove('show');
        return;
      }

      try {
        const response = await fetch('/wp-json/hb/v1/vcard/validate', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            device_id: parseInt(deviceId),
            vcard_hash: vcardHash,
          }),
        });

        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Validation failed');
        }

        if (result.status === 'validated') {
          successMsg.textContent = 'v-Card validated successfully! Redirecting...';
          successMsg.classList.add('show');
          loading.classList.remove('show');

          setTimeout(() => {
            window.location.href = '/activate-device-step-3?device_id=' + deviceId;
          }, 1500);
        } else {
          errorMsg.textContent = 'v-Card validation is pending. Please try again later.';
          errorMsg.classList.add('show');
          loading.classList.remove('show');
        }

      } catch (error) {
        errorMsg.textContent = error.message;
        errorMsg.classList.add('show');
        loading.classList.remove('show');
      }
    }

    // Event Listeners
    toggleScannerBtn.addEventListener('click', startScanner);
    stopScannerBtn.addEventListener('click', stopScanner);

    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      const vcardHash = vcardHashInput.value.trim();
      await validateVCard(vcardHash);
    });

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
      if (isScanning) {
        stopScanner();
      }
    });
  </script>
</body>
</html>

