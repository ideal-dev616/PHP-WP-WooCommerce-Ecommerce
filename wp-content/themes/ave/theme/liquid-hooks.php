<?php
/**
 * Liquid Themes Theme Hooks
 */

if( ! defined( 'ABSPATH' ) ) 
	exit; 
// Exit if accessed directly

/**
 * [liquid_add_body_classes description]
 * @method liquid_add_body_classes
 * @param  [type] $classes [description]
 */
function liquid_add_body_classes( $classes ) {
	
	//Add for single post body classnames
	if( is_single() ) {
		
		$single_post_style = liquid_helper()->get_option( 'post-style', 'cover-spaced' );
		$alt_image_src   = liquid_helper()->get_option( 'liquid-post-cover-image' );
		$image_src = isset( $alt_image_src['background-image'] ) ? esc_url( $alt_image_src['background-image'] ) : get_the_post_thumbnail_url( get_the_ID(), 'full' );
		
		if( empty( $single_post_style ) ) {
			$single_post_style = 'cover-spaced';
		}
		if( 'default' === $single_post_style ) {
			$classes[] = 'blog-single-image-left';
		}
		elseif( 'cover' === $single_post_style ) {
			$classes[] = 'blog-single-default';
		}
		elseif( 'cover-spaced' === $single_post_style ) {
			$classes[] = 'blog-single-cover-bordered';
		}
		elseif( 'modern' === $single_post_style ) {
			$classes[] = 'blog-single-modern';
		}
		elseif( 'slider' === $single_post_style ) {
			$classes[] = 'blog-single-cover-fade';
		}
		
		if( !empty( $image_src ) ) {
			$classes[] = 'blog-single-post-has-thumbnail';
		}
		else {
			$classes[] = 'blog-single-post-has-not-thumbnail';
		}
		if( '' === get_post()->post_content ) {
			$classes[] = 'post-has-no-content';
		}
		
	}
	$enable_preloader = liquid_helper()->get_option( 'enable-preloader', 'raw', '' );
	if( 'on' === $enable_preloader ) {
		$preloader_style  = liquid_helper()->get_theme_option( 'preloader-style' );
		$classes[] = 'lqd-preloader-activated';
		$classes[] = 'lqd-page-not-loaded';
		$classes[] = !empty( $preloader_style ) ? 'lqd-preloader-style-' . $preloader_style : 'lqd-preloader-style-spinner';
	}
	$enable_frame = liquid_helper()->get_option( 'enable-frame', 'raw', '' );
	if( 'on' === $enable_frame ) {
		$classes[] = 'page-has-frame';
	}
	
	$enabled_stack  = liquid_helper()->get_option( 'page-enable-stack' );
	if( 'on' === $enabled_stack ) {
		$buttons_style = liquid_helper()->get_option( 'page-stack-buttons-style' );
		$classes[] = !empty( $buttons_style ) ? $buttons_style : 'lqd-stack-buttons-style-1';
	}
	
	$site_layout = liquid_helper()->get_option( 'page-layout' );
	if( !empty( $site_layout ) ) {
		$classes[] = "site-$site_layout-layout";
	}
	
	
	$body_shadow = liquid_helper()->get_option( 'body-shadow' );
	if( !empty( $body_shadow ) ) {
		$classes[] = $body_shadow;
	}	

	//Page color scheme
	$page_color_scheme = liquid_helper()->get_option( 'body-color-scheme' );
	if( !empty( $page_color_scheme ) ) {
		if( 'light' === $page_color_scheme ) {
			$classes[] = 'page-scheme-light';
		}
		else {
			$classes[] = 'page-scheme-dark';	
		}
	}

	//Progressively load classnames
	if( 'on' === liquid_helper()->get_option( 'enable-lazy-load' ) && !is_admin() ) {
		
		if( function_exists( 'vc_mode' ) ) {
			if( 'page_editable' !== vc_mode() ) {
				$classes[] = 'lazyload-enabled';
			}
		}
		else {
			$classes[] = 'lazyload-enabled';
		}

	}
	
	// Header body class
	$id = liquid_get_custom_header_id(); // which one
	if( $layout = liquid_helper()->get_post_meta( 'header-layout', $id ) ) {
		if( 'fullscreen' === $layout ) {
			$classes[] = 'header-style-fullscreen';
		}
		elseif( in_array( $layout, array( 'side', 'side-2', 'side-3' ) ) ) {
			$classes[] = 'header-style-side';
		}
	}

	return $classes;
	
}
add_filter( 'body_class', 'liquid_add_body_classes' );

