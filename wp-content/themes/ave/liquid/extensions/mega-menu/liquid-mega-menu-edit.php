<?php
/**
 * The Admin Menu Walker
 * Menu Walker class to add fields into menu management screen
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * Add new Fields
 * Based on Walker_Nav_Menu_Edit class.
 */
class Liquid_Mega_Menu_Edit_Walker extends Walker_Nav_Menu_Edit {

	function __construct() {

		$this->megamenus = get_posts(array(
			'post_type' => 'liquid-mega-menu',
			'posts_per_page' => -1
		));

		$this->walker_args = array(
			'depth' => 0,
			'child_of' => 0,
			'selected' => 0,
			'value_field' => 'ID'
		);
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args, $id);

		// Adding new Fields
        $item_output = str_replace( '<fieldset class="field-move', $this->get_fields( $item, $depth, $args, $id ) . '<fieldset class="field-move', $item_output );

        $output .= $item_output;
	}

	function get_fields( $item, $depth = 0, $args = array(), $id = 0 ) {
        ob_start();

        $item_id = esc_attr( $item->ID );
	?>

		<?php if( 0 === $depth ) : ?>
		<p class="description description-wide">
            <label for="edit-menu-item-liquid-megaprofile-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Select Mega Menu', 'ave' ); ?><br />
				<select id="edit-menu-item-liquid-megaprofile-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-liquid-megaprofile[<?php echo esc_attr( $item_id ); ?>]">
					<option value="0"><?php esc_html_e( 'None', 'ave' ) ?></option>
					<?php
						$r = $this->walker_args;
						$r['selected'] = $item->liquid_megaprofile;
						echo walk_page_dropdown_tree( $this->megamenus, $r['depth'], $r );
					?>
				</select>
            </label>
        </p>
		<p class="description description-wide">
            <label for="edit-menu-item-liquid-badge-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Badge', 'ave' ); ?><br />
                <input type="text" id="edit-menu-item-liquid-badge-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-liquid-badge[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->liquid_badge ); ?>" />
            </label>
        </p>
		<?php endif; ?>

        <?php if( 0 !== $depth ) : ?>
		<p class="description description-wide">
            <label for="edit-menu-item-liquid-heading-item-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Make this item menu heading?', 'ave' ); ?><br />
                <select id="edit-menu-item-liquid-heading-item-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-liquid-heading-item[<?php echo esc_attr( $item_id ); ?>]">
					<option value="no" <?php selected( 'no', esc_attr( $item->liquid_heading_item ) ) ?>><?php esc_html_e( 'No', 'ave' ); ?></option>
					<option value="yes" <?php selected( 'yes', esc_attr( $item->liquid_heading_item ) ) ?>><?php esc_html_e( 'Yes', 'ave' ); ?></option>
				</select>            
			</label>
        </p>
        <?php endif; ?>

	<?php
        return ob_get_clean();
    }
}
