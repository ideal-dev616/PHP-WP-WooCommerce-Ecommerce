<?php
/**
* Shortcode Liquid Tab Section
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

// Tab Section Container Class
VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Tta_Section' );
class WPBakeryShortCode_Ld_tab_section extends WPBakeryShortCode_VC_Tta_Section {
	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function mainHtmlBlockParams( $width, $i ) {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

		return 'data-element_type="' . $this->settings['base'] . '" class="wpb_' . $this->settings['base'] . ' ' . $sortable . ' wpb_vc_tta_section wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
	}
}


/**
* LD_Shortcode
*/
class LD_Tab_Section extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ld_tab_section';
		$this->title         = esc_html__( 'Tab Section', 'ave-core' );
		$this->description   = esc_html__( 'Section for Tabs.', 'ave-core' );
		$this->icon          = 'icon-wpb-ui-tta-section';
		$this->is_container  = true;
		$this->allowed_container_element = 'vc_row';
		$this->show_settings_on_create = false;
		$this->scripts       = array( 'jquery-lettering' );
		$this->as_child      = array( 'only' => 'ld_tabs' );
		$this->js_view       = 'VcBackendTtaSectionView';
		$this->custom_markup = '<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
		</div>
		<div class="vc_tta-panel-body">
			{{ editor_controls }}
			<div class="{{ container-class }}">
			{{ content }}
			</div>
		</div>';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array_merge(
			array(

				array( 'id' => 'title' ),
				array(
					'type'       => 'textfield',
					'param_name' => 'desc',
					'heading'    => esc_html__( 'Short Description', 'ave-core' ),
					'description' => esc_html__( 'Add short description for tab, works only for some tabs styles', 'ave-core' ),
				),
				
				array(
					'type'       => 'el_id',
					'param_name' => 'tab_id',
					'settings'   => array(
						'auto_generate' => true,
					),
					'heading'     => esc_html__( 'Section ID', 'ave-core' ),
					'description' => wp_kses_post( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'ave-core' ) ),
				),

			),

			liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'color', 'size', 'hcolor' ) )
		);

		$this->add_extras();
	}

	public function render( $atts, $content = '' ) {

		global $liquid_accordion_tabs;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = $atts['tab_id'];
		//$atts['description'] = esc_html( $atts['desc'] );
		$atts['content'] = ld_helper()->do_the_content( $content );
		$atts['icon'] = liquid_get_icon( $atts );

		$liquid_accordion_tabs[]  = $atts;
	}
}
new LD_Tab_Section;