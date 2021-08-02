<?php
/**
* Header Button Shortcode
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/

class LD_Header_Button extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_button';
		$this->title       = esc_html__( 'Button', 'ave-core' );
		$this->scripts      = array( 'jquery-fresco', 'lity' );
		$this->styles       = array( 'fresco', 'lity' );
		$this->icon        = 'fa fa-square';
		$this->description = esc_html__( 'Create a custom button.', 'ave-core' );
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {
		
		$this->params = array_merge( 

			vc_map_integrate_shortcode( 'ld_button', 'ib_', '' ), 
			array(
				array(
					'type'             => 'liquid_colorpicker',
					'param_name'       => 'sticky_color',
					'only_solid'       => true,
					'heading'          => esc_html__( 'Sticky Primary Color', 'ave-core' ),
					'description'      => esc_html__( 'Background color', 'ave-core' ),
					'group'            => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
				),
				array(
					'type'             => 'liquid_colorpicker',
					'param_name'       => 'sticky_color2',
					'only_solid'       => true,
					'heading'          => esc_html__( 'Sticky Secondary Color', 'ave-core' ),
					'description'      => esc_html__( 'Background secondary color, will create gradient effect', 'ave-core' ),
					'group'            => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_hover_color',
					'only_solid'  => true,
					'heading'     => esc_html__( 'Sticky Primary Hover Color', 'ave-core' ),
					'description' => esc_html__( 'Hover state background color', 'ave-core' ),
					'group'       => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_hover_color2',
					'only_solid'  => true,
					'heading'     => esc_html__( 'Sticky Secondary Hover Color', 'ave-core' ),
					'description' => esc_html__( 'Hover state background secondary color, will create gradient effect', 'ave-core' ),
					'group'       => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_sh_label',
					'heading'    => esc_html__( 'Label', 'ave-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'ave-core' ),
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_text_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Color', 'ave-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_htext_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Hover Color', 'ave-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_sh_border',
					'heading'    => esc_html__( 'Border', 'ave-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'ave-core' ),
				),
				
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_border_color',
					'only_solid'  => true,
					'heading'    => 'Border Color',
					'group'      => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'ib_style',
						'value_not_equal_to' => array( 'btn-naked', 'btn-default', 'btn-split' ),
					),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_border_color2',
					'heading'     => 'Border Color 2',
					'only_solid'  => true,
					'description' => esc_html__( 'Border color 2, will create gradient effect', 'ave-core' ),
					'group'       => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'ib_style',
						'value_not_equal_to' => array( 'btn-naked', 'btn-default', 'btn-split' ),
					),
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'h_sticky_border_color',
					'only_solid'  => true,
					'heading'    => 'Hover Border Color',
					'group'      => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'ib_style',
						'value_not_equal_to' => array( 'btn-naked', 'btn-split' ),
					),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'h_sticky_border_color2',
					'only_solid'  => true,
					'heading'     => 'Hover Border Color 2',
					'description' => esc_html__( 'Hover Border color 2, will create gradient effect', 'ave-core' ),
					'group'       => esc_html__( 'Sticky Design Options', 'ave-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'ib_style',
						'value_not_equal_to' => array( 'btn-naked', 'btn-split' ),
					),
				),
					
			) 
		);

	}

	protected function get_button() {

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		$data['el_class'] = ' ' . $this->get_id();
		
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}
	
	public function generate_css() {
		
		extract( $this->atts );
		
		$elements     = array();
		$id           = '.' .$this->get_id();

		if( 'btn-default' === $ib_style ) {
			
			if( ! empty( $sticky_color ) && isset( $sticky_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s' )]['color'] = $sticky_color;
				$elements[liquid_implode( '.is-stuck %1$s' )]['border-color'] = $sticky_color;
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['background-color'] = $sticky_color;
				$elements[liquid_implode( '.is-stuck %1$s .btn-gradient-bg' )]['background'] = $sticky_color;
				$elements[liquid_implode( '.is-stuck %1$s .btn-gradient-bg-hover' )]['background'] = $sticky_color;
			}
			if( ! empty( $sticky_hover_color ) && isset( $sticky_hover_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['background-color'] = $sticky_hover_color;
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['border-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_hover_color;
			}
			if( ! empty( $sticky_hover_color ) && ! empty( $sticky_hover_color2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color2 ) . ' 100%)';
			} elseif ( empty( $sticky_hover_color2 ) && ! empty( $sticky_hover_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color ) . ' 100%)';
			} elseif ( ! empty( $sticky_color ) && ! empty( $sticky_color2 ) && empty( $sticky_hover_color ) && empty( $sticky_hover_color_2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_color ) . ' 0%, ' . esc_attr( $sticky_color2 ) . ' 100%)';
			}
			//Button gradient border colors
			if( ! empty( $sticky_color ) && ! empty( $sticky_color2 ) ) {
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_color2;
			}
			if( ! empty( $h_sticky_border_color ) && ! empty( $h_sticky_border_color2 ) ) { 
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $h_sticky_border_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $h_sticky_border_color2;
			} elseif( ! empty( $sticky_hover_color ) && ! empty( $sticky_hover_color2 ) ) { 
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_hover_color2;
			}elseif ( ! empty($hover_color) && empty($hover_color2) ) {
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_hover_color;
			}
			
		}
		elseif( 'btn-solid' === $ib_style ) {
			if( ! empty( $sticky_color ) && isset( $sticky_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s' )]['background-color'] = $sticky_color;
				$elements[liquid_implode( '.is-stuck %1$s' )]['border-color'] = $sticky_color;
				$elements[liquid_implode( '.is-stuck %1$s .btn-gradient-bg' )]['background'] = $sticky_color;
				$elements[liquid_implode( '.is-stuck %1$s .btn-gradient-bg-hover' )]['background'] = $sticky_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_color;
			}
			if( ! empty( $sticky_hover_color ) && isset( $sticky_hover_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['background-color'] = $sticky_hover_color;
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['border-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_hover_color;
			}			
			if( ! empty( $sticky_color ) && ! empty( $sticky_color2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-gradient-bg' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_color ) . ' 0%, ' . esc_attr( $sticky_color2 ) . ' 100%)';
			}
			if( ! empty( $sticky_hover_color ) && ! empty( $sticky_hover_color2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color2 ) . ' 100%)';
			} elseif ( empty( $sticky_hover_color2 ) && ! empty( $sticky_hover_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color ) . ' 100%)';
			}
			//Button gradient border colors
			if( ! empty( $sticky_color ) && ! empty( $sticky_color2 ) ) {
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_color2;
			} elseif ( ! empty( $sticky_color ) && empty( $sticky_color2 ) ) {
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_color;
			}

			if( ! empty( $sticky_border_color ) && ! empty( $sticky_border_color2 ) ) {
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_border_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_border_color2;
			} elseif( ! empty( $sticky_border_color ) && empty( $sticky_border_color2 ) ) {
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_border_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_border_color;
			} 

			if( ! empty( $h_sticky_border_color ) && ! empty( $h_sticky_border_color2 ) ) { 
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $h_sticky_border_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $h_sticky_border_color2;
			} elseif( ! empty( $sticky_hover_color ) && ! empty( $sticky_hover_color2 ) ) { 
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_hover_color2;
			} elseif ( ! empty($hover_color) && empty($hover_color2) ) {
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $sticky_hover_color;
				$elements[ liquid_implode( array( '.is-stuck %1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $sticky_hover_color;
			}
		} elseif ( 'btn-naked' === $ib_style || 'btn-underlined' === $ib_style ) {

			if( ! empty( $sticky_color ) && isset( $sticky_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s' )]['color'] = $sticky_color;
			}

			if( ! empty( $sticky_hover_color ) && isset( $sticky_hover_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['color'] = $sticky_hover_color;
			}

			if ( ! empty( $sticky_color ) && ! empty( $sticky_color2 ) ) {
				$elements[liquid_implode( array( '.backgroundcliptext .is-stuck %1$s .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_color ) . ' 0%, ' . esc_attr( $sticky_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '.is-stuck %1$s.btn-icon-solid .btn-icon' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_color ) . ' 0%, ' . esc_attr( $sticky_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '.backgroundcliptext .is-stuck %1$s:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_color ) . ' 0%, ' . esc_attr( $sticky_color2 ) . ' 100%)';
			}
			
			if ( !empty( $sticky_hover_color ) && !empty( $sticky_hover_color2 ) ) {
				$elements[liquid_implode( array( '.backgroundcliptext .is-stuck %1$s:hover .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '.backgroundcliptext .is-stuck %1$s:hover:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '.is-stuck %1$s.btn-icon-solid .btn-icon .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color2 ) . ' 100%)';
			} 
			elseif ( !empty( $sticky_color2 ) && !empty( $sticky_hover_color ) && empty( $sticky_hover_color2 ) ) {
				$elements[liquid_implode( array( '.backgroundcliptext .is-stuck %1$s:hover .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color ) . ' 100%)';
				$elements[liquid_implode( array( '.backgroundcliptext .is-stuck %1$s:hover:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color ) . ' 100%)';
				$elements[liquid_implode( array( '.is-stuck %1$s.btn-icon-solid:hover .btn-icon' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color ) . ' 100%)';
			}

			if ( !empty($sticky_text_color) && isset($sticky_text_color) ) {
				$elements[liquid_implode( '.is-stuck %1$s' )]['color'] = $sticky_text_color;
			}

			if ( !empty($sticky_htext_color) && isset($sticky_htext_color) ) {
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['color'] = $sticky_htext_color;
			}

		}
		if ( 'btn-split' === $ib_style ) {

			if ( ! empty( $sticky_color ) && isset( $sticky_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-split-bg' ) )]['background'] = $sticky_color;
			}
			if ( ! empty( $sticky_hover_color ) && isset( $sticky_hover_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s .btn-split-bg:hover' ) )]['background'] = $sticky_hover_color;
			}
		}

		if ( 'btn-underlined' === $ib_style ) {

			if ( ! empty( $sticky_color ) && isset( $sticky_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:before' ) )]['background'] = $sticky_color;
			}

			if ( ! empty( $sticky_hover_color ) && isset( $sticky_hover_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:after' ) )]['background'] = $sticky_hover_color;
			}

			if ( ! empty( $sticky_color ) && ! empty( $sticky_color2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:before' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_color ) . ' 0%, ' . esc_attr( $sticky_color2 ) . ' 100%)';
			}

			if ( ! empty( $sticky_hover_color ) && ! empty( $sticky_hover_color2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:after' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_hover_color ) . ' 0%, ' . esc_attr( $sticky_hover_color2 ) . ' 100%)';
			}

			if ( ! empty( $sticky_border_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:before' ) )]['background'] = $sticky_border_color;
			}

			if ( ! empty( $sticky_border_color ) && ! empty( $sticky_border_color2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:before' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $sticky_border_color ) . ' 0%, ' . esc_attr( $sticky_border_color2 ) . ' 100%)';
			}

			if ( ! empty( $h_sticky_border_color ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:after' ) )]['background'] = $h_sticky_border_color;
			}

			if ( ! empty( $h_sticky_border_color ) && ! empty( $h_sticky_border_color2 ) ) {
				$elements[liquid_implode( array( '.is-stuck %1$s:after' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $h_sticky_border_color ) . ' 0%, ' . esc_attr( $h_sticky_border_color2 ) . ' 100%)';
			}

			if ( !empty($sticky_text_color) && isset($sticky_text_color) ) {
				$elements[liquid_implode( '.is-stuck %1$s' )]['color'] = $sticky_text_color;
			}

			if ( !empty($sticky_htext_color) && isset($sticky_htext_color) ) {
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['color'] = $sticky_htext_color;
			}

		}
		
		//text colors for button label
		if ( 'btn-naked' !== $ib_style ) {

			if( ! empty( $sticky_text_color ) && isset( $sticky_text_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s' )]['color'] = $sticky_text_color;
			}	
			if( ! empty( $sticky_htext_color ) && isset( $sticky_htext_color ) ) {
				$elements[liquid_implode( '.is-stuck %1$s:hover' )]['color'] = $sticky_htext_color;
			}
			
		} else {
			
			if( !empty( $sticky_text_color ) && isset( $sticky_text_color ) && !empty( $sticky_color2 ) ) {
				$elements[liquid_implode( '.is-stuck %1$s.btn .btn-txt, .backgroundcliptext .is-stuck %1$s.btn .btn-txt' )]['color'] = $sticky_text_color;
				$elements[liquid_implode( '.is-stuck %1$s.btn .btn-txt, .backgroundcliptext .is-stuck %1$s.btn .btn-txt' )]['background'] = 'none';
				$elements[liquid_implode( '.is-stuck %1$s.btn .btn-txt, .backgroundcliptext .is-stuck %1$s.btn .btn-txt' )]['text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '.is-stuck %1$s.btn .btn-txt, .backgroundcliptext .is-stuck %1$s.btn .btn-txt' )]['-webkit-text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '.is-stuck %1$s.btn .btn-txt, .backgroundcliptext .is-stuck %1$s.btn .btn-txt' )]['background-clip'] = 'border-box !important';
				$elements[liquid_implode( '.is-stuck %1$s.btn .btn-txt, .backgroundcliptext .is-stuck %1$s.btn .btn-txt' )]['-webkit-background-clip'] = 'border-box !important';
			}	
			if( !empty( $sticky_htext_color ) && isset( $sticky_htext_color ) && !empty( $sticky_hover_color2 ) ) {
				$elements[liquid_implode( '.is-stuck %1$s.btn:hover .btn-txt', '.backgroundcliptext .is-stuck %1$s.btn:hover .btn-txt' )]['color'] = $sticky_htext_color;
				$elements[liquid_implode( '.is-stuck %1$s.btn:hover .btn-txt', '.backgroundcliptext .is-stuck %1$s.btn:hover .btn-txt' )]['text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '.is-stuck %1$s.btn:hover .btn-txt', '.backgroundcliptext .is-stuck %1$s.btn:hover .btn-txt' )]['-webkit-text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '.is-stuck %1$s.btn:hover .btn-txt', '.backgroundcliptext .is-stuck %1$s.btn:hover .btn-txt' )]['background-clip'] = 'border-box !important';
				$elements[liquid_implode( '.is-stuck %1$s.btn:hover .btn-txt', '.backgroundcliptext .is-stuck %1$s.btn:hover .btn-txt' )]['-webkit-background-clip'] = 'border-box !important';
			}
		}

		//Button border colors
		if( ! empty( $sticky_border_color ) && isset( $sticky_border_color ) ) {
			$elements[liquid_implode( array( '.is-stuck %1$s.btn-bordered' ) )]['border-color'] = $sticky_border_color;
		}
		if( ! empty( $h_sticky_border_color ) && isset( $h_sticky_border_color ) ) {
			$elements[liquid_implode( array( '.is-stuck %1$s.btn-bordered:hover' ) )]['border-color'] = $h_sticky_border_color;
		}
	
		$this->dynamic_css_parser( $id, $elements );	
		
	}

	
}
new LD_Header_Button;