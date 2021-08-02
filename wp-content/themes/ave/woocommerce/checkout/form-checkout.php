<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'ave' ) ) );
	return;
}

?>
<div class="lqd-woo-steps">
	<div class="lqd-woo-steps-inner">
		<div class="lqd-woo-steps-item is-active">
			<span class="lqd-woo-steps-number"><?php esc_html_e( '1', 'ave' ); ?></span><!-- /.lqd-woo-steps-number -->
			<span><?php esc_html_e( 'Shopping Cart', 'ave' ); ?></span>
			<svg width="9" height="56" xmlns="http://www.w3.org/2000/svg" stroke="#e5e5e5" fill="none">
				<polyline points="0.5888671875,0.02734375 0.5888671875,20.145751923322678 7.5888671875,27.7603759765625 0.5888671875,35.53466796875 0.5888671875,55.9697265625 " />
			</svg>
		</div><!-- /.lqd-woo-steps-item -->
		
		<div class="lqd-woo-steps-item is-active">
			<span class="lqd-woo-steps-number"><?php esc_html_e( '2', 'ave' ); ?></span><!-- /.lqd-woo-steps-number -->
			<span><?php esc_html_e( 'Payment and Delivery Options', 'ave' ) ?></span>
			<svg width="9" height="56" xmlns="http://www.w3.org/2000/svg" stroke="#e5e5e5" fill="none">
				<polyline points="0.5888671875,0.02734375 0.5888671875,20.145751923322678 7.5888671875,27.7603759765625 0.5888671875,35.53466796875 0.5888671875,55.9697265625 " />
			</svg>
	</div><!-- /.lqd-woo-steps-item -->
	
	<div class="lqd-woo-steps-item">
		<span class="lqd-woo-steps-number"><?php esc_html_e( '3', 'ave' ); ?></span><!-- /.lqd-woo-steps-number -->
		<span><?php esc_html_e( 'Order Received', 'ave' ); ?></span>
	</div><!-- /.lqd-woo-steps-item -->
	</div><!-- /.lqd-woo-steps-inner -->
</div><!-- /.lqd-woo-steps -->

<form name="checkout" method="post" class="clearfix checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>

			<div class="col-2">
					
				<h3 class="order_review_heading"><?php esc_html_e( 'Your order', 'ave' ); ?></h3>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
			
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
				
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>



</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
