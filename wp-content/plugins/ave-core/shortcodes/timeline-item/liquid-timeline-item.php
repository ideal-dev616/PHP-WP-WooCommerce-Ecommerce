<?php
/**
* Shortcode Timeline Item
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Timeline_Item extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_timeline_item';
		$this->title           = esc_html__( 'Timeline Item', 'ave-core' );
		$this->description     = esc_html__( 'Add timeline item', 'ave-core' );
		$this->icon            = 'fa fa-clock-o';
		$this->as_child        = array( 'only' => 'ld_timeline' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'id'               => 'title',
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'ave-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'ave-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'ave-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'ave-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'subtitle',
				'heading'          => esc_html__( 'Subtitle', 'ave-core' ),
				'description'      => esc_html__( 'Add subtitle to timeline item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'year',
				'heading'          => esc_html__( 'Timeline Year', 'ave-core' ),
				'description'      => esc_html__( 'Add year to timeline item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'ave-core' ),
				'holder'     => 'div'
			),

		);
		$this->add_extras();
	
	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$weight = $this->atts['heading_weight'];

		if( !empty ( $weight ) ) {
			$weight	 = ' ' . $weight;
		}

		$title = sprintf( '<h3 class="mt-md-4 mt-lg-0 mb-3%s">%s</h3>', $weight, $this->atts['title'] );


		echo $title;
	}
	
	protected function get_subtitle() {

		// check
		if( empty( $this->atts['subtitle'] ) ) {
			return '';
		}

		$subtitle = sprintf( '<h6 class="my-0">%s</h6>', $this->atts['subtitle'] );

		echo $subtitle;
	}
	
	protected function get_year() {

		// check
		if( empty( $this->atts['year'] ) ) {
			return '';
		}

		$year = sprintf( '<span class="col-md-2 ld-timeline-date font-weight-medium mt-md-0 mt-4">%s</span><!-- /.ld-timeline-date -->', $this->atts['year'] );

		echo $year;
	}
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		$alt = $this->atts['title'];
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image  = wp_get_attachment_image( $this->atts['image'], 'full', false );
		} else {
			$image = '<img src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
		}

		$image = sprintf( '<figure class="col-md-5 ld-timeline-img">%s</figure>', $image );

		echo $image;

	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo '<hr>' . $content;
	}
	
	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Timeline_Item;