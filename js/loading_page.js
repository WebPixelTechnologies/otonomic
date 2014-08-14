(function ($, window, undefined) {

	var page_id = getParameterByName('page_id');
	var page_name = getParameterByName('page_name');

	track_event('Loading Page', 'View');
	jQuery('input[type=text]').addClass('LoNotSensitive');


	NProgress.configure({
		parent: '#progress-bar',
		trickle: false,
		minimum: 0.001,
		showSpinner: false,
		trickleRate: 0.001,
		trickleSpeed: 100,
		ease: 'linear',
		speed: 1000,
		template: '<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'
	});
	// start progress
	NProgress.start();

	// seconds counter
	var secondsPassed = 0;

	// Progress timer
	var nprogressSpeed = 0.0123;
	var timer = $.timer(function () {

		// Start Progress
		NProgress.inc(nprogressSpeed);

		// Display precentage
		$('.peg').html(Math.ceil(NProgress.status * 100) + '%');

		// Increment seconds
		secondsPassed = secondsPassed + 0.5;
		//secondsPassed = parseFloat(secondsPassed.toPrecision(2), 10);
		// console.log('Seconds Passed:' + secondsPassed); // DEBUG

		// Actions based on number of seconds passed
		switch (secondsPassed) {
			case 5:
				$('#intro').fadeOut('fast', function () {
					$(this).addClass('hidden');
					$('#stage-1').fadeIn('fast').removeClass('hidden');
				});
				$('#progress-text').html('Copying your Photos, Posts and Videos from Facebook…');
				break;
			case 13:
				$('#stage-1').fadeOut('fast', function () {
					$(this).addClass('hidden');
					$('#stage-2').fadeIn('fast').removeClass('hidden');
				});
				$('#progress-text').html('Building the site…');
				break;
			case 18:
				owl.next();
				break;
			case 21:
				owl.next();
				break;
			case 24:
				owl.next();
				break;
			case 27:
				$('#stage-2').fadeOut('fast', function () {
					$(this).addClass('hidden');
					$('#stage-3').fadeIn('fast').removeClass('hidden');
					// init google maps
					var options = {
						map: ".map_canvas",
						location: "New york"
					};
					$("#address").trigger("geocode");
					$("#address").geocomplete(options)
						.bind("geocode:result", function (event, result) {
							//$.log("Result: " + result.formatted_address);
						})
						.bind("geocode:error", function (event, status) {
							//$.log("ERROR: " + status);
						})
						.bind("geocode:multiple", function (event, results) {
							//$.log("Multiple: " + results.length + " results found");
						});
				});
				$('#progress-text').html('Adding contact details…');

				// pause timer and wait for contact details submit
				timer.pause();
				// pause progress bar
				NProgress.set(NProgress.status);
				break;
			case 32:
				owl2.next();
				break;
			case 35:
				owl2.next();
				break;
			case 38:
				NProgress.done(true);
				$('.peg').html('100%');
				timer.stop();
				$('.bg-image').delay(1300).animate({top: 63}, 150);

				$('#stage-5').fadeOut('fast', function () {
					$(this).addClass('hidden');
					$('#congratz').fadeIn('fast').removeClass('hidden');
				});
				$('#progress-text').html('Building the site…');

				break;
		}
		/* End Switch*/

	});
	/* End Timer*/


	// init timer
	timer.set({ time: 500, autostart: true });

	// owl-carousel init
	$("#owl-slider1").owlCarousel({

		navigation: false,
		singleItem: true,
		transitionStyle: "fade",
		//Pagination
		pagination: false,
		paginationNumbers: false,
		//Mouse Events
		dragBeforeAnimFinish: false,
		mouseDrag: false,
		touchDrag: false,
		//Basic Speeds
		slideSpeed: 200,

	});

	//get carousel instance data and store it in variable owl
	var owl = $("#owl-slider1").data('owlCarousel');

	// owl-carousel init
	$("#owl-slider2").owlCarousel({

		navigation: false,
		singleItem: true,
		transitionStyle: "fade",
		//Pagination
		pagination: false,
		paginationNumbers: false,
		//Mouse Events
		dragBeforeAnimFinish: false,
		mouseDrag: false,
		touchDrag: false,
		//Basic Speeds
		slideSpeed: 200,

	});

	//get carousel instance data and store it in variable owl
	var owl2 = $("#owl-slider2").data('owlCarousel');

	// function that switched to stage-4 from stage-3
	function switchToStage4() {
		$('#stage-3').fadeOut('fast', function () {
			$(this).addClass('hidden');
			$('#stage-4').fadeIn('fast').removeClass('hidden');
		});
		$('#progress-text').html('Creating online store…');
	}

	// function that switched to stage-5 from stage-4
	function switchToStage5() {
		$('#stage-4').fadeOut('fast', function () {
			$(this).addClass('hidden');
			$('#stage-5').fadeIn('fast').removeClass('hidden');
		});
		$('#progress-text').html('Adding personalization options…');
	}

	if (page_id) {

		createWebsiteUsingAjax(page_id);

		getFacebookPageAddress(page_id);
	}

	if (page_name) {
		$('#ot-fb-name').html(page_name);
	}

	// Contact details submit
	$('.submit').click(function (e) {
		e.preventDefault();
		contact_form_submited();
		// Increment progress bar a little
		NProgress.set(NProgress.status + 0.01);
		// Display precentage
		$('.peg').html(Math.ceil(NProgress.status * 100) + '%');
		// Switch stage
		switchToStage4();
	});

	// Submit Store
	$('.submit-store').click(function (e) {
		e.preventDefault();
		if (window.is_blog_ready == 1) {
			send_need_store();
		}
		else {
			window.i_need_store = 1;
		}
		// Switch stage
		switchToStage5();
		// Increment progress bar a little
		NProgress.set(NProgress.status + 0.02);
		// Display precentage
		$('.peg').html(Math.ceil(NProgress.status * 100) + '%');
	});

	// Skip Submit
	$('.submit-skip').click(function (e) {
		e.preventDefault();
		send_dont_need_store();
		// Switch stage
		switchToStage5();
		// Increment progress bar a little
		NProgress.set(NProgress.status + 0.02);
		// Display precentage
		$('.peg').html(Math.ceil(NProgress.status * 100) + '%');
	});


	// Submit category
	$('.submit-category-btn').click(function (e) {
		e.preventDefault();
		window.facebook_category = jQuery('#fb_category').val();
		if (window.is_blog_ready == 1) {

			set_site_category();

		} else {
			window.set_site_category_pending = 1;
		}
		// Resume timer
		timer.play();
		// Increment progress bar a little
		NProgress.set(NProgress.status + 0.01);
		// Display precentage
		$('.peg').html(Math.ceil(NProgress.status * 100) + '%');
		// Resume progress bar
		NProgress.inc(nprogressSpeed);
		// Next silde
		owl2.next();

	});

	// typeahead (auto-complete)
	var substringMatcher = function (strs) {
		return function findMatches(q, cb) {
			var matches, substrRegex;

			// an array that will be populated with substring matches
			matches = [];

			// regex used to determine if a string contains the substring `q`
			substrRegex = new RegExp(q, 'i');

			// iterate through the pool of strings and for any string that
			// contains the substring `q`, add it to the `matches` array
			$.each(strs, function (i, str) {
				if (substrRegex.test(str)) {
					// the typeahead jQuery plugin expects suggestions to a
					// JavaScript object, refer to typeahead docs for more info
					matches.push({ value: str });
				}
			});

			cb(matches);
		};
	};

	var categories = [
		'Books & Magazines > Book',
		'Books & Magazines > Author',
		'Books & Magazines > Publisher',
		'Books & Magazines > Book Store',
		'Books & Magazines > Library',
		'Books & Magazines > Magazine',
		'Books & Magazines > Book Series',
		'Brands & Products > Product/Service',
		'Brands & Products > Website',
		'Brands & Products > Cars',
		'Brands & Products > Bags/Luggage',
		'Brands & Products > Camera/Photo',
		'Brands & Products > Clothing',
		'Brands & Products > Computers',
		'Brands & Products > Software',
		'Brands & Products > Office Supplies',
		'Brands & Products > Electronics',
		'Brands & Products > Health/Beauty',
		'Brands & Products > Appliances',
		'Brands & Products > Building Materials',
		'Brands & Products > Commercial Equipment',
		'Brands & Products > Home Decor',
		'Brands & Products > Furniture',
		'Brands & Products > Household Supplies',
		'Brands & Products > Kitchen/Cooking',
		'Brands & Products > Patio/Garden',
		'Brands & Products > Tools/Equipment',
		'Brands & Products > Wine/Spirits',
		'Brands & Products > Jewelry/Watches',
		'Brands & Products > Pet Supplies',
		'Brands & Products > Outdoor Gear/Sporting Goods',
		'Brands & Products > Baby Goods/Kids Goods',
		'Brands & Products > Food/Beverages',
		'Brands & Products > Vitamins/Supplements',
		'Brands & Products > Drugs',
		'Brands & Products > Phone/Tablet',
		'Brands & Products > Games/Toys',
		'Brands & Products > App Page',
		'Brands & Products > Video Game',
		'Brands & Products > Board Game',
		'Companies & Organizations > Company',
		'Companies & Organizations > Health/Beauty',
		'Companies & Organizations > Media/News/Publishing',
		'Companies & Organizations > Bank/Financial Institution',
		'Companies & Organizations > Non-Governmental Organization (NGO)',
		'Companies & Organizations > Insurance Company',
		'Companies & Organizations > Small Business',
		'Companies & Organizations > Energy/Utility',
		'Companies & Organizations > Retail and Consumer Merchandise',
		'Companies & Organizations > Automobiles and Parts',
		'Companies & Organizations > Industrials',
		'Companies & Organizations > Transport/Freight',
		'Companies & Organizations > Health/Medical/Pharmaceuticals',
		'Companies & Organizations > Aerospace/Defense',
		'Companies & Organizations > Mining/Materials',
		'Companies & Organizations > Farming/Agriculture',
		'Companies & Organizations > Chemicals',
		'Companies & Organizations > Consulting/Business Services',
		'Companies & Organizations > Legal/Law',
		'Companies & Organizations > Education',
		'Companies & Organizations > Engineering/Construction',
		'Companies & Organizations > Food/Beverages',
		'Companies & Organizations > Telecommunication',
		'Companies & Organizations > Biotechnology',
		'Companies & Organizations > Computers/Technology',
		'Companies & Organizations > Internet/Software',
		'Companies & Organizations > Travel/Leisure',
		'Companies & Organizations > Community Organization',
		'Companies & Organizations > Political Organization',
		'Companies & Organizations > Church/Religious Organization',
		'Companies & Organizations > Organization',
		'Companies & Organizations > School',
		'Companies & Organizations > University',
		'Companies & Organizations > Non-Profit Organization',
		'Companies & Organizations > Government Organization',
		'Companies & Organizations > Cause',
		'Companies & Organizations > Political Party',
		'Companies & Organizations > Middle School',
		'Local Businesses > Movie Theater',
		'Local Businesses > Concert Venue',
		'Local Businesses > Book Store',
		'Local Businesses > Library',
		'Local Businesses > Lawyer',
		'Local Businesses > Doctor',
		'Local Businesses > Restaurant/Cafe',
		'Local Businesses > Bar',
		'Local Businesses > Club',
		'Local Businesses > Outdoor Gear/Sporting Goods',
		'Local Businesses > Education',
		'Local Businesses > Church/Religious Organization',
		'Local Businesses > Local Business',
		'Local Businesses > Hotel',
		'Local Businesses > Landmark',
		'Local Businesses > Airport',
		'Local Businesses > Sports Venue',
		'Local Businesses > Arts/Entertainment/Nightlife',
		'Local Businesses > Automotive',
		'Local Businesses > Spas/Beauty/Personal Care',
		'Local Businesses > Event Planning/Event Services',
		'Local Businesses > Bank/Financial Services',
		'Local Businesses > Food/Grocery',
		'Local Businesses > Health/Medical/Pharmacy',
		'Local Businesses > Home Improvement',
		'Local Businesses > Pet Services',
		'Local Businesses > Professional Services',
		'Local Businesses > Business Services',
		'Local Businesses > Community/Government',
		'Local Businesses > Real Estate',
		'Local Businesses > Shopping/Retail',
		'Local Businesses > Public Places',
		'Local Businesses > Attractions/Things to Do',
		'Local Businesses > Sports/Recreation/Activities',
		'Local Businesses > Tours/Sightseeing',
		'Local Businesses > Transportation',
		'Local Businesses > Hospital/Clinic',
		'Local Businesses > Museum/Art Gallery',
		'Local Businesses > School',
		'Local Businesses > University',
		'Local Businesses > Middle School',
		'Movies > Actor/Director',
		'Movies > Movie',
		'Movies > Producer',
		'Movies > Writer',
		'Movies > Studio',
		'Movies > Movie Theater',
		'Movies > TV/Movie Award',
		'Movies > Fictional Character',
		'Movies > Movie Character',
		'Music > Album',
		'Music > Song',
		'Music > Musician/Band',
		'Music > Music Video',
		'Music > Concert Tour',
		'Music > Concert Venue',
		'Music > Radio Station',
		'Music > Record Label',
		'Music > Music Award',
		'Music > Music Chart',
		'Other > Community',
		'Other > Just For Fun',
		'People > Actor/Director',
		'People > Producer',
		'People > Writer',
		'People > Fictional Character',
		'People > Movie Character',
		'People > Musician/Band',
		'People > Author',
		'People > Athlete',
		'People > Artist',
		'People > Public Figure',
		'People > Journalist',
		'People > News Personality',
		'People > Chef',
		'People > Business Person',
		'People > Comedian',
		'People > Entertainer',
		'People > Teacher',
		'People > Dancer',
		'People > Designer',
		'People > Photographer',
		'People > Entrepreneur',
		'People > Politician',
		'People > Government Official',
		'People > Coach',
		'People > Pet',
		'Sports > Athlete',
		'Sports > Sports League',
		'Sports > Professional Sports Team',
		'Sports > Coach',
		'Sports > Amateur Sports Team',
		'Sports > School Sports Team',
		'Sports > Sports Event',
		'Sports > Sports Venue',
		'Television > Actor/Director',
		'Television > Writer',
		'Television > Studio',
		'Television > TV/Movie Award',
		'Television > Fictional Character',
		'Television > Movie Character',
		'Television > TV Show',
		'Television > TV Network',
		'Television > TV Channel',
		'Television > Episode',
		'Television > TV Season',
		'Websites & Blogs > Personal Blog',
		'Websites & Blogs > Arts/Humanities Website',
		'Websites & Blogs > Business/Economy Website',
		'Websites & Blogs > Computers/Internet Website',
		'Websites & Blogs > Education Website',
		'Websites & Blogs > Entertainment Website',
		'Websites & Blogs > Government Website',
		'Websites & Blogs > Health/Wellness Website',
		'Websites & Blogs > Home/Garden Website',
		'Websites & Blogs > News/Media Website',
		'Websites & Blogs > Recreation/Sports Website',
		'Websites & Blogs > Reference Website',
		'Websites & Blogs > Regional Website',
		'Websites & Blogs > Science Website',
		'Websites & Blogs > Society/Culture Website',
		'Websites & Blogs > Local/Travel Website',
		'Websites & Blogs > Teens/Kids Website',
		'Websites & Blogs > Personal Website',
	];

	$('#cat-selector .typeahead').typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		},
		{
			name: 'categories',
			displayKey: 'value',
			source: substringMatcher(categories)
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

	} else {
		var page_type = window.page_type || 'Fan Page';
		track_event('Account Manage', 'Create Success', page_type);
	}

	// Site created, facebook fixel
	window._fbq = window._fbq || [];
	//window._fbq.push(['track', facebook_site_created_pixel_id, {'value':'0.00', 'currency':'USD'}]);

	window.site_url = data.site_url;
	window.blog_redirect = data.redirect;
	window.blog_id = data.blog_id;
	window.token = data.token;

	jQuery('#see-my-website-btn').attr('href', data.redirect);
	jQuery('#oto-web-url').html(data.site_url);

	blog_created();
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


		$('#address').val(address);
		$('#email').val(email);
		$('#phone').val(phone);

		jQuery('#address').geocomplete('find', jQuery('#address').val());

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
	if (localhost) {
		request_url = "http://wp.test/migration/index.php";
	} else {
		request_url = "http://wp.otonomic.com/migration/index.php";
	}

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
	if (window.is_contact_saved == 1) {
		send_contact_data();
	}

	if (window.i_need_store == 1) {
		send_need_store();
	}
	if (window.set_site_category_pending == 1) {
		set_site_category();
	}

	return;
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
	// $.post( window.site_url + '/?json=settings.set_many', { values: values_changes });
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
