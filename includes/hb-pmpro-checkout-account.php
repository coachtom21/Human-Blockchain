<?php
/**
 * PMPro membership checkout: hide password fields, submit a generated password,
 * replace confirm-email with a required phone field.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'pmpro_checkout_confirm_password', '__return_false' );
add_filter( 'pmpro_checkout_confirm_email', '__return_false' );

/**
 * If checkout posted without a password, fill a random one before PMPro validates.
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

	if ( empty( $_POST['password'] ) ) {
		$pass                 = wp_generate_password( 20, true, true );
		$_POST['password']    = $pass;
		$_REQUEST['password'] = $pass;
	}

	$_POST['password2_copy']      = '1';
	$_REQUEST['password2_copy']   = '1';
	$_POST['bconfirmemail_copy']  = '1';
	$_REQUEST['bconfirmemail_copy'] = '1';
}
add_action( 'init', 'hb_pmpro_checkout_seed_password', 1 );

/**
 * Keep confirm-email in sync and require phone on the account section.
 *
 * @param array $fields Required user fields.
 * @return array
 */
function hb_pmpro_checkout_required_user_fields( $fields ) {
	global $bphone, $bemail, $bconfirmemail, $password, $password2;

	if ( ! empty( $bemail ) ) {
		$bconfirmemail = $bemail;
	}
	if ( ! empty( $password ) ) {
		$password2 = $password;
	}

	unset( $fields['password2'], $fields['bconfirmemail'] );

	$fields['bphone'] = isset( $bphone ) ? $bphone : '';

	return $fields;
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
 * Phone field in place of Confirm Email Address.
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
		<input id="hb_checkout_phone" name="bphone" type="tel" class="<?php echo esc_attr( function_exists( 'pmpro_get_element_class' ) ? pmpro_get_element_class( 'input', 'bphone' ) : 'input' ); ?>" size="30" value="<?php echo esc_attr( $value ); ?>" autocomplete="tel" inputmode="tel" />
	</div>
	<?php
}
add_action( 'pmpro_checkout_after_email', 'hb_pmpro_checkout_phone_field', 5 );

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
