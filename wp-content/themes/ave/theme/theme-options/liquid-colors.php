<?php
// General Setting
$this->sections[] = array(
	'title'      => esc_html__( 'Colors', 'ave' ),
	'icon'       => 'el el-brush',
	'fields'     => array(
		array(
			'id'      => 'primary_ac_color',
			'type'    => 'color',
			'title'   => esc_html__( 'Primary color' , 'ave' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Choose a primary color for your website by using the colorpicker', 'ave' ),
			'default' => '#f13c46',

		),
		array(
			'id'      => 'secondary_ac_color',
			'type'    => 'color',
			'title'   => esc_html__( 'Secondary color' , 'ave' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Choose a primary color for your website by using the colorpicker', 'ave' ),
		),
		array(
			'id'      => 'primary_gradient_color',
			'type'    => 'color_gradient',
			'title'   => esc_html__( 'Primary Gradient color' , 'ave' ),
			'subtile' => '',
			'desc'    => esc_html__( 'Choose colors to generate a primary gradient color for your website by using the colorpicker', 'ave' ),
			'validate' => 'color',
			'default' => array(
				'from' => '#f42958',
				'to'   => '#e4442a',
				
			)
		),
		array(
			'id'    => 'links_color',
			'type'  => 'link_color',
			'title' => esc_html__( 'Links Color', 'ave' ),
			'active' => false,
			'visited' => false,
		),
		
	)
);
