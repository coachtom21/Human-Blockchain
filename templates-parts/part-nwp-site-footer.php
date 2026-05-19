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
$terms_url   = class_exists( 'Cpm_Hb_Legal_Pages' ) ? Cpm_Hb_Legal_Pages::terms_url() : home_url( '/terms-and-conditions/' );
?>
<footer class="nwp-site-footer" role="contentinfo">
	<div class="container nwp-site-footer__inner">
		<p class="nwp-site-footer__copy">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
			<?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
			<?php esc_html_e( 'All rights reserved.', 'hello-elementor-child' ); ?>
		</p>
		<?php if ( $privacy_url || $terms_url ) : ?>
			<nav class="nwp-site-footer__nav" aria-label="<?php echo esc_attr__( 'Footer', 'hello-elementor-child' ); ?>">
				<?php if ( $privacy_url ) : ?>
					<a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy Policy', 'hello-elementor-child' ); ?></a>
				<?php endif; ?>
				<?php if ( $terms_url ) : ?>
					<?php if ( $privacy_url ) : ?>
						<span class="nwp-site-footer__sep" aria-hidden="true"> · </span>
					<?php endif; ?>
					<a href="<?php echo esc_url( $terms_url ); ?>"><?php esc_html_e( 'Terms and Conditions', 'hello-elementor-child' ); ?></a>
				<?php endif; ?>
			</nav>
		<?php endif; ?>
	</div>
</footer>
