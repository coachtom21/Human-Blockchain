<?php
/**
 * NWP site header: NWP badge, site title, nav (New Menu, menu-1, or static fallback).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>
<nav class="nwp-site-header" aria-label="<?php echo esc_attr__( 'Primary', 'hello-elementor-child' ); ?>">
	<div class="container nwp-site-header__inner">
		<a class="nwp-site-header__brand brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="brand-badge">NWP</div>
			<div>
				<div class="brand-site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></div>
				<small class="nwp-site-header__tagline"><?php echo esc_html__( 'NWP Processing Center', 'hello-elementor-child' ); ?></small>
			</div>
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
		<div class="nwp-site-header__nav nav-links" id="nwp-header-nav">
			<?php
			$new_menu = wp_get_nav_menu_object( 'New Menu' );
			if ( $new_menu ) {
				wp_nav_menu(
					array(
						'menu'         => 'New Menu',
						'container'    => false,
						'menu_class'   => 'nav-menu',
						'fallback_cb'  => false,
					)
				);
			} elseif ( has_nav_menu( 'menu-1' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => false,
						'menu_class'     => 'nav-menu',
						'fallback_cb'    => false,
						'depth'          => 2,
					)
				);
			} else {
				$how    = hb_nwp_landing_section_url( 'how-it-works' );
				$seller = hb_nwp_landing_section_url( 'seller-types' );
				$trade  = hb_nwp_landing_section_url( 'trade-value' );
				?>
				<ul class="nav-menu">
					<li class="menu-item"><a href="<?php echo $how; ?>"><?php echo esc_html__( 'How It Works', 'hello-elementor-child' ); ?></a></li>
					<li class="menu-item"><a href="<?php echo $seller; ?>"><?php echo esc_html__( 'Seller Types', 'hello-elementor-child' ); ?></a></li>
					<li class="menu-item"><a href="<?php echo $trade; ?>"><?php echo esc_html__( 'Trade Value', 'hello-elementor-child' ); ?></a></li>
					<li class="menu-item"><a href="<?php echo esc_url( $shop_url ); ?>"><?php echo esc_html__( 'Shop', 'hello-elementor-child' ); ?></a></li>
					<li class="cpm-nwp-register-btn-wrap menu-item"><a href="#" class="cpm-nwp-register-btn cpm-nwp-open-modal" data-cpm-modal="cpm-nwp-register-modal"><?php echo esc_html__( 'Activate Your Phone', 'cpm-humanblockchain' ); ?></a></li>
					<li class="cpm-hb-get-started-wrap menu-item"><a href="#" class="cpm-hb-get-started-btn cpm-hb-open-membership-modal btn ghost"><?php echo esc_html__( 'Get started', 'cpm-humanblockchain' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</div>
	</div>
</nav>
