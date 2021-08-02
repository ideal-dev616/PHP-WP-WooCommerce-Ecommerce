<?php
/*
 * Header Modules Section
*/

$this->sections[] = array(
	'title'      => esc_html__( 'Modules', 'ave' ),
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id'       => 'header-enable-social',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Header Social', 'ave' ),
			'subtitle' => esc_html__( 'If on, will display social links in header.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
		),
		
		array(
			'id' => 'header-social-links',
			'type' => 'repeater',
			'title'    => esc_html__( 'Social Links', 'ave' ),
			'subtitle' => esc_html__( 'Add social links to display in header', 'ave' ),
			'sortable' => true,
			'group_values' => false,
			'required'  => array(
				'header-enable-social', 
				'equals', 
				'on'
			),
			'fields' => array(

				array(
					'id'    => 'social_label',
					'type'  => 'text',	
					'title' => esc_html__( 'Label', 'ave' ),
					'placeholder' => esc_html__( 'Link text', 'ave' ),
				),
				
				array(
					'id' => 'social_icon',
					'type' => 'iconpicker',
					'title'    => esc_html__( 'Icon', 'ave' ),
					'placeholder' => esc_html__( 'Select an icon', 'ave' ),
					'data'  => 'social-icons',
				),
				
				array(
					'id'    => 'social_url',
					'type'  => 'text',	
					'title' => esc_html__( 'URL', 'ave' ),
				),
				
			)
		),		
		
		array(
			'id'       => 'header-enable-button',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Header Button', 'ave' ),
			'subtitle' => esc_html__( 'If on, will display buttons in header.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
		),
		
		array(
			'id' => 'header-button',
			'type' => 'repeater',
			'title'    => esc_html__( 'Buttons', 'ave' ),
			'subtitle' => esc_html__( 'Add buttons to display in header', 'ave' ),
			'sortable' => true,
			'group_values' => false,
			'required'  => array(
				'header-enable-button', 
				'equals', 
				'on'
			),
			'fields' => array(

				array(
					'id'    => 'button_label',
					'type'  => 'text',	
					'title' => esc_html__( 'Label', 'ave' ),
					'placeholder' => esc_html__( 'Button text', 'ave' ),
				),
				
				array(
					'id' => 'button_icon',
					'type' => 'iconpicker',
					'title'    => esc_html__( 'Icon', 'ave' ),
					'placeholder' => esc_html__( 'Select an icon', 'ave' ),
				),
				
				array(
					'id'    => 'button_url',
					'type'  => 'text',	
					'title' => esc_html__( 'URL', 'ave' ),
				),
				
			)
		),
		
		array(
			'id'       => 'header-enable-text',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Header Text', 'ave' ),
			'subtitle' => esc_html__( 'If on, will display text in header.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
		),
		
		array(
			'id'       => 'header-text',
			'type'	   => 'textarea',
			'title'    => esc_html__( 'Header Text', 'ave' ),
			'required'  => array(
				'header-enable-text', 
				'equals', 
				'on'
			),
		),
		
	)
);	
