<?php
/*
 * Sidebar Section
*/

$sections[] = array(
	'post_types' => array( 'post', 'page' ),
	'title'      => esc_html__('Sidebars', 'ave'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(

		array(
			'id'       => 'liquid-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Select Sidebar', 'ave' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on this page. Choose "No Sidebar" for full width.', 'ave' ),
			'options'  => liquid_helper()->get_sidebars( array( 'none' => esc_html__( 'No Sidebar', 'ave' ), 'main' => esc_html__( 'Main Sidebar', 'ave' ) ) ),
		),

		array(
			'id'       => 'liquid-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar Position', 'ave' ),
			'subtitle' => esc_html__( 'Select the sidebar position. If sidebar 2 is selected, it will display on the opposite side. ', 'ave' ),
			'options'  => array(
				'left'    => esc_html__( 'Left', 'ave' ),
				'0'       => esc_html__( 'Default', 'ave' ),
				'right'   => esc_html__( 'Right', 'ave' )
			),
			'required' => array(
				array( 'liquid-sidebar-one', 'not', '' ),
				array( 'liquid-sidebar-one', 'not', 'none' )
			),
			'default' => '0'
		),
	)
);