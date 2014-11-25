// JavaScript Document

(function(d, s, id) 
{
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=264315953610090&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));

function shareOnFB() 
{
	var e = {
		method: "feed",
		link: "http://otonomic.com/",
		picture: "http://otonomic.com/images/otonomic-logo.png",
		name: "Otonomic-We take your Facebook page and automatically turn it into a Web & Mobile website!",
		caption: 'Otonomic.info',
		description: "We take your Facebook page and automatically turn it into a Web & Mobile website! its free ,effortless,instanse and beautiful."
	};
	FB.ui(e, function(t) 
	{
		if (t["post_id"]) 
		{
          //your download content goes here
          // Do something there
		  showStep3();
        }
    })
}


twttr.events.bind('tweet', function (event) {
      // Do something there
      showStep3();
});

function showStep3(){
    // hide share buttons
    $('.js-social-shares').hide();
    //Change #step-2 content to icon
    $('#step-2').html('<img src="images/icon-check.png">')
    $('#step-2').parent().removeClass('active');
    // Make #step-3 active 
    $('#step-3').parent().addClass('active');
    // Change texts
    $('.js-heading-text').html('Thank you').css('fontSize','50px');
    $('.text3').html("When your website is ready, we'll contact you via Facebook.");
    $('.testimonial').css('marginTop','103px');
}

$(function(){

    // On search result click
    $('#search_wrapper_main').on('click', '.search-results-item', function(event){
        event.preventDefault();
		fb_page_id = jQuery(this).attr('data-facebook-page-id');
		fb_page_name = jQuery(this).attr('data-facebook-page-name');
		fb_page_category = jQuery(this).attr('data-facebook-page-category');
		var event_data = 'Page id:'+fb_page_id+', Page name:'+fb_page_name+', Category:'+fb_page_category;
		track_event("Hair Stylists Lead", "Lead Generated", event_data);
		track_event("Hair Stylists Lead", "Lead Generated", "Page ID: "+fb_page_id);
		track_event("Hair Stylists Lead", "Lead Generated", "Page name:"+fb_page_name);
		track_event("Hair Stylists Lead", "Lead Generated", "Category:"+fb_page_category);
			
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
    });
});