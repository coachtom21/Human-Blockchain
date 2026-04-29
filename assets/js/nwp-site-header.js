/**
 * NWP site header: mobile menu toggle, resize + Escape handling.
 */
(function () {
	'use strict';

	var nav = document.querySelector( '.nwp-site-header' );
	if ( ! nav ) {
		return;
	}

	var btn = document.getElementById( 'nwp-header-menu-btn' );
	var panel = document.getElementById( 'nwp-header-nav' );
	if ( ! btn || ! panel ) {
		return;
	}

	var openLabel = btn.getAttribute( 'data-label-open' ) || 'Open menu';
	var closeLabel = btn.getAttribute( 'data-label-close' ) || 'Close menu';

	function isNarrow() {
		return window.matchMedia( '(max-width: 991.98px)' ).matches;
	}

	function setOpen( open ) {
		nav.classList.toggle( 'nwp-site-header--open', open );
		btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		btn.setAttribute( 'aria-label', open ? closeLabel : openLabel );
		document.body.classList.toggle( 'nwp-header-menu-open', open && isNarrow() );
	}

	btn.addEventListener( 'click', function () {
		if ( ! isNarrow() ) {
			return;
		}
		setOpen( ! nav.classList.contains( 'nwp-site-header--open' ) );
	} );

	panel.querySelectorAll( 'a' ).forEach( function ( a ) {
		a.addEventListener( 'click', function () {
			if ( isNarrow() ) {
				setOpen( false );
			}
		} );
	} );

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && nav.classList.contains( 'nwp-site-header--open' ) ) {
			setOpen( false );
			btn.focus();
		}
	} );

	window.addEventListener( 'resize', function () {
		if ( ! isNarrow() ) {
			setOpen( false );
		}
	} );
} )();
