<div class="<?php $this->get_grid_class() ?> masonry-item <?php $this->entry_term_classes() ?>">

	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?> data-hover3d="true">

		<div class="ld-pf-inner">

			<div class="ld-pf-image" data-stacking-factor="0.5">
				<?php $this->entry_thumbnail( 'liquid-grid-caption', false ); ?>
			</div><!-- /.ld-pf-image -->
			<div class="ld-pf-details pl-0 py-4">
				<div class="ld-pf-bg"></div><!-- /.ld-pf-bg -->
				<div class="ld-pf-details-inner">
					
					<?php the_title( '<h3 class="ld-pf-title h4">', '</h3>' ) ?>
					<?php $this->entry_subtitle( '<p>', '</p>' ) ?>

				</div><!-- /.ld-pf-details-inner -->
			</div><!-- /.ld-pf-details -->

			<?php $this->get_overlay_button(); ?>

		</div><!-- /.ld-pf-inner -->
	</article><!-- /.ld-pf-item -->
</div><!-- /.col-lg-3 col-md-6 -->