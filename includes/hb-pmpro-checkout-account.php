<?php
/**
 * PMPro membership checkout: hide username and password fields, submit generated
 * credentials from email, replace confirm-email with a required phone field.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'pmpro_checkout_confirm_password', '__return_false' );
add_filter( 'pmpro_checkout_confirm_email', '__return_false' );

/**
 * Unique WP login from an email local-part.
 *
 * @param string $email Email.
 * @return string
 */
function hb_pmpro_username_from_email( $email ) {
	$email = sanitize_email( $email );
	$base  = '';
	if ( $email !== '' && strpos( $email, '@' ) !== false ) {
		$base = sanitize_user( strstr( $email, '@', true ), true );
	}
	if ( $base === '' ) {
		$base = 'yamer';
	}
	$base     = substr( $base, 0, 50 );
	$username = $base;
	$i        = 1;
	while ( username_exists( $username ) ) {
		$suffix   = (string) $i++;
		$username = substr( $base, 0, max( 1, 60 - strlen( $suffix ) ) ) . $suffix;
	}
	return $username;
}

/**
 * If checkout posted without a password or username, fill them before PMPro validates.
 *
 * @return void
 */
function hb_pmpro_checkout_seed_password() {
	if ( is_user_logged_in() || empty( $_POST ) ) {
		return;
	}

	$looks_like_checkout = isset( $_POST['username'] ) || isset( $_POST['bemail'] ) || isset( $_POST['pmpro_checkout_nonce'] );
	if ( ! $looks_like_checkout ) {
		return;
	}

	$email = isset( $_POST['bemail'] ) ? sanitize_email( wp_unslash( $_POST['bemail'] ) ) : '';
	if ( $email !== '' ) {
		$login                = hb_pmpro_username_from_email( $email );
		$_POST['username']    = $login;
		$_REQUEST['username'] = $login;
	}

	if ( empty( $_POST['password'] ) ) {
		$pass                 = wp_generate_password( 20, true, true );
		$_POST['password']    = $pass;
		$_REQUEST['password'] = $pass;
	}

	$_POST['password2_copy']        = '1';
	$_REQUEST['password2_copy']     = '1';
	$_POST['bconfirmemail_copy']    = '1';
	$_REQUEST['bconfirmemail_copy'] = '1';
}
add_action( 'init', 'hb_pmpro_checkout_seed_password', 1 );

/**
 * Keep confirm-email in sync, generate username from email, and require phone.
 *
 * @param array $fields Required user fields.
 * @return array
 */
function hb_pmpro_checkout_required_user_fields( $fields ) {
	global $bphone, $bemail, $bconfirmemail, $password, $password2, $username;

	if ( ! empty( $bemail ) ) {
		$bconfirmemail = $bemail;
		$username      = hb_pmpro_username_from_email( $bemail );
	}
	if ( ! empty( $password ) ) {
		$password2 = $password;
	}

	unset( $fields['password2'], $fields['bconfirmemail'] );

	$phone   = isset( $bphone ) ? $bphone : '';
	$ordered = array( 'bphone' => $phone );
	foreach ( $fields as $key => $value ) {
		if ( $key === 'bphone' ) {
			continue;
		}
		$ordered[ $key ] = $value;
	}

	return $ordered;
}
add_filter( 'pmpro_required_user_fields', 'hb_pmpro_checkout_required_user_fields', 20 );

/**
 * Hide the visible password input and submit a generated value instead.
 *
 * @return void
 */
function hb_pmpro_checkout_hidden_password() {
	if ( is_user_logged_in() ) {
		return;
	}

	global $password;
	if ( empty( $password ) ) {
		$password = wp_generate_password( 20, true, true );
	}

	echo '<input type="hidden" name="password" id="hb_pmpro_generated_password" value="' . esc_attr( $password ) . '" autocomplete="new-password" />';
}
add_action( 'pmpro_checkout_after_password', 'hb_pmpro_checkout_hidden_password', 5 );

/**
 * Phone field before email — most members identify with a mobile number.
 *
 * @return void
 */
