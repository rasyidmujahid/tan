<?php
/**
 *	CUSTOM MENU FIELDS
 *
 */
add_action( 'init', array( 'AS_Nav_Custom_Fields', 'setup' ) );
class AS_Nav_Custom_Fields {
		
	static $options = array();

	static function setup() {
		
		self::$options['fields'] = array(
			
			'mega'			=>array(
				'name'				=> 'megamenu',
				'label'				=> __('Mega menu holder', 'showshop'),
				'container_class'	=> 'mega-menu',
				'input_type' 		=> 'checkbox'
			),
			'megawidth'		=>array(
				'name'				=> 'mega_width',
				'label'				=> __('Mega menu width', 'showshop'),
				'container_class'	=> 'mega-width',
				'input_type' 		=> 'text'
			),
			'grid'			=> array(
				'name'				=> 'grid',
				'label'				=> __('Mega menu section width', 'showshop'),
				'container_class'	=> 'menu-grid',
				'input_type'		=> 'select_simple'
			),
			'clear'			=> array(
				'name'				=> 'clear',
				'label'				=> __('Clear for row ?', 'showshop'),
				'container_class'	=> 'mega-menu-clear',
				'input_type'		=> 'checkbox'
			),
			'invisible'		=> array(
				'name'				=> 'stretcher',
				'label'				=> __('Invisible item (stretcher)', 'showshop'),
				'container_class'	=> 'mega-menu-stretcher',
				'input_type'		=> 'checkbox'
			),
			'title'			=> array(
				'name'				=> 'section_title',
				'label'				=> __('Item as section title', 'showshop'),
				'container_class'	=> 'mega-menu-title',
				'input_type'		=> 'checkbox'
			),
			'image'			=> array(
				'name'				=> 'image',
				'label'				=> __('Custom image', 'showshop'),
				'container_class'	=> 'mega-menu-image',
				'input_type'		=> 'image'
			),
			'post_thumb'	=> array(
				'name'				=> 'post_thumb',
				'label'				=> __('Post thumb and excerpt ?', 'showshop'),
				'container_class'	=> 'mega-menu-postthumb',
				'input_type'		=> 'checkbox'
			),
			'icon'			=> array(
				'name'				=> 'icon',
				'label'				=> __('Select icon for item', 'showshop'),
				'container_class'	=> 'menu-icon',
				'input_type'		=> 'select'
			),
			'no_desc'		=>array(
				'name'				=> 'no_desc',
				'label'				=> __('Hide description', 'showshop'),
				'container_class'	=> 'hide-desc',
				'input_type' 		=> 'checkbox'
			),
			
		);
 
		/* add_filter( 'wp_edit_nav_menu_walker', function () {
			return 'AS_Walker_Nav_Menu_Edit';
		}); */
		
		add_filter( 'wp_edit_nav_menu_walker',	array( __CLASS__, '_as_walker_menu_edit' ));
		add_filter( 'as_nav_additional_fields',	array( __CLASS__, '_add_fields' ), 10, 6 );
		add_action( 'save_post',				array( __CLASS__, '_save_post' ) );
		
		if ( !wp_script_is( 'select2', 'enqueued' )) {
			
			function enqueue_select2_menus () {
				
				wp_register_script( 'select2', get_template_directory_uri() . '/js/select2/select2.min.js');
				wp_enqueue_script( 'select2' );
				
				wp_register_script( 'menu-select2', get_template_directory_uri() . '/js/admin/menu_select2.js');
				wp_enqueue_script( 'menu-select2' );
				
				
				wp_register_style( 'select2-css',get_template_directory_uri() . '/js/select2/select2.css','', '', 'all' );
				wp_enqueue_style( 'select2-css' );
			}
			
			add_action( 'admin_enqueue_scripts', 'enqueue_select2_menus' );
		
		}
		
	}
	
	static function _as_walker_menu_edit() {
		return 'AS_Walker_Nav_Menu_Edit';
	}
	
	
	static function get_fields_schema() {
		$schema = array();
		foreach(self::$options['fields'] as $name => $field) {
			if (empty($field['name'])) {
				$field['name'] = $name;
			}
			$schema[] = $field;
		}
		return $schema;
	}
 
