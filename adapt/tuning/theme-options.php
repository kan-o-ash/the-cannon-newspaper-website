<?php


// Build Category/Tag Lists for Get Posts From...
$args = array('type' => 'categories');
$cat_dropdown = dt_make_option_list($args);
$args = array('type' => 'tags');
$tag_dropdown = dt_make_option_list($args);


$options= array(


// HOME
array(
	"type" => "section_start",
	"tab_name" => __("Dashboard", 'engine'),
	"name" => __("Dashboard", 'engine'),
	"tab-id" => "home-tab",
	"save-button" => false),
	array(
		"type" => "home_html" ),

array(
	"type" => "section_end" ),
// END HOME


// DESIGN
array(
	"type" => "section_start",
	"tab_name" => __("Design", 'engine'),
	"name" => __("Design and Layout Settings", 'engine'),
	"tab-id" => "design-tab" ),

	// Design Settings
    array(
		"type" => "options_group_start",
		"name" =>  __("Design Settings", 'engine') ),
		array(
    		"type" => "color_picker",
    		"name" =>  __("Color Scheme", 'engine'),
    		"id" => "dt_color",
    		"desc" =>  __("Click inside the box to select a color or enter the HEX code directly.", 'engine'),
    		"default" => "#99cc00" ),
        array(
			"type" => "textarea",
			"name" =>  __("Add Custom CSS", 'engine'),
			"id" => "dt_custom_css",
			"desc" =>  __("Make quick changes to your theme by adding some custom CSS to this box. <br /><br />If you'd like to make more than just a few custom CSS changes, it's best to place them in your custom.css file which you can <a href='".admin_url()."theme-editor.php?file=/themes/".strtolower(DT_THEME_NAME)."/custom-style.css&theme=".DT_THEME_NAME."&dir=style&TB_iframe=1&width=940&height=800' class='thickbox' title='Edit CSS'>edit here</a>.", 'engine'),
			"default" => "" ),
    array(
		"type" => "options_group_end" ),

	// Branding
	array(
	    "type" => "options_group_start",
	    "name" => __("Branding Options", 'engine') ),
    	array(
			"type" => "image",
			"name" =>  __("Custom Logo", 'engine'),
			"id" => "dt_custom_logo",
			"desc" =>  __("Upload a logo for your theme or enter the image address of your existing logo. <br /><br />Leave this field blank if you'd prefer to just display your site's title and tagline instead of an image. Feel free to make changes to your site's <a href='".admin_url()."options-general.php?TB_iframe=1&width=940&height=800' class='thickbox' title='General Settings'>title and tagline</a>.", 'engine'),
			"default" => "" ),
        array(
			"type" => "image",
			"name" =>  __("Custom Favicon", 'engine'),
			"id" => "dt_custom_favicon",
			"desc" =>  __("Upload a small image to use as your site's favicon, also known as a shortcut icon.", 'engine'),
			"default" => "" ),
		array(
			"type" => "image",
			"name" =>  __("Custom Default Avatar", 'engine'),
			"id" => "dt_custom_avatar",
			"desc" =>  __("Upload a custom default comment avatar. Once you've uploaded your custom avatar, change the Default Avatar setting at the bottom of the <a href='".admin_url()."options-discussion.php?TB_iframe=1&width=940&height=800' class='thickbox' title='Custom Default Avatar'>Discussion Settings</a> page.", 'engine'),
			"default" => "" ),
	array(
	    "type" => "options_group_end" ),

array(
	"type" => "section_end" ),
// END DESIGN/LAYOUT


// HOMEPAGE
array(
	"type" => "section_start",
	"tab_name" => __("Homepage", 'engine'),
	"name" => __("Homepage Settings", 'engine'),
	"tab-id" => "homepage-tab" ),

	// Slider
	array(
		"type" => "options_group_start",
		"name" =>  __("Slider", 'engine') ),
		array(
			"type" => "checkbox",
			"name" => __("Featured Posts Slider", 'engine'),
			"id" => array( "dt_slider"),
			"options" => array( __("Enable homepage featured posts slider", 'engine')),
			"desc" => __("Check this box to enable the featured posts section on your homepage. Choose settings below.", 'engine'),
			"default" => array( "checked" )
		),
		array(
			"type" => "radio",
			"name" => __("Get Posts From...", 'engine'),
			"id" => "dt_posts_from",
			"options" => array( __("Anywhere", 'engine'), __("Categories", 'engine'), __("Tags", 'engine'), ),
			"values" => array( "any", "categories", "tags", ),
			"desc" => __("Choose where to pull posts for the featured posts slider. Get posts from anywhere or from specific categories or tags.", 'engine'),
			"default" => "any"
		),
		array(
			"type" => "checkbox_array_values",
			"name" => __("Choose Categories", 'engine'),
			"id" =>  "dt_slider_categories",
			"options" => $cat_dropdown['options'],
			"values" => $cat_dropdown['values'],
			"desc" => __("Select categories from which to pull posts from for the featured posts section.", 'engine'),
			"default" => $cat_dropdown['default']
		),
		array(
			"type" => "checkbox_array_values",
			"name" => __("Choose Tags", 'engine'),
			"id" =>  "dt_slider_tags",
			"options" => $tag_dropdown['options'],
			"values" => $tag_dropdown['values'],
			"desc" => __("Select tags from which to pull posts from for the featured posts section.", 'engine'),
			"default" => $tag_dropdown['default']
		),
		array(
			"type" => "text",
			"name" => __("Number of Posts", 'engine') ,
			"id" => "dt_slider_number",
			"desc" => __("Enter the number of posts to be featured.", 'engine'),
			"default" => "6"
		),
		array(
			"type" => "select",
			"name" => __("Post Order", 'engine'),
			"id" => "dt_slider_order",
			"options" => array( __("Most Popular", 'engine'), __("Most Recent", 'engine'), __("Random", 'engine') ),
			"values" => array( "comment_count", "date", "rand"),
			"desc" => __("Choose how you would like the featured posts to be sorted.", 'engine'),
			"default" => "comment_count"
		),
		array(
			"type" => "text",
			"name" => __("Slide Speed", 'engine'),
			"id" => "dt_slider_auto",
			"desc" => __("Enter how many milliseconds you would like to show for each slide. Leave blank to disable.", 'engine'),
			"default" => "8000"
		),

    array(
		"type" => "options_group_end"),

array(
	"type" => "section_end" ),
// END HOMEPAGE


// DISPLAY
array(
	"type" => "section_start",
	"tab_name" =>  __("Display", 'engine'),
	"name" =>  __("Display Options", 'engine'),
	"tab-id" => "display-tab" ),

	// Single Posts
	array(
		"type" => "options_group_start",
		"name" =>  __("Single Posts", 'engine') ),
		array(
			"type" => "checkbox",
			"name" =>  __("Show Featured Images", 'engine'),
			"id" => array("dt_blog_image"),
			"desc" =>  __("Check this to enable the featured images on the single posts", 'engine'),
			"default" => array( "checked" ),
			"options" => array(__('Enable featured images on single posts', 'engine') )
		),
	array(
		"type" => "options_group_end" ),

	// Showcase Posts
	array(
		"type" => "options_group_start",
		"name" =>  __("Showcase Posts", 'engine') ),
		array(
			"type" => "checkbox",
			"name" =>  __("Related Showcase Items", 'engine'),
			"id" => array("dt_related"),
			"desc" =>  __("Check this to enable the related items sidebar on the single Showcase posts.", 'engine'),
			"default" => array( "checked" ),
			"options" => array(__('Enable related items on single Showcase posts', 'engine')),
		),
		array(
    		"type" => "text",
    		"name" =>  __("Related Title", 'engine'),
    		"id" => "dt_related_title",
    		"desc" =>  __("Enter the title for the related Showcase items area.", 'engine'),
    		"default" => "Related Projects"
    	),
    	array(
    		"type" => "text",
    		"name" =>  __("Related Number", 'engine'),
    		"id" => "dt_related_number",
    		"desc" =>  __("How many related posts you would like to show?", 'engine'),
    		"default" => "3"
    	),
		array(
		"type" => "options_group_end"
	),

array(
	"type" => "section_end" ),
// END DISPLAY


// GENERAL
array(
	"type" => "section_start",
	"tab_name" =>  __("General", 'engine'),
	"name" =>  __("General Settings", 'engine'),
	"tab-id" => "general-tab" ),

	// Contact Form
	array(
	    "type" => "options_group_start",
	    "name" => __("Contact Form", 'engine') ),
    	array(
    		"type" => "text",
    		"name" =>  __("Your Email Address", 'engine'),
    		"id" => "dt_email_address",
    		"desc" =>  __("This theme includes a built-in contact form. Enter the email address you would like your messages sent to. To display the contact form on your site add <code>[contact-form]</code> anywhere in the content of a page or post.", 'engine'),
    		"default" => "" ),
    	array(
    		"type" => "text",
    		"name" =>  __("Preset Subject Choices", 'engine'),
    		"id" => "dt_contact_subject",
    		"desc" =>  __("By default the contact form displays an empty Subject field for your visitors to specify when filling out the form. However, you can choose to provide a dropdown of Subject choices instead by listing them here, separated by commas. (Example: Support, Advertising, General Question)", 'engine'),
    		"default" => "" ),
	array(
	    "type" => "options_group_end" ),

	// RSS, Newsletter and Social Profiles
	array(
	    "type" => "options_group_start",
	    "name" => "Other Settings" ),
	    array(
	        "type" => "text",
	        "name" =>  __("RSS Feed URL", 'engine'),
	        "id" => "dt_rss_url",
	        "desc" =>  __("Enter your site's Feedburner or other RSS URL here. If left blank, the default WordPress feed will be used.", 'engine'),
	        "default" => ""
	    ),
	    array(
	        "type" => "textarea",
	        "name" =>  __("Tracking Code", 'engine'),
	        "id" => "dt_google_analytics",
	        "desc" =>  __("Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.", 'engine'),
	        "default" => ""
	     ),
	array(
	    "type" => "options_group_end"
	),

array(
	"type" => "section_end" ),
// END GENERAL


);