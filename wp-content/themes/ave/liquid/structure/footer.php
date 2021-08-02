<?php
/**
 * Liquid Themes Theme Framework
 */

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * Table of content
 *
 * 1. Hooks
 * 2. Functions
 * 3. Template Tags
 */

// 1. Hooks ------------------------------------------------------
//

/**
 * [liquid_output_space_body description]
 * @method liquid_output_space_body
 * @return [type]                  [description]
 */
add_action( 'wp_footer', 'liquid_output_space_body', 999 );
function liquid_output_space_body() {

	echo liquid_helper()->get_theme_option( 'space_body' );
}

/**
 * [liquid_attributes_footer description]
 * @method liquid_attributes_footer
 * @param  [type]                  $attributes [description]
 * @return [type]                              [description]
 */
add_filter( 'liquid_attr_footer', 'liquid_attributes_footer' );
function liquid_attributes_footer( $attributes ) {

	$enabled_fullpage = liquid_helper()->get_option( 'enable-fullpage' );
	if( 'on' === $enabled_fullpage ) {
		$attributes['class'] = !empty( $attributes['class'] ) ? 'main-footer site-footer section fp-auto-height-responsive fp-auto-height ' . $attributes['class'] : 'main-footer site-footer section fp-auto-height-responsive fp-auto-height' ;
	} else {
		$attributes['class'] = !empty( $attributes['class'] ) ? 'main-footer site-footer ' . $attributes['class'] : 'main-footer site-footer';	
	}

	$attributes['id'] = 'footer';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WPFooter';
	
	global $post;
	
	// which one
	$id = liquid_get_custom_footer_id();
	if( 'on' === liquid_helper()->get_post_meta( 'footer-fixed', $id ) ) {
		$attributes['data-sticky-footer']  = true;	
	}

	return $attributes;

}

/**
 * [liquid_footer_backtotop description]
 * @method liquid_footer_backtotop
 * @return [type]                 [description]
 */
add_action( 'liquid_after_footer', 'liquid_footer_backtotop' );
function liquid_footer_backtotop() {
	
	$enable = liquid_helper()->get_theme_option( 'enable-go-top' );
	if( ! $enable ) {
		return;
	}
		
	$atts = array(
		'after'    => '</div>',
		'before'   => '<div class="local-scroll site-backtotop">',
		'href'     => '#wrap',
		'nofollow' => true,
		'text'     => esc_html__( 'Return to top of page', 'ave' ),
	);
	$atts = apply_filters( 'liquid_footer_backtotop_defaults', $atts );

	$nofollow = $atts['nofollow'] ? 'rel="nofollow"' : '';

	printf( '%s<a href="%s" %s>%s</a>%s', $atts['before'], esc_url( $atts['href'] ), $nofollow, $atts['text'], $atts['after'] );
}

// 2. Functions ------------------------------------------------------
//

/**
 * [liquid_get_custom_footer_id description]
 * @method liquid_get_custom_footer_id
 * @return [type]                     [description]
 */
function liquid_get_custom_footer_id() {

	// which one
	$id = liquid_helper()->get_option( 'footer-template' );
	if( current_theme_supports( 'theme-demo' ) && !empty( $_GET['f'] ) ) {
		$id = $_GET['f'];
	}

	return $id;
}

/**
 * [liquid_print_custom_footer_css description]
 * @method liquid_print_custom_footer_css
 * @return [type]                        [description]
 */
add_action( 'wp_head', 'liquid_print_custom_footer_css', 1001 );
function liquid_print_custom_footer_css() {

	echo liquid_helper()->get_vc_custom_css( liquid_get_custom_footer_id() );
}

// 3. Template Tags --------------------------------------------------
//
