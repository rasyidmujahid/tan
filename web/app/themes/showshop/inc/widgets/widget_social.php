<?php
/**
 *	AS Social Widget
 *
 */
 
// Load stylesheet and widget
//add_action('wp_head','oleaSocialWidgetCss');
add_action('widgets_init','AligatorStudio_Social');

// Register the widget
function AligatorStudio_Social() {
	register_widget('as_SocialWidget');
}

class as_SocialWidget extends WP_Widget {

	function as_SocialWidget() {
		//Settings
		$widget_ops = array('classname'=>'as_socialwidget','description'=>__('Display social icons on your site.','showshop'));
		
		//Controll settings
		$control_ops = array('id_base' => 'as_socialwidget');
		
		//Create widget
		$this->WP_Widget('as_socialwidget',__('Social Widget','showshop'),$widget_ops,$control_ops);
		
	}
	
	// Widget frontend
	function widget($args,$instance) {
		extract($args);
		
		//User selected settings
		
		$title		= isset( $instance['title']) ? $instance['title'] : '';
		$rss		= isset( $instance['rss']) ? $instance['rss'] : '';
		$facebook	= isset( $instance['facebook']) ? $instance['facebook'] : '';
		$twitter	= isset( $instance['twitter']) ? $instance['twitter'] : '';
		$linkedin	= isset( $instance['linkedin']) ? $instance['linkedin'] : '';
		$gplus		= isset( $instance['gplus']) ? $instance['gplus'] : '';
		$youtube	= isset( $instance['youtube']) ? $instance['youtube'] : '';
		$flickr		= isset( $instance['flickr']) ? $instance['flickr'] : '';
		$vimeo		= isset( $instance['vimeo']) ? $instance['vimeo'] : '';
		$pinterest	= isset( $instance['pinterest']) ? $instance['pinterest'] : '';
		$dribbble	= isset( $instance['dribbble']) ? $instance['dribbble'] : '';
		$forrst		= isset( $instance['forrst']) ? $instance['forrst'] : '';
		$instagram	= isset( $instance['instagram']) ? $instance['instagram'] : '';
		$github		= isset( $instance['github']) ? $instance['github'] : '';
		$picassa	= isset( $instance['picassa']) ? $instance['picassa'] : '';
		$skype		= isset( $instance['skype']) ? $instance['skype'] : '';
		
		echo wp_kses_post($before_widget);
		?>
				
			<?php 
			if ( $title ) {
				echo  wp_kses_post($before_title . $title . $after_title); 
			}
			?>			
			<div class="social">	
			
			<?php if($rss == 1) : ?>
				<a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="RSS" class="tip-top" data-tooltip><span class="icon icon-connection" aria-hidden="true"></span></a>
			<?php endif; ?>
			
			<?php if($facebook) : ?>
				<a href="<?php echo esc_url($facebook); ?>" target="_blank" title="Facebook" class="tip-top" data-tooltip><span class="icon icon-facebook" aria-hidden="true"></span></a>
			<?php endif; ?>		
						
			<?php if($twitter) : ?>
				<a href="<?php echo esc_url($twitter); ?>" target="_blank" title="Twitter" class="tip-top" data-tooltip><span class="icon icon-twitter aria-hidden="true"></span></a>
			<?php endif; ?>	
			
			<?php if($linkedin) : ?>
				<a href="<?php echo esc_url($linkedin); ?>" target="_blank" title="Linkedin" class="tip-top" data-tooltip><span class="icon icon-linkedin" aria-hidden="true"></span></a>
			<?php endif; ?>	
			
			<?php if($gplus) : ?>
				<a href="<?php echo esc_url($gplus); ?>" target="_blank" title="Google Plus" class="tip-top" data-tooltip><span class="icon icon-google-plus" aria-hidden="true"></span></a>
			<?php endif; ?>
					
			<?php if($youtube) : ?>
				<a href="<?php echo esc_url($youtube); ?>" target="_blank" title="YouTube" class="tip-top" data-tooltip><span class="icon icon-youtube" aria-hidden="true"></span></a>
			<?php endif; ?>
						
			<?php if($flickr) : ?>
				<a href="<?php echo esc_url($flickr); ?>" target="_blank" title="Flickr" class="tip-top" data-tooltip><span class="icon icon-flickr" aria-hidden="true"></span></a>
			<?php endif; ?>			

			<?php if($vimeo) : ?>
				<a href="<?php echo esc_url($vimeo); ?>" target="_blank" title="Vimeo" class="tip-top" data-tooltip><span class="icon icon-vimeo" aria-hidden="true"></span></a>
			<?php endif; ?>
			
			<?php if($pinterest) : ?>
				<a href="<?php echo esc_url($pinterest); ?>" target="_blank" title="Pinterest" class="tip-top" data-tooltip><span class="icon icon-pinterest" aria-hidden="true"></span></a>
			<?php endif; ?>
			
			<?php if($dribbble) : ?>
				<a href="<?php echo esc_url($dribbble); ?>" target="_blank" title="Dribbble" class="tip-top" data-tooltip><span class="icon icon-dribbble" aria-hidden="true"></span></a>
			<?php endif; ?>	
			
			<?php if($forrst) : ?>
				<a href="<?php echo esc_url($forrst); ?>" target="_blank" title="Forrst" class="tip-top" data-tooltip><span class="icon icon-forrst" aria-hidden="true"></span></a>
			<?php endif; ?>		

			<?php if($instagram) : ?>
				<a href="<?php echo esc_url($instagram); ?>" target="_blank" title="Instagram" class="tip-top" data-tooltip><span class="icon icon-instagram" aria-hidden="true"></span></a>
			<?php endif; ?>	

			<?php if($github) : ?>
				<a href="<?php echo esc_url($github); ?>" target="_blank" title="Github" class="tip-top" data-tooltip><span class="icon icon-github" aria-hidden="true"></span></a>
			<?php endif; ?>	
			
			<?php if($picassa) : ?>
				<a href="<?php echo esc_url($picassa); ?>" target="_blank" title="Picassa" class="tip-top" data-tooltip><span class="icon icon-picassa" aria-hidden="true"></span></a>
			<?php endif; ?>	
			
			<?php if($skype) : ?>
				<a href="<?php echo esc_url($skype); ?>" target="_blank" title="Skype" class="tip-top" data-tooltip><span class="icon icon-skype" aria-hidden="true"></span></a>
			<?php endif; ?>	

			
			</div><!-- .buttons -->			
				
		<?php
		echo wp_kses_post($after_widget);
	}
	
