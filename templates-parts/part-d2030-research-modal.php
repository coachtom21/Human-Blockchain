<?php
/**
 * Detente 2030 research modal (videos, podcasts, script PDF).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="d2030-modal" class="d2030-modal" role="dialog" aria-modal="true" aria-labelledby="d2030-modal-title" hidden>
	<div class="d2030-modal-content">
		<button type="button" class="d2030-close" onclick="closeD2030Modal()" aria-label="<?php echo esc_attr__( 'Close', 'hello-elementor-child' ); ?>">×</button>
		<p class="d2030-kicker"><?php esc_html_e( 'Detente 2030', 'hello-elementor-child' ); ?></p>
		<h2 id="d2030-modal-title"><?php esc_html_e( 'Can Peace Be Measured?', 'hello-elementor-child' ); ?></h2>
		<p>
			<?php esc_html_e( 'A 15-minute classroom experiment testing whether human interaction can be verified as value.', 'hello-elementor-child' ); ?>
		</p>
		<?php
		$hb_d2030_layout = 'modal';
		get_template_part( 'templates-parts/part', 'd2030-research-resources' );
		?>
	</div>
</div>
