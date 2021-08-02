<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package Ave
 */

/**
 * Custom heading for loop product
 * @return string
 */
if ( ! function_exists( 'liquid_woocommerce_template_loop_product_title' ) ) {
	function liquid_woocommerce_template_loop_product_title() {
		echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
	}
}

if ( ! function_exists( 'liquid_woocommerce_template_loop_product_link' ) ) {
    /**
     * Insert the opening anchor tag for products in the loop.
     */
    function liquid_woocommerce_template_loop_product_link() {
        global $product;

        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

        echo '<a href="' . esc_url( $link ) . '" class="liquid-overlay-link woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>';
    }
}


if ( ! function_exists( 'liquid_woocommerce_template_loop_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail for the loop.
     */
    function liquid_woocommerce_template_loop_product_thumbnail() {
        echo liquid_woocommerce_get_product_thumbnail(); // WPCS: XSS ok.
    }
}
if ( ! function_exists( 'liquid_woocommerce_get_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail, or the placeholder if not set.
     *
     * @param string $size (default: 'woocommerce_thumbnail').
     * @param int    $deprecated1 Deprecated since WooCommerce 2.0 (default: 0).
     * @param int    $deprecated2 Deprecated since WooCommerce 2.0 (default: 0).
     * @return string
     */
    function liquid_woocommerce_get_product_thumbnail( $size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {

		global $product;
        
		$post_thumbnail_id = $product->get_image_id();
		$attachment_ids = array();
		$gallery_ids = $product->get_gallery_image_ids();
		
		$attachment_ids[] = $post_thumbnail_id;
		$attachment_ids = array_merge( $attachment_ids, $gallery_ids );

		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
		
		$hover_img = '';
		$hover_img_id = get_post_meta( $product->get_id(), 'product_product-secondary-image_thumbnail_id', true );

		if( ! empty( $hover_img_id ) ) {
			$hover_img = '<figure class="ld-sp-img-hover bg-cover bg-center my-0 ld-overlay pos-abs" data-responsive-bg="true">' . wp_get_attachment_image( $hover_img_id, $image_size, false, array( 'alt' => esc_attr( $product->get_title() ), 'class' => 'invisible' ) ) . '</figure>' ;
		}

		if( count( $attachment_ids ) > 1 && apply_filters( 'liquid_enable_woo_products_carousel', true )  ) {
			
			$carousel = '<div class="carousel-container carousel-nav-floated carousel-nav-center carousel-nav-middle">

						<div class="carousel-items row mx-0" data-lqd-flickity=\'{ "prevNextButtons": true, "navArrow": { "prev": "<i class=\"fa fa-angle-left\"></i>", "next": "<i class=\"fa fa-angle-right\"></i>" }, "navOffsets": { "prev": 10, "next": 10 } }\'>';
			
			
			foreach( $attachment_ids as $attachment_id ) {			

				$carousel .= '<div class="carousel-item col-xs-12 px-0"><figure class="my-0">';
				$carousel .= wp_get_attachment_image( $attachment_id, $image_size, false, array( 'alt' => esc_attr( $product->get_title() ) ) );
				$carousel .= '</figure></div><!-- /.carousel-item -->';

			};
			
			$carousel .= '</div><!-- /.carousel-items row -->';
			
			$carousel .= '</div><!-- /.carousel-container -->';
	
			return $carousel;
		}

        return $product ? $product->get_image( $image_size ) . $hover_img : '';
    }
}

/**
 * Custom breadcrumb
 * @return string
 */
if ( !function_exists( 'liquid_woocommerce_breadcrumb_args' ) ) {
	function liquid_woocommerce_breadcrumb_args( $args ) {
		
		$args = array(

			'delimiter'   => '',
			'wrap_before' => '<div class="col-md-6"><nav class="woocommerce-breadcrumb mb-4 mb-md-0"><ul class="breadcrumbs reset-ul inline-nav comma-sep-li">',
			'wrap_after'  => '</ul></nav></div>',
			'before'      => '<li>',
			'after'       => '</li>',
			'home'        => esc_html_x( 'Home', 'breadcrumb', 'ave' ),
				
		);

		return $args;

	}
}

function liquid_start_shop_topbar_container() {
	
	echo '<div class="ld-shop-topbar fullwidth"><div class="container"><div class="row">';
	
}
function liquid_end_shop_topbar_container() {

	echo '</div></div></div>';
}

/**
 * Add custom woocommerce template part for list loop
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_add_to_cart_list' ) ) {
	function liquid_woocommerce_add_to_cart_list() {
		wc_get_template( 'loop/add-to-cart-list.php' );
	}
}

/**
 * Add custom woocommerce template part for carousel loop
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_add_to_cart_carousel' ) ) {
	function liquid_woocommerce_add_to_cart_carousel() {
		wc_get_template( 'loop/add-to-cart-carousel.php' );
	}
}

/**
 * Add custom woocommerce template part for elegant loop
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_add_to_cart_elegant' ) ) {
	function liquid_woocommerce_add_to_cart_elegant() {
		wc_get_template( 'loop/add-to-cart-elegant.php' );
	}
}

/**
 * Add custom classnames to product content
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_product_classnames' ) ) {
	function liquid_woocommerce_product_classnames() {
		
		$style = liquid_helper()->get_option( 'wc-archive-product-style' );
		
		if( 'minimal' === $style ) {
			echo 'ld-sp-min-1';
		}
		elseif( 'minimal-2' === $style ) {
			echo 'ld-sp-min-2';			
		}
		elseif( 'minimal-hover-shadow' === $style ) {
			echo 'ld-sp-mhs-1';			
		}
		elseif( 'minimal-hover-shadow-2' === $style ) {
			echo 'ld-sp-mhs-2';			
		}
		
		
	}
}

function liquid_add_wishlist_button() {

	global $product;
	
	if( $product->is_type( 'variable' ) ) {
		return'';
	}

	//Check if the plugin is active and add icon add-to-wishlist
	if ( class_exists( 'YITH_WCWL' ) ):
		echo do_shortcode('[yith_wcwl_add_to_wishlist label="<i class=\'fa fa-heart\'></i>"]');
	endif;

}

function liquid_variable_add_wishlist_button() {

	global $product;
	
	if( !$product->is_type( 'variable' ) ) {
		return'';
	}

	//Check if the plugin is active and add icon add-to-wishlist
	if ( class_exists( 'YITH_WCWL' ) ):
		echo do_shortcode('[yith_wcwl_add_to_wishlist label="<i class=\'fa fa-heart\'></i>"]');
	endif;

}

function liquid_start_summary_foot_container() {
	
	global $product;
	
	if( $product->is_type( 'variable' ) ) {
		return'';
	}
	
	if( $product->is_in_stock() ) {
		echo '<div class="ld-product-summary-foot d-flex flex-row align-items-center">';	
	}
	
}

function liquid_start_variable_summary_foot_container() {
	
	global $product;
	
	if( !$product->is_type( 'variable' ) ) {
		return'';
	}

	echo '<div class="ld-product-summary-foot d-flex flex-row align-items-center">';
	
}
function liquid_end_variable_summary_foot_container() {
	
	global $product;
	
	if( !$product->is_type( 'variable' ) ) {
		return'';
	}

	echo '</div>';
}
function liquid_end_summary_foot_container_no_stock() {

	global $product;
	
	if( $product->is_type( 'variable' ) ) {
		return'';
	}
	
	if( !$product->is_in_stock() ) {
		echo '<div class="ld-product-summary-foot d-flex flex-row align-items-center no-add-to-cart">';	
	}	
}
function liquid_end_summary_foot_container() {
	
	global $product;
	
	if( $product->is_type( 'variable' ) ) {
		return'';
	}

	echo '</div>';
}

/**
 * Add custom woocommerce template part for heading cart
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_header_cart' ) ) {
    function liquid_woocommerce_header_cart() {
        wc_get_template( 'cart/header-mini-cart.php' );
    }
}

/**
 * Enqueue theme-init js after woocommerce js
 * @return void
 */
if ( ! function_exists( 'liquid_theme_init_js' ) ) {
    function liquid_theme_init_js() {
		//Hook to enqueue woocommerce scripts bofore theme-init.js
		wp_dequeue_script( 'custom' );
		wp_enqueue_script( 'custom' );
    }
}

/**
 * Add heading to payment method
 * @return void
 */
if ( ! function_exists( 'liquid_heading_payment_method' ) ) {
	function liquid_heading_payment_method() {
		echo '<h3 class="order_review_heading">' . esc_html__( 'Payment', 'ave' ) . '</h3>';
	}
}

/**
 * Add custom woocommerce template part single product
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_template_single_cats' ) ) {
	function liquid_woocommerce_template_single_cats() {
		wc_get_template( 'single-product/cats-and-tags.php' );
	}
}

/**
 * Add custom woocommerce template part single product
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_variations_quantity_input' ) ) {
	function liquid_woocommerce_variations_quantity_input() {
		wc_get_template( 'single-product/add-to-cart/quantity-input.php' );
	}
}

/**
 * Add custom woocommerce template part single product
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_add_availability' ) ) {
	function liquid_woocommerce_add_availability() {
		wc_get_template( 'single-product/availability.php' );
	}
}

/**
 * Add 'woocommerce' class to the body tag
 * @param  array $classes
 * @return array $classes modified to include 'woocommerce' class
 */
if ( ! function_exists( 'liquid_woocommerce_body_class' ) ) {
	function liquid_woocommerce_body_class( $classes ) {
		
		if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'page-templates/shop.php' ) {
	
			$classes[] = 'woocommerce';
		}
		
		$woo_product_style = liquid_helper()->get_theme_option( 'woo_single_style' );
		if( is_product() && 'alt' === $woo_product_style ) {
			$classes[] = 'single-product-alt';
		}
		
	
		return $classes;
	}
}

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_loop_columns' ) ) {
	function liquid_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_columns', '3' );	
		if( empty( $columns ) ) {
			$columns = '3';
		}
		return $columns; // products per row
	}
}

