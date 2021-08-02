<?php

extract( $atts );

$classes = array(
	'lqd-frickin-img',
	$direction,

	$el_class, 
	$this->get_id() 
);

$this->generate_css();
	
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-inview="true" data-inview-options='{ "delayTime": 250, "threshold": 0.75 }'>
	<div class="lqd-frickin-img-inner">

		<span class="lqd-frickin-img-bg"></span><!-- /.lqd-frickin-img-bg -->
		<?php $this->get_image() ?>

	</div><!-- /.lqd-frickin-img-inner -->
</div><!-- /.lqd-frickin-img -->