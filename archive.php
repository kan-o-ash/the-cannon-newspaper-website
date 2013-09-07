<?php get_header(); ?>

	<!--BEGIN #content -->
    <div id="content">
    	
    	<?php if (!is_author()) : ?>
    		<!-- BEGIN #archive-title -->
	    	<div id="archive-title">
	    		
				<div class="inner">
					
					<?php 
					// Get author data 
					if(get_query_var('author_name')) :
						$curauth = get_userdatabylogin(get_query_var('author_name'));
					else :
						$curauth = get_userdata(get_query_var('author'));
					endif;
					?>	
			 	  	
			 	  	<?php if (is_category()) : ?>
						<h1 id="page-title">
							<?php echo single_cat_title(); ?>
							<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-ribbon.png" alt="" /></span>
						</h1>
						<?php
							$cat_desc = category_description();
							if ($cat_desc != '') echo '<div class="cat-desc">'.category_description().'</div>';
						?>
						
			 	  	<?php elseif( is_tag() ) : ?>
						<h1 id="page-title"><?php echo single_tag_title(); ?></h1>
						
			 	  	<?php elseif (is_day()) : ?>
						<h1 id="page-title"><?php the_time('F jS, Y'); ?></h1>
						
			 	 	<?php elseif (is_month()) : ?>
						<h1 id="page-title"><?php the_time('F, Y'); ?></h1>
						
			 		<?php elseif (is_year()) : ?>
						<h1 id="page-title"><?php the_time('Y'); ?></h1>
						
			 	  	<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
						<h1 id="page-title"><?php _e('Blog Archives', 'engine') ?></h1>
						
					<?php elseif (is_search()) : ?>
						<h1 id="page-title">
							<?php _e('Search Results', 'engine') ?> <?php echo $_GET['s']; ?>
							<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-search.png" alt="" /></span>
							<div class="search-wrap clearfix"><?php get_search_form(); ?></div>
						</h1>
						
					<?php endif; ?>

				</div>
			<?php endif; ?>
	    	</div>
    	<!-- END #archive-title -->
    	
		<?php /* get_sidebar();*/ ?>
 	
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