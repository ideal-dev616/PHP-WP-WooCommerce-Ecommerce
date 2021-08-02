<header class="liquid-lp-header">
	<?php $this->entry_title( 'h5' ); ?>
	<?php
		$time_string = '<time class="published updated liquid-lp-date size-sm" datetime="%1$s">%2$s</time>';
		printf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		);
	?>
</header>
<hr>