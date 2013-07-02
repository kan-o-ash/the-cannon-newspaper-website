// SHOW OR HIDE CATEGORY/TAG LISTS IN OPTIONS DEPENDING ON VALUES - MUST BE ON TOP OF THE FILE
jQuery(document).ready(function () {

	var initial_value = jQuery('input:radio[name=dt_posts_from]:checked').val();
	var radio_elem = jQuery('input:radio[name=dt_posts_from]:checked');

	radio_elem.parents('.option').next().addClass('sub-select').css("max-height", "262px");
	radio_elem.parents('.option').next().next().addClass('sub-select').css("max-height", "262px");

	var orig_cat_height = radio_elem.parents('.option').next().height();
	var orig_tag_height = radio_elem.parents('.option').next().next().height();

	var initial_value = jQuery('input:radio[name=dt_posts_from]:checked').val();
	var radio_elem = jQuery('input:radio[name=dt_posts_from]:checked');

	hide_list_slider(radio_elem, initial_value);

	jQuery('input:radio[name=dt_posts_from]').change(function(){
		var changed_radio_elem = jQuery('input:radio[name=dt_posts_from]:checked');
		var changed_value = jQuery('input:radio[name=dt_posts_from]:checked').val();
		hide_list_slider(changed_radio_elem, changed_value);
	});

	function hide_list_slider(radio_elem, radio_value){

		/* ORDER:
			1. Categories
			2. Tags

			radio_elem.parents('.option').next(); => 1
			radio_elem.parents('.option').next().next(); => 2

			Changes in CSS:
			- Non-display elements - height 0, border-width 0
			- Display elements - height original, border-width 1px
		*/

		if(radio_value == "any"){ //1
			radio_elem.parents('.option').css("border-width", "1px");
			radio_elem.parents('.option').next().css({"height":"0", "border-width": "0"}); //1
			radio_elem.parents('.option').next().next().css({"height":"0", "border-width": "0"}); //2
		}
		else if(radio_value == "categories"){ //1
			radio_elem.parents('.option').css("border-width", "0");
			radio_elem.parents('.option').next().css({"height":orig_cat_height, "border-width": "1px"}); //1
			radio_elem.parents('.option').next().next().css({"height":"0", "border-width": "0"}); //2
		}
		else if(radio_value == "tags"){ //2
			radio_elem.parents('.option').css("border-width", "0");
			radio_elem.parents('.option').next().css({"height":"0", "border-width": "0"}); //1
			radio_elem.parents('.option').next().next().css({"height": orig_tag_height, "border-width": "1px"});  //2
		}
		else{ //default
			radio_elem.parents('.option').css("border-width", "1px");
			radio_elem.parents('.option').next().css({"height":"0", "border-width": "0"}); //1
			radio_elem.parents('.option').next().next().css({"height":"0", "border-width": "0"}); //2
		}
	}
}); // END SHOW OR HIDE CATEGORY/TAG LISTS IN OPTIONS DEPENDING ON VALUES


// Theme options panel tabs
jQuery(document).ready(function () {
	
	//Default Action
	jQuery("ul.dt-tabs li a[rel=#home-tab]").addClass("home-tab").parent().addClass("home-tab");
	jQuery(".dt-tab-content").hide(); //Hide all content
	jQuery("ul.dt-tabs li:first").addClass("active").show(); //Activate first tab
	jQuery(".dt-tab-content:first").show(); //Show first tab content
	jQuery(".import-export ul.dt-tabs li.home").removeClass("active"); //Import/Export Page

	jQuery(".tab-footer input.dt-save").hide(); //Hide Save button for Home tab
	jQuery(".dt-tabs .toggleall").hide(); //Hide '[+] Show/Hide All Options' button for Home tab

	jQuery(".radio-img:first-child").addClass("first");

	jQuery("#dt-reset-div").hide().slideDown(1000);

	jQuery('.dt-metabox-wrap').closest('.postbox.closed').removeClass('closed');
	jQuery('#postcustom.postbox').addClass('closed');

	//On Click Event
	jQuery("ul.dt-tabs li").click(function () {
		var $this = jQuery(this);

		//If the home tab is clicked
		if($this.children('a').attr('rel') == "#home-tab"){
			jQuery('.tab-footer input.dt-save').hide(); //Hide Save button for Home tab
			jQuery('.dt-tabs .toggleall').hide(); //Hide '[+] Show/Hide All Options' button for Home tab
		}
		else{
			jQuery('.tab-footer input.dt-save').show(); //Show Save button for non-Home tab
			jQuery('.dt-tabs .toggleall').show(); //Show '[+] Show/Hide All Options' button for non-Home tab
		}

		jQuery("ul.dt-tabs li").removeClass("active"); //Remove any "active" class
	    jQuery(this).addClass("active"); //Add "active" class to selected tab
	    jQuery(".dt-tab-content").hide(); //Hide all tab content
	    var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
	    jQuery(activeTab).fadeIn(); //Fade in the active content
	    return false;
	});

	//On click event for home tab links
	jQuery('.home-tab-link').click(function(){
		var $this = jQuery(this);
		var tab_href= $this.find('a').attr('href');
		jQuery('ul.dt-tabs li a[href=' + tab_href + ']').click();
		return false;
	});
	jQuery('.home-tab-link a').click(function(){
		var $this = jQuery(this);
		var tab_href= $this.attr('href');
		jQuery('ul.dt-tabs li a[href=' + tab_href + ']').click();
		return false;
	});

	//Append 'Dashboard' link to the <ul> in the Settings Manager page
	jQuery('ul.settings-manager-ul').prepend('<li class="home-tab"><a href="?page=dt-options" class="home-tab">Dashboard</a></li>');

}); // END Theme options panel tabs


