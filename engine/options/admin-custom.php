<?php

/*=====================================================

CONTENTS
- dt_options_set() -> For checking if any DT options have been saved
- dt_set_default_theme_options() -> For setting default theme options
- dt_default_widget_settings() -> For setting default widget options
- dt_clear_options() -> For clearing all DT options
- dt_delete_options() -> Find and delete all DT options
- dt_get_theme_options() -> For getting all the encrypted DT options
- dt_get_widget_settings() -> For getting all the encrypted widget options
- dt_get_all_options() -> For getting all the encrypted DT options and widget settings
- dt_import_from_file() -> For importing theme/widget options from uploaded files
- dt_content_from_file() -> For importing site content from uploaded files
- dt_make_option_list() -> For creating a list of categories/tags/authors/pages used in theme options

=======================================================*/


/*DEFINE FILE PATH CONSTANTS*/
define('DT_FILE_DEFAULT_THEME_OPTIONS', DT_TUNING . '/defaults/default_theme_options.txt');
define('DT_FILE_DEFAULT_WIDGET_OPTIONS', DT_TUNING . '/defaults/default_widget_settings.txt');


function dt_options_set(){
	if(get_option('dt_options_saved'))
		return true;
	return false;
}


add_action('wp_ajax_dt_set_default_theme_options', 'dt_set_default_theme_options'); //Add support for AJAX save
function dt_set_default_theme_options(){

	if( !is_file(DT_FILE_DEFAULT_THEME_OPTIONS) )
		die("File not found");

	$theme_options = file_get_contents(DT_FILE_DEFAULT_THEME_OPTIONS);

	$theme_options=base64_decode($theme_options);
	$theme_options=unserialize($theme_options);

	foreach($theme_options as $the_id => $the_option):
		update_option($the_id, $the_option);
	endforeach;

	die();
}


add_action('wp_ajax_dt_default_widget_settings', 'dt_default_widget_settings'); //Add support for AJAX save
function dt_default_widget_settings(){

	if( !is_file(DT_FILE_DEFAULT_WIDGET_OPTIONS) )
		die("File not found");

	$widget_settings = file_get_contents(DT_FILE_DEFAULT_WIDGET_OPTIONS);

	$widget_settings=base64_decode($widget_settings);
	$widget_settings=unserialize($widget_settings);

	foreach($widget_settings as $the_id => $the_option):
		update_option($the_id, $the_option);
	endforeach;

	die();

}


add_action('wp_ajax_dt_clear_options', 'dt_clear_options'); //Add support for AJAX save
function dt_clear_options(){

	dt_delete_options(); //Delete all DT options

	die(); //Aaaand, we're done

}


function dt_delete_options(){

	global $wpdb;

	$query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'dt_%'";
	$wpdb->query($query);

}


function dt_get_theme_options(){

	global $wpdb;

	//Get all theme settings ( starting with 'dt_' )
	$query="SELECT * FROM $wpdb->options WHERE option_name LIKE 'dt_%'";
	$query_result=$wpdb->get_results($query);

	$theme_options=array();

	foreach($query_result as $the_option):
		$theme_options[$the_option->option_name] = maybe_unserialize($the_option->option_value);
	endforeach;

	$theme_options=serialize($theme_options);
	$theme_options=base64_encode($theme_options);

	return $theme_options;

}


function dt_get_widget_settings(){

	global $wpdb;

	$query="SELECT * FROM $wpdb->options WHERE option_name LIKE 'widget_%'";
	$query_result=$wpdb->get_results($query);

	$widget_settings=array();

	foreach($query_result as $the_option):
		$widget_settings[$the_option->option_name] = maybe_unserialize($the_option->option_value);
	endforeach;

	//Get sidebar widgets locations
	$widget_settings['sidebars_widgets'] = get_option('sidebars_widgets');
	$widget_settings=serialize($widget_settings);
	$widget_settings=base64_encode($widget_settings);

	return $widget_settings;

}


