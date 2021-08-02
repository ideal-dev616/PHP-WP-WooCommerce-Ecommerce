<?php
/*
 * Portfoli General
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
	'post_types'   => array('liquid-portfolio'),
	'separate_box' => true,
	'box_title'    => esc_html__('Portfolio Description', 'ave'),
	'icon'         => 'el-icon-cog',
	'fields'       => array(

		array(
			'id'   => 'portfolio-description',
			'type' => 'editor'
		)
	)
);

$sections[] = array(
	'post_types' => array( 'liquid-portfolio' ),
	'title'      => esc_html__('Portfolio General', 'ave'),
	'icon'       => 'el-icon-cog',
	'fields'     => array(
		
		array(
			'id'       => 'portfolio-enable-header',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Header', 'ave' ),
			'subtitle' => esc_html__( 'Display the header', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'0'    => esc_html__( 'Default', 'ave' ),	
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
			'id'      => 'portfolio-split-bg',
			'type'	  => 'liquid_colorpicker',
			'title'   => esc_html__( 'Split Section Background Color', 'ave' ),
			'required' => array(
				'portfolio-style',
				'equals',
				'split'
			),
		),
		array(
			'id' => 'portfolio-split-items',
			'type' => 'repeater',
			'title' => esc_html__( 'Split Section Items', 'ave' ),
			'group_values' => true, 
			'fields' => array(
				array(
                    'id'          => 'pf_title_field',
                    'type'        => 'text',
                    'placeholder' => esc_html__( 'Title', 'ave' ),
                ),
                array(
                    'id'          => 'pf_text_field',
                    'type'        => 'textarea',
                    'placeholder' => __( 'Text', 'ave' ),
                ),
			),
			'required' => array(
				'portfolio-style',
				'equals',
				'split'
			),
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
				''                          => esc_html__( 'Select a size', 'ave' ),
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

	), // #fields
);
