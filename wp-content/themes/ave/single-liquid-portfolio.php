<?php
/**
 * The template for displaying all single posts.
 *
 * @package Ave
 */
get_header();

	while ( have_posts() ) : the_post();

		$style = get_post_meta( get_the_ID(), 'portfolio-style', true );
		$style = $style ? $style : 'default';
		?>
		<article <?php liquid_helper()->attr( 'post' ) ?>>
			<?php get_template_part( 'templates/portfolio/single/' . $style ); ?>
		</article><!-- #post-## -->
		<?php

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;

get_footer();
