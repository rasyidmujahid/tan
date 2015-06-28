<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $as_of;
$prod_hover_anim	= $as_of['prod_hover_anim'];
$p_anim				= $prod_hover_anim ? ' '.$prod_hover_anim : '';

$data_anim	= $as_of['prod_data_anim'];
$d_anim		= $data_anim == 'none' ? '' : ' '.$data_anim;

$smaller_buttons	= $as_of['smaller_buttons'];
$smaller	= $smaller_buttons ? ' smaller' : '';


?>
<ul class="products<?php echo esc_attr( $p_anim . $d_anim . $smaller) ;?> shuffle" >