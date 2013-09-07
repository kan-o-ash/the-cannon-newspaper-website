<?php get_header(); ?>
	<?php 
		$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : 
		get_userdata(intval($author));
	?>
	<!--BEGIN #content -->
    <div id="content">
		<div id = "sidebar">
			<div id = "blog-sidebar" class = "widget-area">
				
			</div>
		</div>	
    	

    	<!--BEGIN #masonry -->	
		<div id="masonry">
			<!-- author info first -->	
			<div class="item normal" data-order='1'>
			
				<!--BEGIN .hentry -->
				<div  id="authorBlock">
					
					<div id = "author-info">
					<div id = "avatar-boundary" style = "padding-bottom:40px">
						<img class = "circleBase" id = "avatar"
							src = " <?php echo bloginfo('template_directory');?>/images/authors/<?php echo $curauth->first_name ?>-web.jpg"
						/>
					</div>
					<h2><?php echo $curauth->first_name.' '.$curauth->last_name; ?></h2>
					<h3><?php echo $curauth->aim; ?></h3>
					<h3><?php echo $curauth->yim; ?></h3>
					<p>
					<?php echo $curauth->description; ?>
					</p>

					</div>
				<!--END .hentry-->  
				</div>
			
			<!--END .item author info -->	
			</div>


			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!--BEGIN .item -->	
			<div class="item normal" data-order='1'>
			
				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<?php if ( has_post_thumbnail() ) : ?>
					<!--BEGIN .featured-image -->
					<div class="featured-image">
						<div class="da-hover">
							<span class="da-wrap"><a href="<?php the_permalink(); ?>">
								<span class="title"><?php the_title(); ?></span>
								<?php dt_overlay_icon(); ?></a>

							</span>
						</div>
						<a href="<?php the_permalink(); ?>"><?php dt_image(300, ''); ?></a>
					<!--END .featured-image -->
					</div>

					<?php endif; ?>
					
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
						
						<span class="meta-published"
							title="<?php 
									the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>">
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
			<?php endwhile; endif; ?>

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