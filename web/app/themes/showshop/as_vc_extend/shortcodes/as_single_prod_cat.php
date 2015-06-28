<?php
/**
 * as_single_prod_cat_func
 * - DISPLAY PRODUCTS FROM SINGLE CATEGORY
 * 
 * @param array $atts 
 * @param string $content  
 * 
 * @return string $output_string
 */
function as_single_prod_cat_func( $atts, $content = null ) {
  
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
			
			'product_category'	=> '',
			'force_hide_title'	=> '',
			'force_hide_subtitle'=> '',
			'img_format'		=> 'as-portrait',

			'anim'				=> 'anim-1',
			'data_anim'			=> 'none',
			
			'shop_quick'		=> '',
			'shop_buy_action'	=> '',
			'shop_wishlist'		=> '',
			'smaller'			=> '',
			
			'filters'			=> 'latest',
			
			'total_items'		=> 8,
			'hide_slider'		=> '',
			'slider_navig'		=> '',
			'slider_pagin'		=> '',
			'slider_timing'		=> '',
			
			'items_desktop'		=> 4,
			'items_tablet'		=> 2,
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
	
	/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */		
	
	$button 	= vc_build_link( $ap_link_button );
	$but_url	= $button['url'];
	$but_title	= $button['title'];
	$but_target	= $button['target'];
		
		
	$total_items = $total_items ? $total_items : -1;
	
	
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
	
	####################  HTML STARTS HERE: ###########################
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
	
	do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );	
	
	echo '<div id="prod-cats-'.esc_attr($block_id).'" class="content-wrapper" data-equalizer-watch>';
	
	if( term_exists( $product_category, 'product_cat') ) {
		
		// Get prod category name and description
		$prod_cat_object = get_term_by( 'slug', $product_category, "product_cat" ); // get term object using slug
		$cat_name = $prod_cat_object->name;
		$cat_desc = $prod_cat_object->description ? $prod_cat_object->description : '';
		$cat_desc = $force_hide_subtitle ? '' : $cat_desc;
			
		// Use category name and description as block title if no title and subtitle
		$title		= $title ? $title : $cat_name;
		$subtitle	= $subtitle ? $subtitle : $cat_desc;
		


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
		
		$tax_filter_args = array(
			'tax_query' => array(
					array(
						'taxonomy'	=> 'product_cat',
						'field'		=> 'slug', // can be 'slug' or 'id'
						'operator'	=> 'IN', // NOT IN to exclude
						'terms'		=> $product_category,
						'include_children' => true
					)
				)
			);
			
		
		$main_args = array(
			'no_found_rows'		=> 0,
			'post_status'		=> 'publish',
			'post_type'			=> 'product',
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
		
		
		<div id="products-<?php echo esc_attr($block_id); ?>" class="content-block cb-1 woocommerce" >
			
			<input type="hidden" class="slides-config" data-navigation="<?php echo $slider_navig ? '0' : '1'; ?>" data-pagination="<?php echo $slider_pagin ? '0' : '1'; ?>" data-auto="<?php echo esc_attr($slider_timing); ?>" data-desktop="<?php echo $items_desktop; ?>" data-tablet="<?php echo esc_attr($items_tablet); ?>" data-mobile="<?php echo esc_attr($items_mobile); ?>" data-loop="1" />
			
			<div class="category-content <?php echo !$hide_slider ? 'owl-carousel contentslides' : 'shuffle';?><?php echo ' '. esc_attr($anim) ;?> <?php echo $data_anim == 'none' ? '' : esc_attr($data_anim); ?>"  id="ajax-prod-<?php echo esc_attr($block_id); ?>">
			
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
					
					<!--
					<div class="item-data">
					
					
					</div> .item-data 
					-->
					
				
				</div><!-- .anim-wrap -->
				
				</div><!-- .column -->
								
				<?php 
				$i++;
			}// END foreach
			
			wp_reset_postdata();
			
			?>
						
			</div>
			
			
			<?php if( $button_label && $but_url ) { ?>
			<div class="bottom-block-link">
			
				<a href="<?php echo esc_url( $but_url ); ?>" <?php echo ($but_target ? ' target="'.esc_attr($but_target).'" ' : '');?> class="button<?php echo  ($outlined ? ' outlined' : ''); ?>'" <?php echo ($but_title ? 'title="'.esc_attr($but_title).'"' : 'title="'.esc_attr($button_label).'"'); ?> >
					<?php echo esc_html( $button_label ); ?>
				</a>
				
			</div>
			<?php } //endif; $button_label && $but_url ?>
			
			
			<div class="clearfix"></div>
			
		</div><!-- /.content-block cb-1 -->
	
		<?php }else{
		 
		 echo '<p class="warning">'. __("Product category name (slug) has changed, or category doesn't exist.","showshop") .'</p>';
		 
		}// end if term exists ?>
	
	</div><!-- .content-wrapper-->
	
	<?php
	####################  HTML ENDS HERE: ################################
	echo $css_classes ? '</div>' : null;
	
	####################  HTML OUTPUT ENDS HERE: #########################

	$output_string = ob_get_contents();
   
	ob_end_clean();
	
	return $output_string ;

}

add_shortcode( 'as_single_prod_cat', 'as_single_prod_cat_func' );
?>