<?php
/**
 * Terms and Conditions body (included by legal page template).
 *
 * @var array<string, string> $hb_legal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $hb_legal ) || ! is_array( $hb_legal ) ) {
	$hb_legal = function_exists( 'hb_legal_template_vars' ) ? hb_legal_template_vars() : array();
}

$site_name        = isset( $hb_legal['site_name'] ) ? $hb_legal['site_name'] : '';
$home_url         = isset( $hb_legal['home_url'] ) ? $hb_legal['home_url'] : '';
$privacy_url      = isset( $hb_legal['privacy_url'] ) ? $hb_legal['privacy_url'] : '';
$terms_url        = isset( $hb_legal['terms_url'] ) ? $hb_legal['terms_url'] : '';
$support_email    = isset( $hb_legal['support_email'] ) ? $hb_legal['support_email'] : '';
$effective_date   = isset( $hb_legal['effective_date'] ) ? $hb_legal['effective_date'] : '';
$governing_state  = isset( $hb_legal['governing_state'] ) ? trim( $hb_legal['governing_state'] ) : '';
$governing_venue  = isset( $hb_legal['governing_venue'] ) ? trim( $hb_legal['governing_venue'] ) : '';
?>
<h1><?php esc_html_e( 'Terms and Conditions', 'hello-elementor-child' ); ?></h1>

<p><strong><?php esc_html_e( 'Effective date:', 'hello-elementor-child' ); ?></strong> <?php echo esc_html( $effective_date ); ?></p>

<p>
	<?php
	printf(
		wp_kses(
			__( 'Welcome to <strong>%1$s</strong> (“we,” “us,” or “our”), available at <a href="%2$s">%2$s</a> (the “Site”). These Terms and Conditions (“Terms”) govern your access to and use of the Site, including the NWP Processing Center, marketplace, device registration, SMS verification, and two-scan proof-of-delivery features (collectively, the “Services”).', 'hello-elementor-child' ),
			array(
				'strong' => array(),
				'a'      => array( 'href' => array() ),
			)
		),
		esc_html( $site_name ),
		esc_url( $home_url )
	);
	?>
</p>

<p>
	<?php
	printf(
		wp_kses(
			__( 'By accessing or using the Services, you agree to these Terms and our <a href="%s">Privacy Policy</a>. If you do not agree, do not use the Services.', 'hello-elementor-child' ),
			array( 'a' => array( 'href' => array() ) )
		),
		esc_url( $privacy_url )
	);
	?>
</p>

<h2><?php esc_html_e( '1. Eligibility', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'You must be at least 18 years old (or the age of majority in your jurisdiction) and able to form a binding contract to use the Services. You are responsible for ensuring your use complies with applicable laws in your location.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '2. Accounts and security', 'hello-elementor-child' ); ?></h2>

<ul>
	<li><?php esc_html_e( 'You must provide accurate registration information and keep your credentials secure.', 'hello-elementor-child' ); ?></li>
	<li><?php esc_html_e( 'You are responsible for activity under your account.', 'hello-elementor-child' ); ?></li>
	<li>
		<?php
		printf(
			wp_kses(
				/* translators: %s: support email */
				__( 'Notify us promptly at <a href="mailto:%s">%s</a> if you suspect unauthorized access.', 'hello-elementor-child' ),
				array( 'a' => array( 'href' => array() ) )
			),
			esc_attr( $support_email ),
			esc_html( $support_email )
		);
		?>
	</li>
	<li><?php esc_html_e( 'We may suspend or terminate accounts that violate these Terms or pose a security risk.', 'hello-elementor-child' ); ?></li>
</ul>

<h2><?php esc_html_e( '3. Marketplace and orders', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'Products and services offered through the Site may be sold by us or third-party sellers, as indicated on each listing. When you place an order:', 'hello-elementor-child' ); ?></p>

<ul>
	<li><?php esc_html_e( 'You agree to pay all charges, taxes, and shipping shown at checkout.', 'hello-elementor-child' ); ?></li>
	<li><?php esc_html_e( 'Order acceptance is subject to availability, payment authorization, and fraud review.', 'hello-elementor-child' ); ?></li>
	<li><?php esc_html_e( 'Delivery, returns, and refunds are governed by the policies stated at checkout and applicable law.', 'hello-elementor-child' ); ?></li>
	<li><?php esc_html_e( 'Participation in delivery rebates, trade credits, reserves, or wallet features is subject to program rules displayed on the Site and may change with notice.', 'hello-elementor-child' ); ?></li>
