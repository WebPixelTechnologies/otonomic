//Globally used variables
var reference_time = new Date().getTime();
var user_facebook_id;
var access_token;
var fanpage_permissions = 'manage_pages,email,offline_access';
var personal_permissions = 'user_location,user_about_me,user_photos,user_events,user_videos';

var num_click_connect_facebook = 0;
var num_approve_app = 0;
var num_approve_manage_pages = 0;
var num_reject_basic_permissions = 0;
var num_reject_manage_pages = 0;
var img_height, img_width = 0;

var ot_wp_site_creation_url = "http://wp.otonomic.com/migration/index.php?theme=dreamspa";
if(typeof(ot_loading_page_url)==="undefined") {
	var ot_loading_page_url     = "/progresslp3";
	// var ot_loading_page_url     = "/progresslp4";
}

function openFacebookCancelModal() {
    // jQuery('#facebook_connector')[0].click();
    $('#fbCancelModal').modal({
        keyboard:false
    });
}

function closeFacebookCancelModal() {
    $('#fbCancelModal').modal('hide');
}

function openFacebookManagePagesRejectedModal() {
    $('#fbManagePagesModal').modal({
        keyboard:false
    });
}

function closeFacebookManagePagesRejectedModal() {
    $('#fbManagePagesModal').modal('hide');
}

function openFacebookManagePagesApprovedModal() {
    $('#fbConnectedModal').modal({
        keyboard:false
    });
}

function closeFacebookManagePagesApprovedModal() {
    $('#fbConnectedModal').modal('hide');
}

function closeModalWindows() {
    $('.publish-modal').modal('hide');
}

function openThankYouModal() {
    $("#thankYouModal").modal({ backdrop: 'static', keyboard: false },'show');
    $("#thankYouModal").addClass('animateIn');
    $(".modal-backdrop").addClass('show');
}

function closeThankYouModal() {
    $('#thankYouModal').modal('hide');
}

function facebookManagePagesRejected() {
    trackFBConnect('Facebook Connect', 'App Approved', 'manage_pages not approved','redirecting on rejected manage pages');
    // redirect_user(connect_path+'rejected_manage_pages.php', "Please wait...", 3000);
    openFacebookManagePagesRejectedModal();
}

function facebookManagePagesApproved() {
    // getListOfUserFanpages();
    checkAssignSiteToUser(user_facebook_id, access_token);
}

function userAssinedSuccessfully(){
    openFacebookManagePagesApprovedModal();
}

function getListOfUserFanpages() {
    FB.api('/me/accounts', { limit: 100 }, function (response) {
        if (response.data != undefined && response.data.length > 0) {
            //only redirect to fanpage listing if user have any pages.
            redirect_user(connect_path+'facebook_fanpages.php', "Loading pages...");
            trackFBConnect('Facebook Connect', 'App Approved', 'manage_pages approved');

        } else {
            if (typeof rejected_manage_page != 'undefined' && rejected_manage_page == 1) {
                showMessage("You don't have any Facebook fan page", 3000);
                trackFBConnect('Facebook Connect', 'App Approved', 'manage_pages approved, but no pages','show message');

            } else {
                //manage pages permission not found redirect to reject manage fanpages page.
                trackFBConnect('Facebook Connect', 'App Approved', 'manage_pages approved, but no pages','redirecting on rejected manages pages');
                // redirect_user(connect_path+'rejected_manage_pages.php', "You don't have any Facebook fan pages", 3000);
                facebookManagePagesRejected();
            }
        }
    });
}

function checkAssignSiteToUser(user_id, access_token) {

    jQuery.post(BUILDER_PATH+"/users/checkFacebookLogin/.json",
        {
            facebook_id: user_id,
            access_token: access_token
        },
        function(data) {
            if(data.status == "fail"){
                window.location.href = data.redirect;
            } else {
               userAssinedSuccessfully();
            }
        }, "json"
    );


}


