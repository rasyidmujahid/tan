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
font-family:"Josefin Sans", Helvetica, Arial, sans-serif !important;
font-weight:400;
color:#333333;
}

.button, .onsale, .taxonomy-menu h4, button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select, textarea { 
 font-family: Josefin Sans, Helvetica, Arial, sans-serif !important;
 }

/* HEADING STYLE - GOOGLE FONT */
h1, h2, h3, h4, h5, h6 { 
font-family: "Lobster", Helvetica, Arial, sans-serif !important;
font-weight: 400;
color: #333333;
text-transform: none !important;
display: block !important;}

h1.page-title:before, h1.archive-title:before, .block-title.center:before { left: 0; right: 0; }}

/* ITEM OVERLAY COLOR */
.item-overlay { 
background: #ddb3b3; 
 opacity: 0.8;
}

/* LINKS TEXT COLOR */
a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading {
color: #dd4b3e 
}

/* LINKS HOVER TEXT COLOR */
a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover { 
color: #29b581 
}

/* BUTTONS BACK AND TEXT COLORS */
button, .button, a.button, button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
background-color: rgba(221, 75, 62, 1); color: #f9f9f9
}

/* BUTTONS HOVER BACK AND TEXT COLORS */
button:hover, .button:hover, a.button:hover, button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { 
background-color: rgba(41, 181, 129, 1) !important; 
color: #ffffff; 

}
/* HEADER FONT COLOR */
#site-menu, .searchform-header input[type="search"], .mega-clone .desc, .sub-clone .desc { 
color:#424242; 
}

.searchform-header input::input-placeholder,
.searchform-header input::-webkit-input-placeholder,
.searchform-header input:-moz-placeholder,
.searchform-header input:-ms-input-placeholder ,
#yith-ajaxsearchform input::-webkit-input-placeholder, 
#yith-ajaxsearchform input:-moz-placeholder,
#yith-ajaxsearchform input:-ms-input-placeholder{ 
color:#424242; 
}

/* HEADER BACK COLOR */
#site-menu.horizontal { 
background-color:rgba(232, 232, 232, 0.9);  
}

/* SIDEMENU BACK COLOR */
#site-menu.vertical  { 
background-color:rgba(232, 232, 232, 0.9);  
}

.stick-it-header { 
background-color:rgba(232, 232, 232, 0.9 );  
}

/* SUBS, MEGAS and MINI CART back color */
.mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, .secondary .sub-menu { 
background-color: #e8e8e8;  
}

.menu-border:before { 
background-color:#e8e8e8; 
}

.active-mega span { 
border-right-color:#e8e8e8 
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
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header, .vc_toggle_title  { border-color:rgba(221, 75, 62, 0.4);
}
article.sticky { box-shadow: inset 0 0 0px 1px rgba(221, 75, 62, 0.4); 
}
/* LOGO HEIGHT - FOR HORIZ LAYOUT */
.horizontal-layout #site-title h1 img { 
 max-height: 30px 
}

/* SITE TITLE FONT SIZE */
#site-title h1, .stick-it-header h1 {
 font-size: 100%;
}

/* COLOR PALLETES: */
.accent-1-transp-90 {
  background-color: rgba(221, 75, 62, 0.1); }

.accent-1-transp-70 {
  background-color: rgba(221, 75, 62, 0.3); }

.accent-1-transp-60 {
  background-color: rgba(221, 75, 62, 0.4); }

::-moz-selection {
  background: rgba(221, 75, 62, 0.4); }

::selection {
  background: rgba(221, 75, 62, 0.4); }

.accent-1-light-45, .owl-prev, .prev, .owl-next, .next {
  background-color: #fff; }

.accent-1-light-40, .owl-prev:hover, .prev:hover, .owl-next:hover, .next:hover {
  background-color: #fcedeb; }

.accent-1-light-30 {
  background-color: #f4c4c0; }
h2.post-title, .accent-2-a {
  background-color: rgba(41, 181, 129, 0.2); }

.accent-2-b {
  background-color: rgba(41, 181, 129, 0.4); }

.accent-2-c {
  background-color: rgba(41, 181, 129, 0.7); }

.accent-2-light-47 {
  background-color: #d8f6eb; }

.accent-2-light-40 {
  background-color: #bbefdc; }

.accent-2-light-30 {
  background-color: #91e6c6; }
  
h2.post-title {
  padding: 1rem; }

article > a.author {
  padding: 0.5rem 1rem; }
/* HEADER SIZES ADJUST */
.header-bar {
  height: 5rem; }

.right-button, .left-button {
  padding: 2.3975rem; }
/* HEADER COLOR */
.header-bar {
  background-color: rgba(232, 232, 232, 0.9); }


 /* THEME OPTIONS CUSTOM CSS STYLES */

 #secondary .widget h4, #site-menu .widget h4, .product-filters h4.widget-title, .bottom-widgets .widget h4, footer .widget h5, .custom-widget-area h4, .custom-widget-area h5 {
  color: inherit;
  background-color: rgba(0, 0, 0, 0.1);
  text-align: left;
  font-size: 1rem;
  padding: 0.5rem;
  letter-spacing: 0.1rem;
}
h1.page-title:after, h1.archive-title:after, .block-title:after {
  position: absolute;
  width: 100px;
  border-top: 3px solid;
  left: 50%;
  margin-left: -50px;
  bottom: -5px;
}
.block-title.float_right:after {
  left: auto;
  right: 0;
margin-left: 0;
}
.block-title.float_left:after {
  left: 0;
margin-left: 0;
}
';

echo wp_kses_decode_entities($skin_styles);

?>