<?php
/**
 *	The template part for search results.
 *
 *	@since showshop 1.0 
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
global $as_of;
$archive_enteranim	= $as_of['post_enter_anim_archive'];
$tax_enteranim		= $as_of['post_enter_anim_tax'];
$enter_anim			= $archive_enteranim ? $archive_enteranim : $tax_enteranim;
//
//
$classes = array();
$classes[] = ($enter_anim != 'none') ? ' to-anim' : '';
?>


<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

	<a href="<?php the_permalink(); ?>" class="post-link" title="<?php echo the_title_attribute (array('echo' => 0)); ?>" >
		
		<div class="search-text">
		
			<h2 class="post-title"><?php the_title(); ?></h2>	
			
		</div>
	</a>
	
	<div class="post-content">
	
		<?php do_action('as_archive_content'); // smart excerpt - "inc/functions/misc_post_functions.php ?>
		
	</div>
	
	<div class="clearfix"></div>
	
	
</article><!-- #post-<?php the_ID(); ?> -->

<div class="clearfix"></div>