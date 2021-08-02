<?php

extract( $atts );

// Enqueue Conditional Script
$this->generate_css();

$classes = array(
	'ld-module-v-sep',
	$this->get_id()
);

?>
<div class="header-module">
	<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
		<span class="ld-v-sep-inner"></span>
	</div><!-- /.ld-module-v-sep -->
</div>