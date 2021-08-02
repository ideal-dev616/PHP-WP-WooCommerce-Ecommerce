<?php

/**
 *
 * Walker Category
 * @since 1.0.0
 * @version 1.1.0
 *
 */
class Liquid_Walker_Portfolio_List_Categories extends Walker_Category {

	function start_el( &$output, $category, $depth = 0, $args = array(), $current_object_id = 0 ) {

		$has_children = get_term_children( $category->term_id, 'liquid-portfolio-category' );

		if( empty( $has_children ) ) {
			$cat_name = apply_filters( 'list_cats', esc_attr( $category->name ), $category );
			$output  .= sprintf(
				'<li data-filter=".portfolio_cat-%1$s"><span>%2$s</span></li>' . "\n",
				strtolower( $category->term_id ), $cat_name
			);
		}
	}
}

/**
 *
 * Walker Product Category
 * @since 1.0.0
 * @version 1.1.0
 *
 */
class Liquid_Walker_Products_List_Categories extends Walker_Category {

	function start_el( &$output, $category, $depth = 0, $args = array(), $current_object_id = 0 ) {

		$has_children = get_term_children( $category->term_id, 'product_cat' );

		if( empty( $has_children ) ) {
			$cat_name = apply_filters( 'list_cats', esc_attr( $category->name ), $category );
			$output  .= sprintf(
				'<li data-filter=".product_cat-%1$s"><span>%2$s</span></li>' . "\n",
				strtolower( $category->slug ), $cat_name
			);
		}
	}
}