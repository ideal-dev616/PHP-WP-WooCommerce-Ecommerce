<?php
/**
* Liquid Checkbox Param
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
vc_add_shortcode_param( 'liquid_advanced_checkbox', 'liquid_param_advanced_checkbox' );
function liquid_param_advanced_checkbox( $settings, $value ) {
		$output = $columns = $row_start = $row_end = '';
	if ( is_array( $value ) ) {
		$value = ''; // fix #1239
	}
	$current_value = strlen( $value ) > 0 ? explode( ',', $value ) : array();
	$values = isset( $settings['value'] ) && is_array( $settings['value'] ) ? $settings['value'] : array( esc_attr__( 'Yes' ) => 'true' );

	if ( ! empty( $values ) ) {
		foreach ( $values as $label => $v ) {
			$checked = count( $current_value ) > 0 && in_array( $v, $current_value ) ? ' checked' : '';
			$output .= '<div class="liquid-checkbox-with-label liquid-advanced-checkbox"><label class="vc_checkbox-label"><input id="'
			           . $settings['param_name'] . '-' . $v . '" value="'
			           . $v . '" class="wpb_vc_param_value '
			           . $settings['param_name'] . ' ' . $settings['type'] . '" type="checkbox" name="'
			           . $settings['param_name'] . '"'
			           . $checked . '> <span>' . $label . '</span></label></div>';
		}
	}

	return $output;
}