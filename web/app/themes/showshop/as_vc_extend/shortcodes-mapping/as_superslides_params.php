<?php
add_action( 'vc_before_init', 'map_as_superslides' );
function map_as_superslides() {
	
	// IF WOOCOMMERCE IS ACTIVATED: 
	$is_product_tax	= taxonomy_exists( 'product_cat' );
	$is_port_tax	= taxonomy_exists( 'portfolio_category' );
	
	if( $is_product_tax ){
	
		$prod_cats_array = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Product categories",'showshop'),
				"param_name" => "product_cats",
				"value" => apply_filters('as_vc_terms', 'product_cat' ),
				"description" => __('select one or multiple, "Post types" must be set to "Products"','showshop'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
				//"weight" => 1
			)
		);
	}else{
		$prod_cats_array = array();
	}
	
	if( $is_port_tax ){
	
		$portfolio_cats_array = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Portfolio categories",'showshop'),
				"param_name" => "portfolio_cats",
				"value" => apply_filters('as_vc_terms', 'portfolio_category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Portfolio categories"','showshop'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
				//"weight" => 2 
			)
		);
	
	}else{
		$portfolio_cats_array = array();
	}
	
	$main_array = array(


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
				"heading" => __("Stretched of fixed",'showshop'),
				"param_name" => "abs_stretched",
				"value" => array(
					'Fixed'		=> 'fixed',
					'Stretch'	=> 'stretched',
					),
				"description" => __("- If <strong>\"Stretch\"</strong>, the slider will resize (width and height) with other elements in row.<strong><br>NOTE:<br>- Row settings must have checked \"Equalize row elements\" (Theme row settings tab)<br>- If set to \"Stretched\" the \"Set slides height\" will be overriden<br>- Use \"Stretched\" only with other elements in row. </strong>","showshop"),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Post type and categories",'showshop'),
				"param_name" => "sep_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post type or images",'showshop'),
				"param_name" => "post_type",
				"value" => array(
					'Post'		=> 'post',
					'Portfolio'	=> 'portfolio',
					'Product'	=> 'product',
					'Images'	=> 'images'
					),
				"description" => __("Display post, products, portfolio or selection of images from media library","showshop"),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
                "type" => "attach_images",
                "heading" => __("Slide images", "showshop"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library images for slide. Must have selected \"Images\" from option above", "showshop"),
				"edit_field_class"=> "vc_col-sm-12"
             ),
			
			
		);
			
		$main_array_2 = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Blog post categories",'showshop'),
				"param_name" => "post_cats",
				"value" => apply_filters('as_vc_terms', 'category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Post"','showshop'),
				"edit_field_class"=> "vc_col-sm-4"
				//"weight" => 100 
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Image settings and filtering",'showshop'),
				"param_name" => "sep_2",
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
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Special filters",'showshop'),
				"param_name" => "filters",
				"value" => array(
					'Latest'		=> 'latest',
					'Featured'		=> 'featured',
					'Random'		=> 'random',
					'Best selling (only WC products)'	=> 'best_sellers',
					'Best rated (only WC products)'	=> 'best_rated'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Style and effects settings",'showshop'),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background color for text",'showshop'),
				"param_name" => "overlay",
				"value" => '',
				"description" => __("Choose background color for item text (title, excerpt)","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Links color",'showshop'),
				"param_name" => "links_color",
				"value" => '',
				"description" => __("Choose color for item links","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color",'showshop'),
				"param_name" => "text_color",
				"value" => '',
				"description" => __("Choose color for item text","showshop"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Slider settings",'showshop'),
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Total items (slides)",'showshop'),
				"param_name" => "total_items",
				"value" => '8',
				"description" => __("how many items will scroll in slick scroller ?","showshop"),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show navigation arrows ?",'showshop'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show navigation dots ?",'showshop'),
				"param_name" => "slider_pagin",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_4_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Slider timing",'showshop'),
				"param_name" => "slider_auto",
				"value" => '',
				"description" => __('type in the timing for auto sliding items. If left blank no auto sliding will occur.','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Fade images",'showshop'),
				"param_name" => "fade_images",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("Use fading images instead of sliding","showshop"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Use KenBurns effect ?",'showshop'),
				"param_name" => "kenburns",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("KenBurns effect is slowly zooming and panning image","showshop"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Set slides height",'showshop'),
				"param_name" => "set_height",
				"value" => '',
				"description" => __('Will add responsiveness to slides.<br>Enter the value <strong>AND</strong> units (<strong>px</strong>, <strong>pt</strong>,<strong> em</strong> or <strong>rem</strong>)','showshop'),
				"edit_field_class"=> "vc_col-sm-3"
			),

			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Additional CSS classes",'showshop'),
				"param_name" => "css_classes",
				"value" => '',
				"description" => __("add your custom css classes","showshop"),
				"edit_field_class"=> "vc_col-sm-12"
			)
		);
	
	$params_array = array_merge( $main_array, $prod_cats_array, $portfolio_cats_array ,$main_array_2 );
	
	vc_map( array(
		"name" => __("Superslides","showshop"),
		"base" => "as_superslides",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_superslides',
		"category" => __('ShowShop theme elements','showshop'),
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/as_vc_extend/shotcodes/css/input.css'),
		"params" => $params_array // end params array
		) // end array vc_map()
	); // end vc_map()
	

	
	// IF WOOCOMMERCE IS ACTIVATED: 
	/* 
	$is_product_tax	= taxonomy_exists( 'product_cat' );
	$is_port_tax	= taxonomy_exists( 'portfolio_category' );
	
	if( $is_product_tax ){
	
		$add_prod_cats = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Product categories",'showshop'),
				"param_name" => "product_cats",
				"value" => apply_filters('as_vc_terms', 'product_cat' ),
				"description" => __('select one or multiple, "Post types" must be set to "Products"','showshop'),
				"weight" => 10 
			)
		);
		vc_add_params( 'as_slick_slider', $add_prod_cats );
	
	}
	
	if( $is_port_tax ){
	
		$add_portfolio_cats = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Portfolio categories",'showshop'),
				"param_name" => "portfolio_cats",
				"value" => apply_filters('as_vc_terms', 'portfolio_category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Portfolio categories"','showshop'),
				"weight" => 20 
			)
		);
		vc_add_params( 'as_slick_slider', $add_portfolio_cats );
	}
	 */
}
?>