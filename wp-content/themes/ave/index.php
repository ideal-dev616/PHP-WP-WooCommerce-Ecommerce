<?php
/**
 * The main template file
 *
 * @package Ave theme
 */

get_header();

	if( have_posts() ) :

		get_template_part( 'templates/blog', 'layout' );

	else : // If no posts were found.

		get_template_part( 'templates/content/error' );

	endif;

get_footer();
