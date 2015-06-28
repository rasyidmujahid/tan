<?php
/**
 ************ ADMIN FUNCTIONS ***********
 *
 *	- theme documentation admin toolbar link
 *	- wp toolbar fixes for layout
 *	- custom header styles
 *	- get taxonomies terms in array
 *	- plugin included - unattach media
 *	- contact form functions
 *	- editor in meta box ( put other meta boxes above editor)
 *	- WPML functions
 *	- Widget_first_last_classes
 *	- hex to rgb - needed for css background color styles
 *	- list custom image sizes in media upload
 *	- remove an anonymous function filter.
 *	- DEPRECATED: AS SLUGIFY - convert arbitrary string to slug formated sting
 *	- block non-admin users from admin pages
 *	- allow swg upload function
 *	- remove lookbook page meta everywhere expect in lookbook page template:
 *	- limit number of revisions 
 */
//
// THEME DOCUMENTATION ADMIN TOOLBAR LINK
function as_admin_bar_render() {
    global $wp_admin_bar;
    // REMOVE MENU ITEM, like the Comments link, just by knowing the right $id
    //$wp_admin_bar->remove_menu('comments');
    // REMOVING SUBMENU like New Link.
    //$wp_admin_bar->remove_menu('new-link', 'new-content');
    // we can add a submenu item too
    $wp_admin_bar->add_menu( array(
        //'parent' => 'new-content',
        'id'	=> 'theme_documentation',
        'title'	=> __('THEME DOCUMENTATION','showshop'),
        'href'	=> get_template_directory_uri().'/documentation/',
		'meta'	=>  array( 
				//'html'		=> '',
				'class'		=> 'theme_documentation',
				//'onclick'	=> '',
				'target'	=> '_blank',
				'title'		=> 'Open theme documentation in new window/tab'
				)
    ) );
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'as_admin_bar_render' );
//
//
/**
 *	WP TOOLBAR FIXES FOR LAYOUT
 *
 */
function as_toolbar_check () {
	if ( is_admin_bar_showing() ) {
		
		echo '<style>';
		echo '.tooltip  { margin-top:-40px !important; }';
		echo '#site-menu, .vertical-layout .mega-clone, .mobile-sticky.stuck, .stick-it-header , .st-menu  { top:32px  }';
		echo '@media screen and (max-width: 782px) { html #wpadminbar {  top:-46px; } }';
		echo '@media screen and (max-width: 600px) { .mobile-sticky.stuck { top:0 !important; } }';
		echo '@media screen and (max-width: 782px) { #site-menu-mobile { margin-top: 0px;} }';
		echo '</style>';
	}
}
add_action( 'wp_head', 'as_toolbar_check' );
//
/**
 *	CUSTOM HEADER STYLES
 *  - per post/page basis - infinite header styles
 *	- custom css inserted with wp_head hook 
 */
