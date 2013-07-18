<?php

class DT_Ads_125x125 extends WP_Widget {

	function DT_Ads_125x125(){
		$widget_ops = array( 'classname' => 'DT_Ads_125x125', 'description' => 'Display 125x125 banner ads with rotate option' );
		$control_ops = array('width' => 350, 'height' => 350);
		$this->WP_Widget( 'dt_ads-125', 'DT - Ads 125x125', $widget_ops, $control_ops );
	}



	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

		$do_rotate= ($instance['do_rotate'] == 1) ? true : false;
		$do_newwindow= ($instance['do_newwindow'] == 1) ? true : false;

		$target='';

		if($do_newwindow)
			$target='target="_blank"';

		$ad_images=array();
		$ad_links=array();

		for($i=0;$i<8;$i++):
			$ad_images[$i] = $instance['ad_image_'.$i];
			$ad_links[$i] = $instance['ad_link_'.$i];
		endfor;




		echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;


		$div_class='ads-inside cf';
		if($do_rotate)
			$div_class .= ' random';
?>
	<div class="<?php echo $div_class; ?>">

<?php
		for($i=0;$i<8;$i++):
			if($ad_images[$i] != ""):
?>

			<a href="<?php echo stripslashes($ad_links[$i]); ?>" rel="nofollow" <?php echo $target; ?>><img src="<?php echo stripslashes($ad_images[$i]); ?>" alt="ad" /></a>

<?php
			endif;
		endfor;
?>
	</div>

<?php
		echo $after_widget;



	}



	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'do_rotate' => 1, 'do_newwindow' => 1) );

        $title = esc_attr($instance['title']);

		$ad_link_0=esc_attr($instance['ad_link_0']);
		$ad_link_1=esc_attr($instance['ad_link_1']);
		$ad_link_2=esc_attr($instance['ad_link_2']);
		$ad_link_3=esc_attr($instance['ad_link_3']);
		$ad_link_4=esc_attr($instance['ad_link_4']);
		$ad_link_5=esc_attr($instance['ad_link_5']);
		$ad_link_6=esc_attr($instance['ad_link_6']);
		$ad_link_7=esc_attr($instance['ad_link_7']);
		$ad_image_0=esc_attr($instance['ad_image_0']);
		$ad_image_1=esc_attr($instance['ad_image_1']);
		$ad_image_2=esc_attr($instance['ad_image_2']);
		$ad_image_3=esc_attr($instance['ad_image_3']);
		$ad_image_4=esc_attr($instance['ad_image_4']);
		$ad_image_5=esc_attr($instance['ad_image_5']);
		$ad_image_6=esc_attr($instance['ad_image_6']);
		$ad_image_7=esc_attr($instance['ad_image_7']);
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>
           <input class="checkbox" type="checkbox" <?php checked($instance['do_rotate'], true) ?> id="<?php echo $this->get_field_id('do_rotate'); ?>" name="<?php echo $this->get_field_name('do_rotate'); ?>" />
		   <label for="<?php echo $this->get_field_id('do_rotate'); ?>"> Randomly rotate order of banner ads </label>
		   <br />
		   <input class="checkbox" type="checkbox" <?php checked($instance['do_newwindow'], true) ?> id="<?php echo $this->get_field_id('do_newwindow'); ?>" name="<?php echo $this->get_field_name('do_newwindow'); ?>" />
		   <label for="<?php echo $this->get_field_id('do_rotate'); ?>"> Open links in a new window </label>
        </p>

        <p class="helper">Image URL in the first field, link in the second.</p>

		<p>
			Banner Ad #1:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_0'); ?>" name="<?php echo $this->get_field_name('ad_image_0'); ?>" type="text" value="<?php echo $ad_image_0; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_0'); ?>" name="<?php echo $this->get_field_name('ad_link_0'); ?>" type="text" value="<?php echo $ad_link_0; ?>" />
        </p>

		<p>
			Banner Ad #2:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_1'); ?>" name="<?php echo $this->get_field_name('ad_image_1'); ?>" type="text" value="<?php echo $ad_image_1; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_1'); ?>" name="<?php echo $this->get_field_name('ad_link_1'); ?>" type="text" value="<?php echo $ad_link_1; ?>" />
        </p>

		<p>
			Banner Ad #3:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_2'); ?>" name="<?php echo $this->get_field_name('ad_image_2'); ?>" type="text" value="<?php echo $ad_image_2; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_2'); ?>" name="<?php echo $this->get_field_name('ad_link_2'); ?>" type="text" value="<?php echo $ad_link_2; ?>" />
        </p>

		<p>
			Banner Ad #4:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_3'); ?>" name="<?php echo $this->get_field_name('ad_image_3'); ?>" type="text" value="<?php echo $ad_image_3; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_3'); ?>" name="<?php echo $this->get_field_name('ad_link_3'); ?>" type="text" value="<?php echo $ad_link_3; ?>" />
        </p>

		<p>
			Banner Ad #5:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_4'); ?>" name="<?php echo $this->get_field_name('ad_image_4'); ?>" type="text" value="<?php echo $ad_image_4; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_4'); ?>" name="<?php echo $this->get_field_name('ad_link_4'); ?>" type="text" value="<?php echo $ad_link_4; ?>" />
        </p>

		<p>
			Banner Ad #6:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_5'); ?>" name="<?php echo $this->get_field_name('ad_image_5'); ?>" type="text" value="<?php echo $ad_image_5; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_5'); ?>" name="<?php echo $this->get_field_name('ad_link_5'); ?>" type="text" value="<?php echo $ad_link_5; ?>" />
        </p>

		<p>
			Banner Ad #7:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_6'); ?>" name="<?php echo $this->get_field_name('ad_image_6'); ?>" type="text" value="<?php echo $ad_image_6; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_6'); ?>" name="<?php echo $this->get_field_name('ad_link_6'); ?>" type="text" value="<?php echo $ad_link_6; ?>" />
        </p>

		<p>
			Banner Ad #8:
            <input class="widefat" id="<?php echo $this->get_field_id('ad_image_7'); ?>" name="<?php echo $this->get_field_name('ad_image_7'); ?>" type="text" value="<?php echo $ad_image_7; ?>" />
            <br />
			<input class="widefat" id="<?php echo $this->get_field_id('ad_link_7'); ?>" name="<?php echo $this->get_field_name('ad_link_7'); ?>" type="text" value="<?php echo $ad_link_7; ?>" />
        </p>

<?php
    }




	function update($new_instance, $old_instance) {
        $instance=$old_instance;


        $instance['title'] = strip_tags($new_instance['title']);
		$instance['do_rotate'] = isset($new_instance['do_rotate']) ? 1 : 0;
		$instance['do_newwindow'] = isset($new_instance['do_newwindow']) ? 1 : 0;

		for($i=0;$i<8;$i++):
			$instance['ad_image_'.$i] = $new_instance['ad_image_'.$i];
			$instance['ad_link_'.$i] = $new_instance['ad_link_'.$i];
		endfor;

		return $instance;

    }

}
?>