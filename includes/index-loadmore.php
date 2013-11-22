<?php 
global $wp_query;
$found_posts = $wp_query->found_posts;
$per_page = get_option('posts_per_page');
$post_count = $found_posts - $per_page;

if($found_posts > $per_page) :
?>

<!--BEGIN #load-more.item -->	
<div class="item" id="load-more" data-order='999'>

	<a id="load-more-link" href="#">
		
		<span id="detail-holder">
			<div class="count-text"><span class="count"><?php echo $post_count; ?></span> posts remaining</div>
			<div id="loader" data-perpage="<?php echo $per_page; ?>"></div>
			<div class="load-more-text"><?php _e('Load More', 'engine'); ?></div>
		</span>
	</a>
	
<!--END #load-more.item -->	
</div> 	

<?php endif; ?>
