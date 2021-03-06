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
font-family:"Lato", Helvetica, Arial, sans-serif !important;
font-weight:400;
color:#333333;
/* BODY BACKGROUND */
background-image: url('. get_template_directory_uri() .'/img/bg/symphony.png);
background-repeat: repeat;
background-position: center;
background-attachment: scroll;
background-color: #e8e8e8;
}

.button, .onsale, .taxonomy-menu h4, button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select, textarea { 
 font-family: Lato, Helvetica, Arial, sans-serif !important;
 }

/* HEADING STYLE - GOOGLE FONT */
h1, h2, h3, h4, h5, h6 { 
font-family: "Montserrat", Helvetica, Arial, sans-serif !important;
font-weight: 400;
}

/* ITEM OVERLAY COLOR */
.item-overlay { 
background: #f9dbf9; 
 opacity: 0.3;
}

/* LINKS TEXT COLOR */
a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading {
color: #e85eed 
}

/* LINKS HOVER TEXT COLOR */
a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover { 
color: #66a834 
}

/* BUTTONS BACK AND TEXT COLORS */
button, .button, a.button, button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
background-color: rgba(232, 94, 237, 1); color: #ffffff
}

/* BUTTONS HOVER BACK AND TEXT COLORS */
button:hover, .button:hover, a.button:hover, button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { 
background-color: rgba(102, 168, 52, 1) !important; 
color: #ffffff; 

}
/* HEADER BACK COLOR */
#site-menu.horizontal { 
background-color:rgba(252, 252, 252, 0.95);  
}

/* SIDEMENU BACK COLOR */
#site-menu.vertical  { 
background-color:rgba(252, 252, 252, 0.95);  
}

.stick-it-header { 
background-color:rgba(252, 252, 252, 0.9 );  
}

/* SUBS, MEGAS and MINI CART back color */
.mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, .secondary .sub-menu { 
background-color: #fcfcfc;  
}

.menu-border:before { 
background-color:#fcfcfc; 
}

.active-mega span { 
border-right-color:#fcfcfc 
}

/* UNDER PAGE TITLE IMAGE OPACITY */
.header-background{ 
opacity: 0.6 !important;
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
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header, .vc_toggle_title  { border-color:rgba(232, 94, 237, 0.3);
}
article.sticky { box-shadow: inset 0 0 0px 1px rgba(232, 94, 237, 0.3); 
}
/* LOGO HEIGHT - FOR HORIZ LAYOUT */
.horizontal-layout #site-title h1 img { 
 max-height: 40px 
}

/* SITE TITLE FONT SIZE */
#site-title h1, .stick-it-header h1 {
 font-size: 100%;
}

/* PAGE BACK COLOR  */
#page {
background-color: rgba(255, 255, 255, 0.7);
}

/* ONEPAGER BACK COLOR  */
.aq_block_onepager_menu { 
background-color: rgba(255, 255, 255, 0.9);  
}

.product-filters-wrap { 
background-color: rgba(255, 255, 255, 0.9); 
}

/* COLOR PALLETES: */
.accent-1-transp-90 {
  background-color: rgba(232, 94, 237, 0.1); }

.accent-1-transp-70 {
  background-color: rgba(232, 94, 237, 0.3); }

.accent-1-transp-60 {
  background-color: rgba(232, 94, 237, 0.4); }

::-moz-selection {
  background: rgba(232, 94, 237, 0.4); }

::selection {
  background: rgba(232, 94, 237, 0.4); }

.accent-1-light-45, .owl-prev, .prev, .owl-next, .next {
  background-color: #fff; }

.accent-1-light-40, .owl-prev:hover, .prev:hover, .owl-next:hover, .next:hover {
  background-color: #fff; }

.accent-1-light-30 {
  background-color: #fce8fc; }
h2.post-title, .accent-2-a {
  background-color: rgba(102, 168, 52, 0.2); }

.accent-2-b {
  background-color: rgba(102, 168, 52, 0.4); }

.accent-2-c {
  background-color: rgba(102, 168, 52, 0.7); }

.accent-2-light-47 {
  background-color: #e4f3d9; }

.accent-2-light-40 {
  background-color: #d1ebbd; }

.accent-2-light-30 {
  background-color: #b6df96; }
  
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
  background-color: rgba(252, 252, 252, 0.95); }
';

echo wp_kses_decode_entities($skin_styles);

?>