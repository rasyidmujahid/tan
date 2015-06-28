<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce, $product, $post, $as_of, $as_wc_version;
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); 

/**
 *	REPLACE SHOP SINGLE SIZE VALUES WITH THEME REGISTERED SIZE VALUES
 *
 */

$img_sizes = all_image_sizes();
$of_imgformat = $as_of['single_product_image_format'];
if( $of_imgformat == 'as-portrait' ||  $of_imgformat == 'as-landscape' ){
	
	$img_width	= $img_sizes[$of_imgformat]['width'];
	$img_height = $img_sizes[$of_imgformat]['height'];

	$shop_single_w = $img_sizes['shop_single']['width'];
	$shop_single_h = $img_sizes['shop_single']['height'];
	
	
	$to_replace = $shop_single_w.'x'.$shop_single_h;
	$replace_size = $img_width .'x'. $img_height;


	foreach($available_variations as $var ){
		
		$img_src = str_replace( $to_replace, $replace_size , $var['image_src'] );	
		$replacements = array ( 'image_src' => $img_src );
		$variations_changed[] = array_replace( $var, $replacements );
		
	}
	$available_variations = $variations_changed;
}

?>


<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo esc_attr($post->ID); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php if ( ! empty( $available_variations ) ) : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $name ); ?>"><?php echo wc_attribute_label( $name ); ?></label></td>
						<td class="value"><select id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo sanitize_title( $name ); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $name ); ?>">
							<option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>
							<?php
								if ( is_array( $options ) ) {

									if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
										$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
									} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
										$selected_value = $selected_attributes[ sanitize_title( $name ) ];
									} else {
										$selected_value = '';
									}

									// Get terms if this is a taxonomy - ordered
									if ( taxonomy_exists( $name ) ) {
										########### IF OLDER THEN 2.3:
										if( version_compare( $as_wc_version, '2.3.0' ,'<' ) ) {
										
											$orderby = wc_attribute_orderby( $name );

											switch ( $orderby ) {
												case 'name' :
													$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
												break;
												case 'id' :
													$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
												break;
												case 'menu_order' :
													$args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
												break;
											}
										
										}
										
										$terms = get_terms( $name, $args );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) )
												continue;

											echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
										}
									} else {

										foreach ( $options as $option ) {
											echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
										}

									}
								}
							?>
						</select> <?php
							if ( sizeof( $attributes ) === $loop ) {
								echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';
							}
						?></td>
					</tr>
		        <?php endforeach;?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap" style="display:none;">
			<?php do_action( 'woocommerce_before_single_variation' ); ?>

			<div class="single_variation"></div>

			<div class="variations_button">
				<?php woocommerce_quantity_input(); ?>
				<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->id); ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php else : ?>

		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>

	<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
