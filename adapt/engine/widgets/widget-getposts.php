<?php
class DT_Get_Posts extends WP_Widget {

	function DT_Get_Posts(){
		$widget_ops = array( 'classname' => 'DT_Get_Posts', 'description' => 'Set criteria, display however you wish' );
		$this->WP_Widget( 'dt_getposts', 'DT - Get Posts', $widget_ops );
	}

	function widget($args, $instance) {

		/*Backup query string for later use*/
		global $query_string;
		$backup_query_string = $query_string;

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;

		$posttype=$instance['posttype'];
		$sort_by=$instance['sort_by'];

		$description = $instance['description'];

		$thumbnail = ($instance['thumbnail'] == 1) ? true : false;
		$posttitle = ($instance['posttitle'] == 1) ? true : false;
		$byline = ($instance['byline'] == 1) ? true : false;
		$excerpt = ($instance['excerpt'] == 1) ? true : false;
		$meta = ($instance['meta'] == 1) ? true : false;


		//Check if displaying only thumbs
		if ($thumbnail==true && $posttitle==false && $byline==false && $excerpt==false && $meta==false):
			$onlythumbs = 'onlythumbs';
		endif;

		$number = absint( $instance['number'] );

		$categories=(array) $instance['categories'];
		$tags=(array) $instance['tags'];
		$author=intval($instance['author']);

		echo $before_widget;
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;
		endif;

		if($description != "")
			echo '<p class="description">' . stripslashes($description) . '</p>';

		$args=array();

		//Number
		$args['posts_per_page'] = $number;


		//Post type
		if($posttype == "categories"):
			$args['category__in']=$categories;
		elseif($posttype == "tags"):
			$args['tag__in']=$tags;
		elseif($posttype == "author"):
			$args['author']=$author;
		endif;


		//Order by
		if($sort_by == "popular"):
			$args['orderby']= "comment_count";
		elseif($sort_by == "random"):
			$args['orderby']= "rand";
		else:
			$args['orderby']= "date";
		endif;


		$get_posts_query = new WP_Query($args);

		if($get_posts_query->have_posts()):
			echo '<ul class="cf">';

			while($get_posts_query->have_posts()): $get_posts_query->the_post();


		################################
		#  DISPLAY POST CONTENT START  #
		################################
?>

			<li class="cf">

			<?php if($thumbnail): ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php dt_image(60,60) ?></a>
			<?php endif; ?>

			<?php if($posttitle): ?>
				<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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

		###############################
		#   DISPLAY POST CONTENT END  #
		###############################

		endwhile;
			echo '</ul>';
		endif;

		echo $after_widget;

		/*Reset query to initial*/
		query_posts($backup_query_string);
		the_post();
	}


