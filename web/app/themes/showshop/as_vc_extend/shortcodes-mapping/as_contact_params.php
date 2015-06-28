<?php
add_action( 'vc_before_init', 'map_as_contact' );
function map_as_contact() {
	vc_map( array(
		"name" => __("Contact form","showshop"),
		"base" => "as_contact",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_contact',
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
				"type" => "textfield",
				"class" => "",
				"heading" => __('Recipient email address (required)','showshop'),
				"param_name" => "contact_email",
				"value" => get_option('admin_email') ? get_option('admin_email') : '',
				"description" => "",
				"admin_label" => true,
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
                "type" => "attach_images",
                "heading" => __("Location image (optional)", "showshop"),
                "param_name" => "attach_id",
                "value" => "",
                "description" => __("Select image to represent your location.", "showshop"),
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
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => __('Location description','showshop'),
				"param_name" => "content",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Disable auto paragraphs",'showshop'),
				"param_name" => "wp_autop",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-12"
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