// IIFE - Immediately Invoked Function Expression
(function($, window, document) {
    // The $ is now locally scoped
    // Listen for the jQuery ready event on the document
    $(function() {
        // The DOM is ready!

        $(document).on("click", ".modal_close_btn", function (e) {
            e.preventDefault();
            closeModalWindows();
            $('.publish-modal').modal('hide');// had to duplicate the call to hide it, wasnt working otherwise
        });

        $(document).on("click", ".btn-publish", function (e) {
            e.preventDefault();
            $('#publishModal').modal({
                keyboard:false
            });
        });

        //checkConnectedWithFacebook();

        jQuery(document).on("click", ".facebook_connect", function (e) {
            e.preventDefault();
            closeModalWindows();
            $('.publish-modal').modal('hide');// had to duplicate the call to hide it, wasnt working otherwise
            if(num_click_connect_facebook == 0) {
                trackPageView('clickfacebook');
            }
            num_click_connect_facebook++;

            connectFacebook();
        });

        jQuery('#why_manage_pages').on('click', function () {
            jQuery('#why_manage_pages_div').slideToggle();
            trackFBConnect('Facebook Connect', 'Why manage pages', 'Reject manage pages');
        });

        // Click on search result should trigger creation of a personal site
        jQuery(document).on('click', "#facebook_fanpages_list a.page_name, #facebook_fanpages_list a.page_image", function (e) {
            e.preventDefault();

            // Create website for fan page
            var $this = jQuery(this);
            if ($this.hasClass("personal")) {
                trackFBConnect('Facebook Connect', 'Create Personal', 'Reject manage_pages');
                askPersonalPermissions();
                return false;
            }

            var page_id = $this.attr('page_id');
            var page_name = $this.attr('page_name');
            trackFBConnect('Facebook Connect', 'Select page', page_id);
            redirect_user(BUILDER_PATH + 'sites/add/fbid:' + page_id, "Creating a website for " + page_name + "...", 1000);
        });

        // Click on .facebook_pconnect should trigger creation of a personal site
        jQuery(document).on("click",".facebook_pconnect", function(e){
            e.preventDefault();
            trackFBConnect('Facebook Connect', 'Create Personal', 'Reject manage_pages');
            askPersonalPermissions();
            return false;
        });

        return false;
        // The rest of the code goes here!
    });
}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter

function initialize_fanpage_listing(){
    var fp = jQuery(".fanpage_image").first();
    img_height = fp.get(0).height;
    img_width = fp.get(0).width;
    jQuery(".fanpage_list").hide();
    jQuery(".fanpage_list_connected").hide();
}

function currentUrl() {
    return location.protocol + '//' + location.host + location.pathname;
}

function checkConnectedWithFacebook() {
    if (typeof FB == "undefined") {
        console.log('Warning: FB is undefined');
        trackFBConnect('Facebook Connect', 'Error', 'FB is undefined in checkConnectedWithFacebook()', '');
        return false;
    }

    FB.getLoginStatus(function (response) {
        handleFacebookConnectResponse(response);
    });
    return false;
}

function connectFacebook(permissions, callback) {
    if (typeof FB == "undefined") {
        console.log('Warning: FB is undefined');
        trackFBConnect('Facebook Connect', 'Error', 'FB is undefined in connectFacebook()', '');
        return false;
    }

    if (typeof permissions == "undefined") {
        permissions = fanpage_permissions;
    }

    FB.login(function (response) {
        if (typeof callback != "undefined" && typeof callback == "function") {
            callback(response);
        } else {
            handleFacebookConnectResponse(response);
        }
    }, {
        scope: permissions
    });

    return false;
}

function handleFacebookConnectResponse(response) {
    if (response.status == 'connected') {
        // user is logged in - approved app
        user_facebook_id = response.authResponse.userID;
        access_token = response.authResponse.accessToken;
        // getUserFacebookName(user_facebook_id);

        if (typeof isFanpageListing != 'undefined' && isFanpageListing == 1) {
            if(num_approve_app == 0) {
                trackFBConnect('Facebook Connect', 'Approve app', user_facebook_id);
                trackPageView('approve_app');
            }
            num_approve_app++;
            return showFacebookPages();
        }

        checkPermission('manage_pages', function (result) {
                if (result.status) {
                    facebookManagePagesApproved();

                } else {
                    if (typeof rejected_manage_page == 'undefined') {
                        //manage pages permission not found redirect to reject manage fanpages page.
                        facebookManagePagesRejected()
                    }
                }
        });

    } else {
        // user rejected the app
        if(num_reject_basic_permissions == 0) {
            trackFBConnect('Facebook Connect', 'Reject app');
            trackPageView('reject_app');
        }

        trackFBConnect('Facebook Connect', 'View', 'Facebook reject basic permissions', num_reject_basic_permissions);
        num_reject_basic_permissions++;

        /*if (typeof isFanpageListing == "undefined") {*/
            openFacebookCancelModal();
        /*}*/
    }
}

function showFacebookPages() {
    //check permission
    permission_name = 'manage_pages';
    showLoader("Loading Facebook Fanpages...");

    checkPermission(permission_name, function (result) {
            _debug(result);
            if (result.status) {
                //on success
                if(num_approve_manage_pages == 0) {
                    trackFBConnect('Facebook Connect', 'View', 'Approve manage pages');
                    trackPageView('approve_manage_pages');
                }
                num_approve_manage_pages++;
                trackFBConnect('Facebook Connect', 'Approve permissions', (result.found_permissions).join());
                getPages();
            } else {
                //on fail
                if(num_reject_manage_pages == 0) {
                    trackFBConnect('Facebook Connect', 'View', 'Reject manage pages');
                    trackPageView('reject_manage_pages');
                }
                num_reject_manage_pages++;
                trackFBConnect('Facebook Connect', 'Reject permissions', (result.not_found_permissions).join());
                // redirect_user(connect_path+'rejected_manage_pages.php', "Please wait...");
                facebookManagePagesRejected();
            }
        }
    );
}

function doRequireRefreshPage(result) {
    _debug(result);
    isFanpageListing = result.status;
    if (typeof isFanpageListing != "undefined" && isFanpageListing == 1) {
        var items_loaded = jQuery(".site-item", "#facebook_fanpages_list").length;
        if (items_loaded > 0) {
            return false;
        }
    }
    return true;
}

function askPersonalPermissions() {
    // trackPageView('facebook_personal_profile_selected');
    connectFacebook(personal_permissions, function (response) {
        checkPermission(personal_permissions, function (response) {
            _debug(response);
            if (response.status) {
                _debug("Personal permissions approved: " + personal_permissions);
                trackFBConnect('Facebook Connect', 'Approve personal permissions', (response.found_permissions).join());
                trackPageView('approve_personal_permissions');
                createPersonalSite();

            } else {
                _debug("Personal permissions rejected: " + personal_permissions);
                trackFBConnect('Facebook Connect', 'Reject personal permissions', (response.not_found_permissions).join());
                trackPageView('reject_personal_permissions');
                jQuery("#facebook_pconnector").trigger("click");
            }
        });
    });
}

function checkPermission(permissions, callback) {
    if (typeof FB == "undefined") {
        console.log('Warning: FB is undefined');
        trackFBConnect('Facebook Connect', 'Error', 'FB is undefined in checkPermission()', '');
        return false;
    }

    var result = {
        status: true,
        found_permissions: new Array(),
        not_found_permissions: new Array(),
        found_available_permissions: new Array()
    };

    if (typeof permissions == "string") {
        permissions = String.prototype.split.call(permissions, ',');
    }

    FB.api('/me/permissions', function (response) {
        if (typeof response.data == "undefined") {
            _debug("Failed to receive permission response");
            result.status = false;
            result.message = response.message;

        } else {
            result.found_available_permissions = response.data[0]; //All the permissions returned from Facebook
            jQuery.each(permissions, function (key, permission) {
                if (jQuery.trim(permission) in result.found_available_permissions) {
                    result.found_permissions.push(jQuery.trim(permission));
                    _debug(permission + ' found', 'info');
                } else {
                    result.status = false;
                    result.not_found_permissions.push(jQuery.trim(permission));
                    _debug(permission + ' not found', 'error');
                }
            });
        }
        callback(result);
    });
}

function getPages() {
    if (typeof FB == "undefined") {
        console.log('Warning: FB is undefined');
        trackFBConnect('Facebook Connect', 'Error', 'FB is undefined in getPages()', '');
        return false;
    }

    FB.api('/me/accounts', { limit: 100 }, function (response) {
        if (response.data != undefined) {
            trackFBConnect('Facebook Connect', 'View', 'List of fan pages', response.data.length);
            populatePages(response.data);
        } else {
            trackFBConnect('Facebook Connect', 'Error', 'Undefined list of fan pages', '');
        }
        return false;
    });
}

function populatePages(pages) {
    if (typeof pages == "undefined") {
        // redirect_user(connect_path+'rejected_manage_pages.php', "You don't have any Facebook fanpage", 3000);
        facebookManagePagesRejected();
        return;
    }

    if (pages.length == 1) {
        //jQuery("#facebook_fanpages").html("Creating website for your single Facebook fanpage...");
        createSiteSingleFanpageAutomatically(pages[0], 2000);

    } else if (pages.length > 1) {
        showFanpages(pages);

    } else {
        if(typeof isFanpageListing != "undefined" && isFanpageListing == 1){
            // redirect_user(connect_path+'rejected_manage_pages.php', "You don't have any Facebook fanpage", 3000);
            facebookManagePagesRejected();

        } else if(rejected_manage_page != "undefined" && rejected_manage_page == 1){
            showMessage("You don't have any Facebook fanpage", 3000);
        }
    }
}

function showFanpages(pages) {
    //return false;
    //get the fanpage listing DOM
    var $dom = jQuery(".fanpage_list");
    //take sample first dummy fanpage DOM
    var fanpage = jQuery(".fanpage",$dom).first().clone();
    //delete all other dummy fanpage DOMs
    jQuery(".fanpage", $dom).remove();

    // Add pages
    jQuery.each(pages, function (index, value) {
        if (value.category != 'Application') {
            var dummy_fanpage = jQuery(fanpage).clone();
            isAnyPageFound = true;
			var query_tags={};
			query_tags.page_id = value.id;
			query_tags.page_name = value.name;
			if(typeof(value.category) !== 'undefined')         { query_tags.category = value.category; }
			if(typeof(value.category_list) !== 'undefined')    { query_tags.category_list = value.category_list; }
			//current_site_creation_link = BUILDER_PATH + '?' + jQuery.param(query_tags);
			query_tags.fb_user_id = user_facebook_id;
			query_tags.fb_user_t = access_token;
			query_tags.fb_user_auth = 'yes';

			current_site_creation_link = ot_loading_page_url + '?' + jQuery.param(query_tags);

            jQuery(".fanpage_name", dummy_fanpage).html(value.name).attr('href', current_site_creation_link).attr('page_id', value.id).attr('page_name', value.name).attr('title', value.name);
            jQuery(".fanpage_link", dummy_fanpage).attr('href', current_site_creation_link).attr('page_id', value.id).attr('page_name', value.name).attr('title', value.name);
            jQuery(".fanpage_image", dummy_fanpage).attr('src', 'http://graph.facebook.com/' + value.id + '/picture?type=small').attr('title', value.name);

            if(img_height > 0 && img_width > 0 ){
                jQuery(".fanpage_image", dummy_fanpage).attr('height',img_height).attr('width',img_width);
            }
            jQuery($dom).append(dummy_fanpage);
            //jQuery(fanpage).show();
        }
    });

    // show list of pages
    jQuery(".fanpage_list").show();
    jQuery(".fanpage_list_connected").show();
    jQuery(".fanpage_list_disconnected").hide();
    closeLoader();
}

function createPersonalSite() {
    trackFBConnect('Facebook Connect', 'Create personal', 'Reject manage pages');
    //trackPageView('facebook_personal_profile_auto_creation');

    redirect_user(BUILDER_PATH + 'sites/add/type:fb_personal', "Creating your website...", 2000);
}

function createSiteSingleFanpageAutomatically(page_id) {
    trackFBConnect('Facebook Connect', 'Single page automatically selected', page_id);
    //trackPageView('facebook_only_single_fanpage_auto_creation');
	var query_tags={};
	query_tags.page_id = value.id;
	query_tags.page_name = value.name;
	if(typeof(value.category) !== 'undefined')         { query_tags.category = value.category; }
	if(typeof(value.category_list) !== 'undefined')    { query_tags.category_list = value.category_list; }
	//current_site_creation_link = BUILDER_PATH + '?' + jQuery.param(query_tags);
	current_site_creation_link = ot_loading_page_url + '?' + jQuery.param(query_tags);
	redirect_user(current_site_creation_link, "Creating your website...", 2000);
    //redirect_user(BUILDER_PATH + 'sites/add/fbid:' + page_id, "Creating your website...", 2000);
}



function _debug(message) {
    if (window.console && window.console.log && typeof window.console.log === "function") {
        console.log(message);
    }
}

function redirect_user(url, message, timeout) {
    if (typeof timeout == "undefined") {
        timeout = 1250;
    }
    showLoader(message);
    window.setTimeout(function () {
        self.parent.location.href = url;
    }, timeout);
}

function showLoader(message, is_model) {
    jQuery("#loader span").html(message);
    if(typeof is_model === "undefined") is_model = false;
    jQuery.fancybox.open({
        href: "#loader",
        padding: 20,
        width: 300,
        height: 50,
        fitToView: true,
        autoSize: true,
        closeBtn: false,
        modal : is_model
    });
    return false;
}

function showMessage(message, timeout){
    if (typeof message == "undefined") {
        return false;
    }
    if (typeof timeout == "undefined") {
        timeout = 1250;
    }
    jQuery("#message_info span").html(message);
    jQuery.fancybox.open({
        href: "#message_info",
        padding: 20,
        width: 300,
        height: 50,
        fitToView: true,
        autoSize: true,
        closeBtn: false
    });

    window.setTimeout(function () {
        closeLoader();
    }, timeout);
}

function closeLoader() {
    jQuery.fancybox.close();
}

function objectToArray(obj) {
    var arr = [];
    if (typeof obj != "object") {
        return obj;
    }
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            arr.push(key);
        }
    }

    return arr;
}

function trackPageView(url) {
    if (typeof(_gaq) != 'undefined') {
        _gaq.push(['_trackPageview', '/virtual_pageviews/' + url]);
        console.log('Tracked page view: '+url);
    }
}
function getUserFacebookName(user_facebook_id){
    FB.api('/'+user_facebook_id, function(response) {
        $(".facebook_user_name").html(response.name);
    });
}