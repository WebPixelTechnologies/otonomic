$(function() {

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
});