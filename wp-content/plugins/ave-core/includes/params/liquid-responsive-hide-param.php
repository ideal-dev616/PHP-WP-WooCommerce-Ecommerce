<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @property mixed data
 */
class Liquid_Responsive_Hide {

	/**
	 * @var array
	 */
	protected $settings = array();
	/**
	 * @var string
	 */
	protected $value = '';
	/**
	 * @var array
	 */
	protected $size_types = array(	
		'xs' => 'Extra small',
		'sm' => 'Small',
		'md' => 'Medium',
		'lg' => 'Large',
	);
	
	/**
	 * @var $param Vc_Column_Offset
	 * @var $sizes Vc_Column_Offset::$size_types
	 */
	protected $layouts = array(
		'xs' => 'portrait-smartphones',
		'sm' => 'portrait-tablets',
		'md' => 'landscape-tablets',
		'lg' => 'default',
	);

	/**
	 * @var array
	 */
	protected $column_width_list = array();

	/**
	 * @param $settings
	 * @param $value
	 */
	public function __construct( $settings, $value ) {
		$this->settings = $settings;
		$this->value = $value;

		$this->column_width_list = array(
			esc_html__( 'Left', 'ave-core' )    => 'left',
			esc_html__( 'Right', 'ave-core' )   => 'right',
			esc_html__( 'Center', 'ave-core' )  => 'center',
			esc_html__( 'Justify', 'ave-core' ) => 'justify',
		);
	}

	/**
	 * @return string
	 */
	public function render() {
		ob_start(); 
		
			$settings = $this->settings;
			$value = $this->value;
			$data = $this->valueData();
			$sizes = $this->size_types;
			$layouts = $this->layouts;
		?>
		
		<div class="vc_column-offset" data-column-offset="true">
			<input name="<?php echo esc_attr( $settings['param_name'] ) ?>"
			       class="wpb_vc_param_value <?php echo esc_attr( $settings['param_name'] ) ?>
			<?php echo esc_attr( $settings['type'] ) ?>'_field" type="hidden" value="<?php echo esc_attr( $value ) ?>"/>
			<table class="vc_table vc_column-offset-table">
				<tr>
				<?php foreach ( $sizes as $key => $size ) :  ?>
					<!-- <th class="vc_size-<?php echo $key ?>"> -->
						<td class="vc_screen-size vc_screen-size-<?php echo $key ?>" width="50">
							<span title="<?php echo $size ?>"><i class="vc-composer-icon vc-c-icon-layout_<?php echo isset( $layouts[ $key ] ) ? $layouts[ $key ] : $key ?>"></i></span>
						</td>
					<!-- </th> -->
				<?php endforeach ?>				
				</tr>
				<tr>
				<?php foreach ( $sizes as $key => $size ) :  ?>					
					<td class="vc_size-<?php echo $key ?>">
						<label>
							<input type="checkbox" name="hidden-<?php echo esc_attr( $key ); ?>"
									value="yes"<?php echo in_array( 'hidden-' . $key, $data, true ) ? ' checked="true"' : ''; ?>
									class="vc_column_offset_field">
						</label>
					</td>
				<?php endforeach ?>
				</tr>
			</table>
		</div>	
		
<?php		

		return ob_get_clean();
	}

	/**
	 * @return array|mixed
	 */
	public function valueData() {
		if ( ! isset( $this->data ) ) {
			$this->data = preg_split( '/\s+/', $this->value );
		}

		return $this->data;
	}

	/**
	 * @param $size
	 *
	 * @return string
	 */
	public function hideControl( $size ) {
		$prefix = 'text-' . $size . '-';
		$empty_label = 'xs' === $size ? esc_html__( 'No offset', 'ave-core' ) : esc_html__( 'Inherit from smaller', 'ave-core' );
		$output = '<select name="vc_' . $size . '_responsive_hide" class="vc_column_offset_field" data-type="hide-' . $size . '"><option value="">Inherit</option>';

		foreach ( $this->column_width_list as $label => $index ) {
			$value = $prefix . $index;
			$output .= '<option value="' . $value . '"' . ( in_array( $value, $this->data ) ? ' selected="true"' : '' ) . '>' . $label . '</option>';
		}
		$output .= '</select>';

		return $output;
	}
}

/**
 * @param $settings
 * @param $value
 *
 * @return string
 */
function liquid_responsive_hide_form_field( $settings, $value ) {
	$responsive_hide = new Liquid_Responsive_Hide( $settings, $value );

	return $responsive_hide->render();
}
vc_add_shortcode_param( 'responsive_hide', 'liquid_responsive_hide_form_field' );