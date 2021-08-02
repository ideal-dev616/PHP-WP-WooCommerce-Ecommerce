<?php
/**
* Shortcode Counter
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Counter extends LD_Shortcode { 

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_counter';
		$this->title       = esc_html__( 'Counter', 'ave-core' );
		$this->icon        = 'fa fa-list-ol';
		$this->description = esc_html__( 'Create counter.', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/counter/';

		$this->params = array(
			
			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'ave-core' ),
				'admin_label' => true,
				'value'       => array(

					array(
						'value' => 'default',
						'label' => esc_html__( 'Default', 'ave-core' ),
						'image' => $url . 'default.jpg'
					),
					array(
						'value' => 'huge',
						'label' => esc_html__( 'Huge', 'ave-core' ),
						'image' => $url . 'huge.jpg'
					),
					array(
						'label' => esc_html__( 'Bordered', 'ave-core' ),
						'value' => 'bordered',
						'image' => $url . 'bordered.jpg'
					),
				)
			),
			
			array(
				'type'       => 'textfield',
				'param_name' => 'label',
				'heading'    => esc_html__( 'Top Label', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'bottom_label',
				'heading'    => esc_html__( 'Bottom Label', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'count',
				'heading'     => esc_html__( 'Count', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'start_delay',
				'heading'     => esc_html__( 'Start Delay', 'ave-core' ),
				'description' => esc_html__( 'Delay before counting starts in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'align',
				'heading'    => esc_html__( 'Alignment', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Left', 'ave-core' )    => 'left',
					esc_html__( 'Center', 'ave-core' )  => 'center',
					esc_html__( 'Right', 'ave-core' )   => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Extra Small', 'ave-core' ) => 'xs',
					esc_html__( 'Small', 'ave-core' )       => 'sm',
					esc_html__( 'Medium', 'ave-core' )      => 'md',
					esc_html__( 'Large', 'ave-core' )       => 'lg',
					esc_html__( 'Extra Large', 'ave-core' ) => 'xl',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'bottom_margin',
				'heading'     => esc_html__( 'Bottom Margin', 'ave-core' ),
				'description' => esc_html__( 'Set bottom margin for counter', 'ave-core' ),
				'min'         => 0,
				'max'         => 30,
				'step'        => 1,
				'std'         => 0
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Counter custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for counter', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_text',
				'heading'     => esc_html__( 'Text custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for text', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_blur',
				'heading'     => esc_html__( 'Enable Blur effect', 'ave-core' ),
				'description' => esc_html__( 'Enable blur effect on counter digits. Can affect on scrolling performance', 'ave-core' ),
			),
			
			//Counter Typo Options
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
				'group' => esc_html__( 'Counter Typography', 'ave-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'ave-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'ave-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for counter theme default font family?', 'ave-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Counter Typography', 'ave-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'ave-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			//Text Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_fs',
				'heading'     => esc_html__( 'Font Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typography', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_lh',
				'heading'     => esc_html__( 'Line-Height', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typography', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_fw',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typography', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typography', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for counter theme default font family?', 'ave-core' ),
				'param_name'  => 'text_use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'ave-core' ),
				'group' => esc_html__( 'Text Typography', 'ave-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'ave-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'ave-core' ),
					),
				),
				'group' => esc_html__( 'Text Typography', 'ave-core' ),
				'dependency' => array(
					'element'            => 'text_use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			
			//Design options
			array(	
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'text_color',
				'heading'    => esc_html__( 'Title Color', 'ave-core' ),
				'description' => esc_html__( 'Choose a color for the title of the counter, leave empty for default color.', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(	
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'counter_color',
				'heading'    => esc_html__( 'Counter Color', 'ave-core' ),
				'description' => esc_html__( 'Choose a color for the counter, leave empty for default color.', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_gradient',
				'heading'     => esc_html__( 'Enable Gradient?', 'ave-core' ),
				'description' => esc_html__( 'If enabled will display gradient color for counter, will disable Counter Color', 'ave-core' ),
				'value' => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'save_always' => true,
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'start_color',
				'heading'    => esc_html__( 'Start Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_gradient',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'end_color',
				'heading'    => esc_html__( 'End Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_gradient',
					'value' => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_hover_gradient',
				'heading'     => esc_html__( 'Enable Hover Gradient?', 'ave-core' ),
				'description' => esc_html__( 'If enabled will display hover gradient color for counter, will disable Counter Color', 'ave-core' ),
				'value' => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'save_always' => true,
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_start_color',
				'heading'    => esc_html__( 'Hover Start Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_hover_gradient',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_end_color',
				'heading'    => esc_html__( 'Hover End Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_hover_gradient',
					'value' => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			)
			
			

		);

		$this->add_extras();
	}

	protected function get_class( $style ) {

		$hash = array(
			'default'  => 'liquid-counter liquid-counter-default',
			'huge'     => 'liquid-counter liquid-counter-huge',
			'bordered' => 'liquid-counter liquid-counter-bordered liquid-counter-bold'
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : $hash['default'];
	}
	
	protected function get_data_options() {
		
		$opts = array();
		$counter = $this->atts['count'];
		$start_delay = $this->atts['start_delay'];
		$blur    = $this->atts['enable_blur'];
		
		if( ! empty( $counter ) ) {
			$opts['targetNumber'] = esc_html( $counter );	
		}
		if( ! empty( $start_delay ) ) {
			$opts['startDelay'] = esc_html( $start_delay );	
		}
		if( $blur ) {
			$opts['blurEffect'] = true;
		}
		else {
			$opts['blurEffect'] = false;
		}
		
		return 'data-counter-options=\'' . wp_json_encode( $opts ) . '\'';
		
	}
	
	protected function get_count() {
		
		$counter = $this->atts['count'];

		if ( empty( $counter ) ) {
			return;
		}
		
		printf( '<span>%s</span>', esc_html( $counter ) );
	}
	
	protected function get_static_gradient() {
		
		$start_color = $this->atts['start_color'];
		$end_color   = $this->atts['end_color'];
		$counter     = $this->atts['count'];
		
		if( !empty( $start_color ) && !empty( $end_color ) && !empty( $counter ) ) {
			printf( '<div class="liquid-counter-element liquid-counter-element-static"><span>%s</span></div>', $counter );
		}

	}
	
	protected function get_hover_gradient() {
		
		$start_color = $this->atts['hover_start_color'];
		$end_color   = $this->atts['hover_end_color'];
		$counter     = $this->atts['count'];
		
		if( !empty( $start_color ) && !empty( $end_color ) && !empty( $counter ) ) {
			printf( '<div class="liquid-counter-element liquid-counter-element-hover"><span>%s</span></div>', $counter );
		}

	}
	
	protected function get_static_gradient_classname() {
		
		$start_color = $this->atts['start_color'];
		$end_color   = $this->atts['end_color'];
		$counter     = $this->atts['count'];
		
		if( !empty( $start_color ) && !empty( $end_color ) && !empty( $counter ) ) {
			return 'liquid-counter-has-gradient';
		}

	}
	
	protected function get_hover_gradient_classname() {
		
		$start_color = $this->atts['hover_start_color'];
		$end_color   = $this->atts['hover_end_color'];
		$counter     = $this->atts['count'];
		
		if( !empty( $start_color ) && !empty( $end_color ) && !empty( $counter ) ) {
			return 'liquid-counter-has-hover-gradient';
		}

	}


	protected function get_size() {
		
		$size = $this->atts['size'];
		
		if( empty( $size ) ) {
			return;
		}

		return "liquid-counter-$size";
	}
	
	protected function get_align() {
		
		$align = $this->atts['align'];
		
		if( empty( $align ) ) {
			return;
		}
		
		if( 'left' === $align ) {
			return 'text-left';
		}
		elseif( 'center' === $align ) {
			return 'text-center';	
		}
		elseif( 'right' === $align ) {
			return 'text-right';
		}

	}
	
	protected function get_counter_align() {
		
		$align = $this->atts['align'];
		
		if( empty( $align ) ) {
			return;
		}
		
		if( 'left' === $align ) {
			return 'align-items-start';
		}
		elseif( 'center' === $align ) {
			return 'align-items-center';	
		}
		elseif( 'right' === $align ) {
			return 'align-items-right';
		}

	}

	protected function get_top_text() {
		
		$label = $this->atts['label'];
		
		if ( empty( $label ) ) {
			return;
		}

		printf( '<span class="liquid-counter-text liquid-text-top">%s</span>', esc_html( $label ) );

	}
	
	protected function get_bottom_text() {		

		$bottom_label = $this->atts['bottom_label'];
		
		if ( empty( $bottom_label ) ) {
			return;
		}

		printf( '<span class="liquid-counter-text liquid-text-bottom">%s</span>', esc_html( $bottom_label ) );

	}

	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		$text_font_inline_style = '';
		$text_text_font_inline_style = '';

		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}
		if( 'yes' !== $text_use_theme_fonts ) {

			// Build the data array
			$text_text_font_data = $this->get_fonts_data( $text_text_font );

			// Build the inline style
			$text_text_font_inline_style = $this->google_fonts_style( $text_text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_text_font_data );

		}
		
		$elements[ liquid_implode( '%1$s .liquid-counter-element' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .liquid-counter-element' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .liquid-counter-element' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .liquid-counter-element' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s .liquid-counter-element' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		$elements[ liquid_implode( '%1$s .liquid-text-bottom' ) ] = array( $text_text_font_inline_style );
		$elements[ liquid_implode( '%1$s .liquid-text-bottom' ) ]['font-size'] = !empty( $text_fs ) ? $text_fs : '';
		$elements[ liquid_implode( '%1$s .liquid-text-bottom' ) ]['line-height'] = !empty( $text_lh ) ? $text_lh : '';
		$elements[ liquid_implode( '%1$s .liquid-text-bottom' ) ]['font-weight'] = !empty( $text_fw ) ? $text_fw : '';
		$elements[ liquid_implode( '%1$s .liquid-text-bottom' ) ]['letter-spacing'] = !empty( $text_ls ) ? $text_ls : '';
		
		if( $enable_gradient ) {
			if( !empty( $start_color ) && !empty( $end_color ) ) {
				$elements[ liquid_implode( array( '.backgroundcliptext %1$s > .liquid-counter-element > span, .backgroundcliptext %1$s .liquid-counter-element-static' ) ) ] = array (
					'background' => '-webkit-gradient(linear, left top, right top, from(' . esc_attr( $start_color ) . '), to(' . $end_color . '))',
					'background-clip' => 'text !important',
					'-webkit-background-clip' => 'text !important',
					'text-fill-color' => 'transparent !important',
					'-webkit-text-fill-color' => 'transparent !important'
				);
			}
		}
		elseif( !empty( $counter_color ) ) {
			$elements[ liquid_implode( '.backgroundcliptext %1$s > .liquid-counter-element > span' ) ] = array(
				'color' => $counter_color
			);
		}
		if( $enable_hover_gradient ) {
			if( !empty( $hover_start_color ) && !empty( $hover_end_color ) ) {
			$elements[ liquid_implode( array( '.backgroundcliptext %1$s .liquid-counter-element-hover' ) ) ] = array(
				'background' => '-webkit-gradient(linear, left top, right top, from(' . esc_attr( $hover_start_color ) . '), to(' . $hover_end_color . '))',
				'background-clip' => 'text !important',
				'-webkit-background-clip' => 'text !important',
				'text-fill-color' => 'transparent !important',
				'-webkit-text-fill-color' => 'transparent !important'
			);
			}
		}	
		if( !empty( $text_color ) ) {
			$elements[ liquid_implode( '%1$s .liquid-counter-text' ) ]['color'] = esc_attr( $text_color );
		}
		if( $bottom_margin ) {
			$elements[ liquid_implode( '%1$s > .liquid-counter-element' ) ]['margin-bottom'] = esc_attr( $bottom_margin ) . 'px';
		}


		$this->dynamic_css_parser( $id, $elements );

	}
	
}

new LD_Counter;