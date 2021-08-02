<?php
/**
* This object handle cleaning the database, It used before the import actions for better importing results.
*/
class LiquidReset
{
	
	function __construct( $core )
	{
		$this->core = $core;
	}
	public function run() {
		add_action( 'wp_ajax_liquid_reset_wp', array( $this, 'cleanup'), 10, 1 );
	}

	public function multiple_queries( $db = null, $queries = array() ) {
		if( !isset( $db ) ) {
			global $wpdb;
			$db = $wpdb;
		}
		foreach ($queries as $query) {
			try {
				$db->query( $db->prepare( $query ) );
				if( $db->last_error ) {
					echo $db->last_error;
				}
			} catch ( Exception $e ) {
				echo $e->getMessage();
			}
			
		}
	}

	public function cleanup() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		try {
			$wpdb->hide_errors();
			$wpdb->query( $wpdb->prepare( 
				"TRUNCATE TABLE {$prefix}posts" //Unfortunately TRUNCATE is not widely supported 
			) );
			if( $wpdb->last_error ) {
				$queries = array( "DELETE FROM {$prefix}posts", "ALTER TABLE {$prefix}posts AUTO_INCREMENT = 1" );
				$this->multiple_queries( $wpdb, $queries );
			}
		} catch( Exception $e ) {
			echo $e->getMessage();
		}
		wp_die(); //Close the ajax connection and keep going
	}
}
?>