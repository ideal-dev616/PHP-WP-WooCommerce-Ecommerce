<?php
/**
* Shortcode Header Separator
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Separator extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_separator';
		$this->title       = esc_html__( 'Vertical Separator', 'ave-core' );
		$this->description = esc_html__( 'Add vertical separator', 'ave-core' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();

	}
	
	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'textfield',
				'param_name'  => 'sep_width',
				'heading'     => esc_html__( 'Width', 'ave-core' ),
				'description' => esc_html__( 'Add width for separator, ex. 2px', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sep_color',
				'heading'     => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the separator', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'left_margin',
				'heading'     => esc_html__( 'Left Margin', 'ave-core' ),
				'description' => esc_html__( 'Add left margin for separator', 'ave-core' ),
				'min'         => 0,
				'max'         => 30,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'right_margin',
				'heading'     => esc_html__( 'Right Margin', 'ave-core' ),
				'description' => esc_html__( 'Add right margin for separator', 'ave-core' ),
				'min'         => 0,
				'max'         => 30,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6'
			),

		);
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		if( !empty( $sep_width ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['width'] = $sep_width;
		}
		if( !empty( $sep_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-v-sep-inner' ) ]['background'] = $sep_color;
		}
		if( '0' !== $left_margin ) {
			$elements[ liquid_implode( '%1$s' ) ]['margin-left'] = $left_margin . 'px';
		}
		if( '0' !== $right_margin ) {
			$elements[ liquid_implode( '%1$s' ) ]['margin-right'] = $right_margin . 'px';
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Separator;