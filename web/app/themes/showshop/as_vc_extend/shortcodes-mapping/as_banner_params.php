<?php
add_action( 'vc_before_init', 'map_as_banner' );
function map_as_banner() {
	vc_map( array(
		"name" => __("Banner","showshop"),
		"base" => "as_banner",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_banner',
		"category" => __('ShowShop theme elements','showshop'),
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/as_vc_extend/shotcodes/css/input.css'),
		"params" => array(
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Banner text settings","showshop"),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Banner title",'showshop'),
				"param_name" => "title",
				"value" => "",
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title size",'showshop'),
				"param_name" => "title_size",
				"value" => array(
					'Normal'		=> 'normal',
					'Medium'		=> 'medium',
					'Large'			=> 'large',
					'Extra large'	=> 'extra_large',
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Banner subtitle",'showshop'),
				"param_name" => "subtitle",
				"value" => "",
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => __("Banner text",'showshop'),
				"param_name" => "content",
				"value" => "",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color","showshop"),
				"param_name" => "text_color",
				"value" => '',
				"description" => __("Choose text color","showshop"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Text float",'showshop'),
				"param_name" => "text_align",
				"value" => array(
					'Center'	=> 'center',
					'Left'		=> 'left',
					'Right'		=> 'right'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Text padding",'showshop'),
				"param_name" => "text_padding",
				"value" => "",
				"description" => __("If zero or empty, it will be ignored","showshop"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Text border style",'showshop'),
				"param_name" => "border",
				"value" => array(
					'None'		=> 'none',
					'Solid'		=> 'solid',
					'Dashed'	=> 'dashed',
					'Dotted'	=> 'dotted',
					'Double'	=> 'double'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_0",
				"value" => '',
				"desc" =>"",
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Disable invert colors on hover effect",'showshop'),
				"param_name" => "disable_invert",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("TEXT overlay color",'showshop'),
				"param_name" => "overlay",
				"value" => '',
				"description" => __("Choose overlay color","showshop"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_3_0",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Banner overlay color",'showshop'),
				"param_name" => "block_overlay",
				"value" => '',
				"description" => __("Choose overlay color for all block (text block has it's separate color controls )","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Banner opacity",'showshop'),
				"param_name" => "block_opacity",
				"value" => "",
				"description" => __("Enter value AND unit (px, em, rem, %)","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Banner height",'showshop'),
				"param_name" => "banner_height",
				"value" => "",
				"description" => __("add value AND unit ( px, em, rem, % ) for stretch banner height ","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Additional layout and styles settings",'showshop'),
				"param_name" => "sep_1_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'showshop' ),
				'param_name' => 'css',
				//'group' => __( 'Design options', 'showshop' ),
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Animation settings","showshop"),
				"param_name" => "sep_2",
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
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay",'showshop'),
				"param_name" => "anim_delay",
				"value" => "",
				"description" => __("Type the value for delay of block animation delay. Use the miliseconds ( 1second = 1000 miliseconds; example: 100 for 1/10th of second )","showshop"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Button settings","showshop"),
				"param_name" => "sep_3",
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
				"param_name" => "link_button",
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
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_4",
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