function custom_header_style () {
	
	global $post;
	
	if( !$post ) {
		return;
	}
	
	$h_back_color		= get_post_meta( $post->ID,'as_head_back_color', true );
	$h_fonts_color		= get_post_meta( $post->ID,'as_head_fonts_color', true );
	$h_links_color		= get_post_meta( $post->ID,'as_head_links_color', true );
	$h_back_opacity		= get_post_meta( $post->ID,'as_head_back_opacity', true );
	$h_border_color		= get_post_meta( $post->ID,'as_head_border_color', true );
	$h_border_opacity	= get_post_meta( $post->ID,'as_head_border_opacity', true );
	$h_image_opacity	= get_post_meta( $post->ID,'as_head_image_opacity', true );
	$page_title_color	= get_post_meta( $post->ID,'as_page_title_color', true );
	
	//echo '<style>#site-menu.horizontal { background: #fc0 !important;" }</style>';
	$h_ba_opacity = $h_back_opacity ? $h_back_opacity : '1';
	
	$custom_style  = '<style>';
	// header background
	$custom_style .= '#site-menu.horizontal:not(.sticked), #site-menu-mobile {';
	$custom_style .=  $h_back_color ? 'background-color:rgba('.hex2rgb( $h_back_color ).', '. $h_ba_opacity  .') !important;' : '';
	$custom_style .=  '}';
	//header fonts
	$custom_style .=  $h_fonts_color ? '#site-menu .topbar-info, #site-menu:not(.sticked) .showshop-head-cart, #site-menu .breadcrumbs span, #site-menu .topbar-toggle { color: '. $h_fonts_color .' }' : '';
	// header links
	$custom_style .=  $h_links_color ? '#site-menu .topbar-info a, #site-menu:not(.sticked) .navigation > li > a, #site-menu .breadcrumbs a { color: '. $h_links_color .' }' : '';
	
	
		$h_bo_opacity = $h_border_opacity ? $h_border_opacity : '1';
		$border_c =  "rgba(".hex2rgb($h_border_color).", ". $h_bo_opacity .")";
	
	// borders in the header
	$custom_style .=  '#site-menu.horizontal .topbar, .horizontal ul.navigation > li > a:before,  #site-menu.horizontal .border-bottom, #site-menu.horizontal .border-top, .searchform-header input[type="search"], .horizontal .horizontal-menu-wrapper ul.navigation > li > a { border-color:'.$border_c.' !important; } ';
	
	// header (page title) image opacity
	$custom_style .=  $h_image_opacity ? '.header-background { opacity: '. $h_image_opacity.' !important; }' : '';
	
	$custom_style .=  $page_title_color ? 'h1.page-title, h1.archive-title { color: '.$page_title_color.';}' : '';
	
	$custom_style .=  '</style>';
	
	echo wp_kses_decode_entities( $custom_style );
}
add_action( 'wp_head', 'custom_header_style' );
/**
 *	GET TAXONOMIES TERMS IN ARRAY:
 *
 */
function as_terms_func( $taxonomy ) {

	if( ! taxonomy_exists( $taxonomy ) ) return;
	
	$terms_arr = array();
	if( defined('WPML_ON') ) { // IF WPML IS ACTIVATED
				
		$terms = get_terms( $taxonomy,'hide_empty=1, hierarchical=0' );
		if ( !empty( $terms ) ){
			foreach ( $terms as $term ) {
				if($term->term_id == icl_object_id($term->term_id, $taxonomy,false,ICL_LANGUAGE_CODE)){
					$terms_arr[$term->slug]= $term->name ;
				}
			}
		}else{
			$terms_arr = array();
		}
		
	}else{
		
		$terms = get_terms( $taxonomy,'hide_empty=1, hierarchical=0');
		if ( $terms ) {
			foreach ($terms as $term) {
				$terms_arr[$term->slug]= $term->name ;
			}
		}else{
			$terms_arr = array();
		}
	}
	
	return $terms_arr;

}
add_filter('as_terms','as_terms_func', 10, 1);
//
//
/**
 *	CONTACT FORM FUNCTIONS
 *
 */
function hexstr($hexstr) {
	  $hexstr = str_replace(' ', '', $hexstr);
	  $hexstr = str_replace('\x', '', $hexstr);
	  $retstr = pack('H*', $hexstr);
	  return $retstr;
}
function strhex($string) {
	$hexstr = unpack('H*', $string);
	return array_shift($hexstr);
}


/**
 * as_editor_metabox
 * EDITOR IN META BOX ( PUT OTHER META BOXES ABOVE EDITOR)
 * 
 * @return add_action
 */
