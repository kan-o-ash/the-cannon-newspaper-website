<?php

/*=====================================================

CONTENTS
- dt_admin_head() -> For adding admin styles and scripts
- dt_ajax_save() -> For calling AJAX save function
- dt_save_ajax_options() -> For saving options via AJAX
- dt_ajax_image_upload() -> For image uploads via AJAX
- dt_ajax_image_remove() -> For image removals via AJAX
- dt_ajax_update_image() -> For image updates via AJAX
- dt_generate_option_html() -> For generating HTML from options
- display_section_start($value)
- display_options_group_start($value)
- display_text($value)
- display_multitext($value)
- display_textarea($value)
- display_image($value)
- display_checkbox($value)
- display_radio($value)
- display_radio_img($value)
- display_select($value)
- display_html($value)
- display_options_group_end($value)
- display_section_end($value)
- display_home_html()

=======================================================*/

//Redirect to theme options page on theme activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	header( 'Location: ' . admin_url() . 'admin.php?page=dt-options' ) ;
}

//Add styles and scripts to wordpress head in the admin panel
function dt_admin_head(){

global $pagenow;

$dt=false;

//Checks if the DT admin page is begin displayed
if(isset($_GET['page']) && ($_GET['page']=='dt-options' or $_GET['page']=='dt-settings-manager'))
	$dt=true;

$dt_dir=get_bloginfo('template_directory');

?>
<link rel='stylesheet' id='dt-admin-css' href='<?php echo $dt_dir; ?>/engine/css/admin.css' type='text/css' media='all' />

<?php
}

//Save options via AJAX
add_action('wp_ajax_dt_ajax_save', 'dt_ajax_save'); //Add support for AJAX save from theme options

function dt_ajax_save(){

	//IMPORTANT LINE:
	update_option('dt_options_saved', 'true');

	$save_types=array("text", "multitext", "textarea", "image", "checkbox", "radio", "radio_img", "color_picker", "select", "checkbox_array_values");

	global $wpdb; //Now WP database can be accessed
	global $options;
	global $language_options;

	if (isset($_POST['action']) && $_POST['action'] == 'dt_ajax_save' ) {
		dt_save_ajax_options($options);
	}
	else if (isset($_POST['action']) && $_POST['action'] == 'reset' ) {
		//Delete all options from the options table in WPDB, where it has dt_ as a prefix
		$query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'dt_%'";
		$wpdb->query($query);
	}

	die();

}


function dt_save_ajax_options($this_options){

	$save_types=array("text", "multitext", "textarea", "image", "checkbox", "radio", "radio_img", "color_picker", "select", "checkbox_array_values");


	foreach ($this_options as $value) {
			$the_type=$value['type'];

			if(in_array($the_type, $save_types)){ //if its in the array, its an input element

				if($the_type=="checkbox"){
					$ctr=0;

					foreach( $value['options'] as $cbopt):
						$curr_id=$value['id'][$ctr];

						if(isset($_REQUEST[$curr_id]))
							update_option($curr_id, 'true');
						else
							update_option($curr_id, 'false');
					$ctr++;
					endforeach;
				}

				if($the_type=="checkbox_array_values"){
					$curr_id=$value['id'];

					if(isset($_REQUEST[$curr_id]))
						update_option($curr_id, $_REQUEST[$curr_id]);
					else
						update_option($curr_id, 'false');
				}

				if($the_type=="multitext"){
					foreach( $value['id'] as $mt_id):
						update_option($mt_id, $_REQUEST[ $mt_id ]);
					endforeach;
				}

				if($the_type!="checkbox" and $the_type!="checkbox_array_values" and $the_type!="multitext"){
					update_option($value['id'], $_REQUEST[ $value['id'] ]);
				}
			}
	}


}


//Save image via AJAX
add_action('wp_ajax_dt_ajax_upload', 'dt_ajax_image_upload'); //Add support for AJAX save

function dt_ajax_image_upload(){
	global $wpdb; //Now WP database can be accessed

	$image_id=$_POST['data'];
	$image_filename=$_FILES[$image_id];
	$override['test_form']=false; //see http://wordpress.org/support/topic/269518?replies=6
	$override['action']='wp_handle_upload';

	$uploaded_image = wp_handle_upload($image_filename,$override);

	if(!empty($uploaded_image['error'])){
		echo 'Error: ' . $uploaded_image['error'];
	}
	else{
		update_option($image_id, $uploaded_image['url']);
		echo $uploaded_image['url'];
	}

	die();

}


//Update image via AJAX
add_action('wp_ajax_dt_ajax_update_image', 'dt_ajax_update_image'); //Add support for AJAX save

function dt_ajax_update_image(){
	$option_id=$_POST['image_id'];
	$option_value=$_POST['new_image_val'];

	update_option($option_id, $option_value);

	die();

}


