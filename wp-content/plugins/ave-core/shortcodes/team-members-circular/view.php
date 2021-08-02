<?php

extract( $atts );

// classes
$classes = array(
	'ld-tm-circ',
	$el_class, 
	$this->get_id()
);

$this->generate_css();

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" <?php $this->enable_animation() ?> data-ca-options='{ "triggerHandler": "inview", "animationTarget": ".ld-tm-bg", "duration": 700, "delay": 100, "easing": "easeOutBack", "initValues": { "scale": 0 }, "animations": { "scale": 1 } }'>
	<div class="ld-tm-container" <?php $this->enable_animation() ?> data-ca-options='{ "triggerHandler": "inview", "animationTarget": ".ld-tm-avatar", "duration": 700, "delay": 150, "easing": "easeOutBack", "initValues": { "scale": 0 }, "animations": { "scale": 1 } }'>
		
		
		<div class="ld-tm-circ-inner">			
			<div class="ld-tm-bg"></div><!-- /.ld-tm-bg -->
			<?php $this->get_items( $inner_items ); ?>
		</div><!-- /.ld-tm-circ-inner -->

		<div class="ld-tm-circ-middle">
			<div class="ld-tm-bg"></div><!-- /.ld-tm-bg -->
			<?php $this->get_items( $middle_items ); ?>
		</div><!-- /.ld-tm-circ-middle -->
		
		<div class="ld-tm-circ-outer">
			<div class="ld-tm-bg"></div><!-- /.ld-tm-bg -->
			<?php $this->get_items( $outer_items ); ?>
		</div><!-- /.ld-tm-circ-outer -->

	</div><!-- /.ld-tm-container -->
</div><!-- /.ld-tm-circ -->