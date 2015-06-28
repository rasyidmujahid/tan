<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query, $product, $woocommerce_loop,  $as_of;

$classes = array();

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', loop_columns() );
}


$prod_cat_options = isset($as_of['prod_cats_sett']) ? $as_of['prod_cats_sett'] : '';
$cat_columns	= $prod_cat_options ? $prod_cat_options['Categories columns'] : '';
$img_width		= $prod_cat_options ? $prod_cat_options['Image width'] : '';
$img_height		= $prod_cat_options ? $prod_cat_options['Image height'] : '';


$cat_columns	= $cat_columns ? $cat_columns : $woocommerce_loop['columns'];
	
// OLEA THEME EDIT:
// total products:
$total = $wp_query->found_posts;
// for responsive grid:
if( $total == 1 ) {
	$oe = '12';
}elseif( $cat_columns % 2 == 0 ){ // more then 1 item and even
	$oe = '6';
}else{		// more then 1 item and odd
	$oe = '4';
};
//
// showshop theme edit: set grid by columns number
$classes[] = 'large-' . floor( 12 / $cat_columns );
// showshop theme edit: add grid css
$classes[] = 'item medium-'.$oe. ' small-12 column item';
$classes[] = 'product-category product';
?>

<div class="<?php echo implode( " ", $classes ); ?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<div class="item-overlay"></div>
		
		<div class="term">
			
			<span class="table"><span class="tablerow"><span class="tablecell">
			
			<h4 class="box-title">
			
			<?php
				echo esc_html($category->name);
				
				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count button round">' . $category->count . '</mark>', $category );
			?>
			</h4>	
			
			</span></span></span>
		
		</div>		
		<?php
		/**
		 * woocommerce_before_subcategory_title hook
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		//do_action( 'woocommerce_before_subcategory_title', $category ); 
		//
		$cat_img_size  		= apply_filters( 'single_product_cat_img_size', 'thumbnail' );
		$dimensions    		= wc_get_image_size( $cat_img_size );
		$thumbnail_id  		= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

		if ( $thumbnail_id ) {
		
			$image = wp_get_attachment_image_src( $thumbnail_id, $cat_img_size  );
			$image = $image[0];
			
			if( $img_width && $img_height ) {
			
				echo '<div class="entry-image"><img src="' . esc_url( fImg::resize( $image , $img_width, $img_height, true ) ). '" alt="" /></div>';
			
			}else{
				
				echo '<div class="entry-image"><img src="' . esc_url($image) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr($dimensions['width'] )  . '" height="' . esc_attr( $dimensions['height'] ) . '" /></div>';
			}
			
		} else {
		
			$image = woocommerce_placeholder_img_src();
			
			echo '<div class="entry-image"><img src="' . esc_url( fImg::resize( AS_PLACEHOLDER_IMAGE , $dimensions['width'], $dimensions['height'], true ) ). '" alt="" /></div>';
		}
		?>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>