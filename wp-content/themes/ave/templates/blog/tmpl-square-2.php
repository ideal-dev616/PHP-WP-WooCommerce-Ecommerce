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
<div class="liquid-blog-item-inner">

	<a href="<?php the_permalink(); ?>" class="liquid-overlay-link"><?php the_title(); ?></a>

	<?php if( 1 === $i ) { ?>	
	<header class="liquid-lp-header mb-2 mt-auto">
		<div class="liquid-lp-details mb-3">
			<?php
				$time_string = '<time class="published updated liquid-lp-date" datetime="%1$s">%2$s</time>';
				printf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
			?>
			<?php $this->entry_tags( 'bg-primary' ) ?>
		</div><!-- /.liquid-lp-details -->
		<h2 class="liquid-lp-title font-weight-bold h3 mb-0" data-fittext="true" data-fittext-options='{ "maxFontSize": "36", "minFontSize": "20" }'>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
	</header>
	<?php } else { ?>
	<header class="liquid-lp-header mt-auto">
		<div class="liquid-lp-details mb-3">
			<?php $this->entry_tags() ?>
		</div><!-- /.liquid-lp-details -->
		<h2 class="liquid-lp-title font-weight-bold h3 mb-0" data-fittext="true" data-fittext-options='{ "maxFontSize": "20", "minFontSize": "18" }'>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
	</header>
	<?php } ?>
	
	<?php if( 1 === $i ) { $this->entry_content(); } ?>

</div><!-- /.liquid-blog-item-inner -->
