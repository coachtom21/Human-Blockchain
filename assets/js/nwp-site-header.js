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

	function headerOffset() {
		return Math.ceil( nav.getBoundingClientRect().height ) + 8;
	}

	function scrollToHash( hash ) {
		if ( ! hash || hash === '#' ) {
			return false;
		}
		var id = decodeURIComponent( hash.replace( /^#/, '' ) );
		var el = document.getElementById( id );
		if ( ! el ) {
			return false;
		}
		var top = window.pageYOffset + el.getBoundingClientRect().top - headerOffset();
		window.scrollTo( {
			top: Math.max( 0, top ),
			behavior: 'smooth'
		} );
		return true;
	}

	function samePath( url ) {
		var here = window.location.pathname.replace( /\/+$/, '' ) || '/';
		var there = url.pathname.replace( /\/+$/, '' ) || '/';
		return here === there;
	}

	btn.addEventListener( 'click', function () {
		if ( ! isNarrow() ) {
			return;
		}
		setOpen( ! nav.classList.contains( 'nwp-site-header--open' ) );
	} );

	panel.querySelectorAll( 'a' ).forEach( function ( a ) {
		a.addEventListener( 'click', function ( e ) {
			if ( isNarrow() ) {
				setOpen( false );
			}
			var url;
			try {
				url = new URL( a.getAttribute( 'href' ) || a.href, window.location.href );
			} catch ( err ) {
				return;
			}
			if ( ! url.hash || url.hash === '#' ) {
				return;
			}
			if ( samePath( url ) && scrollToHash( url.hash ) ) {
				e.preventDefault();
				if ( history.replaceState ) {
					history.replaceState( null, '', url.hash );
				}
			}
		} );
	} );

	if ( window.location.hash ) {
		window.setTimeout( function () {
			scrollToHash( window.location.hash );
		}, 80 );
	}

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
