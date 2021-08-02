<?php

extract( $atts );

$classes = array( 
	'fancy-box',
	'border-radius-3',
	$scheme,
	$heading_size, 
	$this->get_class( $style ), 
	$add_shadow,
	$is_tall,
	$content_alignment,
	$this->get_custom_height_classname(),
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<div class="cb-img-container border-radius-3">
		<?php $this->get_blured_image(); ?>
	</div><!-- /.cb-img-container -->

	<span class="cb-overlay"></span><!-- /.cb-overlay -->

	<div class="fancy-box-contents border-radius-3">
		
		<div class="fancy-box-header">
			<?php $this->get_info() ?>
			<?php $this->get_title(); ?>
			<?php $this->get_content(); ?>
		</div><!-- /.fancy-box-header -->
		
		<?php if( 'yes' === $show_button ) : ?>
			<div class="fancy-box-footer">
				<?php $this->get_button() ?>
			</div><!-- /.fancy-box-footer -->
		<?php endif; ?>

	</div><!-- /.fancy-box-contents -->

	<?php $this->get_overlay_link() ?>
	
</div><!-- /.fancy-box fancy-box-classes -->