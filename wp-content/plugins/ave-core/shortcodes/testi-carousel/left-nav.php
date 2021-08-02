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
<div class="carousel-container carousel-nav-left">
	
	<div class="row">
		
		<div class="col-md-3 col-xs-12 mb-4 mb-md-0">
			
			<div class="carousel-items row testimonials-details w-100 row" data-lqd-flickity='{ "asNavFor": ".<?php echo $quotesID ?>", "rightToLeft": true }'>
				
				<?php foreach ( $items as $item ) : ?>
					
					<div class="col-md-4 col-sm-3 col-xs-4">
						
						<div class="testimonial testimonial-lg testimonial-details-sm text-right testimonials-details-only <?php echo $item['avatar_size']; ?>">
							
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
								<div class="testimonial-info">
									<h5 class="<?php echo $item['author_weight']; ?>"><?php echo esc_html( $item['author' ]); ?></h5>
									<?php if( !empty( $item['text' ] ) ) { ?>
									<h6><?php echo esc_html( $item['text' ] ); ?></h6>
									<?php } ?>
								</div><!-- /.testimonial-info -->
							</div><!-- /.testimonial-details -->
							
						</div><!-- /.testimonial -->
						
					</div><!-- /.col-md-3 col-xs-12 -->
					
				<?php endforeach; ?>
				
			</div><!-- /.carousel-items -->
			
		</div><!-- /.col-md-3 col-xs-12 -->
		
		<div class="col-md-8 col-md-offset-1 col-xs-offset-0 col-xs-12">
			
			<div class="carousel-items row testimonials-quotes row <?php echo $quotesID ?>" data-lqd-flickity='{ "prevNextButtons": true, "navStyle": 2, "navOffsets": { "nav": { "left": 15 } }, "rightToLeft": true }'>
				
				<?php foreach ( $items as $item ) : ?>
				
					<div class="col-xs-12">
						
						<div class="testimonial testimonial-lg testimonial-details-sm text-left testimonials-quote-only">
							
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
			
		</div><!-- /.col-lg-9 col-lg-offset-1 -->
		
	</div><!-- /.row -->
	
</div><!-- /.carousel-container -->