(function () {
	'use strict';

	var scrollLockY = 0;
	var touchMoveLocked = false;

	function isD2030Open() {
		var el = document.getElementById('d2030-modal');
		return el && !el.hasAttribute('hidden') && el.style.display !== 'none';
	}

	function preventBackgroundTouchMove(event) {
		if (!isD2030Open()) {
			return;
		}
		var modal = document.getElementById('d2030-modal');
		var content = modal ? modal.querySelector('.d2030-modal-content') : null;
		if (content && content.contains(event.target)) {
			return;
		}
		event.preventDefault();
	}

	function lockPageScroll() {
		scrollLockY = window.scrollY || window.pageYOffset || 0;
		document.documentElement.classList.add('d2030-modal-open');
		document.body.classList.add('d2030-modal-open');
		document.body.style.top = '-' + scrollLockY + 'px';

		if (!touchMoveLocked) {
			document.addEventListener('touchmove', preventBackgroundTouchMove, { passive: false });
			touchMoveLocked = true;
		}
	}

	function unlockPageScroll() {
		document.documentElement.classList.remove('d2030-modal-open');
		document.body.classList.remove('d2030-modal-open');
		document.body.style.top = '';
		window.scrollTo(0, scrollLockY);

		if (touchMoveLocked) {
			document.removeEventListener('touchmove', preventBackgroundTouchMove, { passive: false });
			touchMoveLocked = false;
		}
	}

	function openD2030Modal() {
		var el = document.getElementById('d2030-modal');
		if (!el) {
			return;
		}
		el.style.display = 'block';
		el.removeAttribute('hidden');
		lockPageScroll();
	}

	function pauseD2030ModalMedia() {
		var modal = document.getElementById('d2030-modal');
		if (!modal) {
			return;
		}
		modal.querySelectorAll('.d2030-preview-video, .d2030-preview-audio').forEach(function (media) {
			if (!media.paused) {
				media.pause();
			}
		});
	}

	function closeD2030Modal() {
		var el = document.getElementById('d2030-modal');
		if (!el) {
			return;
		}
		pauseD2030ModalMedia();
		el.style.display = 'none';
		el.setAttribute('hidden', 'hidden');
		unlockPageScroll();
	}

	window.openD2030Modal = openD2030Modal;
	window.closeD2030Modal = closeD2030Modal;

	document.addEventListener('click', function (event) {
		var modal = document.getElementById('d2030-modal');
		if (modal && event.target === modal) {
			closeD2030Modal();
		}
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape' && isD2030Open()) {
			closeD2030Modal();
		}
	});
})();
