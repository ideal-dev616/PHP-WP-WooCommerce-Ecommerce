<?php
/**
* Buttons Set Param
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * [liquid_param_select_preview description]
 * @method liquid_param_select_preview
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
vc_add_shortcode_param( 'liquid_button_set', 'liquid_param_button_set' );
function liquid_param_button_set( $settings, $value ) {
	if ( is_array( $value ) ) {
		$value = ''; // fix #1239
	}
	$output = '';
	$output .= '<div class="ld-btn-group" data-toggle="buttons">';
	$current_value = strlen( $value ) > 0 ? explode( ',', $value ) : array();
	$values = isset( $settings['value'] ) && is_array( $settings['value'] ) ? $settings['value'] : array();

		if ( !empty( $values ) ) {
			foreach ( $values as $label => $v ) {

				$checked = count( $current_value ) > 0 && in_array( $v, $current_value ) ? ' checked' : '';
				$active = count( $current_value ) > 0 && in_array( $v, $current_value ) ? ' active' : '';
				
				$output .= '<label class="ld-btn ' . $active . '">
								<input id="'
				           . $settings['param_name'] . '-' . $v . '" value="'
				           . $v . '" class="wpb_vc_param_value '
				           . $settings['param_name'] . ' ' . $settings['type'] . '" type="radio" id="buttons-' . $v . '" autocomplete="off" name="'
				           . $settings['param_name'] . '"'
				           . $checked . '>' . $label . '</label>';
			}
		}

		$output .= '</div>';


	return $output;
}