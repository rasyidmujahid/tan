<?php
/**
 *	The Footer template.
 *
 *	@since showshop 1.0
 */
?>

</div><!-- end #page -->

<?php

global $as_of;
/**
*	HEADER AND MENU ORIENTATION:
*/

if( $as_of['orientation'] == 'vertical' ) {
	$page_layout = ' vertical';
}else{
	$page_layout = ' horizontal';
}

$boxed			= $as_of['bottom_widgets_boxed'] ? ' boxed' : '';
$grid_spacing	= $as_of['bottom_widgets_grid_spacing'] ? ' grid-spacing' : '';
?>
	
	<?php if ( is_active_sidebar( 'bottom-page-widgets' ) ) { ?>
	<div class="row border-top bottom-widgets<?php echo esc_attr( $boxed . $grid_spacing ); ?>">
		
		<div>
	
		<?php dynamic_sidebar( 'bottom-page-widgets' );	?>
	
		<div class="clearfix"></div>

		</div>
		
	</div>
	<?php } ?>
	
	<footer id="footer" class="<?php echo esc_attr($page_layout); ?>">
	
		<?php // FOOTER WIDGETS //////////////////////////////// ?>
		
		<?php if ( is_active_sidebar( 'footer-widgets-1' ) || is_active_sidebar( 'footer-widgets-2' ) || is_active_sidebar( 'footer-widgets-3' ) ) : ?>

			<div id="footerwidgets">
				
				<div class="row border-bottom bottom-widgets<?php echo esc_attr( $boxed . $grid_spacing ); ?>">		
										
					<?php 
					if ( is_active_sidebar( 'footer-widgets-1' ) ) {
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-1' ); 
						echo '</div>';
					}
					if ( is_active_sidebar( 'footer-widgets-2' ) ){
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-2' ); 
						echo '</div>';
					}		
					if ( is_active_sidebar( 'footer-widgets-3' ) ) {
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-3' ); 
						echo '</div>';
					}
					if ( is_active_sidebar( 'footer-widgets-4' ) ) {
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-4' ); 
						echo '</div>';
					}	
					?>
							
				</div><!-- / .row -->
			
			</div>

		
		<?php endif; ?>
		
		<div class="credits">
		
			<div class="row">
				
				<?php if ($as_of['footer_text']) {
					
					echo esc_html( $as_of['footer_text'] );

				}else{?>
				
					<p>&copy; <?php bloginfo('blog_url'); ?> <?php echo get_bloginfo('description') ? ' | '. get_bloginfo('description') : ''; ?></p>
				
				<?php }; // endif ?>
			
			</div> <!-- /row -->
		</div>
		
	</footer>

<?php 
// SOME WOOCOMMERCE STUFF:
global $woocommerce, $as_woo_is_active;

if( $as_woo_is_active ) {

	if( function_exists( 'wc_notice_count' ) ) {
		
		if( wc_notice_count() ) {
			echo '<div class="theme-shop-message">';
			do_action( 'woocommerce_before_single_product' );
			echo '</div>';
		}
		
	}else{
		// backward  < 2.1 compatibility:
		if( $woocommerce->error_count() > 0 || $woocommerce->message_count() > 0 ) {
			echo '<div class="theme-shop-message">';
			do_action( 'woocommerce_before_single_product' );
			echo '</div>';
		}
	}
	
}
?>

<a href="#0" class="to-top icon-chevron-small-up accent-1-light-40" title="<?php esc_attr_e('Top','showshop'); ?>"></a>

<div class="clearfix"></div>

</section>

</div><!-- end .bodywrap -->

<div class="active-mega arrow-left"><span class="arrow-left"></span></div>

<?php wp_footer(); ?>

</body>

</html>