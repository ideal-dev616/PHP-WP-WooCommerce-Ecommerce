<?php

extract( $atts );

$classes = array( 
	'lqd-mockup-device', 
	$this->get_class( $style ),
	'pos-rel',
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

$attachments  = $this->get_attachments();

?>
 
 <div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="lqd-mockup-inner">
	
		<div class="lqd-mockup-container pos-rel z-index-4">
			<div class="lqd-mockup-inner">
				<figure class="text-center">
					<?php $this->get_mockup(); ?>
				</figure>
			</div><!-- /.mockup-inner -->
		</div><!-- /.mockup-container -->

		<div class="lqd-mockup-content-container pos-abs z-index-0 overflow-hidden">
			<div class="lqd-mockup-content-inner ld-overlay">
				
				<div class="carousel-container ld-overlay carousel-nav-floated carousel-nav-middle carousel-nav-solid carousel-nav-circle">

					<div
					class="carousel-items ld-overlay row mx-0"
					data-lqd-flickity='{ "prevNextButtons": true, "navArrow": { "prev": "<i class=\"icon-md-arrow-round-back\"></i>", "next": "<i class=\"icon-md-arrow-round-forward\"></i>" }, "groupCells": false, "wrapAround": true, "cellAlign": "center" }'>
						
						<?php foreach ( $attachments as $attachment ) { ?>
						<div class="carousel-item w-100">

							<figure class="bg-cover bg-center" data-responsive-bg="true">
								<?php echo wp_get_attachment_image( $attachment->ID, 'full', false, array( 'class' => 'invisible' ) ); ?>
							</figure>

						</div><!-- /.carousel-item -->
						<?php } ?>

					</div><!-- /.carousel-items row -->

				</div><!-- /.carousel-container -->
								
			</div><!-- /.mockup-content-inner -->
		</div><!-- /.mockup-content-container -->

	</div><!-- /.lqd-mockup-inner -->

</div><!-- /.lqd-mockup-devices lqd-mockup-imac-style-1 -->