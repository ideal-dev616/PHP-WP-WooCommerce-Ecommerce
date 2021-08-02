<?php

extract( $atts );

$classes = array( 

	'ld-shop-banner', 
	$this->get_class( $style ), 
	'round',
	$this->has_custom_height(),

	$el_class, 
	$this->get_id(), 
	trim( vc_shortcode_custom_css_class( $css ) ) 

);

$carousel_id = uniqid( 'carousel_' );

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="ld-shop-banner-container" data-hover3d="true">

		<div class="ld-shop-banner-inner" data-stacking-factor="0.5">

			<?php $this->get_image( $carousel_id ) ?>
			<?php $this->get_title() ?>
			<?php $this->get_nav( $carousel_id ) ?>
			<?php $this->get_link() ?>

		</div><!-- /.ld-shop-banner-inner -->

	</div><!-- /.ld-shop-banner-container -->
	
</div>