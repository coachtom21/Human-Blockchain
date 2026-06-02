<?php
/**
 * Template Name: Curious
 *
 * Curious? — Human Blockchain Charter discovery landing.
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
$hb_curious_page_url = static function ( $slugs, $fallback ) {
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

$url_register_device = $hb_curious_page_url(
	array( 'register-device', 'device-registration' ),
	'/register-device/'
);

$hb_curious_video_1_url = apply_filters(
	'hb_curious_video_1_url',
	apply_filters(
		'hb_yam_is_on_hero_video_url',
		'http://humanblockchain.info/wp-content/uploads/2026/06/The_Poor_Man_s_Web3__Architecting_the_Human_Ledger.mp4'
	)
);
$hb_curious_video_2_url = apply_filters(
	'hb_curious_video_2_url',
	apply_filters(
		'hb_d2030_video_10_url',
		'http://humanblockchain.info/wp-content/uploads/2026/05/Architecting_the_Non-Custodial_Network__The_VFN_MSB_Dual-Layer_-1.mp4'
	)
);
$hb_curious_video_3_url = apply_filters(
	'hb_curious_video_3_url',
	apply_filters(
		'hb_hotspot_video_1_url',
		'http://humanblockchain.info/wp-content/uploads/2026/06/Architecting_the_Hotspot_Bot__State_Machines_and_Ledger_Isolati.mp4'
	)
);
$hb_curious_podcast_1_url = apply_filters(
	'hb_curious_podcast_1_url',
	apply_filters(
		'hb_d2030_video_2_url',
		'http://humanblockchain.info/wp-content/uploads/2026/05/Organized_Krill_Study-1.mp4'
	)
);
$hb_curious_podcast_2_url = apply_filters(
	'hb_curious_podcast_2_url',
	apply_filters(
		'hb_d2030_video_4_url',
		'http://humanblockchain.info/wp-content/uploads/2026/05/Join-the-Human-Blockchain-Experiment_-YA-2026-05-131.mp4'
	)
);

/**
 * Render inline video or audio for a media card.
 *
 * @param string $url   Media URL.
 * @param string $type  video|audio.
 * @param string $title Accessible title.
 * @return void
 */
$hb_curious_render_media = static function ( $url, $type, $title ) {
	$url = is_string( $url ) ? trim( $url ) : '';
	if ( $url === '' ) {
		return;
	}
	$tag = ( $type === 'audio' ) ? 'audio' : 'video';
	?>
	<div class="media-player">
		<<?php echo esc_html( $tag ); ?> controls preload="metadata" playsinline title="<?php echo esc_attr( $title ); ?>">
			<source src="<?php echo esc_url( $url ); ?>" type="<?php echo ( $type === 'audio' ) ? 'audio/mp4' : 'video/mp4'; ?>" />
			<?php esc_html_e( 'Your browser does not support this media element.', 'hello-elementor-child' ); ?>
		</<?php echo esc_html( $tag ); ?>>
	</div>
	<?php
};

