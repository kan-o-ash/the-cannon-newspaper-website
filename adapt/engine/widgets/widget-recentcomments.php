<?php
class DT_Recent_Comments extends WP_Widget {

	function DT_Recent_Comments(){
		$widget_ops = array( 'classname' => 'DT_Recent_Comments', 'description' => 'Show recent comments with display options' );
		$this->WP_Widget( 'dt_recent', 'DT - Recent Comments', $widget_ops );
	}


	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

		$number = absint( $instance['number'] );
		$show_gravatar = ($instance['show_gravatar'] == 1) ? true : false;
		$show_post_title = ($instance['show_post_title'] == 1) ? true : false;

		echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;


		$comments = get_comments('status=approve&type=comment&number='.$number);

		if($comments):
			echo '<ul>';

			foreach ($comments as $comment):
				$post_url = '<a href="'. get_permalink($comment->comment_post_ID).'" title="'.$comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'">';
				$comment_url = '<a href="'. get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'" title="'.$comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'">';
			?>
					<li class="cf">

					<?php if($show_gravatar): ?>
					<?php echo $comment_url; ?><?php echo get_avatar( $comment->comment_author_email, 60); ?></a>
					<?php endif; ?>

					<span class="author"><?php echo $comment->comment_author; ?>: </span>

					<span class="comment">
						<?php echo $comment_url; ?><?php echo wp_html_excerpt( $comment->comment_content, 60 ); ?>&hellip;</a>
					</span>

					<?php if ($show_post_title): ?>
					<span class="entry-byline"> on <?php echo $post_url; ?><?php echo get_the_title($comment->comment_post_ID); ?></a></span>
					<?php endif; ?>

					</li>

			<?php
			endforeach;


			echo '</ul>';

		else:
			echo '<p>There are no comments.</p>';

		endif;


		echo $after_widget;

	}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array('title' => '', 'number' => 5, 'show_gravatar' => 1, 'show_post_title' => 1) );

        $title = esc_attr($instance['title']);
		$number = absint($instance['number']);
?>

		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>

               <input class="checkbox" type="checkbox" <?php checked($instance['show_gravatar'], true) ?> id="<?php echo $this->get_field_id('show_gravatar'); ?>" name="<?php echo $this->get_field_name('show_gravatar'); ?>" />
			   <label for="<?php echo $this->get_field_id('show_gravatar'); ?>"> Show comment author's gravatar </label>

			   <br />

               <input class="checkbox" type="checkbox" <?php checked($instance['show_post_title'], true) ?> id="<?php echo $this->get_field_id('show_post_title'); ?>" name="<?php echo $this->get_field_name('show_post_title'); ?>" />
			   <label for="<?php echo $this->get_field_id('show_post_title'); ?>"> Show post title link</label>
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
               Number of Comments:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>


<?php
    }




	function update($new_instance, $old_instance) {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number']=$new_instance['number'];
		$instance['show_gravatar'] = isset($new_instance['show_gravatar']) ? 1 : 0;
		$instance['show_post_title'] = isset($new_instance['show_post_title']) ? 1 : 0;
        return $instance;

    }

}

?>