<?php
add_action( 'vc_before_init', 'map_as_single_prod' );
function map_as_single_prod() {
	vc_map( array(
		"name" => __("Single product","showshop"),
		"base" => "as_single_prod",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_single_prod',
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
				"admin_label" => true,
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
				"heading" => __("Select product",'showshop'),
				"param_name" => "single_product",
				"value" => get_products_array(),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Product image and gallery slider settings","showshop"),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Image format",'showshop'),
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
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Slider navigation?",'showshop'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('use prev / next arrows','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Slider pagination?",'showshop'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('pagination dots bellow the slider','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Slider timing",'showshop'),
				"param_name" => "slider_timing",
				"value" => '',
				"description" => __('If empty, no automatic sliding will happen.','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Display options","showshop"),
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Product info background","showshop"),
				"param_name" => "back_color",
				"value" => '',
				"description" => __("Choose background color","showshop"),
				"edit_field_class"=> "vc_col-sm-3"
			),
						
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Product details options",'showshop'),
				"param_name" => "product_options",
				"value" => array(
					'Reduced product options'	=> 'reduced',
					'Full product options'		=> 'full'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide product short description ?",'showshop'),
				"param_name" => "hide_short_desc",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide product image ?",'showshop'),
				"param_name" => "hide_image",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("if you hide product image, there's still an option of row background image.","showshop"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			

			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Animations settings for items",'showshop'),
				"param_name" => "sep_6",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover image animation",'showshop'),
				"param_name" => "anim",
				"value" => as_vc_animations_array('hover_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post text animation",'showshop'),
				"param_name" => "data_anim",
				"value" => as_vc_animations_array('info_animation'),
				"description" => __("APPLICABLE ONLY FOR BLOCK STYLE 3",'showshop'),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Additional settings",'showshop'),
				"param_name" => "sep_7",
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
			),

			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'showshop' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'showshop' ),
			),
			
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
function get_products_array() {
	
	$args = array(
		'post_type'			=> 'product',
		'posts_per_page'	=> -1,
		'suppress_filters'	=> true
	);
	$products_arr = array();  
	$products_obj = get_posts($args);
	if ( $products_obj ) {
		foreach( $products_obj as $prod ) {
			
			$products_arr[$prod->ID] = $prod->post_title  ;
		}
	}else{
		$products_arr[0] = '';
	}
	
	$products_arr = array_flip($products_arr); 
	
	return $products_arr; 
	
}


?>