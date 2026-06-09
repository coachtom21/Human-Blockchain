<?php
/**
 * Detente 2030 resource grid — videos, podcasts, PDFs.
 *
 * @package HelloElementorChild
 *
 * @var string $hb_d2030_layout Optional. modal|page. Default modal.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hb_get_d2030_research_resources' ) ) {
	require_once get_stylesheet_directory() . '/includes/hb-d2030-research-data.php';
}

$hb_d2030_layout = isset( $hb_d2030_layout ) && $hb_d2030_layout === 'page' ? 'page' : 'modal';
$hb_d2030_data   = hb_get_d2030_research_resources();
$hb_d2030_videos   = $hb_d2030_data['videos'];
$hb_d2030_podcasts = $hb_d2030_data['podcasts'];
$hb_d2030_pdfs     = $hb_d2030_data['pdfs'];

$hb_d2030_grid_class = 'page' === $hb_d2030_layout ? 'd2030-resource-grid d2030-resource-grid--page' : 'd2030-resource-grid';
?>
<div class="<?php echo esc_attr( $hb_d2030_grid_class ); ?>">
	<div class="d2030-resource-group">
		<p class="d2030-resource-group-title"><?php esc_html_e( 'Videos', 'hello-elementor-child' ); ?></p>
		<div class="d2030-preview-list">
			<?php if ( ! empty( $hb_d2030_videos ) ) : ?>
				<?php foreach ( $hb_d2030_videos as $hb_d2030_video ) : ?>
					<div class="d2030-preview-card">
						<p class="d2030-preview-title"><?php echo esc_html( $hb_d2030_video['title'] ); ?></p>
						<div class="d2030-media-lazy d2030-media-lazy--video" data-src="<?php echo esc_url( $hb_d2030_video['url'] ); ?>" data-kind="video">
							<button type="button" class="d2030-media-lazy__play" aria-label="<?php echo esc_attr( sprintf( __( 'Play %s', 'hello-elementor-child' ), $hb_d2030_video['title'] ) ); ?>">
								<span class="d2030-media-lazy__icon" aria-hidden="true">▶</span>
								<span class="d2030-media-lazy__label"><?php esc_html_e( 'Load video', 'hello-elementor-child' ); ?></span>
							</button>
							<video class="d2030-preview-video d2030-media-lazy__target" controls preload="none" playsinline title="<?php echo esc_attr( $hb_d2030_video['title'] ); ?>" hidden></video>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<span class="d2030-btn-disabled"><?php esc_html_e( 'Videos coming soon', 'hello-elementor-child' ); ?></span>
			<?php endif; ?>
		</div>
	</div>

	<div class="d2030-resource-group">
		<p class="d2030-resource-group-title"><?php esc_html_e( 'Podcasts', 'hello-elementor-child' ); ?></p>
		<div class="d2030-preview-list">
			<?php if ( ! empty( $hb_d2030_podcasts ) ) : ?>
				<?php foreach ( $hb_d2030_podcasts as $hb_d2030_podcast ) : ?>
					<div class="d2030-preview-card">
						<p class="d2030-preview-title"><?php echo esc_html( $hb_d2030_podcast['title'] ); ?></p>
						<div class="d2030-media-lazy d2030-media-lazy--audio" data-src="<?php echo esc_url( $hb_d2030_podcast['url'] ); ?>" data-kind="audio">
							<button type="button" class="d2030-media-lazy__play" aria-label="<?php echo esc_attr( sprintf( __( 'Play %s', 'hello-elementor-child' ), $hb_d2030_podcast['title'] ) ); ?>">
								<span class="d2030-media-lazy__icon" aria-hidden="true">♪</span>
								<span class="d2030-media-lazy__label"><?php esc_html_e( 'Load audio', 'hello-elementor-child' ); ?></span>
							</button>
							<audio class="d2030-preview-audio d2030-media-lazy__target" controls preload="none" title="<?php echo esc_attr( $hb_d2030_podcast['title'] ); ?>" hidden></audio>
						</div>
						<div class="d2030-preview-actions">
							<a href="<?php echo esc_url( $hb_d2030_podcast['url'] ); ?>" class="d2030-btn-secondary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( '♪ Open in new tab', 'hello-elementor-child' ); ?></a>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<span class="d2030-btn-disabled"><?php esc_html_e( 'Podcasts coming soon', 'hello-elementor-child' ); ?></span>
			<?php endif; ?>

			<?php if ( 'modal' === $hb_d2030_layout ) : ?>
				<div class="d2030-preview-card d2030-script-pdf-card">
					<p class="d2030-preview-title"><?php esc_html_e( 'Script PDF', 'hello-elementor-child' ); ?></p>
					<?php if ( ! empty( $hb_d2030_pdfs ) ) : ?>
						<div class="d2030-script-pdf-list">
							<?php foreach ( $hb_d2030_pdfs as $hb_d2030_pdf ) : ?>
								<div class="d2030-script-pdf-item">
									<p class="d2030-script-pdf-name"><?php echo esc_html( $hb_d2030_pdf['title'] ); ?></p>
									<div class="d2030-preview-actions">
										<a
											href="<?php echo esc_url( $hb_d2030_pdf['url'] ); ?>"
											class="d2030-btn-secondary"
											target="_blank"
											rel="noopener noreferrer"
											aria-label="<?php echo esc_attr( sprintf( __( 'Download %s', 'hello-elementor-child' ), $hb_d2030_pdf['title'] ) ); ?>"
										><?php esc_html_e( '⬇ Download PDF', 'hello-elementor-child' ); ?></a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php else : ?>
						<span class="d2030-btn-disabled"><?php esc_html_e( 'Script PDF coming soon', 'hello-elementor-child' ); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( 'page' === $hb_d2030_layout ) : ?>
		<div class="d2030-resource-group d2030-resource-group--pdfs">
			<p class="d2030-resource-group-title"><?php esc_html_e( 'Documents', 'hello-elementor-child' ); ?></p>
			<div class="d2030-preview-list">
				<?php if ( ! empty( $hb_d2030_pdfs ) ) : ?>
					<?php foreach ( $hb_d2030_pdfs as $hb_d2030_pdf ) : ?>
						<div class="d2030-preview-card d2030-script-pdf-card">
							<p class="d2030-preview-title"><?php echo esc_html( $hb_d2030_pdf['title'] ); ?></p>
							<div class="d2030-preview-actions">
								<a
									href="<?php echo esc_url( $hb_d2030_pdf['url'] ); ?>"
									class="d2030-btn-secondary"
									target="_blank"
									rel="noopener noreferrer"
									aria-label="<?php echo esc_attr( sprintf( __( 'Open %s', 'hello-elementor-child' ), $hb_d2030_pdf['title'] ) ); ?>"
								><?php esc_html_e( '⬇ View / Download PDF', 'hello-elementor-child' ); ?></a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<span class="d2030-btn-disabled"><?php esc_html_e( 'Documents coming soon', 'hello-elementor-child' ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