function hb_pmpro_checkout_phone_field() {
	global $bphone, $skip_account_fields, $pmpro_review;

	if ( ! empty( $skip_account_fields ) || ! empty( $pmpro_review ) ) {
		return;
	}

	$value = isset( $bphone ) ? $bphone : '';
	?>
	<div class="<?php echo esc_attr( function_exists( 'pmpro_get_element_class' ) ? pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-required pmpro_checkout-field-hb-phone', 'pmpro_checkout-field-hb-phone' ) : 'pmpro_checkout-field pmpro_checkout-field-required pmpro_checkout-field-hb-phone' ); ?>">
		<label for="hb_checkout_phone"><?php esc_html_e( 'Phone', 'hello-elementor-child' ); ?></label>
		<input id="hb_checkout_phone" name="bphone" type="tel" class="<?php echo esc_attr( function_exists( 'pmpro_get_element_class' ) ? pmpro_get_element_class( 'input', 'bphone' ) : 'input' ); ?>" size="30" value="<?php echo esc_attr( $value ); ?>" autocomplete="tel" inputmode="tel" required autofocus />
	</div>
	<?php
}
add_action( 'pmpro_checkout_after_password', 'hb_pmpro_checkout_phone_field', 20 );

/**
 * Persist phone on the new member.
 *
 * @param int $user_id User ID.
 * @return void
 */
function hb_pmpro_checkout_save_phone( $user_id ) {
	$user_id = absint( $user_id );
	if ( ! $user_id || empty( $_REQUEST['bphone'] ) ) {
		return;
	}

	$phone = sanitize_text_field( wp_unslash( $_REQUEST['bphone'] ) );
	if ( $phone === '' ) {
		return;
	}

	update_user_meta( $user_id, 'billing_phone', $phone );
	update_user_meta( $user_id, 'phone', $phone );
}
add_action( 'pmpro_after_checkout', 'hb_pmpro_checkout_save_phone', 20 );

/**
 * Checkout “Log in here” must not go to wp-login. Open the device OTP modal instead.
 * Runs after PMPro’s own login_url filter (priority 50).
 *
 * @param string $login_url Login URL.
 * @param string $redirect  Redirect after login.
 * @return string
 */
function hb_pmpro_checkout_login_url( $login_url, $redirect = '' ) {
	if ( is_user_logged_in() ) {
		return $login_url;
	}

	$on_checkout = is_page( 'membership-checkout' )
		|| ( function_exists( 'hb_should_enqueue_pmpro_checkout_styles' ) && hb_should_enqueue_pmpro_checkout_styles() )
		|| ( function_exists( 'pmpro_is_checkout' ) && pmpro_is_checkout() );

	$to_checkout = is_string( $redirect ) && (
		false !== strpos( $redirect, 'membership-checkout' )
		|| false !== strpos( $redirect, 'pmpro_level=' )
	);

	if ( $on_checkout || $to_checkout ) {
		return '#cpm-nwp-activate-modal';
	}

	return $login_url;
}
add_filter( 'login_url', 'hb_pmpro_checkout_login_url', 999, 2 );

/**
 * Bind checkout login link to Activate device (OTP) and stay on checkout after verify.
 *
 * @return void
 */