	function form($instance) {

        $title = esc_attr($instance['title']);

		$number = absint( $instance['number'] );

		$posttype = $instance['posttype'];

		$sort_by = $instance['sort_by'];
		//$display = $instance['display'];
		$description = $instance['description'];

		$categories=(array) $instance['categories'];
		$tags=(array) $instance['tags'];
		$author=$instance['author'];

		$is_cats=' style="display:none;"';
		$is_tags=' style="display:none;"';
		$is_author=' style="display:none;"';

		if($posttype=="categories")
			$is_cats='';
		if($posttype=="tags")
			$is_tags='';
		if($posttype=="author")
			$is_author='';

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
			<label for="<?php echo $this->get_field_id('posttype'); ?>">
				Post Type:
            </label>
			<select name="<?php echo $this->get_field_name('posttype'); ?>" id="<?php echo $this->get_field_id('about_page_id'); ?>" class="widefat dt-get-posts">
				<option value="anywhere"<?php selected( $posttype, 'anywhere' ); ?>>Any</option>
				<option value="categories"<?php selected( $posttype, 'categories' ); ?>>In category...</option>
				<option value="tags"<?php selected( $posttype, 'tags' ); ?>>Tagged with...</option>
				<option value="author"<?php selected( $posttype, 'author' ); ?>>By author...</option>
			</select>
		</p>

		<p id="dt_cats" class="dt-hide-it"<?php echo $is_cats; ?>>
			<label class="head">
				Select Categories:
            </label>
			<br />
		<?php
		$all_categories=get_categories('hide_empty=0&orderby=name');
		foreach ($all_categories as $cat ):
			$cat_id=intval($cat->cat_ID);
			$cat_name=$cat->cat_name;
			$selected='';
			if(in_array($cat_id, $categories))
				$selected=' checked="checked"';
		?>
			<input value="<?php echo $cat_id; ?>" class="checkbox" type="checkbox"<?php echo $selected; ?> id="<?php echo $this->get_field_id('categories'); echo $cat_id; ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" /> <label for="<?php echo $this->get_field_id('categories'); echo $cat_id; ?>"><?php echo $cat_name; ?></label> <br />
		<?php
		endforeach;
		?>

		</p>


		<p id="dt_tags" class="dt-hide-it"<?php echo $is_tags; ?>>
			<label class="head">
				Select Tags:
            </label>
			<br />
		<?php
		$all_tags=get_tags('hide_empty=0&orderby=name');
		foreach ($all_tags as $tag ):
			$tag_id=intval($tag->term_id);
			$tag_name=$tag->name;
			$selected='';
			if(in_array($tag_id, $tags))
				$selected=' checked="checked"';
		?>
			<input value="<?php echo $tag_id; ?>" class="checkbox" type="checkbox"<?php echo $selected; ?> id="<?php echo $this->get_field_id('tags'); echo $tag_id; ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" /> <label for="<?php echo $this->get_field_id('tags'); echo $tag_id; ?>"><?php echo $tag_name; ?></label> <br />
		<?php
		endforeach;
		?>

		</p>



		<p id="dt_author" class="dt-hide-it"<?php echo $is_author; ?>>
			<label class="head" for="<?php echo $this->get_field_id('author'); ?>">
				Select Author:
            </label>
			<select name="<?php echo $this->get_field_name('author'); ?>" id="<?php echo $this->get_field_id('author'); ?>" class="widefat">

			<?php
			$users = get_users();
			$author_ids = array();
	        foreach ( (array) $users as $user )
                $author_ids[] = $user->user_id;

			global $wpdb;

	        if ( count($author_ids) > 0  ) {
	                $author_ids = implode(',', $author_ids );
	                $authors = $wpdb->get_results( "SELECT ID, user_nicename from $wpdb->users WHERE ID IN($author_ids) ORDER BY display_name" );
	        }
			else {
	                $authors = array();
			}
			$author_count = array();

			foreach ( (array) $wpdb->get_results("SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type = 'post' AND " . get_private_posts_cap_sql( 'post' ) . " GROUP BY post_author") as $row )
	                $author_count[$row->post_author] = $row->count;

			foreach ( (array) $authors as $author ):
				$author_id=intval($author->ID);
				$author = get_userdata( $author->ID );
				$posts = (isset($author_count[$author->ID])) ? $author_count[$author->ID] : 0;
				if($posts==0)
					continue;
				$author_name=$author->display_name;
?>
				<option value="<?php echo $author_id; ?>"<?php selected( $instance['author'], $author_id ); ?>><?php echo $author_name; ?> (<?php echo $posts; ?> posts)</option>
<?php
			endforeach;
?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('sort_by'); ?>">
               Sort Posts by:
            </label>
			<select name="<?php echo $this->get_field_name('sort_by'); ?>" id="<?php echo $this->get_field_id('sort_by'); ?>" class="widefat">
				<option value="popular"<?php selected( $instance['sort_by'], 'popular' ); ?>>Most popular</option>
				<option value="recent"<?php selected( $instance['sort_by'], 'recent' ); ?>>Most recent</option>
				<option value="random"<?php selected( $instance['sort_by'], 'random' ); ?>>Random</option>
			</select>
		</p>

		<p>
			Display Options:<br />
			<input class="checkbox" type="checkbox" <?php checked($instance['thumbnail'], true) ?> id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" /><label for="<?php echo $this->get_field_id('thumbnail'); ?>"> Show thumbnails</label><br />
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
		$instance['posttype']  = $new_instance['posttype'];
		$instance['categories']  = (array)$new_instance['categories'];
		$instance['tags']  = (array)$new_instance['tags'];
		$instance['author']  = $new_instance['author'];
		$instance['sort_by'] = $new_instance['sort_by'];
		$instance['description'] = $new_instance['description'];
		$instance['thumbnail'] = isset($new_instance['thumbnail']) ? 1 : 0;
		$instance['posttitle'] = isset($new_instance['posttitle']) ? 1 : 0;
		$instance['byline'] = isset($new_instance['byline']) ? 1 : 0;
		$instance['excerpt'] = isset($new_instance['excerpt']) ? 1 : 0;
		$instance['meta'] = isset($new_instance['meta']) ? 1 : 0;
		$instance['number'] = absint($new_instance['number']);
        return $instance;
    }

}
?>