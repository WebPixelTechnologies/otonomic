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

/*!
 * jQuery lightweight plugin boilerplate
 * Original author: @ajpiano
 * Further changes, comments: @addyosmani
 * Licensed under the MIT license
 */


// the semi-colon before the function invocation is a safety
// net against concatenated scripts and/or other plugins
// that are not closed properly.
;(function ( $, window, document, undefined ) {

    // undefined is used here as the undefined global
    // variable in ECMAScript 3 and is mutable (i.e. it can
    // be changed by someone else). undefined isn't really
    // being passed in so we can ensure that its value is
    // truly undefined. In ES5, undefined can no longer be
    // modified.

    // window and document are passed through as local
    // variables rather than as globals, because this (slightly)
    // quickens the resolution process and can be more
    // efficiently minified (especially when both are
    // regularly referenced in your plugin).

    // Create the defaults once
    var pluginName = 'otonomicFacebookConnect',
        defaults = {
            propertyName: "value"
        };

    // The actual plugin constructor
    function Plugin( element, options ) {
        this.element = element;

        // jQuery has an extend method that merges the
        // contents of two or more objects, storing the
        // result in the first object. The first object
        // is generally empty because we don't want to alter
        // the default options for future instances of the plugin
        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype.init = function () {
        // Place initialization logic here
        // You already have access to the DOM element and
        // the options via the instance, e.g. this.element
        // and this.options
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options, param ) {
        /*
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                    new Plugin( this, options ));
            }
        });
        */

        // Define methods here
        this.openModal = function(url) {
            jQuery.colorbox({
                maxWidth: '100%', maxHeight: '100%', width: '100%', height: '100%', opacity: '0.9', transition: 'elastic', overlayClose: '', fixed: '1', closeButton: '1',
                iframe: true,
                href: url,
                className: 'fbpopup'
            });
        };

        this.closeModal = function() {
            $.colorbox.close();
        };

        this.openFacebookConnectModal = function() {
            this.openModal(otonomic_facebook_popoup_url+'connect.php?site_name='+otonomic_facebook_site_name);
        };

        this.openFacebookCancelModal = function() {
            this.openModal(otonomic_facebook_popoup_url+'rejected_app.php?site_name='+otonomic_facebook_site_name );
        };

        this.closeFacebookCancelModal = function() {
            this.closeModal();
        };

        this.openFacebookManagePagesRejectedModal = function() {
            this.openModal(otonomic_facebook_popoup_url+'rejected_manage_pages.php');
        };

        this.closeFacebookManagePagesRejectedModal = function() {
            this.closeModal();
        };

        this.openFacebookManagePagesApprovedModal = function() {
            // User approved "manage pages" permission - show list of fan pages he admins
            this.openModal(otonomic_facebook_popoup_url+'select_page.php?access_token='+access_token);
        };

        this.closeFacebookManagePagesApprovedModal = function() {
            this.closeModal();
        };

        this.closeModalWindows = function() {
            this.closeModal();
        };

        this.openThankYouModal = function() {
            /*$("#thankYouModal").modal({ backdrop: 'static', keyboard: false },'show');
            $("#thankYouModal").addClass('animateIn');
            $(".modal-backdrop").addClass('show');*/
			this.openModal(otonomic_facebook_popoup_url+'congratulations.php?site_name='+otonomic_facebook_site_name);
        };

        this.closeThankYouModal = function() {
            this.closeModal();
        };


        this.facebookManagePagesRejected = function() {
            otonomicTrackEvent('Facebook Connect', 'App Approved', 'manage_pages not approved','redirecting on rejected manage pages');
            this.openFacebookManagePagesRejectedModal();
        };

        this.facebookManagePagesApproved = function() {
			otonomicTrackEvent('Facebook Connect', 'Approve permissions', '');
            this.checkAssignSiteToUser(user_facebook_id, access_token);
        };

        this.userAssignedSuccessfully = function(){
			otonomicTrackEvent('Facebook Connect', 'Success', '');
            this.openFacebookManagePagesApprovedModal();
        };

        this.getListOfUserFanpages = function() {
            FB.api('/me/accounts', { limit: 100 }, function (response) {
                if (response.data != undefined && response.data.length > 0) {
                    //only redirect to fanpage listing if user have any pages.
                    this.redirect_user(connect_path+'facebook_fanpages.php', "Loading pages...");
                    otonomicTrackEvent('Facebook Connect', 'App Approved', 'manage_pages approved');

                } else {
                    if (typeof rejected_manage_page != 'undefined' && rejected_manage_page == 1) {
                        this.showMessage("You don't have any Facebook fan page", 3000);
                        otonomicTrackEvent('Facebook Connect', 'App Approved', 'manage_pages approved, but no pages','show message');

                    } else {
                        //manage pages permission not found redirect to reject manage fanpages page.
                        otonomicTrackEvent('Facebook Connect', 'App Approved', 'manage_pages approved, but no pages','redirecting on rejected manages pages');
                        this.facebookManagePagesRejected();
                    }
                }
            });
        };
		this.showLoading = function() {
			jQuery('body').append('<div id="fb-ajax-loader" />');
		};
		this.hideLoading = function() {
			jQuery('#fb-ajax-loader').remove();
		};

        this.checkAssignSiteToUser = function(user_id, access_token) {
			/* display loading screen */
			this.showLoading();
			var othis = this;
			/* Lets call the admin-ajx and submit the facebook tokens. */
			var data = {
				'action': 'facebook_authorized',
				'facebook_id': user_id,
				'access_token': access_token
			};
			$.post(ajaxurl, data, function(response) {
				/* hide loading screen */
				othis.hideLoading();
				if(response.status == 'success') {
                    /* User assigned to site successfully */
                    otonomicTrackEvent('Facebook Connect', 'Success', 'User admin of current site');
                    othis.openThankYouModal();
				} else {
                    /* User not assigned. Let's display the page selection popup */
                    otonomicTrackEvent('Facebook Connect', 'Success', 'User not admin of current site');
                    othis.openFacebookManagePagesApprovedModal();
                }
			}, "json");
        };

        this.handleFacebookConnectResponse = function(response) {
            if (response.status == 'connected') {
                // user is logged in - approved app
                user_facebook_id = response.authResponse.userID;
                access_token = response.authResponse.accessToken;

                this.checkPermission('manage_pages', function (result) {
                    if (result.status) {
                        $.fn[pluginName]('facebookManagePagesApproved');

                    } else {
                        if (typeof rejected_manage_page == 'undefined') {
                            //manage pages permission not found redirect to reject manage fanpages page.
                            $.fn[pluginName]('facebookManagePagesRejected');
                        }
                    }
                });

            } else {
                // user rejected the app
                if(num_reject_basic_permissions == 0) {
                    otonomicTrackEvent('Facebook Connect', 'Reject app');
                    trackPageView('reject_app');
                }

                otonomicTrackEvent('Facebook Connect', 'View', 'Facebook reject basic permissions', num_reject_basic_permissions);
                num_reject_basic_permissions++;
                this.openFacebookCancelModal();
            }
        };

        this.connectFacebook = function(permissions, callback) {
            if (typeof FB == "undefined") {
                console.log('Warning: FB is undefined');
                otonomicTrackEvent('Facebook Connect', 'Error', 'FB is undefined in connectFacebook()', '');
                return false;
            }

            if (typeof permissions == "undefined") {
                permissions = fanpage_permissions;
            }

            FB.login(function (response) {
                if (typeof callback != "undefined" && typeof callback == "function") {
                    callback(response);
                } else {
                    $.fn[pluginName]('handleFacebookConnectResponse', response);
                }
            }, {
                scope: permissions
            });

            return false;
        };



        this.askPersonalPermissions = function() {
            // trackPageView('facebook_personal_profile_selected');
            this.connectFacebook(personal_permissions, function (response) {
                this.checkPermission(personal_permissions, function (response) {
                    _debug(response);
                    if (response.status) {
                        _debug("Personal permissions approved: " + personal_permissions);
                        otonomicTrackEvent('Facebook Connect', 'Approve personal permissions', (response.found_permissions).join());
                        trackPageView('approve_personal_permissions');
                        this.createPersonalSite();

                    } else {
                        _debug("Personal permissions rejected: " + personal_permissions);
                        otonomicTrackEvent('Facebook Connect', 'Reject personal permissions', (response.not_found_permissions).join());
                        trackPageView('reject_personal_permissions');
                        jQuery("#facebook_pconnector").trigger("click");
                    }
                });
            });
        };

        this.checkPermission = function(permissions, callback) {
            if (typeof FB == "undefined") {
                console.log('Warning: FB is undefined');
                otonomicTrackEvent('Facebook Connect', 'Error', 'FB is undefined in checkPermission()', '');
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
        };

        function _debug(message) {
            if (window.console && window.console.log && typeof window.console.log === "function") {
                console.log(message);
            }
        };

        if( typeof(this[options]) == 'function' ) {
            this[options](param);
        };

        // do default action


    }

})( jQuery, window, document );

// IIFE - Immediately Invoked Function Expression
(function($, window, document) {
    // The $ is now locally scoped
    // Listen for the jQuery ready event on the document
    $(function() {
        jQuery(document).on("click", ".modal_close_btn", function (e) {
			modal_close_btn_click(e);
        });

        jQuery(document).on("click", ".btn-publish", function (e) {
            e.preventDefault();
            $.fn.otonomicFacebookConnect('openFacebookConnectModal');
        });

        jQuery(document).on("click", ".facebook_connect", function (e){
			facebook_connect_click(e);
		});

        jQuery('#why_manage_pages').on('click', function () {
            jQuery('#why_manage_pages_div').slideToggle();
            otonomicTrackEvent('Facebook Connect', 'Why manage pages', 'Reject manage pages');
        });


    });
}(window.jQuery, window, document));

function modal_close_btn_click(e) {
	e.preventDefault();
	$.fn.otonomicFacebookConnect('closeModalWindows');
}

function facebook_connect_click(e) {
	e.preventDefault();
	if(num_click_connect_facebook == 0) {
		trackPageView('clickfacebook');
	}
	num_click_connect_facebook++;

	$.fn.otonomicFacebookConnect('closeModalWindows');
	$.fn.otonomicFacebookConnect('connectFacebook');
}