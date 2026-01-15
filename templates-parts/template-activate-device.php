<?php

/** Template Name: Activate Device */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Activate Device | HumanBlockchain.info</title>
<style>
:root{
--bg:#0b1020;
--card:#101a34;
--text:#eef2ff;
--muted:#b8c1e3;
--line:rgba(255,255,255,.14);
--shadow:0 18px 50px rgba(0,0,0,.55);
--radius:18px;
--btnRadius:14px;
--focus:0 0 0 3px rgba(120,160,255,.35);
}
*{box-sizing:border-box}
body{
margin:0;
min-height:100vh;
font-family: system-ui,
-apple-system,Segoe UI,Roboto,Helvetica,Arial;
background:
radial-gradient(1000px 650px at 20% 10%, rgba(120,160,255,.18), transparent 60%),
radial-gradient(900px 650px at 80% 85%, rgba(52,211,153,.12), transparent 65%),
var(--bg);
color:var(--text);
}
/* Header */
.nav{
position:sticky;
top:0;
z-index:10;
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
display:flex;
gap:10px;
align-items:center;
text-decoration:none;
color:var(--text);
}
.logo{
width:34px;height:34px;border-radius:12px;
background:
radial-gradient(circle at 30% 30%, rgba(52,211,153,.9), transparent 60%),
radial-gradient(circle at 70% 70%, rgba(120,160,255,.9), transparent 60%),
rgba(255,255,255,.06);
border:1px solid var(--line);
}
.brand h1{margin:0;font-size:14px;letter-spacing:.4px}
.brand small{display:block;font-size:12px;color:var(--muted)}
/* Layout */
.wrap{
max-width:1100px;
margin:0 auto;
padding:26px 18px 60px;
}
.card{
border:1px solid var(--line);
background: rgba(255,255,255,.05);
border-radius: var(--radius);
box-shadow: var(--shadow);
}
.card-inner{padding:20px}
.badge{
display:inline-flex;
align-items:center;
gap:8px;
padding:8px 12px;
border-radius:999px;
border:1px solid rgba(255,255,255,.14);
background: rgba(0,0,0,.18);
color:var(--muted);
font-size:12px;
}
.badge .dot{
width:8px;height:8px;border-radius:50%;
background:#34d399;
box-shadow:0 0 0 3px rgba(52,211,153,.18);
}
h2{
margin:12px 0 10px;
font-size:30px;
line-height:1.15;
letter-spacing:.2px;
}
p{margin:10px 0}
.muted{color:var(--muted)}
.grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:14px;
margin-top:14px;
}
@media(max-width:900px){
.grid{grid-template-columns:1fr}
}
.panel{
border:1px solid rgba(255,255,255,.14);
background: rgba(0,0,0,.18);
border-radius:16px;
padding:14px;
}
.panel h3{
margin:0 0 8px;
font-size:13px;
letter-spacing:.35px;
text-transform:uppercase;
color:var(--muted);
}
ul{margin:0;padding-left:18px}
li{margin:7px 0}
/* Activation steps */
.steps{
margin-top:16px;
display:grid;
gap:12px;
}
.step{
display:flex;
gap:12px;
align-items:flex-start;
}
.stepNum{
width:28px;height:28px;border-radius:50%;
display:flex;align-items:center;justify-content:center;
background:#34d399;color:#062015;
font-weight:900;font-size:14px;
flex:0 0 auto;
}
/* CTA */
.cta{
margin-top:18px;
display:grid;
gap:12px;
}
.btn{
appearance:none;
border:none;
border-radius: var(--btnRadius);
padding:14px 16px;
font-weight:900;
cursor:pointer;
display:flex;
justify-content:space-between;
align-items:center;
border:1px solid transparent;
}
.btnPrimary{
background: linear-gradient(180deg,#34d399,#10b981);
color:#052015;
border-color: rgba(52,211,153,.35);
}
.btnGhost{
background: rgba(255,255,255,.06);
color: var(--text);
border-color: rgba(255,255,255,.14);
}
.arrow{font-weight:900}
.fineprint{
margin-top:14px;
padding-top:12px;
border-top:1px solid rgba(255,255,255,.14);
font-size:12px;
color:var(--muted);
line-height:1.5;
}
/* Active Status Display */
.device-status{
display:none;
padding:16px;
border-radius:var(--btnRadius);
background:rgba(52,211,153,.1);
border:1px solid rgba(52,211,153,.3);
}
.device-status.active{
display:flex;
align-items:center;
gap:12px;
}
.status-dot{
width:12px;
height:12px;
border-radius:50%;
background:#34d399;
box-shadow:0 0 0 4px rgba(52,211,153,.2);
animation:pulse 2s infinite;
}
@keyframes pulse{
0%,100%{opacity:1}
50%{opacity:.7}
}
.status-text{
flex:1;
}
.status-text strong{
display:block;
color:var(--text);
margin-bottom:4px;
}
.status-text small{
display:block;
color:var(--muted);
font-size:12px;
}
</style>
</head>
<body>
<header class="nav">
<div class="nav-inner">
<a class="brand" href="home">
<div class="logo"></div>
<div>
<h1>HumanBlockchain.info</h1>
<small>Activate Device</small>
</div>
</a>
</div>
</header>
<main class="wrap">
<section class="card">
<div class="card-inner">
<div class="badge">
<span class="dot"></span>
Device activation enables loyalty & Proof of Delivery
</div>
<h2>Activate Your Device</h2>
<p class="muted">
Activating your device allows you to participate in
<strong>device-driven verification</strong> for loyalty points and Proof of Delivery
events.
</p>
Each device represents a single human participant.
<div class="grid">
<div class="panel">
<h3>Why activate?</h3>
<ul>
<li>Confirm deliveries using your own device</li>
<li>Participate in loyalty and recognition programs</li>
<li>Reduce disputes through verified confirmation</li>
<li>Maintain privacy with minimal data collection</li>
</ul>
</div>
<div class="panel">
<h3>What activation does</h3>
<ul>
<li>Creates a unique, hashed device identifier</li>
<li>Links scans to timestamp and location</li>
<li>Prevents duplicate or automated activity</li>
<li>Enables 2-scan Proof of Delivery</li>
</ul>
</div>
</div>
<div class="steps">
<div class="step">
<div class="stepNum">1</div>
<div>
<strong>Open this page on the device you will use</strong>
<p class="muted">Activation applies only to the current device.</p>
</div>
</div>
<div class="step">
<div class="stepNum">2</div>
<div>
<strong>Allow required permissions</strong>
<p class="muted">Location and camera access are used only during scans.</p>
</div>
</div>
<div class="step">
<div class="stepNum">3</div>
<div>
<strong>Confirm activation</strong>
<p class="muted">Your device becomes eligible for PoD and loyalty
participation.</p>
</div>
</div>
</div>
<div class="cta">
<!-- Active Status Display (hidden by default) -->
<div id="device-status-active" class="device-status">
<span class="status-dot"></span>
<div class="status-text">
<strong>Device Active</strong>
<small id="device-status-message">Your device is registered and ready to use</small>
</div>
</div>
<!-- Activate Button (shown by default) -->
<div id="device-activate-section">
<button class="btn btnPrimary" onclick="activateDevice()">
Activate This Device
<span class="arrow">→</span>
</button>
</div>
<button class="btn btnGhost" onclick="window.location.href='pod-mode'">
Go to PoD Mode
<span class="arrow">→</span>
</button>
</div>
<div class="fineprint">
<strong>Privacy note:</strong> HumanBlockchain does not store personal identity.
Device activation uses hashed identifiers and is limited to verification purposes
only.
Loyalty points and participation credits are governed by merchant or community
policy.
</div>
</div>
</section>
</main>
<?php
// Get current user info for JavaScript
$current_user = wp_get_current_user();
$user_data = array(
    'userId' => $current_user->ID,
    'userName' => $current_user->display_name,
    'userEmail' => $current_user->user_email,
    'loggedIn' => is_user_logged_in()
);
?>
<script>
// Pass WordPress user data to JavaScript
var hbcUserData = <?php echo json_encode($user_data); ?>;
</script>
<script>
/**
 * Generate UUIDv4
 */
function generateUUIDv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0;
        var v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

/**
 * Get or create device ID from localStorage
 */
function getOrCreateDeviceId() {
    let device_id = localStorage.getItem('hbc_device_id');
    if (!device_id) {
        device_id = generateUUIDv4();
        localStorage.setItem('hbc_device_id', device_id);
    }
    return device_id;
}

/**
 * Create device fingerprint (hybrid method)
 * Collects all available device properties
 */
function createDeviceFingerprint() {
    let fingerprint = {
        // Screen properties (usually stable)
        screen: {
            width: screen.width || null,
            height: screen.height || null,
            availWidth: screen.availWidth || null,
            availHeight: screen.availHeight || null,
            colorDepth: screen.colorDepth || null,
            pixelDepth: screen.pixelDepth || null
        },
        
        // Window properties
        window: {
            innerWidth: window.innerWidth || null,
            innerHeight: window.innerHeight || null,
            outerWidth: window.outerWidth || null,
            outerHeight: window.outerHeight || null,
            devicePixelRatio: window.devicePixelRatio || null
        },
        
        // Navigator properties
        navigator: {
            platform: navigator.platform || null,
            language: navigator.language || null,
            languages: navigator.languages ? Array.from(navigator.languages) : null,
            hardwareConcurrency: navigator.hardwareConcurrency || null,
            maxTouchPoints: navigator.maxTouchPoints || null,
            cookieEnabled: navigator.cookieEnabled || null,
            onLine: navigator.onLine || null,
            userAgent: navigator.userAgent || null
        },
        
        // Timezone
        timezone: {
            timezone: Intl.DateTimeFormat ? Intl.DateTimeFormat().resolvedOptions().timeZone : null,
            timezoneOffset: new Date().getTimezoneOffset() || null
        },
        
        // Date/time
        timestamp: {
            created: new Date().toISOString(),
            localTime: new Date().toString()
        }
    };
    
    // Try to get geolocation (with permission)
    // Note: This is async, so we'll handle it separately
    
    return fingerprint;
}

/**
 * Get geolocation (if permission granted)
 */
function getGeolocation() {
    return new Promise((resolve) => {
        // Check if geolocation is supported
        if (!navigator.geolocation) {
            resolve({ 
                available: false, 
                error: 'Geolocation not supported by this browser',
                errorCode: 'NOT_SUPPORTED'
            });
            return;
        }
        
        // Check if we're in a secure context (HTTPS or localhost)
        if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
            resolve({ 
                available: false, 
                error: 'Geolocation requires HTTPS (secure context)',
                errorCode: 'INSECURE_CONTEXT'
            });
            return;
        }
        
        // Try to get geolocation with error handling
        try {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    resolve({
                        available: true,
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude,
                        accuracy: position.coords.accuracy,
                        altitude: position.coords.altitude || null,
                        altitudeAccuracy: position.coords.altitudeAccuracy || null,
                        heading: position.coords.heading || null,
                        speed: position.coords.speed || null
                    });
                },
                (error) => {
                    // Map error codes to user-friendly messages
                    let errorMessage = 'Permission denied';
                    let errorCode = 'PERMISSION_DENIED';
                    
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = 'User denied geolocation permission';
                            errorCode = 'PERMISSION_DENIED';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = 'Location information unavailable';
                            errorCode = 'POSITION_UNAVAILABLE';
                            break;
                        case error.TIMEOUT:
                            errorMessage = 'Location request timed out';
                            errorCode = 'TIMEOUT';
                            break;
                        default:
                            errorMessage = error.message || 'Unknown geolocation error';
                            errorCode = 'UNKNOWN';
                    }
                    
                    resolve({
                        available: false,
                        error: errorMessage,
                        errorCode: errorCode
                    });
                },
                {
                    enableHighAccuracy: false,
                    timeout: 5000,
                    maximumAge: 60000
                }
            );
        } catch (e) {
            // Catch any unexpected errors
            resolve({
                available: false,
                error: 'Geolocation error: ' + (e.message || 'Unknown error'),
                errorCode: 'EXCEPTION'
            });
        }
    });
}

