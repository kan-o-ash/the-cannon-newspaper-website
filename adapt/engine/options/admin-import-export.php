<?php

/*=====================================================

CONTENTS
- dt_add_import_export() -> For adding submenu page for importing and exporting options
- dt_import_export() -> For displaying submenu page for importing and exporting options

=======================================================*/


function dt_add_import_export(){


	//EXPORT
	if(isset($_POST['export'])):

		if($_POST['export']=='download_theme_options'):

			$theme_options = dt_get_theme_options();

			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: public, must-revalidate");
			header("Content-Type: text/plain");
			header('Content-Transfer-Encoding: binary');
			header('Content-Disposition: attachment; filename="' . strtolower(DT_THEME_NAME) . '-theme-options-' . date("Ymd") . '.txt"');
			echo $theme_options;
			exit();

		elseif($_POST['export']=='download_widget_settings'):

			$widget_settings = dt_get_widget_settings();

			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: public, must-revalidate");
			header("Content-Type: text/plain");
			header('Content-Transfer-Encoding: binary');
			header('Content-Disposition: attachment; filename="' . strtolower(DT_THEME_NAME) . '-widget-settings-' . date("Ymd") . '.txt"');
			echo $widget_settings;
			exit();
		endif;

	endif;


	add_submenu_page(DT_MAINMENU_NAME, DT_THEME_NAME .' Settings Manager', 'Settings Manager', 'administrator', 'dt-settings-manager','dt_import_export');


}



