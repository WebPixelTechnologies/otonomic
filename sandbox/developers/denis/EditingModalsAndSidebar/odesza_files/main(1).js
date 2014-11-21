// OtonomicTrackEvent jQuery Plugin definition
(function ($) {
	'use strict';

    $.fn.otonomicTrackEvent = function (options) {
        options.as = 'event';
        $.fn.otonomicTrack.call(this, options);
    };


    $.fn.otonomicTrackEvent = function (options) {
		options.as = 'event';
		$.fn.otonomicTrack.call(this, options);
	};

	$.fn.otonomicTrackPageView = function (options) {
		options.as = 'pageview';
		$.fn.otonomicTrack.call(this, options);
	};


	$.fn.otonomicTrack = function (input_options) {

		if (!this.length) return;

		// This is the easiest way to have default options.
		var options = $.extend(true, {
			// These are the defaults.
            iframe: false,
            selector: null,
			as: 'event',
			event_type: "click",
			category: "",
			action: "Click",
			label: "",
			value: null,
			non_interaction: false,
            bind_tracking: true
		}, input_options);

		var ori_options =  $.extend( true, {}, options);

		var methods = {
			trackGoogleAnalytics: function () {
				if (typeof(ga) != 'undefined') {
					if (options.as === 'event') {
						// _gaq.push(['_trackEvent', options.category, options.action, options.label, options.value, options.non_interaction]);
						// ga('send', 'event', options.category, options.action, options.label, options.value);
						ga('send', {
							'hitType': 'event',
							'eventCategory': options.category,
							'eventAction': options.action,
							'eventLabel': options.label
						});
					} else if (options.as === 'pageview') {
						// _gaq.push(['_trackPageview', '/virtual_pageviews/' + options.page]);
						ga('send', {
							'hitType': 'pageview',
							'page': '/virtual_pageviews/' + options.page,
							'title': options.title
						});
					}
				}
			},

			trackPiwik: function () {
				if (typeof(_paq) != 'undefined') {
					_paq.push(['trackEvent', options.category, options.action, options.label, options.value]);
				}
			},

            trackOtonomic: function() {
                var submit_options = options;

                // Track using the Otonomic Old Database
                var otonomic_db_analytics_url;
                if( +settings.localhost ) {
                    if ( !(+settings.p2s_local) ) return false;
                    otonomic_db_analytics_url = "http://p2s.test/sites/track_click";
                } else {
                    otonomic_db_analytics_url = "http://builder.otonomic.com/sites/track_click";
                }

                submit_options.site_id = settings.site_id;
                submit_options.user_id = settings.user_id;
                submit_options.event = settings.action;
                submit_options.options_callback = null;

                $.ajax({
                    type: 'GET',
                    url: otonomic_db_analytics_url,
                    data: submit_options
                })
                    .always(function() {
                        // alert('Data sent');
                    });
            },

            otonomic_track: function(e) {
                // var $this = $(this);
                var $this = $(e.currentTarget);

                // var options = jQuery.extend(true, {}, e.data);
				options =  $.extend( true, {}, ori_options);


                if (options.as === 'event') {

                    var fields = ['category', 'action', 'label', 'value'];

                    fields.forEach(function(element, index, array) {

                        options[element] = $this.attr('data-analytics-'+element) || $this.attr('data-ga-'+element) || options[element];

                        switch (options[element]) {
                            case "{current_page_title}":
                                options[element] = get_current_page_title($this);
                                break;

                            case "{text}":
                                options[element] = $this.text().trim();
                                break;

                            case "{id}":
                                options[element] = $this.attr('id');
                                break;

                            case "{title}":
                                options[element] = $this.attr('title');
                                break;
                        }
						try {
                        if(typeof(options[element].attr) !== "undefined") {
                            options[element] = $this.attr(options[element].attr);
                        }
						}
						catch(ex)
						{
							/*console.log($this);
							console.log(options);*/
							console.log(ex);
						}

                    });

                    if (options.options_callback) {
                        // if (options.options_callback($this, options, e) === false) return;
                        if (options.options_callback($this, options, $this) === false) return;
                    }

                    methods.trackPiwik();
                    methods.trackGoogleAnalytics();
                    methods.trackOtonomic();

                    if(settings.localhost) {
                        //alert('Tracking event. \nCategory:'+options.category+'\nAction:'+options.action+'\nLabel:'+options.label);
                    }

                } else if (options.as === 'pageview') {

                    options.page = $this.attr('data-analytics-page') || options.page;
                    options.title = $this.attr('data-analytics-title') || options.title;
                }

                var redirect_timeout_dt = 250;
                var to_url = this.href;

                if (!$this.hasClass('ot-apl') && this.tagName === "A" && to_url && to_url !== "#" && this.target != "_blank" && !$this.hasClass('ngg-fancybox') && !$this.hasClass('fancybox')) {
                    // prevent browser from loading the new page:
                    e.preventDefault();

                    // give time for the event tracking to happen
                    setTimeout(function () {
                        window.location = to_url;
                    }, redirect_timeout_dt);
                }
            }
        };


        if(options.bind_tracking) {
            // Bind tracking to element if it's not already tracked
            var events = $._data(this[0], 'events');
            var event_already_tracked = false;
            if (events && events[options.event_type]) {
                for (var i = 0, len = events[options.event_type].length; i < len; i++) {
                    if (events[options.event_type][i].namespace === "otonomicTrackEvent") {
                        event_already_tracked = true;
                        // console.log('event ' + options.event_type + ' for is already tracked for ', this); // DEBUG
                    }
                }
            }

            if (!event_already_tracked) {
                if(options.iframe) {
                    this.contents().on(
                        options.event_type,
                        options.selector,
                        options,
                        methods.otonomic_track
                    );

                } else {
                    this.on(
                        options.event_type, // + '.otonomicTrackEvent',
                        options.selector,
                        options,
                        methods.otonomic_track
                    );
                }
            }

        } else {
            // Track immediately
            methods.otonomic_track(options);
        }

		return this;
	};

	function get_current_page_title(el) {
		var $ = jQuery;
		var title;
		if (el && el.length) title = el.closest('section').attr('id');
		title = title ||
			$('#current_page_title').text() ||
			$('title').text() ||
			'-';
		return title ;
	}

})(jQuery);

//$ = jQuery; // DEBUG

function otonomicTrackEvent(category, action, label, value) {
    $(document).otonomicTrackEvent({
        category: category,
        action: action,
        label: label,
        value: value,
        bind_tracking: false
    });
}