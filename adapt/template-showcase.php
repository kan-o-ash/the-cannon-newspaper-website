<?php
/*
Template Name: Showcase
*/

get_header();
?>

	<!--BEGIN #content -->
    <div id="content">
    
    	<?php 
			
		$all_terms = get_terms( 'group', array('hide_empty' => 0 ) );
		
		$count = 1;
		
		query_posts(array(
			'post_type' => 'showcase',
			'posts_per_page' => -1
		)); 
		
		$total = $wp_query->post_count;
		
		?>
		
		<!-- BEGIN #archive-title -->
    	<div id="archive-title">
    		
			<div class="inner <?php if($all_terms) : foreach ($all_terms as $term) { echo 'term-'.$term->term_id.' '; } endif; ?>">
				
				<h1 id="page-title">
					<?php the_title(); ?>
					<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-ribbon.png" alt="" /></span>
				</h1>
				
				<ul id="filter" class="clearfix">
				
					<li class="active"><a href="#" data-filter="*"><?php _e('All', 'engine'); ?></a> (<?php echo $total; ?>)</li>
					<?php 
					wp_list_categories( array(
							'taxonomy' => 'group',
							'hide_empty' => 0,
							'title_li' => '',
							'depth' => 1,
							'walker' => new Group_Walker(),
							'show_count' => 1
						) 
					); 
					?> 
					
				</ul>
			</div>

    	</div>
    	<!-- END #archive-title -->
    	
    	<!--BEGIN #masonry -->	
		<div id="masonry">
						
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<?php $terms = get_the_terms( get_the_ID(), 'group' ); ?>
			
			<!--BEGIN .item -->	
			<div data-order='1' data-id="id-<?php echo $count; ?>" class="item normal <?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->term_id.' '; } endif; ?>">
			
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
					
					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
					<!--BEGIN .post-content -->
					<div class="post-content">
						
						<?php $format = get_post_format(); ?>
						<?php if ($format == "image" || $format == "gallery" || $format == "video") : ?>
						<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-<?php echo $format; ?>.png" alt="<?php echo $format; ?>" /></span>
						<?php endif; ?>
						
						<?php 
						if ( !empty( $post->post_excerpt ) ) {
							the_excerpt();
						}
						?>
						
					<!--END .post-content -->
					</div>
					
				<!--END .hentry-->  
				</div>
			
			<!--END .item -->	
			</div>
			<?php $count++; endwhile; endif; ?>
			
			<?php //get_template_part('includes/index-loadmore'); ?>
					
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