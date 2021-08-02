<?php
	$format = get_post_format();
	$size = get_post_meta( get_the_ID(), 'liquid-post-height', true );
	$size = isset( $size ) ? $size : 'short';
	$this->entry_thumbnail( "liquid-masonry-$size", array(), true );
?>
<div class="liquid-blog-item-inner">
	<?php $this->overlay_link(); ?>
	<header class="liquid-lp-header">
		<div class="liquid-lp-details">
			<?php $this->entry_tags( 'liquid-lp-category-filled' ) ?>
		</div><!-- /.liquid-lp-details -->
		<?php $this->entry_title( 'size-sm font-weight-bold h3 liquid-lp-title-clone' ); ?>
	</header>
	
	<footer class="liquid-lp-footer">
		<?php $this->entry_title( 'size-sm font-weight-bold h3 liquid-lp-title-original' ); ?>
		<a href="<?php the_permalink(); ?>" class="btn btn-naked text-uppercase ltr-sp-1 size-sm font-weight-bold liquid-lp-read-more">
			<span>
				<span class="btn-line btn-line-before"></span>
				<span class="btn-txt"><?php esc_html_e( 'Continue Reading', 'ave' ); ?></span>
				<span class="btn-line btn-line-after"></span>
			</span>
		</a>
	</footer>

</div><!-- /.liquid-blog-item-inner -->

