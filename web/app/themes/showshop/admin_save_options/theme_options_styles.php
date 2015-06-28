<?php
if( !isset($_GET['activated'])) {
header("Content-type: text/css; charset: UTF-8");
};
global $as_of;

$theme_styles = "";

// FONTS SETTINGS
$g_FontToggle 		= $as_of['google_typekit_toggle']; // applies to body and titles
$g_FontBody			= $as_of['google_body']['face'];
$g_FontBodySize		= $as_of['google_body']['size'];
$g_FontBodyWeight	= $as_of['google_body']['weight'];
$g_FontBodyColor	= $as_of['google_body']['color'];

$sys_body_font_face		= $as_of['sys_body_font']['face'];
$sys_body_font_size		= $as_of['sys_body_font']['size'];
$sys_body_font_height	= $as_of['sys_body_font']['height'];
$sys_body_font_style	= $as_of['sys_body_font']['style'];
$sys_body_font_color	= $as_of['sys_body_font']['color'];

$g_FontHeadings			= $as_of['google_headings']['face'];
$g_FontHeadingsWeight	= $as_of['google_headings']['weight'];
$g_FontHeadingsColor	= $as_of['google_headings']['color'];
$g_FontHeadingsTransf	= $as_of['google_headings']['transform'];

// STYLES - HTML (SITE) BACKGROUND
$site_bg_toggle 	= $as_of['site_bg_toggle'];
$site_bg_default	= isset($as_of['site_bg_default']) ? $as_of['site_bg_default'] : null; //default tiles
$site_bg_uploaded	= $as_of['site_bg_uploaded']; // uploaded site bg images
$site_bg_repeat		= $as_of['site_bg_controls']['repeat'];
$site_bg_position	= $as_of['site_bg_controls']['position'];
$site_bg_attachment	= $as_of['site_bg_controls']['attachment'];
$site_bg_color		= $as_of['site_back_color'];

// STYLES - BODY BACKGROUND
$body_bg_toggle 	= $as_of['body_bg_toggle'];
$body_bg_default	= isset($as_of['body_bg_default']) ? $as_of['body_bg_default'] : null; //default tiles
$body_bg_uploaded	= $as_of['body_bg_uploaded']; // uploaded site bg images
$body_bg_repeat		= $as_of['body_bg_controls']['repeat'];
$body_bg_position	= $as_of['body_bg_controls']['position'];
$body_bg_attachment	= $as_of['body_bg_controls']['attachment'];
$body_bg_size		= $as_of['body_bg_controls']['size'];
$body_bg_color		= $as_of['body_back_color'];
$body_c_opacity		= $as_of['body_back_color_opacity'];


// STYLES - COLORS
$accent_1		= $as_of['accent_1'];
$accent_2		= $as_of['accent_2'];

$item_overlay_color		= $as_of['item_overlay_color'];	
$item_overlay_opacity	= $as_of['item_overlay_opacity'];	
$io_opac 				= $item_overlay_opacity / 100;

$links_color			= $as_of['links_color'];	
$links_hover_color		= $as_of['links_hover_color'];	

$buttons_bck_color			= $as_of['buttons_bck_color'];	
$buttons_hover_bck_color	= $as_of['buttons_hover_bck_color'];	
$buttons_focus_bck_color	= $as_of['buttons_focus_bck_color'];	
$buttons_font_color			= $as_of['buttons_font_color'];	
$buttons_hover_font_color	= $as_of['buttons_hover_font_color'];
	
// HEADER 
$h_size_ratio				= $as_of['header_height'];
$header_font_color			= $as_of['header_font_color'];	
$header_links_color			= $as_of['header_links_color'];	
$header_links_hover_color	= $as_of['header_links_hover_color'];	
$header_back_color			= $as_of['header_back_color'];
$header_back_opacity		= $as_of['header_back_opacity'];
$sidemenu_back_opacity		= $as_of['sidemenu_back_opacity'];
$under_head_opacity			= $as_of['under_head_opacity'];
$breadcrumbs_color			= $as_of['breadcrumbs_color'];
$topbar_back_color			= $as_of['topbar_back_color'];
$topbar_font_color			= $as_of['topbar_font_color'];

