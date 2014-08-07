$(document).ready(function(){
	var $validator = $("#frm_createWeb").validate({
		onkeyup : false,
		rules: {
			username: {
				required : true,
				defaultInvalid : true
			},
			email: {
				required: true,
				email: true,
				defaultInvalid : true
			},
			fanpage: {
				required : true,
				cus_url : true,
				defaultInvalid : true
			},
			phone: {
				required : true,
				number : true,
				defaultInvalid : true
			}
		},
		messages: {
			username: "Please enter your name",
			email: "Please enter a valid email address",
			fanpage: "Please enter your fanpage link",
			phone: "Please enter your phone number"
		}
	});
	
	jQuery.validator.addMethod("defaultInvalid", function(value, element) 
	{
		return !(element.value == element.defaultValue);
	});
	
	// custom method for url validation with or without http://
	$.validator.addMethod("cus_url", function(value, element) { 
		if(value.substr(0,7) != 'http://'){
			value = 'http://' + value;
		}
		if(value.substr(value.length-1, 1) != '/'){
			value = value + '/';
		}
		return this.optional(element) || /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(value); 
	}, "Not valid url.");
});
	