<?php 
function as_filter_prod_func( $atts, $content = null ) { 
  
	global $post, $wp_query, $as_woo_is_active, $woocommerce_loop, $woocommerce;
	
	
	
	extract( shortcode_atts( array(
		'title'				=> '',
		'subtitle'			=> '',
		'sub_position'		=> 'bellow',
		'title_style'		=> 'center',
		'title_color'		=> '',
		'subtitle_color'	=> '',
		'no_title_shadow'	=> '',
		'title_size'		=> '',
		'enter_anim'		=> '',
		'post_type'			=> 'product',
		'img_format'		=> 'as-portrait',
		'product_cats'		=> '',
		'filters'			=> 'latest',
		'shop_quick'		=> '',
		'shop_buy_action'	=> '',
		'shop_wishlist'		=> '',
		'smaller'			=> '',
		'force_spacing'		=> '',
		
		'anim'				=> 'anim-1',
		'data_anim'			=> 'none',
		'tax_menu_style'	=> 'dropdown',
		'sorting'			=> '',
		'tax_menu_align'	=> '',
		'custom_img_width'	=> '',
		'custom_img_height'	=> '',
		'total_items'		=> '',
		'in_row'			=> '',
		
		'button_label'		=> '',
		'afp_link_button'	=> '',
		'outlined'			=> '',

		'css_classes'		=> '',
		'block_id'			=> generateRandomString()
		  
	), $atts ) );

	
	$content = wpb_js_remove_wpautop($content, true);
	
	/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */
	
		
	$button 	= vc_build_link( $afp_link_button );
	$but_url	= $button['url'];
	$but_title	= $button['title'];
	$but_target	= $button['target'];
	
	
	if( $as_woo_is_active ) {
		
		$grid = round( 12 / $in_row );
		$sticky_array = get_option( 'sticky_posts' );
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
		//
		
		// TAXONOMY FILTER ARGS
		if( $product_cats  ){
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
		?>

		<div class="shuffle-filter-holder">
		
		<?php 
		if( $tax_terms && $tax_menu_style != 'none') {
				
			echo $tax_menu_style == 'dropdown' ?'<div class="menu-toggler block-tax-toggler '.esc_attr($tax_menu_align).'"><a href="#" title="'.esc_attr__('Toggle categories','showshop').'" class="icon-menu"></a></div>' : null;
			
			echo $tax_menu_style == 'dropdown' ? '<div class="tax-toggle-dropdown">' : null; ?> 
			
			<ul class="taxonomy-menu tax-filters <?php echo esc_attr($tax_menu_align); ?>">
				
				<li class="all category-link"><a href="#" class="active"><div class="term"><?php esc_attr_e('All','showshop'); ?></div></a></li>
				
				<?php
				// GET TAXONOMY OBJECT:
				$term_Objects = array();
				$tax_terms_arr = explode(',', $tax_terms );
				foreach ( $tax_terms_arr as $term ) {
					if( term_exists( $term,  $taxonomy) ) {
						$term_Objects[] = get_term_by( 'slug', $term, $taxonomy );
					}
				}
				// DISPLAY TAXONOMY MENU:
				if( !empty( $term_Objects ) ) {
					foreach ( $term_Objects as $term_obj ) {
					
						echo '<li class="'. esc_attr($term_obj->slug) .' category-link" id="cat-'. esc_attr($term_obj->slug) .'">';
						echo '<a href="#" data-group="'. esc_attr($term_obj->slug) .'">';
						echo '<div class="term">' . esc_attr($term_obj->name) . '</div>';
						echo '</a>';
						echo '</li>';
						
						
					}
				}
				?>
			</ul>
			<?php echo $tax_menu_style == 'dropdown' ? '</div>' : null; ?>
			
			
		<?php } // endif $tax_terms ?>

		<?php if( $sorting ) {?>
		<div class="sort-holder <?php echo esc_attr($tax_menu_align); ?>">	
			<select class="sort-options">
				<option value=""><?php esc_html_e('Default sorting','showshop'); ?></option>
				<option value="title"><?php esc_html_e('Sort by Title ','showshop'); ?></option>
				<option value="date-created"><?php esc_html_e('Sort by Date Created','showshop'); ?></option>
			</select>
		</div>
		<?php }; ?>
		
		<?php
		
		if( $custom_img_width || $custom_img_height ) {
			$img_width = $custom_img_width ? $custom_img_width : 450;
			$img_height = $custom_img_height ? $custom_img_height : 300;
		}else{
			// REGISTERED IMAGE SIZES:
			$imgSizes = all_image_sizes(); // as custom fuction
			$img_width = $imgSizes[$img_format]['width'];
			$img_height = $imgSizes[$img_format]['height'];
		}
		?>
		
		<div class="clearfix"></div>
		
		<?php 
		// if there are taxonomies selected, turn on taxonomy filter:
		if( !empty($tax_terms_arr) ) {

			$tax_filter_args = array('tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field' => 'slug', // can be 'slug' too
									'operator' => 'IN', // NOT IN to exclude
									'terms' => $tax_terms_arr
								)
							)
						);
		}else{
			$tax_filter_args = array();
		}
		
		$order_random = ($filters == 'random') ? 'rand ' : '';
		
		$main_args = array(
			'no_found_rows'		=> 1,
			'post_status'		=> 'publish',
			'post_type'			=> $post_type,
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'orderby'			=> $order_rand ? 'rand menu_order date' : 'menu_order date',
			'order'				=> 'DESC',
			'numberposts'		=> $total_items
		);
		
		$all_args = array_merge( $main_args, $args_filters, $tax_filter_args );

		$content = get_posts($all_args);

		?>	
			
		<div id="filter-prod-<?php echo esc_attr($block_id);?>" class="content-block cb-4 woocommerce<?php echo $force_spacing ? ' force-spacing' : ''; ?>">
			
		
			<ul class="shuffle<?php echo ' '. esc_attr($anim) ;?> <?php echo $data_anim == 'none' ? '' : esc_attr($data_anim); ?>">
			
			<?php 
	
			$i = 1;
			
			if( count( $content ) == 1 || $in_row == 1) {
				$medium_grid = '12';
			}else{
				$medium_grid = '6';
			}
			
			
			//start products loop
			foreach ( $content as $post ) {
								
				setup_postdata( $post );
				
				global $product;
				
				if ( ! $product || ! $product->is_visible() || !$product->is_in_stock() ) {
					continue;
				}
				
				// GET LIST OF ITEM CATEGORY (CATEGORIES) for FILTERING jquery.shuffle
				$terms = get_the_terms( $post->ID, $taxonomy );
				if ( $terms && ! is_wp_error( $terms ) ) : 
					$terms_str = '[';
					$t = 1;
					foreach ( $terms as $term ) {
						$zarez = $t >= count($terms) ? '' : ',';
						$terms_str .= '"'. $term->slug . '"' . $zarez; 
						$t++;
					}
					$terms_str .= ']';
				else :
					$terms_str = '';
				endif;
				
				if( defined('WPML_ON') ) { // if WPML plugin is active
					$id			= icl_object_id( get_the_ID(), 'product', false, ICL_LANGUAGE_CODE ); 
					$lang_code	= ICL_LANGUAGE_CODE;
				}else{
					$id			= get_the_ID();
					$lang_code	= '';
				}
				$link =  get_permalink($id);
				
				// DATA for back image
				$attachment_ids = $product->get_gallery_attachment_ids();
				if ( $attachment_ids ) {
					$image_url = wp_get_attachment_image_src( $attachment_ids[0], 'full'  );
					$img_url = $image_url[0];
					// IMAGE SIZES:
					/* $imgSizes = all_image_sizes();
					$img_width = $imgSizes[$img_format]['width'];
					$img_height = $imgSizes[$img_format]['height'];
					*/
				}
				// end DATA
				
				$cats = $product->get_categories( ', ', '<span class="posted_in">', '</span>' );
				
				$prod_title = '<h4 class="prod-title">'.wp_kses_post($cats).'<a href="'. esc_url($link) .'" title="'. the_title_attribute (array('echo' => 0)) .'"> ' . esc_attr(get_the_title()) .'</a></h4>';
				?>
					
				
				<li class="large-<?php echo $grid ? esc_attr($grid) : '6'; ?> medium-<?php echo esc_attr($medium_grid); ?> small-12 item column" data-id="id-<?php echo esc_attr($i);?>" <?php echo $terms_str ? 'data-groups='. esc_attr($terms_str). ''  : null ; ?> data-date-created="<?php echo get_the_date( 'Y-m-d' ); ?>" data-title="<?php echo the_title_attribute (array('echo' => 0));?>" data-i="<?php echo esc_attr($i); ?>">

					<div class="anim-wrap<?php echo ($enter_anim != 'none') ? ' to-anim' : '';  ?>">
					
						<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : ''; ?>
						
							
						<div class="item-img">
							
							<div class="front">
								
								<?php function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : ''; ?>
								
								<?php echo as_image( $img_format, $img_width, $img_height );?>
							
							</div>
							
							<div class="back<?php echo $smaller ? ' smaller' : ''; ?>">
							
								<div class="item-overlay"></div>

								<?php 
															
								if ( $attachment_ids ) {
									echo '<img src="'. fImg::resize( $img_url , $img_width, $img_height, true  ) .'" alt="'. the_title_attribute (array('echo' => 0)) .'" class="back-image" />';
								}else{
									echo as_image( $img_format, $img_width, $img_height );
								}

								as_shop_buttons( !$shop_quick , !$shop_buy_action , !$shop_wishlist );
								
								as_shop_title_price();
								?>
							
							</div>
							
						</div>
						
							
						<div class="clearfix"></div>
						
						
						<div class="item-data">
					
							

						</div>
											
					</div><!-- .anim-wrap -->
					
				
				</li>
				
				<?php 
				$i++;
			}// END foreach
			
			wp_reset_postdata();
			
			?>
			</ul>
					
			<?php if( $button_label && $but_url ) { ?>
			<div class="bottom-block-link">
			
				<a href="<?php echo esc_url( $but_url ); ?>" <?php echo ($but_target ? ' target="'.esc_attr($but_target).'" ' : '');?> class="button<?php echo  ($outlined ? ' outlined' : ''); ?>" <?php echo ($but_title ? 'title="'.esc_attr($but_title).'"' : 'title="'.esc_attr($button_label).'"'); ?> >
					<?php echo esc_html( $button_label ); ?>
				</a>
				
			</div>
			<?php } //endif; $button_label && $but_url ?>
			
			<div class="clearfix"></div>
			
		</div><!-- .content-block .cb-4 -->
		
		</div><!-- // end div.shuffle-filter-holder -->
		
		<?php echo $css_classes ? '</div>' : null;	?>
		
		<script>
		(function( $ ){
			$.fn.anim_waypoints_filter_prod = function(blockId, enter_anim) {
				
				var thisBlock = $('#filter-prod-'+ blockId );
				if ( !window.isMobile && !window.isIE9 ) {
					
					var item = thisBlock.find('.item');
					
					item.waypoint(
						function(direction) {
						
							var item_wrap = $(this).find('.anim-wrap');
							
							if( direction === "up" ) {	
								item_wrap.removeClass('animated '+ enter_anim).addClass('to-anim');
							}else if( direction === "down" ) {
								var i =  $(this).attr('data-i');
								setTimeout(function(){
								   item_wrap.addClass('animated '+ enter_anim).removeClass('to-anim');
								}, 50 * i);
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
			
			$(document).anim_waypoints_filter_prod("<?php echo esc_attr($block_id); ?>"," <?php echo esc_attr($enter_anim);?>");
		
		});
		</script>
		
	<?php
		####################  HTML OUTPUT ENDS HERE: ###########################
		$output_string = ob_get_contents();
	   
		ob_end_clean();
		
		return $output_string ;
	
		//return "<div style='color:{$color};' data-foo='${foo}'>{$content}${foo}</div>";
	
	}else{
		
		echo '<h5 class="no-woo-notice">' . __('FILTERED PRODUCTS BLOCK DISABLED.<br> Sorry, it seems like WooCommerce is not active. Please install and activate last version of WooCommerce.','showshop') . '</h5>';
		
		return;
	}
}

add_shortcode( 'as_filter_prod', 'as_filter_prod_func' );
?>