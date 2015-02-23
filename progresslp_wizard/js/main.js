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
	track_virtual_pageview('installer_start');
	jQuery('input[type=text]').addClass('LoNotSensitive');

    function move_slide(pressed_button) {
        var current_slide = pressed_button.parents('.installer-stage');
        track_event('Loading Page', 'Next', current_slide.attr('id'));
        current_slide.fadeOut('slow', function () {
            current_slide.next().removeClass('hidden').fadeIn();
        });
    }

    // Intro next btn - Let the magic begin
    $('.btn-back').click(function(event) {
        var $this = $(this);
        var current_slide = $this.parents('.installer-stage');
        track_event('Loading Page', 'Back', current_slide.attr('id'));
        event.preventDefault();

        current_slide.fadeOut('slow', function () {
            current_slide.addClass('hidden');
        });
        current_slide.prev().removeClass('hidden').fadeIn();
    });

    // Stage next btn
    $('.btn-next').click(function(event){
        event.preventDefault();
        move_slide( $(this));
    });

    // Intro next btn - Let the magic begin
	$('.js-intro-next').click(function(event){
        event.preventDefault();
        move_slide( $(this));
	});

	// Stage-1 next btn - Be found on Search Engines
	$('.js-stage1-next').click(function(event){
        event.preventDefault();
        move_slide( $(this));
	});
	
	// Stage-2 next btn - Select device
	$('.js-stage2-next').click(function(event){
        event.preventDefault();
        move_slide( $(this));
	});

	// Stage-3 next btn - Store/Booking
	$('.js-stage3-next').click(function(event){
        event.preventDefault();
        move_slide( $(this));

        var values = {};
        values.show_store = $('#option-online-store').hasClass('checked') ? 'yes' : 'no';
        values.show_booking = $('#option-booking').hasClass('checked') ? 'yes' : 'no';
        enqueue_submit('show_store',   values.show_store,   'send_store');
        return enqueue_submit('show_booking', values.show_booking, 'send_booking');
	});

	// Stage-4 next btn - Social Channels
	$('.js-stage4-next').click(function(event){
        event.preventDefault();
        move_slide( $(this));
	});

    // Stage-5 next btn - Select Template
    $('.btn-choose-template').click(function(event){
        event.preventDefault();
        move_slide( $(this));

        var skin = $(this).attr('data-option-value');
        return enqueue_submit('skin', skin, 'send_template');
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
		$('#choose-template').fadeOut('slow', function () {
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

            if(sec == 4) {
				ga('set', 'metric5', '1');
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
	$('.btn-checkbox, .social-btn').click(function (e) {
		var action = $(this).attr('data-analytics-action');
		var label = $(this).attr('data-analytics-label');
		var value = 'Selected';
		if($(this).hasClass('checked'))
			value = 'Selection removed';

		track_event('Loading Page', action, label, value);
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

    // typeahead
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
        "Local Businesses > Jazz Club",
        "Local Businesses > Juvenile Law",
        "Local Businesses > Just For Fun",
        "Local Businesses > Jewelry Store",
        "Local Businesses > Jewelry Supplier",
        "Local Businesses > Janitorial Service",
        "Local Businesses > Junior High School",
        "Local Businesses > Japanese Restaurant",
        "Local Businesses > Smoothie & Juice Bar",
        "Local Businesses > Hot Dog Joint",
        "Local Businesses > Web Design",
        "Local Businesses > Web Development",
        "Local Businesses > Wedding Planning",
        "Local Businesses > Well Water Drilling Service",
        "Local Businesses > Formal Wear",
        "Local Businesses > Wine Bar",
        "Local Businesses > Wallpaper",
        "Local Businesses > Wig Store",
        "Local Businesses > Warehouse",
        "Local Businesses > Water Park",
        "Local Businesses > Women's Health",
        "Local Businesses > Writing Service",
        "Local Businesses > Waste Management",
        "Local Businesses > Event",
        "Local Businesses > Eyewear",
        "Local Businesses > Eco Tours",
        "Local Businesses > Education",
        "Local Businesses > Esthethics",
        "Local Businesses > Entertainer",
        "Local Businesses > Electrician",
        "Local Businesses > Event Venue",
        "Local Businesses > Estate Lawyer",
        "Local Businesses > Event Planner",
        "Local Businesses > River",
        "Local Businesses > Rodeo",
        "Local Businesses > Resort",
        "Local Businesses > Roofer",
        "Local Businesses > Region",
        "Local Businesses > Rafting",
        "Local Businesses > RV Park",
        "Local Businesses > Railroad",
        "Local Businesses > Robotics",
        "Local Businesses > Reservoir",
        "Local Businesses > Rock Climbing",
        "Local Businesses > Roller Coaster",
        "Local Businesses > Meeting Room",
        "Local Businesses > Tea Room",
        "Local Businesses > Emergency Roadside Service",
        "Local Businesses > Race Cars",
        "Local Businesses > Race Track",
        "Local Businesses > Ramen Restaurant",
        "Local Businesses > Racquetball Court",
        "Local Businesses > Radio & Communication Equipment",
        "Local Businesses > Subway & Light Rail Station",
        "Local Businesses > Gun Range",
        "Local Businesses > Driving Range",
        "Local Businesses > RV Repair",
        "Local Businesses > RV Dealership",
        "Local Businesses > Taxi",
        "Local Businesses > Tennis",
        "Local Businesses > Theatre",
        "Local Businesses > Tutoring",
        "Local Businesses > Textiles",
        "Local Businesses > Toy Store",
        "Local Businesses > Theme Park",
        "Local Businesses > Translator",
        "Local Businesses > Tour Guide",
        "Local Businesses > Yoga & Pilates",
        "Local Businesses > Youth Organization",
        "Local Businesses > Frozen Yogurt Shop",
        "Local Businesses > Urban Farm",
        "Local Businesses > Upholstery Service",
        "Local Businesses > Public Utility",
        "Local Businesses > College & University",
        "Local Businesses > Inn",
        "Local Businesses > Island",
        "Local Businesses > Ice Skating",
        "Local Businesses > Ice Machines",
        "Local Businesses > Internet Cafe",
        "Local Businesses > Insurance Agent",
        "Local Businesses > Irish Restaurant",
        "Local Businesses > Image Consultant",
        "Local Businesses > Insurance Broker",
        "Local Businesses > Ice Cream Parlor",
        "Local Businesses > Other",
        "Local Businesses > Ocean",
        "Local Businesses > OBGYN",
        "Local Businesses > Outdoors",
        "Local Businesses > Orchestra",
        "Local Businesses > Oncologist",
        "Local Businesses > Optometrist",
        "Local Businesses > Organization",
        "Local Businesses > Outlet Store",
        "Local Businesses > Office Supplies",
        "Local Businesses > Pub",
        "Local Businesses > Park",
        "Local Businesses > Port",
        "Local Businesses > Plumber",
        "Local Businesses > Parking",
        "Local Businesses > Painter",
        "Local Businesses > Psychic",
        "Local Businesses > Pharmacy",
        "Local Businesses > Plastics",
        "Local Businesses > Pet Store",
        "Local Businesses > Pawn Shop",
        "Local Businesses > Paintball",
        "Local Businesses > Party Center",
        "Local Businesses > Party Supplies",
        "Local Businesses > Patrol & Security",
        "Local Businesses > Pakistani Restaurant",
        "Local Businesses > Passport & Visa Service",
        "Local Businesses > Arcade",
        "Local Businesses > Archery",
        "Local Businesses > Airport",
        "Local Businesses > Airline",
        "Local Businesses > Allergist",
        "Local Businesses > Appraiser",
        "Local Businesses > Amusement",
        "Local Businesses > Architect",
        "Local Businesses > Auditorium",
        "Local Businesses > Art School",
        "Local Businesses > Apartment & Condo Building",
        "Local Businesses > Appliances",
        "Local Businesses > Apostolic Church",
        "Local Businesses > Real Estate Appraiser",
        "Local Businesses > Adult Education",
        "Local Businesses > Adoption Service",
        "Local Businesses > Advertising Agency",
        "Local Businesses > Addiction Resources",
        "Local Businesses > Adult Entertainment",
        "Local Businesses > Admissions Training",
        "Local Businesses > Advertising Service",
        "Local Businesses > Healthcare Administrator",
        "Local Businesses > Seventh Day Adventist Church",
        "Local Businesses > Health Care Administration",
        "Local Businesses > Afghani Restaurant",
        "Local Businesses > African Restaurant",
        "Local Businesses > African Methodist Episcopal Church",
        "Local Businesses > Agricultural Service",
        "Local Businesses > Real Estate Agent",
        "Local Businesses > Modeling Agency",
        "Local Businesses > Travel Agency",
        "Local Businesses > Collection Agency",
        "Local Businesses > Health Agency",
        "Local Businesses > Employment Agency",
        "Local Businesses > Accountant",
        "Local Businesses > Acupuncture",
        "Local Businesses > Active Life",
        "Local Businesses > Accessories Store",
        "Local Businesses > Car Parts & Accessories",
        "Local Businesses > Automotive Parts & Accessories",
        "Local Businesses > Abortion Services",
        "Local Businesses > Spa",
        "Local Businesses > State",
        "Local Businesses > Street",
        "Local Businesses > School",
        "Local Businesses > Storage",
        "Local Businesses > Startup",
        "Local Businesses > Surveyor",
        "Local Businesses > Swimwear",
        "Local Businesses > Symphony",
        "Local Businesses > Security",
        "Local Businesses > DJ",
        "Local Businesses > DMV",
        "Local Businesses > Deli",
        "Local Businesses > Dorm",
        "Local Businesses > Diner",
        "Local Businesses > Doctor",
        "Local Businesses > Dentist",
        "Local Businesses > Day Spa",
        "Local Businesses > Dive Bar",
        "Local Businesses > Drugstore",
        "Local Businesses > Farm",
        "Local Businesses > Fishing",
        "Local Businesses > Florist",
        "Local Businesses > Food Stand",
        "Local Businesses > Food Truck",
        "Local Businesses > Fairground",
        "Local Businesses > Fireplaces",
        "Local Businesses > Flea Market",
        "Local Businesses > Fireproofing",
        "Local Businesses > Gym",
        "Local Businesses > Gay Bar",
        "Local Businesses > Gardener",
        "Local Businesses > Gastropub",
        "Local Businesses > Gift Shop",
        "Local Businesses > Gun Store",
        "Local Businesses > Go Karting",
        "Local Businesses > Golf Course",
        "Local Businesses > Gas Station",
        "Local Businesses > Home",
        "Local Businesses > Hotel",
        "Local Businesses > Hostel",
        "Local Businesses > Horses",
        "Local Businesses > Highway",
        "Local Businesses > Hospital",
        "Local Businesses > Health Spa",
        "Local Businesses > Hair Salon",
        "Local Businesses > Housewares",
        "Local Businesses > Home Decor",
        "Local Businesses > Church of Jesus Christ of Latter-day Saints",
        "Local Businesses > Kennel",
        "Local Businesses > Karaoke",
        "Local Businesses > Kingdom Hall",
        "Local Businesses > Kitchen Supplies",
        "Local Businesses > Kosher Restaurant",
        "Local Businesses > Korean Restaurant",
        "Local Businesses > Kitchen Construction",
        "Local Businesses > Lake",
        "Local Businesses > Lodge",
        "Local Businesses > Loans",
        "Local Businesses > Lounge",
        "Local Businesses > Lodging",
        "Local Businesses > Library",
        "Local Businesses > Lobbyist",
        "Local Businesses > Landmark",
        "Local Businesses > Laser Tag",
        "Local Businesses > Locksmith",
        "Local Businesses > Zoo & Aquarium",
        "Local Businesses > Petting Zoo",
        "Local Businesses > Camp",
        "Local Businesses > Cafe",
        "Local Businesses > City",
        "Local Businesses > Cabin",
        "Local Businesses > Clergy",
        "Local Businesses > Clinic",
        "Local Businesses > Church",
        "Local Businesses > Casino",
        "Local Businesses > County",
        "Local Businesses > Cruise",
        "Local Businesses > Video Games",
        "Local Businesses > Veterinarian",
        "Local Businesses > Vintage Store",
        "Local Businesses > Vacation Home Rental",
        "Local Businesses > Vietnamese Restaurant",
        "Local Businesses > Vending Machine Service",
        "Local Businesses > Vegetarian & Vegan Restaurant",
        "Local Businesses > Antiques & Vintage",
        "Local Businesses > Fruit & Vegetable Store",
        "Local Businesses > Sports Venue & Stadium",
        "Local Businesses > Bar",
        "Local Businesses > Bank",
        "Local Businesses > Beach",
        "Local Businesses > Bakery",
        "Local Businesses > Bridge",
        "Local Businesses > Brewery",
        "Local Businesses > Borough",
        "Local Businesses > Boating",
        "Local Businesses > Butcher",
        "Local Businesses > Bus Line",
        "Local Businesses > Bail Bonds",
        "Local Businesses > Babysitter",
        "Local Businesses > Barber Shop",
        "Local Businesses > Bar & Grill",
        "Local Businesses > Batting Cage",
        "Local Businesses > Baptist Church",
        "Local Businesses > Basque Restaurant",
        "Local Businesses > Nanny",
        "Local Businesses > Nursing",
        "Local Businesses > Nightlife",
        "Local Businesses > Newspaper",
        "Local Businesses > Night Club",
        "Local Businesses > Nail Salon",
        "Local Businesses > Nutritionist",
        "Local Businesses > Nursing Home",
        "Local Businesses > Neighborhood",
        "Local Businesses > Notary Public",
        "Local Businesses > Mover",
        "Local Businesses > Motel",
        "Local Businesses > Mosque",
        "Local Businesses > Museum",
        "Local Businesses > Market",
        "Local Businesses > Marina",
        "Local Businesses > Metals",
        "Local Businesses > Masonry",
        "Local Businesses > Mission",
        "Local Businesses > Massage",
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
		ga('set', 'metric6', '1');
        track_virtual_pageview('site_exists');

	} else {
		var page_type = window.page_type || 'Fan Page';
		track_event('Account Manage', 'Site Created', page_type);
		ga('set', 'metric4', '1');
        track_virtual_pageview('site_created');
	}

    <!-- START Facebook Pixel Tracking for Site created-->
	window._fbq = window._fbq || [];
    if(!is_localhost()) {
	    window._fbq.push(['track', facebook_site_created_pixel_id, {'value':'0.00', 'currency':'USD'}]);
    }
    <!-- END Facebook Pixel Tracking -->

	window.site_url = data.site_url;
	window.blog_redirect = data.redirect;
	window.blog_id = data.blog_id;
	window.token = data.token;

	jQuery('#oto-web-url').html('<a href="'+data.redirect+'">'+data.site_url+'</a>');

    if( data.status === 'fail') {
        alert( data.message);
        window.location.replace(data.redirect);
        return;
    }

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
	request_data.theme = "dreamtheme";
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

function send_store() {
    if (window.show_store == "yes") {
        send_need_store();
    } else {
        send_dont_need_store();
    }
}

function send_booking() {
    if (window.show_booking == "yes") {
        send_need_booking();
    } else {
        send_dont_need_booking();
    }
}

function send_template() {
    var skin = window.skin || '';
    track_event('Loading Page', 'Select Template', skin);
    return post_WP_settings({ skin: skin }, 'Select Template');
}

function enqueue_submit(setting, value, callback_function) {
    window[setting] = value;

    if(window.is_blog_ready) {
        window[callback_function]();

    } else {
        window.callbacks = window.callbacks || [];
        window.callbacks.push(callback_function);
    }
}

function blog_created() {
    window.callbacks = window.callbacks || [];
    $.each( window.callbacks, function(index, callback_function) {
        window[callback_function]();
    });

	send_user_fb_details();
	send_user_authorized_channel();

	return;
}

function redirect_to_website() {
	if(window.do_redirect == 1 && window.is_blog_ready == 1) {
        window.location.replace(window.blog_redirect);
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
    return post_WP_settings({ show_booking: 1 }, 'Booking');
}

function send_dont_need_booking() {
    track_event('Loading Page', 'Booking', 'No');
    return post_WP_settings({ show_booking: 0 }, 'Booking');
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
