<article <?php liquid_helper()->attr( 'post', array( 'class' => 'blog-single' ) ) ?>>	

	<div class="container">
		
		<div class="row">
			
			<?php do_action( 'liquid_start_single_post_container' ); ?>
					
			<?php get_template_part( 'templates/blog/single/part', 'media' ) ?>				
				
				<div class="blog-single-details">
									
					<header class="entry-header blog-single-header">
						
						<?php the_title( '<h1 class="blog-single-title entry-title h2">', '</h1>' ) ?>

						<?php get_template_part( 'templates/blog/single/part', 'meta' ) ?>

						<?php get_template_part( 'templates/blog/single/part', 'extra' ) ?>

					</header><!-- /.blog-single-header -->

				</div><!-- /.blog-single-details -->

				<div class="blog-single-content entry-content">
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
				</div><!-- /.blog-single-content entry-content -->
				
				<footer class="blog-single-footer entry-footer">
				<?php the_tags( '<span class="tags-links">', esc_html_x( ' ', 'Used between list items, there is a space', 'ave' ), '</span>' ); ?>
				<?php if( function_exists( 'liquid_portfolio_share' ) ) : ?>
					<?php liquid_portfolio_share( get_post_type(), array(
						'class' => 'social-icon circle branded social-icon-sm',
						'before' => '<span class="share-links"><span class="text-uppercase ltr-sp-1">'. esc_html__( 'Share On', 'ave' ) .'</span>',
						'after' => '</span>'
					) ); ?>
				<?php endif; ?>
				</footer><!-- /.blog-single-footer entry-footer -->
				
				<?php get_template_part( 'templates/blog/single/part', 'author' ) ?>
				<?php liquid_render_post_nav() ?>
			
			<?php do_action( 'liquid_end_single_post_container' ); ?>

			<?php do_action( 'liquid_single_post_sidebar' ); ?>
			
		</div><!-- /.row -->
	</div><!-- /.container -->

	<?php liquid_render_related_posts( get_post_type() ) ?>	
	<?php

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; 
		
	?>

</article><!-- /.blog-single -->