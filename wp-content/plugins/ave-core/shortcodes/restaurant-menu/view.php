<?php

extract( $atts );

// classes
$classes = array( 
	'lqd-rst-menu',
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-rst-menu-inner d-flex flex-wrap">
		<div class="w-80">
			
			<?php $this->get_title(); ?>
			<?php $this->get_content(); ?>

		</div><!-- /.w-80 -->

		<div class="w-20 text-right">
			<div class="lqd-rst-menu-price pricing h5 my-0 lh-15">
				<?php $this->get_price(); ?>
			</div><!-- /.lqd-rst-menu-price pricing -->
		</div><!-- /.w-20 -->
	</div><!-- /.lqd-rst-menu-inner -->
</div><!-- /.lqd-rst-menu -->