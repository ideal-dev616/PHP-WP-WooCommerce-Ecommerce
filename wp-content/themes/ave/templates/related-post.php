<?php

//get value from options
$related_style = liquid_helper()->get_option( 'post-related-style' );
$col = '3';
if( '2' === $number_of_posts ) {
	$col = '6';
}
elseif( '3' === $number_of_posts ) {
	$col = '4';
}

?>
<div class="related-posts">

	<?php if( 'cover' === $related_style ) : ?>
	
		<div class="row">
			
			<?php if( !empty( $heading ) ) { ?>
				<div class="col-md-12">
					<h3 class="related-posts-title text-left"><?php echo esc_html( $heading ) ?></h3>
				</div><!-- /.col-md-12 -->
			<?php } ?>
			
			<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
				<div class="col-md-<?php echo esc_attr( $col ) ?> col-sm-12">
					
					<article class="related-post related-post-alt">

						<a href="<?php the_permalink() ?>" class="liquid-overlay-link"></a>
						<?php $thumb_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'liquid-rounded-blog' ); ?>
						<figure class="related-post-image" data-responsive-bg="true">
							<?php liquid_the_post_thumbnail( 'liquid-rounded-blog', '', false ); ?>
						</figure><!-- /.related-post-image -->
						<header class="related-post-header">
							<div class="related-post-date">
							<?php
								$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';
								printf( $time_string,
									esc_attr( get_the_date( 'c' ) ),
									get_the_date()
								);
							?>
							</div><!-- /.related-post-date -->
							<?php the_title( sprintf( '<h2 class="related-post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
						</header>

					</article><!-- /.related-post -->
					
				</div><!-- /.col-md-6 col-sm-12 -->
			<?php endwhile; ?>
			
		</div><!-- /.row -->
						
	<?php else : ?>
	
		<div class="container">
			<div class="row">

			<?php if( !empty( $heading ) ) { ?>	
				<div class="col-md-12">
					<h3 class="related-posts-title"><?php echo esc_html( $heading ) ?></h3>
				</div><!-- /.col-md-12 -->
			<?php } ?>

			<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
				<div class="col-lg-<?php echo esc_attr( $col ) ?> col-md-6 col-sm-12">
	
					<article class="related-post">
						<a href="<?php the_permalink() ?>" class="liquid-overlay-link"></a>

						<figure class="related-post-image">
							<?php liquid_the_post_thumbnail( 'liquid-rounded-blog', '', false ); ?>
						</figure><!-- /.related-post-image -->

						<header class="related-post-header">
							<?php the_title( sprintf( '<h2 class="related-post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
							<ul class="related-post-categories">
								<li><?php echo liquid_get_category(); ?></li>
							</ul>
						</header>

					</article><!-- /.related-post -->
		
				</div><!-- /.col-lg-3 col-md-6 col-sm-12 -->
			<?php endwhile; ?>
	
			</div><!-- /.row -->
		</div><!-- /.container -->
	
	<?php endif; ?>

</div><!-- /.related-posts -->
<?php wp_reset_postdata();