<?php

extract( $atts );

$classes = array( 
	'liquid-ig-feed',
	$el_class, 
	$this->get_stretch(),
	$this->get_id(), 
	trim( vc_shortcode_custom_css_class( $css ) )
);

$this->generate_css();

?>

<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php echo $this->get_columns() ?> <?php echo $this->get_columns_gaps() ?>>

<!-- 	<ul class="liquid-ig-feed-list"> -->
		<?php $this->get_images(); ?>
<!-- 	</ul> -->

	<?php $this->get_button() ?>

</div><!-- /.widget_instagram_feed -->