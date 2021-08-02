<?php
/**
 * Header Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order_count = WC()->cart->get_cart_contents_count();
$is_empty    = WC()->cart->is_empty();
$sub_total   = WC()->cart->get_cart_subtotal();

?>
<div class="ld-cart-head flex-wrap justify-content-between">
	<span class="ld-cart-head-txt"><?php esc_html_e( 'Cart', 'ave' ); ?> <span class="ld-module-trigger-count color-primary"><?php echo esc_attr( $order_count ); ?></span></span>
	<span class="ld-module-trigger collapsed" data-ld-toggle="true" data-toggle="collapse" data-target="#lqd-cart-cloned" aria-controls="lqd-cart-cloned" aria-expanded="false">
		<span class="ld-module-trigger-icon">
			<i class="icon-md-close"></i>
		</span><!-- /.ld-module-trigger-icon --> 
	</span><!-- /.ld-module-trigger -->
</div><!-- /.ld-cart-head -->
<span class="item-count" style="display:none;"><?php echo esc_attr( $order_count ); ?></span>

<div class="ld-cart-products woocommerce-mini-cart cart_list product_list_widget">
	
	<?php if ( ! $is_empty ) : ?>

		<?php
	
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
	
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>	
					<div class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'ld-cart-product woocommerce-mini-cart-item', $cart_item, $cart_item_key ) ); ?>">
						<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="ld-cart-product-remove remove remove_from_cart_button" title="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="icon-ion-ios-close"></i></a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							__( 'Remove this item', 'ave' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
						?>
						<div class="ld-cart-product-info">
						<?php if ( empty( $product_permalink ) ) : ?>
							<?php if( $thumbnail ) { ?>
								<figure>
									<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
								</figure>
							<?php } ?>
							<span class="ld-cart-product-details">
								<span class="ld-cart-product-name"><?php echo wp_kses_post( $product_name ); ?></span>
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
							</span><!-- /.ld-cart-product-details -->
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php if( $thumbnail ) { ?>
									<figure>
										<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
									</figure>
								<?php } ?>
								<span class="ld-cart-product-details">
									<span class="ld-cart-product-name"><?php echo wp_kses_post( $product_name ); ?></span>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

									<span class="ld-cart-product-price">
										<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '<span>%s</span> <span class="ld-cart-product-quantity">&times;%s</span>', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
									</span><!-- /.ld-cart-product-price -->

								</span><!-- /.ld-cart-product-details -->
							</a>
						<?php endif; ?>
						</div><!-- /.ld-cart-product-info -->

					</div><!-- /.ld-cart-product -->
					<?php
				}
			}
		?>	

	<?php else : ?>

		<div class="empty"><h3><?php esc_html_e( 'No products in the cart.', 'ave' ); ?></h3></div>

	<?php endif; ?>
	
</div><!-- /.ld-cart-products -->

<?php if ( !$is_empty ) : ?>
<div class="ld-cart-foot">
	<div class="ld-cart-total woocommerce-mini-cart__total total">
		<span class="ld-cart-total-label font-weight-bold text-uppercase ltr-sp-175"><?php esc_html_e( 'Subtotal', 'ave' ); ?></span>
		<span class="ld-cart-total-price woocommerce-Price-amount amount header-cart-amount color-primary"><?php echo wp_kses_post( $sub_total ); ?></span>
	</div><!-- /.ld-cart-total -->
	<div class="ld-cart-button woocommerce-mini-cart__buttons buttons">
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-xlg btn-solid text-uppercase ltr-sp-175">
			<span>
				<span class="btn-txt"><?php esc_html_e( 'Checkout', 'ave' ); ?></span>
				<span class="btn-icon"><i class="fa fa-angle-right"></i></span>
			</span>
		</a>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-xlg btn-naked text-uppercase ltr-sp-175">
			<span>
				<span class="btn-txt"><?php esc_html_e( 'View Cart', 'ave' ); ?></span>
				<span class="btn-icon"><i class="fa fa-angle-right"></i></span>
			</span>
		</a>
	</div><!-- /.ld-cart-button -->
</div><!-- /.ld-cart-foot -->
<?php endif; ?>