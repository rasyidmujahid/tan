<?php
/**
 *	GRID CLASS DEPENDING ON NUMBER OF WIDGETS IN WIDGET AREA (SIDEBAR):
 *	- grid class names are Zurb Foundation classes
 */
function as_product_widgets_params($params) {
	
	$sidebar_id = $params[0]['id'];

    if ( $sidebar_id == 'product-filters-widgets' ) {

        $total_widgets		= wp_get_sidebars_widgets();
        $sidebar_widgets	= count( $total_widgets[$sidebar_id] );
		$grid_width			= floor( 12 / $sidebar_widgets );

        $classes 	= array();
		$classes[] 	= 'large-' . $grid_width ;
		$classes[]	= 'medium-'. $grid_width . ' small-12 column';
		$class		= implode(' ', $classes );
		
		$params[0]['before_widget'] = str_replace('aside class="', 'aside class="'. $class .' ', $params[0]['before_widget']);

    }
    return $params;
}
add_filter('dynamic_sidebar_params','as_product_widgets_params');
//
function as_bottom_widgets_params($params) {
	
	$sidebar_id = $params[0]['id'];

    if ( $sidebar_id == 'bottom-page-widgets' ) {

        $total_widgets		= wp_get_sidebars_widgets();
        $sidebar_widgets	= count( $total_widgets[$sidebar_id] );
		$grid_width			= floor( 12 / $sidebar_widgets );

        $classes 	= array();
		$classes[] 	= 'large-' . $grid_width ;
		$classes[]	= 'medium-'. $grid_width . ' small-12 column';
		$class		= implode(' ', $classes );
		
		$params[0]['before_widget'] = str_replace('aside class="', 'aside class="'. $class .' ', $params[0]['before_widget']);

    }
    return $params;
}
add_filter('dynamic_sidebar_params','as_bottom_widgets_params');
//
/**
 *	STANDARD AS SETUP FOR WIDGETS
 *	
 */
function as_standard_widgets() {
//
	global $as_of, $as_woo_is_active;
	$icons = $as_of['default_widget_icons'];
	
	register_sidebar( array(
		'name'			=> __( 'Sidebar', 'showshop' ),
		'id'			=> 'sidebar',
		'description'	=> 'default Wordpress widget area - for blog, pages and archives sidebar',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
//
//	
//	IF WOOCOMMERCE PLUGIN IS ACTIVATED, TURN ON THESE WIDGET AREAS:
	if( $as_woo_is_active ) {
	
		register_sidebar( array(
			'name'			=> __( 'Shop sidebar', 'showshop' ),
			'id'			=> 'sidebar-shop',
			'description'	=> 'for usage with sidebar on WooCommerce shop pages - catalog, single product, cart, checkout, account ...',
			'before_widget' => '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
			'after_widget'	=> '</div><div class="clearfix"></div></aside>',
			'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
			'after_title'	=> '</h4>',
		) );
		//
		//	
		register_sidebar( array(
			'name'			=> __( 'Products page filter widgets', 'showshop' ),
			'id'			=> 'product-filters-widgets',
			'description'   => 'special widgets area, only visible in products catalog (archives) page, created for usage with products filters.',
			'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
			'after_widget'	=> '</div><div class="clearfix"></div></aside>',
			'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
			'after_title'	=> '</h4>',
		) );
		//	
		//	
		register_sidebar( array(
			'name'			=> __( 'Filter reset widget', 'showshop' ),
			'id'			=> 'layered-nav-filter-widgets',
			'description'   => 'for usage with "WooCommerce Layered Nav Filters" widget ONLY - if Layered Nav is used, place here the "WooCommerce Layered Nav Filters" widget to remove filters',
			'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
			'after_widget'	=> '</div><div class="clearfix"></div></aside>',
			'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
			'after_title'	=> '</h4>',
		) );

	}	// end if $as_woo_is_active
	//
	//	
	register_sidebar( array(
		'name'			=> __( 'Header widgets', 'showshop' ),
		'id'			=> 'sidebar-header',
		'description'	=> 'to be used in side menu or header menu - remember to set header widget block in Theme options.',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
	//
	//	
	register_sidebar( array(
		'name'			=> __( 'Header widgets 2', 'showshop' ),
		'id'			=> 'sidebar-header-2',
		'description'	=> 'to be used in side menu or header menu - remember to set header widget block in Theme options.',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
//
//	
	register_sidebar( array(
		'name'			=> __( 'Header widgets 3', 'showshop' ),
		'id'			=> 'sidebar-header-3',
		'description'	=> 'to be used in side menu or header menu - remember to set header widget block in Theme options.',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
//
//
	register_sidebar( array(
			'name'			=> __( 'Bottom page widgets', 'showshop' ),
			'id'			=> 'bottom-page-widgets',
			'description'   => 'additional widgets place at the bottom of the page, just above the footer',
			'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
			'after_widget'	=> '</div><div class="clearfix"></div></aside>',
			'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
			'after_title'	=> '</h4>',
		) );

	register_sidebar( array(
		'name'			=> __( 'Footer widgets 1', 'showshop' ),
		'id'			=> 'footer-widgets-1',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//
//
	register_sidebar( array(
		'name'			=> __( 'Footer widgets 2', 'showshop' ),
		'id'			=> 'footer-widgets-2',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//
//
	register_sidebar( array(
		'name'			=> __( 'Footer widgets 3', 'showshop' ),
		'id'			=> 'footer-widgets-3',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//
	register_sidebar( array(
		'name'			=> __( 'Footer widgets 4', 'showshop' ),
		'id'			=> 'footer-widgets-4',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//		
}
add_action( 'widgets_init', 'as_standard_widgets' );
//
?>