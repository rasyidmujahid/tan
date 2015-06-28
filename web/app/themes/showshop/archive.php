<?php
/**
 *	The template for displaying Archive pages.
 *
 *	@since showshop 1.0
 */

get_header();
//
global $as_of;
$layout		= $as_of['layout'];
$enter_anim = $as_of['post_enter_anim_archive'];
?>

<header class="archive-header">

	<?php	
	$blog_title_bcktoggle = $as_of['blog_title_bcktoggle'];
	$blog_title_backimg = $as_of['blog_title_backimg'];
	if( $blog_title_bcktoggle ) {
		
		$image = $blog_title_backimg;
		
		echo'<div class="header-background'.( AS_UNDERHEAD_IMAGE ? ' under-head' : '').'" style="background-image: url('. esc_url($image) .');"></div>';
		
	}else{
		$image = '';
	}
	?>
	
	<div class="row">
		
		<div class="small-12 table titles-holder">
		
		<h1 class="archive-title"><?php the_archive_title(); ?></h1>
		
		</div>
	
	</div><!-- /.row -->	
	
</header><!-- .archive-header -->


<div class="row">

	<div id="primary" class="large-<?php echo ( $layout =='full_width' ) ? '12' : '8'; ?> <?php echo $layout ? esc_attr( $layout ) : null; ?> medium-12 small-12" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

		endwhile;

			as_show_pagination() ? as_pagination( 'nav-below' ) : null;

		else :
		
			get_template_part( 'content', 'empty' );
		
		endif; ?>

	</div><!-- /#primary -->

	<?php get_sidebar(); ?>

</div><!-- /.row -->

<?php
if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {
				
	wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style( 'animate' );
	
}
?>
<?php if ( $enter_anim != 'none') { ?>
<script>
jQuery(document).ready( function($) {
	
	var thisBlock	= $('#primary'),
		article		= thisBlock.find('article');
	
	if ( !window.isMobile && !window.isIE9 ) {

		article.each( function() {
		
			var eachArticle = $(this);
			
			eachArticle.waypoint(
			
				function(direction) {
					
					if( direction === "up" ) {	
						
						eachArticle.removeClass('animated <?php echo esc_js($enter_anim);?>').addClass('to-anim');
						
					}else if( direction === "down" ) {
						
						setTimeout(function(){
						   eachArticle.addClass('animated <?php echo esc_js($enter_anim);?>').removeClass('to-anim');
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