// FOOTER
$footer_font_color			= $as_of['footer_font_color'];	
$footer_links_color			= $as_of['footer_links_color'];	
$footer_links_hover_color	= $as_of['footer_links_hover_color'];	
$footer_back_color			= $as_of['footer_back_color'];
$footer_back_opacity		= $as_of['footer_back_opacity'];	
$footer_bc_IE8 = str_replace('#','', $footer_back_color);

// SPECIAL STYLES
$borders_lines_color		= $as_of['borders_lines_color'];
$borders_lines_opacity		= $as_of['borders_lines_opacity'];

$review_stars_color			= $as_of['review_stars_color'];

$hide_titles_shadow			= $as_of['hide_titles_shadow'];


/**
 *	 --------- OUTPUT STYLES: ---------
 *
 *	ROOT (HTML)
 */
$theme_styles .= "html, body { \n";
	if( $g_FontToggle == 'google' ) {
		$theme_styles .= !empty( $g_FontBodySize )	? "font-size:".$g_FontBodySize.";\n" : null;
	}elseif( $g_FontToggle == 'none' || $g_FontToggle == 'typekit' ) {
		$theme_styles .= ( $sys_body_font_size ? "font-size:" . $sys_body_font_size . ";\n" : null );
	}
	
$theme_styles .= "}\n\n";

/**
 *	BODY styles
 *
 */
$theme_styles .= "body { \n";
	
	if( $g_FontToggle ) {
		$theme_styles .= "/* BODY FONT STYLE - GOOGLE FONT */\n";
		
		$theme_styles .= !empty( $g_FontBody )		? "font-family:\"".$g_FontBody."\", Helvetica, Arial, sans-serif !important;\n" : null;
		$theme_styles .= !empty( $g_FontBodyWeight )	? "font-weight:".$g_FontBodyWeight.";\n" : null;
		$theme_styles .= !empty( $g_FontBodyColor )	? "color:".$g_FontBodyColor.";\n" : null;
	
	};
	
	if( $g_FontToggle == 'none' || $g_FontToggle == 'typekit' ) {
		$theme_styles .= "/* BODY FONT STYLE - TYPEKIT - FALLBACK FONTS */\n";
		
		$theme_styles .= "font-family:". $sys_body_font_face .", Helvetica, Arial, sans-serif;\n";
		
		$theme_styles .= ( $sys_body_font_height	? "line-height:" . $sys_body_font_height . " !important;\n " : null );
		$theme_styles .= ( $sys_body_font_style		? "font-style:" . $sys_body_font_style . ";\n " : null );
		$theme_styles .= ( $sys_body_font_color		? "color:" . $sys_body_font_color . ";\n " : null ); 
		
	};
	
	if( $site_bg_toggle != 'none' ) {
		$theme_styles .= "/* BODY BACKGROUND */\n";
		$theme_styles .= ($site_bg_toggle == 'default' && $site_bg_default ) ? "background-image: url(". $site_bg_default .");\n" : null;
		$theme_styles .= ($site_bg_toggle == 'upload' && $site_bg_uploaded) ? "background-image: url(". $site_bg_uploaded .");\n " : null;
		
		$theme_styles .= $site_bg_repeat	 ? "background-repeat: ".$site_bg_repeat.";\n" : null;
		$theme_styles .= $site_bg_position	 ? "background-position: ".$site_bg_position.";\n" : null;
		$theme_styles .= $site_bg_attachment ? "background-attachment: ".$site_bg_attachment.";\n" : null;
		
	};
	
	$theme_styles .= $site_bg_color ? "background-color: ".$site_bg_color.";\n" : null;
	
$theme_styles .= "}\n\n"; // end $theme_styles .= body
/**  end BODY styles */


/** DEPENDENCIES - OTHER SELECTORS WITH CSS's AS BODY ( overrides )*/
if( $g_FontToggle == 'google' && $g_FontBody ) {
	$theme_styles .= ".button, .onsale, .taxonomy-menu h4, button, input#s, input[type=\"button\"], input[type=\"email\"], input[type=\"reset\"], input[type=\"submit\"], input[type=\"text\"], select, textarea { \n font-family: ".$g_FontBody.", Helvetica, Arial, sans-serif !important;\n }\n\n";
	
}elseif(  $g_FontToggle == 'none' || $g_FontToggle == 'typekit' ) {
	$theme_styles .= "#site-menu, .block-subtitle, .bottom-block-link a, .button, .onsale, .taxonomy-menu h4, button, input#s, input[type=\"button\"], input[type=\"email\"], input[type=\"reset\"], input[type=\"submit\"], input[type=\"text\"], select, textarea, ul.post-portfolio-tax-menu li a { \n font-family: ". $sys_body_font_face .", Helvetica, Arial, sans-serif;\n }\n\n";
}

