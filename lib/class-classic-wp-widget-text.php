<?php


/**
 *
 * Classic Text Widget Class Fork to address 4.8 WordPress Update
 *
 */

namespace VictorFontCG;

if( ! defined( 'ABSPATH' ) ) exit;

class ClassicTextWidget extends \WP_Widget {

    /**
     * CONSTRUCT
    */
    public function __construct() {
        $widget_ops = array( 'classname' => 'classic-textwidget', 'description' => __('The classic text widget for arbitrary html or text.', 'classic-text-widget') );
        $control_ops = array( 'width' => 400, 'height' => 350 );
        parent::__construct( 'ClassicTextWidget', __( 'Classic Text Widget', 'classic-text-widget' ), $widget_ops, $control_ops );
    }

	/**
	 * OUTPUT: Outputs the content for the current Text widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Text widget instance.
	 */
    public function widget( $args, $instance ) {

		$title = apply_filters( 'classic_widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

		/**
		 * Filters the content of the Text widget.
		 *
		 * @since 1.0.0
		 *
		 * @param string         $widget_text The widget content.
		 * @param array          $instance    Array of settings for the current widget.
		 * @param WP_Widget_Text $this        Current Text widget instance.
		 */
		$text = apply_filters( 'classic_widget_text', $widget_text, $instance, $this );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) :
			echo $args['before_title'] . $title . $args['after_title'];
		endif; ?>
			<div class="classic-text-widget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $args['after_widget'];

    }

	/**
	 * UPDATE: Handles updating settings for the current Text widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
    public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		if ( current_user_can( 'unfiltered_html' ) ) :

			$instance['text'] = $new_instance['text'];

		else:

			$instance['text'] = wp_kses_post( $new_instance['text'] );

		endif;

		$instance['filter'] = ! empty( $new_instance['filter'] );

		return $instance;


    }

	/**
	 * FORM: Outputs the Text widget settings form.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */

    public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
		<?php

    }
}

/**
 * Register the Classic Text Widget
 */
function classic_text_widget_init() {

    register_widget( __NAMESPACE__ . '\ClassicTextWidget' );

}
add_action( 'widgets_init', __NAMESPACE__ . '\classic_text_widget_init' );

