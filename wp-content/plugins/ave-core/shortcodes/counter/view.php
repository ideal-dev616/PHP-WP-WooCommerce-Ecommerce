<?php

extract( $atts );

// classes
$classes = array( 
	$this->get_class( $style ),
	$this->get_size(),
	$this->get_align(),
	
	$this->get_static_gradient_classname(),
	$this->get_hover_gradient_classname(),
	
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<?php $this->get_top_text() ?>
		<div class="liquid-counter-element <?php echo $this->get_counter_align(); ?>" data-enable-counter="true" <?php echo $this->get_data_options(); ?>>
				<?php $this->get_static_gradient(); ?>
				<?php $this->get_hover_gradient(); ?>
				<?php $this->get_count() ?>
		</div><!-- /.liquid-counter-element -->
	<?php $this->get_bottom_text() ?>

</div><!-- /.liquid-counter -->