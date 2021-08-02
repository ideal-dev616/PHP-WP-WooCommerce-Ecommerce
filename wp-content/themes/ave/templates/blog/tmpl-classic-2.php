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
	$this->entry_thumbnail( 'liquid-classic-meta-blog' );
}
?>

<header class="liquid-lp-header">
	<?php $this->entry_title( 'h4' ); ?>
</header>

<?php $this->entry_content(); ?>

<footer class="liquid-lp-footer">
	<a href="<?php the_permalink() ?>" class="btn btn-naked text-uppercase font-weight-bold liquid-lp-read-more">
		<span>
			<span class="btn-txt"><?php esc_html_e( 'Read more', 'ave' ) ?></span>
		</span>
	</a>
</footer>