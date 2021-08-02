<?php
/*
 * Portfolio
 */

$this->sections[] = array(
	'title'  => esc_html__( 'Portfolio', 'ave' ),
	'icon'   => 'el el-th-large'
);

$this->sections[] = array(
	'title'      => esc_html__( 'General', 'ave' ),
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id'       => 'portfolio-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Portfolio Archive Page Title', 'ave' ),
			'subtitle' => esc_html__( 'Display the portfolio archive page title.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'portfolio-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Portfolio Archive Page Title', 'ave' ),
			'desc'     => esc_html__( '[ld_category_title] shortcode displays the corresponding category title, any text can be added before or after the shortcode.', 'ave' ),
			'subtitle' => esc_html__( 'Manage the title of portfolio archive pages.', 'ave' ),
			'default'  => esc_html__( '[ld_category_title]', 'ave' ),
		),

		array(
			'id'      => 'portfolio-listing-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Portfolio Style', 'ave' ),
			'options' => array(
				'metro'              => esc_html__( 'Metro', 'ave' ),
				'masonry-classic'    => esc_html__( 'Masonry Classic', 'ave' ),
				'masonry-creative'   => esc_html__( 'Masonry Creative', 'ave' ),
				'grid'               => esc_html__( 'Grid', 'ave' ),
				'grid-alt'           => esc_html__( 'Grid Alt', 'ave' ),
				'grid-caption'       => esc_html__( 'Grid Caption', 'ave' ),
				'grid-hover-alt'     => esc_html__( 'Grid Hover Alt', 'ave' ),
				'grid-hover-3d'      => esc_html__( 'Grid Hover 3D', 'ave' ),
				'grid-hover-overlay' => esc_html__( 'Grid Hover Overlay', 'ave' ),
				'grid-hover-classic' => esc_html__( 'Grid Hover Classic', 'ave' ),
				'packery'            => esc_html__( 'Packery', 'ave' ),
				'packery-2'          => esc_html__( 'Packery 2', 'ave' ),
				'packery-3'          => esc_html__( 'Packery 3', 'ave' ),

			),
			'default'  => 'metro'
		),
		array(
			'id'       => 'portfolio-horizontal-alignment',
			'type'     => 'select',
			'title'    => esc_html__( 'Horizontal Alignment', 'ave' ),
			'subtitle' => esc_html__( 'Content horizontal alignment', 'ave' ),
			'options' => array(
				''                 => esc_html__( 'Default', 'ave' ),
				'pf-details-h-str' => esc_html__( 'Left', 'ave' ),
				'pf-details-h-mid' => esc_html__( 'Center', 'ave' ),
				'pf-details-h-end' => esc_html__( 'Right', 'ave' ),
			),
			'required' => array(
				'portfolio-style',
				'!=',
				array( 
					'grid-alt',
				),
			),
		),
		array(
			'id'       => 'portfolio-vertical-alignment',
			'type'     => 'select',
			'title'    => esc_html__( 'Vertical Alignment', 'ave' ),
			'subtitle' => esc_html__( 'Content vertical alignment', 'ave' ),
			'options' => array(
				'' => esc_html__( 'Default', 'ave' ),
				'pf-details-v-str' => esc_html__( 'Top', 'ave' ),
				'pf-details-v-mid' => esc_html__( 'Middle', 'ave' ),
				'pf-details-v-end' => esc_html__( 'Bottom', 'ave' ),
			),
			'required' => array(
				'portfolio-style',
				'!=',
				array( 
					'grid-alt',
				),
			),
		),
		array(
			'id' => 'portfolio-grid-columns',
			'type' => 'select',
			'title' => esc_html__( 'Columns', 'ave' ),
			'options' => array(
				'1' => '1 Column',
				'2' => '2 Columns',
				'3' => '3 Columns',
				'4' => '4 Columns',
				'6' => '6 Columns',
			),
			'required' => array(
				'portfolio-style',
				'equals',
				array( 
					'grid', 
					'grid-alt',
					'grid-caption', 
					'grid-hover-3d', 
					'grid-hover-alt',
					'grid-hover-overlay', 
					'masonry-creative', 
					'masonry-classic' 
				),
			),
		),
		array(
			'id'    => 'portfolio-columns-gap',
			'type'  => 'slider',
			'title' => esc_html__( 'Columns gap', 'ave' ),
			'min'     => 0,
			'max'     => 35,
			'default' => 15,
		),
		array(
			'id'       => 'portfolio-enable-parallax',
			'type'	   => 'switch',
			'title'    => esc_html__( 'Enable parallax?', 'ave' ),
			'subtitle' => esc_html__( 'Parallax for images', 'ave' ),
			'default'  => false
		),
		array(
			'type'  => 'text',
			'id'    => 'portfolio-category-slug',
			'title' => esc_html__( 'Portfolio Category Slug', 'ave' ),
			'description' => esc_html__( 'The slug name cannot be the same name as your portfolio page or the layout will break. This option changes the permalink when you use the permalink type as %postname%. Visit the Settings - Permalinks screen after changing this setting', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
		),
	)
);

