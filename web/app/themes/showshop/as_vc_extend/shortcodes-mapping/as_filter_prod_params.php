<?php
add_action( 'vc_before_init', 'map_as_filter_prod' );
function map_as_filter_prod() {
	vc_map( array(
		"name" => __("Filtered products","showshop"),
		"base" => "as_filter_prod",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_filter_prod',
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
				"group"	=> "Title and subtitle settings",
				"admin_label" => true,
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
				"heading" => __("Viewport enter animation",'showshop'),
				"param_name" => "enter_anim",
				"value" => as_vc_animations_array('enter_animation'),
				"description" => ""
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Product categories and categories menu",'showshop'),
				"param_name" => "sep_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Product categories",'showshop'),
				"param_name" => "product_cats",
				"value" => apply_filters('as_vc_terms', 'product_cat' ),
				"description" => __('select one or multiple product categories','showshop'),
				"admin_label" => true,
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Categories menu style",'showshop'),
				"param_name" => "tax_menu_style",
				"value" => array(
					'Inline menu'	=> 'inline',
					'Dropdown menu'	=> 'dropdown',
					'None'		=>'none' 
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show sorting dropdown ?",'showshop'),
				"param_name" => "sorting",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" =>  __('choose to display sorting dropdown menu ( with options - default, by title, by date)','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
				
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Categories menu alignment",'showshop'),
				"param_name" => "tax_menu_align",
				"value" => array(
					'Center'		=> 'center',
					'Align left'	=> 'align_left',
					'Align right'	=> 'align_right',
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Filters and image settings",'showshop'),
				"param_name" => "sep_31",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Special filters",'showshop'),
				"param_name" => "filters",
				"value" => array(
					'Latest products'		=> 'latest',
					'Featured products'		=> 'featured',
					'Best selling products'	=> 'best_sellers',
					'Best rated products'	=> 'best_rated',
					'Random products'		=> 'random'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
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
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Custom image width",'showshop'),
				"param_name" => "custom_image_width",
				"value" => '',
				"description" => 'set custom image width - must use height, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Custom image height",'showshop'),
				"param_name" => "custom_image_height",
				"value" => '',
				"description" => 'set custom image height - must use width, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Item buttons",'showshop'),
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide quick view button: ",'showshop'),
				"param_name" => "shop_quick",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('hide button for quick product view','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide buy button: ",'showshop'),
				"param_name" => "shop_buy_action",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('hide button for add to cart/select options','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide wishlist button: ",'showshop'),
				"param_name" => "shop_wishlist",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('hide button for add to wishlist','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Item settings",'showshop'),
				"param_name" => "sep_5",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Total items",'showshop'),
				"param_name" => "total_items",
				"value" => '',
				"description" => __('If empty, all items will e showed.','showshop'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Items in one row","showshop"),
				"param_name" => "in_row",
				"value" => array(
					'1'	=> '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'6' => '6'
					),
				'default' => '3',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),

			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover image animation",'showshop'),
				"param_name" => "anim",
				"value" => as_vc_animations_array('hover_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post text animation",'showshop'),
				"param_name" => "data_anim",
				"value" => as_vc_animations_array('info_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_5",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Smaller buttons and text",'showshop'),
				"param_name" => "smaller",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('make item elements ( title, buttons, price text ) smaller, in case of many items in row/smaller images','showshop'),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Force item spacing",'showshop'),
				"param_name" => "force_spacing",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('replace default item floating (without spaces between items) with added spacing (theme grid).<strong>NOTE: recommended usage when "boxed content" in row settings checked</strong>','showshop'),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Additional settings",'showshop'),
				"param_name" => "sep_6",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Button label','showshop'),
				"param_name" => "button_label",
				"value" => '',
				"description" => __("If this setting is empty, and link is set, link will apply to whole banner.","showshop"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "vc_link",
				"class" => "",
				"heading" => __("Add link",'showshop'),
				"param_name" => "afp_link_button", // ap_ prefix as "Ajax filter products"
				"value" => "",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Outlined button ?",'showshop'),
				"param_name" => "outlined",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("Convert button to outlined button without background.","showshop"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			
			/* 
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Text for "more" link','showshop'),
				"param_name" => "more_link_text",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('URL address  for "more" link','showshop'),
				"param_name" => "more_link_url",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Open in new tab/window",'showshop'),
				"param_name" => "target",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12"
			),
			*/
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Additional CSS classes','showshop'),
				"param_name" => "css_classes",
				"value" => '',
				"description" => __('Adds a wrapper div with additional css classes for more styling control','showshop'),
				"edit_field_class"=> "vc_col-sm-6"
			)
			
		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
?>