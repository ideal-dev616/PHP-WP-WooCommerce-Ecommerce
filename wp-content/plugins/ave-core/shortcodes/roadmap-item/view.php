<?php

extract( $atts );

$classes = array( 

	'one-roadmap-item',
	$this->get_checked(),

	$this->get_id() 

);
	
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<spab class="one-roadmap-bar"></spab>

	<div class="one-roadmap-info">
		<?php $this->get_title() ?>
		<?php $this->get_content() ?>
	</div><!-- /.one-roadmap-info -->

	<span class="one-roadmap-mark">
		<?php $this->get_checkmark(); ?>
	</span>

</div><!-- /.one-roadmap-item -->