$this->sections[] = array(
	'title'      => esc_html__( 'Portfolio Single', 'ave' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'portfolio-enable-header',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Header', 'ave' ),
			'subtitle' => esc_html__( 'Display the header', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),
		array(
			'id'       => 'portfolio-subtitle',
			'type'     => 'text',
			'title'    => esc_html__( 'Subtitle', 'ave' ),
			'subtitle' => esc_html__( 'Manage the subtitle of portfolio listing', 'ave' ),
		),
		array(
			'id'       => 'portfolio-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Portfolio Style', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
			'options' => array(
				'default'        => esc_html__( 'Default', 'ave' ),
				'gallery-slider' => esc_html__( 'Carousel', 'ave' ),
				'split'          => esc_html__( 'Split', 'ave' ),
			)
		),
		array(
			'id'       => 'portfolio-width',
			'type'     => 'select',
			'title'    => esc_html( 'Width', 'ave' ),
			'subtitle' => esc_html__( 'Defines the width of the featured image on the portfolio listing page', 'ave' ),
			'options'  => array(
				''     => esc_html__( 'Default', 'ave' ),
				'auto' => esc_html__( 'Auto - width determined by thumbnail width', 'ave' ),
				'2'    => esc_html__( '2 columns - 1/6', 'ave' ),
				'3'    => esc_html__( '3 columns - 1/4', 'ave' ),
				'4'    => esc_html__( '4 columns - 1/3', 'ave' ),
				'5'    => esc_html__( '5 columns - 5/12', 'ave' ),
				'6'    => esc_html__( '6 columns - 1/2', 'ave' ),
				'7'    => esc_html__( '7 columns - 7/12', 'ave' ),
				'8'    => esc_html__( '8 columns - 2/3', 'ave' ),
				'9'    => esc_html__( '9 columns - 3/4', 'ave' ),
				'10'   => esc_html__( '10 columns - 5/6', 'ave' ),
				'11'   => esc_html__( '11 columns - 11/12', 'ave' ),
				'12'   => esc_html__( '12 columns - 12/12', 'ave' ),
			)
		),
		array(
			'id'       => '_portfolio_image_size',
			'type'     => 'select',
			'title'    => esc_html__( 'Thumb Dimension', 'ave' ),
			'subtitle' => esc_html__( 'Choose a dimension for your portfolio thumb', 'ave' ),
			'options'  => array(

				'liquid-portfolio'          => esc_html__( 'Default - (370 x 300)', 'ave' ),
				'liquid-portfolio-sq'       => esc_html__( 'Square - (350 x 350)',     'ave' ),
				'liquid-portfolio-big-sq'   => esc_html__( 'Big Square - (600 x 600)', 'ave' ),
				'liquid-portfolio-portrait' => esc_html__( 'Portrait - (350 x 500)',   'ave' ),
				'liquid-portfolio-wide'     => esc_html__( 'Wide - (600 x 295)',       'ave' ),
				//Packery image sizes
				'liquid-packery-wide'     => esc_html__( 'Packery Wide - (570 x 370)', 'ave' ),
				'liquid-packery-portrait' => esc_html__( 'Packery Portrait - (270 x 370)', 'ave' ),
				
			)
		),
		array(
			'id'       => 'portfolio-social-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Social Sharing Module', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to display the social sharing module on single portfolio pages.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'portfolio-related-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Related Works', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to display related works on single portfolio pages.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),

		array(
			'type'    => 'text',
			'id'      => 'portfolio-related-title',
			'title'   => esc_html__( 'Related Works Title', 'ave' ),
			'default' => 'Related Works',
			'required' => array(
				'portfolio-related-enable',
				'equals',
				'on'
			)
		),
		array(
			'id'       => 'portfolio-related-style',
			'type'	   => 'select',
			'title'    => esc_html__( 'Related Works Style', 'ave' ),
			'subtitle' => esc_html__( 'Choose a style for related works on single portfolio posts.', 'ave' ),
			'options'  => array(
				'style1'   => esc_html__( 'Style 1', 'ave' ),
				'style2'   => esc_html__( 'Style 2', 'ave' ),
			),
			'required' => array(
				'portfolio-related-enable',
				'equals',
				'on'
			),
			'default' => 'style1'
		),

		array(
			'type'     => 'slider',
			'id'       => 'portfolio-related-number',
			'title'    => esc_html__( 'Number of Related Works', 'ave' ),
			'subtitle' => esc_html__( 'Manages the number of works that display on related works section.', 'ave' ),
			'default'  => 3,
			'max'      => 6,
			'required' => array(
				'portfolio-related-enable',
				'equals',
				'on'
			)
		),
		array(
			'id'       => 'portfolio-enable-date',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Date', 'ave' ),
			'subtitle' => esc_html__( 'Swtich on to show the date on your portfolio item.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default' => ''
		),
		array(
			'id'    => 'portfolio-date-label',
			'type'  => 'text',
			'title' => esc_html__( 'Label of Date', 'ave' ),
			'subtitle' => esc_html__( 'Translate or change the "date" text. Leave empty for no change.', 'ave' ),
			'required' => array(
				'portfolio-enable-date',
				'!=',
				'off'
			)			
		),

		array(
			'id'    => 'portfolio-date',
			'type'  => 'date',
			'title' => esc_html__( 'Date of Work', 'ave' ),
			'desc'  => esc_html__( 'Overwrites the portfolio post publish date.', 'ave' ),
			'required' => array(
				'portfolio-enable-date',
				'!=',
				'off'
			)			
		),
		array(
			'id'       => 'portfolio-website',
			'type'     => 'text',
			'validate' => 'url',
			'title'    => esc_html__( 'External URL', 'ave' )
		),
		array(
			'id'       => 'portfolio-website-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Label of Button', 'ave' ),
			'default'  => esc_html__( 'Launch', 'ave' ),
		),
		array(
			'type'  => 'text',
			'id'    => 'portfolio-single-slug',
			'title' => esc_html__( 'Portfolio Slug', 'ave' ),
			'description' => esc_html__( 'The slug name cannot be the same name as your portfolio page or the layout will break. This option changes the permalink when you use the permalink type as %postname%. Visit the Settings - Permalinks screen after changing this setting', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
		),
		
	)
);
