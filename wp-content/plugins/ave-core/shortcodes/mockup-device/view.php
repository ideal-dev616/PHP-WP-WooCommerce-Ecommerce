<?php

extract( $atts );

$classes = array( 
	'lqd-mockup-device', 
	$this->get_class( $style ),
	'pos-rel',
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

$attachments  = $this->get_attachments();

?>
 
 <div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="lqd-mockup-inner">
	
		<div class="lqd-mockup-container pos-rel z-index-4">
			<div class="lqd-mockup-inner">
				<figure class="text-center">
					<?php $this->get_mockup(); ?>
				</figure>
			</div><!-- /.mockup-inner -->
		</div><!-- /.mockup-container -->

		<div class="lqd-mockup-content-container pos-abs z-index-0 overflow-hidden">
			<div class="lqd-mockup-content-inner ld-overlay">
				<?php $this->get_featured_image(); ?>
				<?php $this->get_video(); ?>
				<?php $this->get_overlay_link(); ?>
			</div><!-- /.mockup-content-inner -->
		</div><!-- /.mockup-content-container -->

	</div><!-- /.lqd-mockup-inner -->

</div><!-- /.lqd-mockup-devices lqd-mockup-imac-style-1 -->