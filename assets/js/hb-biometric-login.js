( function ( $ ) {
	'use strict';

	var cfg = window.hbBiometricLogin || {};
	var platformCheck = null;
	var loginInProgress = false;

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

	function isUserCancelled( err ) {
		return !!( err && ( err.name === 'NotAllowedError' || err.name === 'AbortError' ) );
	}

	function parseAjaxResponse( res, responseText ) {
		if ( res === null || res === undefined ) {
			if ( typeof responseText === 'string' && responseText ) {
				try {
					res = JSON.parse( responseText );
				} catch ( parseErr ) {
					res = null;
				}
			}
		}

		if ( res === 0 || res === '0' || res === -1 || res === '-1' ) {
			return null;
		}

		if ( typeof res === 'object' && res ) {
			return res;
		}

		if ( typeof responseText === 'string' && responseText.indexOf( '"success":true' ) !== -1 ) {
			try {
				return JSON.parse( responseText );
			} catch ( parseErr2 ) {
				return null;
			}
		}

		return null;
	}

	function postLogin( data ) {
		return $.ajax( {
			url: cfg.ajaxUrl,
			method: 'POST',
			data: data,
			dataType: 'text',
			xhrFields: { withCredentials: true },
			cache: false,
		} ).then( function ( responseText ) {
			var res = null;
			try {
				res = JSON.parse( responseText );
			} catch ( parseErr ) {
				res = parseAjaxResponse( null, responseText );
			}

			res = parseAjaxResponse( res, responseText );

			if ( ! res ) {
				throw new Error( cfg.i18n.sessionExpired );
			}
			if ( ! res.success ) {
				throw new Error( ( res.data && res.data.message ) || cfg.i18n.errorGeneric );
			}
			return res;
		}, function ( jqXHR ) {
			var parsed = parseAjaxResponse( jqXHR && jqXHR.responseJSON, jqXHR && jqXHR.responseText );
			if ( parsed && parsed.success ) {
				return parsed;
			}
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
		if ( platformCheck ) {
			return platformCheck;
		}
		if ( ! window.isSecureContext ) {
			platformCheck = Promise.resolve( false );
			return platformCheck;
		}
		if ( ! window.PublicKeyCredential || typeof PublicKeyCredential.isUserVerifyingPlatformAuthenticatorAvailable !== 'function' ) {
			platformCheck = Promise.resolve( false );
			return platformCheck;
		}
		platformCheck = PublicKeyCredential.isUserVerifyingPlatformAuthenticatorAvailable().catch( function () {
			return false;
		} );
		return platformCheck;
	}

	function showFeedback( message, type ) {
		if ( window.cpmHbOtpFlowActive && type === 'error' ) {
			return;
		}
		var $el = $( '#hb-biometric-login-feedback' );
		if ( $el.length ) {
			$el.text( message || '' ).attr( 'data-type', type || '' );
		}

		var $modalFb = $( '#cpm-nwp-activate-feedback' );
		if ( $modalFb.length && message ) {
			$modalFb.removeClass( 'cpm-nwp-inline-feedback--hidden' ).text( message );
			if ( type === 'error' ) {
				$modalFb.addClass( 'cpm-nwp-inline-feedback--error' );
			} else {
				$modalFb.removeClass( 'cpm-nwp-inline-feedback--error' );
			}
		}
	}

	function closeLoginModal() {
		$( '#cpm-nwp-activate-modal' ).addClass( 'cpm-nwp-modal--hidden' ).attr( 'aria-hidden', 'true' );
		$( 'body' ).removeClass( 'cpm-nwp-modal-open' );
		$( '#cpm-nwp-activate-feedback' ).addClass( 'cpm-nwp-inline-feedback--hidden' ).text( '' );
	}

	function finishLoginRedirect( redirect, fallback ) {
		var target = redirect || fallback || cfg.myAccountUrl || window.location.href;
		closeLoginModal();
		loginInProgress = false;
		window.location.href = target;
	}

	function openOtpLogin( returnUrl ) {
		var orig = window.cpmHbOpenMyAccountPhoneLoginOriginal;
		if ( typeof orig === 'function' ) {
			orig( returnUrl || cfg.myAccountUrl || '' );
			return;
		}
		if ( typeof window.cpmHbOpenMyAccountPhoneLogin === 'function' ) {
			window.cpmHbOpenMyAccountPhoneLogin( returnUrl || cfg.myAccountUrl || '' );
		}
	}

	function deferOtpAutoOpen() {
		if ( window.cpmNwp && window.cpmNwp.openAccountOtpOnLoad ) {
			window.cpmNwp.openAccountOtpOnLoad = false;
		}
	}

	/**
	 * Attempt passkey sign-in.
	 *
	 * @param {string} returnUrl Redirect after login.
	 * @return {Promise}
	 */
	function loginWithPasskey( returnUrl ) {
		if ( window.cpmHbOtpFlowActive ) {
			return Promise.reject( new Error( 'otp_flow' ) );
		}
		if ( loginInProgress ) {
			return Promise.reject( new Error( 'busy' ) );
		}

		if ( ! cfg.ajaxUrl || ! cfg.loginBegin || ! cfg.nonce ) {
			return Promise.reject( new Error( 'Biometric login script did not load correctly.' ) );
		}

		if ( ! window.isSecureContext ) {
			return Promise.reject( new Error( cfg.i18n.httpsRequired ) );
		}

		if ( ! navigator.credentials || typeof navigator.credentials.get !== 'function' ) {
			return Promise.reject( new Error( cfg.i18n.unsupported ) );
		}

		loginInProgress = true;
		var $btn = $( '#hb-biometric-login-btn, #hb-biometric-login-modal-btn' );
		$btn.prop( 'disabled', true );
		$( '#hb-biometric-login-btn' ).text( cfg.i18n.signingIn || 'Waiting…' );
		showFeedback( cfg.i18n.signingIn || 'Waiting for biometric confirmation…', '' );

		var loginToken = '';
		var redirectTo = returnUrl || cfg.myAccountUrl || '';
		var passkeyUsed = false;

		return postLogin( {
			action: cfg.loginBegin,
			nonce: cfg.nonce,
			redirect_to: redirectTo,
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

				passkeyUsed = true;
				showFeedback( cfg.i18n.signingIn || 'Signing you in…', '' );

				var completeData = {
					action: cfg.loginComplete,
					nonce: cfg.nonce,
					login_token: loginToken,
					id: arrayBufferToBase64Url( cred.rawId ),
					clientDataJSON: arrayBufferToBase64Url( cred.response.clientDataJSON ),
					authenticatorData: arrayBufferToBase64Url( cred.response.authenticatorData ),
					signature: arrayBufferToBase64Url( cred.response.signature ),
					redirect_to: redirectTo,
				};

				if ( cred.response.userHandle ) {
					completeData.userHandle = arrayBufferToBase64Url( cred.response.userHandle );
				}

				return postLogin( completeData );
			} )
			.then( function ( completeRes ) {
				finishLoginRedirect( completeRes.data.redirect, redirectTo );
			} )
			.catch( function ( err ) {
				var errObj = err instanceof Error ? err : new Error( extractErrorMessage( err ) );

				// Touch ID succeeded but AJAX response was unclear — reload account page (cookie may be set).
				if ( passkeyUsed ) {
					finishLoginRedirect( redirectTo, redirectTo );
					return;
				}

				if ( ! isUserCancelled( errObj ) ) {
					showFeedback( extractErrorMessage( errObj ), 'error' );
				}
				throw errObj;
			} )
			.finally( function () {
				if ( ! loginInProgress ) {
					return;
				}
				loginInProgress = false;
				$btn.prop( 'disabled', false );
				$( '#hb-biometric-login-btn' ).text( cfg.i18n.loginBtn || 'Sign in with Face ID / Touch ID' );
			} );
	}

	function tryBiometricThenOtp( returnUrl, fallback ) {
		if ( window.cpmHbOtpFlowActive ) {
			if ( typeof fallback === 'function' ) {
				fallback();
			}
			return;
		}
		platformBiometricAvailable().then( function ( supported ) {
			if ( ! supported ) {
				if ( typeof fallback === 'function' ) {
					fallback();
				}
				return;
			}

			loginWithPasskey( returnUrl ).catch( function ( err ) {
				if ( err && err.message === 'otp_flow' ) {
					return;
				}
				if ( typeof fallback === 'function' ) {
					// Guest without passkeys: fall back to phone + OTP instead of a dead-end error.
					if ( isUserCancelled( err ) ) {
						fallback();
						return;
					}
					var msg = extractErrorMessage( err );
					if ( /not set up|activate your device|session expired|something went wrong/i.test( msg ) ) {
						fallback();
						return;
					}
				}
				if ( ! isUserCancelled( err ) ) {
					showFeedback( extractErrorMessage( err ), 'error' );
				}
			} );
		} );
	}

	function wrapMyAccountPhoneLogin() {
		if ( typeof window.cpmHbOpenMyAccountPhoneLogin !== 'function' || window.cpmHbOpenMyAccountPhoneLoginOriginal ) {
			return;
		}

		window.cpmHbOpenMyAccountPhoneLoginOriginal = window.cpmHbOpenMyAccountPhoneLogin;
		window.cpmHbOpenMyAccountPhoneLogin = function ( returnUrl ) {
			tryBiometricThenOtp( returnUrl, function () {
				window.cpmHbOpenMyAccountPhoneLoginOriginal( returnUrl );
			} );
		};
	}

	function injectActivateModalButton() {
		var $actions = $( '#cpm-nwp-activate-modal .cpm-nwp-activate-actions' );
		if ( ! $actions.length || $( '#hb-biometric-login-modal-btn' ).length ) {
			return;
		}

		platformBiometricAvailable().then( function ( supported ) {
			if ( ! supported ) {
				return;
			}

			var $btn = $( '<button type="button" class="cpm-nwp-btn cpm-nwp-btn--biometric hb-biometric-login__modal-btn" id="hb-biometric-login-modal-btn"></button>' );
			$btn.text( cfg.i18n.loginBtn || 'Sign in with Face ID / Touch ID' );
			$actions.prepend( $btn );

			var $divider = $( '<p class="hb-biometric-login__modal-divider" id="hb-biometric-login-modal-divider"></p>' );
			$divider.text( cfg.i18n.orUseOtp || 'or use your number' );
			$btn.after( $divider );
		} );
	}

	function initGuestLoginPanel() {
		var $panel = $( '#hb-biometric-login-guest' );
		if ( ! $panel.length ) {
			return;
		}

		deferOtpAutoOpen();

		platformBiometricAvailable().then( function ( supported ) {
			if ( ! supported ) {
				$panel.remove();
				setTimeout( function () {
					openOtpLogin( cfg.myAccountUrl );
				}, 250 );
				return;
			}

			$panel.prop( 'hidden', false );

			if ( cfg.autoPromptOnLoad ) {
				setTimeout( function () {
					loginWithPasskey( cfg.myAccountUrl ).catch( function ( err ) {
						if ( isUserCancelled( err ) ) {
							openOtpLogin( cfg.myAccountUrl );
						}
					} );
				}, 350 );
			}
		} );
	}

	window.hbBiometricLoginTry = loginWithPasskey;
	window.hbBiometricLoginTryThenOtp = tryBiometricThenOtp;
	window.cpmHbCancelBiometricLogin = function () {
		loginInProgress = false;
		$( '#hb-biometric-login-btn, #hb-biometric-login-modal-btn' ).prop( 'disabled', false );
		$( '#hb-biometric-login-btn' ).text( cfg.i18n.loginBtn || 'Sign in with Face ID / Touch ID' );
	};

	$( function () {
		var shouldAutoOpen = !!( window.cpmNwp && window.cpmNwp.openAccountOtpOnLoad );

		deferOtpAutoOpen();
		wrapMyAccountPhoneLogin();
		injectActivateModalButton();
		initGuestLoginPanel();

		if ( shouldAutoOpen && ! $( '#hb-biometric-login-guest' ).length ) {
			setTimeout( function () {
				tryBiometricThenOtp( cfg.myAccountUrl, function () {
					openOtpLogin( cfg.myAccountUrl );
				} );
			}, 200 );
		}

		$( document ).on( 'click', '#hb-biometric-login-btn, #hb-biometric-login-modal-btn', function ( e ) {
			e.preventDefault();
			var returnUrl = ( window.cpmHbLanding && window.cpmHbLanding.pendingOtpRedirect ) || cfg.myAccountUrl;
			loginWithPasskey( returnUrl ).catch( function () {
				// Errors shown in modal feedback.
			} );
		} );

		$( document ).on( 'click', '#hb-biometric-login-otp-btn', function ( e ) {
			e.preventDefault();
			openOtpLogin( cfg.myAccountUrl );
		} );
	} );
}( jQuery ) );
