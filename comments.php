<?php if ( comments_open() ) : ?>
<div id="comments"><div class="inner">
<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'engine') ?></p>
	<?php
		return;
	}

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

		if ( have_comments() ) : // if there are comments ?>
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
		
		<h3 class="comments-title">
			<?php comments_number(__('No Comments', 'engine'), __('One Comment', 'engine'), __('% Comments', 'engine')); ?>
			<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-comment.png" alt="" /></span>
		</h3>
		
		<ol class="commentlist">
        <?php wp_list_comments('type=comment&avatar_size=40&callback=dt_comment'); ?>
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
		
		<p class="nocomments"><?php _e('Comments are now closed for this article.', 'engine') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>
		

        <?php endif; ?>
        
<?php endif;


/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : ?>

	<div id="respond">

		<h3>
			<?php comment_form_title( __('Leave a Comment', 'engine'), __('Leave a Comment to %s', 'engine') ); ?>
			<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-comment.png" alt="" /></span>
		</h3>
	
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'engine'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			
			<div class="input-wrap">
			
				<?php if ( is_user_logged_in() ) : ?>
			
				<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'engine'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'engine').'">', '</a>') ?></p>
			
				<?php else : ?>
			
				<p>
				<label for="author"><?php _e('Name', 'engine') ?> <?php if ($req) _e("<span>*</span>", 'engine'); ?></label>
				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" />
				</p>
			
				<p>
				<label for="email"><?php _e('Email', 'engine') ?> <?php if ($req) _e("<span>*</span>", 'engine'); ?></label>
				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
				</p>
			
				<p>
				<label for="url"><?php _e('Website', 'engine') ?></label>
				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
				</p>
			
				<?php endif; ?>
			
			</div>
			
			<div class="textarea-wrap">
			
				<p>
				<label for="comment"><?php _e('Your Comment', 'engine') ?> <?php if ($req) _e("<span>*</span>", 'engine'); ?></label>
				<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
				
				<!--<p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
			
			</div>
		
			<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'engine') ?>" />
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; // If registration required and not logged in ?>
	</div>

	<?php endif; // if you delete this the sky will fall on your head ?>
</div></div>

<?php endif; // if you delete this the sky will fall on your head ?>
