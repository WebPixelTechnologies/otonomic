$(document).ready(function () {


      if ( $(window).width() < 780) {

                $('#tp_tips_show1').fadeIn();
                  setTimeout(function(){$('#tp_tips_show1').fadeOut();}, 5000);
                  $('#tp_tips_show2').fadeIn();
                  setTimeout(function(){$('#tp_tips_show2').fadeOut();}, 5000);

                  $('#show_social_content').click(function(){
                      $('#tab2').fadeIn(function(){                        
                        $('#tp_tips_show3').fadeIn();
                        setTimeout(function(){$('#tp_tips_show3').fadeOut();}, 5000);
                      });
                      $('#fb_first_v_content').hide();
                      $('#fb_first_v_content2').fadeIn();
                      $('#social_showit_content').fadeOut();
                      $('#tp_tips_show1').fadeOut();
                      $('#tp_tips_show2').fadeOut();
                      
                  });

                  $('#fb_showit_btn2').click(function(){
                      
                    $('#fb_first_v_content').fadeOut();
                     $('#tab2').fadeOut();
                    $('#fb_frame_content').fadeIn(function(){                        
                        $('#tp_tips_show3').fadeIn();
                        setTimeout(function(){$('#tp_tips_show3').fadeOut();}, 5000);
                    });
                });

                  $('#tab1').hide();

                  $('.header_wrap2').click(function(){
                      $('#tab1').fadeIn();                      
                      $('#tp_tips_show1').fadeOut();
                      $('#tp_tips_show2').fadeOut();
                  });

                  $('#close_contact').click(function(){
                    $('#tab1').fadeOut();
                });

                  

                  }

                else {  


                   $('#open_panel').click(function(event){
                    event.preventDefault();
                    $('#slide_panel').stop().animate({left:"0"}, 500);
                });

                $('#close_panel').click(function(event){
                  event.preventDefault();
                    $('#slide_panel').stop().animate({left:"-400px"}, 500);
                });

                function createCORSRequest(method, url){
                    var xhr = new XMLHttpRequest();
                    if ("withCredentials" in xhr){
                        // XHR has 'withCredentials' property only if it supports CORS
                        xhr.open(method, url, true);
                    } else if (typeof XDomainRequest != "undefined"){ // if IE use XDR
                        xhr = new XDomainRequest();
                        xhr.open(method, url);
                    } else {
                        xhr = null;
                    }
                    return xhr;
                }
                
                $('#fb_showit_btn').click(function(){
                    
                    var token = "CAACEdEose0cBABdM13vnPYHFxvwrLPxkhzrsZBApiZBcTiQ14NXEj6ZAPi9q3OcJbdPRb1XCxo5IAldYIsYJ3kVrF1DYQBG2XRVjduZAn8pqTbtQ2QubAWEdRzNch10o2ZAqCeVFkCbV9DQXzvcIr73ERU6eaxU0peixmZBLqu8zVwfWxyG0sXLZBKHXjgQV7Mm3675APHAKfZAqywKqhQu7";
                      var fb_id = "1478156079139581";
                      var url = "https://graph.facebook.com/v2.0/"+fb_id+"/albums?access_token="+token+"&fields=id,name,count,photos.fields(id,picture,source,caption,width,height,created_time,updated_time,name)";
                      //var encode_url = "https://m.facebook.com/page/reviews.php?"+ encodeURI("id=1478156079139581");
                      //var test_url = "http://wp.otonomic.com/migration/helpers/FacebookReviews.php?"+ encodeURI("url="+encode_url);
                        var div_data ='';
                      $.ajax({
                        type:'GET',                     
                        url:'test.php?fb_id=1478156079139581',
                        //url:'http://graph.facebook.com/6261817190/reviews',                       
                        //url:test_url,                                             
                        dataType:'JSON',
                        //jsonpCallback:'callback',
                        //crossDomain: true,
                        //processData: true,
                        //async:false,
                        success:function(data){
                            //console.log(JSON.parse(data));
                            var review_data = JSON.parse(data);
                            console.log(review_data);
                            var review_data_length = review_data.facebook_reviews.length;
                            var review_cnt;
                            for(review_cnt=0;review_cnt<review_data_length;review_cnt++){
                                var img_split = review_data.facebook_reviews[review_cnt].user_picture.split('?');
                                img_split= img_split[0];
                                //alert(img_split);
                                if(div_data == ''){
                                    div_data = "<div class='testimonial_list'><div class='testimonial_left_prfl_pic'><img src="+img_split+" width ='58' height = '58'></div><div class='testimonial_details'><h4>"+review_data.facebook_reviews[review_cnt].user_name+"</h4><div class='test_ratings_wrap'><img src='images/star-rating.png' alt='star'></div><p>"+review_data.facebook_reviews[review_cnt].text+"</p></div></div>";
                                }else{
                                    div_data = div_data + "<div class='testimonial_list'><div class='testimonial_left_prfl_pic'><img src="+img_split+" width ='58' height = '58'></div><div class='testimonial_details'><h4>"+review_data.facebook_reviews[review_cnt].user_name+"</h4><div class='test_ratings_wrap'><img src='images/star-rating.png' alt='star'></div><p>"+review_data.facebook_reviews[review_cnt].text+"</p></div></div>";
                                }
                            }
                            //console.log(div_data);
                            $('#testimonial_list_wrap_id').empty();
                            $('#testimonial_list_wrap_id').html(div_data);
                            
                        },
                        error: function (error) {   
                            console.log(error);
                            //alert(12)
                            
                          }
                    });
                    
                    //return false;
                      var url = "https://graph.facebook.com/v2.0/"+fb_id+"/albums?access_token="+token+"&fields=id,name,count,photos.fields(id,picture,source,caption,width,height,created_time,updated_time,name)";
                      $.ajax({
                            url:url,
                            type:'GET',                         
                            success:function(response){
                                //console.log(response.data);
                                var li_data='';
                                var data_length = response.data.length;
                                var i;
                                for(i=0;i<data_length;i++){
                                    
                                    var each_data = response.data[i];
                                    //console.log(each_data);
                                    var j;
                                    for(j=0;j<each_data.count;j++){
                                        if(li_data == ''){
                                            li_data = "<li><a href='#'><img src="+each_data.photos.data[j].source+" width ='66' height = '63'></a></li>";
                                        }else{
                                            li_data = li_data + "<li><a href='#'><img src="+each_data.photos.data[j].source+" width ='66' height = '63'></a></li>";
                                        }
                                    }
                                }
                                //console.log(li_data);
                                $('#photos_container_ul').empty();
                                $('#photos_container_ul').html(li_data);
                            },
                            error: function (error) {
                                  
                              }
                              //console.log(li_data);
                        });
                        
                    $('#fb_first_v_content').hide();
                    $('#social_showit_content').fadeIn();
                    $('#fb_frame_content').fadeIn();
                });


         $(".tab_menu_wrap a").click(function(event){
              event.preventDefault();
              $(this).parent().addClass("active");
              $(this).parent().siblings().removeClass("active");

              var tab = $(this).attr("href");
              $(".tab_content").not(tab).css("display", "none");
              $(tab).fadeIn();
            });


                }

          $("#open_hours").click(function(){                           
                            
                if ($("#openCloseIdentifier").is(":hidden")) {
                    $(".open_hrs_content_wrap").fadeIn();
                    $(".hrs_arrow").html('<img src="images/arrow_up.png" alt="open" />');
                    $("#openCloseIdentifier").show();
          } else {
                  $(".open_hrs_content_wrap").fadeOut();
                  $(".hrs_arrow").html('<img src="images/arrow_down.png" alt="close" />');
                  $("#openCloseIdentifier").hide();
      } 

      });
/*
 * Replace all SVG images with inline SVG
 */
jQuery('img.svg').each(function(){
    var $img = jQuery(this);
    var imgID = $img.attr('id');
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');

    jQuery.get(imgURL, function(data) {
        // Get the SVG tag, ignore the rest
        var $svg = jQuery(data).find('svg');

        // Add replaced image's ID to the new SVG
        if(typeof imgID !== 'undefined') {
            $svg = $svg.attr('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if(typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', imgClass+' replaced-svg');
        }

        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');

        // Replace image with new SVG
        $img.replaceWith($svg);

    }, 'xml');

});
});