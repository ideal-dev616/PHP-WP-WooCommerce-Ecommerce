<?php

$style = $atts['style'];
$filter_id = $atts['filter_id'];

// check
$located = locate_template( "templates/blog/tmpl-$style.php" );
if ( ! file_exists( $located ) ) {
	return;
}

// The CSS
$this->generate_css();

// Enqueue Conditional Script
$this->scripts();

echo '<div class="liquid-blog-posts ' . $this->get_id() . '">';
echo '<div class="carousel-container carousel-nav-floated carousel-nav-vertical carousel-nav-left carousel-nav-circle carousel-nav-solid carousel-nav-lg carousel-nav-shadowed ld-lp-carousel-filterable" data-filterable-carousel="true">';
echo '<div class="row">';

// Include filter
if( 'yes' === $atts['enable_filter'] ) {
	$filter_located = locate_template( 'templates/blog/partial-filters-carousel.php' );
	include $filter_located;
	echo '<div class="col-md-7">';	
} else {
	echo '<div class="col-md-12">';
}

// Build Query
$GLOBALS['wp_query'] = new WP_Query( $this->build_query() );		
	echo '<div class="carousel-items row" data-lqd-flickity=\'{ "filters": "#' . $filter_id . '", "prevNextButtons": true, "wrapAround": false, "navArrow": 1, "fullwidthSide": true, "navOffsets": { "nav": {"left": -10, "top": 200} } }\'>';

	$after  = '</div>';

	while( have_posts() ): the_post();
	
		$post_classes = array( 'liquid-lp' );
		$post_classes = join( ' ', get_post_class( $post_classes, get_the_ID() ) );

		$attributes = array(
			'id'    => 'post-' . get_the_ID(),
			'class' => $post_classes
		);
		$post_width_meta = get_post_meta( get_the_ID(), 'post-carousel-width', true );
		$post_width = !empty( $post_width_meta ) ? $post_width_meta : '12';
		$before = '<div class="carousel-item col-sm-' . $post_width . ' ' . $this->entry_term_classes() . '">';
		echo $before;
		
		printf( '<article%s>', ld_helper()->html_attributes( $attributes ) );

			if( 'quote' === get_post_format() ) {
				$quote_located = locate_template( 'templates/blog/format-quote.php' );
				include $quote_located;
			}
			else {
				include $located;
			}
		echo '</article>';
		echo $after;
	endwhile;

	echo '</div></div></div><!--/ .row -->';

wp_reset_query();

echo '</div><!--/ .liquid-blog-posts -->';