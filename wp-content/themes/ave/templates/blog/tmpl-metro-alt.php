<?php
$this->generate_post_css();
$featured = get_post_meta( get_the_ID(), 'post-metro-featured', true );
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
	if( 'featured' !== $featured && 'instagram' !== $featured ) {
		$this->entry_thumbnail( 'liquid-metro-blog', array(), true );
	}
	else {
		$this->entry_thumbnail( 'liquid-split-blog', array(), true );
	}	
}
?>

<div class="liquid-lp-inner">

	<?php $this->overlay_link(); ?>

	<?php if( 'instagram' === $featured ) { ?>
		<a href="<?php the_permalink() ?>" class="liquid-overlay-link"></a>
	<?php } ?>
	
	<header class="liquid-lp-header">
	<?php if( 'instagram' === $featured ) { ?>
		<span class="liquid-lp-extra-icon">
			<a href="<?php the_permalink() ?>"><i class="fa fa-instagram"></i></a>
		</span>
		<?php $this->entry_tags( 'bordered square' ) ?>
	<?php } else { ?> 
		<?php $this->entry_tags( 'bordered square' ) ?>
		<?php $this->entry_title( 'liquid-lp-title h4 font-weight-bold' ); ?>
	<?php } ?>
	</header>
	
	<?php if( 'instagram' === $featured ) { ?>	
		<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
	<?php } ?>

	<?php
		if( 'featured' !== $featured && 'instagram' !== $featured ) {
			$this->entry_content();	
		}
	?>
	
	<?php if( 'instagram' !== $featured ) { ?>
	<footer class="liquid-lp-footer">
		<?php
		$time_string = '<time class="published updated liquid-lp-date text-uppercase ltr-sp-1" datetime="%1$s">%2$s</time>';
		printf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		);
	?>
	</footer>
	<?php } ?>

</div><!-- /.liquid-lp-inner -->
