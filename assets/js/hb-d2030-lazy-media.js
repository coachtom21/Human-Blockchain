(function () {
	'use strict';

	function loadMedia(wrap) {
		if (!wrap || wrap.classList.contains('is-loaded')) {
			return;
		}
		var src = wrap.getAttribute('data-src');
		var kind = wrap.getAttribute('data-kind') || 'video';
		if (!src) {
			return;
		}
		var el = wrap.querySelector('.d2030-media-lazy__target');
		if (!el) {
			return;
		}
		el.src = src;
		el.removeAttribute('hidden');
		wrap.classList.add('is-loaded');
		var btn = wrap.querySelector('.d2030-media-lazy__play');
		if (btn) {
			btn.setAttribute('hidden', 'hidden');
		}
		el.load();
		if (kind === 'video') {
			var playPromise = el.play();
			if (playPromise && typeof playPromise.catch === 'function') {
				playPromise.catch(function () {
					/* Autoplay blocked — controls remain usable */
				});
			}
		}
	}

	function onPlayClick(event) {
		var btn = event.target.closest('.d2030-media-lazy__play');
		if (!btn) {
			return;
		}
		var wrap = btn.closest('.d2030-media-lazy');
		if (wrap) {
			loadMedia(wrap);
		}
	}

	document.addEventListener('click', onPlayClick);

	document.addEventListener('visibilitychange', function () {
		if (document.visibilityState !== 'hidden') {
			return;
		}
		document.querySelectorAll('.d2030-media-lazy__target').forEach(function (el) {
			if (!el.paused) {
				el.pause();
			}
		});
	});
})();
