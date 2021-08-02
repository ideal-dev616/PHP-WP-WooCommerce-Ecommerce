<?php
/*
 * Title Wrapper Section
 *
 * Available options on $section array:
 * separate_box (boolean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/

$sections[] = array(
	'post_types' => array( 'post', 'page', 'liquid-portfolio', 'product' ),
	'title'      => esc_html__( 'Title Wrapper', 'ave' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(
		array(
			'id'       => 'title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Title Wrapper', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default'  => '0'
		),
		array(
			'id'       => 'title-bar-heading',
			'type'     => 'text',
			'title'    => esc_html__( 'Custom Heading', 'ave' ),
			'subtitle' => esc_html__( 'Custom heading will override the default page/post title', 'ave' ),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'       => 'title-bar-typography-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Title bar Typography', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off',
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		'title-bar-typography' => array(
			'id'             => 'title-bar-typography',
			'title'          => esc_html__( 'Title Bar Heading Typography', 'ave' ),
			'subtitle'       => esc_html__( 'These settings control the typography for the titlebar heading', 'ave' ),
			'type'           => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'required' => array(
				'title-bar-typography-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'    => 'title-bar-subheading',
			'type'  => 'text',
			'title' => esc_html__( 'Sub-Heading', 'ave' ),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'       => 'title-bar-subheading-typography-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Title bar Typography', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off',
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		'title-bar-subheading-typography' => array(
			'id'             => 'title-bar-subheading-typography',
			'title'          => esc_html__( 'Title Bar Subheading Typography', 'ave' ),
			'subtitle'       => esc_html__( 'These settings control the typography for the titlebar subheading', 'ave' ),
			'type'           => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'required' => array(
				'title-bar-subheading-typography-enable',
				'!=',
				'off'
			),
		),
		array(
			'type'     => 'slider',
			'id'       => 'title-bar-padding-top',
			'title'    => esc_html__( 'Padding Top', 'ave' ),
			'subtitle' => esc_html__( 'Controls the top padding of the titlebar', 'ave' ),
			'default'  => 200,
			'max'      => 300,
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'type'     => 'slider',
			'id'       => 'title-bar-padding-bottom',
			'title'    => esc_html__( 'Padding Bottom', 'ave' ),
			'subtitle' => esc_html__( 'Controls the bottom padding of the titlebar', 'ave' ),
			'default'  => 200,
			'max'      => 300,
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'       => 'title-bar-scheme',
			'type'     => 'select',
			'title'    => esc_html__( 'Color scheme', 'ave' ),
			'options'  => array(
				''              => esc_html__( 'Light', 'ave' ),
				'scheme-light'  => esc_html__( 'Dark', 'ave' ),
			),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
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
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'       => 'title-bar-bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Background Image', 'ave' ),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		
		array(
			'id'            => 'title-bar-bg-gradient',
			'type'          => 'liquid_colorpicker',
			'only_gradient' => true,
			'title'    => esc_html__( 'Background Gradient', 'ave' ),
			'subtitle' => esc_html__( 'Overwrites the background image, unless has transparency.', 'ave' ),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'       => 'title-bar-parallax',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Parallax?', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'subtitle' => esc_html__( 'The background should have an image', 'ave' ),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'      => 'title-bar-overlay',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Overlay', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off',
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'       => 'title-bar-overlay-background',
			'type'     => 'liquid_colorpicker',
			'title'    => esc_html__( 'Overlay Background', 'ave' ),
			'required' => array(
				'title-bar-overlay',
				'!=',
				'off'
			),
		),
		array(
			'id'      => 'title-bar-breadcrumb',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Breadcrumbs', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),
		array(
			'id'      => 'title-bar-scroll',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Scroll Button', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'0'    => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => '',
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
		),		
		array(
			'id'         => 'title-bar-scroll-color',
			'type'       => 'liquid_colorpicker',
			'only_solid' => true,
			'title'      => esc_html__( 'Scroll Button Color', 'ave' ),
			'subtitle'   => esc_html__( 'Pick a color for scroll button', 'ave' ),
			'required'   => array(
				'title-bar-scroll',
				'!=',
				'off'
			),
		),
		array(
			'id'       => 'title-bar-scroll-id',
			'type'     => 'text',
			'title'    => esc_html__( 'Anchor ID', 'ave' ),
			'subtitle' => esc_html__( 'Input anchor ID of the section for scroll button', 'ave' ),
			'required' => array(
				'title-bar-scroll',
				'!=',
				'off'
			),
		),
		array(
			'id'=>'title-bar-classes',
			'type' => 'text',
			'title' => esc_html__('Extra classes', 'ave'),
			'required' => array(
				'title-bar-enable',
				'!=',
				'off'
			),
			
		),

	), // #fields
);