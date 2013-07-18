<?php
class DT_Ads_468x60 extends WP_Widget {

	function DT_Ads_468x60(){
		$widget_ops = array( 'classname' => 'DT_Ads_468x60', 'description' => 'Display 468x60 banner ads with rotate option' );
		$control_ops = array('width' => 350, 'height' => 350);
		$this->WP_Widget( 'dt_ads-468', 'DT - Ads 468x60', $widget_ops, $control_ops );
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

		for($i=0;$i<2;$i++):
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

		for($i=0;$i<2;$i++):
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
		$ad_image_0=esc_attr($instance['ad_image_0']);
		$ad_image_1=esc_attr($instance['ad_image_1']);
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


<?php
    }


	function update($new_instance, $old_instance) {
        $instance=$old_instance;


        $instance['title'] = strip_tags($new_instance['title']);
		$instance['do_rotate'] = isset($new_instance['do_rotate']) ? 1 : 0;
		$instance['do_newwindow'] = isset($new_instance['do_newwindow']) ? 1 : 0;

		for($i=0;$i<2;$i++):
			$instance['ad_image_'.$i] = $new_instance['ad_image_'.$i];
			$instance['ad_link_'.$i] = $new_instance['ad_link_'.$i];
		endfor;

		return $instance;

    }

}
?>