// Clickable small dashboard boxes
jQuery(document).ready(function () {
	jQuery(".options-home .box").hover(
		function () { jQuery(this).addClass("box-hover"); },
		function () { jQuery(this).removeClass("box-hover"); }
	);
	jQuery(".options-home .sm.box:not(.home-external-link)").click(function () {
		window.open(jQuery(this).find("a").attr("href"),'_top');
		return false;
	});
	jQuery(".home-external-link").click(function () {
		window.open(jQuery(this).find("a").attr("href"));
		return false;
	});
});


// Theme options toggle
jQuery(document).ready(function () {
    jQuery(".options-group").children('h3').siblings().hide(); //Close toggles initially
    //jQuery(".options-group:first").children('h3').siblings().delay(200).slideDown("medium");
    //jQuery(".options-group:first h3").addClass("active");

    jQuery(".import-export .options-group").children('h3').siblings().show(); //Open Import/Export sections
    jQuery(".import-export .options-group h3").addClass("active");

    jQuery(".options-group > h3").click(function () { //When option toggles add/remove h3 active class
        jQuery(this).toggleClass("active");
    });
    jQuery(".options-group > h3").click(function () { //When option title clicked
        jQuery(this).siblings().slideToggle("medium"); //Toggle all sibling .options when h3 clicked
    });
    jQuery(".toggleall .plus").click(function () {
		jQuery(".options-group").children('h3').siblings().show()
        jQuery(".options-group > h3").addClass("active");
        jQuery(".toggleall span").toggle();
    });
    jQuery(".toggleall .minus").click(function () {
		jQuery(".options-group").children('h3').siblings().hide()
        jQuery(".options-group > h3").removeClass("active");
        jQuery(".toggleall span").toggle();
    });
});


// Color Picker
jQuery(document).ready(function() {
	
	if(jQuery().farbtastic) {
	
		if(jQuery('.colorpicker').length != 0) {
		
			jQuery('.color-picker').each( function() {
				
				$this = jQuery(this);
				
				$name = jQuery(this).find('input').attr('name');
				
				jQuery(this).find('.colorpicker').hide();
				jQuery(this).find('.colorpicker').farbtastic('input[name^="'+$name+'"]');
				
				jQuery('.color-picker input[name^="'+$name+'"]').click(function() {
			    	jQuery(this).parent().find('.colorpicker').fadeIn();
			    });
				
			});
		
		    jQuery(document).mousedown(function() {
		        jQuery('.colorpicker').each(function() {
		            var display = jQuery(this).css('display');
		            if ( display == 'block' )
		                jQuery(this).fadeOut();
		        });
		    });
	    }
	}
	   
});



// Get Posts widget
jQuery(document).ready(function () {

	function check_getposts_dropdown(){
		dropdown=jQuery(this);
		var selected=dropdown.val();

		dropdown.parent().siblings('.dt-hide-it').hide();
		if(selected == "categories")
			dropdown.parent().siblings('#dt_cats').show();
		else if(selected == "tags")
			dropdown.parent().siblings('#dt_tags').show();
		else if(selected == "author")
			dropdown.parent().siblings('#dt_author').show();
		else{
			dropdown.parent().siblings('#dt_cats').hide();
			dropdown.parent().siblings('#dt_tags').hide();
			dropdown.parent().siblings('#dt_author').hide();
		}
	}

	jQuery('.dt-get-posts').each(function(){
		var dropdown=jQuery(this);
		var selected=dropdown.val();

		dropdown.parent().siblings('.dt-hide-it').hide();
		if(selected == "categories")
			dropdown.parent().siblings('#dt_cats').show();
		else if(selected == "tags")
			dropdown.parent().siblings('#dt_tags').show();
		else if(selected == "author")
			dropdown.parent().siblings('#dt_author').show();
		else{
			dropdown.parent().siblings('#dt_cats').hide();
			dropdown.parent().siblings('#dt_tags').hide();
			dropdown.parent().siblings('#dt_author').hide();
		}
	});

	jQuery('.dt-get-posts').live('change', function(){
		var dropdown=jQuery(this);
		var selected=dropdown.val();

		dropdown.parent().siblings('.dt-hide-it').hide();
		if(selected == "categories")
			dropdown.parent().siblings('#dt_cats').show();
		else if(selected == "tags")
			dropdown.parent().siblings('#dt_tags').show();
		else if(selected == "author")
			dropdown.parent().siblings('#dt_author').show();
		else{
			dropdown.parent().siblings('.dt-hide-it').hide();
		}
	});

}); // END Get Posts widget

