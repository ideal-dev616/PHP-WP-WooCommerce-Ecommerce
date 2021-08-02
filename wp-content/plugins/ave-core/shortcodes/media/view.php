<?php

extract( $atts );

$classes = array( 
	'ld-media-row',
	'row',
	'd-flex',

	$atts['el_class'], 
	$this->get_id() 
);


// The CSS
$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-liquid-masonry="true" <?php echo $this->get_options() ?>>
	<?php echo ld_helper()->do_the_content( $content ); ?>
</div><!-- /.ld-media-row -->


