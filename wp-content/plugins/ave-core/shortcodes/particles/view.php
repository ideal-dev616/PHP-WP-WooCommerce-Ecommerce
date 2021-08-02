<?php

extract( $atts );


$id = ( $el_id ) ? ' id="' . esc_attr( $el_id ) . '"' : '';

$classes = array( 
	'ld-particles-container',
	$el_class, 
	$_id,
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();
?>
<div<?php echo $id; ?> class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_items() ?>	

</div><!-- /.particles -->