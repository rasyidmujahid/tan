<?php
/**
 *	The template part used for displaying page content - QUOTE template.
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
// POST CUSTOM  META:
$id = get_the_ID();
$quote_author	= get_post_meta( $id,'as_quote_author', true);
$quote_url		= get_post_meta( $id,'as_quote_author_url', true);
$avatar			= get_post_meta( $id,'as_avatar_email', true);
//
$hide_feat_img	= get_post_meta( $id, 'as_hide_featured_image', true);
//
$classes = array();
$classes[] = ($enter_anim != 'none') ? ' to-anim' : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> >
		
	
	<a href="<?php esc_attr(the_permalink());?>" title="<?php the_title_attribute();?>" class="post-link">
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
	</a>
	
	<?php as_entry_author(); ?>
	
	<?php as_entry_date(); ?>
	
	
	<div class="post-content<?php echo $hide_feat_img ? ' no-feat-img' : ''; ?>">
		
		<?php if( $avatar || has_post_thumbnail() ) {?>
		<div class="avatar-img">
		
			<?php 
			$no_image = '';
			
			echo $quote_url ? '<a href="'. esc_url($quote_url).'" title="'. esc_attr($quote_author) .'">' : '';
			if( $avatar ) {
				echo get_avatar( $avatar , 120 );
			}elseif( has_post_thumbnail() ){
				the_post_thumbnail('thumbnail');
			}
			
			echo $quote_url ? '</a>' : '';
			?>
			
		</div>
		<?php 
		}else{
			$no_image = ' no-image';
		};
		?>
	
		<div class="quote<?php echo esc_attr($no_image); ?>">	
		
			<?php if( $avatar || has_post_thumbnail() ) {?>
			<div class="arrow-left"></div>
			<?php };?>
			
			<?php 
			echo '<p>' . apply_filters('as_custom_excerpt','full') . '</p>';
			echo $quote_url ? '<a href="'.esc_url($quote_url).'" title="'. esc_attr($quote_author) .'">' : '';
			echo $quote_author ? '<h5>'. esc_html($quote_author).'</h5>' : '';
			echo $quote_url ? '</a>' : '';
			?>
			
		</div>
	
	</div>
	
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