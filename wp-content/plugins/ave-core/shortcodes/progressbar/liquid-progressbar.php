<?php
/**
* Shortcode Progress Bar
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Progressbar extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_progressbar';
		$this->title       = esc_html__( 'Progressbar', 'ave-core' );
		$this->description = esc_html__( 'Add progressbars', 'ave-core' );
		$this->icon        = 'fa fa-tasks';
		$this->scripts     = array( 'circle-progress' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(


			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Label', 'ave-core' ),
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'prefix',
				'heading'     => esc_html__( 'Prefix', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'count',
				'heading'     => esc_html__( 'Bar Counter', 'ave-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'suffix',
				'heading'     => esc_html__( 'Suffix', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'label_position',
				'heading'    => esc_html__( 'Label position', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Bottom', 'ave-core' )  => 'liquid-progressbar-values-bottom',
					esc_html__( 'Inside', 'ave-core' )  => 'liquid-progressbar-values-inside',
				),
				'dependency' => array(
					'element' => 'enable_vertical',
					'value_not_equal_to' => array( 'ld-prgbr-v', 'ld-prgbr-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'number_hide',
				'heading'    => esc_html__( 'Hide Counter number', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'liquid-progressbar-count-hide',
				),
				'dependency' => array(
					'element' => 'label_position',
					'value'   => array( 'liquid-progressbar-values-inside' ),
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default ( 15px )', 'ave-core' )     => '',
					esc_html__( 'Thin ( 1px )', 'ave-core' )        => 'liquid-progressbar-thin',
					esc_html__( 'Thick ( 2px )', 'ave-core' )       => 'liquid-progressbar-thick',
					esc_html__( 'Small ( 10px )', 'ave-core' )       => 'liquid-progressbar-sm',
					esc_html__( 'Large ( 20px )', 'ave-core' )       => 'liquid-progressbar-lg',
					esc_html__( 'Extra Large ( 30px )', 'ave-core' ) => 'liquid-progressbar-xl',
					esc_html__( 'Custom', 'ave-core' )      => 'liquid-progressbar-custom',
				),
				'dependency' => array(
					'element' => 'enable_vertical',
					'value_not_equal_to' => array( 'ld-prgbr-v', 'ld-prgbr-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'vertical_height',	
				'heading'     => esc_html__( 'Height', 'ave-core' ),
				'description' => esc_html__( 'Add height with px, for ex. 30px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'size',
					'value' => 'liquid-progressbar-custom',
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'roundness',
				'heading'    => esc_html__( 'Roundness', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )  => '',
					esc_html__( 'Round', 'ave-core' )    => 'liquid-progressbar-round',
					esc_html__( 'Circle', 'ave-core' )   => 'liquid-progressbar-circle',
				),
				'dependency' => array(
					'element' => 'enable_vertical',
					'value_not_equal_to' => array( 'ld-prgbr-v', 'ld-prgbr-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_vertical',
				'heading'     => esc_html__( 'Orientation', 'ave-core' ),
				'description' => esc_html__( 'Select Orientation of the progressbar', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )  => '',
					esc_html__( 'Circular', 'ave-core' ) => 'ld-prgbr-circle',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'circular_thickness',
				'heading'     => esc_html__( 'Thickness', 'ave-core' ),
				'description' => esc_html__( 'Set thickness to circular progressbar', 'ave-core' ),
				'min'         => 0,
				'max'         => 30,
				'step'        => 1,
				'std'         => 10,
				'dependency'  => array(
					'element' => 'enable_vertical',
					'value'   => 'ld-prgbr-circle',
				),
				'edit_field_class' => 'vc_col-sm-6'	
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'line_cap',
				'heading'     => esc_html__( 'Line cap', 'ave-core' ),
				'description' => esc_html__( 'Select type of the line cap', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Butt', 'ave-core' )    => 'butt',
					esc_html__( 'Round', 'ave-core' )   => 'round',
					esc_html__( 'Square', 'ave-core' )  => 'square',
				),
				'dependency'  => array(
					'element' => 'enable_vertical',
					'value'   => 'ld-prgbr-circle',
				),
				'edit_field_class' => 'vc_col-sm-6'	
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'percentage_shape',
				'heading'    => esc_html__( 'Percentage Shape', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Round', 'ave-core' )   => 'round',
					esc_html__( 'Circle', 'ave-core' )  => 'circle',
				),
				'dependency' => array(
					'element' => 'enable_vertical',
					'value_not_equal_to' => array( 'ld-prgbr-v', 'ld-prgbr-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'ave-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'ave-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'label_color',
				'heading'    => esc_html__( 'Label Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'count_color',
				'heading'    => esc_html__( 'Count Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'colorpicker',
				'param_name' => 'circular_color',
				'heading'    => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick color for gradient of the circular progressbar', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_vertical',
					'value'   => 'ld-prgbr-circle',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'colorpicker',
				'param_name' => 'circular_color2',
				'heading'    => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick second color for gradient of the circular progressbar', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_vertical',
					'value'   => 'ld-prgbr-circle',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'colorpicker',
				'param_name' => 'empty_color',
				'heading'    => esc_html__( 'Empty bar Color', 'ave-core' ),
				'description' => esc_html__( 'Pick fill color for empty space of the circular progressbar', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_vertical',
					'value'   => 'ld-prgbr-circle',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'bar',
				'heading'    => esc_html__( 'Bar Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_vertical',
					'value_not_equal_to' => array( 'ld-prgbr-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'background',
				'heading'    => esc_html__( 'Bar Background Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_vertical',
					'value_not_equal_to' => array( 'ld-prgbr-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'top_border',
				'heading'    => esc_html__( 'Top Border Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_vertical',
					'value'   => 'ld-prgbr-v',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
		);

		$this->add_extras();
	}
	
	protected function get_shape() {
		
		$shape = $this->atts['percentage_shape'];
		
		if( empty( $shape ) ) {
			return;
		}
		
		return "style-tooltip $shape";

	}
	
	protected function get_shape_classname() {
		
		$shape = $this->atts['percentage_shape'];
		
		if( empty( $shape ) ) {
			return;
		}
		
		return 'ld-prgbr-details-sm';

	}
	
	protected function get_data_options() {
		
		$opts   = array();
		$count  = $this->atts['count'];
		$suffix = $this->atts['suffix'];
		$prefix = $this->atts['prefix'];
		$orientation = $this->atts['enable_vertical'];

		if( !empty( $count ) ) {
			$opts['value'] = intval( $count );
		}
		if( !empty( $suffix ) ) {
			$opts['suffix'] = $suffix;
		}
		if( !empty( $prefix ) ) {
			$opts['prefix'] = $prefix;
		}
		if( 'ld-prgbr-v' === $orientation ) {
			$opts['orientation'] = 'vertical';
		}
		elseif( 'ld-prgbr-circle' === $orientation ) {
			$opts['orientation'] = 'circle';
		}

		return 'data-progressbar-options=\'' . wp_json_encode( $opts ) . '\'';
		
	}
	
	protected function get_circle_container() {
		
		$orientation = $this->atts['enable_vertical'];
		if( 'ld-prgbr-circle' !== $orientation ) {
			return;
		}
		
		$line_cap_data = $data_empty_fill = $data_fill = '';
		$empty_color = '#e6e6e6';
		
		$thicknes = $this->atts['circular_thickness'];
		$line_cap = $this->atts['line_cap'];
		if( !empty( $line_cap ) ) {
			$line_cap_data = 'data-line-cap="' . $line_cap . '"';	
		}
		
		$color       = $this->atts['circular_color'];
		$color2      = $this->atts['circular_color2'];
		if( !empty( $this->atts['empty_color'] ) ) {
			$empty_color = $this->atts['empty_color'];	
		}

		if( !empty( $color )  && !empty( $color2 ) ) {
			$data_fill = 'data-fill=\'' . wp_json_encode( array( 'gradient' => array( $color, $color2 ) ) ) . '\'';
		}

		$data_empty_fill = 'data-empty-fill="' . $empty_color . '"';
		
		echo '<div class="ld-prgbr-circle-container" data-thickness="' . $thicknes . '"  ' . $line_cap_data . ' ' . $data_fill . ' ' . $data_empty_fill . ' ></div>';
		
	}

	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		$elements[ liquid_implode( '%1$s .liquid-progressbar-title' ) ]['color'] = $label_color;
		$elements[ liquid_implode( '%1$s .liquid-progressbar-value, %1$s .liquid-progressbar-suffix, %1$s .liquid-progressbar-prefix' ) ]['color'] = $count_color;
		$elements[ liquid_implode( '%1$s .liquid-progressbar-bar' ) ]['background'] = $bar;
		$elements[ liquid_implode( '%1$s .liquid-progressbar-inner' ) ]['background'] = $background;
		
		if( !empty( $top_border ) ) {
			$elements[ liquid_implode( '%1$s .liquid-progressbar-inner:before' ) ]['background'] = $top_border;
		}
		else {
			$elements[ liquid_implode( '%1$s .liquid-progressbar-inner:before' ) ]['background'] = $bar;
		}
		
		if( !empty( $vertical_height ) ) {
			$elements[ liquid_implode( '%1$s .liquid-progressbar-inner' ) ]['height'] = $vertical_height;
		}
		
		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $this->get_id() );
		$elements['media']['margin'] = $responsive_margin;

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Progressbar;