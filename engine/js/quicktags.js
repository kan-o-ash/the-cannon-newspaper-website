edButtons[edButtons.length] = new edButton(
	'dt_contact_shortcode',
	'contact form',
	'[contact-form]' + "\n" + '',
	'',
	'',
	-1
);

edButtons[edButtons.length] = new edButton(
	'dt_sitemap_shortcode',
	'sitemap',
	'[sitemap]' + "\n" + '',
	'',
	'',
	-1
);

edButtons[edButtons.length] = new edButton(
	'dt_archives_shortcode',
	'archives',
	'[archives]' + "\n" + '',
	'',
	'',
	-1
);

edButtons[edButtons.length] = new edButton(
	'dt_hr_snippet',
	'divider',
	'<hr />' + "\n" + '',
	'',
	'',
	-1
);

edButtons[edButtons.length] = new edButton(
	'dt_tabs_snippet',
	'tabs',
	'<!--BEGIN .tabs -->' + "\n" + '<div class="tabber">' + "\n" + '' + "\t" + '<ul class="tabs">' + "\n" + '' + "\t" + '' + "\t" + '<li><a href="#">Tab 1</a></li>' + "\n" + '' + "\t" + '' + "\t" + '<li><a href="#">Tab 2</a></li>' + "\n" + '' + "\t" + '' + "\t" + '<li><a href="#">Tab 3</a></li>' + "\n" + '' + "\t" + '</ul>' + "\n" + '' + "\t" + '<div class="panes">' + "\n" + '' + "\t" + '' + "\t" + '<div class="pane">First tab content pane.</div>' + "\n" + '' + "\t" + '' + "\t" + '<div class="pane">Second tab content pane.</div>' + "\n" + '' + "\t" + '' + "\t" + '<div class="pane">Third tab content pane.</div>' + "\n" + '' + "\t" + '</div>' + "\n" + '</div>' + "\n" + '<!--END .tabs -->' + "\n" + '' + "\n" + '',
	'',
	'',
	-1
);

edButtons[edButtons.length] = new edButton(
	'dt_accordion_snippet',
	'accordion',
	'<!--BEGIN .accordion -->' + "\n" + '<div class="accordion">' + "\n" + '' + "\t" + '<a href="#" class="trigger current">Accordion 1</a>' + "\n" + '' + "\t" + '<div class="pane current">First accordion content pane.</div>' + "\n" + '' + "\t" + '<a href="#" class="trigger">Accordion 2</a>' + "\n" + '' + "\t" + '<div class="pane">Second accordion content pane.</div>' + "\n" + '' + "\t" + '<a href="#" class="trigger">Accordion 3</a>' + "\n" + '' + "\t" + '<div class="pane">Third accordion content pane.</div>' + "\n" + '</div>' + "\n" + '<!--END .accordion -->' + "\n" + '' + "\n" + '',
	'',
	'',
	-1
);

edButtons[edButtons.length] = new edButton(
	'dt_toggle_snippet',
	'toggle',
	'<!--BEGIN .toggle -->' + "\n" + '<div class="toggle">' + "\n" + '' + "\t" + '<a href="#" class="trigger">Toggle Trigger</a>' + "\n" + '' + "\t" + '<div class="pane">Toggle content pane.</div>' + "\n" + '</div>' + "\n" + '<!--END .toggle -->' + "\n" + '' + "\n" + '',
	'',
	'',
	-1
);


/* Examples ////

// preformatted text for including code in a post
edButtons[edButtons.length] = new edButton(
	'ed_pre',
	'pre',
	'<pre lang="css" line="1">',
	'</pre>',
	''
);

// definition list
edButtons[edButtons.length] = new edButton(
	'ed_dl',
	'dl',
	'<dl>\n',
	'</dl>\n\n',
	''
);

// definition list - definition term
edButtons[edButtons.length] = new edButton(
	'ed_dt',
	'dt',
	'\t<dt>',
	'</dt>\n',
	''
);

// definition list - definition description
edButtons[edButtons.length] = new edButton(
	'ed_dd',
	'dd',
	'\t<dd>',
	'</dd>\n',
	''
);

// tab character
edButtons[edButtons.length] = new edButton(
	'ed_tab',
	'tab',
	'\t',
	'',
	'',
	-1
);

//// End Examples */


jQuery(window).load(function () {
	jQuery("<br />").insertBefore("#qt_content_dt_contact_shortcode");
});