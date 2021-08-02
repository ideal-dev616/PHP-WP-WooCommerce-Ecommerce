<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
 
global $post;
$enable = liquid_helper()->get_option( 'title-bar-enable', 'raw', '' );

?>

<article <?php liquid_helper()->attr( 'post' ) ?>>

		<?php if( 'on' !== $enable ) { ?>
		<header class="entry-header">

			<?php the_title( '<h1 '. liquid_helper()->get_attr( 'entry-title' ) .'>', '</h1>' ); ?>

			<?php get_template_part( 'templates/entry', 'meta' ) ?>

		</header>
		<?php } ?>

		<div <?php liquid_helper()->attr( 'entry-content' ) ?>>
			<?php the_content();?>
		</div>

</article><!-- #post-## -->