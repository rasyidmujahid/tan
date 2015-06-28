<?php
function as_menu_func( $atts, $content = null ) {

extract( shortcode_atts( array(
		'title'			=> '',
		'subtitle'		=> '',
		'sub_position'	=> 'bellow',
		'title_style'	=> 'center',
		'title_color'	=> '',
		'subtitle_color'=> '',
		'no_title_shadow'	=> '',
		'title_size'	=> '',
		
		'enter_anim'	=> 'fadeIn',
		
		'menu'			=> '',
		'orientation'	=> 'vertical',
	
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	
/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */

####################  HTML STARTS HERE: #########################

ob_start();
echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );

echo '<div class="custom-menu '. esc_attr($orientation).'">';

$walker = new My_Walker;
wp_nav_menu( array( 
	'theme_location'	=> 'custom-menu' . $block_id,
	'menu'				=> $menu,
	'walker'			=> $walker,
	'link_before'		=> '',
	'link_after'		=>'',
	'menu_id'			=> 'menu'. $block_id,
	'menu_class'		=> 'custom-nav navigation vertical',
	'container'			=> false
	) 
);

echo '</div>';

####################  HTML ENDS HERE: ###########################
echo $css_classes ? '</div>' : null;
	
$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}

add_shortcode( 'as_menu', 'as_menu_func' );
?>