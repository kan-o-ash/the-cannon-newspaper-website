<?php
class DT_Author_Info extends WP_Widget {

	function DT_Author_Info(){
		$widget_ops = array( 'classname' => 'DT_Author_Info', 'description' => 'Show the post\'s author info on single post pages' );
		$this->WP_Widget( 'dt_author_info', 'DT - Post Author Info', $widget_ops);
	}



	function widget($args, $instance) {
		extract($args);

		if(!is_single()) return;

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;


		$show_gravatar= ($instance['show_gravatar'] == 1) ? true : false;
		$show_bio= ($instance['show_bio'] == 1) ? true : false;


		echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;

?>

	<div class="author-info cf">

		<?php if($show_gravatar) echo get_avatar( get_the_author_meta('email') , '60' ); ?>

		<span><?php echo stripslashes(get_option('dt_lang_gen_postedby')); ?> <?php the_author_posts_link(); ?></span>

		<?php if($show_bio):?>
			<p><?php the_author_meta('description'); ?></p>
		<?php endif; ?>

	</div><!-- .author-info -->
<?php

		echo $after_widget;

	}





	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'show_gravatar' => 1, 'show_bio' => 1) );

        $title= esc_attr($instance['title']);
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>

			<input class="checkbox" type="checkbox" <?php checked($instance['show_gravatar'], true) ?> id="<?php echo $this->get_field_id('show_gravatar'); ?>" name="<?php echo $this->get_field_name('show_gravatar'); ?>" />
			   <label for="<?php echo $this->get_field_id('show_gravatar'); ?>"> Show author's gravatar</label>
			 <br />
			<input class="checkbox" type="checkbox" <?php checked($instance['show_bio'], true) ?> id="<?php echo $this->get_field_id('show_bio'); ?>" name="<?php echo $this->get_field_name('show_bio'); ?>" />
			   <label for="<?php echo $this->get_field_id('show_bio'); ?>"> Show author's bio</label>
        </p>
<?php
	}



	function update($new_instance, $old_instance) {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
		$instance['show_gravatar'] = isset($new_instance['show_gravatar']) ? 1 : 0;
		$instance['show_bio'] = isset($new_instance['show_bio']) ? 1 : 0;
		return $instance;

    }

}

?>