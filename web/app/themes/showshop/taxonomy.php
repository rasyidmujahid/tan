<?php
/**
 * The template for displaying Taxonomy pages.
 *
 * @since showshop 1.0
 */

get_header();
// 
global $as_of;
$layout		= $as_of['layout'];
$enter_anim = $as_of['post_enter_anim_tax'];
?>

<header class="archive-header">

	<?php	
	$portfolio_title_bcktoggle	= $as_of['portfolio_title_bcktoggle'];
	$portfolio_title_backimg	= $as_of['portfolio_title_backimg'];
	
	if( $portfolio_title_bcktoggle ) {
		
		$image =  $portfolio_title_backimg;
		
		echo'<div class="header-background'. ( AS_UNDERHEAD_IMAGE ? ' under-head' : '') .'" style="background-image: url('. esc_url($image) .');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="row">		

		<div class="small-12 table titles-holder">
		
		<h1 class="archive-title">
		
			<small>
				<?php 
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				echo ucfirst( str_replace('_',' ',$term->taxonomy) );
				?> :
			</small>

			<?php echo esc_html($term->name); ?>
		
		</h1>

		
		</div>
		
	</div><!-- /.container -->	
	
</header><!-- .archive-header -->
	
	
<div class="row">

	<?php if ( category_description() ) : ?>
		<div class="term-description small-12"><?php echo category_description(); ?></div>
	<?php endif; ?>

	
	<div id="primary" class="large-<?php echo (  $layout =='full_width' ) ? '12' : '8'; ?> <?php echo $layout ? esc_attr( $layout ) : null; ?> medium-12 small-12" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php get_template_part( 'content', get_post_format() );

			endwhile;

			as_show_pagination() ? as_pagination( 'nav-below' ) : null;
			
		else :
		
			get_template_part( 'content', 'empty' );
		
		endif; ?>

	</div><!-- /#primary -->

	<?php get_sidebar(); ?>

	
</div><!-- /.row -->

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