<?php
//
/** 
 *	WOOCOMMERCE
 *
 *	REMOVE WOOMMERCE DEFAULT SETTING AND OPTIONS IN FAVOUR OF THEME SETTINGS
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$as_woo_is_active = false;
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	$as_woo_is_active = true; // using as global variable in theme for on/off woo functions and hooks

	$as_wc_version = WOOCOMMERCE_VERSION ;
	
	$run_once = new run_once;
	if ($run_once->run('init_woo_theme_values')) {
		init_woo_theme_values();
	}
	
}// endif is plugin active

/**
 *	YITH WISHLIST plugin init check
 *
 */
$as_wishlist_is_active = false;
if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || class_exists( 'YITH_WCWL' ) ) {
	
	$as_wishlist_is_active = true; 
	
}



	function init_woo_theme_values() {
		//
		$shop_catalog_image_size = array(
			'width' => 300,
			'height' => 180,
			'crop' => 1
		);
		$shop_single_image_size = array(
			'width' => 300,
			'height' => 300,
			'crop' => 1
		);
		$shop_thumbnail_image_size = array(
			'width' => 80,
			'height' => 80,
			'crop' => 1
		);
		update_option('shop_catalog_image_size', $shop_catalog_image_size );
		update_option('shop_single_image_size', $shop_single_image_size );
		update_option('shop_thumbnail_image_size', $shop_thumbnail_image_size );
		//
		update_option( 'woocommerce_frontend_css','no' ); // IMPORTANT - theme's WOO template CSS instead of plugin's
		update_option( 'woocommerce_menu_logout_link','no' ); // remove "Logout" menu item	
		update_option( 'woocommerce_prepend_shop_page_to_urls','yes' );
		update_option( 'woocommerce_prepend_shop_page_to_products','yes' ); 
		update_option( 'woocommerce_prepend_category_to_products','yes' );
		//
		
	};
	
