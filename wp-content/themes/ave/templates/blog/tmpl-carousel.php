
<?php $this->entry_thumbnail( 'full', array(), true ); ?>

<div class="liquid-blog-item-inner">
	<?php $this->overlay_link(); ?>

	<header class="liquid-lp-header">
		<h2 class="liquid-lp-title size-lg font-weight-bold h3" data-fittext="true" data-fittext-options='{ "maxFontSize": "currentFontSize", "compressor": 0.6 }'>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="liquid-lp-details liquid-lp-details-lined size-sm text-uppercase lp-sp-1">
			<?php $this->entry_tags(); ?>
			<?php
				$time_string = '<time class="published updated liquid-lp-date" datetime="%1$s">%2$s</time>';
				printf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
			?>
		</div><!-- /.liquid-lp-details -->
	</header>

</div><!-- /.liquid-blog-item-inner -->
