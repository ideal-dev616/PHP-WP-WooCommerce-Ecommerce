<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'ld-carousel-phone',
	'ld-carousel-phone-style-1',
	$el_class, 
	$this->get_id() 
);

$attachments  = $this->get_attachments();

$this->generate_css();

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="ld-carousel-phone-inner">
	
		<div class="mockup-container">
			<div class="mockup-inner">
				<figure class="text-center">
					<img src="<?php echo get_template_directory_uri() . '/assets/img/mockups/phone/mockup-1.png' ?>" alt="<?php esc_html_e( 'Phone', 'ave-core' ) ?>">
				</figure>
			</div><!-- /.mockup-inner -->
		</div><!-- /.mockup-container -->

		<div class="mockup-content-container">
			<div class="mockup-content-inner">

				<div class="carousel-container carousel-nav-floated carousel-nav-middle carousel-nav-bordered carousel-nav-circle carousel-nav-sm">
					<div class="carousel-items row" data-lqd-flickity='{ "groupCells": false, "wrapAround": true, "cellAlign": "center" }'>					
					<?php
						foreach ( $attachments as $attachment ) {
				
							$image = wp_get_attachment_image( $attachment->ID, 'full', false );
			
							echo '<div class="carousel-item col-xs-12"><figure>';
							echo $image;
							echo '</figure></div>';
				
						}
					?>
					</div><!-- /.carousel-items row -->
				</div><!-- /.carousel-container -->					

			</div><!-- /.mockup-content-inner -->
		</div><!-- /.mockup-content-container -->

	</div><!-- /.ld-carousel-laptop-inner -->

</div><!-- /.ld-carousel-laptop ld-carousel-laptop-style-1 -->