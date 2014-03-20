      $(function() {

          //Enable swiping for tabs
          $(".carousel-inner").swipe( {
            //Generic swipe handler for all directions
            swipeLeft:function(event, direction, distance, duration, fingerCount) {
              $(this).parent().carousel('next'); 
            },
            swipeRight: function() {
              $(this).parent().carousel('prev');
            },
            //Default is 75px, set to 0 for demo so any distance triggers swipe
            threshold:50
          });
          //Enable swiping for menu
          $("#sidebar-wrapper").swipe( {
            //Generic swipe handler for all directions
            swipeLeft:function(event, direction, distance, duration, fingerCount) {
              openCloseMenu();
            },
            swipeRight: function() {
              openCloseMenu();
            },
            //Default is 75px, set to 0 for demo so any distance triggers swipe
            threshold:50
          });

          // Turn to grayscale after page load
          function turnToGrayscale() {
              $('.bg-image>img').addClass('grayscale');
          }
          setTimeout(turnToGrayscale, 3500);

          // Turn on grayscale onFocus on input field 
          $( "#main_search_box" ).focus(function() {
            $('.bg-image>img').removeClass('disabled');
            $('.bg-image>img').addClass('grayscale');
          });
          // Turn off grayscale onFocus on input field 
          $( "#main_search_box" ).blur(function() {
            $('.bg-image>img').addClass('disabled');
          });

          // Side menu button toggle
          function openCloseMenu(){
            //if open then close
              if ($("#menu-toggle").hasClass('active')) {
                  $("#page-content-wrapper").animate({
                    right: "0",
                  }, 300,"swing", function() {
                    // Animation complete.
                    $("#menu-toggle").toggleClass("active");
                  });
                $(".navbar").animate({right: "0",left:"0"}, 300,"swing");
                $("#sidebar-wrapper").animate({right: "-250"}, 300,"swing");
              }
              // else open
              else{
                $("#page-content-wrapper").animate({
                  right: "250",
                }, 300,"swing", function() {
                  // Animation complete.
                  $("#menu-toggle").toggleClass("active");
                });
                $(".navbar").animate({right: "250" ,left:"-250"}, 300,"swing");
                $("#sidebar-wrapper").animate({right: "0"}, 300,"swing");
              }
          }
          $("#menu-toggle").click(function(e) {
              e.preventDefault();
              openCloseMenu();
          });

          // feature hover
          $('.feature').hover(
          // rollover
          function(){
            $(this).find('.feature-icon').addClass('active');
            $(this).find('h3').addClass('active');
            $(this).find('p').addClass('active');
          },
          // rollout
          function(){
            $(this).find('.feature-icon').removeClass('active');
            $(this).find('h3').removeClass('active');
            $(this).find('p').removeClass('active');
          });

          // toggle Drop Screen
          $('.bottom-bar-handle').click(function() {
            $('.drop-screen').toggleClass('active');
            $('.team-default').toggleClass('active');
            $('.team-active').toggleClass('active');
          });

          // Scroll Snaping
          function navBarToggle(dir){
            if( dir =='down'){
              $(".navbar .center-logo").animate({top: "80",}, 300,"swing");
              $(".navbar .facebook-input-holder").animate({ top: "16"}, 300,"swing");
              $(".navbar .navbar-brand img").animate({marginTop: "14"}, 300,"swing");
            }
            else if(dir =='up'){
              $(".navbar .center-logo").animate({top: "9"}, 300,"swing");
              $(".navbar .facebook-input-holder").animate({top: "-50"}, 300,"swing");
              $(".navbar .navbar-brand img").animate({marginTop: "-65"}, 300,"swing");
            }
          }
          // if scrolled to top change header
          $(window).on('scroll', function() {
            var scrollTop = $(this).scrollTop();
            var toggleFlag = $('.navbar').hasClass('active');
            //console.log(scrollTop);
            //console.log(toggleFlag);
            if ( (scrollTop <= 290) && (toggleFlag) ) {
              $('.navbar').removeClass('active');
              //$('#menu-toggle').fadeIn('fast');
              $('#menu-toggle').removeClass('hidden-xs');
              navBarToggle('up');
            }
            else if((scrollTop > 290) && (!toggleFlag)){
              $('.navbar').addClass('active');
              $('#menu-toggle').addClass('hidden-xs');
              /*$('#menu-toggle').fadeOut('fast',function(){
              });*/
              navBarToggle('down');
            }
          });

          // Sidebar Menu onClick
          $('#sidebar-wrapper > .sidebar-nav > li > a.sidebar-link').click(function() {
              openCloseMenu();
              var target = 'section.'+$(this).attr('data-target');
              if (target.length) {
                $('html,body').delay(300).animate({
                  scrollTop: ($(target).offset().top)-70
                }, 700);
                return false;
              }
          });
          // init scrollsnap
          /*$(document).scrollsnap({
              snaps: 'div.row.visible-xs',
              proximity: 100,
              onSnapWait: 500,
              offset:-70,
              onSnap: function(obj){
                console.log(obj.context.className);
                if(obj.context.className != 'home'){
                  //console.log('onSnap: Down');
                  //navBarToggle('down');
                }
                else{
                  //console.log('onSnap: Up');
                  //navBarToggle('up');
                }
              }
          });*/
      });