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
	<div class="ld-media-item content-bottom <?php $this->get_effect_classnames(); ?>">
	
		<figure class="bg-center-top" data-responsive-bg="true">
	
			<?php $this->get_image(); ?>
			<?php $this->get_gallery(); ?>
	
			<div class="ld-media-item-overlay d-flex flex-column align-items-center justify-content-center text-center">
	
				<div class="ld-media-bg" style="background: linear-gradient(to top, #000 0%, transparent 100%);"></div>
	
				<div class="ld-media-content">
					<?php $this->get_media_icon(); ?>
				</div><!-- /.ld-media-content -->
	
			</div><!-- /.ld-media-item-overlay -->
	
		</figure>
	
		<div class="ld-media-content py-4">
				<?php $this->get_media_content(); ?>
		</div><!-- /.ld-media-content -->
	
		<?php $this->get_overlay_link(); ?>
	
	</div><!-- /.ld-media-item -->
</div>