<?php

// Widget class
class dt_blog_widget extends WP_Widget {

	
function dt_blog_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'dt_blog_widget',
		'description' => __('A widget that displays your recent posts.', 'engine')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'dt_blog_widget'
	);

	/* Create the widget. */
	$this->WP_Widget( 'dt_blog_widget', __('DT - Blog Widgets', 'engine'), $widget_ops, $control_ops );
	
}

	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$number = $instance['number'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;
		
	if($number == '')
		$number = 5;
		 
	// Display video widget
	?>
	
		<?php $query = new WP_Query(array('posts_per_page' => $number )); ?>
		
		<ul class="dt_blog">
		
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
			<li class="clearfix"><span><?php the_time( get_option('date_format') ); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; endif; ?>
			
		</ul>
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}

	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['number'] = stripslashes( $new_instance['number']);

	// No need to strip tags

	return $instance;
}

	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'From the Blog',
		'number' => '5'
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'engine') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<!-- Number: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Amount to display:', 'engine') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['number'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>