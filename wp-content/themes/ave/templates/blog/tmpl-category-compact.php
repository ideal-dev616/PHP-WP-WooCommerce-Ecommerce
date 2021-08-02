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
	$this->entry_thumbnail( 'liquid-category-blog', array(), true );
}

?>

<div class="liquid-blog-item-inner">
	
	<a href="<?php the_permalink(); ?>" class="liquid-overlay-link"><?php the_title(); ?></a>
	
	<header class="liquid-lp-header">
		<h2 class="liquid-lp-title h5">
			<a href="<?php the_permalink(); ?>" data-split-text="text" data-split-options='{ "type": "lines" }'><?php the_title(); ?></a>
		</h2>
		<time class="liquid-lp-date" datetime="<?php echo get_the_date( 'c' ); ?>"><i class="fa fa-clock-o mr-2"></i><?php printf( _x( '%s ago', '%s = human-readable time difference', 'ave' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
	</header>
	
</div><!-- /.liquid-blog-item-inner -->
