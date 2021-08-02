<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

// classes
$classes = array( 
	'ld-gmap-container', 
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

$options = array(
	'style'   => $style,
	'address' => $address,
	'marker'  => $this->get_marker(),
	'markers' => $this->get_coordinates(),
	'map'     => array(
		'zoom'      => $zoom ? intval( $zoom ) : 14,
		'mapTypeId' => $map_type
	)
);
if( 'html_marker' === $map_marker ) {
	$options['marker_option'] = 'html';
	$options['className'] = 'map_marker';
}

if( $map_controls ) {
	$map_controls = explode( ',', $map_controls );

	$map = array();
	foreach( $map_controls as $control ) {
		$options['map'][ $control ] = true;
	}
}
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>" style="height: <?php echo $map_height ? $map_height : '600px' ?>">

	<div class="ld-gmap" data-plugin-map="true" data-plugin-options='<?php echo wp_json_encode( $options ) ?>'></div>

</div>