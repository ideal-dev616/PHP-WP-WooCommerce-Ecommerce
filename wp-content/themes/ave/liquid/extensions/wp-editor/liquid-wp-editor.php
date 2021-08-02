<?php
/**
* Liquid Themes Theme Framework
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

// Wp editor Class -----------------------------------------------------

/**
 * Liquid Theme
 */
class Liquid_Wp_Editor extends Liquid_Base {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		//$this->add_action( 'admin_enqueue_scripts', 'enqueue_scripts' );
		$this->add_filter( 'mce_buttons_2',         'liquid_style_select' );
		$this->add_filter( 'mce_buttons_2',         'liquid_mce_buttons' );
		$this->add_filter( 'tiny_mce_before_init',  'liquid_mce_text_sizes' );
		$this->add_filter( 'tiny_mce_before_init',  'liquid_styles_dropdown' );
		$this->add_filter( 'mce_buttons', 'register_highlight_editor' );
		$this->add_filter( 'mce_external_plugins', 'enqueue_plugin_scripts');
		$this->add_action( 'admin_print_footer_scripts', 'shortcode_highlight_script');
		
	}

	public function enqueue_scripts( $hook ) {

		if( $hook == 'post.php' || $hook == 'post-new.php' ) {

			wp_enqueue_style( 'liquid-wp-editor', get_template_directory_uri() . '/liquid/extensions/wp-editor/liquid-wp-editor.css' );
			wp_enqueue_script( 'liquid-wp-editor', get_template_directory_uri() . '/liquid/extensions/wp-editor/liquid-wp-editor.js', array( 'jquery' ), '0.1', true );
			

		}
	}

function shortcode_highlight_script()
	{
	    if(wp_script_is("quicktags"))
	    {
	        ?>
	            <script type="text/javascript">
	               
	                //this function is used to retrieve the selected text from the text editor
	                function getSel()
	                {
	                    var txtarea = document.getElementById("wpb_tinymce_content");
	                    var start = txtarea.selectionStart;
	                    var finish = txtarea.selectionEnd;
	                    return txtarea.value.substring(start, finish);
	                }
	
	                QTags.addButton(
	                    "highlight_shortcode",
	                    "Highlight",
	                    callback
	                );
	
	                function callback()
	                {
	                    var selected_text = getSel();
	                    QTags.insertContent("[ld_highlight]" +  selected_text + "[/ld_highlight]");
	                }
	            </script>
	        <?php
	    }
	}	
	
	function enqueue_plugin_scripts($plugin_array)
	{
	    //enqueue TinyMCE plugin script with its ID.
	    $plugin_array["highlight_plugin"] =  get_template_directory_uri() .  '/liquid/extensions/wp-editor/highlight.js';
	    return $plugin_array;
	}
	
	// Enable font size & font family selects in the editor
	public function liquid_mce_buttons( $buttons ) {
			array_unshift( $buttons, 'fontselect' ); // Add Font Select
			array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
			return $buttons;
		}
	
	// Customize mce editor font sizes
	public function liquid_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}

	// Add Formats Dropdown Menu To MCE
	public function liquid_style_select( $buttons ) {
		array_push( $buttons, 'styleselect' );
		return $buttons;
	}

	// Add new styles to the TinyMCE "formats" menu dropdown
	public function liquid_styles_dropdown( $settings ) {

		// Create array of new styles
		$new_styles = array(
			array(
				'title'    => esc_html__( 'Add Dropcap', 'ave' ),
				'selector' => 'p',
				'classes' => 'add-dropcap',
				'wrapper' => true,
			),
			array(
				'title'	 => esc_html__( 'Highlight', 'ave' ),
				'selector' => '',
				'wrapper' => true,
			),
			array(
				'title'	=> esc_html__( 'Text Transform', 'ave' ),
				'items'	=> array(
					array(
						'title'		=> esc_html__( 'Uppercase', 'ave' ),
						'inline'	=> 'span',
						'styles'    => array( 'text-transform' => 'uppercase' ),
					),
					array(
						'title'		=> esc_html__( 'Lowercase', 'ave' ),
						'inline'	=> 'span',
						'styles'    => array( 'text-transform' => 'lowercase' ),
					),
					array(
						'title'		=> esc_html__( 'Capitalize', 'ave' ),
						'inline'	=> 'span',
						'styles'    => array( 'text-transform' => 'capitalize' ),
					),
				),
			),
			array(
	            'title'    => esc_html__( 'Reset List', 'ave' ),
	            'selector' => 'ul',
	            'classes'  => 'reset-ul',
				'wrapper' => true,
	        ),
			array(
	            'title'    => esc_html__( 'Inline List', 'ave' ),
	            'selector' => 'ul',
				'classes'  => 'reset-ul inline-nav'
	        ),
		);

		// Merge old & new styles
		//$settings['style_formats_merge'] = true;

		// Add new styles
		$settings['style_formats'] = json_encode( $new_styles );

		// Return New Settings
		return $settings;
	}
	
	function register_highlight_editor($buttons)
	{
	    //register buttons with their id.
	    array_push($buttons, "highlight");
	    return $buttons;
	}


}

new Liquid_Wp_Editor();