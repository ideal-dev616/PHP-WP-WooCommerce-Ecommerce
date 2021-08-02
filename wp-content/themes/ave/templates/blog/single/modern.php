<?php

$text = liquid_helper()->get_option( 'post-extra-text' );
	
?>
<div class="blog-single-details">

	<div class="blog-single-cover-bg">
		<svg fill="#F3F6FA" xmlns="http://www.w3.org/2000/svg" width="1440" height="750" viewBox="0 0 1440 750" preserveAspectRatio="none">
			<path d="M0,59 L0,676.474354 C0,676.474354 252.696058,466.245028 572.042187,517.808554 C891.388316,569.37208 1071.97409,872.834039 1420.09555,796.862473 C1768.21701,720.890907 1925,517.808554 1925,517.808554 L1925,59 L0,59 Z" transform="translate(-243 -59)"/>
		</svg>			
	</div><!-- /.blog-single-cover-bg -->
	
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				
				<header class="entry-header blog-single-header">
					<span class="cat-links">
						<span class="screen-reader-text"><?php esc_html_e( 'Published on:', 'ave' ); ?></span>
						<?php liquid_get_category(); ?>
					</span>
					
					<?php the_title( '<h1 class="blog-single-title entry-title h2" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>', '</h1>' ); ?>
					
					<?php if( !empty( $text ) )  { ?>
						<?php echo do_shortcode( wp_kses_post( $text ) ); ?>
					<?php } ?>
					
					<div class="post-meta">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="byline url fn n">
							<span class="screen-reader-text"><?php esc_html_e( 'Author:', 'ave' ); ?></span>
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80, null, null, array('class' => array('circle' ) ) ); ?>
							<span class="author vcard"><?php echo get_the_author(); ?></span>
						</a>
					</div><!-- /.post-meta -->
					
				</header><!-- /.blog-single-header -->
				
			</div><!-- /.col-md-8 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
	
	<div class="blog-single-cover border-radius-10" data-inview="true" data-inview-options='{ "onImagesLoaded": true }' style="background-color: #666871;">
		<?php get_template_part( 'templates/blog/single/part', 'media' ) ?>
	</div><!-- /.blog-single-cover -->
	
</div><!-- /.blog-single-details -->

<article class="blog-single">
	
	<div class="container">
		
		<div class="row">
			
			<?php do_action( 'liquid_start_single_post_container' ); ?>
				
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