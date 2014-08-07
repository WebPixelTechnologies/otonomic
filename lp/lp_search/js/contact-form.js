jQuery(document).ready(function(){
	
	//Do what we need to when form is submitted.	
	jQuery('#form_submit').click(function(){
	
	//Setup any needed variables.
	var input_name = jQuery('#form_name').val(),
		input_email = jQuery('#form_email').val(),
		input_message = jQuery('#form_message').val(),
		response_text = jQuery('#response');
		//Hide any previous response text 
		response_text.hide();
		
		//Change response text to 'loading...'
		response_text.html('Loading...').show();
		
		//Make AJAX request 
		/*$.post('php/contact-send.php', {name: input_name, email: input_email, message: input_message}, function(data){
			response_text.html(data);
		});*/
                
                $.ajax({
                    url: 'php/contact-send.php',
                    data:{name: input_name, email: input_email, message: input_message},
                    dataType : 'json',
                    type : 'POST',
                    success: function(response){
                        if(response && response.status == 'success'){
                            response_text.html(response.message);
                        }else if(response && response.status == 'error'){
                            response_text.html(response.message);
                        }else{
                            alert('nothing found');
                            response_text.html('Error...');
                        }                        
                    },
                    complete:function(){
                        if(jQuery.trim(response_text.html()) == 'Loading...'){
                            response_text.html('Error...');
                        }                        
                    }
		});
		
		//Cancel default action
		return false;
	});

});