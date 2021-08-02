<?php

extract( $atts );

$id = ( $el_id ) ? ' id="' . esc_attr( $el_id ) . '"' : '';

$classes = array( 
	'ld-fancy-heading',
	$this->add_mask(),
	$this->add_bg_mask(),
	$this->get_bg_classname(),
	$alignment,
	$transform,
	$el_class, 
	$_id,
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div<?php echo $id; ?> class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<?php $this->get_title(); ?>
</div>