/**
 *	HEADINGS styles ( and MAIN MENU )
 *
 */
if ( $g_FontToggle == 'google'  ) {
	
	$theme_styles .= "/* HEADING STYLE - GOOGLE FONT */\n";
	// ONLY HEADINGS
	
	if( !empty($g_FontHeadings)) {
		$theme_styles .=  "h1, h2, h3, h4, h5, h6 { \nfont-family: \"".$g_FontHeadings."\", Helvetica, Arial, sans-serif !important;\n"; 
		$theme_styles .= !empty($g_FontHeadingsWeight) ? "font-weight: ".$g_FontHeadingsWeight.";\n" : null;
		$theme_styles .= !empty($g_FontHeadingsColor) ? "color: ". $g_FontHeadingsColor .";\n" : null;
		$theme_styles .= !empty($g_FontHeadingsTransf) ? "text-transform: ". $g_FontHeadingsTransf ." !important;\n" : null;
		$theme_styles .= !empty($g_FontHeadingsTransf) && ($g_FontHeadingsTransf =="none") ? "display: block !important;" : null;
		$theme_styles .= "}\n\n";
		
		$theme_styles .= !empty($g_FontHeadingsTransf) && ($g_FontHeadingsTransf =="none") ? "h1.page-title:before, h1.archive-title:before, .block-title.center:before { left: 0; right: 0; }" : null;
	}
	
}else{
	$theme_styles .= "/* HEADING STYLE - SYSTEM FONT */\n";
	$theme_styles .= "h1, h2, h3, h4, h5, h6  { \n";
	$theme_styles .= "font-family:".$as_of['sys_heading_font']['face'].", Helvetica, Arial, sans-serif;\n";
	$theme_styles .= $as_of['sys_heading_font']['weight'] ? "font-weight:".$as_of['sys_heading_font']['weight'].";\n" : "font-weight:normal;\n";
	$theme_styles .= $as_of['sys_heading_font']['color'] ? "color:".$as_of['sys_heading_font']['color'].";\n" : null;
	$theme_styles .= $as_of['sys_heading_font']['style'] ? 'font-style:'.$as_of['sys_heading_font']['style'].";\n" : null ;
	$theme_styles .= "} \n\n";
		
}
/* end HEADINGS styles  */



/**
 *	IMAGES HOVER OVERLAY
 *
 */
if( $item_overlay_color ) {
	$theme_styles .= "/* ITEM OVERLAY COLOR */\n";
	$theme_styles .= ".item-overlay { \nbackground: ".$item_overlay_color ."; \n opacity: ".$io_opac.";\n}\n\n";
}


/**
 *	LINKS TEXT COLOR:
 *
 */
$lc		= $links_color ? $links_color : $accent_1;
$lch	= $links_hover_color ? $links_hover_color : $accent_2;

if( $lc ) {
	$theme_styles .= "/* LINKS TEXT COLOR */\n";
	$theme_styles .= "a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading {\ncolor: ".  $lc ." \n}\n\n";
}

if( $lch ) {
	$theme_styles .= "/* LINKS HOVER TEXT COLOR */\n";
	$theme_styles .= "a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover { \ncolor: ".  $lch ." \n}\n\n";

}


/**
 *	BUTTONS FONT AND BACKGROUND COLOR:
 *
 */
$bbc	= $buttons_bck_color ? $buttons_bck_color : $accent_1 ;
$bbhc	= $buttons_hover_bck_color ? $buttons_hover_bck_color : $accent_2;

