<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ReduxFramework_iconpicker' ) ) {
    class ReduxFramework_iconpicker {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 1.0.0
         */
        public function __construct( $field = array(), $value = '', $parent ) {
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
        public function render() {

				// Process placeholder
				$placeholder = ( isset( $this->field['placeholder'] ) ) ? esc_attr( $this->field['placeholder'] ) : esc_attr__( 'Select an icon', 'one' );

				// Begin the <select> tag
				echo '<select data-id="' . $this->field['id'] . '" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" class="redux-select-item liquid-icon-picker ' . $this->field['class'] . '">';
				echo '<option value=""></option>';
				
				$this->field['options'] = apply_filters( 'liquid_menu_iconpicker_icons', array() );
					
				//print_r( $this->field['options'] );
					
				// Enum through the options array
				foreach ( $this->field['options'] as $g => $i ) {
					
					echo '<optgroup label="' . esc_attr( $g ) . '">';
					
						foreach ( $i as $key => $label ) {
							$class_key = key( $label );

							// Set the selected entry
							$selected = selected( $class_key, esc_attr( $this->value ), false );
							
							echo '<option value="' . esc_attr( $class_key ) . '" ' . $selected . '>' . esc_html( current( $label ) ) . '</option>';
						}
					
					echo '</optgroup>';
					
				}

                // Close the <select> tag
                echo '</select>';

	    }
	    
		/**
         * Enqueue Function.
         * If this field requires any scripts, or css define this funct	ion and register/enqueue the scripts/css
         *
         * @since ReduxFramework 1.0.0
         */
        function enqueue() {

			$url = trailingslashit( plugin_dir_url( __FILE__ ) ) . 'iconpicker';

			wp_enqueue_style( 'liquid-iconpicker', $url . '/css/jquery.fonticonpicker.min.css' );
			wp_enqueue_style( 'liquid-iconpicker-theme', $url . '/themes/grey-theme/jquery.fonticonpicker.grey.min.css' );
			wp_enqueue_script( 'liquid-iconpicker', $url . '/jquery.fonticonpicker.min.js' ,  array('jquery'), '1.0.0', true, false );

		}
	    
	}
}