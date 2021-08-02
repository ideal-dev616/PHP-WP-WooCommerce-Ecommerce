<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$classes = array( 
	$width,
	'masonry-item',
	$alignment,
	$this->get_custom_height_class(),
	
	$atts['el_class'], 
	$this->get_id() 
);

$this->generate_css();
	
?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="ld-media-item <?php $this->get_effect_classnames(); ?>">

		<?php $this->get_image(); ?>
		<?php $this->get_gallery(); ?>

		<div class="ld-media-item-overlay d-flex flex-column <?php echo $alignment; ?> <?php echo $vertical_alignment; ?>">

			<div class="ld-media-bg"></div>

			<div class="ld-media-content">
				<?php $this->get_media_content(); ?>
				<?php $this->get_media_icon(); ?>
			</div><!-- /.ld-media-content -->

		</div><!-- /.ld-media-item-overlay -->

		<?php $this->get_overlay_link(); ?>

	</div><!-- /.ld-media-item -->

</div><!-- /.col-md-3 -->