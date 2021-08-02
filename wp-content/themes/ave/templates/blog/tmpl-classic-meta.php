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
	$this->entry_thumbnail( 'liquid-classic-2-blog' );
}
?>

<header class="liquid-lp-header">
	<?php $this->entry_title( 'h4' ); ?>
	<?php
		$time_string = '<time class="published updated liquid-lp-date text-uppercase ltr-sp-1" datetime="%1$s">%2$s</time>';
		printf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		);
	?>
</header>

<?php $this->entry_content(); ?>

<footer class="liquid-lp-footer">
	<a href="<?php the_permalink() ?>" class="btn btn-underlined text-uppercase liquid-lp-read-more">
		<span>
			<span class="btn-txt"><?php esc_html_e( 'Continue Reading', 'ave' ) ?></span>
		</span>
	</a>
</footer>

