<?php
/**
 *	Animations for css classes array
 *  var $block_enter_anim_arr - for block viewport entering animation
 */

function as_vc_animations_array( $anim_type ) {
	
	include ( get_template_directory() .'/inc/functions/animations-icons-arrays.php' );
	
	if( $anim_type == 'enter_animation' ) {
		return array_flip ( $block_enter_anim_arr );
	}elseif( $anim_type == 'hover_animation' ) {
		return array_flip ( $hover_animation );
	}elseif( $anim_type == 'info_animation' ) {
		return array_flip ( $info_animation );
	}
}

/**
 *	If taxonomies exist:
 */
function as_vc_tax_posts() {
	$is_port_tax	= taxonomy_exists( 'category' );
	return $is_post_tax;
}
function as_vc_tax_products() {
	$is_port_tax	= taxonomy_exists( 'product_cat' );
	return $is_product_tax;
}
function as_vc_tax_portfolio() {
	$is_port_tax	= taxonomy_exists( 'portfolio_category' );
	return $is_port_tax;
}	
?>