<article <?php liquid_helper()->attr( 'post', array( 'class' => 'blog-single' ) ) ?>>	
			
	<?php do_action( 'liquid_start_single_post_container' ); ?>

		<div class="blog-single-content blog-single-custom entry-content">
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

	<?php get_template_part( 'templates/blog/single/part', 'author' ) ?>		
	<div class="container">
		<?php liquid_render_post_nav() ?>
	</div>
	<?php do_action( 'liquid_end_single_post_container' ); ?>

	<?php do_action( 'liquid_single_post_sidebar' ); ?>
	
	<?php liquid_render_related_posts( get_post_type() ) ?>

	<?php

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; 
		
	?>

</article><!-- /.blog-single -->