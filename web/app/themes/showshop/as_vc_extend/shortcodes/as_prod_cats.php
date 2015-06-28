<?php 
function as_prod_cats_func( $atts, $content = null ) { 

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
		'prod_cat_menu'	=> 'images',
		'menu_columns'	=> 'stretch',
		'tax_menu_align'=> '',
		'text_color'	=> '',
		'overlay_color'	=> '',
		'product_cats'	=> '',
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	
	global $as_woo_is_active;	
	
	if( $as_woo_is_active ) {
			
	//
	// TAXONOMY FILTER ARGS
	if( isset($product_cats)  ){
		$tax_terms = $product_cats;
		$taxonomy = 'product_cat';
	}else{
		$tax_terms = '';
		$taxonomy = '';
	}
	
	####################  HTML STARTS HERE: ###########################
	
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
	
	echo '<div id="prod-cats-'.$block_id.'"  class="content-wrapper">';
	
	do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
	
	if( $tax_terms ) { 

		
	if( $prod_cat_menu == 'images' ){
		 $cat_menu_css = 'cat-images';
	}elseif( $prod_cat_menu == 'no_images') {
		$cat_menu_css = 'cat-list';
	}else{
		$cat_menu_css = '';
	}
	
	
		
		if ( $text_color ) {
			echo '<style scoped>';
			echo $text_color ? '#prod-cats-'.esc_attr($block_id).' ul .category-image .term h4 { color: '.esc_attr($text_color).';}' : null;
			echo '</style>';
		}
		if ( $overlay_color ) {
			echo '<style scoped>';
			echo $overlay_color ? '#prod-cats-'.esc_attr($block_id).' ul .category-image a .item-overlay { background-color: '.esc_attr($overlay_color).';}' : null;
			echo '</style>';
		}
		
		
		// GET TAXONOMY OBJECT:
		$term_Objects = array();
		$tax_terms_arr = explode(',', $tax_terms );
		foreach ( $tax_terms_arr as $term ) {
			if( term_exists( $term,  $taxonomy) ) {
				$term_Objects[] = get_term_by( 'slug', $term, $taxonomy ); // get term object using slug
			}
		}
		// MENU ITEMS COLUMNS	
		$grid_cat = '';
		if( $prod_cat_menu == 'images' ) {
			
			if( $menu_columns == 'auto') {
				$grid_cat = '';
			}elseif( $menu_columns == 'stretch' ){
				$grid_cat = ' large-' . floor( 12 / count($term_Objects) ) . ' medium-' . floor( 12 / count($term_Objects) ) . ' small-12 column';
			}else{
				$grid_cat = ' large-' . floor( 12 / $menu_columns ) . ' medium-' . floor( 12 / $menu_columns ) . ' small-12 column';
			}
		}
		
		
		echo '<ul class="taxonomy-menu '.$cat_menu_css.' '. $tax_menu_align .'">';
				
		$img_width	= $img_width ? $img_width : 300;
		$img_height = $img_height ? $img_height : 180;
		
		// DISPLAY TAXONOMY MENU:
		$i = 1;
		$anim = ($enter_anim != 'none') ? ' to-anim' : '';
		
		if( !empty( $term_Objects ) ) {
			
			foreach ( $term_Objects as $term_obj ) {
				
				$term_link = get_term_link( $term_obj->slug, 'product_cat' );
				
				if( $prod_cat_menu == 'images' ) { // if images should be displayed:
				
					$thumbnail_id = get_woocommerce_term_meta( $term_obj->term_id, 'thumbnail_id' );
					$image = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

					if ( $image ) {
			
						echo '<li class="category-image'. esc_attr($grid_cat) .' as-hover '. esc_attr($anim).'" data-i="'.$i.'" >';
						echo '<a href="'. esc_url($term_link) .'" class="'. esc_attr($term_obj->slug) .'" data-id="'. esc_attr($term_obj->slug) .'">';
						
						echo '<div class="item-overlay">';
						if ( $overlay_color ) {
							echo '<style scoped>';
							echo $overlay_color ? '#prod-cats-'.esc_attr($block_id).' ul .category-image a .item-overlay { background-color: '.esc_attr($overlay_color).';}' : null;
							echo '</style>';
						}
						echo '</div>';
						
						echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
						
						echo '<h4 class="box-title">' . esc_html($term_obj->name) . '</h4>';
						
						echo '</div></div></div></div>';
						
						echo '<img src="' . esc_url( fImg::resize( $image[0] , $img_width, $img_height, true  ) ) . '" alt="" />';
						echo '</a>';
						echo '</li>';
						
					}else{
					
						echo '<li class="category-image'. esc_attr($grid_cat) .' as-hover '. esc_attr($anim) .'" data-i="'.$i.'" >';
						echo '<a href="'. esc_url($term_link).'" class="'. esc_attr($term_obj->slug) .'" data-id="'. esc_attr($term_obj->slug) .'">';
						
						echo '<div class="item-overlay"></div>';
						
						echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
						
						if ( $text_color ) {
							echo '<style scoped>';
							echo $text_color ? '#prod-cats-'. esc_attr($block_id) .' ul .category-image .term h4 { color: '. esc_attr($text_color).';}' : null;
							echo '</style>';
						}
						
						echo '<h4 class="box-title">' . esc_html($term_obj->name) . '</h4></div></div></div></div>';
						echo '<img src="' . esc_url( fImg::resize( AS_PLACEHOLDER_IMAGE , $img_width, $img_height, true  ) ). '" alt="" />';
						echo '</a>';
						echo '</li>';
					}
					
				}elseif( $prod_cat_menu == 'no_images' ){
				
					echo '<li class="category-link'. esc_attr($grid_cat) .'">';
					echo '<a href="'. esc_url($term_link).'" class="'. esc_attr($term_obj->slug) .'" data-id="'. esc_attr($term_obj->slug) .'">';
					echo '<div class="term">' . esc_html($term_obj->name) . '</div>';
					echo '</a>';
					echo '</li>';
					
				}
				$i++;
			}
		
		}else{
			
			echo '<li class="warning">'. __("Product category names (slugs) changed, or no product category exists.","showshop") . '</li>';
			
		} // end if(!empty($term_Objects))
		
		
		echo '</ul>';
		
	
	
	 }// endif $tax_terms
	 
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

	
	}else{
	
		echo '<h5 class="no-woo-notice">' . __('PRODUCT CATEGORIES BLOCK DISABLED.<br> Sorry, it seems like WooCommerce is not active. Please install and activate last version of WooCommerce.','showshop') . '</h5>';
			return;
	} // if $as_woo_is_active


	
	
}

add_shortcode( 'as_prod_cats', 'as_prod_cats_func' );
?>