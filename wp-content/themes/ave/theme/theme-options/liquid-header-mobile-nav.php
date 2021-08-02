<?php
$this->sections[] = array(
	'title'      => esc_html__( 'Mobile Navigation', 'ave' ),
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id'      => 'm-nav-style',
			'type'	  => 'select',
			'title'   => esc_html__( 'Style', 'ave' ),
			'description' => esc_html__( 'for the mobile version of the website', 'ave' ),
			'options' => array(
				'classic' => esc_html__( 'Classic', 'ave' ),
				'minimal' => esc_html__( 'Minimal', 'ave' ),
				'modern'  => esc_html__( 'Modern', 'ave' ),
			),
		),
		array(
			'id'      => 'm-nav-logo-alignment',
			'type'	  => 'select',
			'title'   => esc_html__( 'Logo Alignment', 'ave' ),
			'description' => esc_html__( 'for the mobile version of the website', 'ave' ),
			'options' => array(
				'default' => esc_html__( 'Default', 'ave' ),
				'center'  => esc_html__( 'Center', 'ave' ),
			),
		),
		array(
			'id'      => 'm-nav-trigger-alignment',
			'type'	  => 'select',
			'title'   => esc_html__( 'Trigger Alignment', 'ave' ),
			'description' => esc_html__( 'for the mobile version of the website', 'ave' ),
			'options' => array(
				'right' => esc_html__( 'Right', 'ave' ),
				'left'  => esc_html__( 'Left', 'ave' ),
			),
		),
		array(
			'id'      => 'm-nav-alignment',
			'type'	  => 'select',
			'title'   => esc_html__( 'Navigation Alignment', 'ave' ),
			'description' => esc_html__( 'for the mobile version of the website', 'ave' ),
			'options' => array(
				'right' => esc_html__( 'Right', 'ave' ),
				'left'  => esc_html__( 'Left', 'ave' ),
			),
			'required' => array(
				'm-nav-style',
				'=',
				array( 'classic', 'minimal' )
			),
		),
		array(
			'id'      => 'm-nav-scheme',
			'type'	  => 'select',
			'title'   => esc_html__( 'Color Scheme', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'options' => array(
				'gray' => esc_html__( 'Gray', 'ave' ),
				'light' => esc_html__( 'Light', 'ave' ),
				'dark'  => esc_html__( 'Dark', 'ave' ),
				'custom' => esc_html__( 'Custom', 'ave' ),
			),
			'required' => array(
				'm-nav-style',
				'=',
				array( 'classic', 'minimal' )
			),
		),
		array(
			'id'          => 'm-nav-custom-bg',
			'type'        => 'liquid_colorpicker',
			'title'       => esc_html__( 'Navigation Background', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'required'    => array(
				'm-nav-scheme',
				'=',
				array( 'custom' )
			),
		),
		array(
			'id'          => 'm-nav-custom-color',
			'type'        => 'liquid_colorpicker',
			'only_solid'  => true,
			'title'       => esc_html__( 'Navigation Text/Trigger Color', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'required'    => array( 'm-nav-scheme', '=', array( 'custom' ) ),
		),
		array(
			'id'          => 'm-nav-modern-bg',
			'type'        => 'liquid_colorpicker',
			'title'       => esc_html__( 'Navigation Background', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'required'    => array( 'm-nav-style', '=', 'modern' ),
		),
		array(
			'id'          => 'm-nav-modern-color',
			'type'        => 'liquid_colorpicker',
			'only_solid'  => true,
			'title'       => esc_html__( 'Navigation Text/Trigger Color', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'required'    => array( 'm-nav-style', '=', 'modern' ),
		),
		array(
			'id'          => 'm-nav-border-color',
			'type'        => 'liquid_colorpicker',
			'only_solid'  => true,
			'title'       => esc_html__( 'Navigation Border Color', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'required'    => array( 
				array( 'm-nav-style', '=', 'classic' ), 
				array( 'm-nav-scheme', '=', array( 'custom' ) ), 
			),
		),
		
		array(
			'id'      => 'm-nav-header-scheme',
			'type'	  => 'select',
			'title'   => esc_html__( 'Header Color Scheme', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'options' => array(
				'light' => esc_html__( 'Light', 'ave' ),
				'gray' => esc_html__( 'Gray', 'ave' ),
				'dark'  => esc_html__( 'Dark', 'ave' ),
				'custom' => esc_html__( 'Custom', 'ave' ),
			),
		),
		array(
			'id'          => 'm-nav-header-custom-bg',
			'type'        => 'liquid_colorpicker',
			'title'       => esc_html__( 'Header Background', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'required'    => array(
				'm-nav-header-scheme',
				'=',
				array( 'custom' )
			),
		),
		array(
			'id'          => 'm-nav-header-custom-color',
			'type'        => 'liquid_colorpicker',
			'only_solid'  => true,
			'title'       => esc_html__( 'Header Text/Trigger Color', 'ave' ),
			'description' => esc_html__( 'of the mobile version of the website', 'ave' ),
			'required'    => array(
				'm-nav-header-scheme',
				'=',
				array( 'custom' )
			),
		),
		array(
			'id'      => 'm-nav-enable-secondary-bar',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Show secondary bar of the header', 'ave' ),
			'options' => array(
				'no'  => esc_html__( 'No', 'ave' ),
				'yes' => esc_html__( 'Yes', 'ave' ),
			),
		),

	)
);