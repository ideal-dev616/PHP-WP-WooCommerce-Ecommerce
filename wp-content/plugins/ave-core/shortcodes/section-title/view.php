<?php

extract( $atts );

$id = ( $el_id ) ? ' id="' . esc_attr( $el_id ) . '"' : '';

$classes = array( 
	'fancy-title', 
	$this->get_underline_section(),
	$alignment,
	$el_class, 
	$_id, 
	trim( vc_shortcode_custom_css_class( $css ) ) 
);

$this->generate_css();

?>
<header<?php echo $id; ?> class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<?php $this->get_title(); ?>
	<?php $this->get_subtitle(); ?>
	<?php $this->get_description(); ?>
</header>