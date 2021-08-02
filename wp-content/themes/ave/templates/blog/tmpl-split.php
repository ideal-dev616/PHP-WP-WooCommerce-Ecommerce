<?php

$format = get_post_format();	

?>
<?php $this->entry_thumbnail( 'liquid-split-blog' ); ?>

<div class="liquid-blog-item-inner">
	<?php $this->overlay_link(); ?>
	<header class="liquid-lp-header">
		<h2 class="liquid-lp-title font-weight-bold h3 size-md">
			<a href="<?php the_permalink(); ?>" data-split-text="true" data-split-options='{ "type": "lines" }'><?php the_title(); ?></a>
		</h2>
		<div class="liquid-lp-details liquid-lp-details-lined size-sm text-uppercase lp-sp-1">
			<?php $this->entry_tags() ?>
			<?php
				$time_string = '<time class="published updated liquid-lp-date" datetime="%1$s">%2$s</time>';
				printf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
			?>
		</div><!-- /.liquid-lp-details -->
	</header>
	
	<?php $this->entry_content(); ?>
	
	<footer class="liquid-lp-footer">
		<a href="<?php the_permalink(); ?>" class="btn btn-naked text-uppercase ltr-sp-1 size-sm font-weight-bold liquid-lp-read-more">
			<span>
				<span class="btn-line btn-line-before"></span>
				<span class="btn-txt"><?php esc_html_e( 'Continue Reading', 'ave' ); ?></span>
				<span class="btn-line btn-line-after"></span>
			</span>
		</a>
	</footer>
	
</div><!-- /.liquid-blog-item-inner -->