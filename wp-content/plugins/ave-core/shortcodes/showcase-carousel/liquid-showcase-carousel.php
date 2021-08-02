<?php
/**
* Shortcode Showcase Carousel
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Showcase_Carousel extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_showcase_carousel';
		$this->title       = esc_html__( 'Showcase Carousel', 'ave-core' );
		$this->description = esc_html__( 'Showcase Carousel', 'ave-core' );
		$this->scripts      = array( 'flickity' );
		$this->styles       = array( 'flickity' );
		$this->icon        = 'fa fa-play';

		parent::__construct();
	}

	public function get_params() {


		$this->params = array(

			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Slides', 'ave-core' ),
				'params'     => array(

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
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Element Width', 'ave-core' ),
						'param_name' => 'width',
						'value' => array(
							esc_html__( '1 column - 1/12', 'ave-core' ) => '1/12',
							esc_html__( '2 columns - 1/6', 'ave-core' ) => '1/6',
							esc_html__( '3 columns - 1/4', 'ave-core' ) => '1/4',
							esc_html__( '4 columns - 1/3', 'ave-core' ) => '1/3',
							esc_html__( '5 columns - 5/12', 'ave-core' ) => '5/12',
							esc_html__( '6 columns - 1/2', 'ave-core' ) => '1/2',
							esc_html__( '7 columns - 7/12', 'ave-core' ) => '7/12',
							esc_html__( '8 columns - 2/3', 'ave-core' ) => '2/3',
							esc_html__( '9 columns - 3/4', 'ave-core' ) => '3/4',
							esc_html__( '10 columns - 5/6', 'ave-core' ) => '5/6',
							esc_html__( '11 columns - 11/12', 'ave-core' ) => '11/12',
							esc_html__( '12 columns - 1/1', 'ave-core' ) => '1/1',
							esc_html__( '20% - 1/5', 'ave-core' ) => '1/5',
							esc_html__( '40% - 2/5', 'ave-core' ) => '2/5',
							esc_html__( '60% - 3/5', 'ave-core' ) => '3/5',
							esc_html__( '80% - 4/5', 'ave-core' ) => '4/5',
						),
						'description' => esc_html__( 'Select element width.', 'ave-core' ),
						'std'         => '1/3',
					),

				)
			),

		);

		$this->add_extras();
	}

	public function generate_css() {

		extract( $this->atts );

		$elements = array();

		$id = '.' . $this->get_id();
		$out = '';

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Showcase_Carousel;