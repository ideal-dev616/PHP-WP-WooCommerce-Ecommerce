<?php

extract( $atts );

$classes = array(
	'collapse', 
	'navbar-collapse',

	$visible,
	
	$el_class,
	$this->get_id()
);

$classes = apply_filters( 'liquid_header_collapsed_classes', $classes );
	
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="main-header-collapse">
	<?php echo ld_helper()->do_the_content( $content ); ?>	
</div><!-- /.navbar-collapse -->