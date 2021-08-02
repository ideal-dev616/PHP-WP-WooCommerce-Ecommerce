<?php
/**
 * Default header template
 *
 * @package Ave
 */

$header = liquid_get_header_layout();
?>
<header <?php liquid_helper()->attr( 'header', $header['attributes'] ); ?>>
<?php
	$header_content = get_post_field( 'post_content', $header['id'] );
	$header_content = str_replace( 'vc_row', 'ld_header_row', $header_content );
	$header_content = str_replace( 'vc_column', 'ld_header_column', $header_content );
	echo do_shortcode( $header_content );
?>
</header>