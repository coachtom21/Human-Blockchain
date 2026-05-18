<?php
/**
 * Detente 2030 research modal (videos, podcasts, script PDF).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$d2030_video_1_url = apply_filters(
	'hb_d2030_video_1_url',
	'http://humanblockchain.info/wp-content/uploads/2026/05/Hello_Device_Experiment.mp4'
);
$d2030_video_2_url = apply_filters(
	'hb_d2030_video_2_url',
	'http://humanblockchain.info/wp-content/uploads/2026/05/Organized_Krill_Study-1.mp4'
);
$d2030_video_3_url = apply_filters(
	'hb_d2030_video_3_url',
	'http://humanblockchain.info/wp-content/uploads/2026/05/Gracebook__Presence_Economics__Architecting_Trust_Without_Capi.mp4'
);
$d2030_podcast_1_url = apply_filters(
	'hb_d2030_podcast_1_url',
	'http://humanblockchain.info/wp-content/uploads/2026/05/Human_participation_as_a_measurable_economic_signal.mp4'
);
$d2030_podcast_2_url = apply_filters(
	'hb_d2030_podcast_2_url',
	'http://humanblockchain.info/wp-content/uploads/2026/05/How_symbolic_pledges_build_accountability-1.mp4'
);
$d2030_podcast_3_url = apply_filters(
	'hb_d2030_podcast_3_url',
	'http://humanblockchain.info/wp-content/uploads/2026/05/The_Gracebook_human_blockchain_experiment.mp4'
);
$d2030_script_pdf_url = apply_filters(
	'hb_d2030_script_pdf_url',
	'https://drive.google.com/file/d/1xxjF_mjRmFQvvfidVEC9m5SllTAw-Ca3/view?usp=sharing'
);

$hb_d2030_label_from_url = static function ( $url, $fallback = '' ) {
	if ( empty( $url ) ) {
		return $fallback;
	}
	$path = wp_parse_url( $url, PHP_URL_PATH );
	if ( empty( $path ) ) {
		return $fallback;
	}
	$file = basename( $path );
	$file = preg_replace( '/\.[^.]+$/', '', $file );
	$file = preg_replace( '/[-_]+/', ' ', $file );
	$file = trim( preg_replace( '/\s+/', ' ', (string) $file ) );
	return $file !== '' ? $file : $fallback;
};

$d2030_video_1_title   = $hb_d2030_label_from_url( $d2030_video_1_url, 'Video 1' );
$d2030_video_2_title   = $hb_d2030_label_from_url( $d2030_video_2_url, 'Video 2' );
$d2030_video_3_title   = apply_filters(
	'hb_d2030_video_3_title',
	__( 'Gracebook: Presence Economics — Architecting Trust Without Capital', 'hello-elementor-child' )
);
$d2030_podcast_1_title = $hb_d2030_label_from_url( $d2030_podcast_1_url, 'Podcast 1' );
$d2030_podcast_2_title = $hb_d2030_label_from_url( $d2030_podcast_2_url, 'Podcast 2' );
$d2030_podcast_3_title = apply_filters(
	'hb_d2030_podcast_3_title',
	$hb_d2030_label_from_url(
		$d2030_podcast_3_url,
		__( 'The Gracebook Human Blockchain Experiment', 'hello-elementor-child' )
	)
);
?>
<div id="d2030-modal" class="d2030-modal" role="dialog" aria-modal="true" aria-labelledby="d2030-modal-title" hidden>
	<div class="d2030-modal-content">
		<button type="button" class="d2030-close" onclick="closeD2030Modal()" aria-label="<?php echo esc_attr__( 'Close', 'hello-elementor-child' ); ?>">×</button>
		<p class="d2030-kicker"><?php esc_html_e( 'Detente 2030', 'hello-elementor-child' ); ?></p>
		<h2 id="d2030-modal-title"><?php esc_html_e( 'Can Peace Be Measured?', 'hello-elementor-child' ); ?></h2>
		<p>
			<?php esc_html_e( 'A 15-minute classroom experiment testing whether human interaction can be verified as value.', 'hello-elementor-child' ); ?>
		</p>
		<div class="d2030-resource-grid">
			<div class="d2030-resource-group">
				<p class="d2030-resource-group-title"><?php esc_html_e( 'Videos', 'hello-elementor-child' ); ?></p>
				<div class="d2030-preview-list">
					<?php if ( ! empty( $d2030_video_1_url ) ) : ?>
						<div class="d2030-preview-card">
							<p class="d2030-preview-title"><?php echo esc_html( $d2030_video_1_title ); ?></p>
							<video class="d2030-preview-video" controls preload="metadata" playsinline>
								<source src="<?php echo esc_url( $d2030_video_1_url ); ?>" type="video/mp4" />
							</video>
						</div>
					<?php else : ?>
						<span class="d2030-btn-disabled"><?php esc_html_e( 'Video 1 coming soon', 'hello-elementor-child' ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $d2030_video_2_url ) ) : ?>
						<div class="d2030-preview-card">
							<p class="d2030-preview-title"><?php echo esc_html( $d2030_video_2_title ); ?></p>
							<video class="d2030-preview-video" controls preload="metadata" playsinline>
								<source src="<?php echo esc_url( $d2030_video_2_url ); ?>" type="video/mp4" />
							</video>
						</div>
					<?php else : ?>
						<span class="d2030-btn-disabled"><?php esc_html_e( 'Video 2 coming soon', 'hello-elementor-child' ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $d2030_video_3_url ) ) : ?>
						<div class="d2030-preview-card">
							<p class="d2030-preview-title"><?php echo esc_html( $d2030_video_3_title ); ?></p>
							<video class="d2030-preview-video" controls preload="metadata" playsinline>
								<source src="<?php echo esc_url( $d2030_video_3_url ); ?>" type="video/mp4" />
							</video>
						</div>
					<?php else : ?>
						<span class="d2030-btn-disabled"><?php esc_html_e( 'Video 3 coming soon', 'hello-elementor-child' ); ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="d2030-resource-group">
				<p class="d2030-resource-group-title"><?php esc_html_e( 'Podcasts', 'hello-elementor-child' ); ?></p>
				<div class="d2030-preview-list">
					<?php if ( ! empty( $d2030_podcast_1_url ) ) : ?>
						<div class="d2030-preview-card">
							<p class="d2030-preview-title"><?php echo esc_html( $d2030_podcast_1_title ); ?></p>
							<audio class="d2030-preview-audio" controls preload="metadata">
								<source src="<?php echo esc_url( $d2030_podcast_1_url ); ?>" type="audio/mp4" />
							</audio>
							<div class="d2030-preview-actions">
								<a href="<?php echo esc_url( $d2030_podcast_1_url ); ?>" class="d2030-btn-secondary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( '♪ Listen', 'hello-elementor-child' ); ?></a>
							</div>
						</div>
					<?php else : ?>
						<span class="d2030-btn-disabled"><?php esc_html_e( 'Podcast 1 coming soon', 'hello-elementor-child' ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $d2030_podcast_2_url ) ) : ?>
						<div class="d2030-preview-card">
							<p class="d2030-preview-title"><?php echo esc_html( $d2030_podcast_2_title ); ?></p>
							<audio class="d2030-preview-audio" controls preload="metadata">
								<source src="<?php echo esc_url( $d2030_podcast_2_url ); ?>" type="audio/mp4" />
							</audio>
							<div class="d2030-preview-actions">
								<a href="<?php echo esc_url( $d2030_podcast_2_url ); ?>" class="d2030-btn-secondary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( '♪ Listen', 'hello-elementor-child' ); ?></a>
							</div>
						</div>
					<?php else : ?>
						<span class="d2030-btn-disabled"><?php esc_html_e( 'Podcast 2 coming soon', 'hello-elementor-child' ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $d2030_podcast_3_url ) ) : ?>
						<div class="d2030-preview-card">
							<p class="d2030-preview-title"><?php echo esc_html( $d2030_podcast_3_title ); ?></p>
							<audio class="d2030-preview-audio" controls preload="metadata">
								<source src="<?php echo esc_url( $d2030_podcast_3_url ); ?>" type="audio/mp4" />
							</audio>
							<div class="d2030-preview-actions">
								<a href="<?php echo esc_url( $d2030_podcast_3_url ); ?>" class="d2030-btn-secondary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( '♪ Listen', 'hello-elementor-child' ); ?></a>
							</div>
						</div>
					<?php else : ?>
						<span class="d2030-btn-disabled"><?php esc_html_e( 'Podcast 3 coming soon', 'hello-elementor-child' ); ?></span>
					<?php endif; ?>
					<div class="d2030-preview-card">
						<p class="d2030-preview-title"><?php esc_html_e( 'Script PDF', 'hello-elementor-child' ); ?></p>
						<div class="d2030-preview-actions">
							<?php if ( ! empty( $d2030_script_pdf_url ) ) : ?>
								<a href="<?php echo esc_url( $d2030_script_pdf_url ); ?>" class="d2030-btn-secondary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( '⬇ Download Script PDF', 'hello-elementor-child' ); ?></a>
							<?php else : ?>
								<span class="d2030-btn-disabled"><?php esc_html_e( 'Script PDF coming soon', 'hello-elementor-child' ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
