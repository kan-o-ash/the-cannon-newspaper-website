<?php get_header(); ?>

	<!--BEGIN #content -->
    <div id="content">
    	
    	<!-- BEGIN #archive-title -->
    	<div id="archive-title">
    		
			<div class="inner">
				<h1 id="page-title">
					<?php _e('Search Results for', 'engine') ?> "<?php echo $_GET['s']; ?>"
					<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-search.png" alt="" /></span>
				</h1>
				<div class="search-wrap clearfix"><?php get_search_form(); ?></div>
			</div>

    	</div>
    	<!-- END #archive-title -->
 	
    	<!--BEGIN #masonry -->	
		<div id="masonry">
					
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!--BEGIN .item -->	
			<div class="item normal" data-order='1'>
			
				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<?php if ( has_post_thumbnail() ) : ?>
					<!--BEGIN .featured-image -->
					<div class="featured-image">
						<div class="da-hover">
							<span class="da-wrap">
								<span class="title"><?php the_title(); ?></span>
								<?php dt_overlay_icon(); ?>
							</span>
						</div>
						<a href="<?php the_permalink(); ?>"><?php dt_image(300, ''); ?></a>
					<!--END .featured-image -->
					</div>
					<?php endif; ?>
					
					<?php $format = get_post_format(); ?>
					
					<span class="meta-category"><?php the_category(', '); ?></span>
					
					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
					<!--BEGIN .post-content -->
					<div class="post-content">
						
						<?php $format = get_post_format(); ?>
						<?php if ($format == "image" || $format == "gallery" || $format == "video") : ?>
						<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-<?php echo $format; ?>.png" alt="<?php echo $format; ?>" /></span>
						<?php endif; ?>
						
						<?php dt_excerpt(20); ?>
						
					<!--END .post-content -->
					</div>
					
					<a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'engine'); ?></a>
					
					<!--BEGIN .post-footer -->
					<div class="post-footer">
						
						<!--<span class="meta-published"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' '.  __('ago', 'engine'); ?></span>
						
						<span class="meta-comments"><?php comments_number(__('No Comments', 'engine'), __('1 Comment', 'engine'), __('% Comments', 'engine')); ?></span>-->
						<span class="meta-published"
							title="<?php 
									the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>">
							<!--<?php _e('Posted', 'engine') ?> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' '.  __('ago', 'engine'); ?>-->
							<?php 
								$cur_time = current_time('timestamp');
								$post_time = get_the_time('U');
								if ($cur_time-$post_time >259200) the_time('F j, Y');
								else echo human_time_diff($post_time, $cur_time) . " ago ";
							 ?>
						</span>					
					</div>
					<!--END .post-footer -->
	
				<!--END .hentry-->  
				</div>
			
			<!--END .item -->	
			</div>
			<?php endwhile; else: ?>
				
				<div class="item none">
					<div class="hentry">
						<p><?php _e('No posts were found.', 'engine'); ?></p>
					</div>
				</div>
								
			<?php endif; ?>
			
			<?php get_template_part('includes/index-loadmore'); ?>
					
		<!--END #masonry -->
		</div>
		
		<div id="masonry-new"></div>
		
		<!--BEGIN .post-navigation -->
		<div class="post-navigation clearfix">
			<?php dt_pagination(); ?>
		<!--END .post-navigation -->
		</div>

	</div><!-- #content -->

<?php get_footer(); ?>