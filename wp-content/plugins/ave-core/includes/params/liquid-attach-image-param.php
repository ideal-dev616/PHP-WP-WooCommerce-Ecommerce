<?php
/**
 * Attach images shortcode attribute type generator.
 *
 * @param $settings
 * @param $value
 *
 * @since 4.4
 *
 * @param $tag
 * @param bool $single
 *
 * @return string - html string.
 */
vc_add_shortcode_param( 'liquid_attach_image', 'liquid_attach_images_form_field' );
function liquid_attach_images_form_field( $settings, $value ) {

	$output = '';
	$output .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '
	           . $settings['param_name'] . ' '
	           . $settings['type'] . '" name="' . $settings['param_name'] . '" value="' . $value . '"/>';
	$output .= '<div class="gallery_widget_attached_images">';	
	$output .= '<ul class="gallery_widget_attached_images_list">';

	if( strpos( $value, "http://" ) !== false || strpos( $value, "https://" ) !== false ) {
		$output .= '<li class="added">
						<img src="' . esc_url( $value ) . '" />
						<a href="#" class="vc_icon-remove"><i class="vc-composer-icon vc-c-icon-close"></i></a>
					</li>';
	
	} else {
		$output .= ( '' !== $value ) ? fieldAttachedImages( explode( ',', $value ) ) : '';
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<div class="gallery_widget_site_images">';
	$output .= '</div>';
	$output .= '<a class="gallery_widget_add_images" href="#" use-single="true" title="'
		. esc_html__( 'Add image', 'ave-core' ) . '"><i class="vc-composer-icon vc-c-icon-add"></i>' . esc_html__( 'Add image', 'ave-core' ) . '</a>'; //class: button

	return $output;
}