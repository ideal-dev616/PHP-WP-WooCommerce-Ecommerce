<?php 

extract( $atts );

$classes = array( 
	'ld-bnr',
	'ld-bnr-deal',

	$el_class,
	$this->get_id(),
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="ld-bnr-inner">

		<div class="ld-bnr-content">

			<?php $this->get_title(); ?>
			<?php $this->get_subtitle(); ?>
			<?php $this->get_content(); ?>
			<?php $this->get_button(); ?>
			<?php $this->get_info(); ?>

		</div><!-- /.ld-bnr-content -->

		<?php $this->get_image();  ?>

	</div><!-- /.ld-bnr-inner -->

</div><!-- /.ld-bnr ld-bnr-deal -->