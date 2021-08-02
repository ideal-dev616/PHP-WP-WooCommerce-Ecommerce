<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $align = $responsive_align = $el_id = $css = $offset = '';
$output = '';

//Paralax vars
$parallax = $parallax_preset = $parallax_from = $parallax_to = $parallax_time = $parallax_duration = $parallax_offset = $parallax_trigger = $parallax_trigger_number = $enable_reverse = '';

$translate_from_x = $translate_from_y = $translate_from_z = $scale_from_x = $scale_from_y = $scale_from_z = $rotate_from_x = $rotate_from_y = $rotate_from_z = $from_torigin_x = $from_torigin_x_custom = $from_torigin_y = $from_torigin_y_custom = $from_opacity = '';

$translate_to_x = $translate_to_y = $translate_to_z = $scale_to_x = $scale_to_y = $scale_to_z = $rotate_to_x = $otate_to_y = $rotate_to_z = $to_torigin_x = $to_torigin_x_custom = $to_torigin_y = $to_torigin_y_custom = $to_opacity = $to_delay = $to_easy = '';

//Custom Animation
$enable_content_animation = $animation_preset = $ca_duration = $ca_start_delay = $ca_delay = $ca_easing = $ca_direction = $ca_init_translate_x = $ca_init_translate_y = $ca_init_translate_z = $ca_init_scale_x = $ca_init_scale_y = $ca_init_scale_z = $ca_init_rotate_x = $ca_init_rotate_y = $ca_init_rotate_z = $ca_init_opacity = $ca_an_translate_x = $ca_an_translate_y = $ca_an_translate_z = $ca_an_scale_x = $ca_an_scale_y = $ca_an_scale_z = $ca_an_rotate_x = $ca_an_rotate_y = $ca_an_rotate_z = $ca_an_opacity = '';

//Shadowbox
$enable_column_shadowbox = $column_box_shadow = $custom_style = $responsive_style = $video_bg_source = $video_local_mp4_url = $video_local_webm_url = $y_start_time = $y_end_time = $mobile_video_bg = $has_video_bg = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$liquid_id = uniqid( 'liquid-column-' );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
	$align,
	$responsive_align,
	$liquid_id
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

if( !empty( $responsive_css ) ) {
	$responsive_id = uniqid( 'liquid-column-responsive-' );
	$css_classes[] = $responsive_id;
	$responsive_selector = $responsive_id . ' > .vc_column-inner > .wpb_wrapper';
	$responsive_style = Liquid_Responsive_Css_Editor::generate_css( $responsive_css, $responsive_selector );
}

if( $enable_column_shadowbox ) {
	$column_box_shadow = vc_param_group_parse_atts( $column_box_shadow );
	$column_box_shadow_css = liquid_helper()->get_shadow_css( $column_box_shadow );
	$custom_style = '.' . $liquid_id . ' > .vc_column-inner > .wpb_wrapper { box-shadow:' . $column_box_shadow_css . '};';
}

$wrapper_attributes = $ca_data_opts = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$video_bg_output = $disable_mobile = '';
if ( !empty( $video_bg ) ) {

	wp_enqueue_script( 'jquery-ytplayer' );
	wp_enqueue_style( 'jquery-ytplayer' );

	if( 'local' === $video_bg_source ) {
		if( !empty( $video_local_mp4_url ) || !empty( $video_local_webm_url ) ) {
			
			if( 'yes' === $mobile_video_bg ) {
				$disable_mobile = 'data-inlinevideo-options=\'' . wp_json_encode( array( 'disableOnMobile' => true ) ) . '\'';
			}

			wp_enqueue_script( 'wp-mediaelement' );
			wp_enqueue_style( 'wp-mediaelement' );
			
			$video_bg_output = '<div class="lqd-vbg-wrap">
							<div class="lqd-vbg-inner">
								<span class="lqd-vbg-loader"></span>
								<video class="lqd-vbg-video hidden" data-video-bg="true" ' . $disable_mobile . ' playsinline autoplay loop muted>';
								if( !empty( $video_local_mp4_url ) ) {
									$video_bg_output .= '<source src="'. esc_url( $video_local_mp4_url ) .'" type="video/mp4">';
								}
								if( !empty( $video_local_webm_url ) ) {
									$video_bg_output .= '<source src="'. esc_url( $video_local_webm_url ) .'" type="video/webm">';
								}
			$video_bg_output .=	'</video><!-- /.lqd-vbg-video -->
						</div><!-- /.lqd-vbg-inner -->
					</div><!-- /.lqd-vbg-wrap -->';
		}

	}
	else {
		
		$data_youtube = array();
		if( !empty( $video_bg_url ) ) {
			$data_youtube['videoURL'] = esc_url( $video_bg_url );
		}
		if( !empty( $y_start_time ) ) {
			$data_youtube['startAt'] = (int)$y_start_time;
		}
		if( !empty( $y_end_time ) ) {
			$data_youtube['stopAt'] = (int)$y_end_time;
		}
		if( 'yes' === $mobile_video_bg ) {
			$data_youtube['disableOnMobile'] = true;
		}
		
		$video_bg_output = '<div class="lqd-vbg-wrap">
						<div class="lqd-vbg-inner">
							<span class="lqd-vbg-loader"></span>
							<div
								class="lqd-vbg-video"
								data-video-bg="true"
								data-youtube-options=\'' . wp_json_encode( $data_youtube ) . '\'>
							</div><!-- /.lqd-vbg-video -->
					</div><!-- /.lqd-vbg-inner -->
				</div><!-- /.lqd-vbg-wrap -->';

	}
}

