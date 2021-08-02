<?php
/**
* Shortcode Social Icons
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Social_Icons extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_social_icons';
		$this->title       = esc_html__( 'Social Icons', 'ave-core' );
		$this->description = esc_html__( 'Social Icons', 'ave-core' );
		$this->icon        = 'fa fa-facebook';

		parent::__construct();
	}

	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/social-icons/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'value'      => array(

					array(
						'value' => '',
						'label' => esc_html__( 'Default', 'ave-core' ),
						'image' => $url . 'default.svg'
					),

					array(
						'label' => esc_html__( 'Brand Colors', 'ave-core' ),
						'value' => 'branded-text',
						'image' => $url . 'brand-color.svg'
					),

					array(
						'label' => esc_html__( 'Brand Fills', 'ave-core' ),
						'value' => 'branded',
						'image' => $url . 'brand-fill.svg'
					),
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Small ( 30px )', 'ave-core' )  => 'social-icon-sm',
					esc_html__( 'Medium ( 48px )', 'ave-core' ) => 'social-icon-md',
					esc_html__( 'Large ( 55px )', 'ave-core' )  => 'social-icon-lg'
				),
				'edit_field_class' => 'vc_col-md-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Shape', 'ave-core' ),
				'value'      => array(
					esc_html__( 'None', 'ave-core' )       => '',
					esc_html__( 'Square', 'ave-core' )     => 'square',
					esc_html__( 'Round', 'ave-core' )      => 'round',
					esc_html__( 'Circle', 'ave-core' )     => 'circle',
				),
				'edit_field_class' => 'vc_col-md-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'scheme',
				'heading'    => esc_html__( 'Color Scheme', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Light', 'ave-core' )   => 'scheme-white',
					esc_html__( 'Gray', 'ave-core' )    => 'scheme-gray',
					esc_html__( 'Dark', 'ave-core' )    => 'scheme-dark'
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'branded', 'branded-text' ),
				),
				'edit_field_class' => 'vc_col-md-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'orientation',
				'heading'    => esc_html__( 'Direction', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Horizontal', 'ave-core' ) => '',
					esc_html__( 'Vertical', 'ave-core' )   => 'vertical'
				),
				'edit_field_class' => 'vc_col-md-6'
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Identities', 'ave-core' ),
				'params'     => array(

					array(
						'id' => 'network',
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'ave-core' ),
						'description' => esc_html__(  'Add social link', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					)
				)
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'font_size',
				'heading'     => esc_html__( 'Size', 'ave-core' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-12',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'hover_color',
				'heading'     => esc_html__( 'Hover Color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'shape',
					'value' => array( 'square', 'round', 'circle', 'rectangle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'hbg_color',
				'heading'     => esc_html__( 'Hover Background Color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'shape',
					'value'   => array( 'square', 'round', 'circle', 'rectangle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'border_color',
				'heading'    => esc_html__( 'Border Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'shape',
					'value' => 'square'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$this->add_extras();
	}

	public function generate_css() {

		extract( $this->atts );

		$elements = array();

		$id = '.' . $this->get_id();
		$out = '';

		$elements['%1$s.social-icon'] = array (
			'font-size' => $font_size
		);

		$elements['%1$s.social-icon li a']['color'] = isset( $primary_color ) ? $primary_color : '';
		$elements['%1$s.social-icon li']['border-color'] = isset( $border_color ) ? $border_color : '';
		$elements['%1$s.social-icon li a:hover']['color'] = isset( $hover_color ) ? $hover_color : '';
		$elements['%1$s.social-icon li a']['background-color'] = isset( $bg_color ) ? $bg_color : '';
		$elements['%1$s.social-icon li a:hover']['background-color'] = isset( $hbg_color ) ? $hbg_color : '';

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Social_Icons;