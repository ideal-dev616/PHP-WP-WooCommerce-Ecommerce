<?php
/*
 * Extras Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Extras', 'ave'),
	'icon'   => 'el el-plus-sign'
);

// Miscelanios Fields
$this->sections[] = array(
	'title'  => esc_html__( 'Miscellaneous', 'ave' ),
	'subsection' => true,
	'fields' => array(
		
		array(
			'id'       => 'header-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Header', 'ave' ),
			'subtitle' => esc_html__( 'Switch off to hide the header on your website.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'on'
		),		
		array(
			'id' => 'footer-enable-switch',
			'type'	 => 'button_set',
			'title' => esc_html__('Footer', 'ave'),
			'subtitle' => esc_html__('Switch off to hide the footer on your website.', 'ave'),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),
		array(
			'id' => 'enable-ave-collection',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Ave Collection', 'ave' ),
			'subtitle' => esc_html__( 'Switch off to disabled the ave collection', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'on'
		),
		array(
			'id'       => 'footer-back-to-top',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Back To Top', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to display the back to top link', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'off'
		),
		array(
			'id'       => 'enable-animations-threshold',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Remove Inview Animation Threshold', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off'
		),
		array(
			'id'       => 'enable-lazy-load',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Lazy Load', 'ave' ),
			'subtitle' => esc_html__( 'Lazy load enables images to load only when they are in the viewport. Therefore, lazy load boosts the performance.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'on'
		),
		array(
			'id'       => 'enable-frame',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Page Frame', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to enable page frame', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'off'
		),
		array(
			'id'         => 'page-frame-v-color',
			'type'       => 'liquid_colorpicker',
			'title'      => esc_html__( 'Page Frame Vertical Background Color', 'ave' ),
			'subtitle'   => esc_html__( 'Choose a background color for vertical page frame', 'ave' ),
			'required' => array(
				'enable-frame',
				'=',
				'on'
			),
		),
		array(
			'id'         => 'page-frame-h-color',
			'type'       => 'liquid_colorpicker',
			'title'      => esc_html__( 'Page Frame Horizontal Background Color', 'ave' ),
			'subtitle'   => esc_html__( 'Choose a background color for horizontal page frame', 'ave' ),
			'required' => array(
				'enable-frame',
				'=',
				'on'
			),
		),
		array(
			'id'       => 'enable-preloader',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Preloader', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to enable preloader', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'off'
		),
		array(
			'id'       => 'preloader-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Preloader Style', 'ave' ),
			'subtitle' => esc_html__( 'Select preloder style', 'ave' ),
			'options'  => array(
				'curtain' => esc_html__( 'Curtain', 'ave' ),
				'fade'    => esc_html__( 'Fade', 'ave' ),
				'sliding' => esc_html__( 'Sliding', 'ave' ),
				'spinner' => esc_html__( 'Spinner', 'ave' ),
				'spinner-classical' => esc_html__( 'Spinner Classic', 'ave' ),
			),
			'required' => array(
				'enable-preloader',
				'=',
				'on'
			),
		),
		array(
			'id'         => 'preloader-color',
			'type'       => 'liquid_colorpicker',
			'title'      => esc_html__( 'Preloader Background Color', 'ave' ),
			'subtitle'   => esc_html__( 'Choose a background color for preloader', 'ave' ),
			'required' => array(
				'enable-preloader',
				'=',
				'on'
			),
		),
		array(
			'id'         => 'preloader-color-2',
			'type'       => 'liquid_colorpicker',
			'title'      => esc_html__( 'Preloader Background Color 2', 'ave' ),
			'subtitle'   => esc_html__( 'Choose a 2 background color for preloader', 'ave' ),
			'required' => array(
				'preloader-style',
				'=',
				'curtain'
			),
		),
		array(
			'id'         => 'preloader-elements-color',
			'type'       => 'liquid_colorpicker',
			'title'      => esc_html__( 'Preloader Elements Color', 'ave' ),
			'subtitle'   => esc_html__( 'Choose a color for preloader elements', 'ave' ),
			'required' => array(
				'preloader-style',
				'=',
				array( 'dots', 'signal' )
			),
		),
		array(
			'id'         => 'preloader-elements-color-2',
			'type'       => 'liquid_colorpicker',
			'only_solid' => true,
			'title'      => esc_html__( 'Preloader Elements Color', 'ave' ),
			'subtitle'   => esc_html__( 'Choose a color for preloader elements', 'ave' ),
			'required' => array(
				'preloader-style',
				'=',
				array( 'spinner' )
			),
		),
		array(
			'id'       => 'enable-help-beacon',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Help Beacon', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to enable Help Beacon in the dashboard', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'off'
		),
		array(
			'type'     => 'text',
			'id'       => 'pagescroll-speed',
			'title'    => esc_html__( 'Local scroll speed', 'ave' ),
			'subtitle'     => esc_html__( 'Please add scroll speed in milliseconds', 'ave' ),
		),
		
	)
);

// Theme Features
$this->sections[] = array(
	'title'      => esc_html__( 'Custom Icons', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'    => 'sh_theme_features',
			'type'  => 'raw',
			'class' => 'redux-sub-heading',
			'desc'  => '<h2>' . esc_html__( 'Manage Icons', 'ave' ) . '</h2>'
		),
		array(
			'id'       => 'font-icons',
			'type'     => 'select',
			'multi'    => true,
			'title'    => esc_html__( 'Custom Icon Fonts', 'ave' ),
			'subtitle' => esc_html__( 'Choose the icon Fonts', 'ave' ),
			'options'  => array(
				'liquid-none'  => esc_html__( 'None', 'ave' ),
				'liquid-icons' => esc_html__( 'Liquid Icons', 'ave' )
			),
			'default' => array( 'liquid-icons' ),
		),
		array(
			'id' => 'custom-icons-fonts',
			'type' => 'repeater',
			'title'    => esc_html__( 'Add Custom Icons', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
			'desc' => esc_html__( 'NOTE: All icons files should be uploaded via FTP on your server', 'ave' ),
			'sortable' => false,
			'group_values' => false,
						'fields' => array(
				
				array(
					'id' => 'custom_icon_font_title',
					'type' => 'text',
					'title'    => esc_html__( 'Title', 'ave' ),
					'placeholder' => esc_html__( 'Awesome Font', 'ave' ),
					'subtitle' => esc_html__( '', 'ave' ),
				),
				array(
					'id'    => 'custom_icon_font_css',
					'type'  => 'text',	
					'title' => esc_html__( 'Icon Css file', 'ave' ),
					'placeholder' => esc_html__( '', 'ave' ),
				),
				array(
					'id'    => 'custom_icons_classnames',
					'type'  => 'textarea',	
					'title' => esc_html__( 'Icons classnames', 'ave' ),
					'desc'  => esc_html__( 'Icon classnames should be separated by comma,for ex: icon-classname, icon-2-classname', 'ave' ),
				),
				array(
					'id'          => 'custom_icon_prefix',
					'type'        => 'text',
					'title'       => esc_html__( 'Prefix', 'ave' ),
					'placeholder' => esc_html__( 'fa', 'ave' ),
					'subtitle'    => esc_html__( 'Add a prefix for the icon, will add as classname for all icons.', 'ave' ),
				),
			)
		),		

	)
);
include_once( get_template_directory() . '/theme/theme-options/liquid-page-404.php' );

