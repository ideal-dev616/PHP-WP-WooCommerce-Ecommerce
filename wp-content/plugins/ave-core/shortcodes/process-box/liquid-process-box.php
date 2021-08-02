<?php
/**
* Shortcode Process Box
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Process_Box extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_process_box';
		$this->title       = esc_html__( 'Process Box', 'ave-core' );
		$this->icon        = 'fa fa-table';
		$this->description = esc_html__( 'Create a process box', 'ave-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$icons = liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'size' ), 'i_', array( 'element' => 'add_icon', 'value' => 'yes' ) );
		
		$params = array(

			array(
				'id'               => 'title',
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'ave-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'ave-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'ave-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'ave-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for title', 'ave-core' ),
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-9',
				'holder'     => 'div',
			),
			array(
				'type'        => 'vc_link',
				'param_name'  => 'link',
				'heading'     => esc_html__( 'URL (Link)', 'ave-core' ),
				'description' => esc_html__( 'Add link to the box.', 'ave-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'count',
				'heading'     => esc_html__( 'Count', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'admin_label' => true,
				'dependency' => array(
					'element' => 'add_icon',
					'value_not_equal_to' => 'yes',
				)
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'add_icon',
					'value_not_equal_to' => 'yes',
				)
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'add_icon',
				'heading'    => esc_html__( 'Add Icon?', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
			//Design options
			array(	
				'type'       => 'liquid_colorpicker',
				'param_name' => 'bg_color',
				'heading'    => esc_html__( 'Background Color', 'ave-core' ),
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'add_icon',
					'value'   => 'yes',
				),
			),
		);
		$this->params = array_merge( $params, $icons );
		$this->add_extras();

	}
	
	protected function get_image() {

		// check value
		if( empty( $this->atts['image'] ) || 'yes' === $this->atts['add_icon'] ) {
			return;
		}

		$img_src = $image = '';
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false );
		} 
		else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';

		}

		$image = sprintf( '<figure>%s</figure>', $html );
		
		echo $image;

	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$weight = $this->atts['heading_weight'];

		if( !empty ( $weight ) ) {
			$weight	 = ' class="' . $weight . '" ';
		}
		
		$title = sprintf( '<h3%s>%s</h3>', $weight, $this->atts['title'] );

		echo $title;
	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}

	protected function get_count() {
		
		if( 'yes' === $this->atts['add_icon'] ) {
			return;
		}
		
		$counter = $this->atts['count'];

		if ( empty( $counter ) ) {
			return;
		}
		
		printf( '<span class="ld-pb-num">%s</span>', esc_html( $counter ) );
	}
	
	protected function get_icon() {

		$icon = liquid_get_icon( $this->atts );
		$icon_html = '';

		if( $icon['type'] ) {
			$icon_html = '<span class="ld-pb-icon-wrap"><i class="' . $icon['icon'] . '"></i></span>';
		}

		echo $icon_html;

	}
	
	protected function get_link() {

		$link = liquid_get_link_attributes( $this->atts['link'], false );
		if( empty( $link['href'] ) ) {
			return;
		}
		
		printf( '<a %s class="liquid-overlay-link"></a>', ld_helper()->html_attributes( $link )  );

	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		if( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['color'] = $title_color;
		}
		
		if( !empty( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-pb-icon-wrap' ) ]['background'] = $bg_color;
		}
		if( !empty( $i_color) ) {
			$elements[ liquid_implode( '%1$s .ld-pb-icon-wrap' ) ]['color'] = $i_color;
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Process_Box;