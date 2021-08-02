<div class="<?php $this->get_grid_class() ?> masonry-item <?php $this->entry_term_classes() ?>">

	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>

		<div class="ld-pf-inner pos-rel">
			<div class="ld-pf-image border-radius-2 shadowed">
				<?php $this->entry_thumbnail( 'liquid-portfolio', true ); ?>
			</div><!-- /.ld-pf-image -->
		</div><!-- /.ld-pf-inner -->

		<div class="ld-pf-details">

			<div class="ld-pf-details-inner">
				<?php the_title( '<h3 class="ld-pf-title h4 font-weight-bold">', '</h3>' ) ?>
			</div><!-- /.ld-pf-details-inner -->

		</div><!-- /.ld-pf-details -->

		<?php $this->get_overlay_button(); ?>
		
	</article><!-- /.ld-pf-item -->

</div><!-- /.col-lg-3 col-md-6 -->