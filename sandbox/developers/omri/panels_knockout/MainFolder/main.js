var upgrade_link_pro_yearly = 'https://www.bluesnap.com/jsp/buynow.jsp?contractId=2327123';


// TODO: clear this if it's dead code


function showHelpTooltip() {
	jQuery('.tooltip_help:not(.activated)')
		.each(
		function () {
			tooltip_text = jQuery('small', this).hide().html();
			if (tooltip_text == "") {
				return;
			}
			tooltip_img = "<span class='wtip'><img class='tip_question_icon' src='/wp-content/mu-plugins/otonomic-first-session/assets/images/icon-question.png' original-title='"
				+ tooltip_text + "' /></span>";
			jQuery(this).append(tooltip_img).addClass('activated');
		});
}

function get_current_page_title(el) {
	var $ = jQuery;
    var title;
	if (el && el.length) title = el.closest('section').attr('id');
	title = title ||
		$('#current_page_title').text() ||
		$('title').text() ||
		'-';
    return title ;
}
function fix_help_toggle()
{
	jQuery('#contextual-help-link').click(function (e){
		e.preventDefault();
		jQuery('#contextual-help-wrap').removeClass('hidden');

	});
}
function formSubmit(){
//    document.forms["form"].submit();
	$('form.frm_otonomic_ajax').submit();
}

var OtonomicNav = (function ($) {
	'use strict';

	var self = {
		nextAdminMenu: function () {
			var next_a_href = self.nextAdminMenuLink();
			if (next_a_href) window.location = next_a_href;
		},
		nextAdminMenuLink: function () {
			var next_li = $('#adminmenu').find('.menu-top.wp-has-current-submenu, .menu-top.current').next();
			if (!next_li.length) return;
			var next_a = next_li.children('a');
			if (!next_a.length) return;
			return next_a.attr('href');
		},
		prevAdminMenu: function () {
			var next_li = $('#adminmenu').find('.menu-top.wp-has-current-submenu, .menu-top.current').prev();
			if (!next_li.length) return;
			var next_a = next_li.children('a');
			if (!next_a.length) return;
			var next_a_href = next_a.attr('href');
			if (next_a_href) window.location = next_a_href;
		},
		formSubmit: function () {
			$('form.frm_otonomic_ajax').submit();
		}
	};

	return self;

})(jQuery);

(function ($) {
	'use strict';
	$.fn.otonomicUpgrade = function (options) {

		if (!this.length) return;

		options = $.extend({
			// These are the defaults.
			event_type: "click"
		}, options);

		var methods = {
			showPopup: function (e, o) {
				alert('Upgrade to Enjoy this');
			}
		}

		return this.each(function() {
			jQuery(this).bind(options.event_type, function (event){
				event.preventDefault();
				event.stopImmediatePropagation();
				methods.showPopup(this, options);
			});
		});
	}

})(jQuery);


