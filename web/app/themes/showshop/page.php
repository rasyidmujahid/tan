<?php
/**
 * The default template for displaying pages.
 *
 * Default page template - for general purpose usage
 *
 * @since showshop1.0
 **/
get_header(); 
// 
global $as_of, $as_woo_is_active;
$layout 				= $as_of['layout'];
$shop_cart_full_width	= $as_of['shop_cart_full_width'];

// CUSTOM META:
$hide_title			=  get_post_meta( get_the_ID() ,'as_hide_title', true);
$page_under_head	=  get_post_meta( get_the_ID() ,'as_page_under_head', true);
$under_head 		= ( $page_under_head == false && AS_UNDERHEAD_IMAGE ) ? ' under-head' : '';
//
// VARS IF IT'S  SHOP:
if( $as_woo_is_active ) {
	$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) ? true : false ;
}else{
	$is_shop = false;
}

$shop_full = ( $is_shop && $shop_cart_full_width ) ? true : false;
?>

<?php if( !$hide_title  ) { ?>		
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
} // end if !hide_title
?>

<div class="row">

	<div id="primary" class="large-<?php echo ( $layout =='full_width' || $shop_full ) ? '12 full_width' : '8'; ?> <?php echo $layout ? esc_attr( $layout ) : null; ?> medium-12 small-12" role="main">
		
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php !$is_shop ? comments_template( '', true ) : null; ?>

		<?php endwhile;  ?>

		
	</div><!-- #primary -->

	<?php
	// IF CUSTOM SIDEBAR IS SELECTED (CUSTOM META)
	$options = get_post_custom(get_the_ID());
	if(isset($options['custom_sidebar'])) {
		$sidebar_choice = $options['custom_sidebar'][0];
	}else{
		$sidebar_choice = "default";
	}
	
	if( $layout != 'full_width' && !$shop_full ) {
		
		if($sidebar_choice && $sidebar_choice != "default") {
			
			get_sidebar("custom");
			
		}else{
		
			$is_shop ? do_action('woocommerce_sidebar') : get_sidebar();
		}
	}
	?>
</div><!-- /.row -->
	
<?php get_footer(); ?>