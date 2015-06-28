<?php

function as_banner_func( $atts, $content = null ) { 
  		
	extract( shortcode_atts( array(
		'text_padding'		=> '',
		'css'				=> '',
				
		'title' 			=> '',
		'subtitle' 			=> '',
		'text'				=> '',
		'wp_autop'			=> '',
		'title_size'		=> 'large',
		'text_color'		=> '',
		'text_align'		=> 'center',
		'disable_invert'	=> '',
		'block_overlay'		=> '',
		'block_opacity'		=> '',
		'overlay'			=> '',
		'banner_height'		=> '',
		'border'			=> 'none',
		'button_label'		=> '',
		'link_button'		=> '',
		'outlined'			=> '',
		'enter_anim'		=> 'fadeIn',
		'anim_delay'		=> '',
		'css_classes'		=> '',
		'block_id'			=> generateRandomString()
		  
	), $atts ) );
	
	/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */

	$button 	= vc_build_link( $link_button );
	$but_url	= $button['url'];
	$but_title	= $button['title'];
	$but_target	= $button['target'];
	
	####################  HTML STARTS HERE: ###########################
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;	
	?>

	<?php echo (  $but_url && !$button_label ) ? '<a href="'.esc_url( $but_url ).'" '. ($but_target ? 'target="'.esc_attr($but_target).'"' : '') .''. ($but_title ? 'title="'.esc_attr($but_title).'"' : '') .'>' : null; ?>
	
	<?php

	
	// SCOPED CSS (BLOCK GENERAL):
	if(  $block_opacity || $banner_height  ) {
		echo '<style scoped>';
		echo '#banner-block-'. esc_attr($block_id).' { ';
		echo $block_opacity ? 'opacity:'. esc_attr($block_opacity) / 100 .'; filter: alpha(opacity='. esc_attr($block_opacity) .');-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity='. esc_attr($block_opacity) .')"; ' : '';
		echo $banner_height ? 'height:' .$banner_height. ';' : '';
		echo '}';
		echo '</style>';	
	}
	
	
	// SCOPED CSS (TEXT):
	if( $title || $subtitle || $text ) {
		echo '<style scoped>#banner-block-'.$block_id.' .text-holder  { color: '.$text_color.'; text-align: '. $text_align.';} </style>';
	}
	
	// SCOPED CSS ( OVERLAY ):
	if( $block_overlay ) {
		echo '<style scoped>';
		echo '#banner-block-'. $block_id.' .banner-overlay { ';
		echo 'background-color: '.$block_overlay.';';
		echo '}';
		echo '</style>';
	}
	
	$vc_css_class =  vc_shortcode_custom_css_class( $css, ' '  );
	?>
	
	<div id="banner-block-<?php echo esc_attr($block_id); ?>" class="banner-block content-wrapper<?php echo ($enter_anim != 'none') ? ' to-anim' :'';  ?><?php echo $disable_invert ? ' disable-invert' : null; ?> <?php echo esc_attr($vc_css_class) ; ?>">
	
		<input type="hidden" class="varsHolder" data-boxColor = "<?php echo esc_attr($overlay); ?>"  data-fontColor = "<?php echo esc_attr($text_color); ?>" />
		
		<?php 
		
		if( $block_overlay ) {
			echo '<div class="banner-overlay"></div>';
		}
		
		$padd = 'style="padding:'. ( $text_padding ? $text_padding  : '3rem' ) . '; "';
		
		echo '<div class="text-holder '. $text_align .'" '. $padd .'>';

			// SCOPED CSS:
			echo '<style scoped>';
			$double_border = ($border == 'double') ? 'border-width: 4px;' : '';
			echo '#banner-block-'.$block_id.' .text-holder:before { ';
			echo $border ? 'border-style: '.$border.'; '.$double_border.'; ' : '';
			echo '}';
			

			echo $overlay ? '#banner-block-'.$block_id.' .item-overlay { background-color: '.$overlay.';' : '';
			echo '}';
			
			
			echo '</style>';
			
			echo $overlay ? '<div class="item-overlay"></div>' : ''; 
					
			echo $title ? '<h3 class="'. $title_size .' box-title">'. esc_html( $title ).'</h3>' :  null; 
			
			echo $subtitle ? '<div class="block-subtitle">'. esc_html( $subtitle ).'</div>' :  null; 
			
			echo $content ? '<div class="text">' : null; 
				/* 
				$wp_autop = ( isset($wp_autop) ) ? $wp_autop : 0;
				if( $wp_autop == 1 ){
					echo do_shortcode(htmlspecialchars_decode($text));
				}
				else {
					echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
				}
				*/
				echo wp_kses_post($content);
			
			echo $content ? '</div>' : null; 

			if ( $button_label && $but_url ) {
				
				echo '<div class="clearfix"></div>';
			
				if( $outlined && $text_color ) {
				
					echo '<div class="scopediv">';
				
					echo '<style scoped>.scopediv a#button-'.$block_id.' { color: '.$text_color.'; border-color: '.$text_color.' !important ; -moz-border-left-colors: '.$text_color.'; -moz-border-right-colors: '.$text_color.'; -moz-border-top-colors: '.$text_color.'; -moz-border-bottom-colors: '.$text_color.'}</style>';
				}
			
							
				echo '<a href="'.esc_url( $but_url ).'"'. ($but_target ? ' target="'.esc_attr($but_target).'" ' : '') .' class="button'. ($outlined ? ' outlined' : '') .'" '.($but_title ? 'title="'.esc_attr($but_title).'"' : 'title="'.esc_attr($button_label).'"') .' id="button-'.$block_id.'">';
				
				echo esc_html( $button_label );
				
				echo '</a>';
				
				echo ( $outlined && $text_color ) ? '</div>' : '';
			} 
			
		echo '</div>'; // .text-holder
		
		?>

		<div class="clearfix"></div>
		
	</div>
	
	<?php
	####################  HTML ENDS HERE: ###########################
	echo $css_classes ? '</div>' : null;
	?>
	
	<?php if( $enter_anim != 'none') { ?>
	
	<?php $delay = $anim_delay ? $anim_delay : 100 ?>
	
	<script>
	jQuery(document).ready( function($) {
		
		var thisBlock = $('#banner-block-<?php echo esc_js($block_id);?>');
		
		if ( !window.isMobile && !window.isIE9 ) {

			thisBlock.waypoint(
			
				function(direction) {
					
					if( direction === "up" ) {	
						
						thisBlock.removeClass('animated <?php echo esc_js($enter_anim);?>').addClass('to-anim');
						
					}else if( direction === "down" ) {
						
						setTimeout(function(){
						   thisBlock.addClass('animated <?php echo esc_js($enter_anim);?>').removeClass('to-anim');
						}, <?php echo esc_js($delay); ?>);
					}
				}, 
				{ offset: "98%" }	
			
			);

		}else{
	
			thisBlock.each( function() {
				
				$(this).removeClass('to-anim');
			
			});
			
		}
	
	});
	</script>
	
	<?php } // end if( $enter_anim != 'none' )?>
	
	<?php echo (  $but_url && !$button_label ) ? '</a>' : null; ?>
	
	<div class="clearfix"></div>
	
	<?php 
	####################  HTML OUTPUT ENDS HERE: ###########################
	$output_string = ob_get_contents();
	   
	ob_end_clean();
		
	return $output_string ;
	
}

add_shortcode( 'as_banner', 'as_banner_func' );?>