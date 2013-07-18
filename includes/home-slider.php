<!--BEGIN .featured -->
<div class="featured clearfix" data-order="0">

	<?php

		$slider_enabled = get_option('dt_slider', 'true');
		$slider_type = get_option('dt_posts_from', 'categories'); //categories, tags or any
		$slider_order = get_option('dt_slider_order', 'comment_count'); //comment_count, date or rand
		$slider_number = get_option('dt_slider_number', '6'); //number of slides

		$slider_auto = get_option('dt_slider_auto'); //auto slide

		$dt_slider_head = get_option('dt_slider_head', 'Featured');

		if($slider_auto == '') {
			$slider_auto = 0;
		}

		$args = array();
		
		$format = get_post_format();

		//Post type
		if($slider_type == "categories"):
			$categories = get_option('dt_slider_categories');
			$args['category__in']=$categories;
		elseif($slider_type == "tags"):
			$tags = get_option('dt_slider_tags');
			$args['tag__in']=$tags;
		endif;

		//Number of posts
		$args['posts_per_page'] = $slider_number;

		//Order by
		$args['orderby']= $slider_order;

		$query = new WP_Query($args);

		$loader = '/images/ajax-loader.gif';

	?>

	<!--BEGIN #slides-->
	<div id="slides" data-img="<?php echo get_template_directory_uri() . $loader; ?>" data-auto="<?php echo $slider_auto; ?>">

		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

			<?php if ( has_post_thumbnail() ) : ?>
			
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array(9999,9999) ); ?>
			
			<div data-src="<?php echo $image[0]; ?>">
					
				<div class="featured-details fadeIn camera_effected">

					<div class="inner">
						<span class="meta-category"><?php the_category(', '); ?></span>
						
						<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title('', '', true, '50') ?></a></h2>
						
						<?php $format = get_post_format(); ?>
						
						<!--BEGIN .post-content -->
						<div class="post-content format-<?php echo $format; ?>">
							
							<?php if ($format == "image" || $format == "gallery" || $format == "video") : ?>
							<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-<?php echo $format; ?>.png" alt="<?php echo $format; ?>" /></span>
							<?php endif; ?>
							
							<?php dt_excerpt(30); ?>
							
						<!--END .post-content -->
						</div>
						
						<a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'engine'); ?></a>
					
					</div>
					
				</div>

			</div>

			<?php endif; ?>

		<?php endwhile; endif; ?>

	<!--END #slides -->
	</div>

<!--END .featured -->
</div>