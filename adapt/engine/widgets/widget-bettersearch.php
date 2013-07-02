<?php

class DT_Search extends WP_Widget {

	function DT_Search() {
		$widget_ops = array( 'classname' => 'DT_Search', 'description' =>  'Enjoy complete control over your search form using this widget.' );
		$this->WP_Widget( "dt_search", 'DT - Search', $widget_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

		$search_text = $instance['search_text'];
		$search_submit = $instance['search_submit'];

		echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;


			global $search_form_num;

			if ( !$search_form_num )
				$search_num = false;
			else
				$search_num = $search_form_num;

			if ( is_search() )
				$search_text = esc_attr( get_search_query() );

			$search = '<form method="get" class="search-form" id="searchform-' . $search_num . '" action="' . home_url() . '/">';
			$search .= '<div>';

			if ( $search_submit )
				$search .= '<input class="field" type="text" name="s" id="s-' . $search_num . '" value="' . $search_text . '" onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;" /> <input class="submit" name="searchsubmit" type="submit" value="' . $search_submit . '" />';
			else
				$search .= '<input class="field" type="text" class="dt-submit" name="s" id="s-' . $search_num . '" value="' . $search_text . '" onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;" />';

			$search .= '</div>';
			$search .= '</form><!-- end #searchform-' . $search_num . '" -->';

			echo $search;

			$search_form_num++;

		echo $after_widget;
	}


	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' =>  '', 'search_text' => 'Search...', 'search_submit' => 'Submit') );
?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br />
			<input style="width:100%" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'search_text' ); ?>">Search box text:</label><br />
			<input style="width:100%" type="text" id="<?php echo $this->get_field_id( 'search_text' ); ?>" name="<?php echo $this->get_field_name( 'search_text' ); ?>" value="<?php echo $instance['search_text']; ?>" />
			<br /><span class="helper">Leave field blank to disable.</span>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'search_submit' ); ?>">Submit button:</label><br />
			<input style="width:100%" type="text" id="<?php echo $this->get_field_id( 'search_submit' ); ?>" name="<?php echo $this->get_field_name( 'search_submit' ); ?>" value="<?php echo $instance['search_submit']; ?>" />
			<br /><span class="helper">Leave field blank to disable.</span>
		</p>


	<?php
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['search_label'] = strip_tags( $new_instance['search_label'] );
		$instance['search_text'] = strip_tags( $new_instance['search_text'] );
		$instance['search_submit'] = strip_tags( $new_instance['search_submit'] );
		$instance['theme_search'] = ( isset( $new_instance['theme_search'] ) ? 1 : 0 );

		return $instance;
	}

}

?>