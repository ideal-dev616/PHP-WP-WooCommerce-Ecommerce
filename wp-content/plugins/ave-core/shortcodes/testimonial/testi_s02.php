<?php
extract( $atts );

$classes = array( 
	$this->get_classes( $style ), 
	$align,
	$details_size,
	$avatar_size,
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<div class="testimonial-details">
		
		<?php $this->get_rating( 'square sm' ) ?>
		<?php $this->get_time(); ?>

	</div><!-- /.testimonial-details -->
	
	<div class="testimonial-quote">
		<?php $this->get_position( 'h5' ); ?>
		<?php $this->get_quote(); ?>
	</div><!-- /.testimonial-qoute -->
	
	<div class="testimonial-details">
		<div class="testimonial-info">
			<?php $this->get_name() ?>
		</div><!-- /.testimonial-info -->
	</div><!-- /.testimonial-details -->

</div><!-- /.testimonial -->