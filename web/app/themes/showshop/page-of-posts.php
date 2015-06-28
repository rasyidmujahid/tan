<?php
/**
 * Template Name: Page of posts
 *
 * Page to display posts archive
 *
 * @since showshop1.0
 **/
get_header(); 
// 
global $as_of, $as_woo_is_active;
//
$layout 			= $as_of['layout'];
$enter_anim 		= $as_of['post_enter_anim_archive'];
$page_under_head	=  get_post_meta( get_the_ID() ,'as_page_under_head', true);
$under_head			= ( $page_under_head == false && AS_UNDERHEAD_IMAGE ) ? ' under-head' : '';
//		
// CUSTOM META:
$hide_title 		=  get_post_meta( get_the_ID() ,'as_hide_title', true);
// VARS FOR FULL WIDTH AND/OR SHOP:
if( $as_woo_is_active ) {
	$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) ? true : false ;
}else{
	$is_shop = false;
}
?>

<?php if( !$hide_title  ) { ?>				
<header class="page-header">

	<?php	
	$shop_title_bcktoggle = $as_of['shop_title_bcktoggle'];
	$shop_title_backimg = $as_of['shop_title_backimg'];
	
	if( $shop_title_bcktoggle && $shop_title_backimg && $is_shop ) {
		
		$image =  $shop_title_backimg;
		
		echo'<div class="header-background'. esc_attr( $under_head ) .'" style="background-image: url('. esc_url($image) .');"></div>';
		
	}elseif( has_post_thumbnail() ) {
		// get image by attachment id:
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'as-landscape' );
		$image = $image[0];
		
		echo'<div class="header-background'. esc_attr( $under_head ) .'" style="background-image: url('. esc_url($image) .');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="row">
	
		<div class="small-12 table titles-holder">
		
			<h1 class="page-title" data-shadow-text="<?php the_title(); ?>"><?php the_title(); ?></h1>
		
		</div>
		
	</div><!-- /.row -->

</header>

<?php  } // end if !hide_title ?>

<div class="row">
	
	<div id="primary" class="large-<?php echo ( $layout =='full_width' ) ? '12 full_width' : '8'; ?> <?php echo $layout; ?> medium-12 small-12" role="main">

		
		<?php 
		while ( have_posts() && get_the_content() ) : the_post(); 
		
			get_template_part( 'content', 'page' ); 
			
		endwhile; 
		?>

		<?php

		//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if ( get_query_var('paged') ) { 
			$paged = get_query_var('paged'); 
		}elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page'); 
		}else { 
			$paged = 1;
		}

		$args = array(
				//'post_type' => 'post',
				'paged'		=> $paged,
				'orderby'	=> 'date',
				'order'		=> 'DESC',
				'status'	=> 'publish',
				'ignore_sticky_posts' => 0
				);
		query_posts( $args );
		?>
		
		
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( 'content', get_post_format() ); ?>
				
			<?php endwhile; 
			
				as_show_pagination() ? as_pagination( 'nav-below' ) : null;
			
			else : 
			?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
					
				<h2 class="post-title"><?php _e( 'No posts to display', 'showshop' ); ?></h2>

				<div class="post-content">
				
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'showshop' ), admin_url( 'post-new.php' ) ); ?></p>
					
				</div><!-- .entry-content -->

			<?php else : ?>
				
				<h2 class="post-title"><?php _e( 'No posts found on this site', 'showshop' ); ?></h2>

				<div class="post-content">
				
					<p><?php _e( 'We are sorry, but no results were found. Try search to find a related post.', 'showshop' ); ?></p>
					
					<?php get_search_form(); ?>
				
				</div><!-- .entry-content -->
				
			<?php endif; // end current_user_can() ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() ?>

	</div><!-- #primary -->

	<?php
	if( $layout != 'full_width' ) {
		
		$is_shop ? do_action('woocommerce_sidebar') : get_sidebar();
	}
	?>
	
</div><!-- .row -->

<?php
/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */
?>
<?php if ( $enter_anim != 'none') { ?>
<script>
jQuery(document).ready( function($) {
	
	var thisBlock	= $('#primary'),
		article		= thisBlock.find('article');
	
	if ( !window.isMobile && !window.isIE9 ) {

		article.each( function() {
		
			var thisShit = $(this);
			
			thisShit.waypoint(
			
				function(direction) {
					
					if( direction === "up" ) {	
						
						thisShit.removeClass('animated <?php echo esc_js($enter_anim);?>').addClass('to-anim');
						
					}else if( direction === "down" ) {
						
						setTimeout(function(){
						   thisShit.addClass('animated <?php echo esc_js($enter_anim);?>').removeClass('to-anim');
						}, 100);
					}
				}, 
				{ offset: "98%" }	
				
			);
			
		});

	}else{

		article.each( function() {
			
			$(this).removeClass('to-anim');
		
		});
		
	}

});
</script>
<?php } // end if ?>


<?php get_footer(); ?>