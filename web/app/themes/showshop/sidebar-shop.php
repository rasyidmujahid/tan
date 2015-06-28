<?php
/**
 * The Sidebar containing the main widget area.
 */
global $as_of;
$layout			= $as_of['layout'];
$empty_sidebar	= $as_of['empty_sidebar_meta'];
?>

<?php $grid = ( $layout == 'full_width' ) ? '12' : '4';?>

<div id="secondary" class="widget-area large-<?php echo esc_attr($grid); ?> <?php echo esc_attr($layout);  ?> medium-12 small-12" role="complementary">
	
	<?php if (  is_active_sidebar( 'sidebar-shop' ) )  {
	
		dynamic_sidebar( 'sidebar-shop' );
	
	}else{ 
	
		if( $empty_sidebar == 'meta_login' ) { ?>
		
		<aside id="meta" class="widget">
		
			<h4 class="widget-title"><?php esc_html_e( 'Meta', 'showshop' ); ?></h4>
			<ul>
				<?php wp_register(); ?>
				<aside><?php wp_loginout(); ?></aside>
				<?php wp_meta(); ?>
			</ul>
			
		</aside>
		
	<?php
		
		}elseif( $empty_sidebar == 'empty_notice' ){
		
			echo '<aside class="widget"><p class="empty-sidebar">'. esc_html__("You haven't set any widget for Shop Sidebar. Please, add some widgets or choose Full width page in theme options or page custom meta settings.",'showshop') .'</p></aside>';
		
		}
		?>

	<?php }; // end sidebar widget area ?>
	
	
</div><!-- #secondary .widget-area -->

<div class="clearfix"></div>	