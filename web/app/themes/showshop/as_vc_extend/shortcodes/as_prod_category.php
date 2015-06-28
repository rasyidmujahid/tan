<?php
/**
 * as_prod_cat_single_func
 * - DISPLAY SINGLE CATEGORY WITH ITS IMAGE
 * 
 * @param array $atts 
 * @param string $content  
 * 
 * @return string $output_string
 */
function as_prod_cat_single_func( $atts, $content = null ) { 

	extract( shortcode_atts( array(
		'title'			=> '',
		'subtitle'		=> '',
		'sub_position'	=> 'bellow',
		'title_style'	=> 'center',
		'title_color'	=> '',
		'subtitle_color'=> '',
		'no_title_shadow'	=> '',
		'title_size'	=> '',
		'enter_anim'	=> 'fadeIn',
		'img_width'		=> '',
		'img_height'	=> '',
		'text_color'	=> '',
		'overlay_color'	=> '',
		'product_cats'	=> '',
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	
			
	####################  HTML STARTS HERE: ###########################
	
	ob_start();
	
	$img_width	= $img_width ? $img_width : 300;
	$img_height = $img_height ? $img_height : 180;
		
	$anim = ($enter_anim != 'none') ? ' to-anim' : '';
		
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
	
	echo '<div class="wpb_wrapper">';
	
	echo '<div id="prod-cats-'.$block_id.'"  class="content-wrapper single-prod-category '. esc_attr($anim).'">';
	
		do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
	
		// CHECK IF THERE TERM EXISTS - when categories are changed, VC elements must be updated.
		if( term_exists( $product_cats, 'product_cat') ) {
			
		// set styles
		if ( $text_color ) {
			echo '<style scoped>';
			echo $text_color ? '#prod-cats-'.esc_attr($block_id).' .category-image .term h4, #prod-cats-'.esc_attr($block_id).' .block-subtitle { color: '.esc_attr($text_color).';}' : null;
			echo '</style>';
		}
		if ( $overlay_color ) {
			echo '<style scoped>';
			echo $overlay_color ? '#prod-cats-'.esc_attr($block_id).' a.category-image .item-overlay { background-color: '.esc_attr($overlay_color).';}' : null;
			echo '</style>';
		}
		
				
		// GET TAXONOMY OBJECT:
		$prod_cat_object = get_term_by( 'slug', $product_cats, 'product_cat' ); // get term object using slug
		
		$term_link = get_term_link( $prod_cat_object->slug, 'product_cat' );
		
		$thumbnail_id = get_woocommerce_term_meta( $prod_cat_object->term_id, 'thumbnail_id' );
		$image = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

		if ( $image ) {


			echo '<a href="'. esc_url($term_link) .'" class="'. esc_attr($prod_cat_object->slug) .' category-image" data-id="'. esc_attr($prod_cat_object->slug) .'">';
			
			echo '<div class="item-overlay"></div>';

			
			echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
			
			echo '<h4 class="box-title">' . esc_html($prod_cat_object->name) . '</h4>';
			echo '<p class="block-subtitle">' . esc_html($prod_cat_object->description) . '</p>';
			
			echo '</div></div></div></div>'; // .tablecell .tablerow .table .term
			
			echo '<img src="' . esc_url( fImg::resize( $image[0] , $img_width, $img_height, true  ) ) . '" alt="" />';
			echo '</a>';// .category-image
			
		}else{
		
			echo '<a href="'. esc_url($term_link).'" class="'. esc_attr($prod_cat_object->slug) .' category-image" data-id="'. esc_attr($prod_cat_object->slug) .'">';
			
			echo '<div class="item-overlay"></div>';
			
			echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
			
			echo '<h4 class="box-title">' . esc_html($prod_cat_object->name) . '</h4>';
			
			echo '</div></div></div></div>';// .tablecell .tablerow .table .term
			
			echo '<img src="' . esc_url( fImg::resize( AS_PLACEHOLDER_IMAGE , $img_width, $img_height, true  ) ). '" alt="" />';
			echo '</a>';
		}
	 
	 }else{
		 
		 echo '<p class="warning">'. __("Product category name (slug) has changed, or category doesn't exist.","showshop") .'</p>';
		 
	 }// end if term exists
	 
	 echo '</div>';
	 
	 echo '</div>';
	 
	 ?>
	
	<?php
	####################  HTML ENDS HERE: ###########################
	echo $css_classes ? '</div>' : null;
	?>
	
	<?php if( $enter_anim != 'none' ) {?>
	<script>
	(function( $ ){
		$.fn.anim_waypoints_prod_cat = function(blockId, enter_anim) {
			
			var thisBlock = $('#prod-cats-'+ blockId );
			if ( !window.isMobile && !window.isIE9 ) {
				var item = thisBlock.find('.category-image');
				
				item.waypoint(
					function(direction) {
						var item_ = $(this);
						if( direction === "up" ) {	
							item_.removeClass('animated '+ enter_anim).addClass('to-anim');
						}else if( direction === "down" ) {
							var i =  $(this).attr('data-i');
							setTimeout(function(){
							   item_.addClass('animated '+ enter_anim).removeClass('to-anim');
							}, 50 * i);
						}
					}
					
				,{ offset: "98%" });
			}else{
				thisBlock.find('.category-image').each( function() {
					$(this).removeClass('to-anim');
				});
			}
			
		}
	})( jQuery );
	
	jQuery(document).ready( function($) {
		
		$(document).anim_waypoints_prod_cat("<?php echo esc_js($block_id); ?>"," <?php echo esc_js($enter_anim);?>");
	
	});
	</script>
	<?php } ?>

	<?php
	
	$output_string = ob_get_contents();
   
	ob_end_clean();
	
	return $output_string ;


	
}

add_shortcode( 'as_prod_cat_single', 'as_prod_cat_single_func' );
?>