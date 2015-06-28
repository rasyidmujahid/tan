<?php
/**
 *	The template part used for displaying SINGLE lookbook item.
 *
 *	@since showshop 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
?>

<div class="lookbook-single"> 
	
	<?php 
	if( has_post_thumbnail()  ) {
		
		echo '<div class="large-6 medium-6 small-12 column">';
				
				$img_size	= get_post_meta( get_the_ID(), 'aslb-img_size', true );
				$img_size	= $img_size ? $img_size : 'large';
				echo as_image( $img_size );
		
			echo '<br>';
			
			the_content();
			
		echo '</div>';
		
	}
	?>

	<div class="large-6 medium-6 small-12 column">
		
		<?php
		// get meta
		$img_size_prod	= get_post_meta( get_the_ID(), 'aslb-img_size_prod', true );
		$prod_meta		= get_post_meta( get_the_ID(), 'aslb-products', false );
		$items_num		= get_post_meta( get_the_ID(), 'aslb-items_num', true );		
		$smaller_meta	= get_post_meta( get_the_ID(), 'aslb-smaller', true );
		
		
		$smaller		= $smaller_meta ? ' smaller' : '';
		?>
		
		<div class="content-block post-content<?php echo esc_attr( $smaller ); ?>">
		
			<?php 
			// get products
			$prod_meta_arr	= explode( ',',$prod_meta[0] );
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
				
				// items per row:
				$grid = $items_num ? ( 12 / $items_num ): '6';
				
				foreach( $products as $post ) {
				
					setup_postdata( $post );
					
					global $post, $product, $woocommerce, $wp_query;
					
					$id = $post->ID;
					?>
					<div class="item large-<?php echo esc_attr($grid); ?> small-12 column">
						
						<div class="anim-wrap">
						
							<div class="item-img">
							
								<div class="front">
									
									<?php function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : ''; ?>
									
									<?php echo as_image( $img_size_prod ? $img_size_prod : "thumbnail" );?>
								
								</div>
								
								<div class="back">
								
									<div class="item-overlay"></div>

									<?php 
									
									echo as_image( $img_size_prod ? $img_size_prod : "thumbnail" );

									as_shop_buttons();
									
									as_shop_title_price();
									?>
								
								</div>
							
							</div>
							
						</div>
					
					</div>
				
					<?php
					} // end foreach
				
				wp_reset_postdata();
			
			} //end if
			?>
			
		</div><!--post-content -->	

		<div class="clearfix"></div>
	
	</div>

</div>

<div class="clearfix"></div>