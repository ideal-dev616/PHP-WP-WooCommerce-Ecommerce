<?php

/**
* Liquid Colorpicker Params
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
 * [liquid_param_colorpicker description]
 * @method liquid_param_colorpicker
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
vc_add_shortcode_param( 'liquid_colorpicker', 'liquid_param_colorpicker' );

function liquid_param_colorpicker( $settings, $value ) {
	
	$data_cp_options = '';
	
	if( $settings['only_solid'] ) {
		$data_cp_options = 'data-cp-options=\'{ "cpType": "solid" }\'';
	}
	elseif( $settings['only_gradient'] ) {
		$data_cp_options = 'data-cp-options=\'{ "cpType": "gradient" }\'';
	}

	$output = '';
	
	$output .= '<div class="ld-colorpicker" data-colorpicker="true" '. $data_cp_options .'>';
	$output .= '	<div class="ld-colorpicker-wrap">';
	$output .= '		<span class="ld-colorpicker-preview"></span>';
	$output .= '		<span class="ld-colorpicker-txt">Color</span>';
	$output .= sprintf( '<input type="text" class="hidden wpb_vc_param_value" id="%1$s" name="%1$s" value="%2$s">', $settings['param_name'], $value );
	$output .= sprintf( '<input type="hidden" name="%1$s-liquid-colorpicker" id="%1$s-liquid-colorpicker" class="ld-color-val" value="%2$s">', $settings['param_name'], $value );
	$output .= '	</div><!-- /.ld-colorpicker-wrap -->';
	$output .= '</div><!-- /.ld-colorpicker -->';

	return $output;
}