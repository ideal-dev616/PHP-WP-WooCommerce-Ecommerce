<?php

extract( $atts );

$icon = liquid_get_icon( $atts );

$classes = array( 
	'fancy-box',
	$this->get_class( $style ),
	$scheme,
	$this->get_custom_height_classname(),
	
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" data-hover3d="true">

	<div class="fancy-box-contents border-radius-5" data-stacking-factor="0.5">

		<div class="cb-img-container border-radius-5">

			<figure class="fancy-box-image border-radius-5" <?php $this->get_background(); ?>>
				<?php $this->get_image( false ); ?>
			</figure>

		</div><!-- /.cb-img-container -->
		<div class="fancy-box-header">
			
			<?php 
				if( $icon['type'] ) { 
					printf( '<span class="ld-cb-icon"><i class="%s"></i></span>', $icon['icon'] ); 
				}
			?>
			<?php $this->get_info(); ?>
			<?php $this->get_title(); ?>

		</div><!-- /.fancy-box-header -->

	</div><!-- /.fancy-box-contents -->

	<?php $this->get_overlay_link() ?>

</div><!-- /.fancy-box fancy-box-classes -->