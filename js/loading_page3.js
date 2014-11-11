var builder_domain;
if (is_localhost()) {
    builder_domain = "http://wp.test";
} else {
	builder_domain = 'http://wp.'+window.location.hostname.replace('www.', '');
}


(function ($, window, undefined) {

	window.do_redirect = 0;
	var page_id = getParameterByName('page_id');
	var page_name = getParameterByName('page_name');
    var category = getParameterByName('category');
    var category_list = getParameterByName('category_list');
	
	var page_load_timestamp;
	
	var contact_load_timestamp;
	var store_load_timestamp;
	var category_load_timestamp;
	
	page_load_timestamp = new Date();

    if (page_name) {
        $('.site-name').html(page_name);
    }

    if(category) {
        $('#fb_category').val(category);
    }


    track_event('Loading Page', 'Start');
	jQuery('input[type=text]').addClass('LoNotSensitive');


	// Intro next btn
	$('.js-intro-next').click(function(event){
		event.preventDefault();
		$('#intro').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-1').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});

	// Stage-1 next btn
	$('.js-stage1-next').click(function(event){
		event.preventDefault();
		$('#stage-1').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-2').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});
	
	// Stage-2 next btn
	$('.js-stage2-next').click(function(event){
		event.preventDefault();
		$('#stage-2').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-3').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});

	// Stage-3 next btn
	$('.js-stage3-next').click(function(event){
		event.preventDefault();

		store_load_timestamp = new Date();

		$('#stage-3').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#stage-4').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');
	});


	jQuery('#link-tos').click(function (e){
		track_event('Loading Page', 'ToS', '');
	});

	// #see-my-website-btn Click
	////////////////////////////////////////
	$('#see-my-website-btn').click(function (event) {
		//event.preventDefault();
		
		var cdate = new Date();
		var time_difff = cdate - page_load_timestamp;
		
		track_event('Loading Page', 'Take to website', 'button', time_difff);
		
	    var btn = $(this);
	    btn.button('loading');
	});
	
	// function that switched to stage-5 from stage-4
	/////////////////////////////////////////////////////
	function switchToCongratz() {
		
		category_load_timestamp = new Date();
		
		// fade stage
		$('#stage-4').fadeOut('slow', function () {
			$(this).addClass('hidden');
		});
		$('#congratz').css('opacity',0).removeClass('hidden').animate({opacity: 1}, 'slow');

		// CountDown
		var sec = 7;
		var timer = setInterval(function() { 
			if (sec > 1) {
				$('#congratz #counter').text(--sec+' seconds');
			} else {

				$('#congratz #counter').text(--sec+' second');
				if (sec == 0) {
					$('#congratz .congratz-title').text('Taking you to your website.');
					// now redirect

				    clearInterval(timer);
				} 
			}
		}, 1000);
		window.do_redirect = 1;
		redirect_to_website();
	}


	if (page_id) {
        window.site_url = builder_domain+'/wp-admin/admin-ajax.php?action=check_page&page_id='+page_id;
        $('#oto-web-url').html('<a href="'+window.site_url+'">this link</a>');
		createWebsiteUsingAjax(page_id);
		getFacebookPageAddress(page_id);
	}

	// Submit Store
	////////////////////////////////////////
	$('.submit-store').click(function (e) {
		e.preventDefault();

		var cdate = new Date();
		var time_difff = cdate - store_load_timestamp;
		
		track_event('Loading Page', 'Store Yes', '', time_difff);
		
		if (window.is_blog_ready == 1) {
			send_need_store();
		}
		else {
			window.i_need_store = 1;
		}
		// Switch stage
		switchToCongratz();
	});

	// Skip Store
	////////////////////////////////////////
	$('.submit-skip-store').click(function (e) {
		e.preventDefault();

		var cdate = new Date();
		var time_difff = cdate - store_load_timestamp;
		
		track_event('Loading Page', 'Store No', '', time_difff);
		if (window.is_blog_ready == 1)
		{
			send_dont_need_store();
		}
		else
		{
			window.i_dont_need_store = 1;
		}

		// Switch stage
		switchToCongratz();
	});

})(jQuery, window);


/* required functions */

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
        //track_virtual_pageview('site_exists');

	} else {
		var page_type = window.page_type || 'Fan Page';
		track_event('Account Manage', 'Create Success', page_type);
        //track_virtual_pageview('site_created');
	}

	// Site created, facebook fixel
	window._fbq = window._fbq || [];
	//window._fbq.push(['track', facebook_site_created_pixel_id, {'value':'0.00', 'currency':'USD'}]);

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
		// DEBUG
		// console.log("the page:" + page_id);
		// console.log(data);

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
	request_data.theme = "parallax";
	request_data.facebook_id = encodeURIComponent(page_id);

	// var request_url = "http://wp.otonomic.com/migration/index.php?" + $.param(request_data);
	localhost = is_localhost();

	var request_url;
    request_url = builder_domain+"/migration/index.php";

	$.ajax({
		url: request_url,
		type: "GET",
		dataType: "jsonp",
		data: request_data,
		jsonp: "callback",
		jsonpCallback: "callback"
	});
}

function blog_created() {
	//alert('blog created');
	if (window.is_contact_saved == 1) {
		send_contact_data();
	}

	if (window.i_need_store == 1) {
		send_need_store();
	}
	else if(window.i_dont_need_store == 1)
	{
		send_dont_need_store();
	}
	if (window.set_site_category_pending == 1) {
		set_site_category();
	}
	return;
}
function redirect_to_website()
{
	if(window.do_redirect == 1 && window.is_blog_ready == 1)
	{
		//alert('redirect scheduled');
		window.setTimeout(function (e){
			//alert('redirecting to site...');
			window.location.replace(window.site_url);
		}, 11000);
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

function send_contact_data() {

	if (window.users_contacts != undefined) {
		var _phone = window.users_contacts.phone;
		var _email = window.users_contacts.email;
		var _address = window.users_contacts.address;
	} else {
		var _phone = $('#phone').val();
		var _email = $('#email').val();
		var _address = $('#address').val();
	}

	var values_changes = { phone: _phone, address: _address, email: _email}

	request = $.ajax({
		type: "POST",
		url: window.site_url + '/?json=settings.set_many',
		data: { values: values_changes },
		success: function (data, status, jqxhr) {
			if (jqxhr.status == 307) {
				$.post(window.site_url + '/?json=settings.set_many', { values: values_changes });
				track_event('Loading Page', 'Send Contact Data', '307');
				return;
			}
			if (data.status == "ok") {
				track_event('Loading Page', 'Send Contact Data', 'Success');
			} else {
				track_event('Loading Page', 'Send Contact Data', 'Failure: data.respond.msg: ' + (data.respond && data.respond.msg));
			}
		},
		complete: function (jqxhr, status) {
			if (status !== 'success') {
				track_event('Loading Page', 'Send Contact Data', 'Failure: ' + status);
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

function set_site_category() {
	_facebook_category = window.facebook_category;

	var values_changes = { facebook_category: _facebook_category }
	request = $.ajax({
		type: "POST",
		url: window.site_url + '/?json=settings.set_many',
		data: { values: values_changes },
		success: function (data, status, jqxhr) {
			if (jqxhr.status == 307) {
				$.post(window.site_url + '/?json=settings.set_many', { values: values_changes });
				track_event('Loading Page', 'Set Site Category', '307');
				return;
			}
			if (data.status == "ok") {
				track_event('Loading Page', 'Set Site Category', 'Success');
			} else {
				track_event('Loading Page', 'Set Site Category', 'Failure: data.respond.msg: ' + (data.respond && data.respond.msg));
			}
		},
		complete: function (jqxhr, status) {
			if (status !== 'success') {
				track_event('Loading Page', 'Set Site Category', 'Failure: ' + status);
			}
		}
	});
}

function send_need_store() {
	track_event('Loading Page', 'Online Store', 'Yes');
	request = $.ajax({
		type: "POST",
		async: "false",
		url: window.site_url + '/?json=store.create',
		success: function (data, status, jqxhr) {
			if (jqxhr.status == 307) {
				$.post(window.site_url + '/?json=settings.set_many');
				track_event('Loading Page', 'Online Store', 'Yes - 307');
				return;
			}
			if (data.status == "ok") {
				track_event('Loading Page', 'Online Store', 'Yes - Success');
			} else {
				track_event('Loading Page', 'Online Store', 'Yes - Failure: data.respond.msg: ' + (data.respond && data.respond.msg));
			}
		},
		complete: function (jqxhr, status) {
			if (status !== 'success') {
				track_event('Loading Page', 'Online Store', 'Yes - Sending Failure: ' + status);
			}
		}
	});
}

function send_dont_need_store() {
	track_event('Loading Page', 'Online Store', 'No');
	request = $.ajax({
		type: "POST",
		async: "false",
		url: window.site_url + '/?json=store.hide',
		success: function (data, status, jqxhr) {
			if (jqxhr.status == 307) {
				$.post(window.site_url + '/?json=settings.set_many');
				track_event('Loading Page', 'Online Store', 'No - 307');
				return;
			}
			if (data.status == "ok") {
				track_event('Loading Page', 'Online Store', 'No - Success');
			} else {
				track_event('Loading Page', 'Online Store', 'No - Failure: data.respond.msg: ' + (data.respond && data.respond.msg));
			}
		},
		complete: function (jqxhr, status) {
			if (status !== 'success') {
				track_event('Loading Page', 'Online Store', 'No - Sending Failure: ' + status);
			}
		}
	});
}
