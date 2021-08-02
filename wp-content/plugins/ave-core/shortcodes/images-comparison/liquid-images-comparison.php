<?php
/**
* Shortcode Images Comparison
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Images_Comparison extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_images_comparison';
		$this->title        = esc_html__( 'Images Comparison', 'ave-core' );
		$this->description  = esc_html__( 'Add images to compare', 'ave-core' );
		$this->icon         = 'fa fa-arrows-h';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			
			array(
				'id' => 'title',	
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image 1', 'ave-core' ),
				'description' => esc_html__( 'Add first image from gallery or upload new', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'second_image',
				'heading'    => esc_html__( 'Image 2', 'ave-core' ),
				'description' => esc_html__( 'Add second image from gallery or upload new', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);

		$this->add_extras();
	}

	protected function get_image() {

		// check value
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		$img_src = $image = $html = '';
		$alt = $this->atts['title'];

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false );
		} 
		else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';

		}
		
		echo $html;

	}
	
	protected function get_second_image() {

		// check value
		if( empty( $this->atts['second_image'] ) ) {
			return;
		}

		$img_src = $image = $html = '';
		$alt = $this->atts['title'];

		if( preg_match( '/^\d+$/', $this->atts['second_image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['second_image'], 'full', false, array( 'alt' => esc_html( $alt ) ) );
		} 
		else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';

		}
		
		echo $html;

	}

}
new LD_Images_Comparison;