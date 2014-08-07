$(document).ready(function(){
/* Subscribe form validation */

	$(".subscribe").validate({
		focusInvalid: false,
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			}
		},
		errorPlacement: function(error, element) {
			error.hide();
		},
		submitHandler: function(){
			$.post($(".subscribe").attr('action'), $(".subscribe").serialize()+'&ajax=1', function(result){
				if(result)
				{
					$('#success').fadeIn(500);
				}
				else
				{
					$('#error').fadeIn(500);
				}
			});
		}
	});
	$("#success, #error").hover(function(){
		$(this).fadeOut();
	});
})