<?php

/*=====================================================

CONTENTS
- dt_add_admin() -> For adding an admin panel and a corresponding menu option
- dt_display_options() -> For displaying the options in the admin panel

=======================================================*/


//Add links to WP admin menu
function dt_add_admin() {
	
	add_menu_page(DT_THEME_NAME .' Theme Options', 'Theme Options', 'administrator', 'dt-options', 'dt_display_options', get_template_directory_uri() .'/engine/images/icons/wp-menu.png', 58);
	
	add_submenu_page(DT_MAINMENU_NAME, DT_THEME_NAME .' Theme Options', DT_THEME_NAME .' Options', 'administrator', DT_MAINMENU_NAME, 'dt_display_options');

}



//Display theme options
function dt_display_options(){

global $options;
$i=1;

if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>'.DT_THEME_NAME. ' ' . __('settings saved'. 'engine') . '</strong></p></div>';
if ( isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade"><p><strong>'.DT_THEME_NAME. ' ' . __('settings reset'. 'engine') . '</strong></p></div>';



?>
<form method="post" id="dt_options_form" class="dt_options_form">
<input type="hidden" name="action" value="dt_ajax_save" />

<div class="dt-wrap cf">

	<div class="dt-overlay" style="display:none">
		<div style="display:none" class="dt-overlay-saving">
			<h4><?php _e('Saving options…', 'engine'); ?></h4>
			<p>&nbsp;</p>
		</div>
		<div style="display:none" class="dt-overlay-saved">
			<h4><?php _e('Options saved!', 'engine'); ?></h4>
			<p><a target="_blank" href="<?php echo home_url(); ?>"><?php _e('View live site &raquo;', 'engine'); ?></a></p>
		</div>
	</div><!-- .dt-overlay -->

	<div class="head">
		<?php echo DT_THEME_NAME; ?> <?php _e('Theme Options', 'engine'); ?>
		<span class="version"><br /><?php _e('Theme Version', 'engine'); ?> <?php echo DT_THEME_VERSION; ?></span>
		<!--, <span class="version"><?php _e('Engine Version', 'engine'); ?> <?php echo DT_ENGINE_VERSION; ?></span>-->
	</div>

	<ul class="dt-tabs">

	<span class="toggleall">
		<span class="plus">[+] <?php _e('Show/Hide All Options', 'engine'); ?></span>
		<span class="minus" style="display:none">[-] <?php _e('Show/Hide All Options', 'engine'); ?></span>
	</span>

<?php
	foreach ($options as $value){
		if(isset($value['type']) && $value['type'] == 'section_start'):
?>
		<li><a href="#<?php echo $value['tab-id']; ?>" rel="#<?php echo $value['tab-id']; ?>"><?php echo $value['tab_name']; ?></a></li>

<?php
		endif;
	}


?>
	</ul><!-- .dt-tabs -->

    <div class="dt-tab-wrap cf">


	<?php dt_generate_option_html($options); ?>


		<div class="tab-footer">

			<div class="option-save">
				<input class="dt-save button-primary" type="submit" value="Save All Changes" name="dt-save"/>
</form><!-- .options form -->
			</div><!-- .option-save -->

			<div id="option-reset">
				<a href="#" id="dt-clear-all-settings"/><?php _e('Reset Options', 'engine'); ?></a>
			</div><!-- #option-reset -->

		</div><!-- .tab-footer -->

    </div><!-- .dt-tab-wrap -->

<?php
}

