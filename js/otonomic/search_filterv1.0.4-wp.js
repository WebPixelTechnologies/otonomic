var found_result = 0;
var found_only_result_url = '';
var p2s_site_url = 'http://builder.otonomic.com/';
//var p2s_site_url = 'http://p2s.test/';        //for localhost

var total_req_no = 0;
var sto;
var p2strack = 0;

var minlength = 4;
var already_searched = false;

var redirect_url = '';

function parseURL(url){
    parsed_url = {}

    if ( url == null || url.length == 0 )
        return parsed_url;

    protocol_i = url.indexOf('://');
    parsed_url.protocol = url.substr(0,protocol_i);

    remaining_url = url.substr(protocol_i + 3, url.length);
    domain_i = remaining_url.indexOf('/');
    domain_i = domain_i == -1 ? remaining_url.length - 1 : domain_i;
    parsed_url.domain = remaining_url.substr(0, domain_i);
    parsed_url.path = domain_i == -1 || domain_i + 1 == remaining_url.length ? null : remaining_url.substr(domain_i + 1, remaining_url.length);

    domain_parts = parsed_url.domain.split('.');
    switch ( domain_parts.length ){
        case 2:
          parsed_url.subdomain = null;
          parsed_url.host = domain_parts[0];
          parsed_url.tld = domain_parts[1];
          break;
        case 3:
          parsed_url.subdomain = domain_parts[0];
          parsed_url.host = domain_parts[1];
          parsed_url.tld = domain_parts[2];
          break;
        case 4:
          parsed_url.subdomain = domain_parts[0];
          parsed_url.host = domain_parts[1];
          parsed_url.tld = domain_parts[2] + '.' + domain_parts[3];
          break;
    }

    parsed_url.parent_domain = parsed_url.host + '.' + parsed_url.tld;

    return parsed_url;
}



function create_wp_site(page_id){


    $.get( "http://iproplay.com/migration/index.php?site_id="+ page_id + "&theme=parallax", function( data ) {

        window.location = data;

    });
}

// IIFE - Immediately Invoked Function Expression
(function ($, window, document) {
    $('.form-search').hover(function () {
        $(this).focus();
    });

    if (!Modernizr.input.placeholder) {
        $('[placeholder]').focus(function () {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function () {
                var input = $(this);
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.addClass('placeholder');
                    input.val(input.attr('placeholder'));
                }
            }).blur();

        $('[placeholder]').parents('form').submit(function () {
            $(this).find('[placeholder]').each(function () {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            });
        });
    }
    $("#search_wrapper_main,#search_wrapper_floater").delegate(".search-results-item", 'click', function (e) {
        e.preventDefault();
        $('#btn_go').text('loading...');
        // var page_id = $(this).attr('href').replace(/[^0-9]/g,'');
        // create_wp_site(page_id);

    return false;



	$.ajax({
          type: "get",
          url: $(this).attr('href')
        })
        .done(function(response) {
            responseObj = $.parseJSON(response);
            if (responseObj.status === 'success') {
                redirect_url =responseObj.redirect;
		

		console.log("response: "+ responseObj.redirect);        
    

               // showLoader('Your site is being created for you!', true);
		//sleep(7000, function(){
                    get_site_id(redirect_url);
        //        });
		//showLoader('Your site is being created for you!', true);               
                
		return false;
            };
        });
        var page_name = $('p.media-heading', this).html();
        var result_number = $(this).data('result-number');
        var search_query = $('.main_search_box').val();
        closeSearch('#'+ $(this).parent().parent().attr('id'));
        //showLoader('Your site is being created for you!', true);
        $('.main_search_box').blur();
        trackFBConnect('Search Marketing Website', 'Choose Page', $(this).attr('data-attr')+","+search_query + ' >> ' + page_name, result_number);
    });

    $('#preview-form .form-submit, #preview-form2 .form-submit').on('click', function (e) {
        $('body').css('cursor', 'progress');
        $(this).html('Loading...&nbsp;').css('cursor', 'progress').parent('form').submit();
    });


    $('.btn_go').click(function (event) {
        event.preventDefault();
        var $thisParent = $(this).parent().parent().find('.p2s_fanpages');
        var $el = $thisParent.find('.main_search_box');
        var $page_url = $el.val();

        console.log($page_url.indexOf("facebook.com"));

        if($.trim($thisParent.find('.main_search_box').val()) == ''){
            found_result = 0;   //clear previous results if user delete text from search box
        }
        if (found_result > 1 && ($page_url.indexOf("facebook.com") == -1)) {
            $(this).tipsy("show");
            return false;
        }

        $(this).tipsy("hide");
        trackFBConnect("Search Marketing Website", "Go", $(this).attr('data-attr')+","+$page_url);

        if ($page_url.indexOf("facebook.com") > -1) {
            var url = p2s_site_url + 'sites/add/?u=' + encodeURIComponent($page_url);
            trackFBConnect("Search Marketing Website", "Choose Url", $page_url);
            setTimeout(function () { // now wait 300 milliseconds...
                showLoader('Your site is being created for you!', true);
                window.location = url;
                //window.open(href,(!target?"_self":target)); // ...and open the link as usual
            }, 300);
            return false;
        }


        if (found_result == 1 && $.trim(found_only_result_url) != '') {
            trackFBConnect("Search Marketing Website", "Choose Url", $(this).attr('data-attr')+","+found_only_result_url);
            setTimeout(function () { // now wait 300 milliseconds...
                showLoader('Your site is being created for you!', true);
                window.location = found_only_result_url;
                //window.open(href,(!target?"_self":target)); // ...and open the link as usual
            }, 300);
            return false;
        }

        if(AUTO_FOCUS == undefined || AUTO_FOCUS == true)
            $thisParent.find('.main_search_box').focus();


        if ($page_url.indexOf("facebook.com") > -1 || $.trim($page_url) == '') {
            //input box is empty
            show_empty_message($thisParent);
        } else {
            //page not found
            show_page_not_found_message($thisParent);
        }
    });

}(window.jQuery, window, document));

