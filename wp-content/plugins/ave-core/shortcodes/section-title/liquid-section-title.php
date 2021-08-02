<?php

/**
* Shortcode Section Title
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Section_Title extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_section_title';
		$this->title       = esc_html__( 'Fancy Title', 'ave-core' );
		$this->description = esc_html__( 'Heading, subheading and dividers', 'ave-core' );
		$this->icon        = 'fa fa-text-height';

		parent::__construct();
	}

	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/section-title/';

		$custom_title = array(
			//Typo Options
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
				'group' => esc_html__( 'Title', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'std' => 'h2',
			),
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
				'group' => esc_html__( 'Title', 'ave-core' ),
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
				'group' => esc_html__( 'Title', 'ave-core' ),
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
				'group' => esc_html__( 'Title', 'ave-core' ),
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
				'group' => esc_html__( 'Title', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'color',
				'heading'    => esc_html__( 'Color', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Title', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'title_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Title', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
		);

		$custom_subtitle = array(
			//Typo Options
			array(
				'type'        => 'dropdown',
				'param_name'  => 'sub_tag',
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
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'std' => 'h6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'sub_fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'sub_lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'sub_fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'sub_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'sub_color',
				'heading'    => esc_html__( 'Color', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'sub_use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'sub_title_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Subtitle', 'ave-core' ),
				'dependency' => array(
					'element'            => 'sub_use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
		);

		$this->params = array_merge( 
		
			array(
				array(
					'type' => 'subheading',
					'param_name' => 'title_heading',
					'heading' => esc_html__( 'Title', 'ave-core' ),
				),
				array(
					'id'          => 'title',
					'description' => esc_html__( 'Enter text for heading line.', 'ave-core' ),
					'value'       => esc_html__( 'Hey! I am first heading line feel free to change me', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-9',
				),
				array(
					'type'        => 'checkbox',
					'param_name'  => 'use_custom_fonts_title',
					'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
					'description' => esc_html__( 'Check to use custom font for title', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'alignment',
					'heading'     => esc_html__( 'Alignment', 'ave-core' ),
					'description' => esc_html__( 'Select title alignment', 'ave-core' ),
					'value'       => array(
						esc_html__( 'Left', 'ave-core' )    => '',
						esc_html__( 'Center', 'ave-core' )  => 'text-center',
						esc_html__( 'Right', 'ave-core' )   => 'text-right',
					),
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'type' => 'liquid_slider',
					'param_name' => 'title_top_margin',
					'heading' => esc_html__( 'Title top margin', 'ave-core' ),
					'min'         => 0,
					'max'         => 50,
					'step'        => 1,
					'std'         => 10,
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'type' => 'liquid_slider',
					'param_name' => 'title_bottom_margin',
					'heading' => esc_html__( 'Title bottom margin', 'ave-core' ),
					'min'         => 0,
					'max'         => 50,
					'step'        => 1,
					'std'         => 10,
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'add_line',
					'heading'     => esc_html__( 'Add line?', 'ave-core' ),
					'description' => esc_html__( 'Add line under section title, to title or under title', 'ave-core' ),
					'value' => array(
						esc_html__( 'None', 'ave-core' ) => '',
						esc_html__( 'Section Underline', 'ave-core' ) => 'underline-fancy-title',
						esc_html__( 'Line near', 'one-ore' ) => 'title-line',
						esc_html__( 'Underline', 'ave-core' ) => 'title-underline',
						esc_html__( 'Linethrough', 'ave-core' ) => 'title-linethrough',
						esc_html__( 'Double linethrough', 'ave-core' ) => 'title-double-linethrough',
					)
				),
				array(
					'type' => 'textfield',
					'param_name' => 'line_width',
					'heading' => esc_html__( 'Line width', 'ave-core' ),
					'description' => esc_html__( 'Add line width in px, for ex. 30px', 'ave-core' ),
					'dependency' => array(
						'element' => 'add_line',
						'value' => 'underline-fancy-title'	
					),
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'type' => 'textfield',
					'param_name' => 'line_height',
					'heading' => esc_html__( 'Line height', 'ave-core' ),
					'description' => esc_html__( 'Add line height in px, for ex. 2px', 'ave-core' ),
					'dependency' => array(
						'element' => 'add_line',
						'value' => 'underline-fancy-title'	
					),
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'type' => 'textfield',
					'param_name' => 'line_radius',
					'heading' => esc_html__( 'Line Radius', 'ave-core' ),
					'description' => esc_html__( 'Add line radius in px, for ex. 30px', 'ave-core' ),
					'dependency' => array(
						'element' => 'add_line',
						'value' => 'underline-fancy-title'	
					),
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'type' => 'liquid_colorpicker',
					'only_solid' => true,
					'param_name' => 'line_color',
					'heading' => esc_html__( 'Line Color', 'ave-core' ),
					'description' => esc_html__( 'Pick color for the line', 'ave-core' ),
					'dependency' => array(
						'element' => 'add_line',
						'value' => 'underline-fancy-title'	
					),
					'edit_field_class' => 'vc_col-sm-3',
				),
			),
			
			$custom_title,
			
			array(

				array(
					'type' => 'subheading',
					'param_name' => 'sb_heading',
					'heading' => esc_html__( 'Subtitle', 'ave-core' ),
				),

				array(
					'type'       => 'textfield',
					'param_name' => 'subtitle',
					'heading'    => esc_html__( 'Subtitle', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-9',
				),

				array(
					'type'       => 'checkbox',
					'param_name' => 'use_custom_fonts_subtitle',
					'heading'    => esc_html__( 'Custom font?', 'ave-core' ),
					'description' => esc_html__( 'Check to use custom font for subtitle', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-3',
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'subtitle_transform',
					'heading'    => esc_html__( 'Subtitle Transformation', 'ave-core' ),
					'value'      => array(
						esc_html__( 'Default', 'ave-core' )    => '',
						esc_html__( 'Uppercase', 'ave-core' )  => 'text-uppercase',
						esc_html__( 'Lowercase', 'ave-core' )  => 'text-lowercase',
						esc_html__( 'Capitalize', 'ave-core' ) => 'text-capitalize',
					),
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'type' => 'liquid_slider',
					'param_name' => 'subtitle_top_margin',
					'heading' => esc_html__( 'Subtitle top margin', 'ave-core' ),
					'min'         => 0,
					'max'         => 50,
					'step'        => 1,
					'std'         => 0,
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'type' => 'liquid_slider',
					'param_name' => 'subtitle_bottom_margin',
					'heading' => esc_html__( 'Subtitle bottom margin', 'ave-core' ),
					'min'         => 0,
					'max'         => 50,
					'step'        => 1,
					'std'         => 10,
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'add_sub_line',
					'heading'     => esc_html__( 'Add line?', 'ave-core' ),
					'description' => esc_html__( 'Add line under subtitle, or near title', 'ave-core' ),
					'value' => array(
						esc_html__( 'None', 'ave-core' ) => '',
						esc_html__( 'Line near', 'one-ore' ) => 'title-line',
						esc_html__( 'Underline', 'ave-core' ) => 'title-underline',
						esc_html__( 'Linethrough', 'ave-core' ) => 'title-linethrough',
						esc_html__( 'Double linethrough', 'ave-core' ) => 'title-double-linethrough',
					)
				),

			),
			$custom_subtitle,
			array(
				array(
					'type'       => 'subheading',
					'param_name' => 'sb_heading',
					'heading'    => esc_html__( 'Secondary Options', 'ave-core' ),
				),
				array(
					'type'       => 'textarea_html',
					'param_name' => 'content',
					'heading'    => esc_html__( 'Text', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-9',
				),
				array(
					'type' => 'liquid_slider',
					'param_name' => 'text_top_margin',
					'heading' => esc_html__( 'Text top margin', 'ave-core' ),
					'min'         => 0,
					'max'         => 50,
					'step'        => 1,
					'std'         => 0,
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type' => 'liquid_slider',
					'param_name' => 'text_bottom_margin',
					'heading' => esc_html__( 'Text bottom margin', 'ave-core' ),
					'min'         => 0,
					'max'         => 50,
					'step'        => 1,
					'std'         => 0,
					'edit_field_class' => 'vc_col-sm-6',
				),
			),
			liquid_get_icon_params( false, '', 'all', array( 'color', 'hcolor', 'size', 'margin-left', 'margin-right' ), 'i_', array() ),
			array(
				array(
					'type'       => 'css_editor',
					'param_name' => 'css',
					'heading'    => esc_html__( 'CSS box', 'ave-core' ),
					'group'      => esc_html__( 'Design Options', 'ave-core' ),
				),
			)
			
		);
		
		$this->add_extras();

	}
	
	protected function get_title() {
		
		$alignment = $this->atts['alignment'];
		$title = do_shortcode( esc_html( $this->atts['title'] ) );
		$icon  = liquid_get_icon( $this->atts );
		
		$add_line = $this->atts['add_line'];
		
		$double_classname = '';
		if( 'title-double-linethrough' === $add_line ) {
			$double_classname = 'line-alt-doubled';
		}

		if( ! empty( $icon['type'] ) ) {
			if( 'left' == $icon['align'] ) {
				$title = sprintf( '<i class="%s"></i> %s', $icon['icon'], $title );
			} else {
				$title = sprintf( '%s <i class="%s"></i>', $title, $icon['icon'] );
			}
		}

		// Title
		if( $title ) {

			if( 'title-line' === $add_line ) {
				printf( '<%1$s class="lined">%2$s <i class="line"></i></%1$s>', isset( $this->atts['tag'] ) ? $this->atts['tag'] : 'h2', $title );
			}
			elseif( 'title-underline' === $add_line ) {
				printf( '<%1$s class="underlined">%2$s</%1$s>', isset( $this->atts['tag'] ) ? $this->atts['tag'] : 'h2', $title );
			}
			elseif( 'title-linethrough' === $add_line || 'title-double-linethrough' === $add_line ) {
				if( 'text-center' === $alignment ) {
					printf( '<%1$s class="lined-alt %3$s"><i class="line-alt %3$s"></i> %2$s <i class="line-alt %3$s"></i></%1$s>', isset( $this->atts['tag'] ) ? $this->atts['tag'] : 'h2', $title, $double_classname );
				}
				elseif( 'text-right' === $alignment ) {
					printf( '<%1$s class="lined-alt %3$s"><i class="line-alt %3$s"></i> %2$s</%1$s>', isset( $this->atts['tag'] ) ? $this->atts['tag'] : 'h2', $title, $double_classname );
				}
				else {
					printf( '<%1$s class="lined-alt %3$s">%2$s <i class="line-alt %3$s"></i></%1$s>', isset( $this->atts['tag'] ) ? $this->atts['tag'] : 'h2', $title, $double_classname );
				}
			}
			else {
				printf( '<%1$s>%2$s</%1$s>', isset( $this->atts['tag'] ) ? $this->atts['tag'] : 'h2', $title );
			}
			
		}
	}
	
	protected function get_subtitle() {

		if( empty( $this->atts['subtitle'] ) ) {
			return;
		}
		
		$alignment = $this->atts['alignment'];

		$transform = ! empty( $this->atts['subtitle_transform'] ) ? $this->atts['subtitle_transform'] : '';
		$subtitle = do_shortcode( $this->atts['subtitle'] );
		
		$add_line = $this->atts['add_sub_line'];
		
		$double_classname = '';
		if( 'title-double-linethrough' === $add_line ) {
			$double_classname = 'line-alt-doubled';
		}

		// Content
		if( $subtitle ) {
			if( 'title-line' === $add_line ) {
				printf( '<%1$s class="lined">%2$s <i class="line"></i></%1$s>', isset( $this->atts['sub_tag'] ) ? $this->atts['sub_tag'] : 'h6', wp_kses_post( ld_helper()->do_the_content( $subtitle, false ) ) );
			}
			elseif( 'title-underline' === $add_line ) {
				printf( '<%1$s class="underlined">%2$s</%1$s>', isset( $this->atts['sub_tag'] ) ? $this->atts['sub_tag'] : 'h6', wp_kses_post( ld_helper()->do_the_content( $subtitle, false ) ) );
			}
			elseif( 'title-linethrough' === $add_line || 'title-double-linethrough' === $add_line ) {
				if( 'text-center' === $alignment ) {
					printf( '<%1$s class="lined-alt %3$s"><i class="line-alt %3$s"></i> %2$s <i class="line-alt %3$s"></i></%1$s>', isset( $this->atts['sub_tag'] ) ? $this->atts['sub_tag'] : 'h6', wp_kses_post( ld_helper()->do_the_content( $subtitle, false ) ), $double_classname );
				}
				elseif( 'text-right' === $alignment ) {
					printf( '<%1$s class="lined-alt %3$s"><i class="line-alt %3$s"></i> %2$s</%1$s>', isset( $this->atts['sub_tag'] ) ? $this->atts['sub_tag'] : 'h6', wp_kses_post( ld_helper()->do_the_content( $subtitle, false ) ), $double_classname );
				}
				else {
					printf( '<%1$s class="lined-alt %3$s">%2$s <i class="line-alt %3$s"></i></%1$s>', isset( $this->atts['sub_tag'] ) ?$this->atts['sub_tag'] : 'h6', wp_kses_post( ld_helper()->do_the_content( $subtitle, false ) ), $double_classname );
				}
			}
			else {
				printf( '<%1$s class="%3$s">%2$s</%1$s>', $this->atts['sub_tag'], wp_kses_post( ld_helper()->do_the_content( $subtitle, false ) ), $transform  );	
			}
			
		}
	}
	
	protected function get_description() {

		if( empty( $this->atts['content'] ) ) {
			return;
		}

		$description = ld_helper()->do_the_content( $this->atts['content'], true );
		
		echo '<div class="st-desc">' . $description . '</div>';
		
	}
	
	protected function get_underline_section() {
		
		$enable = $this->atts['add_line'];
		if( 'underline-fancy-title' !== $enable ) {
			return;
		}

		return 'fancy-title-underlined';

	}

	protected function generate_css() {

		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && !empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		$title_font_inline_style = $subtitle_font_inline_style = '';
		
		//title typo
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$title_font_data = $this->get_fonts_data( $title_font );

			// Build the inline style
			$title_font_inline_style = $this->google_fonts_style( $title_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $title_font_data );

		}

		$elements[ liquid_implode( '%1$s ' . $tag  ) ] = array( $title_font_inline_style );
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['color'] = !empty( $color ) ? $color : '';
		
		//subtitle typo
		if( 'yes' !== $sub_use_theme_fonts ) {

			// Build the data array
			$subtitle_font_data = $this->get_fonts_data( $sub_title_font );

			// Build the inline style
			$subtitle_font_inline_style = $this->google_fonts_style( $subtitle_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $subtitle_font_data );

		}

		$elements[ liquid_implode( '%1$s ' . $sub_tag  ) ] = array( $subtitle_font_inline_style );
		$elements[ liquid_implode( '%1$s ' . $sub_tag  ) ]['font-size'] = !empty( $sub_fs ) ? $sub_fs : '';
		$elements[ liquid_implode( '%1$s ' . $sub_tag  ) ]['line-height'] = !empty( $sub_lh ) ? $sub_lh : '';
		$elements[ liquid_implode( '%1$s ' . $sub_tag  ) ]['font-weight'] = !empty( $sub_fw ) ? $sub_fw : '';
		$elements[ liquid_implode( '%1$s ' . $sub_tag  ) ]['letter-spacing'] = !empty( $sub_ls ) ? $sub_ls : '';
		$elements[ liquid_implode( '%1$s ' . $sub_tag  ) ]['color'] = !empty( $sub_color ) ? $sub_color : '';


		if( !empty( $hr_bg_color ) ) {
			$elements[ liquid_implode( array( '%1$s hr', '%1$s.fancy-title-thick h2:after', '%1$s.fancy-title-thick2 h2:after' ) ) ]['background-color'] = $hr_bg_color . ' !important;';
		}

		if( !empty( $icon_color ) ) {
			$elements[ '%1$s .icon']['background-color'] = $icon_color;
		}

		
		//Title Margins
		if( '10' !== $title_top_margin ) {
			$elements[ liquid_implode( array( '%1$s ' . $tag ) ) ]['margin-top'] = (int)$title_top_margin . 'px !important;';
		}
		if( '10' !== $title_bottom_margin ) {
			$elements[ liquid_implode( array( '%1$s ' . $tag ) ) ]['margin-bottom'] = (int)$title_bottom_margin . 'px !important;';
		}
		//Subtitle Margins
		if( !empty( $subtitle_top_margin ) ) {
			$elements[ liquid_implode( array( '%1$s ' . $sub_tag ) ) ]['margin-top'] = (int)$subtitle_top_margin . 'px !important;';
		}
		if( '10' !== $subtitle_bottom_margin ) {
			$elements[ liquid_implode( array( '%1$s ' . $sub_tag ) ) ]['margin-bottom'] = (int)$subtitle_bottom_margin . 'px !important;';
		}
		//Text Margins
		if( !empty( $text_top_margin ) ) {
			$elements[ liquid_implode( array( '%1$s .st-desc' ) ) ]['margin-top'] = (int)$text_top_margin . 'px !important;';
		}
		if( !empty( $text_bottom_margin ) ) {
			$elements[ liquid_implode( array( '%1$s .st-desc' ) ) ]['margin-bottom'] = (int)$text_bottom_margin . 'px !important;';
		}
		
		if( !empty( $line_width ) ) {
			$elements[ liquid_implode( array( '%1$s:after' ) ) ]['width'] = $line_width;
		}
		if( !empty( $line_height ) ) {
			$elements[ liquid_implode( array( '%1$s:after' ) ) ]['height'] = $line_height;
		}
		if( !empty( $line_radius ) ) {
			$elements[ liquid_implode( array( '%1$s:after' ) ) ]['border-radius'] = $line_radius;
		}
		if( !empty( $line_color ) ) {
			$elements[ liquid_implode( array( '%1$s:after' ) ) ]['color'] = $line_color;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}
	
}

new LD_Section_Title;