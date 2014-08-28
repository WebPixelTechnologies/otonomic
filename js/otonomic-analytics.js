var facebook_site_created_pixel_id = '6008636103630';


function is_localhost() {
    if( location.host == 'otonomic.test' || location.host == 'localhost') {
        return true;
    }

    return false;
}


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
    _paq.push(['setSiteId', 1]);
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
        ga('send', 'event', category, action, label,value);
    }

    // jQuery.post('http://otonomic.com/code/sites/track_click/', { category: category, event: action , label: label, value: value });
    if(typeof(_paq) !== 'undefined') {
        _paq.push(['trackEvent', category, action, label, value ]);
    }
}

function track_virtual_pageview(url) {
    if(typeof(ga) !== 'undefined') {
        ga('send', 'pageview', url);
    }
    if(typeof(_paq) !== 'undefined') {
        var piwikTracker = Piwik.getTracker();
        PiwikTracker.trackPageView([url]);
    }
}