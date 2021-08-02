<?php
/*
 * Export options
*/

$this->sections[] = array(
	'title' => esc_html__( 'Import/Export', 'ave' ),
	'desc' => esc_html__( 'Import/Export options', 'ave' ),
	'icon' => 'el-icon-arrow-down',
	'fields' => array(		

		array(
			'id'            => 'opt-import-export',
			'type'          => 'import_export',
			'title'         => esc_html__( 'Import / Export', 'ave' ),
			'subtitle'      => esc_html__( '', 'ave' ),
			'full_width'    => false,
		),
	),
);
