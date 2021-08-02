<?php 

extract( $atts );

$data_target = !empty( $target_id ) ? $target_id : 'main-header-collapse';

$classes = array( 
	'nav-trigger',
	'collapsed',
	'style-1',
	$fill,
	$scheme,
	$orientation,

	$this->get_position(),

	$el_class,
	$this->get_id(),
	trim( vc_shortcode_custom_css_class( $css ) )
);

$classes = apply_filters( 'liquid_trigger_classes', $classes );

$opts = array(
	'role="button"',
	'type="button"',
	'data-toggle="collapse"',
	'data-target="#' . $data_target . '"',
	'aria-expanded="false"',
	'aria-controls="' . $data_target . '"',
);

$opts = apply_filters( 'liquid_trigger_opts', $opts );

?>
<div class="header-module">
	<button 
		id="<?php echo $this->get_id(); ?>" 
		class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>"
		<?php echo implode( ' ', $opts ); ?>
		>
		<span class="bars">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</span>
		<?php $this->get_text(); ?>
	</button>
</div>