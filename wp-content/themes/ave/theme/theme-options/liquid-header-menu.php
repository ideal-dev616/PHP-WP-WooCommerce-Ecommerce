<?php
/*
 * Title Wrapper Section
*/

// Title Bar
$this->sections[] = array(
	'title'  => esc_html__( 'Menu', 'ave' ),
	'subsection' => true,
	'fields' => array(

		array(
			'id'          => 'nav_typography',
			'title'       => esc_html__( 'Menus Typography', 'ave' ),
			'description' => esc_html__( 'These settings control the typography for all menus.', 'ave' ),
			'type'        => 'typography',
			'text-align' => false,
			'line-height' => false,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false
		),
		
		array(
			'id'          => 'nav_mobile_typography',
			'title'       => esc_html__( 'Mobile Menus Typography', 'ave' ),
			'description' => esc_html__( 'These settings control the typography for mobile menu.', 'ave' ),
			'type'        => 'typography',
			'text-align' => false,
			'text-transform' => true,
			'color' => false,
			'letter-spacing' => true,
			'preview' => false,
			'subsets' => false
		),

		array(
			'id'          => 'nav_color',
			'title'       => esc_html__( 'Main Color', 'ave' ),
			'type'        => 'color_rgba',
		),

		array(
			'id'          => 'nav_secondary_color',
			'title'       => esc_html__( 'Secondary Color', 'ave' ),
			'type'        => 'color_rgba',
		),

		array(
			'id'          => 'nav_active_color',
			'title'       => esc_html__( 'Active Color', 'ave' ),
			'type'        => 'color_rgba',
		),

		array(
			'id' => 'nav_padding',
			'type'	 => 'spacing',
			'title' => esc_html__('Menu Item Padding', 'ave'),
			'top' => false, 'bottom' => false,
			'units' => array(
				'px',
				'%',
				'em',
				'rem'
			)
		),

		array(
			'id' => 'nav_logo_padding',
			'type'	 => 'spacing',
			'title' => esc_html__('Logo Padding', 'ave'),
			'units' => array(
				'px',
				'%',
				'em',
				'rem'
			)
		)
	)
);
