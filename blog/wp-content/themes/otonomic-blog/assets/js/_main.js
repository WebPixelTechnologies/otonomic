/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages

          // Change nav-Bar appearance on scroll below Jumbotron
          $(window).on('scroll', function() {
              var scrollTop = $(this).scrollTop();
              var toggleFlag = $('.navbar').hasClass('scrolled');
              //console.log(scrollTop);
              //console.log(toggleFlag);
              if ( (scrollTop <= 300) && (toggleFlag) ) {
                  $('.navbar').removeClass('scrolled');
              }
              else if((scrollTop > 300) && (!toggleFlag)){
                  $('.navbar').addClass('scrolled');
              }
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
            $("section").click(function() {
              //closeSearch('.search-wrapper');
              if ($("#menu-toggle").hasClass('active')) {
                closeMenu();
              }
          });

          $('#sidebar-wrapper').perfectScrollbar();

          $('#more').click(function(e){
            e.preventDefault();
            $(this).parent().hide();
            $('.hidden-option').removeClass('hidden-option');
          });
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};


// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
