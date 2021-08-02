<?php

extract( $atts );

$classes = array( 
	'fancy-box',
	$content_alignment,
	$heading_size, 
	$this->get_class( $style ), 
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();
?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<div class="cb-img-container mb-4">

		<?php $this->get_image(); ?>
		<?php $this->get_overlay_image(); ?>
		
		<?php if( 'yes' === $show_button && 'on_image' === $button_placement || 'yes' === $show_button && 'both' === $button_placement ) : ?>
		<div class="cb-img-btn">
			<div class="cb-img-btn-bg"></div>
			<?php $this->get_overlay_link() ?>
			<div class="cb-img-btn-inner">
				<?php $this->get_button() ?>
			</div><!-- /.cb-img-btn-inner -->
		</div><!-- /.cb-img-btn -->
		<?php endif; ?>

	</div><!-- /.cb-img-container -->

	<div class="fancy-box-contents">
		
		<div class="fancy-box-header">
			<?php $this->get_title(); ?>
			<?php $this->get_content(); ?>
		</div><!-- /.fancy-box-header -->
		
		<?php if( 'yes' === $show_button && 'footer' === $button_placement || 'yes' === $show_button && 'both' === $button_placement ) : ?>
		<div class="fancy-box-footer mt-3">
			<?php $this->get_button() ?>
		</div><!-- /.fancy-box-footer -->
		<?php endif; ?>
		
	</div><!-- /.fancy-box-contents -->
	
	<?php $this->get_overlay_link() ?>
	
</div><!-- /.fancy-box fancy-box-classes -->