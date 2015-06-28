<?php
add_action( 'vc_before_init', 'map_as_gmap' );
function map_as_gmap() {
	vc_map( array(
		"name" => __("Google map","showshop"),
		"base" => "as_gmap",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_gmap',
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
				"heading" => __("Viewport enter animation",'showshop'),
				"param_name" => "enter_anim",
				"value" => as_vc_animations_array('enter_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( in milliseconds )",'showshop'),
				"param_name" => "anim_delay",
				"value" => '500',
				"description" => __("Type the value for delay of block animation delay. Use the miliseconds ( 1second = 1000 miliseconds; example: 100 for 1/10th of second )","showshop"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Enter full address for google map search",'showshop'),
				"param_name" => "sep_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Address (street)","showshop"),
				"param_name" => "address2",
				"value" => '',
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Address (town, country)","showshop"),
				"param_name" => "address3",
				"value" => '',
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Address ( additional info )","showshop"),
				"param_name" => "address4",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
                "type" => "attach_image",
                "heading" => __("Location image", "showshop"),
                "param_name" => "attach_id",
                "value" => "",
                "description" => __("Select image for location.", "showshop"),
				"edit_field_class"=> "vc_col-sm-8"
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
				"type" => "textfield",
				"class" => "",
				"heading" => __("Location latitude","showshop"),
				"param_name" => "latitude",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Location longitude","showshop"),
				"param_name" => "longitude",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Map color","showshop"),
				"param_name" => "map_color",
				"value" => '', 
				"description" => __("Pick the map color","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Map width","showshop"),
				"param_name" => "width",
				"value" => '100%',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Map height","showshop"),
				"param_name" => "height",
				"value" => '420px',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
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
				"type" => "textfield",
				"class" => "",
				"heading" => __("Map desaturation","showshop"),
				"param_name" => "map_desatur",
				"value" => '20',
				"description" => __("Enter a percentage value from 0 -100, WITHOUT % unit","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Map zoom level","showshop"),
				"param_name" => "zoom",
				"value" => '15',
				"description" => __("Enter a number value from 0 - 20, WITHOUT any units","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Disable scroll zoom",'showshop'),
				"param_name" => "scroll_zoom",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('Disable map zooming on mousewheel scroll','showshop'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_6",
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
			
			
		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
?>