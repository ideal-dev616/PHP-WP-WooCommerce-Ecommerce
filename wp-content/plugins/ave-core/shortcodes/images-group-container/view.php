<?php

extract( $atts );

$classes = array(
	'liquid-img-group-container',
	$el_class, 
	$this->get_id() 
);

$this->generate_css();
	
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php echo $this->get_options() ?> <?php echo $this->get_parallax_options() ?>>
	<div class="liquid-img-group-inner">
		<?php echo ld_helper()->do_the_content( $content ); ?>	
	</div><!-- /.liquid-img-group-inner -->
</div><!-- /.liquid-img-group-container -->