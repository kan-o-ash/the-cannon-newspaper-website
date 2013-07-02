<?php

/* ==  Metabox Settings  =======================================================
*
*	  This file contains an array of options for pages, posts and custom post
*	  types.
*
* ============================================================================*/


/* ==  Start with an underscore to hide fields from custom fields list  =====================================================*/

$prefix = 'dt_';

add_filter( 'cmb_meta_boxes', 'dt_metaboxes' );


/* ==  The Settings  =====================================================*/

function dt_metaboxes( $meta_boxes ) {

	global $prefix;

	// Page metabox
	$meta_boxes[] = array(
		'id' => 'additional_options',
		'title' => __('Additional Options', 'engine'),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Custom Thumbnail', 'engine'),
				'desc' => __('To use a custom thumbnail image, upload it here.', 'engine'),
				'id' => $prefix . 'custom_thumbnail',
				'type' => 'file'
			)
		)
	);

	// Post and Showcase metabox
	$meta_boxes[] = array(
		'id' => 'additional_options',
		'title' => __('Additional Options', 'engine'),
		'pages' => array('post', 'showcase'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Custom Thumbnail', 'engine'),
				'desc' => __('To use a custom thumbnail image, upload it here.', 'engine'),
				'id' => $prefix . 'custom_thumbnail',
				'type' => 'file'
			),
			array(
				'name' => __('Insert Video (URL)', 'engine'),
				'desc' => __('<em>Example: http://www.youtube.com/watch?v=zonvhlnjwhg</em>To embed a video simply paste the hosted video URL into the field above. The video width and height will be set to fit your theme automatically.', 'engine'),
				'id' => $prefix . 'video',
				'type' => 'text'
			)
		)
	);

	return $meta_boxes;

}


/* ==  Initialize the metaboxes  =====================================================*/

add_action( 'init', 'dt_initialize_cmb_meta_boxes', 9999 );
function dt_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( DT_ENGINE . '/metaboxes/init.php' );
	}
}

