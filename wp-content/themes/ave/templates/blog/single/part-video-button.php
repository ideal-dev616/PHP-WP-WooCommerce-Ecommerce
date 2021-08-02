<?php
	
$enable = liquid_helper()->get_option( 'post-video-btn-enable' );
if( 'on' !== $enable ) {
	return;
}
$url   = liquid_helper()->get_option( 'post-video-btn-url' );
$label = liquid_helper()->get_option( 'post-video-btn-label' );
		
?>
<div class="blog-single-details-extra">
	<a href="<?php echo esc_url( $url ); ?>" class="lightbox-link fresco">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" stroke="#000" stroke-width="1px" width="71.5px" height="71.5px">
			<path fill-rule="evenodd"  stroke-linecap="butt" stroke-linejoin="miter" d="M35.500,0.500 C54.830,0.500 70.500,16.170 70.500,35.500 C70.500,54.830 54.830,70.500 35.500,70.500 C16.170,70.500 0.500,54.830 0.500,35.500 C0.500,16.170 16.170,0.500 35.500,0.500 Z"/>
			<path fill-rule="evenodd" stroke-linecap="butt" stroke-linejoin="miter" d="M49.410,35.676 L28.165,47.942 L28.165,23.410 L49.410,35.676 Z"/>
		</svg>
		<?php if( ! empty( $label ) ) { ?>
			<span class="text-uppercase ltr-sp-1"><?php echo esc_html( $label ); ?></span>
		<?php } ?>
	</a>
</div><!-- /.blog-single-details-extra -->