<?php
/**
 * Site header shared across all pages.
 * Showing Up Counts chrome: Human Blockchain / Detente 2030 + text nav.
 * Shop only for MEGAvoter / Participant.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$how_url     = home_url( '/#how' );
$join_url    = home_url( '/#join' );
$laugh_url   = home_url( '/r' );
$account_url = home_url( '/my-account/' );
$shop_url    = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
$can_shop    = function_exists( 'hb_user_can_access_shop' ) && hb_user_can_access_shop();
?>
<header class="nwp-site-header" role="banner">
	<div class="container nwp-site-header__inner">
		<a class="nwp-site-header__brand brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			Human Blockchain <span><?php esc_html_e( 'Detente 2030', 'hello-elementor-child' ); ?></span>
		</a>
		<button
			type="button"
			class="nwp-site-header__menu-toggle"
			id="nwp-header-menu-btn"
			aria-expanded="false"
			aria-controls="nwp-header-nav"
			aria-label="<?php echo esc_attr__( 'Open menu', 'hello-elementor-child' ); ?>"
			data-label-open="<?php echo esc_attr__( 'Open menu', 'hello-elementor-child' ); ?>"
			data-label-close="<?php echo esc_attr__( 'Close menu', 'hello-elementor-child' ); ?>"
		>
			<span class="nwp-site-header__menu-toggle-box" aria-hidden="true">
				<span class="nwp-site-header__menu-toggle-inner"></span>
			</span>
		</button>
		<nav class="nwp-site-header__nav nav-links" id="nwp-header-nav" aria-label="<?php echo esc_attr__( 'Primary', 'hello-elementor-child' ); ?>">
			<ul class="nav-menu">
				<li class="menu-item"><a href="<?php echo esc_url( $how_url ); ?>"><?php esc_html_e( 'How It Works', 'hello-elementor-child' ); ?></a></li>
				<?php if ( ! $can_shop ) : ?>
				<li class="menu-item"><a href="<?php echo esc_url( $join_url ); ?>"><?php esc_html_e( 'Join', 'hello-elementor-child' ); ?></a></li>
				<?php endif; ?>
				<li class="menu-item"><a href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'LAUGH Events', 'hello-elementor-child' ); ?></a></li>
				<?php if ( $can_shop ) : ?>
				<li class="menu-item"><a href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Shop', 'hello-elementor-child' ); ?></a></li>
				<?php endif; ?>
				<li class="menu-item"><a href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'My Account', 'hello-elementor-child' ); ?></a></li>
				<?php if ( is_user_logged_in() ) : ?>
				<li class="menu-item"><a href="<?php echo esc_url( function_exists( 'hb_signout_url' ) ? hb_signout_url() : wp_logout_url( home_url( '/' ) ) ); ?>"><?php esc_html_e( 'Log out', 'hello-elementor-child' ); ?></a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</div>
</header>
