<?php
extract( $atts );

$classes = array( 
	$this->get_classes( $style ), 
	$this->get_fill_bg_classname(),
	$align,
	$details_size,
	$avatar_size,
	$this->get_avatar_position(), 
	$this->get_shadow(),
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<div class="testimonial-quote">
		<?php $this->get_quote(); ?>
	</div><!-- /.testimonial-qoute -->

	<div class="testimonial-details">
		<?php $this->get_avatar() ?>
		<div class="testimonial-info">
			<?php $this->get_name() ?>
			<?php $this->get_position() ?>
		</div><!-- /.testimonial-info -->
		<?php $this->get_rating() ?>

	<?php if ( 'testi_s05' === $style ) { ?>
		<?php $this->get_time( 'text-uppercase' ); ?>
	<?php } ?>

	</div><!-- /.testimonial-details -->
	<?php if ( 'testi_s05' !== $style ) { ?>
		<?php $this->get_time( 'text-uppercase' ); ?>
	<?php } ?>

</div><!-- /.testimonial -->