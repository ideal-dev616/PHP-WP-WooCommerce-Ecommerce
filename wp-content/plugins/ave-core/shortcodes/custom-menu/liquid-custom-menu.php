<?php
/**
* Shortcode Custom Menu
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Custom_Menu extends LD_Shortcode { 
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_custom_menu';
		$this->title       = esc_html__( 'Liquid Custom Menu', 'ave-core' );
		$this->icon        = 'fa fa-list';
		$this->description = esc_html__( 'Create custom menu.', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array(
			array(
				'type' => 'dropdown',
				'param_name' => 'source',
				'heading' => esc_html__( 'Data Source', 'ave-core' ),
				'description' => esc_html__( 'Select Data source of the custom menu, it can be an existent wp menu or custom menu items added here the Items option.', 'ave-core' ),
				'value' => array(
					esc_html__( 'WP Menus', 'ave-core' ) => 'wp_menus',
					esc_html__( 'Custom', 'ave-core' ) => 'custom',
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'menu_slug',
				'heading'     => esc_html__( 'Menu', 'ave-core' ),
				'description' => esc_html__( 'Select the menu you want to use.', 'ave-core' ),
				'admin_label' => true,
				'value' => ld_helper()->get_terms_data_for_vc('nav_menu'),
				'dependency' => array(
					'element' => 'source',
					'value' => 'wp_menus'
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'localscroll',
				'heading'     => esc_html__( 'Local Scroll?', 'ave-core' ),
				'description' => esc_html__( 'Enable to use localscroll feature for the menu items on the page', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'custom'
				),
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Items', 'ave-core' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'label',
						'heading'     => esc_html__( 'Label', 'ave-core' ),
						'description' => esc_html__(  'Add label item', 'ave-core' ),
						'admin_label' => true,
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'ave-core' ),
						'description' => esc_html__(  'Add link', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'target',
						'heading'     => esc_html__( 'Target', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6',
						'value' => array(
							esc_html__( 'Self', 'ave-core' ) => '_self',
							esc_html__( 'Blank', 'ave-core' )  => '_blank',
							esc_html__( 'Parent', 'ave-core' )   => '_parent',
							esc_html__( 'Top', 'ave-core' )   => '_top',
						),
						'std' => '_self',
					),
				),
				'dependency' => array(
					'element' => 'source',
					'value' => 'custom'
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'menu_alignment',
				'heading'     => esc_html__( 'Menu Alignment', 'ave-core' ),
				'description' => esc_html__( 'Select alignement for the menu', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Left', 'ave-core' ) => '',
					esc_html__( 'Center', 'ave-core' )  => 'text-center',
					esc_html__( 'Right', 'ave-core' )   => 'text-right',
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'sticky',
				'heading'     => esc_html__( 'Sticky?', 'ave-core' ),
				'description' => esc_html__( 'Enable to make menu sticky', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name'  => 'sticky_duration',
				'heading'     => esc_html__( 'Sticky duration', 'ave-core' ),
				'description' => esc_html__( 'Select sticky duration', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )  => '',
					esc_html__( 'Infinite', 'ave-core' ) => 'infinite',
				),
				'dependency' => array(
					'element' => 'sticky',
					'value'   => 'yes'
				)
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'inline',
				'heading'     => esc_html__( 'Inline?', 'ave-core' ),
				'description' => esc_html__( 'Enable to make menu inline', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'inline-nav' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'separator',
				'heading'     => esc_html__( 'Separator', 'ave-core' ),
				'description' => esc_html__( 'Add separator', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => ',',
				'dependency' => array(
					'element' => 'inline',
					'value' => 'inline-nav'
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'spacing',
				'heading'     => esc_html__( 'Space', 'ave-core' ),
				'description' => esc_html__( 'Space between items', 'ave-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_menu',
				'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for menu', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform',
				'heading'    => esc_html__( 'Transformation', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )    => '',
					esc_html__( 'Uppercase', 'ave-core' )  => 'uppercase',
					esc_html__( 'Lowercase', 'ave-core' )  => 'lowercase',
					esc_html__( 'Capitalize', 'ave-core' ) => 'capitalize',
				),
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bgcolor',
				'heading'     => esc_html__( 'Background Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a background color for the container', 'ave-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Hover Color', 'ave-core' ),
				'description' => esc_html__( 'Pick hover color for the item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a background color for the item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_hcolor',
				'heading'     => esc_html__( 'Hover Background Color', 'ave-core' ),
				'description' => esc_html__( 'Pick background hover color for the item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
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
		$id = '.' . $this->get_id();
		$menu_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$menu_font_data = $this->get_fonts_data( $menu_font );

			// Build the inline style
			$menu_font_inline_style = $this->google_fonts_style( $menu_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $menu_font_data );

		}
		
		$elements[ liquid_implode( '%1$s > li > a' ) ] = array( $menu_font_inline_style );
		$elements[ liquid_implode( '%1$s > li > a' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s > li > a' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s > li > a' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s > li > a' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s > li > a' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';

		if( !empty( $separator ) && 'inline-nav' === $inline ) {
			$elements[ liquid_implode( '%1$s li:not(:last-child):after' ) ]['content'] = '\'' . $separator . '\'';
		}
		if( !empty( $spacing ) ) {
			if( 'inline-nav' === $inline ) {
				$elements[ liquid_implode( '%1$s li + li' ) ]['margin-left'] = $spacing . 'px';
			}
			else {
				$elements[ liquid_implode( '%1$s > li' ) ]['margin-bottom'] = $spacing . 'px';
			}	
		}
		if( !empty( $bgcolor ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $bgcolor;
		}
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s > li > a,%1$s ul > li > a' ) ]['color'] = $color;
		}
		if( !empty( $hcolor ) ) {
			$elements[ liquid_implode( '%1$s > li > a:hover, %1$s ul > li > a:hover, %1$s li.is-active > a, %1$s li.current-menu-item > a' ) ]['color'] = $hcolor;
		}

		if( !empty( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s > li > a, %1$s ul > li > a' ) ]['background'] = $bg_color;
		}
		if( !empty( $bg_hcolor ) ) {
			$elements[ liquid_implode( '%1$s > li > a:hover, %1$s ul > li > a:hover, %1$s li.is-active > a, %1$s li.current-menu-item > a' ) ]['background'] = $bg_hcolor;
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Custom_Menu;