<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//Plugins activeren en installeren
require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {

	$plugins = array(
		array(
			'name'      => 'Responsive Lightbox',
			'slug'      => 'responsive-lightbox',
			'required'  => false,
		),
		array(
			'name'               => 'Advanced Custom Fields Pro', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/includes/plugins/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Gravity Forms', // The plugin name.
			'slug'               => 'gravityforms', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/plugins/gravityforms.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'      => 'ACF-Content Analysis for Yoast SEO',
			'slug'      => 'acf-content-analysis-for-yoast-seo',
			'required'  => false,
		),
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),
		array(
			'name'        => 'Reorder Posts',
			'slug'        => 'metronet-reorder-posts',
			'required'    => false,
		),
		array(
			'name'        => 'Restricted Site Access',
			'slug'        => 'restricted-site-access',
			'required'    => false,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => 'Negeer bericht',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


		'strings'      => array(
			'page_title'                      => __( 'Installeer verplichte plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Installeer plugins', 'theme-slug' ),
			'installing'                      => __( 'Installeren van plugin: %s', 'theme-slug' ), // %s = plugin name.
			'oops'                            => __( 'Er is iets mis met de plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				'Dit thema vereist de volgende plugin: %1$s.',
				'Dit thema vereist de volgende plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'Dit thema beveelt de volgende plugin aan: %1$s.',
				'Dit thema beveelt de volgende plugins aan: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, u heeft niet de juiste rechten om de plugin %1$s te installeren.',
				'Sorry, u heeft niet de juiste rechten om de plugins %1$s te installeren',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'Er is een update beschikbaar voor: %1$s.',
				'Er zijn updates beschikbaar voor: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'De volgende vereiste plugin is niet actief: %1$s.',
				'De volgende vereiste plugins zijn niet actief: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'De volgende aanbevolen plugin is niet actief: %1$s.',
				'De volgende aanbevolen plugins zijn niet actief: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Installeer plugin',
				'Installeer plugins',
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Update plugin',
				'Update plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Activeer plugin',
				'Activeer plugins',
				'theme-slug'
			),
			'return'                          => __( 'Ga terug naar thema plugin installer', 'theme-slug' ),
			'plugin_activated'                => __( 'Plugin succesvol geactiveerd.', 'theme-slug' ),
			'activated_successfully'          => __( 'De volgende plugin is succesvol geactiveerd:', 'theme-slug' ),
			'plugin_already_active'           => __( 'Geen actie ondernomen. Plugin %1$s was al actief.', 'theme-slug' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin niet geactiveerd. Een hogere versie van %s is nodig voor dit thema. Update de plugin a.u.b.', 'theme-slug' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'Alle plugins zijn succesvol geïnstalleerd en geactiveerd. %1$s', 'theme-slug' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Neem contact op met de administrator van de website.', 'tgmpa' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),

	);

	tgmpa( $plugins, $config );
}
