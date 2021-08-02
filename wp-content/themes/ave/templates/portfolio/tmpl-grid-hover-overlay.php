<div class="<?php $this->get_grid_class() ?> masonry-item <?php $this->entry_term_classes() ?>">
	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="ld-pf-inner">

			<div class="ld-pf-image">
				<?php $this->entry_thumbnail( 'liquid-grid-hover-overlay', true ); ?>
			</div><!-- /.ld-pf-image -->

			<div class="ld-pf-details py-3">

				<div class="ld-pf-bg" style="background-color: #fff;" data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".ld-pf-item", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": "this", "easing": "easeInOutCirc", "duration": 850, "offDuration": 700, "initValues": { "translateY": 0 }, "animations": { "translateY": -70 } }'></div><!-- /.ld-pf-bg -->
				<div class="ld-pf-details-inner" data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".ld-pf-item", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": ".split-inner", "easing": "easeOutQuint", "duration": 850, "offDuration": 750, "startDelay": 280, "offDelay": 280, "delay": 60, "initValues": { "translateY": 0 }, "animations": { "translateY": -70 } }'>
					<?php the_title( '<h3 class="ld-pf-title h4" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>', '</h3>' ) ?>
					<?php $this->entry_subtitle( '<p data-split-text="true" data-split-options=\'{ "type": "lines" }\'>', '</p>' ) ?>

				</div><!-- /.ld-pf-details-inner -->
			</div><!-- /.ld-pf-details -->

			<?php $this->get_overlay_button(); ?>

		</div><!-- /.ld-pf-inner -->
	</article><!-- /.ld-pf-item -->
</div><!-- /.col-lg-4 col-md-6 -->