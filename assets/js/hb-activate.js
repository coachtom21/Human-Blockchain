/**
 * Activate funnel: register device. Discord Gracebook is optional (not a redirect gate).
 *
 * @package HelloElementorChild
 */
(function () {
	'use strict';

	var cfg = window.HB_ACTIVATE || {};
	var form = document.getElementById('hb-activate-form');
	var registerBtn = document.getElementById('hb-register-btn');
	var registerMsg = document.getElementById('hb-register-msg');
	var graceBtn = document.getElementById('hb-gracebook-btn');
	var graceSkip = document.getElementById('hb-gracebook-skip');
	var graceMsg = document.getElementById('hb-gracebook-msg');
	var devicePanel = document.getElementById('hb-device-panel');
	var gracePanel = document.getElementById('hb-gracebook-panel');
	var completePanel = document.getElementById('hb-complete-panel');

	function show(panel) {
		if (devicePanel) devicePanel.hidden = panel !== devicePanel;
		if (completePanel) completePanel.hidden = panel !== completePanel;
		// gracePanel lives inside completePanel as an optional block — do not hide it when Ready shows.
	}

	function setMsg(el, text, isError) {
		if (!el) return;
		el.className = isError ? 'hb-act-msg is-error' : 'hb-act-msg';
		el.textContent = text || '';
	}

	function deviceHash() {
		var raw = [
			navigator.userAgent || '',
			screen.width + 'x' + screen.height,
			Intl.DateTimeFormat().resolvedOptions().timeZone || '',
			navigator.language || ''
		].join('|');
		if (window.crypto && crypto.subtle && window.TextEncoder) {
			return crypto.subtle.digest('SHA-256', new TextEncoder().encode(raw)).then(function (buf) {
				return Array.from(new Uint8Array(buf)).map(function (b) {
					return b.toString(16).padStart(2, '0');
				}).join('');
			});
		}
		var h = 0;
		for (var i = 0; i < raw.length; i++) {
			h = ((h << 5) - h) + raw.charCodeAt(i);
			h |= 0;
		}
		return Promise.resolve('fallback-' + Math.abs(h).toString(16) + '-' + raw.length);
	}

	if (form && registerBtn) {
		form.addEventListener('submit', function (event) {
			event.preventDefault();
			if (!form.reportValidity()) return;
			setMsg(registerMsg, '');
			registerBtn.disabled = true;
			deviceHash().then(function (hash) {
				var body = new FormData(form);
				body.append('action', 'hb_funnel_register');
				body.append('nonce', cfg.nonce || '');
				body.append('funnel_id', cfg.funnelId || '');
				body.append('device_hash', hash);
				if (form.privacy_ok && form.privacy_ok.checked) {
					body.append('privacy_ok', '1');
				}
				return fetch(cfg.ajaxUrl, { method: 'POST', credentials: 'same-origin', body: body });
			}).then(function (res) {
				return res.json();
			}).then(function (json) {
				if (!json || !json.success) {
					throw new Error((json && json.data && json.data.message) || 'Registration failed');
				}
				setMsg(registerMsg, (json.data && json.data.message) || 'Device recognized.');
				// Client: Discord is optional — do not force Gracebook or open Discord.
				show(completePanel);
			}).catch(function (err) {
				setMsg(registerMsg, err.message || 'Registration failed.', true);
				registerBtn.disabled = false;
			});
		});
	}

	if (graceBtn) {
		graceBtn.addEventListener('click', function () {
			setMsg(graceMsg, '');
			graceBtn.disabled = true;
			var body = new FormData();
			body.append('action', 'hb_funnel_gracebook');
			body.append('nonce', cfg.nonce || '');
			body.append('funnel_id', cfg.funnelId || '');
			fetch(cfg.ajaxUrl, { method: 'POST', credentials: 'same-origin', body: body })
				.then(function (res) { return res.json(); })
				.then(function (json) {
					if (!json || !json.success) {
						throw new Error((json && json.data && json.data.message) || 'Could not save optional Gracebook note');
					}
					setMsg(graceMsg, 'Optional Gracebook interest saved. Discord was not opened automatically.');
					var link = document.getElementById('hb-discord-optional-link');
					var url = (json.data && json.data.discordUrl) || cfg.discordUrl;
					if (link && url) {
						link.href = url;
						link.hidden = false;
					}
					show(completePanel);
				})
				.catch(function (err) {
					setMsg(graceMsg, err.message || 'Could not save optional Gracebook note.', true);
					graceBtn.disabled = false;
				});
		});
	}

	if (graceSkip) {
		graceSkip.addEventListener('click', function () {
			show(completePanel);
		});
	}
})();
