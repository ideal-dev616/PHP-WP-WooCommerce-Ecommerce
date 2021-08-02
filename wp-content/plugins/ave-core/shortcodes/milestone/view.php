<?php

extract( $atts );

$classes = array( 
	'liquid-milestone',
	$el_class,
	$this->get_id(),
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_time() ?>

	<div class="liquid-milestone-content">
		<?php $this->get_title() ?>
		<?php $this->get_content(); ?>
	</div><!-- /.liquid-milestone-content -->

</div><!-- /.liquid-milestone -->