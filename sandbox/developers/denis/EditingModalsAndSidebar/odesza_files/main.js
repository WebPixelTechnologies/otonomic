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


    /* Front Inline editing modals
    ================================================================*/
    var otonomic_modal_testimonials = '\
    <div class="otonomic-core-style">\
        <!-- Modal -->\
        <div class="modal fade" id="editingModal" tabindex="-1" role="dialog" aria-labelledby="editingModalLabel" aria-hidden="true">\
          <div class="modal-dialog">\
            <div class="modal-content">\
              <div class="modal-header">\
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>\
                <button type="button" class="help btn btn-oto-green btn-sm pull-right">?</button>\
                <h4 class="modal-title" id="myModalLabel">Manage Testimonials</h4>\
              </div>\
              <div class="modal-body">\
                <div class="row">\
                    <div class="col-xs-12">\
                        <button type="button" class="btn btn-oto-blue btn-sm"><span class="glyphicons plus"></span>Add new testimonial</button>\
                        <div class="btn-group pull-right" role="group" data-toggle="buttons" aria-label="filter">\
                          <label class="btn btn-oto-gray-light btn-sm active">\
                            <input type="radio" name="options" id="option1" autocomplete="off" checked>All (12)\
                          </label>\
                          <label class="btn btn-oto-gray-light btn-sm">\
                            <input type="radio" name="options" id="option2" autocomplete="off">Homepage (2)\
                          </label>\
                        </div>\
                    </div>\
                    <div class="col-xs-12">\
                        <div class="item">\
                            <div class="media">\
                              <a class="media-left" href="#">\
                                <img class="media-image" src="https://scontent-a-lhr.xx.fbcdn.net/hphotos-xap1/v/t1.0-9/c0.9.50.50/p50x50/10689755_555100474623091_1319482613182964061_n.jpg?oh=f66d2ce513ebbe09c9ec42193e675ef0&oe=54D4881E" alt="...">\
                              </a>\
                              <div class="media-body">\
                                <h4 class="media-heading">Michael lefebvre</h4>\
                                <p class="text-ellipsis">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested Lorem Ipsum is simply dummy text of the printing and typesetting</p>\
                              </div>\
                            </div>\
                            <!-- Actions -->\
                            <div id="actions-container-1" data-actions-container-id="1" class="js-actions-container actions-container">\
                              <!-- homepage indication-->\
                              <div class="js-homepage-indicator homepage-indicator "><span class="glyphicons home"></span></div>\
                              <!-- Hidden bar indication-->\
                              <div class="js-hidden-indicator hidden-indicator small-indicator hidden"><span class="glyphicons eye_close"></span> Hidden</div>\
                              <!-- Primary actions -->\
                              <div id="primary-btn-group-1" data-btn-group-id="1" class="btn-group js-primary-btn-group">\
                                <button type="button" class="btn action-btn js-hide-btn primary-action-blue" data-toggle="tooltip" title="Hide" data-analytics-action="Show Product"><span class="glyphicons eye_close"></span></button>\
                                <button type="button" class="btn action-btn js-show-btn primary-action-blue hidden" data-toggle="tooltip" title="Show" data-analytics-action="Hide Product"><span class="glyphicons eye_open"></span></button>\
                                <button type="button" class="btn action-btn js-edit-btn" data-analytics-action="Edit Product"><span class="glyphicons edit"></span></button>\
                                <button type="button" class="btn action-btn js-home-hide-btn" data-toggle="tooltip" title="Hide from homepage" data-analytics-action="Hide from homepage"><span class="glyphicons bin"></span></button>\
                                <button type="button" class="btn action-btn js-home-show-btn hidden" data-toggle="tooltip" title="Show on homepage" data-analytics-action="Show on homepage"><span class="glyphicons home"></span></button>\
                              </div>\
                            </div>\
                        </div>\
                        <div class="item">\
                            <div class="media">\
                              <a class="media-left" href="#">\
                                <img class="media-image" src="https://scontent-a-lhr.xx.fbcdn.net/hphotos-xap1/v/t1.0-9/c0.9.50.50/p50x50/10689755_555100474623091_1319482613182964061_n.jpg?oh=f66d2ce513ebbe09c9ec42193e675ef0&oe=54D4881E" alt="...">\
                              </a>\
                              <div class="media-body">\
                                <h4 class="media-heading">Michael lefebvre</h4>\
                                <p class="text-ellipsis">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested Lorem Ipsum is simply dummy text of the printing and typesetting The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested Lorem Ipsum is simply dummy text of the printing and typesetting</p>\
                              </div>\
                            </div>\
                            <!-- Actions -->\
                            <div id="actions-container-2" data-actions-container-id="2" class="js-actions-container actions-container">\
                              <!-- homepage indication-->\
                              <div class="js-homepage-indicator homepage-indicator hidden"><span class="glyphicons ok_2"></span> Newly added</div>\
                              <!-- Hidden bar indication-->\
                              <div class="js-hidden-indicator hidden-indicator small-indicator"><span class="glyphicons eye_close"></span> Hidden</div>\
                              <!-- Primary actions -->\
                              <div id="primary-btn-group-2" data-btn-group-id="2" class="btn-group js-primary-btn-group">\
                                <button type="button" class="btn action-btn js-show-btn primary-action-blue" data-toggle="tooltip" title="Show" data-analytics-action="Hide Product"><span class="glyphicons eye_open"></span></button>\
                                <button type="button" class="btn action-btn js-hide-btn primary-action-blue hidden" data-toggle="tooltip" title="Hide" data-analytics-action="Show Product"><span class="glyphicons eye_close"></span></button>\
                                <button type="button" class="btn action-btn js-edit-btn" data-analytics-action="Edit Product"><span class="glyphicons edit"></span></button>\
                                <button type="button" class="btn action-btn js-home-hide-btn hidden" data-toggle="tooltip" title="Hide from homepage" data-analytics-action="Hide from homepage"><span class="glyphicons bin"></span></button>\
                                <button type="button" class="btn action-btn js-home-show-btn" data-toggle="tooltip" title="Show on homepage" data-analytics-action="Show on homepage"><span class="glyphicons home"></span></button>\
                              </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
              </div>\
              <div class="modal-footer">\
                <button type="button" class="btn btn-link" data-dismiss="modal"><span class="glyphicons remove_2"></span>Cancel</button>\
                <button type="button" class="btn btn-oto-green"><span class="glyphicons ok_2"></span>Save</button>\
              </div>\
            </div>\
          </div>\
        </div>\
    </div>';
    var otonomic_modal_testimonial_edit = '\
    <div class="otonomic-core-style">\
        <!-- Modal -->\
        <div class="modal inner-editing  fade" id="editingModal" tabindex="-1" role="dialog" aria-labelledby="editingModalLabel" aria-hidden="true">\
          <div class="modal-dialog">\
            <div class="modal-content">\
              <div class="modal-header">\
                <button type="button" class="back btn btn-link btn-sm pull-left btn-sm"><span class="glyphicons left_arrow"></span></button>\
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>\
                <button type="button" class="help btn btn-oto-green btn-sm pull-right">?</button>\
                <h4 class="modal-title" id="myModalLabel">Edit Testimonial</h4>\
              </div>\
              <div class="modal-body">\
                <div class="row">\
                    <div class="col-xs-12">\
                        <button type="button" class="btn btn-oto-blue btn-sm"><span class="glyphicons eye_close"></span>Hide from testimonials</button>\
                        <button type="button" class="btn btn-oto-gray-light btn-sm"><span class="glyphicons home"></span>Add to Homepage</button>\
                    </div>\
                    <div class="col-xs-12" style="margin-top: 15px;">\
                        <div class="form-group">\
                            <label for="reviewName">Customer name</label>\
                            <input type="text" class="form-control" id="name" name="reviewer_name"\
                                   value="" placeholder="">\
                        </div>\
                        <div class="form-group">\
                            <label>Customer photo</label><br/>\
                            <a href="#" class="image-selector open-mediagal-popup"\
                               id="add_reviewer_image"\
                               data-input="#reviewer_image_src"\
                               data-thumb="#img_reviewer_image"\
                               data-attachmentid="#reviewer_image">\
                                <div class="centered-image-wrapper">\
                                    <div class="centered">\
                                        <img src="/wp-content/mu-plugins/otonomic-first-session/assets/images/ph-thumb.png" alt="Reviewer picture" id="img_reviewer_image">\
                                    </div>\
                                </div>\
                                <div class="bottom-strip"><span class="glyphicons plus"></span> Edit</div>\
                            </a>\
                        </div>\
                        <div class="form-group">\
                            <label for="review">Recommendation</label>\
                            <textarea id="review" name="reviewer_review" class="form-control"\
                                      rows="4"></textarea>\
                        </div>\
                        <div class="form-group">\
                            <label>Rating</label>\
                            <p>\
                            <span class="rating" style="direction: rtl;">\
                                <span class="glyphicons star" data-rank="5"></span>\
                                <span class="glyphicons star" data-rank="4"></span>\
                                <span class="glyphicons star" data-rank="3"></span>\
                                <span class="glyphicons star" data-rank="2"></span>\
                                <span class="glyphicons star" data-rank="1"></span>\
                            </span>\
                            </p>\
                        </div>\
                    </div>\
                </div>\
              </div>\
              <div class="modal-footer">\
                <button type="button" class="btn btn-link" data-dismiss="modal"><span class="glyphicons remove_2"></span>Cancel</button>\
                <button type="button" class="btn btn-oto-green"><span class="glyphicons ok_2"></span>Save</button>\
              </div>\
            </div>\
          </div>\
        </div>\
    </div>';

    // temp implementation, we can use jQuery's load method and inject content into ".modal" div
    
    // fire only on blog pages
    if ($( "body" ).hasClass( "blog" )) {
        $(otonomic_modal_testimonials).appendTo('body');
        //$(otonomic_modal_testimonial_edit).appendTo('body');
        $('#editingModal').modal('show')
    };


    // Target
    ///////////////////////////////////////////
    var itemClassName = '.item';


    // animate Newly Added items to default state
    //////////////////////////////////////////////
    var newlyAddedDelay = setInterval(animateNewlyAdded, 3000);
    function animateNewlyAdded(){
      $('.'+itemClassName+'.newly-added-item').each(function(){
        $(this).find('.js-newly-added-indicator').animate({opacity: 0}, 2000);
        $(this).removeClass('newly-added-item');
        clearInterval(newlyAddedDelay);
      });
    }

    // On item row hover, display actions
    ////////////////////////////////////////
    $(itemClassName).hover(function() {
      // add class
        $(this).find('.js-primary-btn-group').addClass('up');
      },function() {
      // remove class
        $(this).find('.js-primary-btn-group').removeClass('up');
      }
    );

    // Hide action
    ////////////////////////
    $('.js-primary-btn-group .js-hide-btn').on('click', function(event){
      event.stopPropagation();
      var item_id = $(this).parent().data('btn-group-id');
      // disable primary action
      $('#actions-container-'+item_id).find('.js-edit-btn').attr('disabled',true);
      // Hide "hide" btn
      $(this).addClass('hidden');
      // Show "show" btn
      $('#actions-container-'+item_id).find('.js-show-btn').removeClass('hidden');
      // Show hidden-indicator
      $('#actions-container-'+item_id).find('.js-hidden-indicator').removeClass('hidden');
      // Add hidden style to item row
      $('#actions-container-'+item_id).parent().addClass('hidden-item');
      $('#actions-container-'+item_id).parent().find('td.picture img').addClass('grayscale');
    });

    // Show action
    ////////////////////////
    $('.js-primary-btn-group .js-show-btn').on('click', function(event){
      event.stopPropagation();
      var item_id = $(this).parent().data('btn-group-id');
      // disable primary action
      $('#actions-container-'+item_id).find('.js-edit-btn').attr('disabled',false);
      // Hide "show" btn
      $(this).addClass('hidden');
      // Show "hide" btn
      $('#actions-container-'+item_id).find('.js-hide-btn').removeClass('hidden');
      // Hide hidden-indicator
      $('#actions-container-'+item_id).find('.js-hidden-indicator').addClass('hidden');
      // Remove hidden style to item row
      $('#actions-container-'+item_id).parent().removeClass('hidden-item');
      $('#actions-container-'+item_id).parent().find('td.picture img').removeClass('grayscale');
    });

    // Popover
    //////////////////////////////////////////////////////
    $('h1.title').popover({
        //container: '.otonomic-core-style',
        title: '',
        content:'<div class="form-group">\
                    <label for="business-Name">Business Name</label>\
                    <input type="text" class="form-control" id="business-Name" name="business-Name"\
                           value="" placeholder="">\
                </div>\
                <div class="popover-footer text-right">\
                    <button type="button" class="btn btn-link">Cancel</button>\
                    <button type="button" class="btn btn-oto-green">Save</button>\
                </div>\
                ',
        html: true,
        placement: 'bottom',
        template: '<div class="otonomic-core-style popover popover-stand-alone" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    });
    $('h1.title').popover('show');
    // Side nav bar
    //////////////////////////////////////////////////////


    var sideBarHtml = '\
    <div class="otonomic-core-style">\
        <!-- Side Navbar -->\
        <div id="sidebar-wrapper">\
          <h4>Customize Testimonials</h4>\
          <ul class="sidebar-nav">\
              <li>\
                <a href="#" class="btn btn-oto-white btn-block btn-lg sidebar-link">\
                  <span class="glyphicons picture"></span> Appearance <span class="glyphicons chevron-right"></span>\
                </a>\
              </li>\
              <li>\
                <a href="#" class="btn btn-oto-white btn-block btn-lg sidebar-link">\
                  <span class="glyphicons cogwheel"></span> Reviews <span class="glyphicons chevron-right"></span>\
                </a>\
              </li>\
          </ul>\
          <button type="button" class="back btn btn-link pull-left"><span class="glyphicons left_arrow"></span></button>\
          <h4>Testimonials Appearance</h4>\
          <p>Change background image</p>\
          <div class="dropdown">\
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">\
                Dropdown\
                <span class="caret"></span>\
              </button>\
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>\
              </ul>\
          </div>\
          <br>\
          <p>Choose a feel</p>\
          <div class="dropdown">\
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">\
                Dropdown\
                <span class="caret"></span>\
              </button>\
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>\
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>\
              </ul>\
          </div>\
        </div>\
    </div>';

    $(sideBarHtml).appendTo('body');
    // Side menu button toggle
    function openCloseMenu(){
        //if open then close
        if ($("#menu-toggle").hasClass('active')) {
            $(".navbar").animate({marginRight:"0",marginLeft:"0"}, 300,"swing");
            $("#sidebar-wrapper").animate({right: "-250", opacity:"0"}, 300,"swing", function() {
                // Animation complete.
                $("#menu-toggle").toggleClass("active");
            });
        }
        // else open
        else{
            $(".navbar").animate({marginRight:"250",marginLeft:"-250"}, 300,"swing");
            $("#sidebar-wrapper").animate({right: "0",opacity:"1"}, 300,"swing", function() {
                // Animation complete.
                $("#menu-toggle").toggleClass("active");
              });
        }
    }

    function closeMenu(){
        //if open then close
        $(".navbar").animate({right: "0",paddingRight:"0",left:"0"}, 300,"swing");
        $("#sidebar-wrapper").animate({right: "-250", opacity:"0"}, 300,"swing", function() {
            // Animation complete.
            $("#menu-toggle").toggleClass("active");
        });  
    }

    $("#menu-toggle").click(function(event) {
          event.preventDefault();
          openCloseMenu();
    });

    $("section").click(function() {
        //closeSearch('.search-wrapper');
        if ($("#menu-toggle").hasClass('active')) {
          closeMenu();
        }
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


