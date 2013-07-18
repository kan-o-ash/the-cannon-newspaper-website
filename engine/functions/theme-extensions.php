<?php


// Change default avatar
add_filter( 'avatar_defaults', 'dt_avatar' );
function dt_avatar ($avatar_defaults) {
    $new_avatar = stripslashes(get_option('dt_custom_avatar'));
    $avatar_defaults[$new_avatar] = "Custom Avatar";
    return $avatar_defaults;
}


// Tweak the_excerpt() for dt_excerpt()
function dt_excerpt_length($length) { return 100; }
add_filter('excerpt_length', 'dt_excerpt_length');


// Limit the number of words in the_excerpt and set trim value
function dt_excerpt($num) {
	$trim = stripslashes('...');
	$limit = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	$num_words = count($excerpt);
	if ($num_words >= $num) {
		$last_item=array_pop($excerpt);
	}
	else {
		$trim="";
	}
	$excerpt = implode(" ",$excerpt)."$trim";
	echo "<p>".$excerpt."</p>";
}


// Get specific number of words from the_content to use as excerpt
function dt_content($num) {
	$trim = stripslashes('...');
	$theContent = get_the_content();
	$output = preg_replace('/<img[^>]+./','', $theContent);
	$limit = $num+1;
	$content = explode(' ', $output, $limit);
		array_pop($content);
	$content = implode(" ",$content)." $trim&nbsp;";
	echo $content;
}


// Limit number of characters of the_title
function dt_title($num) {
	global $post;
	$title = get_the_title($post->ID);
	$chars = strlen($title);
	if ($num != '' && $chars > $num) {
		$title = substr($title,0,$num).'...';
	}
	echo $title;
}


// Test if the current category is a child of the input category
function dt_in_parent_category($cats, $_post = null) {
	foreach ((array) $cats as $cat)	{
		$descendants = get_term_children((int) $cat, "category");
		if ($descendants && in_category($descendants, $_post))
			return true;
	}
	return false;
}


add_action( 'cmb_render_repeatable_text', 'dt_repeatable_text', 10, 2 );

function dt_repeatable_text( $field, $meta ) {
	
	echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
    $i = 0;
    if ($meta) {
        foreach($meta as $row) {
            echo '<li>
            		<span class="sort hndle" title="Drag to reorder">|||</span>
					<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="40" />
					<a data-num="'.$i.'" class="repeatable-remove button" href="#">'. __('Remove', 'engine') .'</a>
				</li>';
            $i++;
        }
    } else {
        echo '<li>
        		<span class="sort hndle" title="Drag to reorder">|||</span>
				<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="40" />
				<a data-num="'.$i.'" class="repeatable-remove button" href="#">'. __('Remove', 'engine') .'</a>
			</li>';
    }
    echo '</ul>';
    echo '<a class="repeatable-add button" href="#">' . __('Add +', 'engine') . '</a><br style="line-height:32px;" />';
}



add_action( 'cmb_render_repeatable_textarea', 'dt_repeatable_textarea', 10, 2 );

function dt_repeatable_textarea( $field, $meta ) {

	echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
    $i = 0;
    if ($meta) {
        foreach($meta as $row) {
            echo '<li>
            		<span class="sort hndle" title="Drag to reorder">|||</span>
					<textarea name="'.$field['id'].'['.$i.']" id="'.$field['id'].'['.$i.']" cols="60" rows="10" style="width:80%; vertical-align: top;">'.$row.'</textarea>
					<a data-num="'.$i.'" class="repeatable-remove button" href="#">'. __('Remove', 'engine') .'</a>
				</li>';
            $i++;
        }
    } else {
        echo '<li>
        		<span class="sort hndle" title="Drag to reorder">|||</span>
				<textarea name="'.$field['id'].'['.$i.']" id="'.$field['id'].'['.$i.']" cols="60" rows="10" style="width:80%; vertical-align: top;"></textarea>
				<a data-num="'.$i.'" class="repeatable-remove button" href="#">'. __('Remove', 'engine') .'</a>
			</li>';
    }
    echo '</ul>';
    echo '<a class="repeatable-add button" href="#">' . __('Add +', 'engine') . '</a><br style="line-height:32px;" />';
}

add_action('admin_head', 'dt_meta_script');

function dt_meta_script() {

	?>
	
	<script type="text/javascript">
		
		jQuery(document).ready(function(){
		
			jQuery('.repeatable-add').click(function() {
			
				field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
				fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
				
				console.log(fieldLocation);
				
				jQuery('input', field).val('').attr('name', function(index, name) {
		
					return name.replace(/(\d+)/, function(fullMatch, n) {
						return Number(n) + 1;
					});
					
				});
				
				jQuery('textarea', field).val('').attr('name', function(index, name) {
				
					return name.replace(/(\d+)/, function(fullMatch, n) {
						return Number(n) + 1;
					});
					
				});
				
			
				field.insertAfter(fieldLocation, jQuery(this).closest('td'));
			
				return false;
			
			});
		
			jQuery('.repeatable-remove').click(function(){
			
				jQuery(this).parent().remove();
				
				return false;
			});
			
			if(jQuery().sortable) {
				jQuery('.custom_repeatable').sortable({
					opacity: 0.6,
					revert: true,
					cursor: 'move',
					handle: '.sort'
				});
			}
		});
	
	</script>
<?php

}
