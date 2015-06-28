<?php
global $as_of, $as_woo_is_active,  $as_wishlist_is_active;

$search_type = $as_of['search_type'];


if( $search_type == 'advanced' ){ // <---- if "Search and filter" plugin is active
	
	$filter_options	= "";
	$headings		= "";
	$types			= "";	
	
	$asf_fields_arr = $as_of['fields'];
	
	if( count( $asf_fields_arr ) ) {
		foreach( $asf_fields_arr as $asf_fields ) {
			$filter_options	.= $asf_fields['filter'] .',';
			$headings		.= $asf_fields['title'] .',';
			$types			.= $asf_fields['field_type'] .',';
		}	
	}
	
	$types = str_replace('search_input', '', $types);
	
	echo '<div class="searchform-header">';
	
	echo do_shortcode('[searchandfilter fields="'. $filter_options .'"  headings="'. $headings .'" types="'.$types.'"]');
	
	echo '</div>';
	
}elseif ( $as_woo_is_active && $as_wishlist_is_active && $search_type == 'ajax' ) {// <---- if YITH Ajax WooCommerce search is active
	
	echo as_yith_ajax_search();
	

}elseif( $as_woo_is_active &&  $search_type == 'regular_product') { // <---- if only WooCommerce is active
	
	as_get_product_search_form();
	

}elseif( $search_type == 'regular' ){ // <---- lastly, load WP default search	
?>
<div class="searchform-header">

	<form class="form" role="search" method="get" id="searchform-header" action="<?php echo home_url( '/' ); ?>">
		
		<input class="" type="search" placeholder="<?php esc_attr_e('Search here ...','showshop'); ?>" name="s" id="s">
		
		<button type="submit" class="icon-search"></button>
			
	</form>
	
</div>
<?php } ?>