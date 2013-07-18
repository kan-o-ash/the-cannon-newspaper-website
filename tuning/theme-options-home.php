<div class="options-home cf">

	<div class="cf">

		<div id="dt-reset-div" class="dt-reset">
		<?php if(dt_options_set() == false): ?>
			<div class="updated cf">
				<div class="congrats">
					<?php _e('Congratulations!', 'engine'); ?> <em><?php echo DT_THEME_NAME; ?></em> <?php _e('has been successfully installed and activated', 'engine'); ?>.
					<br />
					<?php _e('Would you like to start with the default theme configuration?', 'engine'); ?>
				</div>
				<p class="default-config">
					<input type="button" class="dt-save button-primary" value="Default Theme Configuration" id="dt_default_theme_config" />
					<br />
					<span><?php _e('Click this button to start with the default configuration of this theme', 'engine'); ?>.</span>
				</p>
				<div class="or">- <?php _e('OR', 'engine'); ?> -</div>
				<p class="sample-settings">
					<strong><a href="<?php echo admin_url(); ?>admin.php?page=dt-settings-manager"><?php _e('Customise Initial Theme Configuration', 'engine'); ?></a></strong>
					<br />
					<span><?php _e('Clicking this link will take you to the <strong>Settings Manager</strong> page where you can choose to load default theme options, widget settings and even demo site content including posts, pages, comments, categories, images, etc.', 'engine'); ?></span>
				</p>
			</div>
		<?php endif; ?>
		</div><!-- #dt-reset-div -->

		<div class="intro">
			<p><?php _e('Hello. Welcome to your Theme Options Dashboard! Here you can easily scan through the available theme options by section and get links to find the answers you\'re looking for', 'engine'); ?>.</p>
		</div><!-- .intro -->

		<div class="lg box first home-tab-link" id="dt-design-settings">
			<h4><a rel="#design-tab" href="#design-tab" class="home-tab-link"><?php _e('Design/Layout Settings', 'engine'); ?></a></h4>
			<p><?php _e('Design and custom branding settings', 'engine'); ?></p>
		</div>

		<div class="lg box home-tab-link" id="dt-homepage-settings">
			<h4><a rel="#homepage-tab" href="#homepage-tab" class=""><?php _e('Homepage Settings', 'engine'); ?></a></h4>
			<p><?php _e('Homepage featured posts slider options', 'engine'); ?></p>
		</div>

		<div class="lg box first home-tab-link" id="dt-display-settings">
			<h4><a rel="#display-tab" href="#display-tab" class=""><?php _e('Display Settings', 'engine'); ?></a></h4>
			<p><?php _e('Single and Showcase post display options', 'engine'); ?></p>
		</div>

		<div class="lg box home-tab-link" id="dt-general-settings">
			<h4><a rel="#general-tab" href="#general-tab" class="home-tab-link"><?php _e('General Settings', 'engine'); ?></a></h4>
			<p><?php _e('Contact form, RSS and tracking settings', 'engine'); ?></p>
		</div>

		<div class="sm box first">
			<h4><a href="<?php echo admin_url(); ?>admin.php?page=dt-settings-manager"><?php _e('Settings Manager', 'engine'); ?></a></h4>
			<p><?php _e('Download, upload or restore theme settings and site content', 'engine'); ?>.</p>
		</div>

		<div class="sm box middle">
			<h4><a href="http://support.designerthemes.com/" target="_blank"><?php _e('Support Forums', 'engine'); ?></a></h4>
			<p><?php _e('For support and documentation, please visit our support forums.', 'engine'); ?>.</p>
		</div>

		<div class="sm box">
			<h4><a href="http://designerthemes.com/" target="_blank"><?php _e('Get More Themes', 'engine'); ?></a></h4>
			<p><?php _e('More awesome WordPress themes at DesignerThemes.com!', 'engine'); ?>.</p>
		</div>

	</div>

</div><!-- .options-home -->