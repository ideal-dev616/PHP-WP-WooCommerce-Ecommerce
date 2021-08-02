<?php

extract( $atts );
	
// classes
$classes = array( 

	'ld-msg',
	'alert', 
	'alert-dismissible',
	
	$type,

	$this->get_id() 
);
?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" role="alert">

	<div class="ld-msg-inner">

		<?php $this->get_icon(); ?>

		<div class="ld-msg-txt">
			<?php $this->get_title(); ?>
		</div><!-- /.ld-msg-txt -->

		<button type="button" class="ld-msg-close close" data-dismiss="alert" aria-label="<?php esc_attr_e( 'Close', 'ave-core' ); ?>">
			<span aria-hidden="true">
				<i class="icon-ion-ios-close"></i>
			</span>
		</button>

	</div><!-- /.ld-msg-inner -->

</div><!-- /.ld-msg -->