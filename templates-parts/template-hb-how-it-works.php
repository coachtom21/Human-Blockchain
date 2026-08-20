<?php
/**
 * Template Name: How It Works
 *
 * Client source: humanblockchain-how-it-works.html
 * Does not replace the YAM-is-On landing popup.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$css_file = get_stylesheet_directory() . '/assets/css/hb-how-it-works.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo esc_html( __( 'How It Works', 'hello-elementor-child' ) . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<meta name="description" content="<?php echo esc_attr__( 'One invitation. Three websites. Your choice to show up.', 'hello-elementor-child' ); ?>" />
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/hb-how-it-works.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'hb-hiw-body' ); ?>>
	<?php wp_body_open(); ?>
	<a class="skip" href="#main"><?php esc_html_e( 'Skip to content', 'hello-elementor-child' ); ?></a>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<main id="main" class="hb-hiw-page">
		<header class="hb-hero">
			<div class="hb-wrap">
				<p class="hb-eyebrow"><?php esc_html_e( 'The Human Gold Rush • How It Works', 'hello-elementor-child' ); ?></p>
				<h1><?php esc_html_e( 'One invitation. Three websites. Your choice to show up.', 'hello-elementor-child' ); ?></h1>
				<p class="hb-lead"><?php esc_html_e( 'The journey begins with curiosity, continues with a personal RSVP, and becomes measurable only when a registered device confirms presence. Money never has to come first.', 'hello-elementor-child' ); ?></p>
				<div class="hb-actions">
					<a class="hb-btn hb-btn--gold" href="https://megavoters.com/"><?php esc_html_e( 'Begin at MEGAvoters.com', 'hello-elementor-child' ); ?></a>
					<a class="hb-btn" href="#three-site-funnel"><?php esc_html_e( 'See the three-site funnel', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
		</header>

		<section class="hb-section" id="three-site-funnel">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'The three-site funnel', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'Each site has one job', 'hello-elementor-child' ); ?></h2>
				<p class="hb-intro"><?php esc_html_e( 'The sites work together without blending their responsibilities. The invitation, the Human Gold Rush experience, and the proof-and-ledger tools remain easy to recognize.', 'hello-elementor-child' ); ?></p>
				<div class="hb-funnel">
					<article class="hb-step">
						<span class="hb-num">1</span>
						<h3><?php esc_html_e( 'Receive the invitation', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'MEGAvoters.com introduces the choice to observe or participate and redirects visitors into the Human Gold Rush. It is the welcome door—not the gratitude ledger.', 'hello-elementor-child' ); ?></p>
						<a class="hb-domain" href="https://megavoters.com/"><?php esc_html_e( 'MEGAvoters.com →', 'hello-elementor-child' ); ?></a>
					</article>
					<article class="hb-step">
						<span class="hb-num">2</span>
						<h3><?php esc_html_e( 'RSVP to the experience', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'LegacyToLiveBy.org asks whether you can practice FAITH—Fair, Accepting, Insightful, Transparent, and Humble. Choose one of 12 touchstone words, confirm the RSVP, and attend a local LAUGH fulfillment event when available.', 'hello-elementor-child' ); ?></p>
						<a class="hb-domain" href="https://legacytoliveby.org/god-wink/"><?php esc_html_e( 'LegacyToLiveBy.org →', 'hello-elementor-child' ); ?></a>
					</article>
					<article class="hb-step">
						<span class="hb-num">3</span>
						<h3><?php esc_html_e( 'Make presence count', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'HumanBlockchain.info registers the device, records consent and encounter outcomes, and connects the participant to Discord Gracebook. Proof can be known by a device without making a public identity the center of the experience.', 'hello-elementor-child' ); ?></p>
						<a class="hb-domain" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'HumanBlockchain.info →', 'hello-elementor-child' ); ?></a>
					</article>
				</div>
			</div>
		</section>

		<section class="hb-section hb-section--white">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'What happens after the RSVP', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'Showing up is the proof', 'hello-elementor-child' ); ?></h2>
				<p class="hb-intro"><?php esc_html_e( 'The study can compare intent with behavior without judging either choice. Participate, observe, walk away, or do not scan—each is a valid outcome.', 'hello-elementor-child' ); ?></p>
				<div class="hb-grid">
					<article class="hb-card">
						<h3><?php esc_html_e( '1. Accept the covenant', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Confirm the simple CEI study terms and the choice to practice FAITH. No answer is treated as a character judgment.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '2. Register one device', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Create a privacy-minded device presence record. The device—not a public personal profile—is the proof object.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '3. Accept Discord Gracebook', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Choose a Peace Pentagon branch and accept the community role needed to receive recognition or consideration.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '4. Complete a two-scan encounter', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A seller/giver benefactor and buyer/recipient beneficiary each confirm the encounter. Time, consent, and permitted location checks create proof.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '5. Record the outcome', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Issued, pending, matured, disputed, reconciled, and extinguished describe ledger status. They do not create an XP payment obligation.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '6. Learn from the pattern', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Communities may compare RSVP, attendance, fulfillment, acceptance, and participation patterns. The research may correlate outcomes; it does not claim to prove motive or character.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
			</div>
		</section>

		<section class="hb-section">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'Choose your path', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'Observer or participant', 'hello-elementor-child' ); ?></h2>
				<div class="hb-paths">
					<article class="hb-path">
						<small><?php esc_html_e( 'YAM\'er', 'hello-elementor-child' ); ?></small>
						<h3><?php esc_html_e( 'Observe • Buy • Receive', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A free observer/buyer/recipient path. Discord Gracebook acceptance is required when consideration or XP recognition is received. There is no fiscal responsibility simply for observing.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-path hb-path--blue">
						<small><?php esc_html_e( 'MEGAvoter', 'hello-elementor-child' ); ?></small>
						<h3><?php esc_html_e( 'Participate • Sell • Give', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A participant/seller/messenger path connected to a $12 annual membership pledge and a Tiger\'s Eye worry-prayer touchstone backorder. The pledge is not a payment collected at a LAUGH event.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
			</div>
		</section>

		<section class="hb-section hb-section--white" id="three-qr-layers">
			<div class="hb-wrap">
				<?php hb_render_coach_tom_welcome(); ?>
				<span class="hb-kicker"><?php esc_html_e( 'Three QR layers', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'Identity, trade, and gratitude stay distinct', 'hello-elementor-child' ); ?></h2>
				<div class="hb-rules">
					<div class="hb-rule">
						<strong><?php esc_html_e( 'Identity QR', 'hello-elementor-child' ); ?></strong>
						<span><?php esc_html_e( 'Registers device presence and supports the “You And Me” two-device encounter.', 'hello-elementor-child' ); ?></span>
					</div>
					<div class="hb-rule">
						<strong><?php esc_html_e( 'YAM-is-On Trade QR', 'hello-elementor-child' ); ?></strong>
						<span><?php esc_html_e( 'Represents an expected $30 trade value through WooCommerce. Fiscal settlement remains outside the XP ledger.', 'hello-elementor-child' ); ?></span>
					</div>
					<div class="hb-rule">
						<strong><?php esc_html_e( 'Seeking Gratitude QR', 'hello-elementor-child' ); ?></strong>
						<span><?php esc_html_e( 'Represents a $30 trade-value-equivalent XP allocation only. It is never money, cash, or crypto.', 'hello-elementor-child' ); ?></span>
					</div>
				</div>
				<div class="hb-note">
					<strong><?php esc_html_e( 'The boundary matters:', 'hello-elementor-child' ); ?></strong>
					<?php esc_html_e( ' XP means Experience Presence. Network Weighted Presence (NWP) uses the project\'s dot-over-equal convention (≐) to communicate a social-value correlation, not cash convertibility. Buyer/recipient daily capacity stays fixed; additional accepted gratitude supports the community surplus. Seller/giver gratitude can continue without turning personal capacity into hoarding.', 'hello-elementor-child' ); ?>
				</div>
			</div>
		</section>

		<section class="hb-cta">
			<div class="hb-wrap">
				<h2><?php esc_html_e( 'Leave your wallet at home. Bring your presence.', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'The first question is not what you can pay. It is whether you will RSVP, practice FAITH, and show up for others.', 'hello-elementor-child' ); ?></p>
				<a class="hb-btn hb-btn--gold" href="https://legacytoliveby.org/god-wink/"><?php esc_html_e( 'Explore the Human Gold Rush', 'hello-elementor-child' ); ?></a>
			</div>
		</section>

		<footer class="hb-foot">
			<div class="hb-wrap"><?php esc_html_e( 'HumanBlockchain.info • Device-driven proof • Gratitude and trade remain separate', 'hello-elementor-child' ); ?></div>
		</footer>
	</main>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
