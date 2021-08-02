<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$el_class = $equal_height = $content_placement = $css = $parallax = $parallax_image = $el_id = '';
$disable_element = '';
$output = $after_output = '';

//Custom Animation
$enable_content_animation = $ca_duration = $ca_start_delay = $ca_delay = $ca_easing  = $ca_init_translate_x = $ca_init_translate_y = $ca_init_translate_z = $ca_init_scale_x = $ca_init_scale_y = $ca_init_scale_z = $ca_init_rotate_x = $ca_init_rotate_y = $ca_init_rotate_z = $ca_init_opacity = $ca_an_translate_x = $ca_an_translate_y = $ca_an_translate_z = $ca_an_scale_x = $ca_an_scale_y = $ca_an_scale_z = $ca_an_rotate_x = $ca_an_rotate_y = $ca_an_rotate_z = $ca_an_opacity = $enable_slideshow_bg = $slideshow_delay = $slideshow_effect = $slideshow_images = $bg_position = $bg_pos_h = $bg_pos_v = $bg_attachment = $bg_styles = '';
$responsive_style = '';

$row_box_shadow = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if( !empty( $responsive_css ) ) {
	$responsive_id = uniqid( 'liquid-row-responsive-' );
	$responsive_style = Liquid_Responsive_Css_Editor::generate_css( $responsive_css, $responsive_id );
	$css_classes[] = $responsive_id;
}