/**
 * Get user account info (if logged in)
 */
function getUserAccountInfo() {
    // Check if WordPress user is logged in
    // This would typically come from PHP/WordPress
    let userInfo = {
        loggedIn: false,
        userId: null,
        userName: null,
        userEmail: null
    };
    
    // Try to get from WordPress (if available)
    if (typeof wpApiSettings !== 'undefined' && wpApiSettings.currentUser) {
        userInfo.loggedIn = true;
        userInfo.userId = wpApiSettings.currentUser.id || null;
        userInfo.userName = wpApiSettings.currentUser.name || null;
        userInfo.userEmail = wpApiSettings.currentUser.email || null;
    }
    
    // Check for custom WordPress user data
    if (typeof hbcUserData !== 'undefined') {
        userInfo.loggedIn = true;
        userInfo.userId = hbcUserData.userId || null;
        userInfo.userName = hbcUserData.userName || null;
        userInfo.userEmail = hbcUserData.userEmail || null;
    }
    
    return userInfo;
}

/**
 * Get device name (if stored)
 */
function getDeviceName() {
    return localStorage.getItem('hbc_device_name') || null;
}

/**
 * Create device hash from fingerprint
 */
function createDeviceHash(fingerprint) {
    // Create a string from fingerprint (excluding user agent for cross-browser)
    let hashData = {
        screen: fingerprint.screen.width + 'x' + fingerprint.screen.height + 'x' + fingerprint.screen.colorDepth,
        timezone: fingerprint.timezone.timezone,
        language: fingerprint.navigator.language,
        hardware: fingerprint.navigator.hardwareConcurrency,
        touch: fingerprint.navigator.maxTouchPoints,
        platform: fingerprint.navigator.platform,
        pixelRatio: fingerprint.window.devicePixelRatio
    };
    
    // Simple hash function (for demo - use proper hashing in production)
    let hashString = JSON.stringify(hashData);
    let hash = 0;
    for (let i = 0; i < hashString.length; i++) {
        let char = hashString.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;
        hash = hash & hash; // Convert to 32-bit integer
    }
    
    return Math.abs(hash).toString(16);
}

