<?php

$classes = array( 
	$this->get_class( $atts['style'] ), 
	$atts['tabs_direction'],
	$atts['el_class'], 
	$this->get_id() 
);

$this->generate_css();

?>
<div class="tabs <?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php echo $this->get_deeplink_opts(); ?>>
	<?php $this->get_nav(); ?>
	<?php $this->get_content() ?>
</div>