	// Widget update
	function update($new_instance,$instance) {
		$pattern1 = '/^http:\/\//'; //
		$pattern2 = '/^https:\/\//';
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['rss'] = strip_tags($new_instance['rss']);
		
		if(!empty($new_instance['facebook'])) {
			$fb = strip_tags($new_instance['facebook']);		
			if(preg_match($pattern1, $fb) || preg_match($pattern2, $fb)){
				$instance['facebook'] = $fb;
			} else {
				$instance['facebook'] = 'http://'.$fb;
			}
		} else {
			$instance['facebook'] = '';
		}
				
		if(!empty($new_instance['twitter'])) {
			$tw = strip_tags($new_instance['twitter']);		
			if(preg_match($pattern1, $tw) || preg_match($pattern2, $tw)){
				$instance['twitter'] = $tw;
			} else {
				$instance['twitter'] = 'http://'.$tw;
			}
		} else {
			$instance['twitter'] = '';	
		}

		if(!empty($new_instance['linkedin'])) {
			$li = strip_tags($new_instance['linkedin']);		
			if(preg_match($pattern1, $li) || preg_match($pattern2, $li)){
				$instance['linkedin'] = $li;
			} else {
				$instance['linkedin'] = 'http://'.$li;
			}		
		} else {
			$instance['linkedin'] = '';
		}
		
		if(!empty($new_instance['gplus'])) {
			$gp = strip_tags($new_instance['gplus']);		
			if(preg_match($pattern1, $gp) || preg_match($pattern2, $gp)){
				$instance['gplus'] = $gp;
			} else {
				$instance['gplus'] = 'http://'.$gp;
			}		
		} else {
			$instance['gplus'] = '';
		}

		if(!empty($new_instance['youtube'])) {
			$yt = strip_tags($new_instance['youtube']);		
			if(preg_match($pattern1, $yt) || preg_match($pattern2, $yt)){
				$instance['youtube'] = $yt;
			} else {
				$instance['youtube'] = 'http://'.$yt;
			}		
		} else {
			$instance['youtube'] = '';
		}
		
		if(!empty($new_instance['flickr'])) {
			$fl = strip_tags($new_instance['flickr']);		
			if(preg_match($pattern1, $fl) || preg_match($pattern2, $fl)){
				$instance['flickr'] = $fl;
			} else {
				$instance['flickr'] = 'http://'.$fl;
			}		
		} else {
			$instance['flickr'] = '';
		}		
		if(!empty($new_instance['vimeo'])) {
			$vi = strip_tags($new_instance['vimeo']);		
			if(preg_match($pattern1, $vi) || preg_match($pattern2, $vi)){
				$instance['vimeo'] = $vi;
			} else {
				$instance['vimeo'] = 'http://'.$vi;
			}		
		} else {
			$instance['vimeo'] = '';
		}

		
		
		if(!empty($new_instance['pinterest'])) {
			$pin = strip_tags($new_instance['pinterest']);		
			if(preg_match($pattern1, $pin) || preg_match($pattern2, $pin)){
				$instance['pinterest'] = $pin;
			} else {
				$instance['pinterest'] = 'http://'.$pin;
			}		
		} else {
			$instance['pinterest'] = '';
		}
		
		if(!empty($new_instance['dribbble'])) {
			$dr = strip_tags($new_instance['dribbble']);		
			if(preg_match($pattern1, $dr) || preg_match($pattern2, $dr)){
				$instance['dribbble'] = $dr;
			} else {
				$instance['dribbble'] = 'http://'.$dr;
			}		
		} else {
			$instance['dribbble'] = '';
		}
		
		if(!empty($new_instance['forrst'])) {
			$bh = strip_tags($new_instance['forrst']);		
			if(preg_match($pattern1, $bh) || preg_match($pattern2, $bh)){
				$instance['forrst'] = $bh;
			} else {
				$instance['forrst'] = 'http://'.$bh;
			}		
		} else {
			$instance['forrst'] = '';
		}
		
		if(!empty($new_instance['instagram'])) {
			$in = strip_tags($new_instance['instagram']);		
			if(preg_match($pattern1, $in) || preg_match($pattern2, $in)){
				$instance['instagram'] = $in;
			} else {
				$instance['instagram'] = 'http://'.$in;
			}		
		} else {
			$instance['instagram'] = '';
		}
		
		if(!empty($new_instance['github'])) {
			$gi = strip_tags($new_instance['github']);		
			if(preg_match($pattern1, $gi) || preg_match($pattern2, $gi)){
				$instance['github'] = $gi;
			} else {
				$instance['github'] = 'http://'.$gi;
			}		
		} else {
			$instance['github'] = '';
		}

		if(!empty($new_instance['picassa'])) {
			$am = strip_tags($new_instance['picassa']);		
			if(preg_match($pattern1, $am) || preg_match($pattern2, $am)){
				$instance['picassa'] = $am;
			} else {
				$instance['picassa'] = 'http://'.$am;
			}		
		} else {
			$instance['picassa'] = '';
		}

		if(!empty($new_instance['skype'])) {
			$sk = strip_tags($new_instance['skype']);		
			if(preg_match($pattern1, $sk) || preg_match($pattern2, $sk)){
				$instance['skype'] = $sk;
			} else {
				$instance['skype'] = 'http://'.$sk;
			}		
		} else {
			$instance['skype'] = '';
		}

		
		return $instance;
	}

