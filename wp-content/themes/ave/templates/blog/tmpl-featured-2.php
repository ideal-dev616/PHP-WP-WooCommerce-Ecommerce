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
	$this->entry_thumbnail( 'liquid-featured-blog', null, true );
}
?>

<div class="liquid-blog-item-inner">
	
	<a href="<?php the_permalink(); ?>" class="liquid-overlay-link"><?php the_title(); ?></a>

	<header class="liquid-lp-header">

		<div class="liquid-lp-details size-sm d-flex flex-wrap align-items-center">
			<?php $this->entry_tags( 'solid' ) ?>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="byline url fn n solid bg-primary">
				<span class="screen-reader-text"><?php esc_html_e( 'Author:', 'ave' ); ?></span>
				<span class="author vcard"><?php echo get_the_author(); ?></span>
			</a>

		</div><!-- /.liquid-lp-details -->

		<h2 class="liquid-lp-title h3 solid" data-fittext="true" data-fittext-options='{ "compressor": 1.25, "maxFontSize": "currentFontSize" }'>
			<a href="<?php the_permalink(); ?>" data-split-text="text" data-split-options='{ "type": "lines" }'><?php the_title(); ?></a>
		</h2>

	</header>
	
</div><!-- /.liquid-blog-item-inner -->