$row_box_shadow = vc_param_group_parse_atts( $row_box_shadow );
if( !empty( $row_box_shadow ) ) {
	$shadow_box_id = uniqid('liquid-row-shadowbox-');
	$shadow_css    = liquid_get_shadow_css( $row_box_shadow, $shadow_box_id );
	$css_classes[] = $shadow_box_id;
}

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( '15' !== $atts['gap'] ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if( 'yes' === $enable_content_animation ) {
	
	$presetsValues = array();

	$opts = $init_values = $animations_values = $arr = array();
	
	$opts['triggerHandler'] = 'inview';
	$opts['animationTarget'] = '.wpb_column';
	
	$opts['duration'] = !empty( $ca_duration ) ? $ca_duration : 700;
	if( !empty( $ca_start_delay ) ) {
		$opts['startDelay'] = $ca_start_delay;
	}
	$opts['delay'] = !empty( $ca_delay ) ? $ca_delay : 100;
	$opts['easing'] = !empty( $ca_easing ) ? $ca_easing : 'easeOutQuint';
	$opts['direction'] = !empty( $ca_direction ) ? $ca_direction : 'forward' ;
	
	if( 'custom' !== $animation_preset ) {

		$opts['duration'] = !empty( $ca_duration ) ? $ca_duration : 1600;
		$opts['delay'] = !empty( $ca_delay ) ? $ca_delay : 250;
		
		$presetsValues = liquid_get_animation_preset( $animation_preset );
		$init_values       = $presetsValues['from'];
		$animations_values = $presetsValues['to'];
	}
	else {

		//Init values
		if ( !empty( $ca_init_translate_x ) ) { $init_values['translateX'] = ( int ) $ca_init_translate_x; }
		if ( !empty( $ca_init_translate_y ) ) { $init_values['translateY'] = ( int ) $ca_init_translate_y; }
		if ( !empty( $ca_init_translate_z ) ) { $init_values['translateZ'] = ( int ) $ca_init_translate_z; }
	
		if ( '1' !== $ca_init_scale_x ) { $init_values['scaleX'] = ( float ) $ca_init_scale_x; }
		if ( '1' !== $ca_init_scale_y ) { $init_values['scaleY'] = ( float ) $ca_init_scale_y; }
		if ( '1' !== $ca_init_scale_z ) { $init_values['scaleZ'] = ( float ) $ca_init_scale_z; }
	
		if ( !empty( $ca_init_rotate_x ) ) { $init_values['rotateX'] = ( int ) $ca_init_rotate_x; }
		if ( !empty( $ca_init_rotate_y ) ) { $init_values['rotateY'] = ( int ) $ca_init_rotate_y; }
		if ( !empty( $ca_init_rotate_z ) ) { $init_values['rotateZ'] = ( int ) $ca_init_rotate_z; }
		
		if ( isset( $ca_init_opacity ) && '1' !== $ca_init_opacity ) { $init_values['opacity'] = ( float ) $ca_init_opacity; }
		
	
		//Animation values
		if ( !empty( $ca_init_translate_x ) ) { $animations_values['translateX'] = ( int ) $ca_an_translate_x; }
		if ( !empty( $ca_init_translate_y ) ) { $animations_values['translateY'] = ( int ) $ca_an_translate_y; }
		if ( !empty( $ca_init_translate_z ) ) { $animations_values['translateZ'] = ( int ) $ca_an_translate_z; }
	
		if ( isset( $ca_an_scale_x ) && '1' !== $ca_init_scale_x ) { $animations_values['scaleX'] = ( float ) $ca_an_scale_x; }
		if ( isset( $ca_an_scale_y ) && '1' !== $ca_init_scale_y ) { $animations_values['scaleY'] = ( float ) $ca_an_scale_y; }
		if ( isset( $ca_an_scale_z ) && '1' !== $ca_init_scale_z ) { $animations_values['scaleZ'] = ( float ) $ca_an_scale_z; }
	
		if ( !empty( $ca_init_rotate_x ) ) { $animations_values['rotateX'] = ( int ) $ca_an_rotate_x; }
		if ( !empty( $ca_init_rotate_y ) ) { $animations_values['rotateY'] = ( int ) $ca_an_rotate_y; }
		if ( !empty( $ca_init_rotate_z ) ) { $animations_values['rotateZ'] = ( int ) $ca_an_rotate_z; }
	
		if ( isset( $ca_an_opacity ) && '1' !== $ca_init_opacity ) { $animations_values['opacity'] = ( float ) $ca_an_opacity; }	
	
	}
	

	$opts['initValues'] = !empty( $init_values ) ? $init_values : array();
	$opts['animations'] = !empty( $animations_values ) ? $animations_values : array();

	$wrapper_attributes[] = 'data-custom-animations="true"';
	$wrapper_attributes[] = 'data-ca-options=\'' . stripslashes( wp_json_encode( $opts ) ) . '\'';
	
}

if( 'enable_parallax' == $parallax ) {
	$wrapper_attributes[] = 'data-parallax="true"';
	$wrapper_attributes[] = 'data-parallax-options=\'' . wp_json_encode( array( 'parallaxBG' => true ) ) . '\'';
}

//Slideshow Bg
if( $enable_slideshow_bg ) {
	$images_arr = $url_arr = $slideshow_opts = array();
	$wrapper_attributes[] = 'data-slideshow-bg="true"';
	if( !empty( $slideshow_delay ) ) {
		$slideshow_opts['delay'] = (int)$slideshow_delay;
	}
	if( !empty( $slideshow_effect ) ) {
		$slideshow_opts['effect'] = $slideshow_effect;
	}
	$images_arr = explode( ',', $slideshow_images );
	foreach( $images_arr as $image_id ) {
		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		$url_arr[] = array( 'src' => wp_get_attachment_image_url( $image_id, 'full', false ), 'alt' => ( $alt ? $alt : 'Row Background Image' ) );
	}
	$slideshow_opts['imageArray'] = $url_arr;
	$wrapper_attributes[] = 'data-slideshow-options=' . wp_json_encode( $slideshow_opts );
}

if( 'custom' != $bg_position && ! empty( $bg_position ) ) {
	$bg_styles = ' background-position:' . esc_attr( $bg_position ) . ' !important;';
} 
elseif( 'custom' === $bg_position ) {
	$bg_styles = ' background-position:' . esc_attr( $bg_pos_h ) . ' ' . esc_attr( $bg_pos_v ) . ' !important; ';
}

if( 'scroll' !== $bg_attachment ){
	$bg_attachment = ' background-attachment:' .  esc_attr( $bg_attachment ) . '; ';
} else {
	$bg_attachment = '';
}

if( !empty( $bg_styles ) ) {
	$wrapper_attributes[] = 'style="' . esc_attr( trim( $bg_styles . $bg_attachment ) ) . '"';	
}

$check = apply_filters( 'liquid_dinamic_css_output', '__return_true' );

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if( !empty( $responsive_style ) && $check || !empty( $shadow_css ) && $check ) {
	$output .= '<style>' . $responsive_style . ' ' . $shadow_css . '</style>';
}
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

echo apply_filters( 'liquid_vc_row_inner', $output );