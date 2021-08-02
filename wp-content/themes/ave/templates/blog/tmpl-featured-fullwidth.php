<?php

$format = get_post_format();
$label  = get_post_meta( get_the_ID(), 'liquid-featured-label', true );
$this->entry_thumbnail( 'full', array(), true ); 

?>
<div class="liquid-blog-item-inner">
	<?php $this->overlay_link(); ?>
	<header class="liquid-lp-header">
		<?php if( ! empty( $label ) ) { ?>
			<span class="liquid-lp-featured-label"><?php echo esc_html( $label ); ?></span>
		<?php } ?>
		<h2 class="liquid-lp-title font-weight-bold h3 size-xl" data-fittext="true" data-fittext-options='{ "compressor": 1, "maxFontSize": "currentFontSize" }'>
			<a href="<?php the_permalink(); ?>" data-split-text="true" data-split-options='{ "type": "lines" }'><?php the_title(); ?></a>
		</h2>

		<div class="liquid-lp-details size-lg">
			<time class="liquid-lp-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'ave' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
			<?php esc_html_e( 'in', 'ave' ); ?>
			<?php $this->entry_tags( 'underlined-onhover' ); ?>
		</div><!-- /.liquid-lp-details -->

	</header>
	<footer class="liquid-lp-footer">
		<a href="<?php the_permalink(); ?>" class="btn btn-bordered border-thick text-uppercase ltr-sp-1 size-md font-weight-bold liquid-lp-read-more">
			<span>
				<span class="btn-txt"><?php esc_html_e( 'Continue Reading', 'ave' ); ?></span>
			</span>
		</a>
	</footer>	
</div><!-- /.liquid-blog-item-inner -->