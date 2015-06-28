<?php 
function as_filter_cats_func( $atts, $content = null ) { 
  
	global $post, $wp_query;
	
	
	
	extract( shortcode_atts( array(
		'title'				=> '',
		'subtitle'			=> '',
		'sub_position'		=> 'bellow',
		'title_style'		=> 'center',
		'title_color'		=> '',
		'subtitle_color'	=> '',
		'no_title_shadow'	=> '',
		'title_size'		=> '',
		'enter_anim'		=> 'fadeIn',
		'post_type'			=> 'post',
		'post_cats'			=> '',
		'portfolio_cats'	=> '',
		'block_style'		=> 'style1',
		'tax_menu_style'	=> 'dropdown',
		'sorting'			=> false,
		'tax_menu_align'	=> false,
		'img_format'		=> 'as-portrait',
		'custom_image_width'=> '',
		'custom_image_height'=> '',
		'zoom_button'		=> '',
		'link_button'		=> '',
		'total_items'		=> 6,
		'in_row'			=> 3,
		'force_spacing'		=> '',
		'only_featured' 	=> false,
		'anim'				=> 'anim-1',
		'data_anim'			=> 'none',
		'button_label'		=> '',
		'afc_link_button'	=> '',
		'outlined'			=> '',
		
		'css_classes'		=> '',
		'block_id'			=> generateRandomString()
		  
	), $atts ) );

	$content = wpb_js_remove_wpautop($content, true);
	
	
	$button 	= vc_build_link( $afc_link_button );
	$but_url	= $button['url'];
	$but_title	= $button['title'];
	$but_target	= $button['target'];

	
	$grid = round( 12 / $in_row );
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
	}else{
		$args_only_featured = array();
	}
	//
	
	// TAXONOMY FILTER ARGS
	if(  $post_cats &&  $post_type == 'post' ) {
		$tax_terms = $post_cats;
		$taxonomy = 'category';
	}elseif( $portfolio_cats && $post_type == 'portfolio' ){
		$tax_terms = $portfolio_cats;
		$taxonomy = 'portfolio_category';
	}else{
		$tax_terms = '';
		$taxonomy = '';
	}
	
	//session_start();
	$_SESSION['template'] = get_permalink();
	
	// CUSTOM OR REGISTERED IMAGE SIZES:
	if( $custom_image_width && $custom_image_height ) {
		// custom
		$img_width	= $custom_image_width ? $custom_image_width : 450;
		$img_height = $custom_image_height ? $custom_image_height : 300;
	}else{
		// registered :
		$imgSizes	= all_image_sizes(); // as custom function
		$img_width	= $imgSizes[$img_format]['width'];
		$img_height = $imgSizes[$img_format]['height'];
	}
	
	
	###### HTML OUTPUT STARTS HERE
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
	
	// Block title and subtitle:
	do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
	?>
	
	<div class="shuffle-filter-holder">
	
	<?php

	if( $tax_terms && $tax_menu_style != 'none') {
				
		echo $tax_menu_style == 'dropdown' ?'<div class="menu-toggler block-tax-toggler '. esc_attr($tax_menu_align) .'"><a href="#" title="'.esc_attr__('Toggle categories','showshop').'"><span class="icon-menu"></span></a></div>' : null;
		
		$terms_menu = $tax_menu_style == 'dropdown' ? '<div class="tax-toggle-dropdown">' : null;
		
		$terms_menu .= '<ul class="taxonomy-menu  tax-filters '. esc_attr($tax_menu_align) .'">';
		
		$terms_menu .= '<li class="all category-link"><a href="#" class="active"><div class="term">'. esc_attr__('All','showshop') .'</div></a></li>';
		
		
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
			
				$terms_menu .= '<li class="'. esc_attr($term_obj->slug) .' category-link" id="cat-'. esc_attr($term_obj->slug) .'">';
				$terms_menu .= '<a href="#" data-group="'. esc_attr($term_obj->slug) .'">';
				$terms_menu .= '<div class="term">' . esc_attr($term_obj->name) . '</div>';
				$terms_menu .= '</a>';
				$terms_menu .= '</li>';
				
			}
		}
		
		$terms_menu .= '</ul>';
		
		$terms_menu .= $tax_menu_style == 'dropdown' ? '</div>' : null;
		
		echo wp_kses_decode_entities($terms_menu);
	
	} // endif $tax_terms
	
		
	if( $sorting ) { ?>
		
		<div class="sort-holder <?php echo esc_attr($tax_menu_align); ?>">
		<select class="sort-options">
				<option value=""><?php esc_html_e('Default sorting','showshop'); ?></option>
				<option value="title"><?php esc_html_e('Sort by Title ','showshop'); ?></option>
				<option value="date-created"><?php esc_html_e('Sort by Date Created','showshop'); ?></option>
			</select>
		</div>
	
	<?php }; ?>
	
		
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
		$main_args = array(
			'no_found_rows'		=> 1,
			'post_status'		=> 'publish',
			'post_type'			=> $post_type,
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'orderby'     		=> 'post_date',
			'order'       		=> 'DESC',
			'numberposts' 		=> $total_items
		);
		
		$all_args = array_merge( $main_args, $args_only_featured, $tax_filter_args );

		$content = get_posts($all_args);

		?>	
			
		<div id="filter-post-<?php echo esc_attr($block_id); ?>" class="content-block cb-3<?php echo $force_spacing ? ' force-spacing' : ''; ?>">
			
		
		<ul class="shuffle<?php echo ' '.esc_attr($anim) ;?> <?php echo $data_anim == 'none' ? '' : esc_attr($data_anim); ?><?php echo ' '.esc_attr($block_style); ?>">
			
			<?php 
	
			$i = 1;
			
			//start posts loop
			foreach ( $content as $post ) {
				
				setup_postdata( $post );
				
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
				
				if( count( $content ) == 1 || $in_row == 1) {
					$medium_grid = '12';
				}else{
					$medium_grid = '6';
				}
				
				if( defined('WPML_ON') ) { // if WPML plugin is active
					$post_id	= icl_object_id( get_the_ID(), get_post_type(), false, ICL_LANGUAGE_CODE ); 
					$lang_code	= ICL_LANGUAGE_CODE;
				}else{
					$post_id	= get_the_ID();
					$lang_code	= '';
				}
				$link			=  esc_attr( get_permalink($post_id) );
				$post_title		= '<h4><a href="'. $link.'" title="'. the_title_attribute (array('echo' => 0)) .'">'. esc_html( strip_tags(get_the_title()) ) .'</a></h4>';
				//$post_excerpt	= '<div class="excerpt"><p>'. get_the_excerpt() .'</p></div>';
				$post_format	= get_post_format();
				$pP_rel			= '';
				
				// custom AS function in inc/functions dir
				$post_formats 	= as_post_formats_media( $post_id, $block_id, $img_format, $img_width, $img_height );
				
				$img_url			= $post_formats['img_url'];
				$image_output		= $post_formats['image_output'];
				$pP_rel				= $post_formats['pP_rel'];
				$img_urls_gallery	= $post_formats['img_urls_gallery'];
				$quote_html			= $post_formats['quote_html'];
				?>
					
				
				<li class="large-<?php echo $grid ? esc_attr($grid) : '6'; ?>  medium-<?php echo esc_attr($medium_grid); ?> small-12 item column" data-id="id-<?php echo $i;?>"  <?php echo $terms_str ? 'data-groups='. esc_attr($terms_str) . ''  : null ; ?> data-date-created="<?php echo get_the_date( 'Y-m-d' ); ?>" data-title="<?php echo the_title_attribute (array('echo' => 0));?>" data-i="<?php echo esc_attr($i); ?>">
					
					<div class="anim-wrap<?php echo ($enter_anim != 'none') ? ' to-anim' : '';  ?>">
					
					<?php echo ($zoom_button && $link_button) ? '<a href="'. $link.'" title="'. the_title_attribute (array('echo' => 0)) .'">' : ''; ?>
					
					
					<div class="item-img">
											
						<div class="front">
							
							<?php echo wp_kses_post($image_output) ; ?>
							
						</div>
						
						<div class="back">
						
							<?php echo wp_kses_post($image_output); ?>
						
							<div class="item-overlay"></div>
						
							<div class="back-buttons">
						
							<?php
							echo !$zoom_button ? '<a href="'. esc_url($img_url) .'" data-rel="prettyPhoto'.$pP_rel.'" title="'. the_title_attribute (array('echo' => 0)) .'"  class="accent-1-light-30">'. as_post_format_icon_action().'</a>' : null;
							
							echo !$link_button ? '<a href="'. $link.'" title="'. the_title_attribute (array('echo' => 0)) .'" class="accent-1-light-40"><div class="icon icon-link" aria-hidden="true"></div></a>' : null;
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
					
					</div><!-- .item-img -->
						
					<?php echo ($zoom_button && $link_button) ? '</a>' : ''; ?>
						
					<div class="item-data">
					
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

					
					</div><!-- .item-data -->
					
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
			
		</div><!-- /.content-block .cb-3 -->
		
		</div><!-- // end div.shuffle-filter-holder -->
		
		<?php
		
		echo $css_classes ? '</div>' : null;
		?>
		
		<?php if( $enter_anim != 'none' ) {?>
		<script>
		(function( $ ){
			$.fn.anim_waypoints_filter_post = function(blockId, enter_anim) {
				
				var thisBlock = $('#filter-post-'+ blockId );
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
			
			$(document).anim_waypoints_filter_post("<?php echo esc_attr($block_id); ?>"," <?php echo esc_attr($enter_anim);?>");
		
		});
		</script>
		<?php } ?>
<?php
	####################  HTML OUTPUT ENDS HERE: ###########################
	$output_string = ob_get_contents();
   
	ob_end_clean();
	
	return $output_string ;
	//return "<div style='color:{$color};' data-foo='${foo}'>{$content}${foo}</div>";
}

add_shortcode( 'as_filter_cats', 'as_filter_cats_func' );
?>