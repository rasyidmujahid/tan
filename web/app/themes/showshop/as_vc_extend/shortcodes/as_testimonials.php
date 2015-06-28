<?php
function as_testimonials_func( $atts, $content = null ) {

extract( shortcode_atts( array(
		'title'			=> '',
		'subtitle'		=> '',
		'sub_position'	=> 'bellow',
		'title_style'	=> 'center',
		'title_color'	=> '',
		'subtitle_color'=> '',
		'no_title_shadow'		=> '',
		'title_size'		=> '',
		'enter_anim'	=> 'fadeIn',
		
		'align'			=> '',
		'images'		=> '',
		'image_style'	=> '',
		'authors'		=> '',
		'text_color'	=> '',
		'author_color'	=> '',
		
		'slider_navig'	=> '',
		'slider_pagin'	=> '',
		'slider_timing'	=> '',
		'items_desktop'	=> '',
		'items_tablet'	=> '',
		'items_mobile'	=> '',
	
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	
/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */

####################  HTML STARTS HERE: #########################

ob_start();
echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

echo '<div id="tesimonial-slides-'. esc_attr($block_id) .'" class="as_vc_block_items '. esc_attr($css_classes) .'">';

do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
?>

<?php
$img_arr = explode(',', $images);
$auth_arr = explode(',', $authors);

$content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

$testimonial_arr = preg_split("/\r\n|\n|\r/", $content);


echo '<input type="hidden" class="slides-config" data-navigation="'. ($slider_navig ? '0' : '1') .'" data-pagination="'. ($slider_pagin ? '0' : '1') .'" data-auto="'. esc_attr($slider_timing) .'" data-desktop="'. esc_attr($items_desktop) .'" data-tablet="'. esc_attr($items_tablet) .'" data-mobile="'. esc_attr($items_mobile) .'" data-loop="true"  />';

?>
<div class="testimonials<?php echo (count($testimonial_arr) > 1) ? ' owl-carousel contentslides' : ''; echo esc_attr( ' '.$align ); ?> ">

<?php 
$i = 0;
$anim = ($enter_anim != 'none') ? ' to-anim' : '';
$output = '';
foreach( $testimonial_arr as $testimonial ) {
	
	$img	= isset($img_arr[$i]) ? $img_arr[$i] : '';
	$author = isset($auth_arr[$i]) ? $auth_arr[$i] : '';
					
	$output .= '<div class="testimonial-item column item '. esc_attr($anim) .'" data-i="'. esc_attr($i) .'">';

		if( $img ) {
			
			$output .= '<div class="image '. esc_attr($image_style) .'"><div class="image-container">';
			
				$attr = array(
					'class' => 'attachment-image',
					'title'	=> $author ? esc_attr($author) : '',
					'alt'	=> $author ? esc_attr($author) : ''
				);
				
				$output .= wp_get_attachment_image( $img, 'thumbnail', false,  $attr ); 
			
			$output .= '</div></div>'; // .image-container .image
		}
		
		
		$no_img = !$img ? ' width: 100%;' : '';
		
		$output .= '<div class="content"'. ( $text_color ? ' style="color:'.$text_color.';'.$no_img.'"' : '').'>';
		
			$output .= '<div class="inner">'. $testimonial .'</div>';
			
			$a_color = $author_color ? ' style="color:'. esc_attr($author_color) .';"' : '';
			
			$output .= $author ? ('<h4'. $a_color .'>'. esc_html($author) .'</h4>') : '';
			
		$output .= '</div>'; // .content
	
	$output .= '</div>'; // .testimonial-item
	$i++;
}

echo wp_kses_post($output);
?>

</div>
<script>
(function( $ ){
	$.fn.anim_waypoints_img_tests = function(blockId, enter_anim) {
		
		var thisBlock = $('#tesimonial-slides-'+ blockId );
		if ( !window.isMobile && !window.isIE9 ) {
			var item = thisBlock.find('.testimonial-item');
			
			item.waypoint(
				function(direction) {
					var item_ = $(this);
					if( direction === "up" ) {	
						item_.removeClass('animated '+ enter_anim).addClass('to-anim');
					}else if( direction === "down" ) {
						var i =  $(this).attr('data-i');
						setTimeout(function(){
						   item_.addClass('animated '+ enter_anim).removeClass('to-anim');
						}, 50 * i);
					}
				}
				
			,{ offset: "98%" });
		}else{
			thisBlock.find('.single-slide').each( function() {
				$(this).removeClass('to-anim');
			});
		}
		
	}
})( jQuery );

jQuery(document).ready( function($) {
	
	$(document).anim_waypoints_img_tests("<?php echo esc_js($block_id); ?>"," <?php echo esc_js($enter_anim);?>");

});
</script>

<?php 

echo '</div>'; // #testimonial-slides

echo $css_classes ? '</div>' : null;
	
$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}

add_shortcode( 'as_testimonials', 'as_testimonials_func' );
?>