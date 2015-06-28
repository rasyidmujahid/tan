<?php
add_action( 'vc_before_init', 'map_as_ajax_prod' );
function map_as_ajax_prod() {
	vc_map( array(
		"name" => __("Ajax load products","showshop"),
		"base" => "as_ajax_prod",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_ajax_prod',
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
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12"
			),
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Product categories and menu settings",'showshop'),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Product categories",'showshop'),
				"param_name" => "product_cats",
				"value" => apply_filters('as_vc_terms', 'product_cat' ),
				"description" => __('select one or multiple product categories (if none, it will display all)','showshop'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Product categories menu style",'showshop'),
				"param_name" => "prod_cat_menu",
				"value" => array(
					'None'					=> 'none',
					'With category images'	=> 'images',
					'Without category images'=> 'no_images',
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Menu items in a row",'showshop'),
				"param_name" => "menu_columns",
				"value" => array(
					'Auto float'	=> 'auto',
					'Auto stretch'	=> 'stretch',
					'1'				=> '1',
					'2'				=> '2',
					'3'				=> '3',
					'4'				=> '4',
					'6'				=> '6'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
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
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Menu color settings","showshop"),
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color","showshop"),
				"param_name" => "text_color",
				"value" => '',
				"description" => __("If categories images - choose color for text","showshop"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Overlay color","showshop"),
				"param_name" => "overlay_color",
				"value" => '', 
				"description" => __("If categories images - choose color for image overlay","showshop"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Image settings",'showshop'),
				"param_name" => "sep_4",
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
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Animations settings for items",'showshop'),
				"param_name" => "sep_7",
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
				"heading" => __("Product buttons and title animation",'showshop'),
				"param_name" => "data_anim",
				"value" => as_vc_animations_array('info_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Products settings",'showshop'),
				"param_name" => "sep_8",
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
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide \"Add to cart/Select options\" button ?",'showshop'),
				"param_name" => "shop_buy_action",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-4"
			),

			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide \"Add to wishlist\" button ?",'showshop'),
				"param_name" => "shop_wishlist",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('Yith WooCommerce Wishlist plugin must be installed','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			

			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_8_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Special filters","showshop"),
				"param_name" => "filters",
				"value" => array(
					'Latest products'		=> 'latest',
					'Featured products'		=> 'featured' ,
					'Best selling products'	=> 'best_sellers',
					'Best rated products'	=> 'best_rated',
					'Random products'		=> 'random'
					),
				"description" => __("make a special selection with these filters","showshop") ,
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-6"
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
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_9",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Total items",'showshop'),
				"param_name" => "total_items",
				"value" => '12',
				"description" => __('If empty, all items will e showed.','showshop'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Disable slider",'showshop'),
				"param_name" => "hide_slider",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide slider navigation?",'showshop'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('use prev / next arrows','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide slider pagination?",'showshop'),
				"param_name" => "slider_pagin",
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
				"heading" => __("Responsive slider settings",'showshop'),
				"param_name" => "sep_6",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items in desktop view",'showshop'),
				"param_name" => "items_desktop",
				"value" => "3",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items in tablet view",'showshop'),
				"param_name" => "items_tablet",
				"value" => "2",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items in mobile view",'showshop'),
				"param_name" => "items_mobile",
				"value" => "1",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
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
				"param_name" => "ap_link_button", // ap_ prefix as "Ajax products"
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
				"heading" => __('Button text','showshop'),
				"param_name" => "button_text",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Button link','showshop'),
				"param_name" => "button_text",
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
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_8",
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
?>