	static function get_menu_item_postmeta_key($name) {
		return '_menu_item_' . $name;
	}
	
 
	/**
	 * Inject the 
	 * @hook {action} save_post
	 */
	static function _add_fields($new_fields, $item_output, $item, $depth, $args, $current_object_id) {
		
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
		
		$schema = self::get_fields_schema($item->ID);
		
		$new_fields = '<div class="as-added-fields">';
		
		foreach($schema as $field) {
			
			$field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
			$field['id'] = $item->ID;
						
			$new_fields .= '<div class="additional-menu-field-'.$field['name'].' description description-thin custom-menu-'.$field['name'].'">';
			$new_fields .= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'<br />';
			
			if( $field['input_type'] == 'image') {
				
				$field_id = 'edit-menu-item-'.$field['name'].'-'.$field['id'];
				$field_class = 'widefat code edit-menu-item-'.$field['name'];
				$field_name = 'menu-item-'.$field['name'].'['.$field['id'].']';
				
				
				$new_fields .= '<div class="image-holder">';
				$new_fields .= '<input type="hidden" class="placeholder" value="'. AS_PLACEHOLDER_IMAGE .'" />';
				$new_fields .= '<a href="#" class="remove-media"><img src="'. get_template_directory_uri() .'/admin/images/icon-delete.png" /></a>';
							
					if( $field['value'] ) {					
						$imgurl = wp_get_attachment_image_src( $field['value'], 'thumbnail' );
						$new_fields .= '<img src="'. $imgurl[0] .'" class="att-image" />';
					}else{
						$new_fields .= '<img src="'. AS_PLACEHOLDER_IMAGE .'" class="att-image" />';
					}
				
				$new_fields .= '<input type="hidden" id="'.$field_id.'" class="input-full input-upload '.$field_class.'" value="'.$field['value'].'" name="'.$field_name.'" data-size="thumbnail" />';
				
				$new_fields .= '<a href="#" class="as_upload_button button" rel="image">upload</a>';
				
				$new_fields .= '</div>';
				
			}elseif( $field['input_type'] == 'select_simple'){
			
				$options_arr = self::grid_array();
				$options = is_array($options_arr) ? $options_arr : array();
				
				$field_id = 'edit-menu-item-'.$field['name'].'-'.$field['id'];
				$field_class = 'widefat code edit-menu-item-'.$field['name'];
				$field_name = 'menu-item-'.$field['name'].'['.$field['id'].']';
				
				$new_fields .= '<select id="'.$field_id.'" name="'.$field_name.'" class="'.$field_class.'">';
				foreach( $options as $key=>$value ) {
					$new_fields .= '<option value="'.$key.'" '.selected( $field['value'], $key, false ).'>'.htmlspecialchars( $value ). '</option>';
				}
				
				$new_fields .= '</select>';
				
			}elseif( $field['input_type'] == 'select'){
			
				$icons_arr = self::icons_array();
				$options = is_array($icons_arr) ? $icons_arr : array();
				
				$field_id = 'edit-menu-item-'.$field['name'].'-'.$field['id'];
				$field_class = 'widefat code edit-menu-item-'.$field['name'];
				$field_name = 'menu-item-'.$field['name'].'['.$field['id'].']';
				
				$new_fields .= '<select id="'.$field_id.'" name="'.$field_name.'" class="'.$field_class.' as-select2">';
				foreach( $options as $key=>$value ) {
					$new_fields .= '<option value="'.$key.'" '.selected( $field['value'], $key, false ).'>'.htmlspecialchars( $value ). '</option>';
				}
				
				$new_fields .= '</select>';
				
			}else{
			
				$new_fields .= '<input type="'.$field['input_type'].'" ';
				$new_fields .= 'id="edit-menu-item-'.$field['name'].'-'.$field['id'].'"';
				$new_fields .= 'class="widefat code edit-menu-item-'.$field['name'].'"';
				$new_fields .= 'name="menu-item-'.$field['name'].'['.$field['id'].']"';
				
				
				if( $field['input_type'] == 'checkbox'){
					
					$new_fields .= 'value="1" '. checked( $field['value'], 1, false ) .' />';
				
				}else{
					$new_fields .= 'value="'.$field['value'].'" />';
				}
			
			}
			
			$new_fields .= '</label>';
			$new_fields .= '</div>';
			
		}
		
		$new_fields .= '</div>';
				
		return $new_fields;
	}
 
	static function icons_array() {
			
		include (get_template_directory() .'/inc/functions/animations-icons-arrays.php');
		return $icons_arr;

	}
	
	static function grid_array() {
			
		$grid_arr = array(
			'auto'		=> 'Auto',
			'medium-3' 	=> 'One fourth',
			'medium-4' 	=> 'One third',
			'medium-6' 	=> 'Half width',
			'medium-8' 	=> 'Two thirds',
			'medium-9' 	=> 'Three fourths',			
			'medium-12' => 'Full width',
		);
		return $grid_arr;

	}
	/**
	 * Save the newly submitted fields
	 * @hook {action} save_post
	 */
	static function _save_post($post_id) {
		if (get_post_type($post_id) !== 'nav_menu_item') {
			return;
		}
		$fields_schema = self::get_fields_schema($post_id);
		foreach($fields_schema as $field_schema) {
			$form_field_name = 'menu-item-' . $field_schema['name'];
			$key = self::get_menu_item_postmeta_key($field_schema['name']);
			$value = isset( $_POST[$form_field_name][$post_id] ) ? stripslashes($_POST[$form_field_name][$post_id]) : '';				
			update_post_meta($post_id, $key, $value);
		}
	}
	

}
 