/**
 * Default related loop columns on single product
 * @return integer columns per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_related_loop_columns' ) ) {
	function liquid_related_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_related_columns', '4' );	
		if( empty( $columns ) ) {
			$columns = '4';
		}
		return $columns; // products per row
	}
}

/**
 * Default up-sell loop columns on single product
 * @return integer columns per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_upsell_loop_columns' ) ) {
	function liquid_upsell_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_up_sell_columns', '4' );	
		if( empty( $columns ) ) {
			$columns = '4';
		}
		return $columns; // products per row
	}
}

/**
 * Default cross-sell loop columns
 * @return integer columns per row
 * @since  1.0.0
 */
if ( ! function_exists( 'liquid_cross_sell_loop_columns' ) ) {
	function liquid_cross_sell_loop_columns() {
		$columns = liquid_helper()->get_option( 'ld_woo_cross_sell_columns', '4' );	
		if( empty( $columns ) ) {
			$columns = '4';
		}
		return $columns; // products per row
	}
}

/**
 * Get default posts per page value
 * @return int
 */
function liquid_wc_get_current_posts_per_page_value( $force_value = null ) {	
	$posts_per_page = get_query_var( 'postsperpage' );
	if ( empty( $posts_per_page ) ) {

		if ( $force_value != null && intval( $force_value ) ) {
			$posts_per_page = $force_value;
		} else {
			$posts_per_page = liquid_helper()->get_option( 'ld_woo_products_per_page', '12' );
			if ( empty( $posts_per_page ) ) {
				$posts_per_page = get_option( 'posts_per_page' );
			}
		}
	}
	return intval( $posts_per_page );
}

