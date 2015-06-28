<?php
/* 
//REMOVE VC PLUGIN WAYPOINTS ( CONFILCT WITH STICKY METHOD USED IN THEME )
add_action( 'wp_footer' , 'as_override_waypoints' );
function as_override_waypoints(){
    wp_dequeue_script('waypoints');
	wp_deregister_script('waypoints');
}
 */
function VC_AS_init() {

	if( class_exists('Vc_Manager') ) {
	
		global $as_woo_is_active;
		
		########## THEME VISUAL COMPOSER SHORTCODES
		
		include('shortcodes/as_ajax_cats.php');		// PRODUCTS AJAXED BY CATEGORIES
		include('shortcodes/as_filter_cats.php');	// POSTS, PORTFOLIO FILTERED BY CATEGORIES
		include('shortcodes/as_slick_slider.php');	// SLICK SLIDER
		include('shortcodes/as_superslides.php');	// SUPERLIDES
		include('shortcodes/as_menu.php');			// CUSTOM MENU
		include('shortcodes/as_social.php');		// SOCIAL
		include('shortcodes/as_banner.php');		// BANNER
		include('shortcodes/as_images_slider.php');	// IMAGES SLIDER
		include('shortcodes/as_testimonials.php');	// TESTIMONIAL
		include('shortcodes/as_single_lookbook.php');// LOOKBOOK
		include('shortcodes/as_gmap.php');			// GOOGLE MAP
		include('shortcodes/as_heading.php');		// HEADING
		include('shortcodes/as_contact.php');		// CONTACT
		include('shortcodes/as_video.php');			// VIDEO PLAYER
		include('shortcodes/as_widget_areas.php');	// WIDGETS
		
		if( $as_woo_is_active ) {
			include('shortcodes/as_ajax_prod.php');		// POSTS, PORTFOLIO AJAXED BY CATEGORIES
			include('shortcodes/as_filter_prod.php');	// PRODUCTS FILTERED BY CATEGORIES
			include('shortcodes/as_prod_cats.php');		// PRODUCT  CATEGORIES
			include('shortcodes/as_single_product.php');	// SINGLE PRODUCT
			include('shortcodes/as_single_prod_cat.php');	// PRODUCTS FROM SINGLE CATEGORY
			include('shortcodes/as_prod_category.php');		// SINGLE PRODUCT CATEGORY
		}
		
		/** 
		 * RANDOM STRING GENERATOR. 
		 * Used for: generated unique block ID (js and customizing actions)
		 * Used in:
		 * - as_vc_extend/shortcodes/ - all files
		 * - vc_templates/vc_row.php
		 */
		
		function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		// SEPARATOR FOR FIELDS
		function as_vc_separator($settings, $value) {
			
			$separator_html  = '<div class="separator"></div>';
			
			return $separator_html;
		}
		add_shortcode_param('separator', 'as_vc_separator' );

		
		/**
		 *	CUSTOM MENU CSS TO BODY TAG
		 */
		function custom_menu_body_class( $c ) {
			global $post;
			if( isset($post->post_content) && has_shortcode( $post->post_content, 'as_menu' ) ) {
				$c[] = 'has-custom-menu';
			}
			return $c;
		}
		add_filter( 'body_class', 'custom_menu_body_class' );
		
		/**
		 *	HEADINGS for all the blocks
		 */
		function as_block_heading_func( $title="", $subtitle="", $title_style="", $sub_position="", $title_color="", $subtitle_color="", $no_title_shadow="", $title_size="" ) {
						
			$without_title = !$title && $subtitle ? ' without-title' : '';
			
			$heading = '<div class="header-holder '. $title_style.' titles-holder'. ($no_title_shadow ? ' no-title-shadow' : '') .'">';
			
			// DISPLAY BLOCK TITLE AND "SUBTITLE":
			$sub = $subtitle ? '<div class="block-subtitle '. esc_attr($sub_position). ' ' .esc_attr($title_style) . esc_attr($without_title) .'"'. (esc_attr($subtitle_color) ? ' style="color:'.esc_attr($subtitle_color).';"' : '') . '>' . esc_html($subtitle) . '</div>' : '';

			$title_css  = 'style="';
			$title_css .= $title_color ? 'color:'.esc_attr($title_color).'; ' : '';
			$title_css .= $title_size ? 'font-size:'.esc_attr($title_size).';' : '';
			$title_css .= '"';

			$heading .= $sub_position == 'above'  ? $sub : '';

			$heading .= $title ? '<h3 class="block-title '. esc_attr($title_style) .'" '. $title_css . ' data-shadow-text="'.esc_attr($title).'">' . esc_html($title) . '</h3>' : '';

			$heading .= $sub_position == 'bellow'  ? $sub : '';
			
			$heading .= '</div>';
			
			echo wp_kses_decode_entities($heading);
			
		}
		add_action('as_block_heading','as_block_heading_func', 10, 8);
		
		
		
	}// end if class_exists
	
	
}
add_action('init','VC_AS_init');

