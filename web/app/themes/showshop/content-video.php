<?php
/**
 *	The template part used for displaying page content - VIDEO template.
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
// FEATURED IMAGE SIZE:
$fimg_size		= isset( $as_of['blog_fetured_img_size'] ) ? $as_of['blog_fetured_img_size'] : array();
$fimg_width		= $fimg_size['Width'] ? $fimg_size['Width'] : '900';
$fimg_height	= $fimg_size['Height'] ? $fimg_size['Height'] : '300';
//
$has_content		= get_the_content();
$id = get_the_ID();
$hide_feat_img		= get_post_meta( $id, 'as_hide_featured_image', true);
//
$classes = array();
$classes[] = ($enter_anim != 'none') ? ' to-anim' : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> <?php echo ( !$has_content ? 'style="margin-bottom:0;"' : '' ); ?>>
	
	<a href="<?php esc_attr(the_permalink());?>" title="<?php the_title_attribute();?>" class="post-link">
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
	</a>
	
	<?php as_entry_author(); ?>
	
	<?php as_entry_date(); ?>
	
	
	<?php
	
	/** 
	 * VIDEO SCREENSHOT or FEAT. POST IMAGE (DISCARDED)
	 * - 
	 *
	$featured_or_thumb	= get_post_meta( get_the_ID(),'as_video_thumb', true);
	if ( $featured_or_thumb == 'host_thumb' ) { // if thumbs from video hosts
		
		$img = as_video_thumbs();
		$image_output = '<div class="entry-image"><img src="'. fImg::resize( esc_url($img) , $fimg_width	, $fimg_height, true  ) .'" alt="'. the_title_attribute (array('echo' => 0)) .'" /></div>';
	
	}else{
	
		$img = as_get_full_img_url();
		$image_output = '<div class="entry-image"><img src="'. fImg::resize( esc_url($img) , $fimg_width	, $fimg_height, true  ) .'" alt="'. the_title_attribute (array('echo' => 0)) .'" /></div>';
		
	}
	echo wp_kses_data($image_output);
	*/
	
	$video_host			= get_post_meta( $id,'as_video_host', true);
	$video_id			= get_post_meta( $id,'as_video_id', true);
	$w					= get_post_meta( $id,'as_video_width', true);
	$h					= get_post_meta( $id,'as_video_height', true) ;
	
	echo '<div class="post-content'.($hide_feat_img ? ' no-feat-img' : '').'">';
		
		if( $video_host ){
		
			do_action('as_embed_video_action', $video_host, $video_id, $w, $h );
		
		}
		
		do_action('as_archive_content'); // smart excerpt - "inc/functions/misc_post_functions.php
		
	echo '</div>';
	
	$wlp_args = array( 
			'before'		=> '<div class="page-link"><p>' . __( 'Pages:', 'showshop' ) . '</p>',
			'after'			=> '</div>',
			'link_before'	=> '<span>',
			'link_after'	=> '</span>',
		);
	
	wp_link_pages( $wlp_args );
	?>

				
	<div class="clearfix"></div>

	<div class="post-meta-bottom">
	
		<?php
		as_entryMeta_comments();
		
		if( has_category() || has_tag() || has_term( '', 'portfolio_category' ) || has_term( '', 'portfolio_tag' ) ) {
		as_entryMeta_cats_tags();
		}
		?>
		
	</div>
		
</article><!-- #post-<?php the_ID(); ?> -->