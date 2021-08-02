<?php
/*
 * Footer Section
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
	'post_types' => array( 'liquid-footer' ),
	'title'      => esc_html__( 'Design Options', 'ave' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(

		array(
			'id'     => 'footer-fixed',
			'type'   => 'button_set',
			'title'  => esc_html__( 'Sticky Footer', 'ave' ),
			'subtitle' => esc_html__( 'If on, this footer will be sticky', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off',
		),

		array(
			'id'    => 'footer-text-color',
			'type'  => 'color_rgba',
			'title' => esc_html__( 'Text Color', 'ave' ),
		),
		array(
			'id'    => 'footer-link-color',
			'type'  => 'link_color',
			'title' => esc_html__( 'Link Color', 'ave' ),
		),

		array(
			'id'      => 'footer-bg',
			'type'	  => 'background',
			'title'   => esc_html__( 'Background', 'ave' ),
			'preview' => false,
		),
		array(
			'id'      => 'footer-gradient',
			'type'	  => 'liquid_colorpicker',
			'title'   => esc_html__( 'Color/Gradient Background', 'ave' ),
		),

		array(
			'id'    => 'footer-padding',
			'type'  => 'spacing',
			'title' => esc_html__( 'Padding', 'ave' ),
		)
	)
);
