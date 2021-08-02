<?php
// New Params for Row header functionality

function liquid_row_header_params() {
	
	$headers_params = array(
		array(
			'type'       => 'dropdown',
			'param_name' => 'header_type',
			'heading'    => esc_html__( 'Bar type', 'ave-core' ),
			'description' => esc_html__( 'Select the role of the bar', 'ave-core' ),
			'value'       => array(
				esc_html__( 'Main', 'ave-core' ) => 'mainbar',
				esc_html__( 'Secondary', 'ave-core' ) => 'secondarybar',
			),
			'weight' => 1,
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Fullwidth?', 'ave-core' ),
			'description' => esc_html__( 'Enable to make header fullwidth', 'ave-core' ),
			'param_name' => 'header_full_width',
			'value' => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			'weight' => 1,
		),
	);
	
	vc_add_params( 'vc_row', $headers_params );
	
}
add_action( 'vc_after_init', 'liquid_row_header_params' );

function liquid_column_header_params() {
	
	$headers_params = array(
		array(
			'type'       => 'dropdown',
			'param_name' => 'header_col_width',
			'heading'    => esc_html__( 'Column Width', 'ave-core' ),
			'description' => esc_html__( 'Select column width', 'ave-core' ),
			'value'       => array(
				esc_html__( 'Expand', 'ave-core' ) => 'col',
				__( 'Equal to content\'s widths.', 'ave-core' ) => 'col-auto',
			),
			'weight' => 1,
		),
	);	

	vc_add_params( 'vc_column', $headers_params );	
	
}
add_action( 'vc_after_init', 'liquid_column_header_params' );