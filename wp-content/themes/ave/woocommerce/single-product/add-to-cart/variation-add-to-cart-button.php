<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button ld-product-summary-foot d-flex flex-row align-items-center">

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input( array(
		'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
		'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
		'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
	) );

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<button type="submit" class="single_add_to_cart_button button btn btn-sm font-weight-bold text-uppercase ltr-sp-15" data-quantity="" aria-label="<?php esc_attr_e( 'Add "', 'ave' ); ?><?php echo $product->get_name(); ?><?php esc_attr_e( '" to your cart', 'ave' ); ?>" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"><span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span></button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
