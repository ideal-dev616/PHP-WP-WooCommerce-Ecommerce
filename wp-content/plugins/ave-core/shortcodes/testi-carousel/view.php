<?php

extract( $atts );

if( empty( $items ) ) {
	return '';
}

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'testimonial-slider', $el_class, $this->get_id() );

$this->generate_css();

$quotesID = uniqid( 'carousel-quotes-' );
$detailsID = uniqid( 'carousel-details-' );

?>
<div class="carousel-container carousel-nav-floated <?php echo $quotesID ?>">

	<div class="carousel-items row testimonials-quote-only" data-lqd-flickity='{ "prevNextButtons": true, "buttonsAppendTo": ".<?php echo $detailsID ?>", "navOffsets": { "nav": { "top": "30%" } } }'>

		<?php foreach ( $items as $item ) : ?>

			<div class="carousel-item col-xs-12">
				<div class="testimonial testimonial-xl testimonial-details-sm text-center testimonials-quote-only">
	
					<?php if( $item['content'] ) { ?>
					<div class="testimonial-quote">
						<blockquote>
							<?php echo wp_kses_post( ld_helper()->do_the_content( $item['content'], true ) ); ?>
						</blockquote>
					</div><!-- /.testimonial-qoute -->
					<?php } ?>
					
				</div><!-- /.testimonial -->
			</div><!-- /.col-xs-12 -->
		
		<?php endforeach; ?>

	</div><!-- /.carousel-items -->

</div><!-- /.carousel-container -->

<div class="carousel-container carousel-nav-floated pos-rel <?php echo $detailsID ?>">

	<div class="carousel-items row testimonials-details" data-lqd-flickity='{ "prevNextButtons": false, "asNavFor": ".<?php echo $quotesID ?> [data-lqd-flickity]" }'>

		<?php foreach ( $items as $item ) : ?>
			<div class="carousel-item col-lg-3 col-md-4 col-xs-6">
				<div class="testimonial testimonial-xl testimonial-details-sm text-center testimonials-details-only <?php echo $item['avatar_size']; ?>">

					<div class="testimonial-details">
						<?php
		
							if( $item['image'] ) {
								
								if( preg_match( '/^\d+$/', $item['image'] ) ){
									$image = wp_get_attachment_image_src( $item['image'], 'full' );
									$src = $image[0];
								} else {
									$src = $item['image'];
								}						
						?>
						<figure class="avatar">
							<img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $item['author' ]); ?>" />
						</figure>
						<?php } ?>
						<?php if( $item['author'] ) { ?>
							<div class="testimonial-info">
								<h5 class="<?php echo $item['author_weight']; ?>"><?php echo esc_html( $item['author' ]); ?></h5>
							</div><!-- /.testimonial-info -->
						<?php } ?>
					</div><!-- /.testimonial-details -->
					
				</div><!-- /.testimonial -->
			</div><!-- /.col-lg-3 -->
		<?php endforeach; ?>
		
	</div><!-- /.carousel-items -->

</div><!-- /.carousel-container -->