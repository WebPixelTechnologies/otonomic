    var WEBROOT = '/';
    var full_path = 'http://builder.page2site.com/';
    var nextpageURL = 'http://www.page2site.com/shared/facebook_fanpages.php';
    var debug_enabled = 0;

    var reference_time = new Date().getTime();
    var user_facebook_id;
    var fanpage_permissions = 'manage_pages,email,offline_access';
    var personal_permissions = 'user_location,user_about_me,user_photos,user_events,user_videos';
    var num_reject_basic_permissions = 1;

    function currentUrl() {
        return current_url = location.protocol + '//' + location.host + location.pathname;
    }
        

    jQuery(document).ready(function(){
        jQuery('#btn_go').tipsy({
            gravity:  'se',//jQuery.fn.tipsy.autoNS,
            trigger: 'manual'
        });
    });

    jQuery(document).ready(function($) {
        // Track time since the page is loaded in the P2S database
        var time_counter = 0;
        var next_record_time = 1;
        p2sTrack('LandingPage', 'Page Loaded', '0 seconds');

        var page_loaded_interval_func = setInterval(function() {
            time_counter++;
            if(time_counter >= next_record_time) {
                next_record_time *= 2;
                p2sTrack('LandingPage', 'Page Loaded', ''+time_counter+' seconds');
            }
        }, 1000);
    });

    jQuery(document).ready(function($) {
        // trackFBConnect('Search Page', 'Document Ready');

        $("#btn_video").click(function(e) {
            e.preventDefault();

            $.fancybox({
                'padding'       : 0,
                'autoScale'     : false,
                'transitionIn'  : 'none',
                'transitionOut' : 'none',
                'title'         : this.title,
                'width'         : 680,
                'height'        : 495,
                'href'          : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                'type'          : 'swf',
                'swf'           : {
                    'wmode'        : 'transparent',
                    'allowfullscreen'   : 'true'
                }
            });

            //return false;
        });


        $('#main_search_box').focus();

        window.scrollTo(0,0);
    });

    
    function trackEvent(category, event, label, value, non_interaction) {
        if(typeof(jQuery)=='undefined') { return; }

        if (typeof(value) == 'undefined') {
            value = null;
        }
        if (typeof(non_interaction) == 'undefined') {
            non_interaction = false;
        }
        category = jQuery.camelCase(category);
        event = jQuery.camelCase(event);
        value = Number(value);

        /* Track in GA */
        if (typeof(_gaq) != 'undefined') {
            _gaq.push(['_trackEvent', category, event, label, value, non_interaction])

        } else {
            p2sTrack('Warning', 'Missing GA tags', category + ' >>> ' + event + ' >>> ' + label + ' >>> ' + value);
            console.log('Warning! Missing GA tags');
        }

        /* Track in Kissmetrics */
        if (typeof(_kmq) != 'undefined') {
            _kmq.push(['record', category + '.' + event, {'label': label, 'value': value}]);
        }
    }

    function trackSocial(category, event, label) {
        if (typeof(_gaq) != 'undefined') {
            category = jQuery.camelCase(category);
            event = jQuery.camelCase(event);
            _gaq.push(['_trackSocial', category, event, label])
        }
    }

    function p2sTrack(category, event, label, value) {
        var data = {category: category, event: event, label: label, value: value};
        makeAjaxTrackCall(data);
    }

    function trackFBConnect(category, event, label, value) {
        if (typeof value == "undefined") {
            value = null;
        }
        p2sTrack(category, event, label, value);
        trackEvent(category, event, label, value);
    }

    function makeAjaxTrackCall(data, callback) {
        var url = WEBROOT + 'code/sites/track_click/';
        if (typeof site_id != "undefined" && site_id) {
            url += site_id + '/';
        };

        jQuery.ajax({
            url: url,
            data: data,
            type: "GET",
            success: function (data, textStatus, jqXHR) {
                if (callback != undefined) {
                    callback(data);
                }
            }
        });
    }

    function objectToArray(obj) {
        var arr = [];
        if (typeof obj != "object") {
            return obj;
        }
        for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
                arr.push(key);
            }
        }

        return arr;
    }

    function trackPageView(url) {
        if (typeof(_gaq) != 'undefined') {
            _gaq.push(['_trackPageview', '/virtual_pageviews/' + url]);
            console.log('Tracked page view: '+url);
        }
    }