<?php get_header(); ?>

	<!--BEGIN #content -->
    <div id="content">	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<!-- #hentry-wrap -->
		<div id="hentry-wrap">
			
			<!--BEGIN .hentry -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				
				<!--BEGIN .post-header-->
				<div class="post-header">
					<div class="inner">
						<h1 class="post-title"><?php the_title(); ?></h1>
					</div>
				<!--END .post-header -->
				</div>
					
				<!--BEGIN .post-content -->
				<div class="post-content">
					<?php
						$content = get_the_content();
						if (empty($content)) {
							$children = wp_list_pages('title_li=&depth=1&child_of='.$post->ID.'&echo=0&sort_column=menu_order');
							if ($children) { ?>
								<ul id="childpages">
								<?php echo $children; ?>
								</ul>
							<?php }
						}
						else the_content();
					?>
					<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'engine'), 'after' => '</p></nav>' )); ?>
				<!--END .post-content -->
				</div>
		        
			<!--END .hentry-->  
			</div>
		
			
	
			<?php endwhile; else : ?>
	
			<p><?php _e('No posts found', 'engine'); ?></p>
	
			<?php endif; ?>

		</div>
		<!-- /#hentry-wrap -->
		
	</div><!-- #content -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>