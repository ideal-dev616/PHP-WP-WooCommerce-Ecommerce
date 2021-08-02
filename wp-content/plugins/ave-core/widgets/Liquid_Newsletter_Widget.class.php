<?php
/**
* Liquid Newslleter Widget
*
* @package Ave
*/
 
class Liquid_Newsletter_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_subscribe', 'description' => esc_html__( "Display Newsletter Form", 'ave-core' ) );
		parent::__construct( 'liquid-newsllter', esc_html__( 'Liquid Themes: Newsletter Form', 'ave-core' ), $widget_ops);

		$this-> alt_option_name = 'widget_liquid_subscribe';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget( $args, $instance ) {

		$cache = wp_cache_get('widget_liquid_subscribe', 'widget');

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		
		$newsletter_id = ! empty( $instance['newsletter_id'] ) ? $instance['newsletter_id'] : '';
		$newsletter_style = ! empty( $instance['newsletter_style'] ) ? $instance['newsletter_style'] : 'default';

		ob_start();
		extract( $args );

		echo $before_widget;
		
        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

        if( $title ):
            echo $before_title . esc_html( $title ) . $after_title;
        endif; ?>


	<div class="widget ld-sf ld-sf--size-sm ld-sf--button-block ld-sf--button-solid">
		<?php echo do_shortcode('[wysija_form id=" ' . $newsletter_id . '"]'); ?>
	</div>
	<?php
		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_liquid_subscribe', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
        $instance['title']         = strip_tags($new_instance['title']);
		$instance['newsletter_id'] = strip_tags( $new_instance['newsletter_id'] );
		$instance['newsletter_style'] = strip_tags( $new_instance['newsletter_style'] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_liquid_subscribe'] ) ) {

			delete_option('widget_liquid_subscribe');

		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_liquid_subscribe', 'widget' );
	}
	
	function get_mailpoet_forms() {

		if ( !class_exists('WYSIJA') ) {
			return array();
		}

		$model_forms = WYSIJA::get( 'forms', 'model' );
		$model_forms->reset();
		$forms = $model_forms->getRows( array( 'form_id', 'name' ) );
		$items = array();
		if (is_array($forms) && !is_wp_error($forms)) {
			foreach ($forms as $form) {
				$items[$form['form_id']] = $form['name'];
			}
		}

		return $items;

	}

	function form( $instance ) {

        $title   = isset($instance['title']) ? $instance['title'] : '';
		$newsletter_id = isset( $instance['newsletter_id'] ) ? $instance['newsletter_id'] : '';
		$newsletter_style = isset( $instance['newsletter_style'] ) ? $instance['newsletter_style'] : '';

		$forms = array_merge_recursive( array( esc_html__( 'Select', 'ave-core' ) => '' ) , array_flip( $this->get_mailpoet_forms() ) );
		
		$styles = array(
			'default' => esc_html__( 'Default', 'ave-core' ),
			'alt' => esc_html__( 'Style 1', 'ave-core'  ),
		);

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ave-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'newsletter_id' ) ); ?>"><?php esc_html_e( 'Newsletter:', 'ave-core' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'newsletter_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'newsletter_id' ) ); ?>" class="widefat">
			<?php foreach( $forms as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['newsletter_id'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>

		<?php
	}
}