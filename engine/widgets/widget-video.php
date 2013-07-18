<?php
class dt_video_widget extends WP_Widget {

	
function DT_Video_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'dt_video_widget',
		'description' => __('A widget that displays your YouTube or Vimeo Video.', 'engine')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'dt_video_widget'
	);

	/* Create the widget. */
	$this->WP_Widget( 'dt_video_widget', __('DT - Video Widget', 'engine'), $widget_ops, $control_ops );
	
}

	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$embed = $instance['embed'];
	$desc = $instance['desc'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>
		
		<div class="dt_video">
		<?php echo $embed ?>
		</div>
		<?php if($desc != '') : ?>
		<p class="dt_video_desc"><?php echo $desc ?></p>
        <?php endif; ?>
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['desc'] = stripslashes( $new_instance['desc']);
	$instance['embed'] = stripslashes( $new_instance['embed']);

	// No need to strip tags

	return $instance;
}

	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'My Video',
		'embed' => stripslashes( '<object type="application/x-shockwave-flash" style="width:275px; height:213px;" data="http://vimeo.com/moogaloop.swf?clip_id=2285902&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1">
	<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=2285902&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" />
	</object>'),
		'desc' => 'This is my latest video, pretty cool huh!',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'engine') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Embed Code: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Embed Code:', 'engine') ?></label>
		<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
	</p>
	
	<!-- Description: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'engine') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>