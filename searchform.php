<!--BEGIN .searchform-->
<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input type="text" name="s" class="s" value="<?php _e('To search type and hit enter', 'engine') ?>" onfocus="if(this.value=='<?php _e('To search type and hit enter', 'engine') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter', 'engine') ?>';" />
	</fieldset>
<!--END .searchform-->
</form>