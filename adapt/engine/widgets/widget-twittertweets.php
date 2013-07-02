<?php

function dt_twitter_js($dt_twitter_username, $dt_twitter_postcount) {
        return '<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
		<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$dt_twitter_username.'.json?callback=twitterCallback2&amp;count='.$dt_twitter_postcount.'"></script>';
}


/* ==  Widget ==============================*/
class DT_Twitter extends WP_Widget {


/* ==  Widget Setup ==============================*/	

	function DT_Twitter() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'DT_Twitter', 'description' => __('A widget that displays your latest tweets.', 'engine') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'dt_tweet_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'dt_tweet_widget', __('DT - Latest Tweets', 'engine'), $widget_ops, $control_ops );
	}


/* ==  Display Widget ==============================*/

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		
		global $dt_twitter_username, $dt_twitter_postcount;
		
		$dt_twitter_username = $instance['username'];
		$dt_twitter_postcount = $instance['postcount'];
		$tweettext = $instance['tweettext'];
		
		function echo_tweets_js() {
			global $dt_twitter_username, $dt_twitter_postcount;
			echo dt_twitter_js($dt_twitter_username, $dt_twitter_postcount);
		}
		
		add_action('wp_footer', 'echo_tweets_js');

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Latest Tweets */
		 ?>

            <ul id="twitter_update_list" class="twitter clearfix">
                <li><p></p></li>
            </ul>
            
            <?php if($tweettext != '') : ?>
	            <div class="visit-wrap">
	            	<a target="_blank" href="http://twitter.com/<?php echo $dt_twitter_username; ?>" class="follow-me"><?php echo $tweettext; ?><span class="right-arrow"></span></a>
	            </div>
			<?php endif; ?>
         		
		<?php 

		/* After widget (defined by themes). */
		echo $after_widget;
	}



/* ==  Update Widget ==============================*/
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
		$instance['tweettext'] = strip_tags( $new_instance['tweettext'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	
	
	
/* ==  Widget Settings ==============================*/
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Latest Tweets',
		'username' => 'designerthemes',
		'postcount' => '1',
		'tweettext' => 'Follow on Twitter',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>


			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'engine') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username e.g. designerthemes', 'engine') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
		
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (max 20)', 'engine') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
		
		<!-- Tweettext: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Text e.g. Follow me on Twitter', 'engine') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
		</p>
		
	<?php
	}
}


?>