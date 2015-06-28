<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $as_of;

$magnifier = false; 
if( $as_of['single_product_images'] == 'magnifier' ) {
	$magnifier = true; 
};


$of_img_format = $as_of['single_product_image_format'];
if( $of_img_format == 'plugin' ) {
	$img_format = 'shop_single';
}else{
	$img_format = $of_img_format;
}

?>
<div class="images item">

	
	<?php
		if ( has_post_thumbnail() ) {

			$post_thumb_id		= get_post_thumbnail_id();
			
			$maginifier_img_src	= wp_get_attachment_image_src( $post_thumb_id, $img_format );
			$maginifier_img  	= $maginifier_img_src[0];
			
			$image_class 		= esc_attr( 'attachment-' . $post_thumb_id );
			$image_title 		= the_title_attribute (array('echo' => 0));
			$full_image			= as_get_full_img_url();
			$product_title		= the_title_attribute (array('echo' => 0));
			$product_link		= esc_attr( get_permalink() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title' => $product_title,
				'class'	=> $image_class,
				'id'	=> 'prod-image-'.$post->ID,
				'data-zoom-image' => $maginifier_img // for jQuery magnifier 
				) );
							
				
			$attachment_count   = count( $product->get_gallery_attachment_ids() );
			if ( $attachment_count > 0 ) {
				$gallery = '[pp_gal-'.$post->ID.']';
			} else {
				$gallery = '';
			}

			
			if( !$magnifier ) {
			
				echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="anim-wrap"><div class="item-img"><div class="front">%1$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons"><a href="%2$s" data-o_href="%2$s" class="woocommerce-main-image zoom accent-1-light-30" itemprop="image" title="%3$s" rel="prettyPhoto' . $gallery . '"><div class="icon icon-zoom-in" aria-hidden="true"></div></a></div></div></div></div>',
			
				$image,			// 1
				$full_image,	// 2
				$product_title	// 3
				), $post->ID );

			}else{
			
				
				echo apply_filters( 'woocommerce_single_product_image_html',sprintf(				
				
				'<div class="item-img">'.

					'<a href="%2$s" data-o_href="%2$s" class="larger-image-link woocommerce-main-image zoom"  itemprop="image" title="%3$s" data-rel="prettyPhoto">'.
						
						'<div class="front">%1$s</div>'.
					
					'</a>'.
					
				'</div>'
				,
			
				$image,			// 1
				$full_image,	// 2
				$product_title	// 3 
				), $post->ID );
				
				// LOAD MAGNIFIER SCRIPTS
				if ( !wp_script_is( 'eZoom', 'enqueued' )) {
					
					wp_register_script( 'eZoom', get_template_directory_uri() . '/js/jquery.elevatezoom.js');
					wp_enqueue_script( 'eZoom' );
					
				}
				
				echo '
				<style>.zoomContainer {z-index: 10;}</style>
				
				<script type="text/javascript">
					 
					jQuery(document).ready(function() {
		
						jQuery("#prod-image-'.$post->ID .'").elevateZoom({
							gallery				: "gallery-'.$post->ID.'",
							zoomType			: "window",
							cursor				: "pointer", 
							galleryActiveClass	: "active",
							imageCrossfade		: true,
							loadingIcon			: "'. get_template_directory_uri() .'/img/ajax-loader.gif",
							zoomWindowPosition	: "magnifier-container",
							zoomWindowWidth		: 300,
							zoomWindowHeight	: 300,
							zoomWindowFadeIn	: 500,
							zoomWindowFadeOut	: 500,
							lensFadeIn			: 500,
							lensFadeOut			: 500,
							responsive			: true,
							scrollZoom			: true,
							constrainType		:"width",
							borderSize			: 1,
							borderColour		: "#999"

						}); 

					}); // end doc ready
		
				</script>
				';
			
			}

		
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ) );

		}
	?>
	
	<div id="magnifier-container"></div>
	
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

	
	
	<?php if( $magnifier ) { ?>
	
	<script type="text/javascript">
	
		jQuery(document).ready(function() {
			
			
			jQuery( document ).on('change','.variations_form .variations select', function(e){
				
				// set vars for : select, form , all variations data and get selected index
				var select		= jQuery(this),
					form		= select.closest('.variations_form '),	
					form_data		= jQuery.parseJSON( form.attr('data-product_variations') ),
					selected_index	= select.find('option:selected').index();
				
				// get variation data by selected dropdown index
				var var_id = '';
				if( form_data[selected_index -1] != undefined ) {
					var_id = form_data[selected_index -1].variation_id;
				}
				
				// vars : default image ( for reset dropdown select ) and target magnifier zoom div
				var defaultImage	= jQuery('.zoomWrapper').find('img').attr('data-zoom-image'),
					zoomWindow		= jQuery('.zoomWindow');
				
				// on dropdown un-select, get and set default image and return ( don't go ajax ) :
				if( !var_id || var_id == 0 ) {

					jQuery('.zoomWrapper').find('img').attr( 'src', defaultImage );
					zoomWindow.css('background-image', 'url(' + defaultImage + ')');
					return;
					
				}
				
				// AJAX load image (background-image) to zoomWindow,  with preload:
				
				var preload = "<?php echo get_template_directory_uri()?>/img/ajax-loader.gif";
				zoomWindow.html('<div class="zoom-image-preload"><img src="' + preload + '" ></div>');
				zoomWindow.css('background-image', 'none');
				
				var ajaxurl = "<?php echo admin_url("admin-ajax.php"); ?>";		
				jQuery.ajax({
		
					type: "POST",
					url: ajaxurl,
					data: { "action": "var-image", var_id: var_id  },
					success: function(response) {
						
						zoomWindow.css('background-image', 'url(' + jQuery.trim(response) + ')');
						zoomWindow.find('.zoom-image-preload').fadeOut(500, function() { zoomWindow.html('');})
												
					}, // end success
					error: function () {
						alert("Ajax fetching or transmitting data error");
					} //end error
				});
				
			}); // end click
			
			jQuery( '.reset_variations' ).click( function(){
							
				jQuery('.zoomWrapper').find('img').attr( 'src', defaultImage );
				jQuery('.zoomWindow').css('background-image', 'url(' + defaultImage + ')');
			
			});
			
		}); // end doc ready
	</script>
	
	<?php } ?>
	
</div>