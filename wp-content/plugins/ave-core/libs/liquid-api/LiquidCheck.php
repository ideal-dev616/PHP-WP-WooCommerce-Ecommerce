<?php
/**
* 
*/
class LiquidCheck
{
	protected $vaild = false;

	protected $user_data = array();

	public $option_name = 'liquid_refresh_token';

	

	public function run() {
		add_action( 'wp_ajax_liquid_set_refresh_code', array($this, 'set_token'));
		add_action( 'wp_ajax_liquid_get_user_info', array($this, 'get_info'));
		add_action( 'wp_ajax_liquid_log_out', array($this, 'log_out'));
		add_action( 'admin_init', array($this, 'update_token') );
		add_action( 'admin_enqueue_scripts', array($this, 'scripts') );
		
	}

	public function scripts() {
		if( ! function_exists( 'liquid' ) ) {
			return;
		}
		wp_enqueue_script( 'liquid-token-check', liquid()->load_assets('js/liquid-check.js'), array( 'jquery' ), false, false );
	}

	public function set_token() {
		$code = '';
		if(isset($_POST['code'])) {
			$code = $_POST['code'];
		}
		
		if($code !== '') {
			return update_option( 'liquid_refresh_token', $code, null );
		} else {
			return delete_option( 'liquid_refresh_token' );
		}
		
	}

	public function update_token() {
		if(isset($_GET['refresh']) && strlen($_GET['refresh']) <= 30) {
			return update_option( 'liquid_refresh_token', $_GET['refresh'], null );
		}
		return;
	}

	public function log_out() {
		return delete_option( 'liquid_refresh_token' );
	}

	public function get_info() {
		global $LiquidCore;
		if(self::get_token() === '' ) {
			return;
		} else {
			$code = self::get_token();
			$LiquidCore['LiquidEnvato']->set_response_type('array');
			$api = $LiquidCore['LiquidEnvato']->call('/?refresh='.$code);
			if(!is_array($api)) {
				$this->user_data = json_decode($api, true);
				if(!isset($this->user_data['email']) || $this->user_data['email'] == '') {
					return self::set_token();
				}
				return $this->user_data;
			}
			
		}
	}

	public function is_vaild() {
		$user_info = $this->get_info();
		if($user_info == '' || !is_array($user_info)) {
			$this->vaild = false;
			return $this->vaild;
		}

		if(isset($user_info) && $user_info['purchase'] === 1) {
			$this->vaild = true;
		}

		return $this->vaild;
	}

	public function logged_in_mail() {
		$data = $this->get_info();
		if( !isset($data) || $data['email'] == '' ) {
			return;
		}
		return $data['email'];
	}

	public function get_token() {
		$token = get_option( 'liquid_refresh_token' , false );
		if(isset($token)) {
			return $token;
		} 
		return false;
	}

}
?>