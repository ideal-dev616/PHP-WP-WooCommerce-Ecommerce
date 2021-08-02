<?php
/**
 * The template for displaying pages
 *
 * @package Ave theme
 */

get_header();

	while ( have_posts() ) : the_post();

		liquid_get_content_template();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;

get_footer();
