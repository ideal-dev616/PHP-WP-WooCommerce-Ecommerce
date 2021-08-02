<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Carousel_Gallery extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_carousel_gallery';
		$this->title        = esc_html__( 'Carousel Gallery', 'ave-core' );
		$this->icon         = 'fa fa-arrows';
		$this->scripts      = array( 'flickity' );
		$this->styles       = array( 'flickity' );
		$this->description  = esc_html__( 'Create a carousel gallery.', 'ave-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$options = array(
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Layout', 'ave-core' ),
				'param_name'  => 'sh_layout',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Initial Index', 'ave-core' ),
				'description' => esc_html__( 'Zero-based index of the initial selected cell.', 'ave-core' ),
				'param_name'  => 'initialindex',
				'edit_field_class' => 'vc_col-sm-6'
			),

			//Navigation
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation', 'ave-core' ),
				'description' => esc_html__( 'Creates and enables previous & next buttons.', 'ave-core' ),
				'param_name'  => 'prevnextbuttons',
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => 'no',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Append Nav To', 'ave-core' ),
				'description' => esc_html__( 'Append the navigation to other elements in the page.', 'ave-core' ),
				'param_name'  => 'navappend',
				'value'       => array(
					esc_html__( 'Carousel itself', 'ave-core' )  => 'self',
					esc_html__( 'Parent Row', 'ave-core' ) => 'parent_row',
					esc_html__( 'Other Elements', 'ave-core' ) => 'custom_id',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'textfield',
				'param_name' => 'navappend_id',
				'heading' => esc_html__( 'ID to Append nav', 'ave-core' ),
				'description' => esc_html__( 'Input the id of element to append the navigaion, for ex. #heading-id', 'ave-core' ),
				'dependency'  => array(
					'element' => 'navappend',
					'value'   => 'custom_id'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination dots', 'ave-core' ),
				'description' => esc_html__( 'Creates and enables pagination dots', 'ave-core' ),
				'param_name'  => 'pagenationdots',
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => 'no',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Behavior', 'ave-core' ),
				'param_name'  => 'sh_behavior',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Autoplay', 'ave-core' ),
				'description' => esc_html__( 'Automatically advances to the next cell.', 'ave-core' ),
				'param_name'  => 'autoplay',
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Autoplay time', 'ave-core' ),
				'description' => esc_html__( 'i.e. 1500 will advance cells every 1.5 seconds.', 'ave-core' ),
				'param_name'  => 'autoplaytime',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pause AutoPlay On Hover', 'ave-core' ),
				'description' => esc_html__( 'Auto play pause when user hovers over carousel', 'ave-core' ),
				'param_name'  => 'pauseautoplayonhover',
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => 'no',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Carousel loop', 'ave-core' ),
				'description' => esc_html__( 'Loop for infinite scrolling.', 'ave-core' ),
				'param_name'  => 'wraparound',
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

		);
		foreach( $options as &$param ) {
			$param['group'] = esc_html__( 'Carousel Options', 'ave-core' );
		}
		
		$nav = array(
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Navigation', 'ave-core' ),
				'param_name'  => 'sh_nav',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'navarrow',
				'heading' => esc_html__( 'Style', 'ave-core' ),
				'description' => esc_html__( 'Select any navigation style', 'ave-core' ),
				'value' => array(
					esc_html__( 'None', 'ave-core' )    => '',
					esc_html__( 'Default', 'ave-core' ) => '1',
					esc_html__( 'Style 2', 'ave-core' ) => '2',
					esc_html__( 'Style 3', 'ave-core' ) => '3',
					esc_html__( 'Style 4', 'ave-core' ) => '4',
					esc_html__( 'Style 5', 'ave-core' ) => '5',
					esc_html__( 'Style 6', 'ave-core' ) => '6',
					esc_html__( 'Custom', 'ave-core' )  => 'custom'
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type' => 'textarea_safe',
				'param_name' => 'prev',
				'heading' => esc_html__( 'Prev Button', 'ave-core' ),
				'description' => esc_html__( 'Add here markup for previous button for ex <i class=\"fa fa-angle-left\"></i>', 'ave-core' ),
				'dependency' => array(
					'element' => 'navarrow',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type' => 'textarea_safe',
				'param_name' => 'next',
				'heading' => esc_html__( 'Next Button', 'ave-core' ),
				'description' => esc_html__( 'Add here markup for next button for ex <i class=\"fa fa-angle-right\"></i>', 'ave-core' ),
				'dependency' => array(
					'element' => 'navarrow',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navsize',
				'heading'     => esc_html__( 'Size', 'ave-core' ),
				'description' => esc_html__( 'Select any navigation size', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )     => 'carousel-nav-md',
					esc_html__( 'Small', 'ave-core' )       => 'carousel-nav-sm',
					esc_html__( 'Large', 'ave-core' )       => 'carousel-nav-lg',
					esc_html__( 'Extra Large', 'ave-core' ) => 'carousel-nav-xl',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navfill',
				'heading'     => esc_html__( 'Fill', 'ave-core' ),
				'description' => esc_html__( 'Select any navigation fill', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' )  => '',
					esc_html__( 'Bordered', 'ave-core' ) => 'carousel-nav-bordered',
					esc_html__( 'Solid', 'ave-core' )    => 'carousel-nav-solid',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navshape',
				'heading'     => esc_html__( 'Shape', 'ave-core' ),
				'description' => esc_html__( 'Select any navigation shape', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' )      => '',
					esc_html__( 'Rectangle', 'ave-core' ) => 'carousel-nav-rectangle',
					esc_html__( 'Square', 'ave-core' )    => 'carousel-nav-square',
					esc_html__( 'Circle', 'ave-core' )    => 'carousel-nav-circle',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navshadow',
				'heading'     => esc_html__( 'Shadow', 'ave-core' ),
				'description' => esc_html__( 'Select any navigation shadow', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' )            => '',
					esc_html__( 'Shadow', 'ave-core' )          => 'carousel-nav-shadowed',
					esc_html__( 'Shadow on hover', 'ave-core' ) => 'carousel-nav-shadowed-onhover',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'navhalign',
				'heading' => esc_html__( 'Alignment', 'ave-core' ),
				'description' => esc_html__( 'Select alignment for the navigation', 'ave-core' ),
				'value' => array(
					esc_html__( 'Left', 'ave-core' ) => 'carousel-nav-left',
					esc_html__( 'Center', 'ave-core' ) => 'carousel-nav-center',
					esc_html__( 'Right', 'ave-core' ) => 'carousel-nav-right',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'navfloated',
				'heading' => esc_html__( 'Floated', 'ave-core' ),
				'description' => esc_html__( 'Select yes if you want nav to be floated', 'ave-core' ),
				'value' => array(
					esc_html__( 'No', 'ave-core' ) => '',
					esc_html__( 'Yes', 'ave-core' ) => 'carousel-nav-floated',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navvalign',
				'heading'     => esc_html__( 'Vertical Position', 'ave-core' ),
				'description' => esc_html__( 'Select vertical position for the navigation', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' )    => '',
					esc_html__( 'Top', 'ave-core' )    => 'carousel-nav-top',
					esc_html__( 'Middle', 'ave-core' ) => 'carousel-nav-middle',
					esc_html__( 'Bottom', 'ave-core' ) => 'carousel-nav-bottom',
				),
				'dependency'  => array(
					'element' => 'navfloated',
					'value'   => 'carousel-nav-floated'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navdirection',
				'heading'     => esc_html__( 'Direction', 'ave-core' ),
				'description' => esc_html__( 'Select direction for the navigation', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' )    => '',
					esc_html__( 'Vertical', 'ave-core' ) => 'carousel-nav-vertical',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navline',
				'heading'     => esc_html__( 'Add line?', 'ave-core' ),
				'description' => esc_html__( 'Select yes to display a line between buttons', 'ave-core' ),
				'value' => array(
					esc_html__( 'No', 'ave-core' )    => '',
					esc_html__( 'Yes', 'ave-core' ) => 'carousel-nav-line-between',
				),
				'dependency'  => array(
					'element' => 'navdirection',
					'value'   => 'carousel-nav-vertical'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'navoffset',
				'heading'     => esc_html__( 'Offset', 'ave-core' ),
				'description' => esc_html__( 'Add here nav offset values, separated by comma, for ex. right:22%', 'ave-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'prevoffset',
				'heading'     => esc_html__( 'Previous Button Offset', 'ave-core' ),
				'description' => esc_html__( 'Add here previous button offset values for ex. 10px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'nextoffset',
				'heading'     => esc_html__( 'Next Button Offset', 'ave-core' ),
				'description' => esc_html__( 'Add here next button offset values, for ex. 22px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'shapesize',
				'heading'     => esc_html__( 'Shape Size', 'ave-core' ),
				'description' => esc_html__( 'Custom Shape Size, for ex. 22px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'navshape',
					'value'   => array( 'carousel-nav-square', 'carousel-nav-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'shapeheight',
				'heading'     => esc_html__( 'Shape height', 'ave-core' ),
				'description' => esc_html__( 'Custom shape height, for ex. 22px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'navshape',
					'value'   => array( 'carousel-nav-rectangle' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'shapewidth',
				'heading'     => esc_html__( 'Shape width', 'ave-core' ),
				'description' => esc_html__( 'Custom shape width, for ex. 22px', 'ave-core' ),
				'dependency'  => array(
					'element' => 'navshape',
					'value'   => array( 'carousel-nav-rectangle' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Styling', 'ave-core' ),
				'param_name'  => 'sh_styling_nav',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_arrow_color',
				'heading' => esc_html__( 'Arrow Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the nav arrows', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_arrow_color_hover',
				'heading' => esc_html__( 'Arrow Hover Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the nav arrows on hover', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_border_color',
				'heading' => esc_html__( 'Border Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the nav button borders', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_border_hcolor',
				'heading' => esc_html__( 'Border Hover Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a hover color for the nav button borders', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'nav_bg_color',
				'heading' => esc_html__( 'Background', 'ave-core' ),
				'description' => esc_html__( 'Pick background for the nav buttons', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'nav_bg_hcolor',
				'heading' => esc_html__( 'Background Hover', 'ave-core' ),
				'description' => esc_html__( 'Pick hover background for the nav buttons', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Pagination Dots', 'ave-core' ),
				'param_name'  => 'sh_pagination_nav',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Align page dots', 'ave-core' ),
				'description' => esc_html__( 'Select alignment for page dots', 'ave-core' ),
				'param_name'  => 'align_dots',
				'value'       => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Left', 'ave-core' )    => 'carousel-dots-left',
					esc_html__( 'Right', 'ave-core' )   => 'carousel-dots-right'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes'
				)

			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Size page dots', 'ave-core' ),
				'description' => esc_html__( 'Select size for page dots', 'ave-core' ),
				'param_name'  => 'size_dots',
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )  => '',
					esc_html__( 'Small' )          => 'carousel-dots-sm',
					esc_html__( 'Medium' )         => 'carousel-dots-md',
					esc_html__( 'Large' )          => 'carousel-dots-lg',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
				'dependency' => array(
					'element' => 'pagenationdots',
					'value'   => 'yes'
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'dots_style',
				'heading'     => esc_html__( 'Style', 'ave-core' ),
				'description' => esc_html__( 'Select dots style', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Style 1', 'ave-core' ) => 'carousel-dots-style1',
					esc_html__( 'Style 2', 'ave-core' ) => 'carousel-dots-style2',
					esc_html__( 'Style 3', 'ave-core' ) => 'carousel-dots-style3',
					esc_html__( 'Style 4', 'ave-core' ) => 'carousel-dots-style4',
				),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'dots_bg_color',
				'heading'     => esc_html__( 'Dots Background', 'ave-core' ),
				'description' => esc_html__( 'Pick background for the page dots', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Nav', 'ave-core' ),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes',	
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'dots_bg_hcolor',
				'heading'     => esc_html__( 'Dots Hover Background', 'ave-core' ),
				'description' => esc_html__( 'Pick hover background for the page dots', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Nav', 'ave-core' ),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes',	
				),
			),
		);
		
		$this->params = array_merge( array(
			// Params goes here
				array(
					'type'        => 'attach_images',
					'param_name'  => 'images',
					'heading'     => esc_html__( 'Gallery Images', 'ave-core' ),
					'description' => esc_html__( 'Add images to show in the gallery', 'ave-core' ),
					'admin_label' => true,
				),
			), $options, $nav ); 

		$this->add_extras();
	}
	
	public function before_output( $atts, &$content ) {

		$atts['template'] = 'iphone';		

		return $atts;
	}
	
	protected function get_attachments() {

		$images = explode( ',', $this->atts['images'] );

		if( empty( $images ) ) {
			return;
		}

		$args = array(
			'posts_per_page' => -1,
			'include'        => $images,
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => 'post__in',

			// improve query performance
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false
		);

		return get_posts( $args );
	}

	protected function columnize_content( &$content ) {

		global $shortcode_tags;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		$pattern = get_shortcode_regex();
		
		$item_classname = 'carousel-item col-xs-12';

		foreach( $tagnames as $tag ) {
			$start = "[$tag";
			$end = "[/$tag]";

			if( ld_helper()->str_contains( $end, $content ) ) {
				$content = str_replace( $start, '<div class="' . $item_classname . '">' . $start, $content );
				$content = str_replace( $end, $end . '</div>', $content );
			}
			else {
				preg_match_all( '/' . $pattern . '/s', $content, $matches );

				foreach( array_unique( $matches[0] ) as $replace ) {
					$content = str_replace( $replace, '<div class="' . $item_classname . '">' . $replace . '</div>', $content );
				}
			}

		}
	}

	protected function get_options() {

		$opts = array();
		$raw = $this->atts;
		$ids = array(
			'initialindex'         => 'initialIndex',
			'cellalign'            => 'cellAlign',
			'contain'              => 'contain',
			'groupcells'           => 'groupCells',
			'groupcellscustom'     => 'groupCells',
			'pagenationdots'       => 'pageDots',
			'autoplay'             => 'autoPlay',
			'autoplaytime'         => 'autoPlay',
			'pauseautoplayonhover' => 'pauseAutoPlayOnHover',
			'draggable'            => 'draggable',
			'freescroll'           => 'freeScroll',
			'wraparound'           => 'wrapAround',
			'adaptiveheight'       => 'adaptiveHeight',
			'navappend'            => 'buttonsAppendTo',
			'navappend_id'         => 'buttonsAppendTo',
			'prevnextbuttons'      => 'prevNextButtons',
			'navarrow'             => 'navArrow',
			'fullwidthside'        => 'fullwidthSide',
			'navoffset'            => 'navOffsets',
			'randomveroffset'      => 'randomVerOffset',
			
		);

		unset(
			$raw['style'],
			$raw['title'],
			$raw['content'],

			$raw['navfloated'],
			$raw['navhalign'],
			$raw['navvalign'],
			$raw['navdirection'],
			$raw['navline'],
			$raw['navsize'],
			$raw['navfill'],
			$raw['navshape'],
			$raw['navshadow'],

			$raw['nav_arrow_color'],
			$raw['nav_arrow_color_hover'],
			$raw['nav_border_color'],
			$raw['nav_border_hcolor'],
			$raw['nav_bg_color'],
			$raw['nav_bg_hcolor'],
			
			$raw['shapesize'],
			$raw['shapeheight'],
			$raw['shapewidth'],			
			
			$raw['size_dots'],
			$raw['align_dots'],
			$raw['dots_style'],
			$raw['dots_bg_color'],
			$raw['dots_bg_hcolor'],
			$raw['_id'],
			$raw['el_id'],
			$raw['el_class'],
			
			$raw['images'],
			$raw['template']
		);

		$raw = array_filter( $raw );
		$custom_opts = $arr = $offset_value = array();

		foreach( $raw as $id => $val ) {

			// Casting
			if( 'yes' === $val ) {
				$val = true;
			}
			if( 'no' === $val || '' === $val ) {
				$val = false;
			}
			if( in_array( $id, array( 'initialindex', 'autoplaytime' ) ) ) {
				$val = intval( $val );
			}

			if( in_array( $id, array( 'prev', 'next', 'navarrow' ) ) ) {
				
				if( 'navarrow' === $id && 'custom' !== $val ){
					$opts[ $ids[ 'navarrow' ] ] = $val;
				}
				else {

					if( 'next' === $id ) {
						$val = !empty( $val ) ? vc_value_from_safe( $val, true ) : '<i class=\"fa fas fa-angle-left\"></i>';
						$custom_opts['next'] = $val;
					}
					if( 'prev' === $id ) {
						$val = !empty( $val ) ? vc_value_from_safe( $val, true ) : '<i class=\"fa fas fa-angle-right\"></i>';
						$custom_opts['prev'] = $val;
					}
					$opts[ $ids[ 'navarrow' ] ] = $custom_opts;
				}
			}
			elseif( 'navoffset' === $id ) {

				$offset_values = explode( ',', $val );

				foreach( $offset_values as $value ) {

					$arr = explode( ':', $value );
					$offset_value[ $arr[0] ] = $arr[1] ;

				}

				$opts[ $ids[ 'navoffset' ] ] = array( 'nav' => $offset_value);

			} 
			elseif( 'prevoffset' === $id )	 {
				if( !empty( $val ) ) {
					$opts[ $ids[ 'navoffset' ] ]['prev'] = $val;	
				}
			}
			elseif( 'nextoffset' === $id )	 {
				if( !empty( $val ) ) {
					$opts[ $ids[ 'navoffset' ] ]['next'] = $val;
				}
			}
			elseif ( 'navappend' === $id ) {

				if ( 'custom_id' === $val && !empty( $opts[ $ids[ 'navappend_id' ] ] ) ) {

					$opts[ $ids[ 'navappend' ] ] = $opts[ $ids[ 'navappend_id' ] ];

				} else {

					$opts[ $ids[ $id ] ] = $val;
					
				}

			}
			else{
				$opts[ $ids[ $id ] ] = $val;
			}
			
			$opts['groupCells'] = false;
			$opts['wrapAround'] = true; 
			$opts['cellAlign']  = 'center';

		}

		if( !empty( $opts ) ) {
			echo " data-lqd-flickity='" . stripslashes( wp_json_encode( $opts ) ) ."'";
		}
		else {
			echo " data-lqd-flickity=true";
		}
	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();

		$id = '.' . $this->get_id();
		
		if( !empty( $nav_arrow_color ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button svg' )]['stroke'] = $nav_arrow_color;
			$elements[liquid_implode( '%1$s .flickity-prev-next-button' )]['color'] = $nav_arrow_color;
		}
		if( !empty( $nav_arrow_color_hover ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button:hover svg' )]['stroke'] = $nav_arrow_color_hover;
			$elements[liquid_implode( '%1$s .flickity-prev-next-button:hover' )]['color'] = $nav_arrow_color_hover;
		}
		if( !empty( $nav_border_color ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button' )]['border-color'] = $nav_border_color;
			$elements[liquid_implode( '%1$s .flickity-prev-next-button.previous:after' )]['background-color'] = $nav_border_color;
		}
		if( !empty( $nav_border_hcolor ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button:hover' )]['border-color'] = $nav_border_hcolor;
		}
		if( !empty( $nav_bg_color ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button' )]['background'] = $nav_bg_color;
		}
		if( !empty( $nav_bg_hcolor ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button:before' )]['background'] = $nav_bg_hcolor;
		}
		if( !empty( $shapesize ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button' ) ]['width'] = $shapesize .' !important';
			$elements[liquid_implode( '%1$s .flickity-prev-next-button' ) ]['height'] = $shapesize .' !important';
		}
		if( !empty( $shapeheight ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button' ) ]['height'] = $shapeheight .' !important';
		}
		if( !empty( $shapewidth ) ) {
			$elements[liquid_implode( '%1$s .flickity-prev-next-button' ) ]['width'] = $shapewidth .' !important';
		}
		
		
		if( 'carousel-dots-style3' ===  $dots_style ) {
			if( !empty( $dots_bg_color ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot:after' )]['background'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['border-color'] = $dots_bg_color;
			}
			if( !empty( $dots_bg_hcolor ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected:before, %1$s .flickity-page-dots .dot:before:hover' )]['background'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected, %1$s .flickity-page-dots .dot:hover' )]['border-color'] = $dots_bg_hcolor;
			}
		}
		else {
			if( !empty( $dots_bg_color ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['background'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['border-color'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['color'] = $dots_bg_color;
			}
			if( !empty( $dots_bg_hcolor ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected, %1$s .flickity-page-dots .dot:hover' )]['background'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected, %1$s .flickity-page-dots .dot:hover' )]['border-color'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected, %1$s .flickity-page-dots .dot:hover' )]['color'] = $dots_bg_hcolor;
			}
		}
		

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Carousel_Gallery;