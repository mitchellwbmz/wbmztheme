<?php
/**
 * Check and setup theme's default settings
 *
 * @package picostrap5
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wbmz_setup_theme_default_settings' ) ) {
	/**
	 * Store default theme settings in database.
	 */
	function wbmz_setup_theme_default_settings() {
		$defaults = wbmz_get_theme_default_settings();
		$settings = get_theme_mods();
		foreach ( $defaults as $setting_id => $default_value ) {
			// Check if setting is set, if not set it to its default value.
			if ( ! isset( $settings[ $setting_id ] ) ) {
				set_theme_mod( $setting_id, $default_value );
			}
		}
	}
}

if ( ! function_exists( 'wbmz_get_theme_default_settings' ) ) {
	/**
	 * Retrieve default theme settings.
	 *
	 * @return array
	 */
	function wbmz_get_theme_default_settings() {
		$defaults = array(
			'wbmz_posts_index_style' => 'default',   // Latest blog posts style.
			'wbmz_sidebar_position'  => 'right',     // Sidebar position.
			'wbmz_container_type'    => 'container', // Container width.
		);

		/**
		 * Filters the default theme settings.
		 *
		 * @param array $defaults Array of default theme settings.
		 */
		return apply_filters( 'wbmz_theme_default_settings', $defaults );
	}
}


// as per https://livecanvas.com/faq/which-themes-with-livecanvas/
function lc_theme_is_livecanvas_friendly(){}


// expose to the livecanvas plugin the active Bootstrap version
function lc_theme_bootstrap_version(){return 5;}