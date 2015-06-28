<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	
	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		$cats_html = $product->get_categories( ', ', '<span class="posted_in"><span class="icon-folder meta-icon"></span> ' . _n( 'Category:', 'Categories:', $size, 'woocommerce' ) . ' ', '.</span>' );
		 echo wp_kses_post($cats_html);
	?>
	
	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		$tags_html = $product->get_tags( ', ', '<span class="tagged_as"><span class="icon-price-tags meta-icon"></span> ' . _n( 'Tag:', 'Tags:', $size, 'woocommerce' ) . ' ', '.</span>' );
		echo wp_kses_post($tags_html);
	?>
	
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><span class="icon-barcode meta-icon"></span> <?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span>.</span>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>