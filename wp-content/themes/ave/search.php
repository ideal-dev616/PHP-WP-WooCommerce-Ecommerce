<?php 
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Ave
 * @since 1.0
 */

get_header();

	if( have_posts() ) :
	
	?>
	
	<div class="row">
		
	<?php // Start the Loop.	
		while ( have_posts() ) : the_post();
		?>
		<div class="col-md-4 col-xs-12">
		<?php get_template_part( 'templates/blog/content', 'excerpt' ); ?>
		</div>
		<?php endwhile; // End of the loop. ?>
		<?php
		// Set up paginated links.
	    $links = paginate_links( array(
			'type' => 'array',
			'prev_next' => true,
			'prev_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-left"></i>', 'ave' ) ) . '</span>',
			'next_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-right"></i>', 'ave' ) ) . '</span>'
		));
	
		if( !empty( $links ) ) {
	
			printf( '<div class="blog-nav"><nav aria-label="' . esc_attr__( 'Page navigation', 'ave' ) . '"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
		}; ?>
		
	</div>

	<?php else : // If no posts were found.

		get_template_part( 'templates/content/error' );

	endif;

get_footer();