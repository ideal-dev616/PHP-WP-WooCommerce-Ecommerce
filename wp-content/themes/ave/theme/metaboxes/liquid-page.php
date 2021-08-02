<?php
/*
 * General Section
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
	'post_types' => array( 'post', 'page', 'liquid-portfolio' ),
	'title'      => esc_html__('Page', 'ave'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
		
		array(
			'id'        => 'body-color-scheme',
			'type'      => 'select',
			'title'     => esc_html__( 'Page Color Scheme', 'ave' ),
			'subtitle'  => esc_html__( 'Select a color scheme for the page', 'ave' ),
			'options'   => array(
				''      => esc_html__( 'Dark - (light background and dark content)', 'ave' ),
				'light' => esc_html__( 'Light - (dark background and light content)', 'ave' ),
			),
		),

		//Content Background
		array(
			'id'       => 'page-content-bg',
			'type'     => 'background',
			'preview'  => false,
			'title'   => esc_html__( 'Content Background', 'ave' ),
		),
		array(
			'id'            => 'page-content-gradient',
			'type'          => 'liquid_colorpicker',
			'only_gradient' => true,
			'title' => esc_html__( 'Content Background Gradient', 'ave' ),
			'subtitle' => esc_html__( 'Overwrites the background image, unless has transparency.', 'ave' ),
		),
		array(
			'id'       => 'page-enable-stack',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Page Blocks?', 'ave' ),
			'subtitle' => esc_html__( 'Will enable page stack', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'page-enable-stack-mobile',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Page Blocks? ( Mobile )', 'ave' ),
			'subtitle' => esc_html__( 'Will enable page stack for mobile devices', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'required' => array(
				'page-enable-stack',
				'equals',
				'on'
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'page-stack-effect',
			'type'	   => 'select',
			'title'    => esc_html__( 'Page Blocks Effect', 'ave' ),
			'subtitle' => esc_html__( 'Select an effect for the section transition', 'ave' ),
			'options'  => array(
				'fadeScale'  => esc_html__( 'fadeScale', 'ave' ),
				'slideOver'  => esc_html__( 'slideOver', 'ave' ),
			),
			'required' => array(
				'page-enable-stack',
				'equals',
				'on'
			),
			'default'  => 'fadeScale'
		),
		array(
			'id'       => 'page-stack-nav',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Page Blocks Navigation?', 'ave' ),
			'subtitle' => esc_html__( 'Will enable page blocks navigation', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'required' => array(
				'page-enable-stack',
				'equals',
				'on'
			),
		),
		array(
			'id'       => 'page-stack-nav-prevnextbuttons',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Page Blocks Previous/Next buttons?', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'required' => array(
				'page-enable-stack',
				'equals',
				'on'
			),
		),
		array(
			'id'       => 'page-stack-buttons-style',
			'type'	   => 'select',
			'title'    => esc_html__( 'Buttons Style', 'ave' ),
			'subtitle' => esc_html__( 'Select style for the buttons', 'ave' ),
			'options'  => array(
				'lqd-stack-buttons-style-1' => esc_html__( 'Style 1', 'ave' ),
				'lqd-stack-buttons-style-2' => esc_html__( 'Style 2', 'ave' ),
			),
			'required' => array(
				'page-stack-nav-prevnextbuttons',
				'equals',
				'on'
			),
		),
		
		array(
			'id'       => 'page-stack-numbers',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Page Blocks Numbers?', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'required' => array(
				'page-enable-stack',
				'equals',
				'on'
			),
		),
	)
);
