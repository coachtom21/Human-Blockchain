<?php
/**
 * Quantity Input — theme override (fixed pack qty for YAM-STICKER).
 *
 * @see wp-content/plugins/woocommerce-side-cart-premium/templates/global/body/qty-input.php
 * @see https://docs.xootix.com/side-cart-woocommerce/
 * @version 3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$resolved_product_id = isset( $product_id ) ? (int) $product_id : ( isset( $args['parent_id'] ) ? (int) $args['parent_id'] : 0 );
$fixed_qty           = 0;
if ( class_exists( 'Cpm_Humanblockchain_Woo_Backorders' ) ) {
	$fixed_qty = Cpm_Humanblockchain_Woo_Backorders::get_fixed_order_qty_for_product_id( $resolved_product_id );
}
$is_fixed_qty = $fixed_qty > 0;

$min = $min_value;
$max = ( 0 < $max_value ) ? $max_value : '';
if ( $is_fixed_qty ) {
	$min         = $fixed_qty;
	$max         = $fixed_qty;
	$input_value = $fixed_qty;
}

?>

<div class="xoo-wsc-qty-box xoo-wsc-qtb-<?php echo esc_attr( $qtyDesign ); ?><?php echo $is_fixed_qty ? ' xoo-wsc-qty-box--fixed' : ''; ?>">

	<?php do_action( 'xoo_wsc_before_quantity_input_field' ); ?>

	<?php if ( ! $is_fixed_qty ) : ?>
		<span class="xoo-wsc-minus xoo-wsc-chng" id="qty_sub_cart">-</span>
	<?php endif; ?>

	<input
		type="<?php echo $is_fixed_qty ? 'text' : 'number'; ?>"
		class="<?php echo esc_attr( join( ' ', (array) $wsc_classes ) ); ?>"
		step="<?php echo esc_attr( $step ); ?>"
		min="<?php echo esc_attr( $min ); ?>"
		max="<?php echo esc_attr( $max ); ?>"
		value="<?php echo esc_attr( $input_value ); ?>"
		placeholder="<?php echo esc_attr( $placeholder ); ?>"
		inputmode="<?php echo esc_attr( $inputmode ); ?>"
		data-product_id="<?php echo esc_attr( $resolved_product_id ); ?>"
		<?php echo $is_fixed_qty ? 'readonly' : ''; ?>
	/>

	<?php do_action( 'xoo_wsc_after_quantity_input_field' ); ?>

	<?php if ( ! $is_fixed_qty ) : ?>
		<span class="xoo-wsc-plus xoo-wsc-chng" id="qty_add_cart">+</span>
	<?php endif; ?>

</div>
