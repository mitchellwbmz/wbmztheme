<?php
/**
 * Declaring widgets
 *
 * @package wbmz
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
add_filter( 'dynamic_sidebar_params', 'wbmz_widget_classes' );

if ( ! function_exists( 'wbmz_widget_classes' ) ) {

	/**
	 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
	 * so widgets can be displayed one, two, three or four per row.
	 *
	 * @global array $sidebars_widgets
	 *
	 * @param array $params {
	 *     Parameters passed to a widget’s display callback.
	 *
	 *     @type array $args  {
	 *         An array of widget display arguments.
	 *
	 *         @type string $name          Name of the sidebar the widget is assigned to.
	 *         @type string $id            ID of the sidebar the widget is assigned to.
	 *         @type string $description   The sidebar description.
	 *         @type string $class         CSS class applied to the sidebar container.
	 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
	 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
	 *         @type string $after_title   HTML markup to append to the widget title when displayed.
	 *         @type string $widget_id     ID of the widget.
	 *         @type string $widget_name   Name of the widget.
	 *     }
	 *     @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 *         @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 * @return array $params
	 */
	function wbmz_widget_classes( $params ) {

		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets );

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
			//$sidebar_id   = $params[0]['id'];
			//$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			$widget_classes = "col-md";
			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
		}

		return $params;

	}
} // End of if function_exists( 'wbmz_widget_classes' ).

add_action( 'widgets_init', 'wbmz_widgets_init' );

if ( ! function_exists( 'wbmz_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function wbmz_widgets_init() {
		/*
		register_sidebar(
			array(
				'name'          => __( 'Right Sidebar', 'wbmz' ),
				'id'            => 'right-sidebar',
				'description'   => __( 'Right sidebar widget area', 'wbmz' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Left Sidebar', 'wbmz' ),
				'id'            => 'left-sidebar',
				'description'   => __( 'Left sidebar widget area', 'wbmz' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Hero Slider', 'wbmz' ),
				'id'            => 'hero',
				'description'   => __( 'Hero slider area. Place two or more widgets here and they will slide!', 'wbmz' ),
				'before_widget' => '<div class="carousel-item">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Hero Canvas', 'wbmz' ),
				'id'            => 'herocanvas',
				'description'   => __( 'Full size canvas hero area for Bootstrap and other custom HTML markup', 'wbmz' ),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Top Full', 'wbmz' ),
				'id'            => 'statichero',
				'description'   => __( 'Full top widget with dynamic grid', 'wbmz' ),
				'before_widget' => '<div id="%1$s" class="static-hero-widget %2$s dynamic-classes">',
				'after_widget'  => '</div><!-- .static-hero-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		*/

		register_sidebar(
			array(
				'name'          => __( 'Sidebar', 'wbmz' ),
				'id'            => 'main-sidebar',
				'description'   => __( 'Main sidebar widget area', 'wbmz' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);


		register_sidebar(
			array(
				'name'          => __( 'Footer kolom 1', 'wbmz' ),
				'id'            => 'footer_een',
				'description'   => __( 'Footer kolom 1', 'wbmz' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer kolom 2', 'wbmz' ),
				'id'            => 'footer_twee',
				'description'   => __( 'Footer kolom 2', 'wbmz' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer kolom 3', 'wbmz' ),
				'id'            => 'footer_drie',
				'description'   => __( 'Footer kolom 3', 'wbmz' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer kolom 4', 'wbmz' ),
				'id'            => 'footer_vier',
				'description'   => __( 'Footer kolom 4', 'wbmz' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		if ( class_exists( 'woocommerce' ) )
		register_sidebar(
			array(
				'name'          => __( 'WooCommerce Shop Sidebar', 'wbmz' ),
				'id'            => 'wc-sidebar',
				'description'   => __( 'Shop sidebar widget area', 'wbmz' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);


	}
} // End of function_exists( 'wbmz_widgets_init' ).
