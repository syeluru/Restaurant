<?php

class Restaurant_Menu_Widget extends Thim_Widget {
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
			'restaurant-menu',
			__( 'Restaurant Menu', 'thim' ),
			array(
				'description'   => __( 'Restaurant Menu', 'thim' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'title'    => array(
					'type'    => 'text',
					'label'   => __( 'Title', 'thim' ),
					'options' => $cate,
				),
				'bg_image' => array(
					'type' => 'media',
					'name' => __( 'Upload Background Title Image', 'thim' ),
				),
				'color'    => array(
					'type'  => 'color',
					'label' => __( 'Color', 'thim' ),
				),
				'size'     => array(
					'type'    => 'select',
					'label'   => __( 'Size', 'thim' ),
					'options' => array( 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6' ),
					'default' => 'h3'
				),
				'id'       => array(
					'type'    => 'select',
					'label'   => __( 'Select Menu', 'thim' ),
					'options' => $cate,
				),
				'columns'  => array(
					'type'    => 'select',
					'label'   => __( 'Columns', 'thim' ),
					'options' => array( '1' => '1', '2' => '2' ),
				),
				'type'     => array(
					'type'    => 'select',
					'label'   => 'Menu Style',
					'options' => array( '' => 'Regular', 'dotted' => 'Dotted' ),
				),

			),
			TP_THEME_DIR . 'inc/widgets/restaurant-menu/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		if ( $instance['type'] == 'dotted' ) {
			return 'base';
		} else {
			return 'default';
		}
	}


	function get_style_name( $instance ) {
		return false;
	}
	function enqueue_frontend_scripts() {
		wp_enqueue_style( 'thim-magnific-css', TP_THEME_URI . 'inc/widgets/restaurant-menu/js/magnific-popup.css', array());
		wp_enqueue_script( 'thim-magnific', TP_THEME_URI . 'inc/widgets/restaurant-menu/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'thim-front-scripts', TP_THEME_URI . 'inc/widgets/restaurant-menu/js/erm-front-scripts.js', array( 'jquery' ), '', true );
	}
}

function thim_restaurant_menu_register_widget() {
	register_widget( 'Restaurant_Menu_Widget' );
}

add_action( 'widgets_init', 'thim_restaurant_menu_register_widget' );