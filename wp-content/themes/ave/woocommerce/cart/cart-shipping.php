<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';

?>
<tr class="woocommerce-shipping-totals shipping">
	<th><?php echo wp_kses_post( $package_name ); ?>
		<?php if ( $show_shipping_calculator ) : ?>
			<?php woocommerce_shipping_calculator( $calculator_text ); ?>
		<?php endif; ?>
	</th>
	<td colspan="2" data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php if ( $available_methods ) : ?>
			<ul id="shipping_method" class="woocommerce-shipping-methods">
				<?php foreach ( $available_methods as $method ) : ?>
					<li>
						<?php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
						}
						printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
						do_action( 'woocommerce_after_shipping_rate', $method, $index );
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php elseif ( 1 === count( $available_methods ) ) :  ?>
			<?php
				$method = current( $available_methods );
				printf( '%3$s <input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d" value="%2$s" class="shipping_method" />', $index, esc_attr( $method->id ), wc_cart_totals_shipping_method_label( $method ) );
				do_action( 'woocommerce_after_shipping_rate', $method, $index );
			?>
		<?php elseif ( ! WC()->customer->has_calculated_shipping() ) : ?>
			<?php echo wpautop( esc_html__( 'Shipping costs will be calculated once you have provided your address.', 'ave' ) ); ?>
		<?php else : ?>
			<?php echo apply_filters( is_cart() ? 'woocommerce_cart_no_shipping_available_html' : 'woocommerce_no_shipping_available_html', wpautop( esc_html__( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'ave' ) ) ); ?>
		<?php endif; ?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>
	</td>
</tr>