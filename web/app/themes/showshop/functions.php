<?php
/**
 *	The MAIN FUNCTIONS FILE - includes all the neccesary additional theme functions, classes etc.
 *
 *	@since showshop 1.0
 */

/**
 * SECURITY: DISABLING XMLRPC FOR PING ATTACKS
 */
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
    unset( $methods['pingback.ping'] );
    
    return $methods;
}
/**
 * HTTP or HTTPS protocol
 */
if ( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ) {
	$as_protocol = "https";
}else{
	$as_protocol = "http";
}
/*
 *	OPTIONS FRAMEWORK - INCLUDED FROM "ADMIN" FOLDER
 *
 *
*/ 
// Paths to admin functions :
// if NOT CHILD THEME -use the paths and dir bellow:
if( !is_child_theme() ) {
	define('AS_OF_ADMIN_PATH', get_stylesheet_directory() . '/admin/');
	define('AS_OF_ADMIN_URI', get_template_directory_uri() . '/admin/');
	define('AS_OF_LAYOUT_PATH', AS_OF_ADMIN_PATH . '/layouts/');
}
//
//
//
$theme_data	= wp_get_theme();
$theme_slug	= sanitize_title( $theme_data );
define('THEMENAME', $theme_data);

// Name of the database row in wp_options table where your options are stored
define('OPTIONS', 'of_'.$theme_slug); 
//
// Build Options
require_once (AS_OF_ADMIN_PATH . 'admin-interface.php');	// Admin Interfaces 
require_once (AS_OF_ADMIN_PATH . 'theme-options.php'); 	// Options panel settings and custom settings
require_once (AS_OF_ADMIN_PATH . 'admin-functions.php'); 	// Theme actions based on options settings
/* end Options Framework */
#
#
#
/**
 *	MAIN INITIALIZATIONS:
 *
 */
if ( ! function_exists( 'as_theme_setup' ) ):
function as_theme_setup() {
	// MAX MEDIA WIDTH
	if ( ! isset( $content_width ) ) $content_width = 1600;
	// TRANSLATIONS:
	load_theme_textdomain( 'showshop', get_template_directory() . '/languages' );
	// HTML TITLE META TAG:
	add_theme_support( 'title-tag' );
	// POST FORMATS:
	add_theme_support( 'post-formats', array( 'audio', 'video', 'gallery','image', 'quote', 'chat', 'link', 'status' ) );
	//	POST THUMBNAIL SUPPORT:
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'product', 'portfolio', 'lookbook' ) );
	// FEEDS:
	add_theme_support( 'automatic-feed-links' );
	//
	// MENUS:
	add_theme_support( 'menus' );
	register_nav_menu( 'offcanvas-menu', 'Off canvas menu' );
	register_nav_menu( 'horizontal-menu', 'Horizontal menu' );
	register_nav_menu( 'vertical-menu', 'Vertical menu' );
	register_nav_menu( 'secondary', 'Secondary menu' );
	//
	//
	/*************** IMAGES ******************/
	//
	// IMAGE RESIZING SCRIPT
	if( ! class_exists('fImgResizer') ) {
		require_once('inc/functions/freshizer.php');	
	}
	//
	// IMAGE SIZES
	// - custom portrait and landscape formats
	// - default image sizes doubled in "inc/functions/run_once_class.php"
	add_image_size( 'as-portrait', 500, 700, true );
	add_image_size( 'as-landscape', 1200 ,680, true );
	//
	add_filter('image_size_names_choose', 'as_image_sizes_mediapopup', 11, 1);
	//
	/************ end IMAGES  ***************/
	//
	// ENABLE SHORTCODES ON REGULAR TEXT WIDGET
	add_filter('widget_text', 'do_shortcode'); // enable shortcodes in widgets
	//
	add_editor_style();
	//
	//
	// THEME WIDGETS
	include('inc/widgets/widget_latest_images.php');
	include('inc/widgets/widget_featured_images.php');
	include('inc/widgets/widget_social.php');
	include('inc/widgets/latest-custom-posts.php');
	include('inc/widgets/woocommerce-account-widget.php');
	//
	//
	// CUSTOM META BOXES
	require_once( 'inc/Custom-Meta-Boxes/custom-meta-boxes.php' );
	require_once( 'inc/functions/as-meta-boxes.php' );
	//
	//
	
}
endif;// as_theme_setup
add_action( 'after_setup_theme', 'as_theme_setup' );
//
//
//
//
global $as_of; // set global theme options variable containing theme options array
/**
 *	GLOBALS AND CONSTANTS 
 *
 *	const AS_PLACEHOLDER_IMAGE - used on all the places where no thumbnail image is not set.
 *	var $delimiter - used in breadcrumbs ( in directories inc/functions and woocommerce/shop)
 */
define ('AS_PLACEHOLDER_IMAGE', $as_of['placeholder_image'] );
define ('AS_UNDERHEAD_IMAGE', $as_of['under_head'] );
//$delimiter   = '<span class="delimiter"><span class="icon icon-angle-right"></span></span>'; // delimiter between crumbs  
$delimiter   = '<span class="delimiter">//</span>'; // delimiter between crumbs  
/**
 *	ADMIN FUNCTIONS:
 */
include('inc/functions/admin_functions.php');
/**
 * MENU FUNCTIONS:
 */
include('inc/functions/menus.php');
//
/**
 *	WIDGETS FUNCTIONS:
 */
include('inc/functions/widgets.php');
//
/**
 *	BREADCRUMBS:
 */
include('inc/functions/breadcrumbs.php');
//
/**
 *	PAGINATION:
 */
include('inc/functions/pagination.php');
//
/**
 *	RUN ONCE class:
 */
include('inc/functions/run_once_class.php');
//
/*
 *	COMMENTS:
 */
include('inc/functions/comments.php');
//
/**
 *	AUDIO / VIDEO: 
 */
include('inc/functions/audio-video.php');
//
/**
 *	IMAGE / GALLERY:
 */
include('inc/functions/image-gallery.php');
//
//
/**
 *	ENQUEUE THEME STYLES:
 */
include('inc/functions/enqueue_styles.php');
//
/**
 *	ENQUEUE THEME SCRIPTS:
 */
include('inc/functions/enqueue_scripts.php');
//
/** 
 *	POST FORMATS:
 */
include('inc/functions/post-meta.php');
/** 
 *	POST META:
 */
include('inc/functions/post-formats.php');
//
/**
 *	MISCELANEUOUS POST FUNCTIONS:
 */
include('inc/functions/misc_post_functions.php');
//
//
/**
 *	PLUGINS:
 */
include('inc/functions/theme_inc_plugins.php');
//
/**
 *	AJAX functions - used in custom blocks (prefixed with AS) created for Aqua Page Builder plugin
 */
 include('inc/functions/ajax.php'); //
/**
 *	WOOCOMMERCE
 */
include('woocommerce/woocommerce-theme-edits.php');
//
//
/**
 *	VISUAL COMPOSER EXTENDING:
 */
include('as_vc_extend/as_vc_init.php');
//
/**
 *	CUSTOM SIDEBARS:
 */
include('inc/functions/custom-sidebars.php');
//
?>