if( $bbc || $buttons_font_color ) {
	$theme_styles .= "/* BUTTONS BACK AND TEXT COLORS */\n";
	$theme_styles .= "button, .button, a.button, button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {\n";
	
	$theme_styles .= $bbc ? "background-color: rgba(". hex2rgb( $bbc ) .", 1);" : "";
	$theme_styles .= $buttons_font_color ? "color: ".$buttons_font_color ."\n\n" : "";
	
	$theme_styles .= "\n}\n";
}
if( $bbhc || $buttons_hover_font_color ) {
	$theme_styles .= "/* BUTTONS HOVER BACK AND TEXT COLORS */\n";
	$theme_styles .= "button:hover, .button:hover, a.button:hover, button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { \n";
	
	$theme_styles .= $bbhc ? "background-color: rgba(". hex2rgb($bbhc) .", 1) !important; \n" : "";
	$theme_styles .= $buttons_hover_font_color ? "color: ".$buttons_hover_font_color."; \n" : "";
	$theme_styles .= "\n}\n";
}
if( $buttons_focus_bck_color  ) {
	$theme_styles .= "/* BUTTONS FOCUS BACK AND TEXT COLORS */\n";
	$theme_styles .= "button:focus, .button:focus, a.button:focus, button.disabled:focus, button[disabled]:focus, .woocommerce .quantity .plus:focus, .woocommerce .quantity .minus:focus, .woocommerce #content .quantity .plus:focus, .woocommerce #content .quantity .minus:focus, .woocommerce-page .quantity .plus:focus, .woocommerce-page .quantity .minus:focus, .woocommerce-page #content .quantity .plus:focus, .woocommerce-page #content .quantity .minus:focus { \n";
	
	$theme_styles .= $buttons_focus_bck_color ? "background-color: rgba(". hex2rgb($buttons_focus_bck_color) .", 1) !important;\n}\n\n" : "";
}



/**
 *	HEADER FONTS, LINKS, BACKGROUND and BORDER:
 *
 */

if( $header_font_color ) {

	$theme_styles .= "/* HEADER FONT COLOR */\n";
	
	$theme_styles .= "#site-menu, .searchform-header input[type=\"search\"], .mega-clone .desc, .sub-clone .desc { \ncolor:".$header_font_color."; \n}\n\n";
			
	$theme_styles .= ".searchform-header input::input-placeholder,\n";
	$theme_styles .= ".searchform-header input::-webkit-input-placeholder,\n";
	$theme_styles .= ".searchform-header input:-moz-placeholder,\n";
	$theme_styles .= ".searchform-header input:-ms-input-placeholder ,\n";
	$theme_styles .= "#yith-ajaxsearchform input::-webkit-input-placeholder, \n";
	$theme_styles .= "#yith-ajaxsearchform input:-moz-placeholder,\n";
	$theme_styles .= "#yith-ajaxsearchform input:-ms-input-placeholder{ \ncolor:".$header_font_color."; \n}\n\n";
}
// HEADER LINKS AND HOVERS :
if( $header_links_color ) {
	$theme_styles .= "/* HEADER LINKS */\n";
	$theme_styles .= "#site-menu a, .horizontal-menu-wrapper a, #secondary-nav a, .mega-clone a, .sub-clone a { \ncolor: ". $header_links_color ." \n}\n\n";
}
if( $header_links_hover_color ) {
	$theme_styles .= "/* HEADER LINKS HOVERS */\n";	
	$theme_styles .= "#site-menu a:hover, .horizontal-menu-wrapper a:hover, #secondary-nav a:hover, .mega-clone a:hover, .sub-clone a:hover { \ncolor: ". $header_links_hover_color ." \n}\n\n";
}

//  HEADER MENU / SIDE MENUBACKGROUND COLOR:
if( $header_back_color ) {

	$theme_styles .= "/* HEADER BACK COLOR */\n";
	$theme_styles .= "#site-menu.horizontal { \nbackground-color:rgba(".hex2rgb($header_back_color).", ".$header_back_opacity / 100 .");  \n}\n\n";
		
	$theme_styles .= "/* SIDEMENU BACK COLOR */\n";
	$theme_styles .= "#site-menu.vertical  { \nbackground-color:rgba(".hex2rgb($header_back_color).", ".$sidemenu_back_opacity / 100 .");  \n}\n\n";
	
	$theme_styles .= ".stick-it-header { \nbackground-color:rgba(".hex2rgb($header_back_color).", 0.9 );  \n}\n\n";
	
	$theme_styles .= "/* SUBS, MEGAS and MINI CART back color */\n";
	$theme_styles .= ".mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, .secondary .sub-menu { \nbackground-color: ".$header_back_color .";  \n}\n\n";
		
	$theme_styles .= ".menu-border:before { \nbackground-color:". $header_back_color ."; \n}\n\n";
	
	$theme_styles .= ".active-mega span { \nborder-right-color:". $header_back_color ." \n}\n\n";
}
// HEADER OPACITY
if( $under_head_opacity ){
	$theme_styles .= "/* UNDER PAGE TITLE IMAGE OPACITY */\n";
	$theme_styles .= ".header-background{ \n";
	$theme_styles .= "opacity: ".$under_head_opacity/100  ." !important;\n";
	$theme_styles .= "} \n\n";
}