require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class AS_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
		$item_output = '';
		parent::start_el($item_output, $object, $depth, $args = array(), $current_object_id = 0);
		$new_fields = apply_filters( 'as_nav_additional_fields', '', $item_output, $object, $depth, $args, $current_object_id );
		// Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
		if ($new_fields) {
			$item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
		}
		$output .= $item_output;
	}
}

/**
 *	CUSTOM MENU LAYOUT
 *
 */
class My_Walker extends Walker_Nav_Menu
{	
	
	private $curItem;
	
	function start_lvl( &$output, $depth = 0, $args=array() ) {
		
		$currentItem = $this->curItem;
	
		$item_meta = get_post_meta($currentItem->ID);
		// CUSTOM MENU FIELDS  
		
		$is_mega = $mega_width = $image = $backimg	= '';
		
		// MEGAMENU:
		if ( isset($item_meta['_menu_item_megamenu'][0]) || !empty($item_meta['_menu_item_megamenu'][0]) ) {
			$is_mega =  $item_meta['_menu_item_megamenu'][0];
		}
		// MEGAMENU WIDTH:
		if ( isset($item_meta['_menu_item_mega_width'][0]) || !empty($item_meta['_menu_item_mega_width'][0]) ) {
			$mega_width =  $item_meta['_menu_item_mega_width'][0];
		}
		// MEGAMENU IMAGE: 
		if ( isset($item_meta['_menu_item_image'][0]) || !empty($item_meta['_menu_item_image'][0]) ) {
			$image =  $item_meta['_menu_item_image'][0];
		}
		
		if( $image && $is_mega ) {
			$imgurl		= wp_get_attachment_image_src( $image, 'medium' );
			$backimg	= ' style="background-image: url('.$imgurl[0].'); background-repeat: no-repeat; background-position: right bottom; "';
		}
		
		$output .= '<ul class="sub-menu'. ( $is_mega ? ' as-megamenu' : ' regular-sub' ). '"'.$backimg.' '. ( $mega_width ? 'style="width:'.$mega_width.';" data-width="'.$mega_width.'"' : '') .'>';
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		
		global $as_of;
		
		$this->curItem = $item;
		//	
		$wp_query;
		//		
		if( is_object($args) ) {
			
			$item_meta = get_post_meta($item->ID);
			/**
			 *	CUSTOM MENU FIELDS
			 *
			 */
			 $is_mega = $grid = $new_row = $stretcher = $section_title = $image = $post_thumb = $icon = $no_desc = '';
			// megamenu:
			if ( isset($item_meta['_menu_item_megamenu'][0]) || !empty($item_meta['_menu_item_megamenu'][0]) ) {
				$is_mega =  $item_meta['_menu_item_megamenu'][0];
			}
			// megamenu width:
			if ( isset($item_meta['_menu_item_mega_width'][0]) || !empty($item_meta['_menu_item_mega_width'][0]) ) {
				$mega_width =  $item_meta['_menu_item_mega_width'][0];
			}
			// megamenu grid:
			if ( isset($item_meta['_menu_item_grid'][0]) || !empty($item_meta['_menu_item_grid'][0]) ) {
				$grid =  $item_meta['_menu_item_grid'][0];
			}
			// megamenu new row: 
			if ( isset($item_meta['_menu_item_clear'][0]) || !empty($item_meta['_menu_item_clear'][0]) ) {
				$new_row =  $item_meta['_menu_item_clear'][0];
			}
			// megamenu stretcher (invisible item): 
			if ( isset($item_meta['_menu_item_stretcher'][0]) || !empty($item_meta['_menu_item_stretcher'][0]) ) {
				$stretcher =  $item_meta['_menu_item_stretcher'][0];
			}
			// megamenu title : 
			if ( isset($item_meta['_menu_item_section_title'][0]) || !empty($item_meta['_menu_item_section_title'][0]) ) {
				$section_title =  $item_meta['_menu_item_section_title'][0];
			}
			// megamenu image: 
			if ( isset($item_meta['_menu_item_image'][0]) || !empty($item_meta['_menu_item_image'][0]) ) {
				$image =  $item_meta['_menu_item_image'][0];
			}
			// megamenu post thumb: 
			if ( isset($item_meta['_menu_item_post_thumb'][0]) || !empty($item_meta['_menu_item_post_thumb'][0]) ) {
				$post_thumb =  $item_meta['_menu_item_post_thumb'][0];
			}
			// menu item icon:
			if ( isset($item_meta['_menu_item_icon'][0]) || !empty($item_meta['_menu_item_icon'][0]) ) {
				$icon =  $item_meta['_menu_item_icon'][0];
			}
			// hide description:
			if ( isset($item_meta['_menu_item_no_desc'][0]) || !empty($item_meta['_menu_item_no_desc'][0]) ) {
				$no_desc =  $item_meta['_menu_item_no_desc'][0];
			}
			// end getting post (nav_menu_item) meta
			///////////////////////////////////////////////

			
			/* Current item has any children? */
			$has_children = get_posts( array('post_type' => 'nav_menu_item', 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID) ); 
			$has_parent = get_post_ancestors( $item->ID );
			//
			//$indent = ( $depth ) ? str_repeat( "\t", $depth ) : ''; // disabled for eventual future use
			$indent ='';
			//
			$class_names = $value = '';
			//
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			//
			$class_names = array_shift($classes); // remove first class ( from menu editor - optional css )
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
			$class_names = $has_children	? rtrim($class_names, '"').' dropdown"' : $class_names; 
			$class_names = $is_mega			? rtrim($class_names, '"').' mega-parent"' : $class_names;
			$class_names = $new_row			? rtrim($class_names, '"').' new-row"' : $class_names;
			$class_names = $stretcher		? rtrim($class_names, '"').' stretcher"' : $class_names;
			$class_names = $section_title 	? rtrim($class_names, '"').' section-title"' : $class_names;
			$class_names = ( $image || $post_thumb ) ? rtrim($class_names, '"').' with-image"' : $class_names;
			$class_names = ( $grid != "auto" && $depth == 1 ) ? rtrim($class_names, '"'). ' '. $grid .' column "' : $class_names;
			//		
			
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			//$attributes .= ! empty( $item->classes[0] ) ? ' class="'  . esc_attr( $item->classes[0] ) .'"' : '';
			$attributes .= ! empty( $has_children ) 	? ' class="dropdown"' : '';
			
			$custom_class =  ! empty( $item->classes[0] ) ? ' class="'.$item->classes[0].'"' : '' ;
			
			// start collecting item output:
			$item_output  = $args->before ? $args->before : '';
			$item_output .= '<a'. $attributes . $custom_class .'>' ;
			$item_output .=  $icon ? '<span class="menu-item-icon '.$icon.'"></span>' : '';
			
			$item_output .= '<span>'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after .'</span>';
								
			$item_output .= '</a>';
			
			if( $image && $depth >= 1 ) {
				$imgurl = wp_get_attachment_image_src( $image, 'thumbnail' );
				$item_output .= '<a href="'.esc_attr( $item->url ).'" class="menu-img-link"><img src="'. $imgurl[0] .'" class="att-image" alt="'.esc_attr( $item->title ).'" /></a>';
			}

			if ( $depth >= 1 && $post_thumb ) {
				$item_output .= '<a href="'.esc_attr( $item->url ).'" class="menu-img-link">'. get_the_post_thumbnail( $item->object_id , 'thumbnail' ) .'</a>';
				
				$post_item = get_post( $item->object_id ); 
				$item_output .= '<div class="menu-post-excerpt">';
				
				if( !$no_desc ){
					$desc_excerpt = $item->description ? $item->description : $post_item->post_excerpt;
				}
				
				$final_txt = $desc_excerpt ? $desc_excerpt : '';
				
				$item_output .= '<span class="desc post-thumb">'.apply_filters( 'as_menu_excerpt', $final_txt, 50 ) . '</span>';
				
				$button	= ( $post_item->post_type == 'product' ) ? __('View product','showshop') : __('Read more','showshop');
				
				$item_output .= '<a href="'.esc_attr( $item->url ).'" class="button">'. $button .'<span class="more-icon icon-arrow-right2"></span></a>';
				
				$item_output .= '</div>';
				
			}elseif( $item->description && !$no_desc  ) {
				
				/* DISPLAY DESCRIPTION ( menu additional fields )*/
				$item_output .= '<span class="desc alone">'. $item->description . '</span>';
				
			};
			
			
			$item_output .= $args->after;
			//
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );	
			
			
		}
	}
}
/*
 *	MENU CLASSES REPLACEMENTS
 *
 */
function roots_wp_nav_menu($text) {
$replace = array(
		//'sub-menu'     => 'dropdown-menu',
		'current-menu-item'     => 'active',
		'current-menu-parent'   => 'active',
		'menu-item-type-post_type' => '',
		'menu-item-object-page' => '',
	);
	$text = str_replace(array_keys($replace), $replace, $text);
	return $text;
}
add_filter('wp_nav_menu', 'roots_wp_nav_menu');
//
?>