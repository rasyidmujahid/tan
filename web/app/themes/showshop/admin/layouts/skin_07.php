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
font-family:"Arvo", Helvetica, Arial, sans-serif !important;
font-weight:400;
color:#333333;
/* BODY BACKGROUND */
background-image: url('. get_template_director_uri() .'/img/wf_slide_1_bck1.jpg);
 background-repeat: no-repeat;
background-position: left;
background-attachment: fixed;
}

.button, .onsale, .taxonomy-menu h4, button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select, textarea { 
 font-family: Arvo, Helvetica, Arial, sans-serif !important;
 }

/* HEADING STYLE - GOOGLE FONT */
h1, h2, h3, h4, h5, h6 { 
font-family: "Abril Fatface", Helvetica, Arial, sans-serif !important;
font-weight: 400;
}

}

/* ITEM OVERLAY COLOR */
.item-overlay { 
background: #1e73be; 
 opacity: 0.6;
}

/* LINKS TEXT COLOR */
a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading {
color: #51708e 
}

/* LINKS HOVER TEXT COLOR */
a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover { 
color: #0f5584 
}

/* BUTTONS BACK AND TEXT COLORS */
button, .button, a.button, button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
background-color: rgba(68, 149, 196, 1); color: #f2f2f2
}

/* BUTTONS HOVER BACK AND TEXT COLORS */
button:hover, .button:hover, a.button:hover, button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { 
background-color: rgba(15, 85, 132, 1) !important; 
color: #ffffff; 

}
/* HEADER BACK COLOR */
#site-menu.horizontal { 
background-color:rgba(249, 234, 234, 0.95);  
}

/* SIDEMENU BACK COLOR */
#site-menu.vertical  { 
background-color:rgba(249, 234, 234, 0.95);  
}

.stick-it-header { 
background-color:rgba(249, 234, 234, 0.9 );  
}

/* SUBS, MEGAS and MINI CART back color */
.mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, .secondary .sub-menu { 
background-color: #f9eaea;  
}

.menu-border:before { 
background-color:#f9eaea; 
}

.active-mega span { 
border-right-color:#f9eaea 
}

/* UNDER PAGE TITLE IMAGE OPACITY */
.header-background{ 
opacity: 0.6 !important;
} 

/* BREADCRUMBS FONT COLOR */
.breadcrumbs span, .breadcrumbs span:hover, .breadcrumbs a,.breadcrumbs a:hover, .woocommerce-breadcrumb, .woocommerce-breadcrumb span,.woocommerce-breadcrumb a  { 
color: #ffffff;
} 

/* SITE TITLE FONT SIZE */
#site-title h1, .stick-it-header h1 {
 font-size: 100%;
}

/* PAGE BACK COLOR  */
#page {
background-color: rgba(255, 255, 255, 0.8);
}

/* ONEPAGER BACK COLOR  */
.aq_block_onepager_menu { 
background-color: rgba(255, 255, 255, 0.9);  
}

.product-filters-wrap { 
background-color: rgba(255, 255, 255, 0.9); 
}

/* FOOTER BACK COLOR  */
footer { 
background-color: rgba(237, 214, 214, 0.8); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ccedd6d6", endColorstr="#ccedd6d6",GradientType=0 );  
}

/* COLOR PALLETES: */
.accent-1-transp-90 {
  background-color: rgba(68, 149, 196, 0.1); }

.accent-1-transp-70 {
  background-color: rgba(68, 149, 196, 0.3); }

.accent-1-transp-60 {
  background-color: rgba(68, 149, 196, 0.4); }

::-moz-selection {
  background: rgba(68, 149, 196, 0.4); }

::selection {
  background: rgba(68, 149, 196, 0.4); }

.accent-1-light-45, .owl-prev, .prev, .owl-next, .next {
  background-color: #f2f8fb; }

.accent-1-light-40, .owl-prev:hover, .prev:hover, .owl-next:hover, .next:hover {
  background-color: #dfedf5; }

.accent-1-light-30 {
  background-color: #b8d7e9; }
h2.post-title, .accent-2-a {
  background-color: rgba(15, 85, 132, 0.2); }

.accent-2-b {
  background-color: rgba(15, 85, 132, 0.4); }

.accent-2-c {
  background-color: rgba(15, 85, 132, 0.7); }

.accent-2-light-47 {
  background-color: #90cbf2; }

.accent-2-light-40 {
  background-color: #70bcef; }

.accent-2-light-30 {
  background-color: #42a6ea; }

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
  background-color: rgba(249, 234, 234, 0.95); }


 /* THEME OPTIONS CUSTOM CSS STYLES */

 #secondary .widget h4, #site-menu .widget h4, .product-filters h4.widget-title, .bottom-widgets .widget h4, footer .widget h5, .custom-widget-area h4, .custom-widget-area h5 {
  font-weight: 400;
  font-size: 0.9rem;
}
.taxonomy-menu li.category-link a, .taxonomy-menu li.one-pager-item a, .wpb_tabs_nav li a, select.sort-options {
  font-weight: 400;
}
';

echo wp_kses_decode_entities($skin_styles);

?>