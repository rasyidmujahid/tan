<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<p class="woocommerce-info no-products-found"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>

<h3><?php esc_html_e("Perhaps you would be interested in our product on sale: ","showshop")?></h3>

<?php echo '<div class="row notfound-sales">'. do_shortcode('[sale_products per_page=12 columns=4 orderby=title order=asc]' ) .'</div>' ?>