<?php

/* ==  Theme Post Types  ======================================================
*
*	   This file contains functions that enable you to
*	   create custom post types with ease. Edit at your own risk.
*
* ============================================================================*/


/* ==  Register Post Type  ==============================*/

function dt_register_post_type( $name, $slug , $supports = array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'comments'), $labels = null, $exclude_from_search = false ) {
	
	if(!$labels) {
		$labels = array(
			'name' => ucfirst($name),
			'singular_name' => ucfirst($name),
			'add_new' => __('Add New','engine'),
			'add_new_item' => __('Add New', 'engine'),
			'edit_item' => __('Edit', 'engine'),
			'new_item' => __('New', 'engine'),
			'view_item' => __('View', 'engine'),
			'search_items' => __('Search', 'engine'),
			'not_found' =>  __('None Found','engine'),
			'not_found_in_trash' => __('None Found in Trash','engine'), 
			'parent_item_colon' => ''
		  );
	  }
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => $exclude_from_search,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => array('slug' => $slug),
		'supports' => $supports
	  ); 
	  
	  register_post_type( strtolower($name), $args );

}



/* ==  Register Custom Taxonomy  ==============================*/

function dt_register_taxonomy($name, $slug, $posttype, $hierarchical) {

	register_taxonomy(
		$slug, 
		array( $posttype ), 
		array(
			"hierarchical" => $hierarchical,
		 	"label" => $name, 
		 	"singular_label" => ucfirst($name), 
		 	"rewrite" => 
			 	array(
			 		'slug' => strtolower($slug), 
			 		'hierarchical' => true
			 	)
		)
	); 
}