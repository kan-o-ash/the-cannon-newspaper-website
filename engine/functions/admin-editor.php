<?php

/* ==  Post Editor  ======================================================
*
*	   Custom post editor styles dropdown, buttons and quicktags.
*
* ============================================================================*/


/* ==  Styles Dropdown  ==============================*/

function dt_tiny_mce_before_init($settings) {
	$style_formats = array(
		array( 'title' => 'Code Block', 'block' => 'pre', 'classes' => 'code' ),
		array( 'title' => 'Text Highlight', 'inline' => 'span', 'classes' => 'highlight' ),
		array( 'title' => 'Image Frame', 'block' => 'div', 'classes' => 'frame' ),
		array( 'title' => 'Drop Caps', 'inline' => 'span', 'classes' => 'drop-cap' ),
		
		array( 'title' => 'Buttons' ),
		array( 'title' => 'White Button', 'inline' => 'a', 'classes' => 'button white' ),
		array( 'title' => 'Grey Button', 'inline' => 'a', 'classes' => 'button grey' ),
		array( 'title' => 'Yellow Button', 'inline' => 'a', 'classes' => 'button yellow' ),
		array( 'title' => 'Green Button', 'inline' => 'a', 'classes' => 'button green' ),
		array( 'title' => 'Blue Button', 'inline' => 'a', 'classes' => 'button blue' ),
		array( 'title' => 'Black Button', 'inline' => 'a', 'classes' => 'button black' ),
		  
		array( 'title' => 'Callouts' ),
		array( 'title' => 'White Box', 'block' => 'div', 'classes' => 'alert white' ),
		array( 'title' => 'Yellow Box', 'block' => 'div', 'classes' => 'alert yellow' ),
		array( 'title' => 'Green Box', 'block' => 'div', 'classes' => 'alert green' ),
		array( 'title' => 'Red Box', 'block' => 'div', 'classes' => 'alert red' ),
		  
		array( 'title' => 'Columns' ),
		array( 'title' => '1/2 Column', 'block' => 'div', 'classes' => 'one-half' ),
		array( 'title' => '1/2 Column (last)', 'block' => 'div', 'classes' => 'one-half column-last' ),
		array( 'title' => '1/3 Column', 'block' => 'div', 'classes' => 'one-third' ),
		array( 'title' => '1/3 Column (last)', 'block' => 'div', 'classes' => 'one-third column-last' ),
		array( 'title' => '2/3 Column', 'block' => 'div', 'classes' => 'two-third' ),
		array( 'title' => '2/3 Column (last)', 'block' => 'div', 'classes' => 'two-third column-last' ),
		array( 'title' => '1/4 Column', 'block' => 'div', 'classes' => 'one-fourth' ),
		array( 'title' => '1/4 Column (last)', 'block' => 'div', 'classes' => 'one-fourth column-last' ),
		array( 'title' => '3/4 Column', 'block' => 'div', 'classes' => 'three-fourth' ),
		array( 'title' => '3/4 Column (last)', 'block' => 'div', 'classes' => 'three-fourth column-last' )
	);
	$settings['style_formats'] = json_encode($style_formats);
	$settings['verify_html'] = false;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'dt_tiny_mce_before_init' );


/* ==  Editor Buttons  ==============================*/

function dt_editor_buttons() {
	if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		add_filter('mce_external_plugins', 'add_dt_editor_buttons');
	}
}
add_action('init', 'dt_editor_buttons');

function add_dt_editor_buttons($button_array) {
	$button_array['dt'] = get_template_directory_uri().'/engine/js/editor-buttons.js';
	return $button_array;
}


/* ==  Quicktags  ==============================*/

function dt_quicktags() {
	if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		wp_enqueue_script('dt_quicktags', get_template_directory_uri() .'/engine/js/quicktags.js', array('quicktags'));
	}
}
add_action('admin_print_scripts', 'dt_quicktags');


/* ==  Add Custom Styles Dropdown and Buttons to tinyMCE 3rd Row  ==============================*/

function dt_mce_buttons_3($buttons) {
  array_push( $buttons, 'styleselect', 'dt_contact_shortcode', 'dt_sitemap_shortcode', 'dt_archives_shortcode', 'dt_hr_snippet', 'dt_tabs_snippet', 'dt_accordion_snippet', 'dt_toggle_snippet' );
  return $buttons;
}
add_filter('mce_buttons_3', 'dt_mce_buttons_3');


/* ==  Add Editor Style  ==============================*/
 
function dt_add_editor_style() {
	add_editor_style( '/engine/css/extras.css' );
}
add_action( 'after_setup_theme', 'dt_add_editor_style' );


?>