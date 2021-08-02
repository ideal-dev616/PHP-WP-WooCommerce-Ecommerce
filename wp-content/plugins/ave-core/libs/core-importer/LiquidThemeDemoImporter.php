<?php

//load admin theme data importer
class LiquidThemeDemoImporter extends LiquidImporter {
    /**
     * Holds a copy of the object for easy reference.
     *
     * @since 0.0.1
     *
     * @var object
     */
    private static $instance;
    

	/**
	 * Store the selected options from the dashboard
	 *
	 * @since 0.0.1
	 * @var object
	 */
	public $selected_demo_folder;


    /**
     * Constructor. Hooks all interactions to initialize the class.
     *
     * @since 0.0.1
     */
    public function __construct($core) {
    	$this->core = $core;
    	
		$this->demo_files_path = $core['LiquidDownload']->temp_folder().DIRECTORY_SEPARATOR;
		if(function_exists('liquid')) {
			$this->theme_option_name = liquid()->get_option_name();
		}
		
        self::$instance = $this;
        
		parent::__construct($core);

    }

    public function run() {
    	add_action( 'wp_ajax_liquid_import_form', array($this, 'ajax_import'), 10, 1 );
    	add_action( 'wp_ajax_liquid_import_theme_options', array($this, 'ajax_import_theme_options'), 10, 1 );
    	add_action( 'wp_ajax_liquid_import_theme_widgets', array($this, 'ajax_import_theme_widgets'), 10, 1 );
    	add_action( 'wp_ajax_liquid_set_home_page', array($this, 'ajax_set_home_page'), 10, 1 );
    	add_action( 'wp_ajax_liquid_import_slider', array($this, 'import_slider'));
    	add_action( 'wp_ajax_liquid_set_demo_content', array($this, 'ajax_set_demo_conten'));
    	add_action( 'wp_ajax_liquid_import_media', array($this, 'import_media'));
    	add_action( 'wp_ajax_liquid_require_plugins', array($this, 'ajax_get_require_plugins'));
    }

    public function ajax_import_theme_options(){
    	$demo = esc_attr($_POST['demo']);
    	$this->selected_demo_folder = $demo;
    	$this->set_demo_theme_options();
    	$this->set_templates($demo);
    	wp_die();
    }

    public function import_master_slider($data = '') {
    	if($data == '' || !file_exists($data)) {
    		return;
    	}
    	if(!class_exists('MSP_Importer')) {
    		require_once RA_ADDONS_PATH  . 'libs'.DIRECTORY_SEPARATOR.'core-importer'.DIRECTORY_SEPARATOR.'class-msp-importer.php';
    	}
		$data_content = @file_get_contents($data);
		$import_class = new MSP_Importer;
		
		if( $import_class->import_data($data_content) ) {
			$this->log->putContent('MS Slider Imported', true, true);
		} else {
			$this->log->putContent('Faild to import MS Slider', true, true);
		}
		wp_die();
    }

    public function import_revslider($data = ''){
    	$demo = esc_attr($_POST['demo']);
    	if(class_exists('RevSliderSlider')) {
    		$slider = new RevSlider();
    		return $slider->importSliderFromPost(true, true, $data);
    	} else {
    		echo esc_html__( 'Failed to import slider data, Please make sure to install and activate slider revolution plugin first', 'ave-core' );
    		$this->log->putContent('Failed to import slider data', true, true);
    	}
    	wp_die();
    }

    public function import_slider() {
    	$demo = esc_attr($_POST['demo']);
  
    	$sliders = self::get_settings($demo, 'sliders');
    	
    	if(is_array($sliders)):
    	
    	foreach ($sliders as $key => $val) {
    		if(!is_array( $val )) {
    			$data = $this->demo_files_path.'/'.$val;
    			if($key == 'masterslider' && file_exists($data)) {
    				echo $this->import_master_slider($data);
    				$this->log->putContent('Slider Imported', true, true);
    			} elseif ($key == 'revslider' && file_exists($data)) {
    				echo $this->import_revslider($data);
    				$this->log->putContent('Slider Imported', true, true);
    			}
    		} else {
    			if($key == 'masterslider' ) {
    				foreach ($val as $file) {
    					$data = $this->demo_files_path.'/'.$file;
    					if(file_exists( $data )) {
    						echo $this->import_master_slider($data);
    				    	$this->log->putContent('Slider Imported', true, true);
    					}
    				
    				}
    			} elseif ($key == 'revslider') {
    				foreach ($val as $file) {
    					$data = $this->demo_files_path.'/'.$file;
    					if(file_exists( $data )) {
    						echo $this->import_revslider($data);
    						$this->log->putContent('Slider Imported', true, true);
    					}
    				}
    			}
    		}
    	}
    	endif;
    	wp_die();
    }

    public function import_media() {
    	
    	$file = $this->demo_files_path.$this->media_file_name;
    	    parent::set_demo_data($file, true);
    	wp_die();
    }

    public function ajax_import_theme_widgets(){
    	$demo = esc_attr($_POST['demo']);
    	$this->selected_demo_folder = $demo;
    	$this->process_widget_import_file();
    	wp_die();
    }

