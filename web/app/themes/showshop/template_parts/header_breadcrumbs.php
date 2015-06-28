<?php
/**
 *	Template part to display breadcrumbs.
 *
 *	@since showshop 1.0
 */
global $as_of, $as_woo_is_active;


if( $as_of['show_breadcrumbs'] && !is_home() ) {
	
	$post_type = get_post_type();
		
	if( $as_woo_is_active ) {
		$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout()) ? true : false ;
	}else{
		$is_shop = false;
	}
	
	if ( $post_type != 'product' && !$is_shop ) {
	
		if (function_exists('dimox_breadcrumbs')  ) {					
			
			dimox_breadcrumbs();
		}
	}else{
	
		do_action('woocommerce_before_main_content'); // to hook woocommerce breadcrumb
	
	}
}
?>