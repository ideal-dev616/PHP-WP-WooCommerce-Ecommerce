<?php

extract( $atts );

// classes
$classes = array( 

	'liquid-progressbar',
	$size,
	$label_position,
	$roundness,
	$enable_vertical,
	$this->get_shape_classname(),
	$number_hide,
	
	$el_class,
	$this->get_id()

);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" data-progressbar="true" <?php echo $this->get_data_options(); ?>>

	<div class="liquid-progressbar-inner">
		<span class="liquid-progressbar-bar">
			<span class="liquid-progressbar-percentage <?php echo $this->get_shape() ?>"></span>
		</span>
		
		<?php $this->get_circle_container(); ?>
		
	</div><!-- /.liquid-progressbar-inner -->

	<?php if( $label ) { ?>
		<div class="liquid-progressbar-details">
			<h3 class="liquid-progressbar-title"><?php echo esc_html( $label ); ?></h3>
		</div><!-- /.liquid-progressbar-details -->
	<?php } ?>

</div><!-- /.liquid-progressbar -->