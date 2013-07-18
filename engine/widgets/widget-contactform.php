<?php
class DT_Contact extends WP_Widget {

	function DT_Contact(){
		$widget_ops = array( 'classname' => 'DT_Contact', 'description' => 'Show your contact form in any widget area' );
		$this->WP_Widget( 'dt_contact', 'DT - Contact Form', $widget_ops );
	}


    function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;


        $description = $instance['description'];

	    echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;

		if($description != "") {
			echo '<p>' . stripslashes($description) . '</p>';
		} else {
		}

			dt_contact_form_display();
        echo $after_widget;

	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => ''));
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
        <p class="helper">Your contact form details are configured from the <a href="<?php echo admin_url(); ?>admin.php?page=dt-options">theme options panel</a>.</p>

<?php
    }

    function update($new_instance, $old_instance) {
        $instance=$old_instance;
        $instance['title']=strip_tags($new_instance['title']);
        $instance['description']=$new_instance['description'];
        return $instance;

    }

}


?>