function dt_get_all_options(){

	global $wpdb;

	//Get all theme settings ( starting with 'dt_' )
	$query="SELECT * FROM $wpdb->options WHERE option_name LIKE 'dt_%'";
	$query_result=$wpdb->get_results($query);

	$all_options = array();

	foreach($query_result as $the_option):
		$all_options[$the_option->option_name] = maybe_unserialize($the_option->option_value);
	endforeach;

	//Get all widget settings ( starting with 'widget_' )
	$query="SELECT * FROM $wpdb->options WHERE option_name LIKE 'widget_%'";
	$query_result=$wpdb->get_results($query);

	foreach($query_result as $the_option):
		$all_options[$the_option->option_name] = maybe_unserialize($the_option->option_value);
	endforeach;

	//Get sidebar widgets locations
	$all_options['sidebars_widgets'] = get_option('sidebars_widgets');

	$all_options=serialize($all_options);
	$all_options=base64_encode($all_options);

	return $all_options;

}


add_action('wp_ajax_dt_upload_import_file', 'dt_import_from_file'); //Add support for AJAX
function dt_import_from_file(){

	$uploaded_file = $_FILES['import_file']['tmp_name'];

	$settings = file_get_contents($uploaded_file);

	$settings=base64_decode($settings);
	$settings=unserialize($settings);

	foreach($settings as $the_id => $the_option):
		update_option($the_id, $the_option);
	endforeach;

	die();

}


add_action('wp_ajax_dt_upload_xml_file', 'dt_content_from_file'); //Add support for AJAX
function dt_content_from_file(){

	$uploaded_file = $_FILES['import_file']['tmp_name'];

	dt_import_xml($uploaded_file);

	die();

}


function dt_make_option_list($args){

	extract($args);

	$return = array(
				'options' => array(),
				'values' => array(),
				'default' => array()
				);

	switch($type):

		case 'categories':
				$all_cats = get_categories('hide_empty=0&orderby=name');

				foreach($all_cats as $cat):

					$return['options'][] = (string) $cat->cat_name;
					$return['values'][] = (string) $cat->cat_ID;
					$return['default'][] = "not";

				endforeach;

				break;

		case 'tags':

				$all_tags = get_tags('hide_empty=0&orderby=name');

				foreach($all_tags as $tag):

					$return['options'][] = (string) $tag->name;
					$return['values'][] = (string) $tag->term_id;
					$return['default'][] = "not";

				endforeach;

				break;

		case 'authors':

				$users = get_users();
				$author_ids = array();

				foreach ( (array) $users as $user )
					$author_ids[] = $user->user_id;

				global $wpdb;

				if ( count($author_ids) > 0  ) {
						$author_ids = implode(',', $author_ids );
						$authors = $wpdb->get_results( "SELECT ID, user_nicename from $wpdb->users WHERE ID IN($author_ids) ORDER BY display_name" );
				}
				else {
						$authors = array();
				}

				$author_count = array();

				foreach ( (array) $wpdb->get_results("SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type = 'post' AND " . get_private_posts_cap_sql( 'post' ) . " GROUP BY post_author") as $row )
	                $author_count[$row->post_author] = $row->count;


				foreach ( (array) $authors as $author ):

					$author = get_userdata( $author->ID );
					$posts = (isset($author_count[$author->ID])) ? $author_count[$author->ID] : 0;
					$author_name=$author->display_name;

					$return['options'][] = (string) $author_name . " (" . $posts . " posts)";
					$return['values'][] = (string) $author->ID;
					$return['default'][] = "not";

				endforeach;

				break;

		case 'pages':

				$all_pages = get_pages();

				foreach($all_pages as $this_page):

					$return['options'][] = (string) $this_page->post_title;
					$return['values'][] = (string) $this_page->ID;
					$return['default'][] = "not";

				endforeach;

				break;

	endswitch;

	return $return;

}


?>