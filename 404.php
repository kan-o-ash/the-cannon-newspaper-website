<?php get_header(); ?>

	<!--BEGIN #content -->
    <div id="content">
    	
		<!--BEGIN .hentry -->
		<div class="hentry item">
			
			<!--BEGIN .post-header-->
			<div class="post-header">
				<div class="inner">
					<h1 class="post-title"><?php _e('Error 404', 'engine'); ?></h1>
				</div>
			<!--END .post-header -->
			</div>
			
			<!--BEGIN .post-content -->
			<div class="post-content" style="padding-top: 0;">
			
				<p><?php _e('The page you are looking for cannot be found.', 'engine'); ?></p>
				
				<!-- .search-wrap -->
				<div class="search-wrap clearfix">
					<?php get_search_form(); ?>
				</div>
				<!-- /.search-wrap -->
				
				<p> &nbsp; </p>
				
				<?php echo do_shortcode('[sitemap]'); ?>
			<!--END .post-content -->
			</div>
			
		<!--END .hentry-->  
		</div>

	</div><!-- #content -->

<?php get_footer(); ?>