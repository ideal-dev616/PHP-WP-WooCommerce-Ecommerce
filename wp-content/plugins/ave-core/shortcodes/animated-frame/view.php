<?php

extract( $atts );

$classes = array(
	'lqd-af-slide',
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	
	<div class="lqd-af-slide__img">
		<?php $this->get_image(); ?>
	</div><!-- /.lqd-af-slide__img -->

	<div class="lqd-af-slide__content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php $this->get_title(); ?>
					<?php $this->get_content(); ?>
					<div class="lqd-af-slide__link">
						<?php $this->get_button();  ?>
					</div><!-- /.lqd-af-slide__link -->
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div><!-- /.lqd-af-slide__content -->

</div><!-- /.slide -->
