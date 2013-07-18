<?php
class DT_Subscribe_Follow extends WP_Widget {

	function DT_Subscribe_Follow(){
		$widget_ops = array( 'classname' => 'DT_Subscribe_Follow', 'description' => 'Show subscribe and follow links' );
		$control_ops = array('width' => 350, 'height' => 350);
		$this->WP_Widget( 'dt_subscribe_follow', 'DT - Subscribe/Follow Links', $widget_ops, $control_ops);
	}



	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

		$display= $instance['display'];

		$s_rss = ($instance['s_rss'] == 1) ? true : false;
		$s_email = ($instance['s_email'] == 1) ? true : false;
		$s_twitter = ($instance['s_twitter'] == 1) ? true : false;
		$s_facebook = ($instance['s_facebook'] == 1) ? true : false;

		$rss = $instance['rss'];
		$email = $instance['email'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];

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

		<?php if($s_rss) : ?>
			<li class="rss"><a rel="nofollow" href="<?php echo stripslashes($rss); ?>" title="RSS"><span class="text">Subscribe via RSS</span></a></li>
		<?php endif; ?>

		<?php if($s_email) : ?>
			<li class="email"><a rel="nofollow" href="<?php echo stripslashes($email); ?>" title="Email"><span class="text">Subscribe via Email</span></a></li>
		<?php endif; ?>

		<?php if($s_twitter) : ?>
			<li class="twitter"><a rel="nofollow" href="http://twitter.com/<?php echo stripslashes($twitter); ?>" title="Twitter"><span class="text">Follow on Twitter</span></a></li>
		<?php endif; ?>

		<?php if($s_facebook) : ?>
			<li class="facebook"><a rel="nofollow" href="<?php echo stripslashes($facebook); ?>" title="Facebook"><span class="text">Follow on Facebook</span></a></li>
		<?php endif; ?>

		</ul>
<?php

		echo $after_widget;

	}


	function form($instance) {

        $title = esc_attr($instance['title']);

		$rss = $instance['rss'];
		$email = $instance['email'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];

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
               Select Profiles to Display:
            </label>
        </p>

		<p>
               <input class="checkbox" type="checkbox" <?php checked($instance['s_rss'], true) ?> id="<?php echo $this->get_field_id('s_rss'); ?>" name="<?php echo $this->get_field_name('s_rss'); ?>" />
			   <label for="<?php echo $this->get_field_id('s_rss'); ?>"> Subscribe via RSS <span class="helper">(URL below)</label><br />
			   <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" />
        </p>

		<p>
               <input class="checkbox" type="checkbox" <?php checked($instance['s_email'], true) ?> id="<?php echo $this->get_field_id('s_email'); ?>" name="<?php echo $this->get_field_name('s_email'); ?>" />
			   <label for="<?php echo $this->get_field_id('s_email'); ?>"> Subscribe via Email <span class="helper">(URL below)</label><br />
			   <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
        </p>

		<p>
               <input class="checkbox" type="checkbox" <?php checked($instance['s_twitter'], true) ?> id="<?php echo $this->get_field_id('s_twitter'); ?>" name="<?php echo $this->get_field_name('s_twitter'); ?>" />
			   <label for="<?php echo $this->get_field_id('s_twitter'); ?>"> Follow on Twitter <span class="helper">(username below, no @)</span> </label><br />
			   <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
        </p>

		<p>
               <input class="checkbox" type="checkbox" <?php checked($instance['s_facebook'], true) ?> id="<?php echo $this->get_field_id('s_facebook'); ?>" name="<?php echo $this->get_field_name('s_facebook'); ?>" />
			   <label for="<?php echo $this->get_field_id('s_facebook'); ?>"> Follow on Facebook <span class="helper">(URL below)</label><br />
			   <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
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
		$instance['s_email'] = isset($new_instance['s_email']) ? 1 : 0;
		$instance['s_rss'] = isset($new_instance['s_rss']) ? 1 : 0;
		$instance['s_twitter'] = isset($new_instance['s_twitter']) ? 1 : 0;
		$instance['s_facebook'] = isset($new_instance['s_facebook']) ? 1 : 0;
		$instance['rss'] = $new_instance['rss'];
		$instance['email'] = $new_instance['email'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
        $instance['display'] = $new_instance['display'];
        $instance['description']=$new_instance['description'];
		return $instance;
    }

}
?>