function as_editor_metabox() {
	global $post, $_wp_post_type_features;
	
	if( $post->post_type == 'page' )
		return;
	
	foreach ($_wp_post_type_features as $type => &$features) {
		if (isset($features['editor']) && $features['editor']) {
			unset($features['editor']);
			add_meta_box(
				'description',
				__('Content','showshop'),
				'content_metabox',
				$type, 'normal', 'default'
			);
		}
	}
	
	add_action( 'admin_head', 'as_action_admin_head'); //white background
}
add_action( 'add_meta_boxes', 'as_editor_metabox', 0 );
function as_action_admin_head() {
	?>
	<style type="text/css">
		.wp-editor-container{background-color:#fff;}
	</style>
	<?php
}
function content_metabox( $post ) {
	echo '<div class="wp-editor-wrap">';
	//the_editor is deprecated in WP3.3, use instead:
	wp_editor($post->post_content, 'content', array('dfw' => true, 'tabindex' => 1) );
	echo '</div>';
}

/**
 *	WPML STUFF: 
 *
 */
if( class_exists('SitePress') ) {

	define( 'WPML_ON', true );
	
	if ( ! function_exists( 'as_languages_list' ) ) {
	function as_languages_list(){
		if(function_exists('icl_get_languages')) {
			$languages = icl_get_languages('skip_missing=0&orderby=code');
		}
		if(!empty($languages)){
			echo '<div id="language_list"><ul>';
			foreach($languages as $l){
				
				$lang_name = icl_disp_language($l['native_name'], $l['translated_name']);
				
				echo '<li>';
				if($l['country_flag_url']){
					if(!$l['active']) echo '<a href="'.$l['url'].'" title="'.esc_attr( $lang_name ).'">';
					echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
					if(!$l['active']) echo '</a>';
				}
				/* // Language name:
				if(!$l['active']) echo '<a href="'.$l['url'].'">';
				echo icl_disp_language($l['native_name'], $l['translated_name']);
				if(!$l['active']) echo '</a>';
				*/
				echo '</li>';
			}
			echo '</ul></div>';
		}
	}
	}
	//
	//Custom theme WPML Translation Shortcode:
	function as_wpml_lang_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array('lang'      => '',), $atts));
		$lang_active = ICL_LANGUAGE_CODE;   
		if($lang == $lang_active){
			return $content;
		}
	}
	add_shortcode('wpml_translate', 'as_wpml_lang_shortcode');

}
/**
 *	end WPML STUFF
 *
 */
/**
 * Widget first last classes
 * 
 * @param array $params 
 * 
 * @return array
 */
function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');

/**
 *	FUNCTION HEX TO RGB - NEEDED FOR CSS BACKGROUND COLOR STYLES
 *
 */
function hex2rgb( $colour ) {
	
	if( !isset($colour[0]) )
		return;
	if ( $colour[0] == '#' ) {
			$colour = substr( $colour, 1 );
	}
	if ( strlen( $colour ) == 6 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	} elseif ( strlen( $colour ) == 3 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	} else {
			return false;
	}
	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );
	//return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	return $rgb = $r.', '. $g .', ' . $b ;	    
} 
/* end hex2rgb */


function wpa82718_scripts() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'iris',
        admin_url( 'js/iris.min.js' ),
        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
        false,
        1
    );
    wp_enqueue_script(
        'wp-color-picker',
        admin_url( 'js/color-picker.min.js' ),
        array( 'iris' ),
        false,
        1
    );
    $colorpicker_l10n = array(
        'clear' => __( 'Clear','showshop' ),
        'defaultString' => __( 'Default','showshop' ),
        'pick' => __( 'Select Color','showshop' )
    );
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n ); 

}
add_action( 'wp_enqueue_scripts', 'wpa82718_scripts', 100 );
//
/**
 * AS_IMAGE_SIZES_MEDIAPOPUP()
 * list custom image sizes in media upload
 * @param <array> $sizes  
 * 
 * @return <array>
 */
 
function as_image_sizes_mediapopup( $sizes ) {
	$new_sizes = array();
	$added_sizes = get_intermediate_image_sizes();
	foreach( $added_sizes as $key => $value) {
		$new_sizes[$value] = $value;
	}
	$new_sizes = array_merge( $new_sizes, $sizes );
	return $new_sizes;
}

