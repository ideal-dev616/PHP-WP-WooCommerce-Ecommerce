<?php

extract( $atts );

$classes = array( 
	'fancy-box',
	'text-center',
	$scheme,
	$heading_size, 
	$this->get_class( $style ), 
	$this->get_custom_height_classname(),
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<div class="cb-img-container">
		<?php $this->get_blured_image(); ?>
	</div><!-- /.cb-img-container -->

	<span class="cb-overlay"></span><!-- /.cb-overlay -->

	<div class="fancy-box-contents justify-content-center">
		
		<div class="fancy-box-header">

			<?php $this->get_title() ?>
			<?php $this->get_info() ?>

		</div><!-- /.fancy-box-header -->
		
	</div><!-- /.fancy-box-contents -->

	<?php $this->get_overlay_link() ?>
	
</div><!-- /.fancy-box fancy-box-classes -->