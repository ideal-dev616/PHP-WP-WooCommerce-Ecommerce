<?php

extract( $atts );


$id = ( $el_id ) ? ' id="' . esc_attr( $el_id ) . '"' : '';

$classes = array( 
	'ld-empty-space',
	$hide,
	$sm_hide,
	$md_hide,
	$lg_hide,
	$el_class, 
	$_id,
);

$this->generate_css();
?>

<div<?php echo $id; ?> class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>"><span class="liquid_empty_space_inner"></span></div>