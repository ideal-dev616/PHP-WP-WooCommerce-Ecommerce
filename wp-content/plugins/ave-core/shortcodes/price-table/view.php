<?php
extract( $atts );

$classes = array( 
	'pricing-table', 
	$this->get_featured(), 
	$this->get_class( $style ), 
	$el_class,
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	
	<?php if( 's5' === $style ) { ?>
		<?php $this->get_featured_tag() ?>
	<?php } ?>
	
	<div class="pricing-table-header">
		<?php $this->get_image(); ?>
		<?php if( 's4' === $style ) { ?>
			<?php $this->get_price() ?>
		<?php } ?>
		<?php $this->get_title() ?>
		<?php if( 's3' === $style || 's5' === $style ) { ?>
			<?php $this->get_price() ?>
		<?php } ?>

	</div><!-- /.pricing-table-head -->
	
	<div class="pricing-table-body">
		<?php $this->get_features() ?>
	</div><!-- /.pricing-table-body -->
	
	<div class="pricing-table-footer">
		<?php if( 's5' !== $style ) { ?>
		<?php $this->get_featured_tag() ?>
		<?php } ?>
		<?php if( 's3' !== $style && 's4' !== $style && 's5' !== $style ) { ?>
			<?php $this->get_price() ?>
		<?php } ?>
		<?php $this->get_button()?>
	</div><!-- /.pricing-table-footer -->
	
</div><!-- /.pricing-table -->