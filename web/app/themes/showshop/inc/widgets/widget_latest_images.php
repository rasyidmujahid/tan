<?php
/**
 *	 Widget Latest Post Images
 *	- login to WooCommerce shop
 *
 */
/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'load_latest_widget' );

/**
 * Register our widget.
 * 'Widget_Latest_Post_Images' is the widget class used below.
 */
function load_latest_widget() {
	register_widget( 'Widget_Latest_Post_Images' );
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 */
class Widget_Latest_Post_Images extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Widget_Latest_Post_Images() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'latest-image-widget', 'description' => __('A widget displaying latest content images.', 'showshop') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest-content-images' );

		/* Create the widget. */
		$this->WP_Widget( 'latest-content-images', __('Latest content images', 'showshop'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title 				= apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
		$num				= isset($instance['num']) ? $instance['num']  : '';
		$width				= isset($instance['width']) ? $instance['width']  : '';
		$image_size 		= isset($instance['image_size']) ? $instance['image_size']  : '';
		$custom_post_list	= isset($instance['types']) ? $instance['types'] : ''; // Post type(s) 		
	    $types				= explode(',', $custom_post_list);
		

		/* Before widget (defined by themes). */
		echo wp_kses_post($before_widget);

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
		
			echo wp_kses_post($before_title . $title . $after_title);

		/* Display num from widget settings if one was input. */
		if ( $num )
		
		
		echo '<div class="latest-content-images-widget">';
		
		$content = get_posts( array(
				'numberposts' => $num, 
				'no_found_rows' => 1,
				'post_status' => 'publish',
				'post_type' => $types,
				'post_parent' => 0,
				'orderby'     => 'post_date',
				'order'       => 'DESC'
				)
			);	

		
		if ( count( $content ) > 0 ) {
			
			foreach( $content as $content_item ){
				setup_postdata ( $content_item );
				global $post;
				$old_post = $post;
				$post = $content_item;
				//$post->the_post();

				$link = get_permalink();
				
				
				echo '<div class="widget-post-thumbs item scroll" style="position:relative; float:left;'.($width ? 'width:'. esc_attr($width).'; height:auto' : '').'">';
				?>
				<div class="anim-wrap">
				
					<div class="item-img">
				
						<div class="front">
				
							<?php echo as_image( $image_size ); ?>
	
						</div>
						<div class="back">
				
							<div class="item-overlay"></div>
							
							<div class="back-buttons">
								<a href="<?php echo esc_attr($link); ?>" class="tip-top accent-1-light-30" title="<?php  echo esc_attr(strip_tags(get_the_title()))  ?>"  data-tooltip><span class="icon icon-link" aria-hidden="true"></span></a>
							</div>
							
							<?php echo as_image( $image_size ); ?>
	
						</div>
				
					</div>
					
					<div class="clearfix"></div>
				
				</div>
				
				<?php
				echo '</div>';

				
			}// endforeach
			
			wp_reset_postdata();
			
		}// endif

		echo '</div>';	
					
		/* If show sex was selected, display the user's sex. */
		//if ( $posttype )
		//	

		
		/* After widget (defined by themes). */
		echo wp_kses_post($after_widget);
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$types = implode(',', (array)$new_instance['types']);

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = strip_tags( $new_instance['num'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['image_size'] = strip_tags( $new_instance['image_size'] );
		$instance['types'] = $types;

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		// instance exist? if not set defaults
		if ( $instance ) {
			$title  = $instance['title'];
			$types  = $instance['types'];
			$num = $instance['num'];
			$width = $instance['width'];
			$image_size = $instance['image_size'];
		} else {
			//These are our defaults
			$title  = '';
			$types  = 'post';
			$num = '5';
			$width = '50%';
			$image_size = 'thumbnail';
		}
		
		/* Set up some default widget settings. 
		$defaults = array( 
			'title' => __('latest content', 'showshop'),
			'num' => 6,
			'width'=>'45%',
			'image_size' => 'thumbnail' ,
			'types'  => 'post'
			);
			
		$instance = wp_parse_args( (array) $instance, $defaults );
		*/
		$types = explode(',', $types);
		
		//Count number of post types for select box sizing
		$custom_post_list_types = get_post_types( array( 'public' => true ), 'names' );
		foreach ($custom_post_list_types as $custom_post_list ) {
		   $custom_post_list_ar[] = $custom_post_list;
		}
		$n = count($custom_post_list_ar);
		if($n > 10) { $n = 10;}
		?>
		
		
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'showshop'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo sanitize_text_field($title); ?>" style="width:100%;" />
		</p>
		
		<!-- Number of images: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'num' )); ?>"><?php esc_html_e('Number of images:', 'showshop'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'num' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'num' )); ?>" value="<?php echo sanitize_text_field($num); ?>" style="width:100%;" />
		</p>
		
		<!-- Post types : multislect -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('types')); ?>"><?php esc_html_e( 'Post type(s):','showshop' ); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('types')); ?>[]" id="<?php echo esc_attr($this->get_field_id('types')); ?>" class="widefat" style="height: auto;" size="<?php echo esc_attr($n) ?>" multiple>
			<?php 
			$args = array( 'public' => true );
			$post_types = get_post_types( $args, 'names' );
			foreach ($post_types as $post_type ) { 
				if( !( $post_type == 'revision' || $post_type == 'nav_menu_item' || $post_type == 'attachment' || $post_type == 'options' || $post_type == 'slogan')) {
			?>
				<option value="<?php echo esc_attr($post_type); ?>" <?php if( in_array($post_type, $types)) { echo 'selected="selected"'; } ?>><?php echo esc_attr($post_type);?></option>
			<?php 
				} //endif
			}// end foreach
			?>
			</select>
		</p>

		<!-- Image sizes : select -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image_size')); ?>"><?php esc_html_e( 'Image sizes:','showshop' ); ?></label>
			<?php 
			$sizes = array();
			$image_sizes = array();
			$added_sizes = get_intermediate_image_sizes();
			
			foreach( $added_sizes as $key => $value) {
				$image_sizes[$value] = $value;
			}
			?>
			
			<select id="<?php echo esc_attr($this->get_field_id('image_size')); ?>" name="<?php echo esc_attr($this->get_field_name('image_size')); ?>">
			
			<?php 
			foreach($image_sizes as $key=>$value) {
				echo '<option value="'.esc_attr($key).'" '.selected( $instance['image_size'], $key, false ).'>'.htmlspecialchars($value).'</option>';
			}
			?>
			</select>
			

		</p>
	
		<!-- Images width: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'width' )); ?>"><?php esc_html_e('Image width in <b>px</b> or <b>%</b> (height is set auto):', 'showshop'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'width' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'width' )); ?>" value="<?php echo sanitize_text_field($width); ?>" style="width:100%;" />
		</p>
		
	<?php
	}
}
?>