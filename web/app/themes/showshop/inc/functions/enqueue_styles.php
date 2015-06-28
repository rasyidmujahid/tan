<?php
/**
 *	REGISTER AND ENQUEUE ADMIN STYLES
 *
 */
function as_customAdminCSS() {
	wp_register_style('showshop-admin-css', get_template_directory_uri(). '/css/admin/admin_styles.css', 'style');
	wp_enqueue_style( 'showshop-admin-css');
}
add_action('admin_head', 'as_customAdminCSS');
function icons_styles_script() {

	wp_register_style( 'glyphs_css', get_template_directory_uri() . '/css/admin/glyphs.css', false, '1.0.0' );
	wp_enqueue_style( 'glyphs_css' );

}
add_action( 'admin_enqueue_scripts', 'icons_styles_script' );
//
/**
 *	REGISTER AND ENQUEUE THEME STYLES
 *
 */
function as_theme_styles()  
{ 
	global $as_of;
	
	$t_url = get_template_directory_uri();
	
	
	/* 
	 * REGISTER GOOGLE FONTS 
	 */
	global $as_protocol;
	
	$google_body		= $as_of['google_body']['face'];
	$google_headings	= $as_of['google_headings']['face'];
	$one_google_font	= ( $google_body == $google_headings ) ? true : false;
	
	if( $google_body ) {
		$gooFontBody = str_replace(' ','+',$as_of['google_body']['face']);
		wp_register_style('google-font-body', $as_protocol . '://fonts.googleapis.com/css?family='. $gooFontBody .':300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	}
	
	if( $google_headings && !$one_google_font ) {
		$gooFontHeads = str_replace(' ','+',$as_of['google_headings']['face']);
		wp_register_style('google-font-headings', $as_protocol . '://fonts.googleapis.com/css?family='. $gooFontHeads .':300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	}
	
	
	
	
	/* REGISTER STYLES*/
	
	wp_register_style( 'showshop-minified', $t_url . '/css/theme_various.min.css', '', '', 'all' );
	//if( wp_style_is('foundation','registered ') ) {
		wp_deregister_style( 'foundation');
		wp_dequeue_style( 'foundation');
		wp_register_style( 'showshop-foundation',$t_url . '/css/foundation.min.css','' ,'' , 'all' );
	//}
	
	wp_register_style( 'showshop-main-css', $t_url . '/style.css', '', '', 'all' );
	wp_register_style( 'woocommerce-as', $t_url . '/woocommerce/woocommerce.css', '', '', 'all' );
	
	/* ENQUEUE STYLES */
	wp_enqueue_style( 'google-font-headings' );
	wp_enqueue_style( 'google-font-body' );
	
	wp_enqueue_style( 'showshop-minified' );
	if( !wp_style_is('showshop-foundation','enqueued ') ) {
		
		wp_enqueue_style( 'showshop-foundation' );
	}
	
	wp_enqueue_style( 'showshop-main-css' );
	wp_enqueue_style( 'woocommerce-as' );
	

	
	### THEME SKIN
	wp_enqueue_style('theme-skin', admin_url('admin-ajax.php') . '?action=theme_skin_css',array(), '1.0.0', 'all');
	require_once ('theme_skin_fonts.php');
	
	
	### THEME OPTIONS CSS AND JAVACRIPTS
	$dynamic_css_js = ( isset($as_of['dynamic_css_js']) && $as_of['dynamic_css_js'] ) ? 1 : 0;
	if( $dynamic_css_js ) {
		//DYNAMIC (AJAX) THEME OPTIONS CSS:
		wp_enqueue_style('options-styles', admin_url('admin-ajax.php') . '?action=dynamic_css',array(), '1.0.0', 'all');
	}else{
		
		// FILES CREATING:
		$theme_data		= wp_get_theme(); // get theme info
		$theme_slug		= sanitize_title( $theme_data ); // make ShowShop Fashion to be showshop-fashion
		
		$uploads		= wp_upload_dir();
		$as_upload_dir	= trailingslashit($uploads['basedir']) . $theme_slug . '-options'; // DIRECTORY to uploads
		$as_upload_url	= trailingslashit($uploads['baseurl']) . $theme_slug . '-options'; // URL to uploads
		
		$as_upload_dir_exists = is_dir( $as_upload_dir );
		
		// THEME OPTIONS CSS :
		if( $as_upload_dir_exists ){
			
			wp_register_style('options-styles', $as_upload_url . '/theme_options_styles.css', 'style');
			
		}else{
		
			wp_register_style('options-styles', get_stylesheet_directory_uri() . '/admin_save_options/theme_options_styles.css', 'style');
		}
		wp_enqueue_style( 'options-styles');
		//
		//
	}
		
}
add_action('wp_enqueue_scripts', 'as_theme_styles');
//
//
/**
 *	THEME SKIN
 *
 */
function theme_skin_css() {
	
	global $as_of;
	$theme_skin = $as_of['theme_skin'];
	$file = get_template_directory().'/admin/layouts/'.$theme_skin;	
	require($file);
	exit;
}
add_action('wp_ajax_theme_skin_css', 'theme_skin_css');
add_action('wp_ajax_nopriv_theme_skin_css', 'theme_skin_css');
/**
 *	DYNAMIC CSS - AJAX 
 *
 */
function dynamic_css() {
	
	$file = get_template_directory().'/admin_save_options/theme_options_styles.php';	
	require($file);
	exit;
}
add_action('wp_ajax_dynamic_css', 'dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'dynamic_css');
//
//
//
/**
 *	CUSTOMIZE LOGIN PAGE.
 *
 */
// Add custom css for login page
function as_login_stylesheet() {

	### THEME OPTIONS CREATING FILES AND REGISTER/ENQUEUING 
	
	$theme_data		= wp_get_theme(); // get theme info
	$theme_slug		= sanitize_title( $theme_data ); // make ShowShop Fashion to be showshop-fashion
	
	$uploads		= wp_upload_dir();
	$as_upload_dir	= trailingslashit($uploads['basedir']) . $theme_slug . '-options'; // DIRECTORY to uploads
	$as_upload_url	= trailingslashit($uploads['baseurl']) . $theme_slug . '-options'; // URL to uploads
	
	$as_upload_dir_exists = is_dir( $as_upload_dir );
		
	if( $as_upload_dir_exists ){
	
		wp_enqueue_style( 'custom-login', $as_upload_url . '/custom_login_css.css' );
		
    }else{
	
		wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/admin/css/customlogin.css' );
	}
	
}
add_action( 'login_enqueue_scripts', 'as_login_stylesheet' );
//
// Change link and title from Wordpress.org to site homepage
function as_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'as_login_logo_url' );

function as_login_logo_url_title() {	
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'as_login_logo_url_title' );

?>