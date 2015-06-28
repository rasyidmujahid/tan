<!DOCTYPE html>
<?php 
//  GLOBAL OPTIONS DATA
global $as_of, $as_woo_is_active;
//
// THEME DEMO VARIABLES:
if( isset($as_of['demo_mode']) ) { // because of theme update, remove isset for future
	
	if( $as_of['demo_mode'])  {

		require_once( get_template_directory() . '/theme_demo_vars.php');
	}
}
//
// CHECK IF IT'S HTTPS
if ( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ) {
	$as_of =  str_replace("http://", "https://", $as_of);
}
?>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->

<!--[if !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,IE=10, chrome=1"><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php if ( version_compare( $wp_version , "4.1" ) < 0 ) { ?>
<title><?php wp_title();?></title>
<?php }?>

<meta name="description" content="<?php bloginfo( 'description' );?>" />
<meta name="author" content="<?php the_author_meta('display_name', 1); ?>" />

<?php $favicon = $as_of['custom_favicon']; ?>

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="<?php echo  fImg::resize( $favicon , 32, 32, true  )?>">

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo  fImg::resize( $favicon , 144, 144, true  )?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo  fImg::resize( $favicon , 72, 72, true  )?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo  fImg::resize( $favicon , 57, 57, true  )?>">

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php
function body_layout($classes) {
	global $as_of;
	if( $as_of['orientation'] == 'horizontal' ) {
		$class = 'horizontal-layout';
	}else{
		$class = 'vertical-layout';
	}
	$classes[] = $class;
	return $classes;
}
add_filter('body_class', 'body_layout');
?>


<?php wp_head(); ?>

</head>


<body <?php body_class();?> id="body">

<div id="bodywrap">

<?php 
/* #bodywrap is used to fix foundation tooltips 
 * div is referenced in as_custom.js for vertical layout - sub and mega menus position
 */
?>

<?php
if( $as_of['use_preloader'] ) { 
	echo '<div id="loader-back"><div class="load-container"><div class="loader">'.__("Loading...","showshop").'</div></div></div>';
} 

if( $as_of['demo_mode'] ) {
	get_template_part('theme_demo_switcher');
}
?>

	<?php
	
	/**
	 *	HEADER AND MENU ORIENTATION:
	 */
	$header			= $as_of['orientation'];
	$horiz_layouts	= isset( $as_of['horizontal_layouts'] ) ? $as_of['horizontal_layouts'] : 'default';
	if( $header == 'horizontal' ){
				
		get_template_part( 'header',  $horiz_layouts );
		
		$page_layout = ' horizontal';
		
	}elseif( $header == 'vertical' ) {
	
		get_template_part('header','vertical');
		
		$page_layout = ' vertical';
	}	
	
	/**
	 *	SETTINGS FOR FIXED HEADER OPTION
	 *  var global $post
	 */
	global $post;
	if( $post ) {
	
		$page_under_head = get_post_meta( $post->ID,'as_page_under_head' );
		$page_under_head_class	= ( $page_under_head && is_singular() ) ? ' page-under-head' : '';
		
	}else{
		$page_under_head_class = '';
	}
	?>
	
	
	<div id="page" class="page<?php echo esc_attr($page_layout); echo esc_attr($page_under_head_class); ?>">
	
	<?php if( $header == 'vertical' ) { ?>
	<div class="row">
	
		
		<div class="small-12 column breadcrumbs-holder">
		
			<?php
			$lang_sel = isset($as_of['lang_sel']) ? $as_of['lang_sel'] : null;
			if ( function_exists('as_languages_list') && $lang_sel  ) { 
				as_languages_list();
			}
			?>
			
			<?php get_template_part('template_parts/header_breadcrumbs'); ?>
		
		</div>
		
		<div class="small-12 column" style="float: right !important;">
		
		<?php		
		if ( has_nav_menu( 'secondary' ) ) { 
			get_template_part('template_parts/header_secondary_menu');
		}
		?>
		</div>
		
	</div>
	<?php } ?>
	
	<?php
	// IF CURRENT PAGE IS SHOP PAGE
	if( $as_woo_is_active ) {
		$is_shop = ( is_shop() ||  is_cart() || is_checkout() || is_account_page()) ? true : false ;
	}else{
		$is_shop = false;
	}
	
	// DISPLAY PREV / NEXT POST ON SINGULAR PAGES
	if( $post ) {
		$hide_single_nav = get_post_meta( $post->ID,'as_hide_single_nav' );
		if( is_singular() && ! is_home() && !$hide_single_nav  && !$is_shop ) {
			echo as_prev_next_post();
		}
	}
	
	//get_template_part("theme_demo_debug");

?>