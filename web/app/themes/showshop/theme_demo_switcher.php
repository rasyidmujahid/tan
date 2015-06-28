<div id="style_switcher" class="demo-controls">

	<?php	
	if(!empty($_COOKIE['_theme'])) $style = $_COOKIE['_theme'];
        else $style = "none";
		
	$themes_folder = get_theme_root_uri();
	$my_theme = wp_get_theme();
	$theme_folder = $themes_folder . '/showshop.' . $my_theme->Version;
	
	$dl =  get_template_directory_uri() .'/admin/images';
	
	$buy = 'http://themeforest.net/item/showshop-clean-fashion-woocommerce-theme/11616293?ref=aligatorstudio';
	?>
	
	<div id="toggle" class="icon-cog button tiny" title="Demo options"></div>
	
	<div id="buy"  class="icon-shopping63 button tiny"><a href="<?php echo esc_url( $buy ); ?>" title="Buy this item on Theme forest"></a></div> 
	
	<div><h5>Select theme skins:</h5></div>

	<hr>
	
	<div id="options">
		<div><a href="javascript:void(0)" id="skin_01" class="button tiny">Skin 1</a></div>
		<div><a href="javascript:void(0)" id="skin_02" class="button tiny">Skin 2</a></div>
		<div><a href="javascript:void(0)" id="skin_03" class="button tiny">Skin 3</a></div>
		<div><a href="javascript:void(0)" id="skin_04" class="button tiny">Skin 4</a></div>
		<div><a href="javascript:void(0)" id="skin_05" class="button tiny">Skin 5</a></div>
		<div><a href="javascript:void(0)" id="skin_06" class="button tiny">Skin 6</a></div>
		<div><a href="javascript:void(0)" id="skin_07" class="button tiny">Skin 7</a></div>
		<div><a href="javascript:void(0)" id="skin_08" class="button tiny">Skin 8</a></div>
		<div><a href="javascript:void(0)" id="skin_09" class="button tiny">Skin 9</a></div>
		<div><a href="javascript:void(0)" id="skin_10" class="button tiny">Skin 10</a></div>

	</div>
	
	<hr>
	
	<?php
	/* USER ADDED GOOGLE FONTS */
	global $as_of;
	$added_fonts = $as_of["added_google_fonts"];
		
	// SANITIZATION:
	$added_fonts = preg_replace('/[^a-zA-Z0-9, ]/','',$added_fonts ) ;// remove all but numbers, letters, spaces and comma
	$added_fonts = preg_replace('/\s+/', ' ', $added_fonts);// remove multiple spaces
	$added_fonts = str_replace(", ",",", $added_fonts ); // remove space after comma
						
	
	$add_fonts_array_simple = explode(",",$added_fonts );
	$add_fonts_array = array_combine(  $add_fonts_array_simple,  $add_fonts_array_simple );
	$fonts_array = apply_filters("as_google_fonts", $add_fonts_array);
	?>
	
	<div>
		<h5 style="width:100%">Title fonts</h5>
		<select name="titles-fonts" class="fonts-selector titles-fonts">
			<option>--Select font--</option>
			<?php foreach( $fonts_array as $font) {
				echo '<option>' . $font . '</option>';
			}
			?>
		</select>	
	</div>
	
	<div>
		<h5>Body fonts</h5>
		<select name="body-fonts" class="fonts-selector body-fonts">
			<option>--Select font--</option>
			<?php foreach( $fonts_array as $font) {
				echo '<option>' . $font . '</option>';
			}
			?>
		</select>	
	</div>

		
	
	<p class="notice">These skins (style sets) are just a start of theme options possibilities .<br />
		<strong>NOTE: global theme options can be overriden with page builder blocks settings.</strong>
	</p>

</div>


<script>
jQuery(document).ready(function($){
	
	/**
	 *	Google font select
	 *
	 */
	function addGoogleFont(FontName, el) {
		
		$(".google-"+el).remove();
		
		if( FontName ) {
			$("head").append("<link href='http://fonts.googleapis.com/css?family=" + FontName + ":300,400,600,700,800,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css' class='google-"+ el +"'>");
		}
	}

	
	
	$( "select.body-fonts" ).change(function() {
		
		var fontname 		= "";
		var fontname_link	= "";
		$( "select.body-fonts option:selected" ).each(function() {
			fontname = $(this).text();
			fontname_link = fontname.replace(/\ /g, "+");
		
		});
		
		var bodyFonts = "body";
		
		if( fontname !== '--Select font--') {

			addGoogleFont( fontname_link, 'body' );
			$( bodyFonts ).css( "cssText",'font-family:'  + fontname + '!important; ' );
		}else{
			$( bodyFonts ).css( 'font-family', null );
		}
	  });
	 //.trigger( "change" );
	  
	$( "select.titles-fonts" ).change(function() {
		
		var fontname 		= "";
		var fontname_link	= "";
		$( "select.titles-fonts option:selected" ).each(function() {
			fontname = $(this).text();
			fontname_link = fontname.replace(/\ /g, "+");
		
		});
		
		var titles = 'h1, h2, h3, h4, h5, h6 ';
		
		if( fontname !== '--Select font--') {
			
			addGoogleFont( fontname_link, 'titles' );
			$( titles ).css( "cssText",'font-family:'  + fontname + '!important; '  );	
		}else{
			$( titles ).css( 'font-family', null );
		}
		
	  });
	  //.trigger( "change" );
	
	/**
	 *	DEMO STYLES TOGGLER.
	 *
	 */

		/** toggle show/hide demo options: */
		var switcher = false;
		$('#style_switcher #toggle').click(function() {
			if( !switcher ) {
				$(this).parent().animate({'left':-4},{'duration': 200, easing: 'easeInOutQuart'});
				switcher = true;
			}else{
				$(this).parent().animate({'left':-250},{'duration': 200, easing: 'easeInOutQuart'});
				switcher = false;
			}
		});
		
	/** END DEMO STYLES TOGGLER*/

	
});
</script>