if( $as_woo_is_active ) {


	function wooc_init () {

		global $as_wc_version;
		
		add_theme_support( 'woocommerce' );
		
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		
	}
	add_action('init','wooc_init');
	
	if( is_admin() ) {
		function dequeue_select2() {
			wp_dequeue_style( 'select2' );
			wp_deregister_style( 'select2' );
		}

		add_action( 'admin_init', 'dequeue_select2' );
	}
	
	/**
	 *	NUMBER OF PRODUCTS ON PRODUCTS PAGE:
	 *
	 */
	add_filter('loop_shop_per_page', 'products_per_page' );
	if (!function_exists('products_per_page')) {
		function products_per_page () {
			global $as_of;
			$products_page_settings = !empty($as_of['products_page_settings']) ? $as_of['products_page_settings'] : '';
			$products_number =  $products_page_settings['Products per page'] ? $products_page_settings['Products per page'] : 6;
			return $products_number;
		}
	}
	/**
	 *	NUMBER OF COLUMNS IN PRODUCTS AND PROD. TAXNOMIES PAGE
	 *
	 */
	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		
		function loop_columns() {
			global $as_of;
			$products_page_settings = !empty($as_of['products_page_settings']) ? $as_of['products_page_settings'] : '';
			$columns =  $products_page_settings['Products columns'] ? $products_page_settings['Products columns'] : 4;
			
			return $columns;

		}
	}
	/**
	 *	NUMBERS FOR RELATED PRODUCTS
	 *
	 **/
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	add_action( 'woocommerce_after_single_product_summary', 'as_output_related_products', 20);
	if ( ! function_exists( 'as_output_related_products' ) ) {
		function as_output_related_products() {
		
			global $as_of, $as_wc_version;
			
			$products_page_settings = !empty($as_of['products_page_settings']) ? $as_of['products_page_settings'] : '';
			
			$related_total =  $products_page_settings['Related total'] ? $products_page_settings['Related total'] : 4;
			$related_columns =  $products_page_settings['Related columns'] ? $products_page_settings['Related columns'] : 4;
			
			if ( version_compare( $as_wc_version, "2.1" ) >= 0 ) {
			
				$args = array(
					'posts_per_page' => $related_total,
					'columns' => $related_columns,
					'orderby' => 'rand'
				);
				woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
				
			} 
		}
	}
	
	/**
	 *	NUMBERS FOR UPSELL PRODUCTS
	 *
	 **/
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );
	 
	if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
		function woocommerce_output_upsells() {
		
			global $as_of;
			$total	= $as_of['upsell_total'] ? $as_of['upsell_total'] : 3;
			$in_row	= $as_of['upsell_in_row'] ? $as_of['upsell_in_row'] : 3;
			
			woocommerce_upsell_display( $total, $in_row);
		}
	}
	
	
	//
	/**
	 *	AJAX UPDATER OF CART
	 *
	 */
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		
		global  $as_of;
		
		ob_start();
		$cart_count = WC()->cart->cart_contents_count;
		
		echo '<div class="showshop-head-cart mini-cart-toggle main-head-toggles" id="showshop-head-cart" data-toggle="mini-cart-list" title="'. __('Cart','showshop').'" data-tooltip>';
		?>
			<span class="icon-shopping63 mini-cart-icon" aria-hidden="true"></span>
				
				
				<?php echo '<span class="count">'. intval($cart_count).'</span>'; ?>
				
				<?php echo wp_kses_post( WC()->cart->get_cart_total()); ?>
				

				
			<div class="clearfix"></div>
		
		<?php echo '</div>';
		
		$fragments['.showshop-head-cart'] = ob_get_clean();
		
		return $fragments;
	}
	
	
	
	/**
	 *	PRODUCTS CATALOG / PROD.ARCHIVE PAGE IMAGES (shop page):
	 *
	 */
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	
	add_action( 'woocommerce_before_shop_loop_item_title', 'as_loop_product_thumbnail', 20 );
	//
	if ( ! function_exists( 'as_loop_product_thumbnail' ) ) {

		function as_loop_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
			
			global $post, $product, $yith_wcwl, $as_of;
			
			$products_settings = !empty($as_of['products_settings']) ? $as_of['products_settings'] : '';
			
			// get image format from theme options:
			$of_imgformat = $as_of['shop_image_format'];
			if( $of_imgformat == 'as-portrait' ||  $of_imgformat == 'as-landscape' || $of_imgformat == 'thumbnail' ||  $of_imgformat == 'medium' ||  $of_imgformat == 'large' ){
				$img_format = $of_imgformat;
			}else{
				$img_format = 'shop_catalog';
			}
			
			$attachment_ids = $product->get_gallery_attachment_ids();
			if ( $attachment_ids ) {
				$image_url	= wp_get_attachment_image_src( $attachment_ids[0], 'full' );
				$img_url	= $image_url[0];
				$imgSizes	= all_image_sizes(); // as custom fuction
				$img_width	= $imgSizes[$img_format]['width'];
				$img_height = $imgSizes[$img_format]['height'];
				
			}
			
			$title = '<a href="' . get_permalink(). '" title="'. esc_attr( strip_tags($post->post_title) ) .'"><h3>'. get_the_title(). '</h3></a>';
			
			echo '<div class="front">';
							
			echo as_image( $img_format );
			
			function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : '';
			
			echo '</div>';
			
			echo '<div class="back">';
			
				echo '<div class="item-overlay"></div>';
						
				if ( $attachment_ids ) {
					echo '<img src="'. esc_url( fImg::resize( $img_url ,$img_width, $img_height, true ) ) .'" alt="'. esc_attr($post->post_title) .'" class="back-image" />';
										
				}else{
					echo as_image( $img_format );
				}
				
				as_shop_buttons();
				
				as_shop_title_price();
				
				
			echo '</div>';

		}
	}
	/**
	 *	CHANGE WOOCOMMERCE PLACEHOLDER IMAGE
	 *
	 */
	remove_filter('woocommerce_placeholder_img_src','woocommerce_placeholder_img_src');
	add_filter('woocommerce_placeholder_img_src','as_placeholder_img_src');
	function as_placeholder_img_src () {
		global $as_of;
		return $as_of['placeholder_image'];
	}
	/**
	 *	REMOVE WOO TITLE from PRIMARY div to head (like blog single page title)
	 *	
	 */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'as_single_product_summary', 'woocommerce_template_single_title', 5 );
	//
	/**
	 *	DEQUEUE PRETTYPHOTO FROM WOOC. PLUGIN IN FAVOUR OF THEME'S PRETTYPHOTO
	 *	
	 */

	function prettyPhoto_dequeue () {
	
		wp_dequeue_style('woocommerce_prettyPhoto_css');
		wp_deregister_style('woocommerce_prettyPhoto_css');
		
		wp_dequeue_script('prettyPhoto');
		wp_dequeue_script('prettyPhoto-init');

	}
	add_action( 'wp_enqueue_scripts','prettyPhoto_dequeue', 1000 );

	/**
	 * Changing order in single product
	 *
	 */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );


	
	/**
	 *	Quick view images
	 *
	 */
	add_action( 'product_quick_view_images', 'quick_view_images', 25 );
	function quick_view_images() {
		
		global $post, $woocommerce, $product, $as_of;
		
		// get image format from theme options:
		$of_imgformat = $as_of['quick_view_image_format'];
		if( $of_imgformat != 'plugin' ){
			$img_format = $of_imgformat;
		}else{
			$img_format = 'shop_single';
		}
		
		$attachment_ids = $product->get_gallery_attachment_ids();
		
		echo '<div class="images'. ($attachment_ids ? ' owl-carousel  productslides'  : '') .'">';
		
		// MAIN PRODUCT IMAGE - POST THUMBNAIL (FEATURED IMAGE ETC.) 
		if ( has_post_thumbnail() ) {
			
			$image_title 		= esc_attr( strip_tags( get_the_title( get_post_thumbnail_id() ) ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title' => $image_title
				) ); 
			$attachment_count   = count( $product->get_gallery_attachment_ids() );
			$product_link		= esc_attr( get_permalink() );

			echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="item-img" itemscope><a href="%4$s" class="woocommerce-main-image zoom" itemprop="image">%3$s</a></div>',
			
			 $image_link,		// 1
			 $image_title,		// 2
			 $image,			// 3
			 $product_link		// 4
			 ),  $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ) );

		}
		
		// PRODUCT GALLERY IMAGES 
		if ( $attachment_ids ) {

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
				
					continue;
				$image_title = esc_attr( strip_tags( get_the_title( $attachment_id ) ) );
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
					'title' => $image_title
					));
				$image_class = esc_attr( implode( ' ', $classes ) );
				

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item-img">
	%4$s</div>', 
				$image_link, 
				$image_class, 
				$image_title, 
				$image ), $attachment_id, $post->ID, $image_class );
				
				$loop++;
			}

		}
		echo '</div>';//. images
	}


	
	/**
	 *	Single product display images
	 *
	 *	- used in as-single-product-block.php and content-single.product.php
	 */
	add_action( 'do_single_product_images', 'single_product_images', 25, 1 );
	function single_product_images( $img_format = 'shop_single') {
		
		global $post, $woocommerce, $product, $as_of;
		
		
		// get image format from theme options for SINGLE PRODUCT:
		$of_imgformat = $as_of['single_product_image_format'];
		
		if( is_product()) { // if on single product page: 
		
			if( $of_imgformat == 'as-portrait' ||  $of_imgformat == 'as-landscape' ){
				$img_format = $of_imgformat;
			}else{
				$img_format = 'shop_single';
			}
			
		}else{ // if not on single product (single block or quick view): 
			
			$img_format = $img_format;
		}
		
		$attachment_ids = $product->get_gallery_attachment_ids();
		
		echo '<div class="'. ($attachment_ids ? 'owl-carousel singleslides'  : '') .' images">';
		
		// MAIN PRODUCT IMAGE - post thumbnail (featured image etc.)
		if ( has_post_thumbnail() ) {
		
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image_class 		= esc_attr( 'attachment-' . get_post_thumbnail_id() );
			$image_title 		= esc_attr( strip_tags( get_the_title( get_post_thumbnail_id() ) ) );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title' => $image_title
				) );
			$full_image			= as_get_full_img_url();
			$product_title		= esc_attr( strip_tags(get_the_title()));
			$product_link		= esc_attr( get_permalink() );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="item-img item"><div class="front">%4$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons" itemscope><a href="%5$s" data-o_href="%5$s" class="woocommerce-main-image zoom accent-1-light-40" itemprop="image" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%6$s"><div class="icon icon-zoom-in" aria-hidden="true"></div></a>%7$s</div></div></div>',
			
				$image_link,	// 1
				$image_class,	// 2
				$image_title,	// 3
				$image,			// 4
				$full_image,	// 5
				$product_title,	// 6
				is_product() ? null : '<a href="'.$product_link .'" title="%6$s" class="accent-1-light-30"><div class="icon icon-link" aria-hidden="true"></div></a>'	// 7

			),  $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ) );

		}
		
		/**	Product gallery images */
		
		if ( $attachment_ids ) {

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;
				$image_class	= esc_attr( implode( ' ', $classes ) );
				$image_title	= esc_attr( strip_tags(get_the_title()) );
				$image			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
					'title' => $image_title
					));
				$attachment_src = wp_get_attachment_image_src( $attachment_id, 'large' );
				
				$full_image		= esc_url( $attachment_src[0] );
				$product_title	= esc_attr( strip_tags( get_the_title() ) );
				$product_link	= esc_attr( get_permalink() );
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item-img item"><div class="front">%4$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons"><a href="%5$s" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%6$s"><div class="icon icon-zoom-in accent-1-light-30" aria-hidden="true"></div></a> %7$s </div></div></div>', 
					$image_link,	// 1
					$image_class,	// 2
					$image_title,	// 3
					$image,			// 4
					$full_image,	// 5
					$product_title,	// 6
					is_product() ? null : '<a href="'.$product_link .'" title="%6$s"><div class="icon icon-link" aria-hidden="true"></div></a>'	// 7
					
				), $attachment_id, $post->ID, $image_class );
				
				$loop++;
			}

		}
		
		echo '</div>';//. images
	}
	
	
	
	if ( ! function_exists( 'as_get_product_search_form' ) ) {

		/**
		 * Output Product search forms - AS edit.
		 *
		 * @access public
		 * @param bool $echo (default: true)
		 * @return void
		 */
		function as_get_product_search_form( $echo = true  ) {
			do_action( 'as_get_product_search_form'  );

			$search_form_template = locate_template( 'product-searchform.php' );
			if ( '' != $search_form_template  ) {
				require $search_form_template;
				return;
			}
			
			$placeholder = esc_attr__('Search for products', 'showshop');

			$form = '<div class="searchform-header"><form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">

					<input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="' . $placeholder . '" />
					<button type="submit" class="icon-search" id="searchsubmit"></button>
					<input type="hidden" name="post_type" value="product" />
				
			</form></div>';

			if ( $echo  )
				echo apply_filters( 'as_get_product_search_form', $form );
			else
				return apply_filters( 'as_get_product_search_form', $form );
		}
	}
	
	
	/**
     * AS YITH AJAX SEARCH
     * 
     * 
     * @return echo
     */
	if ( !function_exists('as_yith_ajax_search') ) {
	
		function as_yith_ajax_search() {
			
			if ( !defined( 'YITH_WCAS' ) ) { return; } 
			wp_enqueue_script('yith_wcas_jquery-autocomplete' );
			
			?>

			<div class="yith-ajaxsearchform-container searchform-menu">
			<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
				<div>
					
					<?php 
					$label		= get_option('yith_wcas_search_input_label');
					$placehold	= $label ? $label : esc_attr__('Search for products','showshop');
					?>
					
					<input type="search"
					   value="<?php echo get_search_query() ?>"
					   name="s"
					   id="yith-s"
					   class="yith-s"
					   placeholder="<?php echo $placehold; ?>"
					   data-loader-icon="<?php echo get_template_directory_uri() . '/img/ajax-loader.gif'; ?>"
					   data-min-chars="<?php echo get_option('yith_wcas_min_chars'); ?>" />
					
					<button type="submit" class="icon-search"></button>
					
					<input type="hidden" name="post_type" value="product" />
					<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ): ?>
						<input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
					<?php endif ?>
				</div>
			</form>
			</div>
			<script type="text/javascript">

			jQuery(document).ready(function ($) {
				"use strict";

				var el = $('.yith-s'),
					loader_icon = el.data('loader-icon') == '' ? '' : el.data('loader-icon'),
					search_button = $('#yith-searchsubmit'),
					min_chars = el.data('min-chars');

				search_button.on('click', function(){
					var form = $(this).closest('form');
					if( form.find('.yith-s').val()==''){
						return false;
					}
					return true;
				});

				if( el.length == 0 ) el = $('#yith-s');

				el.each(function () {
					var $t = $(this),
						append_to = ( typeof  $t.data('append-to') == 'undefined') ? $t.closest('.yith-ajaxsearchform-container') : $t.data('append-to');

					el.yithautocomplete({
						minChars        : min_chars,
						appendTo        : append_to,
						serviceUrl      : woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
						onSearchStart   : function () {
							$(this).css('background', 'url(' + loader_icon + ') no-repeat right center');
						},
						onSelect        : function (suggestion) {
							if (suggestion.id != -1) {
								window.location.href = suggestion.url;
							}
						}  ,
						onSearchComplete: function () {
							$t.css('background', 'transparent');
						}
					});
				});
			});
			</script>
		<?php  
		} // end function as_yith_ajax_search
	} // end if function_exists as_yith_ajax_search
	/**
	 *	SHOP META BOX handling
	 *
	 *	- removing shop meta box if current page is not registered in WooCommerce as shop base
	 *	always removing "catalog-pre" meta box, EXCEPT if:  current edited page id == shop base page id
	 *	
	 *	admin hooks: load-"ADMIN-PAGE"
	 */
	add_action( 'load-post.php', 'only_shop_page_meta' );
	function only_shop_page_meta() {

		$shop_base_id	= wc_get_page_id('shop');
		
		if( isset($_GET['post']) && $_GET['post'] != $shop_base_id ) {
		
			remove_meta_box( 'catalog-page-meta-box', 'page', 'normal' );
		}
		
	}
	add_action( 'load-post-new.php', 'remove_shop_page_meta' );
	function remove_shop_page_meta() {

		remove_meta_box( 'catalog-page-meta-box', 'page', 'normal' );
	
	}	

	/**
	 *	AS WISHLIST - extending and changing YITH WISHLIST plugin ( plugin must be installed and activated )
	 * - deprecated from YITH WCWL 2.0.0
	 */
	if( class_exists( 'YITH_WCWL_UI' ) ) {
			
		class AS_WISHLIST extends YITH_WCWL_UI {
		
			public static function add_to_wishlist_button( $url, $product_type, $exists ) {
			
				
				global $yith_wcwl, $product;
				
				$icon				= '<span class="icon-heart-outlined"></span>';
				$icon_added 		= '<span class="icon-heart2"></span>';
				$classes			= 'class="add_to_wishlist tip-top"';
				$title_add			= __('Add to wishlist','showshop');
				$title_added		= __( 'Product added! Browse Wishlist','showshop' );
				$title_in_wishlist	= __( 'The product is already in the wishlist! Browse Wishlist','showshop' );

				// GENERATE HTML OUTPUT:
				
				$html  = '<div class="yith-wcwl-add-to-wishlist">';
				
				$html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

				$html .= $exists ? ' hide" style="display:none;"' : ' show"';

				$html .= '><a href="' . esc_url( $yith_wcwl->get_addtowishlist_url() ) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' title="'.$title_add.'" data-tooltip>' . $icon . '</a>';
			   
				$html .= '<img src="' . esc_url( get_template_directory_uri(). '/img/ajax-loader.gif' ) . '" class="ajax-loading" alt="loader" width="16" height="16" style="visibility:hidden" />';
				
				$html .= '</div>';
				
				// product JUST added :
				$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">';
				
				$html .= '<a href="' . esc_url( $url ) . '" class="tip-top" title="' .$title_added . '" data-tooltip>'. $icon_added .'</a></div>';
				
				
				// product ALREADY in wishlist :
				$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '">';
				
				$html .= '<a href="' . esc_url( $url ) . '" class="tip-top" title="' .$title_in_wishlist . '" data-tooltip>'.$icon_added.'</a></div>';
				
				$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

				$html .= '</div>';
				$html .= '<div class="clearfix"></div>';

				return $html;
				
			}
		}
		
		
		add_action('as_wishlist_button','as_wishlist_button_func', 10); // FOR PB BLOCKS, CATALOG etc.
		//add_action( 'woocommerce_single_product_summary', 'as_wishlist_button_func', 35 ); // FOR SINGLES
		function as_wishlist_button_func() {
			
			$wishlist_version = get_option( 'yith_wcwl_version' );
			
			if ( $wishlist_version && version_compare( $wishlist_version , "2.0.0" ) < 0 ) {
			
				global $yith_wcwl, $product;
				
				$wishlist = new AS_WISHLIST;
				
				$wishlist_html = $wishlist->add_to_wishlist_button( $yith_wcwl->get_wishlist_url(), $product->product_type, $yith_wcwl->is_product_in_wishlist( $product->id ) );
				
				echo wp_kses_post($wishlist_html);
			
			}else{
				
				yith_wcwl_get_template( 'add-to-wishlist.php' );
				
			}		
			
		}
		
		/* end AS WISHLIST */
		
		/*
		 *	REMOVE ANNONYMOUS YITH HOOKS
		 *	
		 *	- remove single product yith wishlist button, which is created
		 *  with anonymous function
		 */
		
		add_action('remove_YITH_wishlist_hooks', 'remove_anonymous_YITH_hooks');
		function remove_anonymous_YITH_hooks() {
			
			remove_anonymous_function_filter(
				'woocommerce_single_product_summary',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				31
			);
			remove_anonymous_function_filter(
				'woocommerce_product_thumbnails',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				21
			);
			remove_anonymous_function_filter(
				'woocommerce_after_single_product_summary',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				11
			);
			
		}
		
		function dequeue_yith_styles() {
			wp_dequeue_style( 'yith-wcwl-font-awesome');
			wp_dequeue_style( 'yith-wcwl-font-awesome-ie7' );
			//wp_dequeue_style( 'yith-wcwl-main' );
		}

		add_action( 'wp_enqueue_scripts', 'dequeue_yith_styles' );
		
	
	}
	/**
	 *	end YITH WISHLIST related functions
	 */

	/**
	 *	PRODUCT CUSTOM ATTRIBUTES - REGISTER TO MENUS and CREATE THEME FILES
	 *	- register taxonomy pa_"custom prod att." to nav menus
	 *	- create "taxonomy-$custom attribute.php" file
	 */
	
	// get taxonomies and filter out PRODUCT ATTRIBUTES ( PREFIX PA_)
	function fetch_prod_atts() {
		$get_tax_args = array(
			'public'   => true,
			'_builtin' => false
		); 
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $get_tax_args, $output, $operator ); 
		$product_attributes = array();
		if ( $taxonomies ) {
			foreach ( $taxonomies  as $taxonomy ) {	
				if( strpos($taxonomy,'pa_')!== false ){
					$product_attributes[] = $taxonomy;
				}
			}
		}
		return $product_attributes;
	}
	
	add_action('admin_init', 'create_atts_files',10);
	function create_atts_files() {
		
		WP_Filesystem();
		global $wp_filesystem;
		
		$product_attributes	= fetch_prod_atts();
		$theme_folder		= get_template_directory();
		$content			= '<?php if ( ! defined( "ABSPATH" ) ) exit; wc_get_template( "archive-product.php" );?>';
		 
		foreach( $product_attributes as $prod_att ) {

			$file	= $theme_folder .  '/taxonomy-' . $prod_att .'.php';
			
			if( !file_exists($file) ) {
			 
				if ( ! $wp_filesystem->put_contents( $file , $content , 0644 ) ) {
					return true;
				}
			
			}
			
		}
		
	}	
 
	add_filter('woocommerce_attribute_show_in_nav_menus', 'wc_reg_for_menus', 1, 2);
	function wc_reg_for_menus( $register, $name = '' ) {
		//if ( $name == 'pa_color' ) 
		$register = true;
		return $register;
	}
	/**
	 * Woocommerce custom  Size chart tab
	 *
	 **/
	require_once get_template_directory() . '/woocommerce/single-product/tabs/custom-wootab.php'; // woocommerce custom tabs
	

	
	/**
	 * RE-ARRANGE SHOP (CATALOG PAGE) LOOP HEADER
	 * - first remove actions, the re-activate them with different priority
	 * - add grid/list view buttons
	 */
	
	function as_woo_grid_list() {
		
		wp_register_script( 'cookies', get_template_directory_uri() . '/js/jquery.cookie.js');
		wp_enqueue_script( 'cookies', get_template_directory_uri() . '/js/jquery.cookie.js', array('jQuery'), '1.0', true );
		
		//ob_start();
		?>	
		
		<nav class="gridlist-toggle">
			<a href="#" id="grid" title="<?php _e('Grid view', 'showshop') ?>" class="icon-grid"></a>
			<a href="#" id="list" title="<?php _e('List view', 'showshop') ?>" class="icon-list"></a>
		</nav>

		<?php

	}
	// - REARRANGEMENTS:
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );
	add_action('woocommerce_before_shop_loop','as_woo_grid_list', 25);
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 30 );
	
	/**
	 *	DISABLED (to do in next versions):
	 *	custom text instead of "Add to cart"
	 
	add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' );                               // < 2.1
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
	 
	function woo_custom_cart_button_text() {
		return __( 'My Button Text', 'woocommerce' );
	}
	*/
	
	/**
	 *	DISABLED (to do in next versions):
	 *	REMOVE REVIEWS AND RATINGS (with tab, too)
	 *
	 
	add_filter( 'woocommerce_product_tabs', 'as_woo_remove_reviews_tab', 98);
	function as_woo_remove_reviews_tab($tabs) {
		unset($tabs['reviews']);
		return $tabs;
	}
	*/	
	
    /**
     * AS_SHOP_BUTTONS
     * echo shop action buttons - quick view, add to cart, wishlist
     * 
     * @param boolean $shop_quick  
     * @param boolean $shop_buy_action  
     * @param boolean $shop_wishlist  
     * 
     * @return <type>
     */
	function as_shop_buttons( $shop_quick = true, $shop_buy_action = true, $shop_wishlist = true ) {
		
		global $as_of, $as_wishlist_is_active;
		
		if( defined('WPML_ON') ) { // if WPML plugin is active
			$id			= icl_object_id( get_the_ID(), 'product', false, ICL_LANGUAGE_CODE ); 
			$lang_code	= ICL_LANGUAGE_CODE;
		}else{
			$id			= get_the_ID();
			$lang_code	= '';
		}
		
		if( is_shop() ){
			$buttons			= isset($as_of['catalog_buttons']) ? $as_of['catalog_buttons'] : null;
			$shop_quick			= $buttons['shop_quick'];
			$shop_buy_action	= $buttons['shop_buy_action'];
			$shop_wishlist		= $buttons['shop_wishlist'] && $as_wishlist_is_active;
		}
		
				
		
		echo '<div class="table"><div class="tablerow">';
		
		if( $shop_quick	 ) {
			echo '<div class="item-buttons-holder tablecell">';
				echo '<a href="#qv-holder" class="quick-view tip-top accent-1-light-45"   title="'.__('Quick view','showshop').' - '. the_title_attribute (array('echo' => 0)) .'" data-id="'.$id.'" data-lang="'. esc_attr($lang_code) .'" data-tooltip><span class="icon-eye"></span></a>'; // Quick view button
			echo '</div>'; // tablecell
			
			if ( !wp_script_is( 'wc-add-to-cart-variation', 'enqueued' )) {
			
				wp_register_script( 'wc-add-to-cart-variation', WP_PLUGIN_DIR . '/woocommerce/assets/frontend/add-to-cart-variation.min.js');
				wp_enqueue_script( 'wc-add-to-cart-variation' );
				
			}
		
		}
		
		if( $shop_buy_action ) {
			echo '<div class="item-buttons-holder tablecell">';
				do_action( 'woocommerce_after_shop_loop_item' ); // "Add to cart button
			echo '</div>'; // tablecell
		}
		
		if( $shop_wishlist ) {
			echo '<div class="item-buttons-holder tablecell">';
				do_action('as_wishlist_button'); // Wishlist button
			echo '</div>'; // tablecell
		}
		
		echo '</div></div>'; // .table.tablerow
		
	
	} // end shop_buttons()

	
    /**
     * AS_SHOP_TITLE_PRICE
     * echo product title (product categories) and price
     * 
     * @param boolean $shop_quick  
     * @param boolean $shop_buy_action  
     * @param boolean $shop_wishlist  
     * 
     * @return <type>
     */
	function as_shop_title_price( $shop_quick = true, $shop_buy_action = true, $shop_wishlist = true ){
		
		global $as_of, $as_wishlist_is_active, $product;
		
		$cats = $product->get_categories( ', ', '<span class="posted_in">', '</span>' );
				
		$prod_title = '<h4 class="prod-title"><a href="'. esc_attr(get_permalink()) .'" title="'. the_title_attribute (array('echo' => 0)).'"> ' . esc_html(get_the_title()) .'</a>'.$cats.'</h4>';
		
		if( is_shop() ){
			$buttons			= isset($as_of['catalog_buttons']) ? $as_of['catalog_buttons'] : null;
			$shop_quick			= $buttons['shop_quick'];
			$shop_buy_action	= $buttons['shop_buy_action'];
			$shop_wishlist		= $buttons['shop_wishlist'] && $as_wishlist_is_active;
		}
		
		$no_buttons =( !$shop_quick && !$shop_buy_action && !$shop_wishlist ) ?  true : false;
			
		$buttons = $no_buttons ? 'no-buttons' : '';
		echo '<div class="prod-title-price '. esc_attr($buttons) .'">';
							
		echo wp_kses_post( $prod_title );
		
		woocommerce_template_loop_price();
	
		echo '</div>';
	
	}
	
	
	
	// Add save percent next to sale item prices.
	add_filter( 'woocommerce_sale_price_html', 'as_woocommerce_custom_sales_price', 10, 2 );
	function as_woocommerce_custom_sales_price( $price, $product ) {
		$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
		return $price . sprintf( __(' Save %s', 'woocommerce' ), $percentage . '%' );
	}

	
	/* 
	add_filter( 'woocommerce_get_price_html', 'custom_price_html', 100, 2 );
	function custom_price_html( $price, $product ){
		global $post;
		$sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
		if(is_single() && $sales_price_to != "")
		{
			$sales_price_date_to = date("j M y", $sales_price_to);
	 
			return str_replace( '</ins>', ' </ins> <b>(Offer till '.$sales_price_date_to.')</b>', $price );
		}
		else
		{
			return apply_filters( 'woocommerce_get_price', $price );
		}
	}
	 */
} // end if $as_woo_is_active
?>