/**
 * Oligopoly Umbrella role modal.
 */
(function () {
	'use strict';

	var backdrop = document.getElementById( 'hb-ou-modal' );
	if ( ! backdrop ) {
		return;
	}

	var closeBtn = backdrop.querySelector( '.close' );
	var lastFocus = null;

	function isOpen() {
		return ! backdrop.hasAttribute( 'hidden' );
	}

	function openModal() {
		lastFocus = document.activeElement;
		backdrop.removeAttribute( 'hidden' );
		document.body.classList.add( 'hb-ou-modal-open' );
		if ( closeBtn ) {
			closeBtn.focus();
		}
	}

	function closeModal() {
		backdrop.setAttribute( 'hidden', '' );
		document.body.classList.remove( 'hb-ou-modal-open' );
		if ( lastFocus && typeof lastFocus.focus === 'function' ) {
			lastFocus.focus();
		}
	}

	document.querySelectorAll( '[data-open-oligopoly-umbrella]' ).forEach( function ( el ) {
		el.addEventListener( 'click', function ( event ) {
			event.preventDefault();
			openModal();
		} );
	} );

	if ( closeBtn ) {
		closeBtn.addEventListener( 'click', closeModal );
	}

	backdrop.addEventListener( 'mousedown', function ( event ) {
		if ( event.target === backdrop ) {
			closeModal();
		}
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'Escape' && isOpen() ) {
			closeModal();
		}
	} );
} )();