/**
 * Main activation function
 */
async function activateDevice() {
    console.clear(); // Clear console for cleaner output
    console.log('%c=== Device Activation Started ===', 'color: #34d399; font-weight: bold; font-size: 14px;');
    console.log('Note: Any "spoofer.js" errors are from browser extensions, not our code.');
    
    // 1. Get or create device ID
    let device_id = getOrCreateDeviceId();
    console.log('%c✓ Device ID:', 'color: #34d399; font-weight: bold;', device_id);
    
    // 2. Create device fingerprint
    let fingerprint = createDeviceFingerprint();
    console.log('%c✓ Device Fingerprint Collected:', 'color: #34d399; font-weight: bold; font-size: 13px;');
    console.group('%cFingerprint Details:', 'color: #7c3aed; font-weight: bold;');
    console.log('%cScreen:', 'color: #60a5fa; font-weight: bold;', fingerprint.screen);
    console.log('%cWindow:', 'color: #60a5fa; font-weight: bold;', fingerprint.window);
    console.log('%cNavigator:', 'color: #60a5fa; font-weight: bold;', fingerprint.navigator);
    console.log('%cTimezone:', 'color: #60a5fa; font-weight: bold;', fingerprint.timezone);
    console.log('%cTimestamp:', 'color: #60a5fa; font-weight: bold;', fingerprint.timestamp);
    console.groupEnd();
    
    // 3. Create device hash
    let device_hash = createDeviceHash(fingerprint);
    console.log('%c✓ Device Hash:', 'color: #34d399; font-weight: bold;', device_hash);
    console.log('%c  (Created from: screen, timezone, language, hardware, touch, platform, pixelRatio)', 'color: #9ca3af; font-size: 11px;');
    
    // 4. Get geolocation (async)
    let geolocation = await getGeolocation();
    console.log('%c' + (geolocation.available ? '✓' : '⚠') + ' Geolocation:', geolocation.available ? 'color: #34d399; font-weight: bold;' : 'color: #fbbf24; font-weight: bold;');
    console.group('%cGeolocation Details:', 'color: #7c3aed; font-weight: bold;');
    if (geolocation.available) {
        console.log('%c✓ Available:', 'color: #34d399; font-weight: bold;', 'Yes');
        console.log('  Latitude:', geolocation.latitude);
        console.log('  Longitude:', geolocation.longitude);
        console.log('  Accuracy:', geolocation.accuracy + 'm');
        if (geolocation.altitude) console.log('  Altitude:', geolocation.altitude);
        if (geolocation.heading) console.log('  Heading:', geolocation.heading);
        if (geolocation.speed) console.log('  Speed:', geolocation.speed);
    } else {
        console.log('%c✗ Available:', 'color: #ef4444; font-weight: bold;', 'No');
        console.log('  Error:', geolocation.error);
        console.log('  Error Code:', geolocation.errorCode);
        if (geolocation.errorCode === 'INSECURE_CONTEXT') {
            console.log('%c  Note: Geolocation requires HTTPS. Use https:// or localhost for testing.', 'color: #fbbf24; font-style: italic;');
        }
    }
    console.groupEnd();
    
    // 5. Get user account info
    let userInfo = getUserAccountInfo();
    if (userInfo.loggedIn) {
        console.log('%c✓ User Account:', 'color: #34d399; font-weight: bold;', userInfo.userName + ' (ID: ' + userInfo.userId + ')');
    } else {
        console.log('%c⚠ User Account:', 'color: #fbbf24; font-weight: bold;', 'Not logged in');
    }
    
    // 6. Get device name
    let device_name = getDeviceName();
    if (device_name) {
        console.log('%c✓ Device Name:', 'color: #34d399; font-weight: bold;', device_name);
    } else {
        console.log('%c⚠ Device Name:', 'color: #fbbf24; font-weight: bold;', 'Not set');
    }
    
    // 7. Compile all information
    let deviceInfo = {
        device_id: device_id,
        device_hash: device_hash,
        device_name: device_name,
        fingerprint: fingerprint,
        geolocation: geolocation,
        user_account: userInfo,
        storage: {
            localStorage: {
                device_id: localStorage.getItem('hbc_device_id'),
                device_name: localStorage.getItem('hbc_device_name')
            },
            cookie: document.cookie || 'No cookies'
        }
    };
    
    // 8. Display in alert
    let alertMessage = '=== DEVICE ACTIVATION INFO ===\n\n';
    alertMessage += 'Device ID: ' + device_id + '\n';
    alertMessage += 'Device Hash: ' + device_hash + '\n';
    alertMessage += 'Device Name: ' + (device_name || 'Not set') + '\n\n';
    
    alertMessage += '--- User Account ---\n';
    alertMessage += 'Logged In: ' + (userInfo.loggedIn ? 'Yes' : 'No') + '\n';
    if (userInfo.loggedIn) {
        alertMessage += 'User ID: ' + (userInfo.userId || 'N/A') + '\n';
        alertMessage += 'User Name: ' + (userInfo.userName || 'N/A') + '\n';
        alertMessage += 'User Email: ' + (userInfo.userEmail || 'N/A') + '\n';
    }
    alertMessage += '\n';
    
    alertMessage += '--- Device Fingerprint ---\n';
    alertMessage += 'Screen Resolution: ' + fingerprint.screen.width + 'x' + fingerprint.screen.height + '\n';
    alertMessage += 'Available Screen: ' + fingerprint.screen.availWidth + 'x' + fingerprint.screen.availHeight + '\n';
    alertMessage += 'Color Depth: ' + fingerprint.screen.colorDepth + ' bits\n';
    alertMessage += 'Pixel Depth: ' + fingerprint.screen.pixelDepth + ' bits\n';
    alertMessage += 'Window Size: ' + fingerprint.window.innerWidth + 'x' + fingerprint.window.innerHeight + '\n';
    alertMessage += 'Outer Size: ' + fingerprint.window.outerWidth + 'x' + fingerprint.window.outerHeight + '\n';
    alertMessage += 'Pixel Ratio: ' + fingerprint.window.devicePixelRatio + '\n';
    alertMessage += 'Platform: ' + fingerprint.navigator.platform + '\n';
    alertMessage += 'Language: ' + fingerprint.navigator.language + '\n';
    alertMessage += 'Languages: ' + (fingerprint.navigator.languages ? fingerprint.navigator.languages.join(', ') : 'N/A') + '\n';
    alertMessage += 'Timezone: ' + fingerprint.timezone.timezone + '\n';
    alertMessage += 'Timezone Offset: ' + fingerprint.timezone.timezoneOffset + ' minutes\n';
    alertMessage += 'Hardware Cores: ' + fingerprint.navigator.hardwareConcurrency + '\n';
    alertMessage += 'Max Touch Points: ' + (fingerprint.navigator.maxTouchPoints || 'N/A') + '\n';
    alertMessage += 'Cookies Enabled: ' + (fingerprint.navigator.cookieEnabled ? 'Yes' : 'No') + '\n';
    alertMessage += 'Online Status: ' + (fingerprint.navigator.onLine ? 'Online' : 'Offline') + '\n';
    alertMessage += 'User Agent: ' + fingerprint.navigator.userAgent.substring(0, 50) + '...\n';
    alertMessage += '\n';
    
    alertMessage += '--- Geolocation ---\n';
    if (geolocation.available) {
        alertMessage += '✓ Location captured\n';
        alertMessage += 'Latitude: ' + geolocation.latitude + '\n';
        alertMessage += 'Longitude: ' + geolocation.longitude + '\n';
        alertMessage += 'Accuracy: ' + geolocation.accuracy + 'm\n';
    } else {
        alertMessage += '✗ Location not available\n';
        alertMessage += 'Reason: ' + (geolocation.error || 'Not available') + '\n';
        if (geolocation.errorCode) {
            alertMessage += 'Error Code: ' + geolocation.errorCode + '\n';
        }
    }
    alertMessage += '\n';
    
    alertMessage += '--- Storage ---\n';
    alertMessage += 'localStorage Device ID: ' + (deviceInfo.storage.localStorage.device_id || 'Not set') + '\n';
    alertMessage += 'localStorage Device Name: ' + (deviceInfo.storage.localStorage.device_name || 'Not set') + '\n';
    
    alertMessage += '\n\nCheck console for full details!';
    
    // Show alert
    alert(alertMessage);
    
    // Log complete info to console
    console.log('%c=== COMPLETE DEVICE INFO ===', 'color: #7c3aed; font-weight: bold; font-size: 14px;');
    console.log(deviceInfo);
    
    // Display formatted summary
    console.log('%c=== FINGERPRINT SUMMARY ===', 'color: #7c3aed; font-weight: bold; font-size: 13px;');
    console.table({
        'Screen Resolution': fingerprint.screen.width + 'x' + fingerprint.screen.height,
        'Color Depth': fingerprint.screen.colorDepth + ' bits',
        'Pixel Ratio': fingerprint.window.devicePixelRatio,
        'Platform': fingerprint.navigator.platform,
        'Language': fingerprint.navigator.language,
        'Timezone': fingerprint.timezone.timezone,
        'Hardware Cores': fingerprint.navigator.hardwareConcurrency,
        'Max Touch Points': fingerprint.navigator.maxTouchPoints || 'N/A',
        'Device Hash': device_hash
    });
    
    // Send data to backend API
    console.log('%c=== Sending to Backend API ===', 'color: #60a5fa; font-weight: bold; font-size: 13px;');
    
    const requestData = {
        device_id: device_id,
        device_hash: device_hash,
        device_name: device_name,
        wp_user_id: userInfo.loggedIn ? userInfo.userId : null,
        fingerprint: fingerprint,
        geolocation: geolocation
    };
    
    console.log('Request Data:', requestData);
    
    fetch('/wp-json/hb/v1/device/activate-hybrid', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        console.log('Response Status:', response.status, response.statusText);
        
        // Check if response is ok
        if (!response.ok) {
            // Try to get error message from response
            return response.json().then(errData => {
                console.error('%c✗ API Error Response:', 'color: #ef4444; font-weight: bold;', errData);
                throw new Error(errData.message || errData.code || 'Unknown error');
            });
        }
        
        return response.json();
    })
    .then(data => {
        console.log('%c✓ Device saved to database!', 'color: #34d399; font-weight: bold;');
        console.log('Response:', data);
        
        if (data.existing) {
            console.log('%c⚠ Device already exists in database', 'color: #fbbf24; font-weight: bold;');
            console.log('Status:', data.status);
            console.log('Database ID:', data.db_id);
        } else {
            console.log('%c✓ New device registered successfully!', 'color: #34d399; font-weight: bold;');
            console.log('Status:', data.status);
            console.log('Database ID:', data.db_id);
        }
        
        // Update UI to show active status
        if (data.status === 'activating' || data.status === 'validated') {
            showActiveStatus(data.status, data);
        }
        
        console.log('%c=== Device Activation Complete ===', 'color: #34d399; font-weight: bold; font-size: 14px;');
        console.log('%cAll device information saved to database!', 'color: #34d399; font-weight: bold;');
    })
    .catch(error => {
        console.error('%c✗ Error saving device:', 'color: #ef4444; font-weight: bold;', error);
        console.error('Error message:', error.message);
        console.error('Full error:', error);
        alert('Error activating device: ' + error.message + '\n\nCheck console for details.');
    });
    
    // Return device info for further processing
    return deviceInfo;
}

