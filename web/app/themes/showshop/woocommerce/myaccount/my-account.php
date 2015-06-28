<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_print_notices(); ?>

<p class="myaccount_user">
	<?php
	printf(
		__( '<h3>Hello <strong>%1$s</strong> </h3>(not %1$s? <a href="%2$s">Sign out</a>)', 'olea' ) . ' ',
		$current_user->display_name,
		wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )
	);?>
</p>

<div class="myaccount_user">
	<?php
	$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
		'numberposts' => $order_count,
		'meta_key'    => '_customer_user',
		'meta_value'  => get_current_user_id(),
		'post_type'   => wc_get_order_types( 'view-orders' ),
		'post_status' => array_keys( wc_get_order_statuses() )
	) ) );

	$recent_orders = $customer_orders ? '<li><a href="#my_orders">View your recent orders</a></li>' : '';
	
	printf( __( 'From your account dashboard you can: <ul class="inline-list">%s<li><a href="#manage_addresses">Manage your shipping and billing addresses</a></li><li><a href="%s">Edit your password and account details</a></li></ul>', 'olea' ),
		$recent_orders,
		wc_customer_edit_account_url()
	);
	
	?>
</div>
<hr>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>
