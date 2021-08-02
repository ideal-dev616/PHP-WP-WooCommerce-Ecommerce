<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $related_products ) : ?>
	
	<section class="related products">
		
		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related Products', 'ave' ) );

		if ( $heading ) :
			?>
			<h2 class="text-center"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );
					
					$style = liquid_helper()->get_option( 'wc-archive-product-style' );
					
					if( 'minimal' === $style || 'minimal-2' === $style ) {
						wc_get_template_part( 'content', 'product-minimal' );
					}
					elseif( 'minimal-hover-shadow' === $style ) {
						wc_get_template_part( 'content', 'product-minimal-hover-shadow' );
					}
					elseif( 'minimal-hover-shadow-2' === $style ) {
						wc_get_template_part( 'content', 'product-minimal-hover-shadow-2' );				
					}
					else {
						wc_get_template_part( 'content', 'product' );
					} ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
		
<?php endif;

wp_reset_postdata();