//Display theme options
function dt_generate_option_html($this_options){

	foreach ($this_options as $value){

		switch ( $value['type'] ){

			case "section_start": display_section_start($value); break;

				case "options_group_start": display_options_group_start($value); break;

					case "home_html" : display_home_html(); break;

					case "text": display_text($value); break;

					case "multitext": display_multitext($value); break;

					case "textarea": display_textarea($value); break;

					case "image": display_image($value); break;

					case "checkbox": display_checkbox($value); break;

					case "radio": display_radio($value); break;

					case "radio_img": display_radio_img($value); break;
					
					case "color_picker": display_color_picker($value); break;

					case "select": display_select($value); break;

					case "checkbox_array_values": display_checkbox_array_values($value); break;

					case "html": display_html($value); break;

				case "options_group_end": display_options_group_end($value); break;

			case "section_end": display_section_end($value); break;

		}

	}

}



//Display beginning of a section
function display_section_start($value){
?>
	<div id="<?php echo $value['tab-id']; ?>" class="dt-tab-content cf">

		<div class="tab-top">
			<h4><?php echo $value['name']; ?></h4>
			<?php if(!isset($value['save-button'])): ?>
			<input class="dt-save button-primary" type="submit" value="Save All Changes" name="dt-save<?php echo $i++; ?>"/>
			<?php endif; ?>
		</div>
<?php
}


//Display beginning of options group
function display_options_group_start($value){
?>
		<div class="options-group cf">
			<h3><?php echo $value['name']; ?></h3>
<?php
}


