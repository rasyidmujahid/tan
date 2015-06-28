<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="emptycart">

	<div aria-hidden="true" class="icon-shopping63"></div>
	
	<h4><?php _e( 'Your shopping bag is currently empty.', 'showshop' ) ?></h4>

	<?php do_action('woocommerce_cart_is_empty'); ?>

	<h2><a class="cart-empty" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><span class="icon-circle-left"></span> <?php _e( 'Return To Shop', 'woocommerce' ) ?></a></h2>
	
</div>