/**
 * [liquid_add_admin_body_classes description]
 * @method liquid_add_admin_body_classes
 * @param  [type] $classes [description]
 */
function liquid_add_admin_body_classes( $classes ) {
	
	$enabled_stack  = liquid_helper()->get_option( 'page-enable-stack' );
	if( 'on' === $enabled_stack ) {
		$classes .= 'lqd-stack-enabled';
	}

	return $classes;

}
add_filter( 'admin_body_class', 'liquid_add_admin_body_classes' );

function liquid_mobile_nav_body_attributes( $attributes ) {
	
	//Default Values
	$attributes['data-mobile-nav-style']             = 'modern';
	$attributes['data-mobile-nav-scheme']            = 'dark';
	$attributes['data-mobile-nav-trigger-alignment'] = 'right';
	$attributes['data-mobile-header-scheme']         = 'gray';
	$attributes['data-mobile-secondary-bar']         = 'false';
	$attributes['data-mobile-logo-alignment']        = 'default';

	// Header body atts
	$id = liquid_get_custom_header_id(); // which one
	if( $id ) {

		$mobile_nav_logo_alignment        = liquid_helper()->get_post_meta( 'm-nav-logo-alignment', $id );
		$mobile_nav_logo_alignment_global = liquid_helper()->get_theme_option( 'm-nav-logo-alignment' );
		if( $mobile_nav_logo_alignment ) {
			$attributes['data-mobile-logo-alignment'] = $mobile_nav_logo_alignment;
		}
		elseif( $mobile_nav_logo_alignment_global ) {
			$attributes['data-mobile-logo-alignment'] = $mobile_nav_logo_alignment_global;
		}

		$mobile_nav_style        = liquid_helper()->get_post_meta( 'm-nav-style', $id );
		$mobile_nav_style_global = liquid_helper()->get_theme_option( 'm-nav-style' );
		if( $mobile_nav_style ) {
			$attributes['data-mobile-nav-style'] = $mobile_nav_style;
			if( 'modern' === $mobile_nav_style ) {
				$attributes['data-mobile-nav-scheme'] = 'dark';	
			}
		}
		elseif( $mobile_nav_style_global ) {
			$attributes['data-mobile-nav-style'] = $mobile_nav_style_global;
			if( 'modern' === $mobile_nav_style_global ) {
				$attributes['data-mobile-nav-scheme'] = 'dark';	
			}			
		}

		$mobile_nav_trigger_alignment = liquid_helper()->get_post_meta( 'm-nav-trigger-alignment', $id );
		$mobile_nav_trigger_alignment_global = liquid_helper()->get_theme_option( 'm-nav-trigger-alignment' );
		if( $mobile_nav_trigger_alignment ) {
			$attributes['data-mobile-nav-trigger-alignment'] = $mobile_nav_trigger_alignment;
		}
		elseif( $mobile_nav_trigger_alignment_global ) {
			$attributes['data-mobile-nav-trigger-alignment'] = $mobile_nav_trigger_alignment_global;
		}

		$mobile_nav_alignment = liquid_helper()->get_post_meta( 'm-nav-alignment', $id );
		$mobile_nav_alignment_global = liquid_helper()->get_theme_option( 'm-nav-alignment' );
		if( $mobile_nav_alignment && 'modern' !== $mobile_nav_style ) {
			$attributes['data-mobile-nav-align'] = $mobile_nav_alignment;
		}
		elseif( $mobile_nav_alignment_global && 'modern' !== $mobile_nav_style_global ) {
			$attributes['data-mobile-nav-align'] = $mobile_nav_alignment_global;
		}

		$mobile_nav_scheme = liquid_helper()->get_post_meta( 'm-nav-scheme', $id );
		$mobile_nav_scheme_global = liquid_helper()->get_theme_option( 'm-nav-scheme' );
		if( $mobile_nav_scheme && 'modern' !== $mobile_nav_style ) {
			$attributes['data-mobile-nav-scheme'] = $mobile_nav_scheme;
		}
		elseif( $mobile_nav_scheme_global && 'modern' !== $mobile_nav_style_global ) {
			$attributes['data-mobile-nav-scheme'] = $mobile_nav_scheme_global;			
		}

		$mobile_nav_header_style = liquid_helper()->get_post_meta( 'm-nav-header-scheme', $id );
		$mobile_nav_header_style_global = liquid_helper()->get_theme_option( 'm-nav-header-scheme' );
		if( $mobile_nav_header_style ) {
			$attributes['data-mobile-header-scheme'] = $mobile_nav_header_style;
		}
		elseif( $mobile_nav_header_style_global ) {
			$attributes['data-mobile-header-scheme'] = $mobile_nav_header_style_global;
		}

		$mobile_nav_sec_bar        = liquid_helper()->get_post_meta( 'm-nav-enable-secondary-bar', $id );
		$mobile_nav_sec_bar_global = liquid_helper()->get_theme_option( 'm-nav-enable-secondary-bar' );

		if( !empty( $mobile_nav_sec_bar ) ) {
			if( 'no' === $mobile_nav_sec_bar ) {
				$attributes['data-mobile-secondary-bar'] = 'false';
			}
			else {
				$attributes['data-mobile-secondary-bar'] = 'true';
			}
		}
		elseif( $mobile_nav_sec_bar_global ) {
			if( 'no' === $mobile_nav_sec_bar_global ) {
				$attributes['data-mobile-secondary-bar'] = 'false';
			}
			else {
				$attributes['data-mobile-secondary-bar'] = 'true';
			}	
		}

		$mobile_header_overlay = liquid_helper()->get_post_meta( 'mobile-header-overlay', $id );		

		if( !empty( $mobile_header_overlay ) ) {
			if( 'yes' === $mobile_header_overlay ) {
				$attributes['data-overlay-onmobile'] = 'true';
			}
			else {
				$attributes['data-overlay-onmobile'] = 'false';
			}
		}
		
	}
	
	return $attributes;
	
}
add_filter( 'liquid_attr_body', 'liquid_mobile_nav_body_attributes', 10 );

