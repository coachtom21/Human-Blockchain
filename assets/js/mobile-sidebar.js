/**
 * Header mobile menu: wire #navtoggle → #hb-sidebar-overlay + #hb-sidebar-menu
 * Uses IDs so plugin-injected .sidebar-menu earlier in the DOM is not toggled by mistake.
 * Exposes window.toggleSidebar for other scripts (e.g. register modal).
 */
(function () {
	'use strict';

	var OVERLAY_ID = 'hb-sidebar-overlay';
	var SIDEBAR_ID = 'hb-sidebar-menu';

	function toggleSidebar( open ) {
		var overlay = document.getElementById( OVERLAY_ID );
		var sidebar = document.getElementById( SIDEBAR_ID );
		var navToggle = document.getElementById( 'navtoggle' );
		if ( ! overlay || ! sidebar || ! navToggle ) {
			return;
		}
		if ( open ) {
			overlay.classList.add( 'active' );
			overlay.setAttribute( 'aria-hidden', 'false' );
			sidebar.classList.add( 'active' );
			sidebar.setAttribute( 'aria-hidden', 'false' );
			document.body.classList.add( 'sidebar-open' );
			navToggle.checked = true;
		} else {
			overlay.classList.remove( 'active' );
			overlay.setAttribute( 'aria-hidden', 'true' );
			sidebar.classList.remove( 'active' );
			sidebar.setAttribute( 'aria-hidden', 'true' );
			document.body.classList.remove( 'sidebar-open' );
			navToggle.checked = false;
		}
	}

	window.toggleSidebar = toggleSidebar;

	function init() {
		var navToggle = document.getElementById( 'navtoggle' );
		var overlay = document.getElementById( OVERLAY_ID );
		var sidebar = document.getElementById( SIDEBAR_ID );

		if ( navToggle ) {
			navToggle.addEventListener( 'change', function () {
				toggleSidebar( this.checked );
			} );
		}

		if ( overlay ) {
			overlay.addEventListener( 'click', function () {
				toggleSidebar( false );
			} );
		}

		if ( sidebar ) {
			var links = sidebar.querySelectorAll( '.sidebar-menu-links a' );
			links.forEach( function ( link ) {
				link.addEventListener( 'click', function () {
					toggleSidebar( false );
				} );
			} );
			sidebar.querySelectorAll( '.sidebar-buttons .btn' ).forEach( function ( btn ) {
				btn.addEventListener( 'click', function () {
					toggleSidebar( false );
				} );
			} );
			var activateBtn = document.getElementById( 'activate-device-sidebar' );
			if ( activateBtn ) {
				activateBtn.addEventListener( 'click', function () {
					toggleSidebar( false );
				} );
			}
		}

		window.addEventListener( 'resize', function () {
			if ( window.innerWidth >= 901 ) {
				toggleSidebar( false );
			}
		} );

		/* Closed by default: fixes BFCache restore / stray checked state / wrong first .sidebar-menu */
		toggleSidebar( false );
	}

	window.addEventListener( 'pageshow', function ( e ) {
		if ( e.persisted ) {
			toggleSidebar( false );
		}
	} );

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
