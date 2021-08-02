<?php

extract( $atts );

// classes
$classes = array( 
	'ld-masked-image', 
	$el_class,
	$this->get_id(),
);

$this->generate_css();
  
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>" data-dynamic-shape="true">
	<?php $this->get_svg() ?>
	<?php $this->get_image(); ?>
</div>