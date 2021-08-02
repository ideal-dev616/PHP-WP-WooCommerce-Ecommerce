<?php
/**
* Shortcode Liquid Pricing Table
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Price_Table extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_price_table';
		$this->title       = esc_html__( 'Price Table', 'ave-core' );
		$this->description = esc_html__( 'Create pricing table.', 'ave-core' );
		$this->icon        = 'fa fa-usd';
		$this->styles      = array( 'fresco', 'lity' );

		parent::__construct();
	}
	
	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/pricing-table/';

		$icon = liquid_get_icon_params( false, '', 'all', array( 'align', 'size' ), 'i_', array(
			'element' => 'style',
			'value' => array( 's8' )
		) );

		$content = array_merge(
		array(
			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'ave-core' ),
				'admin_label' => true,
				'value'       => array(
					array(
						'value' => 'default',
						'label' => esc_html__( 'Default', 'ave-core' ),
						'image' => $url . 'classic.jpg'
					),
					array(
						'label' => esc_html__( 'Colorfull', 'ave-core' ),
						'value' => 's2',
						'image' => $url . 'colorful.jpg'
					),
					array(
						'label' => esc_html__( 'Modern', 'ave-core' ),
						'value' => 's3',
						'image' => $url . 'modern.jpg'
					),
					array(
						'label' => esc_html__( 'Minimal', 'ave-core' ),
						'value' => 's4',
						'image' => $url . 'minimal.jpg'
					),
					array(
						'label' => esc_html__( 'Agency', 'ave-core' ),
						'value' => 's5',
						'image' => $url . 'agency.jpg'
					),
				),
				'save_always' => true,
			),

			array(
				'type'        => 'textarea',
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Title', 'ave-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle',
				'heading'     => esc_html__( 'Subtitle', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 'default',
				),
				'edit_field_class' => 'vc_col-sm-6'
				
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'price',
				'heading'    => esc_html__( 'Price', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'featured',
				'heading'     => esc_html__( 'Featured?', 'ave-core' ),
				'description' => esc_html__( 'Enable to make this price table featured', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 's2', 's3', 's4', 's5' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'featured_tag',
				'heading'     => esc_html__( 'Show featured tag?', 'ave-core' ),
				'description' => esc_html__( 'Enable to featured tag with label', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'default', 's2', 's5' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'textfield',	
				'param_name' => 'featured_label',
				'heading' => esc_html__( 'Featured Label', 'ave-core' ),
				'description' => esc_html__( 'Add featured label under the featured icon', 'ave-core' ),
				'dependency'  => array(
					'element' => 'featured_tag',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'pt_bg_image',
				'heading'     => esc_html__( 'Image', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's3', 's5' ),
				),
			),
		),

		$icon,

		array(

			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Features', 'ave-core' ),
				'description' => esc_html__( 'Input values here. Divide values by pressing Enter. Example: <strong>10GB</strong> Disk Space,<strong>100GB</strong> Monthly Bandwidth;', 'ave-core'),
				'value'       => '<ul><li>Free One Year Domain</li><li>10+ Pages Design</li><li>Full Organized Layered</li><li>Unlimited Revision</li><li>50% Discount Off</li><li>Free Logo Design</li><li>Free Stationary Design</li></ul>',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'default', 's3', 's4', 's5' ),
				),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes',
				),
			)

		) );

		$button = vc_map_integrate_shortcode( 'ld_button', 'pt_', esc_html__( 'Button', 'ave-core' ),
			array(
				'exclude' => array(
					'color',
					'el_id',
					'el_class'
				)
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);

		$design = array(
			array(
				'type'		 => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'primary_color',
				'heading'    => esc_html__( 'Primary Color', 'ave-core' ),
				'dependency' => array(
					'element'            => 'style',
					'value_not_equal_to' => 's5',
				)
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'txt_color',
				'heading'    => esc_html__( 'Text Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's4' ),
				),
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'param_name' => 'mbg_color',
				'heading'    => esc_html__( 'Background', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's4' ),
				),
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'param_name' => 'accent_color',
				'heading'    => esc_html__( 'Accent Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's4' ),
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for overlay', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 's3' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
		);
		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'ave-core' );
		}

		$this->params = array_merge( $content, $design, $button );

		$this->add_extras();
	}
	
	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$style = $this->atts['style'];
		
		$small = '';
		
		if( 'default' === $style ) {
			if( !empty( $this->atts['subtitle'] ) ) {
				$small = '<small>' . esc_html( $this->atts['subtitle'] ) . '</small>';
			}
		}
		elseif( 's2' === $style ) {
			if( !empty( $this->atts['price'] ) ) {
				$small = '<small>' . esc_html( $this->atts['price'] ) . '</small>';
			}			
		}


		$style = $this->atts['style'];
		$title = wp_kses_post( $this->atts['title'] );

		// Default
		$title = sprintf( '<h5>%s %s</h5>', $title, $small );

		echo $title;

	}
	
	protected function get_image() {

		// check value
		if( empty( $this->atts['pt_bg_image'] ) ) {
			return;
		}

		$style = $this->atts['style'];
		
		if( 's5' !== $style ) {
			return;
		}

		$img_src = $image = '';
		$alt  = $this->atts['title'];
		if( preg_match( '/^\d+$/', $this->atts['pt_bg_image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['pt_bg_image'], 'full', false );
		} 
		else {
			$img_src  = $this->atts['pt_bg_image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';
		}

		$image = sprintf( '<figure class="mb-7">%s</figure>', $html );
	
		echo $image;

	}
	
	protected function get_featured() {

		if( !$this->atts['featured'] ) {
			return;
		}

		return 'featured';
	}
	
	protected function get_featured_tag() {
		
		if( !$this->atts['featured_tag'] ) {
			return;
		}
		$featured_label = '';
		if( !empty( $this->atts['featured_label'] ) ) {
			$featured_label = '<span>'. esc_html( $this->atts['featured_label'] ) .'</span>';
		}
		
		if( 's5' === $this->atts['style']  ) {
			printf( '<span class="pricing-table-featured-label font-weight-bold text-uppercase ltr-sp-25">%s</span>', $featured_label );	
		}
		else {
			printf( '<p class="featured-tag"><i class="fa fa-check-circle-o"></i>%s</p>', $featured_label );
		}
		
		
	}

	protected function get_price() {

		// check
		if( empty( $this->atts['price'] ) || 's2' === $this->atts['style'] ) {
			return '';
		}

		$out = '';

		$price = wp_kses_post( do_shortcode( $this->atts['price'] ) );

		$out .= sprintf( '<p class="pricing">%s</p>', $price );

		echo $out;
	}
	
	protected function get_features() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo wp_kses_post( $content );
	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'pt_' );

		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();
			$data['color'] = $this->atts['primary_color'];
			
			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

	protected function get_class( $style ) {

		$hash = array(
			'default'  => 'pricing-table-default',
			's2'       => 'pricing-table-colorful',
			's3'       => 'pricing-table-modern',
			's4'       => 'pricing-table-minimal',
			's5'       => 'pricing-table-agency',
		);

		return $hash[ $style ];
	}

	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' . $this->get_id();
		
		if( 'default' === $style ) {
			$elements[ liquid_implode( '%1$s.pricing-table-default h5 small, %1$s.pricing-table-default .pricing' ) ]['color'] = $primary_color;
		}
		elseif( 's2' === $style ) {
			$elements[ liquid_implode( '%1$s.pricing-table-colorful .pricing-table-header:before' ) ]['background'] = $primary_color;
			$elements[ liquid_implode( '%1$s.pricing-table-colorful h5 small, %1$s.pricing-table-colorful .featured-tag' ) ]['color'] = $primary_color;
		}
		elseif( 's3' === $style ) {
			if( !empty( $pt_bg_image ) ) {
				if( preg_match( '/^\d+$/', $pt_bg_image ) ){
					$src = liquid_get_image_src( $pt_bg_image );
					$elements[ liquid_implode( '%1$s.pricing-table-modern' ) ]['background-image'] = 'url(' . esc_url( $src[0] ) . ')';
				} else {
					$src = $pt_bg_image;
					$elements[ liquid_implode( '%1$s' ) ]['background-image'] = 'url(' . esc_url( $src ) . ')';
				}
			}
			if( !empty( $bg_color ) ) {
				$elements[ liquid_implode( '%1$s.featured:before' ) ]['background'] = $bg_color;	
			}
			if( !empty( $primary_color ) ) { 
				$elements[ liquid_implode( '%1$s .pricing' ) ]['color'] = $primary_color;
			}
			
		}
		elseif( 's4' === $style ) {
			$elements[ liquid_implode( '%1$s' ) ]['color'] = $txt_color;
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $mbg_color;
			$elements[ liquid_implode( '%1$s .pricing-table-header h5' ) ]['background'] = $mbg_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Price_Table;