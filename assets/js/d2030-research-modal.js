(function () {
	'use strict';

	function openD2030Modal() {
		var el = document.getElementById('d2030-modal');
		if (!el) {
			return;
		}
		el.style.display = 'block';
		el.removeAttribute('hidden');
		document.body.style.overflow = 'hidden';
	}

	function closeD2030Modal() {
		var el = document.getElementById('d2030-modal');
		if (!el) {
			return;
		}
		el.style.display = 'none';
		el.setAttribute('hidden', 'hidden');
		document.body.style.overflow = '';
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
		if (event.key === 'Escape') {
			closeD2030Modal();
		}
	});
})();
