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
	var previewFrontTrigger = previewImg ? previewImg.closest('.hb-postcard-preview-trigger') : null;
	var previewCol = document.getElementById('hb-postcard-preview-col');
	var printNote = document.getElementById('hb-postcard-print-note');
	var downloadWrap = document.getElementById('hb-postcard-download-wrap');
	var referralWrap = document.getElementById('hb-postcard-referral-wrap');

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

	function showGeneratedUi(url, scanUrl) {
		if (url && previewImg) {
			previewImg.src = url + (url.indexOf('?') >= 0 ? '&' : '?') + 't=' + Date.now();
			previewImg.hidden = false;
		}
		if (previewFrontTrigger) {
			previewFrontTrigger.hidden = false;
			previewFrontTrigger.disabled = false;
		}
		if (previewCol) {
			previewCol.hidden = false;
		}
		if (printNote) {
			printNote.hidden = false;
		}
		if (referralWrap) {
			referralWrap.hidden = false;
		}
		if (downloadWrap) {
			downloadWrap.hidden = false;
		}
		if (scanUrl && refInput) {
			refInput.value = scanUrl;
			var previewVcard = document.getElementById('hb-postcard-ref-preview');
			if (previewVcard) {
				previewVcard.href = scanUrl;
				previewVcard.removeAttribute('aria-disabled');
				previewVcard.removeAttribute('tabindex');
			}
			var copyBtn = document.getElementById('hb-postcard-ref-copy');
			if (copyBtn) {
				copyBtn.disabled = false;
			}
		}
		root.dataset.hasImage = '1';
		var genBtn = document.getElementById('hb-postcard-generate-btn');
		if (genBtn) {
			genBtn.textContent = 'Regenerate Postcard';
		}
	}

	function hideGeneratedUi() {
		closeLightbox();
		if (previewImg) {
			previewImg.src = '';
			previewImg.hidden = true;
		}
		if (previewFrontTrigger) {
			previewFrontTrigger.hidden = true;
			previewFrontTrigger.disabled = true;
		}
		if (previewCol) {
			previewCol.hidden = true;
		}
		if (printNote) {
			printNote.hidden = true;
		}
		if (referralWrap) {
			referralWrap.hidden = true;
		}
		if (downloadWrap) {
			downloadWrap.hidden = true;
		}
		root.dataset.hasImage = '0';
		var genBtn = document.getElementById('hb-postcard-generate-btn');
		if (genBtn) {
			genBtn.textContent = 'Generate Postcard';
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
			showGeneratedUi(json.data.image_url, json.data.scan_url || '');
			setStatus(json.data.message || 'Done', false);
		}).catch(function () {
			setStatus('Request failed', true);
		});
	});

	var refCopyBtn = document.getElementById('hb-postcard-ref-copy');
	if (refCopyBtn) {
		refCopyBtn.addEventListener('click', function () {
			if (!refInput) {
				return;
			}
			copyText(refInput.value).then(function () {
				setStatus(cfg.i18n.copied, false);
			}).catch(function () {
				setStatus(cfg.i18n.copyFail, true);
			});
		});
	}

	var lightbox = document.getElementById('hb-postcard-lightbox');
	var lightboxImg = document.getElementById('hb-postcard-lightbox-img');
	var lightboxCaption = document.getElementById('hb-postcard-lightbox-caption');
	var lightboxSlides = [];
	var lightboxIndex = 0;
	var lightboxLastFocus = null;

	function getLightboxSlides() {
		var slides = [];
		root.querySelectorAll('[data-hb-lightbox]').forEach(function (trigger) {
			if (trigger.hidden || trigger.disabled) {
				return;
			}
			var img = trigger.querySelector('.hb-postcard-preview-img');
			if (!img || img.hidden || !img.src) {
				return;
			}
			var labelEl = trigger.closest('.hb-postcard-preview-card');
			var caption = '';
			if (labelEl) {
				var cap = labelEl.querySelector('.hb-postcard-preview-label');
				caption = cap ? cap.textContent.trim() : '';
			}
			slides.push({
				src: img.currentSrc || img.src,
				alt: img.alt || '',
				caption: caption
			});
		});
		return slides;
	}

	function updateLightboxNav() {
		var showNav = lightboxSlides.length > 1;
		var prevBtn = lightbox ? lightbox.querySelector('[data-hb-lightbox-prev]') : null;
		var nextBtn = lightbox ? lightbox.querySelector('[data-hb-lightbox-next]') : null;
		if (prevBtn) {
			prevBtn.hidden = !showNav;
		}
		if (nextBtn) {
			nextBtn.hidden = !showNav;
		}
	}

	function renderLightboxSlide() {
		if (!lightboxImg || !lightboxSlides.length) {
			return;
		}
		var slide = lightboxSlides[lightboxIndex];
		lightboxImg.src = slide.src;
		lightboxImg.alt = slide.alt;
		if (lightboxCaption) {
			lightboxCaption.textContent = slide.caption;
		}
		updateLightboxNav();
	}

	function openLightbox(index) {
		lightboxSlides = getLightboxSlides();
		if (!lightbox || !lightboxSlides.length) {
			return;
		}
		lightboxIndex = Math.max(0, Math.min(index, lightboxSlides.length - 1));
		lightboxLastFocus = document.activeElement;
		renderLightboxSlide();
		lightbox.hidden = false;
		lightbox.setAttribute('aria-hidden', 'false');
		document.body.classList.add('hb-postcard-lightbox-open');
		var closeBtn = lightbox.querySelector('.hb-postcard-lightbox-close');
		if (closeBtn) {
			closeBtn.focus();
		}
	}

	function closeLightbox() {
		if (!lightbox || lightbox.hidden) {
			return;
		}
		lightbox.hidden = true;
		lightbox.setAttribute('aria-hidden', 'true');
		document.body.classList.remove('hb-postcard-lightbox-open');
		if (lightboxImg) {
			lightboxImg.removeAttribute('src');
		}
		if (lightboxLastFocus && typeof lightboxLastFocus.focus === 'function') {
			lightboxLastFocus.focus();
		}
		lightboxLastFocus = null;
	}

	function stepLightbox(delta) {
		if (!lightboxSlides.length) {
			return;
		}
		lightboxIndex = (lightboxIndex + delta + lightboxSlides.length) % lightboxSlides.length;
		renderLightboxSlide();
	}

	root.querySelectorAll('[data-hb-lightbox]').forEach(function (trigger, idx) {
		trigger.addEventListener('click', function () {
			var slides = getLightboxSlides();
			var img = trigger.querySelector('.hb-postcard-preview-img');
			var src = img ? (img.currentSrc || img.src) : '';
			var index = 0;
			slides.forEach(function (slide, i) {
				if (slide.src === src) {
					index = i;
				}
			});
			openLightbox(index);
		});
	});

	if (lightbox) {
		lightbox.querySelectorAll('[data-hb-lightbox-close]').forEach(function (el) {
			el.addEventListener('click', closeLightbox);
		});
		var prevBtn = lightbox.querySelector('[data-hb-lightbox-prev]');
		var nextBtn = lightbox.querySelector('[data-hb-lightbox-next]');
		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				stepLightbox(-1);
			});
		}
		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				stepLightbox(1);
			});
		}
		document.addEventListener('keydown', function (e) {
			if (lightbox.hidden) {
				return;
			}
			if (e.key === 'Escape') {
				closeLightbox();
			} else if (e.key === 'ArrowLeft') {
				stepLightbox(-1);
			} else if (e.key === 'ArrowRight') {
				stepLightbox(1);
			}
		});
	}

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
				hideGeneratedUi();
				setStatus(json.data.message || 'Removed', false);
			});
		});
	}

	function parseDownloadFilename(disposition, fallback) {
		if (!disposition) {
			return fallback;
		}
		var utfMatch = /filename\*=UTF-8''([^;]+)/i.exec(disposition);
		if (utfMatch && utfMatch[1]) {
			return decodeURIComponent(utfMatch[1].trim());
		}
		var plainMatch = /filename="?([^";]+)"?/i.exec(disposition);
		if (plainMatch && plainMatch[1]) {
			return plainMatch[1].trim();
		}
		return fallback;
	}

	function downloadBlobFile(blob, filename) {
		var objectUrl = URL.createObjectURL(blob);
		var link = document.createElement('a');
		link.href = objectUrl;
		link.download = filename;
		link.style.display = 'none';
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
		window.setTimeout(function () {
			URL.revokeObjectURL(objectUrl);
		}, 2000);
	}

	function downloadFromUrl(url, fallbackName) {
		return fetch(url, {
			credentials: 'same-origin',
			cache: 'no-store'
		}).then(function (response) {
			if (!response.ok) {
				throw new Error('HTTP ' + response.status);
			}
			var disposition = response.headers.get('Content-Disposition');
			return response.blob().then(function (blob) {
				return {
					blob: blob,
					filename: parseDownloadFilename(disposition, fallbackName)
				};
			});
		}).then(function (result) {
			downloadBlobFile(result.blob, result.filename);
		});
	}

	function downloadPostcardSides(format) {
		var urls = cfg.downloads && cfg.downloads[format];
		if (!urls || !urls.front) {
			return;
		}
		var ext = format === 'jpg' ? 'jpg' : 'png';
		var uid = cfg.userId || 'postcard';
		var frontName = 'postcard-' + uid + '-front.' + ext;
		var backName = 'postcard-' + uid + '-back.' + ext;

		setStatus(cfg.i18n.downloading || 'Downloading…', false);

		downloadFromUrl(urls.front, frontName)
			.then(function () {
				if (!urls.back) {
					return;
				}
				return new Promise(function (resolve) {
					window.setTimeout(resolve, 500);
				}).then(function () {
					return downloadFromUrl(urls.back, backName);
				});
			})
			.then(function () {
				setStatus('', false);
			})
			.catch(function () {
				setStatus(cfg.i18n.downloadFail || 'Download failed', true);
			});
	}

	['png', 'jpg'].forEach(function (format) {
		var btn = document.getElementById('hb-postcard-dl-' + format);
		if (!btn) {
			return;
		}
		btn.addEventListener('click', function () {
			downloadPostcardSides(format);
		});
	});
})();
