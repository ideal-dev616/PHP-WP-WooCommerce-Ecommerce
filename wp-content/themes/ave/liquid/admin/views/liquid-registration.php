<?php
	
	$register = new Liquid_Register;
	
?>
<div class="lqd-dsd-box lqd-dsd-box-solid lqd-dsd-register-box">

	<div class="lqd-dsd-box-head">

		<?php $register->messages(); ?>

	</div><!-- /.lqd-dsd-box-head -->

	<?php $register->form(); ?>
	
	<div class="lqd-dsd-box-foot">
		<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e( 'Can’t find your purchase code?', 'ave' ); ?></a>
	</div><!-- /.lqd-dsd-box-foot -->	

</div><!-- /.lqd-dsd-register-box -->