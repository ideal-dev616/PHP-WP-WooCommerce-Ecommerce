<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
 
global $post; 

?>

<article <?php liquid_helper()->attr( 'post' ) ?>>

	<?php if( '' !== get_the_post_thumbnail() ) : ?>
	<figure class="post-image hmedia liquid-lp-media w-auto">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	</figure>
	<?php endif; ?>

	<?php if( is_singular() ) : ?>

		<header class="entry-header">

			<?php the_title( '<h1 '. liquid_helper()->get_attr( 'entry-title' ) .'>', '</h1>' ); ?>

			<?php get_template_part( 'templates/entry', 'meta' ) ?>

		</header>

		<div <?php liquid_helper()->attr( 'entry-content' ) ?>>
			<?php
				the_content( sprintf(
					esc_html__( 'Continue reading %s', 'ave' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
					) );

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'ave' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'ave' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
		</div>

		<footer class="entry-footer liquid-lp-footer  d-flex flex-row flex-wrap">

			<?php liquid_post_terms( array( 'taxonomy' => 'category', 'text' => esc_html__( 'Posted in: %s', 'ave' ) ) ); ?>
			<?php liquid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => esc_html__( 'Tagged: %s', 'ave' ), 'before' => ' | ' ) ); ?>

		</footer><!-- .entry-footer -->

	<?php else: ?>

		<header class="entry-header liquid-lp-header">

			<?php the_title( sprintf( '<h2 %s><a href="%s" rel="bookmark">', liquid_helper()->get_attr( 'entry-title' ), esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php get_template_part( 'templates/entry', 'meta' ) ?>

		</header>

		<div <?php liquid_helper()->attr( 'entry-summary' ) ?>>			
			<?php 

				$page_content = apply_filters( 'the_content', $post->post_content );
				if ( strpos( $post->post_content, '<!--more-->' ) ) : 
				echo substr( $page_content, 0, strpos( $page_content, "<!--more-->") );
			
			?>
			<?php else: ?>
		
			<?php the_excerpt() ?>

			<?php endif; ?>

		</div><!-- .entry-content -->
		
		<footer class="entry-footer liquid-lp-footer">
			<?php 

				$page_content = apply_filters( 'the_content', $post->post_content );
				if ( strpos( $post->post_content, '<!--more-->' ) ) {
			?>
			<a href="<?php the_permalink() ?>" class="btn btn-naked text-uppercase ltr-sp-1 size-sm font-weight-bold liquid-lp-read-more">
				<span>
					<span class="btn-line btn-line-before"></span>
					<span class="btn-txt"><?php esc_html_e( 'Continue Reading', 'ave' ) ?></span>
					<span class="btn-line btn-line-after"></span>
				</span>
			</a>
			<?php } ?>

		</footer><!-- .entry-footer -->

	<?php endif; ?>

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'templates/author', 'bio' );
		endif;
	?>

</article><!-- #post-## -->