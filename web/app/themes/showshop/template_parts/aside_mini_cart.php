<?php
/**
 *	Template part: Mini Cart
 *	partial for displaying mini cart (in aside and modal)
 *	requires WooCommerce plugin to be installed
 */
?>
<div class="mini-cart-list">

	<h5><?php echo __("Cart","showshop") ?></h5>
	
	<div class="widget_shopping_cart_content">
		
		
		<?php woocommerce_get_template_part('mini','cart');?>
		
	</div>
	
</div>