// BREADCRUMBS COLOR
if( $breadcrumbs_color ){
	$theme_styles .= "/* BREADCRUMBS FONT COLOR */\n";
	$theme_styles .= ".breadcrumbs span, .breadcrumbs span:hover, .breadcrumbs a,.breadcrumbs a:hover, .woocommerce-breadcrumb, .woocommerce-breadcrumb span,.woocommerce-breadcrumb a  { \n";
	$theme_styles .= "color: ". $breadcrumbs_color .";\n";
	$theme_styles .= "} \n\n";
}

// TOP BAR BACKGROUND COLOR
if( $topbar_back_color ){
	$theme_styles .= "/* TOP BAR FONT COLOR */\n";
	$theme_styles .= ".top-bar { \n";
	$theme_styles .= "background-color: ". $topbar_back_color .";\n";
	$theme_styles .= "} \n\n";
	
	$theme_styles .= ".top-bar > .row { \n background-color: inherit;\n } \n\n";
}
// TOP BAR FONTS COLOR
if( $topbar_font_color ){
	$theme_styles .= "/* TOP BAR FONT COLOR */\n";
	$theme_styles .= ".top-bar, .top-bar .topbar-info a, .secondary > li > a { \n";
	$theme_styles .= "color: ". $topbar_font_color ." !important;\n";
	$theme_styles .= "} \n\n";
	
}



if( $borders_lines_color ){
	
	$border_c =  "rgba(".hex2rgb($borders_lines_color).", ".$borders_lines_opacity/100 .")";
	
	$theme_styles .= "/* BORDERS, OUTLINES COLOR  */\n";
	
	// INPUTS:
	$theme_styles .= "select, input[type=\"text\"], input[type=\"password\"], input[type=\"date\"], input[type=\"datetime\"], input[type=\"datetime-local\"], input[type=\"month\"], input[type=\"week\"], input[type=\"email\"], input[type=\"number\"], input[type=\"search\"], input[type=\"tel\"], input[type=\"time\"], input[type=\"url\"], input[type=\"color\"], textarea,\n ";
	
	// VARIOUS:
	$theme_styles .= "#site-menu.horizontal .topbar,  .border-bottom, .border-top, #secondary .widget h4, #site-menu .widget h4, .lookbook-product, article, .woocommerce.widget_layered_nav li, article h2.post-title, .horizontal .horizontal-menu-wrapper ul.navigation > li > a, \n ";

	// WOOCOMMERCE:
	$theme_styles .= ".product-filters h4.widget-title, .woocommerce ul.products.list li:after, .woocommerce.widget_product_categories li, \n ";
	
	$theme_styles .= ".product-filters-wrap, .woocommerce .woocommerce-ordering select, .woocommerce-page .woocommerce-ordering select, nav.gridlist-toggle a, \n";
	$theme_styles .= ".summary .product_meta, .summary .product_meta > span, .woocommerce div.product .woocommerce-tabs, \n";
	
	// MENUS, TABS, ACCORDIONS:
	$theme_styles .= "body.vertical-layout .mega-clone, body.vertical-layout .sub-clone,\n";
	$theme_styles .= ".wpb_tabs_nav:before, .wpb_tabs_nav:after , \n";
	$theme_styles .= ".taxonomy-menu:before, .taxonomy-menu:after , \n";
	
	$theme_styles .= ".wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header, .vc_toggle_title ";
	
	$theme_styles .= " { border-color:".( $border_c ? $border_c : "inherit")  . ";\n}\n";
	
	// STICKY POST ( BOX SHADOW AS BORDER)
	$theme_styles .= "article.sticky { box-shadow: inset 0 0 0px 1px ". $border_c ."; \n}\n";
}
if( $review_stars_color ){
	
	$theme_styles .= "/* WooCommerce stars color */\n";
	$theme_styles .= ".woocommerce .star-rating:before, .woocommerce-page .star-rating:before, .star-rating span:before { color:". $review_stars_color .";\n}\n";
}

