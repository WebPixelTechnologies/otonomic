jQuery(document).ready(function($){
    jQuery(document).on('click', ".tracking_enabled", function (e) {
        var element = jQuery(this);
        var category = (typeof(element.attr("data-ga-category")) != "undefined") ? element.attr("data-ga-category") : '';
        var event = (typeof(element.attr("data-ga-event")) != "undefined") ? element.attr("data-ga-event") : 'Click';
        var label = (typeof(element.attr("data-ga-label")) != "undefined") ? element.attr("data-ga-label") : '';
        var value = (typeof(element.attr("data-ga-value")) != "undefined") ? element.attr("data-ga-value") : null;

        trackEvent(category, event, label, value);
        p2sTrack(category, event, label, value);		//by default make ajax call

        var href = $(this).attr("href");
        var target = $(this).attr("target");
        e.preventDefault(); // don't open the link yet
        setTimeout(function() { // now wait 300 milliseconds...
            window.open(href,(!target?"_self":target)); // ...and open the link as usual
        },300);
    });

    jQuery(document).on('click', '.track_event', function (e) {
        //e.preventDefault();
        var element = jQuery(this);
        var category = (typeof(element.attr("data-ga-category")) != "undefined") ? element.attr("data-ga-category") : '';
        var event = (typeof(element.attr("data-ga-event")) != "undefined") ? element.attr("data-ga-event") : '';
        var label = (typeof(element.attr("data-ga-label")) != "undefined") ? element.attr("data-ga-label") : '';
        var value = (typeof(element.attr("data-ga-value")) != "undefined") ? element.attr("data-ga-value") : null;
        var ajax_track = element.attr("data-ajax-track") || 1;

        if (value == null && element.hasClass("measure_time")) {
            value = new Date().getTime() - reference_time;
        }

        trackEvent(category, event, label, value);
        if (ajax_track == 1) {
            p2sTrack(category, event, label, value);
        }

        /*var href = $(this).attr("href");
         var target = $(this).attr("target");
         e.preventDefault(); // don't open the link yet
         setTimeout(function() { // now wait 300 milliseconds...
         window.open(href,(!target?"_self":target)); // ...and open the link as usual
         },300);*/
    });
});

function trackEvent(category, event, label, value, non_interaction) {
    if(typeof(jQuery)=='undefined') {
        return;
    }

    default_category = default_label = '';
    default_event = 'Click';
    default_value = null;

    category  = category    || default_category;
    event     = event       || default_event;
    label     = label       || default_label;
    value     = value       || default_value;
    non_interaction     = non_interaction       || false;

    category = "" + jQuery.camelCase(category);
    event = "" + jQuery.camelCase(event);
    label = "" + label;
    if(value!=null) { value = parseInt(value); }

    console.log('Track event in GA - '+category+' >>> '+event+' >>> '+label+' >>> '+value);

    if(typeof(_gaq) != 'undefined') {
        _gaq.push(['_trackEvent', category, event, label, value, non_interaction])

    } else {
        p2sTrack('Warning', 'Missing GA tags', category + ' >>> ' + event + ' >>> ' + label + ' >>> ' + value);
        console.log('Warning! Missing GA tags');
    }

    /* Track in Kissmetrics */
    if (typeof(_kmq) != 'undefined') {
        _kmq.push(['record', category + '.' + event, {'label': label, 'value': value}]);
    }
	submit_options = {
		'event': event,
		'category': category,
		'label': label,
		'value':value
	}
	// trackOtonomic(submit_options);
}
/*function trackOtonomic( submit_options )
{
	if( is_localhost() )
	{

		otonomic_db_analytics_url = "http://p2s.test/sites/track_click";
	}
	else
	{
		otonomic_db_analytics_url = "http://builder.otonomic.com/sites/track_click";
	}
	$.ajax({
		type: 'GET',
		url: otonomic_db_analytics_url,
		data: submit_options
	});

}*/

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

function trackPageView(url) {
    if (typeof(_gaq) != 'undefined') {
        _gaq.push(['_trackPageview', '/virtual_pageviews/' + url]);
        console.log('Tracked page view: '+url);
    }
};

function makeAjaxTrackCall(data, callback) {
	var url = "http://builder.otonomic.com/sites/track_click";;
	if( is_localhost() )
	{

		url = "http://p2s.test/sites/track_click";
	}
    //var url = otonomic_db_analytics_url + 'sites/track_click/';
    if (typeof site_id != "undefined" && site_id) {
        url += site_id + '/';
    }
    ;

    jQuery.ajax({
        url: url,
        data: data,
        type: "POST",
        success: function (data, textStatus, jqXHR) {
            if (callback != undefined) {
                callback(data);
            }
        }
    });
}
function is_localhost() {
	if( location.host == 'otonomic.test' || location.host == 'localhost') {
		return true;
	}

	return false;
}