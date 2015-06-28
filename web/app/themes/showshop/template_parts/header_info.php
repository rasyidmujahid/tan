<?php
global $as_of;

$info_items = $as_of['topbar_info'];
if( count($info_items) ) {
	echo '<div class="table" style="height: 100%; width: auto;">';
	echo '<div class="topbar-info">';
	foreach ( $info_items as $item ) {
		
		$toggle = !empty($item['toggle']) ? ' toggle' : '';
		
		echo '<div class="topbar-info-item">';
		
		echo $item['link'] ? '<a href="'. esc_url( $item['link'] ).'" title="'. esc_attr( $item['title'] ) .'">' : null;
		echo $item['icon'] ? '<span class="'. esc_attr( $item['icon'] ) . ' icon'. esc_attr( $toggle ) .'"></span>' : null;
		echo $item['title'] ? '<span class="title'. esc_attr($toggle) .'">'. esc_html( $item['title'] ).'</span>' : null;
		echo $item['link'] ? '</a>' : null;
		echo '</div>';
		
		
	}
	echo '</div>';
	echo '</div>';
}
?>