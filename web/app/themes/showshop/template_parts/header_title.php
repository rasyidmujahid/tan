<?php global $as_of;?>		

<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home" class="home-link vertical-align" id="site-title">

	<h1 class="vertical-middle">
		<?php 
		$logo		= $as_of['site_logo'];
		$logo_on	= !empty ( $as_of['logo_desc']['logo_on'] );
		
		if ( $logo_on &&  $logo  ) {
		?>
			<img src="<?php echo esc_url($logo); ?>" title="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' );?>" alt="<?php bloginfo( 'name' ); ?>" />
		
		<?php } else { ?>
		
			<span><?php bloginfo( 'name' ); ?></span>
			
		<?php } ?>
	</h1>

</a>


		
