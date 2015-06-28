<?php
/**
 * AS ARCHIVE CONTENT
 * - used for content display on archive pages (taxonomies)
 * 
 * @return string html content
 */
function as_archive_content_func() {
	global $post;
	
	if( !post_password_required() ) {
		
		if( strpos( $post->post_content, '<!--more-->' ) ) {
			$readmore = '<a class="button readmore" href="'. get_permalink( get_the_ID() ) . '">' . esc_html(__('Read More', 'showshop')) . ' <span class="more-icon icon-arrow-right2"></span></a>';
			the_content($readmore);
		}
		else {
			the_excerpt();
		}
	}else{
		echo '<p>' . esc_html__("This post is password protected","showshop") . '</p>';
	}
	
	
}
add_action('as_archive_content', 'as_archive_content_func',10);

/**
 *	NATIVE EXCERPT LENGTH 
 */
function as_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'as_custom_excerpt_length', 999 );
/**
 *	EXCERPT "Read more" 
 */
function new_excerpt_more( $more ) {
	return ' <a class="button readmore" href="'. get_permalink( get_the_ID() ) . '">' . esc_html(__('Read More', 'showshop')) . ' <span class="more-icon icon-arrow-right2"></span></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
/**
 *	EDIT POST LINK 
 */
function as_edit_post_link() {
	$post_edit_link = get_edit_post_link( get_the_ID() );
	$edit_post 		= $post_edit_link ? ' <a href="'. $post_edit_link .'" class="post-edit-link" title="'.__('Edit this','showshop').'"><div class="icon-pencil"></div></a>' : '';
	return $edit_post;
}
/**
 *	AS CUSTOM EXCERPT LENGTH
 *
 *	@param int $chars - length of excerpt in characters
 */
function as_custom_excerpt_func( $chars = 150, $has_readmore = true) {
	
	global $post;
	$ellipsis	= false;
	$text		= get_the_content();
	$readmore	= '<br /><a href="'.get_permalink().'" class="tiny button">'. esc_html('Read more','showshop') .'<span class="more-icon icon-arrow-right2"></span></a>';
	$text		= $text . " ";
	$text		= strip_tags($text);
	$text		= strip_shortcodes($text);  //strip_shortcodes - WP core function (WP Codex)
	
	if( $chars != 'full' ) {
		if( strlen($text) > $chars )
			$ellipsis = true;
		$text = substr($text,0,$chars);
		$text = substr($text,0,strrpos($text,' '));
		if( $ellipsis == true )
			$text = $text . '... ' . ($has_readmore ? $readmore : '') ;
	}
	return $text;
}
add_filter( 'as_custom_excerpt','as_custom_excerpt_func', 10, 2 );
//
/**
 *	MENU EXCERPT
 *
 *	@param int $chars - length of excerpt in characters
 *	@param string $text
 */
function as_menu_excerpt_func( $text, $chars = 150 ) {
	
	$ellipsis = false;
	$text = $text . " ";
	$text = strip_tags($text);
	$text = strip_shortcodes($text);  //strip_shortcodes - WP core function (WP Codex)
	
	if($chars != 'full') {
		if( strlen($text) > $chars )
			$ellipsis = true;
		$text = substr($text,0,$chars);
		$text = substr($text,0,strrpos($text,' '));
		if( $ellipsis == true )
			$text = $text . "...";
	}
	return $text;
}
add_filter('as_menu_excerpt','as_menu_excerpt_func', 10, 2);
//
//
/**
 *	POST FORMAT ICON function.
 *
 *	create icons using icon font using class html attribute.
 *
 */
if( !function_exists('as_post_format_icon')) {
	function as_post_format_icon() {
		global $post;
		$id = get_the_ID();
		$post_type = get_post_type($id);
		$post_format = get_post_format($id);
		
		if( $post_type == 'product' ) {
		
			$icon_class = 'icon-cart-2';
		
		}elseif( $post_format == 'video' ) {
			$icon_class = 'icon-play';
		}elseif( $post_format == 'audio' ) {
			$icon_class = 'icon-bullhorn';
		}elseif( $post_format == 'gallery' ) {
			$icon_class = ' icon-images';
		}elseif( $post_format == 'image' ) {
			$icon_class = 'icon-image';
		}elseif( $post_format == 'quote'  ) {
			$icon_class = 'icon-quotes-left';
		}elseif( $post_format == '' ) {
			$icon_class = 'icon-blog';
		}else{
			$icon_class = 'icon-blog';
		}

		if( $icon_class ) {
			$post_format_icon_output = '<div class="icon"><span class="'.esc_attr($icon_class).'" aria-hidden="true" ></span></div>';
			return $post_format_icon_output;
		}
	}
}
/**
 *	POST FORMAT ACTION ICON.
 *
 *	create icons using icon font using class attribute.
 *	used in items hover for prettyPhoto modal window opening big image, gallery, video, audio or quote
 *
 */
if( !function_exists('as_post_format_icon_action')) {
	function as_post_format_icon_action() {
		global $post;
		$id = get_the_ID();
		$post_type = get_post_type($id);
		$post_format = get_post_format($id);
		
		if( $post_type == 'product' ) {
		
			$icon_class = 'icon-zoom-in';
		
		}elseif( $post_format == 'video' || $post_format == 'audio') {
			$icon_class = 'icon-play';
		}elseif( $post_format == 'gallery' || $post_format == 'image' || $post_format == 'quote' || $post_format == '') {
		
			$icon_class = 'icon-zoom-in';
		}

		$post_format_icon_action = '<div class="icon '. esc_attr($icon_class) .'" aria-hidden="true"></div>';
		
		return $post_format_icon_action;
	}
}
/**
 *	PREVIUOS / NEXT POST LINKS.
 *
 *	replaces default post navigation function to create custom html output.
 *
 */
function as_prev_next_post() {
	
	$output = '<nav class="nav-single">';
		
		$prev_icon		= '<span class="icon icon-angle-left" aria-hidden="true"></span>';
		$next_icon		= '<span class="icon icon-angle-right" aria-hidden="true"></span>';
		$no_prev_next	= '<span class="icon icon-close" aria-hidden="true"></span>';
		
		$prevPost	= get_previous_post();
		$prevURL	= $prevPost ? get_permalink($prevPost->ID) : '';
		$prevTitle	= $prevPost ? $prevPost->post_title : '';
		$prevPrefix = __('Previous : ','showshop');
		$nextPost	= get_next_post();
		$nextURL	= $nextPost ? get_permalink($nextPost->ID) : '';
		$nextTitle	= $nextPost ? $nextPost->post_title : '';
		$nextPrefix = __('Next : ','showshop');
		
		if( $prevPost ) {
		$output .= '<span class="nav-previous">';
			$output .= '<a href="'. esc_url($prevURL) .'" rel="prev" title="'. esc_attr( strip_tags($prevPrefix . $prevTitle) ) .'" class="left">';
			$output .= $prev_icon;
			$output .= '<span class="hidden">'. get_the_post_thumbnail( $prevPost->ID, 'thumbnail' );
			$output .= '<span class="title">'. esc_html($prevPrefix) .'<br>'. esc_html($prevTitle)  .'</span></span>';
			$output .= '</a>';
			$output .= '</span>';
		};
		
		if( $nextPost ) {
		$output .= '<span class="nav-next">';
			$output .= '<a href="'. esc_url($nextURL) .'" rel="next" title="'.esc_attr( strip_tags($nextPrefix . $nextTitle) ). '" class="right">';
			$output .= $next_icon;
			$output .= '<span class="hidden">'. get_the_post_thumbnail( $nextPost->ID, 'thumbnail' );
			$output .= '<span class="title">'. esc_html($nextPrefix) .'<br>'. esc_html($nextTitle)  .'</span></span>';
			$output .= '</a>';
			$output .= '</span>';
		};
		
	$output .= '</nav><!-- .nav-single -->';
	
	return $output;
}
//
//
if (! function_exists('as_chat_formatting') ) :
/**
 * Auto-bold names in chat posts
 */
function as_chat_formatting( $content ) {
  if (has_post_format('chat')) {
    $content = preg_replace('%<p>\s*([^:]+):(\s.*)</p>%e', '\'<p class="chat"><span class="person person-\'.sanitize_title(\'\\1\').\'">\\1:</span>\\2</p>\'', $content);
  }
  return $content; 
}
endif;
// Run after WP html formatting
add_filter('the_content', 'as_chat_formatting', 15);


/**
 *	META BOX AND FIELD FOR FEATURED ITEM.
 *
 * Adds a box to the main column on the Post and Page edit screens.
 */
function as_featured_custom_box() {

    $screens =  array( 'portfolio', 'slide' );
	
	foreach ( $screens as $screen ) {

        add_meta_box(
            '_featured_item_metabox',		// $id
            __( 'Featured', 'showshop' ),		// $title
            'as_inner_custom_box',			// $callback
			$screen ,						// $post_type
			'side',							// $context
			'high'							// $priority
											// $callback_args
        );
    }
}
add_action( 'add_meta_boxes', 'as_featured_custom_box' );
/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function as_inner_custom_box( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'as_inner_custom_box', 'as_inner_custom_box_nonce' );

	/*
	* Use get_post_meta() to retrieve an existing value
	* from the database and use the value for the form.
	*/
	$value = get_post_meta( $post->ID, 'as_featured_item', true );

	echo '<label for="as_featured_field">'. _e( "Make this item featured", 'showshop' ) .'</label>';
	echo '<input type="checkbox" id="as_featured_field" name="as_featured_field" value="1" '. checked( 1, $value, false ) .' size="25" style="float: right;"/>';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function as_featured_save_postdata( $post_id ) {

	/*
	* We need to verify this came from the our screen and with proper authorization,
	* because save_post can be triggered at other times.
	*/

	// Check if our nonce is set.
	if ( ! isset( $_POST['as_inner_custom_box_nonce'] ) )
	return $post_id;

		$nonce = $_POST['as_inner_custom_box_nonce'];

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $nonce, 'as_inner_custom_box' ) )
		return $post_id;

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;

	// Check the user's permissions.
	if ( 'page' == $_POST['post_type'] ) {

	if ( ! current_user_can( 'edit_page', $post_id ) )
		return $post_id;

	} else {

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	}

	/* OK, its safe for us to save the data now. */

	// Sanitize user input.
	$mydata = sanitize_text_field( $_POST['as_featured_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'as_featured_item', $mydata );
}
add_action( 'save_post', 'as_featured_save_postdata' );
/** end FEATURED META BOX */
?>