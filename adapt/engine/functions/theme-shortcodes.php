<?php

// CONTACT FORM
function dt_contact_form_shortcode($atts, $content=null){
	return dt_contact_form_display(false);
}
add_shortcode('contact-form', 'dt_contact_form_shortcode');


// ARCHIVES
function dt_archives_shortcode() {
	global $month, $wpdb, $wp_version;

	// a mysql query to get the list of distinct years and months that posts have been created
	$sql = 'SELECT
			DISTINCT YEAR(post_date) AS year,
			MONTH(post_date) AS month,
			count(ID) as posts
		FROM ' . $wpdb->posts . '
		WHERE post_status="publish"
			AND post_type="post"
			AND post_password=""
		GROUP BY YEAR(post_date),
			MONTH(post_date)
		ORDER BY post_date DESC';

	// use get_results to do a query directly on the database
	$archiveSummary = $wpdb->get_results($sql);

	// if there are any posts
	if ($archiveSummary) {
		
		$output = '<div class="archives">';
		// loop through the posts
		foreach ($archiveSummary as $date) {
			// reset the query variable
			unset ($bmWp);
			// create a new query variable for the current month and year combination
			$bmWp = new WP_Query('year=' . $date->year . '&monthnum=' . zeroise($date->month, 2) . '&posts_per_page=-1');

			// if there are any posts for that month display them
			if ($bmWp->have_posts()) {
				// display the archives heading
				$url = get_month_link($date->year, $date->month);
				$text = $month[zeroise($date->month, 2)] . ' ' . $date->year;

				$output .= get_archives_link($url, $text, '', '<h3>', '</h3>');
				$output .= '<ul class="postspermonth">';

				// display an unordered list of posts for the current month
				while ($bmWp->have_posts()) {
					$bmWp->the_post();
					$output .= '<li><a href="' . get_permalink($bmWp->post) . '" title="' . esc_html($text, 1) . '">' . wptexturize($bmWp->post->post_title) . '</a></li>';
				}

				$output .= '</ul>';
			}
		}
		
		$output .= '</div><!-- .archives -->';
		
		return $output;
	}
}
add_shortcode('archives', 'dt_archives_shortcode');


// SITEMAP
function dt_sitemap_shortcode(){
	$output = '<div class="sitemap cf">';
		$output .=  '<div class="one-half">';
			$output .= '<h3>'.__('Pages', 'engine').'</h3>';
			$output .= '<ul>'.wp_list_pages('title_li=&echo=0').'</ul>';
			$output .= '<h3>'.__('Categories', 'engine').'</h3>';
			$output .= '<ul>'.wp_list_categories('title_li=&show_count=1&echo=0').'</ul>';
			$output .= '<h3>'.__('Authors', 'engine').'</h3>';
			$output .= '<ul>'.wp_list_authors('exclude_admin=0&optioncount=1&echo=0').'</ul>';
		$output .= '</div>';
		$output .= '<div class="one-half column-last">';
			$output .= '<h3>'.__('Monthly Archives', 'engine').'</h3>';
			$output .= '<ul>'.wp_get_archives('type=monthly&show_post_count=1&echo=0').'</ul>';
			$output .= '<h3>'.__('Latest Posts', 'engine').'</h3>';
			$output .= '<ul>'.wp_get_archives('type=postbypost&limit=20&echo=0').'</ul>';
		$output .= '</div>';
	$output .= '</div><!-- .sitemap -->';
	
	return $output;
}
add_shortcode('sitemap', 'dt_sitemap_shortcode');


// WIDGET
function dt_widget_shortcode($atts, $content=null){

	global $wp_widget_factory;

    extract(shortcode_atts(array(
        'name' => false
    ), $atts));

	$name = esc_html($name);

	//Check if widget exists with name given in widget
	if (!is_a($wp_widget_factory->widgets[$name], 'WP_Widget')):

		//If the widget doesn't exist, try prefixing 'WP_WIDGET_' to the name given
		$wp_class = 'WP_Widget_'.ucwords($name);

		//If it still doesn't exist, abort
		if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
			return "<p>$name widget not found</p>";

		//IF it does exist, assign $wp_class to the widget name
		else:
			$name = $wp_class;
		endif;

    endif;

	//Now we know the widget exists, the classname being $name

	//Get attributes:
	$instance=array();
	foreach($atts as $attribute => $value):

		if($attribute != 'name') //We don't need the name again
			$instance[esc_html($attribute)] = esc_html($value); //Assign the value of the attribute to $instance

	endforeach;

	//Starter buffer -> Since the_widget echoes, doesn't return
	ob_start();

		//Call the_widget()
		the_widget($name, $instance, array('widget_id'=>'arbitrary-instance-'.$name,
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => ''
		));

		$output = ob_get_contents();

    ob_end_clean();

    return $output;

}
add_shortcode('widget', 'dt_widget_shortcode');

?>