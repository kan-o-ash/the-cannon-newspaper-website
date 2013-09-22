<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="ie6 ie67"><![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="ie7 ie67"><![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<link rel="icon" type="image/png" href="http://skule.ca/content/cannon-favicon.png">
	<meta property="fb:admins" content="508350886" />
       <meta property="fb:admins" content="508350886" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

	<?php if(get_option('dt_custom_favicon') != '') : ?>
	<link rel="shortcut icon" href="<?php echo stripslashes(get_option('dt_custom_favicon')); ?>">
	<link rel="apple-touch-icon" href="<?php echo stripslashes(get_option('dt_custom_favicon')); ?>">
	<?php endif; ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<?php if(get_option('dt_rss_url')): ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo stripslashes(get_option('dt_rss_url')); ?>" />
	<?php endif; ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_url').'?'.filemtime(get_stylesheet_directory().'/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/custom-style.css'.'?'.filemtime(get_stylesheet_directory().'/custom-style.css'); ?>">

	<?php if(get_option('dt_custom_css') && get_option('dt_custom_css')!=""): ?>
	<style type="text/css">
		<?php echo stripslashes(get_option('dt_custom_css')); ?>
	</style>
	<?php endif; ?>

	<?php wp_head(); ?>

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/engine/js/selectivizr.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/custom-mobile.css'.'?'.filemtime(get_stylesheet_directory().'/custom-mobile.css'); ?>">

</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- BEGIN #wrapper-->
<div id="wrapper">

	<!-- BEGIN #page-->
    <div id="page">

		<!-- BEGIN #mobile-menu -->
		<div id="mobile-menu">
			<?php if ( has_nav_menu( 'mobile-menu' ) ) : wp_nav_menu( array( 'theme_location' => 'mobile-menu' ) ); endif; ?>
		</div>
		<!-- END #mobile-menu -->
		
		<!-- #secondary-menu -->
		<div id="secondary-menu">
			
			<!-- .centered-menu --><!--
			<div class="centered-menu">
				<?php if ( has_nav_menu( 'secondary-menu' ) ) : wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'depth' => 2 ) ); endif; ?>
			</div>-->
			<!-- /.centered-menu -->
			<!-- .left-menu -->
			<table><tr><td class="navigation">
			<div class="secondary-menu-left">
				<?php if ( has_nav_menu( 'secondary-menu' ) ) : wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'depth' => 2 ) ); endif; ?>
			</div>
			<!-- /.left-menu -->
			</td><td class="menu-search">
			<div class="">
				<?php the_widget("DT_Search", array("search_text" => "search...")) ?>
			</div>
			</td></tr></table>
		</div>
		<!-- /#secondary-menu -->
			
		<!-- BEGIN #header-->
		<div id="header">
					
			<!-- #header-inner -->
			<div id="header-inner" class="clearfix">
			
				<?php $logo = get_option('dt_custom_logo'); ?>
	
				<div id="logo">
	
			    <?php if ($logo == '' || !$logo): ?>
	
					<?php if (is_home() || is_front_page()): ?>
	
						<h1 id="site-title" class="text"><span><a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></span></h1>
						<h2 id="site-description"><?php bloginfo('description') ?></h2>
	
					<?php else: ?>
	
						<div id="site-title" class="text"><a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></div>
						<div id="site-description"><?php bloginfo('description') ?></div>
	
					<?php endif; ?>
	
				<?php else: ?>
	
					<?php if (is_home() || is_front_page()): ?>
	
						<h1 id="site-title"><span><a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?> - <?php bloginfo('description') ?>" rel="home"><img class="logo" alt="<?php bloginfo('name') ?>" src="<?php echo stripslashes($logo); ?>" /></a></span></h1>
	
					<?php else: ?>
	
						<div id="site-title"><span><a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?> - <?php bloginfo('description') ?>" rel="home"><img class="logo" alt="<?php bloginfo('name') ?>" src="<?php echo stripslashes($logo); ?>" /></a></span></div>
	
					<?php endif; ?>
	
				<?php endif; ?>
	
				<!-- END #logo -->
				</div>
	
				<!-- BEGIN #primary-menu -->
				<div id="primary-menu" class="clearfix">
					
					<!-- .left-menu -->
					<div class="left-menu split-menu">
						<?php if ( has_nav_menu( 'primary-menu-left' ) ) : wp_nav_menu( array( 'theme_location' => 'primary-menu-left' ) ); endif; ?>
					</div>
					<!-- /.left-menu -->
					
					<!-- .right-menu -->
					<div class="right-menu split-menu">
						<?php if ( has_nav_menu( 'primary-menu-right' ) ) : wp_nav_menu( array( 'theme_location' => 'primary-menu-right' ) ); endif; ?>
					</div>
					<!-- /.right-menu -->	
	
				<!-- END #primary-menu -->
				</div>

			</div>
			<!-- /#header-inner -->
						
		<!-- END #header -->
		</div>
	<!--	<div class="hentry item" style="font-size:13px;width: 100%; position:relative; z-index:5">
			<strong>The Cannon is currently recruiting its 1T3-1T4 crew! For more information, visit the <a href="https://docs.google.com/forms/d/1zJEajpCYxs2DjbqaZ83vFOgplGbiwRUolMR3DO6L1Fk/viewform" target="_blank">application form</a>.</strong>
		</div>-->
		<?php 
		if(is_front_page()) {
			$slider = get_option('dt_slider'); 
			if($slider == 'true') get_template_part('includes/home-slider'); 
		}
		?>
		
		<div id="main" class="clearfix">

			<div id="container" class="clearfix">