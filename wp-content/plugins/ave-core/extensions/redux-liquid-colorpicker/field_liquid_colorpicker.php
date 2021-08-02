<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ReduxFramework_liquid_colorpicker' ) ) {
    class ReduxFramework_liquid_colorpicker {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 1.0.0
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render() {

            if ( empty( $this->value ) && ! empty( $this->field['data'] ) && ! empty( $this->field['options'] ) ) {
                $this->value = $this->field['options'];
            }
			$data_cp_options = '';
			
			if( isset( $this->field['only_solid'] ) ) {
				$data_cp_options = 'data-cp-options=\'{ "cpType": "solid" }\'';
			}
			elseif( isset( $this->field['only_gradient'] ) ) {
				$data_cp_options = 'data-cp-options=\'{ "cpType": "gradient" }\'';
			}

            $qtip_title = isset( $this->field['text_hint']['title'] ) ? 'qtip-title="' . $this->field['text_hint']['title'] . '" ' : '';
            $qtip_text  = isset( $this->field['text_hint']['content'] ) ? 'qtip-content="' . $this->field['text_hint']['content'] . '" ' : '';

			$placeholder = ( isset( $this->field['placeholder'] ) && ! is_array( $this->field['placeholder'] ) ) ? ' placeholder="' . esc_attr( $this->field['placeholder'] ) . '" ' : '';
			echo '<div class="ld-colorpicker" data-colorpicker="true" ' . $data_cp_options . '>';
			echo '	<div class="ld-colorpicker-wrap">';
			echo '		<span class="ld-colorpicker-preview"></span>';
			echo '		<span class="ld-colorpicker-txt">Color</span>';
			echo '<input ' . $qtip_title . $qtip_text . 'type="hidden" id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" ' . $placeholder . 'value="' . esc_attr( $this->value ) . '" class="ld-color-val' . $this->field['class'] . '" />';
			echo '	</div><!-- /.ld-colorpicker-wrap -->';
			echo '</div><!-- /.ld-colorpicker -->';
			
        }

		/**
         * Enqueue Function.
         * If this field requires any scripts, or css define this funct	ion and register/enqueue the scripts/css
         *
         * @since ReduxFramework 1.0.0
         */
        function enqueue() {

            if (!wp_script_is ( 'redux-field-liquid-colorpicker-js' )) {

				$url = trailingslashit( plugin_dir_url( __FILE__ ) );

				wp_enqueue_style( 'ld-colorpicker', $url . 'liquid-colorpicker.css' );
				wp_enqueue_script( 'ld-colorpicker', $url . 'grapick.min.js' ,  array('jquery'), '1.0.0', true );

                wp_enqueue_script(
                    'redux-field-liquidcolorpicker-js',
                    $url . '/plugin.liquidColorPicker.min.js',
                    array( 'jquery', 'redux-js', 'redux-spectrum-js' ),
                    time(),
                    true
                );
            }

            // Spectrum CSS
            if (!wp_style_is ( 'redux-spectrum-css' )) {
                wp_enqueue_style('redux-spectrum-css');
            }
            
		}
    }
}