function hb_pmpro_checkout_login_otp_script() {
	if ( is_user_logged_in() ) {
		return;
	}
	?>
	<script>
	(function () {
		var checkoutOtpIds = ['cpm-nwp-activate-modal', 'cpm-nwp-verify-otp-modal', 'cpm-nwp-register-modal', 'cpm-nwp-discord-modal'];

		function isPmproCheckout() {
			return !!(document.body && document.body.classList.contains('pmpro-checkout'));
		}

		function hideModal(el) {
			if (!el) {
				return;
			}
			el.classList.add('cpm-nwp-modal--hidden');
			el.setAttribute('aria-hidden', 'true');
			el.style.removeProperty('opacity');
			el.style.removeProperty('visibility');
			el.style.removeProperty('pointer-events');
		}

		function closeCheckoutOtpModals() {
			checkoutOtpIds.forEach(function (id) {
				hideModal(document.getElementById(id));
			});
			document.body.classList.remove('cpm-nwp-modal-open');
			window.cpmHbLanding = window.cpmHbLanding || {};
			window.cpmHbLanding.phoneModalFromLanding = false;
			window.cpmHbLanding.pendingOtpRedirect = '';
			window.cpmNwpActivateFromRegisterSuccess = false;
		}

		function isCheckoutOtpCloseTarget(el) {
			if (!el || !el.closest) {
				return false;
			}
			return !!(
				el.closest('#cpm-nwp-activate-modal .cpm-nwp-activate-close') ||
				el.closest('#cpm-nwp-activate-modal .cpm-nwp-modal-overlay') ||
				el.closest('#cpm-nwp-verify-otp-modal .cpm-nwp-activate-close') ||
				el.closest('#cpm-nwp-verify-otp-modal .cpm-nwp-modal-overlay') ||
				el.closest('#cpm-nwp-register-modal .cpm-nwp-modal-close') ||
				el.closest('#cpm-nwp-register-modal .cpm-nwp-modal-overlay')
			);
		}

		function openActivateOtpModal() {
			window.cpmHbLanding = window.cpmHbLanding || {};
			window.cpmHbLanding.pendingOtpRedirect = window.location.href;
			window.cpmHbLanding.phoneModalFromLanding = true;
			var activate = document.getElementById('cpm-nwp-activate-modal');
			if (!activate) {
				return false;
			}
			if (activate.parentNode !== document.body) {
				document.body.appendChild(activate);
			}
			['cpm-nwp-register-modal', 'cpm-nwp-verify-otp-modal', 'cpm-nwp-discord-modal'].forEach(function (id) {
				hideModal(document.getElementById(id));
			});
			activate.classList.remove('cpm-nwp-modal--hidden');
			activate.setAttribute('aria-hidden', 'false');
			activate.style.zIndex = '2147483000';
			activate.style.position = 'fixed';
			activate.style.inset = '0';
			activate.style.removeProperty('opacity');
			activate.style.removeProperty('visibility');
			activate.style.removeProperty('pointer-events');
			document.body.classList.add('cpm-nwp-modal-open');
			var phone = document.getElementById('cpm-nwp-activate-mobile-national');
			if (phone) {
				phone.focus();
			}
			return true;
		}

		function isCheckoutLoginLink(el) {
			return !!(el && el.closest && el.closest('.pmpro_checkout-h2-msg'));
		}

		function bind(link) {
			if (!link || link.getAttribute('data-hb-otp-login') === '1') {
				return;
			}
			link.setAttribute('data-hb-otp-login', '1');
			link.setAttribute('href', '#cpm-nwp-activate-modal');
			link.classList.add('cpm-nwp-open-activate-modal');
		}

		document.addEventListener('click', function (e) {
			var target = e.target;
			if (isPmproCheckout() && isCheckoutOtpCloseTarget(target)) {
				e.preventDefault();
				e.stopPropagation();
				closeCheckoutOtpModals();
				return;
			}
			var link = target && target.closest ? target.closest('a') : null;
			if (!isCheckoutLoginLink(link)) {
				return;
			}
			bind(link);
			e.preventDefault();
			e.stopPropagation();
			openActivateOtpModal();
		}, true);

		document.addEventListener('keydown', function (e) {
			if (e.key !== 'Escape' || !isPmproCheckout()) {
				return;
			}
			var open = checkoutOtpIds.some(function (id) {
				var el = document.getElementById(id);
				return el && !el.classList.contains('cpm-nwp-modal--hidden');
			});
			if (!open) {
				return;
			}
			e.preventDefault();
			e.stopPropagation();
			closeCheckoutOtpModals();
		}, true);

		function bindAll() {
			document.querySelectorAll('.pmpro_checkout-h2-msg a').forEach(bind);
		}
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', bindAll);
		} else {
			bindAll();
		}
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'hb_pmpro_checkout_login_otp_script', 5 );
