<?php

/**
* Shortcode Fancy Heading
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Fancy_Heading extends LD_Shortcode { 

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_fancy_heading';
		$this->title       = esc_html__( 'Liquid Fancy Heading', 'ave-core' );
		$this->description = esc_html__( 'Add a fancy custom heading', 'ave-core' );
		$this->icon        = 'fa fa-text-height';
		$this->scripts      = array( 'splittext' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			array(
				'type'        => 'textarea_html',
				'heading'     => esc_html__( 'Title', 'ave-core' ),
				'param_name'  => 'content',
				'admin_label' => true,
				'value'       => esc_html__( 'This is Liquid Fancy heading element', 'ave-core' ),
				'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/WPBakery Page Builder/General Settings.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-12 vc_column-with-padding',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag',
				'heading'     => esc_html__( 'Element tag', 'ave-core' ),
				'description' => esc_html__( 'Select element tag.', 'ave-core' ),
				'value'       => array(
					esc_html__( 'h1', 'ave-core' )  => 'h1',
					esc_html__( 'h2', 'ave-core' )  => 'h2',
					esc_html__( 'h3', 'ave-core' )  => 'h3',
					esc_html__( 'h4', 'ave-core' )  => 'h4',
					esc_html__( 'h5', 'ave-core' )  => 'h5',
					esc_html__( 'h6', 'ave-core' )  => 'h6',
					esc_html__( 'p', 'ave-core' )   => 'p',
					esc_html__( 'div', 'ave-core' ) => 'div',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'alignment',
				'heading'     => esc_html__( 'Alignment', 'ave-core' ),
				'description' => esc_html__( 'Select title alignment', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Inherit', 'ave-core' )   => '',
					esc_html__( 'Left', 'ave-core' )      => 'text-left',
					esc_html__( 'Center', 'ave-core' )    => 'text-center',
					esc_html__( 'Right', 'ave-core' )     => 'text-right',
					esc_html__( 'Justified', 'ave-core' ) => 'text-justified',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform',
				'heading'    => esc_html__( 'Transformation', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )    => '',
					esc_html__( 'Uppercase', 'ave-core' )  => 'text-uppercase',
					esc_html__( 'Lowercase', 'ave-core' )  => 'text-lowercase',
					esc_html__( 'Capitalize', 'ave-core' ) => 'text-capitalize',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'enable_underline',
				'heading'    => esc_html__( 'Underline', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'color',
				'heading'     => esc_html__( 'Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_gradient' => true,
				'param_name'  => 'gradient',
				'heading'     => esc_html__( 'Gradient', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_inheritance',
				'heading'     => esc_html__( 'Inherit font styles?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable font style inheritance', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag_to_inherite',
				'heading'     => esc_html__( 'Tag', 'ave-core' ),
				'description' => esc_html__( 'Select tag you want to inherite style defined in theme options', 'ave-core' ),
				'value'       => array(
					esc_html__( 'h1', 'ave-core' ) => 'h1',
					esc_html__( 'h2', 'ave-core' ) => 'h2',
					esc_html__( 'h3', 'ave-core' ) => 'h3',
					esc_html__( 'h4', 'ave-core' ) => 'h4',
					esc_html__( 'h5', 'ave-core' ) => 'h5',
					esc_html__( 'h6', 'ave-core' ) => 'h6',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_inheritance',
					'value'   => 'true',
				)
			),
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'URL (Link)', 'ave-core' ),
				'param_name'  => 'link',
				'description' => esc_html__( 'Add link to custom heading.', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_bg_mask',
				'heading'     => esc_html__( 'Enable Background mask?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable background mask on title', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_attach_image',
				'param_name'       => 'mask_image',
				'heading'          => esc_html__( 'Mask Image', 'ave-core' ),
				'descripton'       => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'mask_bg_size',
				'heading' => esc_html__( 'Background Size', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Cover', 'ave-core' )   => 'cover',
					esc_html__( 'Contain', 'ave-core' ) => 'contain',
				),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'mask_bg_repeat',
				'heading' => esc_html__( 'Background Repeat', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'No repeat', 'ave-core' ) => 'no-repeat',
					esc_html__( 'Repeat', 'ave-core' )    => 'repeat',
					esc_html__( 'Repeat X', 'ave-core' )    => 'repeat-x',
					esc_html__( 'Repeat Y', 'ave-core' )    => 'repeat-y',
				),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'mask_bg_position',
				'heading' => esc_html__( 'Background Position', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' )         => '',
					esc_html__( 'Center Bottom', 'ave-core' )   => 'center bottom',
					esc_html__( 'Center Center', 'ave-core' )   => 'center center',
					esc_html__( 'Center Top', 'ave-core' )      => 'center top',
					esc_html__( 'Left Bottom', 'ave-core' )     => 'left bottom',
					esc_html__( 'Left Center', 'ave-core' )     => 'left center',
					esc_html__( 'Left Top', 'ave-core' )        => 'left top',
					esc_html__( 'Right Bottom', 'ave-core' )    => 'right bottom',
					esc_html__( 'Right Center', 'ave-core' )    => 'right center',
					esc_html__( 'Right Top', 'ave-core' )       => 'right top',
					esc_html__( 'Custom Position', 'ave-core' ) => 'custom',
				),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'mask_bg_pos_h',
				'heading'          => esc_html__( 'Horizontal Position', 'ave-core' ),
				'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'ave-core' ),
				'dependency'  => array(
					'element' => 'mask_bg_position',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'mask_bg_pos_v',
				'heading'          => esc_html__( 'Vertical Position', 'ave-core' ),
				'description'      => esc_html__( 'Enter custom vertical position in px or %', 'ave-core' ),
				'dependency'  => array(
					'element' => 'mask_bg_position',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			
			//Underline
			array(
				'type'        => 'subheading',
				'param_name'  => 'sb_underline',
				'heading'     => esc_html__( 'Line Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_height',
				'heading'     => esc_html__( 'Height', 'ave-core' ),
				'description' => esc_html__( 'Add line height in px, for ex 2px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_width',
				'heading'     => esc_html__( 'Width', 'ave-core' ),
				'description' => esc_html__( 'Add line width in px, for ex 60px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_offset',
				'heading'     => esc_html__( 'Bottom Offset', 'ave-core' ),
				'description' => esc_html__( 'Add line bottom offset, for ex -10px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_roudness',
				'heading'     => esc_html__( 'Roudness', 'ave-core' ),
				'description' => esc_html__( 'Add line roudness in px, for ex 5px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'line_color',
				'heading'     => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a background color for line', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type' => 'subheading',
				'param_name' => 'sb_highlight',
				'heading' => esc_html__( 'Highlight', 'ave-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'highlight_type',
				'heading' => esc_html__( 'Type', 'ave-core' ),
				'value' => array(
					esc_html__( 'Underline', 'ave-core' ) => 'lqd-highlight-underline',
					esc_html__( 'Default', 'ave-core' )   => '',

				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'highlight_animation',
				'heading' => esc_html__( 'Animation', 'ave-core' ),
				'value' => array(
					esc_html__( 'Grow From Left', 'ave-core' )   => 'lqd-highlight-grow-left',
					esc_html__( 'Grow From Bottom', 'ave-core' ) => 'lqd-highlight-grow-bottom',
					esc_html__( 'Fade In', 'ave-core' )          => 'lqd-highlight-fadein',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'highlight_color',
				'heading'     => esc_html__( 'Backround Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a background color for highlight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'highlight_height',
				'heading'     => esc_html__( 'Height', 'ave-core' ),
				'description' => esc_html__( 'Add line height in px, for ex 2px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => '0.275em',
				'dependency'  => array(
					'element' => 'highlight_type',
					'value'   => 'lqd-highlight-underline',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'highlight_offset',
				'heading'     => esc_html__( 'Bottom Offset', 'ave-core' ),
				'description' => esc_html__( 'Add line bottom offset, for ex -10px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => '0px'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'highlight_roudness',
				'heading'     => esc_html__( 'Roudness', 'ave-core' ),
				'description' => esc_html__( 'Add line roudness in px, for ex 5px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'subheading',
				'param_name' => 'sb_heading',
				'heading' => esc_html__( 'Effects', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_fit',
				'heading'     => esc_html__( 'Enable Responsive size text?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable responsive size text options', 'ave-core' ),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'compressor',
				'heading' => esc_html__( 'Compressor' ),
				'description' => esc_html__( 'Set a number from 0 to 2 The more you increase the compressor level, the more the text shrinks on mobile.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'enable_fit',
					'value'   => 'true',
				)
			),
			array(
				'type' => 'textfield',
				'param_name' => 'maxfontsize',
				'heading' => esc_html__( 'Maximum Font Size' ),
				'description' => esc_html__( 'Leave blank to use current font size', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'enable_fit',
					'value'   => 'true',
				)
			),
			array(
				'type' => 'textfield',
				'param_name' => 'minfontsize',
				'heading' => esc_html__( 'Minimum Font Size' ),
				'description' => esc_html__( 'Leave blank to use current font size', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'enable_fit',
					'value'   => 'true',
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_split',
				'heading'     => esc_html__( 'Enable Split Text Animation?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable split effect', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_bg_mask',
					'is_empty'   => true,
				)
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'split_type',
				'heading'     => esc_html__( 'Split Type', 'ave-core' ),
				'description' => esc_html__( 'Select split type', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Lines', 'ave-core' ) => 'lines',
					esc_html__( 'Characters', 'ave-core' ) => 'chars, words',
					esc_html__( 'Words', 'ave-core' ) => 'words',
				),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_txt_rotator',
				'heading'     => esc_html__( 'Enable Text Rotator?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable text rotator', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes'  ),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'word_colors',
				'heading'     => esc_html__( 'Title rotator words color', 'ave-core' ),
				'description' => esc_html__( 'Pick a different color for the title rotator words', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'enable_txt_rotator',
					'value'   => 'yes',
				),
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Separated words for text rotator', 'ave-core' ),
				'value'      => '',
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'word',
						'heading'     => esc_html__( 'Title word', 'ave-core' ),
						'description' => esc_html__( 'Add word for title rotator', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
					),
					array(
						'type'        => 'liquid_colorpicker',
						'only_solid'  => true,
						'param_name'  => 'word_color',
						'heading'     => esc_html__( 'Title word color', 'ave-core' ),
						'description' => esc_html__( 'Pick a different color for the title word', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6',
					),
				),
				'dependency' => array(
					'element' => 'enable_txt_rotator',
					'value'   => 'yes',
				),
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Text', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
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
				'group'      => esc_html__( 'Text', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			//Animation Options
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_mask',
				'heading'     => esc_html__( 'Enabled mask?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable mask on title to use it in animation', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Animation', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'duration',
				'heading'     => esc_html__( 'Duration', 'ave-core' ),
				'description' => esc_html__( 'Add duration of the animation in milliseconds', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group'            => esc_html__( 'Animation', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'start_delay',
				'heading'     => esc_html__( 'Start Delay', 'ave-core' ),
				'description' => esc_html__( 'Add start delay of the animation in milliseconds', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Animation', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'delay',
				'heading'     => esc_html__( 'Delay', 'ave-core' ),
				'description' => esc_html__( 'Add delay of the animation between of the animated elements in milliseconds', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Animation', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'easing',
				'heading'     => esc_html__( 'Easing', 'ave-core' ),
				'description' => esc_html__( 'Select an easing type', 'ave-core' ),
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
				'std'         => 'easeOutQuint',
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Animation', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'direction',
				'heading'     => esc_html__( 'Direction', 'ave-core' ),
				'description' => esc_html__( 'Select animations direction', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Forward', 'ave-core' )  => 'forward',
					esc_html__( 'Backward', 'ave-core' ) => 'backward',
				),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Animation', 'ave-core' ),
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'ca_init_values',
				'heading'     => esc_html__( 'Animate From', 'ave-core' ),
				'group'       => esc_html__( 'Animation', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_translate_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_scale_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_scale_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			
			//Animation Values
			array(
				'type'        => 'subheading',
				'param_name'  => 'ca_animations_values',
				'heading'     => esc_html__( 'Animate To', 'ave-core' ),
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_translate_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_scale_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_scale_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),

			//Design Options
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'ave-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'ave-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-md-6 vc_column-with-padding',
			),
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Padding', 'ave-core' ),
				'description' => esc_html__( 'Add paddings for the element, use px or %', 'ave-core' ),
				'css'        => 'padding',
				'param_name' => 'padding',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-md-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_bg',
				'heading'     => esc_html__( 'Enable Background?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable background', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'fh_bg',
				'heading'    => esc_html__( 'Fancy Heading Background', 'ave-core' ),
				'description' => esc_html__( 'Add fancy heading background', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_bg',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'fh_border_radius',
				'heading'     => esc_html__( 'Fancy Heading Border Radius', 'ave-core' ),
				'description' => esc_html__( 'Select border radius for fancy heading', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'value' => array(
					esc_html__( 'None', 'ave-core' )       => '',
					esc_html__( 'Semi Round', 'ave-core' ) => 'semi-round',
					esc_html__( 'Round', 'ave-core' )      => 'round',
					esc_html__( 'Circle', 'ave-core' )     => 'circle',
				),
				'dependency'  => array(
					'element' => 'enable_bg',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable box-shadow?', 'ave-core' ),
				'param_name'  => 'enable_fh_shadowbox',
				'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'enable_bg',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Shadow Box Options', 'ave-core' ),
				'param_name' => 'fh_box_shadow',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_fh_shadowbox',
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

		$this->add_extras();

	}

	protected function get_title() {
		
		$tag = $this->atts['tag'];
		
		$classnames = '';
		$classnames_arr = array();
		
		$link = liquid_get_link_attributes( $this->atts['link'], false );
		
		if( !empty( $this->atts['gradient'] ) ) {
			$classnames_arr[] = 'ld-gradient-heading';
		}
		if( !empty( $this->atts['fh_border_radius'] ) ) {
			$classnames_arr[] = $this->atts['fh_border_radius'];
		}

		if( !empty( $this->atts['highlight_type'] ) ) {
			$classnames_arr[] = $this->atts['highlight_type'];
		}
		if( !empty( $this->atts['highlight_animation'] ) ) {
			$classnames_arr[] = $this->atts['highlight_animation'];
		}
		
		$title = do_shortcode( wp_kses_post( $this->atts['content'] ) ) . $this->get_title_words();
		$tag_inherit = '';
		if( $this->atts['use_inheritance'] ){
			$classnames_arr[] = $this->atts['tag_to_inherite'];
		}
		
		if( !empty( $classnames_arr ) ) {
			$classnames = 'class="' . join( ' ', $classnames_arr ) . '"';
		}
		
		// Title
		if( $title ) {
			if ( !empty ( $link['href'] ) ) {
				printf( '<%1$s %3$s %4$s><a%5$s><span class="ld-fh-txt">%6$s %2$s</span></a></%1$s>', !empty( $tag ) ? $tag : 'h2', $title, $classnames, $this->get_data_opts(), ld_helper()->html_attributes( $link ), $this->get_underline() );
			}
			else {
				printf( '<%1$s %3$s %4$s><span class="ld-fh-txt">%5$s %2$s</span></%1$s>', !empty( $tag ) ? $tag : 'h2', $title, $classnames, $this->get_data_opts(), $this->get_underline() );
			}
			
		}
		
	}
	
	protected function get_title_words() {
		
		if( !$this->atts['enable_txt_rotator'] ) {
			return;
		}

		if( empty( $this->atts['items'] ) ) {
			return;
		}

		$words = vc_param_group_parse_atts( $this->atts['items'] );
		$words = array_filter( $words );

		if( empty( $words ) ) {
			return;
		}
		
		$out = $style_word = '';
		
		$out .= ' <span class="txt-rotate-keywords">';
		$i = 1;
		foreach ( $words as $word ) {
			$active = ( $i == 1 ) ? ' active' : '';
			$style_word = !empty( $word['word_color'] ) ? 'style="color:' . esc_attr( $word['word_color'] ) . '"' : '';
			
			$out .= '<span class="keyword' . $active . '" ' . $style_word . '>' . esc_html( $word['word'] ) . '</span>';
			$i++;
		}
		$out .= '</span><!-- /.txt-rotate-keywords -->';

		return $out;
		
	}
	
	protected function get_text_rotator_options() {
		
		if( !$this->atts['enable_txt_rotator'] ) {
			return;
		}

		return array( 'data-text-rotator="true"' );
	}
	
	protected function get_bg_classname() {

		if( empty( $this->atts['fh_bg'] ) ) {
			return;
		}

		return 'ld-fh-has-fill';
		
	}
	
	protected function get_underline() {
		
		if( empty( $this->atts['enable_underline'] ) ) {
			return;
		}
		
		return '<span class="ld-fh-underline"></span>';
		
	}
	
	protected function get_highlight_opts() {

		
		if( !has_shortcode( $this->atts['content'], 'ld_highlight' )  ) {
			return;
		}
		
		$opts = array();
		$opts[] = 'data-inview="true"';
		$opts[] = 'data-transition-delay="true"';
		$opts[] = 'data-delay-options=\'' . wp_json_encode( array( 'elements' => '.lqd-highlight-inner', 'delayType' => 'transition' ) ) . '\'';
		
		return $opts;
	
	}	
	
	protected function get_data_opts() {
		
		$opts = array();
		$fit_opts = $this->get_fit_options();
		$split_opts = $this->get_split_options();
		$rotator_opts = $this->get_text_rotator_options();
		$highlight_opts = $this->get_highlight_opts();
		
		if( is_array( $fit_opts ) && ! empty( $fit_opts ) ) {
			$opts = array_merge( $opts, $fit_opts );
		}
		if( is_array( $split_opts ) && ! empty( $split_opts ) ) {
			$opts = array_merge( $opts, $split_opts );
		}
		if( is_array( $rotator_opts ) && ! empty( $rotator_opts ) ) {
			$opts = array_merge( $opts, $rotator_opts );
		}
		if( is_array( $highlight_opts ) && ! empty( $highlight_opts ) ) {
			$opts = array_merge( $opts, $highlight_opts );
		}
		
		return join( ' ', $opts );
		
	}
	
	protected function get_split_options() {

		extract( $this->atts );

		if( !$enable_split ) {
			return;
		}
		
		$animation_opts = $this->get_animation_opts();

		$opts = $split_opts = array();
		$split_opts['type'] = $split_type;
		$opts[] = 'data-split-text="true"';
		$opts[] = 'data-custom-animations="true"';
		$opts[] = 'data-ca-options=\'' . stripslashes( wp_json_encode( $animation_opts ) ) . '\'';
		$opts[] = 'data-split-options=\'' . wp_json_encode( $split_opts ) . '\'';

		return $opts;

	}
	
	protected function get_animation_opts() {

		extract( $this->atts );
		
		$opts = $init_values = $animations_values = $arr = array();
		$opts['triggerHandler'] = 'inview';

		if( 'chars, words' === $split_type ) {
			$opts['animationTarget'] = '.lqd-chars .split-inner';
		}
		elseif( 'words' === $split_type ) {
			$opts['animationTarget'] = '.lqd-words .split-inner';
		}
		else {
			$opts['animationTarget'] = '.lqd-lines .split-inner';
		}

		$opts['duration'] = !empty( $duration ) ? $duration : 700;
		if( !empty( $start_delay ) ) {
			$opts['startDelay'] = $start_delay;
		}
		$opts['delay'] = !empty( $delay ) ? $delay : 100;
		$opts['easing'] = $easing;
		$opts['direction'] = $direction;
		
		//Init values
		if ( !empty( $ca_init_translate_x ) ) { $init_values['translateX'] = ( int ) $ca_init_translate_x; }
		if ( !empty( $ca_init_translate_y ) ) { $init_values['translateY'] = ( int ) $ca_init_translate_y; }
		if ( !empty( $ca_init_translate_z ) ) { $init_values['translateZ'] = ( int ) $ca_init_translate_z; }
	
		if ( '1' !== $ca_init_scale_x ) { $init_values['scaleX'] = ( float ) $ca_init_scale_x; }
		if ( '1' !== $ca_init_scale_y ) { $init_values['scaleY'] = ( float ) $ca_init_scale_y; }
		if ( '1' !== $ca_init_scale_z ) { $init_values['scaleZ'] = ( float ) $ca_init_scale_z; }
	
		if ( !empty( $ca_init_rotate_x ) ) { $init_values['rotateX'] = ( int ) $ca_init_rotate_x; }
		if ( !empty( $ca_init_rotate_y ) ) { $init_values['rotateY'] = ( int ) $ca_init_rotate_y; }
		if ( !empty( $ca_init_rotate_z ) ) { $init_values['rotateZ'] = ( int ) $ca_init_rotate_z; }
		
		if ( isset( $ca_init_opacity ) && '1' !== $ca_init_opacity ) { $init_values['opacity']    = ( float ) $ca_init_opacity; }
	
		//Animation values
		if ( !empty( $ca_init_translate_x ) ) { $animations_values['translateX'] = ( int ) $ca_an_translate_x; }
		if ( !empty( $ca_init_translate_y ) ) { $animations_values['translateY'] = ( int ) $ca_an_translate_y; }
		if ( !empty( $ca_init_translate_z ) ) { $animations_values['translateZ'] = ( int ) $ca_an_translate_z; }
	
		if ( isset( $ca_an_scale_x ) && '1' !== $ca_init_scale_x ) { $animations_values['scaleX'] = ( float ) $ca_an_scale_x; }
		if ( isset( $ca_an_scale_y ) && '1' !== $ca_init_scale_y ) { $animations_values['scaleY'] = ( float ) $ca_an_scale_y; }
		if ( isset( $ca_an_scale_z ) && '1' !== $ca_init_scale_z ) { $animations_values['scaleZ'] = ( float ) $ca_an_scale_z; }
	
		if ( !empty( $ca_init_rotate_x ) ) { $animations_values['rotateX'] = ( int ) $ca_an_rotate_x; }
		if ( !empty( $ca_init_rotate_y ) ) { $animations_values['rotateY'] = ( int ) $ca_an_rotate_y; }
		if ( !empty( $ca_init_rotate_z ) ) { $animations_values['rotateZ'] = ( int ) $ca_an_rotate_z; }
	
		if ( isset( $ca_an_opacity ) && '1' !== $ca_init_opacity ) { $animations_values['opacity']    = ( float ) $ca_an_opacity; }	


		$opts['initValues'] = !empty( $init_values ) ? $init_values : array( 'scale' => 1 );
		$opts['animations'] = !empty( $animations_values ) ? $animations_values : array( 'scale' => 1 );
		
		return $opts;
		
	}
	
	protected function get_fit_options() {

		extract( $this->atts );

		if( !$enable_fit ) {
			return;
		}
		
		$opts = $fit_opts = array();
		$opts[] = 'data-fittext="true"';
		
		$fit_opts['compressor']  = empty( $compressor ) ? 1 : ( float )$compressor;
		$fit_opts['maxFontSize'] = empty( $maxfontsize ) ? 'currentFontSize' : $maxfontsize;
		$fit_opts['minFontSize'] = empty( $minfontsize ) ? '' : $minfontsize;

		$opts[] = 'data-fittext-options=\'' . wp_json_encode( $fit_opts ) . '\'';

		return $opts;		

	}
	
	protected function add_mask() {
		
		if( !$this->atts['use_mask'] ) {
			return;
		}

		return 'mask-text';

	}

	protected function add_bg_mask() {
		
		if( empty( $this->atts['mask_image'] ) ) {
			return;	
		}

		return 'has-mask-image';

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
		$id = '.' . $this->get_id();
		$text_font_inline_style = '';
		
		$fh_box_shadow = vc_param_group_parse_atts( $fh_box_shadow );
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}

		$elements[ liquid_implode( '%1$s ' . $tag  ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['color'] = !empty( $color ) ? $color : '';

		if ( !empty( $gradient ) ) {
			$elements[ liquid_implode( '.backgroundcliptext %1$s .ld-fh-txt'  ) ]['background'] = $gradient;
		}
		
		if( !empty( $fh_bg ) ) {
			$elements[ liquid_implode( '%1$s ' . $tag  ) ]['background'] = $fh_bg;
		}

		
		$responsive_pad = Liquid_Responsive_Param::generate_css( 'padding', $padding, $this->get_id() . ' ' . $tag );
		$elements['media']['padding'] = $responsive_pad;

		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $this->get_id() . ' ' . $tag );
		$elements['media']['margin'] = $responsive_margin;
		
		if( !empty( $line_height ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['height'] = $line_height;
		}
		if( !empty( $line_width ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['width'] = $line_width;
		}
		if( !empty( $line_offset ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['bottom'] = $line_offset;
		}
		if( !empty( $line_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['background'] = $line_color;
		}
		if( !empty( $line_roudness ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['border-radius'] = $line_roudness;
		}
		
		
		if( !empty( $highlight_height ) ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['height'] = $highlight_height;
		}
		if( !empty( $highlight_offset ) ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['bottom'] = $highlight_offset;
		}
		if( !empty( $highlight_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['background'] = $highlight_color;
		}
		if( !empty( $highlight_roudness ) ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['border-radius'] = $highlight_roudness;
		}
		
		
		
		if( !empty( $word_colors ) ) {
			$elements[ liquid_implode( '%1$s .txt-rotate-keywords') ]['color'] = $word_colors;
		}
		
		//Shadow box for fh
		if( ! empty( $fh_box_shadow ) ) {	
			$fh_box_shadow_css = $this->get_shadow_css( $fh_box_shadow );
			$elements[liquid_implode( '%1$s ' . $tag )]['box-shadow'] = $fh_box_shadow_css;

		}
		
		if( !empty( $mask_image ) ) {
			if( preg_match( '/^\d+$/', $mask_image ) ){
				$src = liquid_get_image_src( $mask_image );
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-image'] = 'url(' . esc_url( $src[0] ) . ')';
			} else {
				$src = $mask_image;
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-image'] = 'url(' . esc_url( $src ) . ')';
			}
			if( !empty( $mask_bg_size ) ) {
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-size'] = $mask_bg_size;
			}
			if( !empty( $mask_bg_repeat ) ) {
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-repeat'] = $mask_bg_repeat;
			}
			if( !empty( $mask_bg_position ) ) {
				if( 'custom' !== $mask_bg_position ) {
					$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-position'] = $mask_bg_position . ' !important';
				}
				else {
					$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-position'] = $mask_bg_pos_h . ' ' . $mask_bg_pos_v . ' !important';
				}
			}
			$elements[ liquid_implode( ' .backgroundcliptext %1$s ' . $tag ) ] = array(
				'background-clip' => 'text !important',
				'-webkit-background-clip' => 'text !important',
				'color' => 'transparent !important',
			);
		}

		$this->dynamic_css_parser( $id, $elements );
	}
	
}

new LD_Fancy_Heading;