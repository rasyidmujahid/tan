<?php
/**
 * Add to wishlist template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product, $yith_wcwl, $atts;

$icon_added 		= '<span class="icon-heart2"></span>';
$title_added		= __( 'Product added! Browse Wishlist','showshop' );
$title_in_wishlist	= __( 'The product is already in the wishlist! Browse Wishlist','showshop' );

$wishlist_url = YITH_WCWL()->get_wishlist_url();
$exists = YITH_WCWL()->is_product_in_wishlist( $product->id );
$product_type = $product->product_type;
$atts = array(
	'wishlist_url' => $wishlist_url,
	'exists' => $exists,
	'product_id' => $product->id,
	'product_type' => $product_type,
	'label' =>'',
	'icon' => '',
	'link_classes' => '',
	'available_multi_wishlist' => false,
);
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php esc_attr_e($product->id); ?>">
    
	<div class="yith-wcwl-add-button <?php echo ( $exists && ! $available_multi_wishlist ) ? 'hide': 'show' ?>" style="display:<?php echo ( $exists && ! $available_multi_wishlist ) ? 'none': 'block' ?>">

        <?php yith_wcwl_get_template( 'add-to-wishlist-button.php', $atts ); ?>

    </div>

    <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                
		<a href="<?php echo esc_url( $wishlist_url ); ?>" class="tip-top accent-1-light-30" title="<?php echo esc_attr($title_added); ?>" data-tooltip><?php echo wp_kses_post($icon_added); ?></a>

    </div>

    <div class="yith-wcwl-wishlistexistsbrowse <?php echo ( $exists && ! $available_multi_wishlist ) ? 'show' : 'hide' ?>" style="display:<?php echo ( $exists && ! $available_multi_wishlist ) ? 'block' : 'none' ?>">
		
		<a href="<?php echo esc_url( $wishlist_url ) ?>" class="tip-top accent-1-light-30" title="'<?php echo esc_attr($title_in_wishlist); ?> " data-tooltip><?php echo wp_kses_post($icon_added); ?></a>

    </div>

    <div style="clear:both"></div>
    <div class="yith-wcwl-wishlistaddresponse"></div>

</div>

<div class="clear"></div>

<script type="text/javascript">
    if( jQuery( '#yith-wcwl-popup-message' ).length == 0 ) {
        var message_div = jQuery( '<div>' )
                .attr( 'id', 'yith-wcwl-message' ),
            popup_div = jQuery( '<div>' )
                .attr( 'id', 'yith-wcwl-popup-message' )
                .html( message_div )
                .hide();

        jQuery( 'body' ).prepend( popup_div );
    }
</script>