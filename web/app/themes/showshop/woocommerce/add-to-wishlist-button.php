<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product ;
$icon 		= '<span class="icon-heart-outlined"></span>';
$classes	= 'add_to_wishlist tip-top accent-1-light-30';
$title_add	= __('Add to wishlist','showshop');
?>

<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product->id ) ); ?>" data-product-id="<?php esc_attr_e($product->id); ?>" data-product-type="<?php esc_attr_e($product->product_type); ?>" class="<?php esc_attr_e($classes); ?>" title="<?php echo esc_attr($title_add); ?>" data-tooltip>
    <?php echo wp_kses_post($icon); ?> 
    <?php //echo wp_kses_post($label) ?>
</a>
<img src="<?php echo esc_url( get_template_directory_uri(). '/img/ajax-loader.gif' ); ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />