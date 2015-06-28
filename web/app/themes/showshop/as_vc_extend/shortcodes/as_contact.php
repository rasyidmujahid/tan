<?php
function as_contact_func( $atts, $content = null ) {

extract( shortcode_atts( array(
		'title'			=> '',
		'subtitle'		=> '',
		'sub_position'	=> 'bellow',
		'title_style'	=> 'center',
		'title_color'	=> '',
		'subtitle_color'=> '',
		'no_title_shadow'		=> '',
		'title_size'		=> '',
		'enter_anim'	=> 'fadeIn',
		
		'contact_email'	=> get_option('admin_email') ? get_option('admin_email') : '',
		'attach_id'		=> '',
		'img_format'	=> 'as-landscape',
		'text'			=> '',
		'wp_autop'		=> '',
	
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
	
	
	
/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */

####################  HTML STARTS HERE: #########################

ob_start();
echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;


do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_title_shadow, $title_size );

$additional = ( $attach_id || $text ) ? true : false; // if additional text and/or image
?>

<?php echo $additional ? '<div class="row">' : ''; ?>

<div id="contact-block-<?php echo esc_attr($block_id);?>" class="contact-form <?php echo $additional ? 'small-12 medium-6 column' : null; ?>">


	<div id="success" class="emailform-message success clearfix" style="display:none;">
		<?php esc_html_e('Your email has been sent! Thank you!','showshop'); ?>
		<button type="button" class="close" data-dismiss="alert">
			<span class="icon-cross" aria-hidden="true"></span>
		</button>esc_attr()
	</div>

	<div id="bademail" class="emailform-message alert clearfix" style="display:none;">
		<?php esc_html_e('Please enter your name, a message and a valid email address.','showshop'); ?>
		<button type="button" class="close" data-dismiss="alert">
			<span class="icon-cross" aria-hidden="true"></span>
		</button>
	</div>
	
	<div id="badserver" class="emailform-message error clearfix" style="display:none;">
		<?php esc_html_e('Your email failed. Try again later.','showshop'); ?>
		<button type="button" class="close" data-dismiss="alert">
			<span class="icon-cross" aria-hidden="true"></span>
		</button>
	</div>

	<div class="clearfix"></div>
	
	<form id="contact-<?php echo esc_attr($block_id); ?>" action="<?php echo get_template_directory_uri(); ?>/inc/functions/sendmail.php" method="post" class="clearfix">
	
		<p class="name">
		<label for="name"><?php esc_html_e('Your name:','showshop'); ?> *</label>
			<input type="text" id="nameinput" class="contact_input" name="name" value=""/>
		</p>
		
		<p class="email">
		<label for="email"><?php esc_html_e('Your email:','showshop'); ?> *</label>
			<input type="text" id="emailinput" class="contact_input" name="email" value=""/>
		</p>
		
		<p class="message">
		<label for="comment"><?php esc_html_e('Your message:','showshop'); ?> *</label>
			<textarea cols="20" rows="7" id="commentinput" class="contact_input" name="comment"></textarea>
		</p>
		
		<p class="submit">
		<input type="submit" id="submitinput" name="submit" class="submit button small" value="<?php esc_attr_e('Send message','showshop'); ?>"/>
		</p>
		
		<input type="hidden" id="receiver" name="receiver" value="<?php echo strhex( $contact_email ); ?>" />
		
	</form>


</div>  

<?php echo $additional ? '<div class="small-12 medium-6 column contact-additional">' : null; ?>
	

	<?php if( $attach_id ) { ?>
	<div class="image">
		<?php 
		$attr = array(
			'class' => 'as-hover',
			'title'	=> $title ? esc_attr($title) : '',
			'alt'	=> $title ? esc_attr($title) : ''
		);
		
		echo '<div class="entry-image">' . wp_get_attachment_image( $attach_id, $img_format, false,  $attr ) . '</div>'; 
		
		?>
	</div>
	<?php }; ?>

	<?php if( $content ) { ?>
	<div class="location-description">
	
		<?php
		$content = wpb_js_remove_wpautop($content, true);
	
		echo wp_kses_post($content);
		
		?>
		
	</div>
	<?php }; ?>


<?php echo $additional ? '</div>' : null; // end .small-12 medium-6 ?>

<?php echo $additional ? '</div>' : null; // end .row ?>


<?php
####################  HTML ENDS HERE: ###########################
echo $css_classes ? '</div>' : null;

if ( !wp_script_is( 'as_contactform', 'enqueued' )) {
		
	wp_register_script( 'as_contactform', get_template_directory_uri() . '/js/as_contactform.min.js');
	wp_enqueue_script( 'as_contactform' );

	?>		
	<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(document).ready(function() {
	
		$j('#contact-<?php echo esc_js($block_id); ?>').ajaxForm(function(data) {
			if (data==1){
				$j('#success').fadeIn("slow");
				$j('#bademail').fadeOut("slow");
				$j('#badserver').fadeOut("slow");
				$j('#contact').resetForm();
			}
			else if (data==2){
				$j('#badserver').fadeIn("slow");
			}
			else if (data==3)
			{
				$j('#bademail').fadeIn("slow");
			}
		});
		$j('.contact-form').find('button').click(function() {
			$j(this).parent().fadeToggle();
		});
		
	});
	</script>
<?php
} ////end if ( !wp_script_is ...

$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}

add_shortcode( 'as_contact', 'as_contact_func' );
?>