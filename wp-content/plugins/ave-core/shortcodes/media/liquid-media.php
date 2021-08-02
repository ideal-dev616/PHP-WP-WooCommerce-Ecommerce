<?php
/**
* Shortcode Media Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Media extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_media';
		$this->title           = esc_html__( 'Media Gallery', 'ave-core' );
		$this->description     = esc_html__( 'Add media gallery container', 'ave-core' );
		$this->icon            = 'fa fa-music';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => 'ld_media_element' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'columns_gap',
				'heading'     => esc_html__( 'Columns gap', 'ave-core' ),
				'description' => esc_html__( 'Select gap between columns in row.', 'ave-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'std'         => 15
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'bottom_gap',
				'heading'     => esc_html__( 'Bottom Gap', 'ave-core' ),
				'description' => esc_html__( 'Bottom gap for blog items', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30
			),
			array(
				'type'             => 'checkbox',
				'param_name'       => 'enable_item_animation',
				'value'            => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'heading'          => esc_html__( 'Animate Media Gallery Items?', 'ave-core' ),
				'description'      => esc_html__( 'Will enable animation for items, it will be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'ave-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'ave-core' ),
			),
			array(
				'type'       => 'el_id',
				'param_name' => 'media_id',
				'settings'   => array(
					'auto_generate' => true,
				),
				'heading'     => esc_html__( 'Media ID', 'ave-core' ),
				'description' => wp_kses_post( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'ave-core' ) ),
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
			//Design Options
			array(
				'type'        => 'liquid_colorpicker', 
				'only_solid'  => true,
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Text Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for text on media element', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'overlay_bg',
				'heading'     => esc_html__( 'Overlay Background', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for overlay background on media element', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			//Custom Animation Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'pf_duration',
				'heading'     => esc_html__( 'Duration', 'ave-core' ),
				'description' => esc_html__( 'Add duration of the animation in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type' => 'textfield',
				'param_name' => 'pf_start_delay',
				'heading' => esc_html__( 'Start Delay', 'ave-core' ),
				'description' => esc_html__( 'Add start delay of the animation in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type' => 'textfield',
				'param_name' => 'pf_delay',
				'heading' => esc_html__( 'Delay', 'ave-core' ),
				'description' => esc_html__( 'Add delay of the animation between of the animated elements in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'pf_easing',
				'heading' => esc_html__( 'Easing', 'ave-core' ),
				'description' => esc_html__( 'Select an easing type', 'ave-core' ),
				'value' => array(
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
				'std' => 'easeOutQuint',
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'pf_init_values',
				'heading'     => esc_html__( 'Animate From', 'ave-core' ),
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)		
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,	
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			//Animation Values
			array(
				'type'        => 'subheading',
				'param_name'  => 'pf_animations_values',
				'heading'     => esc_html__( 'Animate To', 'ave-core' ),
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Item Animation', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),

		);

		$this->add_extras();
	}
	
	public function before_output( $atts, &$content ) {

		global $liquid_media_value;
		$liquid_media_value['unique_id'] = $atts['media_id'];
		return $atts;
		
	}
	
protected function get_options() {

		extract( $this->atts );
		
		if( !$enable_item_animation ) {
			return;
		}
		
		$animation_opts = $this->get_animation_opts();

		$opts = $split_opts = array();
		$opts[] = 'data-custom-animations="true"';
		$opts[] = 'data-ca-options=\'' . stripslashes( wp_json_encode( $animation_opts ) ) . '\'';
	
		return join( ' ', $opts );

	}
	
	protected function get_animation_opts() {

		extract( $this->atts );
		
		$opts = $init_values = $animations_values = $arr = array();
		$opts['triggerHandler'] = 'inview';
		$opts['animationTarget'] = '.ld-media-item';
		$opts['duration'] = !empty( $pf_duration ) ? $pf_duration : 700;
		if( !empty( $pf_start_delay ) ) {
			$opts['startDelay'] = $pf_start_delay;
		}
		$opts['delay'] = !empty( $pf_delay ) ? $pf_delay : 100;
		$opts['easing'] = $pf_easing;
		
		//Init values
		if ( !empty( $pf_init_translate_x ) ) { $init_values['translateX'] = ( int ) $pf_init_translate_x; }
		if ( !empty( $pf_init_translate_y ) ) { $init_values['translateY'] = ( int ) $pf_init_translate_y; }
		if ( !empty( $pf_init_translate_z ) ) { $init_values['translateZ'] = ( int ) $pf_init_translate_z; }
	
		if ( '1' !== $pf_init_scale_x ) { $init_values['scaleX'] = ( float ) $pf_init_scale_x; }
		if ( '1' !== $pf_init_scale_y ) { $init_values['scaleY'] = ( float ) $pf_init_scale_y; }
		if ( '1' !== $pf_init_scale_z ) { $init_values['scaleZ'] = ( float ) $pf_init_scale_z; }
	
		if ( !empty( $pf_init_rotate_x ) ) { $init_values['rotateX'] = ( int ) $pf_init_rotate_x; }
		if ( !empty( $pf_init_rotate_y ) ) { $init_values['rotateY'] = ( int ) $pf_init_rotate_y; }
		if ( !empty( $pf_init_rotate_z ) ) { $init_values['rotateZ'] = ( int ) $pf_init_rotate_z; }
		
		if ( isset( $pf_init_opacity ) && '1' !== $pf_init_opacity ) { $init_values['opacity'] = ( float ) $pf_init_opacity; }
	
		//Animation values
		if ( !empty( $pf_init_translate_x ) ) { $animations_values['translateX'] = ( int ) $pf_an_translate_x; }
		if ( !empty( $pf_init_translate_y ) ) { $animations_values['translateY'] = ( int ) $pf_an_translate_y; }
		if ( !empty( $pf_init_translate_z ) ) { $animations_values['translateZ'] = ( int ) $pf_an_translate_z; }
	
		if ( isset( $pf_an_scale_x ) && '1' !== $pf_init_scale_x ) { $animations_values['scaleX'] = ( float ) $pf_an_scale_x; }
		if ( isset( $pf_an_scale_y ) && '1' !== $pf_init_scale_y ) { $animations_values['scaleY'] = ( float ) $pf_an_scale_y; }
		if ( isset( $pf_an_scale_z ) && '1' !== $pf_init_scale_z ) { $animations_values['scaleZ'] = ( float ) $pf_an_scale_z; }
	
		if ( !empty( $pf_init_rotate_x ) ) { $animations_values['rotateX'] = ( int ) $pf_an_rotate_x; }
		if ( !empty( $pf_init_rotate_y ) ) { $animations_values['rotateY'] = ( int ) $pf_an_rotate_y; }
		if ( !empty( $pf_init_rotate_z ) ) { $animations_values['rotateZ'] = ( int ) $pf_an_rotate_z; }
	
		if ( isset( $pf_an_opacity ) && '1' !== $pf_init_opacity ) { $animations_values['opacity'] = ( float ) $pf_an_opacity; }	

		$opts['initValues'] = !empty( $init_values ) ? $init_values : array( 'scale' => 1 );
		$opts['animations'] = !empty( $animations_values ) ? $animations_values : array( 'scale' => 1 );
		
		return $opts;
		
	}
	
	public function generate_css() {
		
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}
		
		extract( $this->atts );
		
		$elements     = array();
		$id = '.' .$this->get_id();
		
		$text_font_inline_style = '';
		
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}

		$elements[ liquid_implode( '%1$s .ld-media-txt h3' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .ld-media-txt h3' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .ld-media-txt h3' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .ld-media-txt h3' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s .ld-media-txt h3' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';

		if( isset( $columns_gap ) && '15' !== $columns_gap ) {
			$gap = $columns_gap . 'px';
			
			$elements[ liquid_implode( '%1$s' ) ] = array(
				'margin-left' => '-' . $gap,
				'margin-right' => '-' . $gap
			);
	
			$elements[ liquid_implode( '%1$s > div' ) ] = array(
				'padding-left' => $gap,
				'padding-right' => $gap
			);
			
		}
		if( isset( $bottom_gap ) && '30' !== $bottom_gap ) { 
			$elements[ liquid_implode( '%1$s > div' ) ]['margin-bottom']  = $bottom_gap .'px';
		}
		
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s .ld-media-item-overlay' ) ]['color']  = $color;
		}
		if( !empty( $overlay_bg ) ) {
			$elements[ liquid_implode( '%1$s .ld-media-bg' ) ]['background']  = $overlay_bg;
		}


		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Media;
class WPBakeryShortCode_LD_Media extends WPBakeryShortCodesContainer {}