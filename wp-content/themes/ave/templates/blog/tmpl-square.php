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
	$this->entry_thumbnail( 'liquid-square-blog', array(), true );
}

?>

<div class="liquid-blog-item-inner round">

	<a href="<?php the_permalink()?>" class="liquid-overlay-link"><?php the_title() ?></a>

	<header class="liquid-lp-header mt-auto">
		<div class="liquid-lp-details">
			<?php $this->entry_tags( 'liquid-lp-category text-uppercase ltr-sp-175 font-weight-bold' ) ?>
		</div><!-- /.liquid-lp-details -->
		<h2 class="liquid-lp-title font-weight-bold h3 mb-0">
			<a href="<?php the_permalink()?>"><?php the_title() ?></a>
		</h2>
	</header>

</div><!-- /.liquid-blog-item-inner -->