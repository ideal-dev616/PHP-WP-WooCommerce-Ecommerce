<?php
/**
* Shortcode Team Members Circular
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Team_Members_Circular extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_team_members_circular';
		$this->title       = esc_html__( 'Circular Images', 'ave-core' );
		$this->description = esc_html__( 'Animated images in circle', 'ave-core' );
		$this->icon        = 'fa fa-circle-o';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_animation',
				'heading'     => esc_html__( 'Enable Animation?', 'ave-core' ),
				'description' => esc_html__( 'If checked will enable animation', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ) ,
				'std'         => 'yes',
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'inner_items',
				'heading'    => esc_html__( 'Image on Inner position', 'ave-core' ),
				'params'     => array(
					
					array(
						'type'       => 'liquid_attach_image',
						'param_name' => 'image',
						'heading'    => esc_html__( 'Image', 'ave-core' ),
						'description' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'name',
						'heading'     => esc_html__( 'Name', 'ave-core' ),
						'description' => esc_html__( 'Add Name, it will be used in alt for the image', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'top_pos',
						'heading'     => esc_html__( 'Top', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px or % ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'right_pos',
						'heading'     => esc_html__( 'Right', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'bottom_pos',
						'heading'     => esc_html__( 'Bottom', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'left_pos',
						'heading'     => esc_html__( 'Left', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),

				)
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'middle_items',
				'heading'    => esc_html__( 'Image on Middle position', 'ave-core' ),
				'params'     => array(
					
					array(
						'type'       => 'liquid_attach_image',
						'param_name' => 'image',
						'heading'    => esc_html__( 'Image', 'ave-core' ),
						'description' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'name',
						'description' => esc_html__( 'Add Name, it will be used in alt for the image', 'ave-core' ),
						'heading'     => esc_html__( 'Name', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'top_pos',
						'heading'     => esc_html__( 'Top', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'right_pos',
						'heading'     => esc_html__( 'Right', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'bottom_pos',
						'heading'     => esc_html__( 'Bottom', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'left_pos',
						'heading'     => esc_html__( 'Left', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),

				)
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'outer_items',
				'heading'    => esc_html__( 'Image on Outer position', 'ave-core' ),
				'params'     => array(
					
					array(
						'type'       => 'liquid_attach_image',
						'param_name' => 'image',
						'heading'    => esc_html__( 'Image', 'ave-core' ),
						'description' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'name',
						'heading'     => esc_html__( 'Name', 'ave-core' ),
						'description' => esc_html__( 'Add Name, it will be used in alt for the image', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'top_pos',
						'heading'     => esc_html__( 'Top', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'right_pos',
						'heading'     => esc_html__( 'Right', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'bottom_pos',
						'heading'     => esc_html__( 'Bottom', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),
					
					array(
						'type'        => 'textfield',
						'param_name'  => 'left_pos',
						'heading'     => esc_html__( 'Left', 'ave-core' ),
						'description' => esc_html__( 'Add position value in px ( ex. 20px )', 'ave-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-3'
					),

				)
			),
			
			//Design Options
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'ave-core' ),
			),

		);

		$this->add_extras();
	}
	
	protected function get_image( $img ) {

		if ( empty( $img ) ) {
			return;
		}
		
		$alt = get_post_meta( $img, '_wp_attachment_image_alt', true );
		if( preg_match( '/^\d+$/', $img ) ){
			$image  = wp_get_attachment_image_src( $img, 'full' );
			$image = sprintf( '<figure><img src="%s" alt="%s" /></figure>', $image[0], esc_attr( $alt ) );
		} else {
			$image = sprintf( '<figure><img src="%s" alt="%s" /></figure>', esc_url( $img, esc_attr( $alt ) ) );
		}

		return $image;
	}
	
	protected function enable_animation() {
		
		if( !$this->atts['enable_animation'] ) {
			return;
		}

		echo 'data-custom-animations="true"';
		
	}

	protected function get_position( $pos = array() ) {
		
		$out = '';
		
		if( ! empty( $pos['top_pos'] ) ) {
			$out .= 'top:' . esc_attr( $pos['top_pos'] ) . ';';	
		}
		if( ! empty( $pos['right_pos'] ) ) {
			$out .= 'right:' . esc_attr( $pos['right_pos'] ) . ';';	
		}
		if( ! empty( $pos['bottom_pos'] ) ) {
			$out .= 'bottom:' . esc_attr( $pos['bottom_pos'] ) . ';';	
		}
		if( ! empty( $pos['left_pos'] ) ) {
			$out .= 'left:' . esc_attr( $pos['left_pos'] ) . ';';
		}

		 $out = sprintf( 'style="%s" ', $out );
		 
		 return $out;
	}
	
	protected function get_items( $items ) {
		
		if( empty( $items ) ) {
			return;
		}
		
		extract( $this->atts );
		
		$out = $alt = '';
		
		$items = vc_param_group_parse_atts( $items );
		
		foreach( $items as $member ) {
			
			if( isset( $member['name'] ) ) {
				$alt = $member['name'];
			}
			if( isset( $member['image'] ) ) {
				$out .= sprintf( '<div class="ld-tm-avatar" %s>%s</div>', $this->get_position( $member ), $this->get_image( $member['image'] )  );
			}
			
		}
		
		echo $out;
		
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		
		if( !empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s.ld-tm-circ .ld-tm-bg' ) ]['background'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Team_Members_Circular;