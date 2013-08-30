<?php get_header(); ?>

	<!--BEGIN #content -->
    <div id="content">
    	
		<!--BEGIN .hentry -->
		<div class="hentry item">
			
			<!--BEGIN .post-header-->
			<div class="post-header" id = "round404">
				<div class="inner">
					<h1 class="post-title" id = "err404"><?php _e('404', 'engine'); ?></h1>
				</div>
			<!--END .post-header -->
			</div>
			
			<!--BEGIN .post-content -->
			<div class="post-content">
						
				<!-- .search-wrap -->
				<div class="search-wrap clearfix">
					<?php echo custom_search_form('Sorry, the page was not found. Search for another'); ?>
				</div>
				<!-- /.search-wrap -->
			<!--END .post-content -->
			</div>
			
		<!--END .hentry-->  
		</div>

	</div><!-- #content -->

<?php get_footer(); ?>