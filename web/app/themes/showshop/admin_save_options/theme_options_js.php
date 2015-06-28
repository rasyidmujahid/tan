<?php
if( !isset($_GET['activated'])) {
header("content-type: application/javascript");
};
global $as_of;
//
//
// THEME OPTIONS ADDITION
$smooth_wheelscroll		= isset($as_of['smooth_wheelscroll']) ? $as_of['smooth_wheelscroll'] : true;
$use_nice_scroll_menus	= isset($as_of['use_nice_scroll_menus']) ? $as_of['use_nice_scroll_menus'] : true;
$use_preloader			= $as_of['use_preloader'] ? true : false;
$demo_mode				= $as_of['demo_mode'];

$theme_js = "";
$theme_js .='
var $c = jQuery.noConflict();

$c(document).ready(function() {	
	
	
	var ajaxurl = "'. admin_url("admin-ajax.php") .'",
		theme_url = "'. get_template_directory_uri().'";

	var prettyPhotoMarkup = "<div class=\"pp_pic_holder\"> \
					<div class=\"ppt\">&nbsp;</div> \
					<div class=\"pp_top\"> \
						<div class=\"pp_left\"></div> \
						<div class=\"pp_middle\"></div> \
						<div class=\"pp_right\"></div> \
					</div> \
					<div class=\"pp_content_container\"> \
						<div class=\"pp_left\"> \
						<div class=\"pp_right\"> \
							<div class=\"pp_content\"> \
								<div class=\"pp_loaderIcon\"></div> \
								<div class=\"pp_fade\"> \
									<a href=\"#\" class=\"pp_expand\" title=\"Expand the image\"></a> \
									<div class=\"pp_hoverContainer\"> \
										<a class=\"pp_next\" href=\"#\"></a> \
										<a class=\"pp_previous\" href=\"#\"></a> \
									</div> \
									<div id=\"pp_full_res\"></div> \
									<div class=\"pp_details\"> \
										<div class=\"pp_nav\"> \
											<a href=\"#\" class=\"pp_arrow_previous\"></a> \
											<p class=\"currentTextHolder\">0/0</p> \
											<a href=\"#\" class=\"pp_arrow_next\"></a> \
										</div> \
										<p class=\"pp_description\"></p> \
										{pp_social} \
										<a class=\"pp_close\" href=\"#\"></a> \
									</div> \
								</div> \
							</div> \
							<div class=\"clearfix\"></div>\
						</div> \
						</div> \
					</div> \
					<div class=\"pp_bottom\"> \
						<div class=\"pp_left\"></div> \
						<div class=\"pp_middle\"></div> \
						<div class=\"pp_right\"></div> \
					</div> \
				</div> \
				<div class=\"pp_overlay\"></div>";
	
	/**
	 * AJAX - PRODUCT CATEGORIES
	 * 
	 */	
	
	$c(document).on("click", "a.ajax-products", function(e) {

		e.preventDefault();
		
		var aLink			= $c(this);
		var parentblock		= aLink.parent().parent().parent();
		var parentVars		= parentblock.find(".varsHolder");
		var block			= parentblock.find(".content-block");
		var cat_content		= block.find(".category-content");
		var cat_title		= block.find(".cat-title");
		var load_anim		= parentblock.find(".loading-animation");
		
		
		var t_ID			= aLink.attr("data-id");
		var taxonomy		= parentVars.attr("data-tax");
		var tax_name		= aLink.find(".box-title").text();
		var block_id		= parentVars.attr("data-block_id");
		var ptype			= parentVars.attr("data-ptype");
		var totitems		= parentVars.attr("data-totitems");
		var data_filters	= parentVars.attr("data-filters");
		var img				= parentVars.attr("data-img");
		var shop_quick		= parentVars.attr("data-shop_quick");
		var shop_buy_action	= parentVars.attr("data-shop_buy_action");
		var shop_wishlist	= parentVars.attr("data-shop_wishlist");
		var enter_anim		= parentVars.attr("data-enter_anim");
		var no_slider		= parentVars.attr("data-no_slider");
		//var zoom_button		= parentVars.attr("data-zoom");
		//var link_button		= parentVars.attr("data-link");
		//var hide_prod_info	= parentVars.attr("data-hide_prod_info");
		var smaller			= parentVars.attr("data-smaller");
		
		// START ACTION:
		
		// 1 - REMOVE ALL CLASSES "CURRENT" AND SHOW LOADING ANIMATION:
		$c("a.ajax-products").parent().removeClass("current"); // remove ALL "current" classes
		
		load_anim.slideDown(500);
		
		// 2 - HIDE THE CAT TITLE:		
		cat_title.delay(0).slideUp(
			500, 
			function() {
				
				$c(this).find(".wrap").html("<h3 class=\"ajax-category\">" + tax_name + "</h3>");
				
				block.stop(false,true).animate({opacity: 0.3 }, 500);
				
				$c(this).find(cat_content).empty();
				aLink.parent().addClass("current");
			}
		);
		
		
		$c.ajax({
			type: "POST",
			url: ajaxurl,
			data: {"action": "load-filter", block_id: block_id, termID: t_ID, tax: taxonomy, post_type: ptype, total_items: totitems, filters: data_filters,  img_format: img,  shop_quick: shop_quick,  shop_buy_action: shop_buy_action, shop_wishlist: shop_wishlist, enter_anim: enter_anim, no_slider: no_slider,  smaller: smaller },
			
			success: function(response) {

				load_anim.slideToggle(500);
					
				if(tax_name) {
					cat_title.slideDown(500);
					var del = 500;
				}else{
					var del = 0;
				}
								
				// BACK TO FULL OPACITY:
				
				block.stop().delay(del).animate({opacity: 1 }, 500);
				
				
				/*  SUPPORT FOR PLUGINS AND FUNCTIONS AFTER AJAX LOAD */
				
				// OWL CAROUSEL :
				if( cat_content.hasClass("contentslides") ) {
					 
					cat_content.owlCarousel("replace", response).owlCarousel("refresh");
				
				}else{
										
					cat_content.html($c.trim(response));
						
					block.stop().delay(300).animate({opacity: 1 }, 500);
					
					
				}
								
				
				// PRETTYPHOTO :
				$c("a[data-rel]").each(function() {
					$c(this).attr("rel", $c(this).data("rel"));
				});		
				$c("a[class^=\"prettyPhoto\"], a[rel^=\"prettyPhoto\"]").prettyPhoto(
					{	theme: "light_square",
						slideshow:5000, 
						social_tools: "",
						autoplay_slideshow:false,
						deeplinking: false,
						markup: prettyPhotoMarkup
					});
				
				
				if( enter_anim !== "none") {
					$c(document).anim_waypoints(block_id,enter_anim);
				}
				
				$c.waypoints("refresh");
				
				$c(document).foundation();
	
				return false;
				
			}, // end success
			error: function () {
				alert("Ajax fetching or transmitting data error");
			}
		});
			

	}); ';
/**
 *	AJAX - POSTS and PORTFOLIO CATEGORIES
 *
 */
 
$theme_js .= '
	$c(document).on("click", "a.ajax-posts", function(e) {

		e.preventDefault();
		
		var aLink			= $c(this);
		var parentblock		= aLink.parent().parent().parent();
		var parentVars		= parentblock.find(".varsHolder");
		var block			= parentblock.find(".content-block");
		var cat_content		= block.find(".category-content");
		var cat_title		= block.find(".cat-title");
		var load_anim		= parentblock.find(".loading-animation");
		
		var t_ID			= aLink.attr("data-id");
		var taxonomy		= parentVars.attr("data-tax");
		var tax_name		= aLink.find(".term").text();
		var block_id		= parentVars.attr("data-block_id");
		var ptype			= parentVars.attr("data-ptype");
		var totitems		= parentVars.attr("data-totitems");
		var feat			= parentVars.attr("data-feat");
		var img				= parentVars.attr("data-img");
		var custom_img_w	= parentVars.attr("data-custom-img-w");
		var custom_img_h	= parentVars.attr("data-custom-img-h");
		var icons			= parentVars.attr("data-icons");
		var taxmenu_style	= parentVars.attr("data-taxmenustlye");
		var enter_anim		= parentVars.attr("data-enter_anim");
		var no_slider		= parentVars.attr("data-no_slider");
		var zoom_button		= parentVars.attr("data-zoom");
		var link_button		= parentVars.attr("data-link");
		var offset			= parentVars.attr("data-offset");
		var no_post_thumb	= parentVars.attr("data-no_post_thumb");
		
		
		// START ACTION:
		
		// 1 - remove all classes "current":
		$c("a.ajax-posts").parent().removeClass("current"); // remove all "current" classes
		
		load_anim.slideToggle(500);
		// 2 - HIDE THE CAT TITLE:		
		cat_title.delay(0).slideUp(
			500, 
			function() {
				
				$c(this).find(".wrap").html("<h3 class=\"ajax-category\">" + tax_name + "</h3>");
				
				block.stop(false,true).animate({opacity: 0.3 }, 500);
				
				$c(this).find(cat_content).empty();
				aLink.parent().addClass("current");
			}
		);
		
		$c.ajax({
				type: "POST",
				url: ajaxurl,
				data: {"action": "load-filter2", termID: t_ID, tax: taxonomy, post_type: ptype, total_items: totitems, only_featured: feat,  img_format: img, custom_image_width: custom_img_w , custom_image_height: custom_img_h, display_icons: icons, tax_menu_style: taxmenu_style, block_id: block_id, enter_anim: enter_anim, no_slider: no_slider, zoom_button: zoom_button, link_button: link_button, offset: offset, no_post_thumb: no_post_thumb  },
				success: function(response) {


					load_anim.slideToggle(300);
					
					if(tax_name) {
						cat_title.slideDown(300);
						var del = 300;
					}else{
						var del = 0;
					}
									
					// BACK TO FULL OPACITY:
					block.css("opacity",0);
					
						
					
					/*  SUPPORT FOR PLUGINS AND FUNCTIONS AFTER AJAX LOAD */
					
					// OWL CAROUSEL :
					if( cat_content.hasClass("contentslides") ) {
						 
						cat_content.owlCarousel("replace", response).owlCarousel("refresh");
						
					}else{
						
						cat_content.html($c.trim(response));
						
						block.stop().delay(300).animate({opacity: 1 }, 500);

						
					}	
					
					
					// PRETTYPHOTO :
					$c("a[data-rel]").each(function() {
						$c(this).attr("rel", $c(this).data("rel"));
					});		
					$c("a[class^=\"prettyPhoto\"], a[rel^=\"prettyPhoto\"]").prettyPhoto(
						{	theme: "light_square",
							slideshow:5000, 
							social_tools: "",
							autoplay_slideshow:false,
							deeplinking: false,
							markup: prettyPhotoMarkup,
							ajaxcallback: function(){
								$c("video,audio").mediaelementplayer();
							}
						});
					
					
					/**
					 *	POST META and NAV TOGGLER: 
					 *
					 */
						
					$c(".post-meta-bottom .date_meta, .post-meta-bottom .user_meta, .post-meta-bottom .permalink, .post-meta-bottom .cat_meta ,.post-meta-bottom .tag_meta, .post-meta-bottom .comments_meta, .nav-single a").hover(function() {
							
							var parent = $c(this).parent();
							var hoverBox = $c(this).find(".hover-box");
							var leftPos = - ( hoverBox.outerWidth(true)/2 - $c(this).outerWidth(true)/2 );
							
							if( $c(this).hasClass("left") || parent.hasClass("left") ) {
								hoverBox.css("left", 0);
							}else if( $c(this).hasClass("right") || parent.hasClass("right") ) {
								hoverBox.css("left", "auto").css("right", 0);
							}else{
								hoverBox.css("left", leftPos);
							}
							
							hoverBox.fadeToggle(400);
						},
						function () {
							var hoverBox = $c(this).find(".hover-box");

							hoverBox.fadeToggle(150);
						}
					
					);
					
					if( enter_anim !== "none") {
						$c(document).anim_waypoints_posts(block_id, enter_anim);
					}
					
					$c.waypoints("refresh");
					
					$c(document).foundation();
					
					return false;
					
				}, // end success
				error: function () {
					alert("Ajax fetching or transmitting data error");
				}
			});
			
			
			
	});
	
	$c(document).on("click", "a.quick-view", function(e) {

		e.preventDefault();
		
		$c("body").append("<div class=\"qv-overlay\"><div class=\"qv-holder woocommerce\" id=\"qv-holder\"><div class=\"loading-animation\">"+ wplocalize_options.loading_qb + "</div></div></div>");
		
		var aLink		= $c(this);
		var	prod_ID		= aLink.attr("data-id");
		var	lang		= aLink.attr("data-lang");
		var	qv_holder	= $c("#qv-holder");
		var qv_overlay	= $c(".qv-overlay");
		var	images		= qv_holder.find(".images");
		var load_anim	= qv_holder.find(".loading-animation");
		
		qv_overlay.fadeIn();
		
		qv_holder.fadeIn();
		
		// REMOVING ACTIONS:
		qv_holder.parent().on("click", function(e) {
			if(e.target == this) $c(this).fadeOut("slow", function() { this.remove(); });
		});
		
		$c.ajax({
		
			type: "POST",
			url: ajaxurl,
			data: { "action": "load-filter3", productID: prod_ID, lang: lang  },
			success: function(response) {
				
				load_anim.fadeToggle(500);
				
				// fill with response from server:
				qv_holder.html(response);
				
				
				// add QV window remover:
				qv_holder.append("<div class=\"message-remove\"></div>");
						
				// REMOVING ACTIONS:
				qv_holder.find(".message-remove").on("click", function(e) {
					qv_overlay.fadeOut("slow", function() { qv_overlay.remove(); });
				});
				
			}, // end success
			error: function () {
				alert("Ajax fetching or transmitting data error");
			}
		});

	});

	/**
	 *	MINI WISHLIST
	 *
	 */	
	$c(document).on("click", "a.add_to_wishlist", function(e) {
		
		var	prod_ID		= $c(this).attr("data-product-id");
		
		$c.ajax({
		
			type: "POST",
			url: ajaxurl,
			data: { "action": "add_miniwishlist", productID: prod_ID },
			success: function(response) {
				
				var miniWishlist	= $c(".mini-wishlist")
					productExists 	= miniWishlist.find("a.quick-view").data("id");
				
					if( productExists == prod_ID ) return;
				
					miniWishlist.find(".wishlist-empty").remove();
					miniWishlist.append( response );
			}
		})
	
	});
	
	
	
	/**
	 *	INFINITE LOAD:
	 *
	 */
	
	var element	= $c("section.infinite-posts");
	
	if( element.length ) {
	
		$c( window ).scroll(function() {
			
			checkScroll( element );
		
		});

		
		var loading	= false;
		function checkScroll (element){
			
			var	elementOffset	= element.offset().top,
				elementHeight	= element.height(),
				elementEnd		= elementOffset + elementHeight;
					
			if($c(window).scrollTop() + $c(window).height()  > elementEnd ) {			
				
				if(loading) return true;
				
				element.append("<div class=\"inf-loading-animation\"></div>");
				
				if(!loading) {
					loading=1;
					var params = {"offset":post_offset,"action":"add_posts"}
					$c.post( ajaxurl , params, function(data){
						
						$c(".inf-loading-animation").fadeOut();
						
						if(data){
							
							post_offset += increment ;

							loading=0;
							element.append(data);
													
							$c.waypoints("refresh");
						}

					});//now load more content
			
				}	
			}
		}	
	}
	

/**
 * end AJAX
 *
 */
';

if( $use_nice_scroll_menus ) {

	$theme_js .= '
	/**
	 *	NICESCROLL (FOR SIDE MENU and MEGA MENUS) - smooth page and elements scrolling
	 */

		if( $c.fn.niceScroll && !window.isMobile ) {
			$c("#site-menu.vertical, .vertical-mega").niceScroll({
				horizrailenabled	: false,
				cursorwidth			: 5,
				cursoropacitymax	: 0.7,
				hidecursordelay		: 5
			});
		}
	';

}
if( $smooth_wheelscroll ) {
	
	$theme_js .= '
	if( !window.isMobile ) {
		$c("body").smoothScroll();
	}
	';
	
}
 
if( $use_preloader ) {
	
	$theme_js .='
	/**
	 *	PAGE PRELOADER:
	 *
	 */
	
	$c(window).load(function(){

	  $c("#loader-back").fadeOut(500);
	  
	  var linkLocation = "";
		
		$c("a").click(function(event){
			
			var newPage = false;
			if( ! /#/.test(this.href) ) {
				newPage = true;
			}
			
			if( $c(this).hasAnyClass("product_type_simple item-zoom zoom add_to_wishlist button remove chosen-single") ||  /_blank/.test(this.target) ) {
				newPage = false;
			}
			
			if( newPage ) {
				event.preventDefault();
				linkLocation = $c(this).attr("href");
				$c("#loader-back").fadeIn(500, redirectPage);    
			}
	   });
			 
		function redirectPage() {
			
			window.location = linkLocation;
		}
	  
	});
	';
}

if( $demo_mode ) {
	
	$theme_js .= '
	
	$c(document).on("click", "#options>div a", function(e) {
		
		e.preventDefault();
		
		var skin_to_load = $c(this).attr("id");
		
		$c.ajax({
			
			type: "POST",
			url: ajaxurl,
			data: {skin_to_load: skin_to_load },
			success: function(response) {
				
				$c("head").find("link#demo-skin").remove();
				$c("head").find("link#google-font-demo-headings").remove();
				$c("head").find("link#google-font-demo-body").remove();
				
				$c("head").append("<link rel=\"stylesheet\" href=\""+ theme_url + "/admin/layouts/" + skin_to_load + ".css\" id=\"demo-skin\">");
				
				var fontHead = "", fontBody = "" ;
				if( skin_to_load == "skin_01" ) {
					fontBody = "Raleway";
					fontHead = "Raleway";
				}else if ( skin_to_load == "skin_02" ){
					fontBody = "Muli";
					fontHead = "Playfair+Display";
				}else if ( skin_to_load == "skin_03" ){
					fontBody = "Montserrat+Alternates";
					fontHead = "Quicksand";
				}else if ( skin_to_load == "skin_04" ){
					fontBody = "Lato";
					fontHead = "Montserrat";
				}else if ( skin_to_load == "skin_05" ){
					fontBody = "Open+Sans";
					fontHead = "Open+Sans";
				}else if ( skin_to_load == "skin_06" ){
					fontBody = "Josefin+Sans";
					fontHead = "Lobster";
				}else if ( skin_to_load == "skin_07" ){
					fontBody = "Arvo";
					fontHead = "Abril+Fatface";
				}else if ( skin_to_load == "skin_08" ){
					fontBody = "Ek+Mukta";
					fontHead = "Fjalla+One";
				}else if ( skin_to_load == "skin_09" ){
					fontBody = "Federo";
					fontHead = "Old+Standard+TT";
				}else if ( skin_to_load == "skin_10" ){
					fontBody = "Tienne";
					fontHead = "Rufina";
				}
				
				
				if( fontHead !="" && fontBody != "" ) {
					$c("head").append("<link href=\"http://fonts.googleapis.com/css?family=" + fontHead + ":300,400,600,700,800,400italic,700italic&subset=latin,latin-ext\" rel=\"stylesheet\" type=\"text/css\" id=\"google-font-demo-headings\">");
				
					$c("head").append("<link href=\"http://fonts.googleapis.com/css?family=" + fontBody + ":300,400,600,700,800,400italic,700italic&subset=latin,latin-ext\" rel=\"stylesheet\" type=\"text/css\" id=\"google-font-demo-body\">");
				}else{
					
					$c("head").find("link#google-font-demo-headings").remove();
					$c("head").find("link#google-font-demo-body").remove();
				
				}
				

				$c(document).trigger("resize");
				
				$c(".shuffle").shuffle("update");
				
			}
			
		});
		
	});
	';
}


$theme_js .=' }) // end (document).ready; ';

echo wp_kses_decode_entities( $theme_js );
?>