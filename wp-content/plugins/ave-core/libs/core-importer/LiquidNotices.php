<?php
/**
* Handle admin notices
*/
class LiquidNotices 
{
	/**
	 * used to stroe the dissmiss statue
	 *
	 * @access private
	 * @var string
	 */
	private $cookie_name = 'one_license_login_timer';

	/**
	 * Restore the dissmiss statue after certin time = 2 hours
	 *
	 * @access private
	 * @var integer
	 */
	private $expire = 7200;

	public function run() {
		add_action( 'wp_ajax_liquid_dissmiss_timer', array($this, 'dissmiss_timer'), 10, 1 );
	}

	public function notice_logo() {
		
		if( ! function_exists( 'liquid' ) ) {
			return;
		}
		//to do remove the inline css
		return '<div style="float:left;border-right:1px solid #d9d9d9; margin-right:15px;margin-left:-15px;margin-top:10px;"><img src="'.liquid()->load_assets('/img/liquid-logo-icon.png').'" /></div>';
	}

	public function dissmiss_timer(){
		
		setcookie(
			$this->cookie_name,
			1,
			time()+$this->expire,
			COOKIEPATH,
			COOKIE_DOMAIN
		);
		wp_die();
	}

	public function get_cookie_timer() {
		if( isset($_COOKIE[$this->cookie_name]) ) {
			return $_COOKIE[$this->cookie_name];
		} else {
			return;
		}
	}

	public function admin_notice($msg = '', $args = array()) {
		$args = wp_parse_args( $args, array(
			'message'     => $msg,
			'classes'     => '',
			'type'        => '',
			'echo'        => true,
			'dismissible' => true,
			'dismissTime' => false
		) );

		

		extract($args);

		if(isset($dismissTime)) {
		ob_start(); ?>

        <script type="text/javascript">
        jQuery( function( $ ) {
          $('.liquid-login-notice').on('click','.notice-dismiss', function(e){
            $.post('<?php echo admin_url('admin-ajax.php?action=' . esc_attr( $dismissTime ) ); ?>');
          });
        } );
        </script>
        <?php

        $script = ob_get_clean();
        }
		
		$type =  ($type != '') ? ' notice-'.$type : '';
		$classes = ( $dismissible ) ? ' ' . $classes.$type . ' is-dismissible' : ' ' . $classes.$type;
		$notice = '<div class="notice'.$classes.'">';
		$notice .= $this->notice_logo();
		$notice .= '<p>'.$message.'</p>';
		if($dismissible) {
			$notice .='<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
		}
		$notice .= '</div>'.$script;

		if($echo) { 
			echo $notice;
		} else {
			return $notice;
		}
	}
}
?>