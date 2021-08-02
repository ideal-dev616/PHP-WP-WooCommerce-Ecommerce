<?php

extract( $atts );

$classes = array( 
	'lqd-promo-wrap',
	'lqd-promo-alt',
	$content_alignment,

	$el_class, 
	$this->get_id() 
);

$this->generate_css();

$bg_color = !empty( $overlay_color ) ? $overlay_color : '#fff';

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-promo-inner">

		<div class="lqd-promo-img">
			<div class="lqd-promo-img-inner" data-reveal="true" data-reveal-options='{ "direction": "rl", "bgcolor": "<?php echo esc_attr( $bg_color ); ?>", "revealSettings": { "duration": 800, "onCoverAnimations": { "scale": [2, 1] } } }'>
				<?php $this->get_image(); ?>
			</div><!-- /.lqd-promo-img-inner -->
		</div><!-- /.lqd-promo-img -->

		<div class="lqd-promo-content"
			data-custom-animations="true"
			data-ca-options='{ "triggerHandler": "inview", "animationTarget": "h3, h4, h5, h6, p:not([data-split-text]), .btn", "delay": 250, "duration": 800, "startDelay": 900, "initValues": { "translateY": 30, "opacity": 0 }, "animations": { "translateY": 0, "opacity": 1 } }'
		>
			<div class="lqd-promo-cat"
			data-custom-animations="true"
			data-ca-options='{ "triggerHandler": "inview", "animationTarget": "li", "duration": 800, "delay": 100, "initValues": { "translateX": 15, "opacity": 0 }, "animations": { "translateX": 0, "opacity": 1 } }'
			>
				<?php $this->get_label(); ?>
			</div><!-- /.lqd-promo-cat -->
			<h2
				class="mb-4"
				data-split-text="true"
				data-split-options='{ "type": "chars, words" }'
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 800, "startDelay": 300, "delay": 25, "initValues": { "translateY": 25, "translateX": 15, "rotate": 12, "opacity": 0 }, "animations": { "translateY": 0, "translateX": 0, "rotate": 0, "opacity": 1 } }'
			><?php echo esc_html( $title ); ?></h2>
			<?php $this->get_content(); ?>
			<?php $this->get_button() ?>
		</div><!-- /.lqd-promo-content -->

	</div><!-- /.lqd-promo-inner -->
</div><!-- /.lqd-promo-wrap -->