</ul>

<h2><?php esc_html_e( '4. Device registration and proof-of-delivery', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'Certain features require registering a device, completing identity or presence steps, and/or participating in a two-scan proof-of-delivery process (seller scan, buyer scan). You agree to use these features only for legitimate transactions you are party to; provide accurate information; grant location permissions only for verification purposes described on screen; and not attempt to circumvent verification, GPS checks, time windows, or ledger/audit controls.', 'hello-elementor-child' ); ?></p>

<p>
	<?php
	printf(
		wp_kses(
			__( 'We may record verification events (including timestamps and, where enabled, location data) for fraud prevention, dispute resolution, and audit trails as described in our <a href="%s">Privacy Policy</a>.', 'hello-elementor-child' ),
			array( 'a' => array( 'href' => array() ) )
		),
		esc_url( $privacy_url )
	);
	?>
</p>

<h2><?php esc_html_e( '5. SMS verification program (NWP / device & delivery OTP)', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'This section describes our SMS one-time verification program for carriers and users. It applies when you enter your mobile number on our Site and request a verification code.', 'hello-elementor-child' ); ?></p>

<table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse;width:100%;max-width:640px;">
	<tbody>
		<tr>
			<td><strong><?php esc_html_e( 'Program name', 'hello-elementor-child' ); ?></strong></td>
			<td><?php echo esc_html( $site_name ); ?> / <?php esc_html_e( 'NWP SMS Verification', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Organization', 'hello-elementor-child' ); ?></strong></td>
			<td><?php echo esc_html( $site_name ); ?> (<?php echo esc_html( wp_parse_url( $home_url, PHP_URL_HOST ) ?: $home_url ); ?>)</td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Types of messages', 'hello-elementor-child' ); ?></strong></td>
			<td><?php esc_html_e( 'One-time passwords (OTP) and security codes only. No marketing or promotional SMS in this program.', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'When messages are sent', 'hello-elementor-child' ); ?></strong></td>
			<td><?php esc_html_e( 'Only after you enter your phone number and click Send OTP (or equivalent) on our website—for example during device activation, seller scan verification, or buyer scan verification.', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Message frequency', 'hello-elementor-child' ); ?></strong></td>
			<td><?php esc_html_e( 'Typically one message per verification request you initiate. Additional messages only if you request another code or complete another verification step.', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Sample message', 'hello-elementor-child' ); ?></strong></td>
			<td><em><?php esc_html_e( 'Your NWP verification code is: 123456', 'hello-elementor-child' ); ?></em> <?php esc_html_e( '(actual codes vary and expire.)', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Cost', 'hello-elementor-child' ); ?></strong></td>
			<td><strong><?php esc_html_e( 'Message and data rates may apply.', 'hello-elementor-child' ); ?></strong> <?php esc_html_e( 'Contact your wireless carrier for details.', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Opt-in / consent', 'hello-elementor-child' ); ?></strong></td>
			<td><?php esc_html_e( 'By providing your mobile number and clicking to send a code on our Site, you consent to receive the verification SMS for that request. Consent is not a condition of purchasing goods unless a specific checkout step clearly states otherwise.', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Opt-out', 'hello-elementor-child' ); ?></strong></td>
			<td><?php esc_html_e( 'Reply STOP to any message from this program to stop further SMS. You may still receive one final confirmation of your opt-out.', 'hello-elementor-child' ); ?></td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Help', 'hello-elementor-child' ); ?></strong></td>
			<td>
				<?php esc_html_e( 'Reply HELP for assistance, or email', 'hello-elementor-child' ); ?>
				<a href="mailto:<?php echo esc_attr( $support_email ); ?>"><?php echo esc_html( $support_email ); ?></a>.
			</td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Support contact', 'hello-elementor-child' ); ?></strong></td>
			<td>
				<a href="mailto:<?php echo esc_attr( $support_email ); ?>"><?php echo esc_html( $support_email ); ?></a>
				&middot;
				<a href="<?php echo esc_url( $home_url ); ?>"><?php echo esc_html( untrailingslashit( $home_url ) ); ?></a>
			</td>
		</tr>
		<tr>
			<td><strong><?php esc_html_e( 'Privacy', 'hello-elementor-child' ); ?></strong></td>
			<td>
				<?php esc_html_e( 'See our', 'hello-elementor-child' ); ?>
				<a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy Policy', 'hello-elementor-child' ); ?></a>
				<?php esc_html_e( 'for how we handle phone numbers and related data.', 'hello-elementor-child' ); ?>
			</td>
		</tr>
	</tbody>
</table>

<p><?php esc_html_e( 'Carriers are not liable for delayed or undelivered messages. Supported carriers vary by country; US delivery requires a valid US mobile number where US SMS is offered.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '6. Acceptable use', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'You agree not to violate any law or third-party rights; upload malware or interfere with security; impersonate others; abuse SMS verification; or manipulate proof-of-delivery, ledger, or rebate systems.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '7. Intellectual property', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'The Site, logos, text, graphics, software, and other content are owned by us or licensors and protected by intellectual property laws. You receive a limited, non-exclusive, non-transferable license to access and use the Services for personal or authorized business use.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '8. Disclaimers', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'THE SERVICES ARE PROVIDED “AS IS” AND “AS AVAILABLE.” TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '9. Limitation of liability', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'TO THE FULLEST EXTENT PERMITTED BY LAW, WE AND OUR OFFICERS, DIRECTORS, EMPLOYEES, AND SUPPLIERS WILL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES ARISING FROM YOUR USE OF THE SERVICES. OUR TOTAL LIABILITY FOR ANY CLAIM WILL NOT EXCEED THE GREATER OF (A) THE AMOUNT YOU PAID US FOR THE TRANSACTION GIVING RISE TO THE CLAIM IN THE TWELVE (12) MONTHS BEFORE THE CLAIM, OR (B) ONE HUNDRED U.S. DOLLARS (US $100).', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '10. Indemnification', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'You agree to indemnify and hold harmless us from claims arising from your misuse of the Services, violation of these Terms, or violation of any law or third-party rights.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '11. Dispute resolution and governing law', 'hello-elementor-child' ); ?></h2>

<?php if ( '' !== $governing_state && '' !== $governing_venue ) : ?>
	<p>
		<?php
		printf(
			/* translators: 1: US state name, 2: court venue */
			esc_html__( 'These Terms are governed by the laws of the State of %1$s, United States, without regard to conflict-of-law rules, except where mandatory consumer protections in your country apply. Any dispute will be resolved in the state or federal courts located in %2$s, and you consent to personal jurisdiction there, unless applicable law requires otherwise.', 'hello-elementor-child' ),
			esc_html( $governing_state ),
			esc_html( $governing_venue )
		);
		?>
	</p>
<?php else : ?>
	<p><?php esc_html_e( 'These Terms are governed by the laws of the United States and the state in which our principal place of business is located, without regard to conflict-of-law rules, except where mandatory consumer protections in your country apply.', 'hello-elementor-child' ); ?></p>
<?php endif; ?>

<h2><?php esc_html_e( '12. Changes', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'We may modify these Terms at any time by posting an updated version on this page. Continued use after the effective date constitutes acceptance of the revised Terms.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '13. Termination', 'hello-elementor-child' ); ?></h2>

<p><?php esc_html_e( 'You may stop using the Services at any time. We may suspend or terminate access for any reason, including violation of these Terms.', 'hello-elementor-child' ); ?></p>

<h2><?php esc_html_e( '14. Contact', 'hello-elementor-child' ); ?></h2>

<p>
	<strong><?php echo esc_html( $site_name ); ?></strong><br>
	<?php esc_html_e( 'Email:', 'hello-elementor-child' ); ?> <a href="mailto:<?php echo esc_attr( $support_email ); ?>"><?php echo esc_html( $support_email ); ?></a><br>
	<?php esc_html_e( 'Web:', 'hello-elementor-child' ); ?> <a href="<?php echo esc_url( $home_url ); ?>"><?php echo esc_html( untrailingslashit( $home_url ) ); ?></a><br>
	<?php esc_html_e( 'Privacy:', 'hello-elementor-child' ); ?> <a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy Policy', 'hello-elementor-child' ); ?></a>
</p>
