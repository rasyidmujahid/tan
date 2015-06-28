<?php
function as_social_func( $atts, $content = null ) {

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
		
		'size'			=> '',
		'align'			=> '',
		'items'			=> '',
		
		'facebook'		=> '',
		'twitter'		=> '',
		'instagram'		=> '',
		'linkedin'		=> '',
		'gplus'			=> '',
		'pinterest'		=> '',
		'tumblr'		=> '',
		'dribbble'		=> '',
		'skype'		=> '',
			
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	

####################  HTML STARTS HERE: #########################

ob_start();
echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );


echo '<div class="social-block '. esc_attr($size).' '.esc_attr($align). ' '. esc_attr($items).'" id="social-'.$block_id.'">';

	
	echo '<div class="table"><div class="tablerow">'; // table layout start

		echo $facebook	? '<a class="tablecell facebook tip-top" href="' .esc_attr( $facebook ). '" target="_blank" title="Facebook" data-tooltip><span class="icon-facebook"></span></a>' : '';
		
		echo $twitter 	? '<a class="tablecell twitter tip-top" href="' .esc_attr( $twitter ). '" target="_blank" title="Twitter" data-tooltip><span class="icon-twitter"></span></a>' : '';
		
		echo $instagram	? '<a class="tablecell instagram tip-top" href="' .esc_attr( $instagram ). '" target="_blank" title="Instagram" data-tooltip><span class="icon-instagram"></span></a>' : '';
		
		echo $linkedin	? '<a class="tablecell linkedin tip-top" href="' .esc_attr( $linkedin ). '" target="_blank" title="LinkedIn" data-tooltip><span class="icon-linkedin"></span></a>' : '';
		
		echo $gplus	? '<a class="tablecell gplus tip-top" href="' .esc_attr( $gplus ). '" target="_blank" title="Google plus" data-tooltip><span class="icon-google-plus"></span></a>' : '';
		
		echo $pinterest	? '<a class="tablecell pinterest tip-top" href="' .esc_attr( $pinterest ). '" target="_blank" title="Pinterest" data-tooltip><span class="icon-pinterest"></span></a>' : '';
		
		echo $tumblr	? '<a class="tablecell tumblr tip-top" href="' .esc_attr( $tumblr ). '" target="_blank" title="Tumblr" data-tooltip><span class="icon-tumblr"></span></a>' : '';
		
		echo $dribbble	? '<a class="tablecell dribbble tip-top" href="' .esc_attr( $dribbble ). '" target="_blank" title="Dribbble" data-tooltip><span class="icon-dribbble"></span></a>' : '';

		echo $skype	? '<a class="tablecell skype tip-top" href="' .esc_attr( $skype ). '" target="_blank" title="Skype" data-tooltip><span class="icon-skype"></span></a>' : '';
	
	echo '</div></div>'; // table layout end

echo '</div>';//end .social-block

####################  HTML ENDS HERE: ###########################
echo $css_classes ? '</div>' : null;
	
$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}

add_shortcode( 'as_social', 'as_social_func' );
?>