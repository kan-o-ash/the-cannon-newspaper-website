<?php


/* ==  Theme Widgets  ==========================================================
*
*	   A function that allows you to turn on/off each widget.
*
* ============================================================================*/


/* ==  Include Widgets  ==============================*/

require_once(DT_WIDGETS . '/widget-aboutme.php');
require_once(DT_WIDGETS . '/widget-125x125.php');
require_once(DT_WIDGETS . '/widget-300x250.php');
require_once(DT_WIDGETS . '/widget-468x60.php');
require_once(DT_WIDGETS . '/widget-728x90.php');
require_once(DT_WIDGETS . '/widget-authorinfo.php');
require_once(DT_WIDGETS . '/widget-bettersearch.php');
require_once(DT_WIDGETS . '/widget-contactform.php');
require_once(DT_WIDGETS . '/widget-flickrphotos.php');
require_once(DT_WIDGETS . '/widget-getposts.php');
require_once(DT_WIDGETS . '/widget-recentcomments.php');
require_once(DT_WIDGETS . '/widget-similarrelated.php');
require_once(DT_WIDGETS . '/widget-socialshare.php');
require_once(DT_WIDGETS . '/widget-subscribefollow.php');
require_once(DT_WIDGETS . '/widget-twittertweets.php');
require_once(DT_WIDGETS . '/widget-blog.php');
require_once(DT_WIDGETS . '/widget-video.php');
require_once(DT_WIDGETS . '/widget-enews.php');


/* ==  Widget Selector Function  ==============================*/

function dt_include_widgets($widgets) {

	foreach ($widgets as $widget) {

		if($widget == 'about-me') {
			register_widget( 'DT_About_Me' );
		}
		if($widget == 'ads-125x125') {
			register_widget( 'DT_Ads_125x125' );
		}
		if($widget == 'ads-300x250') {
			register_widget( 'DT_Ads_300x250' );
		}
		if($widget == 'ads-468x60') {
			register_widget( 'DT_Ads_468x60' );
		}
		if($widget == 'ads-728x90') {
			register_widget( 'DT_Ads_728x90' );
		}
		if($widget == 'author-info') {
			register_widget( 'DT_Author_Info' );
		}
		if($widget == 'better-search') {
			register_widget( 'DT_Search' );
			add_action( 'widgets_init', 'dt_unregister_search' );
			function dt_unregister_search() {
				unregister_widget( 'WP_Widget_Search' );
			}
		}
		if($widget == 'contact-form') {
			register_widget( 'DT_Contact' );
		}
		if($widget == 'flickr-photos') {
			register_widget( 'DT_Flickr' );
		}
		if($widget == 'get-posts') {
			register_widget( 'DT_Get_Posts' );
			add_action( 'widgets_init', 'dt_unregister_posts' );
			function dt_unregister_posts() {
				unregister_widget( 'WP_Widget_Recent_Posts' );
			}
		}
		if($widget == 'recent-comments') {
			register_widget( 'DT_Recent_Comments' );
			add_action( 'widgets_init', 'dt_unregister_comments' );
			function dt_unregister_comments() {
				unregister_widget( 'WP_Widget_Recent_Comments' );
			}
		}
		if($widget == 'similar-related') {
			register_widget( 'DT_Related_Posts' );
		}
		if($widget == 'social-share') {
			register_widget( 'DT_Social' );
		}
		if($widget == 'subscribe-follow') {
			register_widget( 'DT_Subscribe_Follow' );
		}
		if($widget == 'twitter-tweets') {
			register_widget( 'DT_Twitter' );
		}
		if($widget == 'video') {
			register_widget( 'DT_Video_Widget' );
		}
		if($widget == 'blog') {
			register_widget( 'DT_Blog_Widget' );
		}
		if($widget == 'enews') {
			register_widget( 'DT_Enews' );
		}
	}
}


/* ==  Check for widgets in widget areas. Collapse if none.  ==============================*/

function dt_is_sidebar_active( $index = 1 ) {

	$sidebars_widgets = wp_get_sidebars_widgets();
	$index = ( is_int( $index ) ) ? "sidebar-$index" : sanitize_title( $index );

	if ( isset( $sidebars_widgets[$index] ) && !empty( $sidebars_widgets[$index] ) )
		return true;

	return false;
}

