<?php
/**
* Shortcode Instagram
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Instagram extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_instagram';
		$this->title       = esc_html__( 'Instagram', 'ave-core' );
		$this->description = esc_html__( 'Add instagram feed with button', 'ave-core' );
		$this->icon        = 'fa fa-instagram';

		parent::__construct();
	}

	public function get_params() {

		$params = array(

			array(
				'id'  => 'limit',
				'std' => 5,
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'images_per_row',
				'heading'    => esc_html__( 'Columns', 'ave-core' ),
				'value'      => array(
					1,
					2,
					3,
					4,
					5,
					6,
					8,
				),
				'std' => 5,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'columns_gap',
				'heading' => esc_html__( 'Columns Gap', 'ave-core' ),
				'description' => esc_html__( 'Specify columns spacing.', 'ave-core' ),
				'value' => array(
					esc_html__( 'None', 'ave-core' )  => '',
					2,
					4,
					6,
					8,
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
/*
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_caption',
				'heading'     => esc_html__( 'Show Caption', 'ave-core' ),
				'description' => esc_html__( 'Enable to show caption', 'ave-core' ),
				'value'      => array( 
					esc_html__( 'Yes', 'ave-core' ) => 'yes' 
				),
				'std' => '',
			),
*/
			array(
				'type'        => 'checkbox',
				'param_name'  => 'stretch',
				'heading'     => esc_html__( 'Equal Height Images', 'ave-core' ),
				'description' => esc_html__( 'Enable to make all images having equal heights.', 'ave-core' ),
				'value'      => array( 
					esc_html__( 'Yes', 'ave-core' ) => 'yes' 
				),
				'std' => '',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'overlay_color',
				'heading'     => esc_html__( 'Overlay Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a custom color for the overlay', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			)

		);

		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'ave-core' ), array(
			'exclude' => array(
				'el_id',
				'el_class'
			)
		) );

		$button = array_merge( array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'group' => esc_html__( 'Button', 'ave-core' )
			)
		), $button );

		$design = array(

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),

		);

		$this->params = array_merge( $params, $button, $design );
		$this->add_extras();
	}
	
	protected function get_columns() {

		$columns = $this->atts['images_per_row'];
		if( empty(  $columns ) || '5' === $columns ) {
			return;
		}

		return "data-list-columns=". $columns ;
		
	}
	protected function get_columns_gaps() {

		$columns_gap = $this->atts['columns_gap'];
		if( empty( $columns_gap ) ) {
			return;
		}

		return "data-list-gap=". $columns_gap ;
		
	}
	
	protected function get_stretch() {
		
		$enable = $this->atts['stretch'];
		if( empty( $enable ) ) {
			return;
		}
	
		return 'liquid-stretch-images';
	
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo '<div class="lqd-pos-mid">';
				echo $btn->render( array_filter( $data ) );
				echo '</div>';
			}
		}
	}
	
	protected function get_images() {

		$limit = $this->atts['limit'];
		$col = $this->atts['images_per_row'];
		$padding = $this->atts['columns_gap'];
		//if( 'single' === $style ) { $limit = 1; };
		//$access_token = liquid_helper()->get_option( 'instagram-token' );
		
		if( !class_exists( 'SB_Instagram_Display_Elements' ) ) {
			return wp_kses_post( _e( '<div class="alert alert-danger">Please, intall the <a href="https://wordpress.org/plugins/instagram-feed/" target="_blank">Instagram Feed</a> and activate it</div>', 'ave-core' ) );
		}

		$atts = array(
			'num' => $limit,
			'cols' => $col,
			'imagepadding' => $padding,
			'showfollow' => false,
			'showheader' => false,
			'customtemplates' => 'on',
			'sb_instagram_show_caption' => true
			
		);
				
		
		$instagram_feed = display_instagram( $atts );
		
		echo $instagram_feed;

		
		//echo do_shortcode( '[instagram-feed num=9 cols=3 showfollow=false showheader=false]' );


		
/*
		if( empty( $access_token ) ) {
			return wp_kses_post( _e( '<div class="alert alert-danger">Please, check you have set the access token in Theme Option Panel</div>', 'ave-core' ) );
		}
		
		$remote_wp    = wp_remote_get( 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $access_token . '&count=' . $limit .'', array( 'timeout' => 60, 'sslverify' => false ) );
		
		$media_array = json_decode( $remote_wp['body'] );
		
		if( $remote_wp['response']['code'] == 200 ) {

			foreach ( $media_array->data as $item ) {
				
				$alt = isset( $item->caption->text ) ? $item->caption->text : '';

				if( $this->atts['enable_caption'] ) {
					$label = isset( $item->caption->text ) ? '<span>' . $item->caption->text . '</span>' : '';
				}
				else {
					$label = '';
				}

				echo '<li><a class="liquid-ig-feed-overlay" target="_blank" href="' . esc_url( $item->link ) . '"><i class="fa fa-instagram"></i>' . $label . '</a><img src="' . esc_url( $item->images->standard_resolution->url ) . '"  alt="' . esc_attr( $alt ) . '" /></li>';
				
			}
		
		} elseif ( $remote_wp['response']['code'] == 400 ) {

			echo '<div class="alert alert-danger">' . $remote_wp['response']['message'] . ':' . $media_array->meta->error_message . '</div>';

		}
*/

	}
	
	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( ! empty( $overlay_color ) ) {
			$elements[ liquid_implode( '%1$s .liquid-ig-feed-overlay' ) ]['background'] = esc_attr( $overlay_color );
		}

		$this->dynamic_css_parser( $id, $elements );
	}
	

}
new LD_Instagram;