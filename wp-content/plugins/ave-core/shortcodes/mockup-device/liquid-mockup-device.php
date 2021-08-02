<?php
/**
* Shortcode Liquid Mockup Device
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Mockup_Device extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_mockup_device';
		$this->title        = esc_html__( 'Mockup Device', 'ave-core' );
		$this->icon         = 'fa fa-laptop';
		$this->scripts      = array( 'flickity' );
		$this->styles       = array( 'flickity' );
		$this->description  = esc_html__( 'Create a device carousel or video.', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		

		$this->params = array(
			
			array(
				'type' => 'dropdown',
				'param_name' => 'style',
				'heading' => esc_html__( 'Style', 'ave-core' ),
				'value' => array(
					esc_html__( 'iMac', 'ave-core' ) => 'imac',
					esc_html__( 'iPad', 'ave-core' ) => 'ipad',
					esc_html__( 'iPad Landscape', 'ave-core' ) => 'ipad-landscape',
					esc_html__( 'iPhone', 'ave-core' ) => 'iphone',
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'template',
				'heading' => esc_html__( 'Type', 'ave-core' ),
				'value' => array(
					esc_html__( 'Video', 'ave-core' )    => 'video',
					esc_html__( 'Carousel', 'ave-core' ) => 'carousel',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'video',
				'heading'     => esc_html__( 'Video ( mp4 format )', 'ave-core' ),
				'description' => esc_html__( 'Insert video source url ', 'ave-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'video',
				),
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Featured Image', 'ave-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'video',
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Play on Hover?', 'ave-core' ),
				'param_name'  => 'play_on_hover',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'video',
				),
				'std'         => '',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Mute?', 'ave-core' ),
				'param_name'  => 'muted',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'muted'
				),
				'description' => esc_html__( 'Mute the video?', 'ave-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'video',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'std'         => 'muted',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Loop?', 'ave-core' ),
				'param_name'  => 'loop',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'loop'
				),
				'description' => esc_html__( 'Loop the video?', 'ave-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'video',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'std'         => '',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Autoplay?', 'ave-core' ),
				'param_name'  => 'autoplay',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'autoplay'
				),
				'description' => esc_html__( 'Autoplay the video?', 'ave-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'video',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'std'         => 'autoplay',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Controls?', 'ave-core' ),
				'param_name'  => 'controls',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'controls'
				),
				'description' => esc_html__( 'Show controls for the video?', 'ave-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'video',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'std'         => 'controls',
			),
			array(
				'type'        => 'attach_images',
				'param_name'  => 'images',
				'heading'     => esc_html__( 'Carousel Images', 'ave-core' ),
				'description' => esc_html__( 'Add images to show in the carousel', 'ave-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'carousel',
				),
			),
			
			//Design Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Absolute Position?', 'ave-core' ),
				'param_name'  => 'absolute_pos',
				'description' => esc_html__( 'If checked the position will be set absolute', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_col-md-offset-6',
			),
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'ave-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'ave-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Position
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Position', 'ave-core' ),
				'description' => esc_html__( 'Add positions for the element, use px or %', 'ave-core' ),
				'css'        => 'position',
				'param_name' => 'position',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			

		);
	}
	
	protected function get_class( $style ) {

		$hash = array(
			'imac'           => 'lqd-mockup-imac-style-1',
			'ipad'           => 'lqd-mockup-ipad-style-1-portrait',
			'ipad-landscape' => 'lqd-mockup-ipad-style-1-landscape',
			'iphone'         => 'lqd-mockup-phone-style-1-portrait',
		);

		return $hash[ $style ];
	}
	
	protected function get_video() {
		
		if( empty( $this->atts['video'] ) ) {
			return;
		}
		
		printf( '<video width="100%%" height="100%%" playsinline %s %s %s %s><source src="%s" type="video/mp4"></video>', $this->atts['muted'], $this->atts['loop'], $this->atts['autoplay'], $this->atts['controls'],  esc_url( $this->atts['video'] ) );

	}
	
	protected function get_featured_image() {

		// check value
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$img_src = $image = '';
		$alt = esc_html__( 'Mockup Featured Image', 'ave-core' );

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_html( $alt ), 'class' => 'invisible' ) );
		} 
		else {
			$img_src  = $this->atts['image'];
			$html = '<img class="invisible" src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';	
		}

		$image = sprintf( '<figure class="lqd-mockup-featured-img bg-cover bg-center ld-overlay z-index-1" data-responsive-bg="true">%s</figure>', $html );	

		echo $image;

	}
	
	protected function get_overlay_link() {
		
		if( 'yes' !== $this->atts['play_on_hover'] ) {
			return;
		}
		
		echo '<a href="#" class="liquid-overlay-link" data-video-trigger="true" data-trigger-options=\'{ "videoPlacement": "parent" }\'></a>';
		
	}
		
	
	protected function get_mockup() {
		
		if( 'imac' === $this->atts['style'] ) {
			echo '<img src="'.get_template_directory_uri() . '/assets/img/mockups/imac/mockup-1.png' . '" alt="iMac" />';
		}
		elseif( 'ipad' === $this->atts['style'] ) {
			echo '<img src="'.get_template_directory_uri() . '/assets/img/mockups/ipad/mockup-1.png' . '" alt="iPad" />';
		} 
		elseif( 'ipad-landscape' === $this->atts['style'] ) {
			echo '<img src="'.get_template_directory_uri() . '/assets/img/mockups/ipad/mockup-2.png' . '" alt="iPad Landscape" />';
		}
		elseif( 'iphone' === $this->atts['style'] ) {
			echo '<img src="'.get_template_directory_uri() . '/assets/img/mockups/phone/mockup-1.png' . '" alt="iPhone" />';
		}
		
		
	}

	protected function get_attachments() {

		$images = explode( ',', $this->atts['images'] );

		if( empty( $images ) ) {
			return;
		}

		$args = array(
			'posts_per_page' => -1,
			'include'        => $images,
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => 'post__in',

			// improve query performance
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false
		);

		return get_posts( $args );
	}
		
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		if( ! empty( $absolute_pos ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['position'] = 'absolute';
		}
		if( !empty( $overflow_height ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['height'] = $overflow_height;
		}
		
		$responsive_pos = Liquid_Responsive_Param::generate_css( 'position', $position, $this->get_id() );
		$elements['media']['position'] = $responsive_pos;

		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $this->get_id() );
		$elements['media']['margin'] = $responsive_margin;
		
		$this->dynamic_css_parser( $id, $elements );
	}
	
}
new LD_Mockup_Device;