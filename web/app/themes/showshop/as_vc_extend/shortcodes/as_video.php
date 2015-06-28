<?php
function as_video_func( $atts, $content = null ) {

extract( shortcode_atts( array(
		'title'			=> '',
		'subtitle'		=> '',
		'sub_position'	=> 'bellow',
		'title_style'	=> 'center',
		'title_color'	=> '',
		'subtitle_color'=> '',
		'no_title_shadow'	=> '',
		'title_size'	=> '',
		
		'site' => 'youtube',
		'id' => '',
		'w' => '100%',
		'h' => '',
	
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );


####################  HTML STARTS HERE: #########################

ob_start();
echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );

if ( $site == "youtube" ) { $src = 'http://www.youtube-nocookie.com/embed/'.$id; }
	else if ( $site == "screenr" ) { $src = 'http://www.screenr.com/embed/'.$id; }
	else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id; }
	else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id; }
	else if ( $site == "yahoo" ) { $src = 'http://d.yimg.com/nl/vyc/site/player.html#vid='.$id; }
	else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
	else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$id; }
	else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/simple/'.$id; 
}
	
if ( $id ) {
	echo '<div class="flex-video"><iframe style="width:'. esc_attr($w).'; height:'. esc_attr($h).';" src="'. esc_url($src).'" class="vid iframe-'.$site.'"></iframe></div>';
}

####################  HTML ENDS HERE: ###########################
echo $css_classes ? '</div>' : null;
	
$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}

add_shortcode( 'as_video', 'as_video_func' );
?>