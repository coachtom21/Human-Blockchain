(function () {
	'use strict';

	var root = document.getElementById('hb-hang-tag-tools');
	if (!root || !window.hbHangTag) {
		return;
	}

	var cfg = window.hbHangTag;
	var statusEl = document.getElementById('hb-hang-tag-status');
	var scanInput = document.getElementById('hb-hang-tag-scan-url');
	var qrImg = document.getElementById('hb-hang-tag-qr-img');
	var previewLink = document.getElementById('hb-hang-tag-preview-link');
	var copyBtn = document.getElementById('hb-hang-tag-copy-btn');

	function setStatus(msg, isError) {
		if (!statusEl) {
			return;
		}
		statusEl.textContent = msg || '';
		statusEl.style.color = isError ? '#f87171' : '#86efac';
	}

	function copyText(text) {
		if (navigator.clipboard && navigator.clipboard.writeText) {
			return navigator.clipboard.writeText(text);
		}
		return new Promise(function (resolve, reject) {
			var ta = document.createElement('textarea');
			ta.value = text;
			document.body.appendChild(ta);
			ta.select();
			try {
				document.execCommand('copy');
				resolve();
			} catch (e) {
				reject(e);
			}
			document.body.removeChild(ta);
		});
	}

	function updateScanUi(scanUrl, qrImageUrl) {
		if (scanInput && scanUrl) {
			scanInput.value = scanUrl;
		}
		if (previewLink && scanUrl) {
			previewLink.href = scanUrl;
			previewLink.removeAttribute('aria-disabled');
			previewLink.removeAttribute('tabindex');
		}
		if (copyBtn && scanUrl) {
			copyBtn.disabled = false;
		}
		if (qrImageUrl) {
			var qrInner = document.querySelector('.hb-hang-tag-preview-stage .qr-inner');
			if (qrImg) {
				qrImg.src = qrImageUrl + (qrImageUrl.indexOf('?') >= 0 ? '&' : '?') + 't=' + Date.now();
			} else if (qrInner) {
				qrInner.classList.remove('qr-inner--placeholder');
				qrInner.innerHTML = '<img id="hb-hang-tag-qr-img" class="hb-hang-tag-qr-img" src="' +
					qrImageUrl + '" alt="Your dynamic Universal QR" width="62" height="62">';
				qrImg = document.getElementById('hb-hang-tag-qr-img');
			}
		}
	}

	var refreshBtn = document.getElementById('hb-hang-tag-refresh-btn');
	if (refreshBtn) {
		refreshBtn.addEventListener('click', function () {
			setStatus(cfg.i18n.refreshing, false);
			var body = new URLSearchParams();
			body.set('action', 'hb_refresh_hang_tag_qr');
			body.set('nonce', cfg.nonce);

			fetch(cfg.ajaxUrl, {
				method: 'POST',
				credentials: 'same-origin',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
				body: body.toString()
			})
				.then(function (r) { return r.json(); })
				.then(function (json) {
					if (!json || !json.success) {
						setStatus((json && json.data && json.data.message) || cfg.i18n.refreshFail, true);
						return;
					}
					updateScanUi(json.data.scan_url || '', json.data.qr_image_url || '');
					setStatus(json.data.message || '', false);
				})
				.catch(function () {
					setStatus(cfg.i18n.refreshFail, true);
				});
		});
	}

	if (copyBtn) {
		copyBtn.addEventListener('click', function () {
			if (!scanInput || !scanInput.value) {
				return;
			}
			copyText(scanInput.value)
				.then(function () {
					setStatus(cfg.i18n.copied, false);
				})
				.catch(function () {
					setStatus(cfg.i18n.copyFail, true);
				});
		});
	}

	var printBtn = document.getElementById('hb-hang-tag-print-btn');
	if (printBtn) {
		printBtn.addEventListener('click', function () {
			window.print();
		});
	}
})();
