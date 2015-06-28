<?php
function as_widget_areas_func( $atts, $content = null ) {

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
		
		'css'			=> '',
		'widget_area'	=> '',
		'orientation'	=> 'vertical',
	
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	
/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */

####################  HTML STARTS HERE: #########################

ob_start();

$vc_css_class =  vc_shortcode_custom_css_class( $css, ' '  );

echo ( $css_classes || $vc_css_class ) ? '<div class="'.esc_attr( $css_classes . $vc_css_class  ).'">' : null;

do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );

echo '<div class="custom-widget-area '. esc_attr( $orientation ).' ">';

if ( is_active_sidebar( $widget_area ) ) {
	
	echo '<div>';
	
	dynamic_sidebar( $widget_area );
	
	echo '</div>';
	
}

echo '</div>';

####################  HTML ENDS HERE: ###########################
echo ( $css_classes || $vc_css_class ) ? '</div>' : null;
	
$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}

add_shortcode( 'as_widget_areas', 'as_widget_areas_func' );
?>