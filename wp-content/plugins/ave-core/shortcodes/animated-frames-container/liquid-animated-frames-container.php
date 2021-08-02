<?php
/**
* Shortcode Animated Frames Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Animated_Frames_Container extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_animated_frames_container';
		$this->title           = esc_html__( 'Animated Frames Container', 'ave-core' );
		$this->description     = esc_html__( 'Animated Frames Container.', 'ave-core' );
		$this->icon            = 'fa fa-image';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => array( 'ld_animated_frame' ) );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'frame_color',
				'heading'    => esc_html__( 'Frame Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding'
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'arrows_color',
				'heading'    => esc_html__( 'Arrows Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'arrows_hcolor',
				'heading'    => esc_html__( 'Arrows Hover Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
		);
		$this->add_extras();

	}
	
	protected function get_opts() {
		
		if( $this->atts['frame_color'] ) {
			echo 'data-animatedframes-options=\'{ "frameFill": ' . $this->atts['frame_color'] . ' }\'';
		}
		
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( !empty( $arrows_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-af-slidenav__item svg' ) ]['stroke'] = $arrows_color;
		}
		if( !empty( $arrows_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-af-slidenav__item:hover svg' ) ]['stroke'] = $arrows_hcolor;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Animated_Frames_Container;
class WPBakeryShortCode_LD_Animated_Frames_Container extends WPBakeryShortCodesContainer {}