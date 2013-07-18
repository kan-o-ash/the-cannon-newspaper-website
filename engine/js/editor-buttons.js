(function() {
    tinymce.create('tinymce.plugins.DT', {
        init : function(ed, url) {
            ed.addButton('dt');
            ed.addButton('dt_contact_shortcode', {
                title : 'Insert contact form shortcode',
                image : 'http://dl.dropbox.com/u/2494752/dt/icons/editor-contact.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, '[contact-form]' + "\n" + '');
                }
            });
            ed.addButton('dt_sitemap_shortcode', {
                title : 'Insert sitemap shortcode',
                image : 'http://dl.dropbox.com/u/2494752/dt/icons/editor-sitemap.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, '[sitemap]' + "\n" + '');
                }
            });
            ed.addButton('dt_archives_shortcode', {
                title : 'Insert archives shortcode',
                image : 'http://dl.dropbox.com/u/2494752/dt/icons/editor-archives.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, '[archives]' + "\n" + '');
                }
            });
            ed.addButton('dt_hr_snippet', {
                title : 'Insert divider',
                image : 'http://dl.dropbox.com/u/2494752/dt/icons/editor-hr.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, '<hr />' + "\n" + '');
                }
            });
			ed.addButton('dt_tabs_snippet', {
                title : 'Insert tabs example',
                image : 'http://dl.dropbox.com/u/2494752/dt/icons/editor-tabs.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, '<!--BEGIN .tabs -->' + "\n" + '<div class="tabber">' + "\n" + '' + "\t" + '<ul class="tabs">' + "\n" + '' + "\t" + '' + "\t" + '<li><a href="#">Tab 1</a></li>' + "\n" + '' + "\t" + '' + "\t" + '<li><a href="#">Tab 2</a></li>' + "\n" + '' + "\t" + '' + "\t" + '<li><a href="#">Tab 3</a></li>' + "\n" + '' + "\t" + '</ul>' + "\n" + '' + "\t" + '<div class="panes">' + "\n" + '' + "\t" + '' + "\t" + '<div class="pane">First tab content pane.</div>' + "\n" + '' + "\t" + '' + "\t" + '<div class="pane">Second tab content pane.</div>' + "\n" + '' + "\t" + '' + "\t" + '<div class="pane">Third tab content pane.</div>' + "\n" + '' + "\t" + '</div>' + "\n" + '</div>' + "\n" + '<!--END .tabs -->' + "\n" + '' + "\n" + '');
                }
            });
            ed.addButton('dt_accordion_snippet', {
                title : 'Insert accordion example',
                image : 'http://dl.dropbox.com/u/2494752/dt/icons/editor-accordion.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, '<!--BEGIN .accordion -->' + "\n" + '<div class="accordion">' + "\n" + '' + "\t" + '<a href="#" class="trigger current">Accordion 1</a>' + "\n" + '' + "\t" + '<div class="pane current">First accordion content pane.</div>' + "\n" + '' + "\t" + '<a href="#" class="trigger">Accordion 2</a>' + "\n" + '' + "\t" + '<div class="pane">Second accordion content pane.</div>' + "\n" + '' + "\t" + '<a href="#" class="trigger">Accordion 3</a>' + "\n" + '' + "\t" + '<div class="pane">Third accordion content pane.</div>' + "\n" + '</div>' + "\n" + '<!--END .accordion -->' + "\n" + '' + "\n" + '');
                }
            });
            ed.addButton('dt_toggle_snippet', {
                title : 'Insert toggle example',
                image : 'http://dl.dropbox.com/u/2494752/dt/icons/editor-toggle.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, '<!--BEGIN .toggle -->' + "\n" + '<div class="toggle">' + "\n" + '' + "\t" + '<a href="#" class="trigger">Toggle Trigger</a>' + "\n" + '' + "\t" + '<div class="pane">Toggle content pane.</div>' + "\n" + '</div>' + "\n" + '<!--END .toggle -->' + "\n" + '' + "\n" + '');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('dt', tinymce.plugins.DT);
})();