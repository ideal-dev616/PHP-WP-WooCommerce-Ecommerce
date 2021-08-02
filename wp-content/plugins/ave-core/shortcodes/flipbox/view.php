<?php
extract( $atts );

$classes = array( 
	'ld-flipbox', 
	$direction,
	$shadow,
	$border_radius,
	$atts['el_class'], 
	$this->get_id() 
);

$this->generate_css();

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php //echo $this->get_effect(); ?>>
	<div class="ld-flipbox-wrap" <?php //echo $this->get_stacking_factor() ?>>
		<?php $this->get_content() ?>
	</div>
</div>