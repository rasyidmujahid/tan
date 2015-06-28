(function() {
"use strict";
/**
 * CUSTOM AS PLUGIN: hasAnyClass
 * 
 */
(function( $ ){
	$.fn.hasAnyClass = function() {
		for (var i = 0; i < arguments.length; i++) {
			var classes = arguments[i].split(" ");
			for (var j = 0; j < classes.length; j++) {
				if (this.hasClass(classes[j])) {
					return true;
				}
			}
		}
		return false;
	}
})( jQuery );
//
/**
 * CUSTOM AS PLUGIN: equalizeHeights
 * 
 */
(function( $ ){
	$.fn.equalizeHeights = function() {
		
	  var maxHeight = this.map(function(i,e) {
		return $(e).height();
	  }).get();
	  
	  return this.height( Math.max.apply(this, maxHeight) );
	};
})( jQuery );


/**
 *	CUSTOM AS PLUGIN: eqHeights
 *
 */
(function( $ ) {
$.fn.extend({
equalHeights: function(){
    var top=0;
    var classname=('equalHeights'+Math.random()).replace('.','');
    $(this).each(function(){
      if ($(this).is(':visible')){
        var thistop=$(this).offset().top;
        if (thistop>top) {
            $('.'+classname).removeClass(classname); 
            top=thistop;
        }
        $(this).addClass(classname);
        $(this).height('auto');
        var h=(Math.max.apply(null, $('.'+classname).map(function(){ return $(this).outerHeight(); }).get()));
        $('.'+classname).height(h);
      }
    }).removeClass(classname); 
}       

});
})( jQuery );
//
//
//
//
/*********************************************************
 *	AS FUNCTION AND PLUGIN CALLS
 *
 ********************************************************/
var $j = jQuery.noConflict();
$j(document).ready(function() {
	
	/***************************************
	 *
	 *	DO THE FOUNDATION SCRIPTS:	
	 *
	 *************************************/
	$j(document).foundation();
	/* 
	
	if( window.isMobile ) { $j('body, #site-menu.vertical, .mega-clone').css('overflow','auto'); }
	
	// SMALL HELPER FUNCTIONS - used for SIMPLE STICKY HEADER:
	function getPageScroll() {
		var xScroll, yScroll;
		if (self.pageYOffset) {
			yScroll = self.pageYOffset;
			xScroll = self.pageXOffset;
		} else if (document.documentElement && document.documentElement.scrollTop) {
			yScroll = document.documentElement.scrollTop;
			xScroll = document.documentElement.scrollLeft;
		} else if (document.body) {// all other Explorers
			yScroll = document.body.scrollTop;
			xScroll = document.body.scrollLeft;
		}
		return new Array(xScroll,yScroll)
	}
	// Adapted from getPageSize() by quirksmode.com
	function getPageHeight() {
		var windowHeight
		if (self.innerHeight) { // all except Explorer
			windowHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) {
			windowHeight = document.documentElement.clientHeight;
		} else if (document.body) { // other Explorers
			windowHeight = document.body.clientHeight;
		}
		return windowHeight
	} */

/**
 *	INTERNET EXPLORERS "SNIFFER":
 *
*/
	var ua = navigator.userAgent,
		isIE11	= ua.match(/Trident\/7\./), //  is Internet Explorer 11
		isIE10	= /MSIE 10.0/.test(ua), //  is Internet Explorer 10
		isIE9	= /MSIE 9.0/.test(ua), //  is Internet Explorer 9
		isMobWebkit = /WebKit/.test(ua) && /Mobile/.test(ua); //  is iPad / iPhone
	
	if( isIE9 ) {
		$j('html').addClass('ie9');
	}else if( isIE10 ) {
		$j('html').addClass('ie10');
	}else if( isIE11 ) {
		$j('html').addClass('ie11');
	}
 

/**	
 *	REMOVE CLASS TO ANIM FOR MOBILE DEVICES
 * 	no viewport entering animation
 *
 */	
	if( window.isMobile ) {
		$j('.to-anim').removeClass('to-anim');
	
	}
	
	
/**	
 *	REMOVE EMPTY <P> TAGS FROM CONTENT .
 *
 */
	$j('p').filter(function() {
		
		return $j.trim($j(this).text()) === '' && $j(this).children().length === 0;
		
	})
	.remove();
	
	
/**
 *	MENUS (main, secondary, and block categories menus)
 *
 */

	 
	$j('.product-categories, .widget_nav_menu ul').superfish({
		autoArrows		: false, 
		animation		: { opacity:'show', height:'show' },
		cssArrows		: false,
		delay			: 0
	});	
	 
/**
 *	TOGGLING MENUS (TAXONOMIES AND MOBILE MENU)
 *
 */

	$j('.menu-toggler a').click(function(e) {
		e.preventDefault();

		var main = $j(this).parent().parent();
			
		main.find('.mobile-dropdown, .tax-dropdown, #secondary-nav').toggleClass("active");
		
		return false;
		
	});
	
	$j('.mobile-dropdown').find('.navigation > li.menu-item-has-children').hover(function(e) {
		
		e.preventDefault();
		
		$j(this).find('> .sub-menu').slideToggle();		
	});
	
	

/**
 *	PRODUCT FILTERS WIDGET TOGGLE.
 *
*/ 
	var prod_filters = false
	$j('.product-filters-title, .product-filters .icon').click(function() {

		var filters		= $j(this).parent().find('.product-filters');
		if( $j(this).hasClass('icon') ) {
			filters		= $j(this).parent().parent().find('.product-filters');
		}
		
		if ( prod_filters == false ) {
			
			filters.slideDown( 300, 'easeInOutQuart', function() { 
				prod_filters = true; 
				$j('.product-filters .icon').fadeIn(300);

			} );
			
		}else{
		
			$j('.product-filters .icon').fadeOut(300);
			
			filters.slideUp( 300, 'easeInOutQuart', function() { 
				prod_filters = false; 

			} );
			
		}	
		
	});
		
/**
 *	ADD BUTTON CLASS TO:
*/ 
	$j('#comments').find('input#submit').addClass('button');
	$j('ul.page-numbers').find('a.page-numbers, span.page-numbers').addClass('button');
	$j('.page-link').find('span').addClass('button');
	$j('.tagcloud').find('a').addClass('button');
	$j('input[type="submit"], input[type="reset"], input[type="button"]').addClass('button');
	
	$j('.btn').addClass('button');
	$j('.clear-all').addClass('button');
	

	
/**
 *	POST META and NAV TOGGLER: 
 *
 */ 
	
	$j('.post-meta-bottom .date_meta, .post-meta-bottom .user_meta, .post-meta-bottom .permalink, .post-meta-bottom .cat_meta ,.post-meta-bottom .tag_meta, .post-meta-bottom .comments_meta, .nav-single a, .wishlist-compare > div').hover(function() {
			
			var parent = $j(this).parent();
			var hoverBox = $j(this).find('.hover-box');
			var leftPos = - ( hoverBox.outerWidth(true)/2 - $j(this).outerWidth(true)/2 );
			
			if( $j(this).hasClass('left') || parent.hasClass('left') ) {
				hoverBox.css('left', 30);
			}else if( $j(this).hasClass('right') || parent.hasClass('right') ) {
				hoverBox.css('left', 'auto').css('right', 30);
			}else{
				hoverBox.css('left', leftPos);
			}
			
			hoverBox.fadeToggle(400);
		},
		function () {
			var hoverBox = $j(this).find('.hover-box');

			hoverBox.fadeToggle(150);
		}
	
	);
	
	/** END POST META*/


/**
 *	SIDEBAR WIDGETS - if full page AND
 *
 */
	var numW = 0;
	$j('#secondary > .widget').each(function() {
		if ( numW === 0 || numW - 3 === 0 ) {
			$j(this).addClass("first");
			numW = 0;
        } 
		numW++;
	});
	 
/**
 *	FOOTER WIDGETS - add scaffolding css depending on widgets number
 *
*/ 
	var footerWidgets = $j('#footerwidgets').find('.row').children();
	var fwNum = footerWidgets.length;
	footerWidgets.each(function() {
		var grid = Math.floor(12/fwNum);
		
		$j(this).addClass('large-'+ grid).addClass('medium-'+ grid).addClass('small-12').addClass('column');
	});
	
/**
 *	HEADER IMAGES FIXES:
 *
 */ 
	
	if( window.isMobile ) {
		$j('.header-background').addClass('no-cover-ipad');
	}
	
	function headerImgTop() {
	
		var imgHeader		= $j('.horizontal').find('.header-background'),
			headelements	= $j('.head-element'),
			siteHeaderHeight= 0;
			
		if( !imgHeader.hasClass('under-head') )
			return;
		
		headelements.each(function() {
			siteHeaderHeight += $j(this).outerHeight(true);
		});
		
		
		var	imgHeadHeight	= $j('.page-header, .archive-header').outerHeight(true);
			
		if ( $j.browser.mozilla ) {
			imgHeader.css( 'top', - siteHeaderHeight ).css('height', siteHeaderHeight + imgHeadHeight );
		
		}else{
			imgHeader.css( 'margin-top', - siteHeaderHeight ).css('height', siteHeaderHeight + imgHeadHeight );
		}
	
	}
	headerImgTop();
	
	
	function pageUnderHead() {
	
		var page		= $j('.horizontal-layout').find('#page'),
			headelements= $j('.head-element'),
			pagetitle	= $j('.horizontal-layout').find('header').find('.titles-holder'),
			pageShift	= 0 ;
			
		
		if( !page.hasClass('page-under-head') )
			return;
			
		headelements.each(function() {
			pageShift += $j(this).outerHeight(true);
		});
				
		pagetitle.css('margin-top',pageShift);	
		
		if ( $j.browser.mozilla ) {

			page.css( 'top', - pageShift );
			//$j('footer').css('top', - pageShift).css('margin-bottom', - pageShift);
		
		}else{
			page.css( 'top', - pageShift ).css( 'margin-top', - pageShift ).css('margin-bottom', - pageShift);
		}
	
	}
	pageUnderHead();
	
	
	$j(window).resize(function() {
		headerImgTop();
		pageUnderHead();
	});
	

/**
 *	TOPBAR INFO / SOCIAL
 *
 */
	
	$j('.topbar-info-item').hover(function() {
		if( $j(this).find('.icon').hasClass('toggle') ) {
			$j(this).find('.title').stop().show( "blind" );

		}
	},function() {
		if( $j(this).find('.icon').hasClass('toggle') ) {
			$j(this).find('.title').stop().hide( "blind" );

		}
	});

/**
 *	BEGIN ON WINDOW LOAD 
 *
 */	
	
	$j(window).load(function(){
		
		
		
/**
 *	BANNER ANIMATE COLOR (transitions in css)
 *
 */ 
	
	$j('.banner-block, .category-image, .product-categories > .item').each(function () {
	
		if( $j(this).hasClass('disable-invert') ) {
		
			return;
			
		}else{
			// from block settings:
			var fontSet	= $j(this).find('.varsHolder').attr('data-fontColor'),
				boxSet	= $j(this).find('.varsHolder').attr('data-boxColor');
			
			// define all inner elements:
			var box			= $j(this).find('.item-overlay'),
				title		= $j(this).find('.box-title'),
				text		= $j(this).find('.text'),
				subtitle	= $j(this).find('.block-subtitle');
				
			// get elem. default vaules:
			var boxDef		= box.css('background-color'),
				titleDef	= title.css('color'),
				textDef		= text.css('color'),
				subtitleDef = subtitle.css('color');
			//invert values on hover:
			$j(this).hover(
				function (){
					
					fontSet ? box.css('background-color', fontSet) : box.css('background-color', titleDef);
					boxSet ? title.css('color', boxSet) : title.css('color', boxDef);
					boxSet ? text.css('color', boxSet) : text.css('color', boxDef);
					boxSet ? subtitle.css('color', boxSet) : subtitle.css('color', boxDef);
				},
				function () {
					
					boxSet ? box.css('background-color', boxSet) : box.css('background-color', boxDef);
					fontSet ? title.css('color', fontSet) : title.css('color', titleDef);			
					fontSet ? text.css('color', fontSet) : text.css('color', textDef);			
					fontSet ? subtitle.css('color', fontSet) : subtitle.css('color',subtitleDef);			
				}
			);
		
		} // end if
	
	});
	
	function inverter( element ) {
		
	}
	
	
/**
 *	PRETTYPHOTO
 *
 */
		
	$j('#review_form_wrapper').hide();
		
		
		$j('a[data-rel]').each(function() {
			$j(this).attr('rel', $j(this).data('rel'));
		});		
		$j('a[rel^="prettyPhoto"]').prettyPhoto(
			{	theme: 'light_square',
				slideshow:			5000, 
				social_tools:		false,
				autoplay_slideshow:	false,
				show_title:			false,
				deeplinking:		false,
				markup: 			'<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image"></a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#"></a> \
											<a class="pp_previous" href="#"></a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous"></a> \
												<p class="currentTextHolder">0/0</p> \
												<a href="#" class="pp_arrow_next"></a> \
											</div> \
											<p class="pp_description"></p> \
											{pp_social} \
											<a class="pp_close" href="#"></a> \
										</div> \
									</div> \
								</div> \
								<div class="clearfix"></div>\
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
					ajaxcallback: function(){
						if( $j("video,audio").length ) {
							$j("video,audio").mediaelementplayer();
						}
					}
			});
			
/** END PRETTYPHOTO */



/**
 *	STICKY ONEPAGER MENU
 *		
**/		
		
/* 		
	$j('.sticky-block').waypoint('sticky', { 
		stuckClass: 'stuck', 
		offset: 1,
		handler:	function(){
			var stickyBlock		= $j('.sticky-block'),
				stickHeader		= $j('.stick-it-header'),
				stickHeadHeight = stickHeader.outerHeight(true),
				wpadminbarH		= $j('#wpadminbar').outerHeight(true);
			
				stickyBlock.css('top', stickHeadHeight + wpadminbarH );
			}
	});


	function correctStickyWidth() {
	
		var stickyBlock = $j('.sticky-block');
		stickyBlock.width( stickyBlock.parent().width() );
		
		stickyBlock.parent().closest('.aq-block').css('z-index', '10');
		
	}
	
	function correctStickyTop() { // same function as handler in waypoint 
	
		var stickyBlock		= $j('.sticky-block'),
			stickHeader		= $j('.stick-it-header'),
			stickHeadHeight = stickHeader.outerHeight(true),
			wpadminbarH		= $j('#wpadminbar').outerHeight(true);
		
		stickyBlock.css('top', stickHeadHeight + wpadminbarH );
	}
	
	$j( window ).resize( function () {
		correctStickyWidth();
		correctStickyTop();
	});
	
	correctStickyWidth();	
	correctStickyTop();
	 */
/**
 *	SIMPLE STICKY HEADER
 *		
 **/
	function stickyHeadElements( nav, logo_title ) {

		if( nav.length && logo_title.length ) {
		
			// jQuery version
			var scrollTop     	= $j(window).scrollTop(),
				elementOffset 	= logo_title.offset().top,
				distance		= (elementOffset - scrollTop),
				header			= nav.closest('#site-menu');
			
			// pure JS - getPageScroll()
			var height 	= logo_title.height(),
				shift	=  parseInt( getPageScroll()[1]);
					
			//if( logo_title.offset().top + height < shift ) {
			if( distance + height < 0 ) {
				
				
				$j('.mega-clone, .sub-clone' ).fadeOut(10);

				 
				if( nav.parent().hasClass('stick-it-header') ) // if already STICKED - STOP
					return;
				
				header.addClass('sticked');
				
				nav.wrapAll( "<div class='stick-it-header' />");

				// CLONE AND APPEND LOGO AND MINICART :
				logo_title.find('a.home-link').clone().appendTo('.stick-it-header');
							
				$j('.wrap-mini-cart').clone().appendTo('.stick-it-header');
				
				$j('.mini-cart-list').slideUp( 300, 'easeInOutQuart', function() { 
					minicart_active = false; 
				} );
				
			
			}else{
				if( !nav.parent().hasClass('stick-it-header') )
					return;
				header.removeClass('sticked');
				nav.unwrap();
				nav.parent().find('a.home-link').remove();
				nav.parent().find('.wrap-mini-cart').remove();
			}
		
		}
	
	}
	$j( window ).scroll(function() {
		stickyHeadElements( $j('.to-stick' ), $j('#site-title') );
	});
	$j( window ).load(function() {
		stickyHeadElements( $j('.to-stick' ), $j('#site-title') );
	});	

	

	
	
/**
 *	SHUFFLE PLUGIN initiate and setup filters.
 *
 */
	$j('.shuffle-filter-holder, .wc-catalog-page, .wpb_wrapper').each( function () {
		
		var filterBlock = $j(this);
		
		var $grid			= filterBlock.find('.shuffle'),
			$sizer			= $grid.find('.item'),
			$filterOptions	= filterBlock.find('ul.tax-filters');
		
		
		if( !$grid.length )
			return;
		
		$grid.shuffle({
			group: 'all',
			itemSelector: '.item',
			sizer: null,
			throttle: $j.throttle,
			speed: 450, 
			easing: 'ease-out'
		});
		
		function setupFilters() {
			
			var $btns = $filterOptions.children();
			
			$btns.find('a').on('click', function(event) {
				
				event.preventDefault();
				
				var $this = $j(this),
					isActive = $this.hasClass( 'active' ),
					group = isActive ? 'all' : $this.data('group');

				// Hide current label, show current label in title
				if ( isActive ) {
					$j('ul.tax-filters a.active').removeClass('active');
				}

				$this.addClass('active');

				// Filter elements
				$grid.shuffle( 'shuffle', group );
			
			});

			$btns = null;	
			
		}
		setupFilters();
		
		function setupSorting() {
			// Sorting options
			filterBlock.find('.sort-options').on('change', function() {
				var sort = this.value,
					opts = {};

				// We're given the element wrapped in jQuery
				if ( sort === 'date-created' ) {
					opts = {
					  reverse: true,
					  by: function($el) {
						return $el.data('date-created');
					  }
					};
				}else if ( sort === 'title' ){
					opts = {
						by: function($el) {
						return $el.data('title').toLowerCase();
						}
					};
				}

				// Sort elements
				$grid.shuffle('sort', opts);
			});
		}
		
		setupSorting();
		
		$grid.on('layout.shuffle', function() {
			$j.waypoints('refresh');
		});
		
	});
/** end Shuffle plugin setup */
	
	
});// ||||||||||||||| 	END ON WINDOW LOAD

// continue on document ready:



/**
 *	MEGA MENU and REGULAR MENU SYSTEM
 *
 */	
	//#######  1. REMOVE MEGA MENU FOR MOBILE DEVICES ( displays as regular submenu )#######
	 
	$j('.mobile-dropdown').find('.sub-menu').removeClass('as-megamenu').css('display','none');
	$j('.mobile-dropdown').find('.mega-parent').removeClass('mega-parent');
	//
	//#######  2a CLONE SUBMENUS WITH CLASS as-megamenu #######
	//
	var $megaID = 0;
	$j('.as-megamenu').each(function () {
		
		$megaID ++;
		
		var header			= $j(this).closest('#site-menu'),
			parentOfMenu	= $j(this).closest('.row'),
			customMenu		= $j(this).closest('.custom-menu'); //++
		
		
		if( header.hasClass('vertical')  || customMenu.hasClass('vertical')) { //++
			$j(this).clone().addClass('mega-clone')
							.addClass('vertical-mega')
							.removeClass('sub-menu')
							.attr('id','mega-'+$megaID)
							.appendTo( 'body' );
		}else if( header.hasClass('horizontal') ){
			$j(this).clone().addClass('mega-clone')
							.addClass('horizontal-mega')
							.removeClass('sub-menu')
							.attr('id','mega-'+$megaID)
							.appendTo( parentOfMenu );
		}
		
		//verticalMega_Position();
		
		$j(this).parent().find('a.dropdown').attr('data-megaid', 'mega-'+$megaID);
		
		$j('.mega-clone').css('display','none');
		
	});
	//
	//####### 2b - CLONE REGULAR SUBMENUS: #######
	//
	var $subCloneID = 0;
	$j('.navigation > li > .sub-menu').each(function () {	
		
		if( $j(this).closest('.navigation').hasClass('secondary') ) // don't clone secondary menu
			return;
		
		$subCloneID ++;
		
		var header		= $j(this).closest('#site-menu'),
			parentOfMenu	= $j(this).closest('.row'),
			thisParent	= $j(this).parent(),
			customMenu	= $j(this).closest('.custom-menu');;
		
		if( thisParent.hasClass('mega-parent') || header.hasClass('header-template-simple') )
			return;
			
		if( header.hasClass('vertical') || customMenu.hasClass('vertical') ) {
			
			$j(this).clone().addClass('sub-clone')
							.addClass('vertical-sub')
							.attr('id','sub-'+$subCloneID)
							.removeClass('sub-menu')
							.appendTo( 'body' );
							
		}else if( header.hasClass('horizontal') ) {
			
			$j(this).clone().addClass('sub-clone')
							.addClass('horizontal-sub')
							.attr('id','sub-'+$subCloneID)
							.removeClass('sub-menu')
							.appendTo( parentOfMenu );
							
		}
		
		$j(this).parent().find('a.dropdown').attr('data-subid', 'sub-'+$subCloneID);
		
		$j('.sub-clone').css('display','none');
		
		
	});
	

	
	
	//####### 3 - MAKE SUBS AND/OR MEGA VISIBLE:#######

	
	$j('ul.navigation > .menu-item-has-children > a, .custom-menu  ul.navigation > .menu-item-has-children > a').mouseenter(

		function(e) {
		
			var $this 	= $j(this), // <--- MAIN TRIGGER - THE MENU LINK ELEMENT WITH CHILDREN
				$is_custom_menu = $this.parent().parent().hasClass('custom-nav') ? true : false; // <--- IF TRIGGER IS IN CUSTOM MENU
			
			if( $is_custom_menu && $j(document).width() <= 768 )
				return;				
						
			if( $this.closest('.navigation').hasClass('secondary') )
				return;
			
			// FIX FOR MEGA PARENT OFFSET TOP:
			var adminbar	= $j('#wpadminbar').height(), // if there's admin bar, add this to fix
				offsetTop	=  $this.offset().top;
			
			if( $j('#site-menu').legnth ) {
				
				var offsetFix = ''; 
				if( $is_custom_menu ) {
					offsetFix = adminbar;
				}else{
					offsetFix =  $j('#site-menu').offset().top - ($this.outerHeight(true)/2 + adminbar);
				}
				
			}
			
			
			// HORIZONTAL SUB/MEGA POSITION
			if( $j('.mega-clone').length || $j('.sub-clone').length ) {
				horiz_megaPosition( $this );
			}
		
			e.preventDefault();
			e.stopPropagation();
			
			// RESET (HIDE) ANY SUB OR MEGA, FIRST:
			$j(' .mega-clone, .sub-clone').css('display','none');
			
			
			// get ID's to show proper sub / mega
			var mega_elm = $j( '#' + $this.attr('data-megaid') );
			var sub_elm = $j( '#' + $this.attr('data-subid') );
			
			
			// VERTICAL POS. OF REGULAR SUB-MENU
			if( sub_elm.hasClass('vertical-sub') ) {
				var offsetSub = offsetFix + ( sub_elm.outerHeight(true) /2 );
				sub_elm.css('top', $this.offset().top - offsetSub );
			}
			
			// FIX POSITION
			var menuHolder = $this.closest('.navigation');
			if( menuHolder.hasClass("vertical") ) {
				verticalMega_Position( menuHolder , $this );
			}

			// MAKE VISIBLE:
			mega_elm.stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			sub_elm.stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			
			
			// ARROW VERTICAL POS. and OPACITY (IF NOT HORIZONTAL MENU)
			if( menuHolder.hasClass('vertical') ) {
				$j('.active-mega').stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			}
			
		}
		
	);
	$j('.horizontal-menu-wrapper  ul.navigation > .menu-item-has-children > a, .custom-menu  ul.navigation > .menu-item-has-children > a').mouseleave(
	
		function (e) {
		
			var $this = $j(this); // <--- MAIN TRIGGER - THE MENU LINK ELEMENT WITH CHILDREN
			
			var mega_elm			= $j( '#' + $this.attr('data-megaid') ),
				sub_elm				= $j( '#' + $this.attr('data-subid') ),
				mega_width_reset	= $this.parent().find('.as-megamenu').data('width');
			
			
			mega_elm.stop(true,true).delay(100).animate( {'opacity':0, avoidCSSTransitions: true }, 100,
				function() {
					
					mega_elm.css('width', mega_width_reset ).css('display','none');
				}
			);
			sub_elm.stop(true,true).delay(100).animate( {'opacity':0, avoidCSSTransitions: true }, 100,
				function() {
					sub_elm.css('display','none');
				}
			);
			
			
			$j( '.active-mega').stop(true,true).delay(300).animate( {'opacity':0 },{duration:300, easing: 'linear'});
		
		}
		
	);
	// MAKE SUB CLONES VISIBLE ( and PREVENT GETTING OFF SCREEN ) :
	$j('.sub-clone li').mouseenter(
		
		function(e) {
		
			e.stopPropagation();
			
			var $this	= $j(this),
				sub		= $this.find('> .sub-menu'),
				subPos	= $this.offset().left + $this.outerWidth(true) + 220;
						
			
			if( subPos >= $j( document ).width() ) {
				sub.css('left','-100%');
			}
			
			sub.fadeIn();
		}
		
	)
	.mouseleave(	
		function(e) {
			var sub = $j(this).find('> .sub-menu');
			sub.fadeOut();
		}
	);	
	// 
	// MEGA or SUB MENU CONFIRM IS ACTIVE:
	$j(document).on('mouseover','.mega-clone, .sub-clone', function (e) {
		e.stopPropagation();
		
		$j(this).stop(true, false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
		
		if( $j(this).hasClass('vertical-mega') ) {
			$j( '.active-mega').stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
		}
		
		
	});
	// HIDE MEGA MENU WHEN MOUSE LEAVES MEGA MENU
	$j(document).on('mouseleave','.mega-clone, .sub-clone', function (e) {
		e.stopPropagation();
		$j(this).stop(true,true).delay(100).animate( {'opacity':0, avoidCSSTransitions: true }, 100,
				function() {
					$j(this).css('display','none');
				}
			)
		$j('.active-mega').delay(300).css('display','none');
	});

	
	$j(document).click(function () {
		if( !window.isMobile ) { 
			$j('.mega-clone').fadeOut( 200, function() {$j('.mega-clone').fadeOut(); } );
		}
	});

	
	$j('.horizontal ul.navigation > li').find('> .sub-menu').each(
		function () {
			var sub = $j(this),
				sub_parent = $j(this).parent(),
				horiz_sub_pos	= sub_parent.outerWidth(true)/2  - sub.outerWidth(true)/2  ;
				
			sub.css('left', horiz_sub_pos )
		}
	);
	
/**
 *	MENU POSITION ON HORIZONTAL LAYOUT:
 */
function horiz_megaPosition( triggered ) {
		
	var megaid	= triggered.attr("data-megaid"),
		mega	= $j('#' + megaid ),
		subid	= triggered.attr("data-subid"),
		sub		= $j('#' + subid);
	
	if( mega.hasClass('horizontal-mega') || sub.hasClass('horizontal-sub') ) {
		
		var top_shift		= triggered.offset().top, // top position of hovered nav element
			parentoffsetTop	= triggered.closest('.row').offset().top, // first positioned el. top
			parentoffsetLeft= triggered.closest('.row').offset().left,// first positioned el. left
			triggered_H		= triggered.outerHeight(true), // height of hovered nav element
			triggered_L		= triggered.offset().left, // left position of hovered nav element
			triggered_W		= triggered.outerWidth(true) / 2, // width of hovered nav element
			sub_W			= sub.outerWidth(true) / 2 ; // width of sub element
		
		// calculate positions
		var topPosition		= top_shift - parentoffsetTop + triggered_H,
			leftPosition	= ( triggered_L + triggered_W )- sub_W - parentoffsetLeft ;
		
		// apply positions
		mega.css('top', topPosition );
		sub.css('top', topPosition );
		sub.css('left',leftPosition );
		
	}

}
/** end position of mega menu */

/** 
 *	VERTICAL (AND CUSTOM MENU) SUB/MEGA - vertical position fix
 */
function verticalMega_Position( theMenu, parentItem ) {
	
	var htmlW		= $j('html').width(),
		bodyW		= $j('#bodywrap').width(),
		scrollT		= $j('body').scrollTop();
	
	if( htmlW >= bodyW && theMenu.hasClass('vertical') ) { // IF MENU IS VERTICAL
		
		// IDENTIFY WHICH SUB OR MEGA BY PARENT ITEM DATA-MEGAID OR DATA-SUBID ATTRIBUTE
		var target		= parentItem.attr('data-megaid');
		if( !target ) { // if no mega
			target		= parentItem.attr('data-subid');
		}
		
		if( theMenu.hasClass('custom-nav') ) {		// IF IT'S CUSTOM MENU:
			$j('#'+ target ).css('bottom','auto') ; // remove vertical mega stretching to bottom 	
		}
		
		var	megaHeight	= $j('#'+ target ).outerHeight(true),
			megaShift	= htmlW/2 - bodyW/2 - $j('#bodywrap').offset().left,
			menuW		= theMenu.offset().left + theMenu.outerWidth(true),
			arrow		= $j('.active-mega');
		
		
		//  POSITION AND SIZE OF MEGA OBJECT
		var targetObject	= $j('#'+ target ), // the Mega Menu object
			leftFinal		= megaShift + menuW,
			rightLimit		= leftFinal + targetObject.width() ;
			
		
		targetObject.css( 'left', leftFinal );
		
		// WIDTH FIX IF MEGA OBJECT GOES OFF SCREEN
		var startWidth = targetObject.data('width');
		
		if( rightLimit< $j(document).width() ) {
			
			targetObject.css( 'right', 'auto' ).css('width', startWidth);
			
		}else if( rightLimit > $j(document).width() ){
			
			targetObject.css( 'right', 30 ).css('width','auto');
			
		}
				
		arrow.css( 'left', megaShift + menuW - 12 );
		
		// TOP POSITION
		var finalPosition	= (parentItem.offset().top - scrollT ) - megaHeight/2 + (parentItem.height()/2),
			arrowPosition	= (parentItem.offset().top - scrollT) + (parentItem.height()/2);
			
		// IF MEGA-CLONE GOES OVER THE TOP
		if( finalPosition < 0 ) {
			finalPosition = 20;
		}
				
		// CUSTOM MENU - VERTICAL POSITION OF SUB/MEGA AND ARROW
		if( theMenu.hasClass('custom-nav') ) {
			
			targetObject.css('top', finalPosition );
			
		}
		arrow.css( 'top', arrowPosition );
		
	}
}
//verticalMega_Position();

/**
 *	SECONDARY MENU TOGGLE:
 */
$j('#secondary-nav li.dropdown, .horizontal-menu-wrapper.side-subs li.dropdown').mouseover(
	
	function (e) {

		var thisSub		= $j(this).find('> ul.sub-menu'),
			bigParent	= $j(this).closest('.navigation').parent();
		
		if( bigParent.hasClass('side-subs') ) {
			thisSub.css('left','100%');
		}else{
			thisSub.css('left',0);
		}
		
		$j(this).siblings().find('ul.sub-menu').css('display','none'); // first hide all other subs
		thisSub.fadeIn();
		
	}
).mouseleave(
	function (e) {
		$j(this).find(' > ul.sub-menu').delay(300).fadeOut();
	}
);

/**
 *	CUSTOM MENU for MOBILES
 *
 */

$j('.custom-menu  ul.navigation > .menu-item-has-children').on("mouseover touchstart touchend",
	function () {
		if( $j(document).width() <= 768 ) {
			$j(this).find('> .sub-menu').slideDown().css('left',0);
		}
	}).mouseleave(
	function() {
		if( $j(document).width() <= 768 ) {
			$j(this).find('> .sub-menu').slideUp();
		}
	}
);


/**
 *	MAKE RELATIVE - depending on WATCH plugin 
 *
 *	if element's height is exceeding parent change css position absolute to relative.
 *	used in single product block ( AQPB )
 */
if ( $j.browser.mozilla ) {
	$j('.wrap').closest('.single-product-block').addClass('mozilla');
}else{
	$j('.wrap').closest('.single-product-block').addClass('not-mozilla');
}
function makeRelative( el ) {
   
	var parent		= el.parent(),
		parentH		= parent.height(),
		thisH		= el.height();
   
	if( parentH >= thisH ) {
		parent.removeClass('adapt-to-child');
	}else
	if( parentH < thisH) {
		parent.addClass('adapt-to-child');
	}
	
}
$j('.wrap').watch("height",
	function() {                         
		makeRelative( $j('.wrap') );
	},
100);
/** end MAKE RELATIVE */



	
/**
 *	WINDOW RESIZE EVENTS.
 *
 */
	$j(window).resize(function() {
		
		makeRelative( $j('.wrap') );
		
		//verticalMega_Position();
		
	});
	
/** end WINDOW RESIZE */
	

/**
 *
 * OWL CAROUSELS.
 *
 */
	function owlCarousels() {
		
		// CONTENT SLIDERS - posts, product, portfolio lists
		var contentSlides = $j(".contentslides");
		
		contentSlides.each(	function() {
			
			var $this	= $j(this),
				config	= $this.parent().find('input.slides-config');
			
			var cs_navig	= config.attr('data-navigation'),
				cs_pagin	= config.attr('data-pagination'),
				cs_auto		= config.attr('data-auto'),
				sc_desk		= config.attr('data-desktop'),
				sc_tablet	= config.attr('data-tablet'),
				sc_mobile	= config.attr('data-mobile'),
				sc_loop		= config.attr('data-loop');
			
			
			// WHEN CAROUSEL IS INITALIZED (must be before owlCarousel() call):	
			$this.on('initialized.owl.carousel', function(event) {
				Foundation.libs.equalizer.reflow(); 
			})
			 
			
			// OWL 2
			$this.owlCarousel({
				//loop:true,
				margin:0,
				navRewind: true,
				responsiveClass:true,
				nav: cs_navig == '1' ? true : false,
				dots:  cs_pagin == '1' ? true : false,
				autoplay:  cs_auto ? true : false,
				autoplayTimeout:  cs_auto  ? cs_auto : 0,
				autoplayHoverPause: true,
				navText: ["<span class=\"icon-chevron-left\"></span>","<span class=\"icon-chevron-right\"></span>"],
				responsive:{
					0:{
						items:sc_mobile ? sc_mobile : 1,
						nav:true
					},
					600:{
						items:sc_tablet ? sc_tablet : 3,
						nav:false
					},
					1000:{
						items: sc_desk ? sc_desk : 4,
						nav:cs_navig == '1' ? true : false,
						loop: sc_loop == '1' ? sc_loop : false
					}
				}
			})
						
		}); // end contentSlides.each
		
		// SINGLE PRODUCT BLOCK IMAGES SLIDER
		var singleSlides = $j(".singleslides");
		
		singleSlides.each(	function() {
			
			var $this	= $j(this),
				config	= $this.prev('input.slides-config');
			
			var sp_navig	= config.attr('data-navigation');
			var sp_pagin	= config.attr('data-pagination');
			var sp_auto		= config.attr('data-auto');
			var sp_transition	= config.attr('data-trans');			

			// OWL 2
			$this.owlCarousel({
				items: 1,
				loop:true,
				margin:0,
				responsiveClass:true,
				nav: sp_navig == 'yes' ? true : false,
				dots:  sp_pagin == 'yes' ? true : false,
				autoplay:  sp_auto ? true : false,
				autoplayTimeout:  sp_auto  ? sp_auto : 0,
				autoplayHoverPause: true,
				navText: ["<span class=\"icon-chevron-left\"></span>","<span class=\"icon-chevron-right\"></span>"]
				
			})
			
		});

		
		// SIMPLE IMAGE SLIDER - owl default responsiveness
		var imageSlides = $j(".simpleslides");
		
		imageSlides.each(	function() {
			
			var $this	= $j(this),
				config	= $this.prev('input.simpleslides-config');
			
			var ss_navig	= config.attr('data-navigation');
			var ss_pagin	= config.attr('data-pagination');
			var ss_auto		= config.attr('data-auto');			
			var ss_desk		= config.attr('data-desktop');			
			var ss_desksmall= config.attr('data-desktop-small');			
			var ss_tablet	= config.attr('data-tablet');			
			var ss_mobile	= config.attr('data-mobile');			
			var ss_transition	= config.attr('data-trans');			
			
			$this.owlCarousel({
						
						items				: ss_desk ? ss_desk : 4,
						itemsCustom			: false,
						itemsDesktop		: [1199,ss_desk ? ss_desk : 4],
						itemsDesktopSmall	: [980,ss_desksmall ? ss_desksmall : 3],
						itemsTablet			: [768,ss_tablet ? ss_tablet : 2],
						itemsTabletSmall	: false,
						itemsMobile			: [479,ss_mobile ? ss_mobile : 1],
						singleItem			: ss_transition ? true : false,
						autoPlay			: ss_auto == 0 ? false : ss_auto,
						stopOnHover			: true,
						navigation			: ss_navig == 1 ? true : false,
						pagination			: ss_pagin == 1 ? true : false,
						addClassActive		: false,
						autoHeight 			: true,
						mouseDrag			: true,
						rewindNav			: true,
						paginationNumbers	: false,
						navigationText		:["&#xe16d;","&#xe170;"],
						beforeInit			: function () {
							// fixes row block fixed background image in Chrome/Safari:
							$j('.aq-block-as_row_block').css('-webkit-transform:', 'translate3d(0,0,0)');
						},
						transitionStyle		: ss_transition ? ss_transition : false
						
					});
			ss_navig = ss_pagin = ss_auto = ss_transition = '';
			
		});
		
		
		
	}
	
	
	$j(window).load(function() {
		owlCarousels();
	})

/**
 *	Google maps initiate and unload.
 *
 *	if issues with this - add in body tag - <body onload="initialize()" onunload="GUnload()">
 */
	
	if( $j('.google-map').length ) {
		$j(window).load(function() {
			initialize(); 
		});
		$j(window).unload(function() {
			unload();
		});
	}


/**
 *	BACK TO TOP
 *
 */	
	function backToTop () {
		var offset = 300,
			//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
			offset_opacity = 1200,
			//duration of the top scrolling animation (in ms)
			scroll_top_duration = 700,
			//grab the "back to top" link
			$back_to_top = $j('.to-top');

		//hide or show the "back to top" link
		$j(window).scroll(function(){
			( $j(this).scrollTop() > offset ) ? $back_to_top.addClass('to-top-is-visible') : $back_to_top.removeClass('to-top-is-visible to-top-fade-out');
			if( $j(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('to-top-fade-out');
			}
		});

		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$j('body,html').animate({
				scrollTop: 0 ,
				}, scroll_top_duration
			);
		});
	}
	
	backToTop();
	
/**
 *	WAYPOINTS REFRESH
 *
*/	 
	$j(window).resize(function() {
		$j.waypoints('refresh');
	});

// prevent empty a href
	$j('a[href=""]').attr('href', '#');


/**
 *	ADD GRAB / GRABBING CURSOR ON CAROUSELS
 *
 */		
$j( ".slick-list, .owl-carousel" )
	.hover(function() {
			$j( this ).addClass( 'to-drag');
		},
		function() {
			$j( this ).removeClass( 'to-drag');
		}
	)
	.mouseup(function() {
		$j( this ).removeClass( 'dragged').addClass( 'to-drag');
	})
	.mousedown(function() {
		$j( this ).addClass( 'dragged' ).removeClass( 'to-drag');
	});


/**
 *	GRID / LIST FUNCTIONS FOR WOOCOMMERCE CATALOG PAGE
 *
 */	
	var itemsHolder = $j('ul.products');
	if( itemsHolder.length ) {
	
		var default_view = 'grid'; // choose the view to show by default (grid/list)
		// check the presence of the cookie, if not create view cookie with the default view value
		if($j.cookie('view') !== 'undefined'){
			$j.cookie('view', default_view, { expires: 7, path: '/' });
		}
		
		var itemList	= $j('.item-data-list');

		
		if($j.cookie('view') == 'list'){ 
			// we dont use the get_list function here to avoid the animation
			$j('#grid').removeClass('active');
			$j('#list').addClass('active');
			itemsHolder.animate({opacity:0});
			itemsHolder.addClass('list');
			itemList.css('display','block');
			itemsHolder.stop().animate({opacity:1});
			$j.waypoints('refresh');
		} 

		if($j.cookie('view') == 'grid'){ 
			$j('#list').removeClass('active');
			$j('#grid').addClass('active');
			itemsHolder.animate({opacity:0});
				itemsHolder.removeClass('list');
				itemList.css('display','none');
				itemsHolder.stop().animate({opacity:1});
				$j.waypoints('refresh');
		}
		
		$j('#list').click(function(event){  
			event.preventDefault();
			$j.cookie('view', 'list'); 
			get_list()
		});

		$j('#grid').click(function(event){ 
			event.preventDefault();
			$j.cookie('view', 'grid'); 
			get_grid();
		});		
		
	}
	function get_grid(){
		$j('#list').removeClass('active');
		$j('#grid').addClass('active');
		itemsHolder.animate({opacity:0},function(){
			itemsHolder.removeClass('list');
			itemList.css('display','none');
			itemsHolder.stop().animate({opacity:1});
			$j.waypoints('refresh');
			$j('.shuffle').shuffle('update');
		});
	} // end get_grid function	
	function get_list(){
		$j('#grid').removeClass('active');
		$j('#list').addClass('active');
		itemsHolder.animate({opacity:0},function(){
			itemsHolder.addClass('list');
			itemList.css('display','block');
			itemsHolder.stop().animate({opacity:1});
			$j.waypoints('refresh');
			$j('.shuffle').shuffle('layout');
		});
	} // end get_list function

	
	/**
	 *	VISUAL COMPOSER "TWEAKS"
	 *
	 */
	$j('.ui-tabs-nav li').mousedown(function() {
		var tabsParent	= $j(this).closest('.ui-tabs'),
			tabContent	= tabsParent.find('.wpb_tab');
		
		tabContent.each(function(){
			$j(this).css('opacity', 0 ).animate( {opacity:1});
		});
		
	});
	$j('.ui-tabs-nav li').mouseup(function() {
		setTimeout( 
			function() { 
				$j.waypoints('refresh');
				$j(window).trigger('resize');
				Foundation.libs.equalizer.reflow();
			} 
			,1000);
	});

	/**
	 *	OFF CANVAS:
	 */
	
	$j(document).on( "click", ".main-head-toggles",function(e) {
		
		e.preventDefault();
		
		$j(".section-overlay").remove();
		
		var button_target = $j(this).attr("data-toggle");
		
		if( button_target == "mini-cart-list" || button_target == "wrap-mini-wishlist" || button_target == "searchform-header") {
						
			$j('.right-off-canvas').addClass("active");
			//$j(".main-section").addClass("right-off");
			$j("#bodywrap").prepend('<div class="section-overlay"></div>');
			
		}else if( button_target == "offcanvaswrapper" ) {
			
			e.preventDefault();
			$j('.left-off-canvas').addClass("active");
			//$j(".main-section").addClass("left-off");
			$j("#bodywrap").prepend('<div class="section-overlay"></div>');
			
		}
		
		$j('.'+ button_target ).addClass("active");
		
	});

	$j(document).on( "click", ".hide-asides, .section-overlay",function (e) {
		
		$j('.right-off-canvas, .left-off-canvas' ).each( function() {
			
			var off_canvases = $j(this),
				off_canv_descend = off_canvases.find("> div");
			
			off_canvases.removeClass("active");
			off_canv_descend.removeClass("active");
			
		});
		
		$j(".section-overlay").fadeOut(300, function() {
			$j(this).remove();
		});
		
	});
		
	$j( '#offcanvas' ).dlmenu({
		animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
	});
	
	// end OFF CANVAS

	/**
	 *	STICKED SIDEBAR
	 */	
	$j('#secondary, .special-stick').stickit({
		scope: StickScope.Parent,
		className: 'sticked-column',
		top: 0,
		extraHeight:0,
	});
	/* 
	$j(window).scroll(function(){
		if( $j("#secondary,.special-stick").hasClass("sticked-column") ) {
			$j(window).trigger("resize");
		}
	});
	*/
	
	/* 
	$j(document).foundation({
		equalizer : {
		// Specify if Equalizer should make elements equal height once they become stacked.
		equalize_on_stack: true
		}
	});
	*/
}); // end document.ready


/**
 *	WooCommerce messages
 *
 */
	$j('.theme-shop-message').find('.woocommerce-message').append('<div class="message-remove"></div>');
	$j('.theme-shop-message,.woocommerce-message .message-remove').on('click',function() {
		$j('.theme-shop-message').fadeOut();
	});
	
	setTimeout( "jQuery('.theme-shop-message').fadeOut();", 5000 );

 ;
})();
//})(jQuery);