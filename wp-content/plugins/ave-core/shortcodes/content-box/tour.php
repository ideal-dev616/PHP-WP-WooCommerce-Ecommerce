<?php

extract( $atts );

$classes = array( 
	'fancy-box',
	$heading_size, 
	$this->get_class( $style ), 
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<?php $this->get_image( true ) ?>	

	<div class="fancy-box-contents">

		<div class="fancy-box-header">
			<?php $this->get_title(); ?>
			<?php $this->get_rating(); ?>
		</div><!-- /.fancy-box-header -->
		
		<div class="fancy-box-info">
			<?php $this->get_content(); ?>
		</div><!-- /.fancy-box-info -->
	</div><!-- /.fancy-box-contents -->

	<div class="fancy-box-footer">
		<?php $this->get_info(); ?>
		<!-- <?php $this->get_button(); ?> -->
		<span class="fancy-box-icon"><i class="icon-liquid_arrow_right"></i></span>
	</div><!-- /.fancy-box-footer -->
	
	<?php $this->get_overlay_link(); ?>
	
</div><!-- /.fancy-box fancy-box-classes -->