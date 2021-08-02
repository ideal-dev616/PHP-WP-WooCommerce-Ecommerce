<?php
/*
 * Layout Section
*/

$this->sections[] = array(

	'title'  => esc_html__( 'Layout', 'ave' ),
	'icon'   => 'el-icon-website',
	'fields' => array(

		array(
			'id'        => 'page-layout',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Layout', 'ave' ),
			'subtitle'  => esc_html__( 'Controls the site layout', 'ave' ),
			'options'   => array(
				'boxed'    => esc_html__( 'Boxed', 'ave' ),
				'wide'     => esc_html__( 'Wide', 'ave' ),
			),
			'default'   => 'wide'
		),
		array(
			'type'     => 'slider',
			'id'       => 'site-width',
			'title'    => esc_html__( 'Site Width', 'ave' ),
			'subtitle' => esc_html__( 'Set the site width', 'ave' ),
			'default'  => 1170,
			'max'      => 1400,
			'min'      => 960,
		),
		array(
			'id'        => 'body-shadow',
			'type'      => 'select',
			'title'     => esc_html__( 'Body Shadow', 'ave' ),
			'subtitle'  => esc_html__( 'Select a style for shadow', 'ave' ),
			'options'   => array(
				''                           => esc_html__( 'None', 'ave' ),
				'site-boxed-layout-shadow-1' => esc_html__( '1', 'ave' ),
				'site-boxed-layout-shadow-2' => esc_html__( '2', 'ave' ),
				'site-boxed-layout-shadow-3' => esc_html__( '3', 'ave' ),
			),
			'required' => array(
				'page-layout',
				'equals',
				'boxed'
			),
		),
		//Body Background
		array(
			'id'       => 'body-background',
			'type'     => 'liquid_colorpicker',
			'title'    => esc_html__( 'Body Background Color', 'ave' ),
			'required' => array(
				'page-layout',
				'equals',
				'boxed'
			),
		),
		array(
			'id'       => 'body-background-image',
			'type'     => 'background',
			'background-color' => false,
			'preview'  => false,
			'title'   => esc_html__( 'Body Background Image', 'ave' ),
			'required' => array(
				'page-layout',
				'equals',
				'boxed'
			),
		),
		array(
			'id'        => 'body-color-scheme',
			'type'      => 'select',
			'title'     => esc_html__( 'Page Color Scheme', 'ave' ),
			'subtitle'  => esc_html__( 'Manages the color scheme across your website.', 'ave' ),
			'options'   => array(
				''      => esc_html__( 'Default', 'ave' ),
				'light'    => esc_html__( 'Light - (dark background and light content)', 'ave' ),
				'dark'     => esc_html__( 'Dark - (light background and dark content)', 'ave' ),
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
			'id'    => 'vc-row-default-margins',
			'type'  => 'spacing',
			'title'     => esc_html__( 'Row Margins', 'ave' ),
			'subtitle'  => esc_html__( 'Manages row margins', 'ave' ),
			'mode'  => 'margin',
			'left' => false,
			'right' => false,
			'units' => 'px',
		),
		array(
			'id'    => 'vc-row-default-padding',
			'type'  => 'spacing',
			'title'     => esc_html__( 'Row Padding', 'ave' ),
			'subtitle'  => esc_html__( 'Manages the rows padding', 'ave' ),
			'mode'  => 'padding',
			'units' => 'px',
		),

	)
);