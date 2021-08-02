<?php

extract( $atts );

$classes = array(
	'liquid-img-group-single',
	$this->get_browser_view(),
	$this->get_color_adjust_reset(),
	$this->get_overflow_height(),

	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php echo $this->get_data_options(); ?>>
	
	<?php $this->get_browser_bar(); ?>
	
	<div class="liquid-img-group-img-container">
		
		
		<?php if( !empty( $content) ) { ?>
			<div class="liquid-img-group-content <?php echo $content_align;  ?>">
				<?php echo ld_helper()->do_the_content( $content, false ); ?>
			</div><!-- /.liquid-img-group-content -->
		<?php } ?>		
		<?php $this->get_label() ?>
		<div class="liquid-img-container-inner" <?php echo $this->get_parallax_options() ?>>
			<?php $this->get_image() ?>
			<?php $this->get_overlay_link() ?>
		</div><!-- /.liquid-img-container-inner -->
		
	</div><!-- /.liquid-img-group-content -->
</div><!-- /.liquid-img-group-single -->