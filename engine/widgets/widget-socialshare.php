<?php
class DT_Social extends WP_Widget {

	function DT_Social(){
		$widget_ops = array( 'classname' => 'DT_Social', 'description' => 'Show social/sharing links in your post.' );
		$this->WP_Widget( 'dt_social', 'DT - Social/Share Links', $widget_ops);
	}



	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;
		$display= $instance['display'];


		$twitter = ($instance['twitter'] == 1) ? true : false;
		$buzz = ($instance['buzz'] == 1) ? true : false;
		$facebook = ($instance['facebook'] == 1) ? true : false;
		$digg = ($instance['digg'] == 1) ? true : false;
		$delicious = ($instance['delicious'] == 1) ? true : false;
		$stumbleupon = ($instance['stumbleupon'] == 1) ? true : false;
		$email = ($instance['email'] == 1) ? true : false;


		$display= $instance['display'];


        $description = $instance['description'];

		echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;


		if($description != "")
			echo '<p>' . stripslashes($description) . '</p>';

?>
		<ul class="<?php echo $display; ?>">

			<?php if($twitter) : ?>
			<li class="twitter"><a rel="nofollow" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php echo home_url(); ?>/?p=<?php the_ID(); ?>" title="Twitter"><span class="text">Twitter</span></a></li>
		<?php endif; ?>

		<?php if($buzz) : ?>
			<li class="google-buzz"><a rel="nofollow" href="http://www.google.com/reader/link?url=<?php the_permalink() ?>&title=<?php the_title(); ?>&srcURL=<?php echo home_url(); ?>" title="Google Buzz"><span class="text">Google Buzz</span></a></li>
		<?php endif; ?>

		<?php if($facebook) : ?>
			<li class="facebook"><a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" title="Facebook"><span class="text">Facebook</span></a></li>
		<?php endif; ?>

		<?php if($delicious) : ?>
			<li class="delicious"><a rel="nofollow" href="http://delicious.com/post?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&notes=<?php the_excerpt_rss(); ?>" title="Delicious"><span class="text">Delicious</span></a></li>
		<?php endif; ?>

		<?php if($digg) : ?>
			<li class="digg"><a rel="nofollow" href="http://digg.com/submit?phase=2&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&bodytext=<?php the_excerpt_rss(); ?>" title="Digg"><span class="text">Digg</span></a></li>
		<?php endif; ?>

		<?php if($stumbleupon) : ?>
			<li class="stumbleupon"><a rel="nofollow" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="StumbleUpon"><span class="text">StumbleUpon</span></a></li>
		<?php endif; ?>

		<?php if($email) : ?>
			<li class="email"><a rel="nofollow" href="http://www.feedburner.com/fb/a/emailFlare?itemTitle=<?php the_title(); ?>&uri=<?php the_permalink(); ?>&loc=$loc" title="Email This"><span class="text">Email</span></a></li>
		<?php endif; ?>

		</ul>
<?php

		echo $after_widget;

	}





	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = esc_attr($instance['title']);
        $description = $instance['description'];
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
              <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('description'); ?>">
               Description:
            </label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
        </p>

        <p>
        	<label>
               Select Links to Display:
            </label>
            <br />
        	<input class="checkbox" type="checkbox" <?php checked($instance['twitter'], true) ?> id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" />
			   <label for="<?php echo $this->get_field_id('twitter'); ?>"> Twitter </label>
        	<br />
               <input class="checkbox" type="checkbox" <?php checked($instance['buzz'], true) ?> id="<?php echo $this->get_field_id('buzz'); ?>" name="<?php echo $this->get_field_name('buzz'); ?>" />
			   <label for="<?php echo $this->get_field_id('buzz'); ?>"> Google Buzz </label>
        	<br />
               <input class="checkbox" type="checkbox" <?php checked($instance['facebook'], true) ?> id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" />
			   <label for="<?php echo $this->get_field_id('facebook'); ?>"> Facebook </label>
        	<br />
               <input class="checkbox" type="checkbox" <?php checked($instance['digg'], true) ?> id="<?php echo $this->get_field_id('digg'); ?>" name="<?php echo $this->get_field_name('digg'); ?>" />
			   <label for="<?php echo $this->get_field_id('digg'); ?>"> Digg </label>
        	<br />
               <input class="checkbox" type="checkbox" <?php checked($instance['delicious'], true) ?> id="<?php echo $this->get_field_id('delicious'); ?>" name="<?php echo $this->get_field_name('delicious'); ?>" />
			   <label for="<?php echo $this->get_field_id('delicious'); ?>"> Delicious </label>
        	<br />
               <input class="checkbox" type="checkbox" <?php checked($instance['stumbleupon'], true) ?> id="<?php echo $this->get_field_id('stumbleupon'); ?>" name="<?php echo $this->get_field_name('stumbleupon'); ?>" />
			   <label for="<?php echo $this->get_field_id('stumbleupon'); ?>"> StumbleUpon </label>
        	<br />
               <input class="checkbox" type="checkbox" <?php checked($instance['email'], true) ?> id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" />
			   <label for="<?php echo $this->get_field_id('email'); ?>"> Email</label>
        </p>

		<p>
			<label for="<?php echo $this->get_field_id('display'); ?>">
               Display Options:
            </label>
			<select name="<?php echo $this->get_field_name('display'); ?>" id="<?php echo $this->get_field_id('display'); ?>" class="widefat">
					<option value="icons-only"<?php selected( $instance['display'], 'icons-only' ); ?>>Icons only</option>
					<option value="icons-text"<?php selected( $instance['display'], 'icons-text' ); ?>>Icons and text</option>
					<option value="text-only"<?php selected( $instance['display'], 'text-only' ); ?>>Text only</option>
			</select>
		</p>

<?php

}



	function update($new_instance, $old_instance) {
        $instance=$old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter'] = isset($new_instance['twitter']) ? 1 : 0;
		$instance['buzz'] = isset($new_instance['buzz']) ? 1 : 0;
		$instance['facebook'] = isset($new_instance['facebook']) ? 1 : 0;
		$instance['digg'] = isset($new_instance['digg']) ? 1 : 0;
		$instance['delicious'] = isset($new_instance['delicious']) ? 1 : 0;
		$instance['stumbleupon'] = isset($new_instance['stumbleupon']) ? 1 : 0;
		$instance['email'] = isset($new_instance['email']) ? 1 : 0;
        $instance['display'] = $new_instance['display'];
        $instance['description']=$new_instance['description'];
		return $instance;

    }

}
?>