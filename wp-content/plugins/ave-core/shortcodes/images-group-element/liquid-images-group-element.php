<?php
/**
* Shortcode Images Group Element
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Images_Group_Element extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_images_group_element';
		$this->title           = esc_html__( 'Liquid Fancy Image', 'ave-core' );
		$this->description     = esc_html__( 'Liquid Fancy Image with effects', 'ave-core' );
		$this->icon            = 'fa fa-file-image-o';
		$this->is_container    = true;
		$this->as_child        = array( 'only' => 'ld_images_group_container' );
		$this->as_parent       = array( 'only' => 'ld_button' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(

			array(
				'type'             => 'liquid_attach_image',
				'param_name'       => 'image',
				'heading'          => esc_html__( 'Image', 'ave-core' ),
				'descripton'       => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',			
			),
			array(
				'type'        => 'vc_link',
				'param_name'  => 'img_link',
				'heading'     => esc_html__( 'Link', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Image size', 'ave-core' ),
				'param_name'       => 'img_size',
				'value'            => '',
				'description'      => esc_html__( 'Enter image sizes or percents from original size. Example: 200x100 (Width x Height) or 50%.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Side label', 'ave-core' )	,
				'description' => esc_html__( 'Add side label', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'label_side',
				'heading'     => esc_html__( 'Label side', 'ave-core' ),
				'description' => esc_html__( 'Select label side', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Left', 'ave-core' )  => 'content-fixed-left',
					esc_html__( 'Right', 'ave-core' ) => 'content-fixed-right',
				),
				'dependency' => array(
					'element' => 'label',
					'not_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_effects',
				'heading'    => esc_html__( 'Add Effects', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'parallax',
				'heading'     => esc_html__( 'Parallax', 'ave-core' ),
				'description' => esc_html__( 'Add parallax effect to the element', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' )  => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'content_align',
				'heading'     => esc_html__( 'Content Alignment', 'ave-core' ),
				'description' => esc_html__( 'Select content alignment', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Left', 'ave-core' )  => 'content-floated-mid-left',
					esc_html__( 'Center ' ) => 'content-floated-mid',
					esc_html__( 'Right', 'ave-core' ) => 'content-floated-mid-right',
				),
				'std' => 'content-floated-mid'
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_image_shadow',
				'heading'    => esc_html__( 'Add Shadow?', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shadow_style',
				'heading'    => esc_html__( 'Shadow Style', 'ave-core' ),
				'value' => array(
					esc_html__( 'Style 1', 'ave-core' ) => 1,
					esc_html__( 'Style 2', 'ave-core' ) => 2,
					esc_html__( 'Style 3', 'ave-core' ) => 3,
					esc_html__( 'Style 4', 'ave-core' ) => 4,
				),		
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_roudness',
				'heading'    => esc_html__( 'Add roundness?', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'image_roudness',
				'heading'    => esc_html__( 'Border Radius', 'ave-core' ),
				'value' => array(
					esc_html__( '2px', 'ave-core' ) => 2,
					esc_html__( '4px', 'ave-core' ) => 4,
					esc_html__( '6px', 'ave-core' ) => 6,
					esc_html__( '8px', 'ave-core' ) => 8,
					esc_html__( '50em (Circle)', 'ave-core' ) => '50em',
				),
				'edit_field_class' => 'vc_col-sm-8',
				'dependency' => array(
					'element' => 'enable_roudness',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_browser',
				'heading'    => esc_html__( 'Enable Browser view?', 'ave-core' ),
				'description' => esc_html__( 'Enable browser view with URL bar', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'browser_url',
				'heading' => esc_html__( 'URL', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_browser',
					'not_empty' => true
				),
			),

			//Effects
			array(
				'type' => 'subheading',
				'param_name' => 'sb_shadow',
				'heading' => esc_html__( 'Animated Shadow', 'ave-core' ),
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_shadow',
				'heading'     => esc_html__( 'Animated Shadow', 'ave-core' ),
				'description' => esc_html__( 'Enable Animated Shadow', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'shadow_delay',
				'heading'    => esc_html__( 'Delay in milliseconds', 'ave-core' ),
				'description' => esc_html__( 'Delay before animation starts', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			// Reveal
			array(
				'type' => 'subheading',
				'param_name' => 'sb_reveal',
				'heading' => esc_html__( 'Reveal effect', 'ave-core' ),
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_reveal',
				'heading'     => esc_html__( 'Reveal Effect', 'ave-core' ),
				'description' => esc_html__( 'Enable Reveal Effect', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-12',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'reveal_color',
				'heading' => esc_html__( 'Background color', 'ave-core' ),
				'description' => esc_html__( 'Background color of the reveal effect', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_reveal',
					'not_empty' => true
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'reveal_direction',
				'heading' => esc_html__( 'Direction', 'ave-core' ),
				'description' => esc_html__( 'Direction of the reveal effect', 'ave-core' ),
				'value' => array(
					esc_html__( 'Left - Right', 'ave-core' ) => 'lr',
					esc_html__( 'Top - Bottom', 'ave-core' ) => 'tb',
					esc_html__( 'Right - Left', 'ave-core' ) => 'rl',
					esc_html__( 'Bottom - Top', 'ave-core' ) => 'bt'
				),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_reveal',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'reveal_delay',
				'heading'    => esc_html__( 'Delay in milliseconds', 'ave-core' ),
				'description' => esc_html__( 'Delay before revealing starts', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_reveal',
					'not_empty' => true
				),
			),
			// Color adjust
			array(
				'type' => 'subheading',
				'param_name' => 'sb_color_adjust',
				'heading' => esc_html__( 'Color Adjust', 'ave-core' ),
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_color_adjust',
				'heading'     => esc_html__( 'Color Adjust', 'ave-core' ),
				'description' => esc_html__( 'Enable color adjust', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
					)
				),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_color_adjust_reset',
				'heading'     => esc_html__( 'Enable Reset Color Adjust', 'ave-core' ),
				'description' => esc_html__( 'Reset color addjusts on hover or when it\'s in active carousel item', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Effects', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_color_adjust',
					'not_empty' => true
					)
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_saturation',
					'heading'     => esc_html__( 'Saturation', 'ave-core' ),
					'description' => esc_html__( 'Default: 1', 'ave-core' ),
					'min'         => 0,
					'max'         => 100,
					'std'         => 1,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'ave-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_brightness',
					'heading'     => esc_html__( 'Brightness', 'ave-core' ),
					'description' => esc_html__( 'Default: 1', 'ave-core' ),
					'min'         => 0,
					'max'         => 10,
					'std'         => 1,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'ave-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_contrast',
					'heading'     => esc_html__( 'Contrast', 'ave-core' ),
					'description' => esc_html__( 'Default: 100', 'ave-core' ),
					'min'         => 0,
					'max'         => 500,
					'std'         => 100,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'ave-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_grayscale',
					'heading'     => esc_html__( 'Grayscale', 'ave-core' ),
					'description' => esc_html__( 'Default: 0', 'ave-core' ),
					'min'         => 0,
					'max'         => 100,
					'std'         => 0,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'ave-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_hue',
					'heading'     => esc_html__( 'Hue', 'ave-core' ),
					'description' => esc_html__( 'Default: 0', 'ave-core' ),
					'min'         => -180,
					'max'         => 180,
					'std'         => 0,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'ave-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_opacity',
					'heading'     => esc_html__( 'Opacity', 'ave-core' ),
					'description' => esc_html__( 'Default: 100', 'ave-core' ),
					'min'         => 0,
					'max'         => 100,
					'std'         => 100,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'ave-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
			
			//Parallax
			array(
				'type'        => 'subheading',
				'param_name'  => 'prlx_from',
				'heading'     => esc_html__( 'Parallax "From" Options', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_from_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_from_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_from_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_from_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 5,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_from_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 5,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_from_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 5,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_from_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_from_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_from_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'from_torigin_x',
				'heading'     => esc_html__( 'Transform Origin X', 'ave-core' ),
				'description' => esc_html__( 'Select or add transform origin X axe', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' )   => '',
					esc_html__( 'Left', 'ave-core' )   => 'left',
					esc_html__( 'Center', 'ave-core' ) => 'center',
					esc_html__( 'Right', 'ave-core' )  => 'right',
					esc_html__( 'Custom', 'ave-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'from_torigin_x_custom',
				'heading'     => esc_html__( 'Custom value for X-asex', 'ave-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'from_torigin_x',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'from_torigin_y',
				'heading'     => esc_html__( 'Transform Origin Y', 'ave-core' ),
				'description' => esc_html__( 'Select or add transform origin Y axe', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' )   => '',
					esc_html__( 'Top', 'ave-core' )    => 'top',
					esc_html__( 'Center', 'ave-core' ) => 'center',
					esc_html__( 'Bottom', 'ave-core' ) => 'bottom',
					esc_html__( 'Custom', 'ave-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'from_torigin_y_custom',
				'heading'     => esc_html__( 'Custom value for Y-asex', 'ave-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'from_torigin_y',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'from_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			//parallax custom code textarea
			array(
				'type'        => 'textarea',
				'param_name'  => 'parallax_from',
				'heading'     => esc_html__( 'Parallax "From" Custom Options', 'ave-core' ),
				'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute, will override all options above', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'prlx_to',
				'heading'     => esc_html__( 'Parallax "To" Options', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_to_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_to_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_to_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_to_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_to_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_to_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_to_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_to_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_to_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'dropdown',
				'param_name'  => 'to_torigin_x',
				'heading'     => esc_html__( 'Transform Origin X', 'ave-core' ),
				'description' => esc_html__( 'Select or add transform origin X axe', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' )   => '',
					esc_html__( 'Left', 'ave-core' )   => '0%',
					esc_html__( 'Center', 'ave-core' ) => '50%',
					esc_html__( 'Right', 'ave-core' )  => '100%',
					esc_html__( 'Custom', 'ave-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'to_torigin_x_custom',
				'heading'     => esc_html__( 'Custom value for X-asex', 'ave-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'to_torigin_x',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'dropdown',
				'param_name'  => 'to_torigin_y',
				'heading'     => esc_html__( 'Transform Origin Y', 'ave-core' ),
				'description' => esc_html__( 'Select or add transform origin Y axe', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' )   => '',
					esc_html__( 'Top', 'ave-core' )    => '0%',
					esc_html__( 'Center', 'ave-core' ) => '50%',
					esc_html__( 'Bottom', 'ave-core' ) => '100%',
					esc_html__( 'Custom', 'ave-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'to_torigin_y_custom',
				'heading'     => esc_html__( 'Custom value for Y-asex', 'ave-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'to_torigin_y',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'to_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'textarea',
				'param_name'  => 'parallax_to',
				'heading'     => esc_html__( 'Parallax To', 'ave-core' ),
				'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
	
			array(
				'type'        => 'subheading',
				'param_name'  => 'prlx_common',
				'heading'     => esc_html__( 'Parallax Settings', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'to_delay',
				'heading'     => esc_html__( 'Delay', 'ave-core' ),
				'description' => esc_html__( 'Add delay time in seconds', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
	
			array(
				'type'        => 'dropdown',
				'param_name'  => 'to_easy',
				'heading'     => esc_html__( 'Animation Easing', 'ave-core' ),
				'description' => '',
				'value'       => array(
					'linear',
					'easeInQuad',
					'easeInCubic',
					'easeInQuart',
					'easeInQuint',
					'easeInSine',
					'easeInExpo',
					'easeInCirc',
					'easeInBack',
					'easeOutQuad',
					'easeOutCubic',
					'easeOutQuart',
					'easeOutQuint',
					'easeOutSine',
					'easeOutExpo',
					'easeOutCirc',
					'easeOutBack',
					'easeInOutQuad',
					'easeInOutCubic',
					'easeInOutQuart',
					'easeInOutQuint',
					'easeInOutSine',
					'easeInOutExpo',
					'easeInOutCirc',
					'easeInOutBack',
				),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_offset',
				'heading'     => esc_html__( 'Parallax Offset', 'ave-core' ),
				'description' => esc_html__( 'Offset number', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'parallax_trigger',
				'heading'    => esc_html__( 'Parallax Trigger', 'ave-core' ),
				'value' => array(
					esc_html__( 'On Enter', 'ave-core' )  => 'onEnter',
					esc_html__( 'On Leave', 'ave-core' ) => 'onLeave',
					esc_html__( 'On Center', 'ave-core' ) => 'onCenter',
					esc_html__( 'Number Value', 'ave-core' ) => 'number',
				),
				'std'        => 'onEnter',
				'group'      => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_trigger_number',
				'heading'     => esc_html__( 'Parallax Trigger Number', 'ave-core' ),
				'description' => esc_html__( 'Input trigger number value from 0 to 1', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax_trigger',
					'value'   => 'number'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),			
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_duration',
				'heading'     => esc_html__( 'Parallax Duration', 'ave-core' ),
				'description' => esc_html__( 'define how much time for ex 800', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'parallax_overflow',
				'heading'     => esc_html__( 'Parallax overflow hidden', 'ave-core' ),
				'description' => esc_html__( 'Make overflow hidden or visible', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'value' => array(
					esc_html__( 'Yes', 'ave-core' )  => 'yes',
					esc_html__( 'No', 'ave-core' )  => 'no',
				),
				'std'        => 'no',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'overflow_height',
				'heading'     => esc_html__( 'Height', 'ave-core' ),
				'description' => esc_html__( 'add height for parallax element with px, for ex 150px', 'ave-core' ),
				'group'       => esc_html__( 'Parallax Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'parallax_overflow',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
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

		$this->add_extras();
	}
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$dimensions = $loaded = '';
		
		$image_opts = $attr = array();
		$size = 'full';
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		$attachment = get_post( $this->atts['image'] );
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			if( !empty( $this->atts['img_size'] ) ) {

				$dimensions  = vc_extract_dimensions( $this->atts['img_size'] );
				if( empty( $dimensions ) ) {
					$image_src = wp_get_attachment_image_src( $this->atts['image'], 'full', false );
					list( $src, $width, $height ) = $image_src;
					$dimensions = array( $width * ( (int)$this->atts['img_size'] / 100 ), $height * ( (int)$this->atts['img_size'] / 100 ) );
				}
					
				$src = wp_get_attachment_image_url( $this->atts['image'], 'full', false );
				$srcset = wp_get_attachment_image_srcset( $this->atts['image'] );
				$hwstring    = image_hwstring( $dimensions[0], $dimensions[1] );
				$default_attr = array(
		            'src'    => $src,
		            'srcset' => $srcset,
		            'class'  => '',
		            'alt'    => $alt,
		        );
 
				$attr = wp_parse_args( $attr, $default_attr );				
				$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment  );
				$attr = array_map( 'esc_attr', $attr );
				
				$image = rtrim("<img $hwstring");
		        foreach ( $attr as $name => $value ) {
		            $image .= " $name=" . '"' . $value . '"';
		        }
		        $image .= ' />';

			}
			else {				
				$image  = wp_get_attachment_image( $this->atts['image'], $size, false, $image_opts );	
			}
			
			$src = wp_get_attachment_image_url( $this->atts['image'], 'full', false );
			$filetype = wp_check_filetype( $src );
			if( 'svg' === $filetype['ext'] ) {
				$loaded = 'class="loaded"';
			} 
			
		} else {
			if( 'on' === liquid_helper()->get_option( 'enable-lazy-load' ) && !is_admin() ) {
				$image = '<img class="ld-lazyload loaded" data-src="' . esc_url( $this->atts['image'] ) . '" src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
			}
			else {
				$image = '<img class="loaded" data-src="' . esc_url( $this->atts['image'] ) . '" src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
			}
			$loaded = 'class="loaded"';
		}
		
		if( !$this->atts['enable_browser'] ) {
			$image = sprintf( '<figure %s>%s</figure>', $loaded, $image );
		}	
		else {
			$image = sprintf( '<figure %s data-responsive-bg="true">%s</figure>', $loaded, $image );
		}
		
		
		echo $image;

	}
	
	protected function get_label() {
		
		$label = $this->atts['label'];
		$side  = $this->atts['label_side'];
		if( empty( $label ) ) {
			return;
		}
		
		printf( '<div class="liquid-img-group-content %s"><p>%s</p></div>', esc_attr( $side ), esc_html( $label ) );		

	}
	
	protected function get_browser_view() {
		
		if( !$this->atts['enable_browser'] ) {
			return '';
		}

		return 'liquid-img-group-browser';
		
	}
	
	protected function get_browser_bar() {
		
		if( !$this->atts['enable_browser'] ) {
			return;
		}
		if( !empty( $this->atts['browser_url'] ) ) {
			printf( '<span class="liquid-img-group-url"><span>https://</span>%s</span>', esc_html( $this->atts['browser_url'] ) );
		}
		
	}
	
	protected function get_overlay_link() {
		
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );
		if ( !empty( $link['href'] ) ) {
			printf( '<a%s class="liquid-overlay-link"></a>', ld_helper()->html_attributes( $link )  );
		}
		
	}
	
	protected function get_data_options() {
		
		$opts = array();
		
		$shadow = $this->atts['enable_shadow'];
		$shadow_style = $this->atts['shadow_style'];
		$shadow_delay = $this->atts['shadow_delay'];

		$reveal = $this->atts['enable_reveal'];
		$reveal_color =	isset( $this->atts['reveal_color'] ) ? $this->atts['reveal_color'] : '#f0f3f6';
		$reveal_direction = $this->atts['reveal_direction'];
		$reveal_delay = isset( $this->atts['reveal_delay'] ) ? $this->atts['reveal_delay'] : 0;

		if( $this->atts['enable_image_shadow'] ) {
			$opts[] = 'data-shadow-style="' . $shadow_style . '"';
		}
		if( $this->atts['enable_roudness'] ) {
			$opts[] = 'data-roundness="'. $this->atts['image_roudness'] . '"';
		}

		if( $shadow ) {
			$opts[] = 'data-inview="true"';
			if( ! empty( $shadow_delay ) && isset( $shadow_delay ) ) {
				$opts[] = 'data-inview-options=\'' . wp_json_encode( array( 'delayTime' => (int)$shadow_delay ) ) . '\'';
			}
			$opts[] = 'data-animate-shadow="true"';	
		}
		
		if( $reveal ) {
			$opts[] = 'data-reveal="true"';
			$opts[] = 'data-reveal-options=\'' . wp_json_encode( array( 'direction' => $reveal_direction, 'bgcolor' => $reveal_color, 'delay' => $reveal_delay ) ) . '\'';
			
		}
		
		if( empty( $opts ) ) {
			return;
		}
		
		return implode( ' ', $opts );	
	}
	
	protected function get_parallax_options() {
		
		extract( $this->atts );
		
		if( 'yes' !== $parallax ) {
			return;
		}

		$wrapper_attributes = $parallax_data = $parallax_data_from = $parallax_data_to = $parallax_opts = array();

		$wrapper_attributes[] = 'data-parallax="true"';
	
		//Data-options-from
		if ( !empty( $translate_from_x ) ) { $parallax_data_from['translateX']      = ( int ) $translate_from_x; }
		if ( !empty( $translate_from_y ) ) { $parallax_data_from['translateY']      = ( int ) $translate_from_y; }
		if ( !empty( $translate_from_z ) ) { $parallax_data_from['translateZ']      = ( int ) $translate_from_z; }
	
		if ( '1' !== $scale_from_x ) { $parallax_data_from['scaleX']     = ( float ) $scale_from_x; }
		if ( '1' !== $scale_from_y ) { $parallax_data_from['scaleY']     = ( float ) $scale_from_y; }
		if ( '1' !== $scale_from_z ) { $parallax_data_from['scaleZ']     = ( float ) $scale_from_z; }
	
		if ( !empty( $rotate_from_x ) ) { $parallax_data_from['rotateX'] = ( int ) $rotate_from_x; }
		if ( !empty( $rotate_from_y ) ) { $parallax_data_from['rotateY'] = ( int ) $rotate_from_y; }
		if ( !empty( $rotate_from_z ) ) { $parallax_data_from['rotateZ'] = ( int ) $rotate_from_z; }
	
		if ( isset( $from_opacity ) && '1' !== $from_opacity ) { $parallax_data_from['opacity']    = ( float ) $from_opacity; }
	
		if ( ! empty(
			$from_torigin_x_custom ) ) { $_x_custom = $from_torigin_x_custom;
		} else {
			$_x_custom = ! empty( $from_torigin_x ) ? $from_torigin_x : '';
		}
		if ( ! empty( $from_torigin_y_custom ) ) {
			$_y_custom = $from_torigin_y_custom;
		} else {
			$_y_custom = ! empty( $from_torigin_y ) ? $from_torigin_y : '';
		}
		if ( ! empty( $_x_custom ) && ! empty( $_y_custom ) ) {
			$parallax_data_from['transformOrigin'] = $_x_custom . '&nbsp;' . $_y_custom;
		}
	
		//Data-options-to
		if ( !empty( $translate_from_x ) ) { $parallax_data_to['translateX'] = ( int ) $translate_to_x; }
		if ( !empty( $translate_from_y ) ) { $parallax_data_to['translateY'] = ( int ) $translate_to_y; }
		if ( !empty( $translate_from_z ) ) { $parallax_data_to['translateZ'] = ( int ) $translate_to_z; }
	
		if ( isset( $scale_to_x ) && '1' !== $scale_from_x ) { $parallax_data_to['scaleX'] = ( float ) $scale_to_x; }
		if ( isset( $scale_to_y ) && '1' !== $scale_from_y ) { $parallax_data_to['scaleY'] = ( float ) $scale_to_y; }
		if ( isset( $scale_to_z ) && '1' !== $scale_from_z ) { $parallax_data_to['scaleZ'] = ( float ) $scale_to_z; }
	
		if ( !empty( $rotate_from_x ) ) { $parallax_data_to['rotateX'] = ( int ) $rotate_to_x; }
		if ( !empty( $rotate_from_y ) ) { $parallax_data_to['rotateY'] = ( int ) $rotate_to_y; }
		if ( !empty( $rotate_from_z ) ) { $parallax_data_to['rotateZ'] = ( int ) $rotate_to_z; }
	
		if ( isset( $to_opacity ) && '1' !== $from_opacity ) { $parallax_data_to['opacity'] = ( float ) $to_opacity; }
	
		if( ! empty(
			$to_torigin_x_custom ) ) { $to_x_custom = $to_torigin_x_custom;
		} else {
			$to_x_custom = ! empty( $to_torigin_x ) ? $to_torigin_x : '';
		}
		if( ! empty( $to_torigin_y_custom ) ) {
			$to_y_custom = $to_torigin_y_custom;
		} else {
			$to_y_custom = ! empty( $to_torigin_y ) ? $to_torigin_y : '';
		}
		if( ! empty( $to_x_custom ) && ! empty( $to_y_custom ) ) {
			$parallax_data_to['transformOrigin'] = $to_x_custom . '&nbsp;' . $to_y_custom;
		}
	
		//Parallax general options
		if ( ! empty( $parallax_from ) ) {
			$parallax_data['from'] = $parallax_from;
		} else {
			$parallax_data['from'] = $parallax_data_from;
		}
		if( ! empty( $parallax_to ) ) {
			$parallax_data['to'] = $parallax_to;
		} else {
			$parallax_data['to'] = $parallax_data_to;
		}

	
		if( is_array( $parallax_data['from'] ) && ! empty( $parallax_data['from'] ) ) {
			$wrapper_attributes[] = 'data-parallax-from=\'' . wp_json_encode( $parallax_data['from'] ) . '\'';
		}
		elseif( ! empty( $parallax_from ) ) {
			$wrapper_attributes[] = 'data-parallax-from=\'{' . $parallax_from . '}\'';
		}
	
		if( is_array( $parallax_data['to'] ) && ! empty( $parallax_data['to'] ) ) {
	
			$wrapper_attributes[] = 'data-parallax-to=\'' . wp_json_encode( $parallax_data['to'] ) . '\'';
		}
		elseif( ! empty( $parallax_to ) ) {
			$wrapper_attributes[] = 'data-parallax-to=\'{' . $parallax_to . '}\'';
		}

		$parallax_opts['overflowHidden'] = ( 'no' === $parallax_overflow ) ? false : true;
		if( ! empty( $parallax_time ) ) { $parallax_opts['time'] = esc_attr( $parallax_time ); }
		if( ! empty( $parallax_duration ) ) { $parallax_opts['duration'] = esc_attr( $parallax_duration ); }
		if ( isset( $to_easy ) ) { $parallax_opts['easing'] = $to_easy; }
		if ( ! empty( $to_delay ) ) { $parallax_opts['delay'] = ( float ) $to_delay; }
		if( ! empty( $parallax_offset ) ) { $parallax_opts['offset'] = esc_attr( $parallax_offset ); }
		if( ! empty( $parallax_opts ) ) {
			$wrapper_attributes[] = 'data-parallax-options=\'' . wp_json_encode( $parallax_opts ) .'\'';
		}

		return implode( ' ', $wrapper_attributes );

	}
	
	protected function get_overflow_height() {
		
		if( empty( $this->atts['overflow_height'] ) ) {
			return '';
		}

		return 'custom-height-applied';
		
	}	

	protected function get_color_adjust_reset() {
		
		if( !$this->atts['enable_color_adjust_reset'] ) {
			return '';
		}

		return 'reset-color-adjust-enabled';
		
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if ( ! empty($enable_color_adjust) ) {
			$elements[ liquid_implode( '%1$s .liquid-img-container-inner figure' ) ]['filter'] = 'saturate(' . $ca_saturation . ')' . ' brightness(' . $ca_brightness . ')' . ' contrast(' . $ca_contrast . '%)' . ' grayscale(' . $ca_grayscale . '%)' . ' hue-rotate(' . $ca_hue . 'deg)' . ' opacity(' . $ca_opacity . '%)';
		}
		
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
new LD_Images_Group_Element;
class WPBakeryShortCode_LD_Images_Group_Element extends WPBakeryShortCodesContainer {}