add_filter( 'image_size_names_choose', 'as_custom_sizes_names' );
function as_custom_sizes_names( $sizes ) {
    return array_merge( $sizes, array(
        'as-portrait'	=> __( 'Theme portrait','showshop' ),
        'as-landscape'	=> __( 'Theme landscape','showshop' ),
    ) );
}
/**
 * REMOVE AN ANONYMOUS FUNCTION FILTER.
 *
 * @param string $tag      Hook name.
 * @param string $filename The file where the function was declared.
 * @param int $priority    Optional. Hook priority. Defaults to 10.
 * @return bool
 */
if ( !function_exists('remove_anonymous_function_filter') ) {
    
    function remove_anonymous_function_filter($tag, $filename, $priority = 10) {
        $filename = plugin_basename($filename);
 
        if ( !isset($GLOBALS['wp_filter'][$tag][$priority]) ) {
            return false;
        }
        $filters = $GLOBALS['wp_filter'][$tag][$priority];
 
        foreach ($filters as $callback) {
            if ( ($callback['function'] instanceof Closure) || is_string($callback['function']) ) {
                $function = new ReflectionFunction($callback['function']);
 
                $funcFilename = plugin_basename($function->getFileName());
                $funcFilename = preg_replace('@\(\d+\)\s+:\s+runtime-created\s+function$@', '', $funcFilename);
 
                if ( $filename === $funcFilename ) {
                    return remove_filter($tag, $callback['function'], $priority);
                }
            }
        }
 
        return false;
    }
}
/**
 *	DEPRECATED: AS SLUGIFY - convert arbitrary string to slug formated sting
 *  - deprecated in favour or WP function sanitize_title
 *
 */
if ( !function_exists('as_slugify') ) {
	function as_slugify($slug) { 
		// replace non letter or digits by -
		$slug = preg_replace('~[^\\pL\d]+~u', '-', $slug);
		// trim
		$slug = trim($slug, '-');
		// transliterate
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
		// lowercase
		$slug = strtolower($slug);
		// remove unwanted characters
		$slug = preg_replace('~[^-\w]+~', '', $slug);

		if (empty($slug)) {
			return 'n-a';
		}
		return $slug;
	}
}
/**
 *	BLOCK NON-ADMIN USERS FROM ADMIN PAGES
 *
*/
add_action( 'admin_init', 'blockusers_init' );
if ( !function_exists('blockusers_init') ) {

	function blockusers_init() {
		
		global $as_woo_is_active, $as_of;
		
		if( $as_of['blockusers'] ) {
		
			if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ){
				
				if( $as_woo_is_active ) {
					$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
					if ( $myaccount_page_id ) {
						$myaccount_page_url = get_permalink( $myaccount_page_id );
						wp_redirect( $myaccount_page_url );
					}
					
				}else{
					wp_redirect( home_url() );
				}
				exit;
			}
		
		}
	}
}
/**
 *	ALLOW SVG UPLOAD
 *
**/
add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes ( $existing_mimes=array() ) {

	$existing_mimes['svg'] = 'mime/type';

	return $existing_mimes;

}
/**
 *	REMOVE LOOKBOOK PAGE META EVERYWHERE EXPECT IN LOOKBOOK PAGE TEMPLATE:
 *
 */
function remove_lookbook_page_meta() {

	$post_id = isset($_GET['post'] ) ? $_GET['post'] : $_POST['post_ID'] ;
	$template_file = get_post_meta( $post_id, '_wp_page_template' ,TRUE );

	// check for a template type:
	if ( $template_file != 'page-lookbook.php' ) {
	
		remove_meta_box( 'lookbook-page-settings', 'page', 'normal' );
	}
}
add_action( 'load-post.php', 'remove_lookbook_page_meta' );
/**
 *	LIMIT NUMBER OF REVISIONS
 *
 */
add_filter( 'wp_revisions_to_keep', 'filter_function_name', 10, 2 );
function filter_function_name( $num = 5, $post ) {
    return $num;
}
?>