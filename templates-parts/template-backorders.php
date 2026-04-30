<?php
/**
 * Template Name: Backorders
 *
 * Empty canvas — add blocks or markup via the editor or by editing this template.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Backorders', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'hb-page-backorders' ); ?>>
<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>
<?php
while ( have_posts() ) :
	the_post();
	// Add page body via editor or template (e.g. the_content(), shortcodes).
endwhile;
?>
<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
