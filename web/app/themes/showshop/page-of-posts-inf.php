<?php
/**
 * Template Name: Page of posts - INFINITE load
 *
 * Page to display posts archive with ajax infinte post load
 *
 * @since showshop1.0
 **/
get_header(); 
// 
global $as_of, $as_woo_is_active;
//
$layout 	= $as_of['layout'];
$enter_anim = $as_of['post_enter_anim_archive'];
$page_under_head		=  get_post_meta( get_the_ID() ,'as_page_under_head', true);
$under_head = ( $page_under_head == false && AS_UNDERHEAD_IMAGE ) ? ' under-head' : '';
// CUSTOM META:
$hide_title =  get_post_meta( get_the_ID() ,'as_hide_title', true);
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

<?php  
} // end if !hide_title
?>

<div class="row">
	
	<div id="primary" class="large-<?php echo ( $layout =='full_width' ) ? '12 full_width' : '8'; ?> <?php echo $layout ? esc_attr( $layout ) : null; ?> medium-12 small-12" role="main">

		
		<?php while ( have_posts() && get_the_content() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile;  ?>

		<?php
		/**
		 *	LOAD POSTS
		 */

		$args = array(
				'orderby'	=> 'date',
				'order'		=> 'DESC',
				'status'	=> 'publish',
				'ignore_sticky_posts' => 0
				);
		query_posts( $args );
		?>
		
		
		<?php if ( have_posts() ) : ?>

			<section class="infinite-posts">
			
				<?php while ( have_posts() ) : the_post(); ?>
								
				<article class="infinite-post">
					
					<h2 class="post-title"><a href="<?php esc_attr(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
					
					<?php 
					as_entry_author(); 
					as_entry_date();
					?>
					
					<div class="post-content"><?php the_post_thumbnail('thumbnail'); ?><?php the_excerpt();?></div>					
				
					<div class="clearfix"></div>
				
				</article>
				
				<?php endwhile; ?>
			
			</section>
			
			<script type="text/javascript">
			post_offset = increment = <?php echo get_option( 'posts_per_page' );?> ;
			</script>

		<?php endif; // end have_posts() ?>

	</div><!-- #primary -->

	<?php
	// IF CUSTOM SIDEBAR IS SELECTED (CUSTOM META)
	$options = get_post_custom(get_the_ID());
	if(isset($options['custom_sidebar'])) {
		$sidebar_choice = $options['custom_sidebar'][0];
	}else{
		$sidebar_choice = "default";
	}
	
	if( $layout != 'full_width' ) {
		
		if($sidebar_choice && $sidebar_choice != "default") {
			
			get_sidebar("custom");
			
		}else{
		
			$is_shop ? do_action('woocommerce_sidebar') : get_sidebar();
		}
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