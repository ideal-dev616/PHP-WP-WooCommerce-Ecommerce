<?php
/**
 * LiquidThemes Theme Framework
 */

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


/**
 * [liquid_attributes_head description]
 * @method liquid_attributes_head
 * @param  [type]                $attributes [description]
 * @return [type]                            [description]
 */
add_filter( 'liquid_attr_head', 'liquid_attributes_head' );
function liquid_attributes_head( $attributes ) {

	unset( $attributes['class'] );
	if ( ! is_front_page() ) {
		return $attributes;
	}

	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WebSite';

	return $attributes;
}

/**
 * [liquid_attributes_body description]
 * @method liquid_attributes_body
 * @param  [type]                $attributes [description]
 * @return [type]                            [description]
 */
add_filter( 'liquid_attr_body', 'liquid_attributes_body' );
function liquid_attributes_body( $attributes ) {
	
	unset( $attributes['class'] );
	$attributes['dir']       = is_rtl() ? 'rtl' : 'ltr';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WebPage';
	
	if ( is_singular( 'post' ) || is_home() || is_archive() ) {
		$attributes['itemtype'] = 'http://schema.org/Blog';
	}

	if ( is_search() ) {
		$attributes['itemtype'] = 'http://schema.org/SearchResultsPage';
	}

	return $attributes;
}

/**
 * [liquid_attributes_menu description]
 * @method liquid_attributes_menu
 * @return [type]                [description]
 */
add_filter( 'liquid_attr_menu', 'liquid_attributes_menu' );
function liquid_attributes_menu( $attributes ) {

	if ( $attributes['location'] ) {

		$menu_name = liquid_helper()->get_menu_location_name( $attributes['location'] );

		if ( $menu_name ) {
			// Translators: The %s is the menu name. This is used for the 'aria-label' attribute.
			$attributes['aria-label'] = esc_attr( sprintf( esc_html_x( '%s', 'nav menu aria label', 'ave' ), $menu_name ) );
		}
	}
	unset( $attributes['location'] );

	$attributes['itemscope']  = 'itemscope';
	$attributes['itemtype']   = 'http://schema.org/SiteNavigationElement';

	return $attributes;
}


/**
 * [liquid_attributes_content description]
 * @method liquid_attributes_content
 * @param  [type]                   $attributes [description]
 * @return [type]                               [description]
 */
add_filter( 'liquid_attr_content', 'liquid_attributes_content' );
function liquid_attributes_content( $attributes ) {

	$attributes['id'] = 'content';

	//Fullpage enable
	$enabled_fullpage = liquid_helper()->get_option( 'enable-fullpage' );
	if( 'on' === $enabled_fullpage ) {
		$attributes['data-enable-fullpage'] = true;
	}
	
	//Stack enable
	$enabled_stack  = liquid_helper()->get_option( 'page-enable-stack' );
	$enabled_stack_mobile  = liquid_helper()->get_option( 'page-enable-stack-mobile' );
	$stack_nav      = liquid_helper()->get_option( 'page-stack-nav' );
	$stack_prevnext = liquid_helper()->get_option( 'page-stack-nav-prevnextbuttons' );
	$stack_numbers  = liquid_helper()->get_option( 'page-stack-numbers' );
	$stack_effect   = liquid_helper()->get_option( 'page-stack-effect' );
	$stack_opts = array();

	if( 'on' === $enabled_stack ) {
		
		if( 'on' === $enabled_stack_mobile ) {
			$stack_opts['disableOnMobile'] = false;
		}

		$attributes['data-liquid-stack'] = true;
		$stack_opts['navigation']        = ( 'on' == $stack_nav ) ? true : false;
		$stack_opts['prevNextButtons']   = ( 'on' == $stack_prevnext ) ? true : false;
		$stack_opts['pageNumber']        = ( 'on' == $stack_numbers ) ? true : false;
		$stack_opts['prevNextLabels']    = array( 'prev' => esc_html__( 'Previous', 'ave' ), 'next' => esc_html__( 'Next', 'ave' ) );

		if( !empty( $stack_effect ) ){
			$stack_opts['effect'] = $stack_effect;
		}
		else {
			$stack_opts['effect'] = 'fadeScale';
		}
		
		$attributes['data-stack-options'] = wp_json_encode( $stack_opts );
	}

	//Fullpage enable parallax	
	$enabled_fullpage_parallax = liquid_helper()->get_option( 'enable-fullpage-parallax' );
	if( 'on' === $enabled_fullpage_parallax ) {
		$attributes['data-fullpage-parallax'] = true;
	}

	if ( ! is_singular( 'post' ) && ! is_home() && ! is_archive() ) {}

	return $attributes;

}
