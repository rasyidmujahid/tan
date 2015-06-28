<?php
/**
 *	Template part: Header Default
 *	default template part for header
 */
global $as_of, $as_woo_is_active, $as_wishlist_is_active;
?>


	<aside class="left-off-canvas off-canvas left-off-canvas-menu" data-offcanvas>
		
		<div class="hide-asides icon-cancel3"></div>

		<div id="offcanvas" class="offcanvaswrapper">
		
			<input type="hidden" id="offcanvas-back-label" value="<?php echo esc_attr("Back","showshop"); ?>" />
			
			<?php get_template_part('template_parts/aside_off_canvas_menu'); ?>
			
		</div>
		
	</aside>
	
	<aside class="right-off-canvas off-canvas right-off-canvas-menu" data-offcanvas>
	
		<div class="hide-asides icon-cancel3 accent-1-c"></div>
		
		<?php get_template_part('template_parts/header_searchform'); ?>
		
		<?php get_template_part('template_parts/aside_mini_wishlist'); ?>
		
		<?php if ( $as_woo_is_active ) { get_template_part('template_parts/aside_mini_cart'); } ?>
	
	</aside>

	
	<section class="main-section">	
	
	<div class="top-bar head-element">
		
		<div class="row accent-2-a">
			
			<?php $grid = has_nav_menu( 'secondary' ) ? '6' :  '12' ?>
			<div class="large-<?php echo esc_attr($grid);?> small-12 columns" style="height: 100%; position: absolute;">
				<?php get_template_part('template_parts/header_info'); ?>
			</div>
			
			<?php 
			// if there's a secondary menu 
			// OR demo mode is on (langauges selector)
			// OR WMPL is on (langauges selector)
			if( has_nav_menu( 'secondary' ) || $as_of['demo_mode'] || $as_of['lang_sel'] ) {?>
			<div class="large-6 small-12 columns" style="float: right !important">
				<?php get_template_part('template_parts/header_secondary_menu'); ?>
			</div>
			<?php } ?>
						
		</div>

	</div>
		
	<div  class="sticky">
	<header class="header-bar row head-element"  data-options="sticky_on: large" data-topbar >

		<div class="left-button accent-1-transp-70">
			<a href="#idOfLeftMenu" role="button" class="main-head-toggles" data-toggle="offcanvaswrapper" title="<?php _e("Menu","showshop");?>" data-tooltip><span class="icon-menu"></span></a>
		</div>
		
		<?php get_template_part("template_parts/header_title"); ?>
		
		<?php if( $as_woo_is_active ) { ?>
		<div class="right-button accent-1-transp-60">

			<?php get_template_part("template_parts/header_cart"); ?>
			
		</div>
		<?php } ?>
		
		<?php
		$wishlist_page_id	= get_option('yith_wcwl_wishlist_page_id');
		$current_page_id	= get_queried_object_id();
		$is_wishlist_page	= $wishlist_page_id == $current_page_id ? true : false;
		if( $as_wishlist_is_active && !$is_wishlist_page ) { ?>
		<div class="right-button accent-1-transp-70">
		
			<a href="#" role="button" class="main-head-toggles tip-bottom" data-toggle="wrap-mini-wishlist" title="<?php _e("Wishlist","showshop");?>" data-tooltip><span class="icon-heart"></span></a>
			
		</div>
	  	<?php } ?>
		
		<div class="right-button accent-1-transp-90">
		
			<a href="#search-toggle" role="button" class="main-head-toggles tip-bottom" data-toggle="searchform-header" title="<?php _e("Search","showshop");?>" data-tooltip><span class="icon-search"></span></a>
			
		</div>
	
	</header>
	</div>
	
	
	<?php 
	$desc_on	= !empty ( $as_of['logo_desc']['desc_on'] );
	if ( $desc_on ) { ?>
		<div id="site-description"><?php bloginfo( 'description' ); ?></div>
	<?php } ?>
	
	
	<div class="row head-element accent-2-c">
	
		<div class="large-12 column breadcrumbs-holder">
			<?php get_template_part('template_parts/header_breadcrumbs'); ?>
		</div>
	
	</div>

