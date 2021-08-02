<div class="<?php $this->get_grid_class() ?> masonry-item <?php $this->entry_term_classes() ?>">
	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="ld-pf-inner">

			<div class="ld-pf-image">				
				<?php $this->entry_thumbnail( 'liquid-portfolio', true ); ?>
			</div><!-- /.ld-pf-image -->

			<div class="ld-pf-bg"></div><!-- /.ld-pf-bg -->

			<div class="ld-pf-details" data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".ld-pf-item", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": ".split-inner", "startDelay": 80, "duration": 650, "delay": 150, "initValues": { "translateY": "150%" }, "animations": { "translateY": "0", "rotateX": 0 } }'>

				<div class="ld-pf-details-inner">

					<?php the_title( '<h3 class="ld-pf-title h4 text-uppercase" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>', '</h3>' ) ?>
					
					<?php $this->entry_cats() ?>

				</div><!-- /.ld-pf-details-inner -->

			</div><!-- /.ld-pf-details -->

			<?php $this->get_overlay_button(); ?>

		</div><!-- /.ld-pf-inner -->
	</article><!-- /.ld-pf-item -->
</div><!-- /.col-lg-4 col-md-6 -->