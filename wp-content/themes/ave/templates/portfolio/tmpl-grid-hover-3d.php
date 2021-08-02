<div class="<?php $this->get_grid_class() ?> masonry-item <?php $this->entry_term_classes() ?>">
	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>

		<div class="ld-pf-wrap" data-hover3d="true" data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": "this", "offTriggerHandler": "mouseleave", "easing": "easeOutQuint", "duration": 850, "offDuration": 850, "initValues": { "scale": 1 }, "animations": { "scale": 1.13 } }'>

			<div class="ld-pf-inner" data-stacking-factor="0.8">

				<div class="ld-pf-image">
					<?php $this->entry_thumbnail( 'liquid-grid-hover-3d' ); ?>
				</div><!-- /.ld-pf-image -->

				<div class="ld-pf-bg"></div><!-- /.ld-pf-bg -->
				
				<div class="ld-pf-details py-3">

					<div class="ld-pf-details-inner justify-content-between">

							<?php $this->entry_cats() ?>

						<div class="ld-pf-details-inner">

							<?php the_title( '<h3 class="ld-pf-title h4">', '</h3>' ); ?>
							<?php $this->entry_subtitle( '<p>', '</p>' ) ?>

						</div><!-- /.ld-pf-details-inner -->
						<?php
							$time_string = '<time class="published updated text-uppercase ltr-sp-1" datetime="%1$s">%2$s</time>';
							printf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								get_the_date()
							);
						?>
					</div><!-- /.ld-pf-details-inner -->
				</div><!-- /.ld-pf-details -->

				<?php $this->get_overlay_button(); ?>

			</div><!-- /.ld-pf-inner -->

		</div><!-- /.ld-pf-wrap -->

	</article><!-- /.ld-pf-item -->

</div><!-- /.col-lg-4 col-md-6 -->