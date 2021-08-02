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
	$this->entry_thumbnail( 'liquid-classic-full-blog' );
}
?>

<div class="liquid-blog-item-inner">
	
	<a href="<?php the_permalink() ?>" class="liquid-overlay-link"><?php the_title() ?></a>

	<header class="liquid-lp-header">

		<h2 class="liquid-lp-title font-weight-bold h3 size-sm">
			<a href="<?php the_permalink() ?>" data-split-text="true" data-split-options='{ "type": "lines" }'><?php the_title(); ?></a>
		</h2>

		<div class="liquid-lp-details">
			<time class="liquid-lp-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'ave' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
			<?php esc_html_e( 'in', 'ave' ); ?>
			<?php $this->entry_tags(); ?>
		</div><!-- /.liquid-lp-details -->

	</header>
	
	<?php $this->entry_content(); ?>
	
	<footer class="liquid-lp-footer">
		<a href="<?php the_permalink() ?>" class="btn btn-naked text-uppercase ltr-sp-1 size-sm font-weight-bold liquid-lp-read-more">
			<span>
				<span class="btn-line btn-line-before"></span>
				<span class="btn-txt"><?php esc_html_e( 'Continue Reading', 'ave' ) ?></span>
				<span class="btn-line btn-line-after"></span>
			</span>
		</a>
	</footer>
	
</div><!-- /.liquid-blog-item-inner -->
