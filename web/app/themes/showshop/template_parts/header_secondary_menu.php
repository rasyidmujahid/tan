<?php
/**
 *	Template part to display secondary menu and/or languages selector in header.
 *
 *	@since showshop 1.0
 */

/**
 *  WMPL support:
 */
global $as_of, $as_woo_is_active;

$lang_sel = isset($as_of['lang_sel']) ? $as_of['lang_sel'] : null;
if ( function_exists('as_languages_list') && $lang_sel  ) { 
	as_languages_list();
}

if( $as_of['demo_mode'] ) { ?>

	<div id="language_list">
	<ul>
		<?php
		$flag_en = get_template_directory_uri() .'/img/demo_flag_en.png';
		$flag_it = get_template_directory_uri() .'/img/demo_flag_it.png';
		?>
		<li><img src="<?php echo esc_attr($flag_en);?>" height="12" alt="en" width="18"></li>
		<li><a href="#"><img src="<?php echo esc_attr($flag_it);?>" height="12" alt="it" width="18"></a></li>
	</ul>
	</div>

<?php } ?>

<nav id="secondary-nav">

	<?php 
	$walker = new My_Walker;
	wp_nav_menu( array( 
			'theme_location'	=> 'secondary',
			//'menu'			=> 'Main menu',
			'walker'			=>$walker,
			'link_before'		=>'',
			'link_after'		=>'',
			'menu_class'		=> 'navigation secondary',
			'container'			=> false 
			) 
		);
	?>
	
</nav>
