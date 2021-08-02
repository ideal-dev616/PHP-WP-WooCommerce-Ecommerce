<?php

extract( $atts );

$classes = array( 
	'fancy-box',
	$cb_size,
	$heading_size, 
	$this->get_class( $style ), 
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" data-slideelement-onhover="true" data-slideelement-options='{ "visibleElement": ".fancy-box-header", "hiddenElement": ".fancy-box-info" }'>
	
	<div class="fancy-box-image">
		<figure data-responsive-bg="true">
			<?php $this->get_image( false ); ?>
		</figure>
	</div><!-- /.fancy-box-image -->
	
	<div class="fancy-box-contents">
		
		<div class="fancy-box-header">
			<?php $this->get_info() ?>
			<?php $this->get_title() ?>
		</div><!-- /.fancy-box-header -->
		
		<div class="fancy-box-info">
			<?php $this->get_content(); ?>
			
			<div class="fancy-box-footer">
				<?php $this->get_button() ?>
			</div><!-- /.fancy-box-footer -->
			
		</div><!-- /.fancy-box-info -->
		
	</div><!-- /.fancy-box-contents -->
	
	<?php $this->get_overlay_link() ?>
	
</div><!-- /.fancy-box fancy-box-travel -->