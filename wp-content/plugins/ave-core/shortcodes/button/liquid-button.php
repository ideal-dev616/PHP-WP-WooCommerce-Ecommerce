<?php
/**
* Custom Button Shortcode
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/

class LD_Button extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_button';
		$this->title       = esc_html__( 'Button', 'ave-core' );
		$this->icon        = 'fa fa-play-circle';
		$this->scripts      = array( 'jquery-fresco', 'lity' );
		$this->styles       = array( 'fresco', 'lity' );
		$this->description = esc_html__( 'Create a custom button.', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {
		
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/button/';
		
		$icon_params = liquid_get_icon_params( true, '', array( 'fontawesome', 'linea' ), array( 'align', 'color', 'hcolor' ), 'i_' );
		
		$icon_button_params = array(
			array(
				'type' => 'dropdown',
				'param_name' => 'i_position',
				'heading' => esc_html__( 'Icon Position', 'ave-core' ),
				'value' => array(
					esc_html__( 'Right', 'ave-core' )  => '',
					esc_html__( 'Left', 'ave-core' )   => 'left',
					esc_html__( 'Bottom', 'ave-core' ) => 'bottom',
					esc_html__( 'Top', 'ave-core' )    => 'top',
				),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_shape',
				'heading'    => esc_html__( 'Icon shape', 'ave-core' ),
				'value'      => array(
					esc_html__( 'None', 'ave-core' )       => '',
					esc_html__( 'Square', 'ave-core' )     => 'btn-icon-square',
					esc_html__( 'Semi Round', 'ave-core' ) => 'btn-icon-semi-round',
					esc_html__( 'Round', 'ave-core' )      => 'btn-icon-round',
					esc_html__( 'Circle', 'ave-core' )     => 'btn-icon-circle',
				),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'i_shape_style',
				'heading' => esc_html__( 'Icon shape style', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Solid', 'ave-core' )    => 'btn-icon-solid',
					esc_html__( 'Bordered', 'ave-core' ) => 'btn-icon-bordered',
				),
				'dependency' => array(
					'element' => 'i_shape',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'i_shape_bw',
				'heading' => esc_html__( 'Icon shape border width', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Thin', 'landinghub-core' )    => 'btn-icon-border-thick',
					esc_html__( 'Thiner', 'landinghub-core' ) => 'btn-icon-border-thicker',
					esc_html__( 'Thinnest', 'landinghub-core' ) => 'btn-icon-border-thickest',
				),
				'dependency' => array(
					'element' => 'i_shape_style',
					'value' => 'btn-icon-bordered'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_shape_size',
				'heading'    => esc_html__( 'Icon Shape size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Extra Small', 'ave-core' ) => 'btn-icon-xsm',
					esc_html__( 'Small', 'ave-core' )       => 'btn-icon-sm',
					esc_html__( 'Medium', 'ave-core' )      => 'btn-icon-md',
					esc_html__( 'Large', 'ave-core' )       => 'btn-icon-lg',
					esc_html__( 'Extra Large', 'ave-core' ) => 'btn-icon-xlg',
					esc_html__( 'Custom Size', 'ave-core' ) => 'btn-icon-custom-size',
				),
				'dependency' => array(
					'element' => 'i_shape',
					'value' => array( 'btn-icon-square', 'btn-icon-semi-round', 'btn-icon-round', 'btn-icon-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'i_shape_custom_size',
				'heading'     => esc_html__( 'Icon shape custom size', 'ave-core' ),
				'description' => esc_html__( 'Add custom shape size with px. for ex. 30px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'i_shape_size',
					'value'   => array( 'btn-icon-custom-size' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_ripple',
				'heading'    => esc_html__( 'Icon Ripple Effect', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'btn-icon-ripple',
				),
				'dependency' => array(
					'element' => 'i_shape',
					'value' => array( 'btn-icon-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'margin_label',
				'heading'    => esc_html__( 'Icon Spacing', 'ave-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_left',
				'heading' => esc_html__( 'Icon Left Margin', 'ave-core' ),
				'description' => esc_html__( 'Add left margin for icon with px. for ex. 30px', 'ave-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_right',
				'heading' => esc_html__( 'Icon Right Margin', 'ave-core' ),
				'description' => esc_html__( 'Add right margin for icon with px. for ex. 30px', 'ave-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_top',
				'heading' => esc_html__( 'Icon Top Margin', 'ave-core' ),
				'description' => esc_html__( 'Add top margin for icon with px. for ex. 30px', 'ave-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_bottom',
				'heading' => esc_html__( 'Icon Bottom Margin', 'ave-core' ),
				'description' => esc_html__( 'Add bottom margin for icon with px. for ex. 30px', 'ave-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'icon_shadow_label',
				'heading'    => esc_html__( 'Icon Shadow', 'ave-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
			),
			//Icon Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable icon box-shadow?', 'ave-core' ),
				'param_name'  => 'enable_icon_shadowbox',
				'description' => esc_html__( 'If checked, the icon box-shadow options will be visible', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-solid', 'btn-icon-bordered' ),
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Icon Shadow Box Options', 'ave-core' ),
				'param_name' => 'icon_box_shadow',
				'dependency' => array(
					'element' => 'enable_icon_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'ave-core' ),
						'description' => esc_html__(  'Select if it is inset', 'ave-core' ),
						'value'      => array(
							esc_html__( 'No', 'ave-core' )  => '',
							esc_html__( 'Yes', 'ave-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'ave-core' ),
						'description' => esc_html__(  'Set position X in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'ave-core' ),
						'description' => esc_html__(  'Set position Y in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'ave-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'ave-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'ave-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),

				)
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Icon Shadow Box Options', 'ave-core' ),
				'param_name' => 'h_icon_box_shadow',
				'dependency' => array(
					'element' => 'enable_icon_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'ave-core' ),
						'description' => esc_html__(  'Select if it is inset', 'ave-core' ),
						'value'      => array(
							esc_html__( 'No', 'ave-core' )  => '',
							esc_html__( 'Yes', 'ave-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'ave-core' ),
						'description' => esc_html__(  'Set position X in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'ave-core' ),
						'description' => esc_html__(  'Set position Y in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'ave-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'ave-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'ave-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),

				)
			),

		);	

		$general_params = array(
			
		array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'value'      => array(

					array(
						'value' => 'btn-default',
						'label' => esc_html__( 'Bordered', 'ave-core' ),
						'image' => $url . 'bordered.svg'
					),
					array(
						'label' => esc_html__( 'Solid', 'ave-core' ),
						'value' => 'btn-solid',
						'image' => $url . 'solid.svg'
					),
					array(
						'label' => esc_html__( 'Split', 'ave-core' ),
						'value' => 'btn-split',
						'image' => $url . 'split.svg'
					),
					array(
						'label' => esc_html__( 'Text only', 'ave-core' ),
						'value' => 'btn-naked',
						'image' => $url . 'text-only.svg'
					),
					array(
						'label' => esc_html__( 'Underlined', 'ave-core' ),
						'value' => 'btn-underlined',
						'image' => $url . 'underlined.svg'
					),

				),
				'save_always' => true,
			),
		
			// Params goes here
			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Text', 'ave-core' ),
				'value'       => '',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transformation',
				'heading'    => esc_html__( 'Text transformation', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Uppercase', 'ave-core' ) => 'text-uppercase',
					esc_html__( 'Capitalize', 'ave-core' ) => 'text-capitalize',
					esc_html__( 'Lowercase', 'ave-core' ) => 'text-lowercase',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'link_type', 
				'heading'     => esc_html__( 'Link Type', 'ave-core' ),
				'description' => esc_html__( 'Select a type of the link' ),
				'value' => array(
					esc_html__( 'Simple Click', 'one' )      => '',
					esc_html__( 'Lightbox', 'ave-core' )     => 'lightbox',
					esc_html__( 'Modal Window', 'ave-core' ) => 'modal_window',
					esc_html__( 'Local Scroll', 'ave-core' ) => 'local_scroll',
					esc_html__( 'Scroll to Section Bellow', 'ave-core' ) => 'scroll_to_section',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'scroll_speed',
				'heading'          => esc_html__( 'Scroll Speed', 'ave-core' ),
				'description'      => esc_html__( 'Add scroll speed in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'link_type',
					'value' => array( 'local_scroll', 'scroll_to_section' ),
				),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'anchor_id',
				'heading'          => esc_html__( 'Element ID', 'ave-core' ),
				'description'      => esc_html__( 'Input the ID of the element to scroll, for ex. #Element_ID', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'link_type',
					'value' => array( 'local_scroll', 'modal_window' ),
				),
			),
			array(
				'id'               => 'link',
				'description'      => esc_html__( 'Add the link', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'link_type',
					'value_not_equal_to' => array( 'modal_window', 'local_scroll', 'scroll_to_section' ),
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_styling',
				'heading'    => esc_html__( 'Styling', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-naked',
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Shape', 'ave-core' ),
				'value'      => array(
					esc_html__( 'None', 'ave-core' )    => '',
					esc_html__( 'Semi Round', 'ave-core' ) => 'semi-round',
					esc_html__( 'Round', 'ave-core' )      => 'round',
					esc_html__( 'Circle', 'ave-core' )     => 'circle'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Extra Small', 'ave-core' ) => 'btn-xsm',
					esc_html__( 'Small', 'ave-core' )       => 'btn-sm',
					esc_html__( 'Medium', 'ave-core' )      => 'btn-md',
					esc_html__( 'Large', 'ave-core' )       => 'btn-lg',
					esc_html__( 'Extra Large', 'ave-core' ) => 'btn-xlg',
					esc_html__( 'Custom', 'ave-core' )      => 'btn-custom',

				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_size',
				'heading'     => esc_html__( 'Custom Width', 'ave-core' ),
				'description' => esc_html__( 'Add custom width for button, in px.', 'ave-core' ),
				'dependency'  => array(
					'element' => 'size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_height',
				'heading'     => esc_html__( 'Custom Height', 'ave-core' ),
				'description' => esc_html__( 'Add custom height for button, in px.', 'ave-core' ),
				'dependency'  => array(
					'element' => 'size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'border',
				'heading'    => esc_html__( 'Border Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => 'border-thin',
					esc_html__( 'Thick', 'ave-core' )   => 'border-thick',
					esc_html__( 'Thicker', 'ave-core' ) => 'border-thicker',
				),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-split' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),			
			

		);
			
		$styling_params = array (
			
			//Group Design Options
			array(
				'type'        => 'css_editor',
				'param_name'  => 'css',
				'description' => '',
				'heading'     => esc_html__( 'CSS Box', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Primary Color', 'ave-core' ),
				'description'      => esc_html__( 'Background color', 'ave-core' ),
				'group'            => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'color2',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Secondary Color', 'ave-core' ),
				'description'      => esc_html__( 'Background secondary color, will create gradient effect', 'ave-core' ),
				'group'            => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Primary Hover Color', 'ave-core' ),
				'description' => esc_html__( 'Hover state background color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color2',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Secondary Hover Color', 'ave-core' ),
				'description' => esc_html__( 'Hover state background secondary color, will create gradient effect', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_color',
				'heading'     => esc_html__( 'Icon color', 'ave-core' ),
				'description' => esc_html__( 'Select icon color.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_hcolor',
				'heading'     => esc_html__( 'Icon hover color', 'ave-core' ),
				'description' => esc_html__( 'Pick icon hover color.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'i_fill_color',
				'heading'     => esc_html__( 'Icon Fill color', 'ave-core' ),
				'description' => esc_html__( 'Pick icon fill color.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-solid' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'i_fill_hcolor',
				'heading'     => esc_html__( 'Icon Hover Fill color', 'ave-core' ),
				'description' => esc_html__( 'Pick icon hover fill color.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-solid' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_fill_color2',
				'heading'     => esc_html__( 'Icon Fill color', 'ave-core' ),
				'description' => esc_html__( 'Pick icon fill color.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-bordered' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_fill_hcolor2',
				'heading'     => esc_html__( 'Icon Hover Fill color', 'ave-core' ),
				'description' => esc_html__( 'Pick icon hover fill color.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-bordered' ),
				),
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Label', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'text_color',
				'only_solid'  => true,
				'heading'    => esc_html__( 'Label Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-underlined',
				),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'htext_color',
				'only_solid'  => true,
				'heading'    => esc_html__( 'Label Hover Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-underlined',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_border',
				'heading'    => esc_html__( 'Border', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-split' ),
				),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'b_color',
				'only_solid'  => true,
				'heading'    => 'Border Color',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-default', 'btn-split' ),
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'b_color2',
				'heading'     => 'Border Color 2',
				'only_solid'  => true,
				'description' => esc_html__( 'Border color 2, will create gradient effect', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-default', 'btn-split' ),
				),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'h_b_color',
				'only_solid'  => true,
				'heading'    => 'Hover Border Color',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-split' ),
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'h_b_color2',
				'only_solid'  => true,
				'heading'     => 'Hover Border Color 2',
				'description' => esc_html__( 'Hover Border color 2, will create gradient effect', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-split' ),
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_shadowbox',
				'heading'    => esc_html__( 'Box-shadow', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),

			//Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable box-shadow?', 'ave-core' ),
				'param_name'  => 'enable_row_shadowbox',
				'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Shadow Box Options', 'ave-core' ),
				'param_name' => 'button_box_shadow',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_row_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'ave-core' ),
						'description' => esc_html__(  'Select if it is inset', 'ave-core' ),
						'value'      => array(
							esc_html__( 'No', 'ave-core' )  => '',
							esc_html__( 'Yes', 'ave-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'ave-core' ),
						'description' => esc_html__(  'Set position X in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'ave-core' ),
						'description' => esc_html__(  'Set position Y in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'ave-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'ave-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'ave-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),

				)
			),

			//Hover state box-shadow
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Hover Shadow Box Options', 'ave-core' ),
				'param_name' => 'hover_button_box_shadow',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_row_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'ave-core' ),
						'description' => esc_html__(  'Select if it is inset', 'ave-core' ),
						'value'      => array(
							esc_html__( 'No', 'ave-core' )  => '',
							esc_html__( 'Yes', 'ave-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'ave-core' ),
						'description' => esc_html__(  'Set position X in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'ave-core' ),
						'description' => esc_html__(  'Set position Y in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'ave-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'ave-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'ave-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
				)
			),
		);
		
		$this->params = array_merge( $general_params,  $icon_params, $icon_button_params, $styling_params  );

		$this->add_extras();
	}

	protected function get_size() {
		
		$size = $this->atts['size'];
		
		if( empty( $size ) ) {
			return '';
		}
		
		return $size;
	}

	protected function get_shape() {
		
		$shape = $this->atts['shape'];
		
		if( empty( $shape ) ) {
			return '';
		}
		
		return $shape;
	}	
	
	protected function get_border() {
		
		if( 'btn-naked' === $this->atts['style'] || 'btn-split' === $this->atts['style'] ) {
			return;
		}

		$border = $this->atts['border'];
		
		return "btn-bordered $border";	
	}
	
	protected function get_gradient() {
		
		$color  = $this->atts['color2'];
		$color2 = $this->atts['hover_color2'];

		// if( empty( $color ) || empty( $color2 ) ) {
		if( empty( $color ) ) {
			return;
		}
		
		return 'btn-gradient';
		
	}
	
	protected function get_gradient_bg() {
		
		extract( $this->atts );
		
		if( 'btn-split' === $style ) {
			echo '<span class="btn-split-bg"></span>';
			return;
		}

		if( empty( $color ) || empty( $color2 ) || 'btn-default' === $style || 'btn-naked' === $style || 'btn-underlined' === $style ) {
			return;
		}
		
		echo '<span class="btn-gradient-bg"></span>';
		
	}

	protected function get_gradient_hover_bg() {

		extract( $this->atts );
		
		if( ( empty( $hover_color2 ) && empty( $color2 ) ) || 'btn-naked' === $style || 'btn-underlined' === $style || 'btn-split' === $style ) {
			return;
		}
		
		echo '<span class="btn-gradient-bg btn-gradient-bg-hover"></span>';
		
	}
	
	protected function get_gradient_hover_icon_bg() {

		extract( $this->atts );
		
		if( 'btn-icon-solid' === $i_shape_style && !empty( $hover_color2 ) && 'btn-naked' === $style || 
			'btn-icon-solid' === $i_shape_style && !empty( $hover_color2 ) && 'btn-underlined' === $style ) 
		{
			return '<span class="btn-gradient-bg btn-gradient-bg-hover"></span>';	
		}

	}
	
	protected function get_gradient_border() {

		$color  = $this->atts['b_color2'];
		$color2 = $this->atts['h_b_color2'];
		
		if( empty( $color ) && empty( $color2 ) ) {
			return;
		}
		
		return 'btn-bordered-gradient';

	}
	
	protected function get_custom_size_classname() {
		
		if( !empty( $this->atts['custom_size'] ) || !empty( $this->atts['custom_height'] ) ) {
			
			return 'btn-custom-sized';
		}

	}
	
	protected function get_border_svg() {
		
		extract( $this->atts );

		$border_color  = $b_color2;
		$border_color2 = $h_b_color2;
		
		$rx = $ry = 0;
		
		if( 'semi-round' === $shape ) {
			$rx = $ry = '2px';
		}
		elseif( 'round' === $shape ) {
			$rx = $ry = '4px';
		}
		elseif( 'circle' === $shape ) {
			$rx = '17%';
			$ry = '50%';
		}
		// if( !empty( $custom_size ) ) {
		// 	$rx = (int)$custom_size / 2 . 'px';
		// }
		if( !empty( $custom_height ) ) {
			$rx = (int)$custom_height / 2 . 'px';
			$ry = (int)$custom_height / 2 . 'px';
		}
		
		if( ( empty( $color2 ) && empty( $hover_color2 ) ) || 'btn-naked' === $style || 'btn-underlined' === $style ) {
			return;
		}
		
		// if( ! empty( $hover_color ) && empty( $hover_color2 ) ) {
		// 	$hover_color2 = $hover_color;
		// }

		$out = '';
		$svg_id = uniqid('svg-border-');
		$out .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="btn-gradient-border" width="100%" height="100%">
			      <defs>
			        <linearGradient id="' . $svg_id . '" x1="0%" y1="0%" x2="100%" y2="0%">
			          <stop offset="0%" />
			          <stop offset="100%" />
			        </linearGradient>
			      </defs>
			      <rect x="0.5" y="0.5" rx="' . esc_attr( $rx ) . '" ry="' . esc_attr( $ry ) . '" width="100%" height="100%" stroke="url(#' . $svg_id . ')"/>
			    </svg>';

		echo $out;

	}

	protected function get_icon_pos() {
		
		$pos = $this->atts['i_position'];
			
		if( empty( $pos ) ) {
			return;
		}
				
		$hash = array(
			'left'   => 'btn-icon-left',
			'bottom' => 'btn-icon-block',
			'top'    => 'btn-icon-block btn-icon-top',	
		);

		return $hash[ $pos ];

	}

	protected function if_lightbox() {

		if( 'lightbox' !== $this->atts['link_type'] ) {
			return '';
		}

		return 'fresco';

	}

	public function generate_css() {
		
		extract( $this->atts );
		
		$elements     = array();
		$parent       = isset( $this->parent_selector ) ? $this->parent_selector . ' ' : '';
		$id           = '.' .$this->get_id();
		$parent_hover = isset( $this->parent_selector ) ? $this->parent_selector . ':hover ' . $id : '';
		
		$gradient_border_start = '#svg-' . $this->get_id() . ' .btn-gradient-border defs stop:first-child';
		$gradient_border_stop  = '#svg-' . $this->get_id() . ' .btn-gradient-border defs stop:last-child';

		$button_box_shadow = vc_param_group_parse_atts( $button_box_shadow );
		$hover_button_box_shadow = vc_param_group_parse_atts( $hover_button_box_shadow );
		$icon_box_shadow = vc_param_group_parse_atts( $icon_box_shadow );
		$h_icon_box_shadow = vc_param_group_parse_atts( $h_icon_box_shadow );
		
		if( !empty( $color ) && isset( $color ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid .btn-icon' )]['background'] = $color;
			$elements[liquid_implode( '%1$s.btn-icon-circle.btn-icon-ripple .btn-icon:before' )]['border-color'] = $color;
		}
		if( !empty( $hover_color ) && isset( $hover_color ) && empty( $hover_color2 ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid:hover .btn-icon' )]['background'] = $hover_color;
		}
		
		//Icon styling 
		if( !empty( $i_color ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['color'] = $i_color;
		}
		if( !empty( $i_size ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['font-size'] = $i_size;
		}
		if( !empty( $i_hcolor ) ) {
			$elements[liquid_implode( '%1$s:hover .btn-icon' )]['color'] = $i_hcolor;
		}
		if( !empty( $i_fill_color ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid .btn-icon' )]['background'] = $i_fill_color;
		}
		if( !empty( $i_fill_hcolor ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid:hover .btn-icon' )]['background'] = $i_fill_hcolor;
		}
		if( !empty( $i_fill_color2 ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-bordered .btn-icon' )]['border-color'] = $i_fill_color2;
		}
		if( !empty( $i_fill_hcolor2 ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-bordered:hover .btn-icon' )]['border-color'] = $i_fill_hcolor2;
		}
		if( !empty( $i_margin_left ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-left'] = $i_margin_left . ' !important';
		}
		if( !empty( $i_margin_right ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-right'] = $i_margin_right . ' !important';
		}
		if( !empty( $i_margin_top ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-top'] = $i_margin_top . ' !important';
		}
		if( !empty( $i_margin_bottom ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-bottom'] = $i_margin_bottom . ' !important';
		}
		if( !empty( $i_shape_custom_size ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['width'] = $i_shape_custom_size . ' !important';
			$elements[liquid_implode( '%1$s .btn-icon' )]['height'] = $i_shape_custom_size . ' !important';
		}
		
		//Button Custom Size
		if( !empty( $custom_size ) ) {
			$elements[liquid_implode( '%1$s' )]['width'] = $custom_size;
		}
		if( !empty( $custom_height ) ) {
			$elements[liquid_implode( '%1$s' )]['height'] = $custom_height;
		}
		
		
		if( 'btn-default' === $style ) {
			
			if( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $color;
				$elements[liquid_implode( '%1$s' )]['border-color'] = $color;
				$elements[liquid_implode( '%1$s:hover' )]['background-color'] = $color;
			}
			if( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['background-color'] = $hover_color;
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['border-color'] = $hover_color;
			}
			if( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			} elseif ( empty( $hover_color2 ) && ! empty( $hover_color ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
			} elseif ( ! empty( $color ) && ! empty( $color2 ) && empty( $hover_color ) && empty( $hover_color_2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}
			//Button gradient border colors
			if( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $color2;
			}
			if( ! empty( $h_b_color ) && ! empty( $h_b_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $h_b_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $h_b_color2;
			} elseif( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color2;
			}elseif ( ! empty($hover_color) && empty($hover_color2) ) {
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color;
			}
			
		}
		elseif( 'btn-solid' === $style ) {
			if( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( '%1$s' )]['background-color'] = $color;
				$elements[liquid_implode( '%1$s' )]['border-color'] = $color;
			}
			if( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['background-color'] = $hover_color;
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['border-color'] = $hover_color;
			}			
			if( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}
			if( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			} elseif ( empty( $hover_color2 ) && ! empty( $hover_color ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
			}
			//Button gradient border colors
			if( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $color2;
			} elseif ( ! empty( $color ) && empty( $color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $color;
			}

			if( ! empty( $b_color ) && ! empty( $b_color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $b_color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $b_color2;
			} elseif( ! empty( $b_color ) && empty( $b_color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $b_color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $b_color;
			} 

			if( ! empty( $h_b_color ) && ! empty( $h_b_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $h_b_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $h_b_color2;
			} elseif( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color2;
			} elseif ( ! empty($hover_color) && empty($hover_color2) ) {
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color;
			}
		} elseif ( 'btn-naked' === $style || 'btn-underlined' === $style ) {

			if( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $color;
			}

			if( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['color'] = $hover_color;
			}

			if ( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[liquid_implode( array( '.backgroundcliptext %1$s .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s.btn-icon-solid .btn-icon' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
				$elements[liquid_implode( array( '.backgroundcliptext %1$s:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}
			
			if ( !empty( $hover_color ) && !empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '.backgroundcliptext %1$s:hover .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '.backgroundcliptext %1$s:hover:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s.btn-icon-solid .btn-icon .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			} 
			elseif ( !empty( $color2 ) && !empty( $hover_color ) && empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '.backgroundcliptext %1$s:hover .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
				$elements[liquid_implode( array( '.backgroundcliptext %1$s:hover:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s.btn-icon-solid:hover .btn-icon' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
			}

			if ( !empty($text_color) && isset($text_color) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $text_color;
			}

			if ( !empty($htext_color) && isset($htext_color) ) {
				$elements[liquid_implode( '%1$s:hover' )]['color'] = $htext_color;
			}

		}
		if ( 'btn-split' === $style ) {

			if ( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( array( '%1$s .btn-split-bg' ) )]['background'] = $color;
			}
			if ( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( '%1$s .btn-split-bg:hover' ) )]['background'] = $hover_color;
			}
		}

		if ( 'btn-underlined' === $style ) {

			if ( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = $color;
			}

			if ( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = $hover_color;
			}

			if ( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}

			if ( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			}

			if ( ! empty( $b_color ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = $b_color;
			}

			if ( ! empty( $b_color ) && ! empty( $b_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $b_color ) . ' 0%, ' . esc_attr( $b_color2 ) . ' 100%)';
			}

			if ( ! empty( $h_b_color ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = $h_b_color;
			}

			if ( ! empty( $h_b_color ) && ! empty( $h_b_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $h_b_color ) . ' 0%, ' . esc_attr( $h_b_color2 ) . ' 100%)';
			}

			if ( !empty($text_color) && isset($text_color) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $text_color;
			}

			if ( !empty($htext_color) && isset($htext_color) ) {
				$elements[liquid_implode( '%1$s:hover' )]['color'] = $htext_color;
			}

		}
		
		//text colors for button label
		if ( 'btn-naked' !== $style ) {

			if( ! empty( $text_color ) && isset( $text_color ) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $text_color;
			}	
			if( ! empty( $htext_color ) && isset( $htext_color ) ) {
				$elements[liquid_implode( '%1$s:hover' )]['color'] = $htext_color;
			}
			
		} else {
			
			if( !empty( $text_color ) && isset( $text_color ) && !empty( $color2 ) ) {
				$elements[liquid_implode( '%1$s.btn .btn-txt, .backgroundcliptext %1$s.btn .btn-txt' )]['color'] = $text_color;
				$elements[liquid_implode( '%1$s.btn .btn-txt, .backgroundcliptext %1$s.btn .btn-txt' )]['background'] = 'none';
				$elements[liquid_implode( '%1$s.btn .btn-txt, .backgroundcliptext %1$s.btn .btn-txt' )]['text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn .btn-txt, .backgroundcliptext %1$s.btn .btn-txt' )]['-webkit-text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn .btn-txt, .backgroundcliptext %1$s.btn .btn-txt' )]['background-clip'] = 'border-box !important';
				$elements[liquid_implode( '%1$s.btn .btn-txt, .backgroundcliptext %1$s.btn .btn-txt' )]['-webkit-background-clip'] = 'border-box !important';
			}	
			if( !empty( $htext_color ) && isset( $htext_color ) && !empty( $hover_color2 ) ) {
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt', '.backgroundcliptext %1$s.btn:hover .btn-txt' )]['color'] = $htext_color;
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt', '.backgroundcliptext %1$s.btn:hover .btn-txt' )]['text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt', '.backgroundcliptext %1$s.btn:hover .btn-txt' )]['-webkit-text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt', '.backgroundcliptext %1$s.btn:hover .btn-txt' )]['background-clip'] = 'border-box !important';
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt', '.backgroundcliptext %1$s.btn:hover .btn-txt' )]['-webkit-background-clip'] = 'border-box !important';
			}
		}

		//Font options fot the label
		if( $lh ) {
			$elements[liquid_implode( '%1$s' )]['line-height'] = $lh . ' !important';
		}

		if ( $fs ) {
			$elements[liquid_implode( '%1$s' )]['font-size'] = $fs . ' !important';
		}

		if ( $fw ) {
			$elements[liquid_implode( '%1$s' )]['font-weight'] = $fw . ' !important';
		}
		if ( $ls ) {
			$elements[liquid_implode( '%1$s' )]['letter-spacing'] = $ls . ' !important';
		}

		//Button border colors
		if( ! empty( $b_color ) && isset( $b_color ) ) {
			$elements[liquid_implode( array( '%1$s.btn-bordered' ) )]['border-color'] = $b_color;
		}
		if( ! empty( $h_b_color ) && isset( $h_b_color ) ) {
			$elements[liquid_implode( array( '%1$s.btn-bordered:hover' ) )]['border-color'] = $h_b_color;
		}
		
		if( !empty( $icon_box_shadow ) ) {
			$icon_box_shadow_css = $this->get_shadow_css( $icon_box_shadow );
			$elements[liquid_implode( '%1$s .btn-icon' )]['box-shadow'] = $icon_box_shadow_css;
		}
		if( !empty( $h_icon_box_shadow ) ) {
			$h_icon_box_shadow_css = $this->get_shadow_css( $h_icon_box_shadow );
			$elements[liquid_implode( '%1$s:hover .btn-icon' )]['box-shadow'] = $h_icon_box_shadow_css;
		}
		
		//Shadow box for button
		if( ! empty( $button_box_shadow ) ) {
			
			$button_box_shadow_css = $this->get_shadow_css( $button_box_shadow );
			$elements[liquid_implode( '%1$s' )]['box-shadow'] = $button_box_shadow_css;

		}
		if( ! empty( $hover_button_box_shadow ) ) {

			$hover_button_box_shadow_css = $this->get_shadow_css( $hover_button_box_shadow );
			$elements[liquid_implode( array( '%1$s:hover' ) )]['box-shadow'] = $hover_button_box_shadow_css;

		}

		$this->dynamic_css_parser( $parent . $id, $elements );

	}
}
new LD_Button;