<?php

/**
 * Calls the class on the post edit screen.
 */
function call_someClass() {
    new someClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_someClass' );
    add_action( 'load-post-new.php', 'call_someClass' );
	
	add_action( 'admin_enqueue_scripts', 'aslb_admin_scripts' );
}

function aslb_admin_scripts($hook) {
    	
	global $typenow;
	
	if( ($hook == 'post-new.php' || $hook == 'post.php') && $typenow == 'lookbook' ) {
		
		wp_enqueue_script('jquery-ui-droppable');
		
		wp_enqueue_script( 'aslb-admin-js', plugin_dir_url( __FILE__ ) . '/assets/js/aslb-admin-js.js' );
		wp_register_style( 'aslb-admin-css', plugin_dir_url( __FILE__ ) . '/assets/css/aslb-admin.css', false, '1.0.0' );
		wp_enqueue_style( 'aslb-admin-css' );
		
	}
	
}



/** 
 * The Class.
 */
class someClass {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'init', array( $this, 'enqueue_scripts') );
	}
	
	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
            $post_types = array('lookbook');     //limit meta box to certain post types
            if ( in_array( $post_type, $post_types )) {
		add_meta_box(
			'some_meta_box_name'
			,__( 'Lookbook settings', 'aslb' )
			,array( $this, 'render_meta_box_content' )
			,$post_type
			,'advanced'
			,'high'
		);
            }
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['myplugin_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
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

		// Sanitize the user input.
		$aslb_img_size			= sanitize_text_field( $_POST['reg_img_size'] );
		$aslb_products_meta		= sanitize_text_field( $_POST['product_ids'] );
		$aslb_item_title_meta	= sanitize_text_field( $_POST['item_title'] );

		// Update the meta field.
		update_post_meta( $post_id, 'aslb-img_size', $aslb_img_size );
		update_post_meta( $post_id, 'aslb-products', $aslb_products_meta );
		update_post_meta( $post_id, 'aslb-item_title', $aslb_item_title_meta );
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
		
		global $wp_query;
		/* 
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		 */
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$meta_img_size		= get_post_meta( $post->ID, 'aslb-img_size', true );
		$meta_prod_ids		= get_post_meta( $post->ID, 'aslb-products', true );
		$meta_item_title	= get_post_meta( $post->ID, 'aslb-item_title', true );

		
		// Display the form fields
		
		echo '<h4>' . __('Lookbook item featured image size.','aslb') . '</h4>';
		
		$img_sizes = $this -> _get_all_image_sizes();
		
		echo '<select name="reg_img_size" id="reg_img_size">';
			
			$i = 0;
			foreach( $img_sizes as $i => $img[0] ) {
				
				$name = ucfirst( str_replace('_',' ', $img[0]) );
				
				echo '<option id="' . $img[0]. '" value="'.$img[0].'" ' . selected($meta_img_size, $img[0], false) . ' />'.
					$name.'</option>';
				$i++;
			}

		echo '</select>';
		
		echo '<p class="description">' . __('Image size will apply to single lookbook item.','aslb') . '</p>';
		
		echo '<hr>';
		
		echo '<input type="hidden" id="product_ids" name="product_ids"';
                echo ' value="' . esc_attr( $meta_prod_ids ) . '" size="25" />';
		
		echo '<div class="sortable-columns active">';
		
		echo '<h4>' . __('Selected products:','aslb') . '</h4>';
		echo '<p class="description">' . __('Products connected to this lookbook item. If left empty no product will be assigned to lookbook item.','aslb') . '</p>';
			
		echo '<ul class="lookbook-list" id="sortable1">';
		
		$args = array(
				'post_type'				=> 'product',
				'orderby'				=> 'post__in',
				'order'					=> 'DESC',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page'		=> -1,
				'post__in'				=> explode(",", $meta_prod_ids)
			);	
		
		
		$temp = $wp_query ;$wp_query  = null;
		$wp_query  = new WP_Query( $args );
		
			if( $wp_query ->have_posts() ) : 
			
			while( $wp_query ->have_posts() ) : $wp_query ->the_post();
			
					$thumb_attr = array(
						'class'	=> "attachment-thumbnail",
						'alt'	=> trim(strip_tags( $post->post_excerpt )),
						'title'	=> trim(strip_tags( $post->post_title )),
					);
					
					echo '<li class="" id="'.get_the_ID().'">';
					
					if( has_post_thumbnail( get_the_ID() ) ){
						echo get_the_post_thumbnail( get_the_ID() , 'thumbnail', $thumb_attr );
					}else{
						echo '<img src="'.plugin_dir_url( __FILE__ ) . '/assets/images/no-image.jpg" />';
					}
					
					echo '<span>' . get_the_title() . '</span>';
					
					echo '</li>';
				
			
			endwhile; 
			
			$wp_query  = null; $wp_query  = $temp;
			
			endif;
			
			echo '</ul>';
			
			echo '</div>';

			
		
		/*
		 *	GET PRODUCTS FOR PICKUP: 
		 *
		 */
		$args = array(
				'post_type'				=> 'product',
				'orderby'				=> 'date',
				'order'					=> 'DESC',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page'		=> -1,
				'post__not_in'			=> explode(",", $meta_prod_ids)
			);	
		
		
		$temp = $wp_query ;$wp_query  = null;
		$wp_query  = new WP_Query( $args );
		
		if( $wp_query ->have_posts() ) : 

			echo '<div class="sortable-columns prod-list">';
			
			echo '<h4>' . __('List of all available products:','aslb') . '</h4>';
			
			echo '<p class="description">' . __('Drag these products in box on the left side to connect them to lookbook item','aslb') . '</p>';
			
			echo '<ul class="prod-list" id="sortable2" style="clear: both; overflow: hidden;">';
			
			while( $wp_query ->have_posts() ) : $wp_query ->the_post();
			
					$thumb_attr = array(
						'class'	=> "attachment-thumbnail",
						'alt'	=> trim(strip_tags( $post->post_excerpt )),
						'title'	=> trim(strip_tags( $post->post_title )),
					);
					
					echo '<li class="" id="'.get_the_ID().'">';
					
					if( has_post_thumbnail( get_the_ID() ) ){
						echo get_the_post_thumbnail( get_the_ID() , 'thumbnail', $thumb_attr );
					}else{
						echo '<img src="'.plugin_dir_url( __FILE__ ) . '/assets/images/no-image.jpg" />';
					}
					
					echo '<span>' . get_the_title() . '</span>';
					
					echo '</li>';
				
			
			endwhile; 
			
			$wp_query  = null; $wp_query  = $temp;
			

			echo '</ul>';
			
			echo '</div>';
			
			echo '<hr>';
			
			echo '<h4>'.__('Lookbook page template settings:','olea').'</h4>';
			
			echo '<label for="product_ids">' . __( 'Hide lookbook item title', 'aslb' ) ;
			echo '<input type="checkbox" id="item_title" name="item_title" value="1" '. checked( 1, $meta_item_title, false ) .' size="25" style="float: right;"/>';
			echo '</label> ';
			echo '<p class="description">'.__('title will be hidden in Lookbook page (lookbook item listings)','aslb') .'</p>';
			
			echo '<hr>';
			
		endif;

		echo '<div class="clearfix"></div>';


	} // end func render_met_box_content
	
private function _get_all_image_sizes() {
	global $_wp_additional_image_sizes;

	$default_image_sizes = array( 'thumbnail', 'medium', 'large' );
	 
	foreach ( $default_image_sizes as $size ) {
		$image_sizes[$size]['width']	= intval( get_option( "{$size}_size_w") );
		$image_sizes[$size]['height'] = intval( get_option( "{$size}_size_h") );
		$image_sizes[$size]['crop']	= get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		$def_img_sizes_names[] = $size;
	}
	
	if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) )
		//$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		
		foreach( $_wp_additional_image_sizes as $name => $added ){
			$added_img_sizes_names[] = $name;
		}
		
		$image_sizes = array_merge( $def_img_sizes_names, $added_img_sizes_names );
		
	return $image_sizes;
}
	
}
?>