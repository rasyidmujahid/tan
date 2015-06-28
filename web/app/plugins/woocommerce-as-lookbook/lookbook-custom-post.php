<?php
/**
 *	Register custom post type and custom taxonomy
 *
 */
/*   */
function filter_lookbook_cpt_link($link, $post) {
    if ($post->post_type != 'lookbook')
        return $link;
    if ($cats = get_the_terms($post->ID, 'lookbook_category')){
        $link = str_replace('%lookbook_category%', array_pop($cats)->slug, $link);
    }else{
		$link = str_replace('%lookbook_category%/', '', $link);
	}
	return $link;
}

add_filter('post_type_link', 'filter_lookbook_cpt_link', 10, 2);




/**
 *	LOOKBOOK POST TYPE 
 *	func. lookbook_post_type()- called from "woocommerce-as-lookbook.php" file
 *
 */

function lookbook_post_type() {

	/**
	 * Enable the lookbook custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */


	$labels = array(
		'name'			=> __( 'Lookbook', 'aslb' ),
		'singular_name'	=> __( 'Lookbook Item', 'aslb' ),
		'add_new'		=> __( 'Add New Item', 'aslb' ),
		'add_new_item'	=> __( 'Add New Lookbook Item', 'aslb' ),
		'edit_item'		=> __( 'Edit Lookbook Item', 'aslb' ),
		'new_item'		=> __( 'Add New Lookbook Item', 'aslb' ),
		'view_item'		=> __( 'View Item', 'aslb' ),
		'search_items'	=> __( 'Search Lookbook', 'aslb' ),
		'not_found'		=> __( 'No Lookbook items found', 'aslb' ),
		'not_found_in_trash' => __( 'No Lookbook items found in trash', 'aslb' )
	);

	$args = array(
    	'labels'			=> $labels,
    	'public'			=> true,
		//'supports'			=> array( 'title', 'editor', 'thumbnail', 'comments','post-formats' ),
		'supports'			=> array( 'title', 'thumbnail', 'comments', 'editor' ),
		'capability_type'	=> 'post',
		'rewrite'			=> array("slug" => "lookbook/%lookbook_category%", 'with_front' => true, 'pages'=> true), // Permalinks format
		'menu_position'		=> 5,
		'has_archive'		=> 'lookbook',
		'hierarchical'		=> false,
		'menu_icon'			=> 'dashicons-images-alt'
	); 

	register_post_type( 'lookbook', $args );
	
	

	/**
	 * Register a taxonomy for lookbook Categories
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */


    $taxonomy_lookbook_category_labels = array(
		'name'					=> _x( 'Lookbook Categories','admin_labels', 'aslb' ),
		'singular_name'			=> _x( 'Lookbook Category','admin_labels', 'aslb' ),
		'search_items'			=> _x( 'Search Lookbook Categories','admin_labels', 'aslb' ),
		'popular_items'			=> _x( 'Popular Lookbook Categories','admin_labels', 'aslb' ),
		'all_items'				=> _x( 'All Lookbook Categories','admin_labels', 'aslb' ),
		'parent_item'			=> _x( 'Parent Lookbook Category','admin_labels', 'aslb' ),
		'parent_item_colon'		=> _x( 'Parent Lookbook Category:','admin_labels', 'aslb' ),
		'edit_item'				=> _x( 'Edit Lookbook Category','admin_labels', 'aslb' ),
		'update_item'			=> _x( 'Update Lookbook Category','admin_labels', 'aslb' ),
		'add_new_item'			=> _x( 'Add New Lookbook Category','admin_labels', 'aslb' ),
		'new_item_name'			=> _x( 'New Lookbook Category Name','admin_labels', 'aslb' ),
		'separate_items_with_commas' => _x( 'Separate Lookbook categories with commas','admin_labels', 'aslb' ),
		'add_or_remove_items'	=> _x( 'Add or remove Lookbook categories','admin_labels', 'aslb' ),
		'choose_from_most_used' => _x( 'Choose from the most used Lookbook categories','admin_labels', 'aslb' ),
		'menu_name'				=> _x( 'Lookbook Categories','admin_labels', 'aslb' ),
    );
	
    $taxonomy_lookbook_category_args = array(
		'labels'			=> $taxonomy_lookbook_category_labels,
		'public'			=> true,
		'show_in_nav_menus' => true,
		'show_ui'			=> true,
		'show_tagcloud'		=> true,
		'hierarchical'		=> true,
		'rewrite'			=> array( 'slug' => 'lookbook' ),
		'query_var'			=> true
    );
	
    register_taxonomy( 'lookbook_category', array( 'lookbook' ), $taxonomy_lookbook_category_args );
	
}
//add_action( 'init', 'lookbook_post_type' );



/**
 *	APPEND LOOKBOOK CPT SUPPORT FOR POST THUMBNAILS ( to themes and plugins existing support )
 *
 
function lookbook_post_thumb() {

	$thumbSupportedIn = get_theme_support( 'post-thumbnails' );
	$thumbLookBook = array('lookbook');
	$postThumbnailTypes = array_merge( $thumbSupportedIn[0], $thumbLookBook );
	add_theme_support( 'post-thumbnails', $postThumbnailTypes );
	
}
add_action('init','lookbook_post_thumb');
*/

