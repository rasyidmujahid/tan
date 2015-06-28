<?php
/**
 * Template Name: Lookbook page
 *
 * Page to display lookbook archive
 *
 * @since showshop1.0
 **/
get_header(); 
// 
global $as_of, $as_woo_is_active;
$layout 				= $as_of['layout'];
$shop_cart_full_width	= $as_of['shop_cart_full_width'];
//
$post_id			= get_the_ID();
$layout 			= $as_of['layout'];
$page_under_head	=  get_post_meta( $post_id ,'as_page_under_head', true);
$under_head			= ( $page_under_head == false && AS_UNDERHEAD_IMAGE ) ? ' under-head' : '';
// CUSTOM META:
$hide_title				=  get_post_meta( $post_id ,'as_hide_title', true);
$lookbook_cats			=  get_post_meta( $post_id ,'as_lookbook_cats', true );
$lookbook_items			=  get_post_meta( $post_id ,'as_lookbook_items', true );
$items_in_row			=  get_post_meta( $post_id ,'as_lookbook_items_inrow', true );
$lookbook_page_img_format	= get_post_meta( $post_id ,'as_lookbook_image_format', true );
// VARS FOR FULL WIDTH AND/OR SHOP:
if( $as_woo_is_active ) {
	$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) ? true : false ;
}else{
	$is_shop = false;
}

$shop_full = ( $is_shop && $shop_cart_full_width ) ? true : false;
?>

<?php if( !$hide_title  ) { ?>				
<header class="page-header">

	<?php	
	$shop_title_bcktoggle = $as_of['shop_title_bcktoggle'];
	$shop_title_backimg = $as_of['shop_title_backimg'];
	
	if( $shop_title_bcktoggle && $shop_title_backimg && $is_shop ) {
		
		$image =  $shop_title_backimg;
		
		echo '<div class="header-background'. esc_attr( $under_head ).'" style="background-image: url('. esc_url($image) .');"></div>';
		
	}elseif( has_post_thumbnail() ) {
		// get image by attachment id:
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'as-landscape' );
		$image = $image[0];
		
		echo '<div class="header-background'. esc_attr( $under_head ) .'" style="background-image: url('. esc_url($image) .');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="row">
	
		<div class="small-12 table titles-holder">
		
			<h1 class="page-title" data-shadow-text="<?php the_title(); ?>"><?php the_title(); ?></h1>
		
		</div>
		
	</div><!-- /.row -->

</header>

<?php } // end if !hide_title ?>



