<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $as_of;
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 * - DISCARDED - FUNCTION MOVED TO footer.php
	 do_action( 'woocommerce_before_single_product' );
	 */
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		//do_action( 'woocommerce_before_single_product_summary' );
		
		woocommerce_show_product_sale_flash();
		
		do_action('remove_YITH_wishlist_hooks'); // in "woocommerce-theme-edits.php" and "admin_functions.php"
		
		/** 
		 *	SINGLE PRODUCT IMAGES BEHAVIOR 
		 *	- default (feat. image with thumbs), slider or magnifier effect 
		 */
		$image_features = $as_of['single_product_images'];
		if( $image_features == 'slider' ) {
			
			echo '<input type="hidden" class="slides-config" data-navigation="1" data-pagination="1">';
			do_action( 'do_single_product_images', 'shop_single' );
		
		}elseif( $image_features == 'thumbnails' || $image_features == 'magnifier' ){
			
			do_action( 'woocommerce_before_single_product_summary' );
			
		}
	?>

	<div class="summary entry-summary">
		
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			
			/* ADDED HOOK IN woocommerce-theme-edits.php 
			 *	- left here for possible future restoring of code.
			 * //add_action('woocommerce_single_product_summary', function(){ do_action('as_wishlist_button');}, 35);
			 **/
			
			do_action( 'woocommerce_single_product_summary' );
		?>
		
	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>