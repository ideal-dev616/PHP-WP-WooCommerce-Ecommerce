<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}

// Enqueue Conditional Script
$this->scripts();

extract( $atts );

global $wpdb, $product;


//query args
$args = array(
	'posts_per_page' => intval( $limit ) ? intval( $limit ) : 12,
	'post_type'      => 'product',
	'post_status'    => 'publish',
);

if ( $taxonomies ) {

	$cats_tax = explode( ',', $taxonomies );
	if ( is_array( $cats_tax ) && count( $cats_tax ) == 1 ) {
		$cats_tax = array_shift( $cats_tax );
	}
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $cats_tax
		)
	);
}

$args['meta_query']   = array();
$args['meta_query'][] = WC()->query->stock_status_meta_query();
$args['meta_query']   = array_filter( $args['meta_query'] );

// default - menu_order
$args['orderby'] = 'menu_order title';
$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
$args['meta_key'] = '';

switch ( $orderby ) {
	case 'rand' :
		$args['orderby'] = 'rand';
	break;
	case 'date' :
		$args['orderby'] = 'date';
		$args['order'] = $order == 'ASC' ? 'ASC' : 'DESC';
	break;
	case 'price' :
		$args['orderby'] = "meta_value_num {$wpdb->posts}.ID";
		$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
		$args['meta_key'] = '_price';
	break;
	case 'popularity' :
		$args['meta_key'] = 'total_sales';
		// Sorting handled later though a hook
		add_filter('posts_clauses', 'liquid_woocommerce_order_by_popularity_post_clauses');
	break;
	case 'rating' :
		// Sorting handled later though a hook
		add_filter('posts_clauses', 'liquid_woocommerce_order_by_rating_post_clauses');
	break;
	case 'title' :
		$args['orderby'] = 'title';
		$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
	break;
}

switch ( $show ) {
	case 'featured' :
		$args['meta_query'][] = array(
			'key'   => '_featured',
			'value' => 'yes'
		);
	break;
	case 'onsale' :
		$product_ids_on_sale   = wc_get_product_ids_on_sale();
		$product_ids_on_sale[] = 0;
		$args['post__in']      = $product_ids_on_sale;
	break;
}

$products_query = new WP_Query( $args );

if( !$products_query->have_posts() ) {
	return '';
}

?>
<div class="ld-bsp-carousel">
	<div class="carousel-container carousel-dots-style2">
		<div class="carousel-items row mx-0" data-lqd-flickity='{ "imagesLoaded": true, "adaptiveHeight": true, "prevNextButtons": true, "navArrow": {
			"prev": "<i class=\"fa fa-angle-left\"></i>",
			"next": "<i class=\"fa fa-angle-right\"></i>"
			} }'>
			<?php

				$posts_sz = count( $products_query->posts );
				if( $limit > $posts_sz ) {
					$all = $posts_sz;
				} else {
					$all = $limit;
				}
			?>
			<?php $i = $last = 0; ?>
			<?php

				while ( $products_query->have_posts() ) :

					$products_query->the_post(); $i++; $last++;
					$product = new WC_Product( get_the_ID() );
			?>		
			<?php

				if( $i == 1 ) { 
					echo '<div class="carousel-item px-0 col-xs-12">';
				}
			?>
			<?php
					if( function_exists( 'wc_get_template' ) ) { 
						wc_get_template( 'content-product-widget.php' );			
					}
			?>
			<?php

				if( $i == 2 || $last == $all ) { 
					echo '</div>'; 
					$i = 0;				
				} 

			?>
			<?php
				endwhile; // end of the loop.
				
				wp_reset_postdata();
					
				remove_filter('posts_clauses', 'liquid_woocommerce_order_by_popularity_post_clauses');
				remove_filter('posts_clauses', 'liquid_woocommerce_order_by_rating_post_clauses');

			?>
		</div><!-- /.carousel-items row -->
	</div><!-- /.carousel-container -->
</div><!-- /.ld-bsp-carousel -->