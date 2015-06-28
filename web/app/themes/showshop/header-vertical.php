<?php
/**
 *	Template part: Header Vertical 
 *	vertical customizable template for header - float left with fixed position
 */
global $as_of, $as_woo_is_active, $as_wishlist_is_active;
?>

<aside class="left-off-canvas off-canvas left-off-canvas-menu" data-offcanvas>
		
		<div class="hide-asides icon-cancel3"></div>

		<div id="offcanvas" class="offcanvaswrapper">
		
			<input type="hidden" id="offcanvas-back-label" value="<?php echo esc_attr("Back","showshop"); ?>" />
			
			<?php 
			$walker = new My_Walker;
			wp_nav_menu( array( 
					'theme_location'	=> 'offcanvas-menu',
					//'menu'			=> 'Offcanvas',
					'walker'			=> $walker,
					'link_before'		=> '',
					'link_after'		=> '',
					'menu_id'			=> 'offcanvas-menu',
					'menu_class'		=> 'offcanvas offcanvasopen',
					'container'			=> false
					) 
				);
			?>
		</div>
		
	</aside>
	
<aside class="right-off-canvas off-canvas right-off-canvas-menu" data-offcanvas>
	
	<div class="hide-asides icon-cancel3 accent-1-c"></div>
	
	<?php get_template_part('template_parts/header_searchform'); ?>
	
	<?php get_template_part('template_parts/aside_mini_wishlist'); ?>
	
	<?php if ( $as_woo_is_active ) { get_template_part('template_parts/aside_mini_cart'); } ?>

</aside>


<header id="site-menu" class="vertical">
		
	<div class="row clearfix">

		<div class="left-button accent-1-transp-90">
			<a href="#idOfLeftMenu" role="button" class="main-head-toggles" data-toggle="offcanvaswrapper" title="<?php _e("Menu","showshop");?>" data-tooltip><span class="icon-menu"></span></a>
		</div>
	
	<?php 
	
	if( isset( $as_of['default_header_blocks']['enabled'] ) ) {
	
		$headblocks = $as_of['default_header_blocks']['enabled'];
		
		foreach ( $headblocks as $block ) {
		
			$block_array_check =  strpos( $block, "|");
			// if are saved as resizable
			if( $block_array_check ) {
			
				$bl =  explode("|", $block ); // $bl[0] - block name, $bl[1] - block width
				
				switch ( $bl[0] ) {
				
					//////////////////////////////////////////
					case 'Sidemenu buttons' :
					
						echo '<div class="buttons">';
							
							echo '<div class="right-button accent-1-transp-90">';
		
							echo '<a href="#search-toggle" role="button" class="main-head-toggles tip-bottom" data-toggle="searchform-header" title="'. __("Search","showshop").'" data-tooltip><span class="icon-search"></span></a>';
			
							echo '</div>';
							
							//IF WOOCOMMERCE AND WISHLIST is ACTIVATED
							$wishlist_page_id	= get_option('yith_wcwl_wishlist_page_id');
							$current_page_id	= get_queried_object_id();
							$is_wishlist_page	= $wishlist_page_id == $current_page_id ? true : false;
							if( $as_wishlist_is_active && !$is_wishlist_page ) { 
							
							echo '<div class="right-button accent-1-transp-70">';
							
								echo '<a href="#" role="button" class="main-head-toggles tip-bottom" data-toggle="wrap-mini-wishlist" title="'. __("Wishlist","showshop") .'" data-tooltip><span class="icon-heart"></span></a>';
								
							echo '</div>';
							}
							
							//IF WOOCOMMERCE is ACTIVATED
							if ( $as_woo_is_active ) {
							
								echo '<div class="right-button accent-1-transp-60">';
								
								get_template_part('template_parts/header_cart');
								
								echo '</div>';
							
							} // endif $as_woo_is_active
							
						echo '</div>';// .buttons
						
					break;
					//////////////////////////////////////////
					case 'Site title or logo' :
					
						get_template_part("template_parts/header_title");
					
					break;
					//////////////////////////////////////////
					case 'Menu' :
					?>
					<nav class="small-12">
						
						<?php 
						$walker = new My_Walker;
						wp_nav_menu( array( 
								'theme_location'	=> 'vertical-menu',
								//'menu'			=> 'Main menu',
								'walker'			=> $walker,
								'link_before'		=>'',
								'link_after'		=>'',
								'menu_id'			=> 'vertical-menu',
								'menu_class'		=> 'navigation vertical',
								'container'			=> false
								) 
							);
						?>
						
					</nav>
					<div class="clearfix"></div>
					
					<?php 
					break;
					//////////////////////////////////////////
					
					case 'Sidemenu info' :
	
						echo '<div class="sidemenu-info">';
						
						get_template_part('template_parts/header_info');
					
						echo '</div>';
						
					break;
					
					//////////////////////////////////////////
					case 'Widgets block' :
					
					if ( is_active_sidebar( 'sidebar-header' ) ) {
						
						dynamic_sidebar( 'sidebar-header' ); 
						
					}
					
					break;
					//////////////////////////////////////////
					case 'Widgets block 2' :
					
					if ( is_active_sidebar( 'sidebar-header-2' ) ) {
						
						dynamic_sidebar( 'sidebar-header-2' ); 
						
					}
					
					break;
					//////////////////////////////////////////
					case 'Widgets block 3' :
					
					if ( is_active_sidebar( 'sidebar-header-3' ) ) {
						
						dynamic_sidebar( 'sidebar-header-3' ); 
						
					}
					
					break;
					
				}
			}
		}
	
	}
		
	?>
	
	</div><!-- .row -->
	
</header>