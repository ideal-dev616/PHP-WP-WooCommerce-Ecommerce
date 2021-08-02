<?php
/**
* Shortcode Header Cart
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Cart extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_cart';
		$this->title       = esc_html__( 'Header Cart', 'ave-core' );
		$this->description = esc_html__( 'Mini cart', 'ave-core' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array_merge(
			array(
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'show_on_mobile',
					'heading'     => esc_html__( 'Show on Mobile', 'ave-core' ),
					'description' => esc_html__( 'Enable if you want to display it on mobile devices', 'ave-core' ),
					'value'       => array(
						esc_html__( 'Yes', 'ave-core' ) => 'lqd-show-on-mobile',
						esc_html__( 'No', 'ave-core' )  => '',
					),
					'std' => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'show_on_addtocart',
					'heading'     => esc_html__( 'Show on Add To Cart', 'ave-core' ),
					'description' => esc_html__( 'Enable if you want to show the cart module after an item being added to the cart.', 'ave-core' ),
					'value'       => array(
						esc_html__( 'Yes', 'ave-core' ) => 'lqd-show-on-addtocart',
						esc_html__( 'No', 'ave-core' )  => '',
					),
					'std' => '',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type' => 'checkbox',
					'param_name' => 'enable_offcanvas',
					'heading'    => esc_html__( 'Offcanvas?', 'ave-core' ),
					'description' => esc_html__( 'Enable offcanvas cart. NOTE ( Please re-generate the resposive css from theme options panel )', 'ave-core' ),
					'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
					'std'        => '',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'offcanvas_placement',
					'heading'     => esc_html__( 'Placement', 'ave-core' ),
					'value'       => array(
						esc_html__( 'Left', 'ave-core' )  => 'ld-module-to-left',
						esc_html__( 'Right', 'ave-core' ) => 'ld-module-to-right',
					),
					'std' => '',
					'dependency' => array(
						'element' => 'enable_offcanvas',
						'value' => 'yes',
					),
					'edit_field_class' => 'vc_col-sm-6',
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
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'textarea',
					'param_name'  => 'icon_text',
					'heading'     => esc_html__( 'Icon Text', 'ave-core' ),
					'description' => esc_html__( 'Enter the text placing beside the icon.', 'ave-core' ),
				),
				array(
					'type'       => 'textarea',
					'param_name' => 'cart_text',
					'heading'    => esc_html__( 'Footer Text', 'ave-core' ),
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'counter_bg',
					'heading'    => esc_html__( 'Counter Background Color', 'ave-core' ),
					'group'    => esc_html__( 'Design Options', 'ave-core' ),
				),
				array(
					'type'       => 'liquid_colorpicker',
					'only_solid' => true,
					'param_name' => 'counter_txt_color',
					'heading'    => esc_html__( 'Counter Text Color', 'ave-core' ),
					'group'    => esc_html__( 'Design Options', 'ave-core' ),
				),
				array(
					'type'       => 'liquid_colorpicker',
					'only_solid' => true,
					'param_name' => 'txt_color',
					'heading'    => esc_html__( 'Text Color', 'ave-core' ),
					'group'    => esc_html__( 'Design Options', 'ave-core' ),
				),
				array(
					'type' => 'checkbox',
					'param_name' => 'add_icon',
					'heading' => esc_html__( 'Add Icon?', 'ave-core' ),
					'value' => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
					'std' => 'yes'
				),

			),

				
			liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'size', 'margin-left', 'hcolor', 'margin-right' ), 'i_', array( 'element' => 'add_icon', 'value' => 'yes' ) )

		);

		$this->add_extras();
	}

	public function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( !empty( $counter_bg ) ) {
			$elements[ liquid_implode( '.ld-module-cart > .ld-module-trigger .ld-module-trigger-count' ) ]['background'] = $counter_bg;
		}	
		if( !empty( $counter_txt_color ) ) {
			$elements[ liquid_implode( '.ld-module-cart > .ld-module-trigger .ld-module-trigger-count' ) ]['color'] = $counter_txt_color;
		}	

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Cart;