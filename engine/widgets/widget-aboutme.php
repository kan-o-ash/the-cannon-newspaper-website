<?php

class DT_About_Me extends WP_Widget {

	function DT_About_Me(){
		$widget_ops = array( 'classname' => 'DT_About_Me', 'description' => 'Show a photo, short bio and a link to your About Me page' );
		$control_ops = array('width' => 350, 'height' => 350);
		$this->WP_Widget( 'dt_about', 'DT - About Me', $widget_ops, $control_ops );
	}


	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

		$photo_url= stripslashes($instance['photo_url']);
		$short_bio= stripslashes($instance['short_bio']);
		$about_page_id= intval($instance['about_page_id']);

		if($about_page_id != -1):
			$about_page=get_page($about_page_id);

			$about_page_name=$about_page->post_title;
			$about_page_url=get_page_link($about_page_id);
		endif;
		echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;

?>

		<?php if($photo_url): ?>
		<img src="<?php echo $photo_url; ?>" class="about-me-image" alt="Me" />
		<?php endif; ?>

		<div class="bio">
			<?php echo $short_bio; ?>

			<?php if($about_page_id != -1): ?>
			<a class="about-me-link" href="<?php echo $about_page_url; ?>">More</a>
			<?php endif; ?>
		</div>

<?php
		echo $after_widget;

	}






	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array('title' => '', 'photo_url' => '', 'short_bio' => '',  'about_page_id' => -1) );

        $title= esc_attr($instance['title']);
		$photo_url= $instance['photo_url'];
		$short_bio= $instance['short_bio'];
		$about_page_id= intval($instance['about_page_id']);
?>

		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('photo_url'); ?>">
               Photo URL:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('photo_url'); ?>" name="<?php echo $this->get_field_name('photo_url'); ?>" type="text" value="<?php echo $photo_url; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('short_bio'); ?>">
               Short Bio:
            </label>
                <textarea rows="5" cols="20" class="widefat" id="<?php echo $this->get_field_id('short_bio'); ?>" name="<?php echo $this->get_field_name('short_bio'); ?>"><?php echo $short_bio; ?></textarea>
        </p>

		<p>
			<label for="<?php echo $this->get_field_id('about_page_id'); ?>">
               Include a "More" About Me Link:
            </label>
			<select name="<?php echo $this->get_field_name('about_page_id'); ?>" id="<?php echo $this->get_field_id('about_page_id'); ?>" class="widefat">
				<option value="-1"<?php selected( $instance['about_page_id'], -1 ); ?>>Select Page...</option>
<?php
		$pages=get_pages();
		foreach($pages as $page):
?>
				<option value="<?php echo $page->ID; ?>"<?php selected( $instance['about_page_id'], $page->ID ); ?>><?php echo $page->post_title; ?></option>
<?php
		endforeach;
?>
			</select>
		</p>

<?php
	}



	function update($new_instance, $old_instance) {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
		$instance['photo_url'] = $new_instance['photo_url'];
		$instance['short_bio'] = $new_instance['short_bio'];
		$instance['about_page_id']  = intval($new_instance['about_page_id']);
        return $instance;

    }

}
?>