<?php
/**
* Shortcode Contact Form
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Contact_Form extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Drop VC CF7
		//vc_remove_element( 'contact-form-7' );

		// Properties
		$this->slug        = 'ld_cf7';
		$this->title       = esc_html__( 'Liquid Contact Form 7', 'ave-core' );
		$this->icon        = 'icon-wpb-contactform7';
		$this->description = esc_html__( 'Add Contact Form7', 'ave-core' );

		parent::__construct();
		
	}

	public function get_params() {

		$this->params = array(
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'id',
				'heading'     => esc_html__( 'Select contact form', 'ave-core' ),
				'save_always' => true,
				'description' => esc_html__( 'Choose contact form from the drop down list.', 'ave-core' ),
				'data'        => 'posts',
				'args'        => array(
					'post_type'   => 'wpcf7_contact_form',
					'numberposts' => -1,
					'posts_per_page' => 100,
					'orderby'     => 'title'
				)
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_inputs',
				'heading'    => esc_html__( 'Inputs', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Input Shape', 'ave-core' ),
				'desription' => esc_html__( 'Select input shape', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )	   => '',
					esc_html__( 'Underlined', 'ave-core' ) => 'lqd-contact-form-inputs-underlined',
					esc_html__( 'Filled', 'ave-core' )     => 'lqd-contact-form-inputs-filled',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Input Size', 'ave-core' ),
				'desription' => esc_html__( 'Select input size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Small', 'ave-core' )   => 'lqd-contact-form-inputs-sm',
					esc_html__( 'Medium', 'ave-core' )  => 'lqd-contact-form-inputs-md',
					esc_html__( 'Large', 'ave-core' )   => 'lqd-contact-form-inputs-lg',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'roundness',
				'heading'    => esc_html__( 'Input Roundness', 'ave-core' ),
				'desription' => esc_html__( 'Select input roundness', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Round', 'ave-core' )   => 'lqd-contact-form-inputs-round',
					esc_html__( 'Circle', 'ave-core' )  => 'lqd-contact-form-inputs-circle',
				),
				'dependency' => array(
					'element' => 'shape',
					'value_not_equal_to' => array( 'lqd-contact-form-inputs-underlined' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'thickness',
				'heading'    => esc_html__( 'Input Border Thickness', 'ave-core' ),
				'desription' => esc_html__( 'Select border thickness', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Thick', 'ave-core' )   => 'lqd-contact-form-inputs-border-thick',
					esc_html__( 'Thicker', 'ave-core' ) => 'lqd-contact-form-inputs-border-thicker',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_input',
				'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for input', 'ave-core' ),
			),
			//Input Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'input_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group'      => esc_html__( 'Input Typo', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			//Submit Button
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_submit',
				'heading'    => esc_html__( 'Submit Button', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_shape',
				'heading'    => esc_html__( 'Button Shape', 'ave-core' ),
				'desription' => esc_html__( 'Select button shape', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )	   => '',
					esc_html__( 'Underlined', 'ave-core' ) => 'lqd-contact-form-button-underlined',
					esc_html__( 'Bordered', 'ave-core' )   => 'lqd-contact-form-button-bordered',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_thickness',
				'heading'    => esc_html__( 'Button Border Thickness', 'ave-core' ),
				'desription' => esc_html__( 'Select button thickness', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Thick', 'ave-core' )   => 'lqd-contact-form-button-border-thick',
					esc_html__( 'Thicker', 'ave-core' ) => 'lqd-contact-form-button-border-thicker',
				),
				'dependency' => array(
					'element' => 'btn_shape',
					'value' => array( 'lqd-contact-form-button-bordered' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_size',
				'heading'    => esc_html__( 'Button Size', 'ave-core' ),
				'desription' => esc_html__( 'Select button size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Small', 'ave-core' )   => 'lqd-contact-form-button-sm',
					esc_html__( 'Medium', 'ave-core' )  => 'lqd-contact-form-button-md',
					esc_html__( 'Large', 'ave-core' )   => 'lqd-contact-form-button-lg',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_width',
				'heading'    => esc_html__( 'Button Width', 'ave-core' ),
				'desription' => esc_html__( 'Select button width', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Fullwidth', 'ave-core' ) => 'lqd-contact-form-button-block',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_roundness',
				'heading'    => esc_html__( 'Button Roundness', 'ave-core' ),
				'desription' => esc_html__( 'Select button roundness', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Round', 'ave-core' )   => 'lqd-contact-form-button-round',
					esc_html__( 'Circle', 'ave-core' )  => 'lqd-contact-form-button-circle',
				),
				'dependency' => array(
					'element' => 'btn_shape',
					'value_not_equal_to' => array( 'lqd-contact-form-button-underlined' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_submit',
				'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for submit', 'ave-core' ),
			),
			//Submit Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'submit_fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_submit',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Submit Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'submit_lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_submit',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Submit Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'submit_fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_submit',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Submit Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'submit_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_submit',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Submit Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Submit button theme default font family?', 'ave-core' ),
				'param_name'  => 'submit_use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Submit Typo', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_submit',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'submit_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group'      => esc_html__( 'Submit Typo', 'ave-core' ),
				'dependency' => array(
					'element'            => 'submit_use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			
			array(
				'type'        => 'css_editor',
				'param_name'  => 'css',
				'description' => '',
				'heading'     => esc_html__( 'CSS Box', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			
			//Input Bg
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_input_design',
				'heading'    => esc_html__( 'Input Design Options', 'ave-core' ),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'lqd_bg_color',
				'heading'    => 'Background Color',
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
				'dependency' => array(
					'element' => 'shape',
					'value_not_equal_to' => array( 'lqd-contact-form-inputs-underlined' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'hbg_color',
				'heading'    => 'Hover Background Color',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'shape',
					'value_not_equal_to' => array( 'lqd-contact-form-inputs-underlined' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'color',
				'only_solid' => true,
				'heading'    => 'Text Color',
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'h_color',
				'only_solid' => true,
				'heading'    => 'Hover Text Color',
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'border_color',
				'only_solid' => true,
				'heading'    => esc_html__( 'Border Color', 'ave-core' ),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'hover_border_color',
				'only_solid' => true,
				'heading'    => esc_html__( 'Focus Border Color', 'ave-core' ),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			//Submit design options
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_submit_design',
				'heading'    => esc_html__( 'Submit Design Options', 'ave-core' ),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'submit_bg_color',
				'heading'    => 'Button Background Color',
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
				'dependency' => array(
					'element' => 'btn_shape',
					'value_not_equal_to' => array( 'lqd-contact-form-button-underlined' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'submit_hbg_color',
				'heading'    => 'Button Hover Background Color',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'btn_shape',
					'value_not_equal_to' => array( 'lqd-contact-form-button-underlined' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'submit_color',
				'only_solid' => true,
				'heading'    => 'Button Label Color',
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'submit_h_color',
				'only_solid' => true,
				'heading'    => 'Button Hover Label Color',
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'submit_border_color',
				'only_solid' => true,
				'heading'    => esc_html__( 'Button Border Color', 'ave-core' ),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'submit_hover_border_color',
				'only_solid' => true,
				'heading'    => esc_html__( 'Button Hover Border Color', 'ave-core' ),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
		);
		
		$this->add_extras();

	}
	
	protected function generate_css() {


		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();
		$input_font_inline_style = $submit_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$input_font_data = $this->get_fonts_data( $input_font );

			// Build the inline style
			$input_font_inline_style = $this->google_fonts_style( $input_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $input_font_data );

		}

		$elements[ liquid_implode( '%1$s input,%1$s textarea,%1$s .ui-selectmenu-button' ) ] = array( $input_font_inline_style );
		$elements[ liquid_implode( '%1$s input,%1$s textarea,%1$s .ui-selectmenu-button' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s input,%1$s textarea,%1$s .ui-selectmenu-button' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s input,%1$s textarea,%1$s .ui-selectmenu-button' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s input,%1$s textarea,%1$s .ui-selectmenu-button' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( 'yes' !== $submit_use_theme_fonts ) {

			// Build the data array
			$submit_font_data = $this->get_fonts_data( $submit_font );

			// Build the inline style
			$submit_font_inline_style = $this->google_fonts_style( $submit_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $submit_font_data );

		}

		$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ] = array( $submit_font_inline_style );
		$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ]['font-size'] = !empty( $submit_fs ) ? $submit_fs : '';
		$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ]['line-height'] = !empty( $submit_lh ) ? $submit_lh : '';
		$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ]['font-weight'] = !empty( $submit_fw ) ? $submit_fw : '';
		$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ]['letter-spacing'] = !empty( $submit_ls ) ? $submit_ls : '';
		
		if( !empty( $lqd_bg_color ) ) {
			$elements[ liquid_implode( '%1$s input, %1$s select, %1$s textarea, %1$s .ui-selectmenu-button' ) ]['background'] = $lqd_bg_color;
		}
		if( !empty( $hbg_color ) ) {
			$elements[ liquid_implode( '%1$s input:focus, %1$s select:focus, %1$s textarea:focus, %1$s .ui-selectmenu-button:hover' ) ]['background'] = $hbg_color;
		}
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s input, %1$s select, %1$s textarea, %1$s .ui-selectmenu-button' ) ]['color'] = $color;
		}
		if( !empty( $h_color ) ) {
			$elements[ liquid_implode( '%1$s input:focus, %1$s select:focus, %1$s textarea:focus, %1$s .ui-selectmenu-button:hover' ) ]['color'] = $h_color;
		}
		if( !empty( $border_color ) ) {
			$elements[ liquid_implode( '%1$s input, %1$s select, %1$s textarea, %1$s .ui-selectmenu-button' ) ]['border-color'] = $border_color;
		}
		if( !empty( $hover_border_color ) ) {
			$elements[ liquid_implode( '%1$s input:focus, %1$s select:focus, %1$s textarea:focus, %1$s .ui-selectmenu-button:hover' ) ]['border-color'] = $hover_border_color;
		}
		
		if( !empty( $submit_bg_color ) ) {
			$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ]['background'] = $submit_bg_color;
		}
		if( !empty( $submit_hbg_color ) ) {
			$elements[ liquid_implode( '%1$s input[type="submit"]:focus,%1$s input[type="submit"]:hover, %1$s button[type="submit"]:focus, %1$s button[type="submit"]:hover' ) ]['background'] = $submit_hbg_color;
		}
		if( !empty( $submit_color ) ) {
			$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ]['color'] = $submit_color;
		}
		if( !empty( $submit_h_color ) ) {
			$elements[ liquid_implode( '%1$s input[type="submit"]:hover, %1$s button[type="submit"]:hover' ) ]['color'] = $submit_h_color;
		}
		if( !empty( $submit_border_color ) ) {
			$elements[ liquid_implode( '%1$s input[type="submit"], %1$s button[type="submit"]' ) ]['border-color'] = $submit_border_color;
		}
		if( !empty( $submit_hover_border_color ) ) {
			$elements[ liquid_implode( '%1$s input[type="submit"]:hover, %1$s button[type="submit"]:hover' ) ]['border-color'] = $submit_hover_border_color;
		}
		

		$this->dynamic_css_parser( $id, $elements );
	}
	
}

if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) || defined( 'WPCF7_PLUGIN' ) ) {
	new LD_Contact_Form;
}