<div class="row">
	
	<div id="primary" class="large-<?php echo ( $layout =='full_width' || $shop_full ) ? '12 full_width' : '8'; ?> medium-12 small-12 <?php echo $layout ? esc_attr( $layout ) : null; ?>" role="main">
		
		<?php
		$_SESSION['lookbook_page'] = get_permalink();
		
		if ( have_posts()) : while ( have_posts()) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>
			
			
		<?php 
		endwhile; 
		
		endif;
		wp_reset_postdata();
		
		if ( post_type_exists( 'lookbook' ) ) {
		?>
		
		<div class="shuffle-filter-holder anim-5">

		<?php 
		if( taxonomy_exists('lookbook_category') && count( $lookbook_cats ) > 1 ) {
		?>
			
				<?php
				// GET TAXONOMY OBJECT:
				$term_Objects = array();
				foreach ( $lookbook_cats as $cat_id ) {
					$term_Objects[] = get_term_by( 'id', $cat_id, 'lookbook_category' );
				}
				
				// DISPLAY TAXONOMY MENU:
				if( !empty($term_Objects) ) {
					
					echo '<ul class="taxonomy-menu tax-filters">';
					
					echo '<li class="all category-link"><a href="#" class="active"><div class="term">'. esc_html__('All','showshop') .'</div></a></li>';
					
					foreach ( $term_Objects as $term_obj ) {
					
						echo '<li class="'. esc_attr($term_obj->slug) .' category-link" id="cat-'. esc_attr($term_obj->slug) .'">';
						echo '<a href="#" data-group="'. esc_attr($term_obj->slug ).'">';
						echo '<div class="term">' . esc_html($term_obj->name) . '</div>';
						echo '</a>';
						echo '</li>';
						
					}
					
					echo '</ul>';
					
				}else{
					
					echo '<div class="lookbook-empty">';
			
						echo '<span class="icon-no-results icon-sad"></span>';
						
						echo '<h3>'. esc_html__("No lookbook categories containing lookbook items selected.","showshop")  .'</h3>';
												
						if( current_user_can('editor') || current_user_can('administrator')  ) {
							
							echo '<p><strong>' . esc_html__("Please, do the following:","showshop") . '</strong></p>';
							echo '<ul>';
								echo '<li>'. esc_html__("Make sure that some lookbook categories are created","showshop") .'</li>';
								echo '<li>'. esc_html__("Lookbook items are assigned to categories","showshop") .'</li>';
								echo '<li>'. esc_html__("In lookbook page template select lookbook categories for display","showshop") .'</li>';
							echo '</ul>';
						}else{
							
							echo '<p><strong>' . esc_html__("Currently there are no lookbook items set. Please, come back soon.","showshop") . '</strong></p>';
						}
						
						
						
					echo '</div>';	
					
				}
				
				?>			
			
			
		<?php } // endif $tax_terms ?>
		

		<?php
		//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if ( get_query_var('paged') ) { 
			$paged = get_query_var('paged'); 
		}elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page'); 
		}else { 
			$paged = 1;
		}
		// GET LOOKBOOK CATEGORIES ( if selected in metabox )
		if( !empty( $lookbook_cats ) ) {
			
			$tax_filter_args = array('tax_query' => array(
								array(
									'taxonomy'			=> 'lookbook_category',
									'field'				=> 'id', // can be 'slug' or 'id'
									'operator'			=> 'IN', // NOT IN to exclude
									'terms'				=> $lookbook_cats,
									'include_children'	=> true
								)
							)
						);
		}else{
			$tax_filter_args = array();
		}

		$grid = $items_in_row ? (12 / $items_in_row )  : 2;
		
		$ppp = $lookbook_items ? $lookbook_items : 3;
		
		$main_args = array(
				'post_type'				=> 'lookbook',
				'orderby'				=> 'date',
				'order'					=> 'ASC',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page'		=> $ppp,
				'paged'					=> $paged,
				);
		$all_args = array_merge( $main_args, $tax_filter_args );		
		
		$temp = $wp_query ;$wp_query  = null;

		$wp_query  = new WP_Query( $all_args );
		 
		if( $wp_query ->have_posts() ) : 
			
			echo '<div class="'.( (count( $lookbook_cats ) > 1) ? 'shuffle ' : 'no-shuffle ' ).'lookbook-page-items">';
			
			while( $wp_query ->have_posts() ) : $wp_query ->the_post();
			
				############################# LOOOKBOOK ITEM ###############################
				
				$lookbook_item_id = get_the_ID();
				//
				// POST CUSTOM META :
				$prod_meta				= get_post_meta( $lookbook_item_id, 'aslb-products', false  );
				$hide_lookbook_title	= get_post_meta( $lookbook_item_id, 'aslb-item_title', true  );

				//
				$classes = array('lookbook-page');

				// GET LIST OF ITEM CATEGORY (CATEGORIES) for FILTERING jquery.shuffle
				$terms = get_the_terms( $lookbook_item_id, 'lookbook_category' );
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
				?>

				<div class="large-<?php echo esc_attr($grid); ?> medium-6 small-12 column item"  <?php echo $terms_str ? 'data-groups='. esc_attr($terms_str). ''  : null ; ?> data-date-created="<?php echo esc_attr(get_the_date( 'Y-m-d' )); ?>" data-title="<?php echo the_title_attribute (array('echo' => 0));?>">

					<div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
						
						<div class="anim-wrap">
						
						<div class="item-img">
						
							<div class="front">
								
								<?php echo as_image( $lookbook_page_img_format ? $lookbook_page_img_format : 'thumbnail'); ?>
								
							</div>	
								
							<div class="back">	
								
								<div class="item-overlay"></div>
								
								<div class="back-buttons">
										
									<a href="<?php esc_attr(the_permalink()); ?>" title="<?php esc_attr(the_title()); ?>" ><div class="icon icon-link" aria-hidden="true"></div></a>
									
									<a href="<?php echo as_get_full_img_url(); ?>" class="lookbook-image" title="<?php echo esc_attr(get_the_title()); ?>" data-rel="prettyPhoto"><span class="icon icon-zoom-in"></span></a>
										
								</div><!-- .back-buttons -->
									
							
							</div><!-- .back  -->
						
						</div><!-- .item-img -->
						
						<div class="item-data lookbook-data">
						
							<?php if( !$hide_lookbook_title ) { ?>
							<a href="<?php esc_attr(the_permalink()); ?>" title="<?php esc_attr(the_title()); ?>" class="post-link">
								
								<h2 class="post-title lookbook-title"><?php esc_html(the_title()); ?></h2>	
											
							</a>
							<?php } ?>
							
							<?php 
							// PRODUCT NAMES OF PRODUCTS CONNECTED TO LOOKBOOK ITEM:
							$productsIDs = explode( ',', $prod_meta[0] );
							
							if( count( $productsIDs ) && !empty($productsIDs[0]) ) {
							
								echo '<span class="lookbook-item-products">' . __('Products from this combination','showshop') .':</span>';
								
								echo '<ul>';
								
								foreach ( $productsIDs as $product_id ) {
									
									global $post;
									
									$product	= get_post( $product_id ); 
									echo '<li><a href="'.get_permalink( $product_id ).'">' . $product -> post_title . '</a></li>'; 
								
								}
								
								echo '</ul>';
								
							}else{
								
								echo '<span class="lookbook-item-products">' . __('Products from this combination not available','showshop') .'.</span>';
								
							}
							
							$wlp_args = array( 
									'before'		=> '<div class="page-link"><p>' . __( 'Pages:', 'showshop' ) . '</p>',
									'after'			=> '</div>',
									'link_before'	=> '<span>',
									'link_after'	=> '</span>',
								);
							
							wp_link_pages( $wlp_args );
							?>
							
						</div>
						
						
						</div><!-- .anim-wrap -->
						
						<div class="clearfix"></div>
							
					</div><!-- #post-<?php the_ID(); ?> -->

				</div>
				
			<?php
				############################################################
			endwhile;
			
			as_show_pagination() ? as_pagination( 'nav-below' ) : null;
			
			$wp_query  = null; $wp_query  = $temp;
			
			echo '</div>';
		
		endif;
		
		?>
		
		<div class="clearfix"></div>
	
		</div><!-- #shuffle-filter-holder -->
		
		<?php } // endif $post_type_exists = 'lookbook' ?>
	
	</div><!-- #primary -->

	<?php
	// IF CUSTOM SIDEBAR IS SELECTED (CUSTOM META)
	$options = get_post_custom(get_the_ID());
	if(isset($options['custom_sidebar'])) {
		$sidebar_choice = $options['custom_sidebar'][0];
	}else{
		$sidebar_choice = "default";
	}
	
	if( $layout != 'full_width' ) {
		
		if($sidebar_choice && $sidebar_choice != "default") {
			
			get_sidebar("custom");
			
		}else{
		
			$is_shop ? do_action('woocommerce_sidebar') : get_sidebar();
		}
	}
	?>
	
</div><!-- .row -->

<?php get_footer(); ?>