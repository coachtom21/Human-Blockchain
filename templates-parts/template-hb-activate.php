<?php
/**
 * Template Name: Activate (Mega funnel)
 *
 * Dedicated Mega handoff activate page. No shop, PoD, $0, $12, $30, $4, or XP.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$state       = HB_Start_Activate::state();
$branch      = HB_Start_Activate::branch_label( isset( $state['branch'] ) ? $state['branch'] : '' );
$mega_start  = HB_Start_Activate::mega_start_url();
$step        = 'device';
if ( ! empty( $state['gracebook_accepted'] ) ) {
	$step = 'complete';
} elseif ( ! empty( $state['device_registered'] ) ) {
	$step = 'gracebook';
} elseif ( ! empty( $state['error'] ) ) {
	$step = 'error';
} elseif ( empty( $state['redeemed'] ) ) {
	$step = 'missing';
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'hb-activate-body' ); ?>>
<?php wp_body_open(); ?>

<div class="hb-act">
	<header class="hb-act-top">
		<div class="hb-act-wrap hb-act-top__inner">
			<a class="hb-act-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="hb-act-mark" aria-hidden="true">H</span>
				<span>
					<strong><?php esc_html_e( 'HumanBlockchain', 'hello-elementor-child' ); ?></strong>
					<small><?php esc_html_e( 'Device activation', 'hello-elementor-child' ); ?></small>
				</span>
			</a>
			<a class="hb-act-back" href="<?php echo esc_url( $mega_start ); ?>"><?php esc_html_e( '← Return to Start', 'hello-elementor-child' ); ?></a>
		</div>
	</header>

	<nav class="hb-act-progress" aria-label="<?php echo esc_attr__( 'Activation progress', 'hello-elementor-child' ); ?>">
		<div class="hb-act-wrap hb-act-progress__inner">
			<div class="hb-act-progress__step<?php echo 'device' === $step ? ' is-current' : ''; ?><?php echo in_array( $step, array( 'gracebook', 'complete' ), true ) ? ' is-done' : ''; ?>">
				<span>1</span><?php esc_html_e( 'Device', 'hello-elementor-child' ); ?>
			</div>
			<div class="hb-act-progress__step<?php echo 'gracebook' === $step ? ' is-current' : ''; ?><?php echo 'complete' === $step ? ' is-done' : ''; ?>">
				<span>2</span><?php esc_html_e( 'Gracebook', 'hello-elementor-child' ); ?>
			</div>
			<div class="hb-act-progress__step<?php echo 'complete' === $step ? ' is-current' : ''; ?>">
				<span>3</span><?php esc_html_e( 'Ready', 'hello-elementor-child' ); ?>
			</div>
		</div>
	</nav>

	<main class="hb-act-main" id="content">
		<div class="hb-act-wrap">

			<?php if ( 'missing' === $step ) : ?>
				<section class="hb-act-card">
					<p class="hb-act-eyebrow"><?php esc_html_e( 'Start first', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'This page needs a Start handoff.', 'hello-elementor-child' ); ?></h1>
					<p><?php esc_html_e( 'Choose Participate on MEGAvoters. That sealed token is the only way this page knows your Peace Pentagon branch.', 'hello-elementor-child' ); ?></p>
					<a class="hb-act-btn" href="<?php echo esc_url( $mega_start ); ?>"><?php esc_html_e( 'Go to Start', 'hello-elementor-child' ); ?></a>
				</section>

			<?php elseif ( 'error' === $step ) : ?>
				<section class="hb-act-card">
					<p class="hb-act-eyebrow"><?php esc_html_e( 'Handoff not accepted', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'We could not continue.', 'hello-elementor-child' ); ?></h1>
					<p><?php echo esc_html( $state['error'] ); ?></p>
					<a class="hb-act-btn" href="<?php echo esc_url( $mega_start ); ?>"><?php esc_html_e( 'Return to Start', 'hello-elementor-child' ); ?></a>
				</section>

			<?php else : ?>

				<section class="hb-act-card" id="hb-device-panel" <?php echo 'device' === $step ? '' : 'hidden'; ?>>
					<p class="hb-act-eyebrow"><?php esc_html_e( 'Recognize this device', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'Activate this Community Checker.', 'hello-elementor-child' ); ?></h1>
					<p><?php esc_html_e( 'This voluntary registration recognizes this device as one Community Checker. It does not establish your worth, continuously track your location, or create money, cryptocurrency, research consent, or a financial obligation.', 'hello-elementor-child' ); ?></p>

					<div class="hb-act-lock">
						<strong><?php esc_html_e( 'Your Peace Pentagon branch', 'hello-elementor-child' ); ?></strong>
						<p><?php echo esc_html( $branch !== '' ? $branch : __( 'Unknown', 'hello-elementor-child' ) ); ?></p>
						<p class="hb-act-lock__warn"><?php esc_html_e( 'This first branch becomes defining when device registration is confirmed and cannot later be changed.', 'hello-elementor-child' ); ?></p>
					</div>

					<form id="hb-activate-form">
						<label>
							<span><?php esc_html_e( 'Email for verification', 'hello-elementor-child' ); ?></span>
							<input type="email" name="email" required autocomplete="email">
						</label>
						<label>
							<span><?php esc_html_e( 'Mobile (optional)', 'hello-elementor-child' ); ?></span>
							<input type="tel" name="mobile" autocomplete="tel">
						</label>
						<label class="hb-act-check">
							<input type="checkbox" name="privacy_ok" value="1" required>
							<span><?php esc_html_e( 'I accept the privacy disclosure for this voluntary device recognition.', 'hello-elementor-child' ); ?></span>
						</label>
						<button class="hb-act-btn" type="submit" id="hb-register-btn"><?php esc_html_e( 'Register My Device', 'hello-elementor-child' ); ?></button>
						<p class="hb-act-note"><?php esc_html_e( 'No shop, pledge, membership, XP, or proof-of-delivery is collected here.', 'hello-elementor-child' ); ?></p>
						<div id="hb-register-msg" role="status" aria-live="polite"></div>
					</form>
				</section>

				<section class="hb-act-card" id="hb-gracebook-panel" <?php echo 'gracebook' === $step ? '' : 'hidden'; ?>>
					<p class="hb-act-eyebrow"><?php esc_html_e( 'Join the conversation—not an ideology', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'Accept the Gracebook covenant.', 'hello-elementor-child' ); ?></h1>
					<p><?php esc_html_e( 'Discord Gracebook is where Community Checkers receive pilot notices, ask questions, and help reconcile what the community reports. Joining the server alone does not complete acceptance.', 'hello-elementor-child' ); ?></p>
					<ul class="hb-act-acks">
						<li><?php esc_html_e( 'I will Practice FAITH: Fair, Accepting, Insightful, Transparent, and Humble.', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'I understand that participation is voluntary and no response is a character judgment.', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'I understand that testnet XP is Experience Presence and never money.', 'hello-elementor-child' ); ?></li>
					</ul>
					<button class="hb-act-btn" type="button" id="hb-gracebook-btn"><?php esc_html_e( 'I Accept and Enter Gracebook', 'hello-elementor-child' ); ?></button>
					<p class="hb-act-note"><?php esc_html_e( 'This click is the acceptance. Opening Discord without it leaves onboarding incomplete.', 'hello-elementor-child' ); ?></p>
					<div id="hb-gracebook-msg" role="status" aria-live="polite"></div>
				</section>

				<section class="hb-act-card" id="hb-complete-panel" <?php echo 'complete' === $step ? '' : 'hidden'; ?>>
					<p class="hb-act-eyebrow"><?php esc_html_e( 'Both flags are true', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'Community Checker ready', 'hello-elementor-child' ); ?></h1>
					<p><?php esc_html_e( 'This device is registered and Gracebook acceptance is confirmed. You may now RSVP, observe as a YAM’er, or continue as a MEGAvoter.', 'hello-elementor-child' ); ?></p>
					<div class="hb-act-next">
						<a class="hb-act-btn" href="<?php echo esc_url( HB_Start_Activate::sister_url( 'llb', '/god-wink/' ) ); ?>"><?php esc_html_e( 'RSVP for the proposed LAUGH gathering', 'hello-elementor-child' ); ?></a>
						<a class="hb-act-btn hb-act-btn--ghost" href="<?php echo esc_url( HB_Start_Activate::sister_url( 'mega', '/discover/' ) ); ?>"><?php esc_html_e( 'Observe as a YAM’er', 'hello-elementor-child' ); ?></a>
						<a class="hb-act-btn hb-act-btn--ghost" href="<?php echo esc_url( HB_Start_Activate::sister_url( 'mega', '/' ) ); ?>"><?php esc_html_e( 'Explore MEGAvoter participation', 'hello-elementor-child' ); ?></a>
					</div>
				</section>

			<?php endif; ?>
		</div>
	</main>
</div>

<?php wp_footer(); ?>
</body>
</html>
