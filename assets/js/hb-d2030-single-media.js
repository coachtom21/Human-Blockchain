(function () {
	'use strict';

	var MEDIA_SELECTOR = '.d2030-preview-video, .d2030-preview-audio';

	function isD2030Media(el) {
		return el && el.matches && el.matches(MEDIA_SELECTOR);
	}

	function pauseOtherMedia(current) {
		document.querySelectorAll(MEDIA_SELECTOR).forEach(function (el) {
			if (el !== current && !el.paused) {
				el.pause();
			}
		});
	}

	document.addEventListener(
		'play',
		function (event) {
			if (!isD2030Media(event.target)) {
				return;
			}
			pauseOtherMedia(event.target);
		},
		true
	);
})();