/**
 *	VC ADMIN FUNCTIONS
 **/
function VC_AS_admin_init() {
	
	if( class_exists('Vc_Manager') ) {
	
		global $as_woo_is_active, $as_of;
		
		vc_set_as_theme();
		
		if( !$as_of['vc_frontend'] ) {
			vc_disable_frontend();
		}
		
		include('shortcodes-mapping/as_ajax_cats_params.php');		// AJAXED CONTENT
		include('shortcodes-mapping/as_filter_cats_params.php');	// FILTERED CONTENT
		include('shortcodes-mapping/as_slick_slider_params.php'); 	// SLICK SLIDER
		include('shortcodes-mapping/as_superslides_params.php'); 	// SUPERSLIDES
		include('shortcodes-mapping/as_menu_params.php'); 			// CUSTOM MENU
		include('shortcodes-mapping/as_social_params.php'); 		// SOCIAL
		include('shortcodes-mapping/as_banner_params.php'); 		// BANNER
		include('shortcodes-mapping/as_testimonials_params.php'); 	// TESTIMONIAL
		include('shortcodes-mapping/as_images_slider_params.php'); 	// IMAGES SLIDER
		include('shortcodes-mapping/as_single_lookbook_params.php');// LOOKBOOK
		include('shortcodes-mapping/as_gmap_params.php');			// GOOGLE MAP
		include('shortcodes-mapping/as_heading_params.php');		// HEADING
		include('shortcodes-mapping/as_contact_params.php');		// HEADING
		include('shortcodes-mapping/as_video_params.php');			// VIDEO PLAYER
		include('shortcodes-mapping/as_widget_areas_params.php');	// WIDGETS
		include('helpers/helpers.php');
		
		if( $as_woo_is_active ) {
			include('shortcodes-mapping/as_ajax_prod_params.php');		// AJAXED PRODUCTS
			include('shortcodes-mapping/as_filter_prod_params.php');	// FILTERED PRODUCTS
			include('shortcodes-mapping/as_prod_cats_params.php');		// PRODUCT CATEGORIES
			include('shortcodes-mapping/as_single_prod_params.php');	// SINGLE PRODUCT
			include('shortcodes-mapping/as_single_prod_cat_params.php');// PRODUCTS FROM SINGLE CATEGORY
			include('shortcodes-mapping/as_prod_category_params.php');	// SINGLE PRODUCT CATEGORY
		}
		
		/**
		 *	GET TERMS ARRAY FOR SHORTCODES SETTINGS
		 *	as_vc_terms filter - term name and term slug switched with array_flip()
		 */
		
		function as_vc_terms_for_blocks_func( $taxonomy ) {
			
			if( ! taxonomy_exists( $taxonomy ) ) return;
			
			$as_terms_array = apply_filters('as_terms', $taxonomy );
			
			$as_vc_terms_array = isset($as_terms_array) ? array_flip($as_terms_array) : array();
			
			return $as_vc_terms_array;
			
		}
		add_filter('as_vc_terms','as_vc_terms_for_blocks_func', 10, 1);
		
		/**
		 *	GET MENUS ARRAY FOR SHORTCODES SETTINGS
		 *
		 */
		
		function as_vc_get_menus_func( $hide_empty = true ) {
		
			$menus = get_terms( 'nav_menu', array( 'hide_empty' =>  $hide_empty ) );
			$menu_array = array();
			foreach( $menus as $menu ) {
				$menu_array[$menu->name] = $menu->slug ;
			}
			
			return $menu_array;
			
		}
		add_filter( 'as_vc_get_menus','as_vc_get_menus_func', 10 );
		/**
         * AS_GET_WIDGET_AREAS
         * 
         * 
         * @return <array>
         */
		
		function as_get_widget_areas( $empty = false ) {
			
			foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar){
				$sidebar_options[$sidebar['name']] = $sidebar['id'];
			}
			
			return $sidebar_options;
		}
		add_filter( 'as_get_widgets','as_get_widget_areas', 10 );
		
		
		/*
		 *	THEME ACCENT COLORS - for usage in different elements
		 *	- array_merge() with other array of settings
		 */
		$accent_colors = array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Accent colors background','showshop'),
				"param_name" => "accent_color",
				"value" => array(
					'' => '',
					'Accent color 1 (opacity 0.1)'	=> 'accent-1-transp-90',
					'Accent color 1 (opacity 0.3)'	=> 'accent-1-transp-70',
					'Accent color 1 (opacity 0.4)'	=> 'accent-1-transp-60',

					'Accent color 1 (light)'		=> 'accent-1-light-30',
					'Accent color 1 (lighter)'		=> 'accent-1-light-40',
					'Accent color 1 (lightest)'		=> 'accent-1-light-45',

					'Accent color 2 (opacity 0.2)'	=> 'accent-2-a',
					'Accent color 2 (opacity 0.4)'	=> 'accent-2-b',
					'Accent color 2 (opacity 0.7)'	=> 'accent-2-c',

					'Accent color 2 (light)'		=> 'accent-2-light-30',
					'Accent color 2 (lighter)'		=> 'accent-2-light-40',
					'Accent color 2 (lightest)'		=> 'accent-2-light-47',
					'Force no back color' 			=> 'force-no-back-color',
				),
				"description" => __("Use theme accent colors for background. Accent colors are set in skins and/or theme options.","showshop"),
				"edit_field_class"=> "vc_col-sm-6",
				'group' => __('Design Options','showshop')
			),
		
		);
				
		
		/**
		 *	Additional ROW settings
		 */
		
		$add_row_attributes = array(
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Parallax background image",'showshop'),
				"param_name" => "parallax",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("check if you want to use parallax effect on background image",'showshop'),
				"edit_field_class"=> "vc_col-sm-6",
				'group' => __('Design Options','showshop')
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Overlay color","showshop"),
				"param_name" => "overlay_color",
				"value" => '',
				"description" => __("Choose color for overlay - between content and (paralax) background image","showshop"),
				'group' => __('Design Options','showshop')
			),			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Overlay opacity','showshop'),
				"param_name" => "overlay_opacity",
				"value" => '0.8',
				"description" => __('Default opacity for overlay - (change it, if you must)','showshop'),
				"edit_field_class"=> "vc_col-sm-6",
				'group' => __('Design Options','showshop')
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Boxed content?",'showshop'),
				"param_name" => "boxed",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("in case you're using \"Page builder template\" and want content boxed (NO fullwidth)",'showshop'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row settings','showshop')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Add grid spacing",'showshop'),
				"param_name" => "grid_spacing",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("add spaces between elements inside this row",'showshop'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row settings','showshop')
			),

			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Equalize row elements",'showshop'),
				"param_name" => "equalize",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => __("careful with this - an lead to undesired effects. Works only with theme blocks.",'showshop'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row settings','showshop')
			),
			/* ===== VIDEO TAB ===== */
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('YouTube video ID','showshop'),
				"param_name" => "videourl",
				"value" => '',
				"description" => __('Enter ONLY video ID, not the whole address','showshop'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Autoplay video','showshop'),
				"param_name" => "autoplay",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Mute video','showshop'),
				"param_name" => "mute",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Optimize display','showshop'),
				"param_name" => "optimizedisplay",
				"value" =>array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_video_1",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12",
				'group' => __('Theme row video settings','showshop')
			),

			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Loop video','showshop'),
				"param_name" => "loop",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Video sound volume','showshop'),
				"param_name" => "volume",
				"value" => '50',
				"description" => __('Enter value between 0 - 100','showshop'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Video quality','showshop'),
				"param_name" => "quality",
				"value" => array(
						'Default'	=> 'default',
						'Small'		=> 'dmall',
						'Medium'	=> 'medium',
						'Large'		=> 'large',
						'hd720'		=> 'HD720',
						'hd1080'	=> 'HD1080',
						'High resolution'	=> 'highres'
					),
				"description" =>"",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Video ratio','showshop'),
				"param_name" => "ratio",
				"value" => array(
						'16/9'		=> '16/9',
						'4/3'		=> '4/3',
					),
				"description" =>"",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Embedded HTML 5 video","showshop"),
				"param_name" => "sep_video_2",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12",
				'group' => __('Theme row video settings','showshop')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('HTML 5 video','showshop'),
				"param_name" => "htmlfivevideo",
				"value" => '',
				"description" => __('<strong>Self hosted video URL or URL to remote video files. </strong><br>
			Enter full path to video file name and exclude extension - the mp4, webm and ogg extension will be added automatically.<br>
			All required video file types OGV, WEBB and OGG files should be available (locally, self-hosted, or remote) for browser compatibility.','showshop'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','showshop')
			),
			
		);
		
		$row_attributes = array_merge( $accent_colors ,$add_row_attributes );
		
		vc_add_params( 'vc_row', $row_attributes );
		
		/*
		 *	COLUMN ELEMENT - ADDITIONAL SETTINGS
		 */
		$add_column_attributes = array(
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color","showshop"),
				"param_name" => "font_color",
				"value" => '',
				"description" => __("Choose color for text - general column setting - can be overriden by inner elements settings","showshop"),
				'group' => __('Design Options','showshop')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Sticky column settings','showshop'),
				"param_name" => "column_sticked",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Sticky column','showshop')
			),
		);
		vc_add_params( 'vc_column', $add_column_attributes );
		
		/*
		 *	MESSAGE BOX ELEMENT - ADDITIONAL SETTINGS
		 */
		
		$add_mb_attributes = array();
		$mb_attributes = array_merge( $accent_colors ,$add_mb_attributes );
		
		vc_add_params( 'vc_message', $mb_attributes );
		
		
	}// end if class_exists
	
}
add_action('after_setup_theme','VC_AS_admin_init');
?>