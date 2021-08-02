<?php

extract( $atts );

$classes = array(

	'ld-timeline-item', 
	'row',

	$el_class, 
	$this->get_id() 

);

$this->generate_css();
	
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_image() ?>

	<?php $this->get_year() ?>

	<div class="col-md-5 ld-timeline-content">

		<?php $this->get_title()  ?>
		<?php $this->get_subtitle() ?>
		<?php $this->get_content(); ?>

	</div><!-- /.ld-timeline-content -->

</div><!-- /.ld-timeline-item -->