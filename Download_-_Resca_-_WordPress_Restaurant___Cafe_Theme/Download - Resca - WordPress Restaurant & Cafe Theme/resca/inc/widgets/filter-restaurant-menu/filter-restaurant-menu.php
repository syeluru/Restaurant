<?php

class Filter_Restaurant_Menu_Widget extends Thim_Widget {
	function __construct() {
		$erm_menu_args = array(
			'post_type' => 'erm_menu',
		);
		$lop_menu_args = new WP_Query( $erm_menu_args );
		$cate[0]       = 'Create Menu';
		if ( $lop_menu_args->have_posts() ) {
			$cate = '';
			while ( $lop_menu_args->have_posts() ): $lop_menu_args->the_post();
				$cate[get_the_ID()] = get_the_title( get_the_ID() );;
			endwhile;
		}
		wp_reset_postdata();

		parent::__construct(
			'filter-restaurant-menu',
			__( 'Filter Restaurant Menu', 'thim' ),
			array(
				'description'   => __( 'Filter Restaurant Menu', 'thim' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'id'      => array(
					'type'    => 'text',
					'label'   => __( 'ID Menu', 'thim' ),
					'description' => __( 'Enter ID Menu. (Example: 1,2,3,...)', 'thim' )
				),
 			),
			TP_THEME_DIR . 'inc/widgets/filter-restaurant-menu/'
		);
	}

	function get_template_name( $instance ) {
		return 'base';
	}


	function get_style_name( $instance ) {
		return false;
	}
	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-mixitup', TP_THEME_URI . 'inc/widgets/filter-restaurant-menu/js/jquery.mixitup.min.js', array( 'jquery' ), '', true );
	}
}

function thim_filter_restaurant_menu_register_widget() {
	register_widget( 'Filter_Restaurant_Menu_Widget' );
}

add_action( 'widgets_init', 'thim_filter_restaurant_menu_register_widget' );