function liquid_add_header_collapsed( $classes ) {

	// Header body class
	$id = liquid_get_custom_header_id(); // which one
	if( $layout = liquid_helper()->get_post_meta( 'header-layout', $id ) ) {
		if( 'fullscreen' === $layout ) {
			$classes[] = 'navbar-fullscreen';
		}
	}
	return $classes;	
} 
add_filter( 'liquid_header_collapsed_classes', 'liquid_add_header_collapsed', 99 );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function liquid_custom_excerpt_length( $length ) {
    
	return 15;
}
add_filter( 'excerpt_length', 'liquid_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function liquid_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'liquid_excerpt_more' );

function liquid_add_header_nav_classes( $classes ) {

	// Header body class
	$id = liquid_get_custom_header_id(); // which one
	if( $layout = liquid_helper()->get_post_meta( 'header-layout', $id ) ) {
		if( 'fullscreen' === $layout ) {
			$classes[] = 'main-nav-hover-underline-1 main-nav-fullscreen-style-1';
		}
		elseif( 'side' === $layout ) {
			$classes[] = 'main-nav-side main-nav-side-style-1';
		}
		elseif( 'side-2' === $layout ) {
			$classes[] = 'main-nav-side main-nav-side-style-2';
		}
		elseif( 'side-3' === $layout ) {
			$classes[] = 'main-nav-side main-nav-side-style-2';
		}
	}
	return $classes;	
} 
add_filter( 'liquid_header_nav_classes', 'liquid_add_header_nav_classes', 99 );

function liquid_add_header_nav_args( $args ) {

	// Header body class
	$id = liquid_get_custom_header_id(); // which one

	if( $layout = liquid_helper()->get_post_meta( 'header-layout', $id ) ) {
		if( 'fullscreen' === $layout 
			|| 'side' === $layout 
			|| 'side-2' === $layout 
			|| 'side-3' === $layout 
		) {
			$args['toggleType'] = 'slide';
			$args['handler']    = 'click';
		}
	}
	return $args;	
} 
add_filter( 'liquid_header_nav_args', 'liquid_add_header_nav_args', 99 );

function liquid_add_trigger_classes( $classes ) {

	// Header body class
	$id = liquid_get_custom_header_id(); // which one
	if( $layout = liquid_helper()->get_post_meta( 'header-layout', $id ) ) {
		if( 'fullscreen' === $layout ) {
			$classes[] = 'main-nav-trigger';
		}
	}	
	return $classes;
}
add_filter( 'liquid_trigger_classes', 'liquid_add_trigger_classes', 99 );

function liquid_add_trigger_opts( $opts ) {

	// Header body class
	$id = liquid_get_custom_header_id(); // which one
	if( $layout = liquid_helper()->get_post_meta( 'header-layout', $id ) ) {
		if( 'fullscreen' === $layout ) {
			$opts[] = 'data-changeclassnames=\'{ "html": "overflow-hidden" }\'';
		}
		elseif( 'side' === $layout ) {
			$opts[] = 'data-changeclassnames=\'{ "html": "side-nav-showing" }\'';
		}
	}	
	return $opts;
}
add_filter( 'liquid_trigger_opts', 'liquid_add_trigger_opts', 99 );

/**
 * [liquid_get_preloader description]
 * @method liquid_get_preloader
 * @return [type]             [description]
 */
 
function liquid_get_preloader() {

	$enable = liquid_helper()->get_option( 'enable-preloader', 'raw', '' );
	$preloader_style  = liquid_helper()->get_theme_option( 'preloader-style' );
	// Check if preloader is enabled
	if( 'off' === $enable ) {
		return;
	}
	
	if( !empty( $preloader_style ) ) {
		
		get_template_part( 'templates/preloader/' . $preloader_style );	
		return;
	}

	get_template_part( 'templates/preloader/spinner' );
	
}

add_action( 'liquid_before', 'liquid_get_preloader' );


/**
 * [liquid_get_header_view description]
 * @method liquid_get_header_view
 * @return [type] [description]
 */

function liquid_get_header_view() {

	//Check if is not frontend vc editor
	if( function_exists( 'vc_mode' ) && 'page_editable' === vc_mode() ) {
		return;
	}

	if( is_404() ) {
		$enable = liquid_helper()->get_option( 'error-404-header-enable-switch', 'raw', '' );	
	}
	else {
		$enable = liquid_helper()->get_option( 'header-enable-switch', 'raw', '' );	
	}
	// Check if header is enabled
	if( 'off' === $enable ) {
		return;
	}

	// Overlay Header
	$header_id = liquid_get_custom_header_id();
	$header_overlay = liquid_helper()->get_post_meta( 'header-overlay', $header_id );

		if( is_search() ) {
			$enable_titlebar = liquid_helper()->get_option( 'search-title-bar-enable', 'raw', '' );
		}
		elseif( is_post_type_archive( 'liquid-portfolio' ) || is_tax( 'liquid-portfolio-category' ) ) {
			$enable_titlebar = liquid_helper()->get_option( 'portfolio-title-bar-enable', 'raw', '' );
		}
		elseif( class_exists( 'WooCommerce' ) && ( is_product_taxonomy() || is_product_category() ) ) {
			$enable_titlebar = liquid_helper()->get_option( 'wc-archive-title-bar-enable', 'raw', '' );
		}
		elseif( ! liquid_helper()->get_current_page_id() && is_home() ){
			$enable_titlebar = liquid_helper()->get_option( 'blog-title-bar-enable', 'raw', '' );
		}
		elseif( is_singular( 'post' ) ) {
			$enable_titlebar = liquid_helper()->get_post_meta( 'title-bar-enable' ) ? liquid_helper()->get_post_meta( 'title-bar-enable' ) : liquid_helper()->get_theme_option( 'post-titlebar-enable' );
		}
		elseif( is_category() ) {
			$enable_titlebar = liquid_helper()->get_option( 'category-title-bar-enable', 'raw', '' );
		}
		elseif( is_tag() ){
			$enable_titlebar = liquid_helper()->get_option( 'tag-title-bar-enable', 'raw', '' );
		}
		elseif( is_author() ) {
			$enable_titlebar = liquid_helper()->get_option( 'author-title-bar-enable', 'raw', '' );
		}
		else {
			$enable_titlebar = liquid_helper()->get_option( 'title-bar-enable', 'raw', '' );
		}

	if( 'main-header-overlay' === $header_overlay && 'on' === $enable_titlebar ){
		return;
	}

	if( $id = liquid_helper()->get_option( 'header-template', 'raw', false ) ) {
		get_template_part( 'templates/header/custom' );
		return;
	}

	get_template_part( 'templates/header/default' );
}
add_action( 'liquid_header', 'liquid_get_header_view' );

/**
 * [liquid_get_header_view description]
 * @method liquid_get_header_view
 * @return [type]             [description]
 */
function liquid_get_header_titlebar_view() {

	//Check if is not frontend vc editor
	if( function_exists( 'vc_mode' ) && 'page_editable' === vc_mode() ) {
		return;
	}

	if( is_404() ) {
		$enable = liquid_helper()->get_option( 'error-404-header-enable-switch', 'raw', '' );	
	}
	else {
		$enable = liquid_helper()->get_option( 'header-enable-switch', 'raw', '' );	
	}
	// Check if title bar is enabled
	if( 'on' !== $enable ) {
		return;
	}

	// Overlay Header
	$header_id = liquid_get_custom_header_id();
	$header_overlay = liquid_helper()->get_post_meta( 'header-overlay', $header_id );
	$header_overlay = $header_overlay ? $header_overlay : '';

	if( empty( $header_overlay ) ){
		return;
	}

	if( $id = liquid_helper()->get_option( 'header-template', 'raw', false ) ) {
		get_template_part( 'templates/header/custom' );
		return;
	}

	get_template_part( 'templates/header/default' );
}
add_action( 'liquid_header_titlebar', 'liquid_get_header_titlebar_view' );


/**
 * [liquid_get_page_frame description]
 * @method liquid_get_page_frame
 * @return [type] [description]
 */

function liquid_get_page_frame() {

	$enable = liquid_helper()->get_option( 'enable-frame', 'raw', '' );
	if( 'on' !== $enable ) {
		return;
	}

	echo '<div class="lqd-page-frame-wrap">
				<span class="lqd-page-frame lqd-page-frame-top" data-orientation="h"></span>
				<span class="lqd-page-frame lqd-page-frame-right" data-orientation="v"></span>
				<span class="lqd-page-frame lqd-page-frame-bottom" data-orientation="h"></span>
				<span class="lqd-page-frame lqd-page-frame-left" data-orientation="v"></span>
			</div><!-- /.lqd-page-frame -->';

}
add_action( 'liquid_after_footer', 'liquid_get_page_frame' );

/**
 * [liquid_get_footer_view description]
 * @method liquid_get_footer_view
 * @return [type] [description]
 */

function liquid_get_back_to_top_link() {

	$enable = liquid_helper()->get_option( 'footer-back-to-top', 'raw', '' );
	if( 'off' === $enable ) {
		return;
	}

	echo '<div class="lqd-back-to-top" data-back-to-top="true">
			<a href="#wrap" data-localscroll="true">
				<i class="fa fa-angle-up"></i>
			</a>
		</div><!-- /.lqd-back-to-top -->';

}
add_action( 'liquid_before_footer', 'liquid_get_back_to_top_link' );

/**
 * [liquid_get_titlebar_view description]
 * @method liquid_get_titlebar_view
 * @return [type]                  [description]
 */
function liquid_get_titlebar_view() {
	
	if( is_404() ) {
		return;
	}

	if( class_exists( 'ReduxFramework' ) && class_exists( 'Liquid_Addons' ) ) {

		if( is_search() ) {
			$enable = liquid_helper()->get_option( 'search-title-bar-enable', 'raw', '' );
		}
		elseif( is_post_type_archive( 'liquid-portfolio' ) || is_tax( 'liquid-portfolio-category' ) ) {
			$enable = liquid_helper()->get_option( 'portfolio-title-bar-enable', 'raw', '' );
		}
		elseif( class_exists( 'WooCommerce' ) && ( is_product_taxonomy() || is_product_category() ) ) {
			$enable = liquid_helper()->get_option( 'wc-archive-title-bar-enable', 'raw', '' );
		}
		elseif( ! liquid_helper()->get_current_page_id() && is_home() ){
			$enable = liquid_helper()->get_option( 'blog-title-bar-enable', 'raw', '' );
		}
		elseif( is_singular( 'post' ) ) {
			$enable = liquid_helper()->get_post_meta( 'title-bar-enable' ) ? liquid_helper()->get_post_meta( 'title-bar-enable' ) : liquid_helper()->get_theme_option( 'post-titlebar-enable' );
		}
		elseif( is_category() ) {
			$enable = liquid_helper()->get_option( 'category-title-bar-enable', 'raw', '' );
		}
		elseif( is_tag() ){
			$enable = liquid_helper()->get_option( 'tag-title-bar-enable', 'raw', '' );
		}
		elseif( is_author() ) {
			$enable = liquid_helper()->get_option( 'author-title-bar-enable', 'raw', '' );
		}
		else {
			$enable = liquid_helper()->get_option( 'title-bar-enable', 'raw', '' );
		}

		if( 'on' !== $enable ) {
			return;
		}
	}
	
	if( class_exists( 'bbPress' ) && is_bbpress() ) {
		get_template_part( 'templates/header/header-title-bar', 'bbpress' );
		return;		
	}

	if( is_singular( 'liquid-portfolio' )) {
		get_template_part( 'templates/header/header-title-bar', 'portfolio' );
		return;
	}

	if( !class_exists( 'ReduxFramework' ) && is_single() ) {
		return;
	}

	get_template_part( 'templates/header/header-title', 'bar' );
}
add_action( 'liquid_after_header', 'liquid_get_titlebar_view' );

/**
 * [liquid_get_footer_view description]
 * @method liquid_get_footer_view
 * @return [type] [description]
 */

function liquid_get_footer_view() {

	$enable = liquid_helper()->get_option( 'footer-enable-switch', 'raw', '' );
	if( 'off' === $enable ) {
		return;
	}

	if( $id = liquid_helper()->get_option( 'footer-template', 'raw', false ) ) {
		get_template_part( 'templates/footer/custom' );
		return;
	}

	get_template_part( 'templates/footer/default' );
}
add_action( 'liquid_footer', 'liquid_get_footer_view' );

/**
 * [liquid_custom_sidebars description]
 * @method liquid_custom_sidebars
 * @return [type] [description]
 */
function liquid_custom_sidebars() {

	//adding custom sidebars defined in theme options
	$custom_sidebars = liquid_helper()->get_theme_option( 'custom-sidebars' );
	$custom_sidebars = array_filter( (array)$custom_sidebars );

	if ( !empty( $custom_sidebars ) ) {

		foreach ( $custom_sidebars as $sidebar ) {

			register_sidebar ( array (
				'name'          => $sidebar,
				'id'            => sanitize_title( $sidebar ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
	}
}
add_action( 'after_setup_theme', 'liquid_custom_sidebars', 9 );

/**
* [liquid_before_comment_form description]
* @method liquid_before_comment_form
* @return [type] [description]
*/
function liquid_before_comment_form() {
	echo '<div class="row">';
}
add_action( 'comment_form_top', 'liquid_before_comment_form', 9 );

/**
* [liquid_after_comment_form description]
* @method liquid_after_comment_form
* @return [type] [description]
*/
function liquid_after_comment_form( $post_id ) {
	echo '</div>';
}
add_action( 'comment_form', 'liquid_after_comment_form', 9 );

/**
* [liquid_move_comment_field_to_bottom description]
* @method liquid_move_comment_field_to_bottom
* @return [type] [description]
*/
function liquid_move_comment_field_to_bottom( $fields ) {

	$comment_field = $fields['comment'];
	$cookie_field = $fields['cookies'];

	unset( $fields['cookies'] );
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	$fields['cookies'] = $cookie_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'liquid_move_comment_field_to_bottom' );

/**
 * [liquid_add_image_placeholders description]
 * @method liquid_add_image_placeholders
 * @param  [type]                       $content [description]
 */

add_action( 'init', 'liquid_enable_lazy_load' );
function liquid_enable_lazy_load() {
	
	if( function_exists( 'vc_mode' ) && 'page_editable' === vc_mode() ) {
		return;
	}

	if( 'on' === liquid_helper()->get_option( 'enable-lazy-load' ) && !is_admin() ) {
		add_filter( 'wp_get_attachment_image_attributes', 'liquid_filter_gallery_img_atts', 10, 2 );
	}

}

/**
 * [liquid_filter_gallery_img_atts description]
 * @method liquid_process_image_placeholders
 * @param  [type]             $atts [description]
 * @param  [type]             $attachment [description]
 * @return [type]            [description]
 */
function liquid_filter_gallery_img_atts( $atts, $attachment ) {

		$img_data = $atts['src'];
		$aspect_ratio = '';

		$filetype = wp_check_filetype( $img_data );

		@list( $width, $height ) = getimagesize( $atts['src'] );
		if( isset( $width ) && isset( $height ) ) {
			$aspect_ratio = $width / $height;
		}

		//Check if is not frontend vc editor
		if( function_exists( 'vc_mode' ) && 'page_editable' === vc_mode() ) {
			return $atts;
		}

		if( 'svg' === $filetype['ext'] ) {
			return $atts;
		}

		$atts['src'] = 'data:image/svg+xml;charset=utf-8,<svg xmlns%3D\'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg\' viewBox%3D\'0 0 ' . $width . ' ' . $height . '\'%2F>';
		$atts['class'] .= ' ld-lazyload';
		$atts['data-src'] = $img_data;
		if ( isset($atts['srcset']) ) { $atts['data-srcset'] = $atts['srcset']; };
		$atts['data-aspect'] = $aspect_ratio;
		$atts['srcset'] = '';

    return $atts;
}

/**
 * [liquid_page_ajaxify description]
 * @method liquid_page_ajaxify
 * @param  [type]             $template [description]
 * @return [type]                       [description]
 */
add_action( 'template_include', 'liquid_page_ajaxify', 1 );
function liquid_page_ajaxify( $template ) {

	if( isset( $_GET['ajaxify'] ) && $_GET['ajaxify'] ) {
		
		if( ! is_archive() ) {
			$located = locate_template( 'ajaxify.php' );
		}

		if( '' != $located ) {
			return $located;
		}
	}

	return $template;
}

function liquid_woo_price_start_container() {

	echo '<p class="ld-sp-price pos-rel">';

}
function liquid_woo_price_end_container() {

	echo '</p>';

}

/**
 * Add custom classnames to product content
 * @return void
 */
if ( ! function_exists( 'liquid_woocommerce_product_styles' ) ) {
	function liquid_woocommerce_product_styles() {
		
		$style = liquid_helper()->get_option( 'wc-archive-product-style' );
		
		if( 'minimal' === $style ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
			//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			
			add_action( 'woocommerce_after_shop_loop_item_title', 'liquid_woo_price_start_container', 1 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'liquid_woo_price_end_container', 99 );
			
			//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'liquid_add_wishlist_button', 15 );
			
			
			
		}
		elseif( 'minimal-2' === $style ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
			//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'liquid_add_wishlist_button', 15 );
			
		}
		elseif( 'minimal-hover-shadow' === $style ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
			//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			
			add_action( 'woocommerce_after_shop_loop_item_title', 'liquid_woo_price_start_container', 1 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'liquid_woo_price_end_container', 99 );
			
			//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'liquid_add_wishlist_button', 15 );
			
		}
		elseif( 'minimal-hover-shadow-2' === $style ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
			//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			
			add_action( 'woocommerce_after_shop_loop_item_title', 'liquid_woo_price_start_container', 1 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'liquid_woo_price_end_container', 99 );
			
			//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'liquid_add_wishlist_button', 15 );

			
		}
		
		
	}
}
liquid_woocommerce_product_styles();

add_action( 'woocommerce_shortcode_before_products_loop', 'liquid_before_products_shortcode_loop', 1, 10 );
add_action( 'woocommerce_shortcode_after_products_loop', 'liquid_after_products_shortcode_loop', 0, 10 );

function liquid_before_products_shortcode_loop( $atts ) {
	
	$style = liquid_helper()->get_option( 'wc-archive-product-style' );
	
    $GLOBALS[ 'liquid_woocommerce_loop_template' ] = ( isset( $atts[ 'style' ] ) ? $atts[ 'style' ] : $style );
}

function liquid_after_products_shortcode_loop( $atts ) {
    $GLOBALS[ 'liquid_woocommerce_loop_template' ] = '';
}
if( 'on' ===  liquid_helper()->get_option( 'wc-enable-carousel-featured' ) ) {
	add_filter( 'liquid_enable_woo_products_carousel', '__return_true' );
}
else {
	add_filter( 'liquid_enable_woo_products_carousel', '__return_false' );
}

$sorterby_enable = liquid_helper()->get_theme_option( 'wc-archive-sorter-enable' );
if( 'off' === $sorterby_enable ) {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}

$add_to_cart_ajax_enable = liquid_helper()->get_option( 'wc-add-to-cart-ajax-enable' );
if( 'on' === $add_to_cart_ajax_enable ) {
	add_filter( 'liquid_ajax_add_to_cart_single_product', '__return_true', 99 );
}