/**
 * Add Columns to lookbook Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 

function lookbook_post_type_edit_columns($lookbook_columns){
	$lookbook_columns = array(
		"cb"				=> "<input type=\"checkbox\" />",
		"title"				=> _x('Title', 'column name','aslb'),
		"thumbnail"			=> __('Thumbnail', 'aslb'),
		"lookbook_category" => __('Lookbook category', 'aslb'),
		"lookbook_tag"		=> __('Tags', 'aslb'),
		"author"			=> __('Author', 'aslb'),
		"comments"			=> __('Comments', 'aslb'),
		"date"				=> __('Date', 'aslb'),
	);
	$lookbook_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $lookbook_columns;
}

add_filter( 'manage_edit-lookbook_columns', 'lookbook_post_type_edit_columns' );
 
function lookbook_post_type_columns_display($lookbook_columns, $post_id){

	switch ( $lookbook_columns )
	
	{
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		/* 
		case "thumbnail":
		$width = (int) 35;
		$height = (int) 35;
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		
		// Display the featured image in the column view if possible
		if ($thumbnail_id) {
			$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
		}
		if ( isset($thumb) ) {
			echo $thumb;
		} else {
			echo __('None', 'aslb');
		}
		break;
		*/
		
		// Display the lookbook tags in the column view
		case "lookbook_category":
		
		if ( $category_list = get_the_term_list( $post_id, 'lookbook_category', '', ', ', '' ) ) {
			echo $category_list;
		} else {
			echo __('None', 'aslb');
		}
		break;	
		
		/* 
		// Display the lookbook tags in the column view
		case "lookbook_tag":
		
		if ( $tag_list = get_the_term_list( $post_id, 'lookbook_tag', '', ', ', '' ) ) {
			echo $tag_list;
		} else {
			echo __('None', 'aslb');
		}
		break;
		*/
	}
}

add_action( 'manage_posts_custom_column',  'lookbook_post_type_columns_display', 10, 2 );



/**
 * Add lookbook count to "Right Now" Dashboard Widget
 */


function add_lookbook_counts() {
        if ( ! post_type_exists( 'lookbook' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'lookbook' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'lookbook Item', 'lookbook Items', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=lookbook'>$num</a>";
            $text = "<a href='edit.php?post_type=lookbook'>$text</a>";
        }
        echo '<td class="first b b-lookbook">' . $num . '</td>';
        echo '<td class="t lookbook">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'lookbook Item Pending', 'lookbook Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=lookbook'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=lookbook'>$text</a>";
            }
            echo '<td class="first b b-lookbook">' . $num . '</td>';
            echo '<td class="t lookbook">' . $text . '</td>';

            echo '</tr>';
        }
}

add_action( 'right_now_content_table_end', 'add_lookbook_counts' );



/**
 * Add contextual help menu
 */
 

