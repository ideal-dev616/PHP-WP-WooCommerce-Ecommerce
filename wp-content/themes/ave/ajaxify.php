<?php
/**
 * The template for displaying the header
 *
 * @package Ave
 */

while ( have_posts() ) : the_post();

	the_content();

endwhile;
