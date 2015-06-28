<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce, $as_of;

$of_img_format = $as_of['single_product_image_format'];
if( $of_img_format == 'plugin' ) {
	$img_format = 'shop_single';
}else{
	$img_format = $of_img_format;
}


$magnifier = false;
if( $as_of['single_product_images'] == 'magnifier' ) {
	$magnifier = true; 
};

$attachment_ids = $product->get_gallery_attachment_ids();

$gall_id = '';
if ( $magnifier &&  $attachment_ids  ) {
	$attachment_ids[] = get_post_thumbnail_id( $post->ID );
	$gall_id = 'gallery-'.$post->ID;
}

if ( $attachment_ids ) {
	$loop = 0;
	$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>

	<div class="thumbnails" id="<?php echo esc_attr($gall_id); ?>">
	
		<?php
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link_src	= wp_get_attachment_image_src( $attachment_id, $img_format );
			$image_link		= $image_link_src[0];
			
			if ( ! $image_link )
				continue;
			
			$image_class	= esc_attr( implode( ' ', $classes ) );
			$image_title	= the_title_attribute (array('echo' => 0));
			$image			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'thumbnail' ), array(
				'title' => $image_title
				));
				
			$full_image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
			$full_image		= $full_image_src[0];
			$product_title	= the_title_attribute (array('echo' => 0));
			$product_link	= esc_attr( get_permalink() );
			

			// CONDITIONAL VARS FOR IMAGE AND LARGE IMAGE LINK:
			$href = $magnifier ? '#' : $full_image;
			
			$a_attrs = $magnifier ? 'data-image="'.$image_link.'" data-zoom-image="'.$image_link.'"  data-full-image="'.$full_image	.'" data-pphotorel="prettyPhoto[pp_gal-'.$post->ID.']"'  : 'data-rel="prettyPhoto[pp_gal-'.$post->ID.']"';
			
			$icon = $magnifier ? 'icon-chevron-up' : 'icon-zoom-in';

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( 
			
						'<div class="item %2$s">'.
							
							'<div class="item-img">'.
							
								'<div class="front">%4$s</div>'.
								
								'<div class="back">'.
								
									'<div class="item-overlay"></div>'.
									
									'<div class="back-buttons">'.
									
										'<a href="'.$href.'" title="%3$s" '. $a_attrs .' class="link-sender accent-1-light-30 zoom">'.
											'<div class="icon '.$icon.'" aria-hidden="true"></div>'.
										'</a>'.
									
									'</div>'.
									

								'</div>'. // back
								
							'</div>'. // item-img
														
						'</div>', // item 
			
			$image_link,	// 1
			$image_class,	// 2
			$image_title,	// 3
			$image,			// 4
			$full_image,	// 5
			$product_title  // 6
			
			), $attachment_id, $post->ID, $image_class );
			
			$loop++;
		}

	?></div>
	
	<script type="text/javascript">
		jQuery(document).ready(function() {

			var aButton		= jQuery('.thumbnails').find('a.link-sender'),
				target		= jQuery('.images').find('a.larger-image-link');
							
			aButton.on('mousedown' ,function () {
							
				var _this	= jQuery(this),
					img_Link	= _this.data('full-image');
				
				target.attr('href', img_Link);
				
			});
			
			
		}); // end doc ready
	</script>
	
	
	<?php
}