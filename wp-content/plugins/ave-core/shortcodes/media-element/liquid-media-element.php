<?php
/**
* Shortcode Media Element
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Media_Element extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_media_element';
		$this->title           = esc_html__( 'Media Element', 'ave-core' );
		$this->description     = esc_html__( 'Add media element', 'ave-core' );
		$this->scripts     = array( 'packery-mode', 'jquery-fresco' );
		$this->styles      = array( 'fresco' );		
		$this->icon            = 'fa fa-file-image-o';
		$this->as_child        = array( 'only' => 'ld_media' );

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
				'type'        => 'dropdown',
				'param_name'  => 'vertical_alignment',
				'heading'     => esc_html__( 'Vertical Alignment', 'ave-core' ),
				'description' => esc_html__( 'Select alignment on vertical axe for content', 'ave-core' ),
				'value' => array(
					esc_html__( 'Center', 'ave-core' ) => 'justify-content-center',
					esc_html__( 'Bottom', 'ave-core' ) => 'justify-content-end'
				),
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
			),
			array(
				'type'        => 'attach_images',
				'param_name'  => 'images',
				'heading'     => esc_html__( 'Gallery Images', 'ave-core' ),
				'description' => esc_html__( 'Add images to show in the gallery', 'ave-core' ),
				'dependency'  => array(
					'element' => 'link_type',
					'value'   => 'gallery'
				),
			),			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'link_type', 
				'heading'     => esc_html__( 'Link Type', 'ave-core' ),
				'description' => esc_html__( 'Select a type of the link' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' ) => 'default',
					esc_html__( 'Image', 'ave-core' )  => 'image',
					esc_html__( 'Gallery', 'ave-core' )  => 'gallery',
					esc_html__( 'Youtube', 'ave-core' )  => 'video',
					esc_html__( 'Iframe', 'ave-core' ) => 'iframe',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'id'               => 'link',
				'description'      => esc_html__( 'Add the link', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'link_type',
					'value_not_equal_to'   => 'gallery'
				),
			),
			array(
				'type'             => 'checkbox',
				'param_name'       => 'add_icon',
				'heading'          => esc_html__( 'Add Icon?', 'ave-core' ),
				'description'      => esc_html__( 'Will add an icon for lightbox link', 'ave-core' ),
				'value'            => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'icon_type',
				'heading'     => esc_html__( 'Select Icon', 'ave-core' ),
				'description' => esc_html__( 'select the icon you want to display', 'ave-core' ),
				'value' => array(
					esc_html__( 'Zoom', 'ave-core' )    => 'zoom',
					esc_html__( 'Plus', 'ave-core' )    => 'plus',
					esc_html__( 'Video', 'ave-core' )   => 'video',
					esc_html__( 'Video 2', 'ave-core' ) => 'video2',
					esc_html__( 'Audio', 'ave-core' )   => 'audio',
				),
				'dependency'  => array(
					'element' => 'add_icon',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
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
				'description' => esc_html__( 'Select media element width.', 'ave-core' ),
				'group'       => esc_html__( 'Responsive Options', 'ave-core' ),
				'std'         => '1/3',
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'custom_height',
				'heading' => esc_html__( 'Element Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'description' => esc_html__( 'Add media element custom height with px, ex. 300px.', 'ave-core' ),
				'group'       => esc_html__( 'Responsive Options', 'ave-core' ),
			),
			array(
				'type'        => 'column_offset',
				'heading'     => esc_html__( 'Responsiveness', 'ave-core' ),
				'param_name'  => 'offset',
				'group'       => esc_html__( 'Responsive Options', 'ave-core' ),
				'description' => esc_html__( 'Adjust width for different screen sizes. Control width, offset and visibility settings.', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'visible_content',
				'heading'     => esc_html__( 'Content Visible', 'ave-core' ),
				'description' => esc_html__( 'Check to make content visible', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'template',
				'heading'     => esc_html__( 'Content Position', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' ) => 'content-default',
					esc_html__( 'Bottom', 'ave-core' )  => 'content-bottom',
				),
				'dependency'  => array(
					'element' => 'visible_content',
					'value'   => 'yes'
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'alignment',
				'heading'     => esc_html__( 'Content Alignment', 'ave-core' ),
				'description' => esc_html__( 'Select content alignment', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Left', 'ave-core' )    => 'align-items-start',
					esc_html__( 'Center', 'ave-core' )  => 'text-center align-items-center',
					esc_html__( 'Right', 'ave-core' )   => 'text-right align-items-end',
				),
				'std' => 'text-center align-items-center'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'shadow_content',
				'heading'     => esc_html__( 'Shadow on hover', 'ave-core' ),
				'description' => esc_html__( 'Check to show shadow on hover', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				)
			),
			

		);
		$this->add_extras();
	
	}
	
	public function before_output( $atts, &$content ) {

		global $liquid_media_value;
		$atts['group_id'] = $liquid_media_value['unique_id'];
		$atts['gallery_id'] = uniqid( 'gallery-' );

		return $atts;
		
	}
	
	protected function get_effect_classnames() {
		
		$visible = $this->atts['visible_content'];
		$shadow  = $this->atts['shadow_content'];
		$classes = array();
		
		if( !$visible && !$shadow ) {
			return;
		}

		if( 'yes' === $visible ) {
			$classes[] = 'contents-visible';	
		}
		if( 'yes' === $shadow ) {
			$classes[] = 'shadow-onhover';	
		}
		
		echo join( ' ', $classes );
		
	}
	
	protected function get_title() {
		
		$title = $this->atts['title'];
		if( empty( $title ) ) {
			return;
		}
		
		return sprintf( '<h3>%s</h3>', esc_html( $title ) );
		
	}
	
	protected function get_subtitle() {
		
		$subtitle = $this->atts['subtitle'];
		if( empty( $subtitle ) ) {
			return;
		}

		return sprintf( '<h6 class="text-uppercase ltr-sp-135">%s</h6>', esc_html( $subtitle ) );
		
	}
	
	protected function get_media_content() {
		
		$title    = $this->get_title();
		$subtitle = $this->get_subtitle();
		$enable_icon = $this->atts['add_icon'];

		if( 'content-bottom' !== $this->atts['template'] ) {
			if( 'yes' === $enable_icon ) {
				return;
			}
		}
		
		if( empty( $title ) && empty( $subtitle ) ) {
			return;
		}
		
		printf( '<div class="ld-media-txt">%s %s</div>', $title, $subtitle );
		
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$image_opts = array();
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$retina_image = wp_get_attachment_image_src( $this->atts['image'], 'full' );
			$image  = wp_get_attachment_image( $this->atts['image'], 'full', false, $image_opts );
		} else {
			$image = '<img src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
		}
		
		if( 'content-bottom' !== $this->atts['template'] ) {
			$image = sprintf( '<figure class="bg-center-top" data-responsive-bg="true">%s</figure>', $image );
		}
		
		echo $image;
	}
	
	protected function get_gallery() {
		
		$link_type = $this->atts['link_type'];
		$images = explode( ',', $this->atts['images'] );
		
		if( 'gallery' !== $link_type || empty( $images ) ) {
			return;
		}
		
		if( 'gallery' === $link_type ) {
			if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
				$link = wp_get_attachment_url( $this->atts['image'] );
			} else {
				$link = $this->atts['image'];
			}
			echo '<a href="' . esc_url( $link ) . '" class="liquid-overlay-link fresco" data-fresco-group="'. esc_attr( $this->atts['gallery_id'] ) .'"></a>';
		}
		
		foreach ( $images as $image ) {

			$src = wp_get_attachment_image_url( $image, 'full', false );
				
			echo '<a href="' . esc_url( $src ) . '" class="fresco" data-fresco-group="'. esc_attr( $this->atts['gallery_id'] ) .'"></a>';		
		}		
		
	}


	protected function get_overlay_link() {
		
		$link = $out = '';
		$link_type = $this->atts['link_type'];
		
		if( 'image' === $link_type ) {
			if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
				$link = wp_get_attachment_url( $this->atts['image'] );
			} else {
				$link = $this->atts['image'];
			}
			$out = '<a href="' . esc_url( $link ) . '" class="liquid-overlay-link fresco" data-fresco-group="'. esc_attr( $this->atts['group_id'] ) .'"></a>';
		}
		elseif( 'gallery' === $link_type ) {
			if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
				$link = wp_get_attachment_url( $this->atts['image'] );
			} else {
				$link = $this->atts['image'];
			}
			//$out = '<a href="' . esc_url( $link ) . '" class="fresco" data-fresco-group="'. esc_attr( $this->atts['gallery_id'] ) .'"></a>';
		}
		elseif( 'video' === $link_type ) {
			$link = $this->atts['link'];
			$link = liquid_get_link_attributes( $link, '#' );
			$out = '<a href="' . esc_url( $link['href'] ) . '" class="liquid-overlay-link fresco" data-fresco-group="'. esc_attr( $this->atts['group_id'] ) .'"></a>';
		}
		elseif( 'iframe' === $link_type ) {
			$link = $this->atts['link'];
			$link = liquid_get_link_attributes( $link, '#' );
			$out = '<a href="' . esc_url( $link['href'] ) . '" class="liquid-overlay-link" data-lity="iframe"></a>';
		}
		else {
			$link = $this->atts['link'];
			$link = liquid_get_link_attributes( $link, '#' );
			$target = isset( $link['target'] ) ? 'target="_blank"' : '';
			$out = '<a ' . $target . ' href="' . esc_url( $link['href'] ) . '" class="liquid-overlay-link"></a>';
		}
		
		echo $out;

	}
	
	protected function get_custom_height_class() {
		
		if( empty( $this->atts['custom_height'] ) ) {
			return;
		}
		
		return 'liquid-media-element-custom-height';
		
	}
	
	protected function get_media_icon() {
		
		$enable = $this->atts['add_icon'];
		if( 'yes' !== $enable ) {
			return;
		}
		
		$icon = $this->atts['icon_type'];
		$out = '';
		
		switch( $icon ) {
			
			case 'image':
			default:
				
				$out = '<span class="ld-media-icon">
							<span class="ld-media-icon-inner">
								<i class="icon-ld-search"></i>
							</span><!-- /.ld-media-icon-inner -->
						</span><!-- /.media-icon -->';
			break;
			
			case 'plus':
				
				$out = '<span class="ld-media-icon icon-lg">
							<span class="ld-media-icon-inner">
								<i class="icon-ion-ios-add"></i>
							</span><!-- /.ld-media-icon-inner -->
						</span><!-- /.media-icon -->';

			break;
			
			case 'video':
				
				$out = '<span class="ld-media-icon icon-play bordered">
							<span class="ld-media-icon-inner">
								<i class="fa fa-play"></i>
							</span><!-- /.ld-media-icon-inner -->
						</span><!-- /.media-icon -->';
			break;

			case 'video2':
				
				$out = '<span class="ld-media-icon icon-play solid size-lg">
							<span class="ld-media-icon-inner">
								<i class="fa fa-play"></i>
							</span><!-- /.ld-media-icon-inner -->
						</span><!-- /.media-icon -->';

			break;
			
			case 'audio':
			
				$out = '<span class="ld-media-icon">
							<span class="ld-media-icon-inner">
								<i class="icon-ion-ios-volume-high"></i>
							</span><!-- /.ld-media-icon-inner -->
						</span><!-- /.media-icon -->';
			break;					
		}
		

		echo $out;

	}
	
	
	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();
		
		if( !empty( $custom_height ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['height']  = $custom_height;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Media_Element;