<?php
/**
 * The Sidebar containing the main widget area.
 */
global $wp_query, $as_of;
// Theme options:
$layout 		= $as_of['layout'];
$empty_sidebar	= $as_of['empty_sidebar_meta'];
// Custom meta (custom sidebars)
$options = get_post_custom($post->ID);
$sidebar_choice = $options['custom_sidebar'][0];
?>

<?php $grid = ( $layout == 'full_width' ) ? '12' : '4';?>

<div id="secondary" class="widget-area large-<?php echo esc_attr($grid); ?> <?php echo esc_attr($layout);  ?>  medium-12 small-12" role="complementary">
	
	<?php 
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() )  { 

		dynamic_sidebar($sidebar_choice);
		
	}elseif( $empty_sidebar == 'empty_notice' ){
		
			echo '<aside class="widget"><p class="empty-sidebar">'. esc_html__("You haven't set any widget for your Custom Sidebar. Please, add some widgets to fulfil this place.",'showshop') .'</p></aside>';
		
	}
	?>
	
</div><!-- #secondary .widget-area -->

<div class="clearfix"></div>