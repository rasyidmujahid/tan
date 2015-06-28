<?php
/**
 *	The template part used for displaying page content - GALLERY template
 *
 *	@since showshop 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $as_of;
$archive_enteranim	= $as_of['post_enter_anim_archive'];
$tax_enteranim		= $as_of['post_enter_anim_tax'];
$enter_anim			= $archive_enteranim ? $archive_enteranim : $tax_enteranim;
//
//
// CUSTOM META:
$id = get_the_ID();
$hide_feat_img	= get_post_meta( $id, 'as_hide_featured_image', true);
//
// AS GALLERY POST META:
//
$gall_img_array		= get_post_meta( $id,'as_gallery_images' );
$gall_image_format	= get_post_meta( $id,'as_gall_image_format', true ) ; 
$slider_thumbs		= get_post_meta( $id,'as_slider_thumbs', true ); 
$thumb_columns		= get_post_meta( $id,'as_thumb_columns', true ) ; 
//
$classes = array();
$classes[] = ($enter_anim != 'none') ? ' to-anim' : '';$thumb_columns;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		
	<a href="<?php esc_attr(the_permalink());?>" title="<?php the_title_attribute();?>" class="post-link">
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
	</a>	
	
	<?php as_entry_author(); ?>
	
	<?php as_entry_date(); ?>
	
	
	<?php 
	// WP GALLERY shortcode img id's
	$wpgall_ids = apply_filters('as_wpgallery_ids','as_wp_gallery');
	//
	
	// image ID's from gallery post meta:
	$images_ids = '';
	if( !empty( $gall_img_array ) ) {
		foreach ( $gall_img_array as $gall_img_id ){
			$images_ids .= $gall_img_id .','; 
		}
	}
	if( !empty( $wpgall_ids ) ) {
		$images_ids = implode(', ', $wpgall_ids); // get images from WP gallery
	}else{
		$images_ids = implode(', ', $gall_img_array); // get images from AS gallery
	}
	
	// function to display images with link to larger:
	echo as_gallery_output( get_the_ID(), $images_ids, $slider_thumbs, $thumb_columns, $gall_image_format );
	?>
	
	
	<div class="post-content<?php echo $hide_feat_img ? ' no-feat-img' : ''; ?>">
	
		<?php
				
		do_action('as_archive_content'); // smart excerpt - "inc/functions/misc_post_functions.php"
		
		$wlp_args = array( 
				'before'		=> '<div class="page-link"><p>' . __( 'Pages:', 'showshop' ) . '</p>',
				'after'			=> '</div>',
				'link_before'	=> '<span>',
				'link_after'	=> '</span>',
			);
		
		wp_link_pages( $wlp_args );
		?>
	
	
	</div>
				
	<div class="clearfix"></div>
	
	<div class="post-meta-bottom">
	
		<?php
		as_entryMeta_comments();
		
		if(  has_category() || has_tag() || has_term( '', 'portfolio_category' ) || has_term( '', 'portfolio_tag' )  ) {
		
			as_entryMeta_cats_tags();
		}
		?>
		
	</div>
	

</article><!-- #post-<?php the_ID(); ?> -->