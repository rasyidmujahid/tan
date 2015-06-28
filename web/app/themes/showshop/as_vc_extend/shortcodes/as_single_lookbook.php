<?php
function as_single_lookbook_func( $atts, $content = null ) { 
  
	global $post, $wp_query,  $as_woo_is_active, $as_wishlist_is_active;
	
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
			'block_style'		=> 'images_right',
			
			'single_lookbook'	=> '',
			'img_format'		=> '',
			'img_format_products'=> '',
			
			'back_color'		=> '',
			'opacity'			=> '100',

			'shop_quick'		=> '' ,
			'shop_buy_action'	=> '',
			'shop_wishlist'		=> '',
			'smaller'			=> '',
			'text_to_display'	=> '',

			'css_classes'		=> '',
			'block_id'			=> generateRandomString()
			  
		), $atts ) );
		
	$content = wpb_js_remove_wpautop( $content, true );
		
	$display_args = array(
		'no_found_rows'		=> 1,
		'post_status'		=> 'publish',
		'post_type'			=> 'lookbook',
		'post_parent'		=> 0,
		'suppress_filters'	=> false,
		'numberposts'		=> 1,
		'include'			=> $single_lookbook
	);
	
	$main_content = get_posts($display_args);
	
	$opacity = $opacity / 100;
	
	// Enqueue variation scripts
	//wp_enqueue_script( 'wc-add-to-cart-variation' );
	
	
	echo '<style type="text/css" scoped>';
	if( $back_color ) {
		if( $block_style == 'centered' || $block_style == 'centered_alt' ) {
			echo '#'. esc_attr($block_id) .' .item-data { background-color: rgba('.hex2rgb( $back_color ).','.$opacity.') !important;}';
		}else{
			echo '#'. esc_attr($block_id) .' { background-color: rgba('.hex2rgb( $back_color ).','.$opacity.') !important;}';
		}
		
	}
	
	echo '</style>';
	
	####################  HTML STARTS HERE: ###########################
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

	do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
	
	?>
	
	<div id="<?php echo esc_attr($block_id); ?>" class="content-block single-item-block <?php echo esc_attr($block_style); ?>">			
		
		<?php
		
			foreach ( $main_content as $post ) {
		
			setup_postdata( $post );
			
			$classes = array();	
			$classes = get_post_class();
			$classes[] = 'inner-wrapper item';
			
			echo '<div class="'. implode(' ',$classes).'">';
			
			$id = get_the_ID();
			$link = esc_url( get_permalink($id));
						
			?>					
				
			<?php
			// TEXT (title, content, addtional content) HTML
			 $item_title = '<h3><a href="'. esc_url($link) .'">'. esc_html($post->post_title).'</a></h3>';
			
			if( $text_to_display == 'lookbook_post' ){
				$text = wpautop( get_the_content(), true );
			}elseif( $text_to_display == 'additional' ){
				$text = $content;
			}elseif( $text_to_display == 'both' ){
				$text = wpautop( get_the_content(), true ) . $content ;
			}
			
			$item_text = '<div class="text">'. $item_title . $text .'</div>';
			
			// IMAGE HTML
			// html for main image - part A
			$image_html_a  = $image_html_b  = '';
			$image_html_a .= '<div class="images-holder">';
				
				$image_html_a .= '<div class="item-img">';
				
					$image_html_a .= '<div class="front">';
						$image_html_a .= as_image( $img_format );
					$image_html_a .= '</div>';// front
					
					$image_html_a .= '<div class="back">';
						$image_html_a .= '<div class="item-overlay"></div>';
						

						// html for main image - part B
						$image_html_b .= '<div class="back-buttons">';
							
							$image_html_b .= '<a href="'. as_get_full_img_url() .'" class="item-zoom accent-1-light-40" data-rel="prettyPhoto" title="'. the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-zoom-in" aria-hidden="true"></div></a>' ;
							
							$image_html_b .= '<a href="'. esc_url($link). '" title="'. the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-link accent-1-light-30" aria-hidden="true"></div></a>';
						
						$image_html_b .= '</div>';// back-buttons
			
					$image_html_b .= '</div>';// back
					
				$image_html_b .= '</div>';// item-img
				
			$image_html_b .= '</div>';// images-holder

			$allowed = array(
					'div' => array(
						'class' => array()
					),
					'a' => array(
						'href' => array(),
						'class' => array(),
						'rel' => array(),
						'data-rel' => array(),
						'title' => array(),
						'aria-hidden' => array()
					),
					'img' => array(
						'src' => array(),
						'class' => array(),
						'title' => array(),
						'alt' => array(),
					)
				);
			
			
			if( $block_style != 'centered_alt' ) {
				
				echo wp_kses($image_html_a, $allowed);
				
				echo wp_kses_post( $item_text );
				
				echo wp_kses($image_html_b, $allowed);
			}
			?>
		
			<div class="item-data">
							
				<?php if( $as_woo_is_active ) { ?>
				
				<?php 
				if ( $post->post_excerpt ) {
					
					echo wp_kses_post($post->post_excerpt);
				}
				?>
				<div class="post-content">
		
					<?php 
					
					$prod_meta		= get_post_meta( get_the_ID(), 'aslb-products', true );
								
					$prod_meta_arr	= explode( ',',$prod_meta );
					
					$products_args	= array(
						'no_found_rows'		=> 0,
						'post_status'		=> 'publish',
						'post_type'			=> 'product',
						'post__in'			=> $prod_meta_arr,
						'post_parent'		=> 0,
						'suppress_filters'	=> false,
						'orderby'			=> 'post__in',
						'order'				=> 'DESC',
						'numberposts'		=> -1
					);
					
					$products = get_posts( $products_args );
					
					if( !empty($products) ) { 
					
						if ( !wp_script_is( 'wc-add-to-cart-variation', 'enqueued' )) {
											
							wp_register_script( 'wc-add-to-cart-variation', WP_PLUGIN_DIR . '/woocommerce/assets/frontend/add-to-cart-variation.min.js');
							wp_enqueue_script( 'wc-add-to-cart-variation' );
							
						}
						
						foreach( $products as $post ) {
						
							setup_postdata( $post );
							
							global $post, $product, $woocommerce, $wp_query;
							
							$id = $post->ID;
							?>
							
							<div class="large-6 medium-6 small-12 column">
								
								<div class="anim-wrap">
								
									<div class="front">
										
										<?php function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : ''; ?>
										
										<?php echo as_image( $img_format_products );?>
									
									</div>
									
									<div class="back<?php echo $smaller ? ' smaller' : ''; ?>">
									
										<div class="item-overlay"></div>

										<?php 
										echo as_image( $img_format_products );

										as_shop_buttons( !$shop_quick , !$shop_buy_action , !$shop_wishlist );
										
										as_shop_title_price();
										?>
										
									</div>
									
								</div>
								
							</div>
							
						<?php
						} // end foreach
						
						wp_reset_postdata();
					
					} //end if
					?>
					
				</div><!--post-content -->	
			
				<?php }else{ ?>
				
				<h4><?php esc_attr_e('WooCommerce plugin is not installed. Please install the plugin to add product associated with lookbook item','showshop') ?></h4>
				
				<?php } ?>
			
			</div>
			
			<?php
			if( $block_style == 'centered_alt' ) {
				echo wp_kses($image_html_a, $allowed);
				
				echo wp_kses_post( $item_text );
				
				echo wp_kses($image_html_b, $allowed);
			}
			?>
			
			<div class="clearfix"></div>
			
			
					
		<?php }// END foreach ?>

		</div>	
	
	
	</div><!-- /.content-block single-item-block -->
	
	<?php
	####################  HTML ENDS HERE: ###########################
	echo $css_classes ? '</div>' : null;

	####################  HTML OUTPUT ENDS HERE: #########################

	$output_string = ob_get_contents();
   
	ob_end_clean();
	
	return $output_string ;
}

add_shortcode( 'as_single_lookbook', 'as_single_lookbook_func' );
?>