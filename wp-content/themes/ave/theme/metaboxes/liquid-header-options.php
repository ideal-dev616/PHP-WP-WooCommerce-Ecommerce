<?php
/*
 * Header Section
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
	'post_types' => array( 'liquid-header' ),
	'title'      => esc_html__( 'Header Design Options', 'ave' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(
		
		array(
			'id'      => 'header-layout',
			'type'	  => 'select',
			'title'   => esc_html__( 'Style', 'ave' ),
			'options' => array(
				'default'    => esc_html__( 'Default', 'ave' ),
				'fullscreen' => esc_html__( 'Fullscreen', 'ave' ),
				'side'       => esc_html__( 'Side 1', 'ave' ),
				'side-3'     => esc_html__( 'Side 2', 'ave' ),
			),
			'default' => 'default'
		),
		array(
			'id'    => 'header-fullscreen-nav-bg',
			'type'  => 'liquid_colorpicker',
			'title' => esc_html__( 'Navigation Background', 'ave' ),
			'required' => array(
				'header-layout',
				'equals',
				'fullscreen'
			),
		),
		array(
			'id'      => 'header-megamenu-react',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Megamenu Reaction?', 'ave' ),
			'description' => esc_html__( 'Enable if you want to add backround animation to header when hover the megamenu item', 'ave' ),
			'options' => array(
				'no'  => esc_html__( 'No', 'ave' ),
				'yes' => esc_html__( 'Yes', 'ave' ),
			),
			'default' => 'no',
			'required' => array(
				array( 'header-layout', 'not', 'side' ),
				array( 'header-layout', 'not', 'side-3' ),
			),
		),
		array(
			'id'      => 'header-sticky',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Sticky Header?', 'ave' ),
			'options' => array(
				'no'  => esc_html__( 'No', 'ave' ),
				'yes' => esc_html__( 'Yes', 'ave' ),
			),
			'default' => 'no',
			'required' => array(
				array( 'header-layout', 'not', 'side' ),
				array( 'header-layout', 'not', 'side-3' ),
			),
		),
		array(
			'id'      => 'header-sticky-pos',
			'type'	  => 'select',
			'title'   => esc_html__( 'Sticky Header Position', 'ave' ),
			'options' => array(
				'default'       => esc_html__( 'Default - Bottom of the header', 'ave' ),
				'after-section' => esc_html__( 'After first section', 'ave' ),
			),
			'default' => 'default',
			'required' => array(
				'header-sticky',
				'equals',
				'yes'
			),
		),
		array(
			'id'    => 'header-sticky-bg',
			'type'  => 'liquid_colorpicker',
			'title' => esc_html__( 'Sticky Header Background', 'ave' ),
			'required' => array(
				'header-sticky',
				'equals',
				'yes'
			),
		),
		array(
			'id'    => 'header-sticky-color',
			'type'  => 'liquid_colorpicker',
			'only_solid' => true,
			'title' => esc_html__( 'Sticky Header Color', 'ave' ),
			'required' => array(
				'header-sticky',
				'equals',
				'yes'
			),
		),
		array(
			'id'    => 'header-sticky-hover-color',
			'type'  => 'liquid_colorpicker',
			'only_solid' => true,
			'title' => esc_html__( 'Sticky Header Hover Color', 'ave' ),
			'required' => array(
				'header-sticky',
				'equals',
				'yes'
			),
		),
		array(
			'id'      => 'header-overlay',
			'type'	  => 'select',
			'title'   => esc_html__( 'Overlay?', 'ave' ),
			'options' => array(
				''    => esc_html__( 'No', 'ave' ),
				'main-header-overlay' => esc_html__( 'Yes', 'ave' ),
			),
			'required' => array(
				array( 'header-layout', 'not', 'side' ),
				array( 'header-layout', 'not', 'side-3' ),
			),
			'default' => ''
		),

	)
);
$sections[] = array(
	'post_types' => array( 'liquid-header' ),
	'title'      => esc_html__( 'Mobile Navigation', 'ave' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(
		
		array(
			'id'      => 'm-nav-style',
			'type'	  => 'select',
			'title'   => esc_html__( 'Style', 'ave' ),
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
			'options' => array(
				'right' => esc_html__( 'Right', 'ave' ),
				'left'  => esc_html__( 'Left', 'ave' ),
			),
		),
		array(
			'id'      => 'm-nav-alignment',
			'type'	  => 'select',
			'title'   => esc_html__( 'Navigation Alignment', 'ave' ),
			'options' => array(
				'right' => esc_html__( 'Right', 'ave' ),
				'center' => esc_html__( 'Center', 'ave' ),
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
			'required'    => array(
				'm-nav-scheme',
				'=',
				array( 'custom' )
			),
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
			'id'      => 'mobile-header-overlay',
			'type'	  => 'select',
			'title'   => esc_html__( 'Enable Overlay on mobile device?', 'ave' ),
			'options' => array(
				''    => esc_html__( 'No', 'ave' ),
				'yes' => esc_html__( 'Yes', 'ave' ),
			),
			'required' => array(
				'header-overlay',
				'equals',
				'main-header-overlay'
			),
			'default' => ''
		),
		array(
			'id'      => 'm-nav-enable-secondary-bar',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Show secondary bar of the header', 'ave' ),
			'options' => array(
				'no'  => esc_html__( 'No', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'yes' => esc_html__( 'Yes', 'ave' ),
			),
		),

	)
);