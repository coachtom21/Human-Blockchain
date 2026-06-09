<?php
/**
 * Template Name: Human Ledger
 *
 * Full-page Detente 2030 research portal (videos, podcasts, documents).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="human-ledger-page" tabindex="-1">
	<div class="human-ledger-wrap">
		<header class="human-ledger-hero">
			<p class="human-ledger-kicker"><?php esc_html_e( 'Detente 2030', 'hello-elementor-child' ); ?></p>
			<h1 class="human-ledger-title"><?php esc_html_e( 'Human Ledger', 'hello-elementor-child' ); ?></h1>
			<p class="human-ledger-subtitle"><?php esc_html_e( 'Can Peace Be Measured?', 'hello-elementor-child' ); ?></p>
			<p class="human-ledger-lead">
				<?php esc_html_e( 'A 15-minute classroom experiment testing whether human interaction can be verified as value. Explore the full research library — videos, podcasts, and classroom documents.', 'hello-elementor-child' ); ?>
			</p>
		</header>

		<div class="human-ledger-panel">
			<?php
			get_template_part(
				'templates-parts/part',
				'd2030-research-resources',
				array(
					'hb_d2030_layout' => 'page',
				)
			);
			?>
		</div>
	</div>
</main>

<?php
get_footer();
