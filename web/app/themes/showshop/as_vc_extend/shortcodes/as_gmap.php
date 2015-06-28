<?php
function as_gmap_func( $atts, $content = null ) {

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
		'anim_delay'	=> 0,
		// 51.51379710359708 , -0.09957700967788696 this lat/long is London, St. Paul's cathedral ;) ...
		'latitude'		=> '', 
		'longitude'		=> '', 
		'address'		=> '',
		'address2'		=> '',
		'address3'		=> '',
		'address4'		=> '',
		'attach_id'		=> '',
		'width'			=> '100%',
		'height'		=> '420px',
		'map_color'		=> '',
		'map_desatur'	=> '20',
		'zoom'			=> '15',
		'scroll_zoom'	=> true,
		
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	
/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */

wp_register_script('gmap', 'http://maps.googleapis.com/maps/api/js?sensor=true');
wp_enqueue_script ('gmap', 'http://maps.googleapis.com/maps/api/js?sensor=true','', '1.0');
		
	
####################  HTML STARTS HERE: #########################

ob_start();
echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );
?>

<div id="map-<?php echo esc_attr($block_id); ?>-holder" class="content-block inner-wrapper<?php echo ($enter_anim != 'none') ? ' to-anim' :''; echo $css_classes ? ' '. esc_attr($css_classes) : ''; ?>" >

<?php
$add_str  = '<div class="marker">';
$add_str .=  $title   ? '<p><strong>' . esc_html($title).'</strong></p>' : '';
$add_str .=  $address2  ? '<p>' .  esc_html($address2).'</p>' : '';
$add_str .=  $address3  ? '<p>' .  esc_html($address3).'</p>' : '';
$add_str .=  $address4  ? '<p>' .  esc_html($address4).'</p>' : '';
$add_str .=  $attach_id ? '<div class="entry-image">'. wp_get_attachment_image( $attach_id, 'thumbnail' ).'</div>' : '';
$add_str  .= '</div>';

$add_str = wpautop($add_str);
			
// GET LONGITUDE AND LATITUDE BY USING ADDRESS:
$address_flds = $address2 .', '. $address3; 
$prepAddr = str_replace(' ','+',$address_flds);

// IF THERE IS ADDRESS DATA AND NO "MANUAL" LONGITUDE/LATITUDE INPUT
if( $prepAddr && !$latitude && !$longitude ) {
	
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	 
	$output= json_decode($geocode);
	
	//	IF THERE'S AND ERROR IN ADDRESS, AND GOGLE CAN'T FIND IT
	if( empty( $output->results ) || ($output->status != 'OK') ) {
		echo '<h3 style="text-align:center">' . esc_html__("Google maps error","showshop") .' :</h3>';
		echo '<p style="text-align:center">' . esc_html__("Please check your address inputs - there's a probable error in data, or use manual longitude and latitude inputs.","showshop") .'</p>';
		return;
	} 

	$lat = $output->results[0]->geometry->location->lat;
	$long = $output->results[0]->geometry->location->lng;	
}


// IF LATITUDE AND LONGITUDE ARE ENTERED MANUALLY:
if( $latitude && $longitude ) {
	$lat	= $latitude;
	$long	= $longitude;
}

?>

<script type="text/javascript">
function initialize() {

	var leeds = new google.maps.LatLng( <?php echo esc_js($lat); ?>, <?php echo esc_js($long); ?> );

	var firstLatlng = new google.maps.LatLng( <?php echo esc_js($lat) ; ?>, <?php echo esc_js($long); ?> );              

	var firstOptions = {
		scrollwheel: <?php echo esc_js($scroll_zoom) ? 'false' : 'true'; ?>,
		zoom: <?php echo $zoom ? esc_js($zoom) : '16'; ?>,
		center: firstLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP 
	};

	var map = new google.maps.Map(document.getElementById("map-<?php echo esc_js($block_id); ?>"), firstOptions);

	firstmarker = new google.maps.Marker({
		map:map,
		draggable:false,
		animation: google.maps.Animation.DROP,
		title: "<?php echo $title ? esc_js($title) : ''; ?>",
		position: leeds
	});

	
	var contentString1 = <?php echo wp_json_encode($add_str); ?>;

	var infowindow1 = new google.maps.InfoWindow({
		content: contentString1
	});

	google.maps.event.addListener(firstmarker, 'click', function() {
		infowindow1.open(map,firstmarker);
	});
	
	var styles = [
		{
			featureType: "all",
			stylers: [
				{ hue: "<?php echo esc_js($map_color); ?>"},
				{ saturation: -<?php echo esc_js($map_desatur); ?> }
			]
		},{
			featureType: "road.arterial",
			elementType: "geometry",
			stylers: [
				{ hue: "#00FFEE" },
				{ saturation: 50 }
			]
		},{
			featureType: "poi.business",
			elementType: "labels",
			stylers: [
				{ visibility: "on" }
			]
		}
	]

	map.setOptions({styles: styles});

}
</script>

<div class="google-map">

	<div id="map-<?php echo  esc_attr($block_id); ?>" style="width: <?php echo esc_attr($width); ?>; height:<?php echo esc_attr($height);?>"></div>  

</div>

</div>  

<?php $delay = $anim_delay ? $anim_delay : 100 ?>

<script>
jQuery(document).ready( function($) {

var thisBlock = $('#map-<?php echo esc_js($block_id); ?>-holder');

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


<?php
####################  HTML ENDS HERE: ###########################
echo $css_classes ? '</div>' : null;
	
$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}

add_shortcode( 'as_gmap', 'as_gmap_func' );
?>