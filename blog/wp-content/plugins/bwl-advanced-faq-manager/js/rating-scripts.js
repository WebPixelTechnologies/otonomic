jQuery(document).ready(function() {    
 
    /*
     * Introduced: Version - 1.4.4
     * Create Date: 25-10-2013
     * Last Update: 25-10-2013
     */
    
    var accordion_container = jQuery(".ac-container");
    var accordion_single_faq_post_container = jQuery(".single-faq-post");
    
    var all_article_faq_container = accordion_container.find("article");
   
    var all_article_faq_label = accordion_container.find("label");
        
        if ( bwl_advanced_faq_collapsible_accordion_status == 1) {
        
            all_article_faq_label.css("background-image", "-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, "+first_color+"), color-stop(100%, "+second_color+"))");
            all_article_faq_label.css("background-image", "-webkit-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            all_article_faq_label.css("background-image", "-moz-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            all_article_faq_label.css("background-image", "-o-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            all_article_faq_label.css("background-image", "linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");

                all_article_faq_container.css({
                    visibility: 'hidden',
                    height: '0px',
                    padding: '0px 10px 0px 10px'
                });
            
        }
        
    /*
     * Title: Collapsable Accordion
     * Introduced: Ver - 1.4.4
     * Create Date: 25-06-2013
     * Last Update: 25-10-2013
     */
     
    if ( bwl_advanced_faq_collapsible_accordion_status == 1 ) {
     
        accordion_container.find("article").css({
                visibility: 'hidden',
                height: '0px',
                padding: '0px'
            }).addClass("article-box-shadow");
        
        accordion_container.find("input[type=checkbox]").attr("checked","checked");
        
        var label_default_state_color = accordion_container.find("label").attr("style");
        
        accordion_container.find("label").on("click",function(){

            var label_id = jQuery(this).attr("label_id");
            var parent_container_id = jQuery(this).attr("parent_container_id");
            var checkbox_id = jQuery(this).attr("for");
            
            // Modify Accordion Container.
            
            accordion_container = jQuery(".ac-container[container_id="+parent_container_id+"]");

            /*------------------------------  LABEL SECTION ---------------------------------*/

            var current_faq_label_container = jQuery(this);
            var other_faq_label_container = accordion_container.find("label[label_id != "+label_id+"]");

            other_faq_label_container.css("background-image", "-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, "+first_color+"), color-stop(100%, "+second_color+"))");
            other_faq_label_container.css("background-image", "-webkit-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            other_faq_label_container.css("background-image", "-moz-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            other_faq_label_container.css("background-image", "-o-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            other_faq_label_container.css("background-image", "linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");


            /*------------------------------  ARTICLE SECTION---------------------------------*/

            var current_article_faq_container = accordion_container.find("article[article_id="+label_id+"]");
            var other_article_faq_container = accordion_container.find("article[article_id != "+label_id+"]");

            // New code in version 1.4.6
            
            if ( ! accordion_container.find("input[id="+checkbox_id+"]").is(':checked') ) {
                
                current_article_faq_container.css({
                    visibility: 'hidden',
                    height: '0px',
                    padding: '0px'
                }).addClass("article-box-shadow");
                
                // change in here
                current_faq_label_container.attr("style", label_default_state_color);
                
            } else {
                
                current_article_faq_container.css({
                    height: 'auto', // issue in here
                    visibility: 'visible',
                    padding: '11px 10px 10px 10px',
                }).addClass("article-box-shadow");
                
                
                current_faq_label_container.css({
                    background: checked_background
                });
                
                accordion_container.find("input[id !="+checkbox_id+"]").attr("checked","checked");
                
            }
            // New code in version 1.4.6
 
            other_article_faq_container.css({
                visibility: 'hidden',
                height: '0px',
                padding: '0px 10px 0px 10px'
            }).removeClass("article-box-shadow");

        })
    
    }
        
        
    /*
     * Title: Show All FAQs Opened
     * Introduced: Ver - 1.4.4
     * Create Date: 25-06-2013
     * Last Update: 25-10-2013
     */    
        
      if( bwl_advanced_faq_collapsible_accordion_status == 2 ) {
                
//        var label_default_state_color = accordion_container.find("label").attr("style");

                accordion_container.find("label").css({
                    background: checked_background
                });
        
//        console.log(" "+label_default_state_color);
        
        accordion_container.find("label").on("click",function(){

            var label_id = jQuery(this).attr("label_id");
            var parent_container_id = jQuery(this).attr("parent_container_id");
            var checkbox_id = jQuery(this).attr("for");
            
            // Modify Accordion Container.
            
            accordion_container = jQuery(".ac-container[container_id="+parent_container_id+"]");

            /*------------------------------  LABEL SECTION ---------------------------------*/

            var current_faq_label_container = jQuery(this);
            var other_faq_label_container = accordion_container.find("label[label_id != "+label_id+"]");

            other_faq_label_container.css("background-image", "-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, "+first_color+"), color-stop(100%, "+second_color+"))");
            other_faq_label_container.css("background-image", "-webkit-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            other_faq_label_container.css("background-image", "-moz-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            other_faq_label_container.css("background-image", "-o-linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");
            other_faq_label_container.css("background-image", "linear-gradient(top, "+first_color+" 0%,"+second_color+" 100%)");


            /*------------------------------  ARTICLE SECTION---------------------------------*/

            var current_article_faq_container = accordion_container.find("article[article_id="+label_id+"]");
            var other_article_faq_container = accordion_container.find("article[article_id != "+label_id+"]");

            // New code in version 1.4.6
            
            if ( ! accordion_container.find("input[id="+checkbox_id+"]").is(':checked') ) {
                
                current_article_faq_container.css({
                    visibility: 'hidden',
                    height: '0px',
                    padding: '0px'
                }).addClass("article-box-shadow");
                
                // change in here
                current_faq_label_container.removeAttr("style");
                
            } else {
                
                current_article_faq_container.css({
                    height: 'auto', // issue in here
                    visibility: 'visible',
                    padding: '11px 10px 10px 10px',
                }).addClass("article-box-shadow");
                
//                alert(checked_background);
//                
                current_faq_label_container.css({
                    background: checked_background
                });
                
                accordion_container.find("input[id !="+checkbox_id+"]").attr("checked","checked");
                
            }

        });
        
         accordion_container.find("input[type=checkbox]").removeAttr("checked");
       
         all_article_faq_container.css({
                    height: 'auto', // issue in here
                    visibility: 'visible',
                    padding: '11px 10px 10px 10px',
                }).addClass("article-box-shadow");
                
                
      }
      
      
    /*
     * Introduced: Version - 1.4.9
     * Create Date: 04-04-2014
     * Last Update: 04-04-2014
     */
     
     if( accordion_single_faq_post_container.length > 0 ) {
         
         accordion_single_faq_post_container.find("input[type=checkbox]").removeAttr("checked");
         
         var all_single_faqs = accordion_single_faq_post_container.find("article");
   
         all_single_faqs.css({
                    height: 'auto', // issue in here
                    visibility: 'visible',
                    padding: '11px 10px 10px 10px',
                }).addClass("article-box-shadow");
         
     }
     
     
        
 
    /*
     * Introduced: Ver - 1.4.4
     * Create Date: 25-10-2013
     * Last Update: 25-10-2013
     */
    
    jQuery('.ac-container input[type=checkbox]').css({
        display: 'none'
    });
 
    
 
    /*
     * Introduced: Ver - 1.0.0
     * Create Date: 25-06-2013
     * Last Update: 25-10-2013
     */
 
    jQuery(".post-like a").click(function() {
      
        icon_container = jQuery(this);
      
        // Retrieve post ID from data attribute  
        post_id = icon_container.data("post_id");
        
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',            
            dataType: 'JSON',
            data: {
                action      : 'bwl_advanced_faq_apply_rating', // action will be the function name
                post_like  : true,
                post_id    : post_id 
            },
            success: function(data) {
                
                 // If vote successful  
                if ( data.status == 0 ) {
                    icon_container.addClass("voted");  
                    icon_container.siblings(".count").text('').append(data.msg);  
                } if ( data.status == 1 ) {
                    icon_container.addClass("voted");  
                    icon_container.siblings(".count").text('').append(data.msg);  
                }
            },
            error: function(xhr, textStatus, e) {
                alert('There was an error saving the update.');
                return;
            }
            
        });

        return false;  
        
    });
    
    
    
    /*------------------------------ Form Submission  ---------------------------------*/
    
    function randomNum( maxNum ){
        
        return Math.floor(Math.random()*maxNum+1);//return a number between 1 - 10
        
    }
    
     jQuery(".bwl_advanced_faq_form").find("input[type=submit]").click(function() {
         
         var form_submit_button = jQuery(this),
               bwl_advanced_faq_form_id = form_submit_button.attr('bwl_advanced_faq_form_id'),
               form_box_container = jQuery("#" + bwl_advanced_faq_form_id),
               form_field_container = jQuery("#" + bwl_advanced_faq_form_id + " .bwl_advanced_faq_form");         
  
         
         var message_box = form_box_container.find('.bwl-faq-form-message-box'),
               title = form_field_container.find('#title'),
               cat = form_field_container.find('#cat'), 
               captcha_status = form_field_container.find('#captcha_status');
               
               if( captcha_status.val() == 1 ) {
                    
                   var num1 = form_field_container.find('#num1');
                   var num2 = form_field_container.find('#num2');
                   var  captcha = form_field_container.find('#captcha');
                   var all_fields = jQuery( [] ).add( title ).add( cat ).add( captcha );   
                    
               } else {
                   
                    var all_fields = jQuery( [] ).add( title ).add( cat );                
                    
               }
               
               
               var bValid = true,
                    required_field_msg = "",
                    ok_border = "border: 1px solid #EEEEEE",
                    error_border = "border: 1px solid #E63F37";
                    
               if( jQuery.trim(title.val()).length <3 ) {
                   
                   title_bValid = false;
                   title.attr("style", error_border);
                   required_field_msg += " " + err_faq_question + "<br />";
                   
               } else {
                   
                   title_bValid = true;
                   title.attr("style", ok_border);                   
                   required_field_msg += "";                   
                   
               }
               
               bValid = bValid && title_bValid;
               
               if( jQuery.trim(cat.val()) == -1 ) {
                   
                   cat_bValid = false;
                   cat.attr("style",error_border);
                   required_field_msg += " " + err_faq_category;
                   
               } else {
                   
                   cat_bValid = true;
                   cat.attr("style",ok_border);
                   required_field_msg += "";
                   
               }
              
                bValid = bValid && cat_bValid;
                
                if ( captcha_status.val() == 1 ) {
                
                    if( ( parseInt( jQuery.trim( num1.val() ) ) + parseInt( jQuery.trim( num2.val() ) ) != parseInt(  jQuery.trim( captcha.val() ) ) ) ) {

                       captcha_bValid = false;
                       captcha.attr("style",error_border);
                       required_field_msg += " " + err_faq_captcha;

                   } else {

                       captcha_bValid = true;
                       captcha.attr("style",ok_border);
                       required_field_msg += "";

                   }

                   bValid = bValid && captcha_bValid;
               
               }
         
               //Alert Message Box For Required Fields.
               
               if ( bValid == false ) {
                   
                    message_box.html("").addClass("bwl-form-error-box").html( required_field_msg ).slideDown("slow");
                
               }
         
               
               if ( bValid == true ) {
                    all_fields.attr("style",ok_border);
                    all_fields.addClass('bwl_advanced_faq_disabled_field').attr('disabled', 'disabled');
                    form_submit_button.addClass('bwl_advanced_faq_disabled_field').attr('disabled', 'disabled');               
                    message_box.html("").removeClass("bwl-form-error-box").addClass("bwl-form-wait-box").html("Please Wait .....").slideDown("slow");

                     jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            action      : 'bwl_advanced_faq_save_post_data', // action will be the function name,
                            title : title.val(),                          
                            cat : cat.val(),
                            post_type: form_field_container.find('#post_type').val(),
                            name_of_nonce_field: form_field_container.find('#name_of_nonce_field').val(),
                        },
                        success: function(data) {

                            if( data.bwl_faq_add_status == 1 ) {
                                
                                //Reload For New Number.
                                
                                if ( captcha_status.val() == 1 ) {
                                
                                    num1.val(randomNum(5));
                                    num2.val(randomNum(9));
                                    
                                }                                
                                
                                message_box.removeClass('bwl-form-wait-box').html("").html("Question successfully added for review!").addClass("bwl-form-success-box").delay(3000).slideUp("slow");
                                all_fields.val("").removeAttr('disabled').removeClass('bwl_advanced_faq_disabled_field');
                                form_submit_button.removeAttr('disabled').removeClass('bwl_advanced_faq_disabled_field');

                            } else {

                                message_box.removeClass('bwl-form-wait-box').html("").html("Unable to add faq. Please try again!").addClass("bwl-form-error-box").delay(3000).slideUp("slow");                                        
                                all_fields.removeAttr('disabled').removeClass('bwl_advanced_faq_disabled_field');
                                form_submit_button.removeAttr('disabled').removeClass('bwl_advanced_faq_disabled_field');
                            }

                        },
                        error: function(xhr, textStatus, e) {

                            message_box.removeClass('bwl-form-wait-box').html("").html("Unable to add faq. Please try again!").addClass("bwl-form-error-box").delay(3000).slideUp("slow");                                        
                            all_fields.removeAttr('disabled').removeClass('bwl_advanced_faq_disabled_field');
                            form_submit_button.removeAttr('disabled').removeClass('bwl_advanced_faq_disabled_field');
                            return;
                        }

                    });
         
            }
         
            return false;
         
     });    
    
})