function dt_import_export(){



	$option=array();

	//Display Page start

?>

<div class="dt-wrap cf import-export">

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
		<?php echo DT_THEME_NAME; ?> <?php _e('Settings Manager', 'engine'); ?>
		<span class="version"><br /><?php _e('Download, upload or restore theme options, widget settings and site content', 'engine'); ?>.</span>
	</div>

	<ul class="dt-tabs settings-manager-ul">
		<li class="active"><a href="#default-tab" rel="#default-tab"><?php _e('Default Settings and Sample Content', 'engine'); ?></a></li>
		<li><a href="#export-tab" rel="#export-tab"><?php _e('Export Settings', 'engine'); ?></a></li>
		<li><a href="#import-tab" rel="#import-tab"><?php _e('Import Settings', 'engine'); ?></a></li>
	</ul>

    <div class="dt-tab-wrap cf">
<?php



	/*-------------------------------------------------------------------------------------
	-----------------------------------START SAMPLE TAB------------------------------------
	-------------------------------------------------------------------------------------*/
	$option=array(
		"type" => "section_start",
		"tab_name" => __("Default Settings", 'engine'),
		"name" => __("Load/Restore Default Settings and Sample Content <p>Set default theme options, widget settings or load demo site content.</p>", 'engine'),
		"tab-id" => "default-tab",
		"save-button" => false);
	display_section_start($option);


		$option=array(
				"type" => "options_group_start",
				"name" => __("Load/Restore Default Settings and Sample Content", 'engine') 
		);
		display_options_group_start($option);

?>


			<form class="dt_options_form" id="dt_default_theme_options">
				<input type="hidden" name="action" value="dt_set_default_theme_options" />
				<div class="option option-text cf">
					<label class="option-label"><?php _e('Default Theme Options', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<input type="submit" class="dt-save button-primary" value="Load Default Theme Options" />
						</div>
						<div class="option-description">
							<?php _e('Click this to load or restore the default theme options. Any customisations you\'ve made will be lost.', 'engine'); ?>
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->
			</form>




			<form class="dt_options_form" id="dt_default_widget_settings">
				<input type="hidden" name="action" value="dt_default_widget_settings" />
				<div class="option option-text cf">
					<label class="option-label"><?php _e('Default Widget Settings', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<input type="submit" class="dt-save button-primary" value="Load Default Widget Settings" />
						</div>
						<div class="option-description">
							<?php _e('Click this to load or restore the default widget settings. Widgets will be assigned to widget areas, and settings/content applied', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->
			</form>


			<form class="dt_options_form" id="dt_import_default_content">
				<input type="hidden" name="action" value="dt_import_default_content" />
				<div class="option option-textarea cf">
					<label class="option-label"><?php _e('Sample Site Content', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<a href="<?php echo admin_url(); ?>admin.php?import=wordpress"><?php _e('Import Sample Site Content', 'engine'); ?></a>
						</div>
						<div class="option-description">
							<?php _e('Use the import tool to upload the sample content <strong>.xml</strong> file included in the <strong>[theme-name]/tuning/defaults/</strong> folder of your theme. This will load demo site data including posts, pages, comments, categories, images, etc', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->
			</form>


<?php

		$option=array(
				"type" => "options_group_end" );
		display_options_group_end($option);



	$option=array(
		"type" => "section_end" );
	display_section_end($option);


	/*-------------------------------------------------------------------------------------
	-----------------------------------END SAMPLE TAB------------------------------------
	-------------------------------------------------------------------------------------*/



	/*-------------------------------------------------------------------------------------
	-----------------------------------START EXPORT TAB------------------------------------
	-------------------------------------------------------------------------------------*/


	$option=array(
		"type" => "section_start",
		"tab_name" => __("Export Settings", 'engine'),
		"name" => __("Export &amp; Download Theme Settings <p>Download your current theme options, widget settings and site content to be saved and imported later.</p>", 'engine'),
		"tab-id" => "export-tab",
		"save-button" => false );
	display_section_start($option);


		$option=array(
				"type" => "options_group_start",
				"name" => __("Export &amp; Download Theme Settings", 'engine') 
		);
		display_options_group_start($option);
?>

			<form class="dt_options_form" id="dt_noajax_download_options" action="" method="POST">

				<div class="option option-textarea cf">
					<label class="option-label"><?php _e('Theme Options', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<input type="hidden" name="export" value="download_theme_options">
							<input type="submit" class="dt-save button-primary" value="Download Theme Options File" />
							<br />
						</div>
						<div class="option-description">
							<?php _e('Click to download the exported theme options as a text file', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->

			</form>

			<form class="dt_options_form" id="dt_noajax_download_widget" action="" method="POST">

				<div class="option option-textarea cf">
					<label class="option-label"><?php _e('Widget Settings', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<input type="hidden" name="export" value="download_widget_settings">
							<input type="submit" class="dt-save button-primary" value="Download Widget Settings File" />
							<br />
						</div>
						<div class="option-description">
							<?php _e('Click to download the exported widget settings as a text file', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->

			</form>


			<div class="option option-text cf">
					<label class="option-label"><?php _e('Site Data XML', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<a href="<?php echo admin_url(); ?>export.php"><?php _e('Export WordPress XML File', 'engine'); ?></a>
						</div>
						<div class="option-description">
							<?php _e('Click to go to the export tool where you can create an XML file containing your site data (posts, pages, comments, custom fields, categories, and tags)', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
			</div><!-- .option -->
<?php

		$option=array(
				"type" => "options_group_end" );
		display_options_group_end($option);



	$option=array(
		"type" => "section_end" );
	display_section_end($option);


	/*-------------------------------------------------------------------------------------
	-----------------------------------END EXPORT TAB------------------------------------
	-------------------------------------------------------------------------------------*/




	/*-------------------------------------------------------------------------------------
	-----------------------------------START IMPORT TAB------------------------------------
	-------------------------------------------------------------------------------------*/
	$option=array(
		"type" => "section_start",
		"tab_name" => __("Import Settings", 'engine'),
		"name" => __("Import &amp; Overwrite Theme Settings <p>Upload your exported theme options, widget settings and site content files to be imported.</p>", 'engine'),
		"tab-id" => "import-tab",
		"save-button" => false);
	display_section_start($option);


		$option=array(
				"type" => "options_group_start",
				"name" => __("Import &amp; Overwrite Theme Settings", 'engine') 
		);
		display_options_group_start($option);
?>


			<form class="dt_options_form" id="dt_import_options">

				<div class="option option-text cf">
					<label class="option-label"><?php _e('Theme Options', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<input type="hidden" name="action" value="dt_upload_import_file" />
							<span id="upload_file_theme_options" class="button upload dt_import_upload"><?php _e('Upload Theme Options File', 'engine'); ?></span>
						</div>
						<div class="option-description">
							<?php _e('Upload a file with exported theme options, and these options will get imported', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->
			</form>


			<form class="dt_options_form" id="dt_import_widget">

				<div class="option option-text cf">
					<label class="option-label"><?php _e('Widget Settings', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<input type="hidden" name="action" value="dt_upload_import_file" />
							<span id="upload_file_widget_settings" class="button upload dt_import_upload"><?php _e('Upload Widget Settings File', 'engine'); ?></span>
						</div>
						<div class="option-description">
							<?php _e('Upload a file with exported widget settings, and these settings will get imported', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->
			</form>


			<form class="dt_options_form" id="dt_import_xml">

				<div class="option option-text cf">
					<label class="option-label"><?php _e('Site Data XML', 'engine'); ?></label>
					<div class="option-wrap">
						<div class="option-control">
							<a href="<?php echo admin_url(); ?>admin.php?import=wordpress"><?php _e('Import WordPress XML File', 'engine'); ?></a>
						</div>
						<div class="option-description">
							<?php _e('Click to go to the import tool to upload an XML file containing your site data (posts, pages, comments, custom fields, categories, and tags)', 'engine'); ?>.
						</div>
					</div><!-- .option-wrap -->
				</div><!-- .option -->
			</form>


<?php

		$option=array(
				"type" => "options_group_end" );
		display_options_group_end($option);



	$option=array(
		"type" => "section_end" );
	display_section_end($option);


	/*-------------------------------------------------------------------------------------
	-----------------------------------END IMPORT TAB------------------------------------
	-------------------------------------------------------------------------------------*/


?>



		<div class="tab-footer">





		</div><!-- .tab-footer -->

    </div><!-- .dt-tab-wrap -->
<?php

}



