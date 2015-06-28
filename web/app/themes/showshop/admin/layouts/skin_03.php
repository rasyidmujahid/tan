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
font-family:"Montserrat Alternates", Helvetica, Arial, sans-serif !important;
font-weight:400;
color:#333333;
}

.button, .onsale, .taxonomy-menu h4, button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select, textarea { 
 font-family: Montserrat Alternates, Helvetica, Arial, sans-serif !important;
 }

/* HEADING STYLE - GOOGLE FONT */
h1, h2, h3, h4, h5, h6 { 
font-family: "Quicksand", Helvetica, Arial, sans-serif !important;
font-weight: 400;
}

/* ITEM OVERLAY COLOR */
.item-overlay { 
background: #f7f7f7; 
 opacity: 0.9;
}

/* LINKS TEXT COLOR */
a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading {
color: #1ab2a3 
}

/* LINKS HOVER TEXT COLOR */
a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover { 
color: #4ae2e2 
}

/* BUTTONS BACK AND TEXT COLORS */
button, .button, a.button, button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
background-color: rgba(31, 196, 190, 1); color: #f7f7f7
}

/* BUTTONS HOVER BACK AND TEXT COLORS */
button:hover, .button:hover, a.button:hover, button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { 
background-color: rgba(247, 247, 247, 1) !important; 
color: #3fc1bd; 

}
/* HEADER FONT COLOR */
#site-menu, .searchform-header input[type="search"], .mega-clone .desc, .sub-clone .desc { 
color:#494949; 
}

.searchform-header input::input-placeholder,
.searchform-header input::-webkit-input-placeholder,
.searchform-header input:-moz-placeholder,
.searchform-header input:-ms-input-placeholder ,
#yith-ajaxsearchform input::-webkit-input-placeholder, 
#yith-ajaxsearchform input:-moz-placeholder,
#yith-ajaxsearchform input:-ms-input-placeholder{ 
color:#494949; 
}

/* HEADER BACK COLOR */
#site-menu.horizontal { 
background-color:rgba(255, 255, 255, 0.8);  
}

/* SIDEMENU BACK COLOR */
#site-menu.vertical  { 
background-color:rgba(255, 255, 255, 0.8);  
}

.stick-it-header { 
background-color:rgba(255, 255, 255, 0.9 );  
}

/* SUBS, MEGAS and MINI CART back color */
.mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, .secondary .sub-menu { 
background-color: #ffffff;  
}

.menu-border:before { 
background-color:#ffffff; 
}

.active-mega span { 
border-right-color:#ffffff 
}

/* UNDER PAGE TITLE IMAGE OPACITY */
.header-background{ 
opacity: 0.6 !important;
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
  background-color: rgba(247, 247, 247, 0.1); }

.accent-1-transp-70 {
  background-color: rgba(247, 247, 247, 0.3); }

.accent-1-transp-60 {
  background-color: rgba(247, 247, 247, 0.4); }

::-moz-selection {
  background: rgba(247, 247, 247, 0.4); }

::selection {
  background: rgba(247, 247, 247, 0.4); }

.accent-1-light-45, .owl-prev, .prev, .owl-next, .next {
  background-color: #fff; }

.accent-1-light-40, .owl-prev:hover, .prev:hover, .owl-next:hover, .next:hover {
  background-color: #fff; }

.accent-1-light-30 {
  background-color: #fff; }
h2.post-title, .accent-2-a {
  background-color: rgba(181, 181, 181, 0.2); }

.accent-2-b {
  background-color: rgba(181, 181, 181, 0.4); }

.accent-2-c {
  background-color: rgba(181, 181, 181, 0.7); }

.accent-2-light-47 {
  background-color: #fff; }

.accent-2-light-40 {
  background-color: #fafefe; }

.accent-2-light-30 {
  background-color: #cef7f7; }
  
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
  background-color: rgba(255, 255, 255, 0.8); }

';

echo wp_kses_decode_entities($skin_styles);

?>