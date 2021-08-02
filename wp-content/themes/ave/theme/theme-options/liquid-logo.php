<?php
/*
 * Logo Section
*/
$this->sections[] = array(
	'title'      => esc_html__( 'Logo', 'ave' ),
	'icon'  => 'el el-star',
	'fields'     => array(

		array(
			'id'       => 'logo-max-width',
			'type'     => 'text',
			'title'    => esc_html__( 'Maximum Logo Width', 'ave' ),
			'subtitle' => esc_html__( 'Define a maximum width for your logo, For instance, 120px', 'ave' )
		),
		array(
			'id'       => 'header-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Default Logo', 'ave' ),
			'subtitle' => esc_html__( 'Select an image as your logo.', 'ave' ),
			'desc'     => wp_kses_post( __( 'Please, resize the SVG logo before to upload it. Use this <a target="_blank" href="https://www.iloveimg.com/resize-image/resize-svg">Online Resize Tool</a>', 'ave' ) )
		),
		array(
			'id'       => 'header-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Retina Default Logo', 'ave' ),
			'subtitle' => esc_html__( 'Select an image as a default logo for the retina supported devices. Default retina logo should be 2x the size of the default logo.', 'ave' ),
			'desc'     => esc_html__( 'SVG logo doesn\'t need retina version', 'ave' ),
		),
		array(
			'id'       => 'header-sticky-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sticky Menu Default Logo', 'ave' ),
			'subtitle' => esc_html__( ' Select an image as your logo for sticky header.', 'ave' ),
		),
		array(
			'id'       => 'header-sticky-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sticky Menu Retina Default Logo', 'ave' ),
			'subtitle' => esc_html__( 'Select an image as a sticky menu default logo for the retina supported devices. Sticky menu retina default logo should be 2x the size of the logo.', 'ave' ),
		),
		array(
			'id'       => 'hover-header-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Hover State of Logo', 'ave' ),
			'subtitle' => esc_html__( 'Select an image as your logo to display on hover of logo', 'ave' ),
		),
		array(
			'id'       => 'hover-header-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Hover State of Retina Default Logo', 'ave' ),
			'subtitle' => esc_html__( 'Select an image as a hover state of logo for the retina supported devices. Retina version should be 2x size.', 'ave' ),
		),
		array(
			'id'       => 'menu-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Mobile Logo', 'ave' ),
			'subtitle' => esc_html__( 'Select the logo that will be displayed in the menu bar for mobile devices.', 'ave' ),
		),
		array(
			'id'       => 'menu-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Retina Mobile Logo', 'ave' ),
			'subtitle' => esc_html__( 'Select an image as a mobile default logo for the retina supported devices. Retina version should be 2x size.', 'ave' ),
		),
		array(
			'id'       => 'header-light-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Light Logo', 'ave' ),
			'subtitle' => esc_html__( 'Upload or select an image as your light logo.', 'ave' ),
		),
		array(
			'id'       => 'header-light-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Retina Light Logo', 'ave' ),
			'subtitle' => esc_html__( 'Upload or select an image for the retina version of the light logo. It should be exactly 2x the size of the logo.', 'ave' ),
		),		

		array(
			'id'       => 'header-dark-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Dark Logo', 'ave' ),
			'subtitle' => esc_html__( 'Upload or select an image as your dark logo.', 'ave' ),
		),
		array(
			'id'       => 'header-dark-logo-retina',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Retina Dark Logo', 'ave' ),
			'subtitle' => esc_html__( 'Upload or select an image for the retina version of the dark logo. It should be exactly 2x the size of the logo.', 'ave' ),
		),
		
		array(
			'id'       => 'favicon',
			'type'     => 'media',
			'title'    => esc_html__( 'Favicon', 'ave' ),
			'subtitle' => esc_html__( 'Select a favicon for your website (16px x 16px).', 'ave' )
		),

		array(
			'id'       => 'iphone_icon',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPhone Icon', 'ave' ),
			'subtitle' => esc_html__( 'Select a favicon for Apple iPhone (57px x 57px).', 'ave' )
		),

		array(
			'id'       => 'iphone_icon_retina',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPhone Retina Icon', 'ave' ),
			'subtitle' => esc_html__( 'Select a favicon for Apple iPhone Retina Version (114px x 114px).', 'ave' ),
			'required' => array(
				array( 'iphone_icon', '!=', '' ),
				array( 'iphone_icon', '!=', array( 'url'  => '' ) )
			)
		),

		array(
			'id'       => 'ipad_icon',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPad Icon', 'ave' ),
			'subtitle' => esc_html__( 'Select a favicon for Apple iPad (72px x 72px).', 'ave' )
		),

		array(
			'id'       => 'ipad_icon_retina',
			'type'     => 'media',
			'title'    => esc_html__( 'Apple iPad Retina Icon', 'ave' ),
			'subtitle' => esc_html__( 'Select a favicon for Apple iPad Retina Version (144px x 144px).', 'ave' ),
			'required' => array(
				array( 'ipad_icon', '!=', '' ),
				array( 'ipad_icon', '!=', array( 'url'  => '' ) )
			)
		)

	)
);