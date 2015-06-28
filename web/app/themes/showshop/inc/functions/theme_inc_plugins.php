<?php
/**
 * This file is a configuration for importing required and recommended plugins.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Theme plugins
 * @version	   2.4.1
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
//require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for ShowShop theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	$plugins = array(

		// REQUIRED PLUGINS
		array(
			'name' 				=> 'WooCommerce',
			'slug' 				=> 'woocommerce',
			'required' 			=> true,
		),
		array(
			'name' 				=> 'Visual Composer',
			'slug' 				=> 'js_composer',
			//'source'			=> get_template_directory() . '/inc/plugins/js_composer.zip',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/js_composer.zip',
			'external_url' 		=> 'http://aligator-studio.com/tgm_pa_plugins',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),	 
		array(
			'name' 				=> 'Revolution Slider',
			'slug' 				=> 'revslider',
			//'source'			=> get_template_directory() . '/inc/plugins/revslider.zip',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/revslider.zip',
			'external_url'		=> 'http://aligator-studio.com/tgm_pa_plugins/',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		array(
			'name' 				=> 'Envato Wordpress Toolkit',
			'slug' 				=> 'envato-wordpress-toolkit',
			'source'			=> get_template_directory() . '/inc/plugins/envato-wordpress-toolkit.zip',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		array(
			'name' 				=> 'WooCommerce Lookbook',
			'slug' 				=> 'woocommerce-as-lookbook',
			'source'			=> get_template_directory() . '/inc/plugins/woocommerce-as-lookbook.zip',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		
		
		// 
		//	Recommended plugins
		//	
		//
		array(
			'name' 				=> 'Search & Filter',
			'slug' 				=> 'search-filter',
			'required' 			=> false,
		),
		array(
			'name' 				=> 'YITH WooCommerce Wishlist',
			'slug' 				=> 'yith-woocommerce-wishlist',
			'required' 			=> false,
		),
		array(
			'name' 				=> 'Mailchimp for WordPress',
			'slug' 				=> 'mailchimp-for-wp',
			'required' 			=> false,
		),
		array(
			'name' 				=> 'AS Portfolio',
			'slug' 				=> 'as-portfolio',
			'source'			=> get_template_directory() . '/inc/plugins/as-portfolio.zip',
			'required' 			=> false,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		array(
			'name' 				=> 'Attachment importer',
			'slug' 				=> 'attachment-importer',
			'required' 			=> false,
		),
		
		array(
			'name' 				=> 'YITH WooCommerce Ajax Search',
			'slug' 				=> 'yith-woocommerce-ajax-search',
			'required' 			=> false,
		),
		
		array(
			'name' 				=> 'WooCommerce ShareThis Integration',
			'slug' 				=> 'woocommerce-sharethis-integration',
			'required' 			=> false
		),	
		
		/*- perhaps: ...
		array(
			'name'     				=> 'WP Tab Widget',
			'slug'     				=> 'wp-tab-widget',
			'required' 				=> false,
			'version' 				=> '1.2',
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false
		),			
		
		array(
			'name' 				=> 'YITH WooCommerce Compare',
			'slug' 				=> 'yith-woocommerce-compare',
			'required' 			=> false,
		),
		
		array(
			'name' 				=> 'YITH WooCommerce Ajax Navigation',
			'slug' 				=> 'yith-woocommerce-ajax-navigation',
			'required' 			=> false,
		),
		*/

	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'showshop' ),
            'menu_title'                      => __( 'Install Plugins', 'showshop' ),
            'installing'                      => __( 'Installing Plugin: %s', 'showshop' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'showshop' ),
            'notice_can_install_required'     => _n_noop( 'Showshop theme requires the following plugin: %1$s.', 'Showshop theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'Showshop theme recommends the following plugin: %1$s.', 'Showshop theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with Showshop theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with Showshop theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'showshop' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'showshop' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'showshop' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

	tgmpa( $plugins, $config );

}