(function () {
	'use strict';

	var root = document.getElementById('hb-postcard-tools');
	if (!root || !window.hbPostcard) {
		return;
	}

	var cfg = window.hbPostcard;
	var statusEl = document.getElementById('hb-postcard-status');
	var pocInput = document.getElementById('hb-postcard-poc');
	var sponsorInput = document.getElementById('hb-postcard-sponsor');
	var campaignInput = document.getElementById('hb-postcard-campaign');
	var refInput = document.getElementById('hb-postcard-ref-url');
	var previewImg = document.getElementById('hb-postcard-preview-img');
	var previewPlaceholder = document.getElementById('hb-postcard-preview-placeholder');
	var downloadWrap = document.getElementById('hb-postcard-download-wrap');

	function setStatus(msg, isError) {
		if (!statusEl) {
			return;
		}
		statusEl.textContent = msg || '';
		statusEl.style.color = isError ? '#f87171' : '#86efac';
	}

	function fieldPayload() {
		return {
			action: '',
			nonce: cfg.nonce,
			poc: pocInput ? pocInput.value : '',
			sponsor: sponsorInput ? sponsorInput.value : '',
			campaign: campaignInput ? campaignInput.value : ''
		};
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

	function post(action, extra) {
		var body = new URLSearchParams();
		body.set('action', action);
		body.set('nonce', cfg.nonce);
		if (extra) {
			Object.keys(extra).forEach(function (key) {
				body.set(key, extra[key]);
			});
		}
		return fetch(cfg.ajaxUrl, {
			method: 'POST',
			credentials: 'same-origin',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
			body: body.toString()
		}).then(function (r) { return r.json(); });
	}

	function showImage(url) {
		if (!url) {
			return;
		}
		if (previewImg) {
			previewImg.src = url + (url.indexOf('?') >= 0 ? '&' : '?') + 't=' + Date.now();
			previewImg.hidden = false;
			previewImg.classList.remove('hb-postcard-preview-img--master');
		}
		if (previewPlaceholder) {
			previewPlaceholder.hidden = true;
		}
		if (downloadWrap) {
			downloadWrap.hidden = false;
		}
		root.dataset.hasImage = '1';
		var genBtn = document.getElementById('hb-postcard-generate-btn');
		if (genBtn) {
			genBtn.textContent = 'Regenerate Postcard';
		}
	}

	var saveBtn = document.getElementById('hb-postcard-save-btn');
	if (saveBtn) {
		saveBtn.addEventListener('click', function () {
			setStatus(cfg.i18n.saving, false);
			var data = fieldPayload();
			post('hb_save_postcard_fields', {
				poc: data.poc,
				sponsor: data.sponsor,
				campaign: data.campaign
			}).then(function (json) {
				if (!json || !json.success) {
					setStatus((json && json.data && json.data.message) || 'Error', true);
					return;
				}
				setStatus(json.data.message || cfg.i18n.copied, false);
			}).catch(function () {
				setStatus('Request failed', true);
			});
		});
	}

	document.getElementById('hb-postcard-generate-btn').addEventListener('click', function () {
		setStatus(cfg.i18n.generating, false);
		var data = fieldPayload();
		post('hb_generate_postcard', {
			poc: data.poc,
			sponsor: data.sponsor,
			campaign: data.campaign
		}).then(function (json) {
			if (!json || !json.success) {
				setStatus((json && json.data && json.data.message) || 'Error', true);
				return;
			}
			if (json.data.scan_url && refInput) {
				refInput.value = json.data.scan_url;
				var previewVcard = document.getElementById('hb-postcard-ref-preview');
				if (previewVcard) {
					previewVcard.href = json.data.scan_url;
					previewVcard.removeAttribute('aria-disabled');
					previewVcard.removeAttribute('tabindex');
				}
				var copyBtn = document.getElementById('hb-postcard-ref-copy');
				if (copyBtn) {
					copyBtn.disabled = false;
				}
			}
			showImage(json.data.image_url);
			setStatus(json.data.message || 'Done', false);
		}).catch(function () {
			setStatus('Request failed', true);
		});
	});

	document.getElementById('hb-postcard-ref-copy').addEventListener('click', function () {
		if (!refInput) {
			return;
		}
		copyText(refInput.value).then(function () {
			setStatus(cfg.i18n.copied, false);
		}).catch(function () {
			setStatus(cfg.i18n.copyFail, true);
		});
	});

	var deleteBtn = document.getElementById('hb-postcard-delete-btn');
	if (deleteBtn) {
		deleteBtn.addEventListener('click', function () {
			if (!window.confirm(cfg.i18n.confirmDel)) {
				return;
			}
			post('hb_delete_postcard', {}).then(function (json) {
				if (!json || !json.success) {
					setStatus((json && json.data && json.data.message) || 'Error', true);
					return;
				}
				if (previewImg) {
					previewImg.src = '';
					previewImg.hidden = true;
				}
				if (previewPlaceholder) {
					previewPlaceholder.hidden = false;
				}
				if (downloadWrap) {
					downloadWrap.hidden = true;
				}
				root.dataset.hasImage = '0';
				var genBtn = document.getElementById('hb-postcard-generate-btn');
				if (genBtn) {
					genBtn.textContent = 'Generate Postcard';
				}
				setStatus(json.data.message || 'Removed', false);
			});
		});
	}
})();
