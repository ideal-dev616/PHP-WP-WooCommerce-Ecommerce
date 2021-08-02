<?php

$this->sections[] = array(
	'title'  => esc_html__( 'Woocommerce', 'ave' ),
	'icon'   => 'el-icon-shopping-cart',
	'fields' => array(

		array(
			'id'    => 'wc-archive-product-style',
			'type'  => 'select',	
			'title' => esc_html__( 'Woo Category Product Style', 'ave' ),
			'desc'  => esc_html__( 'Select a style for products to display on archive page', 'ave' ),
			'options' => array(
				'default'                => esc_html( 'Default', 'ave' ),
				'minimal'                => esc_html__( 'Minimal', 'ave' ),
				'minimal-2'              => esc_html__( 'Minimal 2', 'ave' ),
				'minimal-hover-shadow'   => esc_html__( 'Minimal Hover Shadow', 'ave' ),
				'minimal-hover-shadow-2' => esc_html__( 'Minimal Hover Shadow 2', 'ave' ),
			),
			'default' => 'default'
		),
		array(
			'id'       => 'wc-archive-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Category Title Bar', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to show the woo category title bar', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'wc-archive-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Title', 'ave' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the woo category', 'ave' ),
		),
		array(
			'id'       => 'wc-archive-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Subtitle', 'ave' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the woo category, for individual description use the category description field', 'ave' ),
		),
		array(
			'id'       => 'wc-archive-sorter-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Sorter By', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to show sorterby on shop/category page', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off'
		),
		array(
			'id'      => 'ld_woo_products_per_page',
			'type'    => 'text',	
			'title'   => esc_html__( 'Number of Products Displayed per Page', 'ave' ),
			'desc'    => esc_html__( 'This option works with predefined WooCommerce catalog page and category pages', 'ave' ),
			'default' => '9'
		),
		array(
			'id'      => 'ld_woo_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Products Per Row', 'ave' ),
			'desc'    => esc_html__( 'Define number of products per row to display on your predefined WooCommerce page and category pages', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 3
		),
		array(
			'id'             => 'ld_woo_columns_margin',
			'type'           => 'spacing',
			'mode'           => 'margin',
	        'units'          => array( '%', 'em', 'px' ),
	        'top'            => false,
	        'left'           => false,
	        'bottom'         => false,
			'units_extended' => 'true',
			'title'          => esc_html__( 'Products Columns Spacing', 'ave' ),
			'desc'           => esc_html__( 'Set custom margins for products columns', 'ave' ),
			'default'        => array(
				'margin-right' => '15px',
				'units' => 'px',
			),
		),
		array(
			'id'       => 'wc-enable-carousel-featured',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Carousel', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to enable carousel for featured images, will get the images from product gallery', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-add-to-cart-ajax-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Ajax add to cart ( single product )', 'ave' ),
			'subtitle' => esc_html__( 'Turn on enable ajax add to cart on single product page', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-share-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Single Product Share', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to show the share links', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'      => 'ld_woo_related_columns',
			'type'    => 'slider',	
			'title'   => esc_html__( 'Number of Related Products', 'ave' ),
			'desc'    => esc_html__( 'Define number of related products.', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 4
		),
		array(
			'id'      => 'ld_woo_cross_sell_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Displayed Cross-sells', 'ave' ),
			'desc'    => esc_html__( 'Define number of cross-sells display.', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 2
		),	
		array(
			'id'      => 'ld_woo_up_sell_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Displayed Up-sells', 'ave' ),
			'desc'    => esc_html__( 'Define number of up-sells display.', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 4
		),
	) 
);
