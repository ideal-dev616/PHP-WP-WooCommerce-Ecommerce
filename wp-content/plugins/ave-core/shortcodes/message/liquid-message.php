<?php
/**
* Shortcode Message
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Message extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_message';
		$this->title       = esc_html__( 'Message', 'ave-core' );
		$this->description = esc_html__( 'Add message note', 'ave-core' );
		$this->icon        = 'fa fa-info';

		parent::__construct();

	}
	
	public function get_params() {

		$this->params = array(
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'type',
				'heading'     => esc_html__( 'Type', 'ave-core' ),
				'description' => esc_html__( 'Select a type for the message', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Success', 'ave-core' ) => 'ld-msg-success',
					esc_html__( 'Error', 'ave-core' )   => 'ld-msg-error',
					esc_html__( 'Warning', 'ave-core' ) => 'ld-msg-warning',
				),
			),
			array( 
				'id' => 'title',
			),

		);
	}
	
	protected function get_title() {

		if( empty( $this->atts[ 'title' ] ) ) {
			return;
		}

		printf( '<h5>%s</h5>', esc_html( $this->atts['title'] ) );

	}
	
	protected function get_icon() {
		
		$type = $this->atts['type'];
		$icon = '';
		
		switch( $type ) {
			
			case 'ld-msg-success':
				$icon = '<i class="icon-ion-ios-checkmark"></i>';
			break;
			case 'ld-msg-error':
				$icon = '<i class="icon-ion-ios-help"></i>';
			break;
			case 'ld-msg-warning':
				$icon = '<i class="icon-ion-ios-information"></i>';
			break;

		}

		printf( '<span class="ld-msg-icon">%s</span><!-- /.ld-msg-icon -->', $icon );
		
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Message;