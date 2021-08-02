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
 * [at_meta_mobile_app description]
 * @method at_meta_mobile_app
 * @return [type]             [description]
 */
add_action( 'wp_head', 'liquid_meta_mobile_app', 0 );
function liquid_meta_mobile_app() {

	echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
	echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
	printf( '<meta name="apple-mobile-web-app-title" content="%s - %s">' . "\n", esc_html( get_bloginfo('name') ), esc_html( get_bloginfo('description') ) );
}

/**
 * [liquid_meta_name_url description]
 * @method liquid_meta_name_url
 * @return [type]          [description]
 */
add_action( 'wp_head', 'liquid_meta_name_url', 1 );
function liquid_meta_name_url() {

	if ( ! is_front_page() ) {
		return;
	}

	printf( '<meta itemprop="name" content="%s" />' . "\n", get_bloginfo( 'name' ) );
	printf( '<meta itemprop="url" content="%s" />' . "\n", trailingslashit( home_url() ) );
}

/**
 * [liquid_meta_pingback description]
 * @method liquid_meta_pingback
 * @return [type]              [description]
 */
add_action( 'wp_head', 'liquid_meta_pingback', 0 );
function liquid_meta_pingback() {

	if ( 'open' === get_option( 'default_ping_status' ) ) {
		echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
	}
}

/**
 * [liquid_load_favicon description]
 * @method liquid_load_favicon
 * @return [type]             [description]
 */
add_action( 'wp_head', 'liquid_load_favicon' );
function liquid_load_favicon() {
?>
	<link rel="shortcut icon" href="<?php liquid_helper()->get_option_echo( 'favicon.url', 'url', get_template_directory_uri() . '/favicon.png') ?>" />
	<?php
	if ( $icon = liquid_helper()->get_option( 'iphone_icon.url' ) ) : ?>
		<!-- For iPhone -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( $icon ) ?>">
	<?php endif;

	if ( $icon = liquid_helper()->get_option( 'iphone_icon_retina.url' ) ) : ?>
		<!-- For iPhone 4 Retina display -->
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $icon ) ?>">
	<?php endif;

	if ( $icon = liquid_helper()->get_option( 'ipad_icon.url' ) ) : ?>
		<!-- For iPad -->
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $icon ) ?>">
	<?php endif;

	if ( $icon = liquid_helper()->get_option( 'ipad_icon_retina.url' ) ) : ?>
		<!-- For iPad Retina display -->
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( $icon ) ?>">
	<?php endif;
}

/**
 * [liquid_output_advance_code description]
 * @method liquid_output_advance_code
 * @return [type]                  [description]
 */
add_action( 'wp_head', 'liquid_output_advance_code', 999 );
function liquid_output_advance_code() {

	echo liquid_helper()->get_theme_option( 'google_analytics' );

	echo liquid_helper()->get_theme_option( 'space_head' );
}

/**
 * Add skiplinks for screen readers and keyboard navigation
 */
add_action( 'liquid_before', 'liquid_skip_links', 1 );
function liquid_skip_links() {

	// Determine which skip links are needed
	$links = array();

	if ( has_nav_menu( 'primary' ) ) {
		$links['primary'] =  esc_html__( 'Skip to primary navigation', 'ave' );
	}

	$links['content'] = esc_html__( 'Skip to content', 'ave' );

	// write HTML, skiplinks in a list with a heading
	$skiplinks  =  '<div>';
	$skiplinks .=  '<span class="screen-reader-text">'. esc_html__( 'Skip links', 'ave' ) .'</span>';
	$skiplinks .=  '<ul class="liquid-skip-link screen-reader-text">';

	// Add markup for each skiplink
	foreach ($links as $key => $value) {
		$skiplinks .=  '<li><a href="' . esc_url( '#' . $key ) . '" class="screen-reader-shortcut"> ' . esc_html( $value ) . '</a></li>';
	}

	$skiplinks .=  '</ul>';
	$skiplinks .=  '</div>' . "\n";

	echo wp_kses_post( $skiplinks );
}

/**
 * [liquid_attributes_header description]
 * @method liquid_attributes_header
 * @param  [type]                  $attributes [description]
 * @return [type]                              [description]
 */
add_filter( 'liquid_attr_header', 'liquid_attributes_header' );
function liquid_attributes_header( $attributes ) {

	if( !isset( $attributes['id'] ) || empty( $attributes['id'] ) ) {
		$attributes['id'] = 'header';
	}

	$attributes['class'] = !empty( $attributes['class'] ) ? 'header site-header ' . $attributes['class'] : 'header site-header';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WPHeader';

	return $attributes;

}


add_filter( 'liquid_attr_archive-header', 'liquid_attributes_archive_header' );
/**
 * [liquid_attributes_archive_header description]
 * @method liquid_attributes_archive_header
 * @param  [type]              $attributes [description]
 * @return [type]                          [description]
 */
function liquid_attributes_archive_header( $attributes ) {

	$attributes['class'] = 'page-header archive-header';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WebPageElement';

	return $attributes;
}


add_filter( 'liquid_attr_archive-title', 'liquid_attributes_archive_title' );
/**
 * [liquid_attributes_archive_title description]
 * @method liquid_attributes_archive_title
 * @param  [type]              $attributes [description]
 * @return [type]                          [description]
 */
function liquid_attributes_archive_title( $attributes ) {

	$attributes['class']     = 'archive-title';
	$attributes['itemprop']  = 'headline';

	return $attributes;
}


add_filter( 'liquid_attr_archive-description', 'liquid_attributes_archive_description' );
/**
 * [liquid_attributes_archive_description description]
 * @method liquid_attributes_archive_description
 * @param  [type]              $attributes [description]
 * @return [type]                          [description]
 */
function liquid_attributes_archive_description( $attributes ) {

	$attributes['class']     = 'archive-description';
	$attributes['itemprop']  = 'text';

	return $attributes;
}

// 2. Functions ------------------------------------------------------
//

/**
 * [liquid_get_custom_header_id description]
 * @method liquid_get_custom_header_id
 * @return [type]                     [description]
 */
function liquid_get_custom_header_id() {
	
	// which one
	$search_id = liquid_helper()->get_option( 'search-header-template' );
	if( is_search() && $search_id ) {
		$id = $search_id;
	}
	else { 
		$id = liquid_helper()->get_option( 'header-template' );	
	}

	return $id;
}

/**
 * [liquid_print_custom_header_css description]
 * @method liquid_print_custom_header_css
 * @return [type]                        [description]
 */
add_action( 'wp_head', 'liquid_print_custom_header_css', 1001 );
function liquid_print_custom_header_css() {

	echo liquid_helper()->get_vc_custom_css( liquid_get_custom_header_id() );
}

// 3. Template Tags --------------------------------------------------
//

function liquid_get_custom_header( $post_id = 0 ) {

	if( ! $post_id ) {
		return;
	}
}
