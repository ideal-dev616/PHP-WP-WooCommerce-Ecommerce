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
<figure class="liquid-lp-media">
	<a href="<?php the_permalink(); ?>">
		<?php liquid_the_post_thumbnail( 'liquid-category-blog' ); ?>
	</a>
	<div class="liquid-lp-details size-sm m-0 ld-overlay pos-abs d-flex flex-wrap align-items-end">
		<?php $this->entry_tags( 'solid bg-primary' ) ?>
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="byline url fn n solid">
			<span class="screen-reader-text"><?php esc_html_e( 'Author:', 'ave' ); ?></span>
			<span class="author vcard"><?php echo get_the_author(); ?></span>
		</a>

	</div><!-- /.liquid-lp-details -->
</figure>
<?php } ?>

<div class="liquid-blog-item-inner">
	
	<a href="<?php the_permalink(); ?>" class="liquid-overlay-link"><?php the_title(); ?></a>
	
	<header class="liquid-lp-header">
		<h2 class="liquid-lp-title h4">
			<a href="<?php the_permalink(); ?>" data-split-text="text" data-split-options='{ "type": "lines" }'><?php the_title(); ?></a>
		</h2>
		<time class="liquid-lp-date font-weight-bold text-uppercase" datetime="<?php echo get_the_date( 'c' ); ?>"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'ave' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
	</header>
	
	<?php $this->entry_content(); ?>
	
</div><!-- /.liquid-blog-item-inner -->