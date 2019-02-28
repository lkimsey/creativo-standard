</div> <!-- closing the <div id="wrapper"> opened in header.php -->
<?php global $data; ?>
		<?php echo cr_footer_additional_icons_imgs(); ?>
			
		<footer class="footer">
			<?php 
			if( !is_404() ) {
				if( $data['en_instagram_footer'] && $data['instagram_username'] !='' ) {
				?>
				<div class="instagram_footer_wrap">
					<?php
					$username = $data['instagram_username'];
					$size = $data['instagram_size'];

					if( $data['instagram_footer_title'] != '' ) {

						$title = ( $data['instagram_footer_title_link'] != '' ) ? '<a href="' . esc_url( $data['instagram_footer_title_link'] ) . '" target = "_blank">' . $data['instagram_footer_title'] .'</a>' : $data['instagram_footer_title'];

						?>
						<div class="instagram_footer_title"><?php echo $title; ?></div>
						<?php
					}			

					switch ($size) {
						case 'thumbnail':
							$limit = 12;
							break;
						case 'large' :
							$limit = 8;
							break;
						case 'original':
							$limit = 6;
							break;
						default :
							$limit = 10;
					}

					$links = $data['instagram_links'];
					the_widget( 'cr_instagram_widget' , 'username=' . $username . '&size=' . $size . '&number=' . $limit . '&target=' . $links); 
				?>
				</div>
				<?php
				}
				?>
	        	<?php  
	        	//if (get_post_meta( $post->ID, 'pyre_call_to_action', true) != 'default')
	        	$footer_cta = ( '' !== get_post_meta( $post->ID, 'pyre_call_to_action', true) && 'default' !== get_post_meta( $post->ID, 'pyre_call_to_action', true) ) ? get_post_meta( $post->ID, 'pyre_call_to_action', true) : $data['en_cta'];	        	
				if( $footer_cta == 'true' || $footer_cta == 1 ){
				?>
	            <div class="action_bar">
	                <div class="action_bar_inner <?php echo 'pos_' . $data['cta_elem_pos']; ?> clearfix"> 
	                	
	                	<div class="cta_text">            
	                		<h2><?php echo $data['cta_text_real']; ?></h2>
	                		<div class="cta_description"><?php echo $data['cta_descr_text']; ?></div>
	                	</div>	   
	                	<div class="cta_button"><a href="<?php echo $data['cta_button_link']; ?>" class="button button_default large custompos shape_<?php echo $data['cta_button_shape']; ?>" target="_self"><?php echo $data['cta_button_text']; ?></a></div>            	
	                </div>
	            </div>  
	            <?php 
				}
				?>
	        	<?php        	
				
				if (  is_active_sidebar( 'sidebar-2'  ) && ( get_post_meta($post->ID, 'pyre_en_widgets', true) != 'no' ) ) {
					$footer_cols = ($data['footer_cols']) ? $data['footer_cols'] : 'cols_4';
				?>	
					<div class="footer_widget">
						<div id="footer_widget_inside" class="footer_columns_<?php echo $footer_cols; ?>">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-2')): 
							endif;
							?>
							<div class="clr"></div>
						</div>
					</div>
	            <?php
				}
			}
			?>  
	        
	    	<div class="inner">
	        	<div class="copyright">
	            	<?php 
						if($data['footer_copyright']) { 
							echo $data['footer_copyright'];
						}
					?>                    
	            </div>
	            
	         	<?php
						if($data['footer_right_area'] ) {	 
							if($data['footer_right_area'] =='socialinks_footer') { 
								get_template_part('functions/template/social-links-footer');
							} 
							elseif ($data['footer_right_area'] =='footer_menu') {
								get_template_part('functions/template/footer-menu');
							}
						}
						else{
							get_template_part('functions/template/social-links-footer');
						}
	                    ?>
	        </div>

	    </footer>
	</div>
<?php if($data['en_back_top']) { ?>    
	<div id="gotoTop"></div>    
<?php
	}
	if($data['body_code']) { echo $data['body_code']; } 
	
	//require_once(get_template_directory().'/style-selector/style_selector.php');
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	
	wp_footer();
	
?>
</body>
</html>