/**
 * Check if device is already active and update UI
 */
async function checkDeviceActive() {
    let device_id = localStorage.getItem('hbc_device_id');
    
    if (!device_id) {
        console.log('%c⚠ Cannot check device status: No device ID found', 'color: #fbbf24; font-weight: bold;');
        showActivateButton(); // Show button if no device ID
        return false;
    }
    
    // Create fingerprint and hash
    let fingerprint = createDeviceFingerprint();
    let device_hash = createDeviceHash(fingerprint);
    let userInfo = getUserAccountInfo();
    
    if (!device_id || !device_hash) {
        console.log('%c⚠ Cannot check device status: Missing device ID or hash', 'color: #fbbf24; font-weight: bold;');
        showActivateButton(); // Show button if missing data
        return false;
    }
    
    console.log('%c=== Checking Device Status ===', 'color: #60a5fa; font-weight: bold; font-size: 13px;');
    
    try {
        const response = await fetch('/wp-json/hb/v1/device/check-active', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                device_id: device_id,
                device_hash: device_hash,
                wp_user_id: userInfo.loggedIn ? userInfo.userId : null
            })
        });
        
        const data = await response.json();
        
        if (data.active) {
            console.log('%c✓ Device is ACTIVE!', 'color: #34d399; font-weight: bold;');
            console.log('Device Status:', data.status);
            console.log('Device Data:', data.device);
            
            // Show active status, hide activate button
            showActiveStatus(data.status, data.device);
            return true;
        } else {
            console.log('%c⚠ Device is NOT active', 'color: #fbbf24; font-weight: bold;');
            console.log('Message:', data.message);
            
            // Show activate button, hide active status
            showActivateButton();
            return false;
        }
    } catch (error) {
        console.error('%c✗ Error checking device status:', 'color: #ef4444; font-weight: bold;', error);
        showActivateButton(); // Show button on error
        return false;
    }
}

