var builder_domain;
if (is_localhost()) {
    builder_domain = "http://wp.test";
} else {
	builder_domain = 'http://wp.'+window.location.hostname.replace('www.', '');
}


function checkConnectedWithFacebook() {
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token
            // and signed request each expire
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;

            console.log(uid);
            console.log(accessToken);

            $('#authorize_Facebook').hide();

        } else if (response.status === 'not_authorized') {
            // the user is logged in to Facebook,
            // but has not authenticated your app
        } else {
            // the user isn't logged in to Facebook.
        }
    });
}




(function ($, window, undefined) {

    var settings = {
        user_edits_contact: false,
        user_edits_store: false,
        user_edits_booking: true
    };

	window.do_redirect = 0;

	var page_id = getParameterByName('page_id');
	var page_name = getParameterByName('page_name');
    var category = getParameterByName('category');
    var category_list = getParameterByName('category_list');

	window.authorized_channel = [];
	
	var page_load_timestamp;
	
	var contact_load_timestamp;
	var store_load_timestamp;
	var category_load_timestamp;
	
	page_load_timestamp = new Date();

    if (page_name) {
        $('.site-name').html(page_name);
        $('.ot-fb-name').html(page_name);
    }

    if(category) {
        $('#fb_category').val(category);
    }

    track_event('Loading Page', 'Start');
	jQuery('input[type=text]').addClass('LoNotSensitive');


	// Intro next btn
	$('.js-intro-next').click(function(event){
        track_event('Loading Page', 'Next', 'Start process');
		event.preventDefault();
		$('#intro').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-1').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});

	// Stage-1 next btn
	$('.js-stage1-next').click(function(event){
        track_event('Loading Page', 'Next', '1 > 2');
		event.preventDefault();
		$('#stage-1').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-2').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});
	
	// Stage-2 next btn
	$('.js-stage2-next').click(function(event){
        track_event('Loading Page', 'Next', '2 > 3');
		event.preventDefault();
		$('#stage-2').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-3').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});

	// Stage-3 next btn
	$('.js-stage3-next').click(function(event){
        track_event('Loading Page', 'Next', '3 > 4');
		event.preventDefault();
		$('#stage-3').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-4').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});

	// Stage-4 next btn
	$('.js-stage4-next').click(function(event){
        track_event('Loading Page', 'Next', '4 > 5');
		event.preventDefault();
		switchToCongratz();
	});

	jQuery('#link-tos').click(function (e){
		track_event('Loading Page', 'ToS', '');
	});

	// #see-my-website-btn Click
	////////////////////////////////////////
	$('#see-my-website-btn').click(function (event) {
		//event.preventDefault();
		var cdate = new Date(); var time_diff = cdate - page_load_timestamp;
		track_event('Loading Page', 'Take to website', 'button', time_diff);
	    var btn = $(this);
	    btn.button('loading');
	});
	
	// function that switched to stage-5 from stage-4
	/////////////////////////////////////////////////////
	function switchToCongratz() {
		
		// fade stage
		$('#stage-4').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#congratz').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');

		// CountDown
		var sec = 8;
		var timer = setInterval(function() { 
			if (sec > 1) {
				$('#congratz #counter').text(--sec+' seconds');

            } else {
				$('#congratz #counter').text(--sec+' second');
				if (sec == 0) {
					$('#congratz .congratz-title').text('Taking you to your website...');
                    $('.ot-fb-name').html('');
                    $('.site-name').html('');

                    clearInterval(timer);

					// now redirect
                    //window.location.replace(window.site_url);
				}
			}

            if(sec < 4) {
                track_event('Loading Page', 'Redirect to website', '');
                window.do_redirect = 1;
                redirect_to_website();
            }
		}, 1000);

	}


	if (page_id) {
        window.site_url = builder_domain+'/wp-admin/admin-ajax.php?action=check_page&page_id='+page_id;
        $('#oto-web-url').html('<a href="'+window.site_url+'">this link</a>');
		createWebsiteUsingAjax(page_id);
        if(settings.user_edits_address) {
		    getFacebookPageAddress(page_id);
        }
	}

	// Submit Store
	////////////////////////////////////////
	$('.submit-store').click(function (e) {
		e.preventDefault();

		var cdate = new Date(); var time_diff = cdate - page_load_timestamp;
		
		track_event('Loading Page', 'Store Yes', '', time_diff);

        timed_submit(send_need_store, 'i_need_store');
 	});

	// Skip Store
	////////////////////////////////////////
	$('.submit-skip-store').click(function (e) {
		e.preventDefault();

		var cdate = new Date();
		var time_diff = cdate - page_load_timestamp;
		
		track_event('Loading Page', 'Store No', '', time_diff);
        timed_submit(send_dont_need_store, 'i_dont_need_store');
	});

    // Submit Booking
    $('.submit-booking').click(function (e) {
        e.preventDefault();
        var cdate = new Date(); var time_diff = cdate - page_load_timestamp;
        track_event('Loading Page', 'Booking Yes', '', time_diff);
        timed_submit(send_need_store, 'i_need_booking');
    });

    // Skip Booking
    $('.submit-skip-booking').click(function (e) {
        e.preventDefault();
        var cdate = new Date(); var time_diff = cdate - page_load_timestamp;
        track_event('Loading Page', 'Booking No', '', time_diff);
        timed_submit(send_dont_need_booking, 'i_dont_need_booking');
    });

})(jQuery, window);


/* required functions */
function timed_submit(submit_function, submit_parameter) {
    if (window.is_blog_ready == 1) {
        submit_function();
    } else {
        window[submit_parameter] = 1;
    }
}

function callback(data) {
	window.is_blog_ready = 1;

	if (data.redirect.indexOf("http://") < 0) {
		data.redirect = "http://" + data.redirect;
	}

	if (data.site_url.indexOf("http://") < 0) {
		data.site_url = "http://" + data.site_url;
	}

	if (data.status == 'fail') {
		window.location = data.site_url;
		track_event('Account Manage', 'Site Exists', data.message);
        track_virtual_pageview('site_exists');

	} else {
		var page_type = window.page_type || 'Fan Page';
		track_event('Account Manage', 'Create Success', page_type);
        track_virtual_pageview('site_created');
	}

	// Site created, facebook fixel
	window._fbq = window._fbq || [];
    if(!is_localhost()) {
	    window._fbq.push(['track', facebook_site_created_pixel_id, {'value':'0.00', 'currency':'USD'}]);
    }

	window.site_url = data.site_url;
	window.blog_redirect = data.redirect;
	window.blog_id = data.blog_id;
	window.token = data.token;

	jQuery('#oto-web-url').html('<a href="'+data.redirect+'">'+data.site_url+'</a>');

	blog_created();

    redirect_to_website();
}

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getFacebookPageAddress(page_id) {
	var facebook_query_page_url = "https://graph.facebook.com/" + page_id;
	$.get(facebook_query_page_url, function (data) {
		if (data.location != undefined && data.location.latitude != undefined && data.location.longitude != undefined) {
			delete data.location.latitude;
			delete data.location.longitude;
		}
		var address_parts = [];

		for (var x in data.location) {
			address_parts.push(data.location[x]);
		}

		var phone = (data.phone) ? data.phone : "";
		var address = (address_parts.join(", ")) ? address_parts.join(", ") : "";
		var email = (data.email) ? (data.email) : "";

		if (data.likes != undefined) {
			window.page_type = 'Fan Page';
		} else {
			window.page_type = 'Personal Page';
		}
		window.parsed_page_data = {
			'phone': phone,
			'address': address,
			'email': email
		}
	}, "json");
}

function is_localhost() {
	if (location.host == 'otonomic.test' || location.host == 'localhost') {
		return true;
	}

	return false;
}

function createWebsiteUsingAjax(page_id) {
	var request_data = {};
	request_data.theme = "dreamspa";
	request_data.facebook_id = encodeURIComponent(page_id);

	// var request_url = "http://wp.otonomic.com/migration/index.php?" + $.param(request_data);
	localhost = is_localhost();

	var request_url;
    request_url = builder_domain+"/migration/index.php";

	return $.ajax({
		url: request_url,
		type: "GET",
		dataType: "jsonp",
		data: request_data,
		jsonp: "callback",
		jsonpCallback: "callback"
	});
}

function blog_created() {
	if (window.is_contact_saved == 1) {
		send_contact_data();
	}

	if (window.i_need_store == 1) {
		send_need_store();
	} else if(window.i_dont_need_store == 1) {
		send_dont_need_store();
	}

    if (window.i_need_booking == 1) {
        send_need_booking();
    } else if(window.i_dont_need_booking == 1) {
        send_dont_need_booking();
    }

    if (window.set_site_category_pending == 1) {
		send_site_category();
	}
	if (window.set_site_category_pending == 1) {
		send_site_category();
	}
	send_user_fb_details();
	send_user_authorized_channel();

	return;
}

function redirect_to_website() {

	if(window.do_redirect == 1 && window.is_blog_ready == 1) {
        window.location.replace(window.blog_redirect);
        /*
		window.setTimeout(function (e){
			//alert('redirecting to site...');
			window.location.replace(window.site_url);
		}, 400);
		*/
	}
}


function contact_form_submited() {
	window.is_contact_saved = 1;

	if (window.is_blog_ready == 1) {
		send_contact_data();

	} else {
		window.users_contacts = {
			'phone': $('#phone').val(),
			'address': $('#address').val(),
			'email': $('#email').val()
		}
	}
}

function post_WP_settings(data, tracking_action, endpoint) {
    endpoint = endpoint  || 'settings.set_many';
    tracking_action = tracking_action  || data;

    return request = $.ajax({
        type: "POST",
        url: window.site_url + '/?json=' + endpoint,
        data: { values: data },
        success: function (data, status, jqxhr) {
            if (jqxhr.status == 307) {
                $.post(window.site_url + '/?json=settings.set_many', { values: values_changes });
                track_event('Loading Page', tracking_action, '307');
                return;
            }
            if (data.status == "ok") {
                track_event('Loading Page', tracking_action, 'Success');
            } else {
                track_event('Loading Page', tracking_action, 'Failure: data.respond.msg: ' + (data.respond && data.respond.msg));
            }
        },
        complete: function (jqxhr, status) {
            if (status !== 'success') {
                track_event('Loading Page', tracking_action, 'Failure: ' + status);
            }
        }

//		statusCode: {
//			200: function (data_or_jqxhr, status, jqxhr_or_err) {debugger;
//				return;
//			},
//			307: function (data_or_jqxhr, status, jqxhr_or_err) {debugger;
//				$.post(window.site_url + '/?json=settings.set_many', { values: values_changes });
//			}
//		}
    });
}

function send_contact_data() {
    var _phone, _email, _address;

    if (window.users_contacts != undefined) {
        _phone = window.users_contacts.phone;
        _email = window.users_contacts.email;
        _address = window.users_contacts.address;

    } else {
        _phone = $('#phone').val();
        _email = $('#email').val();
        _address = $('#address').val();
    }

    var values_changes = { phone: _phone, address: _address, email: _email};
    return post_WP_settings(values_changes, 'Send Contact Data');
}

function send_site_category() {
	_facebook_category = window.facebook_category;
	var values_changes = { facebook_category: _facebook_category };
    return post_WP_settings(values_changes, 'Send Site Category');
}

function send_need_store() {
	track_event('Loading Page', 'Online Store', 'Yes');
    return post_WP_settings({}, 'Online Store', 'store.create');
}

function send_dont_need_store() {
    track_event('Loading Page', 'Online Store', 'No');
    return post_WP_settings({}, 'Online Store', 'store.hide');
}

function send_need_booking() {
    track_event('Loading Page', 'Booking', 'Yes');
    return post_WP_settings({ show_booking: true }, 'Booking');
}

function send_dont_need_booking() {
    track_event('Loading Page', 'Booking', 'No');
    return post_WP_settings({ show_booking: false }, 'Booking');
}
function send_user_fb_details()
{
	fb_user_auth = getParameterByName('fb_user_auth');
	fb_user_id = getParameterByName('fb_user_id');
	fb_user_t = getParameterByName('fb_user_t');

	if(fb_user_auth == 'yes')
	{
		var settings_data = {
			wp_otonomic_blog_connected: 'yes',
			otonomic_connected_fb_user_id: fb_user_id,
			otonomic_connected_fb_user_token: fb_user_t
		};
		post_WP_settings(settings_data, 'FB Connected');
	}
}
function send_user_authorized_channel()
{
	if(window.authorized_channel.length>0) {
		jQuery.each(window.authorized_channel, function (key, value) {
			var channel = value['channel'];
			var auth_data = value['auth_data'];
			console.log(channel);
			console.log(auth_data);
			var settings_data = {};
			settings_data[channel] = auth_data;

			if(channel == 'Facebook')
			{
				post_WP_settings({wp_otonomic_blog_connected: 'yes'}, 'FB Connected');
			}
			post_WP_settings(settings_data, 'User authorized channel');
			delete window.authorized_channel[channel];
		});
	}
}
function userConnected(channel,auth_data){
    track_event('Loading Page', 'Social channel connected', channel);

    social_network = channel+"_user_auth";
	
	window.authorized_channel.push({
            'channel': channel, 
            'auth_data':  auth_data
	});
	//send_user_authorized_channel();
	timed_submit(send_user_authorized_channel, 'user_authorized_channel');
    $('#authorize_'+channel).addClass('connected');
	$('#authorize_'+channel).append('<img class="social-check" src="images/social-check.png">');
}
