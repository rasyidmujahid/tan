<?php
function as_ajax_prod_func( $atts, $content = null ) { 
  
	global $post, $wp_query, $as_woo_is_active, $as_wishlist_is_active, $woocommerce;

		extract( shortcode_atts( array(
			'title'				=> '',
			'subtitle'			=> '',
			'sub_position'		=> 'bellow',
			'title_style'		=> 'center',
			'title_color'		=> '',
			'subtitle_color'	=> '',
			'no_title_shadow'		=> '',
			'title_size'		=> '',
			'enter_anim'		=> 'fadeIn',
			'product_cats'		=> '',
			'prod_cat_menu'		=> 'images',
			'menu_columns'		=> 'auto',
			'tax_menu_align'	=> '',
			'img_format'		=> 'as-portrait',
			
			'anim'				=> 'anim-1',
			'data_anim'			=> 'none',
			
			'filters'			=> 'latest',
			'shop_quick'		=> '',
			'shop_buy_action'	=> '',
			'shop_wishlist'		=> '',
			'smaller'			=> '',
			
			'total_items'		=> 8,
			'hide_slider'		=> '',
			'slider_navig'		=> '',
			'slider_pagin'		=> '',
			'slider_timing'		=> '',
			'force_spacing'		=> '',
			
			'items_desktop'		=>  4,
			'items_desktop_small' => 3,
			'items_tablet'		=>	2,
			'items_mobile'		=> 1,
			
			'text_color'		=> '',
			'overlay_color'		=> '',
			'button_label'		=> '',
			'ap_link_button'	=> '',
			'outlined'			=> '',
			'css_classes'		=> '',
			'block_id'			=> generateRandomString()
			  
		), $atts ) );
	
	
	$content = wpb_js_remove_wpautop($content, true);
	
	
	$button 	= vc_build_link( $ap_link_button );
	$but_url		= $button['url'];
	$but_title	= $button['title'];
	$but_target		= $button['target'];
		
		
		$total_items = $total_items ? $total_items : -1;
				
		
		// SET POST TYPE VARIABLE
		$post_type = 'product';
		
		// PRODUCT FILTERS:
		$order_rand	= false;
		if ( $filters == 'featured' ){
			
			$args_filters = array( 
				'meta_key' => '_featured',
				'meta_value' => 'yes'
			);
			remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
			
		}elseif( $filters == 'best_sellers' ){
			
			$args_filters = array( 
				'meta_key' 	 => 'total_sales'
			);
			remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		
		}elseif( $filters == 'best_rated' ){
			
			$args_filters = array();
			add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
			
		}elseif( $filters == 'latest' ){
			
			$args_filters = array();
			remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		
		}elseif( $filters == 'random' ){
		
			$order_rand	= true;
			$args_filters = array();
			remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
			
		}
		/* elseif( $filters == 'on_sale' ){
			
			$product_ids_on_sale    = wc_get_product_ids_on_sale();
			$product_ids_on_sale[]  = 0;
			$main_args['post__in'] = $product_ids_on_sale;
			
			$args_filters = array();
			remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		
		}
		*/
		
		//
		// TAXONOMY FILTER ARGS
		if( $product_cats ){
			$tax_terms = $product_cats;
			$taxonomy = 'product_cat';
		}else{
			$tax_terms = '';
			$taxonomy = '';
		}
		
		####################  HTML STARTS HERE: ###########################
		ob_start();
		
		echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
		
		
		do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
		
		echo '<div id="prod-cats-'.esc_attr($block_id).'" class="content-wrapper">';
		
		########## TAXONOMY (PRODUCT CATEGORIES) MENU CREATING ##########
		$tax_terms_arr = explode(',', $tax_terms );
		
		if( $tax_terms && $prod_cat_menu != 'none' ) {
		
		if( $prod_cat_menu == 'images' ){
			 $cat_menu_css = 'cat-images';
		}elseif( $prod_cat_menu == 'no_images') {
			$cat_menu_css = 'cat-list';
		}else{
			$cat_menu_css = '';
		}
		
		
		
		if ( $text_color || $overlay_color ) {
			
			echo '<style scoped>';
			echo $text_color ? '#prod-cats-'.esc_attr($block_id).' ul .category-image .term h4 { color: '.esc_attr($text_color).';}' : null;						
			echo $overlay_color ? '#prod-cats-'.esc_attr($block_id).' ul .category-image a .item-overlay { background-color: '.esc_attr($overlay_color).';}' : null;
			echo '</style>';
		}			
		
		echo '<ul class="taxonomy-menu '. esc_attr($cat_menu_css) .' '.esc_attr($tax_menu_align).'">';
		
		
		// GET TAXONOMY OBJECT:
		$term_Objects = array();
		
		foreach ( $tax_terms_arr as $term ) {
			if( term_exists( $term,  $taxonomy ) ) {
				$term_Objects[] = get_term_by( 'slug', $term, $taxonomy ); // get term object using slug
			}
		}
		// menu items columns	
		if( $menu_columns == 'auto') {
			$grid_cat = '';
		}elseif( $menu_columns == 'stretch' ){
			$grid_cat = ' large-' . floor( 12 / count($term_Objects) ) . ' medium-' . floor( 12 / count($term_Objects) ) . ' small-12 column';
		}else{
			$grid_cat = ' large-' . floor( 12 / $menu_columns ) . ' medium-' . floor( 12 / $menu_columns ) . ' small-12 column';
		}
		
		$num_terms = count($term_Objects);
				
		
		
		// DISPLAY TAXONOMY MENU:
		if( !empty( $term_Objects ) ) {
		
			foreach ( $term_Objects as $term_obj ) {
				
				if( $prod_cat_menu == 'images' ) { // if images should be displayed:
				
					$thumbnail_id = get_woocommerce_term_meta( $term_obj->term_id, 'thumbnail_id' );
					$image = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

					if ( $image ) {
			
						echo '<li class="category-image'. $grid_cat .' as-hover">';
						echo ($num_terms > 1) ? '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">' : '<div>';
						
						echo '<div class="item-overlay"></div>';
						
						echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
						
						
						echo '<h4 class="box-title">' . $term_obj->name . '</h4></div></div></div></div>';
						echo '<img src="' . fImg::resize( $image[0] , 600, 250, true  ). '" alt="" />';
						echo ($num_terms > 1) ? '</a>' : '</div>';
						echo '</li>';
						
					}else{
					
						echo '<li class="category-image'. $grid_cat .' as-hover">';
						echo ($num_terms > 1) ? '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">' : '<div>';
						
						echo '<div class="item-overlay">';
						if ( $overlay_color ) {
							echo '<style scoped>';
							echo $overlay_color ? '#prod-cats-'.$block_id.' ul .category-image a .item-overlay { background-color: '.$overlay_color.';}' : null;
							echo '</style>';
						}
						echo '</div>';
						
						echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
						
						if ( $text_color ) {
							echo '<style scoped>';
							echo $text_color ? '#prod-cats-'.$block_id.' ul .category-image .term h4 { color: '.$text_color.';}' : null;						
							echo '</style>';
						}
						
						echo '<h4 class="box-title">' . $term_obj->name . '</h4></div></div></div></div>';
						echo '<img src="' . fImg::resize( AS_PLACEHOLDER_IMAGE , 600, 250, true  ). '" alt="" />';
						echo '<div class="arrow-down"></div>';
						echo ($num_terms > 1) ? '</a>' : '</div>';
						echo '</li>';
					}
					
				}elseif( $prod_cat_menu == 'no_images' ){
				
					echo '<li  class="category-link">';
					echo '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">';
					echo '<div class="term box-title">' . $term_obj->name . '</div>';
					echo '</a>';
					echo '</li>';
				}
			
			} // end foreach
		
		} // endif
		
		echo '</ul>';
		
		
		}// endif $tax_terms
		########## END TAXONOMY (PRODUCT CATEGORIES) MENU CREATING ##########
		?>
		
		<?php 
		
		// IN CASE NO SLIDER IS USED - ECHO THE GRID
		$l = 12 / $items_desktop;
		$t = 12 / $items_tablet;
		$m = 12 / $items_mobile;
		
		if ( $hide_slider ) {
			$no_slider = ' large-'.$l.' medium-'. $t . ' small-'.$m;
		}else{
			$no_slider = '';
		}
		/*
		IMPORTANT: HIDDEN INPUT TYPE - HOLDER OF VARS SENT VIA POST BY AJAX :
		*/
		?>
		<input type="hidden" class="varsHolder" name="ajax-vars" data-block_id="<?php echo esc_attr($block_id); ?>" data-tax = "<?php echo esc_attr($taxonomy); ?>"  data-ptype = "<?php echo esc_attr($post_type); ?>" data-totitems = "<?php echo esc_attr($total_items); ?>" data-filters = "<?php echo esc_attr($filters); ?>"  data-img= "<?php echo esc_attr($img_format); ?>"  data-shop_quick ="<?php echo esc_attr($shop_quick); ?>" data-shop_buy_action ="<?php echo esc_attr($shop_buy_action); ?>" data-shop_wishlist ="<?php echo esc_attr($shop_wishlist); ?>" data-enter_anim="<?php echo esc_attr($enter_anim); ?>" data-no_slider="<?php echo esc_attr($no_slider); ?>" data-smaller="<?php echo $smaller ? '1' : '0'; ?>" />
		
		
		<div class="clearfix"></div>

		<?php 
		
		// if there are taxonomies selected, turn on taxonomy filter:
		if( !empty($tax_terms) ) {
			
			$tax_filter_args = array('tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field' => 'slug', // can be 'slug' or 'id'
									'operator' => 'IN', // NOT IN to exclude
									'terms' => $tax_terms_arr,
									'include_children' => true
								)
							)
						);
		}else{
			$tax_filter_args = array();
		}
			
		
		$main_args = array(
			'no_found_rows'		=> 0,
			'post_status'		=> 'publish',
			'post_type'			=> $post_type,
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'orderby'			=> $order_rand ? 'rand menu_order date' : 'menu_order date',
			'order'				=> 'ASC',
			'numberposts'		=> $total_items
		);
		
		$all_args = array_merge( $main_args, $args_filters, $tax_filter_args );

		$content = get_posts($all_args);
		
		?>	

		<div class="loading-animation" style="display: none;"></div>
		
		<?php if($enter_anim != 'none') {?>
		<script>
		(function( $ ){
			$.fn.anim_waypoints = function(blockId, enter_anim) {
				
				var thisBlock = $('#products-'+ blockId );
				if ( !window.isMobile && !window.isIE9 ) {
					var item = thisBlock.find('.item');
					
					item.waypoint(
						function(direction) {
							var item_ = $(this);
							if( direction === "up" ) {	
								item_.removeClass('animated '+ enter_anim).addClass('to-anim');
							}else if( direction === "down" ) {
								var i =  item_.attr('data-i');
								setTimeout(function(){
								   item_.addClass('animated '+ enter_anim).removeClass('to-anim');
								}, 100 * i);
							}
						}
						
					,{ offset: "98%" });
				}else{
					thisBlock.find('.item').each( function() {
						$(this).removeClass('to-anim');
					});
				}
				
			}
		})( jQuery );
		
		jQuery(document).ready( function($) {
			
			//$('#products-<?php echo $block_id; ?>' ).find('.item-data').matchHeight();
			
			$(document).anim_waypoints("<?php echo esc_attr($block_id); ?>"," <?php echo esc_attr($enter_anim);?>");
		
		});
		</script>
		<?php } ?>
		
		
		<div id="products-<?php echo esc_attr($block_id); ?>" class="content-block cb-1 woocommerce<?php echo $force_spacing ? ' force-spacing' : ''; ?>" >

			<?php if( !empty( $tax_terms_arr )) {?>
			<div class="cat-title">
				<div class="wrap"></div>
				<a href="#" class="ajax-products"<?php echo !empty( $tax_terms_arr ) ? ' data-id="' . implode(",", $tax_terms_arr) .'"' : null; // array to string ?>>
					
					<div class="icon-cancel3" aria-hidden="true" title="<?php esc_attr_e('Reset categories','showshop'); ?>"></div> 
				</a>

			</div>
			<?php } ?>
			
			<?php
			// if the slider will loop or not
			$minimum_items	= ( count($content) < $items_desktop ) ? true : false ;
			$slider_loop	= ( $tax_terms || $minimum_items ) ? '0' : '1'; 
			?>
			
			<input type="hidden" class="slides-config" data-navigation="<?php echo $slider_navig ? '0' : '1'; ?>" data-pagination="<?php echo $slider_pagin ? '0' : '1'; ?>" data-auto="<?php echo esc_attr($slider_timing); ?>" data-desktop="<?php echo $items_desktop; ?>" data-desktop-small="<?php echo $items_desktop_small; ?>" data-tablet="<?php echo esc_attr($items_tablet); ?>" data-mobile="<?php echo esc_attr($items_mobile); ?>" data-loop="<?php echo esc_attr($slider_loop); ?>" />
			
			<div class="category-content <?php echo !$hide_slider ? 'owl-carousel contentslides' : '';?><?php echo ' '. esc_attr($anim) ;?> <?php echo $data_anim == 'none' ? '' : esc_attr($data_anim); ?>"  id="ajax-prod-<?php echo esc_attr($block_id); ?>" <?php echo $hide_slider ? "data-masonry-options='{  \"itemSelector\": \".item\" }'" : 'data-equalizer'; ?>>
			
			<?php 
			$i = 1;
			
			//start products loop
			foreach ( $content as $post ) {
				
				setup_postdata( $post );
				
				global $product, $yith_wcwl;
				
				if( defined('WPML_ON') ) { // if WPML plugin is active
					$id	= icl_object_id( get_the_ID(), 'product', false, ICL_LANGUAGE_CODE ); 
					$lang_code	= ICL_LANGUAGE_CODE;
				}else{
					$id	= get_the_ID();
					$lang_code	= '';
				}
				
				// DATA for back image
				$attachment_ids = $product->get_gallery_attachment_ids();
				if ( $attachment_ids ) {
					$image_url = wp_get_attachment_image_src( $attachment_ids[0], 'full'  );
					$img_url = $image_url[0];
					// IMAGE SIZES:
					$imgSizes = all_image_sizes(); // as custom function
					$img_width = $imgSizes[$img_format]['width'];
					$img_height = $imgSizes[$img_format]['height'];
				}
				// end DATA
				
				?>

				<div class="column item<?php echo esc_attr($no_slider); ?><?php echo ($enter_anim != 'none') ? ' to-anim' : '';  ?>" data-i="<?php echo esc_attr($i); ?>">
					
					<div class="anim-wrap" >
					
					<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : ''; ?>	
					
					<div class="item-img">
						
						<div class="front">
													
							<?php function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : ''; ?>
							
							<?php echo as_image( $img_format ); ?>
						
						</div>
						
						<div class="back<?php echo $smaller ? ' smaller' : ''; ?>">
						
							<div class="item-overlay"></div>

							<?php 
														
							if ( $attachment_ids ) {
								echo '<img src="'. fImg::resize( $img_url , $img_width, $img_height, true  ) .'" alt="'. the_title_attribute (array('echo' => 0)) .'" class="back-image" />';
							}else{
								echo as_image( $img_format );
							}

							as_shop_buttons( !$shop_quick , !$shop_buy_action , !$shop_wishlist );
							
							as_shop_title_price();
							
							?>
							
						</div>
						
					</div>
					
					<div class="item-data">
					
					
					</div><?php //.item-data ?>
					
				
				</div><?php // .anim-wrap ?>
				
				</div><?php // .column ?>
								
				<?php 
				$i++;
			}// END foreach
			
			wp_reset_postdata();
			
			?>
						
			</div>
			
			
			<?php if( $button_label && $but_url ) { ?>
			<div class="bottom-block-link">
			
				<a href="<?php echo esc_url( $but_url ); ?>" <?php echo ($but_target ? ' target="'.esc_attr($but_target).'" ' : '');?> class="button<?php echo  ($outlined ? ' outlined' : ''); ?>" <?php echo ($but_title ? 'title="'.esc_attr($but_title).'"' : 'title="'.esc_attr($button_label).'"'); ?> >
					<?php echo esc_html( $button_label ); ?>
				</a>
				
			</div>
			<?php } //endif; $button_label && $but_url ?>
			
			
			<div class="clearfix"></div>
			
		</div><!-- /.content-block cb-1 -->
		
		</div><!-- .content-wrapper-->
		
		<?php
		####################  HTML ENDS HERE: ################################
		echo $css_classes ? '</div>' : null;
		
		####################  HTML OUTPUT ENDS HERE: #########################
	
		$output_string = ob_get_contents();
	   
		ob_end_clean();
		
		return $output_string ;

}

add_shortcode( 'as_ajax_prod', 'as_ajax_prod_func' );
?>