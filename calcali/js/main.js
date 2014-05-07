$(document).ready(function(){

	// Search result to input
	$("#search_wrapper_main").delegate(".search-results-item", 'click', function (e) {
		$('#search').val($(this).attr('href'));
		$('#main_search_box').val($(this).find('.media-heading').html());
		closeSearch('.search-wrapper');
		return false;
	});
	
	// Validation
	var metrics = [
	  [ '#name', 'presence', 'שדה זה חובה' ],
	  [ '#email', 'presence', 'שדה זה חובה' ],
	  [ '#email', 'email', 'כתובת מייל לא תקינה' ],
	  [ '#phone', 'presence', 'שדה זה חובה' ],
	  [ '#main_search_box', 'presence', 'שדה זה חובה' ]
	];
	var options = {
	  'helpSpanDisplay' : 'help-inline',
	  'silentSubmit' : 'true',
	  'submitBtnSelector' : '#submit_btn',
	  'groupSelector' : '.form-group',
	  'groupClass' : 'has-error'

	};
	$( "#form" ).nod( metrics, options);

	// Submit
	var form = $('#form');

	var submitFn = function( event, data ) {
		console.log(data);
	 	$.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            //dataType : "json",
            success: function (response) {
                console.log(response);
                if(response == 'Aproved 1'){
                    window.location = "/";
                }
                else{
                    console.dir(response);
                }
            }
        });
	}

	$( '#form' ).on( 'silentSubmit', submitFn );
});