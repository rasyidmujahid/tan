<?php
/**
 *	HEADER ORIENTATION
 *
 */
if( isset($_GET['demo_orientation']) ) {
	if( $_GET['demo_orientation'] == 'horizontal') {
		$as_of['orientation'] = 'horizontal';
	}elseif($_GET['demo_orientation'] == 'vertical'){
		$as_of['orientation'] = 'vertical';
	}
}

/**
 *	HEADER TYPES
 *
 */
if( isset($_GET['horizontal_layouts']) ) {
	$as_of['horizontal_layouts'] = $_GET['horizontal_layouts'];
}



/**
 *	SHOP
 *
 */
// COLUMNS IN CATALOG
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '3_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 3;
	}
}
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '4_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 4;
	}
}
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '5_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 5;
	}
}
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '6_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 6;
	}
}

// FULL WIDTH IN SINGLE PRODUCT PAGE
if( isset($_GET['single_full_width'])  ) {

	if( $_GET['single_full_width'] == true ) {
		$as_of['single_full_width'] = true;
	}
}
// DIFFERENT SINGLE PRODUCT IMAGE - MAGNIFIER
if( isset($_GET['single_product_images'])  ) {

	if( $_GET['single_product_images'] == 'magnifier' ) {
		$as_of['single_product_images'] = 'magnifier';
	}
}

?>