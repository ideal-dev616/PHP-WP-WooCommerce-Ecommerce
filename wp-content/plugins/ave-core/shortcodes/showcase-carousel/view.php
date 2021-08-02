<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'carousel-container',
	'lqd-showcase-carousel',
	'carousel-nav-floated',
	'carousel-nav-center',
	'carousel-nav-middle',
	'carousel-nav-xl',
	'carousel-nav-bordered',
	'carousel-nav-circle',
	'carousel-nav-shadowed-onhover',
	$atts['el_class'], 
	$this->get_id() 
);

$this->generate_css();
	
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="carousel-items row" data-lqd-flickity='{ "prevNextButtons": true, "navArrow": "1", "pageDots": false, "wrapAround": true, "equalHeightCells": true,"navArrow":{"prev":"<i class=\"icon-ion-ios-arrow-round-back\"></i>","next":"<i class=\"icon-ion-ios-arrow-round-forward\"></i>"},"navOffsets":{"prev":"-10%","next":"-10%"} }'>

	<?php foreach ( $identities as $slides ) { 
		
		$width = wpb_translateColumnWidthToSpan( $slides['width'] );
	?>

		<div class="carousel-item <?php echo $width; ?>">

			<div class="lqd-showcase d-flex flex-column text-center">
				
				<button
				class="lqd-showcase-video-trigger liquid-overlay-link"
				data-video-trigger="true"
				data-trigger-options='{ "videoPlacement": "parent" }'>
					<?php esc_html_e( 'Play', 'ave-core' ); ?>
				</button>

				<?php if( !empty( $slides['title'] ) ) { ?>
				<h2 class="mt-0"><?php echo esc_html( $slides['title'] ) ?></h2>
				<?php } ?>
				
				
				<div class="lqd-showcase-video mb-5">
					<video width="100%" height="100%" loop>						
					<?php if( !empty( $slides['video_local_mp4_url'] ) ) { 
							echo '<source src="'. esc_url( $slides['video_local_mp4_url'] ) .'" type="video/mp4">'; 
					} ?>
					<?php if( !empty( $slides['video_local_webm_url'] ) ) {
						echo '<source src="' . esc_url( $slides['video_local_webm_url'] ) . '" type="video/webm">';
					} ?>
					</video>
				</div><!-- /.lqd-showcase-video -->
				
				<?php if( !empty( $slides['subtitle'] ) ) { ?>
				<h6 class="my-0"><?php echo esc_html( $slides['subtitle'] ) ?></h6>
				<?php } ?>
			
			</div><!-- /.lqd-showcase -->

		</div><!-- /.carousel-item -->

	<?php } ?>	

	</div><!-- /.carousel-items row -->

</div><!-- /.carousel-container -->