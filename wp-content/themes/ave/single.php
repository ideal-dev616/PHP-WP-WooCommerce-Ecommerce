<?php
/**
 * The template for displaying all single posts.
 *
 * @package Ave
 */

get_header();

	while ( have_posts() ) : the_post();
		
		//get value from options
		$style = liquid_helper()->get_option( 'post-style', 'cover-spaced' );
		
		//if empty style get default
		if( !$style ) {
			$style = 'cover-spaced';
		}

		$format = get_post_format();
		if( 'video' === $format && class_exists( 'ReduxFramework' ) ){
			$style = 'cover';
		}
		elseif( 'audio' === $format && class_exists( 'ReduxFramework' ) ){
			$style = 'minimal';
		}
		get_template_part( 'templates/blog/single/' . $style );

	endwhile;

get_footer();