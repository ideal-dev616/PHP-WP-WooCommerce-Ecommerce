<?php
/**
* Shortcode Tooltiped Image
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Tooltiped_Image extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_tooltiped_image';
		$this->title        = esc_html__( 'Image with Hotspots', 'ave-core' );
		$this->description  = esc_html__( 'Tooltips on the image', 'ave-core' );
		$this->icon         = 'fa fa-file-image-o';
		$this->content_element = true;
		$this->is_container = true;
		$this->as_parent    = array( 'only' => 'ld_pointer_tooltip' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' )
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'primary_color',
				'heading'          => esc_html__( 'Primary Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),

		);

		$this->add_extras();
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$img_src = $html = '';
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$src = liquid_get_image_src( $this->atts['image'] );
			$img_src = $src[0];
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $img_src ) );
		} else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="" data-rjs="' .  esc_url( $img_src ) . '" />';
		}

		$image = sprintf( '<figure>%s</figure>', $html );
		
		echo $image;

	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		if( !empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s .info-box:before, %1$s .info-box:after' ) ]['background'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Tooltiped_Image;
class WPBakeryShortCode_LD_Tooltiped_Image extends WPBakeryShortCodesContainer {}