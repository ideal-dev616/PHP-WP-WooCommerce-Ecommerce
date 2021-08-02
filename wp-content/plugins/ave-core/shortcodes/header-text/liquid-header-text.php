<?php
/**
* Shortcode Header Text
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Text extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_text';
		$this->title       = esc_html__( 'Text', 'ave-core' );
		$this->description = esc_html__( 'Add text', 'ave-core' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();

	}
	
	public function get_params() {

		$this->params = array(
			
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'ave-core' ),
				'holder'     => 'div'
			),

		);
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

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Text;