<?php
/**
 * Template Name: Blank with footer widgets
 *
 * Template best suitable for landing pages
 * - uses custom header ( no menus and title )
 *
 * @since showshop1.0
 **/

// Custom header for blank template
get_header('blank'); 

global $as_of;
?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> >	
		
	<?php
	
	if( have_posts() ) : while ( have_posts() ) : the_post(); 
	
		the_content();
	
	endwhile;
	
	endif;
	
	wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'showshop' ), 'after' => '</div>' ) ); ?>
	
	<div class="clearfix"></div>

</section>
	
<?php get_footer('blank_widgets'); ?>