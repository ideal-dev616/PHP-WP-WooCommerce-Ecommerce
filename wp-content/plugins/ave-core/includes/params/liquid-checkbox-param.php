<?php

/**
* Liquid Checbox Param
*/
if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
 * [liquid_param_subheading description]
 * @method liquid_param_subheading
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */

vc_add_shortcode_param( 'liquid_checkbox', 'liquid_param_checkbox' );
function liquid_param_checkbox( $settings, $value ) {
		$output = $columns = $row_start = $row_end = '';
	if ( is_array( $value ) ) {
		$value = ''; // fix #1239
	}
	$current_value = strlen( $value ) > 0 ? explode( ',', $value ) : array();
	$values = isset( $settings['value'] ) && is_array( $settings['value'] ) ? $settings['value'] : array( esc_attr__( 'Yes' ) => 'true' );
	if( count( $values ) > 1 ) {
		$columns = 	'vc_col-sm-4 ';
		$row_start = '<div class="vc_row">';
		$row_end = '</div>';
	}
	$output .= $row_start;
	if ( ! empty( $values ) ) {
		foreach ( $values as $label => $v ) {
			$checked = count( $current_value ) > 0 && in_array( $v, $current_value ) ? ' checked' : '';
			$output .= '<div class="' . $columns . 'liquid-checkbox-with-label"><label class="vc_checkbox-label"><input id="'
			           . $settings['param_name'] . '-' . $v . '" value="'
			           . $v . '" class="wpb_vc_param_value '
			           . $settings['param_name'] . ' ' . $settings['type'] . '" type="checkbox" name="'
			           . $settings['param_name'] . '"'
			           . $checked . '> <span class="checkbox"></span> <span>' . $label . '</span></label></div>';
		}
	}
	$output .= $row_end;

	return $output;
}