if( $hide_titles_shadow ) {
	
	$theme_styles .= "h1.page-title:before, h1.archive-title:before { display: none; }\n"; 
}

/**
 *	LOGO AND TITLE SETTINGS
 *
 *	- logo width (height s auto)
 *	- title font size and word-wrap: break-word toggle 
 *
 */
$logo_width		  = $as_of['logo_width'];
$logo_height	  = $as_of['logo_height'];
$title_size		  = $as_of['title_font_size'];
$title_break_word = $as_of['title_break_word'];
 
if( $logo_width  ) {
	if( $logo_width >= 300 ) {
		$theme_styles .= "/* LOGO WIDTH - IF SET > 300 px */\n";
		$theme_styles .= ".vertical-layout #site-menu  { width: 320px; }\n";
		$theme_styles .= ".vertical-layout #site-title h1 img  { width: 100%; }\n";
		$theme_styles .= "#page.vertical, footer.vertical { margin-left: 320px; }\n\n";

	}elseif ( $logo_width < 300 && $logo_width >= 250 ) {
		$theme_styles .= "/* LOGO WIDTH - IF SET 250 - 300 px */\n";
		$theme_styles .= "#site-menu.vertical  { width: ". ( $logo_width + 20 ) ."px; }\n";
		$theme_styles .= ".vertical #site-title h1 img  { width: ". $logo_width ."px; }\n";
		$theme_styles .= "#page.vertical, footer.vertical { margin-left: ". ( $logo_width + 20 ) ."px; }\n\n";
		 
	}elseif ( $logo_width < 250 ) {
		$theme_styles .= "/* LOGO WIDTH - IF SET < 250px */\n";
		$theme_styles .= "#site-menu.vertical  { width: 270px; }\n";
		$theme_styles .= ".vertical #site-title h1 img  { width: ". $logo_width ."px; }\n";
		$theme_styles .= "#page.vertical, footer.vertical { margin-left: 270px; }\n\n";
	}
}

if(	$logo_height ) {
	$theme_styles .= "/* LOGO HEIGHT - FOR HORIZ LAYOUT */\n";
	$theme_styles .= ".horizontal-layout #site-title h1 img { \n max-height: ".$logo_height."px \n}\n\n";
}

if( $title_size ) {
	$theme_styles .= "/* SITE TITLE FONT SIZE */\n";
	$theme_styles .= "#site-title h1, .stick-it-header h1 {\n font-size: ".$title_size."%;\n}\n\n";
}
if( $title_break_word ) {
	$theme_styles .= "/* SITE TITLE BREAK-WORD PROPERTY */\n";
	$theme_styles .= "#site-title h1 {\n word-wrap: break-word; \n}\n\n";
}



/**
 *	BODY BACKGROUND PROPERTIES:
 *
 */
if( $body_bg_toggle != 'none' ) {

$theme_styles .= "#page, .page-template-page-blank > section, .page-template-page-blank_footerwidgets > section {\n";

	if( $body_bg_toggle != 'none' ) {
		$theme_styles .= "/* PAGE ( CONTENT - #page element) BACK IMAGE  */\n";
		$theme_styles .= ($body_bg_toggle == 'default' && $body_bg_default ) ? "\nbackground-image: url(". $body_bg_default .") ;\n" : null;
		$theme_styles .= ($body_bg_toggle == 'upload' && $body_bg_uploaded) ? "\nbackground-image: url(". $body_bg_uploaded .") ;\n" : null;
		
		
		$theme_styles .= $body_bg_repeat	 ? "background-repeat: ".$body_bg_repeat.";\n" : null;
		$theme_styles .= $body_bg_position	 ? "background-position: ".$body_bg_position.";\n" : null;
		$theme_styles .= $body_bg_attachment ? "background-attachment: ".$body_bg_attachment.";\n" : null;
		$theme_styles .= $body_bg_size		 ? "background-size: ".$body_bg_size.";\n" : null;
		
	};

$theme_styles .= "}\n\n";
	
};

