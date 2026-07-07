<?php
/**
 * Side Cart Header (theme override)
 *
 * @see wp-content/plugins/woocommerce-side-cart-premium/templates/xoo-wsc-header.php
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( Xoo_Wsc_Template_Args::cart_header() );

$hb_side_cart_video_url = (string) apply_filters(
	'cpm_hb_side_cart_video_url',
	(string) apply_filters(
		'cpm_hb_cart_page_video_url',
		'https://humanblockchain.info/wp-content/uploads/2026/05/Coach-Toms-Dream_-One-Grain-of-Sand-2026-05-021.mp4'
	)
);
$hb_side_cart_video_title = (string) apply_filters(
	'cpm_hb_side_cart_video_title',
	(string) apply_filters(
		'cpm_hb_cart_page_video_title',
		__( 'Coach Tom’s Dream — One Grain of Sand', 'hello-elementor-child' )
	)
);
?>

<div class="xoo-wsch-top">

	<?php if ( $showNotifications ) : ?>
		<?php xoo_wsc_cart()->print_notices_html( 'cart' ); ?>
	<?php endif; ?>

	<?php if ( $showBasket ) : ?>
		<div class="xoo-wsch-basket">
			<span class="xoo-wscb-icon xoo-wsc-icon-bag2"></span>
			<span class="xoo-wscb-count"><?php echo xoo_wsc_cart()->get_cart_count(); ?></span>
		</div>
	<?php endif; ?>

	<?php if ( $heading ) : ?>
		<span class="xoo-wsch-text"><?php echo $heading; ?></span>
	<?php endif; ?>

	<?php if ( $showCloseIcon ) : ?>
		<span class="xoo-wsch-close <?php echo $close_icon; ?>"></span>
	<?php endif; ?>

</div>

<?php if ( $hb_side_cart_video_url !== '' ) : ?>
	<div class="cpm-hb-side-cart-video-wrap">
		<?php if ( $hb_side_cart_video_title !== '' ) : ?>
			<p class="cpm-hb-side-cart-video-title"><?php echo esc_html( $hb_side_cart_video_title ); ?></p>
		<?php endif; ?>
		<video class="cpm-hb-side-cart-video" controls playsinline preload="metadata" width="100%">
			<source src="<?php echo esc_url( $hb_side_cart_video_url ); ?>" type="video/mp4" />
			<?php esc_html_e( 'Your browser does not support the video tag.', 'hello-elementor-child' ); ?>
		</video>
	</div>
<?php endif; ?>

<?php xoo_wsc_helper()->get_template( 'global/header/shipping-bar.php' ); ?>