    public function ajax_set_demo_conten() {
    	$demo = esc_attr($_POST['demo']);
	    $data = esc_attr($_POST['data']);
	    $media = esc_attr($_POST['media']);
	    parent::set_demo_data('', false);
	    $this->set_demo_menus($demo);
	    wp_die();
    }

	public function ajax_import() {

	  $demo = esc_attr($_POST['demo']);
	  $data = esc_attr($_POST['data']);
	  $this->selected_demo_folder = $demo;
	  $customize_data = $this->demo_files_path.$this->customizer_data_name;

	  if(isset($data)) {
	  	
	  	foreach ($data as $key) {
	  		if(method_exists($this, $key)) {
	  			call_user_func(array($this, $key));
	  		}
	  	}
	  	$this->import_master_slider();
	  	$this->set_demo_menus();
	  	
	  }
      //parent::_import_customizer($customize_data);
      
    }
	/**
	 * Add menus
	 *
	 * @since 0.0.1
	 */
	public function set_demo_menus($demo) {
		// Menus name and location should be added to demo_settings.json file inside each demo folder
		$locations = array();
		$menus = self::get_settings($demo, 'menus');
		foreach ($menus as $location => $name) {
			$menu = wp_get_nav_menu_object($name);
			$locations[$location] = $menu->term_id; 
        }
		set_theme_mod( 'nav_menu_locations', $locations);
		$this->log->putContent('Default menu has been set', true, true);
	}

	public function set_templates($demo) {
		$templates = self::get_settings($demo, 'templates');
		foreach ($templates as $option => $page) {
			$type = preg_match('/([^\-]+)/i', $option, $matches);
			if($matches) {
				$_page = get_page_by_title( $page, OBJECT,  'liquid-'.$matches[0]);
				if(class_exists('Liquid_Theme_Options')) {
					$theme = new Liquid_Theme_Options;
					$theme->get_redux()->set($option, $_page->ID);
				}
				
			}
		}
		wp_die();
	}

	public function check_settings($demo = '') {
		
		$avilable = array();
		$path = $this->demo_files_path.'/'.$demo.'/';
		$content = @file_get_contents($path.$this->demo_settings_name);
		$settings_file = json_decode($content, true);
		
		if(isset($settings_file['home_page_title']) ){
			$avilable['home_page'] = 1;
		} else {
			$avilable['home_page'] = 0;
		}
		
		if(isset($settings_file['sliders'])) {
			$avilable['slider_data'] = 1;
		} else {
			$avilable['slider_data'] = 0;
		}

		if(file_exists($path.$this->widgets_file_name)) {
			$avilable['widgets'] = 1;
		} else {
			$avilable['widgets'] = 0;
		}
		if(file_exists($path.$this->theme_options_file_name)) {
			$avilable['theme_option'] = 1;
		} else {
			$avilable['theme_option'] = 0;
		}
		if(file_exists($path.$this->content_demo_file_name)) {
			$avilable['content'] = 1;
		} else {
			$avilable['content'] = 0;
		}
		return "data-settings='".json_encode($avilable)."'";

	}

	public function get_settings($selected_demo = '', $setting = '') {
		if($selected_demo == '') {
			
			return;
		}
		$path = $this->demo_files_path.$this->demo_settings_name;
		
		$content = @file_get_contents($path);

		$arr = json_decode($content, true);
		
		if(!empty($setting)) {

			return $arr[$setting];
		} else {
			return $arr;
		}
	}

	public function ajax_set_home_page() {

		$demo = esc_attr($_POST['demo']);
		$page_title = $this->get_settings($demo, 'home_page_title');
		$blog_page_title = $this->get_settings($demo, 'blog_page_title');
		$page = get_page_by_title(esc_html( $page_title ));
		$blog_page = get_page_by_title( $blog_page_title );
		$is_home_page_updated = null;
		$is_blog_page_updated  = null;
		if($page->ID) {
			update_option( 'show_on_front', 'page', true);
			update_option( 'page_on_front', $page->ID );
		    $this->log->putContent('Home page has been set', true, true);
		} 
		if( $blog_page->ID ) {
			update_option( 'show_on_front', 'page', true);
			update_option( 'page_for_posts', $blog_page->ID );
			$this->log->putContent('Blog page has been set', true, true);
		}
		
		wp_die();
	}
	public function ajax_get_require_plugins(){
		$demo = esc_attr($_POST['demo']);
		$ret = '';
		$require_plugins = self::get_settings($demo, 'content_plugins');
		$plugins = array();
		if(is_array($require_plugins) && sizeof($require_plugins) >= 1) {
			foreach ($require_plugins as $plugin => $pluginName) {
				if(!is_plugin_active( $plugin.'/'.$plugin.'.php' )) {
					$plugins[] = $pluginName;
				}
			}
			if(sizeof($plugins) >= 1) {
				$ret = '{"stat":"0", "plugins":'.json_encode(array_values($plugins)).'}';
			} else {
				$ret = '{"stat":"1"}';
			}
			
		} else {
			$ret = '{"stat":"1"}';
		}
		wp_send_json( $ret, null );		
		wp_die();
	}
}
?>