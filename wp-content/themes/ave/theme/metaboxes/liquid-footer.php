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
	'post_types' => array( 'post', 'page', 'liquid-portfolio' ),
	'title' => esc_html__('Footer', 'ave'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id'       => 'footer-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Footer', 'ave' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'0'   => esc_html__( 'Default', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			)
		),

		array(
			'id'       => 'footer-template',
			'type'     => 'select',
			'title'    => esc_html__( 'Footer Style', 'ave' ),
			'subtitle' => esc_html__( 'Choose the footer style amongst you created, selecting a footer will overwrite the theme options.', 'ave' ),
			'data' => 'post',
			'args' => array(
				'post_type'      => 'liquid-footer',
				'posts_per_page' => -1
			),
			'required'  => array( 
				'footer-enable-switch', 
				'!=', 
				'off' 
			),
		)

	), // #fields
);
