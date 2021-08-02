<?php

extract( $atts );

$classes = array( 
	'countdown', 

	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

//Generate CSS
$this->generate_css();

?>

<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>" data-plugin-countdown="true" <?php $this->get_plugin_opts(); ?>></div>