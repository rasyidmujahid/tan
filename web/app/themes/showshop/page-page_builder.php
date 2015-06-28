<?php
/**
 * Template Name: Page builder template
 *
 * Page for template builder - bulit for using row blocks
 *
 * @since showshop1.0
 **/
get_header();
// 
global $post, $as_of;
$layout 				= $as_of['layout'];
$page_under_head		=  get_post_meta( get_the_ID() ,'as_page_under_head', true);
$under_head = ( $page_under_head == false && AS_UNDERHEAD_IMAGE ) ? ' under-head' : '';
//
//
$hide_title = get_post_meta( get_the_ID() ,'as_hide_title');
//
// VARS IF IT'S  SHOP:
if( $as_woo_is_active ) {
	$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) ? true : false ;
}else{
	$is_shop = false;
}
//

if( !$hide_title  ) {
?>
<header class="page-header">

	<?php	
	$shop_title_bcktoggle = $as_of['shop_title_bcktoggle'];
	$shop_title_backimg = $as_of['shop_title_backimg'];
	
	if( $shop_title_bcktoggle && $shop_title_backimg && $is_shop ) {
		
		$image =  $shop_title_backimg;
		
		echo'<div class="header-background'. esc_attr( $under_head ) .'" style="background-image: url('. esc_url($image) .');"></div>';
		
	}elseif( has_post_thumbnail() ) {
		// get image by attachment id:
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'as-landscape' );
		$image = $image[0];
		
		echo'<div class="header-background'. esc_attr( $under_head ) .'" style="background-image: url('. esc_url($image) .');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="row">
	
		<div class="small-12 table titles-holder">
		
			<h1 class="page-title" data-shadow-text="<?php the_title(); ?>"><?php the_title(); ?></h1>
		
		</div>
		
	</div><!-- /.row -->

</header>

<?php
}; // end if !$hide_title ?>	


<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> >	
		
	<?php
	
	if( have_posts() ) : while ( have_posts() ) : the_post(); 
	
		the_content();
					
	endwhile;
	
	endif;
	
	?>

	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'showshop' ), 'after' => '</div>' ) ); ?>
				
	<div class="clearfix"></div>

</section>
	
<?php get_footer(); ?>