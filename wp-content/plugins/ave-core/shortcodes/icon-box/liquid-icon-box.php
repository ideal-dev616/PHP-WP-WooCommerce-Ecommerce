<?php
/**
* Shortcode Icon box
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Icon_Box extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_icon_box';
		$this->title       = esc_html__( 'Icon Box', 'ave-core' );
		$this->description = esc_html__( 'Create an icon box.', 'ave-core' );
		$this->icon        = 'fa fa-flash';
		$this->scripts      = array( 'jquery-vivus' );
		$this->styles       = array( 'fresco', 'lity' );
		
		add_filter( 'https_ssl_verify', '__return_false' );

		parent::__construct();
	}
	
	public function get_params() {

		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'ave-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow'
				),
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);
		
		$params = array(
		
			array(
				'id' => 'title',
				'group' => esc_html__( 'Content', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'title_mb',
				'heading'     => esc_html__( 'Heading Margin Bottom', 'ave-core' ),
				'description' => esc_html__( 'Add bottom margin to the title', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'group' => esc_html__( 'Content', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_size',
				'heading'    => esc_html__( 'Title Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Extra Small (18px)', 'ave-core' ) => 'xs',
					esc_html__( 'Small (20px)', 'ave-core' )       => 'sm',
					esc_html__( 'Medium (24px)', 'ave-core' )      => 'md',
					esc_html__( 'Large (28px)', 'ave-core' )       => 'lg',
					esc_html__( 'Custom', 'ave-core' )             => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Content', 'ave-core' ),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'custom_heading_size',
				'heading'    => esc_html__( 'Custom title size', 'ave-core' ),
				'description' => esc_html__( 'Add custom title size with px. for ex. 35px' ),
				'dependency' => array(
					'element' => 'heading_size',
					'value'   => 'custom'	
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Content', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'ave-core' )    => 'font-weight-normal',
					esc_html__( 'Semi Bold', 'ave-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'ave-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Content', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'alignment',
				'heading'    => esc_html__( 'Alignments', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Left', 'ave-core' )    => 'text-left',
					esc_html__( 'Right', 'ave-core' )   => 'text-right'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Content', 'ave-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Content', 'ave-core' ),
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Content', 'ave-core' ),
				'group' => esc_html__( 'Content', 'ave-core' )
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Label', 'ave-core' ),
				'description' => esc_html__( 'Add label to icon box', 'ave-core' ),
				'group'       => esc_html__( 'Content', 'ave-core' )
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'toggleable',
				'heading'    => esc_html__( 'Show Content on hover', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'group' => esc_html__( 'Content', 'ave-core' ),
			),
			
		);
		
		$icon = liquid_get_icon_params( false, null, 'all', array( 'align', 'color', 'hcolor', 'size' ), 'i_' );
		
		$svg_params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'animation',
				'heading'    => esc_html__( 'Animate SVG Icon?', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'animated',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'hover_animation',
				'heading'    => esc_html__( 'Restart Animation on Hover', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'animated',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'animation_delay',
				'heading'    => esc_html__( 'SVG Animation Delay In Milliseconds', 'ave-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'animated',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);
		
		$styling_params = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Icon Properties', 'ave-core' )
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'icon_size',
				'heading'     => esc_html__( 'Icon size', 'ave-core' ),
				'description' => esc_html__( 'Add font icon size with px, for ex. 24px', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_type',
					'value'   => array( 'fontawesome', 'linea' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_size',
				'heading'     => esc_html__( 'Custom size', 'ave-core' ),
				'description' => esc_html__( 'Add icon custom size with px, for ex. 45px', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_type',
					'value'   => array( 'animated' ),
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'icon_mb',
				'heading'     => esc_html__( 'Icon margin', 'ave-core' ),
				'description' => esc_html__( 'Add margin to the icon', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_shape',
				'heading'    => 'Shape',
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Square', 'ave-core' )  => 'square',
					esc_html__( 'Circle', 'ave-core' )  => 'circle',
					esc_html__( 'Lozenge', 'ave-core' ) => 'lozenge',
					esc_html__( 'Hexagon', 'ave-core' ) => 'hexagon',
					esc_Html__( 'Wavebg', 'ave-core' )  => 'wavebg',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'i_shape_border_radius',
				'heading'     => esc_html__( 'Border Radius', 'ave-core' ),
				'description' => esc_html__( 'Add border radiuse to square shape', 'ave-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square' ),
				),
				'edit_field_class' => 'vc_col-sm-8'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_i_size',
				'heading'     => esc_html__( 'Custom size', 'ave-core' ),
				'description' => esc_html__( 'Add shape custom size with px, for ex. 45px', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_size',
				'heading'    => esc_html__( 'Shape Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Extra Small (45px)', 'ave-core' ) => 'xs',
					esc_html__( 'Small (60px)', 'ave-core' )       => 'sm',
					esc_html__( 'Medium (90px)', 'ave-core' )      => 'md',
					esc_html__( 'Large (100px)', 'ave-core' )       => 'lg',
					esc_html__( 'Extra Large (125px)', 'ave-core' ) => 'xl',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),			
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon Position', 'ave-core' ),
				'param_name' => 'position',
				'value'      => array(
					esc_html__( 'Icon On Top', 'ave-core' )        => '',
					esc_html__( 'Heading Inline', 'ave-core' ) => 'iconbox-inline',
					esc_html__( 'Content Inline', 'ave-core' ) => 'iconbox-side'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon Shape Borders', 'ave-core' ),
				'param_name' => 'i_border',
				'value'      => array(
					esc_html__( 'None', 'ave-core' ) => '',
					esc_html__( '1', 'ave-core' )    => 1,
					esc_html__( '2', 'ave-core' )    => 2,
					esc_html__( '3', 'ave-core' )    => 3,
				),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon Ripple effect', 'ave-core' ),
				'param_name' => 'i_ripple_effect',
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes',
				),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icons Linked', 'ave-core' ),
				'description' => esc_html__( 'Add line between icons. ( works with icon shape "Circle" only', 'ave-core' ),
				'param_name' => 'i_linked',
				'value'      => array(
					esc_html__( 'None', 'ave-core' ) => '',
					esc_html__( 'Yes', 'ave-core' )  => 'iconbox-icon-linked',
				),
				'dependency'       => array(
					'element' => 'position',
					'value'   => array( 'iconbox-side' )
				),
				'edit_field_class' => 'vc_col-sm-9'
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_iconbox_link',
				'heading'    => esc_html__( 'Iconbox Link', 'ave-core' )
			),
			array(
				'id' => 'link',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'localscroll_link',
				'heading'     => esc_html__( 'Localscroll?', 'ave-core' ),
				'description' => esc_html__( 'Enable localscroll link', 'ave-core' ),
				'value' => 'yes',
				'edit_field_class' => 'vc_col-sm-6',
			),
		);
		
		//Design Options
		$design_params = array(
			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'ave-core' ),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'only_solid'       => true,
				'param_name'       => 'i_color',
				'heading'          => esc_html__( 'Icon Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'i_color2',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Icon Color 2', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_i_color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Hover Icon Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_i_color2',
				'only_solid'       => true,				
				'heading'          => esc_html__( 'Hover Icon Color 2', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Heading Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_color2',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Heading Color 2', 'ave-core' ),
				'description' => esc_html__( 'Pick a second color to make heading gradient', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'heading_gradient',
					'value'   => 'iconbox-heading-gradient',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_hcolor',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Hover Heading Color', 'ave-core' ),
				'description' => esc_html__( 'Pick heading color for hover state', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'heading_gradient',
				'heading'     => esc_html__( 'Enable Heading Gradient?', 'ave-core' ),
				'description' => esc_html__( 'Enable gradient color to the heading', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'iconbox-heading-gradient'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'shape_color',
				'heading'          => esc_html__( 'Shape Fill Color', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'shape_hcolor',
				'heading'          => esc_html__( 'Hover Shape Fill Color', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'only_solid'       => true,
				'param_name'       => 'border_shape_color',
				'heading'          => esc_html__( 'Shape Border Color', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_border',
					'value'   => array( '1', '2', '3' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'only_solid'       => true,
				'param_name'       => 'border_shape_hcolor',
				'heading'          => esc_html__( 'Hover Shape Border Color', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_border',
					'value'   => array( '1', '2', '3' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'shape_hexagon_color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Shape Fill Color', 'ave-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'hexagon' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'fill',
				'heading'     => esc_html__( 'Enable Fill?', 'ave-core' ),
				'description' => esc_html__( 'Enable to add background color to the icon box', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'          => 'liquid_colorpicker',
				'param_name'    => 'fill_color',
				'heading'       => esc_html__( 'Fill Color', 'one-color' ),
				'dependency'    => array(
					'element'   => 'fill',
					'not_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'border_radius',
				'heading'    => esc_html__( 'Border Radius', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )    => '',
					esc_html__( 'Semi Round', 'ave-core' ) => 'iconbox-semiround',
					esc_html__( 'Round', 'ave-core' )      => 'iconbox-round',
				),
				'dependency'    => array(
					'element'   => 'fill',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'hover_fill',
				'heading'     => esc_html__( 'Enable Hover Fill?', 'ave-core' ),
				'description' => esc_html__( 'Enable to add background color to the hover state of the icon box', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'hover_bg_image',
				'heading'     => esc_html__( 'Hover Background Image', 'ave-core' ),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'          => 'liquid_colorpicker',
				'param_name'    => 'hover_fill_color',
				'heading'       => esc_html__( 'Hover Fill Color', 'one-color' ),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'          => 'liquid_colorpicker',
				'only_solid'    => true,
				'param_name'    => 'hover_text_color',
				'heading'       => esc_html__( 'Hover Text Color', 'one-color' ),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'scale_bg',
				'heading'     => esc_html__( 'Enable Scale bg?', 'ave-core' ),
				'description' => esc_html__( 'Enable scale background on hover state of the icon box', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'iconbox-scale-bg'
				),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'shadow',
				'heading'    => esc_html__( 'Shadow', 'ave-core' ),
				'value'      => array(
					esc_html__( 'None', 'ave-core' )              => '',
					esc_html__( 'Box Shadow', 'ave-core' )        => 'iconbox-shadow',
					esc_html__( 'Hover Box Shadow', 'ave-core' )  => 'iconbox-shadow-hover',
					esc_html__( 'Icon Shadow', 'ave-core' )       => 'iconbox-icon-shadow',
					esc_html__( 'Hover Icon Shadow', 'ave-core' ) => 'iconbox-icon-hover-shadow',
				)
			),
			
		);
		foreach( $design_params as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'ave-core' );
		}

		$this->params = array_merge( $icon, $svg_params, $params, $styling_params, $design_params, $button );

		$this->add_extras();
	
	}
	
	protected function get_shape() {
		
		$shape = $this->atts['i_shape'];
		if( empty( $shape ) ) {
			return;
		}

		return 'iconbox-' . $shape;

	}
	
	protected function get_the_label() {
		
		$label = $this->atts['label'];
		if( empty( $label ) ) {
			return;
		}

		printf( '<span class="iconbox-label">%s</span>', esc_html( $label ) );

	}
	
	protected function get_overlay_link() {
		
		$link = liquid_get_link_attributes( $this->atts['link'], false );
		
		if( empty( $link['href']) ) {
			return;
		}
		$link['class'] = 'liquid-overlay-link z-index-2';
		if( !empty($this->atts['localscroll_link']) ) {
			$link['data-localscroll'] = 'true';	
		}

		echo '<a'. ld_helper()->html_attributes( $link ) .'></a>';
		
	}
	
	protected function get_svg_attributes() {
		
		$attributes = $svg = array();
		$color  = $color2 = $hcolor = $hcolor2 = '';
		$enable = $this->atts['animation'];
		
		if( !empty( $enable ) ) {
			$attributes['data-animate-icon'] = true;	
			if ( !empty( $this->atts['animation_delay'] ) ) {
				$svg['delay'] = $this->atts['animation_delay'];
			}
			if( 'yes' === $this->atts['hover_animation'] ) {
				$svg['resetOnHover'] = true;
			}
		}

		if( !empty( $this->atts['i_color'] ) ) {
			$color = $this->atts['i_color'];	
		}
		if( !empty( $this->atts['i_color2'] ) && !empty( $this->atts['i_color'] ) ) {
			$color2 = ':' . $this->atts['i_color2'];
		}
		if( !empty( $this->atts['i_color2'] ) || !empty( $this->atts['i_color'] ) ) {
			$svg['color'] = $color . $color2;	
		}

		if( !empty( $this->atts['h_i_color'] ) ) {
			$hcolor = $this->atts['h_i_color'];
		}
		if ( !empty( $this->atts['h_i_color2'] ) && !empty( $this->atts['h_i_color'] ) ) {
			 $hcolor2 = ':' . $this->atts['h_i_color2'];
		}
		if ( !empty( $this->atts['h_i_color2'] ) || !empty( $this->atts['h_i_color'] ) ) {
			$svg['hoverColor'] = $hcolor . $hcolor2;
		}

		if ( !empty( $svg ) ) {
			$attributes['data-plugin-options'] = wp_json_encode( $svg );
		}
		
		
		return $attributes;
		
	}
	
	protected function get_border_opts() {
		
		$border = $this->atts['i_border'];
		if( empty( $border ) ) {
			return;
		}

		return 'data-shape-border="' . $border . '"';		
	}
	
	protected function get_fill() {
		
		$enable = $this->atts['fill'];
		if( empty( $enable ) ) {
			return;
		}
		
		return 'iconbox-filled';
	}
	
	protected function get_ripple_classnames() {

		$enable = $this->atts['i_ripple_effect'];
		if( empty( $enable ) ) {
			return;
		}		

		return 'iconbox-icon-ripple';	
	}
	
	protected function get_hover_fill() {
		
		$enable = $this->atts['hover_fill'];
		if( empty( $enable ) ) {
			return;
		}

		return 'iconbox-filled iconbox-filled-hover';
		
	}
	
	protected function get_svg_shape() {

		$shape = $this->atts['i_shape'];
		if( 'wavebg' !== $shape ) {
			return'';
		}		

		echo '<span class="icon-wave-bg">
					<svg xmlns="http://www.w3.org/2000/svg" width="125.062" height="88.62" viewBox="0 0 125.062 88.62">
						<path d="M488.806,2544.02s35.988-16.17,53.518-7.45S565,2541.44,574,2549s18.09,19.21,14.009,41.12c-3.62,19.44-25.466,15.87-37.2,27.79-10.557,10.72-68.616,1.88-74.4-12.88-6.841-17.45-13.114-17.84-12.406-34.03C464.452,2560.66,475.315,2554.71,488.806,2544.02Z" transform="translate(-463.938 -2534)"/>
					</svg>
				</span>';
	}
	
	protected function get_size() {

		$size = $this->atts['i_size'];
		if( empty( $size ) ) {
			return;
		}

		return 'iconbox-' . $size;

	}
	
	protected function get_image_icon_classname() {
		
		$icon = liquid_get_icon( $this->atts );
		if( 'image' === $icon['type'] ) {
			return 'iconbox-icon-image';
		}
		return'';

	}
	
	protected function get_the_icon() {

		$attributes = array(
			'class' => 'iconbox-icon-container'
		);
		
		echo  '<div class="iconbox-icon-wrap">';
		printf('<span%s>', ld_helper()->html_attributes( $attributes ) );

		if( !empty( $this->atts['shape_hcolor'] ) ) {
			echo '<span class="iconbox-icon-hover-bg"></span>';
		}
		
		$this->get_svg_shape();
		$icon = liquid_get_icon( $this->atts );
		
		if( ! empty( $icon['type'] ) ) {			
			if( 'image' === $icon['type'] || 'animated' === $icon['type'] ) {
				$filetype = wp_check_filetype( $icon['src'] );
				if( 'svg' === $filetype['ext'] ) {
					$request  = wp_remote_get( $icon['src'] );
					$response = wp_remote_retrieve_body( $request );
					$svg_icon = $response;

					echo $svg_icon;
				} 
				else {
					printf( '<img src="%s" class="liquid-image-icon" />', esc_url( $icon['src'] ) );
				}
			}
			else {
				printf( '<i class="%s"></i>', $icon['icon'] );
			}
		}

		echo '</span>';
		echo  '</div><!-- /.iconbox-icon-wrap -->';
	}
	
	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return;
		}

		$title  = wp_kses_post( do_shortcode( $this->atts['title'] ) );
		$weight = $this->atts['heading_weight'];

		if ( ! empty ( $weight ) ) {
			$weight	 = ' class="' . $weight . '" ';
		}

		printf( '<h3%s>%s</h3>', $weight, $title );
	}
	
	protected function get_toggleable() {

		$toggleable = $this->atts['toggleable'];
		if( 'yes' !== $toggleable ) {
			return;
		}

		return "iconbox-contents-show-onhover";

	}
	
	protected function get_toggleable_opts() {

		$toggleable = $this->atts['toggleable'];
		if( 'yes' !== $toggleable ) {
			return;
		}

		return 'data-slideelement-onhover="true" data-slideelement-options=\'{ "visibleElement": ".iconbox-icon-wrap, h3", "hiddenElement": ".contents", "alignMid": true }\'';

	}
	
	protected function get_heading_size() {

		$size = $this->atts['heading_size'];
		if( empty( $size ) || 'custom' === $size ) {
			return;
		}

		return "iconbox-heading-$size";

	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		echo wp_kses_post( ld_helper()->do_the_content( $this->atts['content'] ) );
	}
	
	protected function before_icon_box_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		return '<div class="contents">';
	}

	protected function after_icon_box_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		return '</div>';

	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

	/**
	 * [generate_css description]
	 * @method generate_css
	 */
	protected function generate_css() {

		extract( $this->atts );

		$bg = $elements = array();
		$id = '.' . $this->get_id();
		
		//Icon color
		if( ! empty( $i_color ) && isset( $i_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['color'] = $i_color;
		}
		if( !empty( $h_i_color ) ) {
			$elements[liquid_implode( '%1$s:hover .iconbox-icon-container' )]['color'] = $h_i_color;
		}
		if ( !empty( $i_color2 ) ) {
			$elements[liquid_implode( '.backgroundcliptext %1$s .iconbox-icon-container i' )] = array(
				'background'              => 'linear-gradient(to bottom right, ' . $i_color . ' 20%, ' . $i_color2 . ' 80%)',
				'background-clip'         => 'text !important',
				'-webkit-background-clip' => 'text !important',
				'text-fill-color'         => 'transparent !important',
				'-webkit-text-fill-color' => 'transparent !important',
				'line-height' => '1.15em !important'
			);
			if( !empty( $h_i_color ) ) {

				$h_i_color2 = ! empty( $h_i_color2 ) ? $h_i_color2 : $h_i_color;
				$elements[liquid_implode( '.backgroundcliptext %1$s:hover .iconbox-icon-container i' )] = array(
					'background'              => 'linear-gradient(to bottom right, ' . $h_i_color . ' 20%, ' . $h_i_color2 . ' 80%)',
					'background-clip'         => 'text !important',
					'-webkit-background-clip' => 'text !important',
					'text-fill-color'         => 'transparent !important',
					'-webkit-text-fill-color' => 'transparent !important',
					'line-height' => '1.15em !important'
				);
			}
		}
		if( ! empty( $icon_size ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['font-size'] = $icon_size;
		}
		if( !empty( $icon_mb ) && '0' !== $icon_mb ) {
			if( 'iconbox-inline' === $position || 'iconbox-side' === $position ) {
				if( 'text-right' === $alignment ) {
					$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['margin-left'] = $icon_mb . 'px !important';	
				}
				else {
					$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['margin-right'] = $icon_mb . 'px !important';
				}
			}
			else {
				$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['margin-bottom'] = $icon_mb . 'px !important';
			}
		}
		if( ! empty( $custom_i_size ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['width'] = $custom_i_size . ' !important';
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['height'] = $custom_i_size . ' !important';
		}
		
		if( !empty( $shape_color ) && isset( $shape_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['background'] = $shape_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container:before' ) ]['border-color'] = $shape_color;
		}
		if( !empty( $shape_hcolor ) && isset( $shape_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container .iconbox-icon-hover-bg' ) ]['background'] = $shape_hcolor;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container:before' ) ]['border-color'] = $shape_hcolor;
		}
		if( !empty( $shape_hexagon_color ) && isset( $shape_hexagon_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['background'] = $shape_hexagon_color;
		}
		if( !empty( $i_color ) && isset( $i_color ) && 'wavebg' === $this->atts['i_shape'] ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container .icon-wave-bg path' ) ]['fill'] = $i_color;
		}
		//Heading color
		if( !empty( $h_color ) && isset( $h_color ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['color'] = $h_color;
		}
		if( isset( $title_mb ) && '0' !== $title_mb ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['margin-bottom'] = $title_mb . 'px';
		}
		if( !empty( $custom_heading_size ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['font-size'] = $custom_heading_size;
		}
		
		if( !empty( $h_color ) && !empty( $h_color2 ) ) {
			$elements[ liquid_implode( '.backgroundcliptext %1$s-heading-gradient h3' ) ]['background'] = 'linear-gradient(to right, ' . $h_color . ' 0%, ' . $h_color2 . ' 100%)';
		}
		if( !empty( $h_hcolor ) && 'iconbox-heading-gradient' === $heading_gradient ) {
			$elements[ liquid_implode( '.backgroundcliptext %1$s-heading-gradient:hover h3' ) ]['background'] = $h_hcolor;
		}
		elseif( !empty( $h_hcolor ) ) {
			$elements[ liquid_implode( '%1$s:hover h3' ) ]['color'] = $h_hcolor;
		}
		
		//Background colors
		if( !empty( $fill_color ) && isset( $fill_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $fill_color;
		}
		if( !empty( $hover_fill_color ) && isset( $hover_fill_color ) ) {
			$elements[ liquid_implode( '%1$s:before' ) ]['background'] = $hover_fill_color;
		}
		if( !empty( $hover_bg_image ) ) {
			if( preg_match( '/^\d+$/', $hover_bg_image ) ){
				$src = liquid_get_image_src( $hover_bg_image );
				$elements[ liquid_implode( '%1$s:before' ) ]['background-image'] = 'url(' . esc_url( $src[0] ) . ')';
			} else {
				$src = $hover_bg_image;
				$elements[ liquid_implode( '%1$s:before' ) ]['background-image'] = 'url(' . esc_url( $src ) . ')';
			}
		}
		

		if( !empty( $hover_text_color ) ) {
			$elements[ liquid_implode( '%1$s:hover, %1$s:hover p' ) ]['color'] = $hover_text_color;
		}
		if( !empty( $border_shape_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['border-color'] = $border_shape_color;
		}
		if( !empty( $border_shape_hcolor ) ) {
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container' ) ]['border-color'] = $border_shape_hcolor;
		}
		if( '0' !== $i_shape_border_radius ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['border-radius'] = $i_shape_border_radius . 'px';
		}
		
		if( !empty( $custom_size ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container img[src$=".svg"],%1$s .iconbox-icon-container object,%1$s .iconbox-icon-container > svg' ) ]['width'] = $custom_size . ' !important';
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Icon_Box;