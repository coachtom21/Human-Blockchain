<?php
/**
 * Template Name: Privacy Policy
 *
 * Assign this template to your Privacy Policy page (slug: privacy-policy).
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
		<?php get_template_part( 'templates-parts/part', 'hb-privacy-policy-content' ); ?>
	</div>
</main>
<?php
get_footer();
