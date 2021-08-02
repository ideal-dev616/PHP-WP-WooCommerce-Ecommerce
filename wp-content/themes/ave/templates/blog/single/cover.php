<div class="blog-single-cover scheme-light" data-fullheight="true" data-inview="true" data-inview-options='{ "onImagesLoaded": true }' style="background-color: #666871;">
		
	<?php get_template_part( 'templates/blog/single/part', 'media' ) ?>

	<div class="blog-single-details">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					
					<header class="entry-header blog-single-header" data-parallax="true" data-parallax-to='{ "opacity": 0, "translateY": "30%" }' data-parallax-options='{ "triggerHook": "0.3" }'>
						
						<?php the_title( '<h1 class="blog-single-title entry-title h2" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>', '</h1>' ); ?>

						<?php get_template_part( 'templates/blog/single/part', 'meta' ) ?>

						<?php get_template_part( 'templates/blog/single/part', 'video-button' ); ?>
						<div class="blog-single-details-extra"></div><!-- /.blog-single-details-extra -->

					</header><!-- /.blog-single-header -->


				</div><!-- /.col-md-6 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.blog-single-details -->
	
</div><!-- /.blog-single-cover -->

<article <?php liquid_helper()->attr( 'post', array( 'class' => 'blog-single' ) ) ?>>
	<div class="container">
		<div class="row">

			<?php do_action( 'liquid_start_single_post_container' ); ?>

				<div class="blog-single-content entry-content pull-up expanded">
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