<?php
/**
 * Template Name: Treasured Penny
 *
 * Client source: HumanBlockchain_Treasured_Penny.html
 * Gratitude only — no Woo, payment, QRTiger, or Smallstreet XP.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hb_penny_page_url = static function ( $slugs, $fallback ) {
	$slugs = is_array( $slugs ) ? $slugs : array( $slugs );
	foreach ( $slugs as $slug ) {
		$slug = sanitize_title( (string) $slug );
		if ( $slug === '' ) {
			continue;
		}
		$page = get_page_by_path( $slug );
		if ( $page instanceof WP_Post ) {
			return get_permalink( $page );
		}
	}
	return home_url( $fallback );
};

$register_url = $hb_penny_page_url(
	array( 'register', 'register-device', 'device-registration', 'activate-device' ),
	'/register-device/'
);

$css_file = get_stylesheet_directory() . '/assets/css/treasured-penny.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo esc_html( __( 'The Treasured Penny', 'hello-elementor-child' ) . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<meta name="description" content="<?php echo esc_attr__( 'The Treasured Penny — a Human Blockchain proof-of-presence experience.', 'hello-elementor-child' ); ?>" />
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/treasured-penny.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'hb-penny-body' ); ?>>
	<?php wp_body_open(); ?>
	<a class="skip" href="#main"><?php esc_html_e( 'Skip to content', 'hello-elementor-child' ); ?></a>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<main id="main" class="hb-page">
		<section class="hb-shell hb-hero">
			<div>
				<p class="hb-eyebrow"><?php esc_html_e( 'You And Me • Proof of Presence', 'hello-elementor-child' ); ?></p>
				<h1><?php esc_html_e( 'The Treasured', 'hello-elementor-child' ); ?> <span><?php esc_html_e( 'Penny.', 'hello-elementor-child' ); ?></span></h1>
				<p class="hb-lead"><?php esc_html_e( 'I would do this for free, but you have to accept one treasured penny—person to person, just You And Me.', 'hello-elementor-child' ); ?></p>
				<div class="hb-actions">
					<a class="hb-button" href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Activate your device', 'hello-elementor-child' ); ?></a>
					<a class="hb-button hb-button--ghost" href="#how-it-works"><?php esc_html_e( 'See the two-scan proof', 'hello-elementor-child' ); ?></a>
				</div>
			</div>

			<div class="hb-coin-stage" aria-label="<?php esc_attr_e( 'One treasured penny equals one sextillion Experience Presence units', 'hello-elementor-child' ); ?>">
				<div class="hb-orbit" aria-hidden="true"></div>
				<div class="hb-coin" aria-hidden="true"><div><strong>1¢</strong><span><?php esc_html_e( 'Treasured Presence', 'hello-elementor-child' ); ?></span></div></div>
				<div class="hb-signal"><b>Y / Y / Y</b> &nbsp; <?php esc_html_e( 'Device ready', 'hello-elementor-child' ); ?></div>
			</div>
		</section>

		<section class="hb-band" id="how-it-works">
			<div class="hb-shell hb-proof-grid">
				<article class="hb-proof">
					<span class="hb-proof-num">01</span>
					<h3><?php esc_html_e( 'The benefactor offers', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'A registered seller/giver chooses the treasured penny and initiates the postcard encounter.', 'hello-elementor-child' ); ?></p>
				</article>
				<article class="hb-proof">
					<span class="hb-proof-num">02</span>
					<h3><?php esc_html_e( 'The beneficiary accepts', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'A different registered buyer/recipient confirms the postcard and personally accepts the penny.', 'hello-elementor-child' ); ?></p>
				</article>
				<article class="hb-proof">
					<span class="hb-proof-num">03</span>
					<h3><?php esc_html_e( 'Presence becomes proof', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Two devices, two confirmations and one shared moment create an append-only proof of presence.', 'hello-elementor-child' ); ?></p>
				</article>
			</div>
		</section>

		<section class="hb-shell hb-story" id="levels">
			<div class="hb-story-head">
				<div>
					<p class="hb-eyebrow"><?php esc_html_e( 'Race to the bottom', 'hello-elementor-child' ); ?></p>
					<h2><?php esc_html_e( 'Smaller money reference. More room for people.', 'hello-elementor-child' ); ?></h2>
				</div>
				<div class="hb-story-copy">
					<p><?php esc_html_e( 'Three treasured-penny encounters carry the same $0.03 NWP reference as one Guild encounter, but they record three separate moments when people chose to show up.', 'hello-elementor-child' ); ?></p>
					<p><?php esc_html_e( 'The amounts correlate presence. They never determine anyone’s human worth.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>

			<div class="hb-levels">
				<article class="hb-level hb-level--featured">
					<span class="hb-tag"><?php esc_html_e( 'Recommended', 'hello-elementor-child' ); ?></span>
					<div class="hb-price">$0.01</div>
					<h3><?php esc_html_e( 'Treasured Penny', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Individual gratitude that leaves room for two more people to show up today.', 'hello-elementor-child' ); ?></p>
					<div class="hb-equation"><?php esc_html_e( '$0.01 NWP ≐ 1 sextillion XP', 'hello-elementor-child' ); ?></div>
				</article>
				<article class="hb-level">
					<span class="hb-tag"><?php esc_html_e( 'Verified POC', 'hello-elementor-child' ); ?></span>
					<div class="hb-price">$0.02</div>
					<h3><?php esc_html_e( 'Five-Seller POC', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'A Patron Organizing Community (POC): network-weighted presence issued through an active five-seller community.', 'hello-elementor-child' ); ?></p>
					<div class="hb-equation"><?php esc_html_e( '$0.02 NWP ≐ 2 sextillion XP', 'hello-elementor-child' ); ?></div>
				</article>
				<article class="hb-level">
					<span class="hb-tag"><?php esc_html_e( 'Verified Guild', 'hello-elementor-child' ); ?></span>
					<div class="hb-price">$0.03</div>
					<h3><?php esc_html_e( 'Guild Standard', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Guild-level recognition that fills one beneficiary’s individual daily capacity.', 'hello-elementor-child' ); ?></p>
					<div class="hb-equation"><?php esc_html_e( '$0.03 NWP ≐ 3 sextillion XP', 'hello-elementor-child' ); ?></div>
				</article>
			</div>
		</section>

		<section class="hb-shell hb-easter" id="easter-egg">
			<div class="hb-easter-card">
				<p class="hb-eyebrow"><?php esc_html_e( 'The entire process is the discovery', 'hello-elementor-child' ); ?></p>
				<blockquote><?php esc_html_e( 'Your presence created the Easter Egg.', 'hello-elementor-child' ); ?></blockquote>
				<p><?php esc_html_e( 'You did not have to hunt for it, win it or buy it. The seller/giver benefactor and buyer/recipient beneficiary created it together by showing up and accepting one another’s presence. You enjoy the Easter Egg.', 'hello-elementor-child' ); ?></p>
			</div>
		</section>

		<section class="hb-shell hb-rules" aria-label="<?php esc_attr_e( 'Treasured Penny rules', 'hello-elementor-child' ); ?>">
			<article class="hb-rule">
				<h3><?php esc_html_e( 'Giving remains limitless.', 'hello-elementor-child' ); ?></h3>
				<p><?php esc_html_e( 'A seller/giver may create as many legitimate, independently confirmed postcard encounters as people are willing to accept.', 'hello-elementor-child' ); ?></p>
			</article>
			<article class="hb-rule">
				<h3><?php esc_html_e( 'Personal capacity remains fixed.', 'hello-elementor-child' ); ?></h3>
				<p><?php esc_html_e( 'A buyer/recipient may accept no more than $0.03 NWP into individual capacity each day. Accepted excess is supported by the Gratitude Community Surplus.', 'hello-elementor-child' ); ?></p>
			</article>
			<article class="hb-rule">
				<h3><?php esc_html_e( 'The community supports the penny.', 'hello-elementor-child' ); ?></h3>
				<p><?php esc_html_e( 'The penny is not payment for showing up. It is the smallest shared acknowledgment that one person gave and another personally accepted.', 'hello-elementor-child' ); ?></p>
			</article>
			<article class="hb-rule">
				<h3><?php esc_html_e( 'Every response remains a choice.', 'hello-elementor-child' ); ?></h3>
				<p><?php esc_html_e( 'Participate, observe, decline or walk away. No response is treated as a character judgment.', 'hello-elementor-child' ); ?></p>
			</article>
		</section>

		<footer class="hb-shell hb-disclaimer">
			<strong><?php esc_html_e( 'XP means Experience Presence.', 'hello-elementor-child' ); ?></strong>
			<?php esc_html_e( 'NWP and XP are non-cash accounting references for verified participation. They are not money, cryptocurrency, credit, wages or a payment obligation. Human Blockchain records proof before payment and visibility without custody.', 'hello-elementor-child' ); ?>
		</footer>
	</main>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