if( $body_bg_color ) {
	$theme_styles .= "/* PAGE BACK COLOR  */\n";
	$theme_styles .= "#page {\nbackground-color: rgba(".hex2rgb($body_bg_color).', '.$body_c_opacity / 100 .");\n}\n\n";

	// BODY BACK FOR ONEPAGER MENU BACK
	$theme_styles .= "/* ONEPAGER BACK COLOR  */\n";
	$theme_styles .= ".aq_block_onepager_menu { \nbackground-color: rgba(".hex2rgb( $body_bg_color ).", 0.9);  \n}\n\n";

	$theme_styles .= ".product-filters-wrap { \nbackground-color: rgba(".hex2rgb($body_bg_color).", 0.9); \n}\n\n";

}



/**
 *	FOOTER LINKS AND BUTTONS COLOR:
 *
 */
// text colors
if( $footer_font_color ) {
	$theme_styles .= "\n /* FOOTER TEXT COLOR  */\n";
	$theme_styles .= "footer { \ncolor: ". $footer_font_color ." \n}\n\n";
}
// links and hovers
if( $footer_links_color ) {
	$theme_styles .= "/* FOOTER LINKS COLOR  */\n";
	$theme_styles .= "footer a:link, footer a:visited, footer button, footer .button { \ncolor: ". $footer_links_color ." \n}\n\n";
}
if( $footer_links_hover_color ) {
	$theme_styles .= "/* FOOTER LINKS HOVER COLOR  */\n";	
	$theme_styles .= "footer a:hover, footer button:hover, footer .button:hover { \ncolor: ". $footer_links_hover_color ." \n}\n\n";
}
if( $footer_back_color ) {	
	$theme_styles .= "/* FOOTER BACK COLOR  */\n";	
	$theme_styles .= "footer { \nbackground-color: rgba(". hex2rgb($footer_back_color) .", ". $footer_back_opacity/100 ."); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\"#cc".$footer_bc_IE8."\", endColorstr=\"#cc".$footer_bc_IE8."\",GradientType=0 );  \n}\n\n";
}

/**
 *	FOOTER BACKGROUND:
 *
 */
$footer_bg_toggle 		= $as_of['footer_bg_toggle'];
$footer_bg_default		= isset($as_of['footer_bg_default']) ? $as_of['footer_bg_default'] : null; //default tiles
$footer_bg_uploaded		= $as_of['footer_bg_uploaded']; // uploaded site bg images
$footer_bg_repeat		= $as_of['footer_bg_controls']['repeat'];
$footer_bg_position		= $as_of['footer_bg_controls']['position'];
$footer_bg_attachment	= $as_of['footer_bg_controls']['attachment'];
$footer_bg_size			= $as_of['footer_bg_controls']['size'];

if( $footer_bg_toggle != 'none' ) {

	$theme_styles .= "footer {\n";

		if( $footer_bg_toggle != 'none' ) {
			$theme_styles .= "/* FOOTER BACK IMAGE  */\n";
			$theme_styles .= ($footer_bg_toggle == 'default' && $footer_bg_default ) ? "\nbackground-image: url(". $footer_bg_default .") ;\n" : null;
			$theme_styles .= ($footer_bg_toggle == 'upload' && $footer_bg_uploaded) ? "\nbackground-image: url(". $footer_bg_uploaded .") ;\n" : null;
			
			
			$theme_styles .= $footer_bg_repeat	 	? "background-repeat: ".$footer_bg_repeat.";\n" : null;
			$theme_styles .= $footer_bg_position	? "background-position: ".$footer_bg_position.";\n" : null;
			$theme_styles .= $footer_bg_attachment	? "background-attachment: ".$footer_bg_attachment.";\n" : null;
			$theme_styles .= $footer_bg_size		? "background-size: ".$footer_bg_size.";\n" : null;
			
		};

	$theme_styles .= "}\n\n";
}


/** 
 *	PHP SCSS COMPILER
 *
 */
require "scss.inc.php";
$scss = new scssc();

$accent_1		= $as_of['accent_1'];
$accent_2		= $as_of['accent_2'];
$h_size_ratio	= $as_of['header_height'];

