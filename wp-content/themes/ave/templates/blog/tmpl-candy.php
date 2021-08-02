<?php

$format = get_post_format();	

?>

<div class="liquid-blog-item-inner">

	<a href="<?php the_permalink(); ?>" class="liquid-overlay-link"><?php the_title(); ?></a>

	<figure class="liquid-lp-media">
		<div class="liquid-lp-media-frame">
			<span class="liquid-lp-frame-bar top"></span>
			<span class="liquid-lp-frame-bar right"></span>
			<span class="liquid-lp-frame-bar bottom"></span>
			<span class="liquid-lp-frame-bar left"></span>
		</div><!-- /.liquid-lp-media-frame -->

		<a href="<?php the_permalink(); ?>">
			<?php liquid_the_post_thumbnail( 'liquid-candy-blog' ); ?>
		</a>

	</figure>

	<header class="liquid-lp-header">
		<h2 class="liquid-lp-title size-sm font-weight-normal mb-1">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
	</header>

	<!-- <div class="liquid-lp-excerpt">
		<p>The goal of every tourist booking is to turn potential leads into guests.</p>
	</div> -->

	<footer class="liquid-lp-footer">

		<div class="liquid-lp-details liquid-lp-details-lined liquid-lp-details-lined-alt size-sm font-style-italic text-uppercase lp-sp-1" data-split-text="true" data-split-options='{ "type": "chars, words" }' data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".liquid-lp", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": ".lqd-chars .split-inner", "duration": 170, "delay": 15, "offDuration": 100, "easing": "easeOutCirc", "initValues": { "translateY": 0, "opacity": 1 }, "animations": { "translateY": -10, "opacity": 0 } }'>
			<?php $this->entry_tags() ?>
			<?php
				$time_string = '<time class="published updated liquid-lp-date" datetime="%1$s">%2$s</time>';
				printf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
			?>

		</div>

		<a href="#" class="btn btn-naked text-uppercase ltr-sp-1 size-xs font-style-italic liquid-lp-read-more liquid-lp-read-more-overlay"data-split-text="true" data-split-options='{ "type": "chars, words" }' data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".liquid-lp", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": ".split-inner", "duration": 150, "delay": 15, "startDelay": 100, "offDuration": 100, "easing": "easeOutCirc", "initValues": { "translateY": 10, "opacity": 0 }, "animations": { "translateY": 0, "opacity": 1 } }'>
			<span>
				<span class="btn-txt"><?php esc_html_e( 'Continue Reading', 'ave' ); ?></span>
			</span>
		</a>
	</footer><!-- /.ld-pf-details -->

</div><!-- /.liquid-blog-item-inner -->