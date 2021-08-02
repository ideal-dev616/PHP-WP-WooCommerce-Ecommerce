<?php
/**
 * LiquidThems Theme Framework
 */

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

// Custom Post Type Supports
add_theme_support( 'liquid-portfolio' );
add_theme_support( 'liquid-footer' );
add_theme_support( 'liquid-header' );
add_theme_support( 'liquid-promotion' );
add_theme_support( 'liquid-mega-menu' );

// Custom Extensions
add_theme_support( 'liquid-extension', array(
	'mega-menu',
	'breadcrumb',
	'wp-editor'
) );
add_post_type_support( 'post', 'liquid-post-likes' );

//Support Gutenberg
add_theme_support(
	'gutenberg',
	array( 'wide-images' => true )
);
add_theme_support( 'wp-block-styles' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'align-wide' );

// Set theme options
liquid()->set_option_name( 'liquid_one_opt' );
add_theme_support( 'liquid-theme-options', array(
	'layout',
	'responsive',
	'colors',
	'logo',
	'header',
	'footer',
	'sidebars',
	'typography',
	'blog',
	'portfolio',
	'woocommerce',
	'page-search',
	'apikeys',
	'extras',
	'advanced',
	'custom-code',
	'export'
));

if( function_exists( 'liquid_add_image_sizes' ) ) {
	liquid_add_image_sizes();
}

//Set available metaboxes
add_theme_support( 'liquid-metaboxes', array(
	
	'portfolio-general',
	'portfolio-meta',
	'page',
	'header',
	'footer',
	'sidebars',
	'title-wrapper',
	'title-wrapper-portfolio',
	'post',
	'post-format',

	// Liquid Content
	'header-options',
	'footer-options',
	'megamenu-options'
));

//Enable support for Post Formats.
//See http://codex.wordpress.org/Post_Formats
add_theme_support( 'post-formats', array(
	'audio', 'gallery', 'link', 'quote', 'video'
) );

// Sets up theme navigation locations.
register_nav_menus( array(
   'primary'   => esc_html__( 'Primary Menu', 'ave' ),
   'secondary' => esc_html__( 'Secondary Menu', 'ave' )
) );

// Register Widgets Area.
add_action( 'widgets_init', 'liquid_main_sidebar' );
function liquid_main_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'ave' ),
		'id'            => 'main',
		'description'   => esc_html__( 'Main widget area to display in sidebar', 'ave' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}