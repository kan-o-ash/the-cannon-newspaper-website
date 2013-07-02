<?php
class DT_Flickr extends WP_Widget {

	function DT_Flickr(){
		$widget_ops = array( 'classname' => 'DT_Flickr', 'description' => 'Show off some of your latest Flickr photos' );
		$this->WP_Widget( 'dt_flickr', 'DT - Flickr', $widget_ops);
	}



	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

        $flickr_id = $instance['flickr_id'];
		$number = absint( $instance['number'] );


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


<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>

<?php
		echo $after_widget;

	}



	function form($instance) {
		$default_flickr=stripslashes(get_option('dt_flickr_id'));

		if(!$default_flickr)
			$default_flickr='';

		$instance = wp_parse_args( (array) $instance, array('title' => '', 'number' => 5, 'flickr_id' => $default_flickr) );

        $title = esc_attr($instance['title']);
        $flickr_id = $instance['flickr_id'];
		$number = absint($instance['number']);
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
            <label for="<?php echo $this->get_field_id('flickr_id'); ?>">
               Flickr ID:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" />
                <br /><span class="helper">Look-up your ID here, <a href="http://idgettr.com" target="_blank">idGettr</a>.</span>
        </p>

		<p>

		<p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
               Number of Photos:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
                <br /><span class="helper">Up to 10 photos allowed.</span>
        </p>


<?php
    }




	function update($new_instance, $old_instance) {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['flickr_id']=$new_instance['flickr_id'];
        $instance['number']=$new_instance['number'];
        $instance['description']=$new_instance['description'];
        return $instance;

    }

}

?>