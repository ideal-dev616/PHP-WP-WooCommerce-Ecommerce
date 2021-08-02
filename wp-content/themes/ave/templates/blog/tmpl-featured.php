<?php

$format = get_post_format();

if( 'audio' === $format ) {
	$this->entry_thumbnail();
}
elseif( 'video' === $format ) {
?>
<div class="post-video">
	<?php $this->entry_thumbnail() ?>
	<?php $this->entry_tags() ?>
</div>
<?php
}
elseif( 'link' !== $format ) {
	$this->entry_thumbnail( 'liquid-featured-blog' );
}
?>
<?php $this->overlay_link(); ?>
<header class="liquid-lp-header">
	<?php $this->entry_title( 'h4' ); ?>
	<?php
		$time_string = '<time class="published updated liquid-lp-date text-uppercase size-sm" datetime="%1$s">%2$s</time>';
		printf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		);
	?>
</header>

<?php $this->entry_content(); ?>

<footer class="liquid-lp-footer">
	<a href="<?php the_permalink() ?>" class="btn btn-naked liquid-lp-read-more text-uppercase">
		<span>
			<span class="btn-txt"><?php esc_html_e( 'Read more', 'ave' ) ?></span>
			<span class="btn-icon">
				<i class="fa fa-long-arrow-right"></i>
			</span>
		</span>
	</a>
</footer>