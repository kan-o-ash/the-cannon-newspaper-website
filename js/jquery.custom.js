/*-----------------------------------------------------------------------------------

 	Custom JS - All custom front-end jQuery

-----------------------------------------------------------------------------------*/

/*
 * Direction-Aware Hover Effect
 * http://tympanus.net/codrops/2012/04/09/direction-aware-hover-effect-with-css3-and-jquery/
 */
(function(a,b){a.HoverDir=function(b,c){this.$el=a(c);this._init(b)};a.HoverDir.defaults={hoverDelay:0,reverse:false};a.HoverDir.prototype={_init:function(b){this.options=a.extend(true,{},a.HoverDir.defaults,b);this._loadEvents()},_loadEvents:function(){var b=this;this.$el.on("mouseenter.hoverdir, mouseleave.hoverdir",function(c){var d=a(this),e=c.type,f=d.find("div"),g=b._getDir(d,{x:c.pageX,y:c.pageY}),h=b._getClasses(g);f.removeClass();if(e==="mouseenter"){f.hide().addClass(h.from);clearTimeout(b.tmhover);b.tmhover=setTimeout(function(){f.show(0,function(){a(this).addClass("da-animate").addClass(h.to)})},b.options.hoverDelay)}else{f.addClass("da-animate");clearTimeout(b.tmhover);f.addClass(h.from)}})},_getDir:function(a,b){var c=a.width(),d=a.height(),e=(b.x-a.offset().left-c/2)*(c>d?d/c:1),f=(b.y-a.offset().top-d/2)*(d>c?c/d:1),g=Math.round((Math.atan2(f,e)*(180/Math.PI)+180)/90+3)%4;return g},_getClasses:function(a){var b,c;switch(a){case 0:!this.options.reverse?b="da-slideFromTop":b="da-slideFromBottom";c="da-slideTop";break;case 1:!this.options.reverse?b="da-slideFromRight":b="da-slideFromLeft";c="da-slideLeft";break;case 2:!this.options.reverse?b="da-slideFromBottom":b="da-slideFromTop";c="da-slideTop";break;case 3:!this.options.reverse?b="da-slideFromLeft":b="da-slideFromRight";c="da-slideLeft";break}return{from:b,to:c}}};var c=function(a){if(this.console){console.error(a)}};a.fn.hoverdir=function(b){if(typeof b==="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var e=a.data(this,"hoverdir");if(!e){c("cannot call methods on hoverdir prior to initialization; "+"attempted to call method '"+b+"'");return}if(!a.isFunction(e[b])||b.charAt(0)==="_"){c("no such method '"+b+"' for hoverdir instance");return}e[b].apply(e,d)})}else{this.each(function(){var c=a.data(this,"hoverdir");if(!c){a.data(this,"hoverdir",new a.HoverDir(b,this))}})}return this}})(jQuery)

/*-----------------------------------------------------------------------------------*/
/*	Let's dance
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() {


/*-----------------------------------------------------------------------------------*/
/*	Extras
/*-----------------------------------------------------------------------------------*/

  jQuery("#filter li:nth-child(6)").click(function(){
    jQuery(".dashboardbg").css("display","block"); 
  });
   jQuery("#filter li:nth-child(1)").click(function(){
    jQuery(".dashboardbg").css("display","none"); 
  });
jQuery("#filter li:nth-child(2)").click(function(){
    jQuery(".dashboardbg").css("display","none"); 
  });
jQuery("#filter li:nth-child(3)").click(function(){
    jQuery(".dashboardbg").css("display","none"); 
  });
jQuery("#filter li:nth-child(4)").click(function(){
    jQuery(".dashboardbg").css("display","none"); 
  });
jQuery("#filter li:nth-child(5)").click(function(){
    jQuery(".dashboardbg").css("display","none"); 
  });
jQuery("#filter li:nth-child(7)").click(function(){
    jQuery(".dashboardbg").css("display","none"); 
  });



	jQuery(".tabber ul.tabs").tabs(".tabber div.panes > div", {
		effect: 'fade'
	});

	jQuery(".accordion").tabs(".accordion div.pane", {
		tabs: '.trigger', effect: 'slide', initialIndex: null
	});

	jQuery('.toggle .trigger').bind('click', function() {
		var maketoggle = jQuery(this).parent('.toggle').find('.pane');
		jQuery(maketoggle).slideToggle();
		jQuery(this).toggleClass('open');
		return false;
	});

	jQuery('<div class="clear">&nbsp;</div>').insertAfter('.column-last');


/*-----------------------------------------------------------------------------------*/
/*	Menu Settings - http://users.tpg.com.au/j_birch/plugins/superfish/
/*-----------------------------------------------------------------------------------*/

	jQuery('#primary-menu ul, #secondary-menu ul').superfish({
		delay: 0,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		autoArrows: false,
		dropShadows: false
	});
	
	jQuery("#primary-menu ul ul, #secondary-menu ul ul").each(
	function (i) {
	    jQuery(this).hover( // Preserves the mouse-over on top-level menu elements when hovering over children
		    function () {
		        jQuery(this).parent().find("a").slice(0, 1).addClass("active");
		    }, function () {
		        jQuery(this).parent().find("a").slice(0, 1).removeClass("active");
	    });
	    jQuery(this).parent().find("a").addClass("parent");
	  
	});
	
	jQuery('#primary-menu ul ul').each( function() {
		
		var parent = jQuery(this).parent().outerWidth()+20;
		var diff = 220 - parent;
		jQuery(this).css({
			width: '200px',
			marginLeft: -diff / 2
		});
		
	});
	
	if(jQuery().mobileMenu) {
		jQuery('#mobile-menu .menu').mobileMenu();
	}
	

/*-----------------------------------------------------------------------------------*/
/*	FitVids - http://fitvidsjs.com/
/*-----------------------------------------------------------------------------------*/
	
	if(jQuery().fitVids) {
		jQuery(".single #page, .page #page").not('.page.page-template-template-showcase-php #page').fitVids();
	}


/*-----------------------------------------------------------------------------------*/
/*	Lightbox
/*-----------------------------------------------------------------------------------*/

	function dt_lightbox() {

		if(jQuery().colorbox) {

			jQuery(".gallery a").not('#slide-controls a').colorbox({
				maxWidth: '90%',
			 	maxHeight: '90%'
			});

			jQuery("a.colorbox-video").colorbox({
				inline: true,
				href: jQuery(this).attr('href')
			});

			jQuery("a.colorbox-image, a.colorbox-gallery").each(function(){
			 	jQuery(this).colorbox({
			 		rel: jQuery(this).attr('data-gallery'),
			 		maxWidth: '90%',
			 		maxHeight: '90%'
			 	});
			});

		}

	}

	dt_lightbox();


/*-----------------------------------------------------------------------------------*/
/*	Portfolio Filtering
/*-----------------------------------------------------------------------------------*/
	
	if(jQuery().isotope) {
	
		$container = jQuery('#masonry');
		
		$container.imagesLoaded( function() {
			
			$container.isotope({
	  	    	itemSelector : '.item',
	  	    	masonry: {
	  			    columnWidth: 320
	  			},
	  			getSortData: {
	
		  			order: function($elem) {
		  				return parseInt($elem.attr('data-order'));
		  			}
	
	  			},
	  			sortBy: 'order'
	  	    }, function() {
		    	dt_getposts();
		    	// Isotope Chrome Fix	
				setTimeout(function () {		
					jQuery('#masonry').isotope('reLayout');	
				}, 1000);
		
		   	});


		});

  	    // filter items when filter link is clicked
		jQuery('#filter li').click(function(){

			jQuery('#filter li').removeClass('active');
			jQuery(this).addClass('active');

			var selector = jQuery(this).find('a').attr('data-filter');

			$container.isotope({ filter: selector });

	        return false;

		});
		
		

  	}


/*-----------------------------------------------------------------------------------*/
/*	Load More Button
/*-----------------------------------------------------------------------------------*/

	//var dt = false;

	function dt_getposts(pageNum, max, nextLink, count) {

	 	if(typeof dt != 'undefined') {

		 	jQuery('#load-more.disabled').click(function() { return false; });

			if(!pageNum) {
				// The number of the next page to load (/page/x/).
				var pageNum = parseInt(dt.startPage) + 1;
			}

			if(!max) {
				// The maximum number of pages the current query can return.
				var max = parseInt(dt.maxPages);
			}

			if(!nextLink) {
				// The link of the next page of posts.
				var nextLink = dt.nextLink;
			}

			if(!count) {
				var count = parseInt(jQuery('.count').text());
			}

			/**
			 * Replace the traditional navigation with our own,
			 * but only if there is at least one page of new posts to load.
			 */
			if(pageNum <= max) {

				// Remove the traditional navigation.
				jQuery('.post-navigation').remove();

			} else {

				jQuery('#load-more').addClass('disabled');

			}

			/**
			 * Load new posts when the link is clicked.
			 */
			jQuery('#load-more').not('.disabled').click(function() {

				jQuery(this).unbind('click', dt_getposts());

				// Are there more posts to load?
				if(pageNum <= max) {

					// Show that we're working.
					//jQuery(this).text('Loading posts...');

					jQuery('#detail-holder').fadeOut(200, function(){
						jQuery('#loader').fadeIn(200);
					});

					jQuery('#masonry-new').load(nextLink + ' .item.normal',
						function() {

							var $newEls = jQuery( '#masonry-new .item.normal' );
							
							$newEls.imagesLoaded( function() {
						    
							    jQuery('#masonry').isotope( 'insert', $newEls, function() {
	
							  		dt_hover();
							  		dt_lightbox();
	
									// Update page number and nextLink.
									pageNum++;
									nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
	
									// Update the button message.
									if(pageNum <= max) {
	
										jQuery('#loader').fadeOut(200, function () {
	
											count = count - parseInt(jQuery('#loader').attr('data-perpage'));
											jQuery('.count').text(count);
											jQuery('#detail-holder').fadeIn(200);
											jQuery('#load-more').bind('click', dt_getposts(pageNum, max, nextLink, count));
											jQuery('#loader').fadeOut(200);
											
										});
	
									} else {
	
										jQuery('#loader').fadeOut(200, function () {
	
											jQuery('#load-more').addClass('disabled');
											jQuery('.count').text('0');
											jQuery('#detail-holder').fadeIn(200);
											jQuery('#load-more').bind('click', dt_getposts(pageNum, max, nextLink, count));
											jQuery('#loader').fadeOut(200);
	
										});
	
									}
	
							  	});
						  	
						  	});
						}
					);
				}

				return false;
				
				

			});

		}

	}


/*-----------------------------------------------------------------------------------*/
/*	Show #backtotop link after scrollTop length
/*-----------------------------------------------------------------------------------*/

	jQuery(window).bind('scroll', function(){
		jQuery('#backtotop').toggle(jQuery(this).scrollTop() > 200);
	});


/*-----------------------------------------------------------------------------------*/
/*	Tabber widget
/*-----------------------------------------------------------------------------------*/

	var list = '<ul class="tabs clearfix">';
	jQuery('#sidebar .tabber').find('h3.widget-title').each(function () {
	    var the_title = jQuery(this).html();
	    list += '<li><a href="#">' + the_title + '</a></li>';
	});
	list += '</ul>';
	jQuery('#sidebar .tabber').prepend(list);
	jQuery("#sidebar .tabber .tabs").tabs("#sidebar .tabber .widget", { // requires jquerytools.js
	    //effect: 'fade'
	});


/*-----------------------------------------------------------------------------------*/
/*	Randomizer
/*-----------------------------------------------------------------------------------*/

    jQuery.fn.randomize = function (childElem) {
        return this.each(function () {
            var jQuerythis = jQuery(this);
            var elems = jQuerythis.find(childElem);
            elems.sort(function () {
                return (Math.round(Math.random()) - 0.5);
            });
            jQuerythis.remove(childElem);
            for (var i = 0; i < elems.length; i++)
            jQuerythis.append(elems[i]);
        });
    }

    //RANDOMIZE (ADS)
	jQuery(".ads-inside.random").randomize("a");


/*-----------------------------------------------------------------------------------*/
/*	Contact Form
/*-----------------------------------------------------------------------------------*/

	jQuery.fn.exists = function () { // Check if element exists
	    return jQuery(this).length;
	}
	jQuery('.dt-contactform').submit(function () {
	    var cf = jQuery(this);
	    cf.prev('.alert').slideUp(400, function () {
	        cf.prev('.alert').hide();
	        jQuery.post(ajaxurl, {
	            name: cf.find('.dt-name').val(),
	            email: cf.find('.dt-email').val(),
	            subject: cf.find('.dt-subject').val(),
	            comments: cf.find('.dt-comments').val(),
	            verify: cf.find('.dt-verify').val(),
	            action: 'dt_contact_form'
	        }, function (data) {
	            cf.prev('.alert').html(data);
	            cf.prev('.alert').slideDown('slow');
	            cf.find('img.loader').fadeOut('slow', function () {
	                jQuery(this).remove()
	            });
	            if (data.match('success') != null) cf.slideUp('slow');
	        });
	    });
	    return false;
	});


/*-----------------------------------------------------------------------------------*/
/*	Slides.js Settings - http://slidesjs.com/
/*-----------------------------------------------------------------------------------*/
	
	if(jQuery().camera) {
	
		jQuery('#slides').camera({ //here I declared some settings, the height and the presence of the thumbnails 
				pagination: true,
				height: '425px',
				loaderBgColor: '#333',
				loaderColor: '#ddd'
		});
		
	}

	function dt_sliderInit() {

		if(jQuery().slides) {

			$controls = jQuery('.next, .prev');
			
			jQuery('#single-slides').slides({
				effect: 'fade',
				fadeSpeed: 400,
				crossfade: false,
				generatePagination: false,
				preload: false,
				autoHeight: true,
				slidesLoaded: function () { 
			
					$control = jQuery("#single-slides .slides_control"); 
						
					jQuery('.slides_control').imagesLoaded( function() {
						
						$imageHeight = jQuery('.slides_control div:first img').height();
						
						jQuery('#single-slides .slides_container').css({
							height: 'auto'
						});
						
						$control.css({
							height: $imageHeight,
							opacity: 0
						});
						
						$control.animate({ 
							opacity: 1 
						}, 200,function() {
							
							jQuery('#single-slides .slides_container').css({
								background: 'none'
							});
						
						} );
						
						//console.log('Image Height: '+$imageHeight);
						
					});
					
				}
			});

		}
		
	}

	dt_sliderInit();


/*-----------------------------------------------------------------------------------*/
/*	Direction-Aware Hover Effect
/*-----------------------------------------------------------------------------------*/
	
	function dt_hover() {
		jQuery('.featured-image').not('.single .hentry .featured-image').hoverdir();
	}
	
	dt_hover();
  

/*-----------------------------------------------------------------------------------*/
/*	We've finished dancing!
/*-----------------------------------------------------------------------------------*/

});


/*-----------------------------------------------------------------------------------*/
/*	Plugins
/*-----------------------------------------------------------------------------------*/

/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 5/25/2009
 * @author Ariel Flesler
 * @version 1.4.2
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);




