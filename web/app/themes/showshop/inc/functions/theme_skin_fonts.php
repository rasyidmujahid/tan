<?php
global $as_of, $as_protocol;

$theme_skin = $as_of['theme_skin'];

$body_font_family		= "";
$headings_font_family	= "";


// FONT FAMILIES CHOICE DEPENDING ON WHICH SKIN IS SELECTED :
if( $theme_skin == 'skin_01.php' ) {
	
	$body_font_family 		= "Raleway";
	
}elseif( $theme_skin == 'skin_02.php' ){
	
	$body_font_family 		= "Muli";
	$headings_font_family	= "Playfair+Display";
	
}elseif( $theme_skin == 'skin_03.php' ){
	
	$body_font_family 		= "Montserrat+Alternates";
	$headings_font_family	= "Quicksand";
	
}elseif( $theme_skin == 'skin_04.php' ){
	
	$body_font_family 		= "Lato";
	$headings_font_family	= "Montserrat";
	
}elseif( $theme_skin == 'skin_05.php' ){
	
	$body_font_family 		= "Open+Sans";

}elseif( $theme_skin == 'skin_06.php' ){
	
	$body_font_family 		= "Josefin+Sans";
	$headings_font_family	= "Lobster";
	
}elseif( $theme_skin == 'skin_07.php' ){
	
	$body_font_family 		= "Arvo";
	$headings_font_family	= "Abril+Fatface";
	
}elseif( $theme_skin == 'skin_08.php' ){
	
	$body_font_family 		= "Ek+Mukta";
	$headings_font_family	= "Fjalla+One";
	
}elseif( $theme_skin == 'skin_09.php' ){
	
	$body_font_family 		= "Federo";
	$headings_font_family	= "Old+Standard+TT";
	
}elseif( $theme_skin == 'skin_10.php' ){
	
	$body_font_family 		= "Tienne";
	$headings_font_family	= "Rufina";
}

// IF BODY FONT FAMILY SET:
if( $body_font_family ){
	wp_register_style('theme-skin-body-font', $as_protocol . '://fonts.googleapis.com/css?family=' . $body_font_family . ':300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	wp_enqueue_style( 'theme-skin-body-font' );
}
// IF HEADINGS FONT FAMILY SET:
if( $headings_font_family ){
	wp_register_style('theme-skin-headings-font', $as_protocol . '://fonts.googleapis.com/css?family=' . $headings_font_family . ':300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	wp_enqueue_style( 'theme-skin-headings-font' );
}


?>