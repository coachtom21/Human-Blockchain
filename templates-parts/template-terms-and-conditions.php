<?php
/**
 * Template Name: Terms and Conditions
 *
 * Assign this template to your Terms page (slug: terms-and-conditions).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$hb_legal = hb_legal_template_vars();
?>
<main id="content" class="hb-legal-page site-main" role="main">
	<div class="hb-legal-page__inner">
		<?php get_template_part( 'templates-parts/part', 'hb-terms-and-conditions-content' ); ?>
	</div>
</main>
<?php
get_footer();
