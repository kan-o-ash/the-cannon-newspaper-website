<?php

/* ==  Post/Page Columns  ======================================================
*
*	   This file adds some special magic to the post/page screens
*
* ============================================================================*/


/* ==  Change columns in the Manage Posts screen  ==============================*/

add_filter("manage_posts_columns", "dt_add_post_columns");
add_action("manage_posts_custom_column", "dt_display_post_columns");



/* ==  Add a custom column to the Manage Posts screen  ==============================*/

function dt_add_post_columns($columns){
    unset($columns);
    $columns = array(
        'cb' => '<input type="checkbox"/>',
        'dt-thumb-col' => __("Image", 'engine'),
        'title' => __('Title', 'engine'),
        'author' => __('Author', 'engine'),
        'categories' => __('Category', 'engine'),
        'tags' => __('Tags', 'engine'),
        'comments' => '<img src="images/comment-grey-bubble.png" alt="Comments">',
        'date' => __('Date', 'engine')
    );
    return $columns;
}



/* ==  Display new Image column  ==============================*/

function dt_display_post_columns($column){
    global $post;
    switch ($column):
        case 'dt-thumb-col':
			if(has_post_thumbnail($post->ID)) {
				the_post_thumbnail();
			}
            break;
    endswitch;
}



/* ==  Add new ID column to the columns array  ==============================*/

function dt_id_column($cols) {
	$cols['dt-id-col'] = 'ID';
	return $cols;
}



/* ==  Echo the ID for the ID column  ==============================*/

function dt_id_value($column_name, $id) {
	if ($column_name == 'dt-id-col')
		echo $id;
}

function dt_id_return_value($value, $column_name, $id) {
	if ($column_name == 'dt-id-col')
		$value = $id;
	return $value;
}



/* ==  Output CSS for width for new columns  ==============================*/

function dt_col_css() {
?>
<style type="text/css">
	#dt-id-col { width: 40px; }
	#dt-thumb-col { width: 80px; }
	.wp-admin td.dt-thumb-col { padding-bottom: 5px; }
</style>
<?php
}



/* ==  Actions/Filters for various tables and the css output  ==============================*/

function dt_col_add() {
	add_action('admin_head', 'dt_col_css');

	add_filter('manage_posts_columns', 'dt_id_column');
	add_action('manage_posts_custom_column', 'dt_id_value', 10, 2);

	add_filter('manage_pages_columns', 'dt_id_column');
	add_action('manage_pages_custom_column', 'dt_id_value', 10, 2);

	add_filter('manage_media_columns', 'dt_id_column');
	add_action('manage_media_custom_column', 'dt_id_value', 10, 2);

	add_filter('manage_link-manager_columns', 'dt_id_column');
	add_action('manage_link_custom_column', 'dt_id_value', 10, 2);

	add_action('manage_edit-link-categories_columns', 'dt_id_column');
	add_filter('manage_link_categories_custom_column', 'dt_id_return_value', 10, 3);

	foreach ( get_taxonomies() as $taxonomy ) {
		add_action("manage_edit-${taxonomy}_columns", 'dt_id_column');
		add_filter("manage_${taxonomy}_custom_column", 'dt_id_return_value', 10, 3);
	}

	add_action('manage_users_columns', 'dt_id_column');
	add_filter('manage_users_custom_column', 'dt_id_return_value', 10, 3);

	add_action('manage_edit-comments_columns', 'dt_id_column');
	add_action('manage_comments_custom_column', 'dt_id_value', 10, 2);
}

add_action('admin_init', 'dt_col_add');