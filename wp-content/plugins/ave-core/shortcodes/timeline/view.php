<?php

$classes = array( 
	'ld-timeline-wrap',

	$atts['el_class'], 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<span class="ld-timeline-bar"></span><!-- /.timeline-bar -->
	<?php echo ld_helper()->do_the_content( $content ); ?>
</div><!-- /.ld-timeline-wrap -->