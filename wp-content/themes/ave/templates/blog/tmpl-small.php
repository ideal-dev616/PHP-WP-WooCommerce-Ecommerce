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
?>	
<figure class="liquid-lp-media mb-0">
	<a href="<?php the_permalink(); ?>">
		<?php liquid_the_post_thumbnail( 'liquid-category-blog' ); ?>
	</a>
</figure>
<?php } ?>

<header class="liquid-lp-header pl-3">
	<h2 class="liquid-lp-title size-xsm font-weight-normal"><a href="#"><?php the_title(); ?></a></h2>
	<?php
		$time_string = '<time class="published updated liquid-lp-date mt-0 text-uppercase size-sm" datetime="%1$s">%2$s</time>';
		printf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		);
	?>
</header>

<a href="<?php the_permalink(); ?>" class="liquid-overlay-link"><?php the_title(); ?></a>
	
