
jQuery(function ($) {
  'use strict';
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

    //$(otonomic_modal_testimonials).appendTo('body');
    //$(otonomic_modal_testimonial_edit).appendTo('body');
    //$('#editingModal').modal('show')


    // Target
    ///////////////////////////////////////////
    var itemClassName = '.item';


    // animate Newly Added items to default state
    //////////////////////////////////////////////
    var newlyAddedDelay = setInterval(animateNewlyAdded, 3000);
    function animateNewlyAdded(){
      $(itemClassName+'.newly-added-item').each(function(){
        $(this).find('.js-newly-added-indicator').animate({opacity: 0}, 2000);
        $(this).removeClass('newly-added-item');
        clearInterval(newlyAddedDelay);
      });
    }

    // On item row hover, display actions
    //////////////////////////////////////////
    //$(itemClassName).hover(function() {
    //  // add class
    //    $(this).find('.js-primary-btn-group').addClass('up');
    //  },function() {
    //  // remove class
    //    $(this).find('.js-primary-btn-group').removeClass('up');
    //  }
    //);

    // Hide action
    ////////////////////////
    //$('.js-primary-btn-group .js-hide-btn').on('click', function(event){
    //  event.stopPropagation();
    //  var item_id = $(this).parent().data('btn-group-id');
    //  // disable primary action
    //  $('#actions-container-'+item_id).find('.js-edit-btn').attr('disabled',true);
    //  // Hide "hide" btn
    //  $(this).addClass('hidden');
    //  // Show "show" btn
    //  $('#actions-container-'+item_id).find('.js-show-btn').removeClass('hidden');
    //  // Show hidden-indicator
    //  $('#actions-container-'+item_id).find('.js-hidden-indicator').removeClass('hidden');
    //  // Add hidden style to item row
    //  $('#actions-container-'+item_id).parent().addClass('hidden-item');
    //  $('#actions-container-'+item_id).parent().find('td.picture img').addClass('grayscale');
    //});

    // Show action
    ////////////////////////
    //$('.js-primary-btn-group .js-show-btn').on('click', function(event){
    //  event.stopPropagation();
    //  var item_id = $(this).parent().data('btn-group-id');
    //  // disable primary action
    //  $('#actions-container-'+item_id).find('.js-edit-btn').attr('disabled',false);
    //  // Hide "show" btn
    //  $(this).addClass('hidden');
    //  // Show "hide" btn
    //  $('#actions-container-'+item_id).find('.js-hide-btn').removeClass('hidden');
    //  // Hide hidden-indicator
    //  $('#actions-container-'+item_id).find('.js-hidden-indicator').addClass('hidden');
    //  // Remove hidden style to item row
    //  $('#actions-container-'+item_id).parent().removeClass('hidden-item');
    //  $('#actions-container-'+item_id).parent().find('td.picture img').removeClass('grayscale');
    //});

    // Popover
    //////////////////////////////////////////////////////
    //$('#logo h1').popover({
    //    //container: '.otonomic-core-style',
    //    title: '',
    //    content:'<div class="form-group">\
    //                <label for="business-Name">Business Name</label>\
    //                <input type="text" class="form-control" id="business-Name" name="business-Name"\
    //                       value="" placeholder="">\
    //            </div>\
    //            <div class="popover-footer text-right">\
    //                <button type="button" class="btn btn-link"><span class="glyphicons remove_2"></span>Cancel</button>\
    //                <button type="button" class="btn btn-oto-green"><span class="glyphicons ok_2"></span>Save</button>\
    //            </div>\
    //            ',
    //    html: true,
    //    placement: 'bottom',
    //    template: '<div class="otonomic-core-style popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title">dsadasd</h3><div class="popover-content"></div></div>'
    //});
    //$('#logo h1').popover('show');
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
          <div id="fontSelect" class="fontSelect">\
            <div class="arrow-down"></div>\
          </div>\
          <br>\
          <p>Choose a feel</p>\
          <div id="colorSelector"><div></div></div>\
          <br>\
          <div class="text-right">\
              <button type="button" class="btn btn-link"><span class="glyphicons remove_2"></span>Cancel</button>\
              <button type="button" class="btn btn-oto-green"><span class="glyphicons ok_2"></span>Save</button>\
          </div>\
        </div>\
    </div>';
    //$(sideBarHtml).appendTo('body');

    $('#colorSelector').ColorPicker({
      color: '#0000ff',
      onShow: function (colpkr) {
        $(colpkr).fadeIn(500);
        return false;
      },
      onHide: function (colpkr) {
        $(colpkr).fadeOut(500);
        return false;
      },
      onChange: function (hsb, hex, rgb) {
        $('#colorSelector div').css('backgroundColor', '#' + hex);
      }
    });

    $('#fontSelect').fontSelector({
      'hide_fallbacks' : true,
      'initial' : 'Courier New,Courier New,Courier,monospace',
      'selected' : function(style) { alert("S1: " + style); },
      'fonts' : [
        'Arial,Arial,Helvetica,sans-serif',
        'Arial Black,Arial Black,Gadget,sans-serif',
        'Comic Sans MS,Comic Sans MS,cursive',
        'Courier New,Courier New,Courier,monospace',
        'Georgia,Georgia,serif',
        'Impact,Charcoal,sans-serif',
        'Lucida Console,Monaco,monospace',
        'Lucida Sans Unicode,Lucida Grande,sans-serif',
        'Palatino Linotype,Book Antiqua,Palatino,serif',
        'Tahoma,Geneva,sans-serif',
        'Times New Roman,Times,serif',
        'Trebuchet MS,Helvetica,sans-serif',
        'Verdana,Geneva,sans-serif',
        'Gill Sans,Geneva,sans-serif'
        ]
    });

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
});