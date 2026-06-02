<?php
/**
 * Template Name: YAM is On Landing
 *
 * Detente 2030 — YAM-is-On universal QR landing (Human Gold Experiment).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve a page URL by slug with a path fallback.
 *
 * @param string|string[] $slugs    Page slug(s).
 * @param string          $fallback Path fallback for home_url().
 * @return string
 */
$hb_yam_page_url = static function ( $slugs, $fallback ) {
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

$url_register_device = $hb_yam_page_url(
	array( 'register-device', 'device-registration' ),
	'/register-device/'
);

$url_member_services = function_exists( 'hb_get_nwp_landing_permalink' )
	? hb_get_nwp_landing_permalink()
	: $hb_yam_page_url( array( 'nwp-landing', 'nwp' ), '/' );

$url_observe_free = $hb_yam_page_url(
	array( 'xp-etf-detente-2030', 'etf', 'present-presence' ),
	'/xp-etf-detente-2030/'
);

$url_megavoter_pledge = $hb_yam_page_url(
	array( 'megavoter-pledge', 'membership', 'nwp-landing' ),
	'/nwp-landing/'
);

$url_charter = $hb_yam_page_url(
	array( 'human-blockchain-charter', 'serendipity-protocol', 'explore-research-landing' ),
	'/explore-research-landing/'
);

$url_discord = apply_filters(
	'cpm_nwp_discord_invite_url',
	get_option( 'cpm_nwp_discord_invite_url', 'https://discord.com/invite/g5jreAPbra' )
);

$hb_yam_hero_video_url = apply_filters(
	'hb_yam_is_on_hero_video_url',
	'http://humanblockchain.info/wp-content/uploads/2026/06/The_Poor_Man_s_Web3__Architecting_the_Human_Ledger.mp4'
);
$hb_yam_hero_video_url = is_string( $hb_yam_hero_video_url ) ? trim( $hb_yam_hero_video_url ) : '';

$hb_yam_postcard_url = apply_filters( 'hb_yam_is_on_postcard_image_url', '' );
$hb_yam_postcard_url = is_string( $hb_yam_postcard_url ) ? trim( $hb_yam_postcard_url ) : '';

$css_file = get_stylesheet_directory() . '/assets/css/yam-is-on-landing.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Detente 2030 | Human Blockchain', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/yam-is-on-landing.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'yam-is-on-landing' ); ?>>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<div class="yam-is-on">

		<section class="hero">
			<div class="wrap">
				<p class="eyebrow"><?php esc_html_e( 'Detente 2030 • Human Gold Experiment', 'hello-elementor-child' ); ?></p>
				<h1><?php esc_html_e( 'Two Ledgers. One Purpose.', 'hello-elementor-child' ); ?></h1>
				<p class="lead">
					<?php esc_html_e( 'What if humanity measured participation as carefully as it measures money? The Human Blockchain Charter introduces a second ledger for trust, stewardship, gratitude, and cooperation.', 'hello-elementor-child' ); ?>
				</p>

				<div class="postcard-frame">
					<?php if ( $hb_yam_hero_video_url !== '' ) : ?>
						<video
							class="yam-hero-video"
							controls
							preload="metadata"
							playsinline
							title="<?php esc_attr_e( 'The Poor Man\'s Web3: Architecting the Human Ledger', 'hello-elementor-child' ); ?>"
						>
							<source src="<?php echo esc_url( $hb_yam_hero_video_url ); ?>" type="video/mp4" />
							<?php esc_html_e( 'Your browser does not support the video tag.', 'hello-elementor-child' ); ?>
						</video>
					<?php elseif ( $hb_yam_postcard_url !== '' ) : ?>
						<img
							src="<?php echo esc_url( $hb_yam_postcard_url ); ?>"
							alt="<?php esc_attr_e( 'Detente 2030 Human Blockchain Postcard', 'hello-elementor-child' ); ?>"
							width="1200"
							height="800"
							loading="lazy"
							decoding="async"
						/>
					<?php else : ?>
						<div class="postcard-placeholder" role="img" aria-label="<?php esc_attr_e( 'Detente 2030 Human Blockchain Postcard', 'hello-elementor-child' ); ?>">
							<?php esc_html_e( 'Hero media not configured.', 'hello-elementor-child' ); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="cta-row">
					<a
						href="<?php echo esc_url( $url_register_device ); ?>"
						class="btn btn-primary cpm-nwp-open-modal"
						data-cpm-modal="cpm-nwp-register-modal"
						aria-controls="cpm-nwp-register-modal"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Register Device', 'hello-elementor-child' ); ?></a>
					<button
						type="button"
						class="btn btn-research-portal"
						onclick="openD2030Modal()"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Explore Research Portal', 'hello-elementor-child' ); ?></button>
					<a href="<?php echo esc_url( $url_member_services ); ?>" class="btn btn-secondary"><?php esc_html_e( 'Member Services', 'hello-elementor-child' ); ?></a>
					<a href="<?php echo esc_url( $url_observe_free ); ?>" class="btn btn-outline"><?php esc_html_e( 'Observe Free', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
		</section>

		<section>
			<div class="wrap paper">
				<h2><?php esc_html_e( 'The Human Blockchain Charter', 'hello-elementor-child' ); ?></h2>
				<p>
					<?php esc_html_e( 'The financial ledger measures payments, deposits, purchases, revenue, assets, taxes, settlements, and compliance.', 'hello-elementor-child' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'The Human Participation Ledger measures time given, acts of kindness, mentorship, stewardship, trust earned, knowledge shared, community built, and legacy created.', 'hello-elementor-child' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'Detente 2030 asks whether these two ledgers can coexist: one for money, one for mankind.', 'hello-elementor-child' ); ?>
				</p>
			</div>
		</section>

		<section>
			<div class="wrap">
				<h2><?php esc_html_e( 'Scan the YAM-is-On QR Code', 'hello-elementor-child' ); ?></h2>
				<div class="grid">
					<div class="card">
						<h3><?php esc_html_e( 'Registered Device', 'hello-elementor-child' ); ?></h3>
						<p>
							<?php esc_html_e( 'A recognized device redirects to Member Services and delivers the participant to the selected Discord Gracebook section.', 'hello-elementor-child' ); ?>
						</p>
					</div>
					<div class="card">
						<h3><?php esc_html_e( 'Unregistered Device', 'hello-elementor-child' ); ?></h3>
						<p>
							<?php esc_html_e( 'A new device redirects to XP ETF for the Detente 2030 mission, then into the Human Blockchain community framework.', 'hello-elementor-child' ); ?>
						</p>
					</div>
					<div class="card">
						<h3><?php esc_html_e( 'Discord Gracebook', 'hello-elementor-child' ); ?></h3>
						<p>
							<?php esc_html_e( 'The community becomes the operating room for observers, YAM’ers, MEGAvoters, stewards, and Group Hug organizers.', 'hello-elementor-child' ); ?>
						</p>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="wrap split">
				<div class="card">
					<h2><?php esc_html_e( 'Local Side Hustle', 'hello-elementor-child' ); ?></h2>
					<p>
						<?php esc_html_e( 'The side hustle is delivering Organized Krill Kit fulfillment through local Group Hug events.', 'hello-elementor-child' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'These are “leave your wallet at home” moments where cooperative benefits are placed on display and participation becomes visible.', 'hello-elementor-child' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'Every fulfilled Krill Kit creates another opportunity for community, conversation, and cooperation.', 'hello-elementor-child' ); ?>
					</p>
				</div>
				<div class="card">
					<h2><?php esc_html_e( 'Annual Community Celebrations', 'hello-elementor-child' ); ?></h2>
					<p>
						<?php esc_html_e( 'Once each year communities bring the Human Blockchain to life through Kite Festivals, Sandcastle Building Days, and local Group Hug events.', 'hello-elementor-child' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'These gatherings celebrate stewardship, trust, participation, and friendship.', 'hello-elementor-child' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'One postcard. One scan. One Krill Kit. One community built through participation.', 'hello-elementor-child' ); ?>
					</p>
				</div>
			</div>
		</section>

		<section>
			<div class="wrap">
				<h2><?php esc_html_e( 'Membership Path', 'hello-elementor-child' ); ?></h2>
				<div class="grid">
					<div class="card">
						<h3><?php esc_html_e( 'YAM’er', 'hello-elementor-child' ); ?></h3>
						<div class="price"><?php esc_html_e( 'Free', 'hello-elementor-child' ); ?></div>
						<p>
							<?php esc_html_e( 'Become an observer, register your device, and learn the Detente 2030 Human Gold Experiment.', 'hello-elementor-child' ); ?>
						</p>
						<a href="<?php echo esc_url( $url_observe_free ); ?>" class="btn btn-secondary"><?php esc_html_e( 'Observe Free', 'hello-elementor-child' ); ?></a>
					</div>
					<div class="card">
						<h3><?php esc_html_e( 'MEGAvoter', 'hello-elementor-child' ); ?></h3>
						<div class="price"><?php esc_html_e( '$12/yr', 'hello-elementor-child' ); ?></div>
						<p>
							<?php esc_html_e( 'Receive the right to publish postcards, support Group Hug events, and help organize Krill Kit fulfillment.', 'hello-elementor-child' ); ?>
						</p>
						<a href="<?php echo esc_url( $url_megavoter_pledge ); ?>" class="btn btn-primary"><?php esc_html_e( 'Make $12 Pledge', 'hello-elementor-child' ); ?></a>
					</div>
					<div class="card">
						<h3><?php esc_html_e( 'Patron Steward', 'hello-elementor-child' ); ?></h3>
						<div class="price"><?php esc_html_e( 'Earned', 'hello-elementor-child' ); ?></div>
						<p>
							<?php esc_html_e( 'Patron membership is earned through participation. Stewards wear Patron MEGA hats proudly.', 'hello-elementor-child' ); ?>
						</p>
						<a href="<?php echo esc_url( $url_charter ); ?>" class="btn btn-outline"><?php esc_html_e( 'Read Charter', 'hello-elementor-child' ); ?></a>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="wrap hero">
				<h2><?php esc_html_e( 'The Human Gold Experiment Starts Now', 'hello-elementor-child' ); ?></h2>
				<p class="lead">
					<?php esc_html_e( 'Humanity has spent centuries measuring money. Detente 2030 explores whether humanity can also measure trust, participation, stewardship, gratitude, and cooperation.', 'hello-elementor-child' ); ?>
				</p>
				<p class="lead">
					<?php esc_html_e( 'The research concludes on May 17, 2030. Leave your wallet at home. Bring your presence.', 'hello-elementor-child' ); ?>
				</p>
				<div class="cta-row">
					<a
						href="<?php echo esc_url( $url_register_device ); ?>"
						class="btn btn-primary cpm-nwp-open-modal"
						data-cpm-modal="cpm-nwp-register-modal"
						aria-controls="cpm-nwp-register-modal"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Scan YAM-is-On', 'hello-elementor-child' ); ?></a>
					<button
						type="button"
						class="btn btn-research-portal"
						onclick="openD2030Modal()"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Explore Research Portal', 'hello-elementor-child' ); ?></button>
					<a href="<?php echo esc_url( $url_discord ); ?>" class="btn btn-secondary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Enter Discord Gracebook', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
		</section>

		<footer class="yam-footer">
			<div class="wrap">
				<p><?php esc_html_e( 'Human Blockchain Charter • Detente 2030 • Human Gold Experiment • Humanity • Prosperity • Peace', 'hello-elementor-child' ); ?></p>
			</div>
		</footer>

	</div>

	<?php get_template_part( 'templates-parts/part', 'd2030-research-modal' ); ?>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
