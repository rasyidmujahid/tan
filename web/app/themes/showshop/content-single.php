<?php
/**
 *	The template part used for displaying SINGULAR content (post, page, attachment).
 *
 *	@since showshop 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
global $as_of;
//
/*	THEME OPTIONS -  */
//POST META ( date, author, cats, tags):
$of_pm			= isset( $as_of['post_meta'] ) ? $as_of['post_meta'] : array();
$date_author	= isset( $of_pm['date_author']) ? true : false;
$categories_tags= isset( $of_pm['categories_tags'] ) ? true : false;
$comments		= isset( $of_pm['comments'] ) ? true : false;
// FEATURED IMAGE SIZE:
$fimg_size		= isset( $as_of['blog_fetured_img_size'] ) ? $as_of['blog_fetured_img_size'] : array();
$fimg_width		= isset( $fimg_size['Width']) ? $fimg_size['Width'] : null;
$fimg_height	= isset( $fimg_size['Height']) ? $fimg_size['Height'] : null;
//
//	POST CUSTOM META:
$id = get_the_ID();
$hide_feat_img = get_post_meta( $id ,'as_hide_featured_image', true);
//
//	POST TYPE AND FORMAT vars:
$post_type	= get_post_type( $id );
$format		= get_post_format( $id );

$classes[]	= ($hide_feat_img || $format == 'video') ? 'no-featured': '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> >
			
	<?php	
	if( $post_type == 'portfolio' ) {
		
		get_template_part('content','single-portfolio' );
	
	}elseif( $post_type == 'lookbook' ){
		
		get_template_part('content','single-lookbook' );
	
	}else{ // is regular post type - now, the post FORMATS:
		
		if ( $format == '' ) { // <------ IF POST FORMAT IS STANDARD
		
			if ( $post_type != 'attachment'  ) {
				echo $hide_feat_img ? null : as_image( 'as-landscape', $fimg_width,	$fimg_height );
			}
			
			the_content(); 
		
		}elseif ( $format == 'chat' || $format == 'status' || $format == 'aside') { // <------ IF POST FORMAT IS CHAT OR STATUS
					
			the_content(); 
		
		}elseif ( $format == 'link') { // <------------------ IF POST FORMAT IS LINK
			
			echo the_content();
		
		}elseif( $format == 'image' ) { // <------------------ IF POST FORMAT IS IMAGE
		
			if( !$hide_feat_img && has_post_thumbnail() ){
				echo '<div class="post-image-single">';
				the_post_thumbnail();
				echo '<div class="caption">' ;
				echo '<p>' . esc_html( as_post_thumbnail_caption() ) .'</p>';
				echo '</div>';
				echo '</div>';
			}
			
			the_content();
		
		}elseif( $format == 'gallery' ) { // <------------------ IF POST FORMAT IS GALLERY
		
			//
			// AS GALLERY POST META:
			//
			$gall_img_array		= get_post_meta( $id,'as_gallery_images');
			$gall_image_format	= get_post_meta( $id,'as_gall_image_format', true) ; 
			$slider_thumbs		= get_post_meta( $id,'as_slider_thumbs', true); 
			$thumb_columns		= get_post_meta( $id,'as_thumb_columns', true) ; 
			
			// image ID's from meta:
			$images_ids = '';
			if( !empty($gall_img_array) ) {
				
				$images_ids = implode(', ', $gall_img_array); // get image ID's from AS gallery
				
				echo as_gallery_output( $id, $images_ids, $slider_thumbs, $thumb_columns, $gall_image_format );
				}
						
			the_content();
			
		}elseif( $format == 'audio' ) { // <------------------ IF POST FORMAT IS AUDIO
			
			$audio_file_id	= get_post_meta( $id,'as_audio_file', true);
			$audio_file		= wp_get_attachment_url( $audio_file_id );
			
			
			if( $audio_file ){
				
				$attr = array(
					'src'      => $audio_file,
					'loop'     => false,
					'autoplay' => false,
					'preload'  => 'none'
				);
				
				echo wp_audio_shortcode($attr);
			} 			
			
			the_content();
			
			
		}elseif( $format == 'video' ) { // <------------------ IF POST FORMAT IS VIDEO
		
			$video_host	= get_post_meta( $id,'as_video_host', true);
			$video_id	= get_post_meta( $id,'as_video_id', true);
			$w			= get_post_meta( $id,'as_video_width', true);
			$h			= get_post_meta( $id,'as_video_height', true);
			
			
			if( $video_host ){
				do_action('as_embed_video_action', $video_host, $video_id, $w, $h );
			};
			
			the_content();
			
		
		}elseif( $format == 'quote' ) { // <------------------ IF POST FORMAT IS QUOTE
		
			$quote_author	= get_post_meta( $id,'as_quote_author', true);
			$quote_url		= get_post_meta( $id,'as_quote_author_url', true);
			$avatar			= get_post_meta( $id,'as_avatar_email', true);
		?>
			
			<?php 
			
			if( $avatar || has_post_thumbnail() ) { ?>
			<div class="avatar-img">
			
				<?php 
				echo $quote_url ? '<a href="'. esc_url($quote_url) .'" title="'. esc_attr($quote_author) .'">' : '';
				if( $avatar ) {
					echo get_avatar( $avatar , 120 );
				}elseif( has_post_thumbnail() ){
					the_post_thumbnail('thumbnail');
				}
				echo $quote_url ? '</a>' : '';
				
				$no_image = '';
				
				?>
				
			</div>
			<?php 
			}else{
				$no_image = ' no-image';
			};
			?>
		
			<div class="quote<?php echo esc_attr($no_image); ?>">
			
				<div class="arrow-left"></div>
				<?php 
				the_content(); 
				echo $quote_url ? '<a href="'. esc_url($quote_url) .'" title="'. esc_attr($quote_author) .'">' : '';
				echo $quote_author ? '<h5>'. esc_html($quote_author) .'</h5>' : '';
				echo $quote_url ? '</a>' : '';
				?>
		
			</div>
			<?php	
		}	
	
	} // if get_post_type ...
	
	?>
	
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
		
		if( has_category() || has_tag() || has_term( '', 'portfolio_category' ) || has_term( '', 'portfolio_tag' )) {
		
			as_entryMeta_cats_tags();
		}
		?>
		
	</div>
	
		
</article><!-- #post-<?php the_ID(); ?> -->
