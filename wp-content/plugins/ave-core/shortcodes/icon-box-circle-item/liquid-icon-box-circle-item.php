<?php
/**
* Shortcode Icon Box Circle
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Icon_Box_Circle_Item extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_icon_box_circle_item';
		$this->title       = esc_html__( 'Icon Box', 'ave-core' );
		$this->description = esc_html__( 'Create icon box.', 'ave-core' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->as_child    = array( 'only' => 'ld_icon_box_circle_item' );

		add_filter( 'https_ssl_verify', '__return_false' );

		parent::__construct();
	}
	
	public function get_params() {
		
		$this->params = array_merge(
			liquid_get_icon_params( false, null, 'all', array( 'align', 'color', 'hcolor', 'size' ), 'i_' ),		
			array(
				
				array(
					'id' => 'title',
				),
				array(
					'type'       => 'textarea_html',
					'param_name' => 'content',
					'heading'    => esc_html__( 'Text', 'ave-core' ),
					'holder'     => 'div'
				),
	
			)
		);
		$this->add_extras();
	
	}
	
	protected function get_the_icon() {

		
		echo '<div class="one-ib-circ-icn">';
		echo '<span>';

		$icon = liquid_get_icon( $this->atts );
		
		if( ! empty( $icon['type'] ) ) {			
			if( 'image' === $icon['type'] || 'animated' === $icon['type'] ) {
				$filetype = wp_check_filetype( $icon['src'] );
				if( 'svg' === $filetype['ext'] ) {
					$request  = wp_remote_get( $icon['src'] );
					$response = wp_remote_retrieve_body( $request );
					$svg_icon = $response;

					echo $svg_icon;
				} 
				else {
					printf( '<img src="%s" class="liquid-image-icon" />', esc_url( $icon['src'] ) );
				}
			}
			else {
				printf( '<i class="%s"></i>', $icon['icon'] );
			}
		}

		echo '</span>';
		echo '</div>';
	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$title = sprintf( '<h3>%s</h3>', $this->atts['title'] );

		echo $title;
	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo '<hr>'. $content;
	}

}

new LD_Icon_Box_Circle_Item;