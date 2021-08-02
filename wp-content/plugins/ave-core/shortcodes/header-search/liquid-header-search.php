<?php
/**
* Shortcode Header Search
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Search extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_search';
		$this->title       = esc_html__( 'Header Search', 'ave-core' );
		$this->description = esc_html__( 'Header search form', 'ave-core' );
		$this->icon        = 'fa fa-search';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/header-search/';

		$this->params = array(
			
			
			array(
				'type'       => 'select_preview',
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'param_name' => 'style',
				'value'      => array(

					array(
						'label' => esc_html__( 'Default', 'ave-core' ),
						'value' => 'default',
						'image' => $url . 'default.jpg',
					),
					array(
						'label' => esc_html__( 'Frame', 'ave-core' ),
						'value' => 'frame',
						'image' => $url . 'frame.jpg',								
					),
					array(
						'label' => esc_html__( 'Slide Top', 'ave-core' ),
						'value' => 'slide-top',
						'image' => $url . 'slidetop.jpg',
					),
					array(
						'label' => esc_html__( 'Zoom Out', 'ave-core' ),
						'value' => 'zoom-out',
						'image' => $url . 'zoomout.jpg',
					),

				),
				'description' => esc_html__( 'Select search type for the header', 'infinite-addons' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'scheme',
				'heading'     => esc_html__( 'Color Scheme', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Fill', 'ave-core' )    => 'lqd-module-search-dark',
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'slide-top' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'description',
				'heading'     => esc_html__( 'Description', 'ave-core' ),
				'description' => esc_html__( 'Description under serchform', 'ave-core' ),
				'std' => 'Type and hit enter',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'slide-top', 'zoom-out' ),
				),
			),
			//Suggestion Fields
			array(
				'type'        => 'textfield',
				'param_name'  => 'suggestions_title',
				'heading'     => esc_html__( 'Title', 'ave-core' ),
				'description' => esc_html__( 'Add title for suggestions', 'ave-core' ),
				'std' => 'May We Suggest?',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'suggestions',
				'heading'     => esc_html__( 'Suggestion Text', 'ave-core' ),
				'description' => esc_html__( 'Add text for suggestions. for ex. #drone #funny #catgif #broken #lost', 'ave-core' ),
				'std' => '#drone #funny #catgif #broken #lost',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'suggestions_title2',
				'heading'     => esc_html__( 'Title 2', 'ave-core' ),
				'description' => esc_html__( 'Add title for suggestions', 'ave-core' ),
				'std' => 'Is It This?',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'suggestions2',
				'heading'     => esc_html__( 'Suggestion Text 2', 'ave-core' ),
				'description' => esc_html__( 'Add text for suggestions. for ex. #drone #funny #catgif #broken #lost', 'ave-core' ),
				'std' => '#drone #funny #catgif #broken #lost',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'suggestions_title3',
				'heading'     => esc_html__( 'Title 3', 'ave-core' ),
				'description' => esc_html__( 'Add title for suggestions', 'ave-core' ),
				'std' => 'Needle, Where Art Thou?',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'suggestions3',
				'heading'     => esc_html__( 'Suggestion Text 3', 'ave-core' ),
				'description' => esc_html__( 'Add text for suggestions. for ex. #drone #funny #catgif #broken #lost', 'ave-core' ),
				'std' => '#drone #funny #catgif #broken #lost',				
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'show_on_mobile',
				'heading'     => esc_html__( 'Show on Mobile', 'ave-core' ),
				'description' => esc_html__( 'Enable if you want to display it on mobile devices', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'lqd-show-on-mobile',
					esc_html__( 'No', 'ave-core' )  => '',
				),
				'std' => ''
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'icon_text',
				'heading'     => esc_html__( 'Icon Text', 'ave-core' ),
				'description' => esc_html__( 'Enter the text placing beside the icon.', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'label_weight',
				'heading'    => esc_html__( 'Label Weight', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'ave-core' )    => 'font-weight-normal',
					esc_html__( 'Semi Bold', 'ave-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'ave-core' )      => 'font-weight-bold',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Icon Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
		);

		$this->add_extras();
	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$id = '.' . $this->get_id();
		$out = '';
		
		if( !empty( $primary_color ) ) {
			$elements['.ld-module-search .ld-module-trigger, .ld-module-search .ld-module-trigger']['color'] = $primary_color;	
		}
		if( !empty( $fs ) ) {
			$elements['.ld-module-search .ld-module-trigger-icon']['font-size'] = $fs;
		}
		
		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Header_Search;