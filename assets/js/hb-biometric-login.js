( function ( $ ) {
	'use strict';

	var cfg = window.hbBiometricLogin || {};

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

	function decodeRequestOptions( publicKey ) {
		var pk = JSON.parse( JSON.stringify( publicKey ) );
		pk.challenge = base64UrlToArrayBuffer( pk.challenge );
		if ( Array.isArray( pk.allowCredentials ) ) {
			pk.allowCredentials = pk.allowCredentials.map( function ( cred ) {
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
		if ( err.name === 'NotAllowedError' ) {
			return cfg.i18n.cancelled || cfg.i18n.errorGeneric;
		}
		if ( err.message ) {
			return err.message;
		}
		return cfg.i18n.errorGeneric;
	}

	function postLogin( data ) {
		return $.ajax( {
			url: cfg.ajaxUrl,
			method: 'POST',
			data: data,
			dataType: 'json',
		} ).then( function ( res ) {
			if ( res === null || res === 0 || res === '0' || res === -1 || res === '-1' ) {
				throw new Error( cfg.i18n.sessionExpired );
			}
			if ( typeof res !== 'object' ) {
				throw new Error( cfg.i18n.errorGeneric );
			}
			if ( ! res.success ) {
				throw new Error( ( res.data && res.data.message ) || cfg.i18n.errorGeneric );
			}
			return res;
		}, function ( jqXHR ) {
			var msg = cfg.i18n.errorGeneric;
			if ( jqXHR && jqXHR.responseJSON && jqXHR.responseJSON.data && jqXHR.responseJSON.data.message ) {
				msg = jqXHR.responseJSON.data.message;
			}
			throw new Error( msg );
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

	function platformBiometricAvailable() {
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

	function showFeedback( message, type ) {
		var $el = $( '#hb-biometric-login-feedback' );
		if ( ! $el.length ) {
			return;
		}
		$el.text( message || '' ).attr( 'data-type', type || '' );
	}

	function openOtpLogin() {
		if ( typeof window.cpmHbOpenMyAccountPhoneLogin === 'function' ) {
			window.cpmHbOpenMyAccountPhoneLogin( cfg.myAccountUrl || '' );
			return;
		}
		if ( window.cpmNwp && window.cpmNwp.openAccountOtpOnLoad ) {
			window.cpmNwp.openAccountOtpOnLoad = true;
		}
	}

	function deferOtpAutoOpen() {
		if ( window.cpmNwp && window.cpmNwp.openAccountOtpOnLoad ) {
			window.cpmNwp.openAccountOtpOnLoad = false;
		}
	}

	var loginInProgress = false;

	function loginWithPasskey() {
		if ( loginInProgress ) {
			return;
		}

		var $btn = $( '#hb-biometric-login-btn' );
		if ( ! cfg.ajaxUrl || ! cfg.loginBegin || ! cfg.nonce ) {
			showFeedback( 'Biometric login script did not load correctly. Hard refresh this page.', 'error' );
			return;
		}

		if ( ! window.isSecureContext ) {
			showFeedback( cfg.i18n.httpsRequired, 'error' );
			return;
		}

		if ( ! navigator.credentials || typeof navigator.credentials.get !== 'function' ) {
			showFeedback( cfg.i18n.unsupported, 'error' );
			return;
		}

		loginInProgress = true;
		$btn.prop( 'disabled', true ).text( cfg.i18n.signingIn || 'Waiting…' );
		showFeedback( '', '' );

		var loginToken = '';

		postLogin( {
			action: cfg.loginBegin,
			nonce: cfg.nonce,
			redirect_to: cfg.myAccountUrl || '',
		} )
			.then( function ( beginRes ) {
				validateRpId( beginRes.data.rpId );
				loginToken = beginRes.data.loginToken || '';
				var publicKey = decodeRequestOptions( beginRes.data.publicKey );
				return navigator.credentials.get( { publicKey: publicKey } );
			} )
			.then( function ( cred ) {
				if ( ! cred || ! cred.response ) {
					throw new Error( cfg.i18n.errorGeneric );
				}

				return postLogin( {
					action: cfg.loginComplete,
					nonce: cfg.nonce,
					login_token: loginToken,
					id: arrayBufferToBase64Url( cred.rawId ),
					clientDataJSON: arrayBufferToBase64Url( cred.response.clientDataJSON ),
					authenticatorData: arrayBufferToBase64Url( cred.response.authenticatorData ),
					signature: arrayBufferToBase64Url( cred.response.signature ),
					redirect_to: cfg.myAccountUrl || '',
				} );
			} )
			.then( function ( completeRes ) {
				showFeedback( completeRes.data.message || '', 'success' );
				var redirect = completeRes.data.redirect || cfg.myAccountUrl || window.location.href;
				window.location.href = redirect;
			} )
			.fail( function ( err ) {
				showFeedback( extractErrorMessage( err ), 'error' );
			} )
			.always( function () {
				loginInProgress = false;
				$btn.prop( 'disabled', false ).text( cfg.i18n.loginBtn || 'Sign in with Face ID / Touch ID' );
			} );
	}

	function initGuestLogin() {
		var $panel = $( '#hb-biometric-login-guest' );
		if ( ! $panel.length ) {
			return;
		}

		// Prevent the OTP modal from opening before the async platform check finishes.
		deferOtpAutoOpen();

		platformBiometricAvailable().then( function ( supported ) {
			if ( ! supported ) {
				$panel.remove();
				setTimeout( function () {
					openOtpLogin();
				}, 250 );
				return;
			}

			$panel.prop( 'hidden', false );

			if ( cfg.autoPromptOnLoad ) {
				setTimeout( function () {
					loginWithPasskey();
				}, 350 );
			}
		} );
	}

	$( function () {
		initGuestLogin();

		$( document ).on( 'click', '#hb-biometric-login-btn', function ( e ) {
			e.preventDefault();
			loginWithPasskey();
		} );

		$( document ).on( 'click', '#hb-biometric-login-otp-btn', function ( e ) {
			e.preventDefault();
			openOtpLogin();
		} );
	} );
}( jQuery ) );
