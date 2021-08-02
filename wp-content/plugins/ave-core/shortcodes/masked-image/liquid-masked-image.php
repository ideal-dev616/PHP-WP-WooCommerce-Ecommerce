<?php
/**
* Shortcode Masked Image Element
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Masked_Image extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_masked_image';
		$this->title           = esc_html__( 'Masked Image', 'ave-core' );
		$this->description     = esc_html__( 'Add masked image', 'ave-core' );
		$this->icon            = 'fa fa-image';

		parent::__construct();
	}
	
	public function get_params() {
		
		$this->params = array(

			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'bg_pos_x',
				'heading'          => esc_html__( 'Background Position X', 'ave-core' ),
				'description'      => esc_html__( 'Add Background position on axe X with px, for ex. 24px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'bg_pos_y',
				'heading'          => esc_html__( 'Background Position Y', 'ave-core' ),
				'description'      => esc_html__( 'Add Background position on axe Y with px, for ex. 24px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Absolute Position?', 'ave-core' ),
				'param_name'  => 'absolute_pos',
				'description' => esc_html__( 'If checked the position will be set absolute', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			//Position
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Position', 'ave-core' ),
				'description' => esc_html__( 'Add positions for the element, use px or %', 'ave-core' ),
				'css'        => 'position',
				'param_name' => 'position',
				'group'      => esc_html__( 'Design Options', 'ave-core' ),
			),
			
			
		);

		$this->add_extras();
	
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		$image_opts = array();
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image  = '<figure class="clip-svg" data-responsive-bg="true">' . wp_get_attachment_image( $this->atts['image'], 'full', false, $image_opts ) . '</figure>';
		} else {
			$image = '<figure class="clip-svg" data-responsive-bg="true"><img src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" /></figure>';
		}

		echo $image;

	}
	
	
	protected function get_svg() {
		
		$unique_id = 'svg-' . $this->get_id();
		
		echo '<svg class="scene" width="0" height="0" preserveAspectRatio="none">
				      <defs>
				        <clipPath id="' . $unique_id . '">
				          <path
				            fill="black"
				            d="M131,40 C84.135,83.534 96.819,148.446 63.283,217.394 C31.508,282.723 -3.621,324.812 1.461,394.323 C3.451,421.533 12.117,449.828 29.796,480.002 C87.412,578.34 -15.301,663.448 94.611,833.387 C156.302,928.77 316.559,918.015 435.971,936.052 C572.741,956.711 653.384,1003.601 753.566,971.715 C877.689,932.209 924.99262,809.932822 972.63862,707.700822 C1063.84662,512.000822 1038.71071,197.732895 884.476705,67.2268952 C788.919705,-13.6291048 714.704,70.008 529,43 C339.693,15.468 212.609,-35.808 131,40 Z"
                    pathdata:id="
                    M175.270836,26.7977911 C128.405836,70.3317911 129.938279,144.739124 96.4022789,213.687124 C64.6272789,279.016124 41.242383,286.071679 46.324383,355.582679 C48.314383,382.792679 79.5246278,459.251586 88.7738696,492.334164 C116.497714,591.496483 -75.3047466,680.552915 34.6072534,850.491915 C96.2982534,945.874915 281.559,906.015 400.971,924.052 C537.741,944.711 678.161685,902.348368 778.343685,870.462368 C902.466685,830.956368 927.354,806.232 975,704 C1066.208,508.3 1058.68971,185.848951 904.455709,55.3429506 C808.898709,-25.5130494 786.027661,117.60054 600.323661,90.5925401 C411.016661,63.0605401 256.879836,-49.0102089 175.270836,26.7977911 Z;
                    M200.391256,6 C138.06059,22.7990703 77.9622177,42.6445401 44.4262177,111.59254 C12.6512177,176.92154 -4.1051307,212.01786 0.976869296,281.52886 C2.9668693,308.73886 99.0297526,534.545109 108.278994,567.627688 C136.002839,666.790006 -29.1381304,721.523368 80.7738696,891.462368 C142.46487,986.845368 331.636556,840.153183 451.048556,858.190183 C587.818556,878.849183 705.371102,948.496676 805.553102,916.610676 C929.676102,877.104676 941.497784,689.3436 989.143784,587.1116 C1080.35178,391.4116 1050.68971,206.848951 896.455709,76.3429506 C800.898709,-4.5130494 778.027661,138.60054 592.323661,111.59254 C403.016661,84.0605401 312.765712,-24.2866392 200.391256,6 Z"
				          />
				        </clipPath>
				      </defs>
				    </svg>';
	}
	

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		if( ! empty( $absolute_pos ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['position'] = 'absolute';
		}	
		
		$responsive_pos = Liquid_Responsive_Param::generate_css( 'position', $position, $this->get_id() );
		$elements['media']['position'] = $responsive_pos;
		$elements[ liquid_implode( '%1$s .clip-svg' ) ]['clip-path'] = 'url(#svg-' . $this->get_id() . ' )';
		$elements[ liquid_implode( '%1$s .clip-svg' ) ]['-webkit-clip-path'] = 'url(#svg-' . $this->get_id() . ' )';
		
		if( !empty( $bg_pos_x ) ) {
			$elements[ liquid_implode( '%1$s .clip-svg' ) ]['background-position-x'] = $bg_pos_x;	
		}
		if( !empty( $bg_pos_y ) ) {
			$elements[ liquid_implode( '%1$s .clip-svg' ) ]['background-position-y'] = $bg_pos_y;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}
	
}
new LD_Masked_Image;