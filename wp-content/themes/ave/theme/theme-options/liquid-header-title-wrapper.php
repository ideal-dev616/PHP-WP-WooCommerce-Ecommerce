<?php
/*
 * Title Wrapper Section
*/

// Title Bar
$this->sections[] = array(
	'title'      => esc_html__( 'Page Title Bar', 'ave' ),
	'icon'       => 'el el-indent-right',
	//'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Title Bar', 'ave' ),
			'subtitle' => esc_html__( 'Switch off to hide the title bar on your website.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'title-bar-heading',
			'type'     => 'text',
			'title'    => esc_html__( 'Custom Page Title', 'ave' ),
			'subtitle' => esc_html__( 'Custom page title will override the default page and post titles', 'ave' ),
		),
		array(
			'id'       => 'title-bar-typography-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Page Title Custom Typography', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off',

		),
		'title-bar-typography' => array(
			'id'             => 'title-bar-typography',
			'title'          => esc_html__( 'Page Title Typography', 'ave' ),
			'subtitle'       => esc_html__( 'Manages the typography for the page title', 'ave' ),
			'type'           => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'required' => array(
				'title-bar-typography-enable',
				'equals',
				'on'
			),
		),
		array(
			'id'    => 'title-bar-subheading',
			'type'  => 'text',
			'title' => esc_html__( 'Page Subtitle', 'ave' ),

		),
		array(
			'id'       => 'title-bar-subheading-typography-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Page Subtitle Custom Typography', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off',

		),
		'title-bar-subheading-typography' => array(
			'id'             => 'title-bar-subheading-typography',
			'title'          => esc_html__( 'Page Subtitle Typography', 'ave' ),
			'subtitle'       => esc_html__( 'Manages the typography for the page subtitle', 'ave' ),
			'type'           => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'required' => array(
				'title-bar-subheading-typography-enable',
				'equals',
				'on'
			),
		),
		array(
			'type'     => 'slider',
			'id'       => 'title-bar-padding-top',
			'title'    => esc_html__( 'Padding Top', 'ave' ),
			'subtitle' => esc_html__( 'Manages the top padding of the titlebar', 'ave' ),
			'default'  => 200,
			'max'      => 300,
		),
		array(
			'type'     => 'slider',
			'id'       => 'title-bar-padding-bottom',
			'title'    => esc_html__( 'Padding Bottom', 'ave' ),
			'subtitle' => esc_html__( 'Manages the bottom padding of the titlebar', 'ave' ),
			'default'  => 200,
			'max'      => 300,
		),
		array(
			'id'       => 'title-bar-scheme',
			'type'     => 'select',
			'title'    => esc_html__( 'Color scheme', 'ave' ),
			'options'  => array(
				''              => esc_html__( 'Light', 'ave' ),
				'scheme-light'  => esc_html__( 'Dark', 'ave' ),
			),
		),
		array(
			'id'       => 'title-bar-align',
			'type'     => 'select',
			'title'    => esc_html__( 'Alignment', 'ave' ),
			'options' => array(
				'text-left'   => esc_html__( 'Left', 'ave' ),
				'text-center' => esc_html__( 'Center', 'ave' ),
				'text-right'  => esc_html__( 'Right', 'ave' ),
			),
		),
		array(
			'id'       => 'title-bar-bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Background Image', 'ave' ),
		),
		
		array(
			'id'            => 'title-bar-bg-gradient',
			'type'          => 'liquid_colorpicker',
			'only_gradient' => true,
			'title'    => esc_html__( 'Background Gradient', 'ave' ),
			'subtitle' => esc_html__( 'Overwrites the background image, unless has transparency.', 'ave' ),
		),
		array(
			'id'       => 'title-bar-parallax',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Parallax', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'subtitle' => esc_html__( 'The background should have an image', 'ave' ),
			'default' => 'off',
		),
		array(
			'id'      => 'title-bar-overlay',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Overlay', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off',
		),
		array(
			'id'       => 'title-bar-overlay-background',
			'type'     => 'liquid_colorpicker',
			'title'    => esc_html__( 'Overlay Background', 'ave' ),
			'required' => array(
				'title-bar-overlay',
				'equals',
				'on'
			),
		),
		array(
			'id'      => 'title-bar-breadcrumb',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Breadcrumbs', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
		),
		array(
			'id'      => 'title-bar-scroll',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Scroll Button', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => '',
		),		
		array(
			'id'         => 'title-bar-scroll-color',
			'type'       => 'liquid_colorpicker',
			'only_solid' => true,
			'title'      => esc_html__( 'Scroll Button Color', 'ave' ),
			'subtitle'   => esc_html__( 'Choose a color for scroll button', 'ave' ),
			'required'   => array(
				'title-bar-scroll',
				'equals',
				'on'
			),
		),
		array(
			'id'       => 'title-bar-scroll-id',
			'type'     => 'text',
			'title'    => esc_html__( 'Anchor ID', 'ave' ),
			'subtitle' => esc_html__( 'Anchor ID of the section where the page will be scrolled on click to the scroll button', 'ave' ),
			'required' => array(
				'title-bar-scroll',
				'equals',
				'on'
			),
		),
		array(
			'id'=>'title-bar-classes',
			'type' => 'text',
			'title' => esc_html__( 'Extra classes', 'ave' ),
			
		),
	)
);
