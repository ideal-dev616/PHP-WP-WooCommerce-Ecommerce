<?php
/**
* Shortcode Liquid Testimonial
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Testimonial extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_testimonial';
		$this->title       = esc_html__( 'Testimonial', 'ave-core' );
		$this->description = esc_html__( 'Add testimonial', 'ave-core' );
		$this->icon        = 'fa fa-comment';

		parent::__construct();

	}
	
	/**
	 * [get_params description]
	 * @method get_params
	 * @return array()
	 */
	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/testimonial/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'value' => array(
					array(
						'value' => 'testi_s01',
						'label' => esc_html__( 'Default', 'ave-core' ),
						'image' => $url . 'testi-1.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 02', 'ave-core' ),
						'value' => 'testi_s02',
						'image' => $url . 'testi-2.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 03', 'ave-core' ),
						'value' => 'testi_s03',
						'image' => $url . 'testi-3.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 04', 'ave-core' ),
						'value' => 'testi_s04',
						'image' => $url . 'testi-4.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 05', 'ave-core' ),
						'value' => 'testi_s05',
						'image' => $url . 'testi-5.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 06', 'ave-core' ),
						'value' => 'testi_s06',
						'image' => $url . 'testi-6.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 07', 'ave-core' ),
						'value' => 'testi_s07',
						'image' => $url . 'testi-7.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 08', 'ave-core' ),
						'value' => 'testi_s08',
						'image' => $url . 'testi-8.jpg'
					),
					array(
						'label' => esc_html__( 'Testimonial 09', 'ave-core' ),
						'value' => 'testi_s11',
						'image' => $url . 'testi-11.jpg'
					),
				),
			),
			array( 
				'id' => 'title', 
				'heading' => esc_html__( 'Name', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding' 
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Position', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'avatar',
				'heading'     => esc_html__( 'Avatar', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'avatar_size',
				'heading'    => esc_html__( 'Avatar Size', 'ave-core'  ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )  => '',
					esc_html__( 'Small', 'ave-core' )  => 'testimonial-avatar-sm',
					esc_html__( 'Large', 'ave-core' )  => 'testimonial-avatar-lg',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'avatar_position',
				'heading'    => esc_html__( 'Avatar Position', 'ave-core'  ),
				'value'      => array(
					esc_html__( 'Left', 'ave-core' )  => 'left',
					esc_html__( 'Center', 'ave-core' ) => 'center',
					esc_html__( 'Right', 'ave-core' ) => 'right',
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s08' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'align',
				'heading'    => esc_html__( 'Content alignment', 'ave-core' ),
				'value' => array(
					esc_html__( 'Left', 'ave-core' ) => 'text-left',
					esc_html__( 'Center', 'ave-core' ) => 'text-center',
					esc_html__( 'Right', 'ave-core' ) => 'text-right'
				),
				'edit_field_class' => 'vc_col-sm-6'
				 	
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'details_size',
				'heading'    => esc_html__( 'Details size', 'ave-core' ),
				'description' => esc_html__( 'Sizes of heading and position proportionaly', 'ave-core' ),
				'value' => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Small', 'ave-core' )  => 'testimonial-details-sm',
					esc_html__( 'Large', 'ave-core' )   => 'testimonial-details-lg',
					esc_html__( 'Extra Large', 'ave-core' )   => 'testimonial-details-xl'
				),
				'edit_field_class' => 'vc_col-sm-6'
				 	
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Text', 'ave-core' )
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_additional',
				'heading'    => esc_html__( 'Additional', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s04', 'testi_s02', 'testi_s08', 'testi_s03', 'testi_s05' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_shadow',
				'heading'     => esc_html__( 'Enable Shadow?', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s04' ),
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'liquid_slider',
				'param_name' => 'rating',
				'heading'    => esc_html__( 'Rating/Stars', 'ave-core' ),
				'min'        => 0,
				'max'        => 5,
				'step'       => 1,
				'std'        => 0,
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s02', 'testi_s08' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'date_time',
				'heading'     => esc_html__( 'Data/Time', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s02', 'testi_s03', 'testi_s05'  ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			
			//Design Options
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'title_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Title color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the title', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'pos_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Position color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the position', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary color', 'ave-core' ),
				'description' => esc_html__( 'Pick a primary color for the testimonial box', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s09'  ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'fill_color',
				'heading'     => esc_html__( 'Background color', 'ave-core' ),
				'description' => esc_html__( 'Pick a background color for the testimonial box', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s04', 'testi_s05', 'testi_s08', 'testi_s11' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'fill_bg_color',
				'heading'     => esc_html__( 'Background Fill color', 'ave-core' ),
				'description' => esc_html__( 'Pick a background fill color for the testimonial box inside the carousel active item', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s08' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'star_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Star/Rating color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the star/rating', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'testi_s02', 'testi_s08' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			
		);

		$this->add_extras();
	}

	/**
	 * [before_output( description]
	 * @method before_output
	 * @return array()
	 */
	public function before_output( $atts, &$content ) {
		
		$atts['template'] = $atts['style'];
		return $atts;

	}

	/**
	 * [get_avatar description]
	 * @method get_avatar
	 */
	protected function get_avatar( $classnames = null ) {

		// check
		if( empty( $this->atts['avatar'] ) ) {
			return '';
		}

		$alt = $this->atts['title'];

		if( preg_match( '/^\d+$/', $this->atts['avatar'] ) ){
			$avatar = liquid_get_image( $this->atts['avatar'] );
			// check
			if( ! $avatar ) {
				return;
			}
		} else {
			$avatar = esc_url( $this->atts['avatar'] );
		}

		// Default
		$avatar = sprintf( '<figure class="avatar %s"><img src="%s" alt="%s" /></figure>', $classnames, $avatar, esc_html( $alt ) );

		echo $avatar;
	}

	/**
	 * [get_avatar_position description]
	 * @method get_avatar_position
	 */	
	protected function get_avatar_position() {
		
		$position = $this->atts['avatar_position'];
		$style    = $this->atts['style'];

		// check
		if( 'testi_s08' !== $style ) {
			return'';
		}
		
		return "testimonial-avatar-top$position";
		
	}

	/**
	 * [get_quote description]
	 * @method get_quote
	 */
	protected function get_quote() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}
		$content = ld_helper()->do_the_content( $this->atts['content'] );

		// Default
		$content = sprintf( '<blockquote>%s</blockquote>', $content );

		echo $content;
	}
	
	/**
	 * [get_name description]
	 * @method get_name
	 */
	protected function get_name( $tag = 'h5', $classes = null ) {
		
		$name = $this->atts['title'];
		if( empty( $name ) ) {
			return;
		}
		$classnames = '';
		if( !empty( $classes ) ) {
			$classnames = 'class="' . $classes . '"';
		}

		printf( '<%1$s %3$s>%2$s</%1$s>', $tag, esc_html( $name ), $classnames );
	}
	
	/**
	 * [get_position description]
	 * @method get_position
	 */
	protected function get_position( $tag = 'h6', $classes = null ) {
		
		$style = $this->atts['style'];
		$position = $this->atts['position'];
		if( empty( $position ) ) {
			return;
		}
		
		if( empty( $classes ) ) {
			$classes = 'font-weight-normal';
		}		
		
		if( 'testi_s03' === $style ) {
			printf( '<%1$s class="font-weight-normal text-uppercase ltr-sp-1">%2$s</%1$s>', $tag, esc_html( $position ) );	
		}
		else {
			printf( '<%1$s class="%3$s">%2$s</%1$s>', $tag, esc_html( $position ), $classes );
		}
		
	}
	
	protected function get_shadow() {
		
		if( 'testi_s04' !== $this->atts['style'] ) {
			return;
		}
		
		if( !$this->atts['enable_shadow'] ) {
			return;
		}
		
		return 'testimonial-quote-shadowed';
	}

	/**
	 * [get_rating description]
	 * @method get_rating
	 */	
	protected function get_rating( $class = null ) {
		
		$out = '';
		$rating = $this->atts['rating'];
		if( empty( $rating ) ) {
			return;
		}
		
		$out .= '<ul class="star-rating ' . $class . '">';
		for( $i = 1; $i <= $rating; $i++ ) {
			$out .= '<li><i class="fa fa-star"></i></li> ';
		}
		$out .= '</ul>';
		
		echo $out;
	}
	
	/**
	 * [get_rating description]
	 * @method get_rating
	 */	
	protected function get_time( $class = null ) {
		
		$time = $this->atts['date_time'];
		$style = $this->atts['style'];

		if( empty( $time ) ) {
			return;
		}

		if( 'testi_s03' === $style ) {
			$class = 'text-uppercase ltr-sp-1 size-sm';
		}
		if( ! empty( $class ) ) {
			$class = 'class="' . $class . '"';
		}

		printf( '<time %1$s>%2$s</time>', $class,  esc_html( $time ) );
		
	}
	
	protected function get_fill_bg_classname() {

		if( empty( $this->atts['fill_bg_color'] ) ) {
			return;
		}
		
		return 'testimonial-fill-onhover';

	}


	/**
	 * [get_details description]
	 * @method get_details
	 */
	protected function get_details() {

		extract( $this->atts );

		// check
		if( empty( $title ) && empty( $company_name ) ) {
			return '';
		}

		printf( '<div class="%s">%s</div>', join( ' ', $classes ), ( $title . $meta . $company_logo ) );
	}
	
	/**
	 * [get_classes description]
	 * @method get_classes
	 */
	protected function get_classes( $style ) {

		$hash = array(
			'testi_s01' => 'testimonial',
			'testi_s02' => 'testimonial testimonial-sm',
			'testi_s03' => 'testimonial testimonial-quote-indented testimonial-details-top',
			'testi_s04' => 'testimonial testimonial-quote-filled',
			'testi_s05' => 'testimonial testimonial-whole-filled testimonial-whole-shadowed',
			'testi_s06' => 'testimonial testimonial-xl',
			'testi_s07' => 'testimonial testimonial-avatar-shadowed',
			'testi_s08' => 'testimonial testimonial-whole-filled testimonial-whole-shadowed testimonial-details-top testimonial-avatar-shadowed',
			
			'testi_s09' => 'testimonial testimonial-xs testimonial-avatar-xl testimonial-details-lg testimonial-whole-bordered',
			'testi_s10' => 'testimonial testimonial-xs testimonial-avatar-xl testimonial-details-lg',
			'testi_s11' => 'testimonial testimonial-sm testimonial-whole-filled testimonial-fill-onhover testimonial-whole-shadowed testimonial-whole-shadowed-alt testimonial-info-inline round',
			
			
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : 'testimonial';
	}

	/**
	 * [generate_css description]
	 * @method generate_css
	 */
	protected function generate_css() {

		extract( $this->atts );

		$id = '.' . $this->get_id();
		$elements = array();
		
		if( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s .testimonial-details h5' ) ]['color'] = $title_color;
		}
		if( !empty( $pos_color ) ) {
			$elements[ liquid_implode( '%1$s .testimonial-details h6' ) ]['color'] = $pos_color;
		}
		if( !empty( $star_color ) ) {
			$elements[ liquid_implode( '%1$s .star-rating li' ) ]['color'] = $star_color;
		}
		if( 'testi_s11' === $style ) {
			if( !empty( $fill_color ) ) {
				$elements[ liquid_implode( '%1$s:after' ) ]['background'] = $fill_color;
				$elements[ liquid_implode( '%1$s .testimonial-quote-mark svg' ) ]['fill'] = $fill_color;
			}
		}
		else {
			if( !empty( $fill_color ) ) {
				$elements[ liquid_implode( '%1$s.testimonial-quote-filled .testimonial-quote, %1$s.testimonial-whole-filled' ) ]['background'] = $fill_color;
			}
		}
		if( !empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s:after' ) ]['background'] = $primary_color;
		}
		if( !empty( $fill_bg_color ) ) {
			$elements[ liquid_implode( '%1$s:after' ) ]['background'] = $fill_bg_color;
		}

		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Testimonial;