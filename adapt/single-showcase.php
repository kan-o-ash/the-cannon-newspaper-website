<?php get_header(); ?>

	<!--BEGIN #content -->
    <div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!--BEGIN .hentry -->
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<!--BEGIN .post-header-->
			<div class="post-header">

				<div class="inner">
				
					<span class="meta-category"><?php the_category(', '); ?></span>
					
					<h1 class="post-title">
					
						<?php the_title(); ?>
						
						<?php $format = get_post_format(); ?>
						<?php if ($format == "image" || $format == "gallery" || $format == "video") : ?>
						<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-<?php echo $format; ?>.png" alt="<?php echo $format; ?>" /></span>
						<?php endif; ?>
						
					</h1>
	
					<span class="meta-published"><?php _e('Posted', 'engine') ?> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' '.  __('ago', 'engine'); ?></span>
					<span class="meta-author"><?php _e('by', 'engine') ?> <?php the_author_posts_link(); ?></span>
					
				</div>

			<!--END .post-header -->
			</div>

			<!--BEGIN .featured-image -->
			<div class="featured-image <?php echo get_post_format(); ?>">

				<?php if (get_post_format() == 'video' && get_post_meta(get_the_ID(), 'dt_video', true) != '') : ?>

					<?php
					global $wp_embed;
					$video_url = get_post_meta(get_the_ID(), 'dt_video', true);
					$video_embed = $wp_embed->run_shortcode('[embed width="940"]'.$video_url.'[/embed]');
					?>
					<div id="video-<?php the_ID(); ?>"><?php echo $video_embed; ?></div>

				<?php elseif (get_post_format() == 'gallery') : ?>

					<!--BEGIN #slides -->
					<div id="single-slides">

						<?php

						$args = array(
							'orderby'		 => 'menu_order',
							'post_type'      => 'attachment',
							'post_parent'    => get_the_ID(),
							'post_mime_type' => 'image',
							'post_status'    => null,
							'numberposts'    => -1,
						);

						$attachments = get_posts($args);

						?>

                        <?php if ($attachments) : ?>

                        <div class="slides_container">

                        <?php foreach ($attachments as $attachment) : ?>

                            <?php
                            	$format = get_post_format();
                            	$src = wp_get_attachment_image_src( $attachment->ID, array( '9999','9999' ), false, '' );
								$src = $src[0];
								$image = dt_resize($attachment->ID, $src, 940, '', true);
                             ?>

                        	<div>

                        	<span class="overlay-icon overlay-<?php echo $format; ?>"><a rel="group-<?php the_ID(); ?>" title="<?php echo $attachment->post_title; ?>" class="colorbox-<?php echo $format; ?>" href="<?php echo $src; ?>"></a></span>

                        	<img
                            height="<?php echo $image['height']; ?>"
                            width="<?php echo $image['width']; ?>"
                            alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"
                            src="<?php echo $image['url']; ?>"
                            />
                        	</div>

                        <?php endforeach; ?>

                        </div>

                        <!--BEGIN .slide-cntrols-->
						<div id="slide-controls">

							<a href="#" class="next">Next</a>
							<a href="#" class="prev">Prev</a>

						<!--END .slide-cntrols-->
						</div>

                        <?php endif; ?>

                    <!--END #slides -->
					</div>

				<?php elseif (has_post_thumbnail() && get_option('dt_blog_image') != 'false') : ?>

					<?php
					
					$thumb = get_post_thumbnail_id(get_the_ID());
					$image = dt_resize( $thumb, '', 940, '', true );
					
					echo '<img src="'.$image['url'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="" />';
					
					?>

				<?php endif; ?>

			<!--END .featured-image -->
			</div>

			<!--BEGIN .post-content -->
			<div class="post-content">
				<?php the_content(); ?>
			<!--END .post-content -->
			</div>

		<!--END .hentry-->
		</div>

		<?php comments_template('', true); ?>

		<?php $related = get_option('dt_related');

		if($related == 'true') : ?>

		<!--BEGIN #related-->
		<div id="related" class="clearfix">

			<h3><?php echo stripslashes(get_option('dt_related_title', __('Related', 'engine'))); ?></h3>

			<?php

			$related = dt_get_posts_related_by_taxonomy(get_the_ID(), 'group', get_the_ID());

			?>

			<ul>

				<?php  if($related->have_posts()) : while ($related->have_posts()) : $related->the_post(); ?>

				<!--BEGIN li -->
				<li id="featured-post-<?php the_ID(); ?>">

					<div class="featured-image">
						<div class="da-hover">
							<span class="da-wrap">
								<span class="title"><?php the_title(); ?></span>
								<?php dt_overlay_icon(); ?>
							</span>
						</div>
						<a href="<?php the_permalink(); ?>"><?php dt_image(260, ''); ?></a>
					<!--END .featured-image -->

				<!--END li-->
				</li>

				<?php endwhile;  else: ?>
					<p><?php _e('There are no related projects right now.', 'engine'); ?></p>
				<?php endif; ?>

			</ul>

		<!--END #related-->
		</div>

		<?php endif; ?>


		<?php endwhile; else : ?>

			<p><?php _e('No posts found', 'engine'); ?></p>

		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>