$css_file = get_stylesheet_directory() . '/assets/css/curious-landing.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Curious?', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/curious-landing.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'curious-landing' ); ?>>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<div class="curious-landing">
		<div class="container">

			<div class="hero">
				<h1><?php esc_html_e( 'Curious?', 'hello-elementor-child' ); ?></h1>
				<p>
					<?php esc_html_e( 'Explore the Human Blockchain Charter, the VFN/MSB Ledger, the Pokemon Go Hotspot Bot, and the Detente 2030 Human Gold Experiment.', 'hello-elementor-child' ); ?>
				</p>
				<div class="hero-cta">
					<button
						type="button"
						class="btn research-portal"
						onclick="openD2030Modal()"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Explore Research Portal', 'hello-elementor-child' ); ?></button>
					<a
						href="<?php echo esc_url( $url_register_device ); ?>"
						class="btn primary cpm-nwp-open-modal"
						data-cpm-modal="cpm-nwp-register-modal"
						aria-controls="cpm-nwp-register-modal"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Register Device', 'hello-elementor-child' ); ?></a>
				</div>
			</div>

			<div class="content-box">
				<h2><?php esc_html_e( 'Quick Overview', 'hello-elementor-child' ); ?></h2>
				<div class="summary">
					<p>
						<?php esc_html_e( 'The Human Blockchain Charter proposes a second ledger. Traditional ledgers measure financial activities: payments, purchases, taxes, settlements, and compliance. The Human Participation Ledger measures: trust, stewardship, gratitude, mentorship, community building, and voluntary participation.', 'hello-elementor-child' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'The objective is not to replace money. The objective is to determine whether human cooperation can be measured and studied alongside financial activity.', 'hello-elementor-child' ); ?>
					</p>
				</div>
			</div>

			<h2 class="section-title"><?php esc_html_e( 'Featured Videos', 'hello-elementor-child' ); ?></h2>
			<div class="media-grid">
				<div class="media-card">
					<?php
					$hb_curious_render_media(
						$hb_curious_video_1_url,
						'video',
						__( 'Two Ledgers. One Purpose.', 'hello-elementor-child' )
					);
					if ( trim( (string) $hb_curious_video_1_url ) === '' ) :
						?>
						<div class="media-placeholder"><?php esc_html_e( 'VIDEO #1 Human Blockchain Charter Overview', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
					<h3><?php esc_html_e( 'Two Ledgers. One Purpose.', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Introduction to the Human Blockchain Charter and why participation deserves recognition.', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="media-card">
					<?php
					$hb_curious_render_media(
						$hb_curious_video_2_url,
						'video',
						__( 'Voluntary Fulfillment Networks', 'hello-elementor-child' )
					);
					if ( trim( (string) $hb_curious_video_2_url ) === '' ) :
						?>
						<div class="media-placeholder"><?php esc_html_e( 'VIDEO #2 VFN / MSB Ledger', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
					<h3><?php esc_html_e( 'Voluntary Fulfillment Networks', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Understanding how ordinary business activity continues while participation metrics are observed.', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="media-card">
					<?php
					$hb_curious_render_media(
						$hb_curious_video_3_url,
						'video',
						__( 'Presence Creates Data', 'hello-elementor-child' )
					);
					if ( trim( (string) $hb_curious_video_3_url ) === '' ) :
						?>
						<div class="media-placeholder"><?php esc_html_e( 'VIDEO #3 Pokemon Go Hotspot Bot', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
					<h3><?php esc_html_e( 'Presence Creates Data', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'How devices, consent, time and location become participation signals.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>

			<h2 class="section-title"><?php esc_html_e( 'Featured Podcasts', 'hello-elementor-child' ); ?></h2>
			<div class="media-grid">
				<div class="media-card">
					<?php
					$hb_curious_render_media(
						$hb_curious_podcast_1_url,
						'video',
						__( 'Leave Your Wallet At Home', 'hello-elementor-child' )
					);
					if ( trim( (string) $hb_curious_podcast_1_url ) === '' ) :
						?>
						<div class="media-placeholder"><?php esc_html_e( 'PODCAST #1', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
					<h3><?php esc_html_e( 'Leave Your Wallet At Home', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Group Hug Events, Krill Kit fulfillment, and cooperative participation.', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="media-card">
					<?php
					$hb_curious_render_media(
						$hb_curious_podcast_2_url,
						'video',
						__( 'Detente 2030 Mission', 'hello-elementor-child' )
					);
					if ( trim( (string) $hb_curious_podcast_2_url ) === '' ) :
						?>
						<div class="media-placeholder"><?php esc_html_e( 'PODCAST #2', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
					<h3><?php esc_html_e( 'Detente 2030 Mission', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Why May 17, 2030 serves as the conclusion of the Human Gold Experiment.', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="media-card">
					<button
						type="button"
						class="media-research-btn"
						onclick="openD2030Modal()"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Open Research Library', 'hello-elementor-child' ); ?></button>
					<h3><?php esc_html_e( 'Research Library', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Access whitepapers, presentations, and behavioral research documents.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>

			<h2 class="section-title"><?php esc_html_e( 'Human Blockchain Charter', 'hello-elementor-child' ); ?></h2>
			<div class="charter-grid">
				<div class="charter-card">
					<h3><?php esc_html_e( 'Financial Activities Ledger', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Measures:', 'hello-elementor-child' ); ?></p>
					<ul>
						<li><?php esc_html_e( 'Payments', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Purchases', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Revenue', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Assets', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Taxes', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Compliance', 'hello-elementor-child' ); ?></li>
					</ul>
				</div>
				<div class="charter-card">
					<h3><?php esc_html_e( 'Human Participation Ledger', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Measures:', 'hello-elementor-child' ); ?></p>
					<ul>
						<li><?php esc_html_e( 'Trust Earned', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Mentorship', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Stewardship', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Knowledge Shared', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Community Built', 'hello-elementor-child' ); ?></li>
						<li><?php esc_html_e( 'Gratitude Expressed', 'hello-elementor-child' ); ?></li>
					</ul>
				</div>
			</div>

			<div class="content-box">
				<h2><?php esc_html_e( 'About the VFN / MSB Framework', 'hello-elementor-child' ); ?></h2>
				<p>
					<?php esc_html_e( 'Voluntary Fulfillment Networks (VFN) provide a way to observe participation. Money Service Businesses (MSB) continue managing normal financial activity. The Human Blockchain experiment studies whether these two systems can coexist, creating transparency around both economic activity and human contribution.', 'hello-elementor-child' ); ?>
				</p>
				<p><?php esc_html_e( 'The research concludes on May 17, 2030.', 'hello-elementor-child' ); ?></p>
				<div class="center">
					<a
						href="<?php echo esc_url( $url_register_device ); ?>"
						class="btn primary cpm-nwp-open-modal"
						data-cpm-modal="cpm-nwp-register-modal"
						aria-controls="cpm-nwp-register-modal"
						aria-haspopup="dialog"
					><?php esc_html_e( 'Join The Experiment', 'hello-elementor-child' ); ?></a>
				</div>
			</div>

			<footer class="curious-footer">
				<?php esc_html_e( 'Human Blockchain Charter • Detente 2030 • Human Gold Experiment', 'hello-elementor-child' ); ?>
			</footer>

		</div>
	</div>

	<?php get_template_part( 'templates-parts/part', 'd2030-research-modal' ); ?>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
