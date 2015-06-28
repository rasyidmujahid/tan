<?php

function as_superslides_func( $atts, $content = null ) { 
  		
	extract( shortcode_atts( array(
		'title'				=> '',
		'subtitle'			=> '',
		'sub_position'		=> 'bellow',
		'title_style'		=> 'center',
		'title_color'		=> '',
		'subtitle_color'	=> '',
		'no_title_shadow'	=> '',
		'title_size'		=> '',
		'post_type'			=> '',
		'images'			=> '',
		'post_cats'			=> '',
		'portfolio_cats'	=> '',
		'product_cats'		=> '',
		'img_format'		=> 'as-landscape',
		'custom_img_width'	=> '',
		'custom_img_height'	=> '',		
		'total_items'		=> '',
		'overlay'			=> '',
		'links_color'		=> '',
		'text_color'		=> '',
		'kenburns'			=> '',
		'text_layer_anim'	=> '',
		'filters'			=> '',
		'slider_navig'		=> '',
		'slider_pagin'		=> '',
		'slider_auto'		=> '',
		'fade_images'		=> '',
		'set_height'		=> '',
		'abs_stretched'		=> '',
		'css_classes'		=> '',
		'block_id'			=> generateRandomString()
		  
	), $atts ) );
	
	
	if( ! wp_script_is('superslides-1','enqueued')) {
		wp_register_script( 'superslides-1', get_template_directory_uri() . '/js/superslides/jquery.superslides.min.js');
		wp_enqueue_script( 'superslides-1', get_template_directory_uri() . '/js/superslides/jquery.superslides.min.js', array('jQuery'), '1.0', true );
	}
	

	global $post, $as_woo_is_active;

	
	/* POSTS, PORTFOLIO OR PRODUCT FILTER ARGS 
	 *  - featured (sticky), latest, best seller, best rated (WC)
	 *
	 */
	$order_rand	= false;
	if ( $post_type == 'post'  ) {

		if ( $filters == 'featured' ){
			$sticky_array = get_option( 'sticky_posts' );
			$args_filters = array('post__in' => $sticky_array);
		}elseif ( $filters == 'random' ){
			$order_rand	= true;
			$args_filters = array();
		}else{
			$args_filters = array();
		}

	}elseif ( $post_type == 'portfolio' ){

		if ( $filters == 'featured' ){
			$args_filters = array( 
				'meta_key' => 'as_featured_item',
				'meta_value' => 1
			);
		}elseif ( $filters == 'random' ){
			$order_rand	= true;
			$args_filters = array();
		}else{
			$args_filters = array();
		}
		
	}elseif( $post_type == 'product' ){

		global $woocommerce;
		
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

	}else{

		$args_filters = array();
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

	
	$tax_terms_arr = explode(',', $tax_terms );
	if( !empty($tax_terms_arr) ) {

		$tax_filter_args = array('tax_query' => array(
							array(
								'taxonomy' => $taxonomy,
								'field' => 'slug', // can be 'slug' or 'id'
								'operator' => 'IN', // NOT IN to exclude
								'terms' => $tax_terms_arr
							)
						)
					);
	}else{
		$tax_filter_args = array();
	}

	$main_args = array(
		'no_found_rows' 	=> 1,
		'post_status' 		=> 'publish',
		'post_type' 		=> $post_type,
		'post_parent' 		=> 0,
		'suppress_filters'	=> false,
		'orderby'    		=> $order_rand ? 'rand menu_order date' : 'menu_order date',
		'order'       		=> 'ASC',
		'numberposts' 		=> $total_items
	);

	$all_args = array_merge( $main_args, $args_filters, $tax_filter_args );

	$content = get_posts($all_args);

	####################  HTML STARTS HERE: ###########################
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
	
	do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
	
	?>
	
	<div id="holder-<?php echo esc_attr($block_id); ?>" class="superslides-holder">
		
		<?php 
		if( $overlay || $links_color || $text_color || $set_height || $abs_stretched ){
			echo '<style scoped>'; 
			
			if( $set_height ) {
				echo '#holder-'. esc_attr($block_id).' { height:'. esc_attr($set_height) .'; position:relative; }';
				
			}elseif( $abs_stretched == "stretched" ) {
				echo '#holder-'. esc_attr($block_id).' { position: absolute; top: 0; bottom: 0; left: 0; right: -1px; height: auto;}';
			}
			
			$height = $set_height ? $set_height : "450px";
			
			echo '@media only screen and (max-width: 768px) { #holder-'. esc_attr($block_id).' { height: calc('. esc_attr($height) .' / 1.2); }}';
			echo '@media only screen and (max-width: 548px) { #holder-'. esc_attr($block_id).' { height: calc('. esc_attr($height) .' / 1.8); }}';
			
			echo $overlay		? '#holder-'. esc_attr($block_id) .' .item-overlay { background-color : '. $overlay .' ;}' : '';
			echo $links_color	? '#holder-'. esc_attr($block_id).' .text a { color : '. $links_color .' ;}' : '';
			echo $text_color	? '#holder-'. esc_attr($block_id).' .text { color : '. $text_color .' ;}' : '';
			
			echo '</style>'; 
		}
		?>
		<?php if( $slider_auto ) {
			$duration = $slider_auto / 1000;
		?>
		<style scoped>
		#holder-<?php echo esc_attr($block_id); ?> .slider .slide-item  img {
			-webkit-animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
			-moz-animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
			-o-animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
			animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
		}
		</style>
		<?php } ?>
		
		
		
		<div id="slides-main-<?php echo esc_attr($block_id); ?>" class="superslides" style="opacity:0">
		
			<ul class="slides-container slider<?php echo $kenburns ? ' kenburns' : ''; ?>">
				
				<?php
				if( $post_type == "images" && !empty($images) ) {
					$img_arr = explode(',', $images);
				
					foreach ( $img_arr as $img ) {
						
					?>
					
					<li class="slide-item">
					
						<?php echo wp_get_attachment_image( $img, $img_format, false ); ?>
				
					</li><?php // .slide-item ?>
					
					<?php 
					
					}
					
				}else{
					
				
					foreach ( $content as $post ) {
					
						setup_postdata( $post );
						$id = get_the_ID();
						
						if( $as_woo_is_active && $post_type == 'product' ) {
				
							global  $product, $woocommerce_loop, $wp_query, $woocommerce;
							
						}
						$thumb_id	= get_post_thumbnail_id( $id );
						$img_arr	= wp_get_attachment_image_src( $thumb_id, $img_format);
						$img		= $img_arr[0];
					?>

					<li class="slide-item<?php echo $text_layer_anim ? ' to-animate' : ''; ?>">
						
						<img src="<?php echo esc_attr($img); ?>" />
						
						<div class="item-overlay"></div>
						
						<div class="text">
												
							<?php 
							$p_meta		= get_post_meta( $id, '_portfolio_meta_box');
							$tagline	= get_post_meta( $id, 'as_tagline', true);
							
							echo ($as_woo_is_active && $post_type=='product') ? $product->get_categories( ', ', '<span class="posted_in">', '</span>' ) : '';
							
							echo '<h2><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) .'</a></h2>';
							
							($as_woo_is_active && $post_type=='product') ? woocommerce_template_loop_price() : '';
							
							
							echo ($tagline || get_the_content()) ? '<div class="addendum">' : '';
							
							echo $tagline ? '<h5>'. esc_html($tagline) .'</h5>' : '';
							
							echo get_the_content() ? '<p>' . apply_filters('as_custom_excerpt', 50, false ) . '</p>' : '';
							
							echo ( $tagline || get_the_content()) ? '</div>' : '';
							
							?>
							
						</div>
					
					</li><?php // .slide-item ?>
					
					<?php }// END foreach 
					
					} // end if $post_type == "images" && !empty($images)
					?>
				
			</ul>
			
			<div class="slides-navigation" id="nav-<?php echo esc_attr($block_id); ?>" >
				<a href="#" class="owl-next next"><span class="icon-chevron-right"></span></a>
				<a href="#" class="owl-prev prev"><span class="icon-chevron-left"></span></a>
			</div>
		
		</div>
		
	
	<script>
	(function( $ ){
	
		$(document).ready( function() {
			
			$(function() {
			
				
				var $slides		= "",
					$slidesNav	= "";
				
				$slides		= $('#slides-main-<?php echo esc_attr($block_id); ?>');
				$slidesNav	= $slides.find(".slides-navigation");
				
				// WHEN SLIDES STARTED - can be started.slides, too
				$slides.on('init.slides', function() {
					Foundation.libs.equalizer.reflow();
					$slides.css("opacity", 1);
				});
				 // WHEN SLIDES STARTS ANIM
				$slides.on('animating.slides', function() {
					
				});
				 
				// START PLUGIN
				$slides.superslides({
					play:	<?php echo $slider_auto ? esc_js($slider_auto) : '0' ?>,
					pagination: true,
					hashchange: false,
					scrollable: true,
					animation:	<?php echo $fade_images ? "'fade'" : "'slide'" ?>,
					inherit_width_from: "#holder-<?php echo esc_attr($block_id); ?>",
					inherit_height_from: "#holder-<?php echo esc_attr($block_id); ?>",
					animation_easing: "easeInOutCubic"
				});
				
				/* Swiping */
				Hammer($slides[0]).on("swipeleft", function(e) {
				$slides.data('superslides').animate('next');
				});

				Hammer($slides[0]).on("swiperight", function(e) {
				$slides.data('superslides').animate('prev');
				});
								
				
				if( window.isMobile ) {
					
					$slidesNav.css('opacity', 1);
				
				}else{
				
					$slides.mouseenter(function (){
						$slidesNav.addClass('active');
					}).mouseleave(function (){
						$slidesNav.removeClass('active');
					})						
					
				}
				
				
				
			});

		});
		
	})( jQuery );
	</script>
	
	</div><!-- /.holder -->
	
	<?php echo $css_classes ? '</div>' : null; ?>
	
	<div class="clearfix"></div>
	
	<?php 
	####################  HTML OUTPUT ENDS HERE: ###########################
	$output_string = ob_get_contents();
	   
	ob_end_clean();
		
	return $output_string ;
	
}

add_shortcode( 'as_superslides', 'as_superslides_func' );?>