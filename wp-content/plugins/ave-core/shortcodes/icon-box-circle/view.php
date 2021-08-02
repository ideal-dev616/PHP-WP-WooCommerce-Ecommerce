<?php

extract( $atts );

$classes = array( 
	'one-ib-circ',

	$atts['el_class'], 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();
	
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-spread-incircle="true" <?php $this->get_animation(); ?>>
	<div class="one-ib-circ-wrap" data-stacking-factor="0.95">
		<div class="one-ib-circ-inner">
			<?php echo ld_helper()->do_the_content( $content, false ); ?>
		</div><!-- /.one-ib-circ-inner -->
	</div><!-- /.one-ib-circ-wrap -->
</div><!-- /.one-ib-circ -->