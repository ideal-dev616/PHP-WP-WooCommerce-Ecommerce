<?php

/**
 * Format of the $css array:
 * $css['media-query']['element']['property'] = value
 *
 * If no media query is required then set it to 'global'
 *
 * If we want to add multiple values for the same property then we have to make it an array like this:
 * $css[media-query][element]['property'][] = value1
 * $css[media-query][element]['property'][] = value2
 *
 * Multiple values defined as an array above will be parsed separately.
 */
function liquid_dynamic_css_array() {

	$css = array();
	
	
	//Theme colors 
	$max_media_mobile_nav = liquid_helper()->get_option( 'media-mobile-nav' );
	if( empty( $max_media_mobile_nav ) ) {
		$max_media_mobile_nav = 1199;
	}
	$min_media_mobile_nav = $max_media_mobile_nav + 1;

	$primary_color    = liquid_helper()->get_option( 'primary_ac_color' );
	$secondary_color  = liquid_helper()->get_option( 'secondary_ac_color' );
	$primary_gradient = liquid_helper()->get_option( 'primary_gradient_color' ); 

	$link_colors = liquid_helper()->get_option( 'links_color' );

	if( !empty( $primary_color ) ) {
		$css['global'][ liquid_implode( ':root' ) ]['--color-primary'] = $primary_color;
	}
	if( !empty( $secondary_color ) ) {
		$css['global'][ liquid_implode( ':root' ) ]['--color-secondary'] = $secondary_color;
	}
	
	if( isset( $primary_gradient['from'] ) ) {
		$css['global'][ liquid_implode( ':root' ) ]['--color-gradient-start'] = $primary_gradient['from'];
	}
	if( isset( $primary_gradient['to'] ) ) {
		$css['global'][ liquid_implode( ':root' ) ]['--color-gradient-stop'] = $primary_gradient['to'];
	}

	if( !empty( $link_colors['regular'] ) ) {
		$css['global'][ liquid_implode( ':root' ) ]['--color-link'] = $link_colors['regular'];
	}
	if( !empty( $link_colors['hover'] ) ) {
		$css['global'][ liquid_implode( ':root' ) ]['--color-link-hover'] = $link_colors['hover'];
	}
	
	$page_frame_v_color = liquid_helper()->get_option( 'page-frame-v-color' );
	$page_frame_h_color = liquid_helper()->get_option( 'page-frame-h-color' );

	if( !empty( $page_frame_v_color ) ) {
		$css['global'][ liquid_implode( '.lqd-page-frame[data-orientation=v]' ) ]['background'] = $page_frame_v_color;
	}
	if( !empty( $page_frame_h_color ) ) {
		$css['global'][ liquid_implode( '.lqd-page-frame[data-orientation=h]' ) ]['background'] = $page_frame_h_color;
	}
	$woo_column_margin = liquid_helper()->get_option( 'ld_woo_columns_margin' );
	if( !empty( $woo_column_margin['margin-right'] ) ) {
		$css['global'][ liquid_implode( '.woocommerce ul.products, .woocommerce-page ul.products' ) ]['margin-left'] = '-' . $woo_column_margin['margin-right'];
		$css['global'][ liquid_implode( '.woocommerce ul.products, .woocommerce-page ul.products' ) ]['margin-right'] = '-' . $woo_column_margin['margin-right'];
		
		$css['global'][ liquid_implode( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product' ) ]['padding-left'] = $woo_column_margin['margin-right'];
		$css['global'][ liquid_implode( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product' ) ]['padding-right'] = $woo_column_margin['margin-right'];

	}
	
	/**
	 * Preloader
	 */
	$preloader_bg         = liquid_helper()->get_option( 'preloader-color' );
	$preloader_bg_2       = liquid_helper()->get_option( 'preloader-color-2' );
	$preloader_elements   = liquid_helper()->get_option( 'preloader-elements-color' );
	$preloader_elements_2 = liquid_helper()->get_option( 'preloader-elements-color-2' );
	$preloader_style      = liquid_helper()->get_option( 'preloader-style' );
	
	if( 'curtain' === $preloader_style ) {
		if( !empty( $preloader_bg ) ) {
			$css['global'][ liquid_implode( '.lqd-preloader-curtain-front' ) ]['background'] = $preloader_bg;
		}
		if( !empty( $preloader_bg_2 ) ) {
			$css['global'][ liquid_implode( '.lqd-preloader-curtain-back' ) ]['background'] = $preloader_bg_2;
		}
	}
	elseif( 'sliding' === $preloader_style ) {
		if( !empty( $preloader_bg ) ) {
			$css['global'][ liquid_implode( '.lqd-preloader-sliding-el' ) ]['background'] = $preloader_bg;
		}
	}
	else {
		if( !empty( $preloader_bg ) ) {
			$css['global'][ liquid_implode( '.lqd-preloader-wrap' ) ]['background'] = $preloader_bg;
		}		
	}
	if( !empty( $preloader_elements ) ) {
		$css['global'][ liquid_implode( '.lqd-preloader-dots-dot, .lqd-preloader-signal-circle' ) ]['background'] = $preloader_elements;
	}
	if( !empty( $preloader_elements_2 ) ) {
		$css['global'][ liquid_implode( '.lqd-spinner-circular circle' ) ]['background'] = $preloader_elements_2;
	}

	/**
	 * Body
	 */
	$body_typography = liquid_helper()->get_option( 'body_typography' );
	$css['global'][ liquid_implode( 'body' ) ] = array(
		'font-family'    => !empty( $body_typography['font-family'] ) ? wp_strip_all_tags( $body_typography['font-family'] ) : 'inherit',
		'font-weight'    => isset( $body_typography['font-weight'] ) ? intval( $body_typography['font-weight'] ) : '',
		'line-height'    => isset( $body_typography['line-height'] ) ? $body_typography['line-height'] : '',
		'letter-spacing' => isset( $body_typography['letter-spacing'] ) ? $body_typography['letter-spacing'] : '',
		'font-style'     => ! empty( $body_typography['font-style'] ) ? esc_attr( $body_typography['font-style'] ) : '',
		'font-size'      => isset( $body_typography['font-size'] ) ? $body_typography['font-size'] : '',
		'color'          => isset( $body_typography['color'] ) ? $body_typography['color'] : '',	
	);

	$body_bg = liquid_helper()->get_option( 'body-background' );
	$body_bg_image = liquid_helper()->get_theme_option( 'body-background-image' );
	if( !empty( $body_bg ) ) {
		$css['global'][ liquid_implode( '.site-boxed-layout' ) ]['background'] = $body_bg;
	}
	
	if( isset( $body_bg_image['background-color'] ) && ! empty( $body_bg_image['background-color'] ) ) {
		$css['global'][ liquid_implode( 'body' ) ]['background-color'] = $body_bg_image['background-color'];
	}	
	if( isset( $body_bg_image['background-image'] ) && ! empty( $body_bg_image['background-image'] ) ) {
		$css['global'][ liquid_implode( 'body' ) ]['background-image'] = 'url( ' . esc_url( $body_bg_image['background-image'] ) . ')';
	}	
	if( isset( $body_bg_image['background-repeat'] ) && ! empty( $body_bg_image['background-repeat'] ) ) {
		$css['global'][ liquid_implode( 'body' ) ]['background-repeat'] = $body_bg_image['background-repeat'];
	}	
	if( isset( $body_bg_image['background-size'] ) && ! empty( $body_bg_image['background-size'] ) ) {
		$css['global'][ liquid_implode( 'body' ) ]['background-size'] = $body_bg_image['background-size'];
	}
	if( isset( $body_bg_image['background-attachment'] ) && ! empty( $body_bg_image['background-attachment'] ) ) {
		$css['global'][ liquid_implode( 'body' ) ]['background-attachment'] = $body_bg_image['background-attachment'];
	}	
	if( isset( $body_bg_image['background-position'] ) && ! empty( $body_bg_image['background-position'] ) ) {
		$css['global'][ liquid_implode( 'body' ) ]['background-position'] = $body_bg_image['background-position'];
	}	



	/**
	 * Single Post Title
	 */
	$single_title_typography = liquid_helper()->get_option( 'single_title_typographyy' );
	$css['global'][ liquid_implode( 'body.single-post .blog-single-title' ) ] = array(
		'font-family'    => !empty( $single_title_typography['font-family'] ) ? wp_strip_all_tags( $single_title_typography['font-family'] ) : 'inherit',
		'font-weight'    => isset( $single_title_typography['font-weight'] ) ? intval( $single_title_typography['font-weight'] ) : '',
		'line-height'    => isset( $single_title_typography['line-height'] ) ? $single_title_typography['line-height'] : '',
		'letter-spacing' => isset( $single_title_typography['letter-spacing'] ) ? $single_title_typography['letter-spacing'] : '',
		'font-style'     => ! empty( $single_title_typography['font-style'] ) ? esc_attr( $single_title_typography['font-style'] ) : '',
		'font-size'      => isset( $single_title_typography['font-size'] ) ? $single_title_typography['font-size'] : '',
		'color'          => isset( $single_title_typography['color'] ) ? $single_title_typography['color'] : '',	
	);
	/**
	 * Single Post Content
	 */
	$single_typography = liquid_helper()->get_option( 'single_typography' );
	$css['global'][ liquid_implode( 'body.single-post .content' ) ] = array(
		'font-family'    => !empty( $single_typography['font-family'] ) ? wp_strip_all_tags( $single_typography['font-family'] ) : 'inherit',
		'font-weight'    => isset( $single_typography['font-weight'] ) ? intval( $single_typography['font-weight'] ) : '',
		'line-height'    => isset( $single_typography['line-height'] ) ? $single_typography['line-height'] : '',
		'letter-spacing' => isset( $single_typography['letter-spacing'] ) ? $single_typography['letter-spacing'] : '',
		'font-style'     => ! empty( $single_typography['font-style'] ) ? esc_attr( $single_typography['font-style'] ) : '',
		'font-size'      => isset( $single_typography['font-size'] ) ? $single_typography['font-size'] : '',
		'color'          => isset( $single_typography['color'] ) ? $single_typography['color'] : '',	
	);

	/**
	 * Headings
	 */
	$enable_default_typo = liquid_helper()->get_option( 'typo-default-enable' );

	// H1
	$h1_typography = liquid_helper()->get_option( 'h1_typography' );
	$css['global'][ liquid_implode( array( 'h1', '.h1' ) ) ] = array(
		'font-family'    => !empty( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : 'inherit',
		'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
		'line-height'    => isset( $h1_typography['line-height'] ) ? $h1_typography['line-height'] : '',
		'letter-spacing' => isset( $h1_typography['letter-spacing'] ) ? $h1_typography['letter-spacing'] : '',
		'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : '',
		'font-size'      => isset( $h1_typography['font-size'] ) ? $h1_typography['font-size'] : '',
		'color'          => isset( $h1_typography['color'] ) ? $h1_typography['color'] : '',	
	);

	//H2
	$h2_typography = liquid_helper()->get_option( 'h2_typography' );
	if( 'on' === $enable_default_typo ) {
		$css['global'][ liquid_implode( array( 'h2', '.h2' ) ) ] = array(
			'font-family'    => !empty( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
			'line-height'    => isset( $h2_typography['line-height'] ) ? $h2_typography['line-height'] : '',
			'letter-spacing' => isset( $h2_typography['letter-spacing'] ) ? $h2_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : '',
			'font-size'      => isset( $h2_typography['font-size'] ) ? $h2_typography['font-size'] : '',
			'color'          => isset( $h1_typography['color'] ) ? $h1_typography['color'] : '',
		);
	} else {
		$css['global'][ liquid_implode( array( 'h2', '.h2' ) ) ] = array(
			'font-family'    => !empty( $h2_typography['font-family'] ) ? wp_strip_all_tags( $h2_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h2_typography['font-weight'] ) ? intval( $h2_typography['font-weight'] ) : '',
			'line-height'    => isset( $h2_typography['line-height'] ) ? $h2_typography['line-height'] : '',
			'letter-spacing' => isset( $h2_typography['letter-spacing'] ) ? $h2_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h2_typography['font-style'] ) ? esc_attr( $h2_typography['font-style'] ) : '',
			'font-size'      => isset( $h2_typography['font-size'] ) ? $h2_typography['font-size'] : '',
			'color'           => isset( $h2_typography['color'] ) ? $h2_typography['color'] : '',
			
		);
	}

	// H3
	$h3_typography = liquid_helper()->get_option( 'h3_typography' );
	if( 'on' === $enable_default_typo ) {
		$css['global'][ liquid_implode( array( 'h3', '.h3' ) ) ] = array(
			'font-family'    => !empty( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
			'line-height'    => isset( $h3_typography['line-height'] ) ? $h3_typography['line-height'] : '',
			'letter-spacing' => isset( $h3_typography['letter-spacing'] ) ? $h3_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : '',
			'font-size'      => isset( $h3_typography['font-size'] ) ? $h3_typography['font-size'] : '',
			'color'          => isset( $h1_typography['color'] ) ? $h1_typography['color'] : '',
		);
	} else {
		$css['global'][ liquid_implode( array( 'h3', '.h3' ) ) ] = array(
			'font-family'    => !empty( $h3_typography['font-family'] ) ? wp_strip_all_tags( $h3_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h3_typography['font-weight'] ) ? intval( $h3_typography['font-weight'] ) : '',
			'line-height'    => isset( $h3_typography['line-height'] ) ? $h3_typography['line-height'] : '',
			'letter-spacing' => isset( $h3_typography['letter-spacing'] ) ? $h3_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h3_typography['font-style'] ) ? esc_attr( $h3_typography['font-style'] ) : '',
			'font-size'      => isset( $h3_typography['font-size'] ) ? $h3_typography['font-size'] : '',
			'color'          => isset( $h3_typography['color'] ) ? $h3_typography['color'] : '',
		);
	}

	// H4
	$h4_typography = liquid_helper()->get_option( 'h4_typography' );
	if( 'on' === $enable_default_typo ) {
		$css['global'][ liquid_implode( array( 'h4', '.h4' ) ) ] = array(
			'font-family'    => !empty( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
			'line-height'    => isset( $h4_typography['line-height'] ) ? $h4_typography['line-height'] : '',
			'letter-spacing' => isset( $h4_typography['letter-spacing'] ) ? $h4_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : '',
			'font-size'      => isset( $h4_typography['font-size'] ) ? $h4_typography['font-size'] : '',
			'color'          => isset( $h1_typography['color'] ) ? $h4_typography['color'] : '',
		);
	} else {
		$css['global'][ liquid_implode( array( 'h4', '.h4' ) ) ] = array(
			'font-family'    => !empty( $h4_typography['font-family'] ) ? wp_strip_all_tags( $h4_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h4_typography['font-weight'] ) ? intval( $h4_typography['font-weight'] ) : '',
			'line-height'    => isset( $h4_typography['line-height'] ) ? $h4_typography['line-height'] : '',
			'letter-spacing' => isset( $h4_typography['letter-spacing'] ) ? $h4_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h4_typography['font-style'] ) ? esc_attr( $h4_typography['font-style'] ) : '',
			'font-size'      => isset( $h4_typography['font-size'] ) ? $h4_typography['font-size'] : '',
			'color'          => isset( $h4_typography['color'] ) ? $h4_typography['color'] : '',
		);
	}

	// H5
	$h5_typography = liquid_helper()->get_option( 'h5_typography' );
	if( 'on' === $enable_default_typo ) {
		$css['global'][ liquid_implode( array( 'h5', '.h5' ) ) ] = array(
			'font-family'    => !empty( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
			'line-height'    => isset( $h5_typography['line-height'] ) ? $h5_typography['line-height'] : '',
			'letter-spacing' => isset( $h5_typography['letter-spacing'] ) ? $h5_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : '',
			'font-size'      => isset( $h5_typography['font-size'] ) ? $h5_typography['font-size'] : '',
			'color'          => isset( $h1_typography['color'] ) ? $h1_typography['color'] : '',
		);
	} else {
		$css['global'][ liquid_implode( array( 'h5', '.h5' ) ) ] = array(
			'font-family'    => !empty( $h5_typography['font-family'] ) ? wp_strip_all_tags( $h5_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h5_typography['font-weight'] ) ? intval( $h5_typography['font-weight'] ) : '',
			'line-height'    => isset( $h5_typography['line-height'] ) ? $h5_typography['line-height'] : '',
			'letter-spacing' => isset( $h5_typography['letter-spacing'] ) ? $h5_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h5_typography['font-style'] ) ? esc_attr( $h5_typography['font-style'] ) : '',
			'font-size'      => isset( $h5_typography['font-size'] ) ? $h5_typography['font-size'] : '',
			'color'          => isset( $h5_typography['color'] ) ? $h5_typography['color'] : '',
			
		);
	}

	// H6
	$h6_typography = liquid_helper()->get_option( 'h6_typography' );
	if( 'on' === $enable_default_typo ) {
		$css['global'][ liquid_implode( array( 'h6', '.h6' ) ) ] = array(
			'font-family'    => !empty( $h1_typography['font-family'] ) ? wp_strip_all_tags( $h1_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h1_typography['font-weight'] ) ? intval( $h1_typography['font-weight'] ) : '',
			'line-height'    => isset( $h6_typography['line-height'] ) ? $h6_typography['line-height'] : '',
			'letter-spacing' => isset( $h6_typography['letter-spacing'] ) ? $h6_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h1_typography['font-style'] ) ? esc_attr( $h1_typography['font-style'] ) : '',
			'font-size'      => isset( $h6_typography['font-size'] ) ? $h6_typography['font-size'] : '',
			'color'          => isset( $h1_typography['color'] ) ? $h1_typography['color'] : '',
		);
	} else {
		$css['global'][ liquid_implode( array( 'h6', '.h6' ) ) ] = array(
			'font-family'    => !empty( $h6_typography['font-family'] ) ? wp_strip_all_tags( $h6_typography['font-family'] ) : 'inherit',
			'font-weight'    => isset( $h6_typography['font-weight'] ) ? intval( $h6_typography['font-weight'] ) : '',
			'line-height'    => isset( $h6_typography['line-height'] ) ? $h6_typography['line-height'] : '',
			'letter-spacing' => isset( $h6_typography['letter-spacing'] ) ? $h6_typography['letter-spacing'] : '',
			'font-style'     => ! empty( $h6_typography['font-style'] ) ? esc_attr( $h6_typography['font-style'] ) : '',
			'font-size'      => isset( $h6_typography['font-size'] ) ? $h6_typography['font-size'] : '',
			'color'          => isset( $h6_typography['color'] ) ? $h6_typography['color'] : '',
		);
	}
	
	//Logo max-width
	$logo_max_width = liquid_helper()->get_option( 'logo-max-width' );
	if( ! empty( $logo_max_width ) ) {
		$css['global'][ liquid_implode( '.main-header .navbar-brand' ) ]['max-width'] = esc_attr( $logo_max_width ) . ' !important';
	}
	
	//Titlebar Heading
	$titlebar_global_typo         = liquid_helper()->get_theme_option( 'title-bar-typography' );
	$titlebar_heading_typography  = liquid_helper()->get_post_meta( 'title-bar-typography' );

	//Custom Typography for titlebar heading H1
	$css['global'][ liquid_implode( '.titlebar-inner h1' ) ] = array(

		'font-family'    => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-family' ),
		'font-size'      => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-size' ),
		'font-weight'    => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-weight' ),
		'text-transform' => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'text-transform' ),
		'font-style'     => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'font-style' ),
		'text-align'     => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'text-align' ),
		'line-height'    => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'line-height' ),
		'letter-spacing' => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'letter-spacing' ),
		'color'          => liquid_helper()->get_typography_option( $titlebar_global_typo, $titlebar_heading_typography, 'color' ),

	);

	//Titlebar SubHeading
	$titlebar_sub_global_typo        = liquid_helper()->get_theme_option( 'title-bar-subheading-typography' );
	$titlebar_subheading_typography  = liquid_helper()->get_post_meta( 'title-bar-subheading-typography' );

	$css['global'][ liquid_implode( '.titlebar-inner p' ) ] = array(
		'font-family'    => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-family' ),
		'font-size'      => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-size' ),
		'font-weight'    => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-weight' ),
		'text-transform' => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'text-transform' ),
		'font-style'     => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'font-style' ),
		'text-align'     => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'text-align' ),
		'line-height'    => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'line-height' ),
		'letter-spacing' => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'letter-spacing' ),
		'color'          => liquid_helper()->get_typography_option( $titlebar_sub_global_typo, $titlebar_subheading_typography, 'color' ),
	);
	
	//Titlebar Paddings
	$titlebar_top_padding_global = liquid_helper()->get_theme_option( 'title-bar-padding-top' );
	$titlebar_top_padding        = liquid_helper()->get_post_meta( 'title-bar-padding-top' );
	
	if( !empty( $titlebar_top_padding ) ) {
		$css['global'][ liquid_implode( '.titlebar-inner' ) ]['padding-top'] = $titlebar_top_padding . 'px';
	}
	elseif( '200' !== $titlebar_top_padding_global && !empty( $titlebar_top_padding_global ) ) {
		$css['global'][ liquid_implode( '.titlebar-inner' ) ]['padding-top'] = $titlebar_top_padding_global . 'px';
	}
	
	$titlebar_bottom_padding_global = liquid_helper()->get_theme_option( 'title-bar-padding-bottom' );
	$titlebar_bottom_padding        = liquid_helper()->get_post_meta( 'title-bar-padding-bottom' );
	
	if( !empty( $titlebar_bottom_padding ) ) {
		$css['global'][ liquid_implode( '.titlebar-inner' ) ]['padding-bottom'] = $titlebar_bottom_padding . 'px';
	}
	elseif( '200' !== $titlebar_bottom_padding_global && !empty( $titlebar_bottom_padding_global ) ) {
		$css['global'][ liquid_implode( '.titlebar-inner' ) ]['padding-bottom'] = $titlebar_bottom_padding_global . 'px';
	}
	
	//Titlebar background
	$titlebar_bg_global = liquid_helper()->get_theme_option( 'title-bar-bg' );
	$titlebar_bg        = liquid_helper()->get_post_meta( 'title-bar-bg' );
	
	$titlebar_bg_woo = $titlebar_bg_woo_url = '';
	if( class_exists( 'WooCommerce' ) && ( is_product_taxonomy() || is_product_category() ) ) {
		$titlebar_bg_woo    = get_term_meta( get_queried_object_id(), 'thumbnail_id', true );
		$titlebar_bg_woo_url = wp_get_attachment_url( $titlebar_bg_woo );
	}
	
	$titlebar_gr_global = liquid_helper()->get_theme_option( 'title-bar-bg-gradient' );
	$titlebar_gr        = liquid_helper()->get_post_meta( 'title-bar-bg-gradient' );

	if( is_search(  ) ) {
		if( isset( $titlebar_bg_global['background-color'] ) && ! empty( $titlebar_bg_global['background-color'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-color'] = $titlebar_bg_global['background-color'];
		}
		if( isset( $titlebar_bg_global['background-image'] ) && ! empty( $titlebar_bg_global['background-image'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-image'] = 'url( ' . esc_url( $titlebar_bg_global['background-image'] ) . ')';
		}
		if( isset( $titlebar_bg_global['background-repeat'] ) && ! empty( $titlebar_bg_global['background-repeat'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-repeat'] = $titlebar_bg_global['background-repeat'];
		}
		if( isset( $titlebar_bg_global['background-size'] ) && ! empty( $titlebar_bg_global['background-size'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-size'] = $titlebar_bg_global['background-size'];
		}
		if( isset( $titlebar_bg_global['background-attachment'] ) && ! empty( $titlebar_bg_global['background-attachment'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-attachment'] = $titlebar_bg_global['background-attachment'];
		}
		if( isset( $titlebar_bg_global['background-position'] ) && ! empty( $titlebar_bg_global['background-position'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-position'] = $titlebar_bg_global['background-position'];
		}
		if( !empty( $titlebar_gr_global ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background'] = $titlebar_gr_global;
		}
	}
	else {
		if( isset( $titlebar_bg['background-color'] ) && ! empty( $titlebar_bg['background-color'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-color'] = $titlebar_bg['background-color'];
		}
		elseif( isset( $titlebar_bg_global['background-color'] ) && ! empty( $titlebar_bg_global['background-color'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-color'] = $titlebar_bg_global['background-color'];
		}
		
		//Image Background for the titlebar
		if( class_exists( 'WooCommerce' ) && ( is_product_taxonomy() || is_product_category() ) && !empty( $titlebar_bg_woo_url ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-image'] = 'url( ' . esc_url( $titlebar_bg_woo_url ) . ')';
		}
		elseif( isset( $titlebar_bg['background-image'] ) && ! empty( $titlebar_bg['background-image'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-image'] = 'url( ' . esc_url( $titlebar_bg['background-image'] ) . ')';
		}
		elseif( isset( $titlebar_bg_global['background-image'] ) && ! empty( $titlebar_bg_global['background-image'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-image'] = 'url( ' . esc_url( $titlebar_bg_global['background-image'] ) . ')';
		}
		
		if( isset( $titlebar_bg['background-repeat'] ) && ! empty( $titlebar_bg['background-repeat'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-repeat'] = $titlebar_bg['background-repeat'];
		}
		elseif( isset( $titlebar_bg_global['background-repeat'] ) && ! empty( $titlebar_bg_global['background-repeat'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-repeat'] = $titlebar_bg_global['background-repeat'];
		}
		
		if( isset( $titlebar_bg['background-size'] ) && ! empty( $titlebar_bg['background-size'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-size'] = $titlebar_bg['background-size'];
		}
		elseif( isset( $titlebar_bg_global['background-size'] ) && ! empty( $titlebar_bg_global['background-size'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-size'] = $titlebar_bg_global['background-size'];
		}
		
		if( isset( $titlebar_bg['background-attachment'] ) && ! empty( $titlebar_bg['background-attachment'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-attachment'] = $titlebar_bg['background-attachment'];
		}
		elseif( isset( $titlebar_bg_global['background-attachment'] ) && ! empty( $titlebar_bg_global['background-attachment'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-attachment'] = $titlebar_bg_global['background-attachment'];
		}
		
		if( isset( $titlebar_bg['background-position'] ) && ! empty( $titlebar_bg['background-position'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-position'] = $titlebar_bg['background-position'];
		}
		elseif( isset( $titlebar_bg_global['background-position'] ) && ! empty( $titlebar_bg_global['background-position'] ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background-position'] = $titlebar_bg_global['background-position'];
		}
		
		if( !empty( $titlebar_gr ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background'] = $titlebar_gr;
		}
		elseif( !empty( $titlebar_gr_global ) ) {
			$css['global'][ liquid_implode( '.titlebar' ) ]['background'] = $titlebar_gr_global;
		}
	}
	
	//Titlebar Overlay
	$titlebar_overlay_bg = liquid_helper()->get_option( 'title-bar-overlay-background' );	
	if( !empty( $titlebar_overlay_bg ) ) {
		$css['global'][ liquid_implode( '.titlebar > .titlebar-overlay.ld-overlay' ) ]['background'] = $titlebar_overlay_bg;
	}
	
	//Titlebar scroll button
	$titlebar_scroll_color = liquid_helper()->get_option( 'title-bar-scroll-color' );
	if( !empty( $titlebar_scroll_color ) ) {
		$css['global'][ liquid_implode( '.titlebar .titlebar-scroll-link' ) ]['color'] = $titlebar_scroll_color;
	}

	
	//Content background
	$page_content_bg_global = liquid_helper()->get_theme_option( 'page-content-bg' );	
	$page_content_bg = liquid_helper()->get_post_meta( 'page-content-bg' );
	
	$page_content_gr_global = liquid_helper()->get_theme_option( 'page-content-gradient' );
	$page_content_gr = liquid_helper()->get_post_meta( 'page-content-gradient' );

	if( isset( $page_content_bg['background-color'] ) && ! empty( $page_content_bg['background-color'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-color'] = $page_content_bg['background-color'];
	}
	elseif( isset( $page_content_bg_global['background-color'] ) && ! empty( $page_content_bg_global['background-color'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-color'] = $page_content_bg_global['background-color'];
	}
	
	if( isset( $page_content_bg['background-image'] ) && ! empty( $page_content_bg['background-image'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-image'] = 'url( ' . esc_url( $page_content_bg['background-image'] ) . ')';
	}
	elseif( isset( $page_content_bg_global['background-image'] ) && ! empty( $page_content_bg_global['background-image'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-image'] = 'url( ' . esc_url( $page_content_bg_global['background-image'] ) . ')';
	}
	
	if( isset( $page_content_bg['background-repeat'] ) && ! empty( $page_content_bg['background-repeat'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-repeat'] = $page_content_bg['background-repeat'];
	}
	elseif( isset( $page_content_bg_global['background-repeat'] ) && ! empty( $page_content_bg_global['background-repeat'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-repeat'] = $page_content_bg_global['background-repeat'];
	}
	
	if( isset( $page_content_bg['background-size'] ) && ! empty( $page_content_bg['background-size'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-size'] = $page_content_bg['background-size'];
	}
	elseif( isset( $page_content_bg_global['background-size'] ) && ! empty( $page_content_bg_global['background-size'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-size'] = $page_content_bg_global['background-size'];
	}
	
	if( isset( $page_content_bg['background-attachment'] ) && ! empty( $page_content_bg['background-attachment'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-attachment'] = $page_content_bg['background-attachment'];
	}
	elseif( isset( $page_content_bg_global['background-attachment'] ) && ! empty( $page_content_bg_global['background-attachment'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-attachment'] = $page_content_bg_global['background-attachment'];
	}
	
	if( isset( $page_content_bg['background-position'] ) && ! empty( $page_content_bg['background-position'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-position'] = $page_content_bg['background-position'];
	}
	elseif( isset( $page_content_bg_global['background-position'] ) && ! empty( $page_content_bg_global['background-position'] ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background-position'] = $page_content_bg_global['background-position'];
	}
	
	if( !empty( $page_content_gr ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background'] = $page_content_gr;
	}
	elseif( !empty( $page_content_gr_global ) ) {
		$css['global'][ liquid_implode( '#content' ) ]['background'] = $page_content_gr_global;
	}

	//VC Row default paddings and margins
	$vc_row_margins  = liquid_helper()->get_option( 'vc-row-default-margins' );
	$vc_row_paddings = liquid_helper()->get_option( 'vc-row-default-padding' );
	
	if( is_array( $vc_row_margins ) ) {
		foreach( $vc_row_margins as $key => $value ) {
			if( !empty( $value ) ) {
				$css['global'][ liquid_implode( 'section.vc_row' ) ][$key] = $value;
			}
		}
	}
	if( is_array( $vc_row_paddings ) ) {
		foreach( $vc_row_paddings as $key => $value ) {
			if( !empty( $value ) ) {
				$css['global'][ liquid_implode( 'section.vc_row' ) ][$key] = $value;
			}
		}
	}

	//Header customization
	$header_selectors   = array( '.main-header' );
	$header_bg_type     = liquid_helper()->get_option( 'header-background-type' );
	$header_bg          = liquid_helper()->get_option( 'header-bg' );
	$header_bg_gradient = liquid_helper()->get_option( 'header-bar-gradient' );
	
	if( 'solid' === $header_bg_type && ! empty( $header_bg ) ) {
		
		$header_bg = liquid_parse_bg( $header_bg );				
		$css['global'][ liquid_implode( $header_selectors ) ] = $header_bg;

	}
	elseif( ! empty( $header_bg_gradient ) && 'gradient' === $header_bg_type ) {
		
		if( function_exists( 'liquid_parse_gradient' ) ) {
			
			$header_bg = liquid_parse_gradient( $header_bg_gradient );
			$css['global'][ liquid_implode( $header_selectors ) ]['background'] = $header_bg['background-image'];
				
		}
	}
	
	//Sticky Header
	$header_id                 = liquid_get_custom_header_id();
	$header_sticky_bg          = get_post_meta( $header_id, 'header-sticky-bg', true );
	$header_sticky_color       = get_post_meta( $header_id, 'header-sticky-color', true );
	$header_sticky_hover_color = get_post_meta( $header_id, 'header-sticky-hover-color', true );
	$header_fullscreen_nav_bg  = get_post_meta( $header_id, 'header-fullscreen-nav-bg', true );

	if( !empty( $header_sticky_bg ) ) {
		$css['@media ( min-width: ' . $min_media_mobile_nav . 'px )'][ liquid_implode( array( '.main-header .is-stuck' ) ) ]['background'] = $header_sticky_bg . ' !important';
	}
	if( !empty( $header_sticky_color ) ) {
		$css['@media ( min-width: ' . $min_media_mobile_nav . 'px )'][ liquid_implode( array( '.mainbar-wrap.is-stuck .social-icon:not(.branded):not(.branded-text) a, .mainbar-wrap.is-stuck .header-module .ld-module-trigger, .mainbar-wrap.is-stuck .main-nav > li > a, .mainbar-wrap.is-stuck .ld-module-search-visible-form .ld-search-form input, .mainbar-wrap.is-stuck .header-module .lqd-custom-menu > li > a' ) ) ]['color'] = $header_sticky_color . ' !important';
		$css['@media ( min-width: ' . $min_media_mobile_nav . 'px )'][ liquid_implode( array( '.mainbar-wrap.is-stuck .mainbar-wrap.is-stuck .header-module .nav-trigger .bar' ) ) ]['background-color'] = $header_sticky_color . ' !important';
		$css['@media ( min-width: ' . $min_media_mobile_nav . 'px )'][ liquid_implode( array( '.mainbar-wrap.is-stuck .header-module .ld-module-trigger-icon, .mainbar-wrap.is-stuck .header-module .ld-module-trigger-txt' ) ) ]['color'] = 'inherit !important';
		$css['@media ( min-width: ' . $min_media_mobile_nav . 'px )'][ liquid_implode( array( '.mainbar-wrap.is-stuck .ld-module-search-visible-form .ld-search-form input' ) ) ]['border-color'] = $header_sticky_color . ' !important';
	}
	if( !empty( $header_sticky_hover_color ) ) {
		$css['@media ( min-width: ' . $min_media_mobile_nav . 'px )'][ liquid_implode( array( '.mainbar-wrap.is-stuck .social-icon:not(.branded):not(.branded-text) a:hover, .mainbar-wrap.is-stuck .main-nav > li > a:hover, .mainbar-wrap.is-stuck .header-module .lqd-custom-menu > li > a:hover' ) ) ]['color'] = $header_sticky_hover_color . ' !important';
	}
	if( !empty( $header_fullscreen_nav_bg ) ) {
		$css['@media ( min-width: ' . $min_media_mobile_nav . 'px )'][ liquid_implode( array( '.header-fullscreen .navbar-fullscreen' ) ) ]['background'] = $header_fullscreen_nav_bg . '!important';
	}

	//Mobile header customization
	$header_custom_bg_global    = liquid_helper()->get_theme_option( 'm-nav-header-custom-bg' );
	$header_custom_color_global = liquid_helper()->get_theme_option( 'm-nav-header-custom-color' );
	$header_custom_bg           = get_post_meta( $header_id, 'm-nav-header-custom-bg', true );
	$header_custom_color        = get_post_meta( $header_id, 'm-nav-header-custom-color', true );
	
	if( !empty( $header_custom_bg ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '.main-header .navbar-header' ) ]['background'] = $header_custom_bg;
	}
	elseif( !empty( $header_custom_bg_global ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '.main-header .navbar-header' ) ]['background'] = $header_custom_bg_global;
	}

	if( !empty( $header_custom_color ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '.main-header .ld-module-trigger, .main-header .ld-search-form .input-icon' ) ]['color'] = $header_custom_color;
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '.main-header .nav-trigger .bar' ) ]['background-color'] = $header_custom_color;
	}
	elseif( !empty( $header_custom_color_global ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '.main-header .ld-module-trigger, .main-header .ld-search-form .input-icon' ) ]['color'] = $header_custom_color_global;
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '.main-header .nav-trigger .bar' ) ]['background-color'] = $header_custom_color_global;
	}
	
	//Mobile navigation customization
	$nav_custom_bg_global    = liquid_helper()->get_theme_option( 'm-nav-custom-bg' );
	$nav_custom_color_global = liquid_helper()->get_theme_option( 'm-nav-custom-color' );
	$nav_border_color_global = liquid_helper()->get_theme_option( 'm-nav-border-color' );
	$nav_custom_bg           = get_post_meta( $header_id, 'm-nav-custom-bg', true );
	$nav_custom_color        = get_post_meta( $header_id, 'm-nav-custom-color', true );
	$nav_border_color        = get_post_meta( $header_id, 'm-nav-border-color', true );


	$nav_modern_bg_global    = liquid_helper()->get_theme_option( 'm-nav-modern-bg' );
	$nav_modern_color_global = liquid_helper()->get_theme_option( 'm-nav-modern-color' );
	$nav_modern_bg           = get_post_meta( $header_id, 'm-nav-modern-bg', true );
	$nav_modern_color        = get_post_meta( $header_id, 'm-nav-modern-color', true );	
	
	
	if( !empty( $nav_custom_bg ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=classic] .navbar-collapse, body[data-mobile-nav-style=minimal] .navbar-collapse' ) ]['background'] = $nav_custom_bg;
	}
	elseif( !empty( $nav_custom_bg_global ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=classic] .navbar-collapse, body[data-mobile-nav-style=minimal] .navbar-collapse' ) ]['background'] = $nav_custom_bg_global;
	}
	
	if( !empty( $nav_modern_bg ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=modern]:before' ) ]['background'] = $nav_modern_bg;
	}
	elseif( !empty( $nav_modern_bg_global ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=modern]:before' ) ]['background'] = $nav_modern_bg_global;
	}

	if( !empty( $nav_custom_color ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=classic] .navbar-collapse, body[data-mobile-nav-style=minimal] .navbar-collapse' ) ]['color'] = $nav_custom_color;
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'ul.nav.main-nav > li > a, ul.nav.main-nav > li > a:hover, .main-nav .children > li.active > a, .main-nav .children > li.current-menu-item > a, .main-nav .children > li.current-menu-ancestor > a, .main-nav .children > li:hover > a, .nav-item-children > li.active > a, .nav-item-children > li.current-menu-item > a, .nav-item-children > li.current-menu-ancestor > a, .nav-item-children > li:hover > a' ) ]['color'] = 'inherit !important';
	}
	elseif( !empty( $nav_custom_color_global ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=classic] .navbar-collapse, body[data-mobile-nav-style=minimal] .navbar-collapse' ) ]['color'] = $nav_custom_color_global;
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'ul.nav.main-nav > li > a, ul.nav.main-nav > li > a:hover, .main-nav .children > li.active > a, .main-nav .children > li.current-menu-item > a, .main-nav .children > li.current-menu-ancestor > a, .main-nav .children > li:hover > a, .nav-item-children > li.active > a, .nav-item-children > li.current-menu-item > a, .nav-item-children > li.current-menu-ancestor > a, .nav-item-children > li:hover > a' ) ]['color'] = 'inherit !important';
	}
	
	if( !empty( $nav_modern_color ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=modern] .navbar-collapse-clone ul .nav-item-children > li > a, body[data-mobile-nav-style=modern] .navbar-collapse-clone ul > li > a, body[data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav .nav-item-children > li > a, body[data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav > li > a, .main-nav > li' ) ]['color'] = $nav_modern_color;
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '[data-mobile-nav-style=modern] .navbar-collapse-clone ul .nav-item-children > li > a:hover, [data-mobile-nav-style=modern] .navbar-collapse-clone ul > li > a:hover, [data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav .nav-item-children > li > a:hover, [data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav > li > a:hover' ) ]['color'] = 'inherit !important';
	}
	elseif( !empty( $nav_modern_color_global ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'body[data-mobile-nav-style=modern] .navbar-collapse-clone ul .nav-item-children > li > a, body[data-mobile-nav-style=modern] .navbar-collapse-clone ul > li > a, body[data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav .nav-item-children > li > a, body[data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav > li > a, .main-nav > li' ) ]['color'] = $nav_modern_color_global;
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( '[data-mobile-nav-style=modern] .navbar-collapse-clone ul .nav-item-children > li > a:hover, [data-mobile-nav-style=modern] .navbar-collapse-clone ul > li > a:hover, [data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav .nav-item-children > li > a:hover, [data-mobile-nav-style=modern] .navbar-collapse-clone ul.nav.main-nav > li > a:hover' ) ]['color'] = 'inherit !important';
	}
	
	if( !empty( $nav_border_color ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'ul.nav.main-nav > li > a' ) ]['border-color'] = $nav_border_color;
	}
	elseif( !empty( $nav_border_color_global ) ) {
		$css['@media screen and (max-width: ' . $max_media_mobile_nav . 'px)'][ liquid_implode( 'ul.nav.main-nav > li > a' ) ]['border-color'] = $nav_border_color_global;
	}	

	//Nav customization
	$nav_selectors       = array( '.main-nav > li > a' );
	$nav_hover_selectors = array( '.main-nav > li > a:hover', '.main-nav > li > a:focus' );
	
	$nav_typo         = liquid_helper()->get_option( 'nav_typography' );
	$nav_mobile_typo  = liquid_helper()->get_option( 'nav_mobile_typography' );
	$nav_color        = liquid_helper()->get_option( 'nav_color' );
	$nav_second_color = liquid_helper()->get_option( 'nav_secondary_color' ); 
	$nav_active_color = liquid_helper()->get_option( 'nav_active_color' ); 
	
	$nav_padding      = liquid_helper()->get_option( 'nav_padding' );
	if( ! empty( $nav_padding ) ) {
		unset( $nav_padding['units'] );
		$css['global'][ liquid_implode( $nav_selectors ) ] = $nav_padding;
	}
	
	//Typo for Menu
	if( is_array( $nav_typo ) && ! empty( $nav_typo ) ) {		
		unset( $nav_typo['google'] );
		$css['global'][ liquid_implode( $nav_selectors ) ] = $nav_typo;
	}
	if( is_array( $nav_color ) && ! empty( $nav_color ) ) {
		$css['global'][ liquid_implode( $nav_selectors ) ]['color'] = $nav_color['rgba'];	
	}
	if( is_array( $nav_active_color ) && ! empty( $nav_active_color ) ) {
		$css['global'][ liquid_implode( $nav_hover_selectors ) ]['color'] = $nav_active_color['rgba'];	
	}
	
	//Typo for mobile menu
	if( is_array( $nav_mobile_typo ) && ! empty( $nav_mobile_typo ) ) {
		unset( $nav_mobile_typo['google'] );
		$css['@media screen and ( max-width: 991px )'][ liquid_implode( $nav_selectors ) ] = $nav_mobile_typo;
	}
	
	//Return the arrary with styles to output
	return $css;
}

// Helpers ---------------------------------------

/**
 * Helper function.
 * Parse the Bg options and get only right values
 */
function liquid_parse_bg( $elements = array() ) {
	
	$bg = array();
	
	if ( ! is_array( $elements ) ) {
		return $elements;
	}
	
	if( isset( $elements['background-color'] ) && ! empty( $elements['background-color'] ) ) {
		$bg['background-color'] = $elements['background-color'];
	}
	if( isset( $elements['background-image'] ) && ! empty( $elements['background-image'] ) ) {
		$bg['background-image'] = 'url( ' . esc_url( $elements['background-image'] ) . ')';
	}
	if( isset( $elements['background-repeat'] ) && ! empty( $elements['background-repeat'] ) ) {
		$bg['background-repeat'] = $elements['background-repeat'];
	}
	if( isset( $elements['background-size'] ) && ! empty( $elements['background-size'] ) ) {
		$bg['background-size'] = $elements['background-size'];
	}
	if( isset( $elements['background-attachment'] ) && ! empty( $elements['background-attachment'] ) ) {
		$bg['background-attachment'] = $elements['background-attachment'];
	}
	if( isset( $elements['background-position'] ) && ! empty( $elements['background-position'] ) ) {
		$bg['background-position'] = $elements['background-position'];
	}		

	return $bg;
	
}

/**
 * Helper function.
 * Merge and combine the CSS elements
 */
function liquid_implode( $elements = array() ) {

	if ( ! is_array( $elements ) ) {
		return $elements;
	}

	// Make sure our values are unique
	$elements = array_unique( array_filter( $elements ) );
	// Sort elements alphabetically.
	// This way all duplicate items will be merged in the final CSS array.
	sort( $elements );

	// Implode items and return the value.
	return implode( ',', $elements );

}

/**
 * Maps elements from dynamic css to the selector
 */
function liquid_map_selector( $elements, $selector ) {
	$array = array();

	foreach( $elements as $element ) {
		$array[] = $element . $selector;
	}

	return $array;
}