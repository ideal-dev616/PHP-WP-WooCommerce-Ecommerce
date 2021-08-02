<?php

extract( $atts );

// classes
$classes = array( 

	'ld-pb',
	'text-center',

	$el_class, 
	$this->get_id() 
);

$is_icon = '';
if( 'yes' === $add_icon ) {
	$is_icon = 'ld-pb-icon';
}

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

	<div class="ld-pb-top <?php echo $is_icon; ?>">
		
		<?php $this->get_image() ?>
		<?php $this->get_count() ?>
		<?php $this->get_icon() ?>
		<?php $this->get_link() ?>

	</div><!-- /.ld-pb-top -->

	<div class="ld-pb-content">

		<?php $this->get_title() ?>
		<?php $this->get_content(); ?>

	</div><!-- /.ld-pb-content -->

</div><!-- /.ld-pb -->