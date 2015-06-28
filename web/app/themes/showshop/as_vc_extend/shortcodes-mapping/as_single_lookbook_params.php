<?php
add_action( 'vc_before_init', 'map_as_single_lookbook' );
function map_as_single_lookbook() {
	vc_map( array(
		"name" => __("Single lookbook","showshop"),
		"base" => "as_single_lookbook",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_single_lookbook',
		"category" => __('ShowShop theme elements','showshop'),
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/as_vc_extend/shotcodes/css/input.css'),
		"params" => array(
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Element title",'showshop'),
				"param_name" => "title",
				"value" => "",
				"description" => "",
				"admin_label" => true,
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Element subtitle",'showshop'),
				"param_name" => "subtitle",
				"value" => "",
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Element title style",'showshop'),
				"param_name" => "title_style",
				"value" => array(
					'Center'		=> 'center',
					'Float left'	=> 'float_left',
					'Float right'	=> 'float_right'
					),
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Element subtitle style",'showshop'),
				"param_name" => "sub_position",
				"value" => array(
					'Above heading'		=> 'above',
					'Bellow heading'	=> 'bellow',
					),
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Title color","showshop"),
				"param_name" => "title_color",
				"value" => '',
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Subtitle color","showshop"),
				"param_name" => "subtitle_color",
				"value" => '#999',
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Remove title shadow",'showshop'),
				"param_name" => "no_title_shadow",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('heading shadow is transparent duplicated title text, under the title','showshop'),
				"edit_field_class"=> "vc_col-sm-6",
				"group"	=> "Title and subtitle settings",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title additional sizing",'showshop'),
				"param_name" => "title_size",
				"value" => array(
					'Normal'	=> '237.5%',
					'Larger'	=> '325%',
					'Big'		=> '350%',
					'Smaller'	=> '180%',
					'Small'		=> '150%',
					),
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Block style",'showshop'),
				"param_name" => "block_style",
				"value" => array(
					'Image right'	=> 'images_right',
					'Image left'	=> 'images_left',
					'Centered'		=> 'centered',
					'Centered Alt'	=> 'centered_alt',
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Viewport enter animation",'showshop'),
				"param_name" => "enter_anim",
				"value" => as_vc_animations_array('enter_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Select lookbook item",'showshop'),
				"param_name" => "single_lookbook",
				"value" => get_lookbook_array(),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Lookbook item image settings","showshop"),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Main lookbook image format",'showshop'),
				"param_name" => "img_format",
				"value" => array(
					'Thumbnail'		=> 'thumbnail',
					'Medium'		=> 'medium',
					'ShowShop portrait'	=> 'as-portrait',
					'ShowShop landscape'=> 'as-landscape',
					'Large'			=> 'large',
					'Full'			=> 'full'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),

			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Products image format",'showshop'),
				"param_name" => "img_format_products",
				"value" => array(
					'Thumbnail'		=> 'thumbnail',
					'Medium'		=> 'medium',
					'ShowShop portrait'	=> 'as-portrait',
					'ShowShop landscape'=> 'as-landscape',
					'Large'			=> 'large',
					'Full'			=> 'full'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),

			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Lookbook products settings",'showshop'),
				"param_name" => "sep_6_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),			
			

			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide \"Quick view\" button ?",'showshop'),
				"param_name" => "shop_quick",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide \"Add to cart/Select options\" button ?",'showshop'),
				"param_name" => "shop_buy_action",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),

			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide \"Add to wishlist\" button ?",'showshop'),
				"param_name" => "shop_wishlist",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('Yith WooCommerce Wishlist plugin must be installed','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Smaller buttons and text",'showshop'),
				"param_name" => "smaller",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('make item elements ( title, buttons, price text ) smaller, in case of many items in row/smaller images','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Background settings",'showshop'),
				"param_name" => "sep_7",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),			
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background color","showshop"),
				"param_name" => "back_color",
				"value" => '',
				"description" => __("Choose background color","showshop"),
				"edit_field_class"=> "vc_col-sm-6"
			),

			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Background color opacity",'showshop'),
				"param_name" => "opacity",
				"value" => '',
				"description" => '',
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_8",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => __("Lookbook additional content","showshop"),
				"param_name" => "content",
				"value" => "",
				"description" => ""
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Text to display",'showshop'),
				"param_name" => "text_to_display",
				"value" => array(
					'Content from lookbook item'=> 'lookbook_post',
					'Additional content'		=> 'additional',
					'Both'						=> 'both',
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Additional settings",'showshop'),
				"param_name" => "sep_9",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),

			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Additional CSS classes','showshop'),
				"param_name" => "css_classes",
				"value" => '',
				"description" => __('Adds a wrapper div with additional css classes for more styling control','showshop'),
				"edit_field_class"=> "vc_col-sm-12"
			)
			/* 
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color"),
				"param_name" => "color",
				"value" => '#FF0000', //Default Red color
				"description" => __("Choose text color")
			),
			array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => __("Content"),
				"param_name" => "content",
				"value" => __("<p>I am test text block. Click edit button to change this text.</p>"),
				"description" => __("Enter your content.")
			)
			 */
		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
function get_lookbook_array() {
	
	$args = array(
		'post_type'			=> 'lookbook',
		'posts_per_page'	=> -1,
		'suppress_filters'	=> true
	);
	$lookbooks_arr = array();  
	$lookbooks_obj = get_posts($args);
	if ( $lookbooks_obj ) {
		foreach( $lookbooks_obj as $lbook ) {
			
			$lookbooks_arr[$lbook->ID] = $lbook->post_title  ;
		}
	}else{
		$lookbooks_arr[0] = '';
	}
	
	$lookbooks_arr = array_flip($lookbooks_arr); 
	
	return $lookbooks_arr; 
	
}


?>