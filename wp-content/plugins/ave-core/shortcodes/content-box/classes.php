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
	
	<div class="fancy-box-contents">
		
		<?php $this->get_label(); ?>
		
		<div class="fancy-box-info">
			<?php $this->get_title(); ?>
			<?php $this->get_info(); ?>
		</div><!-- /.fancy-box-info -->
		
	</div><!-- /.fancy-box-contents -->
	
	<?php $this->get_overlay_link() ?>
	
</div><!-- /.fancy-box fancy-box-classes -->