/**
 * Show active status with green dot
 */
function showActiveStatus(status, deviceData) {
    const statusDiv = document.getElementById('device-status-active');
    const activateSection = document.getElementById('device-activate-section');
    const statusMessage = document.getElementById('device-status-message');
    
    if (statusDiv && activateSection) {
        // Hide activate button
        activateSection.style.display = 'none';
        
        // Show active status
        statusDiv.classList.add('active');
        
        // Update status message based on status
        let message = 'Your device is registered and ready to use';
        if (status === 'validated') {
            message = 'Your device is fully validated and ready for all features';
        } else if (status === 'activating') {
            message = 'Your device is activated and ready to use';
        }
        
        if (statusMessage) {
            statusMessage.textContent = message;
        }
        
        console.log('%c✓ UI Updated: Active status displayed', 'color: #34d399; font-weight: bold;');
    }
}

/**
 * Show activate button
 */
function showActivateButton() {
    const statusDiv = document.getElementById('device-status-active');
    const activateSection = document.getElementById('device-activate-section');
    
    if (statusDiv && activateSection) {
        // Hide active status
        statusDiv.classList.remove('active');
        
        // Show activate button
        activateSection.style.display = 'block';
        
        console.log('%c✓ UI Updated: Activate button displayed', 'color: #60a5fa; font-weight: bold;');
    }
}

// Check device status when page loads
document.addEventListener('DOMContentLoaded', function() {
    checkDeviceActive();
});
</script>
</body>
</html>
