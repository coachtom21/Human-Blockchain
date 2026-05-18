<?php
/**
 * Template Name: Explore Research landing
 *
 * YAM JAM research portal — Andrew Young School / civic technology framing.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve a page URL by slug with a path fallback.
 *
 * @param string|string[] $slugs    Page slug(s), first match wins.
 * @param string          $fallback home_url path fallback.
 * @return string
 */
$hb_explore_research_page_url = static function ( $slugs, $fallback ) {
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

$url_member_services = function_exists( 'hb_get_nwp_landing_permalink' )
	? hb_get_nwp_landing_permalink()
	: $hb_explore_research_page_url( array( 'nwp-landing', 'nwp' ), '/' );
$css_file = get_stylesheet_directory() . '/assets/css/explore-research-landing.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Explore Research', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/explore-research-landing.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'explore-research-landing' ); ?>>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<section class="yamjam-portal" aria-labelledby="yamjam-research-title">
		<div class="yamjam-wrap">

			<p class="kicker"><?php esc_html_e( 'HumanBlockchain.info Research Portal', 'hello-elementor-child' ); ?></p>

			<h1 id="yamjam-research-title"><?php esc_html_e( 'YAM JAM: The Reputation Economy', 'hello-elementor-child' ); ?></h1>

			<p class="lead">
				<?php esc_html_e( 'A device-driven presence verification schema for studying human participation, trust, cooperation, and peace — without moving a single fiat penny.', 'hello-elementor-child' ); ?>
			</p>

			<div class="cta-row">
				<a
					href="#"
					class="btn primary cpm-nwp-open-modal"
					data-cpm-modal="cpm-nwp-register-modal"
					aria-controls="cpm-nwp-register-modal"
					aria-haspopup="dialog"
				><?php esc_html_e( 'Register Device', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( $url_member_services ); ?>" class="btn secondary"><?php esc_html_e( 'Member Services', 'hello-elementor-child' ); ?></a>
			</div>

			<div class="intro-card">
				<h2><?php esc_html_e( 'An Easy Discovery Portal for Andrew Young School Researchers', 'hello-elementor-child' ); ?></h2>
				<p>
					<?php esc_html_e( 'YAM JAM invites graduate students, faculty, and civic technology researchers to explore whether verified human participation can become a measurable public policy signal.', 'hello-elementor-child' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'The experiment uses technologies that already exist today: smartphones, two universal QR codes, GPS proximity, timestamps, QRtiger v-cards, Discord/Gracebook credentials, WooCommerce routing, and an append-only reputation ledger.', 'hello-elementor-child' ); ?>
				</p>
				<p>
					<?php
					printf(
						/* translators: %s: strong-wrapped research question (markup). */
						wp_kses_post( __( 'The core research question is simple: %s', 'hello-elementor-child' ) ),
						'<strong>' . esc_html__( 'Can peace, trust, and cooperation be measured through verified human presence?', 'hello-elementor-child' ) . '</strong>'
					);
					?>
				</p>
			</div>

			<div class="schema-grid">

				<div class="schema-card">
					<span class="number">01</span>
					<h3><?php esc_html_e( 'Device Registration', 'hello-elementor-child' ); ?></h3>
					<p>
						<?php esc_html_e( 'Participants register a scanning device and attach basic credentials: email, QRtiger v-card, and Discord/Gracebook access.', 'hello-elementor-child' ); ?>
					</p>
				</div>

				<div class="schema-card">
					<span class="number">02</span>
					<h3><?php esc_html_e( 'Universal Identity QR', 'hello-elementor-child' ); ?></h3>
					<p>
						<?php esc_html_e( 'The first QR code recognizes whether a device is registered, unregistered, returning, or eligible for member services.', 'hello-elementor-child' ); ?>
					</p>
				</div>

				<div class="schema-card">
					<span class="number">03</span>
					<h3><?php esc_html_e( 'Universal Proof QR', 'hello-elementor-child' ); ?></h3>
					<p>
						<?php esc_html_e( 'The second QR code opens a presence session between two devices, using time, location, and yes/no prompts to verify interaction.', 'hello-elementor-child' ); ?>
					</p>
				</div>

				<div class="schema-card">
					<span class="number">04</span>
					<h3><?php esc_html_e( 'Append-Only Reputation', 'hello-elementor-child' ); ?></h3>
					<p>
						<?php esc_html_e( 'Verified participation is written to a ledger as Experience Presence, creating a reputation economy based on action, not speculation.', 'hello-elementor-child' ); ?>
					</p>
				</div>

			</div>

			<div class="no-money-box">
				<h2><?php esc_html_e( 'No Fiat. No Crypto. No Custody.', 'hello-elementor-child' ); ?></h2>
				<p>
					<?php esc_html_e( 'YAM JAM begins as a research-grade participation system. It does not require fiat payment, crypto transfer, token speculation, or custodial finance.', 'hello-elementor-child' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'The goal is to measure verified human interaction before assigning monetary meaning to it. A single device scan becomes a public-interest data point: someone showed up, interacted, confirmed, and participated.', 'hello-elementor-child' ); ?>
				</p>
			</div>

			<div class="nwp-box">
				<h2><?php esc_html_e( 'New World Penny Is Another Matter', 'hello-elementor-child' ); ?></h2>
				<p>
					<?php esc_html_e( 'New World Penny represents gratitude, recognition, and human value signaling. It may be studied separately as a symbolic reputation unit, but the first YAM JAM research portal focuses on device presence, Proof of Delivery, and participation metrics.', 'hello-elementor-child' ); ?>
				</p>
			</div>

			<div class="krill-box">
				<h2><?php esc_html_e( 'Organized Krill as United Citizens', 'hello-elementor-child' ); ?></h2>
				<p>
					<?php esc_html_e( 'Organized Krill describes ordinary people moving together in a sea of change. As United Citizens, participants do not need financial power to create civic value. They need presence, cooperation, and verified participation.', 'hello-elementor-child' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'The reputation economy begins when people prove they are willing to show up for one another.', 'hello-elementor-child' ); ?>
				</p>
			</div>

			<div class="research-box">
				<h2><?php esc_html_e( 'What Researchers Can Study', 'hello-elementor-child' ); ?></h2>
				<ul>
					<li><?php esc_html_e( 'Can verified device participation measure civic trust?', 'hello-elementor-child' ); ?></li>
					<li><?php esc_html_e( 'Can two universal QR codes create a low-cost human interaction ledger?', 'hello-elementor-child' ); ?></li>
					<li><?php esc_html_e( 'Can peaceful participation become a measurable public policy variable?', 'hello-elementor-child' ); ?></li>
					<li><?php esc_html_e( 'Can registered and unregistered devices be funneled into ethical member services?', 'hello-elementor-child' ); ?></li>
					<li><?php esc_html_e( 'Can reputation be built without moving a single fiat penny?', 'hello-elementor-child' ); ?></li>
				</ul>
			</div>

			<div class="final-cta">
				<h2><?php esc_html_e( 'Start With One Scan', 'hello-elementor-child' ); ?></h2>
				<p>
					<?php esc_html_e( 'Register the device. Add QRtiger. Join Discord. Scan for peace. Let the reputation economy prove participation.', 'hello-elementor-child' ); ?>
				</p>
				<div class="cta-row">
					<a
						href="#"
						class="btn primary cpm-nwp-open-modal"
						data-cpm-modal="cpm-nwp-register-modal"
						aria-controls="cpm-nwp-register-modal"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Enter Registration', 'hello-elementor-child' ); ?></a>
					<button type="button" class="btn secondary" onclick="openD2030Modal()"><?php esc_html_e( 'Explore Research Portal', 'hello-elementor-child' ); ?></button>
				</div>
			</div>

		</div>
	</section>

	<?php get_template_part( 'templates-parts/part', 'd2030-research-modal' ); ?>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
