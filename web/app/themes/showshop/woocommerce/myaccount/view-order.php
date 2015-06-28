<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page 
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<p class="order-info"><?php printf( __( 'Order <span class="label alert round">%s</span> was placed on <span class="label alert round">%s</span> and is currently <span class="label alert round">%s</span>.', 'woocommerce' ), $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), __( $status->name, 'woocommerce' ) ); ?></p>

<?php if ( $notes = $order->get_customer_order_notes() ) :
	?>
	<h3><?php _e( 'Order Updates', 'woocommerce' ); ?></h3>
	<div class="order_updates_holder">
	<ol class="commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="comment note">
			<div class="comment_container">
				<div class="comment-text">
					<p class="meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
					<div class="description">
						<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>		
	</ol>
	<hr>
</div>

	<?php
endif;

do_action( 'woocommerce_view_order', $order_id );