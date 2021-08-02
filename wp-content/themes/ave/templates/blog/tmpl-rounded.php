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
	$this->entry_thumbnail( 'liquid-rounded-blog' );
}
?>

<header class="liquid-lp-header">
	<?php $this->entry_tags(); ?>
	<?php $this->entry_title( 'h5' ); ?>
	<time class="liquid-lp-date font-style-italic size-lg" datetime="<?php echo get_the_date( 'c' ); ?>"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'ave' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
</header>