if( 'yes' === $enable_content_animation ) {
	
	$presetsValues = array();
	
	$opts = $init_values = $animations_values = $arr = array();
	
	$opts['triggerHandler'] = 'inview';
	$opts['animationTarget'] = 'all-childs';
	
	$opts['duration'] = !empty( $ca_duration ) ? $ca_duration : 700;
	if( !empty( $ca_start_delay ) ) {
		$opts['startDelay'] = $ca_start_delay;
	}
	$opts['delay'] = !empty( $ca_delay ) ? $ca_delay : 100;
	$opts['easing'] = $ca_easing;
	$opts['direction'] = $ca_direction;
	
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
		
		if ( isset( $ca_init_opacity ) && '1' !== $ca_init_opacity ) { $init_values['opacity']    = ( float ) $ca_init_opacity; }
		
	
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
	
		if ( isset( $ca_an_opacity ) && '1' !== $ca_init_opacity ) { $animations_values['opacity']    = ( float ) $ca_an_opacity; }	
	
	}

	$opts['initValues'] = !empty( $init_values ) ? $init_values : array();
	$opts['animations'] = !empty( $animations_values ) ? $animations_values : array();

	$ca_data_opts[] = 'data-custom-animations="true"';
	$ca_data_opts[] = 'data-ca-options=\'' . stripslashes( wp_json_encode( $opts ) ) . '\'';
	
}

