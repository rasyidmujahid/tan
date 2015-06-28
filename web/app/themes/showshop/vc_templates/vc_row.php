<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'			=> '',
    'bg_image'			=> '',
    'bg_color'			=> '',
    'bg_image_repeat'	=> '',
    'font_color'		=> '',
    'padding'			=> '',
    'margin_bottom'		=> '',
    'css'				=> '',
	// AS EDIT
    'boxed'				=> '',
    'parallax'			=> '',
    'accent_color'		=> '',
	'grid_spacing'		=> '',
	'equalize'			=> '',
	'overlay_color'		=> '',
	'overlay_opacity'	=> '',
	'videourl'			=> '',
	
	'htmlfivevideo'		=> '',
	'autoplay'			=> '',
	'mute'				=> '',
	//'showControls'		=> true,
	'optimizedisplay'	=> '',
	'loop'				=> '',
	'quality'			=> '',
	'ratio'				=> '',
	'volume'			=> '',
	
), $atts));

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


################################################## AS EDIT
$id				= generateRandomString();
$parallax_css	= $parallax ? 'parallax-'. $id : '';

$scoped_css = '';
$grid_spacing_css = '';
if( $grid_spacing == "yes" ) {

	$grid_spacing_css .= ( $grid_spacing == 'yes' ) ? ' grid-spacing' : '';
}

// IF TO LOAD VIDEO:

if( $videourl ) {

	if( !wp_script_is( 'YTPlayer', 'enqueued' )) {
		wp_register_script( 'YTPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.min.js');
		wp_enqueue_script( 'YTPlayer' );
	}
	
	$video_data_property = array(
		'videoURL'			=> '\''. $videourl.'\'',
		'containment'		=> '\'self\'',
		'autoPlay'			=> $autoplay == 'yes' ? 1 : 0,
		'mute'				=> $mute == 'yes' ? 1 : 0,
		//'showControls'	=> $showControls,
		'showControls'		=> 'false',
		'optimizeDisplay'	=> $optimizedisplay  == 'yes' ? 1 : 0,
		'loop'				=> $loop == 'yes' ? 1 : 0,
		'quality'			=> '\''. $quality .'\'',
		'ratio'				=> '\''. $ratio .'\'',
		//'volume'			=> $volume
	);
	
	$i = 0;
	$length = count($video_data_property);
	$video_opt_array = '';
	foreach( $video_data_property as $option => $value ) {
		$i++;
		$zarez =  ( $i == $length ) ? '' : ', ';
		$video_opt_array .=  $option . ' : ' . $value . $zarez;
	}
	
}

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$accent = $accent_color ? ' '.$accent_color : '';
?>

<div class="<?php echo esc_attr($css_class) ?> <?php echo esc_attr($parallax_css) ?> <?php echo esc_attr($grid_spacing_css); echo esc_attr($accent); ?>"<?php echo esc_attr($style) ?> id="vc-custom-<?php echo esc_attr($id) ?>" <?php echo $equalize ? 'data-equalizer' : ''?>>

<?php 
// IMAGE OR VIDEO HOLDER: 
if( $videourl ) {
	?>
	<script>
	jQuery(function(){
		if( !window.isMobile ) {
			jQuery("#vc-custom-<?php echo esc_attr($id) ?> .yt-video").mb_YTPlayer();
		}
	});
	</script>
	
	<div class="yt-video" data-property="{<?php echo esc_attr($video_opt_array); ?>}"></div>

	<?php 
}elseif( $htmlfivevideo ) {
	
	$vid_formats = array('.mp4', '.webm', '.ogg');
	$htmlfivevideo  = str_replace( $vid_formats ,'',$htmlfivevideo);

	if ( $htmlfivevideo && !$videourl ) { 
	
	?>
		<video <?php echo ($autoplay == 'yes' ? ' autoplay' : '') ?> <?php echo ($loop == 'yes' ? ' loop' : '') ?> <?php echo ($mute == 'yes' ? ' muted' : '')?> >
			<source src="<?php echo esc_attr($htmlfivevideo) ?>.mp4" type="video/mp4" />
			<source src="<?php echo esc_attr($htmlfivevideo) ?>.webm" type="video/webm" />
			<source src="<?php echo esc_attr($htmlfivevideo) ?>.ogg" type="video/ogg" />
		</video>
	<?php
	} 
}

// OVERLAY DIV
if( $overlay_color ) {
?>

<div class="overlay" style="background-color:<?php echo esc_attr($overlay_color); ?>; opacity: <?php echo esc_attr($overlay_opacity) ?> ; filter: alpha(opacity=<?php echo esc_attr($overlay_opacity * 100 ) ?>); -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo esc_attr($overlay_opacity * 100 ) ?>);"></div>

<?php } ?>

<div class="row<?php echo $boxed ? ' boxed' : '' ?>">

	<div class="inner">
	<?php echo wpb_js_remove_wpautop($content); ?>
	</div>

</div>


</div><?php echo $this->endBlockComment('row'); ?>

<?php
if( $parallax ) {
	
	if ( !wp_script_is( 'parallax', 'enqueued' )) {
		
		wp_register_script( 'parallax', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js');
		wp_enqueue_script( 'parallax' );
	}
	$bck_ratio = 0.1;
	?>
	
	<script>jQuery(document).ready(function(){
		if( !window.isMobile ) {
			jQuery(".<?php echo esc_js($parallax_css) ?>").waypoint( function() {
				jQuery(".<?php echo esc_js($parallax_css) ?>").parallax("50%", <?php echo esc_js($bck_ratio) ?> , true);
			}, { offset: "100%" });
		}
	});</script>
	
<?php } ?>