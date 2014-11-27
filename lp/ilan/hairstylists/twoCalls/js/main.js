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

function shareOnFB()
{
	var e = {
		method: "feed",
		link: "http://www.otonomic.com/lp/ilan/hairstylists/twoCalls/",
		// picture: "http://www.otonomic.com/images/hairstyleWebsite-theme-154x113_4x.jpg",
		name: "Free website for your hair salon - only 45 Hours left!",
		caption: 'otonomic.com',
		description: "Otonomic turns your Facebook business page into a website."
	};
	FB.ui(e, function(t)
	{
		if (t["post_id"])
		{
            //your download content goes here
            // Do something there
            track_event("Hair LandingPage TwoCol", "Share FB");

            showStep3();
        }
    });
}


twttr.events.bind('tweet', function (event) {
      // Do something there
    track_event("Hair LandingPage TwoCol", "Share Twitter");

    showStep3();
});

function showStep3(){
    track_virtual_pageview('/virtual_pageview/lp/ilan/hairstylists/step3/', 'LP Hairstylists promotion - step 3 - thank you');
    trackFacebookPixel('shared_promotion');

    // hide share buttons
    $('.js-social-shares').hide();
    //Change #step-2 content to icon
    $('#step-2').html('<img src="images/icon-check.png">')
    $('#step-2').parent().removeClass('active');
    // Make #step-3 active
    $('#step-3').parent().addClass('active');
    // Change texts
    $('.js-heading-text').html('Thank you!').css('fontSize','50px');
    $('.text3').html("When your website is ready, we'll contact you via Facebook.");
    $('.testimonial').css('marginTop','103px');
}

$(function(){

    // On search result click
    $('#search_wrapper_main').on('click', '.search-results-item', function(event){

        // Show step 2
        event.preventDefault();

        track_virtual_pageview('/virtual_pageview/lp/ilan/hairstylists/step2/', 'LP Hairstylists promotion - step 2 - share the promotion');

        track_virtual_pageview('/virtual_pageview/lp/ilan/hairstylists/registered_to_promotion/', 'LP Hairstylists promotion - user registered to promotion');

        trackFacebookPixel('registered_to_promotion');

        fb_page_id = jQuery(this).attr('data-facebook-page-id');
		fb_page_name = jQuery(this).attr('data-facebook-page-name');
		fb_page_category = jQuery(this).attr('data-facebook-page-category');
		var event_data = 'Page id:'+fb_page_id+', Page name:'+fb_page_name+', Category:'+fb_page_category;

        track_event("Hair Stylists Lead", "Lead Generated", event_data);
		track_event("Hair Stylists Lead", "Lead Generated", "Page ID: "+fb_page_id);
		track_event("Hair Stylists Lead", "Lead Generated", "Page name:"+fb_page_name);
		track_event("Hair Stylists Lead", "Lead Generated", "Category:"+fb_page_category);

		/* lets also send email */
		jQuery.post(
			'/send-mail.php',
			{ category: fb_page_category, page_id: fb_page_id , page_name: fb_page_name }
		);

		//alert(fb_page_id);
        // Hide search form
        $('.p2s_fanpages').click(function(){
            $(this).hide();
        })

        // Show Share buttons
        $('.js-social-shares').show();
        // Change #step-1 content to icon
        $('#step-1').html('<img src="images/icon-check.png">')
        $('#step-1').parent().removeClass('active');
        // Make #step-2 active
        $('#step-2').parent().addClass('active');
        $('.text3').css('opacity', 1);
    });
});
