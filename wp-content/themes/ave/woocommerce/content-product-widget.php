<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<div class="ld-bsp">
	<figure class="ld-bsp-img">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php liquid_the_post_thumbnail( 'liquid-widget' ); ?>
		</a>
	</figure>
	<div class="ld-bsp-info">

		<h3>
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
		</h3>
		<?php echo wp_kses_post( $product->get_price_html() ); ?>

	</div><!-- /.ld-bsp-info -->
</div><!-- /.ld-bsp -->