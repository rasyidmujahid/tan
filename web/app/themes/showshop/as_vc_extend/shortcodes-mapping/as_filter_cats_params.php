<?php
add_action( 'vc_before_init', 'map_as_filter_cats' );
function map_as_filter_cats() {
		
	vc_map( array(
		"name" => __("Filtered content","showshop"),
		"base" => "as_filter_cats",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_filter_cats',
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
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Block style",'showshop'),
				"param_name" => "block_style",
				"value" => array(
					'Style 1 (general)' => 'style1',
					'Style 2 (blog posts)' => 'style2',
					'Style 3 (portfolio)' => 'style3'
					),
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Post types and categories",'showshop'),
				"param_name" => "sep_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post types",'showshop'),
				"param_name" => "post_type",
				"value" => array(
					'Post'=> 'post',
					'Portfolio' => 'portfolio'
					),
				"admin_label" => true,
				"description" => ""
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Post categories",'showshop'),
				"param_name" => "post_cats",
				"value" => apply_filters('as_vc_terms', 'category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Post"','showshop'),
				"admin_label" => true,
			),
		
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show only featured ?",'showshop'),
				"param_name" => "only_featured",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('show only featured posts or portfolio items','showshop')
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Portfolio  categories",'showshop'),
				"param_name" => "portfolio_cats",
				"value" => apply_filters('as_vc_terms', 'portfolio_category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Portfolio"','showshop'),
				"admin_label" => true,
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Image settings",'showshop'),
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
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Custom image width",'showshop'),
				"param_name" => "custom_image_width",
				"value" => '',
				"description" => 'set custom image width (in pixels, don\'t enter unit) - must use height, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Custom image height",'showshop'),
				"param_name" => "custom_image_height",
				"value" => '',
				"description" => 'set custom image height (in pixels, don\'t enter unit) - must use width, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Menu settings",'showshop'),
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Taxonomy menu style",'showshop'),
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
				"heading" => __("Taxonomy menu alignment",'showshop'),
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
				"heading" => __("Item settings",'showshop'),
				"param_name" => "sep_5",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide zoom button?",'showshop'),
				"param_name" => "zoom_button",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('display button for zooming image','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide link button ?",'showshop'),
				"param_name" => "link_button",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('display button with link to post/portfolio item','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Total number of items",'showshop'),
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
				"heading" => __("Force item spacing",'showshop'),
				"param_name" => "force_spacing",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('replace default item floating (without spaces between items) with added spacing (theme grid). <strong>NOTE: recommended usage when "boxed content" in row settings checked</strong>','showshop'),
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Animations settings",'showshop'),
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
				"param_name" => "afc_link_button", // ap_ prefix as "Ajax filter content"
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