function lookbook_post_type_add_help_text( $contextual_help, $screen_id, $screen ) { 
	if ( 'lookbook' == $screen->id ) {
		$contextual_help =
		'<p>' . __('The title field and the big Post Editing Area are fixed in place, but you can reposition all the other boxes using drag and drop, and can minimize or expand them by clicking the title bar of each box. Use the Screen Options tab to unhide more boxes (Excerpt, Send Trackbacks, Custom Fields, Discussion, Slug, Author) or to choose a 1- or 2-column layout for this screen.', 'aslb') . '</p>' .
		'<p>' . __('<strong>Title</strong> - Enter a title for your post. After you enter a title, you&#8217;ll see the permalink below, which you can edit.', 'aslb') . '</p>' .
		'<p>' . __('<strong>Post editor</strong> - Enter the text for your post. There are two modes of editing: Visual and HTML. Choose the mode by clicking on the appropriate tab. Visual mode gives you a WYSIWYG editor. Click the last icon in the row to get a second row of controls. The HTML mode allows you to enter raw HTML along with your post text. You can insert media files by clicking the icons above the post editor and following the directions. You can go the distraction-free writing screen, new in 3.2, via the Fullscreen icon in Visual mode (second to last in the top row) or the Fullscreen button in HTML mode (last in the row). Once there, you can make buttons visible by hovering over the top area. Exit Fullscreen back to the regular post editor.', 'aslb') . '</p>' .
		'<p>' . __('<strong>Publish</strong> - You can set the terms of publishing your post in the Publish box. For Status, Visibility, and Publish (immediately), click on the Edit link to reveal more options. Visibility includes options for password-protecting a post or making it stay at the top of your blog indefinitely (sticky). Publish (immediately) allows you to set a future or past date and time, so you can schedule a post to be published in the future or backdate a post.', 'aslb') . '</p>' .
		( ( current_theme_supports( 'post-formats' ) && post_type_supports( 'post', 'post-formats' ) ) ? '<p>' . __( '<strong>Post Format</strong> - This designates how your theme will display a specific post. For example, you could have a <em>standard</em> blog post with a title and paragraphs, or a short <em>aside</em> that omits the title and contains a short text blurb. Please refer to the Codex for <a href="http://codex.wordpress.org/Post_Formats#Supported_Formats">descriptions of each post format</a>. Your theme could enable all or some of 10 possible formats.' ) . '</p>' : '' ) .
		'<p>' . __('<strong>Featured Image</strong> - This allows you to associate an image with your post without inserting it. This is usually useful only if your theme makes use of the featured image as a post thumbnail on the home page, a custom header, etc.', 'aslb') . '</p>' .
		'<p>' . __('<strong>Send Trackbacks</strong> - Trackbacks are a way to notify legacy blog systems that you&#8217;ve linked to them. Enter the URL(s) you want to send trackbacks. If you link to other WordPress sites they&#8217;ll be notified automatically using pingbacks, and this field is unnecessary.', 'aslb') . '</p>' .
		'<p>' . __('<strong>Discussion</strong> - You can turn comments and pings on or off, and if there are comments on the post, you can see them here and moderate them.', 'aslb') . '</p>' .
		'<p><strong>' . __('For more information:', 'aslb') . '</strong></p>' .
		'<p>' . __('<a href="http://codex.wordpress.org/Posts_Add_New_Screen" target="_blank">Documentation on Writing and Editing Posts</a>', 'aslb') . '</p>' .
		'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'aslb') . '</p>';
  } elseif ( 'edit-lookbook' == $screen->id ) {
    $contextual_help = 
	    '<p>' . __('You can customize the display of this screen in a number of ways:', 'aslb') . '</p>' .
		'<ul>' .
		'<li>' . __('You can hide/display columns based on your needs and decide how many posts to list per screen using the Screen Options tab.', 'aslb') . '</li>' .
		'<li>' . __('You can filter the list of posts by post status using the text links in the upper left to show All, Published, Draft, or Trashed posts. The default view is to show all posts.', 'aslb') . '</li>' .
		'<li>' . __('You can view posts in a simple title list or with an excerpt. Choose the view you prefer by clicking on the icons at the top of the list on the right.', 'aslb') . '</li>' .
		'<li>' . __('You can refine the list to show only posts in a specific category or from a specific month by using the dropdown menus above the posts list. Click the Filter button after making your selection. You also can refine the list by clicking on the post author, category or tag in the posts list.', 'aslb') . '</li>' .
		'</ul>' .
		'<p>' . __('Hovering over a row in the posts list will display action links that allow you to manage your post. You can perform the following actions:', 'aslb') . '</p>' .
		'<ul>' .
		'<li>' . __('Edit takes you to the editing screen for that post. You can also reach that screen by clicking on the post title.', 'aslb') . '</li>' .
		'<li>' . __('Quick Edit provides inline access to the metadata of your post, allowing you to update post details without leaving this screen.', 'aslb') . '</li>' .
		'<li>' . __('Trash removes your post from this list and places it in the trash, from which you can permanently delete it.', 'aslb') . '</li>' .
		'<li>' . __('Preview will show you what your draft post will look like if you publish it. View will take you to your live site to view the post. Which link is available depends on your post&#8217;s status.', 'aslb') . '</li>' .
		'</ul>' .
		'<p>' . __('You can also edit multiple posts at once. Select the posts you want to edit using the checkboxes, select Edit from the Bulk Actions menu and click Apply. You will be able to change the metadata (categories, author, etc.) for all selected posts at once. To remove a post from the grouping, just click the x next to its name in the Bulk Edit area that appears.', 'aslb') . '</p>' .
		'<p><strong>' . __('For more information:', 'aslb') . '</strong></p>' .
		'<p>' . __('<a href="http://codex.wordpress.org/Posts_Screen" target="_blank">Documentation on Managing Posts</a>', 'aslb') . '</p>' .
		'<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'aslb') . '</p>';

  }
  return $contextual_help;
}

add_action( 'contextual_help', 'lookbook_post_type_add_help_text', 10, 3 );



/**
 * Displays the custom post type icon in the dashboard
 *
 */
function lookbook_icons() { 
   
	global $wp_version;
	if( version_compare( $wp_version, '3.8', '>=') ) {
	?>
		<style type="text/css" media="screen">
		#adminmenu .menu-icon-lookbook div.wp-menu-image:before {
			content: "\f115";
		}
		</style>
	
	<?php }else{ ?>
	
	<style type="text/css" media="screen">
	#menu-posts-lookbook .wp-menu-image {
		background: url(<?php echo plugins_url( '/images/portfolio-icon.png', __FILE__ ) ?>) no-repeat 6px 6px !important;
	}
	#menu-posts-lookbook:hover .wp-menu-image, #menu-posts-lookbook.wp-has-current-submenu .wp-menu-image {
		background-position:6px -16px !important;
	}
	#icon-edit.icon32-posts-lookbook {background: url(<?php echo plugins_url( '/images/portfolio-32x32.png', __FILE__ ) ?>) no-repeat;}
	 */
	#adminmenu .menu-icon-lookbook div.wp-menu-image:before {
		content: "\f322";
	}
   </style>
   
   <?php }; ?>
   
<?php }

//add_action( 'admin_head', 'lookbook_icons' );
?>