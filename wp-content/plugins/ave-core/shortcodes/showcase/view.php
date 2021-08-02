<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-showcase d-flex flex-column text-center',
	$atts['el_class'], 
	$this->get_id() 
);

$this->generate_css();
	
?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<button
	class="lqd-showcase-video-trigger liquid-overlay-link"
	data-video-trigger="true"
	data-trigger-options='{ "videoPlacement": "parent" }'>
		<?php esc_html_e( 'Play', 'ave-core' ); ?>
	</button>
	
	<?php echo $this->get_title(); ?>

	<div class="lqd-showcase-video mb-5">
		<?php $this->get_video(); ?>
	</div><!-- /.lqd-showcase-video -->

	<?php echo $this->get_subtitle(); ?>

</div><!-- /.lqd-showcase -->