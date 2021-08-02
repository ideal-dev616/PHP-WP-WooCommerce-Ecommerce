<?php
/**
 * LiquidThemes WooCommerce hooks
 *
 * @package liquid-framework
 */

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );


/**
 * Layout
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Loop
 * @see  liquid_woocommere_headline()
 * @see  liquid_woocommerce_template_loop_product_title()
 */
 
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
add_filter( 'liquid_ajax_add_to_cart_single_product', '__return_false', 99 );

add_action( 'woocommerce_before_shop_loop', 'liquid_start_shop_topbar_container', 10 );
add_action( 'woocommerce_before_shop_loop', 'liquid_end_shop_topbar_container', 90 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 15 );

add_action( 'woocommerce_before_single_product', 'liquid_get_woo_header_notice', 12 );
add_action( 'woocommerce_before_single_product', 'liquid_start_shop_topbar_container', 15 );
add_action( 'woocommerce_before_single_product', 'liquid_end_shop_topbar_container', 90 );
add_action( 'woocommerce_before_single_product', 'woocommerce_breadcrumb', 20 );

add_filter( 'woocommerce_breadcrumb_defaults', 'liquid_woocommerce_breadcrumb_args', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating',               5 );
remove_action( 'woocommerce_shop_loop_item_title',       'woocommerce_template_loop_product_title',       10 );
add_action( 'woocommerce_shop_loop_item_title',          'liquid_woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'liquid_woocommerce_template_loop_product_thumbnail', 10 );	

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'liquid_woocommerce_template_loop_product_link', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );

//Single Product hooks
add_action( 'woocommerce_before_add_to_cart_button', 'liquid_start_summary_foot_container', 1 );

//add_action( 'woocommerce_before_add_to_cart_button', 'liquid_start_variable_summary_foot_container', 1 );
add_action( 'woocommerce_after_add_to_cart_button', 'liquid_add_wishlist_button', 5 );

add_action( 'woocommerce_after_add_to_cart_form', 'liquid_variable_add_wishlist_button', 5 );
//add_action( 'woocommerce_after_add_to_cart_button', 'liquid_end_variable_summary_foot_container', 99 );

add_action( 'woocommerce_after_add_to_cart_form', 'liquid_start_variable_summary_foot_container', 1 );
add_action( 'woocommerce_single_product_summary', 'liquid_end_variable_summary_foot_container', 55 );

add_action( 'woocommerce_single_product_summary', 'liquid_end_summary_foot_container_no_stock', 30 );
add_action( 'woocommerce_single_product_summary', 'liquid_end_summary_foot_container', 55 );


/**
 * Loop List
 * @see liquid_woocommerce_add_to_cart_list()
 */
add_action( 'woocommerce_shop_loop_add_cart_list', 'liquid_woocommerce_add_to_cart_list', 10 );

/**
 * Loop carousel add to cart
 * @see liquid_woocommerce_add_to_cart_carousel()
 */
add_action( 'liquid_woocommerce_loop_add_to_cart_carousel', 'liquid_woocommerce_add_to_cart_carousel', 10 );

/**
 * Loop elegant add to cart
 * @see liquid_woocommerce_add_to_cart_elegant()
 */
add_action( 'liquid_woocommerce_loop_add_to_cart_elegant', 'liquid_woocommerce_add_to_cart_elegant', 10 );

/**
 * Product
 * @see  liquid_woocommerce_template_single_cats()
 * @see  liquid_woocommerce_variations_quantity_input()
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',         10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 55 );

add_action( 'woocommerce_after_single_product', 'liquid_theme_init_js', 30 );

add_action( 'woocommerce_checkout_order_review', 'liquid_heading_payment_method', 15 );

/**
 * Filters
 * @see  liquid_woocommerce_body_class()
 * @see  liquid_products_per_page()
 * @see  liquid_loop_columns()
 * @see  liquid_wc_add_custom_query_var()
 * @see  liquid_woocommerce_catalog_orderby()
 */
add_filter( 'body_class',                           'liquid_woocommerce_body_class' );
add_filter( 'loop_shop_per_page',                   'liquid_wc_limit_archive_posts_per_page', 20 );
add_filter( 'loop_shop_columns',                    'liquid_loop_columns' );
add_filter( 'woocommerce_related_products_columns', 'liquid_related_loop_columns', 10, 1 );
add_filter( 'woocommerce_up_sells_columns',         'liquid_upsell_loop_columns', 10, 1 );
add_filter( 'woocommerce_cross_sells_columns',      'liquid_cross_sell_loop_columns', 10, 1 );
add_filter( 'query_vars',                           'liquid_wc_add_custom_query_var' );
add_filter( 'woocommerce_catalog_orderby',          'liquid_woocommerce_catalog_orderby' );

/**
 * Custom actions
 * @see  liquid_woocommerce_setup()
 */
add_action( 'after_switch_theme', 'liquid_woocommerce_setup', 1 );
add_action( 'init',               'liquid_woocommerce_clear_cart_url' );

/**
 * Custom metaboxes for products in general tab
 * @see  liquid_add_custom_general_fields()
 * @see  liquid_add_custom_general_fields_save()
 */
//add_action( 'woocommerce_product_options_general_product_data', 'liquid_add_custom_general_fields' );
//add_action( 'woocommerce_process_product_meta',                 'liquid_add_custom_general_fields_save' );

add_filter( 'woocommerce_add_to_cart_fragments', 'liquid_add_to_cart_fragments' );
add_filter( 'woocommerce_add_to_cart_fragments', 'liquid_add_to_cart_amount' );
add_filter( 'woocommerce_add_to_cart_fragments', 'liquid_add_to_cart_quickcart' );


function liquid_add_to_cart_fragments( $fragments ) {

	ob_start();
?>
	<span class="ld-module-trigger-count header-cart-fragments"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
<?php

	$fragments['span.header-cart-fragments'] = ob_get_clean();
    return $fragments;

};

function liquid_add_to_cart_amount( $fragments ) {

	ob_start();
?>
	<span class="header-cart-amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
<?php

	$fragments['span.header-cart-amount'] = ob_get_clean();
    return $fragments;

};

function liquid_add_to_cart_quickcart( $fragments ) {

    ob_start();

?>
	<div class="header-quickcart"><?php liquid_woocommerce_header_cart() ?></div>
    <?php $fragments['div.header-quickcart'] = ob_get_clean();

    return $fragments;
};

function liquid_add_cart_single_ajax() {
	
	$product_id = $_POST['product_id'];
	$variation_id = $_POST['variation_id'];
	$quantity = $_POST['quantity'];

	if ($variation_id) {
		WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
	} else {
		WC()->cart->add_to_cart( $product_id, $quantity);
	}

	$items = WC()->cart->get_cart();
	global $woocommerce;
	$item_count = $woocommerce->cart->cart_contents_count; ?>

	<?php liquid_woocommerce_header_cart() ?>

	<?php wp_die();
}

add_action( 'wp_ajax_liquid_add_cart_single', 'liquid_add_cart_single_ajax' );
add_action( 'wp_ajax_nopriv_liquid_add_cart_single', 'liquid_add_cart_single_ajax' );