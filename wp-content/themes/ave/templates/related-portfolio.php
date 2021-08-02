<div class="pf-related-posts pb-5">

	<div class="container pb-5">

		<div class="row">

			<?php if( 'style2' === $style ) {  ?>
			
			
				<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
				<?php $thumb_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'liquid-rounded-blog' ); ?>
					<div class="col-md-4">
						
						<article class="pf-related pf-related-alt" data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": "this", "offTriggerHandler": "mouseleave", "direction": "forward", "animationTarget": ".pf-related-cat li, .split-inner", "duration": 650, "direction": "backward", "delay": 50, "initValues": { "translateY": "0", "opacity": 1 }, "animations": { "translateY": -20, "opacity": 0 } }'>
		
							<figure data-responsive-bg="true" data-parallax="true" data-parallax-options='{ "parallaxBG": true, "scaleBG": false }' data-parallax-from='{ "translateY": 0, "scale": 1 }' data-parallax-to='{ "translateY": 0, "scale": 1.3 }'>
								<?php liquid_the_post_thumbnail( 'liquid-rounded-blog', null, false ); ?>
							</figure>
		
							<header>
								<?php
									$terms = get_the_terms( get_the_ID(), $taxonomy );
									$term = $terms[0];
									if( isset( $term ) ) {
										echo '<ul class="pf-related-cat text-uppercase ltr-sp-1 reset-ul comma-sep-li mb-2"><li><a href="' . get_term_link( $term->slug, $taxonomy ) . '">' . esc_html( $term->name ) . '</a></li></ul>';
									}
								?>
								<h2 class="pf-related-title h3 mt-0 font-weight-bold">
									<a href="<?php the_permalink() ?>" data-split-text="true" data-split-options='{ "type": "lines" }'><?php the_title() ?></a>
								</h2>
							</header>
		
							<a href="<?php the_permalink() ?>" class="liquid-overlay-link"></a>
						</article>
						
					</div><!-- /.col-lg-4 -->
				<?php endwhile; ?>
			
			
			<?php } else {  ?>
			
				<?php if( !empty( $heading ) ) { ?>
				<div class="col-lg-4 col-md-3">
					<h6 class="mb-5"><?php echo esc_html( $heading ) ?></h6>
				</div><!-- /.col-lg-4 col-md-3 -->
				<?php } ?>
		
				<div class="<?php echo ( empty( $heading ) ? 'col-lg-12 col-md-12' : 'col-lg-8 col-md-9' ) ?>">
					<div class="row d-flex flex-row flex-wrap">
		
						<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
		
							<div class="col-lg-4">
		
								<article class="pf-related pr-lg-4">
		
									<header>
										<h2 class="pf-related-title h3 mt-0 font-weight-bold">
											<a href="<?php the_permalink() ?>" data-split-text="true" data-split-options='{ "type": "lines" }' data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".pf-related", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": ".split-inner", "duration": 850, "delay": 70, "startDelay": 130, "initValues": { "opacity": 1 }, "animations": { "opacity": 0 } }'><?php the_title() ?></a>
											<a href="<?php the_permalink() ?>" rel="bookmark" class="title-shad" data-split-text="true" data-split-options='{ "type": "lines" }' data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".pf-related", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": ".split-inner", "duration": 650, "delay": 70, "initValues": { "width": 0 }, "animations": { "width": "100%" } }'><?php the_title() ?></a>
										</h2>
										<?php
											$terms = get_the_terms( get_the_ID(), $taxonomy );
											$term = $terms[0];
											if( isset( $term ) ) {
												echo '<ul class="pf-related-cat text-uppercase ltr-sp-1 reset-ul comma-sep-li"><li><a href="' . get_term_link( $term->slug, $taxonomy ) . '">' . esc_html( $term->name ) . '</a></li></ul>';
											}
										?>
									</header>
		
									<a href="<?php the_permalink() ?>" class="liquid-overlay-link"></a>	
		
								</article>
			
							</div><!-- /.col-lg-4 -->
		
						<?php endwhile; ?>
		
					</div><!-- /.row -->
		
				</div><!-- /.col-lg-8 col-md-9 -->

			<?php } ?>


		</div><!-- /.row -->

	</div><!-- /.container -->

</div><!-- /.pf-related-posts -->

<?php wp_reset_postdata();