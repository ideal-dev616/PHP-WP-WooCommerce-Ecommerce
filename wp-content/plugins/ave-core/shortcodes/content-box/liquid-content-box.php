<?php
/**
* Shortcode Content Box
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Content_Box extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_content_box';
		$this->title       = esc_html__( 'Fancy Box', 'ave-core' );
		$this->icon        = 'fa fa-th-large';
		$this->description = esc_html__( 'Create a fancy box', 'ave-core' );
		$this->styles       = array( 'fresco', 'lity' );
		$this->scripts      = array( 'stackblur' );

		parent::__construct();
	}

	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/fancy-box/';
		
		$icon_params = liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'size' ), 'i_', array( 'element' => 'add_icon', 'value' => 'yes' ) );
		
		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'ave-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow'
				),
			),
			array(
				'element' => 'show_button',
				'value'   => 'yes',
			)
		);
		
		$params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'value'      => array(

					array(
						'value' => 's01',
						'label' => esc_html__( 'Booking', 'ave-core' ),
						'image' => $url . 'booking.jpg'
					),
					array(
						'label' => esc_html__( 'Classes', 'ave-core' ),
						'value' => 's02',
						'image' => $url . 'classes.jpg'
					),
					array(
						'label' => esc_html__( 'Travel', 'ave-core' ),
						'value' => 's03',
						'image' => $url . 'travel.jpg'
					),
					array(
						'label' => esc_html__( 'Tour', 'ave-core' ),
						'value' => 's04',
						'image' => $url . 'tour.jpg'
					),
					array(
						'label' => esc_html__( 'Case Study', 'ave-core' ),
						'value' => 's05',
						'image' => $url . 'case-study.jpg'
					),
					array(
						'label' => esc_html__( 'Overlay', 'ave-core' ),
						'value' => 's06',
						'image' => $url . 'overlay.jpg'
					),
					array(
						'label' => esc_html__( 'Overlay Alt', 'ave-core' ),
						'value' => 's10',
						'image' => $url . 'overlay-alt.jpg'
					),
					array(
						'label' => esc_html__( 'Classic', 'ave-core' ),
						'value' => 's07',
						'image' => $url . 'classic.jpg'
					),
					
					//Last one is s10 - Overlay Alt
				
				),
				'save_always' => true,
			),
			
			array(
				'type'             => 'checkbox',
				'param_name'       => 'is_tall',
				'heading'          => esc_html__( 'Tall?', 'ave-core' ),
				'description'      => esc_html__( 'Make content box tall?', 'ave-core' ),
				'value'            => array( esc_html__( 'Yes', 'ave-core' ) => 'tall' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'style',
					'value'   => array( 's06' )
				)
			),
			array(
				'type'             => 'checkbox',
				'param_name'       => 'add_shadow',
				'heading'          => esc_html__( 'Add Shadow?', 'ave-core' ),
				'description'      => esc_html__( 'Add shadow to the content box?', 'ave-core' ),
				'value'            => array( esc_html__( 'Yes', 'ave-core' ) => 'shadowed' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'style',
					'value'   => array( 's06' )
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'content_alignment',
				'heading'     => esc_html__( 'Content Alignment', 'ave-core' ),
				'description' => esc_html__( 'Select alignement for the content in content box', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Center', 'ave-core' )  => 'text-center',
					esc_html__( 'Right', 'ave-core' )   => 'text-right',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's06', 's07', 's08', 's09' ),
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'scheme',
				'heading'     => esc_html__( 'Color Scheme', 'ave-core' ),
				'description' => esc_html__( 'Select a color scheme', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default - Light', 'ave-core' ) => 'scheme-light',
					esc_html__( 'Dark', 'ave-core' )            => 'scheme-dark',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's05', 's06', 's10' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'cb_size',
				'heading'    => esc_html__( 'Content box size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => 'fancy-box-small',
					esc_html__( 'Big', 'ave-core' )     => 'fancy-box-big',
					esc_html__( 'Tall', 'ave-core' )     => 'fancy-box-tall',
					esc_html__( 'Wide', 'ave-core' )     => 'fancy-box-wide',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's03' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'cb_height',
				'heading'     => esc_html__( 'Content box height', 'ave-core' ),
				'description' => esc_html__( 'Add custom content box height with px, for ex. 140px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's03', 's05', 's06', 's10' ),
				),
			),
			array(
				'id'          => 'title',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'ave-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'ave-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'ave-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'ave-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_size',
				'heading'    => esc_html__( 'Heading size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Small', 'ave-core' )   => 'fancy-box-heading-sm',
					esc_html__( 'Medium', 'ave-core' )  => 'fancy-box-heading-md',
					esc_html__( 'Large', 'ave-core' )   => 'fancy-box-heading-lg',
					esc_html__( 'Custom', 'ave-core' )  => 'fancy-box-heading-custom',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_heading_size',
				'heading'     => esc_html__( 'Custom Heading size', 'ave-core' ),
				'description' => esc_html__( 'Add custom heading size with px, for ex. 24px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'heading_size',
					'value'   => 'fancy-box-heading-custom'	
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'overlay_image',
				'heading'     => esc_html__( 'Overlay Image', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's07', 's08', 's09' ),
				),
			),
			array(
				'type'        => 'vc_link',
				'param_name'  => 'img_link',
				'heading'     => esc_html__( 'Link', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array( 's02', 's05', 's10' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'blur_radius',
				'heading'     => esc_html__( 'Blur Radius', 'ave-core' ),
				'description' => esc_html__( 'Add blur radius, the value should be integer', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's06', 's10' )
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Label', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's02', 's09' )
				),
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'info',
				'heading'     => esc_html__( 'Box info', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's02', 's03', 's04', 's05', 's06', 's09', 's10' )
				),
			),
			array(
				'type'        => 'param_group',
				'heading'     => esc_html__( 'Attributes/Details/Options', 'ave-core' ),
				'description' => esc_html__( 'Enter attributes/details/options', 'ave-core' ),
				'param_name'  => 'cb_atts',
				'params' => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'cb_label',
						'heading'     => esc_html__( 'Label', 'ave-core' ),
						'description' => esc_html__( 'Enter text used as label', 'ave-core' ),
						'admin_label' => true,
					),
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's01', 's09' ),
				),
				
			),
			array(
				'type'       => 'liquid_slider',
				'param_name' => 'rating',
				'heading'    => esc_html__( 'Rating/Stars', 'ave-core' ),
				'min'        => 0,
				'max'        => 5,
				'step'       => 1,
				'std'        => 0,
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's04' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'rating_text',
				'heading'    => esc_html__( 'Rating Label', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's04' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's01', 's03', 's06', 's07', 's08' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'button_placement',
				'heading'    => esc_html__( 'Button Placement', 'ave-core' ),
				'value'      => array(
					esc_html__( 'In Footer', 'ave-core' )  => 'footer',
					esc_html__( 'On Image', 'ave-core' )  => 'on_image',
					esc_html__( 'In Footer And On Image', 'ave-core' )  => 'both',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's07' ),
				),
			),
			array(
				'type' => 'checkbox',
				'param_name' => 'add_icon',
				'heading' => esc_html__( 'Add Icon?', 'ave-core' ),
				'value' => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 's02', 's05' ),
				),
			),
			
		);
		
		$design = array(

			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color as primary', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's01', 's04', 's07' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'btncontainer_bg_color',
				'heading'     => esc_html__( 'Background Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a background color for button container', 'ave-core' ),
				'dependency'  => array(
					'element' => 'button_placement',
					'value' => array( 'on_image', 'both' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'btncontainer_border_color',
				'heading'     => esc_html__( 'Border Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a border color for button container', 'ave-core' ),
				'dependency'  => array(
					'element' => 'button_placement',
					'value' => array( 'on_image', 'both' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'alt_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color as primary', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's02', 's03' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'overlay_color',
				'heading'     => esc_html__( 'Overlay Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color overlay', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's05', 's06', 's10' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'blending_mode',
				'heading'     => esc_html__( 'Mix blending mode', 'ave-core' ),
				'description' => esc_html__( 'Only supported in modern browsers, or partial support in some browsers', 'ave-core' ),
				'value' => array(
					esc_html__( 'None', 'ave-core' )        => '',
					esc_html__( 'Normal', 'ave-core' )      => 'normal',
					esc_html__( 'Multiply', 'ave-core' )    => 'multiply',
					esc_html__( 'Screen', 'ave-core' )      => 'screen',
					esc_html__( 'Overlay', 'ave-core' )     => 'overlay',
					esc_html__( 'Darken', 'ave-core' )      => 'darken',
					esc_html__( 'Lighten', 'ave-core' )     => 'lighten',
					esc_html__( 'Color Dodge', 'ave-core' ) => 'color-dodge',
					esc_html__( 'Color Burn', 'ave-core' )  => 'color-burn',
					esc_html__( 'Hard Light', 'ave-core' )  => 'hard-light',
					esc_html__( 'Soft Light', 'ave-core' )  => 'soft-light',
					esc_html__( 'Difference', 'ave-core' )  => 'difference',
					esc_html__( 'Exclusion', 'ave-core' )   => 'exclusion',
					esc_html__( 'Hue', 'ave-core' )         => 'hue',
					esc_html__( 'Saturation', 'ave-core' )  => 'saturation',
					esc_html__( 'Color', 'ave-core' )       => 'color',
					esc_html__( 'Luminosity', 'ave-core' )  => 'luminosity',					
				),
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's06', 's10' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			)

		);
	
		$this->params = array_merge( $params, $button, $icon_params, $design );
		$this->add_extras();

	}
	
	public function before_output( $atts, &$content ) {
		
		$style = $atts['style'];
		
		switch( $style ) {
			
			case 's01':
				$atts['template'] = 'booking';
			break;
			
			case 's02':
				$atts['template'] = 'classes';
			break;
			
			case 's03':
				$atts['template'] = 'travel';
			break;
			
			case 's04':
				$atts['template'] = 'tour';
			break;
			
			case 's05':
				$atts['template'] = 'case-study';
			break;

			case 's06':
				$atts['template'] = 'overlay';
			break;
			
			case 's07':
				$atts['template'] = 'classic';
			break;
			
			case 's08':
				$atts['template'] = 'card';
			break;
			
			case 's09':
				$atts['template'] = 'card-alt';
			break;
			
			case 's10':
				$atts['template'] = 'overlay-alt';
			break;

		}

		return $atts;
	}
	
	protected function get_image( $wrapper = true ) {

		// check value
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$style = $this->atts['style'];

		$img_src = $image = '';
		$alt  = $this->atts['title'];
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			if( 's05' === $style ) {
				$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'class' => 'invisible' ) );
			}
			else {
				$html = wp_get_attachment_image( $this->atts['image'], 'full', false );
			}
		} 
		else {
			$img_src  = $this->atts['image'];
			if( 's05' === $style ) {
				$html = '<img class="invisible" src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';	
			}
			else {
				$html = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';
			}
			
		}

		if( $wrapper ) {
			$image = sprintf( '<figure class="fancy-box-image">%s</figure>', $html );	
		}
		else {
			$image = $html;
		}

		
		echo $image;

	}
	
	protected function get_overlay_image( $wrapper = true ) {

		// check value
		if( empty( $this->atts['overlay_image'] ) ) {
			return;
		}
		
		$style = $this->atts['style'];

		$img_src = $image = '';
		$alt  = $this->atts['title'];

		if( preg_match( '/^\d+$/', $this->atts['overlay_image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['overlay_image'], 'full', false, array( 'alt' => esc_html( $alt ), 'class' => 'invisible' ) );
		} 
		else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';
		}

		if( $wrapper ) {
			$image = sprintf( '<figure class="cb-img-overlay" data-responsive-bg="true">%s</figure>', $html );	
		}
		else {
			$image = $html;
		}

		
		echo $image;

	}
	
	protected function get_blured_image() {

		// check value
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$img_src = $image = '';
		$alt  = $this->atts['title'];
		$wrapper_attributes =  array();
		
		$radius = $this->atts['blur_radius'];
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			$image_url = wp_get_attachment_url( $this->atts['image'] );
		} 
		else {
			$img_url  = $this->atts['image'];
		}
		
		$data_opts = array(
			'imgSrc'         => 'backgroundImage',
			'radius'         => !empty( $radius ) ? intval( $radius ) : 25,
			'blurHandlerOn'  => 'static'
		);

		$wrapper_attributes[] = 'class="fancy-box-image border-radius-3"';
		$wrapper_attributes[] = 'data-responsive-bg="true"';
		$wrapper_attributes[] = 'data-liquid-blur="true"';
		$wrapper_attributes[] = 'data-blur-options=\'' . wp_json_encode( $data_opts ) . '\'';

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_html( $alt ), 'class' => 'invisible' ) );
		} 
		else {
			$img_src  = $this->atts['image'];
			$html = '<img class="invisible" src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';
		}

		$image = sprintf( '<figure %s>%s</figure>', implode( ' ', $wrapper_attributes ), $html );	
		
		echo $image;

	}
	
	protected function get_overlay_link() {
		
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );
		if ( !empty( $link['href'] ) ) {
			printf( '<a%s class="liquid-overlay-link"></a>', ld_helper()->html_attributes( $link )  );
		}
		
	}
	
	protected function get_custom_height_classname() {

		if( empty( $this->atts['cb_height'] ) ) {
			return;
		}
		
		return 'fancy-box-custom-height';		
		
	}
	
	/**
	 * [get_rating description]
	 * @method get_rating
	 */	
	protected function get_rating() {
		
		$out = '';
		$rating = $this->atts['rating'];
		$rating_text = $this->atts['rating_text'];
		if( empty( $rating ) && empty( $rating_text ) ) {
			return;
		}
		
		$out .= '<div class="rating">';		
		if( ! empty( $rating ) ) {
			$out .= '<ul class="star-rating">';
			for( $i = 1; $i <= $rating; $i++ ) {
				$out .= '<li><i class="fa fa-star"></i></li> ';
			}
			$out .= '</ul>';
		}
		if( ! empty( $rating_text ) ) {
			$out .= ' <span>' . esc_html( $rating_text ) . '</span>';	
		}		
		$out .= '</div><!-- /.rating -->';
		
		echo $out;
	}			
			
	
	protected function get_background() {

		// check value
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){		
			$image_src = wp_get_attachment_url( $this->atts['image'] );
		} 
		else {
			$img_src = $this->atts['image'];
		}

		echo 'style="background-image: url(' . esc_url( $image_src ) . ');"';
		
	}
	
	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}
		
		$style = $this->atts['style'];
		$weight = $this->atts['heading_weight'];

		if( !empty ( $weight ) ) {
			$weight	 = ' class="' . $weight . '" ';
		}
		
		if( 's10' === $style ) {
			$title = sprintf( '<h3 class="text-uppercase ltr-sp-05 font-weight-bold mb-3">%s</h3>', $this->atts['title'] );	
		}
		else {
			$title = sprintf( '<h3%s>%s</h3>', $weight, $this->atts['title'] );
		}

		echo $title;
	}
	
	protected function get_info() {
		
		// check
		if( empty( $this->atts['info'] ) ) {
			return '';
		}
		
		$style = $this->atts['style'];
		
		if( 's02' === $style ) {
			
			$icon = liquid_get_icon( $this->atts );
			$icon_html = '';
			if( $icon['type'] ) {
				$icon_html = '<i class="' . $icon['icon'] . '"></i>';
			}
			
			printf(  '<span class="trainer">%s %s</span>',$icon_html, ld_helper()->do_the_content( $this->atts['info'], false ) );
		}
		elseif( 's03' === $style ) {
			printf( '<span class="fancy-box-time">%s</span>', ld_helper()->do_the_content( $this->atts['info'] ) );
		}
		elseif( 's04' === $style  ) {
			printf( '<h6>%s</h6>', ld_helper()->do_the_content( $this->atts['info'] ) );
		}
		elseif( 's05' === $style ) {
			printf( '<span class="ld-cb-cat font-weight-medium text-uppercase ltr-sp-15">%s</span>', ld_helper()->do_the_content( $this->atts['info'] ) );
		}
		elseif( 's06' === $style ) {
			printf( '<span class="cb-subtitle text-uppercase ltr-sp-2 border-radius-3">%s</span>', ld_helper()->do_the_content( $this->atts['info'] ) );
		}
		elseif( 's09' === $style ) {
			printf( '<span class="cb-price">%s</span>', ld_helper()->do_the_content( $this->atts['info'] ) );
		}
		elseif( 's10' === $style ) {
			printf( '<p class="text-uppercase ltr-sp-175 font-weight-semibold">%s</p>', ld_helper()->do_the_content( $this->atts['info'], false ) );
		}
		else {
			printf(  '<span>%s</span>', ld_helper()->do_the_content( $this->atts['info'] ) );
		}
		
	}
	
	protected function get_label() {
		
		// check
		if( empty( $this->atts['label'] ) ) {
			return '';
		}
		$style = $this->atts['style'];
		
		if( 's09' === $style ) {
			printf(  '<span class="cb-label">%s</span>', ld_helper()->do_the_content( $this->atts['label'] ) );	
		}
		else {
			printf(  '<span class="fancy-box-label">%s</span>', ld_helper()->do_the_content( $this->atts['label'] ) );
		}		
		
	}
	
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}
	
	protected function get_details() {
		
		
		$cb_atts = (array)vc_param_group_parse_atts( $this->atts['cb_atts'] );
		$style   = $this->atts['style'];
		//$cb_atts = array_filter( $cb_atts );
		
		//print_r( $cb_atts );

		// check
		if( empty( $cb_atts ) ) {
			return '';
		}

		$out = '';
		foreach ( $cb_atts as $cb_att ) {
			if ( ! empty ( $cb_att['cb_label'] ) ) {
				if( 's09' === $style ) {
					$out .= sprintf(
						'<li>%s</li>',
				 		do_shortcode( wp_kses_post( $cb_att['cb_label'] ) )
					);					
				}
				else {
					$out .= sprintf(
						'<span>%s</span>',
				 		do_shortcode( wp_kses_post( $cb_att['cb_label'] ) )
					);
				}

			}
		}
		if( 's09' === $style ) {
			printf( '<ul class="reset-ul comma-sep-li pt-3">%s</ul>', $out );	
		}
		else {
			printf( '<div class="fancy-box-details">%s</div><!-- /.fancy-box-details -->', $out );
		}
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}
	
	protected function get_class( $style ) {
		
		$hash = array(
			's00' => '',
			's01' => 'fancy-box-booking',
			's02' => 'fancy-box-classes',
			's03' => 'fancy-box-travel',
			's04' => 'fancy-box-tour',
			's05' => 'fancy-box-case-study',
			's06' => 'fancy-box-overlay',
			's07' => 'fancy-box-classic',
			's08' => 'fancy-box-card',
			's09' => 'fancy-box-card-alt',
			's10' => 'fancy-box-overlay fancy-box-overlay-alt',
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : '';
	}
	
	protected function get_header() {
		
		
		
	}
	
	protected function get_footer() {
		
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		//Booking style
		if( 's01' === $style ) {

			if( !empty( $color ) && isset( $color ) )  {
				$elements[liquid_implode( '%1$s.fancy-box-booking .fancy-box-details' )]['color'] = $color;
				$elements[liquid_implode( '%1$s.fancy-box-booking .fancy-box-info:before' )]['background-color'] = $color;
			}
		}
		//classes, trainer
		elseif( 's02' === $style ) {
			
			if( !empty( $alt_color ) && isset( $alt_color ) )  {
				$elements[liquid_implode( '%1$s.fancy-box-classes .trainer i, .fancy-box-classes .fancy-box-label' )]['background'] = $alt_color;
			}
			if( !empty( $i_color ) && isset( $i_color ) ) {
				$elements[liquid_implode( '%1$s.fancy-box-classes .trainer i' )]['color'] = $i_color;
			}
		}
		//Travel
		elseif( 's03' === $style ) {

			if( !empty( $alt_color ) && isset( $alt_color ) )  {
				$elements[liquid_implode( '%1$s.fancy-box-travel .fancy-box-time' )]['background'] = $alt_color;
			}			
		}
		//Tour
		elseif( 's04' === $style ) {

			if( !empty( $color ) && isset( $color ) )  {
				$elements[liquid_implode( '%1$s.fancy-box-tour .fancy-box-footer h6 strong, %1$s.fancy-box-tour .fancy-box-icon' )]['color'] = $color;
			}
			
		}
		elseif( 's05' === $style ) {

			if( !empty( $overlay_color ) && isset( $overlay_color ) )  {
				$elements[liquid_implode( '%1$s.fancy-box-case-study figure:after' )]['background'] = $overlay_color;
			}
		}
		elseif( 's06' === $style ) {

			if( !empty( $overlay_color ) && isset( $overlay_color ) )  {
				$elements[liquid_implode( '%1$s.fancy-box-overlay .cb-overlay' )]['background'] = $overlay_color;
			}
			if( !empty( $blending_mode ) ) {
				$elements[liquid_implode( '%1$s.fancy-box-overlay .cb-overlay' )]['mix-blend-mode'] = $blending_mode;
			}
		}
		elseif( 's10' === $style ) {

			if( !empty( $overlay_color ) && isset( $overlay_color ) )  {
				$elements[liquid_implode( '%1$s.fancy-box-overlay-alt .cb-overlay' )]['background'] = $overlay_color;
			}
			if( !empty( $blending_mode ) ) {
				$elements[liquid_implode( '%1$s.fancy-box-overlay-alt .cb-overlay' )]['mix-blend-mode'] = $blending_mode;
			}
		}
		else {
			if( !empty( $color ) && isset( $color ) )  {
				$elements[liquid_implode( '%1$s .fancy-box-header h3' )]['color'] = $color;
			}
		}
		if( !empty( $custom_heading_size ) ) {
			$elements[liquid_implode( '%1$s .fancy-box-header h3' )]['font-size'] = $custom_heading_size;
		}
		if( !empty( $cb_height ) ) {
			$elements[liquid_implode( '%1$s' )]['min-height'] = $cb_height;
		}
		if( !empty( $btncontainer_bg_color ) ) {
			$elements[liquid_implode( '%1$s .cb-img-btn-bg' )]['background'] = $btncontainer_bg_color;
		}
		if( !empty( $btncontainer_border_color ) ) {
			$elements[liquid_implode( '%1$s .cb-img-btn-inner' )]['border-color'] = $btncontainer_border_color;
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Content_Box;