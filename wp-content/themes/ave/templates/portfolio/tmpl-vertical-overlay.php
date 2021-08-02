<div class="carousel-item col-lg-4 col-md-6 col-xs-12 <?php $this->entry_term_classes() ?>">	
	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="ld-pf-inner">
			
			<div class="ld-pf-image">
				<?php $this->entry_thumbnail( 'liquid-portfolio-vertical-overlay', true ); ?>
			</div><!-- /.ld-pf-image -->
			
			<div class="ld-pf-details">

				<div class="ld-pf-bg" style="background-color: #fff;"></div><!-- /.ld-pf-bg -->

				<div class="ld-pf-details-inner">
					
					<?php the_title( '<h3 class="ld-pf-title h4 font-weight-bold mb-3">', '</h3>' ) ?>

					<div class="pf-extra-arrow">
						<svg viewBox="0 0 32 32" width="32" height="32" stroke="#444444" stroke-width="2" fill="none">
							<line x1="0" y1="16" x2="30" y2="16"></line>
							<line x1="29.437477268313835" y1="15.812499336899357" x2="20.62687498893718" y2="7.001897057522699"></line>
							<line x1="29.312477462028617" y1="15.999999046327163" x2="20.659231009526074" y2="24.653245498829705" ></line>
						</svg>

					</div><!-- /.pf-extra-arrow mb-3 -->

					<?php $this->entry_subtitle( '<p>', '</p>' ) ?>

				</div><!-- /.ld-pf-details-inner -->
			</div><!-- /.ld-pf-details -->
			
			<?php $this->get_overlay_button(); ?>
			
		</div><!-- /.ld-pf-inner -->
	</article><!-- /.ld-pf-item -->
</div><!-- /.carousel-item col-lg-4 col-md-6 col-xs-12 -->