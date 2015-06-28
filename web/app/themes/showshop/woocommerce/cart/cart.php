<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $as_of,  $as_wc_version;

$full_width_page = $as_of['shop_cart_full_width'];

wc_print_notices();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>


<table class="shop_table cart products" cellspacing="0">
	<thead>
		<tr>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		if ( sizeof(  WC()->cart->get_cart() ) > 0 ) {
			foreach (  WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<!-- The thumbnail -->
						<td class="product-thumbnail">

							<?php
								// remove cart link
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon-cancel3"></span></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
							
							
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $_product->is_visible() )
									echo wp_kses_post($thumbnail);
								else
									printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
									
							?>
						</td>

						<!-- Product Name -->
						<td class="product-name">
							<?php
								if ( ! $_product->is_visible() )
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
								else
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );


								// Meta data
								echo wp_kses_post( WC()->cart->get_item_data( $cart_item ));

                   				// Backorder notification
                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
                   					echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>
						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										'min_value'   => '0'
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		
	</tbody>
	
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

<div class="clearfix"></div>

<div class="large-8 small-12 columns update-holder">

	<div class="cart actions update-cart">
		<input type="submit" class="button" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />	
	</div>
	<?php do_action( 'woocommerce_cart_actions' ); ?>

	<?php wp_nonce_field( 'woocommerce-cart' ); ?>

</div>

<hr>

<div>

	<?php 
	$coupon_enabled = false;
	if ( WC()->cart->coupons_enabled() ) {
		$coupon_enabled = true;
	}
	?>
	
	<?php if( $coupon_enabled )  {?>
	<div class="large-4 small-12 columns cart-side">		

		<div class="cart actions"><h5><?php _e( 'Coupon', 'woocommerce' ); ?></h5>
		
				<div>
					
					<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label>
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button tiny" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
					
					<?php do_action('woocommerce_cart_coupon'); ?>
				</div>

		</div>

	</div>
	<?php } ?>

	<div class="<?php echo $coupon_enabled ? "large-8" : "large-12"; ?> small-12 columns cart-submain">		
		
		<?php 		
		do_action( 'woocommerce_after_cart_contents' ); 
		?>

		<div class="cart-collaterals">
		<?php do_action('woocommerce_cart_collaterals'); ?>
		</div>

	</div>

</div>

</form>

<?php do_action( 'woocommerce_after_cart' ); ?>