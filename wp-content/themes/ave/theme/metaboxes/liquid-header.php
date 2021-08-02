<?php

/*
 * Header Section
 *
 * Available options on $section array:
 * separate_box (avelean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/

$sections[] = array(
	'post_types' => array( 'post', 'page', 'liquid-portfolio' ),
	'title'      => esc_html__( 'Header', 'ave' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(

		array(
			'id'       => 'header-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Header', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default'  => ''
		),
		array(
 			'id'       => 'header-template',
 			'type'     => 'select',
 			'title'    => esc_html__( 'Header Style', 'ave'),
 			'subtitle' => esc_html__( 'Choose the header style amongst your headers, this option will overwrite the default header.', 'ave' ),
 			'data'     => 'post',
			'args'     => array( 
				'post_type'      => 'liquid-header', 
				'posts_per_page' => -1 
			)
 		),

	), // #fields
);