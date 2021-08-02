<?php
/**
* Shortcode Lists
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_List extends LD_Shortcode { 

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_list';
		$this->title       = esc_html__( 'Custom Lists', 'ave-core' );
		$this->icon        = 'fa fa-list';
		$this->description = esc_html__( 'Create custom lists.', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$params = array(
			
			array(
				'type'       => 'checkbox',
				'param_name' => 'inline',
				'heading'    => esc_html__( 'Inline List?', 'ave-core' ),
				'description' => esc_html__( 'Enable to make list inline', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'inline-nav' ),
			),	
			array(
				'type'        => 'exploded_textarea',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'List Items', 'ave-core' ),
				'description' => esc_html__( 'Enter list items here. Divide items with linebreaks (Enter).', 'ave-core'),
				'value'       =>  'List item 1, List Item 2, List Item 3',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_list',
				'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for lists items', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'items_spacing',
				'heading'     => esc_html__( 'Spacing', 'ave-core' ),
				'description' => esc_html__( 'Add margin between lists items', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'bullet_size',
				'heading'     => esc_html__( 'Bullet Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);
		
		$design = array(
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a custom color for the date/time color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'txt_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Text Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for text', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			)

		);
		
		$typo = array(

			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
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
					'element' => 'use_custom_fonts_list',
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
					'element' => 'use_custom_fonts_list',
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
					'element' => 'use_custom_fonts_list',
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
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for lists items theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Typo', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'list_font',
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
					
		);

		$this->params = array_merge( $params, $typo, $design );
		$this->add_extras();
	}

	
	protected function get_items() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}
		
		$output = '';
		
		$items = explode( ',', $this->atts['content'] );
		
		foreach( $items as $item ) {
			$output .= sprintf( '<li>%s</li>', $item );
		}

		echo $output;
	}

	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		$list_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$list_font_data = $this->get_fonts_data( $list_font );

			// Build the inline style
			$list_font_inline_style = $this->google_fonts_style( $list_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $list_font_data );

		}
		
		if( '0' !== $items_spacing && empty( $inline ) ) {
			$elements[ liquid_implode( '%1$s li' ) ]['margin-bottom'] = $items_spacing . 'px';
		}
		elseif( '0' !== $items_spacing && $inline ) {
			$elements[ liquid_implode( '%1$s.inline-nav li + li' ) ]['margin-left'] = $items_spacing . 'px';
		}
		
		$elements[ liquid_implode( '%1$s > li' ) ] = array( $list_font_inline_style );
		$elements[ liquid_implode( '%1$s > li' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s > li' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s > li' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s > li' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( !empty( $txt_color ) ) {
			$elements[ liquid_implode( '%1$s > li' ) ]['color'] = $txt_color;			
		}
		if( !empty( $transform ) ) {
			$elements[ liquid_implode( '%1$s > li' ) ]['text-transform'] = $transform;
		}
		if( !empty( $bullet_size ) ) { 
			$elements[ liquid_implode( '%1$s li:before' ) ] = array(
				'height' => $bullet_size,
				'width'  => $bullet_size,
			);
		}
		if( !empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s li:before' ) ]['background'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
	
}

new LD_List;