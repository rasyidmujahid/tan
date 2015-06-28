<?php
function as_ajax_cats_func( $atts, $content = null ) { 
  
	global $post, $wp_query;
	
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
			'tax_menu_style'	=> 'inline',
			'post_type'			=> 'post',
			
			'post_cats'			=> '',
			'portfolio_cats'	=> '',
			'product_cats'		=> '',
			'block_style'		=> 'style1',
			'img_format'		=> 'as-portrait',
			'custom_image_width'	=> '',
			'custom_image_height'	=> '',
			'total_items'		=> 8,
			'offset'			=> '',
			'no_post_thumb'		=> '',
			'only_featured' 	=> '',
			'items_desktop'		=> 3,
			'items_tablet'		=> 2,
			'items_mobile'		=> 1,
			
			'zoom_button'		=> '',
			'link_button'		=> '',
			'force_spacing'		=> '',
			
			'hide_slider'		=> '',
			'slider_navig'		=> '',
			'slider_pagin'		=> '',
			'slider_timing'		=> '',
			'anim'				=> 'anim-1',
			'data_anim'			=> 'none',
			'button_label'		=> '',
			'ac_link_button'		=> '',
			'outlined'			=> '',
			
			'css_classes'		=> '',
			'block_id'			=> generateRandomString()
			  
		), $atts ) );

	$content = wpb_js_remove_wpautop($content, true);
	
	/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */
	
	$button 	= vc_build_link( $ac_link_button );
	$but_url	= $button['url'];
	$but_title	= $button['title'];
	$but_target	= $button['target'];
	
	
	
	$sticky_array = get_option( 'sticky_posts' );
		$total_items = $total_items ? $total_items : -1;
		
		// FEATURED POSTS FILTER ARGS
		if ( $post_type == 'post' && $only_featured ) {
			$args_only_featured = array('post__in' => $sticky_array);
		}elseif ( $post_type == 'portfolio' && $only_featured ){
			$args_only_featured = array( 
				'meta_key' => 'as_featured_item',
				'meta_value' => 1
			);
		}elseif ( $post_type == 'product' && $only_featured ){
			$args_only_featured = array( 
				'meta_key' => '_featured',
				'meta_value' => 'yes'
			);
		}else{
			$args_only_featured = array();
		}
		//
		
		// TAXONOMY FILTER ARGS
		if( $post_cats &&  $post_type == 'post' ) {
			$tax_terms = $post_cats;
			$taxonomy = 'category';
		}elseif( $portfolio_cats && $post_type == 'portfolio' ){
			$tax_terms = $portfolio_cats;
			$taxonomy = 'portfolio_category';
		}elseif( $product_cats && $post_type == 'product' ){
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
		
		$tax_terms_arr = explode(",", $tax_terms);
				
		if( $tax_terms && $tax_menu_style != 'none') {
		
			echo $tax_menu_style == 'dropdown' ?'<div class="menu-toggler block-tax-toggler"><a href="#" title="'.esc_attr(__('Toggle categories','showshop')).'"><span class="icon-menu"></span></a></div>' : null;
			?>
			
			<ul class="taxonomy-menu category-list<?php echo $tax_menu_style == 'dropdown' ? ' tax-dropdown' : null; ?>">
			
			<?php 
			// GET TAXONOMY OBJECT:
			$term_Objects = array();
			
			foreach ( $tax_terms_arr as $term ) {
				if( term_exists( $term,  $taxonomy ) ) {
					$term_Objects[] = get_term_by( 'slug', $term, $taxonomy );
				}
			}
			// DISPLAY TAXONOMY MENU:
			if( !empty( $term_Objects ) ) {
				
				foreach ( $term_Objects as $term_obj ) {
				
					echo '<li class="category-link" id="cat-'.esc_attr($term_obj->term_id) .'">';
					echo '<a href="#" class="'.esc_attr($term_obj->slug) .' ajax-posts" data-id="'. esc_attr($term_obj->slug) .'">';
					echo '<div class="term">' . esc_html($term_obj->name) . '</div>';
					echo '</a>';
					echo '</li>';
					
				}
			}
			?>
			</ul>
		
		<?php } // ENDIF $TAX_TERMS ?>
		
		<?php
		
		if( $custom_image_width || $custom_image_height ) {
			$img_width = $custom_image_width ? $custom_image_width : 450;
			$img_height = $custom_image_height ? $custom_image_height : 300;
		}else{
			// REGISTERED IMAGE SIZES:
			$imgSizes = all_image_sizes(); // as custom fuction
			$img_width = $imgSizes[$img_format]['width'];
			$img_height = $imgSizes[$img_format]['height'];
		}				
		
		// IN CASE NO SLIDER IS USED - ECHO THE GRID
		$l = 12 / $items_desktop;
		$t = 12 / $items_tablet;
		$m = 12 / $items_mobile;
		
		if ( $hide_slider ) {
			$no_slider = 'large-'.$l.' medium-'. $t . ' small-'.$m;
			wp_enqueue_script('masonry');
			
		}else{
			$no_slider = '';
		}
		?>
		
		<div class="clearfix"></div>
		
		<?php 
		// if there are taxonomies selected, turn on taxonomy filter:
		if( $tax_terms ) {

			$tax_filter_args = array('tax_query' => array(
								array(
									'taxonomy'	=> $taxonomy,
									'field'		=> 'slug', // can be 'slug' too
									'operator'	=> 'IN', // NOT IN to exclude
									'terms'		=> $tax_terms_arr
								)
							)
						);
		}else{
			$tax_filter_args = array();
		}
		$main_args = array(
			'no_found_rows' => 1,
			'post_status'	=> 'publish',
			'post_type'		=> $post_type,
			'post_parent'	=> 0,
			'suppress_filters' => false,
			'orderby'     	=> 'post_date',
			'order'       	=> 'DESC',
			'numberposts' 	=> $total_items,
			'offset'		=> $offset ? $offset : 0
		);
		
		$all_args = array_merge( $main_args, $args_only_featured, $tax_filter_args );

		$content = get_posts($all_args);

		
		/*
		IMPORTANT: HIDDEN INPUT TYPE - HOLDER OF VARS SENT VIA POST BY AJAX :
		*/
		
		?>
		<input type="hidden" class="varsHolder" data-tax="<?php echo esc_attr($taxonomy); ?>" data-block_id="<?php echo esc_attr($block_id); ?>"  data-ptype = "<?php echo esc_attr($post_type); ?>" data-totitems = "<?php echo esc_attr($total_items); ?>" data-feat="<?php echo esc_attr($only_featured); ?>"  data-img="<?php echo esc_attr($img_format); ?>"  data-custom-img-w="<?php echo esc_attr($custom_image_width); ?>" data-custom-img-h="<?php echo esc_attr($custom_image_height); ?>"  data-taxmenustlye="<?php echo esc_attr($tax_menu_style); ?>"  data-enter_anim="<?php echo esc_attr($enter_anim); ?>" data-no_slider="<?php echo esc_attr($no_slider); ?>" data-zoom="<?php echo esc_attr($zoom_button); ?>" data-link="<?php echo esc_attr($link_button); ?>" data-offset="<?php echo esc_attr($offset); ?>" data-no_post_thumb="<?php echo esc_attr($no_post_thumb); ?>" />
		
		
		<div class="loading-animation" style="display: none;"></div>
		
		<?php if( $enter_anim != 'none' ) {?>
		<script>
		(function( $ ){
			$.fn.anim_waypoints_posts = function(blockId, enter_anim) {
				
				var thisBlock = $('#posts-'+ blockId );
				if ( !window.isMobile && !window.isIE9 ) {
					var item = thisBlock.find('.item');
					
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
					thisBlock.find('.item').each( function() {
						$(this).removeClass('to-anim');
					});
				}
								
			}
		})( jQuery );
		
		jQuery(document).ready( function($) {
			
			$(document).anim_waypoints_posts("<?php echo esc_attr($block_id); ?>"," <?php echo esc_attr($enter_anim);?>");
		
		});
		</script>
		<?php } // end if( $enter_anim != 'none' ) ?>
		
		<div id="posts-<?php echo esc_attr($block_id); ?>" class="content-block cb-2<?php echo $force_spacing ? ' force-spacing' : ''; ?>">
			
			<?php if( !empty( $tax_terms )) { ?>
			<div class="cat-title">
				<div class="wrap"></div>
				<a href="#" class="ajax-posts"<?php echo !empty( $tax_terms ) ? ' data-id="' .  $tax_terms.'"' : null; // array to string ?>>
					<div class="icon-cancel3" aria-hidden="true" title="<?php esc_attr_e('Reset categories','showshop'); ?>"></div>
				</a>
			</div>
			<?php } ?>			
		
			
			<?php
			// if the slider will loop or not
			$minimum_items	= ( count($content) < $items_desktop ) ? true : false ;
			$slider_loop	= ( $tax_terms || $minimum_items ) ? '0' : '1'; 
			?>

			
			<input type="hidden" class="slides-config" data-navigation="<?php echo $slider_navig ? '0' : '1'; ?>" data-pagination="<?php echo $slider_pagin ? '0' : '1'; ?>" data-auto="<?php echo esc_attr($slider_timing); ?>" data-desktop="<?php echo esc_attr($items_desktop); ?>" data-tablet="<?php echo esc_attr($items_tablet); ?>" data-mobile="<?php echo esc_attr($items_mobile); ?>"  data-loop="<?php echo esc_attr($slider_loop); ?>" />
						
			
			<div class="<?php echo !$hide_slider ? 'owl-carousel contentslides' : 'js-masonry';?> category-content <?php echo ' '. esc_attr($anim) ;?> <?php echo $data_anim == 'none' ? '' : esc_attr($data_anim); ?><?php echo ' '. esc_attr($block_style); ?>" id="ajax-cats-<?php echo esc_attr($block_id); ?>" <?php echo $hide_slider ? "data-masonry-options='{  \"itemSelector\": \".item\" }'" : '' ?>> 
			
			<?php 			
			$i = 1;

			foreach ( $content as $post ) {
				
				setup_postdata( $post );
				
				if( defined('WPML_ON') ) { // if WPML plugin is active
					$post_id	= icl_object_id( get_the_ID(), get_post_type(), false, ICL_LANGUAGE_CODE ); 
					$lang_code	= ICL_LANGUAGE_CODE;
				}else{
					$post_id	= get_the_ID();
					$lang_code	= '';
				}
				
				$link			= esc_attr( get_permalink($post_id) );
				$post_title		= '<h4><a href="'. $link.'" title="'. the_title_attribute (array('echo' => 0)).'">'. esc_html( strip_tags( get_the_title() ) ) .'</a></h4>';
				$post_format	= get_post_format();
				$pP_rel			= '';
				
				// custom AS function in inc/functions dir
				$post_formats 	= as_post_formats_media( $post_id, $block_id, $img_format, $img_width, $img_height );
				
				$img_url			= $post_formats['img_url'];
				$image_output		= !$no_post_thumb ? $post_formats['image_output'] : '';
				$pP_rel				= $post_formats['pP_rel'];
				$img_urls_gallery	= $post_formats['img_urls_gallery'];
				$quote_html			= $post_formats['quote_html'];
				?>
					
				<div class="column item <?php echo $no_slider; ?><?php echo ($enter_anim != 'none') ? ' to-anim' : '';  ?>" data-i="<?php echo esc_attr($i); ?>">
					
					<div class="anim-wrap">
					
					<?php if( !$no_post_thumb ) { ?>
					
					<?php echo ($zoom_button && $link_button) ? '<a href="'. $link.'" title="'. the_title_attribute (array('echo' => 0)).'">' : ''; // if hiding buttons link the image ?>
					
					<div class="item-img">
					
						<div class="front">
							
							<?php echo wp_kses_post($image_output) ;?>
							
						</div>
						
						<div class="back">
						
							<div class="item-overlay"></div>
																				
							<div class="back-buttons">
						
							<?php
							echo !$zoom_button ? '<a href="'.esc_url($img_url).'"  data-rel="prettyPhoto'.$pP_rel.'" title="'.the_title_attribute (array('echo' => 0)).'" class="accent-1-light-30">'. as_post_format_icon_action().'</a>' : null;
							
							echo !$link_button ? '<a href="'. $link.'"  title="'. the_title_attribute (array('echo' => 0)).'" class="accent-1-light-40"><div class="icon icon-link" aria-hidden="true"></div></a>' : null;
							?>
							
							</div>
							
						</div>
						
						<?php
						$allowed = array(
							'a' => array(
								'href' => array(),
								'class' => array(),
								'rel' => array(),
								'data-rel' => array(),
							)
						);
						echo $img_urls_gallery ? wp_kses( $img_urls_gallery, $allowed ) : null; // for usage with prettPhoto
						
						echo $post_format == 'quote' ? '<div class="hidden-quote" id="quote-'.esc_attr($post_id).'">'. esc_html($quote_html) .'</div>' : null;
						?>
					
					</div><?php //.item-img ?>
						
					<?php echo ( $zoom_button && $link_button ) ? '</a>' : ''; // if hiding buttons link the image ?>
						
					<?php } // end if (!$no_post_thumb)?>
					
					<div class="item-data<?php echo $no_post_thumb ? ' no-post-thumb' : ''; ?>">
						
						<?php echo wp_kses_post($post_title); ?>
												
						<div class="meta">
						
							<?php 
							as_entry_date( false ); 
							as_entry_author();
							?>
						
						</div>						
						
						<?php 
						echo '<div class="excerpt">';
						do_action('as_archive_content'); // smart excerpt - "inc/functions/misc_post_functions.php
						echo '</div>'; 
						?>

						<div class="clearfix"></div>
					
					</div><?php // .item-data ?>
					
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
			
		</div><!-- /.content-block -->
		
	<?php
	####################  HTML ENDS HERE: ###########################
	echo $css_classes ? '</div>' : null;
	####################  HTML OUTPUT ENDS HERE: ###########################
	
	$output_string = ob_get_contents();
   
	ob_end_clean();
	
	return $output_string ;

}

add_shortcode( 'as_ajax_cats', 'as_ajax_cats_func' );
?>