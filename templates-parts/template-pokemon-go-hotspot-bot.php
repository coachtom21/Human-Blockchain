<?php
/**
 * Template Name: Pokemon Go Hotspot Bot
 *
 * Proof-of-presence portal — daily loop, XP progression, media placeholders.
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
$hb_hotspot_page_url = static function ( $slugs, $fallback ) {
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

$url_register_device = $hb_hotspot_page_url(
	array( 'register-device', 'device-registration' ),
	'/register-device/'
);

$hb_hotspot_video_1_url = apply_filters(
	'hb_hotspot_video_1_url',
	'http://humanblockchain.info/wp-content/uploads/2026/06/Architecting_the_Hotspot_Bot__State_Machines_and_Ledger_Isolati.mp4'
);

$hb_hotspot_video_2_url = apply_filters(
	'hb_hotspot_video_2_url',
	'http://humanblockchain.info/wp-content/uploads/2026/06/Practice-FAITH_-The-Human-Gold-Standard1.mp4'
);

$hb_hotspot_podcast_1_url = apply_filters(
	'hb_hotspot_podcast_1_url',
	'http://humanblockchain.info/wp-content/uploads/2026/06/How_the_Pokemon_Go_Schema_Governs_Society.mp4'
);

$css_file = get_stylesheet_directory() . '/assets/css/pokemon-go-hotspot-bot.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Pokémon Go Hotspot Bot', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/pokemon-go-hotspot-bot.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'pokemon-go-hotspot-bot' ); ?>>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<section class="hcb-hotspot-bot" aria-labelledby="hcb-hotspot-title">
		<div class="hcb-card">
			<p class="hcb-kicker"><?php esc_html_e( 'HumanBlockchain.info Engaged', 'hello-elementor-child' ); ?></p>

			<h2 id="hcb-hotspot-title"><?php esc_html_e( 'Pokémon Go Hotspot Bot', 'hello-elementor-child' ); ?></h2>

			<p>
				<?php esc_html_e( 'A proof-of-presence portal inspired by daily activity loops, XP thresholds, streak rewards, and reputation leaderboards. Register your device, accept the Gracebook Discord invitation, and begin building your Human Presence Index through FAITH, gratitude, and participation.', 'hello-elementor-child' ); ?>
			</p>

			<div class="hcb-rebalance-banner">
				<strong><?php esc_html_e( 'XP Rebalance Active:', 'hello-elementor-child' ); ?></strong>
				<?php esc_html_e( 'pending XP matures after 8–12 weeks, rolls over on August 11, and supports annual PMG and Captain role assignment through HPI and Kalshi Mirror reputation.', 'hello-elementor-child' ); ?>
			</div>

			<div class="hcb-status-grid">
				<span>
					<?php esc_html_e( 'Device Registration:', 'hello-elementor-child' ); ?>
					<strong><?php esc_html_e( 'Required', 'hello-elementor-child' ); ?></strong>
				</span>
				<span>
					<?php esc_html_e( 'Discord Acceptance:', 'hello-elementor-child' ); ?>
					<strong><?php esc_html_e( 'Required', 'hello-elementor-child' ); ?></strong>
				</span>
				<span>
					<?php esc_html_e( 'Peace Pentagon Branch:', 'hello-elementor-child' ); ?>
					<strong><?php esc_html_e( 'Pending', 'hello-elementor-child' ); ?></strong>
				</span>
				<span>
					<?php esc_html_e( '5-Seller POC:', 'hello-elementor-child' ); ?>
					<strong><?php esc_html_e( 'Pending', 'hello-elementor-child' ); ?></strong>
				</span>
			</div>

			<a
				class="hcb-button cpm-nwp-open-modal"
				href="<?php echo esc_url( $url_register_device ); ?>"
				data-cpm-modal="cpm-nwp-register-modal"
				aria-controls="cpm-nwp-register-modal"
				aria-haspopup="dialog"
			><?php esc_html_e( 'Activate Hotspot Bot', 'hello-elementor-child' ); ?></a>

			<div class="hcb-level-section">
				<h3><?php esc_html_e( 'Daily Human Gold Loop', 'hello-elementor-child' ); ?></h3>

				<div class="hcb-loop-grid">
					<div>
						<span><?php esc_html_e( 'Daily Show-Up', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Check in once per day through device presence or QR interaction.', 'hello-elementor-child' ); ?></p>
					</div>
					<div>
						<span><?php esc_html_e( 'NWP Gratitude', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Accept or issue a New World Penny as a non-money thank-you.', 'hello-elementor-child' ); ?></p>
					</div>
					<div>
						<span><?php esc_html_e( 'Backorder Signal', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Record pledge demand without moving fiat or crypto value.', 'hello-elementor-child' ); ?></p>
					</div>
					<div>
						<span><?php esc_html_e( 'Fulfillment Proof', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Confirm delivery activity through registered devices.', 'hello-elementor-child' ); ?></p>
					</div>
					<div>
						<span><?php esc_html_e( 'Kalshi Mirror', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Reputation improves when participation claims resolve as true.', 'hello-elementor-child' ); ?></p>
					</div>
					<div>
						<span><?php esc_html_e( 'August 11 Snapshot', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Annual standings freeze for PMG and Captain eligibility.', 'hello-elementor-child' ); ?></p>
					</div>
				</div>
			</div>

			<div class="hcb-xp-path">
				<h3><?php esc_html_e( 'Human Gold XP Progression', 'hello-elementor-child' ); ?></h3>

				<div class="hcb-xp-row">
					<span><?php esc_html_e( 'Level 10', 'hello-elementor-child' ); ?></span>
					<strong><?php esc_html_e( 'Show-Up Streak', 'hello-elementor-child' ); ?></strong>
					<em><?php esc_html_e( 'Basic presence and Discord acceptance', 'hello-elementor-child' ); ?></em>
				</div>
				<div class="hcb-xp-row">
					<span><?php esc_html_e( 'Level 20', 'hello-elementor-child' ); ?></span>
					<strong><?php esc_html_e( 'NWP Participant', 'hello-elementor-child' ); ?></strong>
					<em><?php esc_html_e( 'Gratitude issued or accepted', 'hello-elementor-child' ); ?></em>
				</div>
				<div class="hcb-xp-row">
					<span><?php esc_html_e( 'Level 30', 'hello-elementor-child' ); ?></span>
					<strong><?php esc_html_e( 'Backorder Builder', 'hello-elementor-child' ); ?></strong>
					<em><?php esc_html_e( 'Pledge demand recorded as pending observation', 'hello-elementor-child' ); ?></em>
				</div>
				<div class="hcb-xp-row">
					<span><?php esc_html_e( 'Level 40', 'hello-elementor-child' ); ?></span>
					<strong><?php esc_html_e( 'Fulfillment Verifier', 'hello-elementor-child' ); ?></strong>
					<em><?php esc_html_e( 'Proof-of-delivery activity matures after 8–12 weeks', 'hello-elementor-child' ); ?></em>
				</div>
				<div class="hcb-xp-row">
					<span><?php esc_html_e( 'Level 50', 'hello-elementor-child' ); ?></span>
					<strong><?php esc_html_e( 'POC Contributor', 'hello-elementor-child' ); ?></strong>
					<em><?php esc_html_e( 'Individual and 5-seller group HPI standing improves', 'hello-elementor-child' ); ?></em>
				</div>
				<div class="hcb-xp-row">
					<span><?php esc_html_e( 'Level 80', 'hello-elementor-child' ); ?></span>
					<strong><?php esc_html_e( 'Human Gold Standard', 'hello-elementor-child' ); ?></strong>
					<em><?php esc_html_e( 'Eligible for annual role consideration through snapshot ranking', 'hello-elementor-child' ); ?></em>
				</div>
			</div>

			<div class="hcb-media">
				<h3><?php esc_html_e( 'Explore the Human Gold Standard', 'hello-elementor-child' ); ?></h3>

				<div class="hcb-highlight-grid">
					<div class="hcb-highlight-card">
						<span><?php esc_html_e( 'Video 1', 'hello-elementor-child' ); ?></span>
						<h4><?php esc_html_e( 'What Is the Hotspot Bot?', 'hello-elementor-child' ); ?></h4>
						<p>
							<?php esc_html_e( 'A smartphone proof-of-presence system that turns daily participation into pending XP, HPI standing, and surplus gratitude.', 'hello-elementor-child' ); ?>
						</p>
						<a href="#video-1"><?php esc_html_e( 'Watch Video →', 'hello-elementor-child' ); ?></a>
					</div>
					<div class="hcb-highlight-card">
						<span><?php esc_html_e( 'Video 2', 'hello-elementor-child' ); ?></span>
						<h4><?php esc_html_e( 'Practice FAITH & Ease Tensions', 'hello-elementor-child' ); ?></h4>
						<p>
							<?php esc_html_e( 'Learn how Fair, Accepting, Insightful, Transparent, and Humble behavior supports Detente 2030 and Group Hug Events.', 'hello-elementor-child' ); ?>
						</p>
						<a href="#video-2"><?php esc_html_e( 'Watch Video →', 'hello-elementor-child' ); ?></a>
					</div>
					<div class="hcb-highlight-card">
						<span><?php esc_html_e( 'Podcast', 'hello-elementor-child' ); ?></span>
						<h4><?php esc_html_e( 'Human Presence as Gold', 'hello-elementor-child' ); ?></h4>
						<p>
							<?php esc_html_e( 'Explore how gratitude, reputation, and human presence become visible through the Human Presence Index.', 'hello-elementor-child' ); ?>
						</p>
						<a href="#podcast-1"><?php esc_html_e( 'Listen Now →', 'hello-elementor-child' ); ?></a>
					</div>
				</div>

				<div id="video-1" class="hcb-media-panel">
					<h4><?php esc_html_e( 'Video 1: What Is the Hotspot Bot?', 'hello-elementor-child' ); ?></h4>
					<?php if ( ! empty( $hb_hotspot_video_1_url ) ) : ?>
						<div class="hcb-media-player">
							<video class="hcb-media-video" controls preload="metadata" playsinline title="<?php echo esc_attr__( 'Video 1: What Is the Hotspot Bot?', 'hello-elementor-child' ); ?>">
								<source src="<?php echo esc_url( $hb_hotspot_video_1_url ); ?>" type="video/mp4" />
								<?php esc_html_e( 'Your browser does not support the video element.', 'hello-elementor-child' ); ?>
							</video>
						</div>
					<?php else : ?>
						<div class="hcb-placeholder"><?php esc_html_e( 'Embed Video 1 Here', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
				</div>

				<div id="video-2" class="hcb-media-panel">
					<h4><?php esc_html_e( 'Video 2: Practice FAITH & Ease Tensions', 'hello-elementor-child' ); ?></h4>
					<?php if ( ! empty( $hb_hotspot_video_2_url ) ) : ?>
						<div class="hcb-media-player">
							<video class="hcb-media-video" controls preload="metadata" playsinline title="<?php echo esc_attr__( 'Video 2: Practice FAITH & Ease Tensions', 'hello-elementor-child' ); ?>">
								<source src="<?php echo esc_url( $hb_hotspot_video_2_url ); ?>" type="video/mp4" />
								<?php esc_html_e( 'Your browser does not support the video element.', 'hello-elementor-child' ); ?>
							</video>
						</div>
					<?php else : ?>
						<div class="hcb-placeholder"><?php esc_html_e( 'Embed Video 2 Here', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
				</div>

				<div id="podcast-1" class="hcb-media-panel">
					<h4><?php esc_html_e( 'Podcast: Human Presence as Gold', 'hello-elementor-child' ); ?></h4>
					<?php if ( ! empty( $hb_hotspot_podcast_1_url ) ) : ?>
						<div class="hcb-media-player hcb-media-player--podcast">
							<audio class="hcb-media-audio" controls preload="metadata" playsinline title="<?php echo esc_attr__( 'Podcast: Human Presence as Gold', 'hello-elementor-child' ); ?>">
								<source src="<?php echo esc_url( $hb_hotspot_podcast_1_url ); ?>" type="audio/mp4" />
								<?php esc_html_e( 'Your browser does not support the audio element.', 'hello-elementor-child' ); ?>
							</audio>
						</div>
					<?php else : ?>
						<div class="hcb-placeholder"><?php esc_html_e( 'Embed Podcast Player Here', 'hello-elementor-child' ); ?></div>
					<?php endif; ?>
				</div>
			</div>

			<p class="hcb-note">
				<?php esc_html_e( 'XP is a behavioral research measure only. No fiat, crypto, USDT, or securities value moves inside the append-only study ledger. Pokémon Go is referenced only as a familiar progression-design analogy.', 'hello-elementor-child' ); ?>
			</p>
		</div>
	</section>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
