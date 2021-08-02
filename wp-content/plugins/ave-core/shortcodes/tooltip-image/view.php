<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'img-maps', $el_class, $this->get_id() );

$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_image(); ?>

	<div class="contents">
		<?php echo do_shortcode( $content ); ?>
	</div><!-- /.contents -->

</div><!-- /.img-maps -->