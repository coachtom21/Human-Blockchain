<?php
/**
 * Template Name: Activate (Mega funnel)
 *
 * Dedicated Mega handoff activate page. No shop, PoD, $0, $12, $30, $4, or XP.
 * Discord / Gracebook is optional — never an auto-redirect gate.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$state       = HB_Start_Activate::state();
$branch      = HB_Start_Activate::branch_label( isset( $state['branch'] ) ? $state['branch'] : '' );
$mega_start  = HB_Start_Activate::mega_start_url();
$hbc_rsvp    = home_url( '/r' );
$discord_url = HB_Start_Activate::discord_invite_url();
$step        = 'device';
if ( ! empty( $state['device_registered'] ) ) {
	// Device registration completes the required funnel. Gracebook/Discord is optional.
	$step = 'complete';
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
			<div class="hb-act-progress__step<?php echo 'device' === $step ? ' is-current' : ''; ?><?php echo 'complete' === $step ? ' is-done' : ''; ?>">
				<span>1</span><?php esc_html_e( 'Device', 'hello-elementor-child' ); ?>
			</div>
			<div class="hb-act-progress__step<?php echo 'complete' === $step ? ' is-current' : ''; ?>">
				<span>2</span><?php esc_html_e( 'Ready', 'hello-elementor-child' ); ?>
			</div>
		</div>
	</nav>

	<main class="hb-act-main" id="content">
		<div class="hb-act-wrap">

			<?php if ( 'missing' === $step ) : ?>
				<section class="hb-act-card">
					<p class="hb-act-eyebrow"><?php esc_html_e( 'Start first', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'This page needs a Start handoff.', 'hello-elementor-child' ); ?></h1>
					<p><?php esc_html_e( 'Choose Participate on Miners. That sealed token is the only way this page knows your Peace Pentagon branch.', 'hello-elementor-child' ); ?></p>
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
						<p class="hb-act-note"><?php esc_html_e( 'No shop, pledge, membership, XP, or Discord join is required here.', 'hello-elementor-child' ); ?></p>
						<div id="hb-register-msg" role="status" aria-live="polite"></div>
					</form>
				</section>

				<section class="hb-act-card" id="hb-complete-panel" <?php echo 'complete' === $step ? '' : 'hidden'; ?>>
					<p class="hb-act-eyebrow"><?php esc_html_e( 'Device ready', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'You can return to your event.', 'hello-elementor-child' ); ?></h1>
					<p><?php esc_html_e( 'This device is registered. Discord Gracebook is optional — you are not sent there automatically. Continue with Human Gold RSVP or explore Miners.', 'hello-elementor-child' ); ?></p>
					<div class="hb-act-next">
						<a class="hb-act-btn" href="<?php echo esc_url( $hbc_rsvp ); ?>"><?php esc_html_e( 'Return to Human Gold RSVP (/r)', 'hello-elementor-child' ); ?></a>
						<a class="hb-act-btn hb-act-btn--ghost" href="<?php echo esc_url( HB_Start_Activate::sister_url( 'mega', '/discover/' ) ); ?>"><?php esc_html_e( 'Observe as a Nugget', 'hello-elementor-child' ); ?></a>
						<a class="hb-act-btn hb-act-btn--ghost" href="<?php echo esc_url( HB_Start_Activate::sister_url( 'mega', '/' ) ); ?>"><?php esc_html_e( 'Explore Miner participation', 'hello-elementor-child' ); ?></a>
					</div>

					<details class="hb-act-optional" style="margin-top:28px">
						<summary><?php esc_html_e( 'Optional: Discord Gracebook invite', 'hello-elementor-child' ); ?></summary>
						<div id="hb-gracebook-panel" style="margin-top:16px">
							<p><?php esc_html_e( 'Gracebook is an optional conversation space. It is not required for RSVP, device registration, or attending an HBC event.', 'hello-elementor-child' ); ?></p>
							<button class="hb-act-btn hb-act-btn--ghost" type="button" id="hb-gracebook-btn"><?php esc_html_e( 'Save optional Gracebook interest', 'hello-elementor-child' ); ?></button>
							<?php if ( is_string( $discord_url ) && $discord_url !== '' ) : ?>
								<p style="margin-top:12px">
									<a id="hb-discord-optional-link" class="hb-act-btn hb-act-btn--ghost" href="<?php echo esc_url( $discord_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Open Discord invite (optional)', 'hello-elementor-child' ); ?></a>
								</p>
							<?php else : ?>
								<a id="hb-discord-optional-link" hidden href="#" target="_blank" rel="noopener noreferrer"></a>
							<?php endif; ?>
							<button class="hb-act-btn hb-act-btn--ghost" type="button" id="hb-gracebook-skip" style="margin-top:8px"><?php esc_html_e( 'Skip — stay here', 'hello-elementor-child' ); ?></button>
							<div id="hb-gracebook-msg" role="status" aria-live="polite"></div>
						</div>
					</details>
				</section>

			<?php endif; ?>
		</div>
	</main>
</div>

<?php wp_footer(); ?>
</body>
</html>
