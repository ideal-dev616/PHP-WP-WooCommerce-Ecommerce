<?php
/**
* Shortcode Media Element
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Showcase extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_showcase';
		$this->title           = esc_html__( 'Showcase', 'ave-core' );
		$this->description     = esc_html__( 'Add video showcase', 'ave-core' );
		$this->icon            = 'fa fa-play';

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'id' => 'title',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle',
				'heading'     => esc_html__( 'Subtitle', 'ave-core' )	,
				'description' => esc_html__( 'Add subtitle', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'MP4 Video Path', 'ave-core' ),
				'param_name'  => 'video_local_mp4_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in mp4 format', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'WEBM Video Path', 'ave-core' ),
				'param_name'  => 'video_local_webm_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in WEBM format', 'ave-core' ),

			),

		);
		$this->add_extras();
	
	}
		
	protected function get_title() {
		
		$title = $this->atts['title'];
		if( empty( $title ) ) {
			return;
		}
		
		return sprintf( '<h2 class="mt-0">%s</h2>', esc_html( $title ) );
		
	}
	
	protected function get_subtitle() {
		
		$subtitle = $this->atts['subtitle'];
		if( empty( $subtitle ) ) {
			return;
		}

		return sprintf( '<h6 class="my-0">%s</h6>', esc_html( $subtitle ) );
		
	}
	
	protected function get_video() {
		
		$video_bg_output = '';
		$video_local_mp4_url  = $this->atts['video_local_mp4_url'];
		$video_local_webm_url = $this->atts['video_local_webm_url']; 

		if( !empty( $video_local_mp4_url ) ) {
			$video_bg_output .= '<source src="'. esc_url( $video_local_mp4_url ) .'" type="video/mp4">';
		}
		if( !empty( $video_local_webm_url ) ) {
			$video_bg_output .= '<source src="'. esc_url( $video_local_webm_url ) .'" type="video/webm">';
		}

		echo '<video width="100%" height="100%" loop>' . $video_bg_output . '</video>';
		
	}
	
	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Showcase;