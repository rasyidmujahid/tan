<?php
add_action( 'vc_before_init', 'map_as_heading' );
function map_as_heading() {
	vc_map( array(
		"name" => __("Heading","showshop"),
		"base" => "as_heading",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_heading',
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
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Element subtitle",'showshop'),
				"param_name" => "subtitle",
				"value" => "",
				"description" => "",
				
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
				
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Title color","showshop"),
				"param_name" => "title_color",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Subtitle color","showshop"),
				"param_name" => "subtitle_color",
				"value" => '#999',
				"description" => "",
				
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background color","showshop"),
				"param_name" => "bck_color",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Remove title shadow",'showshop'),
				"param_name" => "no_title_shadow",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('heading shadow is transparent duplicated title text, under the title','showshop'),
				"edit_field_class"=> "vc_col-sm-6",
				
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
					'Bigger'	=> '462.5%',
					'Really Big'=> '556.25%',
					'Smaller'	=> '180%',
					'Small'		=> '150%',
					'Even smaller'=> '100%',					
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Heading tag",'showshop'),
				"param_name" => "tag",
				"value" => array(
					''		=> '',
					'h1'	=> 'h1',
					'h2'	=> 'h2',
					'h3'	=> 'h3',
					'h4'	=> 'h4',
					'h5'	=> 'h5',
					'h6'	=> 'h6',
					),
				"description" => __("Use wisely - heading tag affects the semantic structure and SEO.","showshop"),
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Viewport enter animation",'showshop'),
				"param_name" => "enter_anim",
				"value" => as_vc_animations_array('enter_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6",
				
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( in milliseconds )",'showshop'),
				"param_name" => "anim_delay",
				"value" => '500',
				"description" => __("Type the value for delay of block animation delay. Use the miliseconds ( 1second = 1000 miliseconds; example: 100 for 1/10th of second )","showshop"),
				"edit_field_class"=> "vc_col-sm-6",
				
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Absolute heading positioning","showshop"),
				"param_name" => "sep_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Position heading to absolute ?",'showshop'),
				"param_name" => "abs_heading",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('absolute heading is related to first relative parent','showshop'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-3",
				
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Top position",'showshop'),
				"param_name" => "abs_top",
				"value" => "",
				"description" => __("enter value AND unit (px, em, rem or %)","showshop"),
				"edit_field_class"=> "vc_col-sm-3",
				
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Left position",'showshop'),
				"param_name" => "abs_left",
				"value" => '11.5%',
				"description" => __("enter value AND unit (px, em, rem or %)","showshop"),
				"edit_field_class"=> "vc_col-sm-3",	
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Right position",'showshop'),
				"param_name" => "abs_right",
				"value" => '11.5%',
				"description" => __("enter value AND unit (px, em, rem or %)","showshop"),
				"edit_field_class"=> "vc_col-sm-3",	
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
				"heading" => __('Additional CSS classes','showshop'),
				"param_name" => "css_classes",
				"value" => '',
				"description" => __('Adds a wrapper div with additional css classes for more styling control','showshop'),
				"edit_field_class"=> "vc_col-sm-12",
				
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_1_1",
				"value" => '',
				"description" => __("Settings bellow will apply to heading ONLY and not subititle","showshop"),
				"edit_field_class"=> "vc_col-sm-12",
				'group' => __( 'Design options', 'showshop' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'showshop' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'showshop' ),
			),
			
			
		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
?>