var facebook_site_created_pixel_id = '6008636103630';
var piwik_site_id = 1;
if(window.location.hostname.replace('www.', '') == 'verisites.com') {
	piwik_site_id = 2;
}
var pixel_values = {
    visited_editor: '6020069195630',
    added_product: '6020069233430',
    visited_domain_page: '6020069257230',
    created_site: '6008636103630',
    shared_promotion: '6020812900230',
    registered_to_promotion: '6020812953830'
};


/* Google Analytics */
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-37736198-1', 'auto');
    ga('send', 'pageview');
/* END Google Analytics */



/* LuckyOrange */
    window.__wtw_lucky_site_id = 10400;

    (function() {
        var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
        wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://cdn') + '.luckyorange.com/w.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
        })();
/* END LuckyOrange */



/* Piwik */
var _paq = _paq || [];

_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
    if(is_localhost()) {
        var piwik_url = "localhost/piwik/";
    } else {
        var piwik_url = "a.otonomic.com/";
    }

    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://" + piwik_url;
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', piwik_site_id]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
})();
/* END Piwik */



/* Facebook */
(function() {
    var _fbq = window._fbq || (window._fbq = []);
    if (!_fbq.loaded) {
        var fbds = document.createElement('script');
        fbds.async = true;
        fbds.src = '//connect.facebook.net/en_US/fbds.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(fbds, s);
        _fbq.loaded = true;
    }
})();
/* END Facebook */


function track_event(category, action, label, value){
	// console.log('track_envent: ' + category + ' - ' + action + ' - ' + label + ' - ' + value); // DEBUG
    if(label == undefined)
        label = '';

    if(!value){
        value = null;
    }

    if(typeof(ga) !== 'undefined') {
        //ga('send', 'event', category, action, label,value);
		ga('send', {
			'hitType': 'event',
			'eventCategory': category,
			'eventAction': action,
			'eventLabel': label,
			'value':value
		});
    }

    jQuery.post(
        'http://otonomic.com/code/sites/track_click/',
        { category: category, event: action , label: label, value: value }
    );

    if(typeof(_paq) !== 'undefined') {
        //_paq.push(['trackEvent', category, action, label, value ]);
		_paq.push(['trackEvent', category, action, label, value]);
    }
	submit_options = {
			'event': action,
			'category': category,
			'action': action,
			'label': label,
			'value':value
		}

	// trackOtonomic(submit_options);
}
function trackOtonomic( submit_options )
{
	if( is_localhost() ) {	
		otonomic_db_analytics_url = "http://p2s.test/sites/track_click";
	
	} else {
		otonomic_db_analytics_url = "http://builder.otonomic.com/sites/track_click";
	}
	$.ajax({
		type: 'GET',
		url: otonomic_db_analytics_url,
		data: submit_options
	});
	
}

function track_virtual_pageview(url, title) {
    var options = {
        'hitType': 'pageview',
        'page': '/virtual_pageviews/' + url
    };
    if(typeof(title) !== 'undefined') {
        options.title = title;
    }

    if(typeof(ga) !== 'undefined') {
        ga('send', options);
    }

    if(typeof(_paq) !== 'undefined') {
        var PiwikTracker = Piwik.getTracker();
        PiwikTracker.trackPageView([url]);
    }
}

function trackFacebookPixel(pixel_id) {
    if(typeof(pixel_values[pixel_id]) == "undefined") {
        pixel_id = pixel_values[pixel_id];
    }
    window._fbq = window._fbq || [];
    window._fbq.push(['track', pixel_id, {'value':'0.00','currency':'USD'}]);
}