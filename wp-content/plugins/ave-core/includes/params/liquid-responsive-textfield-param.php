<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @property mixed data
 */
class Liquid_Responsive_Textfield {

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

		'lg' => 'Large',
		'md' => 'Medium',
		'sm' => 'Small',
		'xs' => 'Extra small',

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
	 * @param $settings
	 * @param $value
	 */
	public function __construct( $settings, $value ) {
		$this->settings = $settings;
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function render() {
		ob_start(); 
		
			$settings = $this->settings;
			$value = $this->value;
			$values = $this->get_responsive_values( $value );
			$data = $this->valueData();
			$sizes = $this->size_types;
			$layouts = $this->layouts;
		?>
		
		<div class="vc_column-offset">
			<input name="<?php echo esc_attr( $settings['param_name'] ) ?>"
			       class="wpb_vc_param_value <?php echo esc_attr( $settings['param_name'] ) ?> <?php echo esc_attr( $settings['type'] ) . '_field'; ?>" type="hidden" value="<?php echo esc_attr( $value ) ?>"/>
			<table class="vc_table vc_column-offset-table">
				<tr>
					<th>
						<?php esc_html_e( 'Device', 'ave-core' ) ?>
					</th>
					<th>
						<?php esc_html_e( 'Items', 'ave-core' ) ?>
					</th>
					<th>
						<?php esc_html_e( 'Spacing', 'ave-core' ) ?>
					</th>
				</tr>
				<?php foreach ( $sizes as $key => $size ) :  ?>
					<tr class="vc_size-<?php echo $key ?>">
						<td class="vc_screen-size vc_screen-size-<?php echo $key ?>" width="50">
							<span title="<?php echo $size ?>"><i class="vc-composer-icon vc-c-icon-layout_<?php echo isset( $layouts[ $key ] ) ? $layouts[ $key ] : $key ?>"></i></span>
						</td>
						<td>
							<?php echo $this->textfieldControl( $key, $values ) ?>
						</td>
						<td>
							<?php echo $this->spacingControl( $key, $values ) ?>
						</td>
					</tr>
				<?php endforeach ?>
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
	
	public static function get_responsive_values( $value ) {
		return vc_parse_multi_attribute( $value, array( 'xs' => '', 'sm' => '', 'md' => '', 'lg' => '', 'spacing_xs' => '', 'spacing_sm' => '', 'spacing_md' => '', 'spacing_lg' => '',  ) );
	}

	/**
	 * @param $size
	 *
	 * @return string
	 */
	public function textfieldControl( $size, $values = array() ) {

		$prefix = 'text-' . $size . '-';
		$output = '<input type="number" name="vc_' . $size . '_responsive_textfield" class="vc_column_offset_field" value="' . $values[ $size ] . '" data-name="textfield-' . $size . '" data-type="textfield-' . $size . '">';

		return $output;
	}
	/**
	 * @param $size
	 *
	 * @return string
	 */
	public function spacingControl( $size, $values = array() ) {

		$prefix = 'text-' . $size . '-';
		$output = '<input type="text" name="vc_' . $size . '_responsive_spacing" class="vc_column_offset_field" value="' . $values[ 'spacing_' . $size ] . '" data-name="spacing-' . $size . '" data-type="spacing-' . $size . '">';

		return $output;
	}
}

/**
 * @param $settings
 * @param $value
 *
 * @return string
 */
function liquid_responsive_textfield_form_field( $settings, $value ) {
	$responsive_alignment = new Liquid_Responsive_Textfield( $settings, $value );

	return $responsive_alignment->render();
}
vc_add_shortcode_param( 'responsive_textfield', 'liquid_responsive_textfield_form_field' );