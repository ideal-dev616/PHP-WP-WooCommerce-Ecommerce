<?php
/**
* SubHeading Param
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
vc_add_shortcode_param( 'subheading', 'liquid_param_subheading' );
function liquid_param_subheading( $settings, $value ) {

	return '<div class="subheading_block">' .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' . esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />' . '</div>';

}