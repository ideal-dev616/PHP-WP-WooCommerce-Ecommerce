<?php
/**
* Shortcode Milestone
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Milestone extends LD_Shortcode { 

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_milestone';
		$this->title       = esc_html__( 'Milestone box', 'ave-core' );
		$this->icon        = 'fa fa-list-ol';
		$this->description = esc_html__( 'Create milestone box.', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$params = array(

			array( 
				'id' => 'title',
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'date',
				'heading'    => esc_html__( 'Date/Time', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'ave-core' ),
				'holder'     => 'div',
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
			)

		);

		$this->params = array_merge( $params, $design );
		$this->add_extras();
	}
	
	protected function get_title() {

		if( empty( $this->atts[ 'title' ] ) ) {
			return;
		}

		printf( '<h5 class="text-uppercase">%s</h5>', esc_html( $this->atts['title'] ) );

	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}

	protected function get_time() {
		
		if( empty( $this->atts[ 'date' ] ) ) {
			return;
		}
		
		printf( '<div class="liquid-milestone-time h3"><span>%s</span></div>', esc_html( $this->atts['date'] ) );

	}


	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( ! empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s .liquid-milestone-time' ) ]['color'] = esc_attr( $primary_color );
		}

		$this->dynamic_css_parser( $id, $elements );
	}
	
}

new LD_Milestone;