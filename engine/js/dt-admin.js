jQuery(document).ready(function(){
	
	/******************************************************************
	* 	    	    	       REPEATABLE METABOXES                   *
	******************************************************************/
	
	jQuery('.repeatable-add').click(function() {
	
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		
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

	/******************************************************************
	* 	    	    	       GENERIC FUNCTIONS                      *
	******************************************************************/

	function dt_ajax_started(){
		jQuery('.dt-overlay').show();
		jQuery('.dt-overlay-saving').fadeIn();
	}

	function dt_ajax_response(){

		jQuery('.dt-overlay-saving').hide();
		jQuery('.dt-overlay-saved').fadeIn();

			window.setTimeout(function(){
				jQuery('.dt-overlay-saved').fadeOut();
				jQuery('.dt-overlay').hide();
			}, 4000);
	}

	window.setTimeout(function(){
		jQuery('.fade').fadeOut(500);
	}, 4000);

	//Position the dt-overlay div
	jQuery.fn.pos_overlay = function () {
		var window_height=jQuery(window).height();
		var elem_height=jQuery(this).height();
		var pos_top=((window_height - elem_height)/2) + jQuery(window).scrollTop();
		this.animate({"top":pos_top+ "px"},100);

		return this;
	}

	//Check if element exists
	jQuery.fn.exists = function(){return jQuery(this).length;}

	//Position Overlay
	jQuery('.dt-overlay').pos_overlay();
	jQuery(window).scroll(function() {
		jQuery('.dt-overlay').pos_overlay();
	});


	/******************************************************************
	* 	    	         THEME OPTIONS ADMIN AREA                    *
	******************************************************************/

	//DASHBOARD TAB DEFAULT THEME OPTIONS
	jQuery('#dt_default_theme_config').click(function(){

		dt_ajax_started();
		var dt_form_values = { action: "dt_set_default_theme_options" }

		jQuery.post(ajaxurl, dt_form_values, function(response) {
			dt_ajax_response();
			jQuery("#dt-reset-div").slideUp(1000);
		});

		return false; //Stop regular form submission

	});

	//THEME OPTIONS SUBMIT AJAX
	jQuery('#dt_options_form').submit(function(){

		dt_ajax_started();
		var dt_form_values = jQuery("#dt_options_form").serialize();

		jQuery.post(ajaxurl, dt_form_values, function(response) {
			dt_ajax_response();
		});

		return false; //Stop regular form submission

	});


	//THEME OPTIONS AJAX IMAGE UPLOAD
	jQuery('.dt-button-upload').each(function(){

		var the_button=jQuery(this);
		var image_input=jQuery(this).prev();
		var image_id=jQuery(this).attr('id');

		new AjaxUpload(image_id, {
			  action: ajaxurl,
			  name: image_id,

			  // Additional data
			  data: {
				action: 'dt_ajax_upload',
				data: image_id
			  },
			  autoSubmit: true,
			  responseType: false,
			  onChange: function(file, extension){},
			  onSubmit: function(file, extension) {
					the_button.html("Uploading...");
				},
			  onComplete: function(file, response) {
					the_button.html("Upload Image");

					if(response.search("Error") > -1){
						alert("There was an error uploading:\n"+response);
					}

					else{
						image_input.val(response);
						var image_preview='<img src="' + response + '" class="dt_image_preview" />';

						the_button.siblings('.dt-image-remove').css('display', 'inline-block');
						the_button.siblings('.dt-save').css('display', 'inline');
						the_button.siblings('.dt-image-preview').html(image_preview);

						}

				}
		});
	});


	//THEME OPTIONS IMAGE REMOVE
	jQuery('.dt-wrap .option-upload .dt-image-remove').each(function(){
		var dt_upload_val = jQuery(this).siblings('input.text').val();
		if (dt_upload_val != ''){
			jQuery(this).css('display', 'inline-block');
		}
	});
	jQuery('.dt-wrap .option-upload .dt-image-remove').live('click', function(){
		jQuery(this).siblings('.dt-image-preview').children('img').fadeOut();
		jQuery(this).siblings('input.text').attr({ value: '' });
		jQuery(this).siblings('.dt-save').css('display', 'inline');
		jQuery(this).css('display', 'none');
	});


	//THEME OPTIONS AJAX IMAGE UPDATE
	jQuery('.dt-wrap .option-upload input.text').each(function(){
		jQuery(this).focus(function () {
        	jQuery(this).siblings('.dt-image-update').fadeIn();
    	});
	});

	jQuery('.dt-image-update').live('click', function(){
		var update_button=jQuery(this);
		update_button.html('updating...');
		var image_update_id=jQuery(this).prev().attr('id');
		var new_image_val=update_button.siblings('input').val();

		var data = {
			action: 'dt_ajax_update_image',
			image_id: image_update_id,
			new_image_val: new_image_val
		};

		jQuery.post(ajaxurl, data, function(response) {
			update_button.css('display', 'none');
			update_button.siblings('.dt-save').css('display', 'inline');
			if(new_image_val == ""){
				update_button.siblings('.dt-image-preview').html('');
			}
			else{
				var dt_img = '<img src="' + new_image_val + '" class="dt_image_preview" />';
				update_button.siblings('.dt-image-preview').html(dt_img);
			}
			update_button.html('update image');
		});

		return false; //Stop link click

	});


	//CLEAR OPTIONS LINK IN FOOTER
	jQuery('#dt-clear-all-settings').click(function(){

		var are_you_sure=confirm('Are you sure you want to reset? All options will be deleted if you continue.\n\nClick "Cancel" to cancel the reset or OK to continue the reset.');
		if(are_you_sure==false) return false;

		var old_h4_saving_content = jQuery('.dt-overlay-saving h4').html();
		jQuery('.dt-overlay-saving h4').html('Resetting options...');
		jQuery('.dt-overlay').show();
		jQuery('.dt-overlay-saving').fadeIn();

		var data = {
			action: 'dt_clear_options'
		};

		jQuery.post(ajaxurl, data, function(response) {
			dt_ajax_response();

			//And now reset the html to what it was
			jQuery('.dt-overlay-saving h4').html(old_h4_saving_content);

			jQuery("#dt-reset-div").slideDown(1000);

		});

		return false; //Stop link click

	});


	/******************************************************************
	* 	    	         IMPORT / EXPORT ADMIN AREA                   *
	******************************************************************/

	//IMPORT TAB UPLOAD
	jQuery('.dt_import_upload').each(function(){

		var the_button = jQuery(this);
		var the_button_val = the_button.html();
		var upload_id = the_button.attr('id');
		var file_action = the_button.prev().val();

		new AjaxUpload(upload_id, {
			  action: ajaxurl,
			  name: 'import_file',

			  // Additional data
			  data: {
				action: file_action
			  },
			  autoSubmit: true,
			  responseType: false,
			  onChange: function(file, extension){},
			  onSubmit: function(file, extension) {

					//Confirm for non-XML imports
					if(upload_id != 'upload_file_xml'){
						var are_you_sure=confirm('Are you sure you want to import these settings? You will lose earlier customizations if you do.\n\nClick "Cancel" to cancel the import or OK to continue the import');
						if(are_you_sure==false) return false;
					}

					the_button.html("Uploading...");
				},
			  onComplete: function(file, response) {

					jQuery('.dt-overlay').show();
					dt_ajax_response();
					the_button.html(the_button_val);

					if(response.search("Error") > -1){
						alert("There was an error uploading:\n"+response);
					}

				}
		});
	});


	//RESTORE TAB - SET DEFAULT THEME OPTIONS
	jQuery('#dt_default_theme_options').submit(function(){

		var are_you_sure=confirm('Are you sure you want to restore default settings? All theme options will be reset to default if you continue.\n\nClick "Cancel" to cancel the reset or OK to continue the reset');
			if(are_you_sure==false) return false;

		dt_ajax_started();
		var dt_form_values = jQuery("#dt_default_theme_options").serialize();

		jQuery.post(ajaxurl, dt_form_values, function(response) {
			dt_ajax_response();
		});

		return false; //Stop regular form submission

	});


	//RESTORE TAB - SET DEFAULT WIDGET SETTINGS
	jQuery('#dt_default_widget_settings').submit(function(){

		var are_you_sure=confirm('Are you sure you want to restore default settings? All widget settings, will be reset to default if you continue.\n\nClick "Cancel" to cancel the reset or OK to continue the reset');
			if(are_you_sure==false) return false;

		dt_ajax_started();
		var dt_form_values = jQuery("#dt_default_widget_settings").serialize();

		jQuery.post(ajaxurl, dt_form_values, function(response) {
			dt_ajax_response();
		});

		return false; //Stop regular form submission

	});


});