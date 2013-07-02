<?php
class DT_Related_Posts extends WP_Widget {

	function DT_Related_Posts(){
		$widget_ops = array( 'classname' => 'DT_Related_Posts', 'description' => 'Show related posts on single post pages' );
		$this->WP_Widget( 'dt_related', 'DT - Similar/Related Posts', $widget_ops );
	}

	function widget($args, $instance) {


		/*Backup query string for later use*/
		global $query_string;
		$backup_query_string = $query_string;


		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;
		$related_type= $instance['related_type'];

		$description = $instance['description'];
		$thumbnail = ($instance['thumbnail'] == 1) ? true : false;
		$posttitle = ($instance['posttitle'] == 1) ? true : false;
		$byline = ($instance['byline'] == 1) ? true : false;
		$excerpt = ($instance['excerpt'] == 1) ? true : false;
		$meta = ($instance['meta'] == 1) ? true : false;

		$number = intval( $instance['number'] );



		global $wp_query;
		global $post;
		$curr_id = $post->ID;


		if(!is_single())
			return;

		 echo $before_widget;
         if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;


		if($description != "")
			echo '<p>' . stripslashes($description) . '</p>';

		$count=0;

		if($related_type == "category"):

			$categories = get_the_category();
			$catlist = array();
			foreach ($categories as $category) :
				$catlist[] = $category->cat_ID;
			endforeach;

			$args=array(
				'posts_per_page' => $number,
				'category__in'   => $catlist,
				'post__not_in'   => array($curr_id)
			);

			$related_query = new WP_Query($args);


			if($related_query->have_posts()):
			echo '<ul>';

			while($related_query->have_posts()): $related_query->the_post();

?>
			<li class="cf">

			<?php if($thumbnail): ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php dt_image(60,60) ?></a>
			<?php endif; ?>

			<?php if($posttitle): ?>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<?php if($byline): ?>
			<!--BEGIN .post-meta .post-header-->
			<div class="post-meta post-header">
			
				<span class="meta-author"><?php _e('Posted by', 'engine') ?> <?php the_author_posts_link(); ?></span>
				<span class="meta-published"><?php _e('on', 'engine') ?> <?php the_time( get_option('date_format') ); ?></span>																
				
			<!--END .post-meta post-header -->
			</div>
			<?php endif; ?>


			<?php if($excerpt): ?>
				<?php dt_excerpt(25); ?>
			<?php endif; ?>

			<?php if($meta): ?>
			<!--BEGIN .post-meta .post-footer-->
			<div class="post-meta post-footer">
			
				<span class="meta-categories"><?php _e('Posted in', 'engine') ?> <?php the_category(', ') ?></span>
                <span class="meta-comment"><?php comments_popup_link(__('No Comments', 'engine'), __('1 Comment', 'engine'), __('% Comments', 'engine')); ?> </span>
                
			<!--END .post-meta .post-footer-->
			</div>
			<?php endif; ?>

			</li>

<?php
			endwhile;
				echo '</ul>';
			endif;



		##END CATEGORIES##


		elseif($related_type == "tags"):
			$tags = get_the_tags();
			if(!$tags):
				echo '<p>No related posts</p>';
				echo $after_widget;
				return;
			endif;
			$taglist = array();
			foreach ($tags as $tag) :
				$taglist[] = $tag->term_id ;
			endforeach;

			$args=array(
				'posts_per_page' => $number,
				'tag__in'   => $taglist,
				'post__not_in'   => array($curr_id)
			);

			$related_query = new WP_Query($args);


			if($related_query->have_posts()):
			echo '<ul>';

			while($related_query->have_posts()): $related_query->the_post();

?>

			<li class="cf">

			<?php if($thumbnail): ?>
				<?php dt_image(60,60) ?>
			<?php endif; ?>

			<?php if($posttitle): ?>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<?php if($byline): ?>
			<!--BEGIN .post-meta .post-header-->
			<div class="post-meta post-header">
			
				<span class="meta-author"><?php _e('Posted by', 'engine') ?> <?php the_author_posts_link(); ?></span>
				<span class="meta-published"><?php _e('on', 'engine') ?> <?php the_time( get_option('date_format') ); ?></span>																
				
			<!--END .post-meta post-header -->
			</div>
			<?php endif; ?>

			<?php if($excerpt): ?>
				<?php dt_excerpt('25'); ?>
			<?php endif; ?>

			<?php if($meta): ?>
			<!--BEGIN .post-meta .post-footer-->
			<div class="post-meta post-footer">
			
				<span class="meta-categories"><?php _e('Posted in', 'engine') ?> <?php the_category(', ') ?></span>
                <span class="meta-comment"><?php comments_popup_link(__('No Comments', 'engine'), __('1 Comment', 'engine'), __('% Comments', 'engine')); ?> </span>
                
			<!--END .post-meta .post-footer-->
			</div>
			<?php endif; ?>

			</li>


<?php
			endwhile;
				echo '</ul>';
			endif;





		##END TAGS##

		else:

			$the_author=$wp_query->post->post_author;
			$args=array(
					'posts_per_page' => $number,
					'author' => $the_author,
					'post__not_in'   => array($curr_id)
				);
			$related_query = new WP_Query($args);


			if($related_query->have_posts()):
			echo '<ul>';

			while($related_query->have_posts()): $related_query->the_post();

?>
			<li class="cf">

			<?php if($thumbnail): ?>
				<?php dt_image(60,60) ?>
			<?php endif; ?>

			<?php if($posttitle): ?>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<?php if($byline): ?>
			<!--BEGIN .post-meta .post-header-->
			<div class="post-meta post-header">
			
				<span class="meta-author"><?php _e('Posted by', 'engine') ?> <?php the_author_posts_link(); ?></span>
				<span class="meta-published"><?php _e('on', 'engine') ?> <?php the_time( get_option('date_format') ); ?></span>																
				
			<!--END .post-meta post-header -->
			</div>

			<?php endif; ?>

			<?php if($excerpt): ?>
				<?php dt_excerpt('25'); ?>
			<?php endif; ?>

			<?php if($meta): ?>
			<!--BEGIN .post-meta .post-footer-->
			<div class="post-meta post-footer">
			
				<span class="meta-categories"><?php _e('Posted in', 'engine') ?> <?php the_category(', ') ?></span>
                <span class="meta-comment"><?php comments_popup_link(__('No Comments', 'engine'), __('1 Comment', 'engine'), __('% Comments', 'engine')); ?> </span>
                
			<!--END .post-meta .post-footer-->
			</div>
			<?php endif; ?>

			</li>

<?php
			endwhile;
				echo '</ul>';
			endif;



		endif;

		##END AUTHOR##



		echo $after_widget;

		/*Reset query to initial*/
		query_posts($backup_query_string);
		the_post();

	}



	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array('title' => '', 'related_type' => 'category', 'number' => '5',  'thumbnail' => 1) );

        $title= esc_attr($instance['title']);
		$related_type= $instance['related_type'];

		$description = $instance['description'];
		$thumbnail = ($instance['thumbnail'] == 1) ? true : false;
		$posttitle = ($instance['posttitle'] == 1) ? true : false;
		$byline = ($instance['byline'] == 1) ? true : false;
		$excerpt = ($instance['excerpt'] == 1) ? true : false;
		$meta = ($instance['meta'] == 1) ? true : false;

		$number = intval( $instance['number'] );
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
			<label for="<?php echo $this->get_field_id('related_type'); ?>">
				Post Type:
            </label>
			<select name="<?php echo $this->get_field_name('related_type'); ?>" id="<?php echo $this->get_field_id('related_type'); ?>" class="widefat">
				<option value="category"<?php selected( $instance['related_type'], 'category' ); ?>>In same categories</option>
				<option value="tags"<?php selected( $instance['related_type'], 'tags' ); ?>>With same tags</option>
				<option value="author"<?php selected( $instance['related_type'], 'author' ); ?>>By same author</option>
			</select>
		</p>

		<p>
			Display Options:<br />
			<input class="checkbox" type="checkbox" <?php checked($instance['thumbnail'], true) ?> id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" /><label for="<?php echo $this->get_field_id('thumbnail'); ?>"> Show thumbnails </label><br />
			<input class="checkbox" type="checkbox" <?php checked($instance['posttitle'], true) ?> id="<?php echo $this->get_field_id('posttitle'); ?>" name="<?php echo $this->get_field_name('posttitle'); ?>" /><label for="<?php echo $this->get_field_id('posttitle'); ?>"> Show titles</label><br />
			<input class="checkbox" type="checkbox" <?php checked($instance['byline'], true) ?> id="<?php echo $this->get_field_id('byline'); ?>" name="<?php echo $this->get_field_name('byline'); ?>" /><label for="<?php echo $this->get_field_id('byline'); ?>"> Show bylines</label><br />
			<input class="checkbox" type="checkbox" <?php checked($instance['excerpt'], true) ?> id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>" /><label for="<?php echo $this->get_field_id('excerpt'); ?>"> Show excerpts</label><br />
			<input class="checkbox" type="checkbox" <?php checked($instance['meta'], true) ?> id="<?php echo $this->get_field_id('meta'); ?>" name="<?php echo $this->get_field_name('meta'); ?>" /><label for="<?php echo $this->get_field_id('meta'); ?>"> Show meta data</label><br />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
				Number of Posts:
            </label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>


<?php

	}



	function update($new_instance, $old_instance) {
        $instance=$old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['related_type'] = $new_instance['related_type'];
		$instance['description'] = $new_instance['description'];
		$instance['thumbnail'] = isset($new_instance['thumbnail']) ? 1 : 0;
		$instance['posttitle'] = isset($new_instance['posttitle']) ? 1 : 0;
		$instance['byline'] = isset($new_instance['byline']) ? 1 : 0;
		$instance['excerpt'] = isset($new_instance['excerpt']) ? 1 : 0;
		$instance['meta'] = isset($new_instance['meta']) ? 1 : 0;
		$instance['number'] = $new_instance['number'];
		return $instance;

    }

}
?>