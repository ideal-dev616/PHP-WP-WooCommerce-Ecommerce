<?php
/**
* Shortcode Liquid Restauran Menu
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Restaurant_Menu extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_restaurant_menu';
		$this->title       = esc_html__( 'Restaurant Menu', 'ave-core' );
		$this->description = esc_html__( 'Create restaurant menu.', 'ave-core' );
		$this->icon        = 'fa fa-usd';

		parent::__construct();
	}
	
	public function get_params() {
		
		$params = array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Title', 'ave-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-9 vc_column-with-padding',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_list',
				'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'price',
				'heading'    => esc_html__( 'Price', 'ave-core' ),
			),
			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Description', 'ave-core' ),
				'description' => wp_kses_post( __( 'Input values here. Divide values by pressing Enter. Example: <strong>Lamb</strong>, <strong>Pork</strong>, <strong>Lemon</strong>', 'ave-core') ),
				'value'       => '<ul class="reset-ul inline-nav comma-sep-li"><li>Lamb</li><li>Pork</li><li>Lemon</li><li>Soy Sauce</li></ul>',
			),

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
		$design = array(
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'title_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Title Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a custom color for title', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'txt_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Description Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for description', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'border_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Border Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for border', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			)

		);

		$this->params = array_merge( $params, $typo, $design );
		$this->add_extras();
	}
	
	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$title = wp_kses_post( $this->atts['title'] );

		// Default
		$title = sprintf( '<h3 class="h5 mt-0 mb-1">%s</h3>', $title );

		echo $title;

	}

	protected function get_price() {

		// check
		if( empty( $this->atts['price'] ) ) {
			return '';
		}

		$out = '';

		$price = wp_kses_post( do_shortcode( $this->atts['price'] ) );
		$out .= sprintf( '<span class="price">%s</span>', $price );

		echo $out;
	}

	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}	
	

	protected function generate_css() {


		$elements = array();
		extract( $this->atts );
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
		
		$elements[ liquid_implode( '%1$s h3' ) ] = array( $list_font_inline_style );
		$elements[ liquid_implode( '%1$s h3' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s h3' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s h3' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s h3' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['color'] = $title_color;
		}
		if( !empty( $txt_color ) ) {
			$elements[ liquid_implode( '%1$s ul' ) ]['color'] = $txt_color;
		}
		if( !empty( $transform ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['text-transform'] = $transform;
		}		
		if( !empty( $border_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['border-color'] = $border_color;
		}		

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Restaurant_Menu;