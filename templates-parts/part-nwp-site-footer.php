<?php
/**
 * NWP site footer — copyright + optional legal links (matches header palette).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$privacy_url = function_exists( 'get_privacy_policy_url' ) ? get_privacy_policy_url() : '';
?>
<footer class="nwp-site-footer" role="contentinfo">
	<div class="container nwp-site-footer__inner">
		<p class="nwp-site-footer__copy">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
			<?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
			<?php esc_html_e( 'All rights reserved.', 'hello-elementor-child' ); ?>
		</p>
		<?php if ( $privacy_url ) : ?>
			<nav class="nwp-site-footer__nav" aria-label="<?php echo esc_attr__( 'Footer', 'hello-elementor-child' ); ?>">
				<a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy Policy', 'hello-elementor-child' ); ?></a>
			</nav>
		<?php endif; ?>
	</div>
</footer>
