<?php
if( !isset($_GET['activated'])) {
header("Content-type: text/css; charset: UTF-8");
};
$skin_styles  = "";
$skin_styles .= '
html, body { 
font-size:16px;
}

body { 
/* BODY FONT STYLE - GOOGLE FONT */
font-family:"Ek Mukta", Helvetica, Arial, sans-serif !important;
font-weight:400;
color:#333333;
}

.button, .onsale, .taxonomy-menu h4, button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select, textarea { 
 font-family: Ek Mukta, Helvetica, Arial, sans-serif !important;
 }

/* HEADING STYLE - GOOGLE FONT */
h1, h2, h3, h4, h5, h6 { 
font-family: "Fjalla One", Helvetica, Arial, sans-serif !important;
font-weight: 400;
}

/* LINKS TEXT COLOR */
a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading {
color: #dd3333 
}

/* LINKS HOVER TEXT COLOR */
a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover { 
color: #777777 
}

/* BUTTONS BACK AND TEXT COLORS */
button, .button, a.button, button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
background-color: rgba(221, 51, 51, 1); color: #e8e8e8
}

/* BUTTONS HOVER BACK AND TEXT COLORS */
button:hover, .button:hover, a.button:hover, button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { 
background-color: rgba(119, 119, 119, 1) !important; 
color: #ffffff; 

}
/* BUTTONS FOCUS BACK AND TEXT COLORS */
button:focus, .button:focus, a.button:focus, button.disabled:focus, button[disabled]:focus, .woocommerce .quantity .plus:focus, .woocommerce .quantity .minus:focus, .woocommerce #content .quantity .plus:focus, .woocommerce #content .quantity .minus:focus, .woocommerce-page .quantity .plus:focus, .woocommerce-page .quantity .minus:focus, .woocommerce-page #content .quantity .plus:focus, .woocommerce-page #content .quantity .minus:focus { 
background-color: rgba(221, 168, 168, 1) !important;
}

/* HEADER BACK COLOR */
#site-menu.horizontal { 
background-color:rgba(244, 244, 235, 0.95);  
}

/* SIDEMENU BACK COLOR */
#site-menu.vertical  { 
background-color:rgba(244, 244, 235, 0.95);  
}

.stick-it-header { 
background-color:rgba(244, 244, 235, 0.9 );  
}

/* SUBS, MEGAS and MINI CART back color */
.mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, .secondary .sub-menu { 
background-color: #f4f4eb;  
}

.menu-border:before { 
background-color:#f4f4eb; 
}

.active-mega span { 
border-right-color:#f4f4eb 
}

/* UNDER PAGE TITLE IMAGE OPACITY */
.header-background{ 
opacity: 0.6 !important;
} 

/* BREADCRUMBS FONT COLOR */
.breadcrumbs span, .breadcrumbs span:hover, .breadcrumbs a,.breadcrumbs a:hover, .woocommerce-breadcrumb, .woocommerce-breadcrumb span,.woocommerce-breadcrumb a  { 
color: #f9f9f9;
} 

/* BORDERS, OUTLINES COLOR  */
select, input[type="text"], input[type="password"], input[type="date"], input[type="datetime"], input[type="datetime-local"], input[type="month"], input[type="week"], input[type="email"], input[type="number"], input[type="search"], input[type="tel"], input[type="time"], input[type="url"], input[type="color"], textarea,
 #site-menu.horizontal .topbar,  .border-bottom, .border-top, #secondary .widget h4, #site-menu .widget h4, .lookbook-product, article, .woocommerce.widget_layered_nav li, article h2.post-title, .horizontal .horizontal-menu-wrapper ul.navigation > li > a, 
 .product-filters h4.widget-title, .woocommerce ul.products.list li:after, .woocommerce.widget_product_categories li, 
 .product-filters-wrap, .woocommerce .woocommerce-ordering select, .woocommerce-page .woocommerce-ordering select, nav.gridlist-toggle a, 
.summary .product_meta, .summary .product_meta > span, .woocommerce div.product .woocommerce-tabs, 
body.vertical-layout .mega-clone, body.vertical-layout .sub-clone,
.wpb_tabs_nav:before, .wpb_tabs_nav:after , 
.taxonomy-menu:before, .taxonomy-menu:after , 
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header, .vc_toggle_title  { border-color:rgba(221, 51, 51, 0.6);
}
article.sticky { box-shadow: inset 0 0 0px 1px rgba(221, 51, 51, 0.6); 
}
/* WooCommerce stars color */
.woocommerce .star-rating:before, .woocommerce-page .star-rating:before, .star-rating span:before { color:#81d742;
}
/* SITE TITLE FONT SIZE */
#site-title h1, .stick-it-header h1 {
 font-size: 100%;
}

/* PAGE BACK COLOR  */
#page {
background-color: rgba(242, 242, 242, 1);
}

/* ONEPAGER BACK COLOR  */
.aq_block_onepager_menu { 
background-color: rgba(242, 242, 242, 0.9);  
}

.product-filters-wrap { 
background-color: rgba(242, 242, 242, 0.9); 
}

/* FOOTER BACK COLOR  */
footer { 
background-color: rgba(237, 227, 227, 0.8); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ccede3e3", endColorstr="#ccede3e3",GradientType=0 );  
}

/* COLOR PALLETES: */
.accent-1-transp-90 {
  background-color: rgba(221, 51, 51, 0.1); }

.accent-1-transp-70 {
  background-color: rgba(221, 51, 51, 0.3); }

.accent-1-transp-60 {
  background-color: rgba(221, 51, 51, 0.4); }

::-moz-selection {
  background: rgba(221, 51, 51, 0.4); }

::selection {
  background: rgba(221, 51, 51, 0.4); }

.accent-1-light-45, .owl-prev, .prev, .owl-next, .next {
  background-color: #fef8f8; }

.accent-1-light-40, .owl-prev:hover, .prev:hover, .owl-next:hover, .next:hover {
  background-color: #fae2e2; }

.accent-1-light-30 {
  background-color: #f3b6b6; }
h2.post-title, .accent-2-a {
  background-color: rgba(119, 119, 119, 0.2); }

.accent-2-b {
  background-color: rgba(119, 119, 119, 0.4); }

.accent-2-c {
  background-color: rgba(119, 119, 119, 0.7); }

.accent-2-light-47 {
  background-color: #efefef; }

.accent-2-light-40 {
  background-color: #ddd; }

.accent-2-light-30 {
  background-color: #c4c4c4; }

h2.post-title {
  padding: 1rem; }

article > a.author {
  padding: 0.5rem 1rem; }
/* HEADER SIZES ADJUST */
.header-bar {
  height: 6rem; }

.right-button, .left-button {
  padding: 2.8975rem; }
/* HEADER COLOR */
.header-bar {
  background-color: rgba(244, 244, 235, 0.95); }


 /* THEME OPTIONS CUSTOM CSS STYLES */

 #secondary .widget h4, #site-menu .widget h4, .product-filters h4.widget-title, .bottom-widgets .widget h4, footer .widget h5, .custom-widget-area h4, .custom-widget-area h5 {
  font-weight: 400;
  font-size: 0.8rem;
}
';

echo wp_kses_decode_entities($skin_styles);

?>