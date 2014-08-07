Cufon.replace('.cufonfont,#logo a,#logo a span,#topcontacts,#topcontacts span,h1,h2,h3,h4,p.describe,table tr,label.getquote,#bottompromo .bpleft', {fontFamily: 'PTSans'} );
Cufon.replace('a.action,.tabnav li a span', {fontFamily: 'PTSans',textShadow:'1px 1px 1px #FFF'} );

var $ = jQuery.noConflict();

$(document).ready(function() {
	
		$('a.action,#fsocial li a img,.bigsubmit,.smallsubmit').hover(function(){
			$(this).animate({opacity: 0.7}, 300);
		}, function () {
			$(this).animate({opacity: 1}, 300);
		});
		
		
		$('.ntip').tipsy({gravity: 's', fade:true});
		$('.stip').tipsy({gravity: 'n', fade:true});
		$('.etip').tipsy({gravity: 'w', fade:true});
		$('.wtip').tipsy({gravity: 'e', fade:true});
		
		
		$('#offerslide').cycle({ 
        	fx:'scrollLeft,scrollDown,scrollRight,scrollUp',
			timeout:3000,
			easing:'easeInBack' // easing supported via the easing plugin 
    	});
    	
    	$('#offerslide').hover(function() { 
    		$('#offerslide').cycle('pause'); 
		}, function() { 
    		$('#offerslide').cycle('resume'); 
		}
		);
		
		$('#pgallery li a').mouseenter(function(e) {
            $(this).children('img').animate(300);
            $(this).children('span').fadeIn(400);
        }).mouseleave(function(e) {
            $(this).children('img').animate(300);
            $(this).children('span').fadeOut(400);
        });
		
		
		$(".details-content").hide(); //Hide all content
			$("ul.tabnav li:first").addClass("active").show(); //Activate first tab
			$(".details-content:first").show(); //Show first tab content

			//On Click Event
			$("ul.tabnav li").click(function() {

				$("ul.tabnav li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".details-content").hide(); //Hide all tab content

				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(600); //Fade in the active ID content
				return false;
			});
			
		$("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal',
			theme: 'dark_rounded'
			});
			
});


