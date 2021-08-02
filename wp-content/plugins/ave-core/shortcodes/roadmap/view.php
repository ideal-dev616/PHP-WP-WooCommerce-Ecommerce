<?php

extract( $atts );

$classes = array( 
	'one-roadmap',

	$atts['el_class'], 
	$this->get_id() 
);

$this->generate_css();
	
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php $this->get_animation(); ?>>

	<div class="one-roadmap-inner">	
		<?php echo ld_helper()->do_the_content( $content, false ); ?>
	</div><!-- /.one-roadmap-inner -->

</div><!-- /.one-roadmap -->