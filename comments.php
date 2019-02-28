<?php
global $data;
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'Creativo') ?></p>
	<?php
		return;
	}

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

		if ( have_comments() ) : // if there are comments ?>
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
		
		<div id="comments" class="posts-boxes toppadding">
        	<div class="content_box_title">
        		<?php 
        		if ($data['single_post_design'] == 'modern' || $data['comments_style'] == 'modern') {
        		?>
        			<h5><?php _e('Article Comments', 'Creativo') ?></h5>
        		<?php
        		}
        		else {
        		?>
        			<span class="white smaller"><?php _e('Your thoughts here', 'Creativo') ?></span>
        	
        		<?php
        		}
        		?>
            </div>    
        </div>
		
		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=comment_style'); ?>
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		<h3 id="pings"><?php _e('Trackbacks for this post', 'Creativo') ?></h3>
		
		<ol class="pinglist">
        <?php wp_list_comments('type=pings&callback=comment_style'); ?>
        </ol>

        <?php endif; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		
		<?php
		
		
/*-----------------------------------------------------------------------------------*/
/*	Deal with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
		
		if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		
		<p class="nocomments"><?php _e('Comments are now closed for this article.', 'Creativo') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php _e('Comments are closed.', 'Creativo') ?></p><?php } ?>

        <?php endif; ?>
        
<?php endif;


/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : ?>
		<?php 
		if ($data['single_post_design'] == 'modern' || $data['comments_style'] == 'modern') {
			$args = array(
				'id_form'           => 'commentform',
				'id_submit'         => 'submit',
				'title_reply'       => '<div class="posts-boxes toppadding"><div class="content_box_title"><h5 class="modern_big">' . __('Leave a Comment', 'Creativo') . '</h5></div></div>',
				'title_reply_to'    => '<div class="posts-boxes toppadding"><div class="content_box_title"><h5 class="modern_big">' . __('Leave a Comment to %s', 'Creativo') . '</h5></div></div>',
				'cancel_reply_link' => __( 'Cancel Comment', 'Creativo' ),
				'label_submit'      => __( 'Submit Comment', 'Creativo' ),
				'class_submit'		=> 'button large rounded button_default',
				//'submit_button'		=> '<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="' . $button_class . '">' . __($c_icon.'Submit Comment', 'Creativo') . '</button>',
				'comment_field' =>  '<div class="comment_textarea"><label for="comment">'.__('Message', 'Creativo').'</label><textarea name="comment" id="comment" cols="58" rows="5" tabindex="4"></textarea></div>',
				'must_log_in' => '<p class="must-log-in">' .
				  sprintf(
				    __( 'You must be <a href="%s">logged in</a> to post a comment.', 'Creativo' ),
				    wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
				  ) . '</p>',

				'logged_in_as' => '<div class="col_full">' . '<p>' .
				  sprintf(
				  __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'Creativo' ),
				    admin_url( 'profile.php' ),
				    $user_identity,
				    wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
				  ) . '</p>' . '</div>',

				'comment_notes_before' => '',

				'comment_notes_after' => '',

				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' =>
						'<div class="comment_fields clearfix"><div class="comment_half">'. 
			            	'<label for="author">' . __('Name ', 'Creativo'). ( $req ? '<span>'. __("*", 'Creativo') . '</span>' : '' ) . '</label> ' .
			                '<input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) .'" size="22" tabindex="1" />
			            </div>',									

					'email' =>
						'<div class="comment_half last">'.
							'<label for="email">' . __('Email ', 'Creativo'). ($req ? '<span>'. __("*", 'Creativo') . '</span>' : '' ) . '</label> ' .
						 	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="22" tabindex="2">'.
						 '</div></div>',
					'url' => '',
					)
						
				),
			);
			comment_form($args);     	
    		
    	}
    	else {
    		$args = array(
    			'id_form'           => 'commentform',
    			'id_submit'         => 'submit',
    			'title_reply'       => '<div class="comments_title"><h5>' . __('Leave a Comment', 'Creativo') . '</h5></div>',
    			'title_reply_to'    => '<div class="comments_title"><h5>' . __('Leave a Comment to %s', 'Creativo') . '</h5></div>',
    			'cancel_reply_link' => __( 'Cancel Comment', 'Creativo' ),
    			'label_submit'      => __( 'Submit Comment', 'Creativo' ),
    			'class_submit'		=> 'button small button_default',
    			//'submit_button'		=> '<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="' . $button_class . '">' . __($c_icon.'Submit Comment', 'Creativo') . '</button>',
    			'comment_field' =>  '<div class="comment_textarea"><label for="comment">'.__('Comment', 'Creativo').'</label><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" class="input-block-level"></textarea></div>',
    			'must_log_in' => '<p class="must-log-in">' .
    			  sprintf(
    			    __( 'You must be <a href="%s">logged in</a> to post a comment.', 'Creativo' ),
    			    wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    			  ) . '</p>',

    			'logged_in_as' => '<div class="col_full">' . '<p>' .
    			  sprintf(
    			  __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'Creativo' ),
    			    admin_url( 'profile.php' ),
    			    $user_identity,
    			    wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    			  ) . '</p>' . '</div>',

    			'comment_notes_before' => '',

    			'comment_notes_after' => '',

    			'fields' => apply_filters( 'comment_form_default_fields', array(
    				'author' =>
    					'<div class="comment_column">'. 
    		            	'<label for="author">' . __('Name ', 'Creativo') . ( $req ? '<span>'. __("*", 'Creativo') . '</span>' : '' ) . '</label>' .
    		                '<input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) .'" size="22" tabindex="1" class="input-block-level" />
    		            </div>',									

    				'email' =>
    					'<div class="comment_column">'.
    						'<label for="email">' . __('Email ', 'Creativo') . ( $req ? '<span>'. __("*", 'Creativo') . '</span>' : '' ) . '</label>' .
    					 	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="22" tabindex="2" class="input-block-level">'.
    					 '</div>',
    				'url' => 
    					'<div class="comment_column last">'.
    						'<label for="url">' . __('Website', 'Creativo') . '</label>'.
    						'<input type="text" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="22" tabindex="3" class="input-block-level" />'.
    					'</div>',
    				)
    					
    			),
    		);
    		comment_form($args);        
		}
		?>
	<?php endif; // if you delete this the sky will fall on your head ?>
