<?php
/**
 *	Template part: Mini Wishlist
 *	partial to display mini wishlist (in aside and modal)
 *	requires YITH Wishlist plugin installation
 */

global $as_of, $as_woo_is_active, $as_wishlist_is_active;

if( $as_woo_is_active && $as_wishlist_is_active ) {
	
	 $products_in_wishlist = array();
	 if ( is_user_logged_in() ) {
		 
		global $wpdb;
		
		$user_ID = get_current_user_id();
		
		$tablename = $wpdb->prefix ."yith_wcwl";
		
		$sql				= 'SELECT prod_id FROM '.$tablename.' WHERE user_id = %d';
		$sql_prepared		= $wpdb->prepare( $sql , $user_ID );	
		$wishlist_table		= $wpdb->get_results( $sql_prepared, ARRAY_A );
		
		$products_in_wishlist = array();
		foreach( $wishlist_table as $wishlist_row ){
			$products_in_wishlist[] =  $wishlist_row['prod_id'];
		}
		
	 }else{
		 
		$cookie = yith_getcookie( 'yith_wcwl_products' );

		$products_in_wishlist = array();
		foreach( $cookie as $cookie_item ){
			$products_in_wishlist[] =  $cookie_item['prod_id'];
		}
		 
	}
	?>
	
	<div class="wrap-mini-wishlist">
		
		<h5><?php echo __("Wishlist","showshop") ?></h5>
	
		<ul class="mini-wishlist cart_list">
	
	
	<?php if( empty( $products_in_wishlist ) ) {
	?>
		
		<li class="wishlist-empty"><?php echo __("Your wishlist is empty","showshop"); ?></li>
		
	<?php 
	}else{
		
		$args = array(
			'no_found_rows' => 1,
			'post_status'	=> 'publish',
			'post_type'		=> 'product',
			'post_parent'	=> 0,
			'suppress_filters' => false,
			'orderby'     	=> 'post_date',
			'order'       	=> 'DESC',
			'numberposts' 	=> 5,
			'post__in'		=> $products_in_wishlist
		);	

		$get_products = get_posts($args);

		foreach ( $get_products as $post ) {
						
			setup_postdata( $post );
			$id = get_the_ID();
			?>
			
			<li>
				<a href="<?php echo get_permalink(); ?>">
				
					<?php echo as_image( 'shop_thumbnail' ); ?>
					
					<?php the_title(); ?>
					
					<a href="#qv-holder" class="quick-view tip-top accent-1-light-45"   title="<?php echo __('Quick view','showshop') ?> - <?php echo the_title_attribute (array('echo' => 0)) ?>" data-id="<?php echo esc_attr($id) ?>"  data-tooltip><span class="icon-eye"></span></a>
					
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				
				</a>
			</li>
			
		<?php }// end forech
		
			wp_reset_postdata();
		
		}// endif empty( $products_in_wishlist )
	
	?>
	
	</ul>

	<?php
	$wishlist_page_id =  get_option('yith_wcwl_wishlist_page_id');

	echo '<a href="'. get_permalink( $wishlist_page_id ).'" class="button wishlist-page-link">'. __("View the wishlist page","showshop") .'</a>';
	?>
	
	</div>
	
<?php } // endif count($as_woo_is_active && $as_wishlist_is_active)
?>