<?php
/**
 *	The main template file for blog posts.
 *
 *	@since showshop 1.0 
 */

get_header();
//
global $as_of;
$layout			= $as_of['layout'];
$index_title	= $as_of['index_title'];
$enter_anim		= $as_of['post_enter_anim_archive'];
?>

<header class="archive-header">

	<?php	
	$index_title_bcktoggle = $as_of['index_title_bcktoggle'];
	$index_title_backimg = $as_of['index_title_backimg'];
	if( $index_title_bcktoggle ) {
		
		$image =  $index_title_backimg;
		
		echo'<div class="header-background'. ( AS_UNDERHEAD_IMAGE ? ' under-head' : '') .'" style="background-image: url('. esc_url($image) .');"></div>';
	}
	?>
	<div class="row">
		
		<?php if( $index_title ) { ?>
		<div class="small-12 table titles-holder">
		
			<h1 class="archive-title tablerow"><?php bloginfo( 'name' );?></h1>

		</div>
		<?php }else{ ?>
			
			<div style="height:80px; display: block; background: none;"></div>
		
		<?php } ?>
		
	</div><!-- /.row -->	
	

</header><!-- .archive-header -->


<div class="row">
	
	<div class="site-desc-index small-12"><?php bloginfo( 'description' );?></div>
	
	<div id="primary" class="large-<?php echo ( $layout =='full_width' ) ? '12' : '8'; ?> <?php echo $layout ? esc_attr( $layout ) : null; ?> medium-12 small-12" role="main">

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
					
				<h2 class="post-title"><?php esc_html_e( 'No posts to display', 'showshop' ); ?></h2>

				<div class="post-content">
				
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'showshop' ), admin_url( 'post-new.php' ) ); ?></p>
					
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				
				<h2 class="post-title"><?php esc_html_e( 'No posts found on this site', 'showshop' ); ?></h2>
				

				<div class="post-content">
				
					<p><?php esc_html_e( 'We are sorry, but no results were found. Try search ti find a related post.', 'showshop' ); ?></p>
					
					<?php get_search_form(); ?>
				
				</div><!-- .entry-content -->
				
			<?php endif; // end current_user_can() ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() ?>

	</div><!-- #primary -->

	<?php get_sidebar(); ?>
	
</div><!-- .row -->

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