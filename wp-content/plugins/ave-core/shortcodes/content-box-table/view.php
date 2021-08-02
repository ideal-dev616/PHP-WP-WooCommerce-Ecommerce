<?php

extract( $atts );

$classes = array( 
	'fancy-box',
	'fancy-box-offer',
	$this->is_header(),

	$el_class, 
	$this->get_id() 
);

// $this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<?php echo wp_kses_post( do_shortcode( $content ) ); ?>
</div><!-- /.fancy-box fancy-box-offer -->