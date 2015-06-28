<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $border_decor, $as_wc_version;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() ); ?>



<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
<div>
<div class="large-6 small-12 columns">
	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div id="customer_details">

			<div>

				<div style="width:95%;">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
			
			</div>

			<div>

				<?php do_action( 'woocommerce_checkout_shipping' ); ?>

			</div>

		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		
</div>
<div class="large-6 small-12 columns order_review_holder">		

		<h2 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h2>

	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_order_review' ); ?>

</div>
</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>