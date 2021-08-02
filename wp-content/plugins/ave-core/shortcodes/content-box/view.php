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
	
	<?php $this->get_image( true ); ?>

	<div class="fancy-box-header">
		<?php $this->get_title(); ?>
		<?php $this->get_details(); ?>
	</div><!-- /.fancy-box-header -->
	
	<div class="fancy-box-contents">		

		<div class="fancy-box-info">
			<?php $this->get_content(); ?>
		</div><!-- /.fancy-box-info -->
		
		<div class="fancy-box-footer">
			<?php $this->get_button() ?>
		</div><!-- /.fancy-box-footer -->

	</div><!-- /.fancy-box-contents -->
	
	<?php $this->get_overlay_link() ?>

</div>