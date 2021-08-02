<?php
/**
* Shortcode Newsletter
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Newsletter extends LD_Shortcode {

	/**
	 * [$post_type description]
	 * @var string
	 */
	public $list_id = '';

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_newsletter';
		$this->title       = esc_html__( 'Newsletter', 'ave-core' );
		$this->description = esc_html__( 'Create a newsletter.', 'ave-core' );
		$this->icon        = 'fa fa-envelope-open';
		$this->scripts     = 'liquid-mailchimp-form';

		add_action( 'wp_ajax_add_mailchimp_user', array( $this, 'add_user_to_the_list' ) );
		add_action( 'wp_ajax_nopriv_add_mailchimp_user', array( $this, 'add_user_to_the_list' ) );

		parent::__construct();

	}

	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/newsletter/';

		$general = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'list_id',
				'heading'     => esc_html__( 'List ID', 'ave-core' ),
				'description' => esc_html__( 'Select the list from mailchimp to add emails. The API Key of the Mailchimp should be added in Theme Options', 'ave-core' ),
				'value'       => array_merge_recursive( array( 'Select' => '' ) , array_flip( $this->get_mailchimp_lists() ) ),
				'admin_label' => true,
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_opt_in',
				'heading'     => esc_html__( 'Use Opt-in?', 'ave-core' ),
				'description' => esc_html__( 'Enable this if you checked the Opt-in in mailchimp.com settings also', 'ave-core' ),
				'value'       => array( 'yes' => esc_html__( 'Yes', 'ave-core' ) ),
			),
			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Input Style', 'ave-core' ),
				'value'      => array(

					array(
						'value' => 'bordered',
						'label' => esc_html__( 'Bordered', 'ave-core' ),
						'image' => $url . 'input-border.svg'
					),

					array(
						'label' => esc_html__( 'Solid', 'ave-core' ),
						'value' => 'solid',
						'image' => $url . 'input-solid.svg'
					),

					array(
						'label' => esc_html__( 'Underlined', 'ave-core' ),
						'value' => 'underlined',
						'image' => $url . 'input-underline.svg'
					),
				),
				'save_always' => true,
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'placeholder_text',
				'heading'     => esc_html__( 'Placehoder', 'ave-core' ),
				'description' => esc_html__( 'Add placeholder text', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_input',
				'heading'     => esc_html__( 'Custom font in inputs?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for input', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_label',
				'heading'     => esc_html__( 'Custom font for label?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for button label', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_response',
				'heading'     => esc_html__( 'Custom font for response?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for response', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_size',
				'heading'    => esc_html__( 'Size', 'ave-core' ),
				'description' => esc_html__( 'Select input border size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => 'ld-sf--size-md',
					esc_html__( 'xSmall', 'ave-core' )  => 'ld-sf--size-xs',
					esc_html__( 'Small', 'ave-core' )  => 'ld-sf--size-sm',
					esc_html__( 'Medium', 'ave-core' )  => 'ld-sf--size-md',
					esc_html__( 'Large', 'ave-core' )   => 'ld-sf--size-lg',
					esc_html__( 'xLarge', 'ave-core' )   => 'ld-sf--size-xl',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_radius',
				'heading'    => esc_html__( 'Border radius', 'ave-core' ),
				'description' => esc_html__( 'Select input border radius', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Sharp', 'ave-core' )    => 'ld-sf--sharp',
					esc_html__( 'Semi Round', 'ave-core' ) => 'ld-sf--semi-round',
					esc_html__( 'Round', 'ave-core' )      => 'ld-sf--round',
					esc_html__( 'Circle', 'ave-core' )     => 'ld-sf--circle',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_border',
				'heading'    => esc_html__( 'Border thickness', 'ave-core' ),
				'description' => esc_html__( 'Select input border thickness', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Thin', 'ave-core' ) => 'ld-sf--border-thin',
					esc_html__( 'Thick', 'ave-core' )   => 'ld-sf--border-thick',
					esc_html__( 'Thicker', 'ave-core' ) => 'ld-sf--border-thicker',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'inputs_shadow',
				'heading'    => esc_html__( 'Other', 'ave-core' ),
				'description' => esc_html__( 'Select input other styling', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )      => '',
					esc_html__( 'Shadow', 'ave-core' )       => 'ld-sf--input-shadow',
					esc_html__( 'Inner Shadow', 'ave-core' ) => 'ld-sf--input-inner-shadow',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Response Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'response_fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_response',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Response Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'response_lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_response',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Response Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'response_fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_response',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Response Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'response_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_response',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Response Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Response theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts_response',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Response Typo', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_response',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'response_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Response Typo', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_response',
					'value_not_equal_to' => 'yes',
				),
			),
			
			
			//Inputs Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_input',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Input Typo', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			
			//Label Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'label_fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_label',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Button Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label_lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_label',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Button Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label_fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_label',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Button Typo', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_label',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Button Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts_label',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Button Typo', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_label',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'label_text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Button Typo', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_label',
					'value_not_equal_to' => 'yes',
				),
			),
			

		);

		$button = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons',
				'heading'    => esc_html__( 'Submit Button', 'ave-core' ),
			),

			array(
				'type'       => 'select_preview',
				'param_name' => 'btn_style',
				'heading'    => esc_html__( 'Submit Button Style', 'ave-core' ),
				'value'      => array(

					array(
						'value' => 'solid',
						'label' => esc_html__( 'Solid', 'ave-core' ),
						'image' => $url . 'button-solid.svg'
					),

					array(
						'label' => esc_html__( 'Bordered', 'ave-core' ),
						'value' => 'bordered',
						'image' => $url . 'button-border.svg'
					),

					array(
						'label' => esc_html__( 'Underlined', 'ave-core' ),
						'value' => 'underlined',
						'image' => $url . 'button-underline.svg'
					),

					array(
						'label' => esc_html__( 'Plain', 'ave-core' ),
						'value' => 'naked',
						'image' => $url . 'button-plain.svg'
					),	
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_state',
				'heading'    => esc_html( 'Button state', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Display', 'ave-core' ) => 'ld-sf--button-show',
					esc_html__( 'Hidden', 'ave-core' )  => 'ld-sf--button-hidden',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_display',
				'heading'    => esc_html__( 'Button display', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Button label', 'ave-core' )          => 'label',
					esc_html__( 'Icon', 'ave-core' )                  => 'icon',
					esc_html__( 'Button label and icon', 'ave-core' ) => 'label_icon',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'btn_label',
				'heading'     => esc_html__( 'Button label', 'ave-core' ),
				'description' => esc_html__( 'Add button label', 'ave-core' ),
				'std'         => esc_html__( 'Subscribe', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'btn_display',
					'value' => array( 'label', 'label_icon' )
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_position',
				'heading'    => esc_html__( 'Button Position', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )  => '',
					esc_html__( 'In input', 'ave-core' ) => 'ld-sf--button-inside',
					esc_html__( 'Near input' )             => 'ld-sf--button-inline',
					esc_html__( 'Under input' )            => 'ld-sf--button-block',
				),
				'dependency' => array(
					'element' => 'btn_state',
					'value_not_equal_to' => 'subscribe-minimal',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'btn_shrink',
				'heading'    => esc_html__( 'Button Shrink', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'button-shrinked',
				),
				'dependency' => array(
					'element' => 'btn_position',
					'value'   => 'ld-sf--button-inside',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),


		);

		$icon = liquid_get_icon_params( true, '', array( 'fontawesome', 'linea' ),  array( 'color', 'align', 'hcolor' ), 'i_', array( 'element' => 'btn_display', 'value_not_equal_to' => 'label' ) );

		$design = array(

			//design options
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_inputs',
				'heading'    => esc_html__( 'Inputs', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'txt_color',
				'heading'    => esc_html__( 'Text Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'bg_color',
				'heading'    => esc_html__( 'Background Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'brd_color',
				'only_solid' => true,
				'heading'    => esc_html__( 'Border Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_inputs_f',
				'heading'    => esc_html__( 'Inputs Focus', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'txt_f_color',
				'heading'    => esc_html__( 'Text Color', '_s' ),
				'group'      => esc_html__( 'Design Options', '_s' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'bg_f_color',
				'heading'    => esc_html__( 'Background Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'brd_f_color',
				'heading'    => esc_html__( 'Border Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons',
				'heading'    => esc_html__( 'Submit Button', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true, 
				'param_name' => 'btn_txt_color',
				'heading'    => esc_html__( 'Label color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'btn_bg_color',
				'heading'    => esc_html__( 'Background color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'btn_brd_color',
				'heading'    => esc_html__( 'Border color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_buttons_hover',
				'heading'    => esc_html__( 'Hover Submit Button', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_btn_txt_color',
				'heading'    => esc_html__( 'Label color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'hover_btn_bg_color',
				'heading'    => esc_html__( 'Background color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_btn_brd_color',
				'heading'    => esc_html__( 'Border color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_response_styling',
				'heading'    => esc_html__( 'Response Colors', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),

			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'response_txt_color',
				'heading'    => esc_html__( 'Response color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

		);

		$this->params = array_merge( $general, $button, $icon, $design );

		$this->add_extras();

	}
	
	public function get_list_id() {
		
		if( !empty( $this->atts['list_id'] ) ) {
			return;
		}
		
		$this->list_id = $this->atts['list_id'];
		
		return $this->list_id;
		
	}
	
	/**
	 * Get MailChimp Lists IDs
	 * @return array
	 */
	public function get_mailchimp_lists() {
		
		if( !class_exists( 'liquid_MailChimp' ) ) {
			return array();
		}
		$api_key = liquid_helper()->get_theme_option( 'mailchimp-api-key' );
		if( empty( $api_key ) || strpos( $api_key, '-' ) === false ) {
			return array();
		}

		$MailChimp = new liquid_MailChimp( $api_key );
		
		$lists = $MailChimp->get( 'lists?count=100' );
		$items = array();
		if ( is_array( $lists ) && !is_wp_error( $lists ) ) {
			foreach ( $lists as $list ) {
				if( is_array( $list ) ) {
					foreach( $list as $l ) {
						if( isset( $l['id'] ) && isset( $l['name'] ) ) {
							$items[ $l['id'] ] = $l['name'];	
						}
					}
				}
			}
		}

		return $items;
	}
	
	protected function get_class( $style ) {

		$hash = array(
			'underlined' => 'ld-sf--input-underlined',
			'solid'      => 'ld-sf--input-solid',
			'bordered'   => 'ld-sf--input-bordered',
		);

		return $hash[ $style ];
	}

	protected function get_btn_class( $style ) {

		$hash = array(
			'solid'      => 'ld-sf--button-solid',
			'bordered'   => 'ld-sf--button-bordered',
			'underlined' => 'ld-sf--button-underlined',
			'naked'      => 'ld-sf--button-naked',
		);

		return $hash[ $style ];
	}
	
	protected function get_submit_button(){
		
		$icon = liquid_get_icon( $this->atts );
		extract( $icon );

		$icon = !empty ( $icon ) && 'true' === $this->atts['i_add_icon'] ? $icon : 'fa fa-long-arrow-right';
		$label = !empty( $this->atts['btn_label'] ) ? '<span class="submit-text">' . esc_html( $this->atts['btn_label'] ) . '</span>' : '';
		$icon_html  = ' <span class="submit-icon"><i class="' . $icon . '"></i></span>';
		
		$btn_display = $this->atts['btn_display'];
		if( 'label' === $btn_display ) {
			$icon_html = '';	
		}
		elseif( 'icon' === $btn_display ) {
			$label = '';	
			$icon_html  = '<span class="submit-icon"><i class="' . $icon . '"></i></span>';
		}

		$label_html = $label . $icon_html;

		printf( '<button type="submit" class="ld_sf_submit">%s <span class="ld-sf-spinner"><span>Sending </span></span></button>', $label_html );
		
	}
	
	function get_status() {

		if( $this->atts['use_opt_in'] ) {
			return 'pending';
		}
		else {
			return 'subscribed';
		}
	}
	
	function add_user_to_the_list() {
		
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ld-mailchimp-form', 'security', false );

		if( !class_exists( 'liquid_MailChimp' ) ) {
			return;
		}
		
		$api_key = liquid_helper()->get_theme_option( 'mailchimp-api-key' );
		if( empty( $api_key ) || strpos( $api_key, '-' ) === false ) {
			wp_die( esc_html__( 'Please, input the MailChimp Api Key in Theme Options Panel', 'ave-core' ) );
		}
		$MailChimp = new liquid_MailChimp( $api_key );
		
		$list_id = $_POST['list_id'];
		$email  = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
		$fname  = isset( $_POST['fname'] ) ? sanitize_text_field( $_POST['fname'] ) : '';
		$lname  = isset( $_POST['lname'] ) ? sanitize_text_field( $_POST['lname'] ) : '';

		if( empty( $list_id ) ) {
			wp_die( esc_html__( 'Wrong List ID, please select a real one', 'ave-core' ) );
		}

		$result = $MailChimp->post( "lists/$list_id/members", array(
						'email_address' => $email,
						'merge_fields'  => array( 'FNAME'=> $fname, 'LNAME' => $lname ),
						'status'        => $this->get_status(),
					) );
		if ( $MailChimp->success() ) {	
			// Success message
			echo '<h4>' . esc_html__( 'Thank you, you have been added to our mailing list.', 'ave-core' ) . '</h4>';
		}
		else {
			$check_user_status = json_decode( $MailChimp->getLastRequest()['body'] );
			
			if( 'subscribed' === $check_user_status->status ) {
				echo '<h4>' . esc_html__( 'Thank you, you are already subscribed', 'ave-core' ) . '</h4>';
			}
			// Display error
			echo $MailChimp->getLastError();
		}	
		
		wp_die(); // Important
	}
	
	protected function generate_css() {
		
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		extract( $this->atts );
		$elements = array();
		$id = '.' .$this->get_id();
		
		$text_font_inline_style = $label_font_inline_style = $response_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}

		$elements[ liquid_implode( '%1$s.ld-sf input' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s.ld-sf input' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s.ld-sf input' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s.ld-sf input' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s.ld-sf input' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( 'yes' !== $use_theme_fonts_response ) {

			// Build the data array
			$response_font_data = $this->get_fonts_data( $response_font );

			// Build the inline style
			$response_font_inline_style = $this->google_fonts_style( $response_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $response_font_data );

		}

		$elements[ liquid_implode( '%1$s .ld_sf_response h4' ) ] = array( $response_font_inline_style );
		$elements[ liquid_implode( '%1$s .ld_sf_response h4' ) ]['font-size'] = !empty( $response_fs ) ? $response_fs : '';
		$elements[ liquid_implode( '%1$s .ld_sf_response h4' ) ]['line-height'] = !empty( $response_lh ) ? $response_lh : '';
		$elements[ liquid_implode( '%1$s .ld_sf_response h4' ) ]['font-weight'] = !empty( $response_fw ) ? $response_fw : '';
		$elements[ liquid_implode( '%1$s .ld_sf_response h4' ) ]['letter-spacing'] = !empty( $response_ls ) ? $response_ls : '';
		$elements[liquid_implode( '%1$s .ld_sf_response h4' )]['color'] = !empty( $response_txt_color ) ? $response_txt_color : '';
		
		if( 'yes' !== $use_theme_fonts_label ) {

			// Build the data array
			$label_font_data = $this->get_fonts_data( $label_text_font );

			// Build the inline style
			$label_font_inline_style = $this->google_fonts_style( $label_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $label_font_data );

		}
		
		$elements[ liquid_implode( '%1$s.ld-sf .ld_sf_submit' ) ] = array( $label_font_inline_style );
		$elements[ liquid_implode( '%1$s.ld-sf .ld_sf_submit' ) ]['font-size'] = !empty( $label_fs ) ? $label_fs : '';
		$elements[ liquid_implode( '%1$s.ld-sf .ld_sf_submit' ) ]['line-height'] = !empty( $label_lh ) ? $label_lh : '';
		$elements[ liquid_implode( '%1$s.ld-sf .ld_sf_submit' ) ]['font-weight'] = !empty( $label_fw ) ? $label_fw : '';
		$elements[ liquid_implode( '%1$s.ld-sf .ld_sf_submit' ) ]['letter-spacing'] = !empty( $label_ls ) ? $label_ls : '';
		$elements[liquid_implode( '%1$s .submit-icon' )]['font-size'] = !empty( $i_size ) ? $i_size : '';

		$elements[liquid_implode( '%1$s.ld-sf input[type="email"]' )] = array(
			'background'   => $bg_color,
			'color'        => $txt_color,
			'border-color' => $brd_color
		);
		$elements[liquid_implode( '%1$s.ld-sf input[type="email"]:focus' )] = array(
			'background'   => $bg_f_color,
			'color'        => $txt_f_color,
			'border-color' => $brd_f_color
		);
		$elements[liquid_implode( '%1$s.ld-sf button.ld_sf_submit' )] = array(
			'background'   => $btn_bg_color,
			'color'        => $btn_txt_color,
			'border-color' => $btn_brd_color
		);
		$elements[liquid_implode( '%1$s.ld-sf buttont.ld_sf_submit:hover' )] = array(
			'background'   => $hover_btn_bg_color,
			'color'        => $hover_btn_txt_color,
			'border-color' => $hover_btn_brd_color
		);

		$this->dynamic_css_parser( $id, $elements );
	}
	

}

new LD_Newsletter;