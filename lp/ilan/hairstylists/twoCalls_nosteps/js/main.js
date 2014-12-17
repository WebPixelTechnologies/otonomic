// JavaScript Document

var domain = window.location.host.replace("www.", "");
var facebook_app_id;

switch(domain) {
    case "otonomic.com":
        facebook_app_id = "373931652687761";
        break;

    case "verisites.com":
        facebook_app_id = "202562333264809";
        break;

    case "otonomic.test":
        facebook_app_id = "286934271328156";
        break;

    case "wp.test":
        facebook_app_id = "264315953610090";
        break;

    default:
        facebook_app_id = "160571960685147";
}


(function(d, s, id)
{
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId="+facebook_app_id+"&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));

