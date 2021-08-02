<?php
/*
 * Responsive rules
*/

// Responsivness
$this->sections[] = array(
	'title'      => esc_html__( 'Responsive', 'ave' ),
	'icon'       => 'el el-resize-horizontal',
	'fields'     => array(
		array(
			'type'     => 'slider',
			'id'       => 'media-mobile-nav',
			'title'    => esc_html__( 'Mobile Navigation Breakpoint', 'ave' ),
			'subtitle' => esc_html__( 'Set the breakpoint for the mobile navigation', 'ave' ),
			'default'  => 1199,
			'max'      => 1199,
			'min'      => 767,
		),
	)
);