/**
 * Limit post on products archive
 * @return type
 */
function liquid_wc_limit_archive_posts_per_page() {
	return liquid_wc_get_current_posts_per_page_value();
}

/**
 * Add postsperpage var to custom query
 * @param array $vars
 * @return string
 */
function liquid_wc_add_custom_query_var( $vars ){
  $vars[] = "postsperpage";
  return $vars;
}

/**
 * Get values to post per pages dropdown list
 * @return type
 */
function liquid_wc_get_posts_per_page_dropdown_values( $add_value = null ) {
  
	$current_value = liquid_wc_get_current_posts_per_page_value( $add_value );

	$values = array( 10,20,30,40,50,60,70,80,90,100 );

	if ( ! in_array( $current_value, $values ) ) {
		$values[] = $current_value;
		sort( $values );
	}

	if ( ! in_array( $add_value, $values ) ) {
		$values[] = $add_value;
		sort( $values );
	}

	$defined_posts_per_page = intval( liquid_helper()->get_option( 'ld_woo_products_per_page' ) );
	if ( ! empty( $defined_posts_per_page ) &&  ! in_array( $defined_posts_per_page, $values ) ) {
		$values[] = liquid_helper()->get_option( 'ld_woo_products_per_page' );
		sort( $values );
	}

	return $values;
}

/**
 * Custom woocommerce order by array
 * @param array $sortby
 * @return array
 */

function liquid_woocommerce_catalog_orderby( $sortby ) {
	
	$sortby = array(
		'menu_order' => esc_html__( 'Default Order', 'ave' ),
		'popularity' => esc_html__( 'Popularity', 'ave' ),
		'rating'     => esc_html__( 'Average rating', 'ave' ),
		'date'       => esc_html__( 'Newness', 'ave' ),
		'price'      => esc_html__( 'Lowest Price', 'ave' ),
		'price-desc' => esc_html__( 'Highest Price', 'ave' )
	);
	
	return $sortby;
}

