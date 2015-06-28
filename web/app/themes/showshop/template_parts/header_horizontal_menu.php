<?php 
$walker = new My_Walker;
wp_nav_menu( array( 
		'theme_location'	=> 'horizontal-menu',
		//'menu'			=> 'Horizontal',
		'walker'			=> $walker,
		'link_before'		=> '',
		'link_after'		=> '',
		'menu_id'			=> 'horizontal-menu',
		'menu_class'		=> 'navigation',
		'container'			=> false
		) 
	);
?>