<?php
	
// Enqueue Conditional Script


$style = $atts['style'];

// Locate the template and check if exists.
$located = locate_template( array(
	"templates/portfolio/tmpl-$style.php"
) );
if ( ! $located ) {
	return;
}

// Build Query and check for posts
$the_query = new WP_Query( $this->build_query() );
if( !$the_query->have_posts() ) {
	return;
}

$this->grid_id = $grid_id = uniqid( 'grid-');

// Enqueue Conditional Script
$this->scripts();

// The CSS
$this->generate_css();

//Container 

echo '<div class="carousel-container carousel-nav-circle carousel-nav-bordered carousel-nav-sm ' . $this->get_id() . '" data-filterable-carousel="true"><div class="row"><div class="col-xs-12">';
	echo '<div class="carousel-items row" data-lqd-flickity=\'{ "fullwidthSide": true }\'>';

	// Build Query
	$GLOBALS['wp_query'] = $the_query;
	$before = $after = '';

	$this->add_excerpt_hooks();

	while( have_posts() ): the_post();

		$post_classes = array( 'ld-pf-item', $this->get_item_classes() );		
		$post_classes = join( ' ', get_post_class( $post_classes, get_the_ID() ) );

		$attributes = array(
			'id' => 'post-' . get_the_ID(),
			'class' => $post_classes
		);

		echo $before;

			include $located;

		echo $after;

	endwhile;

	$this->remove_excerpt_hooks();

	wp_reset_query();

	echo '</div><!-- /.carousel-item -->';
echo '</div></div></div><!-- /.carousel-container -->';