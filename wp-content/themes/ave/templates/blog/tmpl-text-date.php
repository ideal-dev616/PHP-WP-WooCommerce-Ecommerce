<?php

$format = get_post_format();
	
if( 'link' !== $format ) {
	$time_string = '<time class="entry-date published updated liquid-lp-date" datetime="%1$s"><span>%2$s</span> %3$s</time>';
	printf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date( 'd' ),
		get_the_date( 'M' )
	);
}
?>
<header class="liquid-lp-header">
	<?php $this->entry_title( 'h5' ); ?>
</header>

<?php $this->entry_content(); ?>

<footer class="liquid-lp-footer">

	<div class="liquid-lp-meta">

		<?php $this->entry_author(); ?>
		<?php $this->entry_tags( 'size-sm' ) ?>

	</div><!-- /.liquid-lp-meta -->

</footer>