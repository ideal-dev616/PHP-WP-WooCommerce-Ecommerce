<?php 

$text = liquid_helper()->get_option( 'post-extra-text' );

if( empty( $text ) ) {
	return;
}
	
?>
<div class="blog-single-details-extra">
	<?php echo do_shortcode( wp_kses_post( $text ) ); ?>
</div><!-- /.blog-single-details-extra -->