<?php
/**
 *	The template part used for displaying page content - AUDIO template
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
// FEATURED IMAGE SIZE:
$fimg_size		= isset( $as_of['blog_fetured_img_size'] ) ? $as_of['blog_fetured_img_size'] : array();
$fimg_width		= isset( $fimg_size['Width']) ? $fimg_size['Width'] : null;
$fimg_height	= isset( $fimg_size['Height']) ? $fimg_size['Height'] : null;

$has_content = get_the_content();
// POST CUSTOM META
$hide_feat_img	= get_post_meta( get_the_ID(),'as_hide_featured_image', true);
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
	$audio_file_id	= get_post_meta( get_the_ID(),'as_audio_file', true);
	$audio_file		= wp_get_attachment_url( $audio_file_id );
	
	echo $hide_feat_img ? null : as_image('as-landscape', $fimg_width, $fimg_height );
	?>

	
	<div class="post-content"<?php echo $hide_feat_img ? ' no-feat-img' : ''; ?>>
		
		<?php 
		if( $audio_file ){
		
			$attr = array(
				'src'      => $audio_file,
				'loop'     => false,
				'autoplay' => false,
				'preload'  => 'none'
			);
			
			echo wp_audio_shortcode( $attr );
			
		}
		
		do_action('as_archive_content'); // smart excerpt - "inc/functions/misc_post_functions.php
		
		?>
	</div>
	
	
	<?php 
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
		
		if( has_category() || has_tag() || has_term( '', 'portfolio_category' ) || has_term( '', 'portfolio_tag' )  ) {
		
			as_entryMeta_cats_tags();
		}
		?>
		
	</div>
	
	
</article><!-- #post-<?php the_ID(); ?> -->