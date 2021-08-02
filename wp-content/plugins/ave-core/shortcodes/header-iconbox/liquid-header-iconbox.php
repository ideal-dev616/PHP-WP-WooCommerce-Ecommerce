<?php
/**
* Shortcode Header Iconbox
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Iconbox extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_iconbox';
		$this->title       = esc_html__( 'Header Iconbox', 'ave-core' );
		$this->description = esc_html__( 'Header icon box', 'ave-core' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );
		
		add_filter( 'https_ssl_verify', '__return_false' );

		parent::__construct();
	}

	public function get_params() {

		$icon = liquid_get_icon_params( false, null, 'all', array( 'align', 'color', 'hcolor', 'size' ), 'i_' );
			
		$general = array(
			
			array(
				'id' => 'title',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_size',
				'heading'    => esc_html__( 'Title Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Extra Small (18px)', 'ave-core' ) => 'xs',
					esc_html__( 'Small (20px)', 'ave-core' )       => 'sm',
					esc_html__( 'Medium (24px)', 'ave-core' )      => 'md',
					esc_html__( 'Large (28px)', 'ave-core' )       => 'lg',
					esc_html__( 'Custom', 'ave-core' )             => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'custom_heading_size',
				'heading'    => esc_html__( 'Custom title size', 'ave-core' ),
				'description' => esc_html__( 'Add custom title size with px. for ex. 35px' ),
				'dependency' => array(
					'element' => 'heading_size',
					'value'   => 'custom'	
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'custom_heading_weight',
				'heading'    => esc_html__( 'Custom title Weight', 'ave-core' ),
				'description' => esc_html__( 'Add custom title weight, for ex. 500' ),
				'dependency' => array(
					'element' => 'heading_size',
					'value'   => 'custom'	
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Content', 'ave-core' ),
				'holder'     => 'div',
				'group' => esc_html__( 'Content', 'ave-core' )
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_size',
				'heading'    => esc_html__( 'Icon Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Extra Small (45px)', 'ave-core' ) => 'xs',
					esc_html__( 'Small (60px)', 'ave-core' )       => 'sm',
					esc_html__( 'Medium (90px)', 'ave-core' )      => 'md',
					esc_html__( 'Large (100px)', 'ave-core' )       => 'lg',
					esc_html__( 'Extra Large (125px)', 'ave-core' ) => 'xl',
					esc_html__( 'Custom', 'ave-core' )             => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'custom_i_size',
				'heading'    => esc_html__( 'Custom Icon size', 'ave-core' ),
				'description' => esc_html__( 'Add custom icon size with px. for ex. 35px' ),
				'dependency' => array(
					'element' => 'i_size',
					'value'   => 'custom'	
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
		);
	
		$design = array(

			array(
				'type'             => 'liquid_colorpicker',
				'only_solid'       => true,
				'param_name'       => 'i_color',
				'heading'          => esc_html__( 'Icon Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Heading Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
		);
		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'ave-core' );
		}
		
		$this->params = array_merge( $icon, $general, $design );

		$this->add_extras();
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
			return;
		}

		echo wp_kses_post( ld_helper()->do_the_content( $this->atts['content'] ) );
	}
	
	protected function get_the_icon() {

		
		echo '<div class="iconbox-icon-wrap">';
		echo '<span class="iconbox-icon-container">';

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
		echo '</div><!-- /.iconbox-icon-wrap -->';
	}
	
	protected function get_heading_size() {

		$size = $this->atts['heading_size'];
		if( empty( $size ) || 'custom' === $size ) {
			return;
		}

		return "iconbox-heading-$size";

	}
	
	protected function get_size() {

		$size = $this->atts['i_size'];
		if( empty( $size ) ) {
			return;
		}

		return 'iconbox-' . $size;

	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$id = '.' . $this->get_id();
		$out = '';

		//Icon color
		if( ! empty( $i_color ) && isset( $i_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['color'] = $i_color;
		}
		if( !empty( $custom_heading_size ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['font-size'] = $custom_heading_size;
		}
		if( !empty( $custom_heading_weight ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['font-weight'] = $custom_heading_weight;
		}
		if( !empty( $h_color ) && isset( $h_color ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['color'] = $h_color;
		}
		if( !empty( $custom_i_size ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['font-size'] = $custom_i_size;
		}
		
		
		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Header_Iconbox;