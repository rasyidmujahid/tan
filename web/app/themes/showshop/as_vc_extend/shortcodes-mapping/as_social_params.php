<?php
add_action( 'vc_before_init', 'map_as_social' );
function map_as_social() {
	vc_map( array(
		"name" => __("Social links","showshop"),
		"base" => "as_social",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_social',
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
				"description" => ""
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Enter social links","showshop"),
				"param_name" => "sep_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Facebook','showshop'),
				"param_name" => "facebook",
				"value" => '',
				"description" => __('add link to your Facebook profile/page/group','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Twitter','showshop'),
				"param_name" => "twitter",
				"value" => '',
				"description" => __('add link to your Twitter account','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Instagram','showshop'),
				"param_name" => "instagram",
				"value" => '',
				"description" => __('add link to your Instagram account','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('LinkedIn','showshop'),
				"param_name" => "linkedin",
				"value" => '',
				"description" => __('add link to your LinkedIn account','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Google +','showshop'),
				"param_name" => "gplus",
				"value" => '',
				"description" => __('add link to your Google plus account','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Pinterest','showshop'),
				"param_name" => "pinterest",
				"value" => '',
				"description" => __('add link to your Pinterest account','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Tubmlr','showshop'),
				"param_name" => "tumblr",
				"value" => '',
				"description" => __('add link to your Tumblr page','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Dribbble','showshop'),
				"param_name" => "dribbble",
				"value" => '',
				"description" => __('add link to your Dribbble account','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Skype','showshop'),
				"param_name" => "skype",
				"value" => '',
				"description" => __('add your Skype contact','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
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
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Social icons size",'showshop'),
				"param_name" => "size",
				"value" => array(
					"Default (large)"	=> "default",
					"Smaller"			=> "smaller",
				),
				"description" =>"",
				"edit_field_class"=> "vc_col-sm-4",
				"admin_label" => true,
			),
			 
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Social icons align",'showshop'),
				"param_name" => "align",
				"value" => array(
					'Center'	=> 'center',
					'Left'		=> 'left',
					'Right'		=> 'right'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Social icons in row",'showshop'),
				"param_name" => "items",
				"value" => array(
					'Stretched'		=> 'stretched',
					'not-stretched'	=> 'not-stretched',
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
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
				"edit_field_class"=> "vc_col-sm-12"
			)
			
			
		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
?>