( function ( $ ) {
	'use strict';

	var cfg = window.hbBiometric || {};

	function base64UrlToArrayBuffer( base64url ) {
		var base64 = base64url.replace( /-/g, '+' ).replace( /_/g, '/' );
		var pad = base64.length % 4;
		if ( pad ) {
			base64 += '='.repeat( 4 - pad );
		}
		var binary = window.atob( base64 );
		var bytes = new Uint8Array( binary.length );
		for ( var i = 0; i < binary.length; i++ ) {
			bytes[ i ] = binary.charCodeAt( i );
		}
		return bytes.buffer;
	}

	function arrayBufferToBase64Url( buffer ) {
		var bytes = new Uint8Array( buffer );
		var binary = '';
		for ( var i = 0; i < bytes.length; i++ ) {
			binary += String.fromCharCode( bytes[ i ] );
		}
		return window.btoa( binary ).replace( /\+/g, '-' ).replace( /\//g, '_' ).replace( /=+$/, '' );
	}

	function decodeCreationOptions( publicKey ) {
		var pk = JSON.parse( JSON.stringify( publicKey ) );
		if ( pk.extensions ) {
			delete pk.extensions;
		}
		pk.challenge = base64UrlToArrayBuffer( pk.challenge );
		if ( pk.user && pk.user.id ) {
			pk.user.id = base64UrlToArrayBuffer( pk.user.id );
		}
		if ( Array.isArray( pk.excludeCredentials ) ) {
			pk.excludeCredentials = pk.excludeCredentials.map( function ( cred ) {
				return {
					type: cred.type,
					id: base64UrlToArrayBuffer( cred.id ),
					transports: cred.transports || undefined,
				};
			} );
		}
		return pk;
	}

	function extractErrorMessage( err ) {
		if ( ! err ) {
			return cfg.i18n.errorGeneric;
		}
		if ( typeof err === 'string' ) {
			return err;
		}
		if ( err.message ) {
			return err.message;
		}
		if ( err.responseJSON && err.responseJSON.data && err.responseJSON.data.message ) {
			return err.responseJSON.data.message;
		}
		if ( err.responseText ) {
			try {
				var parsed = JSON.parse( err.responseText );
				if ( parsed && parsed.data && parsed.data.message ) {
					return parsed.data.message;
				}
			} catch ( parseErr ) {
				// Ignore JSON parse errors.
			}
		}
		return cfg.i18n.errorGeneric;
	}

	function postBiometric( data ) {
		return $.ajax( {
			url: cfg.ajaxUrl,
			method: 'POST',
			data: data,
			dataType: 'json',
		} ).then( function ( res, textStatus, jqXHR ) {
			if ( res === null || res === 0 || res === '0' || res === -1 || res === '-1' ) {
				throw new Error( cfg.i18n.sessionExpired || 'Session expired. Reload this page and try again.' );
			}
			if ( typeof res !== 'object' ) {
				throw new Error( cfg.i18n.errorGeneric );
			}
			if ( ! res.success ) {
				throw new Error( ( res.data && res.data.message ) || cfg.i18n.errorGeneric );
			}
			return res;
		}, function ( jqXHR ) {
			throw new Error( extractErrorMessage( jqXHR ) );
		} );
	}

	function validateRpId( rpId ) {
		if ( ! rpId ) {
			return;
		}
		var host = window.location.hostname.toLowerCase().replace( /^www\./, '' );
		var expected = String( rpId ).toLowerCase().replace( /^www\./, '' );
		if ( host === expected || host.endsWith( '.' + expected ) ) {
			return;
		}
		throw new Error(
			'Open this page at https://' + expected + ' (you are on ' + window.location.hostname + ') and try again.'
		);
	}
		if ( ! window.isSecureContext ) {
			return Promise.resolve( false );
		}
		if ( ! window.PublicKeyCredential || typeof PublicKeyCredential.isUserVerifyingPlatformAuthenticatorAvailable !== 'function' ) {
			return Promise.resolve( false );
		}
		return PublicKeyCredential.isUserVerifyingPlatformAuthenticatorAvailable().catch( function () {
			return false;
		} );
	}
	function initBiometricPage() {
		var $root = $( '#hb-biometric-settings' );
		if ( ! $root.length ) {
			return;
		}

		var $unsupported = $( '#hb-biometric-unsupported' );
		var $supported = $( '#hb-biometric-supported' );

		if ( ! $supported.length ) {
			return;
		}

		platformBiometricAvailable().then( function ( supported ) {
			if ( ! supported ) {
				$unsupported.show();
				$supported.hide();
				return;
			}

			if ( cfg.canManage ) {
				$supported.show();
				$unsupported.hide();
			} else {
				$supported.hide();
				$unsupported.hide();
			}
		} );
	}

	function updateNavVisibility() {
		var $navItem = $( '.woocommerce-MyAccount-navigation-link--biometric-login' );
		if ( $navItem.length ) {
			$navItem.removeClass( 'hb-biometric-nav-hidden' );
		}
	}

	function showFeedback( message, type ) {
		var $el = $( '#hb-biometric-feedback' );
		if ( ! $el.length ) {
			return;
		}
		$el.text( message || '' ).attr( 'data-type', type || '' );
	}

	function appendPasskeyRow( data ) {
		var $list = $( '#hb-biometric-passkey-list' );
		if ( ! $list.length ) {
			return;
		}
		$list.prop( 'hidden', false );
		var $wrap = $( '.hb-biometric-settings__list-wrap' );
		if ( ! $wrap.length ) {
			var html = '<div class="hb-biometric-settings__list-wrap"><h3>Registered devices</h3></div>';
			$list.before( html );
			$wrap = $( '.hb-biometric-settings__list-wrap' );
		}
		if ( ! $list.parent( '.hb-biometric-settings__list-wrap' ).length ) {
			$wrap.append( $list );
		}
		var item = document.createElement( 'li' );
		item.className = 'hb-biometric-settings__list-item';
		if ( data.passkey_id ) {
			item.setAttribute( 'data-passkey-id', String( data.passkey_id ) );
		}
		item.innerHTML =
			'<div class="hb-biometric-settings__list-meta"><strong></strong><span></span></div>' +
			'<button type="button" class="hb-biometric-settings__remove hb-biometric-remove-btn">Remove</button>';
		item.querySelector( 'strong' ).textContent = data.device_label || 'This device';
		item.querySelector( 'span' ).textContent = data.created_at || 'Just now';
		$list.prepend( item );
	}

	function registerPasskey() {
		var $btn = $( '#hb-biometric-enable-btn' );
		var label = $( '#hb-biometric-device-label' ).val() || '';

		$btn.prop( 'disabled', true ).text( cfg.i18n.enabling || 'Waiting…' );
		showFeedback( '', '' );

		if ( ! window.isSecureContext ) {
			showFeedback( cfg.i18n.httpsRequired, 'error' );
			$btn.prop( 'disabled', false ).text( cfg.i18n.enableBtn || 'Enable Face ID / fingerprint login' );
			return;
		}

		if ( ! navigator.credentials || typeof navigator.credentials.create !== 'function' ) {
			showFeedback( cfg.i18n.unsupported, 'error' );
			$btn.prop( 'disabled', false ).text( cfg.i18n.enableBtn || 'Enable Face ID / fingerprint login' );
			return;
		}

		postBiometric( {
			action: cfg.registerBegin,
			nonce: cfg.nonce,
		} )
			.then( function ( beginRes ) {
				validateRpId( beginRes.data.rpId );
				var publicKey = decodeCreationOptions( beginRes.data.publicKey );
				return navigator.credentials.create( { publicKey: publicKey } );
			} )
			.then( function ( cred ) {
				if ( ! cred || ! cred.response ) {
					throw new Error( cfg.i18n.errorGeneric );
				}

				return postBiometric( {
					action: cfg.registerComplete,
					nonce: cfg.nonce,
					clientDataJSON: arrayBufferToBase64Url( cred.response.clientDataJSON ),
					attestationObject: arrayBufferToBase64Url( cred.response.attestationObject ),
					device_label: label,
				} );
			} )
			.then( function ( completeRes ) {
				showFeedback( completeRes.data.message, 'success' );
				appendPasskeyRow( {
					passkey_id: completeRes.data.passkey_id,
					device_label: completeRes.data.device_label || label || 'This device',
					created_at: completeRes.data.created_at || 'Just now',
				} );
			} )
			.fail( function ( err ) {
				showFeedback( extractErrorMessage( err ), 'error' );
			} )
			.always( function () {
				$btn.prop( 'disabled', false ).text( cfg.i18n.enableBtn || 'Enable Face ID / fingerprint login' );
			} );
	}

	function removePasskey( passkeyId, $row ) {
		if ( ! window.confirm( cfg.i18n.removeConfirm ) ) {
			return;
		}

		$.post( cfg.ajaxUrl, {
			action: cfg.removeAction,
			nonce: cfg.nonce,
			passkey_id: passkeyId,
		} )
			.done( function ( res ) {
				if ( ! res || ! res.success ) {
					throw new Error( ( res && res.data && res.data.message ) || cfg.i18n.errorGeneric );
				}
				$row.remove();
			} )
			.fail( function ( xhr ) {
				var msg = cfg.i18n.errorGeneric;
				if ( xhr && xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message ) {
					msg = xhr.responseJSON.data.message;
				}
				window.alert( msg );
			} );
	}

	$( function () {
		updateNavVisibility();
		initBiometricPage();

		$( document ).on( 'click', '#hb-biometric-enable-btn', function ( e ) {
			e.preventDefault();
			registerPasskey();
		} );

		$( document ).on( 'click', '.hb-biometric-remove-btn', function ( e ) {
			e.preventDefault();
			var $row = $( this ).closest( '.hb-biometric-settings__list-item' );
			var id = $row.data( 'passkey-id' );
			if ( id ) {
				removePasskey( id, $row );
			}
		} );
	} );
}( jQuery ) );
