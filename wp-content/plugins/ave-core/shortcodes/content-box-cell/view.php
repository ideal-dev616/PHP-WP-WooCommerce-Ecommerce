<?php

extract( $atts );

$classes = array( 
	'fancy-box-cell',

	$el_class, 
	$this->get_id() 
);

// $this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<?php echo wp_kses_post( do_shortcode( $content ) ); ?>
</div><!-- /.fancy-box-cell -->