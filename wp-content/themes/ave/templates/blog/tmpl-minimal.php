<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
<div class="liquid-blog-item-inner">

	<a href="<?php the_permalink()?>" class="liquid-overlay-link"><?php the_title() ?></a>

	<header class="liquid-lp-header">
		<h2 class="liquid-lp-title font-weight-normal mb-1">
			<a href="<?php the_permalink()?>"><?php the_title() ?></a>
		</h2>
	</header>

	<?php $this->entry_content(); ?>

	<footer class="liquid-lp-footer">
		<div class="ld-post-author">

			<figure>
				<?php echo get_avatar( get_the_author_meta( 'ID' ), '50', get_option( 'avatar_default', 'mystery' ), get_the_author(), array( 'class' => 'circle' ) ); ?> 
			</figure>


			<div class="ld-author-info">

				<time class="liquid-lp-date text-uppercase ltr-sp-1 my-0" datetime="<?php echo get_the_date( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
				<h5 class="text-uppercase ltr-sp-2 my-0"><?php echo get_the_author(); ?></h5>

			</div><!-- /.ld-author-info -->
		</div>
	</footer>

</div><!-- /.liquid-blog-item-inner -->
