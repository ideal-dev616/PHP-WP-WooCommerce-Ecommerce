<?php 

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();
?>
<div class="header-module">
	<?php $this->get_button() ?>
</div>