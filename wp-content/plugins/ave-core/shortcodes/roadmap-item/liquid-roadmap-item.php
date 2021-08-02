<?php
/**
* Shortcode Roadmap Item
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Roadmap_Item extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_roadmap_item';
		$this->title           = esc_html__( 'Roadmap Item', 'ave-core' );
		$this->description     = esc_html__( 'Add Roadmap item', 'ave-core' );
		$this->icon            = 'fa fa-list';
		$this->as_child        = array( 'only' => 'ld_roadmap' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'id' => 'title',
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'ave-core' ),
				'holder'     => 'div'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Checked Item?', 'ave-core' ),
				'param_name'  => 'checked_item',
				'description' => esc_html__( 'If checked the icon with check mark will display', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),

		);
		$this->add_extras();
	
	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$title = sprintf( '<h6>%s</h6>', $this->atts['title'] );

		echo $title;
	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}
	
	protected function get_checked() {
		
		if( 'yes' === $this->atts['checked_item'] ) {
			return 'one-roadmap-item-checked';
		}

	}
	
	protected function get_checkmark() {

		if( 'yes' === $this->atts['checked_item'] ) {
			echo '<i class="icon-ion-ios-checkmark"></i>';
		}		

	}
	
	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Roadmap_Item;