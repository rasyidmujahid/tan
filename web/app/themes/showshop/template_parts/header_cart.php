<?php
/**
 *	Template part: Header Cart Icon
 *	partial to display shopping icon with ajax update
 *	
 *	requires WooCommerce plugin to be installed
 */
global $as_of;

$cart_count = WC()->cart->cart_contents_count;
?>

<div class="showshop-head-cart mini-cart-toggle main-head-toggles" id="showshop-head-cart" data-toggle="mini-cart-list" title="<?php _e("Cart","showshop");?>" data-tooltip>
		
	<span class="icon-shopping63 mini-cart-icon" aria-hidden="true"></span>
	
		<?php echo '<span class="count">'. intval( $cart_count ).'</span>'; ?>
		
		<?php echo wp_kses_post( WC()->cart->get_cart_total() ); ?>

</div>