jQuery(function ($) {
	'use strict';
    // TODO: Change this so that indeed only users of Free role will see this code - move it to a Limit Features module
	// jQuery('#wp-admin-bar-otonomic-user-actions-advance-mode-switch a').otonomicUpgrade();


    /* Set rank on click
    ================================================================*/

	$('.review-rating > .glyphicons.star').click(function () {
		var $this = $(this);
		var rank;
		var rank_input = $('#rank');
		//  if we cleak the first start when rank is set to 1, clear rank
		if ($this.attr('data-rank') == 1 && rank_input.val() == 1) {
			rank = "";
			$('.glyphicons[data-rank]').removeClass('active');
		} else {
			rank = $(this).attr('data-rank');
			// make the right stars yellow
			$('.glyphicons[data-rank]').removeClass('active');
			for (var i = rank - 1; i >= 0; i--) {
				$('.glyphicons[data-rank="' + (i + 1) + '"]').addClass('active');
			}
		}
		//  put value into hidden field
		rank_input.val(rank);
	});

	/* LuckeyOrange class
    ================================================================*/
	$('input[type=text], input[type=email], textarea').addClass('LoNotSensitive');

 
    /* Add data-loading-text="Loading..."
    /* after button click
    ================================================================*/

    $('.js-edit-link').on('click', function () {
        var $btn = $(this).button('loading');
    });


	fix_help_toggle();

    /* Tooltips
    ================================================================*/
    // Init Tooltips for admin bar
    // tooltip got "admin-bar-tooltip" class for specific styling
    $('#wpadminbar a[data-toggle="tooltip"]').tooltip({
        container : '.otonomic-core-style',
        delay: { "show": 500, "hide": 100 },
        trigger: 'hover',
        template: '<div class="tooltip admin-bar-tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    });

    $('button.action-btn').tooltip({
        container : '.otonomic-core-style',
        delay : { "show": 300, "hide": 50 },
        placement : 'top',
        trigger : 'hover'
    });

        // Manual trigger, good for testing
    //$('a[data-toggle="tooltip"]').tooltip('show');

    // admin menu tool tips
    $('#adminmenu .toplevel_page_ot-fs-business-profile').tooltip({
        container : '.otonomic-core-style',
        delay : { "show": 500, "hide": 100 },
        placement : 'bottom',
        trigger : 'hover',
        title : 'Here you can edit your business details',
        viewport : '#viewport'
    });

    // Manual trigger, good for testing
    //$('#adminmenu .toplevel_page_ot-fs-business-profile').tooltip('show');

    // ToolTip for disabled "Save changes" button
    $('#wpfooter-first-session .disabled-save-btn').tooltip({
        container : 'body',
        delay: { "show": 500, "hide": 100 },
        trigger: 'hover',
        template: '<div class="tooltip admin-footer-tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    });

    $('.js-actions-container button[data-toggle]').tooltip({
        container : 'body',
        delay: { "show": 500, "hide": 100 },
        trigger: 'hover',
    });





    /* Close Upgrade hook
    ================================================================*/
	$('.otonomic-upgrade-hook .close').click(function(e){
		var othis = this;
		setTimeout(function (e){
			$(othis).parent('div').parent('div').parent('.otonomic-upgrade-hook').remove();
		}, 200);
		e.preventDefault;
		//return false;
	});

	window.setTimeout(function (){
		apply_lock();
	},200);


	$('div.wrap h2:first').nextAll('div.admin-otonomic-notice, div.admin-otonomic-error').addClass('below-h2');
	$('div.admin-otonomic-updated, div.admin-otonomic-error').not('.below-h2, .inline').insertAfter( $('div.wrap h2:first') );


    /*$('.not-now-link').click(function(event){
        event.preventDefault();
        $(this).parents('.popover_container').remove();
    });*/
});



function apply_lock()
{
	jQuery('.otonomic-locked').each(function(){
        var $this = jQuery(this);

		var buttonLink;

        buttonLink = $this.attr('data-upgrade-link');
        if( !buttonLink) {
            if(typeof upgrade_link_pro_yearly === 'undefined') {
                buttonLink = '/pricing/';

            } else {
                buttonLink = upgrade_link_pro_yearly;
            }
        }

		var content ='<div class="content">Upgrade to show all your content without limitations</div>';
		var defaultState = '<div class="default"><span class="ot-icon-locked"> Locked</span></div>';
		var activeState = '<div class="active"><span class="ot-icon-unlocked"> Unlock</span></div>';

		var lockedOverlay = '<a href="'+buttonLink+'" class="otonomic-lock otonomic-core-style"><div class="otonomic-lock-overlay">'+content+defaultState+activeState+'</div></a>'

        $this.append(lockedOverlay);
        // $this.children().not('.otonomic-lock').css('opacity','0.4');
        $this.children().not('.otonomic-lock').addClass('otonomic-semi-trasparent');
	});
}



function set_time_to_site_deletion() {

    var time_left_to_deletion = site_settings.scheduled_site_delete*1000 - new Date().getTime();



    if(time_left_to_deletion < 0) {
        window.location.replace("http://otonomic.com/?msg=site-deleted");
    }

	time_left_to_deletion = new Date(Math.abs( time_left_to_deletion ));
	//alert(time_left_to_deletion);
    jQuery('#otonomic_delete_timer,#otonomic_delete_timer_tooltip').text(
            ("0" + time_left_to_deletion.getUTCHours()).slice(-2) + ":" +
            ("0" + time_left_to_deletion.getUTCMinutes()).slice(-2) + ":" +
            ("0" + time_left_to_deletion.getUTCSeconds()).slice(-2) );
}

jQuery(document).ready(function($) {
    // Prevent click on help icon on admin screens from accessing hashtag
    $('#wpbody').on('click', '#contextual-help-link', function(e) {
        e.preventDefault(); e.stopPropagation();
    });

    if(typeof(site_settings.scheduled_site_delete) !== 'undefined'
        && site_settings.scheduled_site_delete !== '') {
            // Add timer element to admin bar
            jQuery('#wp-admin-bar-top-secondary').prepend('<li id="wp-admin-bar-otonomic-adminbar-deletesite-timer" class="otonomic-adminbar-item otonomic-adminbar-first-session-item">' +
                '<a href="#" data-container="#wpcontent" data-toggle="popover" data-placement="bottom" class="oto-nav-counter" data-original-title="" title=""><span class="glyphicons stopwatch"></span> <span id="otonomic_delete_timer"></span></a></li>');
            
            jQuery('.oto-nav-counter').popover({
                html: true,
                template: '<div class="popover popover-counter" role="tooltip"><div class="arrow"></div><h3 class="popover-title">This website is designated for deletion in  23:59:59</h3><div class="popover-content"></div></div>',
                title: 'You have <span id="otonomic_delete_timer_tooltip" class="counter">00:00:00</span> more hours to connect with Facebook and prove you’re managing this business page.',
                content: '\
                    <p>If you can’t prove you’re the page owner, the website will be deleted.<p>\
                    <div><a href="#" id="popover-counter-close-btn" class="btn btn-link">Not now</a>\
                    <a href="javascript:void(0);" class="btn btn-oto-blue facebook_connect">Connect with Facebook</a></div>',
            });

            jQuery('body').on( 'click', '#popover-counter-close-btn', function(event){
                event.preventDefault();
                jQuery('.oto-nav-counter').popover('hide');
            });


            set_time_to_site_deletion();
            setInterval(function() {
                set_time_to_site_deletion();
            }, 1000);
    }
});



$ = jQuery; // DEBUG


