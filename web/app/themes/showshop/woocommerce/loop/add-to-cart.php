<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<div class="add-to-cart-holder"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="tip-top %s product_type_%s accent-1-light-40" title="%s" data-tooltip><span class="icon-shopping63"></span></a></div>',
		esc_url( $product->add_to_cart_url() ), //1
		esc_attr( $product->id ), //2
		esc_attr( $product->get_sku() ), //3 
		esc_attr( isset( $quantity ) ? $quantity : 1 ), //4
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '', //5
		esc_attr( $product->product_type ), //6
		esc_html( $product->add_to_cart_text() ) //7
	),
$product );
 ?>
