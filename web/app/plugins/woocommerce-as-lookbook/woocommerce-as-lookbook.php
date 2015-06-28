<?php
/*
Plugin Name: Woocommerce Lookbook
Plugin URI: http://aligator-studio.com
Description: Lookbook plugin for Woocommerce products
Version: 0.1.0
Author: Aligator Studio
Author URI: http://aligator-studio.com
*/

/**
 * LOAD TRANSLATIONS
 *
 */
function aslb_translations() {
	
	$wp_lang_dir_file = WP_LANG_DIR . '/plugins/aslb-' . get_locale() .'.mo';
	
	if ( file_exists( $wp_lang_dir_file ) ) {
		load_textdomain( 'aslb', $wp_lang_dir_file );
	}else{
		load_plugin_textdomain('aslb', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}
	
}  
add_action('init', 'aslb_translations');  

/**
 *	REGISTER CUSTOM POST TYPE - LOOKBOOK
 *
 **/
require_once( plugin_basename( 'lookbook-custom-post.php' ) );


/**
 *	FLUSHING REWRITE RULES ON ACTIVATION/DEACTIVATION
 *
 */ 
// INIT - REGISTER CPT ( function from require once file):
function lookbook_post_type_activation(){
	if( function_exists('lookbook_post_type') ){
		lookbook_post_type();
	}
}
// ON ACTIVATION - REGISTER CPT AND FLUSH:
function aslb_plugin_activate(){
	
	lookbook_post_type_activation(); //defines the post type so the rules can be flushed.

	flush_rewrite_rules();//and flush the rules.
}
// ON DEACTIVATION - JUST FLUSH:
function aslb_plugin_deactivate() {
	flush_rewrite_rules();
}
// ACTIONS:
register_activation_hook(__FILE__, 'aslb_plugin_activate');
register_deactivation_hook( __FILE__, 'aslb_plugin_deactivate' );
add_action('init', 'lookbook_post_type_activation');



/**
 *	ADD CUSTOM META BOXES
 *
 *
 **/
require_once( plugin_basename( 'meta-products.php' ) );
?>