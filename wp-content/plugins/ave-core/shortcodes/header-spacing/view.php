<?php 

extract( $atts );

$this->generate_css();

$classes = array(
	'header-spacing',
	'ld-header-spacing',
	$this->get_id()
);

?>
<div class="header-module">
	<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>"></div>
</div>