if( $accent_1 ) {
	$theme_styles .=  $scss->compile('
		$accent_1: '. $accent_1  .';
		/* COLOR PALLETES: */
		/////////// PRIMARY ACCENT /////////
		
		// =============== transparency ===============
		.accent-1-transp-90 { 
			//background-color: lighten( $accent_1, 47% ); 
			background-color: transparentize( $accent_1, 90% ); 
		}
		.accent-1-transp-70 { 
			//background-color: lighten( $accent_1, 40% ); 
			background-color: transparentize( $accent_1, 70% ); 
		}
		.accent-1-transp-60  { 
			//background-color: lighten( $accent_1, 30% ); 
			background-color: transparentize( $accent_1, 60% ); 
		}
		
		::-moz-selection {background: transparentize( $accent_1, 60% );}
		::selection {background: transparentize( $accent_1, 60% );}
		
		// =============== lighten ====================
		.accent-1-light-45,
		.owl-prev, .prev,
		.owl-next, .next { 
			background-color: lighten( $accent_1, 45% ); 
		}
		.accent-1-light-40,
		.owl-prev:hover, .prev:hover,
		.owl-next:hover, .next:hover { 
			background-color: lighten( $accent_1, 40% ); 
		}
		.accent-1-light-30 { 
			background-color: lighten( $accent_1, 30% ); 
		}
		
	');
}
if( $accent_2 ) {
	 $theme_styles .= $scss->compile('
		
		$accent_2: '. $accent_2 .';
		
		// SECONDARY ACCENT (transparency):
		// ============ very transparent ================
		h2.post-title,
		.accent-2-a { 
			//background-color: lighten( $accent_2, 47% ); 
			background-color: transparentize( $accent_2, 80% ); 
		}
		// ============ medium transparent ================
		.accent-2-b { 
			//background-color: lighten( $accent_2, 40% ); 
			background-color: transparentize( $accent_2, 60% ); 
		}
		// ================== transparent ==================
		.accent-2-c { 
			//background-color: lighten( $accent_2, 30% ); 
			background-color: transparentize( $accent_2, 30% ); 
		}
		
		// SECONDARY ACCENT (from lightest do darker):
		// =============== lightest ==================
		.accent-2-light-47 { 
			background-color: lighten( $accent_2, 47% ); 

		}
		// ============ medium light ================
		.accent-2-light-40{ 
			background-color: lighten( $accent_2, 40% ); 
		}
		// ================== light ==================
		.accent-2-light-30 { 
			background-color: lighten( $accent_2, 30% ); 
		}
		
		h2.post-title { padding: 1rem }
		article > a.author { padding: 0.5rem 1rem }
	 ');
}
if( $h_size_ratio ) {
	 $theme_styles .= $scss->compile('
	 
		$headSizeRatio: '. $h_size_ratio .'rem;
		/* HEADER SIZES ADJUST */
		.header-bar {
			height:$headSizeRatio+4;
		}
		
		.right-button, .left-button {
			padding: 1.8975+($headSizeRatio/2);
		}
		');
}
if( $header_back_color ) {
	 $theme_styles .= $scss->compile('
		$headBack : '.$header_back_color.';
		$headOpacity : (100-'.$header_back_opacity.')/100;
		 /* HEADER COLOR */
		.header-bar {
			background-color: transparentize( $headBack, $headOpacity );
		}
	 ');
}


//$theme_styles .=  $scss->compile('');

/*	end PHP SCSS*/

/**
 *	PRELOADER STLYES:
 *
 */
include("preloader_styles.php");


/**
 *	BOXED LAYOUT
 *
 */
$boxed_layout = $as_of['boxed_layout'];

if( $boxed_layout && $boxed_layout < 100 ) {
	$theme_styles .=  ".row { width: ". $boxed_layout ."% }";
	$theme_styles .=  ".row.boxed { width: ". $boxed_layout ."% !important }";
}



/**
 *	CUSTOM CSS
 *
 */
if( $as_of['custom_css'] ) {
	$theme_styles .= "\n\n /* THEME OPTIONS CUSTOM CSS STYLES */\n\n ";
	$theme_styles .= $as_of['custom_css'];
}

echo wp_kses_decode_entities( $theme_styles );

?>