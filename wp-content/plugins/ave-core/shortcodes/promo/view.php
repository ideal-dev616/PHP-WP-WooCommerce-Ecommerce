<?php

extract( $atts );

$classes = array( 
	'lqd-promo-wrap',
	$content_alignment,

	$el_class, 
	$this->get_id() 
);

$this->generate_css();

$bg_color = !empty( $overlay_color ) ? $overlay_color : '#FE055E';

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-promo-inner">

		<?php $this->get_dynamic_shape(); ?>			
		<?php $this->get_label(); ?>

		<div class="lqd-promo-img">
			<div class="lqd-promo-img-inner" data-reveal="true" data-reveal-options='{ "direction": "rl", "bgcolor": "<?php echo esc_attr( $bg_color ); ?>", "revealSettings": { "onCoverAnimations": { "scale": [2, 1] } } }'>
				<?php $this->get_image(); ?>
			</div><!-- /.lqd-promo-img-inner -->
		</div><!-- /.lqd-promo-img -->

		<div class="lqd-promo-content"
			data-custom-animations="true"
			data-ca-options='{ "triggerHandler": "inview", "animationTarget": "h3, h4, h5, h6, p:not([data-split-text]), .btn", "delay": 250, "duration": 800, "startDelay": 1300, "initValues": { "translateY": 70, "opacity": 0 }, "animations": { "translateY": 0, "opacity": 1 } }'
		>
			<?php $this->get_title(); ?>
			<?php $this->get_content(); ?>
			<?php $this->get_button() ?>

		</div><!-- /.lqd-promo-content -->

	</div><!-- /.lqd-promo-inner -->
</div><!-- /.lqd-promo-wrap -->