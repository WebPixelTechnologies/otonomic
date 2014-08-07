$.noConflict();
jQuery(document).ready(function($){
    
    var total_req_no=0;
    
	$('#form_name').hover(function() { this.focus(); });
	
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
		  	var input = $(this);
		  	if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
		  	}
		}).blur(function() {
		  	var input = $(this);
		  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
		  	}
		}).blur();
		
		$('[placeholder]').parents('form').submit(function() {
	  		$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
		  			input.val('');
				}
	  		});
		});
	}

    $(".search-results-item a").on('click', function(e) {
        page_name = $('a.page_name', this).html();
    	_gaq.push(['_trackEvent', 'Create site', 'Public page', page_name]);
    
    });
	
	$('#preview-form .form-submit, #preview-form2 .form-submit').on('click',function(e){
		/*
		if(!(url = $('#form_name').val())) {
			e.preventDefault();
			$('#form_name').focus();
			return false;
		};
		*/

		$('body').css('cursor','progress');
		$(this).html('Loading...&nbsp;').css('cursor','progress').parent('form').submit();
	});


	var minlength = 2;
	var already_searched = false;
	
    $("#form_name").keyup(function () {

        var that = this,
        value = $(this).val();
        
        var url = 'https://graph.facebook.com/search';
        //?q={text_box_value, escaped}&type=page&fields=id,name,category,cover,likes
        if (value.length >= minlength ) {
            
            total_req_no += 1;
            var this_req_no=total_req_no;           
			if(!already_searched) {
				_gaq.push(['_trackEvent', 'Search', 'Searched for page', value]);
			}
        	already_searched = true;
                
                             $.jsonp({
                url: 'https://graph.facebook.com/search',
                context: document.body,
                callbackParameter: "callback",
                data : {'q' : value, type : 'page', fields: 'id,name,category,cover,likes', limit: 9, access_token: '389314351133865|O4FgcprDMY0k6rxRUO-KOkWuVoU'},
                success : function (json, textStatus, xOptions) {
                   if(this_req_no < total_req_no) return;
                    var items = [];
                    jQuery.each(json.data, function(key, val) {
            		items.push('<div class="media search-results-item">' + 
                                            '<a class="pull-left fanpage" href="http://builder.page2site.com/sites/add/fbid:' + val.id + '" target="_blank" title="Click to view site">' +
                                                    '<img class="media-object" src="http://graph.facebook.com/' + val.id + '/picture?type=square">' +
                                            '</a>' +
                                            '<div class="media-body pull-left">' + 
                                                    '<p class="media-heading">' +
                                                            '<a class="page_name" href="http://builder.page2site.com/sites/add/fbid:' + val.id + '" target="_blank" title="Click to view site">' + val.name + '</a>' +
                                                    '</p>' +
                                                    '<p class="media-address">' +
                                                            val.category +   
                                                    '</p>' + 
                                                    '<p class="media-address" style="color:black;">' + val.likes + ' likes</p>' +
                                            '</div>' +
                                            '<div class="clearfix"></div>' +
                                    '</div>'
                        );
                            
                         
                    });
                    $('#search-wrapper').html($('<div/>', {'class': 'search_results',html: items.join('')}));                    
                }
            });
                        
             
           
        }
    });
});