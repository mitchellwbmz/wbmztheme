<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


$wbmz_includes = array(
	'/theme-settings.php',                  // thema instellingen
	'/setup.php',                           // Thema supports
	'/widgets.php',                         // Widgets
	'/clean-head.php',											// Verwijder useless meta tags, emojis, etc
	'/enqueues.php', 												// Enqueue scripts and styles
	'/template-tags.php',                   // Custom template tags
	'/pagination.php',                      // Custom pagination
	'/custom.php',                      		// Custom code t.b.v. de klant en het het thema
	'/acf.php',                      				// Custom ACF code
	'/facetwp.php',                      		// Custom FacetWP code
	'/gforms.php',                      		// Custom Gravity forms code
	'/custom-comments.php',                 // Custom reacties
	'/class-wp-bootstrap-navwalker.php',    // Custom WordPress nav walker
	'/woocommerce.php',                     // Custom WooCommerce functies
	'/editor.php',                          // Custom editor functies
	'/customizer-assets/customizer.php',		// Customizer instellingen
	'/customizer-assets/scss-compiler.php', // SCSS compiler
	'/customizer-assets/livereload.php', 		// Livereload
	'/options-page.php',                  	// Opties pagina

);

foreach ( $wbmz_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}

// Zet comments uit
if (get_theme_mod("singlepost_disable_comments") ) require_once locate_template('/inc/disable-comments.php');

// Scroll to top
if (get_theme_mod("enable_back_to_top") ) require_once locate_template('/inc/back-to-top.php');

// Lightbox
if (get_theme_mod("enable_lightbox") ) require_once locate_template('/inc/lightbox.php');