$(document).ready(function($){

    $(document).on('click','#how_do_i',function(event){
        event.preventDefault();
        var $this = $(this);

        if($this.hasClass('open')){
            closeHowDoISteps();
        } else {
            openHowDoISteps();
        }
        //return false;
    });

});

var timeoutEmptySearchBox;

function searchBoxClick(InputField) {
    //console.log('searchBoxClick('+InputField+')');
    var value = $(InputField).val();
    if(value.length == 0) {
        timeoutEmptySearchBox = setTimeout(function() {
            show_empty_message(InputField);
        }, 1000);
    }
}

function searchBoxKeyUp(InputField,targetContainer,targetCloseBtn) {
    clearTimeout(timeoutEmptySearchBox);

    var that = $(InputField);
    var value = $(InputField).val();

    var wrapper = $(targetContainer);
    var url = 'https://graph.facebook.com/search';
    //console.log($(InputField).parent().parent().find('div.btn_go'));
    $(InputField).parent().parent().find('div>button.btn_go').tipsy("hide");

    //?q={text_box_value, escaped}&type=page&fields=id,name,category,cover,likes
    if (value.length == 0) {
        $(targetCloseBtn).hide();
        wrapper.html($('<div/>', {}));
    } else {
        $(targetCloseBtn).show();
    }

    if (value.length < minlength) {
        return;
    }

    total_req_no += 1;
    var this_req_no = total_req_no;
    setTimeout(function () {
        if (this_req_no < total_req_no) {
            return;
        }
        p2strack++;
        trackFBConnect("Search Marketing Website", "Query", $(InputField).attr('data-attr')+","+value, p2strack);
    }, 2000);

    if (!already_searched) {
    }

    already_searched = true;

    if (value.indexOf("facebook.com") > -1) {
        // User inserted full address - don't perform search
        $(targetCloseBtn).hide();
        wrapper.html($('<div/>', {}));
        return;
    }

    /* show_searching_message(); */
    $.jsonp({
        url: 'https://graph.facebook.com/search',
        context: document.body,
        callbackParameter: "callback",
        data: {'q': value, type: 'page', fields: 'id,name,category,cover,likes', limit: 9, access_token: '389314351133865|O4FgcprDMY0k6rxRUO-KOkWuVoU'},
        success: function (json, textStatus, xOptions) {
            found_only_result_url = '';
            found_result = json.data.length;
            if (this_req_no < total_req_no) return;

            var ind = 1;
            var items = [];
            jQuery.each(json.data, function (key, val) {
                if (found_result == 1) {
                    found_only_result_url = p2s_site_url + 'sites/add/fbid:' + val.id;
                }

                if(SEARCH_PICTURE_SIZE == undefined || SEARCH_PICTURE_SIZE == 'square'){
                    var simage = 'http://graph.facebook.com/' + val.id + '/picture?type=square'
                } else {
                    var simage = 'http://graph.facebook.com/' + val.id + '/picture?height=' + SEARCH_PICTURE_SIZE +'&width=' + SEARCH_PICTURE_SIZE;
                }

                items.push('<a class="media search-results-item" data-attr="'+$(InputField).attr('data-attr')+'" href="http://otonomic.com/progresslp?page_id='+val.id+'" title="Click to view site" data-result-number="' + ind + '" >' +
                    '<div >' +
                    '<div class="pull-left fanpage">' +
                    '<img class="media-object" src="'+ simage +'">' +
                    '</div>' +
                    '<div class="media-body pull-left">' +
                    '<p class="media-heading">' +
                    val.name +
                    '</p>' +
                    '<p class="media-address">' +
                    val.category +
                    '</p>' +
                    '<p class="media-address" style="color:black;">' + val.likes + ' likes</p>' +
                    '</div>' +
                    '<div class="clearfix"></div>' +
                    '</div>' +
                    '</a>'
                );
                ind++;
            });

            if (found_result > 0) {
                wrapper.html($('<div/>', {'class': 'search_results', html: items.join('')}));
            } else {
                show_page_not_found_message(InputField);
            }
        }
    });
}
function closeSearch(targetContainer,from){
        found_result = 0;
        trackFBConnect('Search Marketing Website','Close',from);

        var wrapper = $(targetContainer);
        wrapper.html($('<div/>', {}));
        $(".main_search_box").val('');
        jQuery('.btn_go').tipsy("hide");
        closeHowDoISteps();
        $(".close-search").hide();
        $(".close-search-floater").hide();
        // perevent scrolling to top of the page on close
        if(from != 'top'){
            $('#main_search_box').focus();
        }
}

