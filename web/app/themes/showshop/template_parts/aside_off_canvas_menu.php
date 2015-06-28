<?php
if( has_nav_menu( 'offcanvas-menu' )) {
	$walker = new My_Walker;
	wp_nav_menu( array( 
			'theme_location'	=> 'offcanvas-menu',
			//'menu'			=> 'Offcanvas',
			'walker'			=> $walker,
			'link_before'		=> '',
			'link_after'		=> '',
			'menu_id'			=> 'offcanvas-menu',
			'menu_class'		=> 'offcanvas offcanvasopen',
			'container'			=> false
			) 
		);
}else{

	echo __("There is no menu set to this offcanvas area","showshop");

}
?>