<?php
/**
* Shortcode Header Dropdown
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Lang_Switcher extends LD_Shortcode { 
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_lang_switcher';
		$this->title       = esc_html__( 'Header Language Switcher', 'ave-core' );
		$this->icon        = 'fa fa-bars';
		$this->description = esc_html__( 'Create custom dropdown.', 'ave-core' );
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array(
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'show_on_mobile',
				'heading'     => esc_html__( 'Show on Mobile', 'ave-core' ),
				'description' => esc_html__( 'Enable if you want to display it on mobile devices', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'lqd-show-on-mobile',
					esc_html__( 'No', 'ave-core' )  => '',
				),
				'std' => ''
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_trigger',
				'heading'     => esc_html__( 'Custom font for Trigger?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for trigger label', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_menu',
				'heading'     => esc_html__( 'Custom font for Dropdown?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for dropdown', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'trigger_fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_trigger',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo Label', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'trigger_lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_trigger',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo Label', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'trigger_fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_trigger',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo Label', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'trigger_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_trigger',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo Label', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Trigger Label theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts_trigger',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Typo Label', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_trigger',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'trigger_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Typo Label', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_trigger',
					'value_not_equal_to' => 'yes',
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'hover_style',
				'heading'     => esc_html__( 'Hover Style', 'ave-core' ),
				'description' => esc_html__( 'Select hover style for dropdown', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Underlined', 'ave-core' )   => 'ld-dropdown-menu-underlined',
				),
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo DropDown', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo DropDown', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo DropDown', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo DropDown', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Dropdown items theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Typo DropDown', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'menu_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Typo DropDown', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Label Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the trigger label', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the dropdown item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Hover Color', 'ave-core' ),
				'description' => esc_html__( 'Pick hover color for the dropdown item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Design Options' ),
			)

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
		$id = '.' . $this->get_id();
		$menu_font_inline_style = $trigger_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$menu_font_data = $this->get_fonts_data( $menu_font );

			// Build the inline style
			$menu_font_inline_style = $this->google_fonts_style( $menu_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $menu_font_data );

		}
		
		if( 'yes' !== $use_theme_fonts_trigger ) {

			// Build the data array
			$trigger_font_data = $this->get_fonts_data( $trigger_font );

			// Build the inline style
			$trigger_font_inline_style = $this->google_fonts_style( $trigger_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $trigger_font_data );

		}
		
		$elements[ liquid_implode( '%1$s li > a' ) ] = array( $menu_font_inline_style );
		$elements[ liquid_implode( '%1$s li > a' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s li > a' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s li > a' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s li > a' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		$elements[ liquid_implode( '%1$s .ld-module-trigger-txt' ) ] = array( $trigger_font_inline_style );
		$elements[ liquid_implode( '%1$s .ld-module-trigger-txt' ) ]['font-size'] = !empty( $trigger_fs ) ? $trigger_fs : '';
		$elements[ liquid_implode( '%1$s .ld-module-trigger-txt' ) ]['line-height'] = !empty( $trigger_lh ) ? $trigger_lh : '';
		$elements[ liquid_implode( '%1$s .ld-module-trigger-txt' ) ]['font-weight'] = !empty( $trigger_fw ) ? $trigger_fw : '';
		$elements[ liquid_implode( '%1$s .ld-module-trigger-txt' ) ]['letter-spacing'] = !empty( $trigger_ls ) ? $trigger_ls : '';

		if( !empty( $trigger_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-module-trigger-txt' ) ]['color'] = $trigger_color;
		}
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s li > a' ) ]['color'] = $color;
		}
		if( !empty( $hcolor ) ) {
			$elements[ liquid_implode( '%1$s li > a:hover' ) ]['color'] = $hcolor;
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Lang_Switcher;