function show_searching_message(){
    //console.log('show_searching_message()');
    var $sbox = $(".search_progress").clone();
    $('#search_wrapper_main').html('').html($sbox).show();
}

function show_empty_message(inputField){
    //console.log('show_empty_message('+inputField+')');
    closeHowDoISteps();
    if($(inputField).val() == ''){
        var $tbox = $(".t_box").clone();
        $(".msg_info" , $tbox).html('Search for your Facebook Business Page above');
        $(".first_msg" , $tbox).html('Type in its name in the search box');
        $(".first_msg_desc" , $tbox).html('e.g. Jessica\'s Pastries');
        $(inputField).parent().find('.search-wrapper').html('').html($tbox).show();
        $(".close_btn").show();
    } else {
        show_page_not_found_message();
    }
}
function show_page_not_found_message(inputField){
    //console.log('show_page_not_found_message()');
    closeHowDoISteps();
    var $tbox = $(".t_box").clone();
    $(inputField).parent().find('.search-wrapper').html('').html($tbox).show();
    $(".close_btn").show();
}

function closeHowDoISteps(){
    $("#how_do_i").removeClass('open');
    $(".t_box").removeClass('open');
}

function openHowDoISteps(){
    $("#how_do_i").addClass('open');
    $(".t_box").addClass('open');
}

var loaderCounter;
var interval;
function counterLoader(counterElementId){
            loaderCounter = 8;
            document.getElementById(counterElementId).innerHTML = loaderCounter;
            interval = setInterval(function(){
                if (loaderCounter <= 1){
                    //fade in/out animation 
                    $(".loading-content").animate({opacity:"0"}, 300,"swing", function() {
                        $('.loading-content').html('<p>Your new website is <strong>ready</strong>!</p>');
                        $('.loading-image>img').attr('src','images/loading/v.gif');
                        $('.loading-page .loading-content p').css('margin','71px 0  34px 0');
                        $(".loading-content").animate({opacity:"1"}, 300,"swing");
                    });
                    // start redirect
                    setTimeout(function(){
                        var ua    = navigator.userAgent.toLowerCase(),
                        isIE      = ua.indexOf('msie') !== -1,
                        version   = parseInt(ua.substr(ua.indexOf('msie')+5, 1), 10);

                    // IE9 
                    if (isIE && version == 9) {
                        $('.loading-content .loading-counter-text').html('<p>Your website is ready</p><a href="'+redirect_url+'" class="btn btn-lg btn-ttc" class="btn_go btn btn-ttc track_event" data-ga-category="Marketing Website"  data-ga-event="site created ie9fix" data-ajax-track="1">See Your Website</a>');
                    }
                    // All other browsers
                    else {
			 window.location.href = redirect_url; }
                    },1000);

                    clearInterval(interval);
                    loaderCounter--;
                    document.getElementById(counterElementId).innerHTML = loaderCounter;
                    return;
                }
                loaderCounter--;
                document.getElementById(counterElementId).innerHTML = loaderCounter;

            }, 1000);
        }

function showLoader(message, is_model) {

    $('#wrapper').css('display','none');
    $('.loading-box').animate({opacity: '1'}, 1500,'swing');
    $('.loading-box').addClass('show');

    counterLoader('loaderCounter');
}
