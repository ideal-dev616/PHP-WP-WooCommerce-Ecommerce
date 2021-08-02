<div class="<?php $this->get_grid_class() ?> masonry-item <?php $this->entry_term_classes() ?>">
	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="ld-pf-inner">

			<div class="ld-pf-image">
				
				<?php $this->entry_thumbnail(); ?>

				<div class="ld-pf-bg">
					<?php $this->entry_button(); ?>
				</div><!-- /.ld-pf-bg -->

			</div><!-- /.ld-pf-image -->

			<div class="ld-pf-details pl-0 py-3">
				<div class="ld-pf-details-inner">

					<?php the_title( '<h3 class="ld-pf-title h4">', '</h3>' ); ?>
					<?php $this->entry_cats() ?>

				</div><!-- /.ld-pf-details-inner -->
			</div><!-- /.ld-pf-details -->

			<?php $this->get_overlay_button(); ?>

		</div><!-- /.ld-pf-inner -->
	</article><!-- /.ld-pf-item -->
</div><!-- /.col-lg-4 col-md-6 -->