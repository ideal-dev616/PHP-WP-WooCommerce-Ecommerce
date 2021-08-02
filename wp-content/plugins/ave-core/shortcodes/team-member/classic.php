<?php

extract( $atts );

// classes
$classes = array(
	'ld-tm',
	'd-flex',
	'flex-column',
	'text-center',

	$el_class, 
	$this->get_id()
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

	<?php $this->get_image(); ?>

	<div class="ld-tm-info">

		<?php $this->get_name() ?>
		<?php $this->get_position(); ?>
		<?php $this->get_content() ?>
		<?php $this->get_social(); ?>

	</div><!-- /.ld-tm-info -->

</div><!-- /.ld-team-member -->