<?php

class Event_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'event',
			__( 'Thim: Event', 'thim' ),
			array(
				'description'   => __( 'event', 'thim' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'number' => array(
					'type'  => 'number',
					'label' => __( 'Number Post', 'thim' ),
				),
			),
			TP_THEME_DIR . 'inc/widgets/event/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-comingsoon', TP_THEME_URI . 'inc/widgets/event/js/jquery.mb-comingsoon.min.js', array( 'jquery' ), '', true );
	}
}

function thim_event_register_widget() {
	register_widget( 'Event_Widget' );
}
add_action( 'widgets_init', 'thim_event_register_widget' );