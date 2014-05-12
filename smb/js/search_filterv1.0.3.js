var found_result = 0;
var found_only_result_url = '';
var p2s_site_url = 'http://builder.page2site.com/';
//var p2s_site_url = 'http://p2s.test/';        //for localhost

var total_req_no = 0;
var sto;
var p2strack = 0;

var minlength = 4;
var already_searched = false;

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

    $("#search_wrapper_main").delegate(".search-results-item", 'click', function (e) {
        /*var page_name = $('p.media-heading', this).html();
        var result_number = $(this).data('result-number');
        var search_query = $('#main_search_box').val();
        showLoader('Your site is being created for you!', true);
        trackFBConnect('Search LP', 'Choose Page', search_query + ' >> ' + page_name, result_number);*/
    });

    $('#preview-form .form-submit, #preview-form2 .form-submit').on('click', function (e) {
        /*
         if(!(url = $('#form_name').val())) {
         e.preventDefault();
         $('#form_name').focus();
         return false;
         };
         */

        $('body').css('cursor', 'progress');
        $(this).html('Loading...&nbsp;').css('cursor', 'progress').parent('form').submit();
    });

    $("#main_search_box").click(function () {
        if(found_result == 0){
            //$('#search_wrapper_main').html('<div class="search_results"><div id="empty_search_box_go" class="center"><img src="/shared/fanpages/images/up-arrow.png"><div style="margin-top: 18px;">Type in your Facebook Fan Page in the search box above</div><img style="float: right" class="close-search" src="/shared/fanpages/images/close.png" width="24" height="19"/></div></div>').show();
            show_empty_message();
        }
    });
}(window.jQuery, window, document));

$(document).ready(function($){
    $("#main_search_box").keyup(function () {
        var that = this;
        var value = $(this).val();
        //var wrapper = $(this).next();
        var wrapper = $("#search_wrapper_main");
        var url = 'https://graph.facebook.com/search';

        jQuery('#btn_go').tipsy("hide");

        //?q={text_box_value, escaped}&type=page&fields=id,name,category,cover,likes
        if (value.length == 0) {
            $(".close-search").hide();
            wrapper.html($('<div/>', {}));
        } else {
            $(".close-search").show();
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
            //trackFBConnect("Search LP", "Query", value, p2strack);
        }, 2000);

        if (!already_searched) {
        }

        already_searched = true;

        show_searching_message();
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
                //items.push('<div style="position: absolute; right: 10px; top: 10px;width:24px;height:19px;cursor:pointer;"><img class="close-search" src="misc/images/home/close.png" width="24" height="19"/></div>');
                jQuery.each(json.data, function (key, val) {
                    if (found_result == 1) {
                        found_only_result_url = p2s_site_url + 'sites/add/fbid:' + val.id;
                    }
                    items.push('<a class="media search-results-item" href="' + p2s_site_url + '/sites/add/fbid:' + val.id + '" title="Click to view site" data-result-number="' + ind + '" >' +
                        '<div >' +
                        '<div class="pull-left fanpage">' +
                        '<img class="media-object" src="http://graph.facebook.com/' + val.id + '/picture?type=square">' +
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
                    show_page_not_found_message();
                    //wrapper.html('');
                }
            }
        });
    });

    $(document).on('click','#how_do_i',function(e){
        e.preventDefault();
        $(".t_box").css('width', '920px');
        $(".t_box .msgbox").css('border-right', '1px solid #000000');
        $(".t_box .steps").show();

        return false;
    });
});

function show_searching_message(){
    var $sbox = $(".search_progress").clone();
    $('#search_wrapper_main').html('').html($sbox).show();
}

function show_empty_message(){
    if($("#main_search_box").val() == ''){
        var $tbox = $(".t_box").clone();
        $(".msg_info" , $tbox).html('Search for your Facebook Business Page above');
        $(".first_msg" , $tbox).html('Type in its name in the search box');
        $(".first_msg_desc" , $tbox).html('e.g. Jessica\'s Pastries');
        $('#search_wrapper_main').html('').html($tbox).show();
        $(".close_btn").show();
    } else {
        show_page_not_found_message();
    }
}
function show_page_not_found_message(){
    var $tbox = $(".t_box").clone();
    $('#search_wrapper_main').html('').html($tbox).show();
    $(".close_btn").show();
}

function closeSearch(targetContainer,from){
        var wrapper = $(targetContainer);
        wrapper.html($('<div/>', {}));
        $(".close-search").hide();
}