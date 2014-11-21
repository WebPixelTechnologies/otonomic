// On DOM ready
var otonomic_analytic_fb_label='';
; jQuery(document).ready(function ($) {

    function set_button_for_media_gallery_options(el, opts) {

        // TODO: find out why this gets called 2 extra (!!) times with no arguments
        // this is just an ugly hack around an unsolved bug:
        if (!opts) return;

        opts.category = document.title;
        opts.action = 'Media Library';
        opts.label = el.attr('id');
    }

    function set_admin_menu_options(el, opts) {
        // get path of (li > a) patterns (nested menu items) and set it as label
        var path = [el.text()];
        el.parents('li').each(function (i) {
            if (!i) return;
            var child_as = $(this).children('a');
            if (child_as.length) {
                path.unshift(child_as.text());
            }
        });
        var label = path.join(' / ');
        if (label.length) opts.label = label;

        // "guess" category from the top parent menu id or class, if not already set
        if (!opts.category) {
            var top_parent_menu = el.closest('ul:not(.wp-submenu)');
            var category = top_parent_menu.attr('id') || top_parent_menu.attr('class');
            if (category) opts.category = category;
        }
    }

    function set_help_screen_options(el, opts) {
        opts.category = "Top Bar";
        opts.action = "Help";
        opts.label = $('title').text();
        if( $('a', el).hasClass('screen-meta-active')) {
            opts.action = "Help Close";
        } else {
            opts.action = "Help Open";
        }

    }

    function set_share_popup_button_options(el, opts) {
        opts.category = "Share Popup";
        opts.action = el.attr('data-platform');
    }

	function set_delete_site_popup_button_options(el, opts) {
		opts.category = "Delete Popup";
		opts.action = el.attr('data-action');
	}

	function set_welcome_popup_button_options(el, opts) {
		opts.category = "Welcome Popup";
		opts.action = el.attr('data-action');
	}

    function set_domain_page_search_options(el, opts) {
        opts.category = "Domain Page";
        opts.action = "Search";
        opts.label = $('#domain-search-box').val();
    }



    /**
     * Event Tracking handlers
     */

    /// - Phase 1: track specific events:

    // Edit section link (front-end)
    // TODO: track *which* section
    $('.otonomic_edit_link').otonomicTrackEvent({
        category: "Template Engagement",
        action: "Edit Hook",
		label: {attr: "data-analytic-label"}
    });

    // Locked elements (front-end)
    $("#updates .otonomic-locked").otonomicTrackEvent({
        category: "Updates",
        action: "Locked"
    });
    $("#testimonials .otonomic-locked").otonomicTrackEvent({
        category: "Recommendations",
        action: "Locked"
    });
    $("#photos .otonomic-locked").otonomicTrackEvent({
        category: "Photo Albums",
        action: "Locked"
    });

    // Upgrade hooks/messages

	// upgrade button click
    $(".otonomic-upgrade-message").otonomicTrackEvent({
        category: "Upgrade Engagement",
        action: "Button Click",
		label: "{current_page_title}"
    });

	// upgrade banner click backend


	$('#wpwrap').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook',
		category: "Upgrade Engagement",
		action: "Upgrade Hook",
		options_callback: function (el, options, event) {
			// don't track the upgrade button click again
			//if ($(event.target).closest('.button-holder').length) return false;
			options.label = el.parent().parent().attr('data-analytic-category');
		}
	});
	$('#wpwrap').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook .close',
		category: "Upgrade Engagement",
		action: "Upgrade Hook Close",
		options_callback: function (el, options, event) {
			// don't track the upgrade button click again
			//if ($(event.target).closest('.button-holder').length) return false;
			options.label = el.parent().parent().parent().parent().parent().attr('data-analytic-category');
		}
	});
	/* Front */
	$('#photos').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook',
		category: "Upgrade Engagement",
		action: "Upgrade Hook",
		label: "Photos Template"
	});
	$('#photos').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook .close',
		category: "Upgrade Engagement",
		action: "Upgrade Hook Close",
		label: "Photos Template"
	});

	$('#updates').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook',
		category: "Upgrade Engagement",
		action: "Upgrade Hook",
		label: "Updates Template"
	});
	$('#updates').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook .close',
		category: "Upgrade Engagement",
		action: "Upgrade Hook Close",
		label: "Updates Template"
	});
	$('#updates').otonomicTrackEvent({
		selector: '.otonomic-lock',
		category: "Upgrade Engagement",
		action: "Lock",
		label: "Updates Template"
	});

	/* testimonial */
	$('#testimonials').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook',
		category: "Upgrade Engagement",
		action: "Upgrade Hook",
		label: "Testimonials Template"
	});
	$('#testimonials').otonomicTrackEvent({
		selector: '.otonomic-upgrade-hook .close',
		category: "Upgrade Engagement",
		action: "Upgrade Hook Close",
		label: "Testimonials Template"
	});
	$('#testimonials').otonomicTrackEvent({
		selector: '.otonomic-lock',
		category: "Upgrade Engagement",
		action: "Lock",
		label: "Testimonials Template"
	});





    // Main Admin Menu
    $('ul#adminmenu li > a').otonomicTrackEvent({
        category: "Admin side menu",
        options_callback: set_admin_menu_options
    });



    // Preview button (back-end)
    $("#wpadminbar a").otonomicTrackEvent({
        category: "Service Toolbar",
        action: "{text}"
    });

    // Media gallery click
    $('a.open-mediagal-popup').otonomicTrackEvent({
        options_callback: set_button_for_media_gallery_options
    });

    // AddThis Social Share click
    $('.at-share-btn span').otonomicTrackEvent({
        category: "AddThis Share",
        options_callback: function(el, opts) {
            opts.action = el.attr('title');
        }
    });

    // Pricing Page Plan Click (to get to checkout page)
    $('a.pay_link').otonomicTrackEvent({});

    // Pricing Page Plan Length (yearly/monthly)
    $('#pricing_page .btn-payment-plan').otonomicTrackEvent({
        category: "Pricing",
        action: "Change Plan"
    });

    // Pricing Page Like/Share
    $('#likes-div').otonomicTrackEvent({
        selector: '.like-div',
        category: "Pricing",
        action: "Like/Share",
        label: "{title}"
    });


    // Admin Help Tab open/close
    $('#wpbody').otonomicTrackEvent({

        options_callback: set_help_screen_options
    });

    // Delete site popup
    $('#deletesite-popup-action-links a').otonomicTrackEvent({
        options_callback: set_delete_site_popup_button_options
    });
	/* Close event tracking */
	$('body').otonomicTrackEvent({
		selector: '.deletesite-popup #cboxClose',
		category: "Delete Popup",
		action: "Close"
	});

    // Welcome site popup
    $('#welcome-popup-action-links a').otonomicTrackEvent({
        options_callback: set_welcome_popup_button_options
    });

    // Close Colorbox popup
    $('body').otonomicTrackEvent({
		selector: '#cboxClose',
        category: "Popup",
        action: "Close"
    });

    // Search domain name
    $('#domain-search-btn').otonomicTrackEvent({
        options_callback: set_domain_page_search_options
    });



    // First Session Admin Screens Navigation Buttons
    $('#cboxLoadedContent').otonomicTrackEvent({
        selector: "a.add-app",
        category: "App Market",
        action: "Add",
        label: "{text}"
    });

	// First Session Admin Screens Navigation Buttons
	$('#wpbody').otonomicTrackEvent({
		selector: "#wpfooter-first-session a, #wpfooter-first-session button",
		options_callback: function(el, opts) {
			opts.category = el
                .parents('#wpbody-content')
                .find('.ot-admin-page-container .wrap.first-session')
                .attr('data-analytic-category');
		},
		action: "{text}"
		// label: "{text}"
	});

	/* Business Profile */
	$('#wpbody').otonomicTrackEvent({
		selector: '.business-identity .open-mediagal-popup',
		category: "Business Profile Editor",
		label: "",
		action: {attr: "data-analytics-action"}
	});

	/* Store Editor */
	$('#wpbody .online-store').otonomicTrackEvent({
		selector: '.product-remove-btn, .store-confirm-action a',
		category: "Store Editor",
		label: "",
		action: {attr: "data-analytics-action"}

	});
	/*$('#wpbody .online-store').otonomicTrackEvent({
		selector: '',
		category: "Store Editor",
		label: "",
		action: {attr: "data-analytics-action"}

	});*/

	/* Domain Editor */
	$('#wpbody').otonomicTrackEvent({
		selector: '.domain-search-btn',
		category: "Domain Editor",
		label: "",
		action: 'Search'

	});
	/* Domain Upgrade */
	$('#wpbody').otonomicTrackEvent({
		selector: '.btn-red',
		category: "Domain Editor",
		options_callback: function(el, opts) {
			var category = el.parent('p').parent('#wpfooter-first-session').parent('#wpbody-content').find('.ot-admin-page-container .wrap.first-session').attr('data-analytic-category');
			if(category == 'Domain Editor')
			{
				search_box = $("#domain-search-box").val();
				if(search_box.length>0)
				{
					/* May be suggestion */
					if($('.error-box').hasClass('ng-hide'))
					{
						opts.action = 'Search';
					}
					else
					{
						opts.action = 'Suggestion';
					}
				}
				else
				{
					opts.action = 'Default';
				}
			}
			else
			{
				return false;
			}
		}

	});

	/* Social Media Editor */
	$('#wpbody .social-media').otonomicTrackEvent({
		selector: 'ul.nav li a',
		category: "Social Media Editor",
		label: {attr:"data-service"},
		action: 'Channel Click'
	});

	/* Recommendations Editor */
	$('#wpbody .customer-reviews').otonomicTrackEvent({
		selector: '.review',
		category: "Recommendations Editor",
		label: "",
		options_callback: function(el, opts) {
			opts.action = el.hasClass('status-hidden')?'Hide':'Show';
		}

	});


	/* Welcome popup */
	/*$('#welcome-overlay').otonomicTrackEvent({
		iframe: true,
		selector: ".btn, .not-now-link, .otonomic-track",
		category: "Welcome Popup",
		action: {attr: "data-action"},
		label: ""

	});*/
	/* Front end image click */
	$('#photos img').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Image Click",
		label: ''
	});
	/* Bottom banner */
	$('#bottom_bar').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Bottom Banner",
		label: ''
	});
	/* Blog posts */
	$('#updates .post').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Blog Post Click",
		label: ''
	});
	/* Read more for blog */
	$('#updates .shortcode.button').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Read More Blog",
		label: ''
	});
	/* Submit booking */
	$('#birs_book_appointment').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Submit Booking",
		label: ''
	});
	/* Send contact */
	$('.wpcf7-submit').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Send Contact",
		label: ''
	});
	$('.back-top').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Back to top",
		label: ''
	});
	$('body').otonomicTrackEvent({
		selector: '#uvTab',
		category: "Template Engagement",
		action: "Feedback and Support",
		label: ''
	});
	$('ul.main-nav li.menu-item a').otonomicTrackEvent({
		category: "Template Engagement",
		action: "Menu Click",
		label: '{text}'
	});
	$('body').otonomicTrackEvent({
		selector: '.appmarket-popup #cboxClose',
		category: "App Store",
		action: "Close"
	});

	/* Facebook connect events */
	$('body').otonomicTrackEvent({
		selector: '.facebook_connect',
		category: "Facebook Connect",
		action: "Start",
		options_callback: function(el, opts) {
			var label = el.attr('data-analytics-label');
			if(label == undefined) {
				label = otonomic_analytic_fb_label;
			}
			else
			{
				otonomic_analytic_fb_label = label;
			}
			opts.label = label;
		}
	});



    /* Generic click events */
    $('body').otonomicTrackEvent({
        selector: 'a',
        category: '{current_page_title}',
        action: "Click",
        options_callback: function(el, opts) {
            var label = el.attr('data-analytics-label');
            if(label == undefined) {
                label = el.attr('title');
            }
            if(label == undefined) {
                label = el.attr('id');
            }
            if(label == undefined) {
                label = el.text().trim();
            }
            opts.label = label;
        }
    });





    // Put events tracked in Pop ups that use iframe here
    $(document).on('cbox_complete', function() {
        $('iframe.cboxIframe').contents().ready(function(){
            setTimeout(function(){
                var iframebody = $('iframe.cboxIframe').contents().find('body');

                iframebody.otonomicTrackEvent({
                    selector: ".otonomic-share-button",
                    category: "Share Popup",
                    action: "Share",
                    label: {attr: "data-platform"}
                });

                // App Market Add App Buttons
                iframebody.otonomicTrackEvent({
                    selector: "a.add-app",
                    category: "App Market",
                    action: "Add",
                    label: "{text}"
                });
				//jQuery('.title',iframebody).click(function (){alert('Here');});
				/* App market popup */
				jQuery('#oto-apps-container a.btn',iframebody).otonomicTrackEvent({
					iframe: false,
					category: "App Store",
					action: "Add App",
					label: {attr: "data-app-name"}
				});
				jQuery('#appmarket-carousel a.btn',iframebody).otonomicTrackEvent({
					iframe: false,
					category: "App Store",
					action: "Hero",
					label: {attr: "data-app-name"}
				});



                iframebody.otonomicTrackEvent({
                    selector: 'a',
                    category: '{current_page_title}',
                    action: "Click",
                    options_callback: function(el, opts) {
                        var label = el.attr('data-analytics-label');
                        if(label == undefined) {
                            label = el.attr('title');
                        }
                        if(label == undefined) {
                            label = el.attr('id');
                        }
                        if(label == undefined) {
                            label = el.text().trim();
                        }
                        opts.label = label;
                    }
                });


				/*iframebody.otonomicTrackEvent({
					iframe: false,
					selector: "a",
					category: "App Store",
					action: "Add App",
					label: {attr: "data-app-name"}
				});*/

            }, 2500);
        });
    });

//	}, 300);
});

//	setTimeout(function () {
