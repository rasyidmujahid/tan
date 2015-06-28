<?php

function as_slick_slider_func( $atts, $content = null ) { 
  		
	extract( shortcode_atts( array(
		'title'				=> '',
		'subtitle'			=> '',
		'sub_position'		=> 'bellow',
		'title_style'		=> 'center',
		'title_color'		=> '',
		'subtitle_color'	=> '',
		'no_title_shadow'		=> '',
		'title_size'		=> '',
		'post_type'			=> 'portfolio',
		'post_cats'			=> '',
		'portfolio_cats'	=> '',
		'product_cats'		=> '',
		'img_format'		=> 'as-landscape',
		'custom_image_width'	=> '',
		'custom_image_height'	=> '',		
		'total_items'		=> '',
		'overlay'			=> '',
		'links_color'		=> '',
		'text_color'		=> '',
		'kenburns'			=> '',
		'text_layer_anim'	=> '',
		'hide_text'			=> '',
		'filters'			=> '',
		'slider_navig'		=> '',
		'slider_pagin'		=> '',
		'slider_auto'		=> '',
		'fade_images'		=> '',
		'hide_thumbs'		=> '',
		'thumbs_format'		=> 'thumbnail',
		'css_classes'		=> '',
		'block_id'			=> generateRandomString()
		  
	), $atts ) );
	

	global $post, $as_woo_is_active;
	if ( $post_type == 'product') {
		global $woocommerce;
	}
	
	
	wp_register_script( 'slick-slider', get_template_directory_uri() . '/js/slick.min.js');
	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/slick.js', array('jQuery'), '1.0', true );
	
	wp_register_style( 'slick-slider-css', get_template_directory_uri() . '/css/slick.css');
	wp_enqueue_style( 'slick-slider-css');
	
	
	/* POSTS, PORTFOLIO OR PRODUCT FILTER ARGS 
	 *  - featured (sticky), latest, best seller, best rated (WC)
	 *
	 */
	if( $custom_image_width || $custom_image_height ) {
		$img_width = $custom_image_width ? $custom_image_width : 450;
		$img_height = $custom_image_height ? $custom_image_height : 300;
	}else{
		// REGISTERED IMAGE SIZES:
		$imgSizes = all_image_sizes(); // as custom fuction
		$img_width = $imgSizes[$img_format]['width'];
		$img_height = $imgSizes[$img_format]['height'];
	}				
		
	 
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
		
	}elseif( $post_type = 'product' ){

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
	
	<div id="carousel-<?php echo esc_attr($block_id); ?>" class="slick-slider-holder">
				
		<?php 
		if( $overlay || $links_color || $text_color ){
			echo '<style scoped>'; 
			
			echo $overlay		? '#carousel-'. esc_attr($block_id) .' .item-overlay { background-color : '. $overlay .' ;}' : '';
			echo $links_color	? '#carousel-'. esc_attr($block_id).' .text a { color : '. $links_color .' ;}' : '';
			echo $text_color	? '#carousel-'. esc_attr($block_id).' .text { color : '. $text_color .' ;}' : '';
			
			echo '</style>'; 
		}
		?>
		<?php if( $slider_auto ) {
				$duration = $slider_auto / 1000;
			?>
			<style scoped>
			#carousel-<?php echo esc_attr($block_id); ?> .slider .slide-item .entry-image img {
				-webkit-animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
				-moz-animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
				-o-animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
				animation-duration: <?php echo $duration ? esc_attr($duration) : '7'; ?>s;
			}
			</style>
			<?php } ?>
		
		<div id="slick-main-<?php echo esc_attr($block_id); ?>" class="slider<?php echo $kenburns ? ' kenburns' : ''; ?>">
			
			<?php			
			foreach ( $content as $post ) {
			
				setup_postdata( $post );
				$id = get_the_ID();
				//$post_type = get_post_type();
				
				if( $as_woo_is_active && $post_type == 'product' ) {
		
					global  $product, $woocommerce_loop, $wp_query, $woocommerce;
					
				}
				
			?>

			<div class="slide-item<?php echo $text_layer_anim ? ' to-animate' : ''; ?>">
				
				<?php echo as_image( $img_format, $img_width, $img_height ); ?>
				
				<?php if( !$hide_text ) { ?>
				
				<div class="text">
					
					<div class="item-overlay"></div>
					
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
				
				<?php } ?>
			
			</div><!-- /.slide-item -->
			
			<?php }// END foreach ?>
			
		</div> <!-- /#slick-main-ID  -->
		
		<?php if( ! $hide_thumbs ) { // NOT TO DISPLAY THUMBS FOR SLIDER NAVIGATION ?>
		
		<div id="slick-nav-<?php echo esc_attr($block_id); ?>" class="slick-nav table">
		
			<?php
			foreach ( $content as $post ) {
			
				setup_postdata( $post );
				$id = get_the_ID();

				echo '<div class="table">';
				
				echo '<div class="tablecell"><h5>'. esc_html(get_the_title()) .'</h5>';
			
				echo '<div class="nav-image"><div class="item-overlay"></div>'. as_image( $thumbs_format ).'</div></div>';
				
				echo '</div>';
			}
			?>
		
		</div>
		
		<?php } ?>

	</div><!-- /.carousel -->

	
	<script>
	(function( $ ){
	
		$(document).ready( function() {
			
			
			$('#slick-main-<?php echo esc_js($block_id); ?>').on('init', function(event, slick, direction){
				$('#carousel-<?php echo esc_js($block_id); ?>').slideDown(400);
				$(this).slideDown(400);
				$(this).addClass('kenburns');
			});
			
			
			$('#slick-main-<?php echo esc_js($block_id); ?>').on('afterChange', function(event, slick, currentSlide, direction){
			   
				var currSlide	= $(this).find('.slide-item').eq(currentSlide);
				$(this).addClass('kenburns');
				
			  
			});
			$('#slick-main-<?php echo esc_js($block_id); ?>').on('beforeChange', function(event, slick, currentSlide, nextSlide, direction){
			   
				/* var currSlide	= $(this).find('.slide-item').eq(currentSlide),
					nextSlide	= $(this).find('.slide-item').eq(nextSlide);
					 */
				$(this).removeClass('kenburns');
			  
			});


			 $('#slick-main-<?php echo esc_js($block_id); ?>').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: <?php echo $slider_navig ? 'true' : 'false'; ?>,
				dots: <?php echo $slider_pagin ? 'true' : 'false'; ?>,
				fade: <?php echo $fade_images ? 'true' : 'false'; ?>,
				autoplay: <?php echo $slider_auto ? 'true' : 'false'; ?>,
				<?php echo $slider_auto ?  'autoplaySpeed:'. esc_js($slider_auto) .',' : ''; ?>
				<?php echo !$hide_thumbs ?  'asNavFor: "#slick-nav-'. esc_js($block_id) .'",' : ''; ?>
			});
			
			<?php if( ! $hide_thumbs ) { ?>
			$('#slick-nav-<?php echo esc_js($block_id); ?>').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '#slick-main-<?php echo esc_js($block_id); ?>',
				arrows: false,
				dots: false,
				centerMode: true,
				focusOnSelect: true,
				adaptiveHeight: true,
				responsive: [
					{
					  breakpoint: 1024,
					  settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: true
					  }
					},
					{
					  breakpoint: 600,
					  settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					  }
					},
					{
					  breakpoint: 480,
					  settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					  }
					}
				]
			});
			<?php } ?>
		});
		
	})( jQuery );
	</script>
	
	
	<?php echo $css_classes ? '</div>' : null; ?>
	
	<div class="clearfix"></div>
	
	<?php 
	####################  HTML OUTPUT ENDS HERE: ###########################
	$output_string = ob_get_contents();
	   
	ob_end_clean();
		
	return $output_string ;
	
}

add_shortcode( 'as_slick_slider', 'as_slick_slider_func' );?>