/**
 * Define woocommerce image sizes
 */
function liquid_woocommerce_setup() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

	$catalog = array(
		'width'  => '250', // px
		'height' => '358', // px
		'crop'   => 1      // true
	);

	$single = array(
		'width'  => '500', // px
		'height' => '760', // px
		'crop'   => 1      // true
	);

	$thumbnail = array(
		'width'  => '50', // px
		'height' => '72', // px
		'crop'   => 1     // true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size',   $catalog );   // Product category thumbs
	update_option( 'shop_single_image_size',    $single );    // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
	update_option( 'yith_wcwl_button_position', 'shortcode' );
}

/**
 * Empty the cart
 * @global object $woocommerce
 */
function liquid_woocommerce_clear_cart_url() {
  global $woocommerce;
	
	if ( is_object( $woocommerce ) && isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
		$url = $woocommerce->cart->get_cart_url();
		if ( empty( $url ) ) {
			$url = get_permalink( wc_get_page_id( 'shop' ) );
		}
		wp_redirect( esc_url($url) );
	}
}

/**
 * Get current products list view type
 * @return string
 */
function liquid_woocommerce_get_products_list_view_type() {
	
	if ( isset( $_GET['view'] ) && in_array( $_GET['view'], array( 'list', 'grid' ) ) ) {
		return $_GET['view'];
	}
	return liquid_helper()->get_option( 'shop-products-list-view' );
}

/**
* WP Core doens't let us change the sort direction for invidual orderby params - http://core.trac.wordpress.org/ticket/17065
*
* This lets us sort by meta value desc, and have a second orderby param.
*
* @param array $args
* @return array
*/
function liquid_woocommerce_order_by_popularity_post_clauses( $args ) {

	global $wpdb;
	$args['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";
	return $args;
}

/**
* order_by_rating_post_clauses function.
*
* @param array $args
* @return array
*/
function liquid_woocommerce_order_by_rating_post_clauses( $args ) {

	global $wpdb;
	$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";
	$args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";
	$args['join'] .= "
	   LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
	   LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
	";
	$args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";
	$args['groupby'] = "$wpdb->posts.ID";

	return $args;
};

function liquid_get_woo_header_notice() {
	
	global $woocommerce, $post;
	
	$notice = get_post_meta( $post->ID, 'liquid_woo_header_notice', true );
	if( empty( $notice ) || ' ' == $notice ) {
		return '';
	}
	
	printf( '<div class="ld-shop-notice fullwidth"><div class="container"><div class="row"><div class="col-md-12 text-center"><h3>%s</h3></div></div></div></div>', wp_kses_post( $notice ) );

}


/*
 * Tab
 */
add_filter( 'woocommerce_product_data_tabs', 'liquid_product_settings_tabs' );
function liquid_product_settings_tabs( $tabs ){
 
	//unset( $tabs['inventory'] );
 
	$tabs['header-note'] = array(
		'label'    => esc_html__( 'Header Note', 'ave' ),
		'target'   => 'liquid_product_data',
		'priority' => 21,
	);
	return $tabs;
}
/*
 * Tab content
 */
add_action( 'woocommerce_product_data_panels', 'liquid_product_panels' );
function liquid_product_panels(){
	
	global $woocommerce, $post;
 
	echo '<div id="liquid_product_data" class="panel woocommerce_options_panel hidden">';
 
	woocommerce_wp_textarea_input( array(
		'id'          => 'liquid_woo_header_notice',
		'value'       => get_post_meta( $post->ID, 'liquid_woo_header_notice', true ),
		'label'       => esc_html__( 'Notice', 'ave' ),
		'desc_tip'    => true,
		'description' => esc_html__( 'Add header notice in yellow box', 'ave' ),
	) );

	echo '</div>';

}
add_action( 'woocommerce_process_product_meta', 'liquid_add_header_notice_field_save' );
/**
 * Save values for custom field in woo product
 * @return void
 */
function liquid_add_header_notice_field_save( $post_id ){

	// Custom button label
	$woo_header_notice = wp_kses_post( $_POST['liquid_woo_header_notice'] );
	if( !empty( $woo_header_notice ) ) {
		update_post_meta( $post_id, 'liquid_woo_header_notice', $woo_header_notice );
	}
}
add_action( 'admin_head', 'liquid_css_icon' );
function liquid_css_icon(){
	echo '<style>
	#woocommerce-product-data ul.wc-tabs li.header-note_options.header-note_tab a:before{
		content: "\f534";
	}
	</style>';
}