	// Widget backend
	function form($instance) {
		$default = array('title' =>'', 'twitter'=>'','facebook'=>'','flickr'=>'','rss'=>'', 'gplus'=>'', 'youtube'=>'','vimeo'=>'', 'linkedin'=>'', 'pinterest'=>'', 'dribbble'=>'', 'forrst'=>'', 'instagram'=>'', 'github'=>'', 'picassa'=>'', 'skype'=>'');
		$instance = wp_parse_args((array)$instance,$default);
	?>
		<!-- TITLE -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>		
		<!-- RSS -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('rss')); ?>"><?php echo esc_html__('RSS link:','showshop'); ?></label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('rss')); ?>" name="<?php echo esc_attr($this->get_field_name('rss')); ?>" <?php if($instance['rss'] == 1): ?> checked="checked" <?php endif; ?> value="1" /> <?php echo esc_html__('Yes','showshop'); ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('rss')); ?>" name="<?php echo esc_attr($this->get_field_name('rss')); ?>" <?php if($instance['rss'] == 0): ?> checked="checked" <?php endif; ?> value="0" /> <?php echo esc_html__('No','showshop'); ?>
		</p>
		<!-- Facebook -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" value="<?php echo sanitize_text_field($instance['facebook']); ?>" class="widefat" />
		</p>		
		<!-- Twitter -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" value="<?php echo sanitize_text_field($instance['twitter']); ?>" class="widefat" />
		</p>
		<!-- LinkedIn -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('LinkedIn link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" value="<?php echo sanitize_text_field($instance['linkedin']); ?>" class="widefat" />
		</p>
		<!-- Google Plus -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('gplus')); ?>"><?php esc_html_e('Google Plus link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('gplus')); ?>" name="<?php echo esc_attr($this->get_field_name('gplus')); ?>" value="<?php echo sanitize_text_field($instance['gplus']); ?>" class="widefat" />
		</p>
		
		<!-- Youtube -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Youtube link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" value="<?php echo sanitize_text_field($instance['youtube']); ?>" class="widefat" />
		</p>
		
		<!-- Flickr -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr')); ?>"><?php esc_html_e('Flickr link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('flickr')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr')); ?>" value="<?php echo sanitize_text_field($instance['flickr']); ?>" class="widefat" />
		</p>		

		
		<!-- Vimeo -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php esc_html_e('Vimeo link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" value="<?php echo sanitize_text_field($instance['vimeo']); ?>" class="widefat" />
		</p>
		
		<!-- Pinterest -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" value="<?php echo sanitize_text_field($instance['pinterest']); ?>" class="widefat" />
		</p>
		<!-- Dribbble -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('dribbble')) ; ?>"><?php esc_html_e('Dribbble link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('dribbble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribbble')); ?>" value="<?php echo sanitize_text_field($instance['dribbble']); ?>" class="widefat" />
		</p>
		<!-- Forrst -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('forrst')); ?>"><?php esc_html_e('Forrst link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('forrst')); ?>" name="<?php echo esc_attr($this->get_field_name('forrst')); ?>" value="<?php echo sanitize_text_field($instance['forrst']); ?>" class="widefat" />
		</p>
		<!-- Instagram -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Instagram link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" value="<?php echo sanitize_text_field($instance['instagram']); ?>" class="widefat" />
		</p>			
		<!-- Github -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('github')); ?>"><?php esc_html_e('Github link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('github')); ?>" name="<?php echo esc_attr($this->get_field_name('github')); ?>" value="<?php echo sanitize_text_field($instance['github']); ?>" class="widefat" />
		</p>			
		<!-- Picassa -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('picassa')); ?>"><?php esc_html_e('Picassa link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('picassa')); ?>" name="<?php echo esc_attr($this->get_field_name('picassa')); ?>" value="<?php echo sanitize_text_field($instance['picassa']); ?>" class="widefat" />
		</p>			
		<!-- Skype -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('skype')); ?>"><?php esc_html_e('Skype link:','showshop'); ?></label>
			<br />
			<input type="text" id="<?php echo esc_attr($this->get_field_id('skype')); ?>" name="<?php echo esc_attr($this->get_field_name('skype')); ?>" value="<?php echo sanitize_text_field($instance['skype']); ?>" class="widefat" />
		</p>			

	
	<?php
	
	}

}
?>