<div id="sidebar">
    
    <?php if ( (is_single() || is_archive()) && dt_is_sidebar_active('blog_sidebar') ) : ?>
    <div id="blog-sidebar" class="widget-area">
    	<?php dynamic_sidebar('blog_sidebar'); ?>
    </div><!-- #blog-sidebar .widget-area -->
    <?php endif; ?>

    <?php if (is_page() && dt_is_sidebar_active('page_sidebar')) : ?>
    <div id="page-sidebar" class="widget-area">
    	<?php dynamic_sidebar('page_sidebar'); ?>
    </div><!-- #page-sidebar .widget-area -->
    <?php endif; ?>

    <?php if (dt_is_sidebar_active('global_sidebar')) : ?>
    <div id="global-sidebar" class="widget-area">
    	<?php dynamic_sidebar('global_sidebar'); ?>
    </div><!-- #global-sidebar .widget-area -->
    <?php endif; ?>

</div><!-- #sidebar -->