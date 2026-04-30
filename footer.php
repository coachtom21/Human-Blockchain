<?php
/**
 * Footer template — NWP bar when Theme Builder footer is not used; closes document.
 *
 * @package HelloElementorChild
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	if ( hello_elementor_display_header_footer() ) {
		get_template_part( 'templates-parts/part', 'nwp-site-footer' );
	}
}
?>

<?php wp_footer(); ?>

</body>
</html>
