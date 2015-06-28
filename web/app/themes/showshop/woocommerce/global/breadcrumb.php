<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $as_wc_version, $delimiter;

if( version_compare( $as_wc_version, '2.3.0' ,'<' ) ) {
	//wc_get_template_part( 'breadcrumb', 'before2.3' );
	include('breadcrumb-before2.3.php');

}else{
?>

<?php if ( $breadcrumb ) : ?>

	<?php $breadcrumb_html = ""; ?>
	
	<?php $breadcrumb_html .= $wrap_before; ?>

	<?php foreach ( $breadcrumb as $key => $crumb ) : ?>

		<?php $breadcrumb_html .= $before; ?>

		<?php if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) : ?>
			<?php $breadcrumb_html .= '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>'; ?>
		<?php else : ?>
			<?php $breadcrumb_html .= esc_html( $crumb[0] ); ?>
		<?php endif; ?>

		<?php $breadcrumb_html .= $after; ?>

		<?php if ( sizeof( $breadcrumb ) !== $key + 1 ) : ?>
			<?php $breadcrumb_html .= $delimiter; ?>
		<?php endif; ?>

	<?php endforeach; ?>

	<?php $breadcrumb_html .= $wrap_after; ?>
	
	<?php echo wp_kses_post($breadcrumb_html); ?>

<?php endif; ?>
	 
<?php } // end version_compare ?>
