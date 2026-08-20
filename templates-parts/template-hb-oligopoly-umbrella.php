<?php
/**
 * Template Name: Oligopoly Umbrella
 *
 * Client source: Oligopoly_Umbrella_HBC_Utsav_Handoff
 * Does not replace the YAM-is-On landing popup.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$yam_url  = home_url( '/' );
$mega_url = 'https://megavoters.com/';
$css_file = get_stylesheet_directory() . '/assets/css/hb-oligopoly-umbrella.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
$js_file  = get_stylesheet_directory() . '/assets/js/hb-oligopoly-umbrella.js';
$js_ver   = file_exists( $js_file ) ? (string) filemtime( $js_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
$observer = array(
	__( 'Free to observe, browse and shop', 'hello-elementor-child' ),
	__( 'No annual membership pledge', 'hello-elementor-child' ),
	__( 'No Buyer or Seller POC assignment', 'hello-elementor-child' ),
	__( 'Buyer/recipient access when offered', 'hello-elementor-child' ),
	__( 'Free to decline or walk away', 'hello-elementor-child' ),
);
$participant = array(
	__( '$12 annual membership pledge of intent', 'hello-elementor-child' ),
	__( 'No membership payment during gameplay', 'hello-elementor-child' ),
	__( 'Pending until device and Discord acceptance', 'hello-elementor-child' ),
	__( 'One 30-member Seller POC and one Buyer POC', 'hello-elementor-child' ),
	__( 'Assignments arrive through Serendipity', 'hello-elementor-child' ),
);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo esc_html( __( 'Oligopoly Umbrella Explainer', 'hello-elementor-child' ) . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<meta name="description" content="<?php echo esc_attr__( 'Understand the YAM’er observer and MEGAvoter participant roles within Oligopoly Community Checkers.', 'hello-elementor-child' ); ?>" />
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/hb-oligopoly-umbrella.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'hb-ou-body' ); ?>>
	<?php wp_body_open(); ?>
	<a class="skip" href="#main"><?php esc_html_e( 'Skip to content', 'hello-elementor-child' ); ?></a>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<main id="main" class="hb-ou-page page">
		<section class="shell hero">
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Oligopoly · Community Checkers', 'hello-elementor-child' ); ?></p>
				<h1><?php echo wp_kses( __( 'The Oligopoly <em>Umbrella.</em>', 'hello-elementor-child' ), array( 'em' => array() ) ); ?></h1>
				<p class="lead"><?php esc_html_e( 'A structured recording umbrella helps every registered device understand its choices without deciding the next move for the human being.', 'hello-elementor-child' ); ?></p>
				<div class="actions">
					<button type="button" class="button" data-open-oligopoly-umbrella><?php esc_html_e( 'Understand the two roles', 'hello-elementor-child' ); ?></button>
					<a class="button ghost" href="#roles"><?php esc_html_e( 'Read the full explainer', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
			<div class="visual" aria-label="<?php echo esc_attr__( 'A Community Checker device freely choosing between observer and participant', 'hello-elementor-child' ); ?>">
				<div class="dome">
					<span class="yam"><?php echo wp_kses( __( 'YAM’er<small>Observe</small>', 'hello-elementor-child' ), array( 'small' => array() ) ); ?></span>
					<span class="device">▣<small><?php esc_html_e( 'DEVICE', 'hello-elementor-child' ); ?></small></span>
					<span class="mega"><?php echo wp_kses( __( 'MEGAvoter<small>Participate</small>', 'hello-elementor-child' ), array( 'small' => array() ) ); ?></span>
				</div>
				<p><b>≐</b> <?php esc_html_e( 'Human choice remains final', 'hello-elementor-child' ); ?></p>
			</div>
		</section>

		<section class="band">
			<div class="shell steps">
				<article>
					<span>01</span>
					<h3><?php esc_html_e( 'Register the device', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Use an approved device identifier rather than requiring a public name.', 'hello-elementor-child' ); ?></p>
				</article>
				<article>
					<span>02</span>
					<h3><?php esc_html_e( 'Understand the roles', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Observe freely as a YAM’er or voluntarily begin the MEGAvoter path.', 'hello-elementor-child' ); ?></p>
				</article>
				<article>
					<span>03</span>
					<h3><?php esc_html_e( 'Choose every scan', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Seller, giver, buyer, recipient, observer or walk-away remains your choice.', 'hello-elementor-child' ); ?></p>
				</article>
			</div>
		</section>

		<section class="shell section" id="roles">
			<div class="heading">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Two entry roles', 'hello-elementor-child' ); ?></p>
					<h2><?php esc_html_e( 'Observe freely. Participate by choice.', 'hello-elementor-child' ); ?></h2>
				</div>
				<p><?php esc_html_e( 'Shopping, scanning and Discord acceptance do not create membership. Only a voluntary MEGAvoter selection begins the membership process.', 'hello-elementor-child' ); ?></p>
			</div>
			<div class="roles">
				<article class="role">
					<span class="tag"><?php esc_html_e( 'No membership obligation', 'hello-elementor-child' ); ?></span>
					<h3><?php esc_html_e( 'YAM’er', 'hello-elementor-child' ); ?></h3>
					<p class="subtitle"><?php esc_html_e( 'Observer · Buyer · Shopper', 'hello-elementor-child' ); ?></p>
					<ul>
						<?php foreach ( $observer as $item ) : ?>
							<li><b>✓</b><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="button ghost" href="<?php echo esc_url( $yam_url ); ?>"><?php esc_html_e( 'Remain a YAM’er', 'hello-elementor-child' ); ?></a>
				</article>
				<article class="role featured">
					<span class="tag"><?php esc_html_e( 'Voluntary membership path', 'hello-elementor-child' ); ?></span>
					<h3><?php esc_html_e( 'MEGAvoter', 'hello-elementor-child' ); ?></h3>
					<p class="subtitle"><?php esc_html_e( 'Participant · Seller · Messenger', 'hello-elementor-child' ); ?></p>
					<ul>
						<?php foreach ( $participant as $item ) : ?>
							<li><b>✓</b><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="button" href="<?php echo esc_url( $mega_url ); ?>"><?php esc_html_e( 'Explore MEGAvoter', 'hello-elementor-child' ); ?></a>
				</article>
			</div>
		</section>

		<section class="cream" id="serendipity">
			<div class="shell split">
				<div>
					<p class="eyebrow dark"><?php esc_html_e( 'The next device up', 'hello-elementor-child' ); ?></p>
					<h2><?php esc_html_e( 'Serendipity assigns communities—not your next human role.', 'hello-elementor-child' ); ?></h2>
				</div>
				<div class="copy">
					<p><?php esc_html_e( 'A pledge records intent. Membership remains pending until the device accepts the guidelines, enters Discord Gracebook, and the system can issue both 30-member Trade assignments.', 'hello-elementor-child' ); ?></p>
					<div class="flow">
						<span><?php esc_html_e( 'Registered device', 'hello-elementor-child' ); ?></span>
						<b>→</b>
						<span><?php esc_html_e( 'Seller POC', 'hello-elementor-child' ); ?></span>
						<b>+</b>
						<span><?php esc_html_e( 'Buyer POC', 'hello-elementor-child' ); ?></span>
					</div>
					<p><?php esc_html_e( 'The system-wide queue uses the next eligible openings. No organizer, recruiter, payment, XP total or personal influence can purchase priority.', 'hello-elementor-child' ); ?></p>
					<aside><?php esc_html_e( 'Timing depends on the velocity of eligible device registrations and Discord acceptance—not a promised date.', 'hello-elementor-child' ); ?></aside>
				</div>
			</div>
		</section>

		<section class="shell section" id="doors">
			<div class="heading">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Three insulated doors', 'hello-elementor-child' ); ?></p>
					<h2><?php esc_html_e( 'One checker. Three records.', 'hello-elementor-child' ); ?></h2>
				</div>
				<p><?php esc_html_e( 'The initiating QR determines the recording silo. A new scan opens a different door.', 'hello-elementor-child' ); ?></p>
			</div>
			<div class="doors">
				<article>
					<span><?php esc_html_e( 'IDENTITY', 'hello-elementor-child' ); ?></span>
					<h3><?php esc_html_e( 'Who showed up?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Device, consent, role and presence. No purchase, debt, wage or tax event.', 'hello-elementor-child' ); ?></p>
				</article>
				<article>
					<span><?php esc_html_e( 'TRADE', 'hello-elementor-child' ); ?></span>
					<h3><?php esc_html_e( 'What was promised?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'YAM-is-On and separate VFN records. Trade never creates or converts XP.', 'hello-elementor-child' ); ?></p>
				</article>
				<article>
					<span><?php esc_html_e( 'GRATITUDE', 'hello-elementor-child' ); ?></span>
					<h3><?php esc_html_e( 'Who recognized it?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Experience Presence, acceptance and community surplus. XP is never money.', 'hello-elementor-child' ); ?></p>
				</article>
			</div>
		</section>

		<section class="shell freedom">
			<p class="eyebrow dark"><?php esc_html_e( 'The governing freedom', 'hello-elementor-child' ); ?></p>
			<blockquote><?php esc_html_e( 'The checker remains recognizable. Its next move remains a choice.', 'hello-elementor-child' ); ?></blockquote>
			<p><?php esc_html_e( 'Stable POC assignments organize Trade opportunities. They never permanently label a device as seller, buyer, giver or recipient. No response is treated as a character judgment.', 'hello-elementor-child' ); ?></p>
		</section>

		<footer class="shell footer">
			<b><?php esc_html_e( 'Proposed initiative notice.', 'hello-elementor-child' ); ?></b>
			<?php esc_html_e( ' Oligopoly, Community Checkers, the Serendipity Protocol, Discord Gracebook assignments and Patron Organizing Communities are proposed. XP means Experience Presence and is not money, cryptocurrency, wages, credit or a payment obligation.', 'hello-elementor-child' ); ?>
		</footer>
	</main>

	<div class="hb-ou-backdrop" id="hb-ou-modal" hidden>
		<section class="modal" role="dialog" aria-modal="true" aria-labelledby="hb-ou-modal-title">
			<button type="button" class="close" aria-label="<?php echo esc_attr__( 'Close', 'hello-elementor-child' ); ?>">×</button>
			<p class="eyebrow"><?php esc_html_e( 'Oligopoly Umbrella', 'hello-elementor-child' ); ?></p>
			<h2 id="hb-ou-modal-title"><?php esc_html_e( 'Choose how you enter today.', 'hello-elementor-child' ); ?></h2>
			<p class="intro"><?php esc_html_e( 'Both paths preserve your freedom to change encounter roles or walk away. Only participation begins a membership request.', 'hello-elementor-child' ); ?></p>
			<div class="modal-grid">
				<div>
					<b><?php esc_html_e( 'YAM’er · Observer', 'hello-elementor-child' ); ?></b>
					<p><?php esc_html_e( 'Free to browse, shop and observe. No $12 pledge, membership obligation or dual POC assignment.', 'hello-elementor-child' ); ?></p>
				</div>
				<div>
					<b><?php esc_html_e( 'MEGAvoter · Participant', 'hello-elementor-child' ); ?></b>
					<p><?php esc_html_e( 'Voluntary $12 annual pledge. Pending until device, Discord and dual 30-member POC assignment.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
			<div class="actions">
				<a class="button ghost" href="<?php echo esc_url( $yam_url ); ?>"><?php esc_html_e( 'Remain a YAM’er', 'hello-elementor-child' ); ?></a>
				<a class="button" href="<?php echo esc_url( $mega_url ); ?>"><?php esc_html_e( 'Explore MEGAvoter', 'hello-elementor-child' ); ?></a>
			</div>
			<p class="modal-foot"><?php esc_html_e( 'No membership payment is collected during gameplay.', 'hello-elementor-child' ); ?></p>
		</section>
	</div>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
	<script src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/js/hb-oligopoly-umbrella.js' ); ?>?ver=<?php echo esc_attr( $js_ver ); ?>"></script>
</body>
</html>
