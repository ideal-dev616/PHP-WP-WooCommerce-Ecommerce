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

		<?php $this->get_avatar( 'mb-4'); ?>

		<div class="testimonial-info">
			<?php $this->get_name( 'h5' ,'font-weight-medium mb-3' ); ?>
			<?php $this->get_position( 'h6', 'font-weight-medium text-uppercase ltr-sp-175 md mb-3' ); ?>
		</div><!-- /.testimonial-info -->

	</div><!-- /.testimonial-details -->
	
	<div class="testimonial-quote mb-0">
		<?php $this->get_quote(); ?>
	</div><!-- /.testimonial-qoute -->
	
</div><!-- /.testimonial -->