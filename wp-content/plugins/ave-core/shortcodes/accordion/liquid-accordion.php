<?php

/**
* Shortcode Accordion
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Accordion extends LD_Shortcode {
	
	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'vc_accordion';
		$this->title         = esc_html__( 'Accordion', 'ave-core' );
		$this->icon          = 'fa fa-navicon';
		$this->description   = esc_html__( 'Create an accordion.', 'ave-core' );
		$this->is_container  = true;
		$this->show_settings_on_create = false;
		$this->js_view       = 'VcAccordionView';
		$this->custom_markup = '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>';
		$this->default_content = '
			[vc_accordion_tab title="' . sprintf( '%s %d', 'Section', 1 ) . '"][/vc_accordion_tab]
			[vc_accordion_tab title="' . sprintf( '%s %d', 'Section', 2 ) . '"][/vc_accordion_tab]';

		parent::__construct();

	}
	
	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array_merge(

			array(

				array(
					'type'        => 'textfield',
					'param_name'  => 'active_tab',
					'heading'     => esc_html__( 'Active tab', 'ave-core' ),
				),
				
				array(
					'type'       => 'dropdown',
					'param_name' => 'size',
					'heading'    => esc_html__( 'Title Height', 'ave-core' ),
					'value'      => array(
						esc_html__( 'Shortest', 'ave-core' ) => 'xs',
						esc_html__( 'Short', 'ave-core' )    => 'sm',
						esc_html__( 'Medium', 'ave-core' )   => 'md',
						esc_html__( 'Tall', 'ave-core' )     => 'lg',
					),
					'std' => 'md',
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'active_style',
					'heading'     => esc_html__( 'Active state style', 'ave-core' ),
					'value'       => array(
						esc_html__( 'Default', 'ave-core' ) => '',
						esc_html__( 'Fill', 'ave-core' )    => 'fill',
						esc_html__( 'Shadow', 'ave-core' )  => 'shadow',
						esc_html__( 'Fill and Shadow', 'ave-core' ) => 'fill_shadow',
					),
					'edit_field_class' => 'vc_col-sm-6'
				),
				
				array(
					'type'       => 'dropdown',
					'param_name' => 'borders',
					'heading'    => esc_html__( 'Border style', 'ave-core' ),
					'value'      => array(
						esc_html__( 'None', 'ave-core' )  => '',
						esc_html__( 'Title Bordered', 'ave-core' )     => 'accordion-title-bordered',
						esc_html__( 'Title Underlined', 'ave-core' )   => 'accordion-title-underlined',
						esc_html__( 'Content Underlined', 'ave-core' ) => 'accordion-body-underlined',
						esc_html__( 'Content Bordered', 'ave-core' )   => 'accordion-body-bordered',
					),
					'edit_field_class' => 'vc_col-sm-6'
				),
				
				array(
					'type'       => 'dropdown',
					'param_name' => 'border_round',
					'heading'    => esc_html__( 'Border Round', 'ave-core' ),
					'value'      => array(
						esc_html__( 'None', 'ave-core' )  => '',
						esc_html__( 'Round', 'ave-core' )  => 'accordion-title-round',
						esc_html__( 'Circle', 'ave-core' ) => 'accordion-title-circle',
					),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'borders',
						'value'   => 'accordion-title-bordered'
					),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'bottom_margin',
					'heading'     => esc_html__( 'Bottom Margin', 'ave-core' ),
					'description' => esc_html__( 'Example: 20px', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'checkbox',
					'param_name'  => 'use_custom_fonts_title',
					'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
					'description' => esc_html__( 'Check to use custom font for title', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Typo', 'ave-core' ),
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
				'group' => esc_html__( 'Typo', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
				array(
					'type'        => 'checkbox',
					'param_name'  => 'show_icon',
					'heading'     => esc_html__( 'Icons?', 'ave-core' ),
					'description' => esc_html__( 'If enabled will show icons in expander', 'ave-core' ),
					'value'       => array( esc_html__( ' Yes', 'ave-core' ) => 'yes' ),
				),

				array(
					'type'       => 'checkbox',
					'param_name' => 'i_add_icon',
					'heading'    => esc_html__( 'Add icon?', 'ave-core' ),
					'description' => esc_html__( 'Normal state of the panel', 'ave-core' ),
					'group'      => esc_html__( 'Icon', 'ave-core' ),
					'value'      => '',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'expander_position',
					'heading'    => esc_html__( 'Expander position', 'ave-core' ),
					'value'      => array(
						esc_html__( 'Default', 'ave-core' ) => '',
						esc_html__( 'Left', 'ave-core' )    => 'accordion-expander-left',
					),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'expander_size',
					'heading'    => esc_html__( 'Expander Size', 'ave-core' ),
					'value'      => array(
						esc_html__( 'Normal', 'ave-core' ) => '',
						esc_html__( 'Large ( 22px )', 'ave-core' )    => 'accordion-expander-lg',
						esc_html__( 'xLarge ( 26px )', 'ave-core' )    => 'accordion-expander-xl',
					),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),
			),

			liquid_get_icon_params( 'manual', esc_html__( 'Icon', 'ave-core' ), 'all', array( 'align', 'color', 'size', 'hcolor' ) ),

			array(

				array(
					'type'       => 'checkbox',
					'param_name' => 'active_add_icon',
					'heading'    => esc_html__( 'Add icon?', 'ave-core' ),
					'description' => esc_html__( 'Active state of the panel', 'ave-core' ),
					'group'      => esc_html__( 'Icon', 'ave-core' ),
					'value'      => '',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),

			),

			liquid_get_icon_params( 'manual', esc_html__( 'Icon', 'ave-core' ), 'all', array( 'align', 'color', 'size', 'hcolor' ), 'active_' ),

			array(

				//Headings colors
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'heading_color',
					'heading'     => esc_html__( 'Color', 'ave-core' ),
					'description' => esc_html__( 'Heading normal state', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'active_heading_color',
					'heading'     => esc_html__( 'Active Color', 'ave-core' ),
					'description' => esc_html__( 'Heading active state', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),

				//BG colors				
				array( 
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'bg_color',
					'heading'     => esc_html__( 'Background Color', 'ave-core' ),
					'description' => esc_html__( 'Background color for heading', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'active_style',
						'value'   => array( 'fill',  'fill_shadow' )
					),
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'active_bg_color',
					'heading'     => esc_html__( 'Active Background Color', 'ave-core' ),
					'description' => esc_html__( 'Background color for active heading', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'active_style',
						'value'   => array( 'fill',  'fill_shadow' )
					),
				),
				
				//Border color
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'border_color',
					'heading'     => esc_html__( 'Border Color', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'active_border_color',
					'heading'     => esc_html__( 'Active Border Color', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				
				//Expander color
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'exp_color',
					'heading'     => esc_html__( 'Expander Color', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'active_exp_color',
					'heading'     => esc_html__( 'Active Expander Color', 'ave-core' ),
					'group'       => esc_html__( 'Design', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),

				
			)
		);

		$this->add_extras();
	}
	
	public function before_output( $atts, &$content ) {

		global $liquid_accordion_tabs;

		$liquid_accordion_tabs = array();

		//parse vc_accordion_tab shortcode
		do_shortcode( $content );

		$atts['items'] = $liquid_accordion_tabs;

		return $atts;
	}
	
	//Method to get size classname of the accordion	
	protected function get_size() {
		
		$size = $this->atts['size'];
		
		if( empty( $size ) ) {
			return;
		}
		
		return 'accordion-' . $size;
	}

	protected function get_active_style() {
		
		$active_style = $this->atts['active_style'];
		$active_style_arr = array(
			'fill'   => 'accordion-active-has-fill',
			'shadow' => 'accordion-active-has-shadow',
			'fill_shadow' => 'accordion-active-has-fill accordion-active-has-shadow',
		);

		if( empty( $active_style ) ) {
			return;
		}

		return $active_style_arr[ $active_style ];		
	}


	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		$text_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}

		$elements[ liquid_implode( '%1$s .accordion-title'  ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .accordion-title'  ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .accordion-title' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .accordion-title'  ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s .accordion-title'  ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		//Heading color
		if( ! empty( $heading_color ) && isset( $heading_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-title a' ) ]['color'] = $heading_color;
		}
		if( ! empty( $active_heading_color ) && isset( $active_heading_color ) ) {
			$elements[ liquid_implode( '%1$s .active .accordion-title a' ) ]['color'] = $active_heading_color;
		}

		//BG Color
		if( ! empty( $bg_color ) && isset( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-title a' ) ]['background'] = $bg_color;
		}
		if( ! empty( $active_bg_color ) && isset( $active_bg_color ) ) {
			$elements[ liquid_implode( '%1$s .active .accordion-title a' ) ]['background'] = $active_bg_color;
		}
		
		//Border color		
		if( ! empty( $border_color ) && isset( $border_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-title a, %1$s .accordion-item' ) ]['border-color'] = $border_color;
		}
		if( ! empty( $active_border_color ) && isset( $active_border_color ) ) {
			$elements[ liquid_implode( '%1$s .active .accordion-title a, %1$s .accordion-item.active' ) ]['border-color'] = $active_border_color;
		}
		if( !empty( $bottom_margin ) ) {
			$elements[ liquid_implode( '%1$s .accordion-item:not(:last-child)' ) ]['margin-bottom'] = $bottom_margin;
		}
		
		//Expander color		
		if( ! empty( $exp_color ) && isset( $exp_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-expander' ) ]['color'] = $exp_color;
		}
		if( ! empty( $active_exp_color ) && isset( $active_exp_color ) ) {
			$elements[ liquid_implode( '%1$s .active .accordion-expander' ) ]['color'] = $active_exp_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}


	
}
new LD_Accordion;

//Accordion Tab
include_once 'liquid-accordion-tab.php';