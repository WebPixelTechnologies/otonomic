/**
 * Created with JetBrains PhpStorm.
 * User: Omri
 * Date: 14/08/14
 * Time: 12:51
 * To change this template use File | Settings | File Templates.
 */
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

    // Site created, fire a facebook conversion pixel
    window._fbq = window._fbq || [];
    window._fbq.push(['track', facebook_site_created_pixel_id, {'value':'0.00', 'currency':'USD'}]);

    window.site_url = data.site_url;
    window.blog_redirect = data.redirect;
    window.blog_id = data.blog_id;
    window.token = data.token;

    jQuery('#see-my-website-btn').attr('href', data.redirect);

    blog_created();
};

function blog_created() {
    if (window.is_contact_saved == 1) {
        send_contact_data();
    }

    if (window.i_need_store == 1) {
        send_need_store();
    }

    return;
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

    var values_changes = { phone:_phone, address:_address, email:_email}
    // $.post( window.site_url + '/?json=settings.set_many', { values: values_changes });

    request = $.ajax({
        type:"POST",
        url:window.site_url + '/?json=settings.set_many',
        data:{ values:values_changes },
        statusCode:{
            200:function () {
                return;
            },
            307:function () {
                $.post(window.site_url + '/?json=settings.set_many', { values:values_changes });
            }
        }
    });
}

function send_need_store() {
    track_event('Loading Page', 'Online Store', 'Yes');
    request = $.ajax({
        type:"POST",
        url:window.site_url + '/?json=store.create',
        statusCode:{
            200:function () {
                //doSomething();
            },
            307:function () {
                $.post(window.site_url + '/?json=store.create');
            }
        }
    });
}

function send_dont_need_store() {
    track_event('Loading Page', 'Online Store', 'No');
    request = $.ajax({
        type:"POST",
        url:window.site_url + '/?json=store.hide',
        statusCode:{
            200:function () {
                //doSomething();
            },
            307:function () {
                $.post(window.site_url + '/?json=store.hide');
            }
        }
    });
}

function getFacebookPageAddress(page_id) {
    var facebook_query_page_url = "https://graph.facebook.com/" + page_id+'?fields=category,category_list,id,name,location,likes';
    $.get(facebook_query_page_url, function (data) {
        console.log("the page:" + page_id);
        console.log(data);

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
            'phone':phone,
            'address':address,
            'email':email
        }


        $('#address').val(address);
        $('#email').val(email);
        $('#phone').val(phone);

        jQuery('#address').geocomplete('find', jQuery('#address').val());

    }, "json");
}

function is_localhost() {
    if( location.host == 'otonomic.test' || location.host == 'localhost') {
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
    if(localhost) {
        request_url = "http://wp.test/migration/index.php";
    } else {
        request_url = "http://wp.otonomic.com/migration/index.php";
    }

    $.ajax({
        url: request_url,
        type: "GET",
        dataType: "jsonp",
        data: request_data,
        jsonp : "callback",
        jsonpCallback: "callback"
    });
}

function contact_form_submited() {
    window.is_contact_saved = 1;

    if (window.is_blog_ready == 1) {
        send_contact_data();

    } else {
        window.users_contacts = {
            'phone':$('#phone').val(),
            'address':$('#address').val(),
            'email':$('#email').val()
        }
    }
}




$(function () {
    // Track to analytics that the loading page is viewed
    track_event('Loading Page', 'View');

    // Allow LO to record input data
    jQuery('input[type=text]').addClass('LoNotSensitive');

    // start progress-bar for element id='targetElement'
    // owl-carousel init
    $("#owl-slider").owlCarousel({
        navigation:false,
        singleItem:true,
        transitionStyle:"fade",
        //Pagination
        pagination:false,
        paginationNumbers:false,
        //Mouse Events
        dragBeforeAnimFinish:false,
        mouseDrag:false,
        touchDrag:false,
        //Basic Speeds
        slideSpeed:200
    });

    //get carousel instance data and store it in variable owl
    var owl = $("#owl-slider").data('owlCarousel');


    var progressBarOptions = {};
    progressBarOptions.percent_increase = 1;
    progressBarOptions.increaseEveryMsec = 500;

    var progressBarStartTime = new Date().getTime();
    var nextStopSlide = 12;
    var nextStopSlideInPercent;

    var expected_slide_according_to_time;
    var expected_percent_according_to_time;

    var progressBar = progressJs("#progress-bar").start().autoIncrease(progressBarOptions.percent_increase, progressBarOptions.increaseEveryMsec);//.set(0);

    // callback function to call for each change of progress-bar
    progressBar.onprogress(function (targetElm, percent) {
        expected_percent_according_to_time = (new Date().getTime() - progressBarStartTime) / progressBarOptions.increaseEveryMsec * progressBarOptions.percent_increase;
        expected_slide_according_to_time = convertPercentToSlide(expected_percent_according_to_time);
        if(expected_percent_according_to_time > percent+5) {
            temp_slide = Math.min( expected_slide_according_to_time, nextStopSlide);
            if( temp_slide > owl.currentItem) {
                owl.goTo(temp_slide);
                percent = convertSlideToPercent(temp_slide);
                progressBar.set( percent);
            }
        }

        if (owl.currentItem == 12) {
            progressBar.set(convertSlideToPercent(owl.currentItem));

        } else if (owl.currentItem == 14) {
            progressBar.set(convertSlideToPercent(owl.currentItem));
        }

        if (owl.currentItem == owl.maximumItem) {
            progressBar.set(100);
            owl.stop() // Autoplay Stop

        }

        if (percent > convertSlideToPercent(owl.currentItem+1)) {
            owl.next();
        }

        if (percent == 100) {
            $('.progressjs-theme-blue .progressjs-percent').hide();
            progressBar.end();
            owl.stop() // Autoplay Stop
        }
    });

    function convertSlideToPercent(slide) {
        return Math.floor(slide/owl.itemsAmount*100);
    }

    function convertPercentToSlide(percent) {
        return Math.floor(percent/100*owl.itemsAmount);
    }

    $('.submit-skip').click(function (e) {
        e.preventDefault();
        owl.next();
    });


    var options = {
        map:".map_canvas"
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


    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    $('#see-my-website-btn').click(function () {
        track_event('Loading Page', 'Show Website');
        window.location.href = window.blog_redirect;
    });

    $('#contact-form-btn').click(function () {
        contact_form_submited();
        owl.next();
    });

    $('#dont-need-store-btn').click(function () {
        send_dont_need_store();
        owl.next();
    });

    $('#create_store_btn').click(function () {
        if (window.is_blog_ready == 1) {
            send_need_store();

        } else {
            window.i_need_store = 1;
        }
        owl.next();
    });






    // Get the page id from the query param page_id
    var page_id = getParameterByName('page_id');

    if (page_id) {
        createWebsiteUsingAjax(page_id);
        getFacebookPageAddress(page_id);
    }

});
