<?php
add_action( 'vc_before_init', 'map_as_testimonials' );
function map_as_testimonials() {
	vc_map( array(
		"name" => __("Testimonials","showshop"),
		"base" => "as_testimonials",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_testimonials',
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
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Testimonial items alignment",'showshop'),
				"param_name" => "align",
				"value" =>  array(
					'Align left'	=> 'align_left',
					'Centred'		=> 'center',
					'Align right'	=> 'align_right'
					),
				"description" => ""
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_5",
				"value" => '',
				"description" => __("For each testimonial item, add image, add testimonial text and testimonial auhor name, separated by new line","showshop"),
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
                "type" => "attach_images",
                "heading" => __("Testimonial author images", "showshop"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "showshop"),
				"edit_field_class"=> "vc_col-sm-8"
             ),
			 array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Image style",'showshop'),
				"param_name" => "image_style",
				"value" => array(
					'Diamond' => 'diamond',
					'Round' => 'round',
					'Square'=> 'square',
				),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "exploded_textarea",
				"heading" => __("Testimonial author name", 'showshop'),
				"param_name" => "authors",
				"value" => __("Annette Begin,Humphrey Bogota,David Letterson", 'showshop'),
				"description" => __("Use new line (press Enter) for each author", 'showshop'),
				"admin_label" => true,
			),
			array(
				"type" => "textarea_html",
				"heading" => __("Testimonial text", "showshop"),
				"param_name" => "content",
				"value" => "Testimonial text one - this is the best place to input your testimonial. Don't use any other.\n\nTestimonial text two - this is the best place to input your testimonial. Don't use any other.\n\nTestimonial text three - this is the best place to input your testimonial. Don't use any other.",
				"description" => __("Use new line (press Enter) for each testimonial text", "showshop")
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Testimonial text color","showshop"),
				"param_name" => "text_color",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Testimonial author color","showshop"),
				"param_name" => "author_color",
				"value" => '#999',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
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
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide slider navigation?",'showshop'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('use prev / next arrows','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide slider pagination?",'showshop'),
				"param_name" => "slider_pagin",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __('pagination dots bellow the slider','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Slider timing",'showshop'),
				"param_name" => "slider_timing",
				"value" => '5000',
				"description" => __('If empty, no automatic sliding will happen.','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
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
				"heading" => '',
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
			
			
		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
?>