$(document).ready(function() {
	
		$('input[type="text"],select,textarea').focus(function () {
			$(this).removeClass("invalidfield");
		});
	
		//Ajax forms
			
		// Newsletter Form
			
		$('#newsletterform_submit').click(function () {
          
        //Get the data from all the fields
        
        var regemail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  		 
        var ajaxnewsletteremail = $('input[name="newsletterform_email"]');  
          
        if (ajaxnewsletteremail.val()=='') {  
            ajaxnewsletteremail.addClass('invalidfield');  
            return false;  
        } else ajaxnewsletteremail.removeClass('invalidfield');
		
		if (ajaxnewsletteremail.val()=='Subscribe Now to get Discount Coupons &amp; Other Promotions') {  
            ajaxnewsletteremail.addClass('invalidfield');  
            return false;  
        } else ajaxnewsletteremail.removeClass('invalidfield');        
		
		if(regemail.test(ajaxnewsletteremail.val()) == false) {
  			ajaxnewsletteremail.addClass('invalidfield');  
            return false;  
        } else ajaxnewsletteremail.removeClass('invalidfield');
		
		//organize the data properly  
        var data = 'email=' + ajaxnewsletteremail.val();
          
        //start the ajax  
        $.ajax({  
            //this is the php file that processes the data and send mail  
            url: "newsletter.php",   
              
            //GET method is used  
            type: "GET",  
  
            //pass the data           
            data: data,       
              
            //Do not cache the page  
            cache: false,  
              
            //success  
            success: function (html) {                
                //if process.php returned 1/true (send mail success)  
                if (html==1) {                    
                    //hide the form  
                    $('#newsletter').hide();                   
                      
                    //show the success message  
                    $('#newsletterform_successmsg').fadeIn('slow');  
                      
                //if process.php returned 0/false (send mail failed)  
                } else alert('Sorry, unexpected error. Please Refresh the Page & Try Again.');                 
            }         
        });  
          
        //cancel the submit button default behaviours  
        return false;  
    });
    
    
    
    
    
    
    // Contact Form
			
		$('#contactform_submit').click(function () {
          
        //Get the data from all the fields
        
        var regemail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  		 
		var ajaxcontactname = $('input[name="contactform_name"]');
        var ajaxcontactemail = $('input[name="contactform_email"]');
        var ajaxcontactmessage = $('textarea[name="contactform_message"]');
        
        if (ajaxcontactname.val()=='') {  
            ajaxcontactname.addClass('invalidfield');  
            return false;  
        } else ajaxcontactname.removeClass('invalidfield');
        
        if (ajaxcontactemail.val()=='') {  
            ajaxcontactemail.addClass('invalidfield');  
            return false;  
        } else ajaxcontactemail.removeClass('invalidfield');        
		
		if(regemail.test(ajaxcontactemail.val()) == false) {
  			ajaxcontactemail.addClass('invalidfield');  
            return false;  
        } else ajaxcontactemail.removeClass('invalidfield');
        
        if (ajaxcontactmessage.val()=='') {  
            ajaxcontactmessage.addClass('invalidfield');  
            return false;  
        } else ajaxcontactmessage.removeClass('invalidfield');
          
        //organize the data properly  
        var data = 'name=' + ajaxcontactname.val() + '&email=' + ajaxcontactemail.val() + '&message=' + ajaxcontactmessage.val();
          
        //start the ajax  
        $.ajax({  
            //this is the php file that processes the data and send mail  
            url: "contact.php",   
              
            //GET method is used  
            type: "GET",  
  
            //pass the data           
            data: data,       
              
            //Do not cache the page  
            cache: false,  
              
            //success  
            success: function (html) {                
                //if process.php returned 1/true (send mail success)  
                if (html==1) {                    
                    //hide the form  
                    $('#contactform').hide();                   
                      
                    //show the success message  
                    $('#contactform_successmsg').fadeIn('slow');  
                      
                //if process.php returned 0/false (send mail failed)  
                } else alert('Sorry, unexpected error. Please Refresh the Page & Try Again.');                 
            }         
        });  
          
        //cancel the submit button default behaviours  
        return false;  
    });
    
    
    
    
    
    // Get Quote Form
			
		$('#getquote_submit').click(function () {
          
        //Get the data from all the fields
        
        var regemail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  		 
		var ajaxgetquotename = $('input[name="getquote_name"]');
        var ajaxgetquoteemail = $('input[name="getquote_email"]');
        var ajaxgetquotewebsite = $('input[name="getquote_website"]');
        var ajaxgetquotecompany = $('input[name="getquote_company"]');
        var ajaxgetquotephone = $('input[name="getquote_phone"]');
        var ajaxgetquotepages = $('select[name="getquote_pages"]');
        
        if (ajaxgetquotename.val()=='') {  
            ajaxgetquotename.addClass('invalidfield');  
            return false;  
        } else ajaxgetquotename.removeClass('invalidfield');
        
        if (ajaxgetquoteemail.val()=='') {  
            ajaxgetquoteemail.addClass('invalidfield');  
            return false;  
        } else ajaxgetquoteemail.removeClass('invalidfield');        
		
		if(regemail.test(ajaxgetquoteemail.val()) == false) {
  			ajaxgetquoteemail.addClass('invalidfield');  
            return false;  
        } else ajaxgetquoteemail.removeClass('invalidfield');
        
        if (ajaxgetquotewebsite.val()=='') {  
            ajaxgetquotewebsite.addClass('invalidfield');  
            return false;  
        } else ajaxgetquotewebsite.removeClass('invalidfield');
        
        if (ajaxgetquotecompany.val()=='') {  
            ajaxgetquotecompany.addClass('invalidfield');  
            return false;  
        } else ajaxgetquotecompany.removeClass('invalidfield');
        
        if (ajaxgetquotephone.val()=='') {  
            ajaxgetquotephone.addClass('invalidfield');  
            return false;  
        } else ajaxgetquotephone.removeClass('invalidfield');
        
        if (ajaxgetquotepages.val()=='') {  
            ajaxgetquotepages.addClass('invalidfield');  
            return false;  
        } else ajaxgetquotepages.removeClass('invalidfield');
          
        //organize the data properly  
        var data = 'name=' + ajaxgetquotename.val() + '&email=' + ajaxgetquoteemail.val() + '&website=' + ajaxgetquotewebsite.val() + '&company=' + ajaxgetquotecompany.val() + '&phone=' + ajaxgetquotephone.val() + '&pages=' + ajaxgetquotepages.val();
          
        //start the ajax  
        $.ajax({  
            //this is the php file that processes the data and send mail  
            url: "getquote.php",   
              
            //GET method is used  
            type: "GET",  
  
            //pass the data           
            data: data,       
              
            //Do not cache the page  
            cache: false,  
              
            //success  
            success: function (html) {                
                //if process.php returned 1/true (send mail success)  
                if (html==1) {                    
                    //hide the form  
                    $('#getquote').hide();                   
                      
                    //show the success message  
                    $('#getquoteform_successmsg').fadeIn('slow');  
                      
                //if process.php returned 0/false (send mail failed)  
                } else alert('Sorry, unexpected error. Please Refresh the Page & Try Again.');                 
            }         
        });  
          
        //cancel the submit button default behaviours  
        return false;  
    });
    
});