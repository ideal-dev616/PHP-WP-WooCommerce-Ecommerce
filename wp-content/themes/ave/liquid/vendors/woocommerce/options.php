<?php

add_action( 'liquid_option_sidebars', 'liquid_woocommerce_option_sidebars' );

function liquid_woocommerce_option_sidebars( $obj ) {

	// Product Sidebar
	$obj->sections[] = array(
		'title'  => esc_html__('Products', 'ave'),
		'subsection' => true,
		'fields' => array(

			array(
				'id'       => 'wc-enable-global',
				'type'	   => 'button_set',
				'title'    => esc_html__( 'Activate Global Sidebar For Products', 'ave' ),
				'subtitle' => esc_html__( 'Turn on if you want to use the same sidebars on all product posts. This option overrides the product options.', 'ave' ),
				'options'  => array(
					'on'   => esc_html__( 'On', 'ave' ),
					'off'  => esc_html__( 'Off', 'ave' ),
				),
				'default' => 'off'
			),
			array(
				'id'       => 'wc-sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'Global Products Sidebar', 'ave' ),
				'subtitle' => esc_html__( 'Select sidebar that will display on all product posts.', 'ave' ),
				'data'     => 'sidebars'
			),
			array(
				'id'       => 'wc-sidebar-position',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Global Products Sidebar Position', 'ave' ),
				'subtitle' => esc_html__( 'Controls the position of the sidebar for all product posts.', 'ave' ),
				'options'  => array(
					'left'  => esc_html__( 'Left', 'ave' ),
					'right' => esc_html__( 'Right', 'ave' )
				),
				'default' => 'right'
			),
		)
	);

	// Product Archive Sidebar
	$obj->sections[] = array(
		'title'  => esc_html__( 'Product Archive', 'ave' ),
		'subsection' => true,
		'fields' => array(
			array(
				'id'       =>'wc-archive-sidebar-one',
				'type'     => 'select',
				'title'    => esc_html__( 'Product Archive Sidebar', 'ave' ),
				'subtitle' => esc_html__( 'Select sidebar 1 that will display on the product archive pages.', 'ave' ),
				'data'     => 'sidebars'
			),
			array(
				'id'       => 'wc-archive-sidebar-position',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Global Products Archive Sidebar Position', 'ave' ),
				'subtitle' => esc_html__( 'Controls the position of the sidebar for all product archives.', 'ave' ),
				'options'  => array(
					'left'  => esc_html__( 'Left', 'ave' ),
					'right' => esc_html__( 'Right', 'ave' )
				),
				'default' => 'right'
			),

		)
	);

}