if( 'yes' === $parallax ) {

	$parallax_data = $parallax_data_from = $parallax_data_to = $parallax_opts = array();

	$wrapper_attributes[] = 'data-parallax="true"';

	//Data-options-from
	if ( !empty( $translate_from_x ) ) { $parallax_data_from['translateX']      = ( int ) $translate_from_x; }
	if ( !empty( $translate_from_y ) ) { $parallax_data_from['translateY']      = ( int ) $translate_from_y; }
	if ( !empty( $translate_from_z ) ) { $parallax_data_from['translateZ']      = ( int ) $translate_from_z; }

	if ( '1' !== $scale_from_x ) { $parallax_data_from['scaleX']     = ( float ) $scale_from_x; }
	if ( '1' !== $scale_from_y ) { $parallax_data_from['scaleY']     = ( float ) $scale_from_y; }
	if ( '1' !== $scale_from_z ) { $parallax_data_from['scaleZ']     = ( float ) $scale_from_z; }

	if ( !empty( $rotate_from_x ) ) { $parallax_data_from['rotateX'] = ( int ) $rotate_from_x; }
	if ( !empty( $rotate_from_y ) ) { $parallax_data_from['rotateY'] = ( int ) $rotate_from_y; }
	if ( !empty( $rotate_from_z ) ) { $parallax_data_from['rotateZ'] = ( int ) $rotate_from_z; }

	if ( isset( $from_opacity ) && '1' !== $from_opacity ) { $parallax_data_from['opacity']    = ( float ) $from_opacity; }

	if ( ! empty(
		$from_torigin_x_custom ) ) { $_x_custom = $from_torigin_x_custom;
	} else {
		$_x_custom = ! empty( $from_torigin_x ) ? $from_torigin_x : '';
	}
	if ( ! empty( $from_torigin_y_custom ) ) {
		$_y_custom = $from_torigin_y_custom;
	} else {
		$_y_custom = ! empty( $from_torigin_y ) ? $from_torigin_y : '';
	}
	if ( ! empty( $_x_custom ) && ! empty( $_y_custom ) ) {
		$parallax_data_from['transformOrigin'] = $_x_custom . '&nbsp;' . $_y_custom;
	}

	//Data-options-to
	if ( !empty( $translate_from_x ) ) { $parallax_data_to['translateX'] = ( int ) $translate_to_x; }
	if ( !empty( $translate_from_y ) ) { $parallax_data_to['translateY'] = ( int ) $translate_to_y; }
	if ( !empty( $translate_from_z ) ) { $parallax_data_to['translateZ'] = ( int ) $translate_to_z; }

	if ( isset( $scale_to_x ) && '1' !== $scale_from_x ) { $parallax_data_to['scaleX'] = ( float ) $scale_to_x; }
	if ( isset( $scale_to_y ) && '1' !== $scale_from_y ) { $parallax_data_to['scaleY'] = ( float ) $scale_to_y; }
	if ( isset( $scale_to_z ) && '1' !== $scale_from_z ) { $parallax_data_to['scaleZ'] = ( float ) $scale_to_z; }

	if ( !empty( $rotate_from_x ) ) { $parallax_data_to['rotateX'] = ( int ) $rotate_to_x; }
	if ( !empty( $rotate_from_y ) ) { $parallax_data_to['rotateY'] = ( int ) $rotate_to_y; }
	if ( !empty( $rotate_from_z ) ) { $parallax_data_to['rotateZ'] = ( int ) $rotate_to_z; }

	if ( isset( $to_opacity ) && '1' !== $from_opacity ) { $parallax_data_to['opacity'] = ( float ) $to_opacity; }

	if( ! empty(
		$to_torigin_x_custom ) ) { $to_x_custom = $to_torigin_x_custom;
	} else {
		$to_x_custom = ! empty( $to_torigin_x ) ? $to_torigin_x : '';
	}
	if( ! empty( $to_torigin_y_custom ) ) {
		$to_y_custom = $to_torigin_y_custom;
	} else {
		$to_y_custom = ! empty( $to_torigin_y ) ? $to_torigin_y : '';
	}
	if( ! empty( $to_x_custom ) && ! empty( $to_y_custom ) ) {
		$parallax_data_to['transformOrigin'] = $to_x_custom . '&nbsp;' . $to_y_custom;
	}

	//Parallax general options
	if ( ! empty( $parallax_from ) ) {
		$parallax_data['from'] = $parallax_from;
	} else {
		$parallax_data['from'] = $parallax_data_from;
	}
	if( ! empty( $parallax_to ) ) {
		$parallax_data['to'] = $parallax_to;
	} else {
		$parallax_data['to'] = $parallax_data_to;
	}

	if( is_array( $parallax_data['from'] ) && ! empty( $parallax_data['from'] ) ) {
		$wrapper_attributes[] = 'data-parallax-from=\'' . wp_json_encode( $parallax_data['from'] ) . '\'';
	}
	elseif( ! empty( $parallax_from ) ) {
		$wrapper_attributes[] = 'data-parallax-from=\'{' . $parallax_from . '}\'';
	}

	if( is_array( $parallax_data['to'] ) && ! empty( $parallax_data['to'] ) ) {

		$wrapper_attributes[] = 'data-parallax-to=\'' . wp_json_encode( $parallax_data['to'] ) . '\'';
	}
	elseif( ! empty( $parallax_to ) ) {
		$wrapper_attributes[] = 'data-parallax-to=\'{' . $parallax_to . '}\'';
	}

	if( ! empty( $parallax_time ) ) { $parallax_opts['time'] = esc_attr( $parallax_time ); }
	if( ! empty( $parallax_duration ) ) { $parallax_opts['duration'] = esc_attr( $parallax_duration ); }
	if ( isset( $to_easy ) ) { $parallax_opts['ease'] = $to_easy; }
	if ( ! empty( $to_delay ) ) { $parallax_opts['delay'] = ( float ) $to_delay; }
	if( ! empty( $parallax_offset ) ) { $parallax_opts['offset'] = esc_attr( $parallax_offset ); }
	if( 'yes' === $enable_reverse ) {
		$parallax_opts['reverse'] = true;
	}
	else {
		$parallax_opts['reverse'] = false;
	}
	if( 'number' !== $parallax_trigger ){
		$parallax_opts['triggerHook'] = esc_attr( $parallax_trigger );
	}
	elseif ( ! empty( $parallax_trigger_number ) ) {
		$parallax_opts['triggerHook'] = esc_attr( $parallax_trigger_number );
	}
	if( ! empty( $parallax_opts ) ) {
		$wrapper_attributes[] = 'data-parallax-options=\'' . wp_json_encode( $parallax_opts ) .'\'';
	}
}

$check = apply_filters( 'liquid_dinamic_css_output', '__return_true' );

if( !empty( $responsive_style ) && $check ) {
	$output .= '<style>' . $responsive_style . '</style>';
}
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $video_bg_output;
$output .= '<div class="vc_column-inner">';
$output .= '<div class="wpb_wrapper ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '"  ' . implode( ' ', $ca_data_opts ) . '>';
$output .= '<div class="wpb_wrapper-inner">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
if( ! empty( $custom_style ) && $check ) {
	$output .= '<script type="text/javascript">'
			. '(function($) {'
				. '$("head").append("<style>' . $custom_style . '</style>");'
			. '})(jQuery);'
		. '</script>';
}
$output .= '</div>';

echo apply_filters( 'liquid_vc_column_inner', $output );