//Display text input
function display_text($value){
?>
			<div class="option option-text <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
						<input type="text" class="text" value="<?php if(get_option($value['id'])) echo stripslashes(get_option($value['id']));else echo $value['default']; ?>" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>"/>

					</div>
					<div class="option-description">
					<?php
						echo $value['desc'];
					?>
					</div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display multiple text imputs
function display_multitext($value){
?>
			<div class="option option-multitext <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">

					<div class="option-control">
				<?php
					$ctr=-1;
					foreach($value['id'] as $mt_id):
						$ctr++;
				?>
						<input type="text" class="text" value="<?php if(get_option($value['id'][$ctr])) echo stripslashes(get_option($value['id'][$ctr]));else echo $value['default'][$ctr]; ?>" id="<?php echo $value['id'][$ctr]; ?>" name="<?php echo $value['id'][$ctr]; ?>"/>
				<?php
					endforeach;
				?>
					</div>
					<div class="option-description">
					<?php
						echo $value['desc'];
					?>
					</div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display textarea
function display_textarea($value){
?>
			<div class="option option-textarea <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
						<textarea rows="5" cols="25" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>"><?php
						if(get_option($value['id']))
							echo stripslashes(get_option($value['id'])) ;
						else
							echo $value['default'];
						?></textarea>
					</div>
					<div class="option-description">
						<?php echo $value['desc'];?>
					</div>

				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display image upload field
function display_image($value){
?>
			<div class="option option-upload <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
						<input type="text" class="text" value="<?php
						if(get_option($value['id'])) echo stripslashes(get_option($value['id'])); ?>" name="<?php echo $value['id']; ?>"/>
						<span id="<?php echo $value['id']; ?>" class="button upload dt-button-upload">Upload Image</span>
						<span style="display:none;" class="button dt-image-remove" id="remove_<?php echo $value['id']; ?>">Remove</span>
						<input style="display:none;" class="dt-save button-primary" type="submit" value="Save" name="dt-save"/>
						<a style="display:none;" class="dt-image-update" id="update_<?php echo $value['id']; ?>" href="#">update image</a>
						<div class="dt-image-preview">
							<?php if(get_option($value['id'])): ?>
							<img src="<?php echo get_option($value['id']); ?>" />
							<?php endif; ?>
						</div>
					</div>
					<div class="option-description"><?php echo $value['desc']; ?></div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display checkbox
function display_checkbox($value){
$has_spaces=false;
if( array_key_exists  ( 'spaces', $value ) ) $has_spaces=true;
?>
			<div class="option option-checkbox <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
				<?php
					$ctr=-1;
					foreach($value['options'] as $cb_option):
						$ctr++;
						$checked='';
						if(get_option($value['id'][$ctr])){
							if(get_option($value['id'][$ctr]) == 'true') $checked=' checked="checked"';
							else $checked='';
						}
						else{
							if($value['default'][$ctr]=="checked") $checked=' checked="checked"';
						}

						if($has_spaces) echo $value['spaces'][$ctr];
				?>
						<input type="checkbox" id="<?php echo $value['id'][$ctr]; ?>"<?php echo $checked; ?> name="<?php echo $value['id'][$ctr]; ?>"><span class="sub-label"><?php echo $value['options'][$ctr]; ?></span><br/>
				<?php
					endforeach;
				?>
					</div>
					<div class="option-description"><?php echo $value['desc']; ?></div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display radio buttons
function display_radio($value){
?>
			<div class="option option-radio <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
				<?php
					$ctr=-1;
					if(get_option($value['id'])) $default=get_option($value['id']);
					else $default = $value['default'];
					foreach($value['options'] as $rd_option):
						$ctr++;
						$checked='';
						if($value['values'][$ctr]==$default) $checked=' checked="checked"';

				?>
						<input type="radio" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" value="<?php echo $value['values'][$ctr]; ?>"<?php echo $checked; ?>><?php echo $value['options'][$ctr]; ?><br/>
				<?php
					endforeach;
				?>

					</div>
					<div class="option-description"><?php echo $value['desc']; ?></div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}

//Display radio img buttons
function display_radio_img($value){
?>
			<div class="option option-radio-img <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
				<?php
					$ctr=-1;
					if(get_option($value['id'])) $default=get_option($value['id']);
					else $default = $value['default'];
					foreach($value['options'] as $rd_option):
						$ctr++;
						$checked='';
						if($value['values'][$ctr]==$default) $checked=' checked="checked"';

				?>
						<div class="radio-img"><?php echo $value['options'][$ctr]; ?>
						<input type="radio" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" value="<?php echo $value['values'][$ctr]; ?>"<?php echo $checked; ?>></div><!-- .radio-img -->
				<?php
					endforeach;
				?>
					</div>
					<div class="option-description"><?php echo $value['desc']; ?></div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display color picker
function display_color_picker($value){
?>
			<div class="option option-color-picker <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
						<div class="color-picker">
				        	<input type="text" class="text" value="<?php if(get_option($value['id'])) echo stripslashes(get_option($value['id']));else echo $value['default']; ?>" name="<?php echo $value['id']; ?>"/>
				        	<div class="colorpicker"></div>
				    	</div><!-- .color-picker -->
					</div>
					<div class="option-description">
					<?php
						echo $value['desc'];
					?>
					</div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display dropdown menu (select)
function display_select($value){
	if(isset($value['values']))
		$values = $value['values'];
	else
		$values = false;
	$ctr=0;
?>
			<div class="option option-select <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
						<select id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>">
							<?php
								foreach($value['options'] as $sel_opt):
									$this_value='';
									$currval = $values[$ctr];
									if($values):
										$currval = $values[$ctr];
										$this_value = ' value="'.$values[$ctr].'"';
										$ctr++;
									endif;
									if(get_option($value['id']))
										$default = get_option($value['id']);
									else
										$default = $value['default'];
										$selected='';
									if( ($sel_opt == $default) || ($currval == $default) )
										$selected=' selected="selected"';
							?>
							<option <?php echo $selected . $this_value;?>><?php echo $sel_opt; ?></option>
							<?php
								endforeach;
							?>
						</select>
					</div>
					<div class="option-description"><?php echo $value['desc']; ?></div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display checkbox
function display_checkbox_array_values($value){
?>
			<div class="option option-checkbox <?php echo strtolower(str_replace(" ","_",$value['name'])); ?> cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
				<?php
					$this_stored = (array) get_option($value['id']);
					$ctr=-1;
					foreach($value['options'] as $cb_option):
						$ctr++;
						$checked='';
						if(get_option($value['id'])){
							if( in_array($value['values'][$ctr], $this_stored) ) $checked=' checked="checked"';
							else $checked='';
						}
						else{
							if($value['default'][$ctr]=="checked") $checked=' checked="checked"';
						}
				?>
						<input type="checkbox"<?php echo $checked; ?> name="<?php echo $value['id']; ?>[]" value="<?php echo $value['values'][$ctr]; ?>"><span class="sub-label"><?php echo $value['options'][$ctr]; ?></span><br/>
				<?php
					endforeach;
				?>
					</div>
					<div class="option-description"><?php echo $value['desc']; ?></div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display HTML
function display_html($value){
?>
			<div class="option option-html cf">
				<label class="option-label"><?php echo $value['name']; ?></label>
				<div class="option-wrap">
					<div class="option-control">
						<?php echo $value['content']; ?>
					</div>
					<div class="option-description">

					</div>
				</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php
}


//Display options group end
function display_options_group_end($value){
?>
		</div><!-- .options-group -->
<?php
}


//Display end of a section
function display_section_end($value){
?>
	</div><!-- #<?php echo $value['tab-id']; ?> .dt-tab-content -->
<?php
}


//Display any HTML required for the home tab
function display_home_html(){
	include(DT_TUNING . '/theme-options-home.php');
}


?>